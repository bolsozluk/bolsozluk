<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<?
session_start();
ob_start();

//extract($_REQUEST); //bunu silebilirim
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE);

include "icerik/firstsettings.php";
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();
addMeOnlines();

$aktifTema = $_SESSION['aktifTema_S']; if(!$_SESSION['aktifTema_S']){$aktifTema="default";}
$currentPage = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$list = guvenlikKontrol($_REQUEST["list"],"hard");

$araGun = $_REQUEST['gun'];
$araAy = $_REQUEST['ay'];
$araYil = $_REQUEST['yil'];



if($list != "today" | "yesterday" | "lastmonth" | "oneday" );
if(!$currentPage) $currentPage=1;

$limitFrom = ($currentPage - 1) * $maxTopicPage;
?>

<? if($list=="today") { ?> <meta http-equiv="refresh" content="120;URL=left.php?list=today"><? } ?> 
<script src="inc/top.js" type="text/javascript"></script>
<script src="inc/sozluk.js" type="text/javascript"></script>
<link href="favicon.ico" rel="shortcut Icon">
<link href="favicon.ico" rel="icon">
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">


<style>
.butx {
        border-right: #a6b4d4 1px outset; border-TOP: #a6b4d4 1px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 1px outset; display: inline-block; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}

.responsive {
  width: 100%;
  height: auto;
}

input {
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
    padding: 4px;
    display: inline-block;
}



</style>


</head>
<body class="bodyLeftFrame">
<div style="width: 100%">

<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}

</script>

    <script type="text/javascript"> 
   //     function araFocus() { 
   //         document.getElementById("getir").focus(); 
        } 
    </script> 


<?
//			echo "$kullaniciAdi";

if ($kullaniciAdi=='admin') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );



//echo $aktifTema;

 $aramobile = "<center> <b> </b>başlık <input maxLength=55 class=\"input\" style=\"height:12px\" onkeyup=\"araFocus()\" accesskey=\"b\" id=\"q\" name=\"q\" size=\"25\"  placeholder=\"aramaya inanın\"> <input type='button' onClick=\"javascript:mobgetir();\" value='getir' id='getir' class='butx'> <input type='button' onClick=\"javascript:mobara();\" value='ara' class='butx'></center>  <br>";                

if($isMobile == 0)
{ 

?>
<style>
A {
    font-size: 1.1em;
    line-height: 13pt;
}
</style>
<?

}

if($isMobile == 1)
{ 

			getPrivateMessages();
			if ($kullaniciAdi)
			{
					if ($notice)
		echo "<SCRIPT>alert('$notice okunmayan mesajınız var.');</SCRIPT>";
			}

			?>
<style>

ulx {
    line-height: 16pt;
}


lix {
    font-size: 1.14em;
}

A {
    font-size: 1.14em;
    line-height: 14pt;
}
</style>




<center>
<a id="gundem" href="left.php?list=today" target="_top" title=sol&nbsp;frame> <img src=inc/turuncu.png width=150 border=1></a></center><br><br>
 <?

	//echo "<center><td style=\"white-space:nowrap;\" onClick=\"location.href='/sozluk.php?process=staff'\" class=\"logo\"><img id=\"logopic\" alt=\"bol sözlük\" src=\"img/1.gif\" width=\"197\" height=\"56\" /></center>";
 
 echo $aramobile;

//if($isMobile == 0) echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'>  </center> ";



 if(($isMobile == 1) && ($kullaniciAdi == "") && ($list != ""))
{


?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>

<?



}


/*
 if($isMobile == 1) //and $kullaniciAdi == ""
{ 
?>
<div style="max-width: 728px;">
  <iframe src="https://www.bolsozluk.com/nezaman.html" width="100%" height="90" frameborder="0" scrolling="no"></iframe>
</div>
<?
}
*/
echo "<br>";

	$ekmobile = "<input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'> <br><br>";

if ($kullaniciAdi)
{
 echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='left.php?list=kenar';\" value='kenar' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=entrylerim&kimdirbu=$kullaniciAdi';\" value='ben' class='butx'> <input type='button' onclick=\"location.href='logout.php';\" value='çık' class='butx'></center>"  ; 
}
else
{
echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=master&login=onair';\" value='giriş yap' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=word&q=gururlarımız';\" value='⭐gururlarımız⭐' class='butx'> </center> "; 
}

}

if($isMobile == 1)
{ 
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53237593-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>
<?
}

$dDay =  date("d") - 1;
$eDay =  date("d") - 2;
$fDay =  date("d") - 3;
$cMon = date("m");

if ($dDay==0)
{
$dMon=$cMon-1;
switch ($dMon) {
				case 1:	case 3:	case 5:	case 7:	case 8:	case 10: case 12: $dDay = 31; $eDay = 30; $fDay = 29; break;
				case 2:	$dDay = 28; $eDay = 27; $fDay = 26; break;
				case 4:	case 6:	case 9:	case 11: $dDay = 30; $eDay = 29; $fDay = 28; break;
			}
}

if ($eDay==0)
{
$dMon=$cMon-1;
switch ($dMon) {
				case 1:	case 3:	case 5:	case 7:	case 8:	case 10: case 12: $dDay = 1; $eDay = 31; $fDay = 30; break;
				case 2:	$dDay = 1; $eDay = 28; $fDay = 27; break;
				case 4:	case 6:	case 9:	case 11: $dDay = 1; $eDay = 30; $fDay = 29; break;
			}
}

if ($fDay==0)
{
$dMon=$cMon-1;
switch ($dMon) {
				case 1:	case 3:	case 5:	case 7:	case 8:	case 10: case 12: $dDay = 2; $eDay = 1; $fDay = 31; break;
				case 2:	$dDay = 2; $eDay = 1; $fDay = 28; break;
				case 4:	case 6:	case 9:	case 11: $dDay = 2; $eDay = 1; $fDay = 30; break;
			}
}

