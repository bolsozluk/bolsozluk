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
