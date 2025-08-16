<?
session_start();
ob_start();
include("baglan.php");
include("fonksiyonlar.php");
vtBaglan();
kontrolEt();
$dakika = date("i");
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$knt = guvenlikKontrol($_REQUEST["knt"],"hard");
$ip = getenv('REMOTE_ADDR');

//echo "test";


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
		
	if (!$yazar) {
		echo "buna izniniz yok..";
		die();
		}
		

	$gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
			$sorgu = "UPDATE mesajlar SET kanaat = '$knt' WHERE id= '$id'";
			mysql_query($sorgu);

	

		echo $knt." oyunuz kaydedildi..";





	}

mysql_close($databaseConnection);
ob_end_flush();
?>