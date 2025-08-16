<?

$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");

if ($kullanici != 1) {
	echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
	die;
}

/*if ($yazar and $ok) {
	$sorgu = "SELECT id,yazar FROM mesajlar WHERE yazar = '$yazar' and statu = 'silindi'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$id=$kayit["id"];
			$sorgu = "UPDATE mesajlar SET `statu` = '' WHERE id='$id'";
			mysql_query($sorgu);
			echo "<b>$id ($yazar) </b>geri gelenler listesine eklendi.<br>";
		}
	}
}
*/

if ($yazar and $ok) {
	$sorgu = "SELECT id,yazar,ilkyazar FROM mesajlar WHERE ilkyazar = '$yazar' and statu != 'silindi'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$id=$kayit["id"];
			$ilkyazar=$kayit["ilkyazar"];
			$sorgu = "UPDATE mesajlar SET `yazar` = '$ilkyazar' WHERE id='$id'";
			mysql_query($sorgu);
			echo "<b>$id ($yazar) </b>geri gelenler listesine eklendi.<br>";
		}
	}
}

else{
	?>
	<form name="deleteUser" method="post" action="">
	<?php echo $yazar ?> nickine ait tüm entry'lar geri getirilecek.<br>
	Emin misiniz ?
	  <input name="Submit" type="submit" value="evet <?php echo $yazar ?> nickine ait silinmemiş anonim entryleri geri getir!">
	  <input name="yazar" type="hidden" id="yazar" value="<?php echo $yazar ?>">
	  <input name="ok" type="hidden" id="ok" value="ok">
	</form>
<?php } ?>