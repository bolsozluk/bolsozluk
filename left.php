<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<?
session_start();
ob_start();

include "icerik/firstsettings.php";
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
otomatikLogin();
kontrolEt();
addMeOnlines();

$aktifTema = $_SESSION['aktifTema_S']; if(!$_SESSION['aktifTema_S']){$aktifTema="default";}
$currentPage = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$list = guvenlikKontrol($_REQUEST["list"],"hard");

$araGun = $_REQUEST['gun'];
$araAy = $_REQUEST['ay'];
$araYil = $_REQUEST['yil'];

$aylikentry = mysql_result(mysql_query("SELECT aylikentry FROM user WHERE nick='$kullaniciAdi'"), 0);
if ($kullaniciAdi == "") $aylikentry = 0;
$entryBaraji = 1; 
$pasifyazar = ($aylikentry < $entryBaraji);

/*
				//KAR YAĞDIR
		?>
		<script src="snow-background.js"></script>
		<script>
		// Kış aylarında kar yağdır (Aralık=11, Ocak=0, Şubat=1)
		var now = new Date();
		var currentMonth = now.getMonth();			
	    var day = now.getDate();      // 1–31
		if (month === 11 && day >= 24 && day <= 31) {
			// Entry yazarken kar dursun istenmiyorsa freezeOnBlur'u kapat
			snowStorm.freezeOnBlur = false;
		} else {
			// Kış değilse karı durdur
			snowStorm.stop();
		}
		</script>
		<?

*/

if($list != "today" | "yesterday" | "lastmonth" | "oneday" );
if(!$currentPage) $currentPage=1;

$limitFrom = ($currentPage - 1) * $maxTopicPage;
?>

<? 
/* if($list=="today") { ?> <meta http-equiv="refresh" content="120;URL=left.php?list=today"><? } */
?> 

	<script>
(function(){

  var isToday = <?php echo ($list === "today") ? 'true' : 'false'; ?>;
  if (!isToday) return;

  var isMobile = <?php echo ($isMobile ? 'true' : 'false'); ?>;
//  if (isMobile) return; // mobilde kapatmak istersen bu satırı bırak

  var LIST_SELECTOR = '#listLeftFrame';
  var INTERVAL_MS = 60000; // 60s

  setInterval(refreshList, INTERVAL_MS);

  async function refreshList() {
    try {
      var url = location.pathname + '?list=today';
      var res = await fetch(url, { cache: 'no-store', credentials: 'same-origin' });
      if (!res.ok) return;
      var html = await res.text();
      var parser = new DOMParser();
      var doc = parser.parseFromString(html, 'text/html');
      var newList = doc.querySelector(LIST_SELECTOR);
      var oldList = document.querySelector(LIST_SELECTOR);
      if (!newList || !oldList) return;
      var prevScrollTop = oldList.scrollTop;
      var active = document.activeElement;
      var activeId = active && active.id ? active.id : null;

      oldList.innerHTML = newList.innerHTML;
      oldList.scrollTop = prevScrollTop;

      if (activeId) {
        var el = document.getElementById(activeId);
        if (el && typeof el.focus === 'function') el.focus();
      }
    } catch (err) {
      console.error('refreshList error', err);
    }
  }
})();
</script>
	

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



if( ($isMobile == 1) && ( ($kullaniciAdi == "" && $list != "") || ($pasifyazar) ) ) //if(($isMobile == 1) && ($kullaniciAdi == "") && ($list != ""))
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


//-----------------------------------------
	// KANAL FİLTRE (GÜNDEM)
if (!$pasifyazar)
{
$kanallar = array(
        "#mc",
        "#album",
        "#yabancirap",
        "#graffiti",
        "#turntablism",
        "#instrumental",
        "#produktor",
        "#polemik",
        "#magazin",
        "#lyrics",
        "#konser",
        "#kultur"
);

echo "<center>";
echo "<select class='ksel' onchange='goKanal(this.value)'>";
echo "<option value=''>kanal seç</option>";

foreach ($kanallar as $k) {
	$kanalUrl = ltrim($k, '#'); // #mc → mc
    $url = "left.php?list=kanal&kanal=" . urlencode($kanalUrl);
    echo "<option value='$url'>$k</option>";
}

echo "</select>";
echo "</center>";

?>
<script>
function goKanal(url) {
    if (url !== '') {
        location.href = url;
    }
}
</script>
<?
}

