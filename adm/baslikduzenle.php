<LINK href="inc/<?echo "$aktiftema";?>.css" type=text/css rel=stylesheet>
<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?

$bid = guvenlikKontrol($_REQUEST["bid"],"hard");
$ybaslik = guvenlikKontrol($_REQUEST["ybaslik"],"hard");
$baslik = guvenlikKontrol($_REQUEST["baslik"],"hard");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");


if ($bid and $ybaslik and $baslik and $sebep) {
	
	$ybaslik = strtolower($ybaslik);


	$sorgux = "UPDATE konular SET eskibaslik='$baslik' WHERE id='$bid'";
	mysql_query($sorgux);

	$sorgu = "UPDATE konular SET baslik='$ybaslik' WHERE id='$bid'";
	mysql_query($sorgu);

	$sorgu2 = "UPDATE konular SET editsebep='$sebep' WHERE id='$bid'";
	mysql_query($sorgu2);

	$sorgu3 = "UPDATE konular SET editlendi='1' WHERE id='$bid'";
	mysql_query($sorgu3);

	$sorgu4 = "UPDATE konular SET editleyen='$kullaniciAdi' WHERE id='$bid'";
	mysql_query($sorgu4);

	    $tarih = date("YmdHi");

	    	$sorgu5 = "UPDATE konular SET edittarih='$tarih' WHERE id='$bid'";
	mysql_query($sorgu5);


	echo "<center>Baslik Apdeyt edildi.</center>";
	
}else {
	
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
	  <tr>
		<td>Cunkuuu</td>
		<td>:</td>
		<td><input name="sebep" type="text" id="sebep" maxlength="100"></td>
		<input type="hidden" name="bid" value="<?php echo $bid ?>">
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

?>