switch($list) {


//DDAY I SİL

case "kenar":

					if($isMobile == 1)
{ 
$ekmobile = "<input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'> <br><br>";

echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> $ekmobile </center>  ";
}

		echo "<div class='pagi'>kenardaki entryler:</div>";
		echo "<hr>";
		echo '<ul id="listLeftFrame">';

$takip=mysql_query("select * from mesajlar where statu='kenar' and yazar='$kullaniciAdi'");
while ($takip2=mysql_fetch_array($takip)){
	++$sayiechox;
	$entryid=$takip2['id'];
	$baslikid=$takip2['sira'];

	$baslikx=mysql_query("select baslik from konular where id = '$baslikid'");
	$baslik2=mysql_fetch_array($baslikx);
	$baslik=$baslik2['baslik'];
	$link = str_replace(" ","+",$baslik);

 	
if($isMobile == 1) echo "$sayiechox. <a href='sozluk.php?process=eid&eid=$entryid' target='main'>$baslik - #$entryid </a><br>";
if($isMobile == 0) echo "$sayiechox. <a href='sozluk.php?process=eid&eid=$entryid' target='top'>$baslik - #$entryid </a><br>";

}
 echo "</ul>";

echo "<hr>";
echo "<div class='pagi'>favori entryler:</div>";
echo "<hr>";
		echo '<ul id="listLeftFrame">';

$ylistele1 = mysql_query("SELECT nick FROM oylar WHERE nick='$kullaniciAdi' AND oy='1' ORDER BY id DESC LIMIT 0,255");

while($row = mysql_fetch_array($ylistele1)){
++$sayi;
++$sayiecho;
$sayix = ($sayi-1);
$ybase1 = $row["nick"];
$xlistele1 = mysql_fetch_array(mysql_query("SELECT entry_id FROM oylar WHERE nick='$kullaniciAdi' AND oy='1' ORDER BY id DESC LIMIT $sayix,1"));
$xbase1 = $xlistele1["entry_id"];
$xlistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$xbase1'"));
$xbase11 = $xlistele11["sira"];
$xsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$xbase11'"));
$xsonbaslik1 = $xsonbaslik11["baslik"];
$gds = $xsonbaslik11["gds"];
$xsonbaslik2 = ereg_replace(" ","+",$xsonbaslik1);

if($isMobile == 1)   echo "$sayiecho. <a href=sozluk.php?process=word&q=$xsonbaslik2 target=blank>$xsonbaslik1</a> - <a href=sozluk.php?process=eid&eid=$xbase1 target=main>#$xbase1</a><br>"; //
if($isMobile == 0)   echo "$sayiecho. <a href=sozluk.php?process=word&q=$xsonbaslik2 target=blank>$xsonbaslik1</a> - <a href=sozluk.php?process=eid&eid=$xbase1 target=top>#$xbase1</a><br>"; //
}
 echo "</ul>";

 break;



///RAST GETİR

	case "mix":
	if ($isMobile == 1)
{
	echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";
echo "";
}


		$totalEntry = mysql_query("SELECT id FROM konular WHERE statu=''");
		$totalEntryNum = mysql_num_rows($totalEntry);
		echo "<div class='pagi'>tombala sonuçları</div>";
		echo "<hr>";
		echo '<ul id="listLeftFrame">';
		for ($i=1;$i<=40;++$i) {
			$sayi = rand(1, $totalEntryNum);
			if (!$sayi) echo "var bisiler var";
		
			$getmesajlar1 = mysql_query("SELECT baslik FROM konular WHERE id=$sayi AND statu=''");
			$getmesajlar2 = mysql_fetch_array($getmesajlar1);
			$topic = $getmesajlar2["baslik"];
			$link  = ereg_replace(" ","+",$topic);
		
//		    $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
//    $replacement = '$1 ($2)';
//    $topic = preg_replace($pattern, $replacement, $topic);


			if (!$topic) {
				$i--;
			}else{
				if ($isMobile == 0) echo "<font size=2><li>· <a href='/".$link."-1.html' target='main' title='".$topic."'>".$topic."</a></font>"; 
				if ($isMobile == 1) echo "<font size=2><li>· <a href='/".$link."-1.html' target='_top' title='".$topic."'>".$topic."</a></font>"; 
			//echo "<li>. <a href='/b/".$link."/' target='self' title='".$topic."'>".$topic."</a>"; //title da başlık istastistikleri verilebilir
			}   
		}
		echo '</ul>';
		echo "<div class='pagi'>tombala sonuçları</div>";
		echo "<hr>";
		mysql_close($databaseConnection);
		ob_end_flush();
		die();

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";

	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	
}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}


//$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");

			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else

//				    $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
//    $replacement = '$1 ($2)';
//    $currenTopic['baslik'] = preg_replace($pattern, $replacement, $currenTopic['baslik']);


		
			if ($isMobile == 0) echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
			if ($isMobile == 1) echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='_top' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;

//GÜNDEM

	case "today":
		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "gündem";
		$gds = "g";

				//KAR YAĞDIR
/* 
		?>
 <script src="snow-background.js"></script>


		<?
*/
		

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> $ekmobile </center>  ";
	}

//100.YIL
// <img src="/img/100.png" alt="nice yüzyıllara!" class="responsive">


	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 
 $sqlSyntax31 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik != 'çaylaklıktan reddedilenler' AND baslik != 'aramıza yeni katılanlar') ORDER BY say DESC LIMIT 0,1";	
 $sqlSyntax32 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik != 'çaylaklıktan reddedilenler' AND baslik != 'aramıza yeni katılanlar') ORDER BY say DESC LIMIT 1,2";	
 $sqlSyntax33 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik != 'çaylaklıktan reddedilenler' AND baslik != 'aramıza yeni katılanlar') ORDER BY say DESC LIMIT 2,3";	
$getkonular31 = mysql_query($sqlSyntax31);
$getkonular32 = mysql_query($sqlSyntax32);
$getkonular33 = mysql_query($sqlSyntax33);
$row31 = mysql_fetch_array($getkonular31);
$row32 = mysql_fetch_array($getkonular32);
$row33 = mysql_fetch_array($getkonular33);
$baslik31=$row31['baslik'];
$baslik32=$row32['baslik'];
$baslik33=$row33['baslik'];
 $sqlSyntax3 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik != 'çaylaklıktan reddedilenler' AND baslik != 'aramıza yeni katılanlar') ORDER BY say DESC LIMIT 3";	

//gündem filtresi buraya eklenecek - mertd


$getkonular3 = mysql_query($sqlSyntax3);

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik !='$baslik31' AND baslik !='$baslik32' AND baslik !='$baslik33') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{




/*$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	*/

$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik !='$baslik31' AND baslik !='$baslik32' AND baslik !='$baslik33') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	


			}
/*$sqlSyntax3 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' GROUP BY sira ORDER BY COUNT(sira) DESC LIMIT 5";	*/


$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);

echo "<hr>";

//if($isMobile == 1) echo "<li>· <a href='her+sey+cok+guzel+olacak-1.html' title='".'her şey çok güzel olacak'."'>".'her şey çok güzel olacak'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='her+sey+cok+guzel+olacak-1.html' target='main' title='".'her şey çok güzel olacak'."'>".'her şey çok güzel olacak'."</a> (<font color='red'>!</font>)"; 



//alc//

//echo "<li>· <a href='ocak+2021+en+iyiler+anketi-1.html' target='main' title='".'ocak 2021 en iyiler anketi'."'>".'ocak 2021 en iyiler anketi'."</a> (<font color='red'>!</font>)"; 
// echo "<hr>";
//alc// N

//alc//
//echo "<li>· <font size=1><a href='sozluk.php?process=eid&eid=418884' target='main' title='".'ağustos 2023 güncellemeleri'."'>".'ağustos 2023 güncellemeleri'."</a></font> (<font color='red'>!</font>)"; 
//echo "<hr>";
//alc//

//alc//
//echo "<li>· <a href='bogazici+direnisi-4.html' target='main' title='".'boğaziçi direnişi'."'>".'boğaziçi direnişi'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//alc//

//VOL 8 haz//
//echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+sekizinci+alb%C3%BCm-4.html' target='main' title='".'sözlük yazarlarının emeğiyle yapılacak sekizinci albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak sekizinci albüm'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//VOL 8 haz//

//VOL 9 haz//
//echo "<li>· <a href='6+şubat+2023+maraş+depremi-1.html' target='main' title='".'6 şubat 2023 maraş depremi'."'>".'6 şubat 2023 maraş depremi '."</a> (<font color='red'>!</font>)"; 
//echo "<li>· <a href='21+şubat+2023+ekşi+sözlüğe+erişimin+engellenmesi-1.html' target='main' title='".'21 şubat 2023 ekşi sözlüğe erişimin engellenmesi'."'>".'21 şubat 2023 ekşi sözlüğe erişimin engellenmesi '."</a> (<font color='red'>!</font>)"; 
//echo "<li>· <a href='s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+dokuzuncu+alb%C3%BCm-1.html' target='main' title='".'bol sözlük compilation vol 9 duyurusu'."'>".'bol sözlük compilation vol 9 duyurusu'."</a> (<font color='red'>!</font>)"; 
//echo "<li>· <a href='2022+en+iyiler+listesi-1.html' target='main' title='".'2022 en iyiler listesi'."'>".'2022 en iyiler listesi'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//VOL 0 haz//

//VOL 10 haz//
//if($isMobile == 1) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+onuncu+alb%C3%BCm-1.html' title='".'sözlük yazarlarının emeğiyle yapılacak onuncu albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak onuncu albüm'."</a> (<font color='red'>son gün: 14 temmuz</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+onuncu+alb%C3%BCm-1.html' target='main' title='".'sözlük yazarlarının emeğiyle yapılacak onuncu albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak onuncu albüm'."</a> (<font color='red'>son gün: 14 temmuz</font>)"; 
//echo "<hr>";
//VOL 10 haz//

//VOL 10 haz//
if($isMobile == 1) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+on+birinci+alb%C3%BCm-1.html' title='".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."</a> (<font color='red'>son gün: 19 eylül</font>)"; 
if($isMobile == 0) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+on+birinci+alb%C3%BCm-1.html' target='main' title='".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."</a> (<font color='red'>son gün: 19 eylül</font>)"; 
//echo "<hr>";
//VOL 10 haz//


