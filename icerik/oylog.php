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





$sorgu = "SELECT * FROM oylar  WHERE `oy` = 0 ORDER BY `id` DESC LIMIT 1000";
$sorgulama = @mysql_query($sorgu);


if (@mysql_num_rows($sorgulama)>0){

if($isMobile == 1)
{ 
echo "
<table width=\"100%\" border=\"1\">
  <tr>
    <td width=\"18%\"><strong>eksi veren</strong></td>
    <td width=\"22%\"><strong>eksi verilen</strong></td>
    <td width=\"16%\"><strong>başlık</strong></td>
        <td width=\"20%\"><strong>entry id</strong></td>
     <td width=\"18%\"><strong>tarih</strong></td>
       <td width=\"27%\"><strong>işlem dakikası</strong></td>
  </tr>

";
}

if($isMobile == 0)
{ 
echo "
<table width=\"700\" height=\"77\" border=\"1\">
  <tr>
    <td width=\"174\"><strong>eksi veren</strong></td>
    <td width=\"600\"><strong>eksi verilen</strong></td>
    <td width=\"534\"><strong>başlık</strong></td>
        <td width=\"600\"><strong>entry id</strong></td>
     <td width=\"534\"><strong>tarih</strong></td>
       <td width=\"534\"><strong>işlem dakikası</strong></td>
  </tr>

";

}

//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$oyveren=$kayit["nick"];
$oylanan=$kayit["entry_sahibi"];
$oykodu=$kayit["oy"];
$entryid=$kayit["entry_id"];
$zamandamga=$kayit["julyen"];
$dakika=$kayit["dakika"];

$zamandamga = jdtogregorian($zamandamga);

$xlistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$entryid'"));
$xbase11 = $xlistele11["sira"];
$xsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$xbase11'"));
$xsonbaslik1 = $xsonbaslik11["baslik"];


echo "
  <tr>
    <td><font size=1><i>$oyveren</i></td>
    <td><font size=1><i>$oylanan</i></td>
       <td><font size=1><i>$xsonbaslik1</i></td>
       <td><font size=1><i>$entryid</i></td>
    <td><font size=1><i>$zamandamga</i></td>
    <td><font size=1><i>$dakika</i></td>
    </tr>

";
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
