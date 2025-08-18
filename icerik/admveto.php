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

<?

$ip = getenv('REMOTE_ADDR');
$vetoc= mysql_fetch_array(mysql_query("SELECT * FROM veto WHERE `baslik`='$q'"));
$veto1=$vetoc["veto1"];
$veto2=$vetoc["veto2"];
$veto3=$vetoc["veto3"];
$baslik=$vetoc["baslik"];
$vetogun=$vetoc["gun"];
$fake=0;
$gun = date("d");

if ($vetogun != $gun)
{
$vetola2 = "UPDATE veto SET veto1='' WHERE baslik='$q'"; 
mysql_query($vetola2);
$vetola3 = "UPDATE veto SET veto2='' WHERE baslik='$q'"; 
mysql_query($vetola3);
$vetola4 = "UPDATE veto SET veto3='' WHERE baslik='$q'"; 
mysql_query($vetola4);
$vetoc= mysql_fetch_array(mysql_query("SELECT * FROM veto WHERE `baslik`='$q'"));
$veto1=$vetoc["veto1"];
$veto2=$vetoc["veto2"];
$veto3=$vetoc["veto3"];
$vetola5 = "UPDATE veto SET gun='$gun' WHERE baslik='$q'"; 
mysql_query($vetola5);
}
//echo "1:$veto1 2:$veto2 3:$veto3 ip:$ip baslik:$baslik q:$q test:$testx";


if ($kulYetki == "admin" or $kulYetki == "mod" or $kullaniciAdi == "bolsozluk") 
{
$vetola = "UPDATE veto SET veto3='$ip' WHERE baslik='$q'"; 
mysql_query($vetola);
	echo "<br>$q başlığı bir kenara yazıldı.<br>";

$vetopass = "UPDATE konular SET yil='2013' WHERE baslik='$q'"; 
mysql_query($vetopass);
	echo "<br>babalar gibi vetoladın, $q başlığı sol frameden tek hamlede düştü.<br>";
	echo "<br>ohal bitince kaldıralım bu özelliği aq orantısız güç oldu biraz.<br>";

	die;

}

//echo "<br>fake:$fake";
