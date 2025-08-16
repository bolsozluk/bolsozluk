<?php
ini_set('date.timezone', 'Europe/Istanbul');
ini_set('session.cookie_httponly', 1); // XSS koruması
ini_set('session.use_only_cookies', 1); // Session fixation koruması

// Mevcut session ayarları
session_set_cookie_params(
    86400,  // 1 gün
    '/',    // path
    '',     // domain (boş bırakılarak mevcut domain kullanılır)
    false,  // secure
    true    // httponly
);

session_start();


/*
// Session hijacking koruması
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
} else if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || 
           $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
    session_destroy();
    header("Location: logout.php");
    exit;
}

// Her 30 dakikada bir session ID'yi yenile
if (isset($_SESSION['created']) && (time() - $_SESSION['created'] > 1800)) {
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}
*/

// Mevcut değişkenler aynen kalsın
$maxTopicPage = 50;
$fDay = 26;
$fYea = 2014;
$fMon = 7;

$yuklenecekSayfa = "";
$yuklenecekSayfaSub = "";
$aktifTema = "";
$kullaniciAdi = "";
$kulYetki = "";
$verifyStatus = "";
$verifyFloor = "";
$currentUserIP = "";
$sayfa = "";
?>