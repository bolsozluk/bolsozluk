<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">
<?

$okmu = guvenlikKontrol($_REQUEST["okmu"],"hard");

$ip = getenv('REMOTE_ADDR');
$siteStatus = $_SERVER["HTTP_REFERER"];
$siteStatus = explode("/", $siteStatus);
$siteStatus = $siteStatus[2];

if ($okmu != "ok") {
	echo "Söz vermeden üye olamazsın ;)";
	exit;
}

if (!$okmu) {
	echo "Adam gibi form doldur adamin canýný sýkma !($ip logged)";
}else{
	$userNickName = guvenlikKontrol($_REQUEST["nick"],"hard");
	$email = guvenlikKontrol($_REQUEST["email"],"hard");
	$vilayet = guvenlikKontrol($_REQUEST["vilayet"],"hard");
	$sifre = guvenlikKontrol($_REQUEST["sifre"],"hard");
	$sifre2 = guvenlikKontrol($_REQUEST["sifre2"],"hard");
	$dogKodu = guvenlikKontrol($_REQUEST["dogKodu"],"hard");
		$dogKodu2 = guvenlikKontrol($_REQUEST["dogKodu2"],"hard");

	if ($dogKodu != $_SESSION["dogKodu"] || $_SESSION["dogKodu"]=='')  { 
     echo  '<strong>resimdeki kodu yanlış girdiniz</strong><br>';
	 die(); 
	}

	//	if ($dogKodu2 != $_SESSION["dogKodu2"] || $_SESSION["dogKodu2"]=='')  { 
    // echo  '<strong>olmaz</strong><br>';
//	 die(); 
	// }



	
	if ($userNickName == "" or $email == "") {
		echo "O boşlukları neyle dolduracaksın ?";
		exit;
	}

	if (!ereg ("^[' A-Za-z0-9]+$", $userNickName)) {
		echo "Nickinizde;
		<br>sadece kucuk ve ingilizce harfler,
		<br>bosluk {space},
		<br>ve rakamlar bulunabilir.
		<br>Lütfen bu kurallara uygun bir nick yazin.
		";
		die();
	}

	if (!eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $email)) {
		die ("Fake adres gireceksen de düzgün bir e-mail adresine benzet bari.");
	}

	$sorgu = "SELECT email FROM user WHERE `email` = '$email'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)){
		$email=$kayit["email"];
		echo "Bu emaili dedeler kullanıyor zaten ?!";
		die;
	}

	$sorgu1 = "SELECT * FROM ayar";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$registerStyle=$kayit2["reg"];
	
	if ($registerStyle == "off") {
		if (!$sifre or !$sifre2) {
			echo "Kurallara uygun bir şifre belirleyiniz.";
			exit;
		}
		
		if ($sifre != $sifre2) {
			echo "şifreler birbirini tutmuyor, kontrol edin.";
			exit;
		}
	}
	
	$userNickName = strtolower($userNickName);
	$email = strtolower($email);

	$sorgu = "SELECT nick,id FROM user WHERE `nick`='$userNickName'";
	$sorgulama = mysql_query($sorgu);
	
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
		$id=$kayit["id"];
			if ($id) {
			echo "başka bir kullanıcı adı seçiniz?";
			exit;
			}
		}
	}

	$tarih = date("Y/m/d G:i");
	$dt = "$day/$month/$year";
	$verifyStatus = "off";
	
		$betasifre = sha1($sifre);
		
	$yetki = "user";
	
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$regsehir = $details->city;
//echo "şehir: ";
//echo $details;
//echo "<br>";


	$sorgu = "INSERT INTO user ";
	$sorgu .= "(nick,sifre,email,durum,yetki,regip,regtarih,ilknick,sehir,reset,regsehir)";
	$sorgu .= " VALUES ";
	$sorgu .= "('$userNickName','$betasifre','$email','$verifyStatus','$yetki','$ip','$tarih','$userNickName','$vilayet',0,'$regsehir')";
	mysql_query($sorgu);
	
	$kime = $email;
	$konu = "bol sözlük'e hoşgeldiniz!";
	$icerik = "$nick\n \n
				Nickin: $userNickName \n
				Şifren de: $sifre \n
				daha ne olsun? \n\n

