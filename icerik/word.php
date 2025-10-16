<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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


// Oturum süresini uzatmak için her sayfa yüklenmesinde cookie'yi +15 dk güncelle
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), $_COOKIE[session_name()], time() + 1500, "/");
}
    }

getPrivateMessages();
$mod = guvenlikKontrol($_REQUEST["mod"],"hard");
$aranacak = guvenlikKontrol($_REQUEST["aranacak"],"hard");
$q = guvenlikKontrol($_REQUEST["q"],"hard");
$q = strtrlower($q);
$mesaj = str_replace("'","&#039;",$mesaj);
$mesaj = guvenlikKontrol($_REQUEST["mesaj"],"med");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");
$kenar = guvenlikKontrol($_REQUEST["kenar"],"hard");
$test= mysql_query("SELECT * FROM online WHERE nick='$kullaniciAdi'");

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük, ne demek, nedir" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR" />
<meta property="og:type" content="article" />
<meta property="og:image" content="https://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<title><?echo"$q";?> - bol sözlük</title>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3Q34PEYTM8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3Q34PEYTM8');
</script>

<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>



 <style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  padding: 0;
  margin: 0;
  text-align: left;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  display: block;
  padding: 8px;
  margin: 0;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown-content::after {
  content: "";
  display: table;
  clear: both;
}

 input[type=radio]
{
  -webkit-appearance:checkbox;
}

@media print {
    html, body {
       display: none;  /* hide whole page */
    }
}

.yesil {
   background-color: #006400;
    border: yes;
    color: white;
    padding: 5px 2px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px;

vertical-align: top;
    cursor: pointer;
}

.kirmizi {
   background-color: #8B0000;
    border: yes;
    color: white;
    padding: 5px 2px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px;

vertical-align: top;
    cursor: pointer;
}
</style>

<style>



.butx {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center;
}

.butsuk {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center; margin:2px;
}

.butkir {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #900D09; text-align: center; margin:2px;
}

.butyes {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #0B6623; text-align: center; margin:2px;
}

.buttur {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #ED7014; text-align: center; margin:2px;

}

.butsar {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #E67451; text-align: center; margin:2px;
}

.butbv {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #2C041C; text-align: center; margin:2px;
}

.butgpt{
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #00A67E; text-align: center; margin:2px;

}

.divider{
    width:2px;
    height:auto;
    display:inline-block;
}

</style>

<script>
function kanaat(id,kanaat){
    ajaxReq('/icerik/kanaat.php?id='+id+'&knt='+kanaat,'oySonuc'+id);
  
}
</script>


</head>
<body>

	<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}

</script>



<?

if($isMobile == 0)
{ 

?>
<style>
li {
    font-size: 14px;
    line-height: 13pt;
}
</style>
<?

}

if($isMobile == 1)
{ 

?>
<style>
li {
    font-size: 1.1em;
    line-height: 13pt;
}
</style>
<?

}



function strtrlower($text)
{
    $search=array("Ç","İ","i̇","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","i","ı","ğ","ö","ş","ü");

    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}

//$mesajcount = 0;
$okupdate = guvenlikKontrol($_REQUEST["okupdate"],"hard");
$puankayit = guvenlikKontrol($_REQUEST["durum"],"hard");

function yt_exists($videoID) {
    $theURL = "https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoID[1]&format=json";
    $headers = get_headers($theURL);


    if(substr($headers[0], 9, 3) !== "404")    {
    	return ("<br> <iframe width=\"320\" height=\"240\" src=\"http://www.youtube.com/embed/\\$videoID[1]\" frameborder=\"0\" allowfullscreen></iframe>");
    }else
    {
    	return ("");
    }

 }
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE);

$_SESSION['discard_after'] = $now + 3600;

//DEĞİŞKEN TANIMLARI
ob_start();

vtBaglan();
kontrolEt();

$_SESSION['discard_after'] = $now + 3600;
$msg ="";
$linkt ="";
$kanal2 ="";
$kanal3 ="";
$album ="";
$track ="";
$skor ="";
$bolpuan ="";
$sukelink = "";
$babaveto ="";
$kayit ="";
$veto ="";
$takipx ="";
$istekbuton ="";
$basliksil ="";
$baslikduzenle ="";
$basliktasi ="";
$gdspanel ="<br>";
$mesajcount ="";
$yazstatu ="";
$randrek = 0;
$gorunum = 2;

//

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

//GURUR DEĞİŞKENLERİ
if($isMobile == 0) $iframe="<iframe width=\"560\" height=\"315\"";
if($isMobile == 1) $iframe="<iframe width=\"100%\" height=\"200\"";


$gururlist = [
    //necip
    1 => $iframe.'src="https://www.youtube.com/embed/STHy7LU4o-U?si=7EmKM53nztn_-6by" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //artz
    2 => $iframe.'src="https://www.youtube.com/embed/2Wnwno94VJk?si=QOBD1SiZ3YRkQvrG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //aspova
    3 => $iframe.'src="https://www.youtube.com/embed/Z-pG2uwnRQY?si=cGctwmwX6DoNAkeO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //sinci
    4 => $iframe.'src="https://www.youtube.com/embed/STHy7LU4o-U?si=7EmKM53nztn_-6by" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //kezzo
    5 => $iframe.'src="https://www.youtube.com/embed/iBVxROe1aNo?si=kHiDhbUG3S_LFk9z" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //hayki
    6 => $iframe.'src="https://www.youtube.com/embed/8TOfSjqRVjU?si=YFvVY45gOSNNuqSY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //tanerman
    7 => $iframe.'src="https://www.youtube.com/embed/iwdSGZn2kMc?si=m3LlIjzH1qtlVor_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //ados
    8 => $iframe.'src="https://www.youtube.com/embed/sT1VDRUB9yE?si=zCPVh606dTEz-Wv-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //server
    9 => $iframe.'src="https://www.youtube.com/embed/eqn39SA7I5E?si=zZFZFwET-IyuQDKe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //kayra
    10 => $iframe.'src="https://www.youtube.com/embed/qE4K1teBto8?si=dGgcNsPSUPhPnXYR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //uziaksan
    11 => $iframe.'src="https://www.youtube.com/embed/9XFrXCkoPu8?si=Qtk0QFSUv1MoOKBS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //kodes
    12 => $iframe.'src="https://www.youtube.com/embed/UwWmD9GFvFA?si=WwlDlRAzpnFZxFnL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //sprey1
    13 => $iframe.'src="https://www.youtube.com/embed/5K6FNabyad0?si=wZPPuSK5HgZxnFPm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //sprey2
    14 => $iframe.'src="https://www.youtube.com/embed/FfnjVOqR8m4?si=DMZGatiz7wIiEvMD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //nasılbaykan
    15 => $iframe.'src="https://www.youtube.com/embed/b3ERULSdS5E?si=IrQm7yWTSoFNbHsC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //fikir1
    16 => $iframe.'src="https://www.youtube.com/embed/K8MHeN8_-5M?si=TItqJdd8YUnbnXuc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //16 => $iframe.'src="https://www.youtube.com/embed/kByauJ1Mvvs?si=fqdI11yzJC_NAGpD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //fikirsıpsıfır
    17 => $iframe.'src="https://www.youtube.com/embed/K8MHeN8_-5M?si=TItqJdd8YUnbnXuc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //yeraltıd3
    18 => $iframe.'src="https://www.youtube.com/embed/12fRaQce8i4?si=Nvj_k-BU3SZiSpxA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //yeraltıkaplan
    19 => $iframe.'src="https://www.youtube.com/embed/pS1Uz_f5Bk8?si=pcjHMmN-58_DkJJZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //yeraltıkfünye
    20 => $iframe.'src="https://www.youtube.com/embed/P-38uTvb458?si=cRtPgCF7jhA4WjEM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol9fikiriz
    21 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=7BSx-KN_SRMDkwTn&amp;list=PLqw9aTgi1eS47Ja2hJGGByRUxBd0tZ0oW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol8if
    22 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=8Tz4Z9uPxVpkkWoG&amp;list=PLqw9aTgi1eS5stayLpeVEZV6dTV_CRCXP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol7kanove
    23 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=RTRIge-6S0FW4emS&amp;list=PLqw9aTgi1eS6TXkT0eofXYtzayCyBVyD-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol6track2
    24 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=Bifv8hl63IdvnCd5&amp;list=PLqw9aTgi1eS5dUSU6sXN3DqNiRBnKqG-Z" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol5
    25 =>  $iframe.'src="https://www.youtube.com/embed/videoseries?si=jJeTCoytrtZQAjHp&amp;list=PLqw9aTgi1eS7A0qEsTaF1I35Bet5q-_Rx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol4
    26 => $iframe.'src="https://www.youtube.com/embed/eqn39SA7I5E?si=zZFZFwET-IyuQDKe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //26 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=CemnUa-UZRf1iM2P&amp;list=PLqw9aTgi1eS5pbr3_cuX2byjMIPIzqHmY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol3
    27 => $iframe.'src="https://www.youtube.com/embed/eqn39SA7I5E?si=zZFZFwET-IyuQDKe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //27 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=YlaZXMPUSBNaX75A&amp;list=PLqw9aTgi1eS5-htrsW2REn9PHDaSXMTUz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol2
    28 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=Inepvxh-YAEVQMBw&amp;list=PLqw9aTgi1eS4XWJcquK82t7ecI0zIoE3n" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //vol1
    29 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=8k7REk591hBDQgVI&amp;list=PLqw9aTgi1eS7nDfSTa3434gTMYQsnGz-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //impalaröp
    30 => $iframe.'src="https://www.youtube.com/embed/x236SqHecA4?si=NUPnt1qR8r4914QH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //boltrack1
    31 => $iframe.'src="https://www.youtube.com/embed/AOkvuPQ2y3c?si=-2av5_JkYjigrcP6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //eskiceket
    32 => $iframe.'src="https://www.youtube.com/embed/videoseries?si=uslEXk9lJtnyFnNl&amp;list=PLqw9aTgi1eS4Hh9ReQPtq7FTstY5LKq6K" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //mirac
    33 => $iframe.'src="https://www.youtube.com/embed/JKoTKIGykIk?si=2bxMAw1l7m8yWHX7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //dipnot
    34 => $iframe.'src="https://www.youtube.com/embed/ZOsviKZjUFk?si=F355CjVORKfXYv4W" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //jefe
    35 => $iframe.'src="https://www.youtube.com/embed/0TU5C_OHLuY?si=QZSt5-3Bpklr5CEa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
    //şam
    36 => $iframe.'src="https://www.youtube.com/embed/ATalUfIuXqE?si=OJvZX3Hlkuq1Zd0h" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
	//comp12
	37 => $iframe.'src="https://www.youtube.com/embed/si4HFWYxiHM?si=MLZXAMpi6fKLILvN" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'

];

$randomgurur = rand(1, 37);


//eol size 

//Mobile extension

include "mobframe.php";



if(($isMobile == 1) && ($kullaniciAdi == ""))
{ 
?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>

<?
}

$caylaksin= mysql_fetch_array(mysql_query("SELECT durum FROM user WHERE `nick`='$kullaniciAdi'"));
$yazarlik= $caylaksin["durum"];
//if ($yazarlik = 'kurumsal'){
	//$yazarlik ='on';
//}
$flood= mysql_fetch_array(mysql_query("SELECT flood FROM user WHERE `nick`='$kullaniciAdi'"));
$flad=$flood["flood"];
if ($flad >=4 AND $flad <7)
{
echo "<center><b>sözlüğe bu kadar yüklenmeyiniz, makina ısınıyor. <br>(uyarıdan kurtulmak için daha yavaş oylayın/entry girin)</b></center>";

}

if ($flad >= 6)
{
    $xgkime = "admin";


    $tarih = date("YmdHi");
    $gun = date("d");
    $ay = date("m");
    $yil = date("Y");
    $saat = date("H:i");
    $ip = getenv('REMOTE_ADDR');

    $xsorgu = "INSERT INTO privmsg ";
    $xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
    $xsorgu .= " VALUES ";
    $xsorgu .= "('$xgkime','$kullaniciAdi','$ip','FBI','$tarih','2','$gun','$ay','$yil','$saat')";
    mysql_query($xsorgu);

    mysql_query("UPDATE user SET msg=1 WHERE nick='".$gkime."'");

$sorguban = "INSERT INTO ipban ";
$sorguban .= "(ip)";
$sorguban .= " VALUES ";
$sorguban .= "('$ip')";
mysql_query($sorguban);
$msg = "UYARI: sözlüğün oto-koruma sistemi devreye girdi.";
echo '<script type="text/javascript">alert("' . $msg . '"); window.location="/logout.php"; </script>';
header ("Location: logout.php");
die;
exit;
}

$dakika = date("i");
$saniye = date("s");
if ($dakika==27 and $kullaniciAdi and $saniye>0 and $saniye<10)
{
	include "icerik/statgen.php";
}

if ($dakika==08 and $kullaniciAdi and $saniye>0 and $saniye<15)
{
	include "icerik/caylakmdt.php";
}

if ($dakika==12 and $kullaniciAdi and $saniye>0 and $saniye<15)
{
	include "icerik/caylakmdt.php";
}

if ($dakika==35 and $kullaniciAdi and $saniye>0 and $saniye<15)
{
	include "icerik/caylakmdt.php";
}

$link = str_replace(" ","+",$q); 
$link = str_replace(" ","+",$baslik);
$link = str_replace("%20","+",$baslik);

$tid1= mysql_fetch_array(mysql_query("SELECT id FROM konular WHERE `baslik`='$q'"));
$tid= $tid1["id"];
$linkt = $tid;

?>
<div id="dom-target" style="display:none">https://www.bolsozluk.com/share.php?tid=<? echo $linkt; ?></div>


<script>
function linkb(){
var div = document.getElementById("dom-target");
var myData = div.textContent;
window.prompt("sayfa linki:",myData);
}
</script>



<?
						if($isMobile != 1)
{ 

$twtb = "
<a href=\"https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.bolsozluk.com%2Fshare.php?tid=$linkt&via=bolsozluk&text=$q\" title=\"Başlığı Twitle\" target=%22%5Fblank%22><img src=/img/twitter.png width=30 height=30></a></font>
";

//$twtb = "";

//https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.bolsozluk.com%2Fb%2Frdkyszn%2Bfreestyle%2F&via=bolsozluk&text=rdkyszn%20freestyle

$fbb = "
<a href=\"http://www.facebook.com/sharer.php?u=/share.php%3Fq=$link&p[title]=$q\" title=\"Başlığı Paylaş\" target=%22%5Fblank%22> <img src=/img/fb.png width=30 height=30></a></font>
";

$linkb = "
<a href=\"#\" onclick=\"linkb()\"><img src=/img/www.png width=30 title=\"Sayfa Linki\"></a></font>";
}
$test2= mysql_fetch_array($test);
$test3=$test2['ondurum'];

$test21= mysql_query("SELECT * FROM user WHERE nick='$kullaniciAdi'");
$test22= mysql_fetch_array($test21);
$durum=$test22['durum'];
//echo $durum;echo $durum;echo $durum;echo $durum;echo $durum;echo $durum;


//BAŞLIKTA TIRNAK
$q = str_replace("°"," ",$q);
$q = str_replace("�"," ",$q);
$q = trim(preg_replace("'[^0-9a-zA-ZüÜşŞiİöÖçÇığĞ\'\.\´\`\-\:\& \s]'", "", $q)); //ORJİ
$sayfa = guvenlikKontrol($_REQUEST["sayfa"],"ultra");
$mesaj = mysql_real_escape_string($mesaj);
$mod = guvenlikKontrol($_REQUEST["mod"],"hard");
$aranacak = guvenlikKontrol($_REQUEST["aranacak"],"hard");

$kac = count($q);
$q = substr($q, 0, 65);
$mesaj = substr($mesaj, 0, 2000);

$q = str_replace("İ","i",$q);
$mesaj = str_replace("İ","i",$mesaj);
$mesaj = str_replace("<","&lt;",$mesaj); 
$mesaj = str_replace(">","&gt;",$mesaj);
$mesaj = nl2br($mesaj);
	$today = date("Y-m-d");
	    $date1 = "2017-04-04";
	    $date2 = "2017-03-27";
	    $date3 = "2017-04-10";


