<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('session.cookie_httponly', 1);
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', 1);
}


// Oturumdan al
$kullaniciAdi = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : '';
$kulYetki = isset($_SESSION['kulYetki_S']) ? $_SESSION['kulYetki_S'] : '';

if ($kullaniciAdi === '') {
    fonksiyonlartest();
    baglantest();
    echo "Lütfen farklı bir tarayıcı deneyiniz veya yeniden giriş yapın.";
    exit;
}

// URL parametreleriyle yetki değiştirme engeli
if (isset($_REQUEST['kulYetki']) || isset($_REQUEST['kullaniciAdi'])) {
    header("Location: logout.php");
    exit;
}

// Güvenli kullanıcı adı
if (function_exists('mysql_real_escape_string')) {
    $safeKullanici = mysql_real_escape_string($kullaniciAdi);
} else {
    $safeKullanici = preg_replace('/[^A-Za-z0-9_\-]/', '_', $kullaniciAdi);
}

// Kullanıcının tema bilgisi
$tema = 'sozluk';
$query_user = "SELECT * FROM user WHERE `nick` = '$safeKullanici' LIMIT 1";
$res_user = mysql_query($query_user);
if ($res_user && mysql_num_rows($res_user) > 0) {
    $kayit2 = mysql_fetch_assoc($res_user);
    if (!empty($kayit2['tema'])) {
        $tema = $kayit2['tema'];
    }
}

// GET parametresi: gelen veya gönderilen mesaj
$tip = isset($_GET['tip']) ? $_GET['tip'] : 'gelen';
$tip = ($tip === 'giden') ? 'giden' : 'gelen';

// Dosya adı güvenliği
$safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $kullaniciAdi);
$safeName = substr($safeName, 0, 100);
$filename = $safeName . "_" . $tip . "_mesaj_yedek.doc";

// Word header
header("Content-Type: application/msword; charset=utf-8");
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo "<!DOCTYPE html><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
echo "<p>$tip mesaj yedekleri:<br></p>";
echo "<table border='1'>";


if ($tip === 'giden') {
    // Gönderilen mesajlar
    $sorgu = "SELECT id, kime, mesaj FROM privmsg WHERE `gonderen` = '$safeKullanici' ORDER BY id ASC";
} else {
    // Alınan mesajlar
    $target = $kullaniciAdi;
    if (isset($_GET['kim']) && $_GET['kim'] !== '') {
        if (function_exists('mysql_real_escape_string')) {
            $requested = mysql_real_escape_string($_GET['kim']);
        } else {
            $requested = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_GET['kim']);
        }
        $isAdmin = ($kulYetki === 'admin' || $kulYetki === 'yönetici' || $kulYetki === 'super');
        if ($requested !== $kullaniciAdi && !$isAdmin) {
            echo "</table>";
            echo "<p>Yetkisiz erişim.</p>";
            echo "</body></html>";
            if (ob_get_level()) ob_end_flush();
            exit;
        }
        $target = $requested;
    }
    $sorgu = "SELECT id, gonderen, mesaj FROM privmsg WHERE `kime` = '$target' ORDER BY id ASC";
}

// Mesajları yazdır
$sorgulama = mysql_query($sorgu);
$say = 0;

if ($sorgulama === false) {
    echo "<tr><td>Mesajlar alınırken hata oluştu.</td></tr>";
} else {
    if (mysql_num_rows($sorgulama) > 0) {
        while ($kayit = mysql_fetch_assoc($sorgulama)) {
            $say++;
            $mesaj = isset($kayit['mesaj']) ? htmlspecialchars($kayit['mesaj'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';
            if ($tip === 'giden') {
                $kime = isset($kayit['kime']) ? htmlspecialchars($kayit['kime'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';
                echo "<tr><td>{$say} :<br>kime:<b>{$kime}</b> <br><br>mesaj:<b><br><small>{$mesaj}</small></b><br><br></td></tr>";
            } else {
                $gonderen = isset($kayit['gonderen']) ? htmlspecialchars($kayit['gonderen'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';
                echo "<tr><td>{$say} :<br>kimden:<b>{$gonderen}</b> <br><br>mesaj:<b><br><small>{$mesaj}</small></b><br><br></td></tr>";
            }
        }
    } else {
        echo "<tr><td>Gösterilecek mesaj yok.</td></tr>";
    }
}

echo "</table>";
echo "</body></html>";

if (ob_get_level()) ob_end_flush();
exit;
?>