ancak yazarlığınız onaylanana kadar çaylak statüsünde üye olacaksınız.\n\n

çaylaklık sistemi nedir?\n\n 

(1) 13 ağustos 2016 bol sözlük çaylaklık referandumu sonucu sözlükte çaylaklık sistemi uygulanmaktadır.\n 

(2) yeni üyeler çaylak statüsü ile sözlüğe kayıt olabilmektedir. yazar alımı daima açık kalmaya devam edecek olup, belli bir sayıda entry giren çaylaklar arasından yönetim onayından geçen kişiler sözlüğe yazar olarak kabul edilecektir. \n

(3) 10 entry eşiğini aşan yazarlar çaylak onay modülü listesine otomatik olarak düşmektedir. sözlük yöneticileri bu listede yer alan çaylakların entrylerini inceleyerek yazar olarak statülerini değiştirme yahut sözlükten uzaklaştırma haklarına sahiptir. \n

(4) incelenen entrylerinizin sözlüğün ana teması olan hip hop çerçevesinde ilgili başlıklarda tanım ya da var olan tanımları bütünleyen örnekler içermesi beklenmektedir. \n

(5) gündem başlıklarına nitelikli entryler giren çaylaklar moderatörler tarafından daha erken farkedilip 10 entry limitini doldurmadan da yazarlık statüsüne hak kazanabilirler. \n

(6) 10 entryden sayıca daha çok ve çoğunlukla bilgi içerikli entryler girmeniz yazarlık onayınızı hızlandıracaktır.\n

bol bol yazman dileğiyle.

				";

	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");

	$konu = "<img src=img/unlem.gif> Hoşgeldin!";
	$admtem = "bolsozluk";
	$yazi = "
	hazırsan başlayalım.
	";

	$yazi = preg_replace("/\n/","<br>",$yazi);
	
	$sorgu = "INSERT INTO privmsg ";
	$sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$sorgu .= " VALUES ";
	$sorgu .= "('$userNickName','$konu','$yazi','$admtem','$tarih','1','$gun','$ay','$yil','$saat')";
	mysql_query($sorgu);
// SMTP ayarları (ilk sayfandakiyle aynı)
define('SMTP_HOST', 'mail.bolsozluk.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', "info@bolsozluk.com");
define('SMTP_PASSWORD', "1q2w3E4R*");
define('SMTP_TLS', false);
define('SMTP_SENDER_NAME', "Bol Sözlük");

// Gönderim bilgileri
$mailkonu = "aramıza hoşgeldin!";
$aliciEmail = $kime; // $kime değişkeni e-posta olmalı
$aliciIsim  = "";    // İstersen kullanıcı ismini buraya ekle
$icerik = $icerik;   // Mevcut içerik

require_once("smtp/PHPMailerAutoload.php");

try {
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Host = SMTP_HOST;
    $mail->Port = SMTP_PORT;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = SMTP_TLS ? 'tls' : '';
    $mail->SMTPAutoTLS = SMTP_TLS;
    $mail->CharSet = 'UTF-8';
    $mail->Username = SMTP_USERNAME; 
    $mail->Password = SMTP_PASSWORD;
    $mail->From = SMTP_USERNAME; 
    $mail->FromName = SMTP_SENDER_NAME;
    $mail->AddAddress($aliciEmail, $aliciIsim);
    $mail->Subject = $mailkonu;
    $mail->Body = $icerik;

    if(!$mail->Send()) {
        echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
    } else {
        echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';
    }

} catch (Exception $e) {
    echo '<font color="#F62217"><b>Mail Gönderilirken Hata Oluştu: ' . $e->getMessage() . '</b></font>';
}

// Mevcut yönlendirme ve mesaj
echo "
<div class=div1>
Bol bol yaz, artık bizimlesin. Şifreni unutursan da yeni hesap al bize ulaş, eski adresine yeni şifreni yollarız.
başlamadan önce (bkz: sözlükle ilgili duyurular) başlığının ilk girisini okumanı tavsiye ederiz.
</div>
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=sozluk.php?process=master&login=yescanem\">
";

}
?>