if ($kullaniciAdi) {

	if ($okunmayan) {
		echo "<p align=right><a title=\"$okunmayan okunmayan hede var\" href=/sozluk.php?process=privmsg><img src=img/new.gif alt=\"$okunmayan okunmayan hede var\"> ($okunmayan) yeni mesaj var.</a></p>";
	}

	if ($notice)
		echo "<SCRIPT>alert('$notice okunmayan mesajınız var.');</SCRIPT>";
	}

$q = strtrlower($q);
//echo $q;echo $q;echo $q;echo $q;echo $q;echo $q;
$sorgu = "SELECT * FROM konular WHERE LOWER(konular.baslik) LIKE '$q' COLLATE utf8_bin";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)==0){
$sorgu = "SELECT * FROM konular WHERE LOWER(konular.baslik) LIKE '$q'";}


$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
	while ($kayit=mysql_fetch_array($sorgulama)){
		$gid=$kayit["id"];
		$tasi=$kayit["tasi"];
		$baslik=$kayit["baslik"];

    if ($baslik=="esrar içerken dinlenebilecek rap parçalar") { echo "<img src=https://isbh.tmgrup.com.tr/sbh/2022/02/07/650x344/calismalar-neticesinde-11-kilo-488-gram-eroin-4-ki-1644213622184.jpg width=\"100%\">"; die(); } 


		$statu=$kayit["statu"];
		$gds=$kayit["gds"];
		$sahibi=$kayit["sahibi"];

		if ($statu == "silindi") {
			if ($kulYetki != "admin" and $kulYetki != "mod") {
				echo "<div class=dash><center><b><img src=img/unlem.gif> Bu baslik ucurulmus!";
				die;
			}	
			echo "<div class=dash><center><b><img src=img/unlem.gif> Bu baslik ucurulmus! Yönetici olduğunuz için bu başlığı görüyorsunuz.</a></center>";
		}
	}
}
$yazar = $kullaniciAdi;
$link = str_replace(" ","+",$baslik);
$link = str_replace("%20","+",$baslik);

?>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@bolsozluk">
<meta name="twitter:creator" content="@bolsozluk">
<meta name="twitter:title" content="<?echo $baslik;?>">
<meta name="twitter:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük.">
<meta name="twitter:image" content="https://i.imgur.com/Osi2LRo.png">

<?

