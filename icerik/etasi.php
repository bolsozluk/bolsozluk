<?
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");

	//if ($dbyazar != $kullaniciAdi and $kulYetki != "admin" and $kulYetki != "mod")  {
		if ($kulYetki != "admin" and $kulYetki != "mod")  {
		$ip = getenv('REMOTE_ADDR');
		echo "Dikkat!<br>$ip ispitledin!";
		die;
	}
	
if (!$kullaniciAdi) {
 header("Location:sozluk.php?process=master&login=yescanim");
} else {
	extract($_REQUEST);} //bunu silebilirim
 //if ($_GET['id'] and $_GET['sira'] and !$_POST['tasi']) {
 ?>
 <form action="" method="POST">
 #<?=$id?> numaralı entry'yi #<input type="number" size="5" name="sira"> numaralı başığa taşı!<br>
 <input type="submit" name="tasi" value="tamamdir">
 </form>
 <?
 if ($_POST['tasi'] and $sira>1) {

$sorgu1 = "SELECT sira FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$tasiorji=$kayit2["sira"];

 			$sorgu = "UPDATE mesajlar SET `tasiorji` = '$tasiorji' WHERE id='$id'";
		mysql_query($sorgu);

 $degistir=mysql_query("update mesajlar set sira='$_POST[sira]' where id='$_GET[id]'");

$tarih = date("YmdHi");
 		$sorgu = "UPDATE mesajlar SET `tasiyan` = '$kullaniciAdi' WHERE id='$id'";
		mysql_query($sorgu);

		$sorgu = "UPDATE mesajlar SET `tasitarih` = '$tarih' WHERE id='$id'";
		mysql_query($sorgu);


 $no=@mysql_num_rows($degistir);
  echo "entryniz #$_POST[sira] numaralı başlığa taşınmıştır";
?>
<script language="JavaScript" type="text/javascript">
        setTimeout("window.history.go(-2)",500);
</script>
<?

 }
  if ($no>=1 or $sira<1) 
  {
  echo "sözlük sıçtı sonra tekrar deneyiniz, belki de kusur sözlükte değildir.";
  } 
   //} 
?>



