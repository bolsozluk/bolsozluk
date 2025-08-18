<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="favicon.ico" rel="shortcut Icon">
  <link href="favicon.ico" rel="icon">
  <link href="inc/sozluk.css" type="text/css" rel="stylesheet">
</head>
<body>

<?php
session_start();
ob_start();
error_reporting(E_ALL ^ E_NOTICE);

include "/icerik/firstsettings.php";
include "/icerik/baglan.php";
include "/icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();
addMeOnlines();

  $tarih = date("YmdHi");
  $gun = date("d");
  $ay = date("m");
  $yil = date("Y");
  $saat = date("H:i");
  $dakika = date("i");
  $saniye = date("s");
  $ip = getenv('REMOTE_ADDR');

$aktifTema = $_SESSION['aktifTema_S'];

if ($kullaniciAdi == "")
{

    echo "<b>bolgpt için yetkisiz kullanım.</b> ip adresiniz: $ip";
    die();
}

$sql = "SELECT * FROM mesajlar WHERE yazar = 'bolgpt' AND gun = '$gun' AND ay = '$ay' AND yil = '$yil' AND statu !='silindi' ORDER BY id";
$result = mysql_query($sql);

//echo "kontrol: ";
//echo mysql_num_rows($result);
//echo "<br><br>";

if (mysql_num_rows($result) > 2) { //normali 3
  echo "bolgpt'nin günlük çağırma limiti dolmuş. yarın tekrar dene.";
  die();
}


    //echo "<b>geçici olarak test ve bakım.";
    //die();


?>
<link href="inc/<?php echo $aktifTema; ?>.css" type="text/css" rel="stylesheet">

<?php

if (!$_SESSION['aktifTema_S']) {
  $aktifTema = "default";
}


$api_key = "HIDDEN_API_KEY";
$api_base = "https://chimeragpt.adventblocks.cc/api/v1/chat/completions";
$api_url = "https://api.openai.com/v1/chat/completions";


$prompt = "ekşi sözlük formatını biliyorsun. bu formatta, türkçe raple ilgili bir interaktif sözlük sitesinde tartışmaya oldukça müsait, hakarete varmayan ifadeler kullanarak okuru tahrik edici, sözlük formatında 1 adet konu başlığı üretmeni istiyorum. başlık kesinlikle sıradan olmamalı ve zeki bir bakış açısını yansıtmalı. başlık önerme şeklinde olmalı. türkçe rapte... diye başlığa başlama çünkü zaten burada tüm konular türkçe raple ilgili. başlıklar soru kelimesi içermemeli ve soru cümlesi şeklinde olmamalı. örneğin insanların tartışması için -türkçe rapin en iyi storytelling şarkısı hangisi- değil de -türkçe rapin en iyi storytelling şarkısı- şeklinde başlık açılmalı. kesme işaretini, iki nokta üstüste işaretini, noktalı virgül işaretini, çizgi işaretini ve tırnak işaretini başlık metninde kullanma ama türkçe harfleri kullanabilirsin. başlık maksimum 50 karakter uzunluğunda olmalı.";

//türkçe rapin en popüler isimlerini anarak bitcoin, metaverse gibi güncel trendlerl onlarla ilişkilendirip absürt başlıklar açarak sansasyon yaratmayı deneyebilirsin.

// API'ye gönderme 

$data = array( //Follow this list: ['gpt-4', 'gpt-3.5-turbo', gpt-4-1106-preview]
  "model" => "gpt-4o",
  "messages" => array(
    array("role" => "user", "content" => $prompt),
  ),
  "stream" => true,
);


//$ch = curl_init();

$ch = curl_init($api_url);

// cURL seçenekleri
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
]);

$response = curl_exec($ch);
$rawData = $response;

if ($response === false) {
  echo "<b>cURL Hatası: </b>" . curl_error($ch);
} else {

  // API yanıtı alındıktan sonra karakter kodlamasını UTF-8'e dönüştürme
  $response = mb_convert_encoding($response, 'UTF-8', 'AUTO');

  // Yanıt içeriğini parçalara bölmek için satır satır işlem yapalım
  $lines = explode("data: ", $response);
  $result = "";

  foreach ($lines as $line) {
    $json_start = strpos($line, '{');
    $json_end = strrpos($line, '}');

    if ($json_start !== false && $json_end !== false) {
      $json = substr($line, $json_start, $json_end - $json_start + 1);
      $data = json_decode($json, true);

      if (isset($data["choices"][0]["delta"]["content"])) {
        $result .= $data["choices"][0]["delta"]["content"];
      }
    }
  }

  // Boşlukları temizleyelim
  $resultBaslik = trim(preg_replace('/\s+/', ' ', $result));
  $resultBaslik = preg_replace("/[':;]+/", "", $resultBaslik);
//$resultBaslik = mysql_real_escape_string($resultBaslik);

echo $resultBaslik;
echo "<br><br>";

curl_close($ch);

}

