<?
session_start();
ob_start();
include("baglan.php");
include("fonksiyonlar.php");
vtBaglan();
kontrolEt();
$dakika = date("i");
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$oy = guvenlikKontrol($_REQUEST["kanal2"],"hard");

if ($oy=="track") {
	$oyKayit = "track";
	$kanal = "kanal2";
}else if ($oy=="album") { 
	$oyKayit = "album";
	$kanal = "kanal3";
}else{
	die();
}

if ($id) {

	$sorgu1 = "SELECT yazar FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$yazar=$kayit2["yazar"];
		
	if (!$kullaniciAdi) {
		echo "tekrar giris yapin..";
		die();
		} 
		
		 $gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
  
  mysql_query("UPDATE konular SET $kanal='$oyKayit' WHERE id=$id");
		echo "$id numarali basliga $kanal icin $oyKayit degeri tercihiniz kaydedildi..";



	
}
mysql_close($databaseConnection);
ob_end_flush();
?>