$sorgu = "SELECT id,tarih,baslik FROM konular WHERE `id`=$gid";
$sorgulama = @mysql_query($sorgu);

				if ($kullaniciAdi) {
        $benlink = "<b><input type='button' onclick=\"location.href='sozluk.php?process=word&q=$q&mod=ben';\" value='benimki' class='butx'></b>";
						if($isMobile != 1)
{ 
					$veto = "<a id=\"veto\" href=\"sozluk.php?process=veto&q=$q&testx=$test3\" title=veto&nbsp;et> <img src=/img/veto.png width=30></a>";
					}
}
if (@mysql_num_rows($sorgulama)>0){

	while ($kayit=@mysql_fetch_array($sorgulama)){
		$ip = getenv('REMOTE_ADDR');
		$gun = date("d");
		$id=$kayit["id"];
		$konuid=$kayit["id"];
		$baslik=$kayit["baslik"];
		$tarih=$kayit["tarih"];
		$hit2 = mysql_fetch_array(mysql_query("SELECT hit FROM konular WHERE `id` = '$konuid'"));
		$hit3 = $hit2["hit"];
		$ipduzenlex = mysql_fetch_array(mysql_query("SELECT ip FROM konular WHERE `id` = '$konuid'"));
		$ipduzenle = $ipduzenlex["ip"];
		$gunduzenlex = mysql_fetch_array(mysql_query("SELECT gun FROM konular WHERE `id` = '$konuid'"));
		$gunduzenle = $gunduzenlex["gun"];



		if ($kulYetki == "admin" or $kulYetki == "mod") {
			$baslikduzenle = "<input type='button' onclick=\"location.href='/sozluk.php?process=adm&islem=baslikduzenle&bid=$id';\" value='edit' class='butx'>";
			//$baslikduzenle = "<a class=link> - </a><a class=div href=/sozluk.php?process=adm&islem=baslikduzenle&bid=$id><font color=green size=2 face=verdana>[düzenle]</font></a>";
		$gdspanel ="<input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=g';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=d';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=l';\" value='lobi' class='butx'>";
		}

			

		if ($kulYetki == "admin" or $kulYetki == "mod") {
			$basliksil = "<input type='button' onclick=\"location.href='/sozluk.php?process=adm&islem=baslikoldur&bid=$id';\" value='sil' class='butx'>";
			//$basliksil = "<br><a class=div href=/sozluk.php?process=adm&islem=baslikoldur&bid=$id><font color=red size=2 face=verdana>[sil]</font></a>";
		}
			
		if ($ipduzenle == $ip and $gunduzenle == $gun and $kulYetki != "admin" ) {
		//$baslikduzenle = "<a class=link></a><a class=div href=/sozluk.php?process=baslikduzenle&id=$id><font color=green size=2 face=verdana>[düzenle]</font></a>";
			$baslikduzenle = "";
		}
				
		if ($kulYetki == "admin" or $kulYetki == "mod"){
			$basliktasi = "<input type='button' onclick=\"location.href='/sozluk.php?process=adm&islem=basliktasi&bid=$id';\" value='taşı' class='butx'>";
      $babaveto = "<input type='button' onclick=\"location.href='sozluk.php?process=admveto&q=$q&testx=$test3';\" value='babaveto' class='butbv'>";
			//$basliktasi = "<a class=link> - </a> <a class=div href=/sozluk.php?process=adm&islem=basliktasi&bid=$id><font size=2 face=verdana>[taşı] - </font></a>";
		}

		
		if ($kulYetki == "admin" or $kulYetki == "mod" or $kullaniciAdi == "bolsozluk" or $kullaniciAdi == "fikirsiz" or $kullaniciAdi != "")  {		
    //$bolgpt = "<input type='button' onclick=\"location.href='sozluk.php?process=bolgpt&baslik=$q&sira=$konuid';\" value='bolgpt' class='butgpt'>";
		//$babaveto = "<a class=link> - </a> <a class=div href=\"sozluk.php?process=admveto&q=$q&testx=$test3\"><font color=purple size=2 face=verdana>[babaveto] </font></a>";
		}

//if ($kullaniciAdi == "booyaka")  {
$sukelink = "<b><input type='button' onclick=\"location.href='sozluk.php?process=word&q=$q&mod=sukela';\" value='şükela' class='butx'></b>";

//}
			/*$sorgu1r= "SELECT reytingci FROM user WHERE `nick` = '$yazar'";
				$sorgur2 = mysql_query($sorgu1r);
				mysql_num_rows($sorgur2);
				$kayitr2=mysql_fetch_array($sorgur2);
				$reytingci=$kayitr2["reytingci"];*/

					/*if ($reytingci == "1")  {
		$track = "<a class=link></a> <a class=div href=\"/icerik/kanal2.php?id=$id&kanal2=track\" target=main><font color=red size=2 face=verdana>[track]</font></a>";
		$album = "<a class=link></a> <a class=div href=\"/icerik/kanal2.php?id=$id&kanal2=album\" target=main><font color=red size=2 face=verdana>[album] </font></a>";
		
		}*/

if ($baslik == "sözlükle ilgili istekler")  
{
$istekbuton = "<input type='button' onclick=\"location.href='/sozluk.php?process=istek1';\" value='çözülenler' class='butx'> <input type='button' onclick=\"location.href='/sozluk.php?process=istek2';\" value='işlem bekleyenler' class='butx'> <input type='button' onclick=\"location.href='/sozluk.php?process=istek3';\" value='reddedilenler' class='butx'><br>";

}

if ($baslik == "bolchat")  
{
$istekbuton = "<small><a href='https://chat.bolsozluk.com' target=\"_blank\">bolchat - underground'ta kim var diye her gece düşünülen yer </a><br><br></small>";

}


if ($kullaniciAdi)  
{
//$takipx = "<a class=link> </a> <a class=div href=\"/icerik/takip2.php?id=$id\" target=main><font color=blue size=2 face=verdana>[takip] </font></a>";

?>
<style>
.butakip {
   background-color: #187291;
    border: yes;
    color: white;
    padding: 5px 2px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px;

vertical-align: top;
    cursor: pointer;
}
</style>
<?
						if($isMobile != 1)
{ 
//$takipx = "<input type='button' onclick=\"location.href='/icerik/takip2.php?id=$id'\" value='takip' style='height:30px; width:35px' class='butakip'>";
}
}

if (($kullaniciAdi == "admin") or ($kullaniciAdi == "booyaka") or ($kullaniciAdi == "deepsky") or ($kullaniciAdi == "if rap gets jealous") or ($kullaniciAdi == "ret1arius"))
{
	$gdspanel ="<input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=g';\" value='gündem' class='butx'> 
	<input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=d';\" value='konudışı' class='butx'>
  <input type='button' onclick=\"location.href='/icerik/gds.php?id=$id&gds=l';\" value='lobi' class='butx'>";

	//<a class=link> </a> <a class=div href=\"/icerik/gds.php?id=$id&gds=g\" target=main><font color=yellow size=2 face=verdana>- [gündem] </font></a> 
	//<a class=link> </a> <a class=div href=\"/icerik/gds.php?id=$id&gds=d\" target=main><font color=yellow size=2 face=verdana>[konudışı] </font></a>" ;
	
}

//<a class=link> </a> <a class=div href=\"/icerik/gds.php?id=$id&gds=s\" target=main><font color=yellow size=2 face=verdana>[soru] </font></a>
/*$sorgu2r= "SELECT kanal2, kanal3 FROM konular WHERE `id` = '$id'";
				$sorgur3 = mysql_query($sorgu2r);
				mysql_num_rows($sorgur3);
				$kayitr3=mysql_fetch_array($sorgur3);
				$kanal2=$kayitr3["kanal2"];
				$kanal3=$kayitr3["kanal3"];*/

/*$puanham = mysql_query("SELECT AVG(oy) AS port FROM puanlar WHERE baslik_id='$id'");
mysql_num_rows($puanham);
	$puan2=mysql_fetch_array($puanham);
		$puan=$puan2["port"];*/

		$kanaatham = mysql_query("SELECT AVG(kanaat) AS kh FROM mesajlar WHERE statu !='silindi' and sira='$id'");
mysql_num_rows($kanaatham);
	$kp2=mysql_fetch_array($kanaatham);
		$kp=$kp2["kh"];

		$ksx = mysql_fetch_array(mysql_query("SELECT COUNT(kanaat) AS ks FROM `mesajlar` WHERE sira='$id' and statu !='silindi' and (kanaat ='0' or kanaat ='1')"));
		$ks = $ksx['ks'];



        

	

				if ($kanal2 || $kanal3 )				{
						if ($kulYetki){
							
					
					$skor = <<<EOD
					<form method=post action=>
					  <input type="hidden" name="okupdate" value="ok">
						<select name="puankayit" id="puankayit">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select>
					<input type="submit" name="Submit" value="puanla" class=but>
					</form>
EOD;
					
					//$bolpuan = "bolpuan: $puan/9"; 		
				}

}

?>
<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}

</script>
<?




if ($okupdate) {
	$mpuan = mysql_query("SELECT baslik_id,nick FROM puanlar WHERE `baslik_id` = $id and `nick` = '$kullaniciAdi'");
	$puansay = mysql_num_rows($mpuan);

	if ($puansay == 0){
$dakika = date("i");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$julyen = GregorianToJD($ay, $gun, $yil);
$sorgu = "INSERT INTO puanlar ";
		$sorgu .= "(baslik_id,nick,oy,dakika,julyen)";
		$sorgu .= " VALUES ";
		$sorgu .= "('$id','$yazar','$puankayit','$dakika','$julyen')";
		mysql_query($sorgu);

		echo "<center><b>puanınız kaydedildi.</center></b>";
}else{
	echo "<center><b>daha önce puan vermişsiniz.</center></b>";
}
}

	/*$sorgu1 = "SELECT id,mesajcount FROM konular WHERE `id` = '$konuid'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$mesajcount=$kayit2["mesajcount"];

	$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");
			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);

		$mesajcount=(($mesajcount/150)*$goster);
		$mesajcount = floor($mesajcount * 2) / 2;*/


  //  $pattern = '/(\\p{L}+) (\\p{L}+) olan/u';
  //  $replacement = '$1 ($2)';
  //  $baslik = preg_replace($pattern, $replacement, $baslik);

$link = str_replace(" ","+",$link);
$link = str_replace("%20","+",$link);


	echo "


		<meta name=\"keywords\" content=\"$baslik\">
		<meta name=\"description\" content=\"$baslik\">
		<title>$baslik - bol sözlük</title>
		<TABLE width=\"100%\">
		  <TBODY>



		  <TR>

				  <h1 class=\"title\"><A href=\"$link-1.html\">$baslik</A> $babaveto $bolgpt $linkb $fbb $twtb $takipx $veto</H1> $istekbuton $basliksil $baslikduzenle $basliktasi $sukelink $benlink $album $track $skor $buton $bolpuan $gdspanel<br></FONT>";
 				if ($kullaniciAdi)
				{
					//echo "<br>";
				}

 				if ($mesajcount )
				{
					
			//	echo "<small>bu başlığı ortalama $mesajcount dakikada okuyabilirsiniz.</small>"; 	<	
			//			echo "<br>"; 
				}

//GÜNDEM ÖZEL ERİŞİM KISITI 29/01/2024

/*
   $sorgu = "SELECT * FROM ayar WHERE `id` = '1'";
  $sorgulama = @mysql_query($sorgu);
  
  if (@mysql_num_rows($sorgulama)>0){
  
    while ($kayit=@mysql_fetch_array($sorgulama)){
      
      $siteStatus=$kayit["site"];
      $registerStyle=$kayit["reg"];
      $gundemkisit=$kayit["g"];

    }}
    



  if ((($kullaniciAdi == "") or ($gundemkisit == "off") or ($durum == "") or ($durum =="off") or ($durum =="sus")) and ($gds == "g") )
  {
    echo "Hukuki sakınca denetimimiz tamamlanana kadar gündem başlıkları sadece sözlük yazarlarının erişimine açıktır.";
    ?>
    <br><br><b>rastgele gururlarımız:<br><br></b>
<? 
echo $gururlist[$randomgurur];
echo "<br>";
echo "<br>";

include "footer.php";

    die;
  }

*/
  
//SANSAR ÖZEL

    
//if ($baslik =='sansar salvonun yardım çığlıkları') 
if (strpos($baslik, 'sansar') !== false || strpos($baslik, 'ekincan') !== false) {
if  (($baslik != "13 mart 2025 sansar salvonun tahliye olması")) {

    echo "<br><br>";
    echo "bu başlıkta Moderasyon denetimi yapılmaktadır.";
    if ($kullaniciAdi != "") echo " Moderasyon denetimi süresince sadece sözlük yazarlarının erişimine açıktır.";
    if ($kullaniciAdi == "") die;
    echo "<br><br>";

  }

}
  //SANSAR ÖZEL  


//LOBİ-KONUDIŞI ERİŞİM KISITI 17/04/2022

  if ((($kullaniciAdi == "") or ($durum == "") or ($durum =="off") or ($durum =="sus")) and ($gds == "d"))
  {
    echo "Konu dışı bölümü başlıkları sadece sözlük yazarlarının erişimine açıktır.";
    ?>
    <br><br><b>rastgele gururlarımız:<br><br></b>
<? 
echo $gururlist[$randomgurur];
echo "<br>";
echo "<br>";

?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<!-- bolBanner -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7095410555"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?
include "footer.php";
    die;
  }
  
if ((($kullaniciAdi == "") or ($durum == "") or ($durum =="off") or ($durum =="sus")) and ($gds == "l"))
  {
     echo "Lobi bölümü başlıkları sadece sözlük yazarlarının erişimine açıktır.";
     ?>
     <br><br><b>rastgele gururlarımız:<br><br></b>
<? 
echo $gururlist[$randomgurur];
echo "<br>";
echo "<br>";

?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<!-- bolBanner -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7095410555"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?
include "footer.php";
     die;
  }


echo"


				  <b>başlık no:</b>$konuid <b>okunma:</b>$hit3" ;



				if ($gds=="d") {echo"<small><br>şu an <a href=\"left.php?list=konudisi\" target=\"left\">konu dışı</a> kategorisindeki bir başlıktasınız.</b></small>" ;}
				if ($gds=="s") {echo"<small><br><a href=\"left.php?list=soru\" target=\"left\">soru</a> başlıklarında entry sahipleri anonim olarak görünmekteydi, bu başlıklar artık konu dışında yer almaktadır.</b></small>";}
				if ($gds=="l") {echo"<small><br><a href=\"left.php?list=lobi\" target=\"left\">lobi</a> bölümü yazar nickaltlarına ve önceden konudışına alınmış bazı meta başlıklara ayrılan bir alandır.</b></small>";}
				/*if ($kanal2 || $kanal3 )
				{
				$puan = round($puan, 1);
				echo " <b>bolpuan</b>: $puan/9"; 		
				}*/

			/*	if ($kp)
				{
				$kp = round($kp, 2);
		   		$kp = ($kp*10);
				$kp = round($kp,1);
			//	echo $kp;				
				//	echo $ks[0];
			//	if ($kulYetki == 'admin'){echo " <b>bolpuan</b>:$kp/10"; 		}
				if ($ks >= '10'){echo " <b>bolpuan</b>:$kp/10"; 		}
				}*/
 				
?>
<script>
function basara(){
    var kelime = document.getElementById('x').value.toLowerCase();
    var basbas = "<?php echo $q ?>";
    self.location.href='sozluk.php?process=word&q='+basbas+'&mod=arabul&aranacak='+kelime;
}

</script>
<?

echo"




			  </TD>
		</TR>
		

<tr>

<td align=right>";




			if ($okunmayan and $kullaniciAdi)
			{
			echo "<input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='pmsghi'>";
			}else{
            if($kullaniciAdi){
			echo "<input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='pmsg'>";
			}}
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kullaniciAdi' and `statu` = 'silindi' and `ucur` = '0'"); //or `statu` = 'akillandim'
$kac = mysql_num_rows($sor);
if ($kac and $kullaniciAdi)
{
echo"<input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=cp';\" value='çöp' class='pbinhi'>";
}else{if($kullaniciAdi){
echo"<input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=cp';\" value='çöp' class='pbin'>";
}}
if($kullaniciAdi){
	if($isMobile == 1)
{ 
//echo"<input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol paneli' class='pbin'>";
}	
echo"<input type='button' onclick=\"location.href='sozluk.php?process=rand';\" value='rastgele' class='pevt'>";
}else{
	if($isMobile == 1)
{ 
//echo"<input type='button' onclick=\"location.href='sozluk.php?process=master&login=onair';\" value='giriş yap' class='pbinhi'>";
}
echo"<input type='button' onclick=\"location.href='sozluk.php?process=rand';\" value='rastgele' class='pevt'>";
}
?>

<?
//if($kullaniciAdi){ 
//echo"<input type='button' onclick=\"location.href='http://www.bolshit.com';\" target=\"_blank\" value='bolshit' class='pbinhi'>		";
//}else{
//echo"<input type='button' onclick=\"location.href='http://www.bolshit.com';\" target=\"_blank\" value='bolshit' class='pbinhi'>		";/
//}

$qsaf = str_replace("+"," ",$q);
$a1= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 0,1"));
$alaka1 = $a1["baslik"];
$a2= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 1,1"));
$alaka2 = $a2["baslik"];
$a3= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 2,1"));
$alaka3 = $a3["baslik"];
$a4= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 3,1"));
$alaka4 = $a4["baslik"];
$a5= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 4,1"));
$alaka5 = $a5["baslik"];
$a1 = str_replace(" ","+",$alaka1);
$a2 = str_replace(" ","+",$alaka2);
$a3 = str_replace(" ","+",$alaka3);
$a4 = str_replace(" ","+",$alaka4);
$a5 = str_replace(" ","+",$alaka5);
		
if ($isMobile ==0)
{
echo "
  <br>
    <select onchange=\"window.location=this.options[this.selectedIndex].value\">
        <option value=\"\">alakalı olabilir...</option>
        <option value=\"/sozluk.php?process=word&q=$a1\">$alaka1</option>";
}

if ($isMobile ==1)
{
echo "
  <br>
    <select onchange=\"window.location=this.options[this.selectedIndex].value\">
        <option value=\"\">alakalı olabilir...</option>
        <option value=\"/sozluk.php?process=word&q=$a1\">$alaka1</option>";
}


if ($a2!="1" and $a2 !="") echo "<option value=\"/sozluk.php?process=word&q=$a2\">$alaka2</option>";
if ($a3!="1" and $a3 !="") echo "<option value=\"/sozluk.php?process=word&q=$a3\">$alaka3</option>";
if ($a4!="1" and $a4 !="") echo "<option value=\"/sozluk.php?process=word&q=$a4\">$alaka4</option>";
if ($a5!="1" and $a5 !="") echo "<option value=\"/sozluk.php?process=word&q=$a5\">$alaka5</option>";
echo "</select>";




//BAŞLIKTA ARA
if ($isMobile ==0)
{
echo "<br><input maxLength=55 class=\"input\" style=\"height:12px\" accesskey=\"b\" id=\"x\" name=\"x\" size=\"12\" placeholder=\"başlık içinde ara\"> <input type='button' onClick=\"javascript:basara();\" value='ara' class='butx'><br>";                
}

if ($isMobile ==1)
{
echo "<br><input maxLength=55 class=\"input\" style=\"height:12px\" accesskey=\"b\" id=\"x\" name=\"x\" size=\"22\" placeholder=\"başlık içinde ara\"> <input type='button' onClick=\"javascript:basara();\" value='ara' class='butx'><br>";                
}

// Veritabanından verileri seçme
$sql = "SELECT kim FROM rehber WHERE kimin='$kullaniciAdi' AND num=0";
$result = mysql_query($sql);

// ARKADAŞ ÇAĞIR
if ($kullaniciAdi != "")
{
echo "<b>Arkadaş Çağır: </b><select name='rehber' onchange='location = this.value;'>";
if (mysql_num_rows($result) > 0) {
  while($row = mysql_fetch_assoc($result)) {
    $url = "sozluk.php?process=privmsg&islem=yenimsj&gkonu=$q&summon=1&gkime=" . $row['kim'];
    echo "<option value='" . $url . "'>" . $row['kim'] . "</option>";
  }
$urlEntry = "sozluk.php?process=bolgpt&baslik=$q&sira=$konuid";
echo "<option value='" . $urlEntry . "'>" . 'bolgpt (entry)' . "</option>";

$urlBaslik = "sozluk.php?process=bolgptnb";
echo "<option value='" . $urlBaslik . "'>" . 'bolgpt (yeni başlık)' . "</option>";



}
echo "</select>";
}

?>
</tr>

		</TBODY></TABLE>

	<?
		if ($tasi) {
			$link = str_replace(" ","+",$tasi);
			echo "<center><a class=link><br><font color=red><b>$baslik -> $tasi</b></font><br><br>Bu başlık taşınmıştır.<br>Lütfen bekleyin.<br>Yönlendiriliyorsunuz..</a></center>
			<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=/sozluk.php?process=word&q=$link\">
			";
			die;
		}

	}
}else{
	if (!$q) {

		echo "<div class=dash><center><b><img src=img/unlem.gif> başlık ismini gir.";
		exit;
	}

	echo "<div class=dash><center><font color=red size=2>$q</font><font size=2> diye bir konu yok ki?</font></div>";
$qsaf = str_replace("+"," ",$q);
$a1= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and  MATCH (baslik) AGAINST ('$q') limit 0,1"));
$alaka1 = $a1["baslik"];
$a2= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 1,1"));
$alaka2 = $a2["baslik"];
$a3= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 2,1"));
$alaka3 = $a3["baslik"];
$a4= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 3,1"));
$alaka4 = $a4["baslik"];
$a5= mysql_fetch_array(mysql_query("SELECT baslik FROM konular WHERE (statu != 'silindi' and tasi = '') and MATCH (baslik) AGAINST ('$q') limit 4,1"));
$alaka5 = $a5["baslik"];
$a1 = str_replace(" ","+",$alaka1);
$a2 = str_replace(" ","+",$alaka2);
$a3 = str_replace(" ","+",$alaka3);
$a4 = str_replace(" ","+",$alaka4);
$a5 = str_replace(" ","+",$alaka5);

if ($isMobile ==0)
{
if ($alaka1){
echo "<tr><td><small>böyle bir başlık bulamadık, ama şunlar belki aradıklarınla alakalıdır:</small></td></tr><tr><td><br>
<tr><td><small><a href=\"/sozluk.php?process=word&q=$a1\" target=\"main\">*$alaka1</a></small><br></td></tr>";}
if ($alaka2){echo"<tr><td><small><a href=\"/sozluk.php?process=word&q=$a2\" target=\"main\">*$alaka2</a></small><br></td></tr>";}
if ($alaka3){echo"<tr><td><small><a href=\"/sozluk.php?process=word&q=$a3\" target=\"main\">*$alaka3</a></small><br></td></tr>";}
if ($alaka4){echo"<tr><td><small><a href=\"/sozluk.php?process=word&q=$a4\" target=\"main\">*$alaka4</a></small><br></td></tr>";}
if ($alaka5){echo"<tr><td><small><a href=\"/sozluk.php?process=word&q=$a5\" target=\"main\">*$alaka5</a></small><br></td></tr>";}
if ($alaka1 and $kullaniciAdi){echo"<tr><td><small>alakası yoksa hemen patlat bir başlık:</small></td></tr><tr><td><br><br></tr></tbody></table></div>";}
}

if ($isMobile == 1)
{
if ($alaka1){
echo "<tr><td><small>yok boyle bi\$ii???, lakin \$oyle bi\$iiler war belki alakalidir:</small></td></tr><tr><td><br>
<tr><td><a href=\"/sozluk.php?process=word&q=$a1\" >*$alaka1</a><br></td></tr>";}
if ($alaka2){echo"<tr><td><a href=\"/sozluk.php?process=word&q=$a2\" >*$alaka2</a><br></td></tr>";}
if ($alaka3){echo"<tr><td><a href=\"/sozluk.php?process=word&q=$a3\" >*$alaka3</a><br></td></tr>";}
if ($alaka4){echo"<tr><td><a href=\"/sozluk.php?process=word&q=$a4\" >*$alaka4</a><br></td></tr>";}
if ($alaka5){echo"<tr><td><a href=\"/sozluk.php?process=word&q=$a5\" >*$alaka5</a><br></td></tr>";}
if ($alaka1 and $kullaniciAdi){echo"<tr><td><small>alakası yoksa hemen patlat bir başlık:</small></td></tr><tr><td><br><br></tr></tbody></table></div>";}
}



	mt_srand ((double)microtime()*1000000);
	$banner = mt_rand(1, 4);



	if ($kullaniciAdi) {
	
//echo "$q basligi icin $kullaniciAdi $test3 ";
		if ($test3 == "on" or $test3 =="" and $yazarlik != "off" ) {
		/*<?echo "$q" ?> hakkında kafanızda bir tanım veya verebileceğiniz bir örnek varsa eklemekten çekinmeyin:*/
		?>		 
				

        <form method="post" action="sozluk.php?process=add">
<input type="radio" name="gds" value="g" checked> Gündem
<input type="radio" name="gds" value="d"> Konu dışı
<input type="radio" name="gds" value="l"> Lobi<br>
      
            <table width="100%" align="left" class="dash">
                <tr>
                	<h1 class=\"title\"><A href="#"><?if ($q) { echo $q;}?></A></H1><h3>(aklınıza geleni yazın, bilgilendirin, içinizi dökün.)</h3>							                		
               <font color=green>sözlüğün ana teması olan hiphop kültürü ve rap müzikle doğrudan ilgili olmayan içerikler için konu dışı seçeneğini seçiniz.<br><br></font>
(<b>1</b>) bol sözlük'te başlık açarken ilk entrynizde kısa da olsa başlığı tanımlayan bir bilgilendirici cümle kurmanız beklenmektedir.
<br>
<br>(<b>2</b>) başlık adı belirlenirken en genel ifadeyi bulmanız yerinde olacaktır. &quot;kadıköy ilçesi&quot;, &quot;kadıköy hakkında&quot; gibi başlıklar yerine &quot;kadıköy&quot; başlığını kullanmalısınız.
<br>
<br>(<b>3</b>) bir şarkının başlığını açarken doğrudan şarkı ismi başlıkta kullanılmalıdır. örneğin &quot;fuat - yüzleş&quot; şeklindeki bir başlık açımı bilginin derlenmesini zorlaştıracaktır, doğru tercih &quot;yüzleş&quot; başlığı olmalıdır.
<br>
<br>(<b>4</b>) her konuda görüş ve bilgilerinizi dilediğiniz şekilde başlık açarak paylaşabilirsiniz, ancak sizden sonra gelecekler tarafından da okunacak sözlüğün daha derli ve toplu bir bilgi kaynağı olması adına moderasyon ekibi açacağınız başlıkları bazı ana konu başlıklarına taşıyabilir. 
<br>
<br>(<b>5</b>) bu hususları kasten veya ısrarla istismar etmediğiniz sürece herhangi bir uyarı ya da çaylaklık cezası almanız bol sözlük'te söz konusu değildir.<br>

                		 <input class="inp"  readonly type="hidden" maxLength="65" SIZE="65" name="baslik" value="<? if ($q) { echo $q."\""; }?>">
                    <?
                    /*
                     <td colspan="2">
                        <input class="inp" readonly maxLength="0" SIZE="0" name="baslik" value="<? if ($q) { echo $q."\""; }?>">(değiştirmek için başlığı yeniden açın)
                    </td>*/
                    ?>
                   
                </tr>

                <tr>
                    <td colspan="2">
                        <textarea id="entry" name="mesaj" rows="8" style="width:100%;height:12em;max-height:12em;resize:none;text-transform:none !important;"></textarea>
                    </td>
                </tr>

                <tr>
                    <td width="90" >
                        <input id="kaydet" class=butx type="submit" name="kaydet" value="gönder" onClick="javascript:dekaydet();">
                        <input type=hidden name=ok value=ok>
                        <input type=hidden name=okmsj value=ok>
                        <input type="hidden" name="gonder" value="kaydet">
                        <input type="submit" class=butx name="kenar" value="kenar"/>

					<td width="788" align="right" valign="top"> 
            <input class="butx" type="button" name="bkz" value="bkz" onClick="return insert('entry','(bkz: ',')');">
            <input class="butx" type="button" name="bkz" value="gizli bkz" onClick="return insert('entry','`','`');">
            <input class="butx" type="button" name="bkz" value="youtube" onClick="return insert('entry','(youtube: ',')');">
            <input class="butx" type="button" name="bkz" value="sndcld" onClick="return insert('entry','(soundcloud: ',')');">
            <input class="butx" type="button" name="bkz" value="sptfy albüm" onClick="return insert('entry','(spoalbum: ',')');">
            <input class="butx" type="button" name="bkz" value="sptfy track" onClick="return insert('entry','(spotrack: ',')');">
            <input class="butx" type="button" name="bkz" value="kalın" onClick="return insert('entry','(kalin: ',')');">
            <input class="butx" type="button" name="bkz" value="*" onClick="return insert('entry','~','~');">
            <input class="butx" type="button" name="bkz" value="-s!-" onClick="return insert('entry','\n--`spoiler`--\n','\n--`spoiler`--\n\n');" accesskey=v>
                    </td>
                    </td>
                    </tr>
            </table>
        </form>
butonları kullanmadan da;<br>
Bakmak için bakınız: (bkz: kelime)<br>
Çaktırmadan bakınız: (gbkz: kelime)<br>
<br>
        <?php
        		}
			
	}
	
	exit;
}

	if ($ok) {
		$mesaj = $_POST["mesaj"];
		$kenar = $_POST["kenar"];
		if (!$kullaniciAdi) {
			die;
		}
				
		if (strlen($mesaj)<4) { //11.07.2020 alche için edit
			echo "Entry yazman lazım ama.. :)";
		exit;



		}else{
			$siteStatus = $_SERVER["HTTP_REFERER"];
			$siteStatus = explode("/", $siteStatus);
			$siteStatus = $siteStatus[2];

			if ($test3 == "off" or $test3 == "wait" or $yazstatu == "wait" or $yazstatu == "kenar" or $yazarlik != "on") {
				$sorgu1 = "SELECT nick,online FROM user WHERE `nick` = '$yazar'";
				$sorgu2 = mysql_query($sorgu1);
				mysql_num_rows($sorgu2);
				$kayit2=mysql_fetch_array($sorgu2);
				$online=$kayit2["online"];
				$userNickName=$kayit2["nick"];

				if (!$online) {
					$online = 1;
				}else{
					$online++;
				}

				if ($online == "1000") {
					$sesdurum = "wait";
					$_SESSION['sesdurum_S'] = $sesdurum;
					$sorgu = "UPDATE user SET durum = 'wait' WHERE nick= '$kullaniciAdi'";
					mysql_query($sorgu);
					$sorgu = "UPDATE online SET ondurum = '$sesdurum' WHERE nick= '$kullaniciAdi'";
					mysql_query($sorgu);
					echo "<br><center>10 deneme entry girme hakkinizi doldurdunuz.Şuan entrylariniz yöneticiler tarafından inceleniyor.<br>
					Uygun görülmesi halinde yazar olarak atanacaksınız sayın çaylak.<br></center>
					";
					$tarih = date("YmdHi");
					$gun = date("d");
					$ay = date("m");
					$yil = date("Y");
					$saat = date("H:i");

					$konu = "<img src=img/unlem.gif> $kullaniciAdi onay bekliyor!";
					$admtem = "admTEM";
					$yazi = "$kullaniciAdi nickine ait entrylar:<br>";
	
					$sorgu = "SELECT id,statu FROM mesajlar WHERE `statu`= 'wait' and `yazar` = '$kullaniciAdi'";
					$sorgulama = @mysql_query($sorgu);
					$sayyy = 0;
					
					if (@mysql_num_rows($sorgulama)>0){
						while ($kayit=@mysql_fetch_array($sorgulama)){
							$id=$kayit["id"];
							$sayyy++;
							$yazi .= "$sayyy- #$id <br>";
						}
					}
					die;
				}

				if (!$online) {
					echo "<center><br><br>Çaylak olarak bu entry'iniz <b>ilk</b> deneme entry'iniz olarak kayitlara geçti.";
				}else{
					echo "<center><br><br>Çaylak olarak bu entry'iniz <b>$online.</b> deneme entry'iniz olarak kayitlara geçti.";
				}

				$sorgu = "UPDATE user SET online='$online' WHERE nick='$yazar'";
				mysql_query($sorgu);
			}

			$tarih = date("YmdHi");
			$gun = date("d");
			$ay = date("m");
			$yil = date("Y");
			$saat = date("H:i");
			$dakika = date("i");
			$ip = getenv('REMOTE_ADDR');
			
			if ($test3 == "off" || $test3 == "sus" || $yazarlik != "on" ) {
				$statu = "wait";
			}else{
				$statu = "";
			}
			$mesaj = str_replace("\n","<br>",$mesaj);
			$mesaj = mysql_real_escape_string($mesaj);

			//
$msjcheck = mysql_query("SELECT * FROM mesajlar WHERE `mesaj`='$mesaj' and `sira`='$gid' and`statu`!='silindi' ORDER BY `id` desc limit 0,1");

if(mysql_num_rows($msjcheck)==0)
{
//echo "<script type='text/javascript'>alert('$mesaj. $gid. Tamam.');</script>";
}
else
{
echo "<script type='text/javascript'>alert('Böyle bir entry mevcut, entryniz zaten kaydedildi ya da sistemsel bir hata yaşandı.');</script>";
die;
}

$msjcheck = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE `sira`='$gid' ORDER BY `id` desc limit 0,1"));
$base1 = $msjcheck["ilkyazar"];

$msjcheck = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE `sira`='$gid' ORDER BY `id` desc limit 1,2"));
$base2 = $msjcheck["ilkyazar"];

$msjcheck = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE `sira`='$gid' ORDER BY `id` desc limit 2,3"));
$base3 = $msjcheck["ilkyazar"];

$msjcheck = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE `sira`='$gid' ORDER BY `id` desc limit 3,4"));
$base4 = $msjcheck["ilkyazar"];


//ÜSTÜSTE ENTRY KONTROLÜ

//if (($base4 == $base3) && ($base3 == $base2) &&($base1 != "") && ($base3 != "") && ($base1 == $kullaniciAdi))
//{
//echo "<script type='text/javascript'>alert('IP loglarınıza göre flood entry girmeye çalışıyorsunuz! Kayıt alınarak moderasyona bildirilmiştir.');</script>";
//echo "Yeni entry girmek yerine son girdiğiniz entryi editleyebilirsiniz.";
//die;
//}

//kenara gir

if(isset($_POST['kenar'])) {
$statu = "kenar";
}


if ($statu == "kenar")
{
if ($test3 == "off" || $test3 == "sus" || $yazarlik != "on" ) 
{
$statu = "wait";
}	
			$sorgu = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu .= " VALUES ('$gid','$mesaj','$yazar','$ip','$tarih','$gun','$ay','$yil','$saat','$statu','$dakika','$yazar')";
			mysql_query($sorgu);
	
}

			if ($statu !== "kenar")
{

// ETLİ ENTRY TEST 27-09-2024

if (strpos($mesaj, '@') !== false) {

    // Sadece @'ten sonra rakamları eşleştir 14-11 UPDATE
    if (preg_match('/\@(\d+)/', $mesaj, $matches)) {
        $mention = $matches[1];
        $mlow = $mention - 1;

if (($kulYetki != "admin") and ($kulYetki != "mod")) $listele = mysql_query("SELECT * FROM mesajlar WHERE `sira`=$gid and `statu`='' ORDER BY `id` asc limit $mlow,$mention");
if (($kulYetki == "admin") or ($kulYetki == "mod")) $listele = mysql_query("SELECT * FROM mesajlar WHERE `sira`=$gid ORDER BY `id` asc limit $mlow,$mention");
        if (mysql_num_rows($listele) > 0) {
            $kayit = mysql_fetch_assoc($listele);
            $id = $kayit["id"];

            $mesaj = str_replace("@$mention", "#$id", $mesaj);
        }
    }
}

//ETLİ ENTRY SON	
		


			$sorgu = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu .= " VALUES ('$gid','$mesaj','$yazar','$ip','$tarih','$gun','$ay','$yil','$saat','$statu','$dakika','$yazar')";
			mysql_query($sorgu);

		



}

			$ipdecimal = ip2long($ip);
			$sorgu31 = "INSERT INTO iptables (yazar,ip,tarih,ipdecimal)";
			$sorgu31 .= " VALUES ('$kullaniciAdi','$ip','$tarih','$ipdecimal')";
			mysql_query($sorgu31);


//$token = "1776243917:AAGjIzZJ4zO-jmCVie64nLh5yhf8-_UGO2U";
//$chatid = "-535314601";
//sendMessage($chatid, "$mesaj", $token);


//ÜSTÜN FLAD KORUMASI
$listele1 = mysql_fetch_array(mysql_query("SELECT id FROM mesajlar WHERE yazar='$kullaniciAdi' and statu != 'silindi' ORDER BY id desc limit 0,1"));
$base1 = $listele1["id"];
$listele2 = mysql_fetch_array(mysql_query("SELECT id FROM mesajlar WHERE yazar='$kullaniciAdi' and statu != 'silindi' ORDER BY id desc limit 1,2"));
$base2 = $listele2["id"];
$listele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$base1'"));
$base11 = $listele11["sira"];
$listele22 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$base2'"));
$base22 = $listele22["sira"];


$flood= mysql_fetch_array(mysql_query("SELECT flood FROM user WHERE `nick`='$kullaniciAdi'"));
$flad=$flood["flood"];
$fladx1 = mysql_fetch_array(mysql_query("SELECT dakika FROM mesajlar WHERE yazar='$kullaniciAdi' and statu != 'silindi' ORDER BY id desc limit 0,1"));
$flad1 = $fladx1["dakika"];
$fladx2 = mysql_fetch_array(mysql_query("SELECT dakika FROM mesajlar WHERE yazar='$kullaniciAdi' and statu != 'silindi' ORDER BY id desc limit 1,2"));
$flad2 = $fladx2["dakika"];


if (($flad1 == $flad2) && ($flad2 == $dakika))
{
++$flad;
$fladla = "UPDATE user SET flood='$flad' WHERE nick='$kullaniciAdi'"; 
mysql_query($fladla);
}

if ($flad1!=$flad2)
{
--$flad;
$fladla = "UPDATE user SET flood='$flad' WHERE nick='$kullaniciAdi'"; 
mysql_query($fladla);
}

if ($flad<=-4) //TAKOZ KOYDUK DÜŞMESİN ÇOK
{
$flad=-3;
$fladla = "UPDATE user SET flood='$flad' WHERE nick='$kullaniciAdi'"; 
mysql_query($fladla);
}

if ($flad1==$flad2 AND $base11 != $base22)
{
++$flad;
$fladla = "UPDATE user SET flood='$flad' WHERE nick='$kullaniciAdi'"; 
mysql_query($fladla); 
}



$flood= mysql_fetch_array(mysql_query("SELECT flood FROM user WHERE `nick`='$kullaniciAdi'"));
$flad=$flood["flood"];

//IF SORUN

if ($flad >=5 AND $flad <8)
{
 $msg = "UYARI: sözlüğün oto-koruma sistemi devreye girdi.";
 echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}

if ($flad >= 8)
{
	$xgkime = "admin";


	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");
	$ip = getenv('REMOTE_ADDR');

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$xgkime','$kullaniciAdi','$ip','FBI','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);

	mysql_query("UPDATE user SET msg=1 WHERE nick='".$gkime."'");

$msg = "UYARI: sözlüğün oto-koruma sistemi devreye girdi. sözlüğe bu kadar yüklenmeyiniz.";
$sorguban = "INSERT INTO ipban ";
$sorguban .= "(ip)";
$sorguban .= " VALUES ";
$sorguban .= "('$ip')";
mysql_query($sorguban);
echo '<script type="text/javascript">alert("' . $msg . '"); window.location="/logout.php"; </script>';
header ("Location: logout.php");
die;
exit;
}
//FLAD KORUMASI SONU




		/*	if ($test3 != "off" and $test3 != "wait" or $yazstatu == "wait") {
				 // echo '<script type="text/javascript">alert("' . $gid . '"); </script>';
				if ($gid == 4925) {
								}
				if ($gid != 4925) {
				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='$gid'";
				mysql_query($sorgux); 
				}
			}*/

			if (($durum == "on")  && ($statu != "kenar"))
			{
				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='$gid'";
				mysql_query($sorgux); 
			}
			else
			{
		$sorgux = "";
		mysql_query($sorgux); 
			}

			mt_srand ((double)microtime()*1000000);
			$banner = mt_rand(1, 4);
			mt_srand ((double)microtime()*1000000);
			mt_srand ((double)microtime()*1000000);

			if ($kulYetki == "admin") {
				$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid");
			}else if ($kulYetki != "admin" and $test3 == "wait" or $test3 == "off" or $yazstatu == "wait" or $yazstatu == "kenar" or $yazarlik != "on") {
				$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and or `statu` = ''  ");			
			}else{
				$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");
			}
			
			$w = mysql_num_rows($sor);
			$max = 20;
			$goster = $w/$max;
			$goster=ceil($goster);
			
			if ($goster >1) {
				$gostersayfa = "&sayfa=$goster";
			}
			
			if ($isMobile == 0)
			{
			echo "
			<p><center><b>Entry'niz kayıt edilmiştir!</b><br>
			<a href=\"sozluk.php?process=word&q=$baslik$gostersayfa\">devam!</a>
			</font></a></b></center></p><br><br>
			<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"7;URL=/sozluk.php?process=word&q=$baslik$gostersayfa\">
			<script language=\"javascript\">goUrl('left.php?list=today','left');</script>";
			exit;
			}

			if ($isMobile == 1)
			{
			echo "
			<p><center><b>Entry'niz kayıt edilmiştir!</b><br>
			<a href=\"sozluk.php?process=word&q=$baslik$gostersayfa\">devam!</a>
			</font></a></b></center></p><br><br>
			<script>location.href='left.php?list=today'</script>";
			exit;
			}



		} // if mesaj
	} // else

