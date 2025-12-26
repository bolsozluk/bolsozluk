<?
$konu = guvenlikKontrol($_REQUEST["konu"],"hard");
$aciklama = guvenlikKontrol($_REQUEST["aciklama"],"med");

if ($haber != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
if ($ok) {


$aciklama = preg_replace("/\n/","<br>",$aciklama);

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("G:i");

$konu = mysql_real_escape_string($konu);
$aciklama = mysql_real_escape_string($aciklama);

$sorgu = "INSERT INTO haberler ";
$sorgu .= "(konu,aciklama,yazar,tarih,gun,ay,yil,saat)";
$sorgu .= " VALUES ";
$sorgu .= "('$konu','$aciklama','$kullaniciAdi','$tarih','$gun','$ay','$yil','$saat')";
mysql_query($sorgu);


      $mesaj = $aciklama;
      $sorgu2 = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
      $sorgu2 .= " VALUES ('24563','$mesaj','$kullaniciAdi','127.0.0.1','$tarih','$gun','$ay','$yil','$saat','','$dakika','$kullaniciAdi')";
      mysql_query($sorgu2);

        $sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='24563'";
        mysql_query($sorgux); 


echo "$konu hakkında haber eklendi.";
}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>
</head>

<body>
<form METHOD=post action>
<table width="600" border="0">
  <tr>
    <td width="116">Konu</td>
    <td width="8">:</td>
    <td width="341"><input name="konu" size=60 type="text" id="konu"></td>
  </tr>
  <tr>
   <td>Açıklama:</td>
   <td>:</td>
   <td><textarea cols="50" rows="6" name="aciklama"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <input TYPE=hidden name=ok value=ok>
    <td><input type="submit" name="Submit" value="Ekle"></td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>