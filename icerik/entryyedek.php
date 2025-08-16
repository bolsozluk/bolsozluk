<?

session_start();
ob_start();
//include "baglan.php";


if ($_REQUEST[kulYetki] or $_REQUEST[kullaniciAdi]) {
header("Location:logout.php");
die();

}
//$kullaniciAdi = $_SESSION['kullaniciAdi'];
//$kulYetki = $_SESSION['kulYetki'];
if ($kullaniciAdi == "") {
echo("lutfen farkli bir tarayici deneyiniz");
die();

}

$sorgu1 = "SELECT * FROM user WHERE `nick` = '$kullaniciAdi'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$aktifTema=$kayit2["tema"];
if (!$aktifTema)	
$aktifTema = "sozluk";
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$kullaniciAdi yedek.doc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">
<SCRIPT language=javascript src="inc/vsozluk.js"></SCRIPT>
<title>Bol Sözlük</title>

</head>

<table border=1>
<?
if ($_GET[kim]) {
	$sorgu = "SELECT * FROM mesajlar WHERE `yazar` = '$_GET[kim]' order by id asc";
}
else {
	$sorgu = "SELECT * FROM mesajlar WHERE `yazar` = '$kullaniciAdi' order by id asc";
}

$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){
//kayytlary listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################

$id=$kayit["id"];
$gid=$kayit["sira"];
$statu=$kayit["statu"];
$mesaj=$kayit["mesaj"];

$sorgus = "SELECT * FROM konular WHERE `id` = '$gid'  order by id asc";
$sorgulamas = @mysql_query($sorgus);
$kayits=@mysql_fetch_array($sorgulamas);
$baslik=$kayits["baslik"];
$say++;


echo "

  <tr>
    <td >$say. entry<br>baslik:<b>$baslik</b> <br> <br>entry no:<b>$id</b> <br> <br>entry:<b><br><small>$mesaj</b></small><br><br></td>
     </tr>
";


} 


}
echo"</table>";
ob_end_flush();
?>
