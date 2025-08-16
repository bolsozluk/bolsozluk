<?
	$tarih = date("YmdHi");
if (!$kullaniciAdi) {
 header("Location:sozluk.php?process=master&login=yescanim");
} else {
 if ($_GET['n']) {
 $sorgu=mysql_query("select * from rehber where kim='$_GET[n]' and kimin='$kullaniciAdi'");
 $kontrol=@mysql_num_rows($sorgu);
 if ($kontrol==0) {
 $ekle=mysql_query("insert into rehber values('','$_GET[n]','$kullaniciAdi','0','$tarih')");
 $no=@mysql_num_rows($ekle);
 echo "arkadaş eklendi. lütfen bekleyiniz...";
?> 
<meta http-equiv="refresh" content="0;url=sozluk.php?process=panel&islem=arkadaslarim" />
<?
  if ($no>=1) {
   echo "bol engine sıçtı. kısa süre sonra tekrar deneyiniz yada denemeyiniz ne biliyim işte";
  } else {
   header("Location:sozluk.php?process=arkadaslarim");
  }
 } else {
  echo "bu kişi zaten sizin listenizde mevcut bir daha eklenmez";
  ?> 
<meta http-equiv="refresh" content="0;url=sozluk.php?process=panel&islem=arkadaslarim" />
<?
 }
 }
}
?>
