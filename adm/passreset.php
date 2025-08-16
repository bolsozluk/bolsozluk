<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?php
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
extract($_REQUEST); //bunu silebilirim

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('SMTP_HOST', 'mail.bolsozluk.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', "info@bolsozluk.com");
define('SMTP_PASSWORD', "1q2w3E4R*");
define('SMTP_TLS', false);

define('SMTP_SENDER_NAME', "Bol Sözlük");
define('ALICI_ISMI', $yazar);


?>

<?php
if (isset($_GET['ok'])) {

$sorgu = "SELECT nick,email FROM user WHERE nick='$yazar'";
$sorgulama = mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
var_dump($kayit); // BURAYI EKLE
###################### var ##############################################
$userNickName=$kayit["nick"];
$email=$kayit["email"];
define('ALICI_ADRESI',$email);
}
}	


$random_number = mt_rand(100000, 999999);
$sifre = sha1($random_number);

	if ($sifre) {
		$sorgu = "UPDATE user SET sifre = '$sifre' WHERE nick='$userNickName'";
		mysql_query($sorgu);
	}

echo "<center><b>$userNickName Apdeytıd.</center></b>";


$subject = "Yeni Şifreniz";
$message = "Merhaba,\n\nYeni şifreniz: " . $random_number . "\n\nŞifreniz otomatik olarak sistem tarafından üretilmiştir. Kolay tahmin edilebilecek bir şifre olduğu için giriş yaptıktan sonra şifrenizi değiştirmenizi öneririz.";



	if ($_POST['yazar']) {

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
			$mail->AddAddress(ALICI_ADRESI, ALICI_ISMI);
			$mail->Subject = $subject . " - " . "Bol Sözlük";
			$mail->Body = $message;

			if(!$mail->Send()) {
				echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
			} else {
				echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';
			}

		} catch (Exception $e) {
			echo '<font color="#F62217"><b>Mail Gönderilirken Hata Oluştu: ' . $e->getMessage() . '</b></font>';
		}
	} else {
		echo '<font color="#F62217"><b>Tüm alanların doldurulması zorunludur.</b></font>';
	}
}
?>

</fieldset>
</body>
</html>
