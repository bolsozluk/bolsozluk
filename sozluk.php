<?php
session_start();
ob_start();
error_reporting(E_ALL ^ E_NOTICE);

include "icerik/firstsettings.php";
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";

vtBaglan();
kontrolEt();
addMeOnlines();

// Get variables
$yuklenecekSayfa = guvenlikKontrol($_REQUEST["process"],"hard");
$yuklenecekSayfaSub = guvenlikKontrol($_REQUEST["islem"],"hard");
$sayfa = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$stat = guvenlikKontrol($_REQUEST["stat"],"hard");
$q = guvenlikKontrol($_REQUEST["q"],"hard");


// Eğer ajax istekleri için sadece içerik dönecekse, örneğin chat ajax isteği:
if ($yuklenecekSayfa === 'chat') {
    // Direkt sadece içerik/chat.php dosyasını çağır ve exit yap
    if (file_exists("icerik/chat.php")) {
        include "icerik/chat.php";
        mysql_close($databaseConnection);
        ob_end_flush();
        exit; // buradan sonra sayfa html yapısı gelmez
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "İstenen içerik bulunamadı.";
        exit;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "https://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="https://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<script src="inc/top.js" type="text/javascript"></script>
<script src="inc/sozluk.js" type="text/javascript"></script>
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<?php echo $aktifTema ?>.css" type="text/css" rel="stylesheet">

    <style>
html {
overflow: -moz-scrollbars-vertical; 
overflow: -moz-scrollbars-horizontal; 
overflow: scroll;
}
</style>
    
<?php
if ($yuklenecekSayfa) {
	$authProcess = array("privmsg","cp","add","adm","msjoku","msjana","yenimsj","panel");
	foreach ($authProcess as $yuklenecekSayfaArea) {
		if ($yuklenecekSayfa == $yuklenecekSayfaArea && !$kullaniciAdi) {
			header ("Location: logout.php");
			die();	
		}
	}

	if (file_exists("icerik/$yuklenecekSayfa.php")) {
		include "icerik/$yuklenecekSayfa.php";
	}else if (file_exists("adm/$yuklenecekSayfa.php")) {
		include "adm/$yuklenecekSayfa.php";
	}else{
		echo "<link href=\"inc/$aktifTema.css\" type=text/css rel=stylesheet>Bu bölüm geçici olarak servis dışı.";
	}
}
mysql_close($databaseConnection);
ob_end_flush();
?>
</html>
