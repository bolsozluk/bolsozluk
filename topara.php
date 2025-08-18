

<?

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
?>
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="inc/top.js" type="text/javascript"></script>
<script src="inc/sozluk.js" type="text/javascript"></script>
<link href="https://www.bolsozluk.com/inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="https://www.bolsozluk.com/inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="inc/top.js" type="text/javascript"></script>
<script src="inc/sozluk.js" type="text/javascript"></script>
<link href="favicon.ico" rel="shortcut Icon">
<link href="favicon.ico" rel="icon">
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">
</head>
<body>
	    <style>
html {
html, body {margin: 0; height: 100%; overflow: hidden}
}
</style>
<center><td style="height:10px;white-space:nowrap;padding:1px;font-size:x-small"><u>b</u>a$lik <input maxLength=55 onKeyPress="return submitenter(this,event)" class="input" style="height:12px" accesskey="b" id="q" name="q" size="30" onkeyup="javascript:ara2()" placeholder="aramaya inanın"/></td><br></center><br>
</body>
</html>
