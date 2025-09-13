<META http-equiv=Content-Type content="text/html; charset=utf-8">
<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>
<meta name="viewport" content="width=device-width, initial-scale=0.92">
</HEAD>
<BODY>
<style>
html {
overflow: -moz-scrollbars-vertical; 
overflow-y: scroll;
}


</style>
<?

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

$sorgu = "SELECT * FROM online ORDER BY nick asc";
$sorgulama = mysql_query($sorgu);
$kac = mysql_num_rows($sorgulama);





if($isMobile == 0) $onlines = "<img src=img/yazarlar.gif alt=\"$kac kayitli onlayn\"> <a title=\"$kac kayitli onlayn\">($kac)</a>";
if(($isMobile == 0) && ($okunmayan)) $pms = "&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;<a title=\"$okunmayan okunmayan hede var\" href=sozluk.php?process=privmsg><img src=img/new.gif alt=\"$okunmayan okunmayan hede var\"> ($okunmayan)</a>";

if($isMobile == 1) $onlines = "on: <img src=img/yazarlar.gif alt=\"$kac kayitli onlayn\"> <a title=\"$kac kayitli onlayn\">($kac)</a>";
if(($isMobile == 1) && ($okunmayan)) $pms = "dm: <a title=\"$okunmayan okunmayan hede var\" href=sozluk.php?process=privmsg><img src=img/new.gif alt=\"$okunmayan okunmayan hede var\"> ($okunmayan)</a>";
?>
<TABLE width="95%" align=center border=0>
  <TBODY>
  <TR>
    <TD vAlign=top width="100%">
      <fieldset><LEGEND><B>üstbilgi</B></LEGEND>
        <DIV>
           <span style="display:block; position:relative; float:right; top:0px; right:0px; font-family:Arial, Helvetica, sans-serif;margin-top:-7px; font-size: 12px;font-weight:bold;">
          (v0.9.2)</span>
          <br>
duyuru ve gelişmeler için<a href="/s%C3%B6zl%C3%BCkle+ilgili+duyurular-1.html"> (bkz: sözlükle ilgili duyurular)</a><br>
<br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=booyaka&gkonu=">genel iletişim ADRESİ</a> - <a href="mailto:info@bolsozluk.com">info@bolsozluk.com</a><br>
<br>
<small>yönetim ve moderasyon
<br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=deepsky&gkonu=">deepsky</a> - <a href="mailto:deepsky@bolsozluk.com">deepsky@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=ret1arius&gkonu=">ret1arius</a> - <a href="mailto:ret1arius@bolsozluk.com">ret1arius@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=komutana sniper neresinden&gkonu=">komutana sniper neresinden</a> - <a href="mailto:komutan@bolsozluk.com">komutan@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=if rap gets jealous&gkonu=">if rap gets jealous</a> - <a href="mailto:if@bolsozluk.com">if@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=abra yutpa&gkonu=">abra yutpa</a> - <a href="mailto:abrayutpa@bolsozluk.com">abrayutpa@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=dragunov&gkonu=">dragunov</a> - <a href="mailto:dragunov@bolsozluk.com">dragunov@bolsozluk.com</a><br>
<br>
sosyal medya/içerik ekibi<br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=fikirsiz&gkonu=">fikirsiz</a> - <a href="mailto:fikirsiz@bolsozluk.com">fikirsiz@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=lord voldemort&gkonu=">lord voldemort</a> - <a href="mailto:voldemort@bolsozluk.com">voldemort@bolsozluk.com</a><br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=pek&gkonu=">pek</a> - <a href="mailto:pek@bolsozluk.com">pek@bolsozluk.com</a><br>
<br>
emektarlar<br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=semttenbirses&gkonu=">semttenbirses</a>, 
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=komita cedey&gkonu=">komita cedey</a>, 
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=hayatitelgeler&gkonu=">hayatitelgeler</a>, 
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=etik fanatik&gkonu=">etik fanatik</a>,
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=etik fanatik&gkonu=">kirito</a>,
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=etik fanatik&gkonu=">mancini</a><br>
<br>
teknik problemler ve destek talepleri için<br>
<a href="/sozluk.php?process=privmsg&islem=yenimsj&gmesaj=&gkime=booyaka&gkonu=">booyaka</a> - <a href="mailto:booyaka@bolsozluk.com">booyaka@bolsozluk.com</a><br></small>
<br></DIV>
      <fieldset><LEGEND><B>şimdi haberler!</B></LEGEND>


          <DIV>
          <?
