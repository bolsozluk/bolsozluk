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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
html {
overflow: -moz-scrollbars-vertical; 
overflow-y: scroll;
}

table {
    table-layout:fixed;
}

table td {
    overflow:hidden;
}

</style>

<?
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if(isset($_POST['sil1'])){
foreach($id as $kayit)
{
$sorgu = "DELETE FROM privmsg WHERE kime = '$kullaniciAdi' and id = '$kayit' LIMIT 1";
mysql_query($sorgu);
}
}

if(isset($_POST['sil2'])){
$sorgu = "DELETE FROM privmsg WHERE kime = '$kullaniciAdi'";
mysql_query($sorgu);
}

$filterUnread = isset($_GET['filter']) && $_GET['filter'] == 'unread';



if ($filterUnread) {
    $sorgu = "SELECT id, konu, gonderen, gun, okundu, ay, yil, saat 
              FROM privmsg 
              WHERE kime = '$kullaniciAdi' AND okundu != 0 
              ORDER BY tarih DESC LIMIT 0,5000";
} else {
    $sorgu = "SELECT id, konu, gonderen, gun, okundu, ay, yil, saat 
              FROM privmsg 
              WHERE kime = '$kullaniciAdi' 
              ORDER BY tarih DESC LIMIT 0,5000";
}

include "mobframe.php";

  if ($isMobile == 0)
{
echo "
    
      <input class=\"but\" type=\"button\" name=\"ymsj\" value=\"Yeni Mesaj\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=yenimsj'\" accesskey=x>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
  <input class=\"but\" type=\"button\" name=\"filter\" value=\"Okunmamışlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&filter=unread'\" accesskey=u>
    <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
    ";
}

  if ($isMobile == 1)
{
echo "
  <TD vAlign=top>     
  <input class=\"but\" type=\"button\" name=\"ymsj\" value=\"Yeni Mesaj\" onclick=\"location.href='sozluk.php?process=privmsg&islem=yenimsj'\" accesskey=x>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg'\" accesskey=c>
  <input class=\"but\" type=\"button\" name=\"filter\" value=\"Okunmamışlar\" onclick=\"location.href='sozluk.php?process=privmsg&filter=unread'\" accesskey=u>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
  </TD>";
}

$sorgulama = mysql_query($sorgu);
$adeto = mysql_num_rows($sorgulama);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele



if($isMobile == 1)
{ 
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53237593-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>
<?
}





  if ($isMobile == 0)
{
echo"
<form name=mailOperations method=post action=>
<table width=\"597\" border=\"1\">
  <tr>
    <td colspan=\"4\">Gelen mesajlar ($adeto) </td>
  </tr>

  <tr>
    <td colspan=\"4\" align=\"center\" valign=\"bottom\"><table width=\"597\" border=\"1\" cellpadding=\"0\" cellspacing=\"1\" bordercolor=\"#00000\">
      <tr>
    <td width=\"27\"><div align=\"center\"></div></td>
    <td width=\"103\"><strong>g&ouml;nderen</strong></td>
    <td width=\"326\"><div align=\"center\"><strong>konu</strong></div></td>
    <td width=\"130\"><div align=\"center\"><strong>tarih</strong></div></td>
  </tr>

";

while ($kayit=mysql_fetch_array($sorgulama)){
$id=$kayit["id"];
$gonderen=$kayit["gonderen"];
$konu=$kayit["konu"];
$gun=$kayit["gun"];
$ay=$kayit["ay"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];
$okundu=$kayit["okundu"];
if ($okundu != 0)
$yeni = "<b>(Yeni)</b>";
else //$gonderen admin
$yeni = "";
echo "
      <tr>
        <td width=\"27\"><center>&nbsp;<input name=\"id[]\" class=inp type=\"checkbox\" id=\"$id\" value=\"$id\"></td>
        <td width=\"103\">&nbsp;<a href=?process=msjoku&id=$id>$gonderen</a></td>
        <td width=\"326\">&nbsp;<a href=?process=msjoku&id=$id>$konu $yeni</a></td>
        <td width=\"130\">&nbsp;<a href=?process=msjoku&id=$id>$gun/$ay/$yil $saat</a></td>
      </tr>
";
}
}

  if ($isMobile == 1)
{
echo"
<form name=mailOperations method=post action=>
<table width=\"100%\" border=\"0\">
  <tr>
    <td colspan=\"5%\">Gelen mesajlar ($adeto) </td>
  </tr>

  <tr>
    <td colspan=\"5%\" align=\"center\" valign=\"bottom\">
    <table width=\"100%\" border=\"1\" cellpadding=\"0\" cellspacing=\"1\" bordercolor=\"#00000\">
            <tr>
        <td width=\"7%\"></td>
        <td width=\"22%\"><center>&nbsp;<strong>gönderen</center></strong></a></td>
        <td width=\"48%\"><center>&nbsp;<strong>konu</center></strong></td>
        <td width=\"23%\"><center>&nbsp;<strong>tarih</center></strong></td>
      </tr>

";

while ($kayit=mysql_fetch_array($sorgulama)){
$id=$kayit["id"];
$gonderen=$kayit["gonderen"];
$konu=$kayit["konu"];
$gun=$kayit["gun"];
$ay=$kayit["ay"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];
$okundu=$kayit["okundu"];
if ($okundu != 0)
$yeni = "<b>(Yeni)</b>";
else //$gonderen admin
$yeni = "";
echo "
      <tr>
        <td width=\"7%\"><center>&nbsp;<input name=\"id[]\" class=inp type=\"checkbox\" id=\"$id\" value=\"$id\"></td>
        <td width=\"22%\">&nbsp;<a href=?process=msjoku&id=$id>$gonderen</a></td>
        <td width=\"48%\">&nbsp;<a href=?process=msjoku&id=$id>$konu $yeni</a></td>
        <td width=\"23%\">&nbsp;<a href=?process=msjoku&id=$id>$gun/$ay/$yil $saat</a></td>
      </tr>
";
}
}
    echo "
      </tr>
    </table></td>
  </tr>
</table>
<input type=hidden name=ok value=ok>
 <form action='' method='POST'>
<input class=\"but\" type=\"submit\" name=\"sil1\" value=\"Seçilenleri Sil\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=v>
<input class='but' type='submit' name='sil2' value='Tümünü Sil' onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=s>	
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"filter\" value=\"Okunmamışlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&filter=unread'\" accesskey=u>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>

 </form>
      </FORM>";
}

//IF NO MSG
else {


echo "Yeni mesajınız yok.";
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

