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
$sira = $_REQUEST['sira'];
$baslik = $_REQUEST['baslik'];
$link = str_replace(" ","+",$baslik); 

if ($kullaniciAdi == "")
{

    echo "<b>bolgpt için yetkisiz kullanım.</b> ip adresiniz: $ip";
    die();
}

?>
<link href="inc/<?php echo $aktifTema; ?>.css" type="text/css" rel="stylesheet">
<h1 class="title"><a href="<?php echo $link; ?>-1.html"><?php echo $baslik; ?></a></h1><br><b>başlık no:</b><?php echo $sira; ?><br><br>

<?php

if (!$_SESSION['aktifTema_S']) {
  $aktifTema = "default";
}

$currentPage = guvenlikKontrol($_REQUEST["sayfa"], "ultra");
$list = guvenlikKontrol($_REQUEST["list"], "hard");

$api_key = "HIDDEN_API_KEY";
$api_base = "https://chimeragpt.adventblocks.cc/api/v1/chat/completions";
$api_url = "https://api.openai.com/v1/chat/completions";

// Veritabanından ilgili mesajları çekme
$firstEntry = "";
$secondEntry = "";
$lastEntry = "";

$entryCheck = "SELECT COUNT(*) AS count FROM mesajlar WHERE sira = '$sira'";
$entryCheckResult = mysql_query($entryCheck);
if ($entryCheckResult) {
  $rowCount = mysql_fetch_assoc($entryCheckResult)['count'];
  if ($rowCount < 2) {
    echo "<b>bolgpt için Yetersiz içerik.</b>";
    die();
  }
} else {
  echo "<b>Veritabanı hatası:</b> " . mysql_error($conn);
  die();
}


$sql = "SELECT * FROM mesajlar WHERE yazar = 'bolgpt' AND gun = '$gun' AND ay = '$ay' AND yil = '$yil' AND statu !='silindi' ORDER BY id";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 2) { //normali 2
  echo "bolgpt'nin günlük çağırma limiti dolmuş. yarın tekrar dene.";
  die();
}

if ($lastYazar == "bolgpt") 
{
  echo "Bu başlığa bolgpt yakınlarda yazmış. tekrar çağıramazsın.";
  die();
}

$sql = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id DESC LIMIT 1";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
  $row = mysql_fetch_assoc($result);
  $lastEntry = $row['mesaj'];
  $lastYazar = $row['yazar'];
}

if ($lastYazar == "bolgpt") 
{
  echo "Bu başlığa bolgpt yakınlarda yazmış. tekrar çağıramazsın.";
  die();
}


$sql = "SELECT * FROM mesajlar WHERE sira = '$sira' AND yazar = 'bolgpt' AND statu !='silindi' ORDER BY id DESC LIMIT 1";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
  $row = mysql_fetch_assoc($result);
  $lastAy = $row['ay'];
  $lastYil = $row['yil'];
}

$exyil = ($yil - 1);
if (($lastYil == $yil) || ($lastYil == $exyil))//($lastAy == $ay) && 
{
  echo "Bu başlığa bolgpt yakınlarda yazmış. tekrar çağıramazsın.";
  die();
}

if ($rowCount > 0) {
$sqlFirstEntry = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id ASC LIMIT 1";
$resultFirstEntry = mysql_query($sqlFirstEntry);
if (mysql_num_rows($resultFirstEntry) > 0) {
  $row = mysql_fetch_assoc($resultFirstEntry);
  $firstEntry = $row['mesaj'];
}
}

if ($rowCount > 2) {
$sqlSecondEntry = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id ASC LIMIT 1, 1";
$resultSecondEntry = mysql_query($sqlSecondEntry);
if (mysql_num_rows($resultSecondEntry) > 0) {
  $row = mysql_fetch_assoc($resultSecondEntry);
  $secondEntry = $row['mesaj'];
}
}

