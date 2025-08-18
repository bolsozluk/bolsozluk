	<?

//session_start();
//extract($_POST);
//extract($_GET);

$kime = "info@bolsozluk.com"; // Mesajın gitmesini istediğin e-posta adresin.
$kime1 = "ufuk@bolsozluk.com"; // Mesajın gitmesini istediğin e-posta adresin.
$kime2 = "ret1arius@bolsozluk.com"; // Mesajın gitmesini istediğin e-posta adresin.
$konu = "İhbar Var!";
$DateandTime = date("d-m-Y H:i:s");
$ip = getenv('REMOTE_ADDR');
$mesaj = "İletişim Formunuzdan Gönderilen Mesajın İçeriği Aşağıdadır:

Adı - Soyadı: $GONDERENIN_ADI_SOYADI
E-Posta Adresi: $EPOSTA_ADRESI
Yazdığı Mesajı: $GONDERENIN_MESAJI
İlgili Entry No: $MESAJIN_KONUSU
IP Adresi: $ip
";


$dogKodu = guvenlikKontrol($_REQUEST["dogKodu"],"hard");
if ($dogKodu != $_SESSION["dogKodu"] || $_SESSION["dogKodu"]=='')  { 
     echo  '<strong>resimdeki kodu yanlış girdiniz.</strong><br>';
	 die(); 
	}

if ( $_POST["GONDERENIN_ADI_SOYADI"]=="")
{
	$bos = '1';
    echo "Lütfen Adınızı ve Soyadınızı Giriniz.<BR> " . $_POST["GONDERENIN_ADI_SOYADI"];
    exit();
}

if ( $_POST["EPOSTA_ADRESI"]=="")
{
	$bos = '1';
    echo "Lütfen E-Posta Adresinizi Giriniz.<BR> " . $_POST["EPOSTA_ADRESI"];
    exit();
}

if ( $_POST["GONDERENIN_MESAJI"]=="")
{
	$bos = '1';
    echo "Lütfen Mesajınızı Giriniz.<BR> " . $_POST["GONDERENIN_MESAJI"];
    exit();
}

//$basliklar     = 'Content-type: text/html; charset=utf-8\nFrom: $ADI_SOYADI <$EPOSTA_ADRESI>\nX-Mailer: PHP/'. phpversion();    

 // 

if (!@mail($kime, $konu, $mesaj, "Content-type: text/html; charset=utf-8\nFrom: $ADI_SOYADI <$EPOSTA_ADRESI>\nX-Mailer: PHP/" . phpversion()) )
{
    echo "Şu anda sistemimizde bir sorun bulunmaktadır.<BR>" .
         "Lütfen daha sonra tekrar deneyin.<BR>";
    exit();
}

if (!@mail($kime1, $konu, $mesaj, "Content-type: text/html; charset=utf-8\nFrom: $ADI_SOYADI <$EPOSTA_ADRESI>\nX-Mailer: PHP/" . phpversion()) )
{
    echo "Şu anda sistemimizde bir sorun bulunmaktadır.<BR>" .
         "Lütfen daha sonra tekrar deneyin.<BR>";
    exit();
}

if (!@mail($kime2, $konu, $mesaj, "Content-type: text/html; charset=utf-8\nFrom: $ADI_SOYADI <$EPOSTA_ADRESI>\nX-Mailer: PHP/" . phpversion()) )
{
    echo "Şu anda sistemimizde bir sorun bulunmaktadır.<BR>" .
         "Lütfen daha sonra tekrar deneyin.<BR>";
    exit();
}


$gkime = "admin";
$gmesaj = "otomatik şikayet bildirimi";


	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");
	$ip = getenv('REMOTE_ADDR');

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$gkime','iletisim formu ihbar','$ip','FBI','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);

	$ysorgu = "INSERT INTO ispiyon ";
	$ysorgu .= "(mesaj,konu,ip,gonderen,mail,tarih,gun,ay,yil,saat)";
	$ysorgu .= " VALUES ";
	$ysorgu .= "('$GONDERENIN_MESAJI','iletisim formu ihbar','$ip','$GONDERENIN_ADI_SOYADI','$EPOSTA_ADRESI','$tarih','$gun','$ay','$yil','$saat')";

	mysql_query($ysorgu);

	mysql_query("UPDATE user SET msg=1 WHERE nick='".$gkime."'");

/*	$sorgu1 = "SELECT * FROM stat";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$oycu1=$kayit2["oycu1"];
	echo "$oycu1 <br>";
	echo "'$gkime','$MESAJIN_KONUSU','$gmesaj','şikayet','$tarih','2','$gun','$ay','$yil','$saat' <br>";*/
	echo "İhbarınız iletildi.";


// header( "location: http://www.bolsozluk.com/sozluk.php?process=word&q=bol+sozluk" ); // Mesaj gönderiltikten sonra yönlenmesini istediğin adres.

?>