//if($isMobile == 1) echo "<li>· <a href='pray+for+turkiye-1.html' title='".'pray for turkiye'."'>".'pray for turkiye'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='pray+for+turkiye-1.html' target='main' title='".'pray for turkiye'."'>".'pray for turkiye'."</a> (<font color='red'>!</font>)"; 


//if($isMobile == 1) echo "<li>· <a href='pray+for+turkiye-1.html' title='".'pray for turkiye'."'>".'pray for turkiye'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='pray+for+turkiye-1.html' target='main' title='".'pray for turkiye'."'>".'pray for turkiye'."</a> (<font color='red'>!</font>)"; 


//VOL 10 //
//if($isMobile == 1) echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+10-1.html' title='".'bol sözlük compilation vol 10'."'>".'bol sözlük compilation vol 10'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+10-1.html' target='main' title='".'bol sözlük compilation vol 10'."'>".'bol sözlük compilation vol 10'."</a> (<font color='red'>!</font>)"; 

//if($isMobile == 1) echo "<li>· <a href='bol+instrumentals+vol+3-1.html' title='".'bol instrumentals vol 3'."'>".'bol instrumentals vol 3'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='bol+instrumentals+vol+3-1.html' target='main' title='".'bol instrumentals vol 3'."'>".'bol instrumentals vol 3'."</a> (<font color='red'>!</font>)"; 

//echo "<hr>";
//VOL 10 //


//VOL 8//
//echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+8-1.html' target='main' title='".'bol sözlük compilation vol 8'."'>".'bol sözlük compilation vol 8'."</a> (<font color='red'>!</font>)"; 
//echo "<li>· <a href='y%C4%B1l%C4%B1n+enleri+2021+anketi-1.html' target='main' title='".'yılın enleri 2021 anketi'."'>".'yılın enleri 2021 anketi'."</a> (<font color='red'>!</font>)"; 
//echo "<li>· <a href='y%C4%B1l%C4%B1n+enleri+2023+anketi-2.html' target='main' title='".'yılın enleri 2023 anketi'."'>".'yılın enleri 2023 anketi'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";


//echo "<hr>";
//60 GÜN//

//VOL 9//
//echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+9-1.html' target='main' title='".'bol sözlük compilation vol 9'."'>".'bol sözlük compilation vol 9'."</a> (<font color='red'>!</font>)"; 
//VOL 9//


//echo "<hr>";
//VOL 8//

//VOL 7//
//echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+7-1.html' target='main' title='".'bol sözlük compilation vol 7'."'>".'bol sözlük compilation vol 7'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//VOL 7//

//VOL 5//
//echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+5-1.html' target='main' title='".'bol sözlük compilation vol 5'."'>".'bol sözlük compilation vol 5'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//VOL 5//

//GELECEĞİMİZ//
// echo "<li>· <a href='gelece%C4%9Fimiz%20i%C3%A7in%20toplan%C4%B1yoruz-1.html' target='main' title='".'geleceğimiz için toplanıyoruz'."'>".'geleceğimiz için toplanıyoruz'."</a> (<font color='red'>!</font>)"; 
// echo "<hr>";
//GELECEĞİMİZ//

//echo "<li>· <a href='bol%20sözlük%20ados%20röportajı-1.html' target='main' title='".'bol sözlük ados röportajı'."'>".'bol sözlük ados röportajı'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";

echo "<hr>";

///
///BURAYA GÜNDEMDEKİ 3 TOP BAŞLIK EKLENECEK

while ($currenTopic=mysql_fetch_array($getkonular3)) {
$baslik2=$currenTopic['baslik'];
$say = $currenTopic['say'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];
//$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}


			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else

//		    $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
//    $replacement = '$1 ($2)';
//    $currenTopic['baslik'] = preg_replace($pattern, $replacement, $currenTopic['baslik']);


			if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\"  title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

			if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif (s</font>
				if ($currenTopic['say']>0) {
		  echo "(<font color='green'>".$currenTopic['say']."</font>)";
		}
		
		echo "</li>\n";
	}

/// GÜNDEMDEKİ 3 BAŞLIK SONU
///
echo "<hr>";
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
//echo $baslik31;
$sorgu = "SELECT * FROM konular WHERE baslik ='$baslik2' COLLATE utf8_turkish_ci ";
//echo $baslik2;
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];
//$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}


			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else

//				    $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
//    $replacement = '$1 ($2)';
//    $currenTopic['baslik'] = preg_replace($pattern, $replacement, $currenTopic['baslik']);



					if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\" title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

					if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;

		case "konudisi":

//KAR YAĞDIR
/* 
		?>
<script src="snow-background.js"></script>


		<?
*/

		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "konu dışı";
		$gds = "d";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gds ='d' OR gds ='s')  ORDER BY tarih DESC LIMIT 0, 666"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gds ='d' OR gds ='s') ORDER BY tarih DESC LIMIT 0, 666"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
		echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center>  ";
	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	

}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'COLLATE utf8_turkish_ci";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}

			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else

//		    $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
//    $replacement = '$1 ($2)';
//    $currenTopic['baslik'] = preg_replace($pattern, $replacement, $currenTopic['baslik']);

							if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\" title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

									if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}


  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}

	break;


/*
		case "soru":
		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "soru";
		$gds = "s";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 666 "); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 666"); 
}

$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center>  ";
}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	

}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2' COLLATE utf8_turkish_ci";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}

			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else


									if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\" title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

											if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}


  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;
*/


	
		case "lobi":

//KAR YAĞDIR
 /* 
		?>
<script src="snow-background.js"></script>


		<?
 */

		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "lobi";
		$gds = "l";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 333 "); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 333"); 
}

$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center>  ";
}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' AND (baslik != 'allah' AND baslik != 'birdir') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' AND (baslik != 'allah' AND baslik != 'birdir') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	

}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);



//alc//
if($isMobile == 0)
{
//echo "<li>· <a href='subat 2022 anketleri-1.html' target='main' title='".'şubat 2022 anketleri'."'>".'şubat 2022 anketleri'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
}

if($isMobile == 1)
{
//echo "<li>· <a href='subat 2022 anketleri-1.html' title='".'şubat 2022 anketleri'."'>".'şubat 2022 anketleri'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
}


//alc//


	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2' COLLATE utf8_turkish_ci";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}

			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else

  //  $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
  //  $replacement = '$1 ($2)';
  //  $currenTopic['baslik'] = preg_replace($pattern, $replacement, $currenTopic['baslik']);

									if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\" title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

											if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}


  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;


		case "yesterday":

		echo "<div class='pagi'>dünün gündemi</div>";
		$cYea = date("Y");
		$cMon = date("m");
		$cDay = (date("d")-1);
		$topicDate = $cDay."/".$cMon."/".$cYea." günü";
$gds = 'g';

if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";	
}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	
}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}


			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	
	}

	break;
	case "lastmonth":
		$cDay = date("d");
		$cMon = date("m") - 1;
		$cYea = date("Y");
		if ($cMon==0) $cMon = 12;
		$topicDate = "geçen ayın";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
	echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";	
	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	
}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");
			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;

//EN BEĞENİLENLER

case "ebe";

if ($isMobile == 1)
{
	echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";
echo "<br>";
}

$sorgu1 = "SELECT * FROM debe";
$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$eniyientry1=$kayit2["eniyientry1"];
	$eniyientry2=$kayit2["eniyientry2"];
	$eniyientry3=$kayit2["eniyientry3"];
	$eniyientry4=$kayit2["eniyientry4"];
	$eniyientry5=$kayit2["eniyientry5"];

	$eniyibaslik1=$kayit2["eniyibaslik1"];
	$eniyibaslik2=$kayit2["eniyibaslik2"];
	$eniyibaslik3=$kayit2["eniyibaslik3"];
	$eniyibaslik4=$kayit2["eniyibaslik4"];
	$eniyibaslik5=$kayit2["eniyibaslik5"];

