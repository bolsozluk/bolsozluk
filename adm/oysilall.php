<?

$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");

if ($kullanici != 1) {
	echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
	die;
}

if ($yazar and $ok) {
	$sorgu = "SELECT id, nick FROM oylar WHERE nick = '$yazar'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$id=$kayit["id"];
			$sorgu = "DELETE FROM oylar WHERE id='$id'";
			mysql_query($sorgu);
			echo "<b>$id ($yazar) </b>oyları silindi<br>";
		}
	}
}else{
	?>
	<form name="deleteUser" method="post" action="">
	<?php echo $yazar ?> nickine ait tüm oylar silenecek.<br>
	Emin misiniz ?
	  <input name="oSubmit" type="submit" value="evet <?php echo $yazar ?> nickine ait tüm oyları sil!">
	  <input name="yazar" type="hidden" id="yazar" value="<?php echo $yazar ?>">
	  <input name="ok" type="hidden" id="ok" value="ok">
	</form>
<?php } ?>