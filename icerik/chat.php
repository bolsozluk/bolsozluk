<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Güvenlik önlemleri
$ip = $_SERVER['REMOTE_ADDR'];
if ($ip == "188.119.5.42") {
    die();
}

/*
session_start();
$kullaniciAdi = isset($_SESSION['kullaniciAdi']) ? $_SESSION['kullaniciAdi'] : '';
$yetki = isset($_SESSION['yetki']) ? $_SESSION['yetki'] : '';

// Veritabanı bağlantısı
$host = "localhost";
$user = "bol_db";
$password = "1q2w3E4R";
$name = "bol";

$databaseConnection = mysql_connect($host, $user, $password);
if (!$databaseConnection) {
    header('HTTP/1.1 500 Internal Server Error');
    die(json_encode(['error' => 'Veritabanı bağlantı hatası']));
}

if (!mysql_select_db($name, $databaseConnection)) {
    header('HTTP/1.1 500 Internal Server Error');
    die(json_encode(['error' => 'Veritabanı seçilemedi']));
}

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
*/

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
function convertTurkishToAscii($text) {
    $turkish = array('ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç');
    $english = array('i', 'g', 'u', 's', 'o', 'c', 'I', 'G', 'U', 'S', 'O', 'C');
    return str_replace($turkish, $english, $text);
}

