<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="https://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />


</head>

<style>
@media print {
    html, body {
       display: none;  /* hide whole page */
    }
}
</style>

<?

$eid = guvenlikKontrol($_REQUEST["eid"],"ultra");


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

if ($eid) {

$eid = preg_replace("/#/","",$eid);


$sorgu1 = "SELECT id,sira FROM mesajlar WHERE (`id` = '$eid' and statu != 'silindi' and statu != 'wait')";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$konusira=$kayit2["sira"];
$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$konusira'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];


        $ispit = "
        <a href=/sozluk.php?process=esikayet&id=$eid&sr=$konusira title='Şikayet Et'> <font size=1> <img src=/img/sikayet.jpg width=22 height=22> </font></a>
        ";

if (!$baslik) {
echo "<div class=dash><center><b>Bu numaralı $eid ait bir entry yok.";
die;
}

$sorgux = "SELECT * FROM konular WHERE `baslik`='$baslik'";
$sorgulamax = mysql_query($sorgux);
if (mysql_num_rows($sorgulamax)>0){
  while ($kayit=mysql_fetch_array($sorgulamax)){
    $gds=$kayit["gds"];
}}

$baslik = strtolower($baslik);

$yazar = $kullaniciAdi;

$link = preg_replace("/ /","+",$baslik);

if ($kulYetki == "admin" or $kulYetki == "mod")
$baslikduzenle = "<a class=link> - </a><a class=div href=sozluk.php?process=adm&islem=baslikduzenle&id=$id><font color=green size=2 face=verdana>Düzenle</font></a>";

if ($kulYetki == "admin" or $kulYetki == "mod")
$basliksil = "<br><a class=div href=sozluk.php?process=adm&islem=basliksil&id=$id><font color=red size=2 face=verdana>Sil</font></a>";

$sorgu1 = "SELECT * FROM mesajlar WHERE (`id` = '$eid' and statu != 'silindi')";
$sorgu2 = mysql_query($sorgu1);
$kayit=mysql_fetch_array($sorgu2);
$mesaj=$kayit["mesaj"];
$mesajcount = ($mesajcount + str_word_count($mesaj));
  $mesajcount=(($mesajcount/3.5));
    $mesajcount = floor($mesajcount * 1) / 1;

$sor = mysql_query("select * from oylar WHERE entry_id = '$eid' and oy = 1");
$arti = mysql_num_rows($sor);
$arti = "<b><font size=1>: $arti</a></b>";

$sor = mysql_query("select * from oylar WHERE entry_id = '$eid' and oy = 0");
$eksi = mysql_num_rows($sor);
$eksi = "<b><font size=1>: $eksi</a></b>";

echo "
<title>$baslik - bol sözlük</title>
<TABLE width=\"100%\">
  <TBODY>
  <TR>
    <TD width=\"80%\" height=15>
      <H3><FONT size=3><A href=\"sozluk.php?process=word&q=$link\">$baslik</A> $basliksil $baslikduzenle</FONT>
      </H3></TD>  
</TR></TBODY></TABLE>
";
if ($mesajcount > 60)
{
echo "<a href=/sozluk.php?process=eid&eid=$eid target=%22%5Fblank%22><font face=verdana size=2>#$eid</font></a>";
echo " - ";
echo "<small>bu entryi ortalama $mesajcount saniyede okuyabilirsiniz.</small>";
}


$sorgu1 = "SELECT * FROM mesajlar WHERE (`id` = '$eid' and statu != 'silindi')";
$sorgu2 = mysql_query($sorgu1);
$kayit=mysql_fetch_array($sorgu2);

$id=$kayit["id"];
$sira=$kayit["sira"];
$statu=$kayit["statu"];
$mesaj=$kayit["mesaj"];
$updater=$kayit["updater"];
$yazar=$kayit["yazar"];
$tarih=$kayit["tarih"];
$gun=$kayit["gun"];
$ay=$kayit["ay"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];
$update=$kayit["update2"];
$updatesebep=$kayit["updatesebep"];
$ayazar = $yazar;

$yazarlink = preg_replace("/&/","",$yazar); // adminlerden ~ kaldırıyoruz
$yazartitle = preg_replace("/&/","Administrator / ",$yazar); // adminlerden ~ kaldırıyoruz

//$mesaj = strtolower($mesaj);

$mesaj = preg_replace("/<br>/","/n",$mesaj);
$mesaj = preg_replace("/<br />/","/n",$mesaj);
$mesaj = preg_replace("/</","&lt;",$mesaj);
$mesaj = preg_replace("/>/","&gt;",$mesaj);
$mesaj = preg_replace("//n/","<br>",$mesaj);
$mesaj = preg_replace("'\@([0-9]{1,9})'","<b>@\\1</b>",$mesaj);

$mesaj = preg_replace("'\:\)'","~swh~", $mesaj);

//$mesaj = preg_replace("'\(bkz: (.+?)\)'","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
$mesaj = preg_replace("'\(bkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\`\:]+)\)'","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
$mesaj = preg_replace("'\(gbkz: ([\w öçşığüÖÇŞİĞÜ\-\.\´\:]+)\)'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
$mesaj = preg_replace("'\`(.+?)\`'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
$mesaj = preg_replace("'\~(.+?)\~'","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);

//$mesaj = preg_replace("'([^&])#([0-9]{1,9})'","<a href=sozluk.php?process=eid&eid=\\2>#\\2</a>",$mesaj);

$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6\\8\\9</a>", $mesaj);
$mesaj = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><br> <iframe width=\"320\" height=\"240\" src=\"https://www.youtube.com/embed/\\1\" frameborder=\"0\" allowfullscreen></iframe><br>",$mesaj); //ÇALIŞIYOR eski kod
 $mesaj = str_replace("&#039;","'",$mesaj);
$mesaj = preg_replace("/#([0-9\/\.]{3,9})/", "<a href=sozluk.php?process=eid&eid=\\1>#\\1</a>",$mesaj);   


?>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@bolsozluk">
<meta name="twitter:creator" content="@bolsozluk">
<meta name="twitter:title" content="<?echo $baslik;?>">
<meta name="twitter:description" content="Bol Sözlük">
<meta name="twitter:image" content="https://i.filmot.com/Osi2LRo.png">

<?

$uzunluk = 142;
if($mesaj && strlen($mesaj)>$uzunluk) {
$mesaj=preg_replace("/([^\n\r -]{".$uzunluk."})/i"," \\1\n<br />",$mesaj);
}


$say++;

//EKSTRA GÜVENLİK
//if (!$kullaniciAdi) die;


if ($ayazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod")
$sil = "<a href=sozluk.php?process=esil&id=$id&sr=$sira><font size=1>Patlat </a>";
$oylama = "
          &nbsp;          
          &nbsp;
<a id=\"hos".$id."\" href=\"javascript:oylama($id,'arti');\" title=Puanım&nbsp;9> <font color= green> <span class=\"material-symbols-outlined\"> heart_plus </span></font></a><font size=\"1\">$arti</font>          <a id=\"bos".$id."\" href=\"javascript:oylama($id,'eksi');\" title=Mix&nbsp;Olmamış> <font color= red> <span class=\"material-symbols-outlined\"> stat_minus_2 </span></font></a><font size=\"1\">$eksi</font>&nbsp;  
";

if ($ayazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod")
$duzenle = "<a href=sozluk.php?process=eduzenle&id=$id&sr=$sira><font size=1>Düzenle</a> -";
else
$duzenle = "";

  if ($kullaniciAdi =="yorumlar") {
            $sil = "";
          $duzenle = "";
        }

if ($updatesebep)
$updatesebep = "(Sebep: $updatesebep)";
// admin check
$echoyazar = $yazar;
$sorgu1 = "SELECT nick,yetki FROM user WHERE `nick` = '$yazar'";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$yetki=$kayit2["yetki"];
$userNickName=$kayit2["nick"];
if ($yetki == "admin") {
$yazar = "<font color=red title=Administrator><b>&$yazar</b></font>";
}
if ($yetki == "mod") {
$yazar = "<font title=Moderatör><b>+$yazar</b></font>";
}
if ($yetki == "gammaz") {
$yazar = "<font title=Ispitci>$yazar</font>";
}
// admin check
if ($kullaniciAdi)
$msg = "<A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gmesaj=$id&gkime=$yazartitle&gkonu=$link\"><font size=1><span class=\"material-symbols-outlined\"> mail </span></A> </font>";
echo "
<OL>
  <LI value=$say>
  <DIV class=highlight>$mesaj<BR>
  ";
  if ($updater == "admtem Administrator")
  $updater = "<img src=img/unlem.gif> $updater";
  if ($updater)
  $bastir = "~ $update";
  if ($updater and ($kulYetki == "admin" or $kulYetki == "mod"))
  echo "------------------------------------------------------------------------------<br>
  <font size=1>$updater tarafindan düzenlendi.$updatesebep</font>
  ";

  if ($statu == "kenar")
{
    echo "<br>------------------------------------------------------------------------------";
echo "<small><br>bu entry <b>kenar</b>da beklettiğiniz bir entrydir. düzenleyip <b>gönder</b>dikten sonra mevcut sırasında yayına girecektir.<br></small>";
}

//SORU BÖLÜMÜ ANONİMLİĞİ
  if ($gds=="x")
{
  $yazar ="anonim";
}
  echo "
  </DIV>";

    echo "<DIV class=div2 align=right>";

    echo  "<span class=\"oySonuc\" id='oySonuc".$id."'></span> <font size=1>$ispit $duzenle $sil <B>";
   

if ($gds!="x")
{
  echo "
  <br> <A
  href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar </A></B>   $msg  <br> $gun/$ay/$yil $saat $bastir   <br> $oylama <br> #$eid
  </DIV><BR><BR>
  </li>
";
}
else
{
  echo "<A
  href=\"\" title=\"anonim\"><font size=1>$yazar</A></B>|$gun/$ay/$yil $saat $bastir|
  </DIV><BR><BR>
  </li>
";
}

echo "<center><form action=\"sozluk.php?process=word&q=$link\" method=post>
<input type=submit class=but value=\"Tümünü Göster\">
</form></center>
";
} // eid
else {
echo "<div class=dash><center><b><img src=img/unlem.gif> Müneccimmiyim ben ?";
exit;

}
?>

<? if ($kullaniciAdi == "")  { ?>
<br>
<br>
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

<center>
  
  <br>
    <br>
    
<? if ($kullaniciAdi == "")  { ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<?
}
?>


<center>