<?
session_start();
ob_start();
include("baglan.php");
include("fonksiyonlar.php");
vtBaglan();
kontrolEt();
$dakika = date("i");
$id = guvenlikKontrol($_REQUEST["id"],"ultra");

if ($id) {
 	if (!$kullaniciAdi) {
		echo "tekrar giris yapin..";
		die();
		} 
 
 $mtakip = mysql_query("SELECT baslik,nick FROM takip WHERE `baslik` = $id and `nick` = '$kullaniciAdi'");
	$tcheck = mysql_num_rows($mtakip);

	if ($tcheck == 0){
$sorgu = "INSERT INTO takip ";
		$sorgu .= "(baslik,nick)";
		$sorgu .= " VALUES ";
		$sorgu .= "('$id','$kullaniciAdi')";
		mysql_query($sorgu);
			echo "$id numarali basliga dair takip tercihiniz kaydedildi..";
			echo "<meta http-equiv=\"refresh\" content=\"1;url=/sozluk.php?process=word&q=sözlüğü%20takip%20ettiğini%20çaktırmamaya%20çalışan%20rapçi\" />";


}else{
	mysql_query("DELETE FROM takip WHERE `baslik`= $id AND `nick` = '$kullaniciAdi'");
	echo "<center><b>takibinizde olan bu baslik takipten cikarildi.</center></b>";
				echo "<meta http-equiv=\"refresh\" content=\"1;url=/sozluk.php?process=word&q=sözlüğü%20takip%20ettiğini%20çaktırmamaya%20çalışan%20rapçi\" />";
}

	
}
mysql_close($databaseConnection);
ob_end_flush();
?>