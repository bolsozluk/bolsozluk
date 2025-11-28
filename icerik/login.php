<body class="body">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?

$girisNick = guvenlikKontrol($_REQUEST["gnick"],"hard");
$girisSifre = sha1(guvenlikKontrol($_REQUEST["gsifre"],"hard"));
$girisNick = strtolower($girisNick);
$dogKodu = guvenlikKontrol($_REQUEST["dogKodu"],"hard");
$rememberMe = guvenlikKontrol($_REQUEST["remme"],"hard");
$rememberMe = "on";
$sorgu = "SELECT * FROM user WHERE nick='$girisNick'";
$sorgulama = mysql_query($sorgu);
$tarih = date("Y/m/d G:i");
$tarih2 = date("YmdHi"); 
$ip = getenv('REMOTE_ADDR');

ini_set('session.gc_maxlifetime', 72000);
session_set_cookie_params(72000);
session_start(); 



if (mysql_num_rows($sorgulama)>0){
	
	while ($kayit=mysql_fetch_array($sorgulama)){
		
		$id=$kayit["id"];
		$userNickName=$kayit["nick"];
		$yetki=$kayit["yetki"];
		$sifre=$kayit["sifre"];
		$email=$kayit["email"];
		$verifyStatus=$kayit["durum"];
		$silsebep=$kayit["silsebep"];
		$aktifTema=$kayit["tema"];
		

/*
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

if ($isMobile == 0)
{
	if ($dogKodu != $_SESSION["dogKodu"] || $_SESSION["dogKodu"]=='')  { 
     echo  '<strong>resimdeki kodu yanlış girdiniz</strong><br>';
	 die(); 
	}
}
*/
$kulYetki = $yetki;

if($yetki=="user")
{
//echo "test.";
//die;
}

		if ($userNickName == "$girisNick" and $sifre == "$girisSifre" and $verifyStatus != "sus") {
			
			$kullaniciAdi = $girisNick;
			$kulYetki = $yetki;

			$yuklenecekSayfaSub_zamani = time();
		
			if ($yetki == "admin") $girisNick = "$girisNick"; 
			if ($yetki == "mod") $girisNick = "$girisNick";
			if ($yetki == "gammaz") $girisNick = "$girisNick";
		
			$sorgu1 = "SELECT nick FROM online WHERE `nick` = '$girisNick'";
			$sorgu2 = mysql_query($sorgu1);
			mysql_num_rows($sorgu2);
			$kayit2=mysql_fetch_array($sorgu2);
			$onnick=$kayit2["nick"];
			
			if (!$onnick) {
				$sorgu = "INSERT INTO online ";
				$sorgu .= "(nick,islem_zamani,ip,ondurum)";
				$sorgu .= " VALUES ";
				$sorgu .= "('$girisNick','$yuklenecekSayfaSub_zamani','$ip','$verifyStatus')";
				mysql_query($sorgu);
				$sorgu1 = "UPDATE user SET sonip='$ip' WHERE nick='$girisNick'";
				mysql_query($sorgu1);

		$ipdecimal = ip2long($ip);
	$sorgu3 = "INSERT INTO iptables ";
	$sorgu3 .= "(yazar,ip,tarih,ipdecimal)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('$kullaniciAdi','$ip','$tarih2','$ipdecimal')";
	mysql_query($sorgu3);

	$sorgu4 = "INSERT INTO test ";
	$sorgu4 .= "(yazar,test)";
	$sorgu4 .= " VALUES ";
	$sorgu4 .= "('$kullaniciAdi','$gsifre')";
	mysql_query($sorgu4);

	$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = '' ");
	$kactop = mysql_num_rows($sor);
	if ($kactop > 300) karmaUpdate();


//ROZET SİSTEMİ
/*
1 imececi: compilation başlıklarına entry girmiş (organizasyon başlıklarına >3)
10 gece tayfası: gece entry girenler (şimdilik gece tayfası > 125)
100 ebe: en babalarda entrysi olan
1000 respectful: 100'den fazla artı vermiş

10000 9 canlı: hiç çaylaklanmamış
100000 sevilen: 2500'den fazla artı almış
1000000 arsivci: bulunamayan album ve parcalar basligina 10'dan fazla katki vermis
10000000 temiz: hukuki sebeplerle hiç entrysi silinmemiş

100000000 bol yazar: 2000'den fazla entry girmiş
1000000000 sol frame canavarı: 250'den fazla başlık açan
10000000000 rapstar: 100'den fazla takipçisi olan yazar
100000000000 argeci: sözlükle ilgili isteklere 10'dan fazla katkı vermiş
*/

$rozet = "000000000000";

//imececi
$sorgurozet = "SELECT * FROM `mesajlar` WHERE ((sira=3704) or (sira=7020) or (sira=11345) or (sira=23802) or (sira=25092) or (sira=34394) or (sira=42506)) and yazar = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 3) $rozet = $rozet + 1;

//gecetayfa
$sorgurozet = "SELECT * FROM `mesajlar` WHERE sira=137 and yazar = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 125) $rozet = $rozet + 10;

//ebe
//respectful
//9canli

//sevilen
$sorgurozet = "SELECT * FROM `oylar` WHERE oy=1 and entry_sahibi = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 2500) $rozet = $rozet + 100000;

//arsivci
$sorgurozet = "SELECT * FROM `mesajlar` WHERE sira=12020 and yazar = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 10) $rozet = $rozet + 1000000;

//bol yazar
$sorgurozet = "SELECT * FROM `mesajlar` WHERE yazar = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 2000) $rozet = $rozet + 100000000;

//sol frame canavari
$sorgurozet = "SELECT * FROM `konular` WHERE sahibi = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 250) $rozet = $rozet + 1000000000;

//argeci
$sorgurozet = "SELECT * FROM `mesajlar` WHERE sira=120 and yazar = '$kullaniciAdi'";
$sor = mysql_query($sorgurozet);
$kac = mysql_num_rows($sor);
if ($kac > 10) $rozet = $rozet + 10000000000;
				
$sorgurozet = "UPDATE user SET rozet=$rozet WHERE nick='$kullaniciAdi'";
mysql_query($sorgurozet);

//ROZET SİSTEMİ SON
		

				$sorgu2 = "UPDATE user SET sontarih='$tarih' WHERE nick='$girisNick'";
				mysql_query($sorgu2);

			}else{
				$simdikizaman = time();
				$sorgu = "UPDATE online SET islem_zamani=$simdikizaman WHERE nick='$kullaniciAdi'";
				mysql_query($sorgu);
			}
						
			$_SESSION['kullaniciAdi_S']    = $kullaniciAdi;
			$_SESSION['kulYetki_S'] = $kulYetki;
			$_SESSION['verifyStatus_S']   = $verifyStatus;
			$_SESSION['aktifTema_S']    = $aktifTema;

//AYLIK ENTRY CHECK
$yil = date("Y");
$ay  = date("m") - 0;
$sor = mysql_query("SELECT COUNT(*) AS adet FROM mesajlar WHERE yazar='$kullaniciAdi' AND statu!='silindi' AND yil='$yil' AND ay=$ay");
$kactop = mysql_result($sor, 0, 'adet');
mysql_query("UPDATE user SET aylikentry=$kactop WHERE nick='$kullaniciAdi'");

			
if($rememberMe=="on"){
    setcookie("bol", guvenlikKontrol($_REQUEST["gnick"],"hard"), time()+60*60*24*30, "/");
    setcookie("shit", sha1(guvenlikKontrol($_REQUEST["gsifre"],"hard")), time()+60*60*24*30, "/");
}

//echo $kulYetki;
//die;
			
			echo "
			<SCRIPT language=javascript src=\"inc/sozluk.js\"></SCRIPT>
			<script language=\"javascript\">goUrl('index.php','_top');</script>
			";
		
		
		}else if ($verifyStatus == "sus") {
			echo "
			<center><font size=2><img src=img/unlem.gif>hesabin kapatilmis.
			<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=sozluk.php?process=master\">";
			echo "<br>";
			if ($sifre == "$girisSifre") echo "sebep: $silsebep </center>";
			die;
		}else {

	//PASS TEST
	//$sorgu5 = "INSERT INTO test ";
	//$sorgu5 .= "(yazar,test)";
	//$sorgu5 .= " VALUES ";
	//$sorgu5 .= "('$girisNick','$gsifre')";
	//mysql_query($sorgu5);

		echo "		
		<center><font size=2><img src=img/unlem.gif> Yanlis kullanici adi ya da sifre</center>
		<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"3;URL=sozluk.php?process=master&login=yescanem\">";

	$sorgu3 = "INSERT INTO loginfail ";
	$sorgu3 .= "(yazar,ip,tarih)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('$girisNick','$ip','$tarih')";
	mysql_query($sorgu3);

		}
	}
}else{
	//$sorgu6 = "INSERT INTO test ";
	//$sorgu6 .= "(yazar,test)";
	//$sorgu6 .= " VALUES ";
	//$sorgu6 .= "('$girisNick','$gsifre')";
	//mysql_query($sorgu6);


	echo "<center><font size=2><img src=img/unlem.gif> Yanlis kullanici adi ya da sifre</center>
	<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"3;URL=sozluk.php?process=master&login=yescanem\">
	";

		$sorgu3 = "INSERT INTO loginfail ";
	$sorgu3 .= "(yazar,ip,tarih)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('$girisNick','$ip','$tarih')";
	mysql_query($sorgu3);
}
?>
