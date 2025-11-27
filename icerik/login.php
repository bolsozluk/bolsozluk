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



//KARMA UPDATE SİSTEMİ
$kim = $kullaniciAdi;
				
//entry id çek
$kimse1=mysql_fetch_array(mysql_query("SELECT * from user where nick='$kim'"));
$kimse = $kimse1["nick"];
$saycaylak = $kimse1["saycaylak"];
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = '' ");
$kactop = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim'");
$kachamx = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `ilkyazar`='$kim'");
$kachamy = mysql_num_rows($sor);

if ($kachamx > $kachamy) $kacham = $kachamx;
if ($kachamx <= $kachamy) $kacham = $kachamy;

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = 'silindi' AND silen<>'$kim'"); //kendi sildiklerini dahil etme
$saysil = mysql_num_rows($sor);

$yil = date("Y");
$ay = date("n");

if ($ay == 12) {
    $ilkAy = 1; 
    $ilkYil = $yil;
} else {
    $ilkAy = $ay + 1;
    $ilkYil = $yil - 1;
}

$sorgu = "SELECT COUNT(*) FROM mesajlar WHERE yazar='anonim' AND ilkyazar='$kim' AND ((yil='$ilkYil' AND ay>='$ilkAy') OR (yil='$yil' AND ay<='$ay'))";
$res = mysql_query($sorgu);
$anonimsayi = mysql_result($res, 0);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '1'");
$arti = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '0'");
$eksi = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `nick`='$kim' and oy = 1");
$verarti = mysql_num_rows($sor);

// Şüpheli oy oranı tespiti
$oy_verme_orani = $verarti / max($kactop, 1);
$oy_alma_orani = $arti / max($kactop, 1);

// Kalite puanı hesaplamasından önce net oy oranını sınırla
$net_oy_orani = ($arti - $eksi) / max($kactop, 1);
$maksimum_oran = 4; // Entry başına maksimum 2 net oy

if ($net_oy_orani > $maksimum_oran) {
    $net_oy_orani = $maksimum_oran;
}

// Katsayıları ayarla
$aktivite_carpani = 0.07;         // Düşürüldü (0.12 → 0.07)
$kalite_agirlik = 0.59;           // Düşürüldü (0.65 → 0.59)
$topluluk_carpani = 25;           // Artirildi (18 → 25)
$deneyim_bonus_carpani = 0.04;    // Düşürüldü (0.07 → 0.04)
$silinen_ceza = 2.0;              // Düşürüldü (4 → 2)
$caylak_ceza = 25;                // Düşürüldü (30 → 25)
$sadakat_indirim_carpani = 0.01;  // Düşürüldü (0.02 → 0.01)
$kpi_carpani = 1.8;               // Düşürüldü (2.2 → 1.8)
$kpi_max = 1.5;                   // Düşürüldü (1.8 → 1.5)
$anon_carpan = 0.5;			      // initial (0.5)
$bot_cezasi = 1.0; 

if ($kactop > 1000) {
    $caylak_ceza = 15; // 15 puan
} else {
    $caylak_ceza = 25; // 25 puan
}

if ($kactop > 1000) {
    $anon_carpan = 0.4; 
} else if ($kactop > 500) {
    $anon_carpan = 0.45; 
} else {
    $anon_carpan = 0.5; 
}

if ($oy_verme_orani > 5 || $oy_alma_orani > 5) $bot_cezasi = 0.8; // %20 ceza
if ($oy_verme_orani > 10 || $oy_alma_orani > 10) $bot_cezasi = 0.3; // %70 ceza
if ($oy_verme_orani > 15 || $oy_alma_orani > 15) $bot_cezasi = 0.1; // %90 ceza
if ($oy_verme_orani > 30 || $oy_alma_orani > 30) $bot_cezasi = 0.01; // %99 ceza

//karma hesaplama
$karmak0 = min($net_oy_orani * 100 * $kalite_agirlik,500)*$bot_cezasi;
$karmak1 = $kactop * $aktivite_carpani;
$karmak2 = min(($verarti / max($kactop, 1)) * $topluluk_carpani, 250)*$bot_cezasi; // Maksimum sınır
$deneyim_bonus = ($kactop > 1000) ? min(($kactop - 1000) * $deneyim_bonus_carpani, 50) : 0;

$kalite_orani = $arti / max($kactop, 1);

if ($kalite_orani <= 0.3) {
    $kpi = 0.6; // Düşük kalite: %40 ceza
} elseif ($kalite_orani <= 0.7) {
    $kpi = 0.9; // Orta kalite: %10 ceza  
} elseif ($kalite_orani <= 1.2) {
    $kpi = 1.1; // İyi kalite: %10 bonus
} elseif ($kalite_orani <= 2.0) {
    $kpi = 1.3; // Çok iyi: %30 bonus
} else {
    $kpi = 1.5; // Mükemmel: %50 bonus
}

$karmaneg = $saysil * $silinen_ceza;
$caylak_ceza = $saycaylak * $caylak_ceza;
$anonimceza = $anonimsayi * $anon_carpan;

$karma = ($karmak0 + $karmak1 + $karmak2 + $deneyim_bonus - $anonimceza) * $kpi;
$karma = $karma - $karmaneg - $caylak_ceza;
$karma = round($karma);

$yil = date("Y");
$ay = date("n"); // 'n' → 1-12 arası rakam (başında sıfır yok)

$sql_check = "SELECT id FROM karma_log WHERE user='$kullaniciAdi' AND yil='$yil' AND ay='$ay'";
$result = mysql_query($sql_check);

if ($kactop >300)
{
if (mysql_num_rows($result) > 0) {
    // O ay için kayıt varsa: Güncelle
    $row = mysql_fetch_assoc($result);
    $log_id = (int) $row['id'];
    $sql_update = "UPDATE karma_log SET karma='$karma' WHERE id='$log_id'";
    mysql_query($sql_update);
} else {
    // Kayıt yoksa, yeni kaydı ekle
    $sql_insert = "INSERT INTO karma_log (user, karma, yil, ay) VALUES ('$kullaniciAdi', '$karma', '$yil', '$ay')";
    mysql_query($sql_insert);
}
}

//KARMA UPDATE SİSTEMİ


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