$eniyibaslikl1 = ereg_replace(" ","+",$eniyibaslik1);
$eniyibaslikl2 = ereg_replace(" ","+",$eniyibaslik2);
$eniyibaslikl3 = ereg_replace(" ","+",$eniyibaslik3);
$eniyibaslikl4 = ereg_replace(" ","+",$eniyibaslik4);
$eniyibaslikl5 = ereg_replace(" ","+",$eniyibaslik5);

	echo "
<strong>dünün en beğenilenleri:</strong>
<table width=\"100%\"  border=\"0\">
  
    
  
  <tr>
    <td><p>";
	 
if ($isMobile == 1)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1 >#$eniyientry1</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl1>$eniyibaslik1</a><br>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2 >#$eniyientry2</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl2>$eniyibaslik2</a><br>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3 >#$eniyientry3</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl3>$eniyibaslik3</a><br>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4 >#$eniyientry4</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl2>$eniyibaslik4</a><br>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5 >#$eniyientry5</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl3>$eniyibaslik5</a><br>";
}

if ($isMobile == 0)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1  target='main'>#$eniyientry1</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl1 target='main'>$eniyibaslik1</a><br>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2  target='main'>#$eniyientry2</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl2 target='main'>$eniyibaslik2</a><br>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3  target='main'>#$eniyientry3</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl3 target='main'>$eniyibaslik3</a><br>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4  target='main'>#$eniyientry4</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl4 target='main'>$eniyibaslik4</a><br>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5  target='main'>#$eniyientry5</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl5 target='main'>$eniyibaslik5</a><br>";
}



$sorgu1 = "SELECT * FROM debe";
$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$eniyientry1=$kayit2["hebe1"];
	$eniyientry2=$kayit2["hebe2"];
	$eniyientry3=$kayit2["hebe3"];
	$eniyientry4=$kayit2["hebe4"];
	$eniyientry5=$kayit2["hebe5"];
	$eniyientry6=$kayit2["hebe6"];
	$eniyientry7=$kayit2["hebe7"];

	$eniyientry8=$kayit2["hebe8"];
	$eniyientry9=$kayit2["hebe9"];
	$eniyientry10=$kayit2["hebe10"];


	$eniyibaslik1=$kayit2["hebeb1"];
	$eniyibaslik2=$kayit2["hebeb2"];
	$eniyibaslik3=$kayit2["hebeb3"];
	$eniyibaslik4=$kayit2["hebeb4"];
	$eniyibaslik5=$kayit2["hebeb5"];
	$eniyibaslik6=$kayit2["hebeb6"];
	$eniyibaslik7=$kayit2["hebeb7"];

	$eniyibaslik8=$kayit2["hebeb8"];
	$eniyibaslik9=$kayit2["hebeb9"];
	$eniyibaslik10=$kayit2["hebeb10"];




$eniyibaslikl1 = ereg_replace(" ","+",$eniyibaslik1);
$eniyibaslikl2 = ereg_replace(" ","+",$eniyibaslik2);
$eniyibaslikl3 = ereg_replace(" ","+",$eniyibaslik3);
$eniyibaslikl4 = ereg_replace(" ","+",$eniyibaslik4);
$eniyibaslikl5 = ereg_replace(" ","+",$eniyibaslik5);
$eniyibaslikl6 = ereg_replace(" ","+",$eniyibaslik6);
$eniyibaslikl7 = ereg_replace(" ","+",$eniyibaslik7);
$eniyibaslikl8 = ereg_replace(" ","+",$eniyibaslik8);
$eniyibaslikl9 = ereg_replace(" ","+",$eniyibaslik9);
$eniyibaslikl10 = ereg_replace(" ","+",$eniyibaslik10);

	echo "<br>
<font size=2><strong>son 7 günün en beğenilenleri:</strong></font><br>";

  
    
 
	 
if ($isMobile == 1)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1  >#$eniyientry1 - <a href=sozluk.php?process=word&q=$eniyibaslikl1 >$eniyibaslik1</a></a><br>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2 >#$eniyientry2 - <a href=sozluk.php?process=word&q=$eniyibaslikl2 >$eniyibaslik2</a></a><br>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3 >#$eniyientry3 - <a href=sozluk.php?process=word&q=$eniyibaslikl3 >$eniyibaslik3</a></a><br>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4 >#$eniyientry4 - <a href=sozluk.php?process=word&q=$eniyibaslikl4 >$eniyibaslik4</a></a><br>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5 >#$eniyientry5 - <a href=sozluk.php?process=word&q=$eniyibaslikl5 >$eniyibaslik5</a></a><br>";
echo "6. <a href=sozluk.php?process=eid&eid=$eniyientry6 >#$eniyientry6 - <a href=sozluk.php?process=word&q=$eniyibaslikl6 >$eniyibaslik6</a></a><br>";
echo "7. <a href=sozluk.php?process=eid&eid=$eniyientry7 >#$eniyientry7 - <a href=sozluk.php?process=word&q=$eniyibaslikl7 >$eniyibaslik7</a></a><br>";
echo "8. <a href=sozluk.php?process=eid&eid=$eniyientry8 >#$eniyientry8 - <a href=sozluk.php?process=word&q=$eniyibaslikl8 >$eniyibaslik8</a></a><br>";
echo "9. <a href=sozluk.php?process=eid&eid=$eniyientry9 >#$eniyientry9 - <a href=sozluk.php?process=word&q=$eniyibaslikl9 >$eniyibaslik9</a></a><br>";
echo "10. <a href=sozluk.php?process=eid&eid=$eniyientry10 >#$eniyientry10 - <a href=sozluk.php?process=word&q=$eniyibaslikl10 >$eniyibaslik10</a></a><br>";
}

if ($isMobile == 0)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1 target='main' >#$eniyientry1 - <a href=sozluk.php?process=word&q=$eniyibaslikl1 target='main'>$eniyibaslik1</a></a><br>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2 target='main'>#$eniyientry2 - <a href=sozluk.php?process=word&q=$eniyibaslikl2 target='main'>$eniyibaslik2</a></a><br>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3 target='main'>#$eniyientry3 - <a href=sozluk.php?process=word&q=$eniyibaslikl3 target='main'>$eniyibaslik3</a></a><br>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4 target='main'>#$eniyientry4 - <a href=sozluk.php?process=word&q=$eniyibaslikl4 target='main'>$eniyibaslik4</a></a><br>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5 target='main'>#$eniyientry5 - <a href=sozluk.php?process=word&q=$eniyibaslikl5 target='main'>$eniyibaslik5</a></a><br>";
echo "6. <a href=sozluk.php?process=eid&eid=$eniyientry6 target='main'>#$eniyientry6 - <a href=sozluk.php?process=word&q=$eniyibaslikl6 target='main'>$eniyibaslik6</a></a><br>";
echo "7. <a href=sozluk.php?process=eid&eid=$eniyientry7 target='main'>#$eniyientry7 - <a href=sozluk.php?process=word&q=$eniyibaslikl7 target='main'>$eniyibaslik7</a></a><br>";
echo "8. <a href=sozluk.php?process=eid&eid=$eniyientry8 target='main'>#$eniyientry8 - <a href=sozluk.php?process=word&q=$eniyibaslikl8 target='main'>$eniyibaslik8</a></a><br>";
echo "9. <a href=sozluk.php?process=eid&eid=$eniyientry9 target='main'>#$eniyientry9 - <a href=sozluk.php?process=word&q=$eniyibaslikl9 target='main'>$eniyibaslik9</a></a><br>";
echo "10. <a href=sozluk.php?process=eid&eid=$eniyientry10 target='main'>#$eniyientry10 - <a href=sozluk.php?process=word&q=$eniyibaslikl10 target='main'>$eniyibaslik10</a></a><br>";
}




	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$eniyientry1=$kayit2["eniyientry1"];
	$eniyientry2=$kayit2["eniyientry2"];
	$eniyientry3=$kayit2["eniyientry3"];
	$eniyientry4=$kayit2["eniyientry4"];
	$eniyientry5=$kayit2["eniyientry5"];
	$eniyientry6=$kayit2["eniyientry6"];
	$eniyientry7=$kayit2["eniyientry7"];
	$eniyientry8=$kayit2["eniyientry8"];
	$eniyientry9=$kayit2["eniyientry9"];
	$eniyientry10=$kayit2["eniyientry10"];
	$eniyientry11=$kayit2["eniyientry11"];
	$eniyientry12=$kayit2["eniyientry12"];
	$eniyientry13=$kayit2["eniyientry13"];
	$eniyientry14=$kayit2["eniyientry14"];
	$eniyientry15=$kayit2["eniyientry15"];


		$eniyientry16=$kayit2["eniyientry16"];
	$eniyientry17=$kayit2["eniyientry17"];
	$eniyientry18=$kayit2["eniyientry18"];
	$eniyientry19=$kayit2["eniyientry19"];
	$eniyientry20=$kayit2["eniyientry20"];


	$eniyibaslik1=$kayit2["eniyibaslik1"];
	$eniyibaslik2=$kayit2["eniyibaslik2"];
	$eniyibaslik3=$kayit2["eniyibaslik3"];
	$eniyibaslik4=$kayit2["eniyibaslik4"];
	$eniyibaslik5=$kayit2["eniyibaslik5"];
	$eniyibaslik6=$kayit2["eniyibaslik6"];
	$eniyibaslik7=$kayit2["eniyibaslik7"];
	$eniyibaslik8=$kayit2["eniyibaslik8"];
	$eniyibaslik9=$kayit2["eniyibaslik9"];
	$eniyibaslik10=$kayit2["eniyibaslik10"];
	$eniyibaslik11=$kayit2["eniyibaslik11"];
	$eniyibaslik12=$kayit2["eniyibaslik12"];
	$eniyibaslik13=$kayit2["eniyibaslik13"];
	$eniyibaslik14=$kayit2["eniyibaslik14"];
	$eniyibaslik15=$kayit2["eniyibaslik15"];

		$eniyibaslik16=$kayit2["eniyibaslik16"];
	$eniyibaslik17=$kayit2["eniyibaslik17"];
	$eniyibaslik18=$kayit2["eniyibaslik18"];
	$eniyibaslik19=$kayit2["eniyibaslik19"];
	$eniyibaslik20=$kayit2["eniyibaslik20"];

