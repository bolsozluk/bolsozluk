<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Güvenlik önlemleri - IP Ban Kontrolü
$ip = $_SERVER['REMOTE_ADDR'];
$ipBanQuery = "SELECT COUNT(*) as banned FROM ipban WHERE ip = '" . mysql_real_escape_string($ip) . "'";
$ipBanResult = mysql_query($ipBanQuery);

//$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
//$sehir = $details->city;

if ($ipBanResult && mysql_fetch_assoc($ipBanResult)['banned'] > 0) {
    header('HTTP/1.1 403 Forbidden');
    die('Hata.');
}

//if (strtolower($sehir) === "naaldwijk") {
//    header('HTTP/1.1 403 Forbidden');
//    exit('Hata.');
//}

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
            $result = mysql_query("SELECT * FROM chat_messages WHERE hidden = 0 ORDER BY id DESC LIMIT 30");
            if (!$result) {
                throw new Exception('Sorgu hatası: ' . mysql_error());
            }

            $messages = array();
            while ($row = mysql_fetch_assoc($result)) {
               $mesaj = str_replace("&#039;", "'",$row['message']);
                $messages[] = array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'message' => $mesaj,
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
            
             $result = mysql_query("SELECT * FROM chat_messages WHERE hidden = 1 ORDER BY id DESC LIMIT 10");
            if (!$result) {
                throw new Exception('Sorgu hatası: ' . mysql_error());
            }

            $messages = array();
            while ($row = mysql_fetch_assoc($result)) {

        $mesaj = str_replace("&#039;", "'",$row['message']);

         $messages[] = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'message' => $mesaj,
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

case 'ban_ip_by_message':
    // Sadece adminler IP banlayabilir
    if ($kulYetki !== 'admin') { //&& $kulYetki !== 'mod'
        header('HTTP/1.1 403 Forbidden');
        die('Yetkiniz yok');
    }
    
    if (isset($_POST['message_id']) && is_numeric($_POST['message_id'])) {
        $messageId = (int)$_POST['message_id'];
        
        // Önce mesajı bul ve IP'sini al
        $messageQuery = "SELECT ip FROM chat_messages WHERE id = $messageId";
        $messageResult = mysql_query($messageQuery);
        
        if (!$messageResult || mysql_num_rows($messageResult) === 0) {
            die('Mesaj bulunamadı');
        }
        
        $messageData = mysql_fetch_assoc($messageResult);
        $ipToBan = mysql_real_escape_string($messageData['ip']);
        
        // IP zaten banlı mı kontrol et
        $checkQuery = "SELECT COUNT(*) as banned FROM ipban WHERE ip = '$ipToBan'";
        $checkResult = mysql_query($checkQuery);
        $isBanned = mysql_fetch_assoc($checkResult)['banned'] > 0;
        
        if ($isBanned) {
            die('Bu IP zaten banlı');
        }
        
        // IP'yi banla
        $banQuery = "INSERT INTO ipban (ip) 
                     VALUES ('$ipToBan')";
        
        if (mysql_query($banQuery)) {
            // Loglama
            $logMessage = date('Y-m-d H:i:s') . " - $ip - $kullaniciAdi - $ipToBan banlandı (Mesaj ID: $messageId)";
            file_put_contents('chat_moderation.log', $logMessage.PHP_EOL, FILE_APPEND);
            echo 'OK';
        } else {
            throw new Exception('IP banlanamadı: ' . mysql_error());
        }
    } else {
        throw new Exception('Geçersiz mesaj ID');
    }
    break;


    case 'get_online_count':
    $result = mysql_query("SELECT COUNT(*) as count FROM online");
    if (!$result) {
        throw new Exception('Sorgu hatası: ' . mysql_error());
    }
    $row = mysql_fetch_assoc($result);            
    echo isset($row['count']) ? ((int)$row['count'] + 1) : 1;
    break;

   case 'send_message':
    $nick = mysql_real_escape_string(trim($_POST['nick']));
    $message = $_POST['message'];
    $message = str_replace("'","&#039;",$message);
    $message = mysql_real_escape_string(trim($message));
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

            // 1) Çok kısa aralık
            $lastMsgRes = mysql_query("
                SELECT created_at 
                FROM chat_messages 
                WHERE ip = '$ipEsc' OR username = '$nick' 
                ORDER BY id DESC LIMIT 1
            ");
            if ($lastMsgRes && mysql_num_rows($lastMsgRes) > 0) {
                $lastRow = mysql_fetch_assoc($lastMsgRes);
              if ($verified==1)
              {
                if (strtotime($lastRow['created_at']) > time() - 3) {
                    header('HTTP/1.1 429 Too Many Requests');
                    die('Mesajlar arasında en az 3 saniye beklemelisiniz.');
                }
              }

              if ($verified==0)
              {
                if (strtotime($lastRow['created_at']) > time() - 10) {
                    header('HTTP/1.1 429 Too Many Requests');
                    die('Mesajlar arasında en az 10 saniye beklemelisiniz.');
                }
              }
            }

            // 2) Saatlik limit 
            $lastHour = date('Y-m-d H:i:s', time() - 3600);
            $hourCountRes = mysql_query("
                SELECT COUNT(*) AS count 
                FROM chat_messages 
                WHERE (ip = '$ipEsc' OR username = '$nick') 
                AND created_at > '$lastHour'
            ");
            $hourCountRow = mysql_fetch_assoc($hourCountRes);
            if ($verified==1)
            {
            if ($hourCountRow['count'] > 200 ) {
                header('HTTP/1.1 429 Too Many Requests');
                die('Saatlik mesaj limitine ulaştınız. Lütfen biraz bekleyin.');
                }
            }
            if ($verified==0)
            {
            if ($hourCountRow['count'] > 7 ) {
                header('HTTP/1.1 429 Too Many Requests');
                die('Saatlik mesaj limitine ulaştınız. Lütfen biraz bekleyin.');
                }
            }

            // 3) Günlük limit 
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

                   if (preg_match('/(?<![a-zA-Z0-9])([1-9][0-9]{9}[02468])(?![a-zA-Z0-9])/', $message)) {
                   $message = 'cartel 1 numara en büyük';
                   } else {
                   $message = $message;
                   }
                
                $message = mysql_real_escape_string($message); 

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
