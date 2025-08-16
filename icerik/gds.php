<?
session_start();
ob_start();
include("baglan.php");
include("fonksiyonlar.php");
vtBaglan();
kontrolEt();
$dakika = date("i");
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$gds = guvenlikKontrol($_REQUEST["gds"],"hard");


if ($id) {

	$sorgu1 = "SELECT yazar FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$yazar=$kayit2["yazar"];
		
	if (($kullaniciAdi == "admin") or ($kullaniciAdi == "booyaka") or ($kullaniciAdi == "komutana sniper neresinden") or ($kullaniciAdi == "deepsky") or ($kullaniciAdi == "ret1arius") or ($kullaniciAdi == "if rap gets jealous") or ($kullaniciAdi == "komita cedey") or ($kullaniciAdi == "dragunov") or ($kullaniciAdi == "abra yutpa")) 
	{
	echo "yetki dogrulandi.";
		}else{
		echo "tekrar giris yapin..";
		die();
		} 
		
		 $gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
  
  mysql_query("UPDATE konular SET gds='$gds' WHERE id=$id");
		echo "baslik turu degistirildi..";
	
}
mysql_close($databaseConnection);
ob_end_flush();
?>

<script language="JavaScript" type="text/javascript">
        setTimeout("window.history.go(-1)",500);
</script>

