<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?
extract($_REQUEST); //bunu silebilirim
$eskinick = $kullaniciAdi;
$sorset= mysql_fetch_array(mysql_query("SELECT reset,msgblok FROM user WHERE `nick`='$kullaniciAdi'"));
$reset=$sorset["reset"];
$msgdurum=$sorset["msgblok"];



	if ($msgdurum == 1)
	{
	echo "hesabınız($eskinick) mesaj alımına açılıyor!!!"; 
	$sorgu2 = "UPDATE user SET msgblok=0 WHERE `nick`='$eskinick'";
	mysql_query($sorgu2);
}

	if ($msgdurum == 0)
	{
	echo "hesabınız($eskinick) mesaj alımına kapatılıyor!!!"; 
	$sorgu1 = "UPDATE user SET msgblok=1 WHERE `nick`='$eskinick'";
	mysql_query($sorgu1);
}


//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR

//$msg = "işlem başarılı. lütfen yeniden sözlüğe giriş yapın.";
//echo '//echo '<script type="text/javascript">alert("' . $msg . '"); 

//echo '<script type="text/javascript">window.location="http://www.bolsozluk.com/sozluk.php?process=panel&islem=cp",1000; </script>';
?>
<meta http-equiv="refresh" content="3;url=http://www.bolsozluk.com/sozluk.php?process=panel&islem=cp" />


			



