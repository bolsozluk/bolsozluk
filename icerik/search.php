<style>
.butx {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}
</style>
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

<?php
session_start();

function strtrlower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}
$sonuc ="";
$q = guvenlikKontrol($_REQUEST["q"],"hard");

if ($q) {
$string=$_GET['q'];

if (!$q) {
echo "<div class=dash><center><b><img src=img/unlem.gif> Müneccim miyim ben ?";
die;
}

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
$aramobile = "<center> <b> </b>başlık <input maxLength=55 class=\"input\" style=\"height:12px\" onkeyup=\"araFocus()\" accesskey=\"b\" id=\"q\" name=\"q\" size=\"25\"  placeholder=\"aramaya inanın\"> <input type='button' onClick=\"javascript:mobgetir();\" value='getir' id='getir' class='butx'> <input type='button' onClick=\"javascript:mobara();\" value='ara' class='butx'></center>  <br>";                
if($isMobile == 0)
{ 
?>
<style>
A {
    font-size: 1.1em;
    line-height: 13pt;
}
</style>
<?
}
if($isMobile == 1)
{ 
            getPrivateMessages();
            if ($kullaniciAdi)
            {
                    if ($notice)
        echo "<SCRIPT>alert('$notice okunmayan mesajınız var.');</SCRIPT>";
            }
            ?>
<style>
.butx {
        border-right: #a6b4d4 1px outset; border-TOP: #a6b4d4 1px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 1px outset; display: inline-block; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}
.responsive {
  width: 100%;
  height: auto;
}
input {
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
    padding: 4px;
    display: inline-block;
}
</style>
<center>
<a id="gundem" href="left.php?list=today" target="_top" title=sol&nbsp;frame> <img src=inc/turuncu.png width=150 border=1></a></center><br><br>
 <?
    //echo "<center><td style=\"white-space:nowrap;\" onClick=\"location.href='/sozluk.php?process=staff'\" class=\"logo\"><img id=\"logopic\" alt=\"bol sözlük\" src=\"img/1.gif\" width=\"197\" height=\"56\" /></center>";
 echo $aramobile;
 if(($isMobile == 1) && ($kullaniciAdi == "") && ($adet > 1))
{
?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<?
}
/*
 if($isMobile == 1) //and $kullaniciAdi == ""
{ 
?>
<div style="max-width: 728px;">
  <iframe src="https://www.bolsozluk.com/nezaman.html" width="100%" height="90" frameborder="0" scrolling="no"></iframe>
</div>
<?
}
*/
echo "<br>";
    $ekmobile = "<input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'> <br><br>";
if ($kullaniciAdi)
{
 echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='left.php?list=kenar';\" value='kenar' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=entrylerim&kimdirbu=$kullaniciAdi';\" value='ben' class='butx'> <input type='button' onclick=\"location.href='logout.php';\" value='çık' class='butx'></center>"  ; 
}
else
{
echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=master&login=onair';\" value='giriş yap' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=word&q=gururlarımız';\" value='⭐gururlarımız⭐' class='butx'> </center> "; 
}
}
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
echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> $ekmobile </center>  ";
}
//   echo "<small><font class=link>en az 4 harfle aramanız önerilir.</font></small><br><br>"; 
//$SQL = "SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik LIKE '%$q%' ORDER BY CHAR_LENGTH(baslik) LIMIT 0,150";
$SQL = "SELECT baslik, id 
FROM konular 
WHERE (statu != 'silindi' and tasi = '') 
  AND LOWER(baslik) LIKE LOWER('%$q%')
ORDER BY 
  CASE 
    WHEN baslik LIKE '$q' THEN 1  -- Tam eşleşme
    WHEN baslik LIKE '$q%' THEN 2 -- Başında eşleşme
    WHEN baslik LIKE '%$q' THEN 3 -- Sonunda eşleşme
    ELSE 4                        -- İçinde eşleşme
  END,
  CHAR_LENGTH(baslik)
LIMIT 0,250";
    }
    $sorgu=mysql_query($SQL) ;
    if (!$sorgu)
        {
            header('Location: '."left.php?list=today"); 
            //echo "<div class=dash><center><b><img src=img/unlem.gif> başlık ismini gir.";  exit();
        }

        if($q)
        $arguman=0;
        $adet=0;

        while($sira=mysql_fetch_array($sorgu))
            {
                $sonuc[$arguman]=$sira["id"];
                $arguman++;

            }
        $adet = $arguman;      
        //echo "<div class=div1>";
        for($i=0;$i<(count($sonuc));$i++)
        {
        $SQLx="SELECT * FROM konular WHERE id='$sonuc[$i]' and statu=''";
        $sorgu=mysql_query($SQLx) ;
        while($sira=mysql_fetch_array($sorgu))
        {
        $baslik = $sira["baslik"];
        $baslik = strtolower($baslik);

if($isMobile == 0)
{ 
        echo "* <a target=\"main\" href=\"sozluk.php?process=word&q=$baslik\"><font size=2>$baslik</font></a><br>";
}
if($isMobile == 1)
{ 
        echo "* <a href=\"sozluk.php?process=word&q=$baslik\"><font size=2>$baslik</font></a><br>";
}
        }
        }
        $SQL="SELECT id FROM konular WHERE baslik='$q' and statu=''";
        $sorgu=mysql_query($SQL);
              ?>
<br>
<?
if ($adet == 0) echo "bulunamadı...";
if ($adet > 1) {
?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:197px;height:56px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="6678616589"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?
}
?>