// cevap /write

	//


	$max = 20;
	
	if (!$_GET["sayfa"]){
		$_GET["sayfa"] = 1;
	}

	$alt = ($_GET["sayfa"] - 1)  * $max;
	$say = 0;

	if (($kulYetki == "admin") or ($kulYetki == "mod")) { //xmod'u mod yap
		$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid");
	}else if ($test3 == "wait" or $test3 == "off" or $yazstatu == "wait" or $yazstatu == "kenar" or $yazarlik != "on"){
		$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and (`statu` = 'wait' or `statu` = '')");
	}else{
		$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");
	}

	$w = mysql_num_rows($sor);



	if ($sayfa and $sayfa != 1)
		$say = ($sayfa -1) * $max;
		$goster = $w/$max;
		$goster=ceil($goster);

//ÜST NAV SAYFA NAVİGASYONU
	if (($mod !="sukela") && ($mod !="arabul"))
	{
		if ($goster > 1)
			echo "<p align=center class=eol><font face=Verdana size=1>Sayfalar: ";
			if ($goster >1) {
				if ($sayfa >= 1 or !$sayfa) {
					$linksayfa = $sayfa - 1;
					if ($sayfa > 1 or $sayfa) {
						if ($sayfa != 1)
							        echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=1\"><font color=red face=verdana size=1><b>|<</b></font></a> ";
        echo "&nbsp;";
        echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$linksayfa\"><font color=red face=verdana size=1><b><<</b></font></a> ";
						}
					}
		
					echo "<select class=ksel onchange=\"jm('self',this,0);\" name=sayfa>";
					for ($i=1;$i<=$goster;$i++) {
						if ($sayfa == $i) {
							echo "<option value=\"/sozluk.php?process=word&q=$q&sayfa=$i\" selected>$i</OPTION>"; //$q
						}else{
							echo "<OPTION value=\"/sozluk.php?process=word&q=$q&sayfa=$i\">$i</OPTION>"; //$q
						}
					}
					echo "</SELECT>";
				}


				
		
			if ($sayfa >= 1 or !$sayfa) {
				if (!$sayfa)
				$sayfa = 1;
				$linksayfa = $sayfa + 1;
				
				if ($mod !="sukela")
	{
				if ($linksayfa <= $goster) {
					   echo " <a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$linksayfa\"><font color=red face=verdana size=1><b>>></b></font></a>";
    echo "&nbsp;";
    echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$goster\"><font color=red face=verdana size=1><b>>|</b></font></a> ";
				}
				}
			}
			}			
			echo "<ol style=\"margin-inline-start: 18px;font-size:14px\">";

		
		function renklendir($metin, $kelimeler, $renk)
{
  if(is_array($kelimeler))
  {
    foreach($kelimeler as $k => $kelime)
    {
      $desen[$k] = "/\b($kelime)\b/is";
      $degistir[$k] = '<font style="background-color:'.$renk.'; color:#FFFFFF">\\1</font>';
    }
  }  else {
    $desen = "/\b($kelimeler)\b/is";
    $degistir = '<font style="background-color:'.$renk.'; color:#FFFFFF">\\1</font>';
  }
  return preg_replace($desen,$degistir,$metin);
}

function highlight($text, $words) {
    preg_match_all('~\w+~', $words, $m);
    if(!$m)
        return $text;
    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
    return preg_replace($re, '<b>$0</b>', $text);
}

