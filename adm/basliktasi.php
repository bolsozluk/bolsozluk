<LINK href="inc/<?echo "$aktiftema";?>.css" type=text/css rel=stylesheet>
<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?

$bid = guvenlikKontrol($_REQUEST["bid"],"hard");
$ybaslik = guvenlikKontrol($_REQUEST["ybaslik"],"hard");
$baslik = guvenlikKontrol($_REQUEST["baslik"],"hard");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");

echo "<br>hedef:$ybaslik baslik:$baslik bid:$bid<br>";

if ($bid and $ybaslik and $baslik) {

echo "<br>hedef:$ybaslik baslik:$baslik bid:$bid<br>";
$ybaslik = preg_replace("/ş/","s",$ybaslik);
$ybaslik = preg_replace("/Ş/","S",$ybaslik);
$ybaslik = preg_replace("/ç/","c",$ybaslik);
$ybaslik = preg_replace("/Ç/","C",$ybaslik);
$ybaslik = preg_replace("/ı/","i",$ybaslik);
$ybaslik = preg_replace("/İ/","I",$ybaslik);
$ybaslik = preg_replace("/ğ/","g",$ybaslik);
$ybaslik = preg_replace("/Ğ/","G",$ybaslik);
$ybaslik = preg_replace("/ö/","o",$ybaslik);
$ybaslik = preg_replace("/Ö/","O",$ybaslik);
$ybaslik = preg_replace("/ü/","u",$ybaslik);
$ybaslik = preg_replace("/Ü/","U",$ybaslik);
$ybaslik = preg_replace("/Ö/","O",$ybaslik);

$ybaslik = strtolower($ybaslik);

if (!ereg("^[A-za-z0-9]",$ybaslik)) {
echo "girdiğiniz başlık: $baslik için --> $ybaslik";
echo "<p class=div1>Basliklarda;<br>sadece ingilizce harfler,<br>bosluk {space},<br>ve rakamlar bulunabilir.<br>Lütfen bu kurallara uygun bir baslik yazin.</p>";
exit;
}

$sorgu = "UPDATE konular SET `tasi` = '$ybaslik' WHERE id='$bid'";
mysql_query($sorgu);

$sorgu1 = "SELECT id FROM konular WHERE `baslik` = '$ybaslik'";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$yid=$kayit2["id"];

$sorgu = "SELECT id,sira FROM mesajlar WHERE sira='$bid'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$sira=$kayit["sira"];
$sorgu = "UPDATE mesajlar SET `sira` = '$yid' WHERE sira = '$bid'";
mysql_query($sorgu);
echo "$sira numaralı entry $ybaslik basligina tasindi.<br>";
}
}


echo "<br><center><b>Baslik \"$ybaslik\" basligina tasindi.</center>";
}
else {

if ($bid) {
$sorgu = "SELECT id,baslik FROM konular WHERE id='$bid'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$baslik=$kayit["baslik"];
}
}
?>
    <form method="post" action="">
  <table width="443" border="0">
    <tr>

    <td width="154">Böyleydi</td>
    <td width="10">:</td>
    <td width="265"><input name="baslik" type="text" id="baslik" value="<?php echo $baslik ?>" readonly="1"></td>
  </tr>
  <tr>
    <td>Böyle olsun </td>
    <td>:</td>
    <td><input name="ybaslik" type="text" id="ybaslik"></td>
  </tr>
    <input type=hidden name=bid value=<?php echo $bid ?>>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="gonder" type="submit" id="gonder" value="Apdeyt Et"></td>
    </tr>

</table>
</form>
    <?php
}
}

?>
