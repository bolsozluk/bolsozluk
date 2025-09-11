<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="http://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>
</head>



<?
$gkonu = guvenlikKontrol($_REQUEST["gkonu"],"hard");
//$verifyStatus = guvenlikKontrol($_REQUEST["verifyStatus"],"hard");
$gkime = guvenlikKontrol($_REQUEST["gkime"],"hard");
$gmesaj = guvenlikKontrol($_REQUEST["gmesaj"],"med");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");
$cevap = guvenlikKontrol($_REQUEST["cevap"],"hard");
$ip = getenv('REMOTE_ADDR');
$summon = guvenlikKontrol($_REQUEST["summon"],"hard");

include "mobframe.php";

$test21= mysql_query("SELECT * FROM user WHERE nick='$kullaniciAdi'");
$test22= mysql_fetch_array($test21);
$durum=$test22['durum'];


$gkime = str_replace("@", "", $gkime); //anonim silici

if (($summon > 0) && ($durum=="on"))
{



		$gmesaj = "
	$kullaniciAdi tarafından (bkz: $gkonu) başlığına değerli bilgi, yorum ve fikirlerinizi yazıya dökmek üzere çağrılmaktasınız!


	";

	$ok = 1;



}


$sorgu = "SELECT * FROM user WHERE nick='$kullaniciAdi'";
$sorgulama = mysql_query($sorgu);

if (mysql_num_rows($sorgulama)>0){
	
	while ($kayit=mysql_fetch_array($sorgulama)){
				$verifyStatus=$kayit["durum"];}}

$numsorgu = "SELECT num FROM rehber WHERE kimin='$kullaniciAdi' AND kim='$gkime' AND num='1'";
$numsorgulama = mysql_query($numsorgu);

if(mysql_num_rows($numsorgulama)>0)
{
// echo $kullaniciAdi;
	echo "engellediğiniz kişiye mesaj atamazsınız.";
die;
}

$numsorgu = "SELECT num FROM rehber WHERE kimin='$gkime' AND kim='$kullaniciAdi' AND num='1'";
$numsorgulama = mysql_query($numsorgu);

if(mysql_num_rows($numsorgulama)>0)
{
// echo mysql_num_rows($numsorgulama);
	echo "bu yazar sizden mesaj almak istemiyor.";
	die;
}

$sorset= mysql_fetch_array(mysql_query("SELECT reset,msgblok,email FROM user WHERE `nick`='$gkime'"));
$reset=$sorset["reset"];
$msgdurum=$sorset["msgblok"];
$email=$sorset["email"];
	if ($msgdurum == 1)
	{
	echo "bu yazar mesajlaşma özelliğini kapatmış."; 
		die;

}




