<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?
$cay3sebep= guvenlikKontrol($_REQUEST["cay3sebep"],"hard");
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");

$eskinick = $yazar;
$tarih  = strtotime('now');


if ($cay3sebep == "") { echo "Çaylaklık sebebi girmediniz.";}

if ($cay3sebep != "") { 


$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);


	$nick = strtolower($nick);
		
					echo "değiştiriliyor...<br>"; 

$muddet = 3;
$guns = 86400;
$muddet=($muddet*$guns);
$muddettarih = ($tarih + $muddet);


		$sorg = "UPDATE user SET muddettarih = '$muddettarih' WHERE nick='$eskinick'";
		mysql_query($sorg);

		$sorgu = "UPDATE user SET cezali = '1' WHERE nick='$eskinick'";
		mysql_query($sorgu);

	$sorgu2 = "UPDATE user SET durum='off' WHERE nick='$eskinick'";
	mysql_query($sorgu2);

	$sorgu3 = "UPDATE user SET infaztarih='$tarih' WHERE nick='$eskinick'";
	mysql_query($sorgu3);

	$sorgu4 = "UPDATE user SET muddet='3' WHERE nick='$eskinick'";
	mysql_query($sorgu4);
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR*/

/*
 echo '<b> yazar belirlenen sürece <br> çaylak edildi. </b>';

	 		$tarih = date("YmdHi");
		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
			$dakika = date("i");

			$mesaj = "`$eskinick` yönetim tarafından \"$cay3sebep\" sebebiyle 3 gün süreyle çaylak edilmiştir. (sorumlu: $kullaniciAdi)";
			$sorgu2 = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu2 .= " VALUES ('29096','$mesaj','bolsozluk','127.0.0.1','$tarih','$gun','$ay','$yil','$saat','','$dakika','bolsozluk')";
			mysql_query($sorgu2);

				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='29096'";
				mysql_query($sorgux); 			
				*/
}	
?>
