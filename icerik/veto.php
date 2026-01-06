<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="http://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>
</head>
<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>

<?php

$ip    = getenv('REMOTE_ADDR');
$gun   = date("d");
$tarih = date("YmdHi");
$fake  = 0;

if ($testx != 'on') {
    die;
}

/* Veto kaydını çek */
$vetosor = mysql_query("SELECT * FROM veto WHERE baslik='$q'");
$vetoc   = mysql_fetch_array($vetosor);

$veto1     = $vetoc['veto1'];
$veto2     = $vetoc['veto2'];
$veto3     = $vetoc['veto3'];
$veto1kim  = $vetoc['veto1kim'];
$veto2kim  = $vetoc['veto2kim'];
$veto3kim  = $vetoc['veto3kim'];
$baslik    = $vetoc['baslik'];
$vetogun   = $vetoc['gun'];

/* Gün değiştiyse reset */
if ($vetogun != $gun && $baslik != '') {
    mysql_query("UPDATE veto SET 
        veto1='', veto2='', veto3='', 
        veto1kim='', veto2kim='', veto3kim='',
        gun='$gun'
        WHERE baslik='$q'
    ");

    $veto1 = $veto2 = $veto3 = '';
}

/* Kayıt yoksa oluştur */
if ($baslik == '') {
    mysql_query("INSERT INTO veto (baslik, gun) VALUES ('$q', '$gun')");
}

/* Aynı IP veya kullanıcı tekrar veto veremez */
if (
    $veto1 == $ip || $veto2 == $ip || $veto3 == $ip ||
    $veto1kim == $kullaniciAdi || $veto2kim == $kullaniciAdi || $veto3kim == $kullaniciAdi
) {
    echo "<br>$q başlığı bir kenara yazıldı...";
    die;
}

/* Hangi veto slotu boşsa onu doldur */
if ($veto1 == '' || $veto1 == 'NULL') {

    mysql_query("UPDATE veto SET 
        veto1='$ip',
        veto1kim='$kullaniciAdi'
        WHERE baslik='$q'
    ");

}
elseif ($veto2 == '' || $veto2 == 'NULL') {

    mysql_query("UPDATE veto SET 
        veto2='$ip',
        veto2kim='$kullaniciAdi'
        WHERE baslik='$q'
    ");

}
elseif ($veto3 == '' || $veto3 == 'NULL') {

    mysql_query("UPDATE veto SET 
        veto3='$ip',
        veto3kim='$kullaniciAdi'
        WHERE baslik='$q'
    ");

    /* 3 veto tamamlandı → başlığı düşür */
    mysql_query("UPDATE konular SET yil='2013' WHERE baslik='$q'");

    echo "<br>$q başlığı bir kenara yazıldı.<br>";
    echo "<br>algoritma yürütüldü, $q başlığı sol frameden düşürüldü.";
    die;
}

echo "<br>$q başlığı bir kenara yazıldı.";
die;