$eniyibaslikl1 = ereg_replace(" ","+",$eniyibaslik1);
$eniyibaslikl2 = ereg_replace(" ","+",$eniyibaslik2);
$eniyibaslikl3 = ereg_replace(" ","+",$eniyibaslik3);
$eniyibaslikl4 = ereg_replace(" ","+",$eniyibaslik4);
$eniyibaslikl5 = ereg_replace(" ","+",$eniyibaslik5);
$eniyibaslikl6 = ereg_replace(" ","+",$eniyibaslik6);
$eniyibaslikl7 = ereg_replace(" ","+",$eniyibaslik7);
$eniyibaslikl8 = ereg_replace(" ","+",$eniyibaslik8);
$eniyibaslikl9 = ereg_replace(" ","+",$eniyibaslik9);
$eniyibaslikl10 = ereg_replace(" ","+",$eniyibaslik10);
$eniyibaslikl11 = ereg_replace(" ","+",$eniyibaslik11);
$eniyibaslikl12 = ereg_replace(" ","+",$eniyibaslik12);
$eniyibaslikl13 = ereg_replace(" ","+",$eniyibaslik13);
$eniyibaslikl14 = ereg_replace(" ","+",$eniyibaslik14);
$eniyibaslikl15 = ereg_replace(" ","+",$eniyibaslik15);

$eniyibaslikl16 = ereg_replace(" ","+",$eniyibaslik16);
$eniyibaslikl17 = ereg_replace(" ","+",$eniyibaslik17);
$eniyibaslikl18 = ereg_replace(" ","+",$eniyibaslik18);
$eniyibaslikl19 = ereg_replace(" ","+",$eniyibaslik19);
$eniyibaslikl20 = ereg_replace(" ","+",$eniyibaslik20);
	
	
		echo "<br>
<font size=2><strong>en babalar:</strong></font><br>";

if ($isMobile == 1)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1>#$eniyientry1</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl1>$eniyibaslik1</a><br>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2>#$eniyientry2</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl2>$eniyibaslik2</a><br>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3>#$eniyientry3</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl3>$eniyibaslik3</a><br>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4>#$eniyientry4</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl4>$eniyibaslik4</a><br>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5>#$eniyientry5</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl5>$eniyibaslik5</a><br>";
echo "6. <a href=sozluk.php?process=eid&eid=$eniyientry6>#$eniyientry6</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl6>$eniyibaslik6</a><br>";
echo "7. <a href=sozluk.php?process=eid&eid=$eniyientry7>#$eniyientry7</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl7>$eniyibaslik7</a><br>";
echo "8. <a href=sozluk.php?process=eid&eid=$eniyientry8>#$eniyientry8</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl8>$eniyibaslik8</a><br>";
echo "9. <a href=sozluk.php?process=eid&eid=$eniyientry9>#$eniyientry9</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl9>$eniyibaslik9</a><br>";
echo "10. <a href=sozluk.php?process=eid&eid=$eniyientry10>#$eniyientry10</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl10>$eniyibaslik10</a><br>";
echo "11. <a href=sozluk.php?process=eid&eid=$eniyientry11>#$eniyientry11</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl11>$eniyibaslik11</a><br>";
echo "12. <a href=sozluk.php?process=eid&eid=$eniyientry12>#$eniyientry12</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl12>$eniyibaslik12</a><br>";
echo "13. <a href=sozluk.php?process=eid&eid=$eniyientry13>#$eniyientry13</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl13>$eniyibaslik13</a><br>";
echo "14. <a href=sozluk.php?process=eid&eid=$eniyientry14>#$eniyientry14</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl14>$eniyibaslik14</a><br>";
echo "15. <a href=sozluk.php?process=eid&eid=$eniyientry15>#$eniyientry15</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl15>$eniyibaslik15</a><br>";
echo "16. <a href=sozluk.php?process=eid&eid=$eniyientry16>#$eniyientry16</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl16>$eniyibaslik16</a><br>";
echo "17. <a href=sozluk.php?process=eid&eid=$eniyientry17>#$eniyientry17</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl17>$eniyibaslik17</a><br>";
echo "18. <a href=sozluk.php?process=eid&eid=$eniyientry18>#$eniyientry18</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl18>$eniyibaslik18</a><br>";
echo "19. <a href=sozluk.php?process=eid&eid=$eniyientry19>#$eniyientry19</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl19>$eniyibaslik19</a><br>";
echo "20. <a href=sozluk.php?process=eid&eid=$eniyientry20>#$eniyientry20</a> - <a href=sozluk.php?process=word&q=$eniyibaslikl20>$eniyibaslik20</a><br>";
}

