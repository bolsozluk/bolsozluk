<?
$esifre = sha1($_REQUEST["esifre"]);
$ysifre = $_REQUEST["ysifre"];
$ysifre2 = $_REQUEST["ysifre2"];
$okpasswd = $_REQUEST["okpasswd"];

$userNickName = $kullaniciAdi;

if (!$okpasswd) {
echo "Höyt ulan !";
}
else {
// degiskenleri ata
$sorgu = "SELECT * FROM user WHERE `nick`='$userNickName'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$sifre=$kayit["sifre"];
} //while
} // if

if ($esifre == "" or $ysifre == "" or $ysifre2 == "") {
echo "Bos alan birakmamak iktiza etmekte..";
exit;
}

if ($esifre != $sifre) {
echo "Suanki sifrenizi dogru yazarsaniz sifrenizi degistiricem ama..";
exit;
}

if ($ysifre != $ysifre2) {
echo "Alti üstü sifreyi 2 yere birden yazican onuda beceremiyosun..Gencligine yazik babacim..";
exit;
}

$ysifre = preg_replace("/ş/","s",$ysifre);
$ysifre = preg_replace("/Ş/","S",$ysifre);
$ysifre = preg_replace("/ç/","c",$ysifre);
$ysifre = preg_replace("/Ç/","C",$ysifre);
$ysifre = preg_replace("/ı/","i",$ysifre);
$ysifre = preg_replace("/İ/","I",$ysifre);
$ysifre = preg_replace("/ğ/","g",$ysifre);
$ysifre = preg_replace("/Ğ/","G",$ysifre);
$ysifre = preg_replace("/ö/","o",$ysifre);
$ysifre = preg_replace("/Ö/","O",$ysifre);
$ysifre = preg_replace("/ü/","u",$ysifre);
$ysifre = preg_replace("/Ü/","U",$ysifre);
$ysifre = preg_replace("/Ö/","O",$ysifre);



$sorgu = "SELECT nick,sifre FROM user WHERE `nick`='$userNickName'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$userNickName=$kayit["nick"];
$ysifre = sha1($ysifre);
$sorgu = "UPDATE user SET sifre='$ysifre' WHERE nick='$userNickName'";
mysql_query($sorgu);
session_destroy();
echo "Sifreniz basariyla degistirildi.Yeniden giris yapmak icin yönlendiriliyorsunuz, Please wait..
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"3;URL=logout.php\">
";
exit;
}
}
}
?>