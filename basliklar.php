<?
session_start();
ob_start();

include "icerik/firstsettings.php";
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();

$aktifTema = $_SESSION['aktifTema_S']; if(!$_SESSION['aktifTema_S']){$aktifTema="default";}
$currentPage = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$list = guvenlikKontrol($_REQUEST["list"],"hard");

if($list != "today" | "yesterday" | "lastmonth" | "oneday" );
if(!$currentPage) $currentPage=1;

$limitFrom = ($currentPage - 1) * $maxTopicPage;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<? if($list=="today") { ?> <meta http-equiv="refresh" content="600;URL=basliklar.php?list=today"><? } ?> 
<script src="inc/top.js" type="text/javascript"></script>
<script src="inc/sozluk.js" type="text/javascript"></script>
<link href="favicon.ico" rel="shortcut Icon">
<link href="favicon.ico" rel="icon">
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">

<style>
.butx {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}

.butx2 {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #ffffff; text-align: center
}
</style>

<center>
<table cellpadding="0" cellspacing="1" class="nav">
<tr>
<td style="height:10px;white-space:nowrap;padding:1px;font-size:x-small"><u>b</u>a$lik <input maxLength=55 onKeyPress="return submitenter(this,event)" class="input" style="height:12px" accesskey="b" id="q" name="q" size="30" placeholder="aramaya inanın"/></td>
<td onClick="javascript:getir2();"  class="butx"><a title="ogrenelim nedir"> getir </a></td>
<td onClick="javascript:ara2();"  class="butx"><a title="ara bul"> ara </a></td>

<?
/*
<td><input id="getir" type="button" value="getir" onclick="javascript:getir2();" class='butx'/></td>
<td><input id="clickMe" type="button" value="ara" onclick="javascript:ara2();" class='butx'/></td>

*/
?>

<br>
</tr>
</table></center>
</head>
<body class="bodyLeftFrame">


<br>


<div style="width: 100%">


<?

//			echo "$kullaniciAdi";

if ($kullaniciAdi=='admin') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
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

	case "mix":
		$totalEntry = mysql_query("SELECT id FROM konular WHERE statu=''");
		$totalEntryNum = mysql_num_rows($totalEntry);
		echo "<div class='pagi'>tombala sonuçları</div>";
		echo '<ul id="listLeftFrame">';
		for ($i=1;$i<=40;++$i) {
			$sayi = rand(1, $totalEntryNum);
			if (!$sayi) echo "var bisiler var";
		
			$getmesajlar1 = mysql_query("SELECT baslik FROM konular WHERE id=$sayi AND statu=''");
			$getmesajlar2 = mysql_fetch_array($getmesajlar1);
			$topic = $getmesajlar2["baslik"];
			$link  = ereg_replace(" ","+",$topic);
		
			if (!$topic) {
				$i--;
			}else{
				echo "<font size=2><li>· <a href='/".$link."-1.html' target='main' title='".$topic."'>".$topic."</a></font>"; 
			//echo "<li>. <a href='/b/".$link."/' target='self' title='".$topic."'>".$topic."</a>"; //title da başlık istastistikleri verilebilir
			}   
		}
		echo '</ul>';
		echo "<div class='pagi'>tombala sonuçları</div>";
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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";

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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
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

/*
if ($kullaniciAdi=='admin') 
{ 
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid"); //admin için 	
} else {
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' "); //herkes için 	
}
*/

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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 
 $sqlSyntax31 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY say DESC LIMIT 0,1";	
 $sqlSyntax32 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY say DESC LIMIT 1,2";	
 $sqlSyntax33 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY say DESC LIMIT 2,3";	
$getkonular31 = mysql_query($sqlSyntax31);
$getkonular32 = mysql_query($sqlSyntax32);
$getkonular33 = mysql_query($sqlSyntax33);
$row31 = mysql_fetch_array($getkonular31);
$row32 = mysql_fetch_array($getkonular32);
$row33 = mysql_fetch_array($getkonular33);
$baslik31=$row31['baslik'];
$baslik32=$row32['baslik'];
$baslik33=$row33['baslik'];
 $sqlSyntax3 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY say DESC LIMIT 3";	