if ($isMobile == 0)
{
echo "1. <a href=sozluk.php?process=eid&eid=$eniyientry1 target='main'>#$eniyientry1 - <a href=sozluk.php?process=word&q=$eniyibaslikl1  target='main'>$eniyibaslik1<br></a>";
echo "2. <a href=sozluk.php?process=eid&eid=$eniyientry2 target='main'>#$eniyientry2 - <a href=sozluk.php?process=word&q=$eniyibaslikl2 target='main'>$eniyibaslik2<br></a>";
echo "3. <a href=sozluk.php?process=eid&eid=$eniyientry3 target='main'>#$eniyientry3 - <a href=sozluk.php?process=word&q=$eniyibaslikl3 target='main'>$eniyibaslik3<br></a>";
echo "4. <a href=sozluk.php?process=eid&eid=$eniyientry4 target='main'>#$eniyientry4 - <a href=sozluk.php?process=word&q=$eniyibaslikl4 target='main'>$eniyibaslik4<br></a>";
echo "5. <a href=sozluk.php?process=eid&eid=$eniyientry5  target='main'>#$eniyientry5 - <a href=sozluk.php?process=word&q=$eniyibaslikl5 target='main'>$eniyibaslik5<br></a>";
echo "6. <a href=sozluk.php?process=eid&eid=$eniyientry6  target='main'>#$eniyientry6 - <a href=sozluk.php?process=word&q=$eniyibaslikl6 target='main'>$eniyibaslik6<br></a>";
echo "7. <a href=sozluk.php?process=eid&eid=$eniyientry7  target='main'>#$eniyientry7 - <a href=sozluk.php?process=word&q=$eniyibaslikl7 target='main'>$eniyibaslik7<br></a>";
echo "8. <a href=sozluk.php?process=eid&eid=$eniyientry8  target='main'>#$eniyientry8 - <a href=sozluk.php?process=word&q=$eniyibaslikl8 target='main'>$eniyibaslik8<br></a>";
echo "9. <a href=sozluk.php?process=eid&eid=$eniyientry9  target='main'>#$eniyientry9 - <a href=sozluk.php?process=word&q=$eniyibaslikl9 target='main'>$eniyibaslik9<br></a>";
echo "10. <a href=sozluk.php?process=eid&eid=$eniyientry10  target='main'>#$eniyientry10 - <a href=sozluk.php?process=word&q=$eniyibaslikl10 target='main'>$eniyibaslik10<br></a>";
echo "11. <a href=sozluk.php?process=eid&eid=$eniyientry11  target='main'>#$eniyientry11 - <a href=sozluk.php?process=word&q=$eniyibaslikl11 target='main'>$eniyibaslik11<br></a>";
echo "12. <a href=sozluk.php?process=eid&eid=$eniyientry12  target='main'>#$eniyientry12 - <a href=sozluk.php?process=word&q=$eniyibaslikl12 target='main'>$eniyibaslik12<br></a>";
echo "13. <a href=sozluk.php?process=eid&eid=$eniyientry13  target='main'>#$eniyientry13 - <a href=sozluk.php?process=word&q=$eniyibaslikl13 target='main'>$eniyibaslik13<br></a>";
echo "14. <a href=sozluk.php?process=eid&eid=$eniyientry14  target='main'>#$eniyientry14 - <a href=sozluk.php?process=word&q=$eniyibaslikl14 target='main'>$eniyibaslik14<br></a>";
echo "15. <a href=sozluk.php?process=eid&eid=$eniyientry15  target='main'>#$eniyientry15 - <a href=sozluk.php?process=word&q=$eniyibaslikl15 target='main'>$eniyibaslik15<br></a>";

echo "16. <a href=sozluk.php?process=eid&eid=$eniyientry16  target='main'>#$eniyientry16 - <a href=sozluk.php?process=word&q=$eniyibaslikl16  target='main'>$eniyibaslik16<br></a>";
echo "17. <a href=sozluk.php?process=eid&eid=$eniyientry17  target='main'>#$eniyientry17 - <a href=sozluk.php?process=word&q=$eniyibaslikl17  target='main'>$eniyibaslik17<br></a>";
echo "18. <a href=sozluk.php?process=eid&eid=$eniyientry18  target='main'>#$eniyientry18 - <a href=sozluk.php?process=word&q=$eniyibaslikl18  target='main'>$eniyibaslik18<br></a>";
echo "19. <a href=sozluk.php?process=eid&eid=$eniyientry19  target='main'>#$eniyientry19 - <a href=sozluk.php?process=word&q=$eniyibaslikl19  target='main'>$eniyibaslik19<br></a>";
echo "20. <a href=sozluk.php?process=eid&eid=$eniyientry20  target='main'>#$eniyientry20 - <a href=sozluk.php?process=word&q=$eniyibaslikl20  target='main'>$eniyibaslik20<br></a>";
}
echo "
 </td>
  </tr>
</table>
	";
	die();



	case "oneday":
		$cYea = rand($fYea, date("Y"));
		if($cYea==date("Y")) {$maxMon=date("m");}else{$maxMon=12;}
		if(!$cYea==$fYea) {$fMon=1;}
		$cMon = rand($fMon, $maxMon);
		if($cMon==date("m")) {$maxDay=date("d");}else{$maxDay="select";}
		if(!$cMon==$fMon) {$fDay=1;}
		if($maxDay=="select"){
			switch ($cMon) {
				case 1:	case 3:	case 5:	case 7:	case 8:	case 10: case 12: $maxDay = 31; break;
				case 2:	$maxDay = 28; break;
				case 4:	case 6:	case 9:	case 11: $maxDay = 30; break;
			}	
		}
		$cDay = rand($fDay, $maxDay);
		$topicDate = $cDay."/".$cMon."/".$cYea." günü";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";	
	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	
}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}

			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;	


	case "tb":

		$cYea = rand("2015", (date("Y")-1));
		$cMon = date("m");
		$cDay = date("d");


		if (isset($_GET['gun']) && isset($_GET['ay']) && isset($_GET['yil'])) {
    $cDay = $_GET['gun'];
    $cMon = $_GET['ay'];
    $cYea = $_GET['yil'];
}

		$topicDate = $cDay."/".$cMon."/".$cYea." günü";
		$gds = 'g';

if ($isMobile == 1)
{
	echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";
echo "";
}

			echo "<div class='pagi'>tarihte bugün</div>";

			//GÜN ARAMA

				echo "<center><select class=ksel name=gun>";
					for ($i=1;$i<=31;$i++) {
						if ($cDay == $i) {
							echo "<option selected>$i</OPTION>"; //$q
						}else{
							echo "<OPTION>$i</OPTION>"; //$q
						}
					}
					echo "</SELECT>";

									echo "<select class=ksel  name=ay>";
					for ($i=1;$i<=12;$i++) {
						if ($cMon == $i) {
							echo "<option selected>$i</OPTION>"; //$q
						}else{
							echo "<OPTION>$i</OPTION>"; //$q
						}
					}
					echo "</SELECT>";

									echo "<select class=ksel  name=yil>";
					for ($i=2014;$i<=2024;$i++) {
						if ($cYea == $i) {
							echo "<option selected>$i</OPTION>"; //$q
						}else{
							echo "<OPTION>$i</OPTION>"; //$q
						}
					}
					echo "</SELECT>";

					echo "    <input type=\"button\" onclick=\"updateDateSelection();\" value=\"Seç\" class=\"butx\">";
					echo "</center>";

					?>
					<script>
function updateDateSelection() {
    var selectedGun = document.getElementsByName('gun')[0].value;
    var selectedAy = document.getElementsByName('ay')[0].value;
    var selectedYil = document.getElementsByName('yil')[0].value;

    var newLocation = 'left.php?list=tb&gun=' + selectedGun + '&ay=' + selectedAy + '&yil=' + selectedYil;
    location.href = newLocation;
    
}
</script>
<?


			//GÜN ARAMA



if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea' AND gds ='$gds' ORDER BY tarih"); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru' or $topicDate=='lobi')
	{
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  $ekmobile </center> ";	
	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	
}
$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);
	while ($currenTopic=mysql_fetch_array($getkonular)) {
$baslik2=$currenTopic['baslik'];
$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslik2'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];


if ($kulYetki=='admin' or $kulYetki=='mod') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}


			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

			$id = $currenTopic['id'];
		$link = str_replace(" ","+",$currenTopic['baslik']);
		//if ($link == "bol+sözlük+scout+ekibi"){
			// echo " <font color=\"blue\"><li>· <a href='sozluk.php?process=word&q=".$link."&sayfa=$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>";
			//else
		if ($isMobile ==0)
		{
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		}

  				if ($isMobile ==1)
		{
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
  		}


  		// echo "<li>· <a href='/bol/".$link."/$goster' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
  		//OLD
  		 // echo "<li>· <a href=/b/".$link."/$goster target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a>";
		//}
	//	endif
				if ($currenTopic['say']>1) {
		  echo "(".$currenTopic['say'].")";
		}
		
		echo "</li>\n";
	}
	break;	


	//SON
}



?>
</ul>
<?php
//echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)";
echo "<br /><center>";

if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</center>";
echo "<br>";


