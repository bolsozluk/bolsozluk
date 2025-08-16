<LINK href="inc/<?echo "$aktiftema";?>.css" type=text/css rel=stylesheet>
<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?

$id = guvenlikKontrol($_REQUEST["id"],"hard");
$ybaslik = guvenlikKontrol($_REQUEST["ybaslik"],"hard");
$baslik = guvenlikKontrol($_REQUEST["baslik"],"hard");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$ipduzenlex = mysql_fetch_array(mysql_query("SELECT ip,sahibi FROM konular WHERE `id` = '$id'"));
$ipduzenle = $ipduzenlex["ip"];
$sahibi = $ipduzenlex["sahibi"];
$ip = getenv('REMOTE_ADDR');
		$gunduzenlex = mysql_fetch_array(mysql_query("SELECT gun FROM konular WHERE `id` = '$id'"));
		$gunduzenle = $gunduzenlex["gun"];
		$gun = date("d");

if ($ipduzenle == $ip and $gunduzenle == $gun and $sahibi == $kullaniciAdi )
{
$yazarduzenle="evet";
}


//BAŞLIK DUPLİCATE ENGELİ
$baslikz = mysql_fetch_array(mysql_query("SELECT * FROM konular WHERE `baslik` = '$ybaslik'"));
$baslikt = $baslikz["baslik"];
//echo "$baslikt";
//echo "$ybaslik";
if ($ybaslik == $baslikt and $ybaslik)
{
echo "böyle bir başlık zaten var.";
exit;
}

if ($kulYetki == "admin" or $kulYetki == "mod" or $yazarduzenle == "evet") 
{


if ($id and $ybaslik and $baslik and $sebep) {
	
	$ybaslik = strtolower($ybaslik);

	$sorgu = "UPDATE konular SET baslik='$ybaslik' WHERE id='$id'";
	mysql_query($sorgu);

	echo "<center>Baslik Apdeyt edildi.</center>";
	
}else {
	
if ($id) {
	$sorgu = "SELECT id,baslik FROM konular WHERE id='$id'";
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
	  <tr>
		<td>Cunkuuu</td>
		<td>:</td>
		<td><input name="sebep" type="text" id="sebep" maxlength="100"></td>
		<input type="hidden" name="id" value="<?php echo $id ?>">
	  </tr>
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
}
else
{
echo "<img src=http://th05.deviantart.net/fs71/PRE/i/2011/260/0/7/fbi_cybercrime__terminal_logon_by_w1ck3dmatt-d4a2m6z.jpg>";
echo "<center>tl, dr: olmayacak işler peşindesin...</center>";
}
?>