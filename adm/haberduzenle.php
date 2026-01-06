<?
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
$konu = guvenlikKontrol($_REQUEST["konu"],"med");
$aciklama = guvenlikKontrol($_REQUEST["aciklama"],"med");

echo "haber düzenleme modülü";

if ($haber != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}

if ($ok) {
  $sorgu = "UPDATE haberler SET konu = '$konu' WHERE id='$id'";
  mysql_query($sorgu);
  $aciklama = ereg_replace("\n","<br>",$aciklama);
  $sorgu = "UPDATE haberler SET aciklama = '$aciklama' WHERE id='$id'";
  mysql_query($sorgu);
  $sorgu = "UPDATE haberler SET yazar = '$yazar' WHERE id='$id'";
  mysql_query($sorgu);
  echo "<center>Apdeytıd.</center>";
}
else {
if ($id) {
$sorgu = "SELECT id,konu,yazar,aciklama,tarih FROM haberler WHERE `id` = '$id' ORDER BY `tarih`";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$konu=$kayit["konu"];
$aciklama=$kayit["aciklama"];
$tarih=$kayit["tarih"];
$yazar=$kayit["yazar"];
$aciklama = ereg_replace("<br>","\n",$aciklama);
echo "
<form METHOD=post action=>
<table width=\"600\" border=\"0\">
  <tr>
    <td width=\"116\">Konu</td>
    <td width=\"8\">:</td>
    <td width=\"341\"><input name=\"konu\" size=60 type=\"text\" id=\"konu\" value=\"$konu\"></td>
  </tr>
  <tr>
    <td width=\"116\">Yazar</td>
    <td width=\"8\">:</td>
    <td width=\"341\"><input name=\"yazar\" size=60 type=\"text\" id=\"yazar\" value=\"$yazar\"></td>
  </tr>

  <tr>
    <td>A&ccedil;&#305;klama</td>
    <td>:</td>
    <td><textarea name=\"aciklama\" cols=\"100\" rows=\"5\" wrap=\"VIRTUAL\" id=\"aciklama\">$aciklama</textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <input TYPE=hidden name=ok value=ok>
    <td><input type=\"submit\" name=\"Submit\" value=\"Apdeyt\"></td>
  </tr>
</table>
</form>
";
}
}
}
}

?>
