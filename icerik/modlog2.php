<?
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

if (($kulYetki != "admin") and ($kulYetki != "mod")) {
  echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=sozluk.php?process=refresh\">";
  die;
}
?>

<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>

<style>
.but {font-size: 12px}
</style>


<?
if($isMobile == 1)
{ 
?>              
<style type="text/css">
table {
    table-layout:fixed;
}

table td {
    overflow:hidden;
}
</style>
<?
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?
extract($_REQUEST); //bunu silebilirim


$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );


$sorgu = "SELECT * FROM user WHERE `durum` = 'sus' AND `bantarih` !='' ORDER BY `bantarih` desc LIMIT 100";
$sorgulama = @mysql_query($sorgu);

$sorgu2 = "SELECT * FROM user WHERE `durum` = 'sus' ORDER BY `siltarih` desc LIMIT 750";
$sorgulama2 = @mysql_query($sorgu2); 
echo "<br>";
echo "<input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog';\" value='silinen entryler' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog2';\" value='banlanan yazarlar' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog3';\" value='editlenen başlıklar' class='but'>";
echo "<br>";
echo "<br>";


if (@mysql_num_rows($sorgulama)>0){


if($isMobile == 1)
{ 

echo "
<table width=\"100%\" border=\"1\">
  <tr>
    <td width=\"17%\"><strong>işlemi yapan</strong></td>
    <td width=\"17%\"><strong>işlem yapılan</strong></td>
    <td width=\"20%\"><strong>işlem mahiyeti</strong></td>
    <td width=\"20%\"><strong>işlem sebebi</strong></td>
    <td width=\"12%\"><strong>işlem tarihi</strong></td>
  </tr>
";
}


if($isMobile == 0)
{ 
echo "
<table width=\"700\" height=\"77\" border=\"1\">
  <tr>
    <td width=\"174\"><strong>işlemi yapan</strong></td>
    <td width=\"534\"><strong>işlem yapılan</strong></td>
    <td width=\"534\"><strong>işlem mahiyeti</strong></td>
    <td width=\"534\"><strong>işlem sebebi</strong></td>
    <td width=\"534\"><strong>işlem tarihi</strong></td>
  </tr>
";


}

//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
     $silen=$kayit["silen"];
    $sorgu3 = "SELECT yetki FROM user WHERE `nick` = '$silen'";
$sorgulama3 = @mysql_query($sorgu3); 
$sorgulama31=@mysql_fetch_array($sorgulama3);
   $yetki=$sorgulama31["yetki"];

//echo $yetki;

//if ($yetki == 'admin' or $yetki == 'mod' or $yetki =='yazar') 

//{

$id=$kayit["id"];
$ip=$kayit["ip"];
$mesaj=$kayit["mesaj"];
$tarih=$kayit["tarih"]; 
$silsebep=$kayit["silsebep"];
$yazar=$kayit["nick"];
$silen=$kayit["silen"];
$statu=$kayit["durum"];
$bantarih=$kayit["bantarih"];

if (empty($silen)) 
{
$silen = 'admin';
}

if (($statu=='sus')) 
{
$statu = 'uçuruldu';
}


/*$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];

$kesbaslik = substr ($baslik, 0, 60);
$titlebaslik = $baslik;
$baslik = ereg_replace(" ","+",$baslik);
$mesaj = ereg_replace("<br>","",$mesaj);

$mesaj = substr ($mesaj, 0, 250);
$mesaj = "$mesaj...";*/


echo "
  <tr>
    <td><font size=1><i>$silen</i></td>
    <td><font size=1><i>$yazar</i></td>
    <td><font size=1><i>$statu</i></td>
    <td><font size=1><i>$silsebep</i></td>
    <td><font size=1><i>$bantarih</i></td>
    </tr>
";
//}
}
}
else {
echo "ispiyon yok henüz.";
}

echo "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- bolsözlük-3 -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:728px;height:90px\"
     data-ad-client=\"ca-pub-7994669731946359\"
     data-ad-slot=\"7236998758\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

";
?>
