<?php
session_start();
ob_start();

include("baglan.php");
include("fonksiyonlar.php");

vtBaglan();
kontrolEt();

$id = guvenlikKontrol($_REQUEST["id"], "ultra");
$deger = guvenlikKontrol($_REQUEST["kanal2"], "hard"); // gelen her şey serbest

if (!$id || !$deger) {
    die("gecersiz istek");
}

if (!$kullaniciAdi) {
    echo "tekrar giris yapin..";
    die();
}

/* Başlığı çek */
$sorgu = mysql_query("
    SELECT kanal1, kanal2, kanal3 
    FROM konular 
    WHERE id = '$id'
");

if (mysql_num_rows($sorgu) == 0) {
    die("baslik bulunamadi");
}

$kayit = mysql_fetch_array($sorgu);

/* Slot belirle */
$hedefKanal = '';

if ($kayit['kanal1'] == '' || $kayit['kanal1'] == 'NULL') {
    $hedefKanal = 'kanal1';
}
elseif ($kayit['kanal2'] == '' || $kayit['kanal2'] == 'NULL') {
    $hedefKanal = 'kanal2';
}
elseif ($kayit['kanal3'] == '' || $kayit['kanal3'] == 'NULL') {
    $hedefKanal = 'kanal3';
}
else {
    echo "Bu baslik icin tum kanal slotlari dolu.";
    die();
}

/* Yaz */
mysql_query("
    UPDATE konular 
    SET $hedefKanal = '$deger'
    WHERE id = '$id'
");

echo "$id numarali basliga $hedefKanal slotuna '$deger' yazildi.";

mysql_close($databaseConnection);
ob_end_flush();
?>