if ($ok and $gkime and $gmesaj) {
	$gmesaj = ereg_replace("\n","<br>",$gmesaj);
	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");

	if ($gkime == "yonetim" and $kulYetki != "admin" and $kulYetki != "mod") {
		echo "Yönetim klasörünü sadece lordlar kullanabilir.Nash..";
		die;
	}

		if ($gkonu == "") {
		echo "Konu kısmı boş bırakılamaz!";
		die;
	}

	$sorgu = "SELECT nick FROM user WHERE `nick`='$gkime'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama) == 0){
		echo "$gkime adinda bir vampir yoktur.";
		die;
	}

	if ($verifyStatus=="sus" || $verifyStatus=="off") {
		echo "Yazarlığınız onaylanana kadar özel mesaj atamazsınız...";
		die;
	}

	$gmesaj = mysql_real_escape_string($gmesaj);
	$gkonu = mysql_real_escape_string($gkonu);
	$gmesaj = ereg_replace("&#039;","\'",$gmesaj);


	if ($summon > 0)
	{	

	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");

$sorgu = "SELECT * FROM privmsg WHERE kime='$gkime' AND gonderen='bol sekreter' AND gun ='$gun' AND ay ='$ay' AND yil ='$yil' ";
$sorgulama = mysql_query($sorgu);

if (mysql_num_rows($sorgulama)>2)
{
	echo "Bu kişi bugün çok çağrılmış, yarın tekrar dene.";
	die;
}

if (mysql_num_rows($sorgulama)<3)
{




	$sorgu = "INSERT INTO privmsg ";
	$sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu .= " VALUES ";
	$sorgu .= "('$gkime','$gkonu','$gmesaj','bol sekreter','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu);

echo "Çağrı iletildi.";

		if ($isMobile == 1)
			{
			echo "
			<script>location.href='left.php?list=today'</script>";
			exit;
			}

		if ($isMobile == 0)
			{
			echo "
			<script language=\"javascript\">goUrl('left.php?list=today','left');</script>
			<script language=\"javascript\">goUrl('sozluk.php?process=word&q=$gkonu','main');</script>";
			exit;
			}

}



	}
	//YÖNETİME CC ÖZELLİĞİ 
	if ($gkime == 'admin')
	{
	$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('ret1arius','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('deepsky','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('booyaka','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('if rap gets jealous','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('komutana sniper neresinden','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);
	}

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('dragunov','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);
	}

	$sorgu3 = "INSERT INTO privmsg ";
	$sorgu3 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu3 .= " VALUES ";
	$sorgu3 .= "('abra yutpa','$gkonu -admin mesajı kopyası-','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu3);
	}


	 $ipdecimal = ip2long($ip);	
	 $gkime=strtolower($gkime);

$msjcheck = mysql_query("SELECT * FROM privmsg WHERE `mesaj`='$gmesaj' and `kime`='$gkime' and `gonderen`='$kullaniciAdi' and `konu`='$gkonu' and `saat`='$saat' ORDER BY `id` desc limit 0,1");

if(mysql_num_rows($msjcheck)==0)
{
//echo "<script type='text/javascript'>alert('$mesaj. $gid. Tamam.');</script>";
}
else
{
echo "<script type='text/javascript'>alert('Böyle bir mesaj mevcut, mesajınız zaten gönderildi ya da sistemsel bir hata yaşandı.');</script>";
die;
}

	$sorgu = "INSERT INTO privmsg ";
	$sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu .= " VALUES ";
	$sorgu .= "('$gkime','$gkonu','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu);

//YAZARA MAİL GÖNDERME
// SMTP ayarlarını ekle
define('SMTP_HOST', 'mail.bolsozluk.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', "info@bolsozluk.com");
define('SMTP_PASSWORD', "1q2w3E4R*");
define('SMTP_TLS', false);

define('SMTP_SENDER_NAME', "Bol Sözlük");

// YAZARA MAİL GÖNDERME
$tarih = date("YmdHi");
$gun   = date("d");
$ay    = date("m");
$yil   = date("Y");
$saat  = date("H:i");

// Konu: $gkonu
// Mesaj: $gmesaj

$kime  = $gkime;       // Kullanıcı nick veya isim
$email = $email;       // Alıcı e-posta adresi (veritabanından geliyor olmalı)
$konu  = "bol sözlük özel mesaj bildirimi!";
$icerik = "
-------------- Mesaj Detayları --------------
Gönderen: $kullaniciAdi
Kime: $kime
Tarih: $gun/$ay/$yil $saat
-------------- Mesaj Detayları --------------

Mesajınızı https://www.bolsozluk.com/ üzerinden okuyabilirsiniz.

Gizlilik Notu: E-posta adresiniz mesaj alan/gönderen kişilerle paylaşılmamaktadır. 
Sözlüğe kayıtlı e-posta adresinize bu mail sistem tarafından otomatik olarak gönderilmektedir. 
Bu bildirimin sizinle bir ilgisi yoksa e-posta adresiniz başka biri tarafından sehven kullanıcı bilgisi olarak verilmiş olabilir, 
info@bolsozluk.com adresiyle iletişime geçerek mail adresinizi veritabanımızdan sildirebilirsiniz.
";

// PHPMailer ile gönder
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
    $mail->AddAddress($email, $kime);
    $mail->Subject = $konu;
    $mail->Body = $icerik;

    if(!$mail->Send()) {
        echo "<br><br>";
        echo '<font color="#F62217"><b>Mail Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
    } else {
        //echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';
    }

} catch (Exception $e) {
	echo "<br><br>";
    echo '<font color="#F62217"><b>Mail Gönderilirken Hata Oluştu: ' . $e->getMessage() . '</b></font>';
}


//YAZARA MAİL GÖNDERME


    
   
	// IPTABLES
	//$sorgu2 = "INSERT INTO iptables ";
	//$sorgu2 .= "(yazar,ip,tarih,ipdecimal)";
	//$sorgu2 .= " VALUES ";
	//$sorgu2 .= "('$kullaniciAdi','$ip','$tarih','$ipdecimal')";
	//mysql_query($sorgu2);
	
	mysql_query("UPDATE user SET msg=1 WHERE nick='".$gkime."'");
	
	echo "Mesajınız $gkime adlı yazara iletildi.";

	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );


	if ($isMobile == 1)
			{
			echo "
			<script>location.href='left.php?list=today'</script>";
			exit;
			}

		if ($isMobile == 0)
			{
			echo "
			<script language=\"javascript\">goUrl('left.php?list=today','left');</script>
			<script language=\"javascript\">goUrl('sozluk.php?process=panel&islem=gidenler','main');</script>";
			exit;
			}

	
}else {
if ($cevap) {

	$sorgu = "SELECT * FROM privmsg WHERE `kime` = '$kullaniciAdi' and id = '$cevap'";
	$sorgulama = mysql_query($sorgu);
	$kayit2=mysql_fetch_array($sorgulama);
	$mmesaj=$kayit2["mesaj"];
	$gonderen=$kayit2["gonderen"];
	$gkonu=$kayit2["konu"];
	$gun=$kayit2["gun"];
	$ay=$kayit2["ay"];
	$kime=$kayit2["kime"];
	$yil=$kayit2["yil"];
	$saat=$kayit2["saat"];
	$mmesaj = "

	-------------- Orjinal Mesaj --------------
	Gönderen: $gonderen
	Kime: $kime
	Tarih: $gun/$ay/$yil $saat
	Konu: $gkonu
	$mmesaj
	";
	
	if (mysql_num_rows($sorgulama) == 0){
		echo "$id size ait değil!";
		die;
	}
}

$mmesaj = ereg_replace("<br>","\n",$mmesaj);
//echo $verifyStatus;
//echo "a";
echo "<FORM name=ok method=post action=>
  <TABLE class=dash cellSpacing=0 cellPadding=3 width=\"100%\" align=center border=0>
<TBODY>
<TR>
  <TD>Kime</TD>
  <TD><INPUT class=inp maxLength=60 size=35 name=gkime value=\"$gkime\"></TD></TR>
<TR>
  <TD>Konu</TD>
  <TD><INPUT class=inp maxLength=50 size=35 name=gkonu value=\"$gkonu\"></TD></TR>
<TR>
  <TD>Mesaj</TD>";
  ?><TD><TEXTAREA name=gmesaj rows=10 cols=90><?
  if ($gmesaj > 1)
  	{
  		echo "(#$gmesaj)";
  	} 
  	echo"$mmesaj </TEXTAREA></TD></TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><INPUT type=hidden value=ok name=ok> <INPUT class=but id=kaydet type=submit value=Gönder name=ok>
  </TD></TR></TBODY></TABLE></FORM>";
  }

if (($gkonu == "bol vol 11") && ($gkime == "lord voldemort"))
  	{
  		echo "<br>";
  		echo "<br>";
  		echo "bu mesajın bir kopyası tüm sözlük yöneticilerine otomatik olarak gönderilecektir.";
  		echo "<br>";
  		echo "<br>";
  		echo "albüme katılımınızı ve hangi konularda destek verebileceğinizi albüm organizasyon başlığına da lütfen yazınız.";
  		echo "<br>";
  		echo "<br>";
  		echo"<a href=\"sozluk.php?process=word&q=sözlük+yazarlarının+emeğiyle+yapılacak+on+birinci+albüm\"> (bkz: sözlük yazarlarının emeğiyle yapılacak on birinci albüm) ";
  		echo "<br>";
  		echo "<br>";
  	}


  if($isMobile == 1)
{ 
?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bolsözlük-3 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7236998758"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?
}

?>
