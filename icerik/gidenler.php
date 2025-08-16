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
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<?
if(isset($_POST['sil1'])){
foreach($id as $kayit)
{
$sorgu = "DELETE FROM privmsg WHERE gonderen= '$kullaniciAdi' and id = '$kayit' LIMIT 1";
mysql_query($sorgu);
}
}

if(isset($_POST['sil2'])){
$sorgu = "DELETE FROM privmsg WHERE gonderen = '$kullaniciAdi'";
mysql_query($sorgu);
}

$sorgu = "select id,kime,konu,gonderen,gun,okundu,ay,yil,saat from privmsg WHERE gonderen = '$kullaniciAdi' ORDER BY tarih desc"; //LIMIT 0,500
$sorgulama = mysql_query($sorgu);
$adeto = mysql_num_rows($sorgulama);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
  //if ($adeto == 500){$uya="max:500 adet görüntülenmektedir.";}
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

include "mobframe.php";


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
echo "

      <input class=\"but\" type=\"button\" name=\"ymsj\" value=\"Yeni Mesaj\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=yenimsj'\" accesskey=x>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
    <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
     ";
}

  if ($isMobile == 1)
{
 // echo "<a id=\"gundem\" href=\"left.php?list=today\" target=\"_top\" title=sol&nbsp;frame> <img src=inc/turuncu.png width=120 border=1></a>";
  // <a id=\"gundem\" href=\"left.php?list=today\" target=\"_top\" title=sol&nbsp;frame> <img src=mobframe.png width=50 border=1></a>

//  <input class=\"but\" type=\"button\" name=\"gundem\" value=\"Gündem\" onclick=\"location.href='left.php?list=today'\" accesskey=x>

echo "
    <TD vAlign=top>
    
      <input class=\"but\" type=\"button\" name=\"ymsj\" value=\"Yeni Mesaj\" onclick=\"location.href='sozluk.php?process=privmsg&islem=yenimsj'\" accesskey=x>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg'\" accesskey=c>
    <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
      </TD>";
}

if ($isMobile ==0)
{
echo"
<form name=mailOperations method=post action=>
<table width=\"597\" border=\"1\">
  <tr>
    <td colspan=\"4\">Giden mesajlar ($adeto) </td>
  </tr>

  <tr>
    <td colspan=\"4\" align=\"center\" valign=\"bottom\"><table width=\"597\" border=\"1\" cellpadding=\"0\" cellspacing=\"1\" bordercolor=\"#00000\">

      <tr>
    <td width=\"103\"><center><strong>alıcı</center></strong></td>
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
$kime=$kayit["kime"];
if ($okundu != 0)
$yeni = "<b>(Yeni)</b>";
else//$kime
$yeni = "";
echo "
      <tr>
        <td width=\"103\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$kime</a></td>
        <td width=\"326\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$konu $yeni</a></td>
        <td width=\"130\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$gun/$ay/$yil $saat</a></td>
      </tr>
";
}
}

if ($isMobile ==1)
{
echo"
<form name=mailOperations method=post action=>
<table width=\"100%\" border=\"0\">
  <tr>
    <td colspan=\"5%\">Giden mesajlar ($adeto) </td>
  </tr>

  <tr>
    <td colspan=\"5%\" align=\"center\" valign=\"bottom\">
    <table width=\"100%\" border=\"1\" cellpadding=\"2\" cellspacing=\"1\" bordercolor=\"#00000\">

    <tr>
    <td width=\"30%\"><center><strong>g&ouml;nderen</strong></center></td>
    <td width=\"40%\"><div align=\"center\"><strong>konu</strong></div></td>
    <td width=\"30%\"><div align=\"center\"><strong>tarih</strong></div></td>
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
$kime=$kayit["kime"];
if ($okundu != 0)
$yeni = "<b>(Yeni)</b>";
else//$kime
$yeni = "";
echo "
      <tr>
        <td width=\"30%\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$kime</a></td>
        <td width=\"40%\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$konu $yeni</a></td>
        <td width=\"30%\">&nbsp;<a href=?process=gidenmsjoku&id=$id>$gun/$ay/$yil $saat</a></td>
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
          <input class=\"but\" type=\"button\" name=\"ymsj\" value=\"Yeni Mesaj\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=yenimsj'\" accesskey=x>
  <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
    <input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>       
 </form>
      </FORM>";
}
else {
echo "";
echo "
Yeni mesajınız yok.";
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

