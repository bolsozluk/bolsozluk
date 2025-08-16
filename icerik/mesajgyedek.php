<?

session_start();
ob_start();

// Fonksiyonlar Basliyor...

// Baglaniyor...
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();

//$turkceayari='hilal06';
if ($_REQUEST[kulYetki] or $_REQUEST[kullaniciAdi]) {
header("Location:logout.php");
die();


}
$kullaniciAdi = $_SESSION['kullaniciAdi_S'];
$kulYetki = $_SESSION['kulYetki_S'];
if ($kullaniciAdi == "") {
fonksiyonlartest();
baglantest();
echo("lutfen farkli bir tarayici deneyiniz");
die();


}

//if ($kullaniciAdi) {
$sorgu1 = "SELECT * FROM user WHERE `nick` = '$kullaniciAdi'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$tema=$kayit2["tema"];
if (!$tema)
$tema = "sozluk";

//}

Header("Content-type: application/msword");
header("Content-Disposition: attachment;Filename=$kullaniciAdi giden mesaj yedek.doc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<SCRIPT language=javascript src="inc/vsozluk.js"></SCRIPT>

</head>
<? echo "giden mesaj yedekleri:<br>"; ?>
<table border=1>
<?
if ($_GET[kim]) {
	$sorgu = "SELECT * FROM privmsg WHERE `gonderen` = '$_GET[kim]' order by id asc";
}
else {
	$sorgu = "SELECT * FROM privmsg WHERE `gonderen` = '$kullaniciAdi' order by id asc";
}

$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){
//kayytlary listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################

$id=$kayit["id"];
$gonderen=$kayit["kime"];
$mesaj=$kayit["mesaj"];


$say++;


echo "

  <tr>
    <td >$say :<br>kime:<b>$gonderen</b> <br><br>mesaj:<b><br><small>$mesaj</b></small><br><br></td>
     </tr>
";


} 


}
echo"</table>";
ob_end_flush();
?>
