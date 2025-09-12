<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start();

// Basit session güvenlik iyileştirmeleri
if (!isset($_SESSION['kullaniciAdi_S'])) {
    // session boşsa sonlandır
    echo "Oturum yok. Lütfen giriş yapın.";
    exit;
}
session_regenerate_id(true);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // eğer HTTPS kullanıyorsanız açın

include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";

if (function_exists('vtBaglan')) {
    vtBaglan();
}
if (function_exists('kontrolEt')) {
    kontrolEt();
}

// Oturumdan al
$kullaniciAdi = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : '';
$kulYetki = isset($_SESSION['kulYetki_S']) ? $_SESSION['kulYetki_S'] : '';

if ($kullaniciAdi === '') {
    // Hatalı oturum durumu
    fonksiyonlartest();
    baglantest();
    echo "Lütfen farklı bir tarayıcı deneyiniz veya yeniden giriş yapın.";
    exit;
}

// Güvenlik: URL parametreleriyle yetki değiştirilmesini önleme
if (isset($_REQUEST['kulYetki']) || isset($_REQUEST['kullaniciAdi'])) {
    header("Location: logout.php");
    exit;
}

// Güvenli sorgulama için mysql_real_escape_string (mysql bağlantısı kurulduktan sonra çalışmalı)
if (function_exists('mysql_real_escape_string')) {
    $safeKullanici = mysql_real_escape_string($kullaniciAdi);
} else {
    // mysql_* yoksa en azından temel temizleme
    $safeKullanici = preg_replace('/[^A-Za-z0-9_\-]/', '_', $kullaniciAdi);
}

// Kullanıcının tema bilgisini alma (hata kontrolü ile)
$tema = 'sozluk';
$query_user = "SELECT * FROM user WHERE `nick` = '$safeKullanici' LIMIT 1";
$res_user = mysql_query($query_user);
if ($res_user && mysql_num_rows($res_user) > 0) {
    $kayit2 = mysql_fetch_assoc($res_user);
    if (!empty($kayit2['tema'])) {
        $tema = $kayit2['tema'];
    }
}

// Dosya adı güvenliği: sadece izin verilen karakterlere izin ver
$safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $kullaniciAdi);
$filename = $safeName . "_gelen_mesaj_yedek.doc";

// Word için header (UTF-8)
header("Content-Type: application/msword; charset=utf-8");
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo "<!DOCTYPE html><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
echo "<p>gelen mesaj yedekleri:<br></p>";
echo "<table border='1'>";

// Hedef kullanıcı: eğer ?kim parametresi varsa ve istek yapan kişi yetkili değilse reddet
$target = $kullaniciAdi;
if (isset($_GET['kim']) && $_GET['kim'] !== '') {
    // sanitize input
    if (function_exists('mysql_real_escape_string')) {
        $requested = mysql_real_escape_string($_GET['kim']);
    } else {
        $requested = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_GET['kim']);
    }

    // Eğer hedef farklı ise yalnızca admin yetkisiyle izin ver
    $isAdmin = ($kulYetki === 'admin' || $kulYetki === 'yönetici' || $kulYetki === 'super'); // örnek kontroller, projeye göre düzenle
    if ($requested !== $kullaniciAdi && !$isAdmin) {
        echo "</table>";
        echo "<p>Yetkisiz erişim.</p>";
        echo "</body></html>";
        ob_end_flush();
        exit;
    }
    $target = $requested;
}

// Güvenli SQL (mysql_* kullanıldığı için en azından kaçış uygulandı)
$sorgu = "SELECT id, gonderen, mesaj FROM privmsg WHERE `kime` = '$target' ORDER BY id ASC";
$sorgulama = mysql_query($sorgu);

$say = 0;
if ($sorgulama === false) {
    // Hata durumunda güvenli bir mesaj yaz
    echo "<tr><td>Mesajlar alınırken hata oluştu.</td></tr>";
} else {
    if (mysql_num_rows($sorgulama) > 0) {
        while ($kayit = mysql_fetch_assoc($sorgulama)) {
            $say++;
            // XSS koruması: ekrana basmadan önce htmlspecialchars
            $gonderen = isset($kayit['gonderen']) ? htmlspecialchars($kayit['gonderen'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';
            $mesaj = isset($kayit['mesaj']) ? htmlspecialchars($kayit['mesaj'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';

            echo "<tr><td>{$say} :<br>kimden:<b>{$gonderen}</b> <br><br>mesaj:<b><br><small>{$mesaj}</small></b><br><br></td></tr>";
        }
    } else {
        echo "<tr><td>Gösterilecek mesaj yok.</td></tr>";
    }
}

echo "</table>";
echo "</body></html>";

ob_end_flush();
exit;
?>