$getkonular3 = mysql_query($sqlSyntax3);

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik !='$baslik31' AND baslik !='$baslik32' AND baslik !='$baslik33') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{




/*$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	*/

$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' AND (baslik !='$baslik31' AND baslik !='$baslik32' AND baslik !='$baslik33') ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	


			}
/*$sqlSyntax3 = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' GROUP BY sira ORDER BY COUNT(sira) DESC LIMIT 5";	*/


$getkonular = mysql_query($sqlSyntax);
$totalTopic = mysql_num_rows($getkonular);



//VOL 5//
//echo "<li>· <a href='bol+s%C3%B6zl%C3%BCk+compilation+vol+5-1.html' target='main' title='".'bol sözlük compilation vol 5'."'>".'bol sözlük compilation vol 5'."</a> (<font color='red'>!</font>)"; 
//echo "<hr>";
//VOL 5//

//echo "<li>· <a href='bol%20sözlük%20kezzo%20röportajı-1.html' target='main' title='".'bol sözlük kezzo röportajı'."'>".'bol sözlük kezzo röportajı'."</a> (<font color='red'>!</font>)"; 
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
			echo "<font size=2><li>· <a href='/".$link."-".$goster.".html' target='main' title='".$currenTopic['baslik']." (".$currenTopic['say'].")'>".$currenTopic['baslik']."</a></font>"; 
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
$sorgu = "SELECT * FROM konular WHERE  baslik ='$baslik2'  ";
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

		case "konudisi":
		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "konu dışı";
		$gds = "d";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 500 "); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 500 "); 
}


$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
		echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	

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


		case "soru":
		$cDay = date("d");
		$cMon = date("m");
		$cYea = date("Y");
		$topicDate = "soru";
		$gds = "s";

		if ($cDay==1)
{

$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 500 "); 
}
else
{
$getPage = mysql_query("SELECT id FROM konular WHERE statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT 0, 500"); 
}

$topicNum = mysql_num_rows($getPage);
$pageNum=ceil($topicNum/$maxTopicPage);

$totalPage = $topicNum/$maxTopicPage;
$totalPage = ceil($totalPage);
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND yil!='') AS say FROM konular WHERE  statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";	

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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";	}
	//echo $topicDate;
	echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
echo "</div>\n";

?>
<ul id="listLeftFrame">
<?php 

if ($cDay==1)
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
	echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
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


	case "tb":
			echo "<div class='pagi'>tarihte bugün</div>";
		$cYea = rand("2015", (date("Y")-1));
		$cMon = date("m");
		$cDay = date("d");
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
if ($topicDate=='gündem' or $topicDate=='konu dışı' or $topicDate=='soru')
	{
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center> ";
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
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
			  AND (gun='$cDay' OR gun='$dDay' OR gun='$eDay' OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon') AND yil='$cYea') AS say FROM konular WHERE (gun='$cDay' OR gun='$dDay'  OR gun='$eDay'  OR gun='$fDay') AND (ay='$cMon' OR ay='$dMon')
			  AND yil='$cYea' AND statu='' AND gds ='$gds' ORDER BY tarih DESC LIMIT $limitFrom,$maxTopicPage";
}
else
{
$sqlSyntax = "SELECT id,baslik,tarih, (SELECT count(id) FROM mesajlar WHERE sira=konular.id AND statu != 'silindi' AND statu!= 'wait'
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
}

	

	//echo " ";
	//echo $cDay;
	//echo " ";
	//echo $dDay;
	//echo " ";
	//echo $eDay;
	//echo " ";
	//	echo $fDay;
	//echo " ";
	//	echo $cMon;
	//echo " ";
	//echo $dMon;
	//echo " ";




	

?>
</ul>
<?php
echo "<div class='pagi'>$topicDate başlıkları: ($topicNum başlık)<br />";
if ($totalPage>1) navigatePage($list,$currentPage,$totalPage);
//REKLAM YERİ
?>
<br>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- solframe1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:197px;height:56px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="6531641306"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?
echo "</div>";


mysql_close($databaseConnection);
ob_end_flush();
?>
</div>
</body>
</html>
