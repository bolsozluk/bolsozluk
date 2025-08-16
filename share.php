
<?
session_start();
ob_start();
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();

extract($_REQUEST); //bunu silebilirim
error_reporting(E_ALL ^ E_NOTICE);
// Get variables
$yuklenecekSayfa = guvenlikKontrol($_REQUEST["process"],"hard");
$yuklenecekSayfaSub = guvenlikKontrol($_REQUEST["islem"],"hard");
$sayfa = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$stat = guvenlikKontrol($_REQUEST["stat"],"hard");
$q = guvenlikKontrol($_REQUEST["q"],"hard"); 
$tid = guvenlikKontrol($_REQUEST["tid"],"hard"); 
$baslik = ereg_replace(" ","+",$q);

if ($tid > 0)
{

//echo " tid:";
//echo $tid; //geliyor
$tid1= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE id=$tid"));
$tbaslik = $tid1["baslik"];
$q=$tbaslik;
$baslik = ereg_replace(" ","+",$q);

//echo " tbaslik:";
//echo $tbaslik;

}


//https://bolsozluk.com/share.php?process=sozluk&q=qw34
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="http://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@bolsozluk">
<meta name="twitter:creator" content="@bolsozluk">
<meta name="twitter:title" content="<?echo $baslik;?>">
<meta name="twitter:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük.">
<meta name="twitter:image" content="https://i.imgur.com/Osi2LRo.png">



<title><?echo"$q";?> - bol sözlük</title>
<link rel="alternate" type="application/rss+xml" title="bol sözlük rss" href="http://www.bolsozluk.com/sitemap.xml"/>
</head>

<?
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );



if($isMobile == 1)
{ 
              header("Location: https://www.bolsozluk.com/sozluk.php?process=word&q=$baslik&sayfa=$sayfa"); 
              die;

}

mysql_close($databaseConnection);
ob_end_flush();
?>


<frameset rows="56,*" cols="*" frameborder="0" border="0" framespacing="0">
  <frame src="https://www.bolsozluk.com/sozluk.php?process=top" name="menu" noresize="noresize" scrolling="no">
  <frameset rows="*" cols="250,*" frameborder="0" border="0" framespacing="0">
    <frame src="https://www.bolsozluk.com/left.php?list=today" name="left" noresize="noresize" scrolling="auto">
    <frame src="https://www.bolsozluk.com/sozluk.php?process=word&q=<? echo"$baslik";?>&sayfa=<? echo"$sayfa";?>" name="main" noresize="noresize">
  </frameset>
  <noframes>
    <body>Lütfen daha yeni bir internet tarayıcı kullanın.</body>
  </noframes>
</frameset>
</html>