if ($rowCount > 3) {
$sqlThirdEntry = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id ASC LIMIT 2, 1";
$resultThirdEntry = mysql_query($sqlThirdEntry);
if (mysql_num_rows($resultThirdEntry) > 0) {
  $row = mysql_fetch_assoc($resultThirdEntry);
  $thirdEntry = $row['mesaj'];
}
}

if ($rowCount > 4) {
$entry4 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id ASC LIMIT 3, 1";
$result4 = mysql_query($entry4);
if (mysql_num_rows($result4) > 0) {
  $row = mysql_fetch_assoc($result4);
  $fourthEntry = $row['mesaj'];
}
}

if ($rowCount > 5) {
$entry5 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id ASC LIMIT 4, 1";
$result5 = mysql_query($entry5);
if (mysql_num_rows($result5) > 0) {
  $row = mysql_fetch_assoc($result5);
  $fifthEntry = $row['mesaj'];
}
}

if ($rowCount > 6) {
$entry6 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id DESC LIMIT 1, 1";
$result6 = mysql_query($entry6);
if (mysql_num_rows($result6) > 0) {
  $row = mysql_fetch_assoc($result6);
  $sixthEntry = $row['mesaj'];
}
}

if ($rowCount > 7) {
$entry7 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id DESC LIMIT 2, 1";
$result7 = mysql_query($entry7);
if (mysql_num_rows($result7) > 0) {
  $row = mysql_fetch_assoc($result7);
  $seventhEntry = $row['mesaj'];
}
}

if ($rowCount > 8) {
$entry8 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id DESC LIMIT 3, 1";
$result8 = mysql_query($entry8);
if (mysql_num_rows($result8) > 0) {
  $row = mysql_fetch_assoc($result8);
  $eighthEntry = $row['mesaj'];
}
}

if ($rowCount > 9) {
$entry9 = "SELECT * FROM mesajlar WHERE sira = '$sira' AND statu !='silindi' ORDER BY id DESC LIMIT 4, 1";
$result9 = mysql_query($entry9);
if (mysql_num_rows($result9) > 0) {
  $row = mysql_fetch_assoc($result9);
  $ninthEntry = $row['mesaj'];
}
}

// Prompt oluşturma
//$prompt = "$baslik hakkında daha önce $firstEntry, $secondEntry, $thirdEntry, $fourthEntry, $fifthEntry, $sixthEntry, $seventhEntry, $eighthEntry, $ninthEntry ve $lastEntry yorumlarından yola çıkarak ve başlıktaki ortalama üslubu taklit ederek, eğlenceli ve samimi bir dille; günceli sorgulayan, olumsuz yönleri varsa eleştirel olarak onu da belirten, tartışma çıkaracak derece biraz sivri bir yeni yorum yazabilir misin? ayrıca $baslik neyi refere ediyor ve literatürdeki karşılığı nedir onları da bizimle paylaş. çok ayrıntı elinde yoksa bile, bilgi havuzundan faydalan. yorumun 4 ya da 5 cümleyi geçmesin. yazının sonunda da yazdıklarınla ilgili olduğuna emin olduğun referans bir kavramı da (bkz: referanskavram) şeklinde belirt.";
$prompt = "$baslik hakkında daha önce $firstEntry, $secondEntry, $thirdEntry, $fourthEntry, $fifthEntry ve $lastEntry yorumlarını dikkate alarak, onların cümlelerini tekrar etmeden yeni bir söylem kurarak, eğlenceli, samimi ve akıcı bir dille; günceli sorgulayan, olumsuz yönleri varsa eleştirel olarak onu da belirten, tartışma çıkaracak derece biraz sivri bir yeni yorum yazabilir misin? ayrıca $baslik neyi refere ediyor ve literatürdeki karşılığı nedir onları da bizimle paylaş. çok ayrıntı elinde yoksa bile, bilgi havuzundan faydalan. yazacaklarının toplamı 3 cümleyi geçmesin. yazının sonunda da yazdıklarınla ilgili olduğuna emin olduğun referans bir kavramı da (bkz: referanskavram) şeklinde belirt.";