$sorgu = "SELECT * FROM haberler ORDER BY `tarih` desc LIMIT 5";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayÄ±tlarÄ± listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$konu=$kayit["konu"];
$aciklama=$kayit["aciklama"];
$yazar=$kayit["yazar"];
$tarih=$kayit["tarih"];
$ay=$kayit["ay"];
$gun=$kayit["gun"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];



$aciklama = preg_replace("'\(bkz: (.*)\)'Ui","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$aciklama);
$aciklama = preg_replace("'\(gbkz: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$aciklama);
$aciklama = preg_replace("'\`([\w öçşığüÖÇŞİĞÜ\-\.\´\:]+)\`'","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$aciklama);
$aciklama = preg_replace("'\(u: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$aciklama);
$aciklama = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $aciklama);
//$aciklama = preg_replace("'\#([0-9]{1,9})'","<a href=sozluk.php?process=eid&eid=\\1><b>#\\1</b></a>",$aciklama);
$aciklama = preg_replace("'([^&][\w\n öçşığüÖÇŞİĞÜ]*)#([0-9]{1,9})'","<a href=sozluk.php?process=eid&eid=\\2>(#\\2</a>",$aciklama);
$aciklama = preg_replace("'\(graffiti: \)'","<img src=http://imgim.com/20140920_234935.jpg width=500>",$aciklama);
$aciklama = preg_replace("'\(antalya: \)'","<img src=https://scontent-b-fra.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/10372523_10204395401458430_2062040542875082296_n.jpg?oh=b9f7cb28c2482d94e32812ef94d20338&oe=54ECCB9A width=500>",$aciklama);
$aciklama = preg_replace("'\(antalya2: \)'","<img src=https://i.hizliresim.com/g49RrO.jpg width=400>",$aciklama);
$aciklama = preg_replace("'\(bolgelecek: \)'","<img src=https://i.hizliresim.com/R0XGgG.jpg width=400>",$aciklama);
$aciklama = preg_replace("'\(comp4: \)'","<img src=https://i.hizliresim.com/POGY66.jpg width=300>",$aciklama);
$aciklama = preg_replace("'\(comp4x: \)'","<img src=https://pbs.twimg.com/media/DSXc1MrWkAEmDcv.jpg width=300>",$aciklama);
$aciklama = preg_replace("'\(tag1: \)'","<img src=https://i.hizliresim.com/adk5y5.jpg width=300>",$aciklama);
$aciklama = preg_replace("'\(tinci: \)'","<img src=https://i.hizliresim.com/X9OvDR.jpg width=300>",$aciklama);
$aciklama = preg_replace("'\(youtube: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br> <iframe width=\"320\" height=\"240\" src=\"https://www.youtube.com/embed/\\1\" frameborder=\"0\" allowfullscreen></iframe>",$aciklama); //ÇALIŞIYOR eski kod
$aciklama = preg_replace("'\(foto: ([\w öçşığüÖÇŞİĞÜ.]+)\)'","<a target=_blank href=http://eksiye.com/i/p/$1.jpg><img src=\"http://eksiye.com/i/p/$1.jpg\" alt=\"\" title=\"\" height=\"300\" /></a>",$aciklama); 
$aciklama = preg_replace("'\(spoalbum: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:album:\\1\" width=\"300\" height=\"380\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$aciklama);
$aciklama = preg_replace("'\(spotrack: ([\w öçşığüÖÇŞİĞÜ\-_]+)\)'","<br><iframe src=\"https://open.spotify.com/embed?uri=spotify:track:\\1\" width=\"300\" height=\"80\" frameborder=\"0\" allowtransparency=\"true\" allow=\"encrypted-media\"></iframe>",$aciklama);
$aciklama = preg_replace("'\(xalbum2022x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS5stayLpeVEZV6dTV_CRCXP\" frameborder=\"0\" allowfullscreen></iframe>",$aciklama); 
$aciklama = preg_replace("'\(xins3x\)'","<br> <iframe width=\"70%\" height=\"50%\" src=\"https://www.youtube.com/embed/videoseries?list=PLqw9aTgi1eS6C_KQ98LaoYTEDrVIuZq58\" frameborder=\"0\" allowfullscreen></iframe>",$aciklama); 

echo "
<a class=highligth>$konu
      [$gun/$ay/$yil $saat]</a><BR>
      <font size=2>$aciklama</font>
      <BR>
      <strong>$yazar</strong>
      <HR SIZE=1>
      "; //$yazar
}
}
?>
<a href="logout.php">· çıkış yap ·</a>

        </DIV>
      </fieldset></TD>
    <TD vAlign=top align=left width="25%">

      <fieldset noresize="noresize" style="width:100%;"><LEGEND><B>online yazarlar</B></LEGEND>
        
	<div style="width:100%;height:100%;overflow:scroll;overflow-x:hidden">

<?

$sayac = 0;
$sorgu = "SELECT * FROM online ORDER BY nick asc";
$sorgulama = mysql_query($sorgu);
$kac = mysql_num_rows($sorgulama);

//echo "<center>";
if (!$statusWhere) {
}
if ($statusWhere == "disarida")
$disarida = "selected";
if ($statusWhere == "mesgul")
$mesgul = "selected";
if ($statusWhere == "yemekte")
$yemekte = "selected";
if ($statusWhere == "iceride" or !$statusWhere)
$iceride = "selected";


if($isMobile == 0) echo "$onlines $pms <hr>";
if($isMobile == 1) echo "$onlines <br> $pms <hr>";

if (($kulYetki == 'admin') or ($kulYetki == 'mod'))
{

  echo "<img src=img/unlem.gif><a href=sozluk.php?process=adm&islem=ispliste> [bol adalet sarayı]</a>";
  echo "<hr>";

}
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$userNickName=$kayit["nick"];
$ondurum=$kayit["ondurum"];
$ip=$kayit["ip"];
$sayac++;

if ($ondurum == "on")
$echodurum = "Yazar";
if ($ondurum == "off")
$echodurum = "Ã‡Ã¶mez";
if ($ondurum == "wait")
$echodurum = "Yazar AdayÄ±";
if ($ondurum == "sus")
$echodurum = "TekmelenmiÅŸ";

$checknick = explode("+", $userNickName);
$checknick = $checknick[1];

$msgnick = str_replace(".","",$userNickName);
$msgnick = str_replace("&","",$userNickName);

if ($checknick)
$userNickName = "$userNickName";



if ($kulYetki == "admin" || $kulYetki == "mod" ) {
$iptit = "<a title=\"$ip blockla\" href=\"sozluk.php?process=adm&islem=ipban&ip=$ip\" class=link><img src=img/unlem.gif></a>";
}


if ($ondurum == "off")
echo "$iptit<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$msgnick\" title=\"$echodurum\"><font size=1> $userNickName</a> <a href='sozluk.php?process=arkadasekle&n=$msgnick' title='arkadaşım olsun'>(+)</a> <a href='sozluk.php?process=dusmanekle&n=$msgnick' title='düşmanım olsun'>(-)</a></font><br>";
if ($ondurum == "on" OR $ondurum =="")
echo "$iptit<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$msgnick\" title=\"$echodurum\"><font size=1> $userNickName</a> <a href='sozluk.php?process=arkadasekle&n=$msgnick' title='arkadaşım olsun'>(+)</a> <a href='sozluk.php?process=dusmanekle&n=$msgnick' title='düşmanım olsun'>(-)</a><br>";
if ($ondurum == "wait")
echo "$iptit<a href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$msgnick\" title=\"$echodurum\"><font size=1> $userNickName</a> <a href='sozluk.php?process=arkadasekle&n=$msgnick' title='arkadaÅŸÄ±m olsun'>(+)</a> <a href='sozluk.php?process=dusmanekle&n=$msgnick' title='dÃ¼ÅŸmanÄ±m olsun'>(-)</a><br>";

}
}

?>

</div></FIELDSET>  

<br>

<?
/*
if(($isMobile == 0) && ($kullaniciAdi != ""))
{ 
?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bolsozluk_kp -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:1050px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="6684398512"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<?
}
*/
?>



  </TD></TR>
  </TBODY></TABLE>

</BODY>
</HTML>
<? include "bolchat.php"; ?>
