<?php
ini_set('date.timezone', 'Europe/Istanbul');
ini_set('session.cookie_httponly', 1); // XSS koruması
ini_set('session.use_only_cookies', 1); // Session fixation koruması

session_set_cookie_params(
    86400,  // 1 gün
    '/',
    '',
    false,
    true
);

session_start();

// Tum Durumlari Kontrol Ediyoruz
function fonksiyonlartest() 
	{
		echo"fonksiyonlar yüklendi.<br>";
	}

function karmaUpdate()
	{

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

if ($kactop > 300) {
    $sql = "INSERT INTO karma_log (user, karma, yil, ay) 
            VALUES ('$kullaniciAdi', '$karma', '$yil', '$ay')
            ON DUPLICATE KEY UPDATE karma = VALUES(karma)";
    
    if (mysql_query($sql)) {
        error_log("Karma log başarıyla işlendi: $kullaniciAdi - $karma");
    } else {
        error_log("Karma log hatası: " . mysql_error());
    }

$user_karma_update = "UPDATE user SET karma = '$karma' WHERE nick = '$kullaniciAdi'";
mysql_query($user_karma_update);
	
}

//KARMA UPDATE SİSTEMİ
		
	}
// Otomatik Cookie'den Giriş Fonksiyonu (BENİ HATIRLA)
function otomatikLogin() {
    if (!isset($_SESSION['kullaniciAdi_S']) && isset($_COOKIE['bol']) && isset($_COOKIE['shit'])) {
        $nick = $_COOKIE['bol'];
        $sifre = $_COOKIE['shit'];
        $sorgu = "SELECT * FROM user WHERE nick='$nick'";
        $sorgulama = mysql_query($sorgu);
        if (mysql_num_rows($sorgulama)>0){
            $kayit = mysql_fetch_array($sorgulama);
            // Hem eski hem yeni hash'li şifre destekli
            if (sha1($kayit["sifre"]) == $sifre || $kayit["sifre"] == $sifre) {
                $_SESSION['kullaniciAdi_S'] = $kayit["nick"];
                $_SESSION['kulYetki_S'] = $kayit["yetki"];
                $_SESSION['verifyStatus_S'] = $kayit["durum"];
                $_SESSION['aktifTema_S'] = $kayit["tema"];
            }
        }
    }
}

function kontrolEt(){ 
	global $currentUserIP, $kullaniciAdi, $kulYetki, $verifyStatus, $verifyFloor, $aktifTema;
	global $siteStatus, $registerStyle, $yuklenecekSayfa;

	// Session ve IP'yi aliyoruz.
	$kullaniciAdi = $_SESSION['kullaniciAdi_S'];
	$kulYetki = $_SESSION['kulYetki_S'];
	$verifyStatus = $_SESSION['verifyStatus_S'];
	$aktifTema = $_SESSION['aktifTema_S']; 
	if(!$_SESSION['aktifTema_S']){
		$aktifTema="default";
	}
	$currentUserIP = $_SERVER['REMOTE_ADDR'];    

	// Basit session kontrolü
	if (!isset($_SESSION['session_check'])) {
		$_SESSION['session_check'] = true;
		$_SESSION['user_ip'] = $currentUserIP;
	}

	// Veritabanı kontrolü
	if($kullaniciAdi) {
		$mysqlSentence = "SELECT user.durum AS userverifyStatus, user.nick AS userNickName, 
						 user.msg AS userMsg, (SELECT ip FROM ipban WHERE ip = '".$currentUserIP."') 
						 AS bannedIP FROM user WHERE nick = '".mysql_real_escape_string($kullaniciAdi)."' LIMIT 1";
	} else {
		$mysqlSentence = "SELECT ip AS bannedIP FROM ipban WHERE ip='".mysql_real_escape_string($currentUserIP)."' LIMIT 1";
	}

	$mysqlQuery = mysql_fetch_array(mysql_query($mysqlSentence));
	
	$bannedIP = $mysqlQuery["bannedIP"];
	$verifyStatus = $mysqlQuery["userverifyStatus"];
	$userNickName = $mysqlQuery["userNickName"];
	$userHaveMsg = $mysqlQuery["userMsg"];
	
	$_SESSION['verifyStatus_S'] = $verifyStatus;
	
	if ($verifyStatus == "sus")
	{
		header("Location: ban.php");
		exit; 
	}
	
	if ($userHaveMsg) getPrivateMessages();
}

