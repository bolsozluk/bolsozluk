<?php
ini_set('date.timezone', 'Europe/Istanbul');

// Session ayarları
ini_set('session.cookie_httponly', 1); // XSS koruması
ini_set('session.cookie_lifetime', 7200);
ini_set('session.gc_maxlifetime', 7200);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); 
ini_set('session.use_trans_sid', 0);

// Cookie ayarları
session_set_cookie_params(
    86400, // 30 gün
    '/',     // path
    '',      // domain (boş = mevcut domain)
    true,   // secure
    true     // httponly
);

session_start();

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