if (($isMobile == 1) && ($kullaniciAdi == "") ) 
{
//REKLAM YERİ
?>
<center>
<a href="https://chat.bolsozluk.com" target="_blank"><font size=1>bolchat</font></a>
 | 
<a href="http://www.twitter.com/BolSozluk" target="_blank"><font size=1>x</font></a>
 | 
<a href="http://www.youtube.com/BolSozluk" target="_blank"><font size=1>yt</font></a>
 | 
 <a href="http://www.instagram.com/bolsozluk" target="_blank"><font size=1>insta</font></a>
 | 
<a href="https://open.spotify.com/artist/6cbqsKLbEyJZ7LhiuIqe7z" target="_blank"><font size=1>spotify</font></a>
 | 
<a href="http://anket.bolsozluk.com" target="_blank"><font size=1>anket</font></a>
 | 
 <a href="http://www.bolsozluk.com/raple" target="_blank"><font size=1>raple</font></a>
 | 
<a href="/sozlesme.html" target="_blank"><font size=1>uyarı</font></a>
 | 
<a href="/devlog.txt" target="_blank"><font size=1>devlog</font></a></center>
<br>
<center>
<font size=1>
bol'da yer alan içeriğin doğru veya güncel olduğu hiçbir şekilde iddia veya garanti edilmemektedir. burada okuduklarınız sizi dehşete düşürürse bir de türkçe rap ansiklopedisine göz atmayı deneyebilirsiniz. hukuka aykırı içerikler titizlikle incelenip gereği düşünülmektedir. sözlüğü reklamsız görüntülemek isterseniz üye girişi yapabilirsiniz. soğuk içiniz.
</center>
</font>
<br> 

<? if (($kullaniciAdi == "") || ($list != "")) { ?>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<!-- bolsözlük-3 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7236998758"
     data-ad-format="auto"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<?
}
}




echo "</div>";


mysql_close($databaseConnection);
ob_end_flush();

//LEGACY PART