function highlight_word( $title, $searched_word, $renk) {
    return preg_replace('#('.$searched_word.')#i','<font style="background-color:'.$renk.'; color:#FFFFFF">\\1</font>',$title) ;
}

	//ŞÜKELA MODU

		if ($mod == "sukela")	
		{
	$listele = mysql_query("SELECT *, (SELECT SUM(oy) FROM oylar WHERE oylar.entry_id=mesajlar.id) AS oytop FROM mesajlar WHERE sira = $gid  AND `statu` = '' ORDER BY oytop DESC LIMIT 0,50");
	    }
  
//BEN MODU - AĞUSTOS 2023

          if ($mod == "ben") 
    {
//ECHO "ben mod - $gid - $kullaniciAdi";
 $listele = mysql_query("SELECT * FROM mesajlar WHERE sira = $gid  AND `statu` = '' AND `yazar` = '$kullaniciAdi' ORDER BY id ASC");


      }




	    if ($mod == "arabul")	
		{

			//if (substr('$aranacak', 0, 1) === '@')
			if ($aranacak[0] == "@")
			{
			$arayazar = substr($aranacak, 1);
			$listele = mysql_query("SELECT * FROM mesajlar WHERE sira = $gid AND yazar = '$arayazar' AND `statu` = '' ORDER BY id DESC LIMIT 0,50");
			}
			else
			{
			$listele = mysql_query("SELECT * FROM mesajlar WHERE sira = $gid AND mesaj LIKE '%$aranacak%' AND `statu` = '' ORDER BY id DESC LIMIT 0,255");
	    	}
	    	}


		if (($mod != "sukela") && ($mod != "arabul") && ($mod != "ben"))	
		{


			if ($kulYetki == "admin" or $kulYetki == "mod") {
				$listele = mysql_query("SELECT * FROM mesajlar WHERE `sira`=$gid ORDER BY `id` asc limit $alt,$max");
			}else if ($test3 == "off" or $test3 == "wait" or $yazstatu == "wait" or $yazstatu == "kenar" or $yazarlik != "on") {
				$listele = mysql_query("SELECT * FROM mesajlar WHERE `sira`=$gid and `statu` != 'silindi' and `statu` != 'akillandim' and `statu` != 'wait' and `statu` != 'kenar' ORDER BY `id` asc limit $alt,$max"); //OFFLINE GÖSTERME BURDA
			}
			else{
				$listele = mysql_query("SELECT * FROM mesajlar WHERE `sira`=$gid and `statu` = '' ORDER BY `id` asc limit $alt,$max");


			}

		}

			if (mysql_num_rows($listele)>0){

				if ($mod == "sukela") 
					{

						//

					}


				while ($kayit=mysql_fetch_array($listele)) {

					$id=$kayit["id"];

          //ENTRY GÖRÜNTÜLEME DB
					//echo $id;
					$sira=$kayit["sira"];
					$mesaj=$kayit["mesaj"];
					$updater=$kayit["updater"];
					$yazar=$kayit["yazar"];
					$tarih=$kayit["tarih"];
					$gun=$kayit["gun"];
					$ay=$kayit["ay"];
					$yil=$kayit["yil"];
					$saat=$kayit["saat"];
					$statu=$kayit["statu"];
					$yazstatu=$kayit["statu"];
					$update=$kayit["update2"];
					$ilkyazar=$kayit["ilkyazar"];
					$updatesebep=$kayit["updatesebep"];
					$istekhatti=$kayit["istekhatti"];
          $ansiklopedik=$kayit["kulliyat"];
					$ayazar = $yazar;

          $kulliyat = "";

          if($ansiklopedik=="1"){ $kulliyat = "<img src=\"https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-blue-512.png\" title=\"ebedi entry\" width=16 height=16> <font size=1>";}


					
					$yazarlink = str_replace("&","",$yazar); // adminlerden ~ kaldırıyoruz
					$yazartitle = str_replace("&","Administrator / ",$yazar); // adminlerden ~ kaldırıyoruz
					$uzunluk = 150;
					if($mesaj && strlen($mesaj)>$uzunluk) {
					$mesaj=preg_replace("/([^\n\r -]{".$uzunluk."})/i"," \\1\n<br />",$mesaj);
				}

				$say++;
				if (!$ayazar) {
					die;	
				}

				if ($kulYetki == "gammaz") {
					$ispit = "<a href=/sozluk.php?process=ispit&id=$id><font size=1>[ispiyon et]</font></a>";
				}else{
					$ispit = "";
				}
				 


//istek hattı
				 if ($kulYetki == "admin" or $kulYetki == "mod"){
		 	if ($baslik =='sözlükle ilgili istekler') {
			$istek1 = "<a class=link> - </a> <a class=div href=/sozluk.php?process=adm&islem=istek&bid=$id&a=1><font size=1 face=verdana>[çözüldü]</font></a>";
			$istek2 = "<a class=link> - </a> <a class=div href=/sozluk.php?process=adm&islem=istek&bid=$id&a=2><font size=1 face=verdana>[reddedildi]</font></a>";
			$istek3 = "<a class=link> - </a> <a class=div href=/sozluk.php?process=adm&islem=istek&bid=$id&a=3><font size=1 face=verdana>[talep alındı]</font></a>	";
			$istek4 = "<a class=link> - </a> <a class=div href=/sozluk.php?process=adm&islem=istek&bid=$id&a=4><font size=1 face=verdana>[boşa düşür] -</font></a>	";
            $istek = $istek1 + $istek2+ $istek3 + $istek4;
		}
		}
if ($baslik !='sözlükle ilgili istekler') { $istek = ''; }
				if ($ayazar == $kullaniciAdi and $kullaniciAdi!='') {
					$veto = "<a id=\"veto\" href=\"sozluk.php?process=veto&q=$q&testx=$test3\" title=veto&nbsp;et> <img src=/veto.png width=30 height=23></a>"					;
        //  $dmyolla = "<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazar&gkonu=$link\"><font size=1>[/mesaj]</font></a>";
          $sil = "<a href=sozluk.php?process=esil&id=$id&sr=$sira&ispitle=$yazar><font size=1>[/sil]</font></a>";
					// $sil = "&nbsp;<span class=\"but\" onClick=\"sil".$id.".Click();\">
					// <a id=\"sil".$id."\" href=\"sozluk.php?process=esil&id=$id&sr=$sira\"> :) </a>
					//</span>&nbsp;					
					$duzenle = "<a href=sozluk.php?process=eduzenle&id=$id&sr=$sira><font size=1>[/edit]</font></a> "; //<a href='sozluk.php?process=etasi&id=$id&sira=$sira'><font size=1>[/taşı] </font></a>

					$anon = "<a href='sozluk.php?process=eanon&id=$id&sr=$sira'><font size=1>[/anon]</font></a> ";

				}else{
					$sil = "";
					$duzenle = "";
					$anon = "";
					$menu = "";
				}

				$dmyolla = "<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazar&gkonu=$link\"><font size=1>[/mesaj]</font></a>";     
				$esikayet = "<a href=/sozluk.php?process=esikayet&id=$id&sr=$konuid title='Şikayet Et'><font size=1>[/ispitle]</font></A>";

				if ( $kulYetki == "admin" or $kulYetki == "mod") {



					$veto = "<a id=\"veto\" href=\"sozluk.php?process=veto&q=$q&testx=$test3\" title=veto&nbsp;et> <img src=/veto.png width=30 height=23> </a>"					;
    

					$sil = "<a href=sozluk.php?process=esil&id=$id&sr=$sira&ispitle=$yazar><font size=1>[/sil]</font></a>";
					// $sil = "&nbsp;<span class=\"but\" onClick=\"sil".$id.".Click();\">
					// <a id=\"sil".$id."\" href=\"sozluk.php?process=esil&id=$id&sr=$sira\"> :) </a>
					//</span>&nbsp;					
					$duzenle = "<a href='sozluk.php?process=etasi&id=$id&sira=$sira'><font size=1>[/taşı] </font></a><a href=sozluk.php?process=eduzenle&id=$id&sr=$sira><font size=1>[/edit]</font></a> "; //

          //echo "| <a href=\"sozluk.php?process=adm&islem=kullanici&update=ok&gnick=$echoyazar\" title=\"kozmik oda\">♦</A> |";

					$anon = "<a href='sozluk.php?process=eanon&id=$id&sr=$sira'><font size=1>[/anon]</font></a> ";
					}

										if ( $kulYetki == "admin" or $kulYetki == "mod" or (($kullaniciAdi == "hayatitelgeler") && ($ayazar == $kullaniciAdi)  ))  {
              $echoyazar = $yazar;
							$ebol = "<a href='sozluk.php?process=ebol&id=$id&sr=$sira'><font size=1>[/BOL]</font></a> ";
              $kozmik = "<a href=\"sozluk.php?process=adm&islem=kullanici&update=ok&gnick=$echoyazar\" title=\"kozmik oda\"><font size=1>[/kozmik]</font></A>";
					}

				if ($kullaniciAdi =="yorumlar") {
						$sil = "";
					$duzenle = "";
				}
				
				
				if ($updatesebep) {
					$updatesebep = "(Sebep: $updatesebep)";
				}

				//DROPDOWN MENU 06.02.2024

                if (($kullaniciAdi == $yazar) || ($kulYetki == "admin") || ($kulYetki == "mod") )
                {

  				$menu = "
				<div class=\"dropdown\">
				  <button class=\"dropdown-toggle eidButton\"> <small><strong>#{$id}</strong></small> </button> 
				  <div class=\"dropdown-content\">";
				
				if ($istek =! "") {
				  $menu .= $istek1;
				  $menu .= $istek2;
				  $menu .= $istek3;
				  $menu .= $istek4;
				}
				
				$menu .= $dmyolla;
        $menu .= $duzenle;
				$menu .= $sil;
				$menu .= $ebol;
				$menu .= $anon;
        $menu .= $kozmik;
        $menu .= $esikayet;

				$menu .= "
				  </div>
				</div>";
            }
            else if (($kullaniciAdi != $yazar) && ($kullaniciAdi != "") && (($kulYetki != "admin") || ($kulYetki != "mod")) )
            {
        
          $menu = "
        <div class=\"dropdown\">
          <button class=\"dropdown-toggle eidButton\"> <small><strong>#{$id}</strong></small> </button> 
          <div class=\"dropdown-content\">";



		  $menu .= $dmyolla;
      $menu .= $esikayet;
		  $menu .= "
		  </div>
		</div>";


             }

            else 
            {
              //$menu = "";
          $menu = "";

             }

				$duzenle = "";
				$anon = "";
				$sil = "";
				$ebol = "";

?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tüm .eidButton butonlarını seç
    var buttons = document.querySelectorAll('.eidButton');

    // Eğer tek bir buton varsa bile, bu butonu düzgün seçip işlemek için döngü kur
    if (buttons.length > 0) {
      buttons.forEach(function(button) {
        button.ondblclick = function() {
          // Butonun içindeki metni seç (sadece tıklanan buton için)
          var range = document.createRange();
          range.selectNode(this);
          window.getSelection().removeAllRanges();
          window.getSelection().addRange(range);
        };
      });
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.getElementById('entry');
    var form = textarea.closest('form');
    
    textarea.addEventListener('keydown', function(e) {
        // Ctrl+Enter veya Cmd+Enter (Mac için) tuş kombinasyonunu kontrol et
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 13) {
            e.preventDefault(); // Varsayılan davranışı engelle
            form.submit(); // Formu gönder
        }
    });
});
</script>

<?

				
				
$sor = mysql_query("select * from oylar WHERE entry_id = '$id' and oy = 1");
$arti = mysql_num_rows($sor);
$arti = "<b><font size=1>: $arti</a></b>";

