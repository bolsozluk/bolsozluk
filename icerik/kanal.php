<?php
// Hata göster
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Güvenli ID ve değer al
$id = isset($_REQUEST["id"]) ? guvenlikKontrol($_REQUEST["id"], "ultra") : '';
$deger = isset($_REQUEST["kanal2"]) ? mysql_real_escape_string($_REQUEST["kanal2"]) : '';

// Not: $kullaniciAdi değişkeninin bu dosyanın üst kısımlarında veya 
// include edilen dosyalarda tanımlanmış olduğunu varsayıyoruz.
$guncelKullanici = mysql_real_escape_string($kullaniciAdi);

if (!$id || $deger == '') {
    die("gecersiz istek: id veya kanal2 yok");
}

$allowed = array(
    "#mc", "#album", "#yabancirap", "#graffiti", "#turntablism", 
    "#produktor", "#polemik", "#magazin", "#lyrics", "#konser", 
    "#kultur", "reset", "kanal1sil", "kanal2sil", "kanal3sil"
);

if (!in_array($deger, $allowed, true)) {
    die("geçersiz istekler istiyorsunuz.");
}

// --------------------
// KANAL SİLME (ADMIN / MOD)
// --------------------
if ($kulYetki == "admin" || $kulYetki == "mod") {
    $silme = false; 
    if (isset($_GET['kanal2'])) {
        if ($_GET['kanal2'] == 'kanal1sil') {
            mysql_query("UPDATE konular SET kanal1='', kanalci1='' WHERE id='$id'");
            echo "$id numarali basligin kanal1 ve kanalci1 slotu silindi.";
            $silme = true;
        }
        if ($_GET['kanal2'] == 'kanal2sil') {
            mysql_query("UPDATE konular SET kanal2='', kanalci2='' WHERE id='$id'");
            echo "$id numarali basligin kanal2 ve kanalci2 slotu silindi.";
            $silme = true;
        }
        if ($_GET['kanal2'] == 'kanal3sil') {
            mysql_query("UPDATE konular SET kanal3='', kanalci3='' WHERE id='$id'");
            echo "$id numarali basligin kanal3 ve kanalci3 slotu silindi.";
            $silme = true;
        }
        if ($_GET['kanal2'] == 'reset') {
            mysql_query("UPDATE konular SET kanal1='', kanalci1='', kanal2='', kanalci2='', kanal3='', kanalci3='' WHERE id='$id'");
            echo "$id numarali basligin tüm kanal ve kanalci bilgileri silindi.";
            $silme = true;
        }

        if ($silme) {
            echo '<script type="text/javascript">setTimeout(function () { window.history.go(-2); }, 500);</script>';
            exit;
        }
    }
}

/* Sorgu kontrolü */
$sorgu = mysql_query("SELECT kanal1, kanal2, kanal3 FROM konular WHERE id='$id'");
if (!$sorgu) {
    die("SQL hatasi: ".mysql_error());
}

$kayit = mysql_fetch_array($sorgu);

// Değer kontrolü
if ($kayit['kanal1'] === $deger || $kayit['kanal2'] === $deger || $kayit['kanal3'] === $deger) {
    die("Bu değer zaten bir slotta mevcut, tekrar eklenemez.");
}

/* Slot ve Kullanıcı Sütun Mantığı */
$hedefKanal = '';
$hedefKanalci = '';

if ($kayit['kanal1'] == '' || $kayit['kanal1'] == 'NULL') {
    $hedefKanal = 'kanal1';
    $hedefKanalci = 'kanalci1';
}
elseif ($kayit['kanal2'] == '' || $kayit['kanal2'] == 'NULL') {
    $hedefKanal = 'kanal2';
    $hedefKanalci = 'kanalci2';
}
elseif ($kayit['kanal3'] == '' || $kayit['kanal3'] == 'NULL') {
    $hedefKanal = 'kanal3';
    $hedefKanalci = 'kanalci3';
}
else {
    die("Bu baslik icin tum kanal slotlari dolu.");
}

/* Her iki sütunu da güncelle */
$updateQuery = "UPDATE konular SET $hedefKanal='$deger', $hedefKanalci='$guncelKullanici' WHERE id='$id'";

if (!mysql_query($updateQuery)) {
    die("SQL update hatasi: ".mysql_error());
}

echo "$id numarali basliga $hedefKanal slotuna '$deger' ve $hedefKanalci slotuna '$guncelKullanici' yazildi.";

?>
<script language="JavaScript" type="text/javascript">
    setTimeout("window.history.go(-1)", 500);
</script>