//60 GÜN//
/*
echo "<li>· <a href='sen%20bir%20korkaks%C4%B1n-1.html' target='main' title='".'şafak 60: sen bir korkaksın'."'>".'şafak 60: sen bir korkaksın'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='bask%C4%B1n-1.html' target='main' title='".'şafak 59: baskın'."'>".'şafak 59: baskın'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='kin-1.html' target='main' title='".'şafak 58: kin'."'>".'şafak 58: kin'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='para%20pula%20meyil-1.html' target='main' title='".'şafak 57: para pula meyil'."'>".'şafak 57: para pula meyil'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='b1r-1.html' target='main' title='".'şafak 56: b1r'."'>".'şafak 56: b1r'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='cehaletin%20evlatlar%C4%B1-1.html' target='main' title='".'şafak 55: cehaletin evlatları'."'>".'şafak 55: cehaletin evlatları'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='aya%C4%9Fa%20kalk-1.html' target='main' title='".'şafak 54: ayağa kalk'."'>".'şafak 54: ayağa kalk'."</a> (<font color='red'>!</font>)"; 
echo "<li>· <a href='insanlar%20%C3%B6l%C3%BC-1.html' target='main' title='".'şafak 53: insanlar ölü'."'>".'şafak 53: insanlar ölü'."</a> (<font color='red'>!</font>)"; 

if (($cDay==23) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='saman%20alt%C4%B1%20sava%C5%9Flar%C4%B1-1.html' target='main' title='".'şafak 52: saman altı savaşları'."'>".'şafak 52: saman altı savaşları'."</a> (<font color='red'>!</font>)"; 
if (($cDay==24) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='%C3%A7%C4%B1kt%C4%B1k%20yine%20yollara-1.html' target='main' title='".'şafak 51: çıktık yine yollara'."'>".'şafak 51: çıktık yine yollara'."</a> (<font color='red'>!</font>)"; 
if (($cDay==25) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='barut-1.html' target='main' title='".'şafak 50: barut'."'>".'şafak 50: barut'."</a> (<font color='red'>!</font>)"; 
if (($cDay==26) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='proleter-1.html' target='main' title='".'şafak 49: proleter'."'>".'şafak 49: proleter'."</a> (<font color='red'>!</font>)"; 
if (($cDay==27) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='pazarl%C4%B1k%20yok-1.html' target='main' title='".'şafak 48: pazarlık yok'."'>".'şafak 48: pazarlık yok'."</a> (<font color='red'>!</font>)"; 
if (($cDay==28) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='hadi%20konu%C5%9F-1.html' target='main' title='".'şafak 47: hadi konuş'."'>".'şafak 47: hadi konuş'."</a> (<font color='red'>!</font>)"; 
if (($cDay==29) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='s%C4%B1f%C4%B1r%20miligram-1.html' target='main' title='".'şafak 46: sıfır miligram'."'>".'şafak 46: sıfır miligram'."</a> (<font color='red'>!</font>)"; 
if (($cDay==30) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='canavar%20kafanda-1.html' target='main' title='".'şafak 45: canavar kafanda'."'>".'şafak 45: canavar kafanda'."</a> (<font color='red'>!</font>)"; 
if (($cDay==31) && ($cMon==03) && ($cYea==2023)) echo "<li>· <a href='tek%20bir%20ihtimal%20var-1.html' target='main' title='".'şafak 44: tek bir ihtimal var'."'>".'şafak 44: tek bir ihtimal var'."</a> (<font color='red'>!</font>)"; 
if (($cDay==01) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='bu%20s%C3%B6zleri%20yazd%C4%B1%C4%9F%C4%B1mda%20dolar%202%20lirayd%C4%B1-1.html' target='main' title='".'şafak 43: bu sözleri yazdığımda dolar 2 liraydı'."'>".'şafak 43: bu sözleri yazdığımda dolar 2 liraydı'."</a> (<font color='red'>!</font>)"; 
if (($cDay==02) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='yaz%20gazeteci%20yaz-1.html' target='main' title='".'şafak 42: yaz gazeteci yaz'."'>".'şafak 42: yaz gazeteci yaz'."</a> (<font color='red'>!</font>)"; 
if (($cDay==03) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='unutma-1.html' target='main' title='".'şafak 41: unutma'."'>".'şafak 41: unutma'."</a> (<font color='red'>!</font>)"; 
if (($cDay==04) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='fele%C4%9Fin%20%C3%A7emberine%2040%20kur%C5%9Fun-1.html' target='main' title='".'şafak 40: feleğin çemberine 40 kurşun'."'>".'şafak 40: feleğin çemberine 40 kurşun'."</a> (<font color='red'>!</font>)"; 
if (($cDay==05) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='b%C3%B6yle%20festival-1.html' target='main' title='".'şafak 39: böyle festival'."'>".'şafak 39: böyle festival'."</a> (<font color='red'>!</font>)"; 
if (($cDay==06) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='rant%20hilafeti-1.html' target='main' title='".'şafak 38: rant hilafeti'."'>".'şafak 38: rant hilafeti'."</a> (<font color='red'>!</font>)"; 
if (($cDay==07) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='olay-1.html' target='main' title='".'şafak 37: olay'."'>".'şafak 37: olay'."</a> (<font color='red'>!</font>)"; 
if (($cDay==8) && ($cMon==4) && ($cYea==2023)) echo "<li>· <a href='say%C4%B1n%20t%C3%BCrk-1.html' target='main' title='".'şafak 36: sayın türk'."'>".'şafak 36: sayın türk'."</a> (<font color='red'>!</font>)"; 

if (($cDay==9) && ($cMon==4) && ($cYea==2023)) echo "<li>· <a href='hep%20biz%20%C3%B6ld%C3%BCk-1.html' target='main' title='".'şafak 35: hep biz öldük'."'>".'şafak 35: hep biz öldük'."</a> (<font color='red'>!</font>)"; 
if (($cDay==10) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='sayg%C4%B1%20duru%C5%9Fu-1.html' target='main' title='".'şafak 34: saygı duruşu'."'>".'şafak 34: saygı duruşu'."</a> (<font color='red'>!</font>)"; 
if (($cDay==11) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='neoliberal%20mezbaha-1.html' target='main' title='".'şafak 33: neoliberal mezbaha'."'>".'şafak 33: neoliberal mezbaha'."</a> (<font color='red'>!</font>)"; 
if (($cDay==12) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='susmak%20i%C3%A7in%20yok%20bahanem-1.html' target='main' title='".'şafak 32: susmak için yok bahanem'."'>".'şafak 32: susmak için yok bahanem'."</a> (<font color='red'>!</font>)"; 
if (($cDay==13) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='molotoflu%20vodvil-1.html' target='main' title='".'şafak 31: molotoflu vodvil'."'>".'şafak 31: molotoflu vodvil'."</a> (<font color='red'>!</font>)"; 
if (($cDay==14) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='propaganda-1.html' target='main' title='".'şafak 30: propaganda'."'>".'şafak 30: propaganda'."</a> (<font color='red'>!</font>)"; 

if (($cDay==15) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='kimin%20umrunda-1.html' target='main' title='".'şafak 29: kimin umurunda'."'>".'şafak 29: kimin umurunda'."</a> (<font color='red'>!</font>)"; 
if (($cDay==16) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='adrenalin-1.html' target='main' title='".'şafak 28: adrenalin'."'>".'şafak 28: adrenalin'."</a> (<font color='red'>!</font>)"; 
if (($cDay==17) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='yang%C4%B1na%20k%C3%B6r%C3%BCklen-1.html' target='main' title='".'şafak 27: yangına körüklen'."'>".'şafak 27: yangına körüklen'."</a> (<font color='red'>!</font>)"; 
if (($cDay==18) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='h%C4%B1rs%C4%B1z%20var-1.html' target='main' title='".'şafak 26: hırsız var'."'>".'şafak 26: hırsız var'."</a> (<font color='red'>!</font>)";  
if (($cDay==19) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='%C4%B1rmaklar%C4%B1%20kan%C4%B1mla%20kur-1.html' target='main' title='".'şafak 25: ırmakları kanımla kur'."'>".'şafak 25: ırmakları kanımla kur'."</a> (<font color='red'>!</font>)"; 
if (($cDay==20) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='neyin%20fark%C4%B1ndas%C4%B1n-1.html' target='main' title='".'şafak 24: neyin farkındasın'."'>".'şafak 24: neyin farkındasın'."</a> (<font color='red'>!</font>)"; 
if (($cDay==21) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='a%C3%A7%C4%B1k%20artt%C4%B1rma-1.html' target='main' title='".'şafak 23: açık artırma'."'>".'şafak 23: açık artırma'."</a> (<font color='red'>!</font>)"; 
if (($cDay==22) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='ar%20gelir%20yak%C4%B1n-1.html' target='main' title='".'şafak 22: ar gelir yakın'."'>".'şafak 22: ar gelir yakın'."</a> (<font color='red'>!</font>)"; 
if (($cDay==23) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='yerin%20en%20dibine-1.html' target='main' title='".'şafak 21: yerin en dibine'."'>".'şafak 21: yerin en dibine'."</a> (<font color='red'>!</font>)"; 
if (($cDay==24) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='tariz-1.html' target='main' title='".'şafak 20: tariz'."'>".'şafak 20: tariz'."</a> (<font color='red'>!</font>)"; 

if (($cDay==25) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='ezilmi%C5%9F%20%C3%A7ocuklar-1.html' target='main' title='".'şafak 19: ezilmiş çocuklar'."'>".'şafak 19: ezilmiş çocuklar'."</a> (<font color='red'>!</font>)"; 
if (($cDay==26) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='sonras%C4%B1%20yok-1.html' target='main' title='".'şafak 18: sonrası yok'."'>".'şafak 18: sonrası yok'."</a> (<font color='red'>!</font>)"; 
if (($cDay==27) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='katilimi%20tan%C4%B1yorum-1.html' target='main' title='".'şafak 17: katilimi tanıyorum'."'>".'şafak 17: katilimi tanıyorum'."</a> (<font color='red'>!</font>)"; 
if (($cDay==28) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='reddet-1.html' target='main' title='".'şafak 16: reddet'."'>".'şafak 16: reddet'."</a> (<font color='red'>!</font>)"; 
if (($cDay==29) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='hi%C3%A7%20sevmedim%20seni-1.html' target='main' title='".'şafak 15: hiç sevmedim seni'."'>".'şafak 15: hiç sevmedim seni'."</a> (<font color='red'>!</font>)"; 
if (($cDay==30) && ($cMon==04) && ($cYea==2023)) echo "<li>· <a href='bu%C4%9Fulu%20camlara%20devrik%20c%C3%BCmleler-1.html' target='main' title='".'şafak 14: buğulu camlara devrik cümleler'."'>".'şafak 14: buğulu camlara devrik cümleler'."</a> (<font color='red'>!</font>)"; 
if (($cDay==01) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='ic%20mihrak-1.html' target='main' title='".'şafak 13: iç mihrak'."'>".'şafak 13: iç mihrak'."</a> (<font color='red'>!</font>)"; 
if (($cDay==02) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='s%C4%B1ra%20kimde-1.html' target='main' title='".'şafak 12: sıra kimde'."'>".'şafak 12: sıra kimde'."</a> (<font color='red'>!</font>)"; 
if (($cDay==03) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='katili%20katlet-1.html' target='main' title='".'şafak 11: katili katlet'."'>".'şafak 11: katili katlet'."</a> (<font color='red'>!</font>)"; 
if (($cDay==04) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='manifesto-1.html' target='main' title='".'şafak 50: manifesto'."'>".'şafak 10: manifesto'."</a> (<font color='red'>!</font>)"; 

if (($cDay==05) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='anlat-1.html' target='main' title='".'şafak 09: anlat'."'>".'şafak 09: anlat'."</a> (<font color='red'>!</font>)"; 
if (($cDay==06) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='%C3%A7are%20var-1.html' target='main' title='".'şafak 08: çare var'."'>".'şafak 08: çare var'."</a> (<font color='red'>!</font>)"; 
if (($cDay==07) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='karar%20bizim-1.html' target='main' title='".'şafak 07: karar bizim'."'>".'şafak 07: karar bizim'."</a> (<font color='red'>!</font>)"; 
if (($cDay==8) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='hani%20nerdeler-1.html' target='main' title='".'şafak 06: hani nerdeler'."'>".'şafak 06: hani nerdeler'."</a> (<font color='red'>!</font>)"; 
if (($cDay==9) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='%C3%B6lene%20kadar-1.html' target='main' title='".'şafak 05: ölene kadar'."'>".'şafak 05: ölene kadar'."</a> (<font color='red'>!</font>)"; 
if (($cDay==10) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='%C3%B6l%C3%BCler%20dirilerden%20%C3%A7alacak-1.html' target='main' title='".'şafak 04: ölüler dirilerden çalacak'."'>".'şafak 04: ölüler dirilerden çalacak'."</a> (<font color='red'>!</font>)"; 
if (($cDay==11) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='fkp%20se%C3%A7im%20%C5%9Fark%C4%B1s%C4%B1-1.html' target='main' title='".'şafak 03: fkp seçim şarkısı'."'>".'şafak 03: fkp seçim şarkısı'."</a> (<font color='red'>!</font>)"; 
if (($cDay==12) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='susamam-1.html' target='main' title='".'şafak 02: susamam'."'>".'şafak 02: susamam'."</a> (<font color='red'>!</font>)"; 
if (($cDay==13) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='se%C3%A7im%20%C5%9Fark%C4%B1s%C4%B1-1.html' target='main' title='".'şafak 01: seçim şarkısı'."'>".'şafak 01: seçim şarkısı'."</a> (<font color='red'>!</font>)"; 
//if (($cDay==14) && ($cMon==05) && ($cYea==2023)) echo "<li>· <a href='https://www.bolsozluk.com/60%20g%C3%BCn-1.html' target='main' title='".'şafak doğan güneş'."'>".'şafak doğan güneş'."</a> (<font color='red'>!</font>)"; 

*/


?>
</div>


</body>




</html>


