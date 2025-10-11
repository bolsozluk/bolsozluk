<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?

if (!isset($_SESSION['kulYetki_S']) || ($_SESSION['kulYetki_S'] != 'admin' && $_SESSION['kulYetki_S'] != 'mod')) {
    $user = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : 'Unknown';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    error_log("Yetkisiz erişim girişimi: " . $user . " - IP: " . $ip);
    header("Location: /sozluk.php?process=refresh");
    die;
}


$cay7sebep= guvenlikKontrol($_REQUEST["cay7sebep"],"hard");
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");

$eskinick = $yazar;
$tarih  = strtotime('now');


if ($cay7sebep == "") { echo "Çaylaklık sebebi girmediniz.";}

if ($cay7sebep != "") { 


$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);


	$nick = strtolower($nick);
		
					echo "değiştiriliyor...<br>"; 

$muddet = 5;
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

	$sorgu4 = "UPDATE user SET muddet='5' WHERE nick='$eskinick'";
	mysql_query($sorgu4);

		$sorgu5 = "UPDATE user SET saycaylak=saycaylak + 1 WHERE nick='$eskinick'";
	mysql_query($sorgu5);
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR*/

 echo '<b> yazar belirlenen sürece <br> çaylak edildi. </b>';

		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
		$dakika = date("i");
		$tarih = date("YmdHi");


		$gmesaj = "`$eskinick` yönetim tarafından \"$cay7sebep\" sebebiyle 5 gün süreyle çaylak edilmiştir.";
		$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('$eskinick','otomatik işlem bildrimi','$gmesaj','bolsozluk','$tarih','2','$gun','$ay','$yil','$saat','127.0.0.1')";
	mysql_query($sorgu2);

/*
				 		


			$mesaj = "`$eskinick` yönetim tarafından \"$cay7sebep\" sebebiyle 7 gün süreyle çaylak edilmiştir. (sorumlu: $kullaniciAdi)";
			$sorgu2 = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu2 .= " VALUES ('29096','$mesaj','bolsozluk','127.0.0.1','$tarih','$gun','$ay','$yil','$saat','','$dakika','bolsozluk')";
			mysql_query($sorgu2);

				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='29096'";
				mysql_query($sorgux); 
				*/
	}



?>