//-----------------------------------------

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


$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait' AND statu!= 'kenar'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik !='$baslik31' AND baslik !='$baslik32' AND baslik !='$baslik33') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	


			}


$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);

echo "<hr>";

//if($isMobile == 1) echo "<li>· <a href='her+sey+cok+guzel+olacak-1.html' title='".'her şey çok güzel olacak'."'>".'her şey çok güzel olacak'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='her+sey+cok+guzel+olacak-1.html' target='main' title='".'her şey çok güzel olacak'."'>".'her şey çok güzel olacak'."</a> (<font color='red'>!</font>)"; 


//VOL 10 haz//
//if($isMobile == 1) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+on+birinci+alb%C3%BCm-1.html' title='".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='https://www.bolsozluk.com/s%C3%B6zl%C3%BCk+yazarlar%C4%B1n%C4%B1n+eme%C4%9Fiyle+yap%C4%B1lacak+on+birinci+alb%C3%BCm-1.html' target='main' title='".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."'>".'sözlük yazarlarının emeğiyle yapılacak on birinci albüm'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";

//vol 11//
//if($isMobile == 1) echo "<li>· <a href='bol+sozluk+compilation+vol+11-1.html' title='".'bol sözlük compilation vol 11'."'>".'bol sözlük compilation vol 11'."</a> (<font color='red'>!</font>)"; 
//if($isMobile == 0) echo "<li>· <a href='bol+sozluk+compilation+vol+11-1.html' target='main' title='".'bol sözlük compilation vol 11'."'>".'bol sözlük compilation vol 11'."</a> (<font color='red'>!</font>)"; 

