<?
  // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

session_start();
ob_start();
include("baglan.php");
include("fonksiyonlar.php");
vtBaglan();
kontrolEt();
extract($_REQUEST); //bunu silebilirim
$dakika = date("i");
//$kullaniciAdi = $_SESSION['kullaniciAdi_S'];

$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$oy = guvenlikKontrol($_REQUEST["oy"],"hard");
$ip = getenv('REMOTE_ADDR');

//echo "test";
	$sorgu1 = "SELECT yazar FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$yazar=$kayit2["yazar"];

	$sorgu3 = "SELECT eksiyasak FROM user WHERE `nick` = '$kullaniciAdi'";
	$sorgu4 = mysql_query($sorgu3);
	mysql_num_rows($sorgu4);
	$kayit3=mysql_fetch_array($sorgu4);
	$eksiyasak=$kayit3["eksiyasak"];
//echo $kullaniciAdi;
//echo $eksiyasak;

if ($oy=="arti") {
	$oyKayit = 1;
}else if ($oy=="eksi" and $eksiyasak=="0") {
	//echo "alert('$eksiyasak');"
		 $oyKayit = 0; 
	//EKSİ OY KAPATILDI	
    //echo "eksi oy devre disidir...";
	//die();
}else{
	die();
}

if ($id) {

	$sorgu1 = "SELECT yazar FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$yazar=$kayit2["yazar"];

	if ($kullaniciAdi == $yazar) {
		echo "<font size=1><b>kendi entrynize oy veremezsiniz.</b></font>";
		die();
	}
		
	if (!$kullaniciAdi) {
		echo "<font size=1><b>kullanici girişi yapın.</b></font>";
		die();
		} 
		
	if (!$yazar) {
		echo "<font size=1><b>buna izniniz yok.</b></font>";
		die();
		}
		
	$listele = mysql_query("SELECT entry_id FROM oylar WHERE `entry_id` = $id and `nick` = '$kullaniciAdi'");
	$say = mysql_num_rows($listele);
	
	if ($say) 

	{

	$csorgu1 = "SELECT oy FROM oylar WHERE `entry_id` = $id and `nick` = '$kullaniciAdi'";
	$csorgu2 = mysql_query($csorgu1);
	mysql_num_rows($csorgu2);
	$ckayit2=mysql_fetch_array($csorgu2);
	$coy=$ckayit2["oy"];

	if ($coy == $oyKayit){echo "<b><font size=1> zaten böyle oy kullanmışsınız. </b></font>";die();} 

	if ($coy != $oyKayit){


		
		

			 $gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
		$sorgu = "DELETE FROM oylar WHERE `entry_id` = $id and `nick` = '$kullaniciAdi'  ";	
		mysql_query($sorgu);
		$tarih = date("YmdHi");

		usleep( 560000 );
	
	$ipdecimal = ip2long($ip);
    

		echo " <font size=1><b> oy tercihiniz silindi.</b></font>";
}}

	if ($say==NULL) {
		
		usleep( 560000 );
		 $gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
		$sorgu = "INSERT INTO oylar ";
		$sorgu .= "(entry_id,nick,entry_sahibi,oy,dakika,julyen)";
		$sorgu .= " VALUES ";
		$sorgu .= "('$id','$kullaniciAdi','$yazar','$oyKayit','$dakika','$julyen')";
		mysql_query($sorgu);

		if ($oy=="arti") 
		{
			echo" <b><font size=1>artı oyunuz kaydedildi. </b></font>"; 

		}
		if ($oy=="eksi") 
		{
		echo" <b><font size=1>eksi oyunuz kaydedildi. </b></font>"; 
	
	} 


		


	}
}
mysql_close($databaseConnection);
ob_end_flush();
?>