// Online Kisileri Kontrol Ediyor
function addMeOnlines() {
	global $kullaniciAdi;
	
	if ($kullaniciAdi) {
		$son_zaman = time() - 1800;
		mysql_query("DELETE FROM online WHERE islem_zamani < $son_zaman"); 
		$simdikizaman = time();
		
		$verifyStatus = $_SESSION['verifyStatus_S'];
		$currentUserIP = $_SERVER['REMOTE_ADDR'];
		
		$select = mysql_fetch_array(mysql_query("SELECT nick FROM online WHERE nick='$kullaniciAdi'"));
		$selectF = $select["nick"];
		
		if (!$selectF) {
			//mysql_query("INSERT INTO online (nick,islem_zamani,ip,ondurum) VALUES ('$kullaniciAdi','$simdikizaman','$currentUserIP','$verifyStatus')");
			mysql_query(" INSERT INTO online (nick, islem_zamani, ip, ondurum) VALUES ('$kullaniciAdi', '$simdikizaman', '$currentUserIP', '$verifyStatus')
			ON DUPLICATE KEY UPDATE
			islem_zamani = VALUES(islem_zamani), ip = VALUES(ip), ondurum = VALUES(ondurum)");
		} else {
			mysql_query("UPDATE online SET islem_zamani=$simdikizaman WHERE nick='$kullaniciAdi'");
		}
	}
}

// Güvenlik Kontrolü Yapiyor$mesaj = $mesaj);
function guvenlikKontrol($variable,$style){
	switch ($style) {
		case "ultra":
				$before = array("'","<",">","\"","\\","document","cookie",Chr(10),Chr(34),Chr(255));
				$after  = array("","","","","","","","","","");
				$variable = trim(intval(strip_tags($variable)));
				$variable = str_replace($before, $after, $variable);
				break;
		case "hard":
				$before = array("'","<",">","\"","\\",Chr(255));
				$after  = array("`","","","","","\\","");
				$variable = str_replace($before, $after, $variable);
				$variable = trim(strip_tags($variable));
				break;
		case "med":
				$before = array("'","<",">","\"");
				$after  = array("&#039;","&lt;","&gt;","&quot;");
				$variable = str_replace($before, $after, $variable);
				$variable = trim(strip_tags($variable));
				break;
		case "low":
				$before = array("","","","");
				$after  = array("","","","");
				$variable = strip_tags($variable);
				$variable = str_replace($before, $after, $variable);
				break;
	}
	return trim($variable);
}

function guvenlikDecode($variable) {
    // 'med' modundaki işlemlerin tam tersi
    $before = array("&#039;", "&lt;", "&gt;", "&quot;");
    $after  = array("'", "<", ">", "\"");
    $variable = str_replace($before, $after, $variable);
	$variable = str_replace(array("\n", "\r", "\\n", "\\r", "\\"), '', $variable);
    return $variable;
}

// Mesajları okuyoruz
function getPrivateMessages(){
	global $kullaniciAdi,$notice,$okunmayan;
	
	$connection = mysql_query("SELECT okundu,id FROM privmsg WHERE kime='$kullaniciAdi'");
	while ($privateMessages=mysql_fetch_array($connection)) {
		
		$okundu = $privateMessages["okundu"];
		$id = $privateMessages["id"];
		
		if ($okundu != 0) $okunmayan++;
		
		if ($okundu == 2) {
			$notice++;
			mysql_query("UPDATE privmsg SET okundu = '1' WHERE id= '$id'");
		}
	}
	mysql_query("UPDATE user SET msg=0 WHERE nick='".$kullaniciAdi."'");
}

// Sayfalama yaptırıyoruz
function navigatePage($list,$currentPage,$totalPage){
	if ($currentPage > 1) {
		$pageLink = $currentPage - 1;
		echo "<a class='but' href='left.php?list=".$list."&sayfa=".$pageLink."'><<</a>";
	}
	echo "<select class='pagis' onchange=\"jm('self',this,0);\" name='sayfa'>";
	for ($i=1;$i<=$totalPage;$i++) {
		if ($currentPage == $i) {
			echo "<option value='left.php?list=".$list."&sayfa=".$i."' selected>$i</option>";
		}else{
			echo "<option value='left.php?list=".$list."&sayfa=".$i."'>$i</option>";
		}
	}
	echo "</select> / $totalPage ";
	$pageLink = $currentPage + 1;
	if ($pageLink <= $totalPage) {
		echo "<a class='but' href='left.php?list=".$list."&sayfa=".$pageLink."'>>></a>";
	}
}

// Session güvenlik kontrolü
function checkSession() {
	// Session süre kontrolü ve yenileme
	if (!isset($_SESSION['created'])) {
		$_SESSION['created'] = time();
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
		session_regenerate_id(true);
	} else if (time() - $_SESSION['created'] > 1800) { // 30 dakika
		session_regenerate_id(true);
		$_SESSION['created'] = time();
	}

	// Session hijacking kontrolü
	if (!isset($_SESSION['user_agent']) || 
		$_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] ||
		$_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
		session_destroy();
		header("Location: logout.php");
		exit;
	}
}
?>