//GENERIC
//echo "<hr>";

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

							if($isMobile == 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target=\"_top\" title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

									if($isMobile != 1)
{ 
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
		}

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



case "kanal":
    // Tarih değişkenleri
    $cDay = date("d");
    $cMon = date("m");
    $cYea = date("Y");
    $gds = "g";
    
    // Sayfalama değişkenleri
    $currentPage = isset($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
    if ($currentPage < 1) $currentPage = 1;
    
    $limitFrom = ($currentPage - 1) * $maxTopicPage;
    
    // Kanal değişkeni
    $kanal = '';
    if (isset($_GET['kanal'])) {
        $kanal = mysql_real_escape_string($_GET['kanal']);
        $kanal = strtolower(trim($kanal));
    }
    
    if (empty($kanal)) {
        echo "<center><div style='color:red;padding:10px;'>Lütfen bir kanal seçin!</div></center>";
        break;
    }
    
    // TOPLAM KAYIT SAYISI
    $countQuery = "SELECT COUNT(id) as total FROM konular 
                  WHERE statu = '' 
                  AND gds = 'g'
                  AND (
                      LOWER(kanal1) = '#" . $kanal . "' OR 
                      LOWER(kanal2) = '#" . $kanal . "' OR 
                      LOWER(kanal3) = '#" . $kanal . "'
                  )";
    
    $countResult = mysql_query($countQuery);
    if (!$countResult) {
        die("Sorgu hatası: " . mysql_error());
    }
    
    $countRow = mysql_fetch_assoc($countResult);
    $topicNum = $countRow['total'];
    $totalPage = ceil($topicNum / $maxTopicPage);
    
    // Butonlar
    echo "<center>
        <input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> 
        <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> 
        <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'>  
        $ekmobile 
    </center>";
    
    // Kanal seçimi (sadece admin)
    if ($kulYetki == "admin") {
        $kanallar = array(
            "mc", "album", "yabancirap", "graffiti", "turntablism",
            "instrumental", "produktor", "polemik", "magazin",
            "lyrics", "konser", "kultur"
        );
        
        echo "<center>";
        echo "<select class='ksel' onchange='if(this.value) location.href=this.value;'>";
        echo "<option value=''>-- kanal seç --</option>";
        
        foreach ($kanallar as $k) {
            $selected = ($kanal == strtolower($k)) ? "selected='selected'" : "";
            $url = "left.php?list=kanal&kanal=" . urlencode($k);
            echo "<option value='" . htmlspecialchars($url, ENT_QUOTES) . "' $selected>#$k</option>";
        }
        
        echo "</select>";
        echo "</center>";
    }
    
    // Sayfalama
    echo "<div class='pagi'>#$kanal başlıkları: ($topicNum başlık)<br />";
    if ($totalPage > 1) {
        navigateKanal('kanal', $kanal, $currentPage, $totalPage);
    }
    echo "</div>\n";
    
    // ASIL SORGUMUZ
    $mainQuery = "
        SELECT k.id, k.baslik, k.tarih,
            (SELECT COUNT(m.id) FROM mesajlar m 
             WHERE m.sira = k.id 
             AND m.statu NOT IN ('silindi', 'wait', 'kenar')
             AND m.yil != '') AS say
        FROM konular k
        WHERE k.statu = '' 
        AND k.gds = 'g'
        AND (
            LOWER(k.kanal1) = '#" . $kanal . "' OR 
            LOWER(k.kanal2) = '#" . $kanal . "' OR 
            LOWER(k.kanal3) = '#" . $kanal . "'
        )
        ORDER BY k.tarih DESC 
        LIMIT $limitFrom, $maxTopicPage
    ";
    
    $result = mysql_query($mainQuery);
    
    if (!$result) {
        die("SQL Hatası: " . mysql_error());
    }
    
    $numRows = mysql_num_rows($result);
    
    // Sonuçları listele
    if ($numRows > 0) {
        echo "<ul id='listLeftFrame'>";
        
        while ($currenTopic = mysql_fetch_array($result)) {
            $baslik = htmlspecialchars($currenTopic['baslik'], ENT_QUOTES, 'UTF-8');
            $id = $currenTopic['id'];
            $say = $currenTopic['say'];
            
            // Sayfa hesaplama
            $w = $say;
            $max = 20;
            $goster = ceil($w / $max);
            if ($goster < 1) $goster = 1;
            
            $link = str_replace(" ", "+", $currenTopic['baslik']);
            
            // Mobil kontrol
            if ($isMobile == 1) {
                echo "<font size=2><li>· <a href='/" . $link . "-" . $goster . ".html' target=\"_top\" title='" . $baslik . " (" . $say . ")'>" . $baslik . "</a>";
            } else {
                echo "<font size=2><li>· <a href='/" . $link . "-" . $goster . ".html' target='main' title='" . $baslik . " (" . $say . ")'>" . $baslik . "</a>";
            }
            
            if ($say > 1) {
                echo " (" . $say . ")";
            }
            
            echo "</li></font>\n";
        }
        
        echo "</ul>";
    } else {
        echo "<div style='padding:20px;text-align:center;color:#666;'>Bu kanalda henüz başlık bulunmuyor.</div>";
    }
    
    break;



	//SON
}
?>



</ul>
<?php
//echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)";
echo "<br /><center>";
if (($totalPage>1)&& ($list!="kanal"))navigatePage($list,$currentPage,$totalPage);
if (($totalPage>1)&& ($list=="kanal"))navigateKanal($list,$kanal,$currentPage,$totalPage);
echo "</center>";
echo "<br>";
if ($isMobile == 1) {
include "icerik/footer.php";
echo "<br>";
echo "<br>";
if ($kullaniciAdi) {include "icerik/bolchat.php";}
if (($kullaniciAdi == "") || ($pasifyazar)) { ?> 
</font>
<br> 
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
?>
</div>
</body>
</html>
