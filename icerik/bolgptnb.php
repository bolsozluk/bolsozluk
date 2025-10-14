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

$tarih   = date("YmdHi");
$gun     = date("d");
$ay      = date("m");
$yil     = date("Y");
$saat    = date("H:i");
$dakika  = date("i");
$saniye  = date("s");
$ip      = getenv('REMOTE_ADDR');

$aktifTema = $_SESSION['aktifTema_S'];

if ($kullaniciAdi == "") {
    echo "<b>bolgpt için yetkisiz kullanım.</b> ip adresiniz: $ip";
    die();
}

// Günlük limit kontrolü
$sql = "SELECT * FROM mesajlar WHERE yazar = 'bolgpt' AND gun = '$gun' AND ay = '$ay' AND yil = '$yil' AND statu !='silindi' ORDER BY id";
$result = mysql_query($sql);

if (mysql_num_rows($result) > 5) { // normali 3
  echo "bolgpt'nin günlük çağırma limiti dolmuş. yarın tekrar dene.";
  die();
}

if (!$_SESSION['aktifTema_S']) {
  $aktifTema = "default";
}

echo '<link href="inc/'.$aktifTema.'.css" type="text/css" rel="stylesheet">';

$api_key = "HIDDEN_API_KEY";
$api_url = "https://api.x.ai/v1/chat/completions";  

$prompt = "ekşi sözlük formatını biliyorsun. bu formatta, türkçe raple ilgili bir interaktif sözlük sitesinde tartışmaya oldukça müsait, hakarete varmayan ifadeler kullanarak okuru tahrik edici, sözlük formatında 1 adet konu başlığı üretmeni istiyorum. başlık kesinlikle sıradan olmamalı ve zeki bir bakış açısını yansıtmalı. başlık önerme şeklinde olmalı. türkçe rapte... diye başlığa başlama çünkü zaten burada tüm konular türkçe raple ilgili. başlıklar soru kelimesi içermemeli ve soru cümlesi şeklinde olmamalı. örneğin insanların tartışması için -türkçe rapin en iyi storytelling şarkısı hangisi- değil de -türkçe rapin en iyi storytelling şarkısı- şeklinde başlık açılmalı. kesme işaretini, iki nokta üstüste işaretini, noktalı virgül işaretini, çizgi işaretini ve tırnak işaretini başlık metninde kullanma ama türkçe harfleri kullanabilirsin. başlık maksimum 50 karakter uzunluğunda olmalı.";

// === API'ye Gönderim (BAŞLIK ÜRETME) ===

$data = array(
  "model" => "grok-4-fast-non-reasoning",
  "messages" => array(
    array("role" => "user", "content" => $prompt)
  ),
  "stream" => false
);

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Authorization: Bearer ' . $api_key
));

$response = curl_exec($ch);

if ($response === false) {
  echo "<b>cURL Hatası (Başlık):</b> " . curl_error($ch);
  die();
}

//echo $response;
$responseData = json_decode($response, true);
$resultBaslik = trim($responseData["choices"][0]["message"]["content"]);

$resultBaslik = preg_replace("/[':;]+/", "", $resultBaslik);
$resultBaslik = trim(preg_replace('/\s+/', ' ', $resultBaslik));

if ($resultBaslik == "") {
  echo "<b>Başlık üretilemedi. Lütfen tekrar deneyin.</b>";
  die();
}

echo "<b>Başlık:</b> $resultBaslik<br><br>";

// === ENTRY ÜRETME ===

$prompt = "senin adın bolgpt. ekşi sözlük formatında olan ama hiphop temasında içerik yazılan bol sözlük'te yazan bir yazarsın. $resultBaslik hakkında  tamamen orijinal, eğlenceli, samimi ve sert yeni bir yorum yaz. yorumun küçük harflerle olsun, gerektiğinde hafif küfür veya argo kullan ama şahıslara doğrudan hakaret etme. yorum dikkat çekici ve akıcı olsun. olumsuz yönleri varsa eleştir ama anlam bütünlüğünü koru. toplam uzunluk en fazla 3 cümle olsun, noktalı virgül kullanma. eğer $baslik’in literatürde bilinen net bir karşılığı varsa paylaş, yoksa paylaşma. yorumun sonunda yazdıklarınla ilgili olduğuna emin olduğun bir kavramı (bkz: referanskavram) formatında ekle.";

$data = array(
  "model" => "grok-4-fast-non-reasoning",
  "messages" => array(
    array("role" => "user", "content" => $prompt)
  ),
  "stream" => false
);

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Authorization: Bearer ' . $api_key
));

$response = curl_exec($ch);

if ($response === false) {
  echo "<b>cURL Hatası (Entry):</b> " . curl_error($ch);
  die();
}

$responseData = json_decode($response, true);
$resultEntry = trim($responseData["choices"][0]["message"]["content"]);

if ($resultEntry == "") {
  echo "<b>Entry üretilemedi. Lütfen tekrar deneyin.</b>";
  die();
}

echo "<b>Entry:</b> $resultEntry<br><br>";

curl_close($ch);

// === VERİTABANI KAYDI ===

$resultEntry = mysql_real_escape_string($resultEntry);
$resultBaslik = mysql_real_escape_string($resultBaslik);

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");
$ip = getenv('REMOTE_ADDR');
$yazar = $kullaniciAdi;

// Aynı başlık var mı kontrol et
$sorgu = "SELECT id FROM konular WHERE baslik = '$resultBaslik'";
$sorgulama = mysql_query($sorgu);

if (mysql_num_rows($sorgulama) > 0) {
  echo "Var olm böyle bir başlık :)<br>";
  echo "baslik: $resultBaslik<br>";
  echo "entry: $resultEntry<br>";
  die();
}

// Konu ekle
$sorgu = "INSERT INTO konular (baslik, ip, tarih, gun, ay, yil, saat, gds, sahibi)
          VALUES ('$resultBaslik', '$ip', '$tarih', '$gun', '$ay', '$yil', '$saat', 'g', '$kullaniciAdi')";
mysql_query($sorgu);

// Yeni eklenen konunun ID’sini al
$sorgu = "SELECT id FROM konular WHERE baslik = '$resultBaslik' ORDER BY id DESC LIMIT 1";
$sorgulama = mysql_query($sorgu);
$id = 0;
if (mysql_num_rows($sorgulama) > 0) {
  $kayit = mysql_fetch_array($sorgulama);
  $id = $kayit["id"];
}

if (!$id) {
  echo "Hata: Başlık ID alınamadı (ID01)";
  die();
}

// Entry ekle
$sorgu = "INSERT INTO mesajlar (sira, mesaj, yazar, ip, tarih, gun, ay, yil, saat, ilkyazar)
          VALUES ('$id', '$resultEntry', 'bolgpt', '$ip', '$tarih', '$gun', '$ay', '$yil', '$saat', '$yazar')";
mysql_query($sorgu);

echo "<b>Başlık ve entry başarıyla eklendi ✅</b>";

if ($kullaniciAdi == "booyaka") {  
 echo "<br><br><small><b>---- raw data </b> $response -- <b>raw data </b><br><br></small>";
}
?>

</body>
</html>