try {
    switch ($action) {
        case 'get_messages':
            // Sadece hidden=0 olan mesajları getir
            $result = mysql_query("SELECT * FROM chat_messages WHERE hidden = 0 ORDER BY id DESC LIMIT 70");
            if (!$result) {
                throw new Exception('Sorgu hatası: ' . mysql_error());
            }

            $messages = array();
            while ($row = mysql_fetch_assoc($result)) {
                $messages[] = array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'message' => $row['message'],
                    'created_at' => $row['created_at'],
                    'is_verified' => $row['verified']
                );
            }

            // ID'ye göre sırala (artan sıra)
            usort($messages, function($a, $b) {
                return $a['id'] - $b['id'];
            });

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($messages);
            exit;

        case 'get_hidden_messages':
            // Sadece adminler gizli mesajları görebilir
            if ($kulYetki !== 'admin' && $kulYetki !== 'mod') {
                header('HTTP/1.1 403 Forbidden');
                die('Yetkiniz yok');
            }
            
             $result = mysql_query("SELECT * FROM chat_messages WHERE hidden = 1 ORDER BY id DESC LIMIT 70");
            if (!$result) {
                throw new Exception('Sorgu hatası: ' . mysql_error());
            }

            $messages = array();
            while ($row = mysql_fetch_assoc($result)) {
                 $messages[] = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'message' => $row['message'],
        'created_at' => $row['created_at'],
        'ip' => $row['ip'] // IP'yi de JSON'a ekliyoruz
                );
            }

            usort($messages, function($a, $b) {
                return $a['id'] - $b['id'];
            });

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($messages);
            exit;

        case 'get_online_count':
            $threshold = time() - 600;
            $result = mysql_query("SELECT COUNT(DISTINCT username) as count FROM chat_messages WHERE hidden = 0 AND UNIX_TIMESTAMP(created_at) > $threshold");
            if (!$result) {
                throw new Exception('Sorgu hatası: ' . mysql_error());
            }
            $row = mysql_fetch_assoc($result);            
            echo isset($row['count']) ? (int)$row['count'] : 0;
            break;

   case 'send_message':
    $nick = mysql_real_escape_string(trim($_POST['nick']));
    $message = mysql_real_escape_string(trim($_POST['message']));
    $verified = 0;

            if ($kullaniciAdi) {
                $checkUser = mysql_query("SELECT id FROM user WHERE nick = '".mysql_real_escape_string($kullaniciAdi)."'");
                $verified = mysql_num_rows($checkUser) > 0 ? 1 : 0;


                $nick = mysql_real_escape_string($kullaniciAdi);
                //$nick = mysql_real_escape_string(trim($_POST['nick'])); // Direkt formdan gelen nick
            } else {
                // Anonim kullanıcı için nick kontrolü
                if (empty($_POST['nick'])) {
                    header('HTTP/1.1 400 Bad Request');
                    die('Nick boş olamaz.');
                }
                $nickInput = mysql_real_escape_string($_POST['nick']);

                // Burada "kullanici_tablosu" kısmını kendi kullanıcı tablon ile değiştir
                // Ve nick alanı senin veritabanındaki kullanıcı adı sütun adı olmalı
                
                $nickAscii = convertTurkishToAscii($nickInput);
                
                $query = "SELECT COUNT(*) AS count FROM user WHERE nick = '$nickAscii'";
                $res = mysql_query($query);
                if (!$res) {
                    header('HTTP/1.1 500 Internal Server Error');
                    die('Kullanıcı sorgu hatası.');
                }
                $row = mysql_fetch_assoc($res);
                if ($row['count'] > 0) {
                    header('HTTP/1.1 403 Forbidden');
                    die('Bu nick kullanılamaz.');
                }
                $nick = $nickInput;
            }

            // Rate Limiting (IP ve nick bazında)

            $ipEsc = mysql_real_escape_string($ip);

            // 1) Çok kısa aralık (en az 5 saniye)
            $lastMsgRes = mysql_query("
                SELECT created_at 
                FROM chat_messages 
                WHERE ip = '$ipEsc' OR username = '$nick' 
                ORDER BY id DESC LIMIT 1
            ");
            if ($lastMsgRes && mysql_num_rows($lastMsgRes) > 0) {
                $lastRow = mysql_fetch_assoc($lastMsgRes);
                if (strtotime($lastRow['created_at']) > time() - 3) {
                    header('HTTP/1.1 429 Too Many Requests');
                    die('Mesajlar arasında en az 3 saniye beklemelisiniz.');
                }
            }

            // 2) Saatlik limit (50 mesaj)
            $lastHour = date('Y-m-d H:i:s', time() - 3600);
            $hourCountRes = mysql_query("
                SELECT COUNT(*) AS count 
                FROM chat_messages 
                WHERE (ip = '$ipEsc' OR username = '$nick') 
                AND created_at > '$lastHour'
            ");
            $hourCountRow = mysql_fetch_assoc($hourCountRes);
            if ($hourCountRow['count'] > 100 ) {
                header('HTTP/1.1 429 Too Many Requests');
                die('Saatlik mesaj limitine ulaştınız. Lütfen biraz bekleyin.');
            }

            // 3) Günlük limit (500 mesaj, opsiyonel)
            $lastDay = date('Y-m-d H:i:s', time() - 86400);
            $dayCountRes = mysql_query("
                SELECT COUNT(*) AS count 
                FROM chat_messages 
                WHERE (ip = '$ipEsc' OR username = '$nick') 
                AND created_at > '$lastDay'
            ");
            $dayCountRow = mysql_fetch_assoc($dayCountRes);
            if ($dayCountRow['count'] > 1000) {
                header('HTTP/1.1 429 Too Many Requests');
                die('Günlük mesaj limitine ulaştınız.');
            }

            // Mesaj ve nick doluluk kontrolü
            if (isset($_POST['message']) && trim($_POST['message']) !== '') {
                $message = mysql_real_escape_string(trim($_POST['message']));

                $insertQuery = "INSERT INTO chat_messages (username, message, ip, verified) VALUES ('$nick', '$message', '$ipEsc', '$verified')";
                if (!mysql_query($insertQuery)) {
                    throw new Exception('Mesaj eklenemedi: ' . mysql_error());
                }
                echo 'OK';
            } else {
                throw new Exception('Mesaj boş olamaz.');
            }
            break;

        case 'delete_message':
            // Sadece adminler mesaj gizleyebilir
            if ($kulYetki !== 'admin' && $kulYetki !== 'mod') {
                header('HTTP/1.1 403 Forbidden');
                die('Yetkiniz yok');
            }
            
            if (isset($_POST['message_id']) && is_numeric($_POST['message_id'])) {
                $message_id = (int)$_POST['message_id'];
                $query = "UPDATE chat_messages SET hidden = 1 WHERE id = $message_id";
                if (mysql_query($query)) {
                    // Loglama
                    $logMessage = date('Y-m-d H:i:s') . " - $ip - $kullaniciAdi - $message_id gizlendi";
                    file_put_contents('chat_moderation.log', $logMessage.PHP_EOL, FILE_APPEND);
                    echo 'OK';
                } else {
                    throw new Exception('Mesaj gizlenemedi: ' . mysql_error());
                }
            } else {
                throw new Exception('Geçersiz mesaj ID');
            }
            break;

        case 'restore_message':
            // Sadece adminler mesaj geri getirebilir
            if ($kulYetki !== 'admin' && $kulYetki !== 'mod') {
                header('HTTP/1.1 403 Forbidden');
                die('Yetkiniz yok');
            }
            
            if (isset($_POST['message_id']) && is_numeric($_POST['message_id'])) {
                $message_id = (int)$_POST['message_id'];
                $query = "UPDATE chat_messages SET hidden = 0 WHERE id = $message_id";
                if (mysql_query($query)) {
                    // Loglama
                    $logMessage = date('Y-m-d H:i:s') . " - $ip - $kullaniciAdi - $message_id geri getirildi";
                    file_put_contents('chat_moderation.log', $logMessage.PHP_EOL, FILE_APPEND);
                    echo 'OK';
                } else {
                    throw new Exception('Mesaj geri getirilemedi: ' . mysql_error());
                }
            } else {
                throw new Exception('Geçersiz mesaj ID');
            }
            break;

        default:
            throw new Exception('Geçersiz istek');
    }
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die($e->getMessage());
}
?>