// API'ye gönderme 

$data = array( //Follow this list: ['gpt-4', 'gpt-3.5-turbo', gpt-4-1106-preview]
  "model" => "gpt-4o-mini",
  "messages" => array(
    array("role" => "user", "content" => $prompt),
  ),
  "stream" => true,
);


/*
$data = [
    'prompt' => $prompt,  // Değiştirebilirsiniz
    'max_tokens' => 50  // Maksimum token sayısı
];
*/

//$ch = curl_init();

$ch = curl_init($api_url);

/*
curl_setopt_array($ch, array(
  CURLOPT_URL => $api_base,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_POST => 1,
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $api_key,
  ),
));
*/

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
  $result = trim(preg_replace('/\s+/', ' ', $result));

  // Sonuç metnini gösterelim
  if (!empty($result)) {
    echo "<b>chatgpt entrysi basliga girildi:</b> " . $result;

        $mesaj = str_replace("<br>","/n/s",$result);
        $mesaj = str_replace("<br />"," /n/s",$mesaj);
        $mesaj = str_replace("<","&lt;",$mesaj); 
        $mesaj = str_replace(">","&gt;",$mesaj);
        $mesaj = preg_replace("'\@([0-9]{1,9})'","<b>@\\1</b>",$mesaj);        
        //$mesaj = preg_replace("'\(bkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\`\:]+)\)'","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
        //$mesaj = preg_replace("'\(gbkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\`\:]+)\)'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
        //$mesaj = preg_replace("'\`([\w öçşığüÖÇŞİĞÜ\-\.\´\:]+)\`'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
        //$mesaj = preg_replace("'\~([\w öçşığüÖÇŞİĞÜ]+)\~'","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);
        //$mesaj = preg_replace("/#([0-9\/\.]{3,9})/", "<a href=sozluk.php?process=eid&eid=\\1>#\\1</a>",$mesaj);     
        $mesaj = str_replace("&#039;","'",$mesaj);  
        $mesaj = mysql_real_escape_string($mesaj);

      $sorgu = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
      $sorgu .= " VALUES ('$sira','$mesaj','bolgpt','$ip','$tarih','$gun','$ay','$yil','$saat','','$dakika','$kullaniciAdi')";
      mysql_query($sorgu);

      echo "<br><br><b>Mesajlar başarıyla veritabanına eklendi.</b>";

      $sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='$sira'";
      mysql_query($sorgux); 
   } else {
    echo $result;


if ($kullaniciAdi == "booyaka")
{  
    echo "<br><br>Veritabanı log bilgisi: " . mysql_error() . "<A href=\"https://chimeragpt.adventblocks.cc/api/v1/status\">Check API Status</A>";
     /* 
      echo "<small><br><br><b>sözlükten alınan ek data:</b> $firstEntry";      
      if (!empty($secondEntry)) echo "<br><b>sözlükten alınan ek data:</b> $secondEntry";
      if (!empty($thirdEntry))echo "<br><b>sözlükten alınan ek data:</b> $thirdEntry";
      if (!empty($fourthEntry))echo "<br><b>sözlükten alınan ek data:</b> $fourthEntry";
      if (!empty($fifthEntry))echo "<br><b>sözlükten alınan ek data:</b> $fifthEntry";
      if (!empty($sixthEntry))echo "<b><br>sözlükten alınan ek data:</b> $sixthEntry";
      if (!empty($seventhEntry))echo "<b><br>sözlükten alınan ek data:</b> $seventhEntry";
      if (!empty($eighthEntry))echo "<b><br>sözlükten alınan ek data:</b> $eighthEntry";
      if (!empty($lastEntry))echo "<b><br>sözlükten alınan ek data:</b> $lastEntry<br></small>";
      */
      
}

  }
}

curl_close($ch);

if ($kullaniciAdi == "booyaka")
{  
 echo "<br><br><br><small><b>---- raw data  </b> $rawData -- <b>raw data </b> <br><br></small>";
}

?>

</body>
</html>