$sor = mysql_query("select * from oylar WHERE entry_id = '$id' and oy = 0");
$eksi = mysql_num_rows($sor);
$eksi = "<b><font size=1>: $eksi</a></b>";
?>
<?/*

				if ($yazar != $kullaniciAdi and $kullaniciAdi) {
					$oylama = "
					&nbsp;					
					<a id=\"hos".$id."\" href=\"javascript:oylama($id,'arti');\" title=Puanım&nbsp;9> <img src=/arti.png width=22 height=22></a><font size=\"2\" color=\"green\"><p id=\"likeCount.$id.\">$arti</p></font>
					<a id=\"bos".$id."\" href=\"javascript:oylama($id,'eksi');\" title=Mix&nbsp;Olmamış> <img src=/eksi.png width=22 height=22></a><font size=\"2\" color=\"red\"><p id=\"dislikeCount.$id.\">$eksi</p></font>&nbsp;
					
					";	}*/

					if ($yazar != $kullaniciAdi and $kullaniciAdi) {
						$oylama = "
						&nbsp;					
						<a id=\"hos".$id."\" href=\"javascript:oylama($id,'arti');\" title=Puanım&nbsp;9> <img src=/img/arti.png width=22 height=22></a><font size=\"2\" color=\"green\"><p id=\"likeCount.$id.\">$arti</p></font>
						<a id=\"bos".$id."\" href=\"javascript:oylama($id,'eksi');\" title=Mix&nbsp;Olmamış> <img src=/img/eksi.png width=22 height=22></a><font size=\"2\" color=\"red\"><p id=\"dislikeCount.$id.\">$eksi</p></font>&nbsp;
						bolsozluk.com/icerik/oyla.php?id='+$id+'&oy='+'arti','oySonuc'+$id
						
						";	}
			

if ($yazar == $kullaniciAdi) {
					$oylama = "
					&nbsp;					
					&nbsp;
					<img src=/img/arti.png width=22 height=22><font size=\"2\" color=\"green\">$arti</font>
					&nbsp;
					
					<img src=/img/eksi.png width=22 height=22><font size=\"2\" color=\"red\">$eksi</font>
					&nbsp;";

					
				}




				if ($kullaniciAdi=="")
				{
					$oylama = "";
				}


				
				if ($kullaniciAdi and $yazarlik != "on" and $yazarlik !="kurumsal")
				{
					$oylama = "";
				}


				// admin check
				$echoyazar = $yazar;
				$sorgu1 = "SELECT nick,yetki FROM user WHERE `nick` = '$yazar'";
				$sorgu2 = mysql_query($sorgu1);
				mysql_num_rows($sorgu2);
				$kayit2=mysql_fetch_array($sorgu2);
				$yetki=$kayit2["yetki"];
				$userNickName=$kayit2["nick"];
				
				if ($yetki == "admin" || $yetki == "mod" || $yetki == "gammaz") {
					$yazar = "$yazar";
				}
				
				// admin check
 //$ispit = "";

				$ispit = "
				<a href=/sozluk.php?process=esikayet&id=$id&sr=$sira title='Şikayet Et'> <font size=1> <img src=/img/sikayet.jpg width=22 height=22> </font></a>
				";
				

$twt = "
<a href=\"https://twitter.com/intent/tweet?text=$q%20-%20//sozluk.php?process=eid%26eid=$id%20%40bolsozluk&related=bolsozluk\" title=Twitle target=%22%5Fblank%22><img src=/img/twitter.png width=22 height=22></a></font>
";
$fb = "
<a href=\"http://www.facebook.com/sharer.php?u=/sozluk.php%3Fprocess=eid%26eid=$id&p[title]=$q\" title=Paylaş target=%22%5Fblank%22> <img src=/img/fb.png width=22 height=22></a></font>
";


				if ($kullaniciAdi) {




if ($isMobile ==0){
					if ($kullaniciAdi != $yazar) {
					    $msg = "
						<a id=\"link".$id."\" href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazartitle&gkonu=$q\" target=%22%5Fblank%22 title=Özel&nbsp;Mesaj> <img src=/img/msgnew.png width=16 height=16></a> 
						";
					}else{
						$msg = "";
					}
					}

if ($isMobile ==1){
					if ($kullaniciAdi != $yazar) {
					    $msg = "
						<a id=\"link".$id."\" href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazartitle&gkonu=$q\" title=Özel&nbsp;Mesaj> <img src=/img/msgnew.png width=16 height=16> </a>  
						";
					}else{
						$msg = "";
					}
					}

				}

				if ($statu == "akillandim" or $statu == "silindi")  {
					if ($kulYetki == "admin" or $kulYetki == "mod") {
						if ($statu == "akillandim") {
							$yazstatu = "Bu entry silinmiş, fakat yazar tarafından hataları tekrar giderilip aktif edilmiş.(Admin onay bekliyor.)";
						}else if ($statu == "silindi"){
							$yazstatu = "Bu entry silinmiş, mod olduğunuz için bu mesajı görüyorsunuz.";
						}else{
						$yazstatu = "";
						}
					}
				}


				$mesaj = str_replace("<br>","/n/s",$mesaj);
			    $mesaj = str_replace("<br />"," /n/s",$mesaj);
			//  $mesaj = *reg_replace("/[^A-Za-z0-9\s\s+'<br>''<br />''/n''/cr']/","/n",$mesaj);
			//	$mesaj = *reg_replace("<","&lt;",$mesaj);
			//	$mesaj = *reg_replace(">","&gt;",$mesaj);
				$mesaj = str_replace("<","&lt;",$mesaj); 
				$mesaj = str_replace(">","&gt;",$mesaj);
				$mesaj = preg_replace("'\@([0-9]{1,9})'","<b>@\\1</b>",$mesaj);
				//$mesaj = preg_replace("'\:\)'","~swh~", $mesaj);
				$mesaj = preg_replace("'\(bkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\`\:]+)\)'","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
				$mesaj = preg_replace("'\(gbkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\`\:]+)\)'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
				$mesaj = preg_replace("'\`([\w öçşığüÖÇŞİĞÜ\-\.\´\:]+)\`'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
				$mesaj = preg_replace("'\~([\w öçşığüÖÇŞİĞÜ]+)\~'","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);


				$mesaj = str_replace("&#039;","'",$mesaj);
$uzanti= '#^http+(s)?:\/\/(.*)\.(gif|png|jpg)$#i'; //|gif|png)
if(preg_match($uzanti, $mesaj))
{
//resim gömme öncelikli kodu
//$mesaj = preg_replace('#(http+(s)?://([^\s]*)\.(jpg|gif|png))#', '<a target=_blank href="$1"><img src="$1" alt="" title="" height="150" /></a>', $mesaj);
$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $mesaj); //ORJİNAL LİNK KODU
} else {
$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $mesaj); //ORJİNAL LİNK KODU
}


 //$mesaj = preg_replace("'\(foto: ([\w öçşığüÖÇŞİĞÜ]+)\)'","<a target=_blank href=\"$1\"><img src=\"http://www.imgelem.org/files/$1.jpg\" alt=\"\" title=\"\" height=\"200\" /></a>",$mesaj); 
 //$mesaj = preg_replace("'\(foto: ([\w öçşığüÖÇŞİĞÜ.]+)\)'","<a target=_blank href=http://eksiye.com/i/p/$1.jpg><img src=\"http://eksiye.com/i/p/$1.jpg\" alt=\"\" title=\"\" height=\"300\" /></a>",$mesaj); 
        $mesaj = preg_replace("'\(soundcloud: ([\w öçşığüÖÇŞİĞÜ]+)\)'","<br><iframe width=\"50%\" height=\"120\" scrolling=\"no\" frameborder=\"no\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/\\1&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true\"></iframe>",$mesaj); 
				$mesaj = str_replace("/n/s","<br>",$mesaj);
			

				$mesaj = str_replace("\\\'","'",$mesaj);
				$mesaj = preg_replace("'\(kalin: ([\w öçşığüÖÇŞİĞÜ\-_`\']+)\)'","<b>\\1</b>",$mesaj); //ÇALIŞIYOR
			
			//  $youtubeid=  preg_match("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","\\1",$mesaj, $youtubeid); //TEST
		
				
//$id = 'yyDUC1LUXSU'; //Video id goes here
//echo $youtubeid;
//if (yt_exists($youtubeid)) {
//$mesaj = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br> <iframe width=\"320\" height=\"240\" src=\"http://www.youtube.com/embed/\\1\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); //ÇALIŞIYOR eski kod
if ($isMobile ==0)
{
$mesaj = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><br> <iframe width=\"320\" height=\"240\" src=\"https://www.youtube.com/embed/\\1\" frameborder=\"0\" allowfullscreen></iframe><br>",$mesaj); //ÇALIŞIYOR eski kod
}

if ($isMobile ==1)
{
$mesaj = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/\\1\" frameborder=\"0\" allowfullscreen></iframe><br>",$mesaj); //ÇALIŞIYOR eski kod
}

//$mesaj = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<div class=\"youtube\" id=\"$1\" style=\"width: 320px; height: 180px;\"></div> <script src=\"https://www.bolsozluk.com/youtube.js\"></script>",$mesaj); //ÇALIŞMIYOR labnol

if ($isMobile ==0)
{			
$mesaj = preg_replace("'\(spoalbum: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:album:\\1\" width=\"300\" height=\"380\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$mesaj);
$mesaj = preg_replace("'\(spotrack: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:track:\\1\" width=\"300\" height=\"80\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$mesaj);
}

if ($isMobile ==1)
{			
$mesaj = preg_replace("'\(spoalbum: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:album:\\1\" width=\"100%\" height=\"100%\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$mesaj);
$mesaj = preg_replace("'\(spotrack: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:track:\\1\" width=\"100%\" height=\"100%\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$mesaj);
}

$mesaj = preg_replace("'\(audius: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://audius.co/embed/track?id=\\1\"&flavor=card width=\"100%\" height=\"480\" allow=\"encrypted-media\" style=\"border: none;\"></iframe>",$mesaj);

//$mesaj = preg_replace("'\(baklava\)'","<a target=_blank href=\"http://www.yemekye.net/2016/02/ev-baklavasi_21.html\" rel=\"dofollow\">http://www.yemekye.net/2016/02/ev-baklavasi_21.html</a>",$mesaj); 
 				
if ($isMobile ==0)
{	
 				$mesaj = preg_replace("'\(xalbum1x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mXb9O3dPgzo?list=PLqw9aTgi1eS73qYVjCc-xa8iamkiYuE0z\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum2x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/sOIGb-5sUZc?list=PLqw9aTgi1eS4FQ4EfRYzxFMzrUKzK_-Da\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum3x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS4XWJcquK82t7ecI0zIoE3n\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum4x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mIscvBz9U7Y?list=PLqw9aTgi1eS4mQmeMaYdz6D6dlDUk-A4i\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum5x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/YrBOtueof3Q?list=PLqw9aTgi1eS7W7BVfKV-OvGYIMTPP1Cgf\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
				$mesaj = preg_replace("'\(xalbum6x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS7TQlp3Iu0y8aVcr-4sasyx\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum7x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS78a4eLRRCdswGLhvNc_m_1\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum8x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS7A0qEsTaF1I35Bet5q-_Rx\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
        $mesaj = preg_replace("'\(xalbum2020x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS5dUSU6sXN3DqNiRBnKqG-Z\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
        $mesaj = preg_replace("'\(xalbum2022x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS5stayLpeVEZV6dTV_CRCXP\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
        $mesaj = preg_replace("'\(xinsvol1x\)'","<br> <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS6H-4JQ3d7mrdUxyS1P_eLJ\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",$mesaj); 
}

if ($isMobile ==1)
{	
 				$mesaj = preg_replace("'\(xalbum1x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/mXb9O3dPgzo?list=PLqw9aTgi1eS73qYVjCc-xa8iamkiYuE0z\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum2x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/sOIGb-5sUZc?list=PLqw9aTgi1eS4FQ4EfRYzxFMzrUKzK_-Da\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum3x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS4XWJcquK82t7ecI0zIoE3n\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum4x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/mIscvBz9U7Y?list=PLqw9aTgi1eS4mQmeMaYdz6D6dlDUk-A4i\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum5x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/YrBOtueof3Q?list=PLqw9aTgi1eS7W7BVfKV-OvGYIMTPP1Cgf\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
				$mesaj = preg_replace("'\(xalbum6x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS7TQlp3Iu0y8aVcr-4sasyx\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum7x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS78a4eLRRCdswGLhvNc_m_1\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
 				$mesaj = preg_replace("'\(xalbum8x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS7A0qEsTaF1I35Bet5q-_Rx\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
				$mesaj = preg_replace("'\(xalbum2020x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS5dUSU6sXN3DqNiRBnKqG-Z\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
				$mesaj = preg_replace("'\(xinsvol1x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS6H-4JQ3d7mrdUxyS1P_eLJ\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",$mesaj); 
        $mesaj = preg_replace("'\(xalbum2022x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS5stayLpeVEZV6dTV_CRCXP\" frameborder=\"0\" allowfullscreen></iframe>",$mesaj); 
}

$mesaj = preg_replace("'\(killshot\)'","<br> <iframe src=\"https://audiomack.com/embed/song/eminem/killshot?background=1\" scrolling=\"no\" width=\"85%\" height=\"214\" scrollbars=\"no\" frameborder=\"0\"></iframe>",$mesaj); 
$mesaj = preg_replace("'\(vol5kapak: \)'","<img src=https://s3.eksiup.com/1bb41ed8c26.jpg width=500>",$mesaj);
$mesaj = preg_replace("'\(bolgraph: \)'","<a href=\"/img/bolgraph1.jpg\"><img border=\"0\" src=\"/img/bolgraph1.jpg\"  width=\"500\"></a>", $mesaj);
$mesaj = preg_replace("'\(screhber: \)'","<a href=\"/img/soundcloud.png\"><img border=\"0\" src=\"/youtube.png\" width=\"400\" height=\"400\"></a>", $mesaj);
$mesaj = preg_replace("'\(ytrehber: \)'","<a href=\"/img/youtube.png\"><img border=\"0\" src=\"/soundcloud.png\" width=\"400\" height=\"400\"></a>", $mesaj);
$mesaj = preg_replace("'\(kuvvetmira: \)'","<blockquote class=\"twitter-tweet\"><p lang=\"tr\" dir=\"ltr\">Biz Türk Rap’in 4 kişilik temel taşıyız.<br>Görüşmesek de,buluşmasak da, atışsak da,herbirimizin ayrı ayrı hakkı vardır.Yaşasın Rap<a href=\"https://twitter.com/ceza_ed?ref_src=twsrc%5Etfw\">@ceza_ed</a> <a href=\"https://twitter.com/fuat_ergin?ref_src=twsrc%5Etfw\">@fuat_ergin</a> <a href=\"https://twitter.com/hashtag/drfuchsofficial?src=hash&amp;ref_src=twsrc%5Etfw\">#drfuchsofficial</a><a href=\"https://t.co/oSu8ddfNPZ\">https://t.co/oSu8ddfNPZ</a><a href=\"https://t.co/K8Hm3pMG4m\">https://t.co/K8Hm3pMG4m</a><a href=\"https://t.co/URMOc2OaHz\">https://t.co/URMOc2OaHz</a><a href=\"https://t.co/3hA9gp6xe9\">https://t.co/3hA9gp6xe9</a></p>&mdash; sagopa kajmer (@Sagopakajmerrap) <a href=\"https://twitter.com/Sagopakajmerrap/status/1356160771512795137?ref_src=twsrc%5Etfw\">February 1, 2021</a></blockquote> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>",$mesaj);
$mesaj = preg_replace("'\(evinedon: \)'","<br> <blockquote class=\"twitter-tweet\" lang=\"tr\"><p>Artık herkes evine dönmeli.</p>&mdash; Abdullah Gül (@cbabdullahgul) <a href=\"https://twitter.com/cbabdullahgul/statuses/345799286551891969\">15 Haziran 2013</a></blockquote> <script async src=\"//platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>",$mesaj);

$mesaj = preg_replace("/#([0-9\/\.]{3,9})/", "<a href=sozluk.php?process=eid&eid=\\1>#\\1</a>",$mesaj);				
  			//$mesaj = preg_replace("'\(#([\w öçşığüÖÇŞİĞÜ]+)\)'", "<a target=\"_new\" href=\"http://twitter.com/search?q=\\2\">#\\2</a>",$mesaj);				
				//$mesaj = preg_replace("/#([A-Za-z\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>",$mesaj);		
	


if ($mod == "arabul")
{
//$mesaj = renklendir($mesaj, $aranacak , $renk = '#800080');
//$mesaj = highlight($mesaj, $aranacak);
	$mesaj = highlight_word($mesaj, $aranacak , $renk = '#800080');
}

	if ($baslik == "sözlükle ilgili istekler" and $istekhatti == "1") {
					echo "</font>
				 <li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";
					echo "<img src=/img/green-mark.png width=50 title=\"Çözüldü.\">";
				}

	if ($baslik == "sözlükle ilgili istekler" and $istekhatti == "2") {
					echo "</font>
				 <li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";
					echo "<img src=/img/no-image-icon-23481.png width=50 title=\"Reddedildi.\">";
				}


	if ($baslik == "sözlükle ilgili istekler" and $istekhatti == "3") {
					echo "</font>
				 <li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";
					echo "<img src=/img/talep.png width=50 title=\"Talep Alındı.\">";
				}

	if ($baslik == "sözlükle ilgili istekler" and $istekhatti == "777") {
					echo "</font>
				 <li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";
					echo "<img src=/img/cropped-heart.png width=50 title=\"şimdi cennettesin tuna\">";
				}



	if ($baslik == "sözlükle ilgili istekler" and ($istekhatti == "0" or $istekhatti == "4")) {
		echo "</font>
				 <li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";

				}
				
				if ($baslik != "sözlükle ilgili istekler") {

					
					if ( $kullaniciAdi == "")
					{

						//ENTRY ARASI REKLAM
$rand=rand(00,100); 
if (($rand > 80) && ($randrek <2) && ($kullaniciAdi == "") ) //maksimum 2 reklam
{
	$randrek = $randrek + 1;
//echo"<small><i>reklamlar</i></small>" ;
?>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<!-- bolBanner -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7095410555"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>


<br>
<br>
<?
}
}

		echo "</font><li value=".$say." class='eol'  onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' >$mesaj";
				//$mesajcount = ($mesajcount + str_word_count($mesaj));
				//echo str_word_count($mesaj);
				//echo " ";
				//echo $mesajcount;
	//$sorgu = "UPDATE konular SET mesajcount='$mesajcount' WHERE id='$konuid'";
	//mysql_query($sorgu);

				}



			

				if ($updater == "admtem Administrator") {
					$updater = "<img src=img/unlem.gif> $updater";
				}
					
				if ($updater and $updater != "admin"){
					//echo $update;
					$result = substr($update, 0, 10);
					$result2 = "$gun/$ay/$yil";
					//echo $result;
					//echo $result2;
					if ($result == $result2) {$update =  substr($update, 10, 15); }
					//if (substr('$update', 1, 2) === ':') { substr_replace($update, '0', 0, 0);}

					$bastir = "~ $update";
                    $bastirnew = "~";
				}else{
					$bastir = "";
				}
					
				if ($updater and ($kulYetki == "admin" or $kulYetki == "mod"))
					echo "<br>------------------------------------------------------------------------------<br>
					<font size=1>$updater tarafindan düzenlendi.$updatesebep</font>
					";
				
				if ($yazstatu and $yazstatu == "wait") {
					echo "<br><font color=white size=1><img src=img/unlem.gif>Bu entry'i bir çaylak yazmış.</font>";
			}
			
		/*	if ($yazstatu and $yazstatu == "on" ) {
				echo "<br><font color=white size=1><img src=img/unlem.gif>$yazstatu</font>";
			}

				if ($yazstatu and $yazstatu == "akillandim" ) {
				echo "<br><font color=white size=1><img src=img/unlem.gif>$yazstatu</font>";
			}*/

			if ($yazstatu and $yazstatu != "wait") {
				echo "<br><font color=white size=1><img src=img/unlem.gif>$yazstatu</font>";
			}


/*

if ($gds=="s")
{
	// $yazar ="anonim";
		$msg ="";
}

*/
			echo "
				<div align='right'>";

				/*
        if ($gds =="s"){
echo "
				<b><a href=\"\" title=\"anonim\"><font size=1>anonim</A>";
}

				if ($gds =="s" and $sahibi =="$yazar"){
echo " | soruyu soran |";
//echo "$yazar";
}
*/

$kimse1=mysql_fetch_array(mysql_query("SELECT * from user where nick='$yazar'"));
$kimse = $kimse1["nick"];
$verified = $kimse1["verified"];






if($gorunum=="1"){ 

if($verified=="1"){ echo "<img src=\"https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-gold-512.png\" title=\"onaylı hesap\" width=16 height=16> <font size=1>";}

				if (($kulYetki == "admin" or $kulYetki == "mod") and ($yazar =="anonim")){
echo "<font size=1><b>| $ilkyazar |</b></font>";
//echo "$yazar";
}

        if (($kulYetki == "admin" or $kulYetki == "mod") and ($yazar =="bolgpt")){
echo "<font size=1><b>| $ilkyazar |</b></font>";
//echo "$yazar";
}

 // if ($gds !="s"){
echo "
				<b><a href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A> ";
// }


				if ($gds !="s"){
				echo "| <a href=\"sozluk.php?process=entrylerim&kimdirbu=$echoyazar\" title=\"kimdir nedir\">?</A> |";
				}

				if ($kulYetki == "admin" or $kulYetki == "mod") {
				echo "| <a href=\"sozluk.php?process=adm&islem=kullanici&update=ok&gnick=$echoyazar\" title=\"kozmik oda\">♦</A> |";
				}

				if ($kulYetki != "admin")
				{ //$bastir
				echo "</B> $gun.$ay.$yil $saat </font>
				<div onMouseOut='javascript:hideEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' align='right'>
				<span class='entryDiv' id='".$id."' ><span class=\"oySonuc\" id='oySonuc".$id."'></span>
				(<a href=/sozluk.php?process=eid&eid=$id target=%22%5Fblank%22><font face=verdana size=1>#$id</font></a>) $istek1 $istek2 $istek3 $istek4 $duzenle $sil $ebol $anon $ispit $twt $msg $oylama $kanaat  $menu
				</span>				
				</div>
				</li>
				</font></font>
				";
			}
        }

        //NEW ENTRY UI 06.02.2024
        if($gorunum=="2"){       
			$sorgu = "SELECT * FROM user WHERE `nick` = '$yazar'";
			$sorgulama = @mysql_query($sorgu);
			
			if (@mysql_num_rows($sorgulama)>0){
			
				while ($kayit=@mysql_fetch_array($sorgulama)){
					
					$avatar=$kayit["avatar"];
					if ($avatar == "") $avatar = "https://ekstat.com/img/default-profile-picture-light.svg"; 
				}

				if (($kulYetki == "admin" or $kulYetki == "mod") && $yazar == "anonim") $yazar =  "@" . $ilkyazar;

			}

$onayli = "";



/// "<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazar&gkonu=$link\"><font size=1>[/mesaj]</font></a>"

if($verified=="1"){ $onayli = "<img src=\"https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-gold-512.png\" title=\"onaylı hesap\" width=16 height=16> <font size=1>";}

//				<b><a href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A></B> | $gun.$ay.$yil $saat $bastir</font>
				//if ($kulYetki == "admin")
				//{
				echo "
                
                
                
                </B> <div onMouseOut='javascript:showEntryDiv(".$id.");' onMouseOver='javascript:showEntryDiv(".$id.");' align='right'>
				<span class='entryDiv' id='".$id."' ><span class=\"oySonuc\" id='oySonuc".$id."'></span> </div>





				<table>
				<tbody>
				<tr>
					<td></td>
					<td style='text-align: right; white-space: nowrap;'>
						<b>
							<a href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\">
								<font size='1'>$yazar</font>
							</a>
							$onayli $kulliyat $menu
						</b>
				<br>
                <span style='font-size: 0.8em; color: #888;'> $gun/$ay/$yil $saat $bastir </font></span>
					</td>
					<td rowspan='2'>
						<div style='width: 40px; height: 40px; border-radius: 50%; overflow: hidden;'>
							<a href='sozluk.php?process=entrylerim&kimdirbu=$echoyazar'>
								<img src='$avatar' alt='Avatar' style='width: 100%; height: 100%; object-fit: cover;'>
							</a>
						</div>
					</td>
				</tr>
			</tbody>
</table>

<a id=\"hos".$id."\" href=\"javascript:oylama($id,'arti');\" title=Puanım&nbsp;9> <font color= green> <span class=\"material-symbols-outlined\"> heart_plus </span></font></a><font size=\"1\">$arti</font>          <a id=\"bos".$id."\" href=\"javascript:oylama($id,'eksi');\" title=Mix&nbsp;Olmamış> <font color= red> <span class=\"material-symbols-outlined\"> stat_minus_2 </span></font></a><font size=\"1\">$eksi</font>&nbsp;  

				
				

				
				</li>
				</font></font>
                <br><br>
				";
			//}
        }


			
		}
	}else if ($statu != "silindi") {
	}
//				<b><a href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A></B> | <a href=\"sozluk.php?process=entrylerim&kimdirbu=$echoyazar\" title=\"kimdir nedir?\"><font size=1>?</A> | $gun.$ay.$yil $saat $bastir</font>
			// ORJ // <b><a href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A></B> | $gun.$ay.$yil $saat $bastir</font>

// alt nav

		if (($mod != "sukela") && ($mod != "arabul"))
	{


//SAYFA NAVİGASYONU
	if ($goster >1 ) {
		echo "<p align=center class=eol><font face=Verdana size=1>Sayfalar: ";
	if ($sayfa >= 1 or !$sayfa) {
		$linksayfa = $sayfa - 1;
		if ($sayfa > 1 or $sayfa) {
			if ($sayfa != 1)
        echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=1\"><font color=red face=verdana size=1><b>|<</b></font></a> ";
        echo "&nbsp;";
				echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$linksayfa\"><font color=red face=verdana size=1><b><<</b></font></a> ";

				}
		}
// test
		echo "<select class=ksel onchange=\"jm('self',this,0);\" name=sayfa>";
	for ($i=1;$i<=$goster;$i++) {
						if ($sayfa == $i) {
							echo "<option value=\"/sozluk.php?process=word&q=$q&sayfa=$i\" selected>$i</OPTION>"; //$q
						}else{
							echo "<OPTION value=\"/sozluk.php?process=word&q=$q&sayfa=$i\">$i</OPTION>"; //$q
						}
					}
		echo "</SELECT>";
	}

if ($sayfa >= 1 or !$sayfa) {
	if (!$sayfa)
	$sayfa = 1;
	$linksayfa = $sayfa + 1;
	
	if ($linksayfa <= $goster) {
		echo " <a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$linksayfa\"><font color=red face=verdana size=1><b>>></b></font></a>";
    echo "&nbsp;";
    echo "<a class=link href=\"/sozluk.php?process=word&q=$q&sayfa=$goster\"><font color=red face=verdana size=1><b>>|</b></font></a> ";
	}
}
}
//alt nav	



	$sorgu1 = "SELECT id,hit FROM konular WHERE `id` = '$konuid'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$hit=$kayit2["hit"];
	$hit++;
	$sorgu = "UPDATE konular SET hit='$hit' WHERE id='$konuid'";
	mysql_query($sorgu);
//echo $yazarlik;
if ($kullaniciAdi and $yazarlik != "on" and $yazarlik !="kurumsal") {
	echo "<br>";
	echo "<b>...ç a y l a k s ı n ı z... en az 10 entry girdiğinizde entryleriniz incelenip hesabınız onaylanacaktır. 10 entryden sayıca daha çok ve çoğunlukla bilgi içerikli entryler girmeniz yazarlık onayınızı hızlandıracaktır..</b>";
	echo "<br>";
}

if ($kullaniciAdi)
{
if (($baslik =='sözlükle ilgili duyurular' or $baslik =='gururlarımız') and ($kulYetki !="admin"))
{
}
else
{
/*<?echo "$q" ?> hakkında kafanızda bir tanım veya verebileceğiniz bir örnek varsa eklemekten çekinmeyin:*/
//BAŞLIĞA ENTRY GİRME INPUTBOX
?>

    <form method="post" action="">
        <table width="100%" align="left" class="dash">
            <tr>
                <td colspan="2">
                    <textarea id="entry" name="mesaj" rows="8" style="width:100%;height:12em;resize:yes;text-transform:none !important;"></textarea>
                </td>
            </tr>
            <tr>
                    <td width="20%" >
               
                        <input id="kaydet" class=butx type="submit" name="kaydet" value="gönder" onClick="javascript:dekaydet();">
                        <input type=hidden name=ok value=ok>
                        <input type=hidden name=okmsj value=ok>
                        <input type="hidden" name="gonder" value="kaydet">
        				<input type="submit" class=butx name="kenar" value="kenar"/>


					<td width="80%" align="right" valign="top"> 
                        <input class="butx" type="button" name="bkz" value="bkz" onClick="return insert('entry','(bkz: ',')');">
                        <input class="butx" type="button" name="bkz" value="gizli bkz" onClick="return insert('entry','`','`');">
                        <input class="butx" type="button" name="bkz" value="youtube" onClick="return insert('entry','(youtube: ',')');">
                        <input class="butx" type="button" name="bkz" value="sptfy albüm" onClick="return insert('entry','(spoalbum: ',')');">
                        <input class="butx" type="button" name="bkz" value="sptfy track" onClick="return insert('entry','(spotrack: ',')');">
                        <input class="butx" type="button" name="bkz" value="sndcld" onClick="return insert('entry','(soundcloud: ',')');">
                        <input class="butx" type="button" name="bkz" value="kalın" onClick="return insert('entry','(kalin: ',')');">
                        <input class="butx" type="button" name="bkz" value="*" onClick="return insert('entry','~','~');">
                        <input class="butx" type="button" name="bkz" value="-s!-" onClick="return insert('entry','\n--`spoiler`--\n','\n--`spoiler`--\n\n');" accesskey=v>
                    </td>
                </td>
		</tr>
        </table>
    </form>
    <br>
butonları kullanmadan da;<br>
Bakmak için bakınız: (bkz: kelime)<br>
Çaktırmadan bakınız: (gbkz: kelime)<br>
<br>
<?
}
}
?>
</div>

<?


function sendMessage($uid, $txt, $tok) {
$url = 'https://api.telegram.org/bot' . $tok . '/sendMessage?chat_id='.$uid.'&text=BS';
$ch = curl_init( );
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
// Allowing cUrl funtions 20 second to execute
curl_setopt ( $ch, CURLOPT_TIMEOUT, 5 );
// Waiting 20 seconds while trying to connect
curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 5 );                                 
$response_string = curl_exec( $ch );
curl_close($ch);
//echo $response_string;
}

if ($baslik=="dolar")
{
	echo "
	
<div class=\"tradingview-widget-container\">
  <div id=\"tradingview_597fe\"></div>
  <div class=\"tradingview-widget-copyright\"><a href=\"https://www.tradingview.com/symbols/FX-USDTRY/\" rel=\"noopener\" target=\"_blank\"><span class=\"blue-text\">USDTRY chart</span></a> by TradingView</div>
  <script type=\"text/javascript\" src=\"https://s3.tradingview.com/tv.js\"></script>
  <script type=\"text/javascript\">
  new TradingView.widget(
  {
  \"width\": 980,
  \"height\": 610,
  \"symbol\": \"FX:USDTRY\",
  \"interval\": \"1\",
  \"timezone\": \"Europe/Istanbul\",
  \"theme\": \"Light\",
  \"style\": \"1\",
  \"locale\": \"en\",
  \"toolbar_bg\": \"#f1f3f6\",
  \"enable_publishing\": false,
  \"allow_symbol_change\": true,
  \"container_id\": \"tradingview_597fe\"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
";
}
?>

<?
if ($baslik=="petrol")
{
	echo "
	
<div class=\"tradingview-widget-container\">
  <div id=\"tradingview_597fe\"></div>
  <div class=\"tradingview-widget-copyright\"><a href=\"https://www.tradingview.com/symbols/FX-UKOIL/\" rel=\"noopener\" target=\"_blank\"><span class=\"blue-text\">UKOIL chart</span></a> by TradingView</div>
  <script type=\"text/javascript\" src=\"https://s3.tradingview.com/tv.js\"></script>
  <script type=\"text/javascript\">
  new TradingView.widget(
  {
  \"width\": 980,
  \"height\": 610,
  \"symbol\": \"UKOIL\",
  \"interval\": \"1\",
  \"timezone\": \"Europe/Istanbul\",
  \"theme\": \"Light\",
  \"style\": \"1\",
  \"locale\": \"en\",
  \"toolbar_bg\": \"#f1f3f6\",
  \"enable_publishing\": false,
  \"allow_symbol_change\": true,
  \"container_id\": \"tradingview_597fe\"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
";
}
?>


<?
if ($kullaniciAdi == "")
{
?>
<div id=reklam>
<a name="son"></a>
<center>
	
	
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<!-- bolBanner -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7095410555"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
	<br>
<center>
	<br>
	<br>
	</div>
<?
	}

include "footer.php";
echo "<br>";
echo "<br>";
if ($kullaniciAdi) {include "bolchat.php";}
if ($kullaniciAdi == "") {
	echo "<center><br><br><b>bol sözlük on the mic:<br><br></b>";
	echo $gururlist[37];
	echo "</center>";
}
	
?>
</center>
</font>
<?
$rand=rand(00,100); 
if ($rand > 100)
{
?>
<script type="text/javascript"  charset="utf-8">

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';q N=\'\',28=\'1V\';1R(q i=0;i<12;i++)N+=28.X(D.K(D.I()*28.F));q 34=8,2E=5i,2f=22,2u=5l,2v=C(e){q i=!1,o=C(){B(k.1g){k.2Q(\'2W\',t);E.2Q(\'1U\',t)}O{k.2R(\'36\',t);E.2R(\'1W\',t)}},t=C(){B(!i&&(k.1g||5o.2F===\'1U\'||k.2U===\'2V\')){i=!0;o();e()}};B(k.2U===\'2V\'){e()}O B(k.1g){k.1g(\'2W\',t);E.1g(\'1U\',t)}O{k.32(\'36\',t);E.32(\'1W\',t);q n=!1;2g{n=E.5u==5v&&k.1Y}2t(a){};B(n&&n.2s){(C r(){B(i)G;2g{n.2s(\'17\')}2t(t){G 4T(r,50)};i=!0;o();e()})()}}};E[\'\'+N+\'\']=(C(){q e={e$:\'1V+/=\',4W:C(t){q r=\'\',d,n,i,c,s,l,o,a=0;t=e.t$(t);1a(a<t.F){d=t.14(a++);n=t.14(a++);i=t.14(a++);c=d>>2;s=(d&3)<<4|n>>4;l=(n&15)<<2|i>>6;o=i&63;B(2y(n)){l=o=64}O B(2y(i)){o=64};r=r+V.e$.X(c)+V.e$.X(s)+V.e$.X(l)+V.e$.X(o)};G r},11:C(t){q n=\'\',d,l,c,s,a,o,r,i=0;t=t.1A(/[^A-4Y-56-9\\+\\/\\=]/g,\'\');1a(i<t.F){s=V.e$.1H(t.X(i++));a=V.e$.1H(t.X(i++));o=V.e$.1H(t.X(i++));r=V.e$.1H(t.X(i++));d=s<<2|a>>4;l=(a&15)<<4|o>>2;c=(o&3)<<6|r;n=n+S.T(d);B(o!=64){n=n+S.T(l)};B(r!=64){n=n+S.T(c)}};n=e.n$(n);G n},t$:C(e){e=e.1A(/;/g,\';\');q n=\'\';1R(q i=0;i<e.F;i++){q t=e.14(i);B(t<1s){n+=S.T(t)}O B(t>5a&&t<6e){n+=S.T(t>>6|6j);n+=S.T(t&63|1s)}O{n+=S.T(t>>12|2T);n+=S.T(t>>6&63|1s);n+=S.T(t&63|1s)}};G n},n$:C(e){q i=\'\',t=0,n=6l=1u=0;1a(t<e.F){n=e.14(t);B(n<1s){i+=S.T(n);t++}O B(n>6c&&n<2T){1u=e.14(t+1);i+=S.T((n&31)<<6|1u&63);t+=2}O{1u=e.14(t+1);2w=e.14(t+2);i+=S.T((n&15)<<12|(1u&63)<<6|2w&63);t+=3}};G i}};q r=[\'69==\',\'5H\',\'5I=\',\'5J\',\'5S\',\'5V=\',\'5Z=\',\'61=\',\'62\',\'3G\',\'3v=\',\'4f=\',\'5L\',\'6y\',\'4c=\',\'4b\',\'4a=\',\'49=\',\'48=\',\'47=\',\'46=\',\'45=\',\'44==\',\'43==\',\'42==\',\'41==\',\'40=\',\'3Y\',\'3K\',\'3X\',\'3W\',\'3V\',\'3U\',\'3T==\',\'3S=\',\'3R=\',\'3Q=\',\'3P==\',\'3O=\',\'3N\',\'3M=\',\'3L=\',\'4d==\',\'3Z=\',\'4e==\',\'4v==\',\'4J=\',\'4I=\',\'4H\',\'4G==\',\'4F==\',\'4E\',\'4D==\',\'4C=\'],y=D.K(D.I()*r.F),Y=e.11(r[y]),w=Y,M=1,v=\'#4B\',a=\'#4A\',g=\'#4z\',W=\'#4y\',Q=\'\',b=\'4x!\',p=\'4w 4u 4g 4t 4sı2r 3I. 4q 4pı2r 4o?\',f=\'4n 2D 4m 4l 2M 4k 4j 4iız 4hız.\',s=\'3Jı3F, 2M 3g i&38;3b 2D 3f 3e dışı bı3dğım!\',i=0,u=0,n=\'3c.39\',l=0,Z=t()+\'.2O\';C h(e){B(e)e=e.1S(e.F-15);q i=k.2S(\'3a\');1R(q n=i.F;n--;){q t=S(i[n].1G);B(t)t=t.1S(t.F-15);B(t===e)G!0};G!1};C m(e){B(e)e=e.1S(e.F-15);q t=k.3i;x=0;1a(x<t.F){1n=t[x].1Q;B(1n)1n=1n.1S(1n.F-15);B(1n===e)G!0;x++};G!1};C t(e){q n=\'\',i=\'1V\';e=e||30;1R(q t=0;t<e;t++)n+=i.X(D.K(D.I()*i.F));G n};C o(i){q o=[\'3E\',\'3D==\',\'3C\',\'3B\',\'33\',\'3A==\',\'3z=\',\'3y==\',\'3x=\',\'3w==\',\'3u==\',\'3j==\',\'3t\',\'3s\',\'3r\',\'33\'],a=[\'2H=\',\'3q==\',\'3p==\',\'3o==\',\'3n=\',\'3m\',\'3l=\',\'3k=\',\'2H=\',\'4K\',\'4r==\',\'3h\',\'5e==\',\'68==\',\'67==\',\'66=\'];x=0;1P=[];1a(x<i){c=o[D.K(D.I()*o.F)];d=a[D.K(D.I()*a.F)];c=e.11(c);d=e.11(d);q r=D.K(D.I()*2)+1;B(r==1){n=\'//\'+c+\'/\'+d}O{n=\'//\'+c+\'/\'+t(D.K(D.I()*20)+4)+\'.2O\'};1P[x]=26 24();1P[x].1X=C(){q e=1;1a(e<7){e++}};1P[x].1G=n;x++}};C L(e){};G{2h:C(e,a){B(5Y k.J==\'5X\'){G};q i=\'0.1\',a=w,t=k.1d(\'1y\');t.1k=a;t.j.1h=\'1O\';t.j.17=\'-1o\';t.j.U=\'-1o\';t.j.1t=\'29\';t.j.13=\'5W\';q d=k.J.2X,r=D.K(d.F/2);B(r>15){q n=k.1d(\'2a\');n.j.1h=\'1O\';n.j.1t=\'1r\';n.j.13=\'1r\';n.j.U=\'-1o\';n.j.17=\'-1o\';k.J.5U(n,k.J.2X[r]);n.1f(t);q o=k.1d(\'1y\');o.1k=\'2Y\';o.j.1h=\'1O\';o.j.17=\'-1o\';o.j.U=\'-1o\';k.J.1f(o)}O{t.1k=\'2Y\';k.J.1f(t)};l=5G(C(){B(t){e((t.1T==0),i);e((t.23==0),i);e((t.1K==\'2l\'),i);e((t.1N==\'2C\'),i);e((t.1J==0),i)}O{e(!0,i)}},27)},1F:C(t,c){B((t)&&(i==0)){i=1;E[\'\'+N+\'\'].1z();E[\'\'+N+\'\'].1F=C(){G}}O{q f=e.11(\'5R\'),u=k.5Q(f);B((u)&&(i==0)){B((2E%3)==0){q l=\'5P=\';l=e.11(l);B(h(l)){B(u.1E.1A(/\\s/g,\'\').F==0){i=1;E[\'\'+N+\'\'].1z()}}}};q y=!1;B(i==0){B((2f%3)==0){B(!E[\'\'+N+\'\'].2x){q d=[\'5O==\',\'5N==\',\'5M=\',\'4L=\',\'5K=\'],m=d.F,a=d[D.K(D.I()*m)],r=a;1a(a==r){r=d[D.K(D.I()*m)]};a=e.11(a);r=e.11(r);o(D.K(D.I()*2)+1);q n=26 24(),s=26 24();n.1X=C(){o(D.K(D.I()*2)+1);s.1G=r;o(D.K(D.I()*2)+1)};s.1X=C(){i=1;o(D.K(D.I()*3)+1);E[\'\'+N+\'\'].1z()};n.1G=a;B((2u%3)==0){n.1W=C(){B((n.13<8)&&(n.13>0)){E[\'\'+N+\'\'].1z()}}};o(D.K(D.I()*3)+1);E[\'\'+N+\'\'].2x=!0};E[\'\'+N+\'\'].1F=C(){G}}}}},1z:C(){B(u==1){q R=2m.6w(\'2j\');B(R>0){G!0}O{2m.6v(\'2j\',(D.I()+1)*27)}};q h=\'6t==\';h=e.11(h);B(!m(h)){q c=k.1d(\'6r\');c.1Z(\'6q\',\'6p\');c.1Z(\'2F\',\'1m/6o\');c.1Z(\'1Q\',h);k.2S(\'6n\')[0].1f(c)};6m(l);k.J.1E=\'\';k.J.j.16+=\'P:1r !19\';k.J.j.16+=\'1C:1r !19\';q Z=k.1Y.23||E.2G||k.J.23,y=E.6k||k.J.1T||k.1Y.1T,r=k.1d(\'1y\'),M=t();r.1k=M;r.j.1h=\'2z\';r.j.17=\'0\';r.j.U=\'0\';r.j.13=Z+\'1v\';r.j.1t=y+\'1v\';r.j.2p=v;r.j.21=\'6i\';k.J.1f(r);q d=\'<a 1Q="6h://6g.6f" j="H-1e:10.6d;H-1j:1i-1l;1c:5T;">5F-5E 5D</a>\';d=d.1A(\'5b\',t());d=d.1A(\'59\',t());q o=k.1d(\'1y\');o.1E=d;o.j.1h=\'1O\';o.j.1B=\'1I\';o.j.17=\'1I\';o.j.13=\'58\';o.j.1t=\'57\';o.j.21=\'2o\';o.j.1J=\'.6\';o.j.2k=\'2d\';o.1g(\'54\',C(){n=n.53(\'\').52().51(\'\');E.2i.1Q=\'//\'+n});k.1D(M).1f(o);q i=k.1d(\'1y\'),L=t();i.1k=L;i.j.1h=\'2z\';i.j.U=y/7+\'1v\';i.j.4X=Z-4V+\'1v\';i.j.4U=y/3.5+\'1v\';i.j.2p=\'#4S\';i.j.21=\'2o\';i.j.16+=\'H-1j: "4R 4Q", 1w, 1x, 1i-1l !19\';i.j.16+=\'4P-1t: 4O !19\';i.j.16+=\'H-1e: 5c !19\';i.j.16+=\'1m-1p: 1q !19\';i.j.16+=\'1C: 4Z !19\';i.j.1K+=\'2L\';i.j.35=\'1I\';i.j.5d=\'1I\';i.j.5C=\'2e\';k.J.1f(i);i.j.5B=\'1r 5z 5y -5x 5w(0,0,0,0.3)\';i.j.1N=\'2q\';q w=30,Y=22,x=18,Q=18;B((E.2G<2Z)||(5t.13<2Z)){i.j.37=\'50%\';i.j.16+=\'H-1e: 5q !19\';i.j.35=\'5f;\';o.j.37=\'65%\';q w=22,Y=18,x=12,Q=12};i.1E=\'<2P j="1c:#5n;H-1e:\'+w+\'1L;1c:\'+a+\';H-1j:1w, 1x, 1i-1l;H-1M:5m;P-U:1b;P-1B:1b;1m-1p:1q;">\'+b+\'</2P><2N j="H-1e:\'+Y+\'1L;H-1M:5k;H-1j:1w, 1x, 1i-1l;1c:\'+a+\';P-U:1b;P-1B:1b;1m-1p:1q;">\'+p+\'</2N><5j j=" 1K: 2L;P-U: 0.2J;P-1B: 0.2J;P-17: 2c;P-2I: 2c; 2B:5h 5g #4M; 13: 25%;1m-1p:1q;"><p j="H-1j:1w, 1x, 1i-1l;H-1M:2A;H-1e:\'+x+\'1L;1c:\'+a+\';1m-1p:1q;">\'+f+\'</p><p j="P-U:5s;"><2a 5A="V.j.1J=.9;" 5r="V.j.1J=1;"  1k="\'+t()+\'" j="2k:2d;H-1e:\'+Q+\'1L;H-1j:1w, 1x, 1i-1l; H-1M:2A;2B-4N:2e;1C:1b;55-1c:\'+g+\';1c:\'+W+\';1C-17:29;1C-2I:29;13:60%;P:2c;P-U:1b;P-1B:1b;" 6s="E.2i.6u();">\'+s+\'</2a></p>\'}}})();E.2K=C(e,t){q n=6x.6b,i=E.6a,r=n(),o,a=C(){n()-r<t?o||i(a):e()};i(a);G{3H:C(){o=1}}};q 2n;B(k.J){k.J.j.1N=\'2q\'};2v(C(){B(k.1D(\'2b\')){k.1D(\'2b\').j.1N=\'2l\';k.1D(\'2b\').j.1K=\'2C\'};2n=E.2K(C(){E[\'\'+N+\'\'].2h(E[\'\'+N+\'\'].1F,E[\'\'+N+\'\'].5p)},34*27)});',62,407,'|||||||||||||||||||style|document||||||var|||||||||||if|function|Math|window|length|return|font|random|body|floor|||AhMjWKNiWKis|else|margin|||String|fromCharCode|top|this||charAt||||decode||width|charCodeAt||cssText|left||important|while|10px|color|createElement|size|appendChild|addEventListener|position|sans|family|id|serif|text|thisurl|5000px|align|center|0px|128|height|c2|px|Helvetica|geneva|DIV|LuLyEHisQf|replace|bottom|padding|getElementById|innerHTML|OhHHCJQdKJ|src|indexOf|30px|opacity|display|pt|weight|visibility|absolute|spimg|href|for|substr|clientHeight|load|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|onload|onerror|documentElement|setAttribute||zIndex||clientWidth|Image||new|1000|aRrPXOnhqU|60px|div|babasbmsgx|auto|pointer|15px|oeumpnJNgP|try|UpAdgdOGwD|location|babn|cursor|hidden|sessionStorage|DOXkTwxTgF|10000|backgroundColor|visible|yor|doScroll|catch|sbeTelWTRs|jViRCLAsOk|c3|ranAlready|isNaN|fixed|300|border|none|reklam|RyZzFNawAG|type|innerWidth|ZmF2aWNvbi5pY28|right|5em|cvHhNBQNFS|block|bu|h1|jpg|h3|removeEventListener|detachEvent|getElementsByTagName|224|readyState|complete|DOMContentLoaded|childNodes|banner_ad|640|||attachEvent|cGFydG5lcmFkcy55c20ueWFob28uY29t|HwesUJZdbQ|marginLeft|onreadystatechange|zoom|ccedil|kcolbdakcolb|script|in|moc|rakaca|devre|engelleyicimi|site|ZmF2aWNvbjEuaWNv|styleSheets|YWRzLnp5bmdhLmNvbQ|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|c2t5c2NyYXBlci5qcGc|NzIweDkwLmpwZw|NDY4eDYwLmpwZw|YmFubmVyLmpwZw|YXMuaW5ib3guY29t|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|YWRzLnlhaG9vLmNvbQ|YWQtY29udGFpbmVyLTE|cHJvbW90ZS5wYWlyLmNvbQ|Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|YWdvZGEubmV0L2Jhbm5lcnM|YS5saXZlc3BvcnRtZWRpYS5ldQ|YWQuZm94bmV0d29ya3MuY29t|anVpY3lhZHMuY29t|YWQubWFpbC5ydQ|YWRuLmViYXkuY29t|yorum|YWQtY29udGFpbmVy|clear|gibisin|Anl|RGl2QWQy|YWRiYW5uZXI|YWRCYW5uZXI|YmFubmVyX2Fk|YWRUZWFzZXI|Z2xpbmtzd3JhcHBlcg|QWRDb250YWluZXI|QWRCb3gxNjA|QWREaXY|QWRJbWFnZQ|RGl2QWRD|RGl2QWRC|RGl2QWRB|RGl2QWQz|RGl2QWQx|YmFubmVyYWQ|RGl2QWQ|QWRzX2dvb2dsZV8wNA|QWRzX2dvb2dsZV8wMw|QWRzX2dvb2dsZV8wMg|QWRzX2dvb2dsZV8wMQ|QWRMYXllcjI|QWRMYXllcjE|QWRGcmFtZTQ|QWRGcmFtZTM|QWRGcmFtZTI|QWRGcmFtZTE|QWRBcmVh|QWQ3Mjh4OTA|YWRBZA|IGFkX2JveA|YWQtY29udGFpbmVyLTI|bir|imkans|tutmam|ayakta|siteyi|olmadan|gelirleri|Ancak|ki|kullanm|Kim|c3F1YXJlLWFkLnBuZw|kullan|eklenti|engelleyici|YWRfY2hhbm5lbA|Reklam|Merhaba|FFFFFF|adb8ff|777777|EEEEEE|c3BvbnNvcmVkX2xpbms|b3V0YnJhaW4tcGFpZA|Z29vZ2xlX2Fk|YWRzZW5zZQ|cG9wdXBhZA|YWRzbG90|YmFubmVyaWQ|YWRzZXJ2ZXI|YWQtbGFyZ2UucG5n|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|CCC|radius|normal|line|Black|Arial|fff|setTimeout|minHeight|120|encode|minWidth|Za|12px||join|reverse|split|click|background|z0|40px|160px|FILLVECTID2|127|FILLVECTID1|16pt|marginRight|YmFubmVyX2FkLmdpZg|45px|solid|1px|214|hr|500|211|200|999|event|ifGfznZJhb|18pt|onmouseout|35px|screen|frameElement|null|rgba|8px|24px|14px|onmouseover|boxShadow|borderRadius|solutions|adblock|Anti|setInterval|YWRCYW5uZXJXcmFw|YWQtZnJhbWU|YWQtaGVhZGVy|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|QWQzMDB4MTQ1|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|querySelector|aW5zLmFkc2J5Z29vZ2xl|YWQtaW1n|black|insertBefore|YWQtaW5uZXI|468px|undefined|typeof|YWQtbGFiZWw||YWQtbGI|YWQtZm9vdGVy||||YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|d2lkZV9za3lzY3JhcGVyLmpwZw|bGFyZ2VfYmFubmVyLmdpZg|YWQtbGVmdA|requestAnimationFrame|now|191|5pt|2048|com|blockadblock|http|9999|192|innerHeight|c1|clearInterval|head|css|stylesheet|rel|link|onclick|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|reload|setItem|getItem|Date|QWQzMDB4MjUw'.split('|'),0,{}));
</script>
<?
}
?>
</body>
</html>