//BAŞLIK ALINDI
//ENTRY ÜRETME


$prompt = "$resultBaslik hakkında daha önce eğitildiğin yorumlardan yola çıkarak ve ortalama ekşi sözlük yazarı üslubunu taklit ederek, eğlenceli, samimi ve akıcı bir dille; günceli sorgulayan, olumsuz yönleri varsa eleştirel olarak onu da belirten, tartışma çıkaracak derece biraz sivri bir yeni yorum yazabilir misin? ayrıca $baslik neyi refere ediyor ve literatürdeki karşılığı nedir onları da bizimle paylaş. çok ayrıntı elinde yoksa bile, bilgi havuzundan faydalan. yazacaklarının toplamı 3 cümleyi geçmesin. yazının sonunda da yazdıklarınla ilgili olduğuna emin olduğun referans bir kavramı da (bkz: referanskavram) şeklinde belirt.";

// API'ye gönderme 

$data = array( //Follow this list: ['gpt-4', 'gpt-3.5-turbo', gpt-4-1106-preview]
  "model" => "gpt-4o",
  "messages" => array(
    array("role" => "user", "content" => $prompt),
  ),
  "stream" => true,
);


//$ch = curl_init();

$ch = curl_init($api_url);

// cURL seçenekleri
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
]);

$response = curl_exec($ch);
$rawData = $response;

if ($response === false) {
  echo "<b>cURL Hatası: </b>" . curl_error($ch);
} else {

  // API yanıtı alındıktan sonra karakter kodlamasını UTF-8'e dönüştürme
  $response = mb_convert_encoding($response, 'UTF-8', 'AUTO');

  // Yanıt içeriğini parçalara bölmek için satır satır işlem yapalım
  $lines = explode("data: ", $response);
  $result = "";

  foreach ($lines as $line) {
    $json_start = strpos($line, '{');
    $json_end = strrpos($line, '}');

    if ($json_start !== false && $json_end !== false) {
      $json = substr($line, $json_start, $json_end - $json_start + 1);
      $data = json_decode($json, true);

      if (isset($data["choices"][0]["delta"]["content"])) {
        $result .= $data["choices"][0]["delta"]["content"];
      }
    }
  }

  // Boşlukları temizleyelim
  $resultEntry = trim(preg_replace('/\s+/', ' ', $result));


echo $resultEntry;

$resultEntry = mysql_real_escape_string($resultEntry);



}


curl_close($ch);




$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");
$ip = getenv('REMOTE_ADDR');

$baslik = substr($baslik, 0, 65);
$baslik = strtolower($baslik);
$mesaj = substr($mesaj, 0, 16000);
$yazar = $kullaniciAdi;

$sorgu = "SELECT id FROM konular WHERE `baslik`='$resultBaslik'";
$sorgulama = mysql_query($sorgu);

if (mysql_num_rows($sorgulama)>0){
  while ($kayit=mysql_fetch_array($sorgulama)){
    $id=$kayit["id"];
    if ($id) {
      echo "Var olm böyle bir başlık :)";
      die;
    }
  }
}

$sorgu = "INSERT INTO konular ";
$sorgu .= "(baslik,ip,tarih,gun,ay,yil,saat,gds,sahibi)";
$sorgu .= " VALUES ";
$sorgu .= "('$resultBaslik','$ip','$tarih','$gun','$ay','$yil','$saat','g','$kullaniciAdi')";
mysql_query($sorgu);

$sorgu = "SELECT id FROM konular WHERE `baslik`='$resultBaslik'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
  $id=$kayit["id"];
  if (!$id) echo "Hata var beah: ID01. Operatöre haber ver :(";
}
}

$sorgu = "INSERT INTO mesajlar ";
$sorgu .= "(sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,ilkyazar)";
$sorgu .= " VALUES ";
$sorgu .= "('$id','$resultEntry','bolgpt','$ip','$tarih','$gun','$ay','$yil','$saat','$yazar')";
mysql_query($sorgu);
// mesajida yazdik
// ekranada basiyoz

$baslik = substr($resultBaslik, 0, 65);
$baslik = strtolower($baslik);

/*

echo "
<script type=\"text/javascript\">top.left.location.href='left.php?list=today'</script>
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=sozluk.php?process=word&q=$baslik\">";
 // bitirdik IF i
*/



if ($kullaniciAdi == "booyaka")
{  
 echo "<br><br><br><small><b>---- raw data  </b> $rawData -- <b>raw data </b> <br><br></small>";
}

?>

</body>
</html>


