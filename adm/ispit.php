<?

/*if ($ispit != 1 and $kulYetki != "user") {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}*/

if ($canlandir) {
$sorgu = "UPDATE mesajlar SET `statu` = '' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `update` = '$tarih' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `updater` = 'admtem Administrator' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `updatesebep` = 'Ispitlenen entry tekrar basliga eklendi.' WHERE id='$canlandir'";
mysql_query($sorgu);
echo "$canlandir red edildi ve entry aktif edildi.";
}
else {
echo "Ispitlenen Entryler";

$max = 40;
if (!$_GET["sayfa"])  { $_GET["sayfa"]=1; }
$alt = ($_GET["sayfa"] - 1)  * $max;

$sor = mysql_query("SELECT id FROM mesajlar WHERE `statu`='ispit'");
$w = mysql_num_rows($sor);

$goster = $w/$max;
$goster=ceil($goster);
if ($goster >1) {
echo "<center><p class=eol><font face=Verdana size=1>
<b>Toplam $w/$max adet baslik listeleniyor</b><br>
Sayfalar:
";

if ($sayfa >= 1 or !$sayfa) {

$linksayfa = $sayfa - 1;
if ($sayfa > 1 or $sayfa) {
if ($sayfa != 1) {
echo "<a class=link href=?process=adm&islem=ispit&sayfa=$linksayfa><font face=verdana size=1><<</font></a>";
}
}

}

echo "
<SELECT class=ksel onchange=\"jm('self',this,0);\" name=sayfa>";
for ($i=1;$i<=$goster;$i++) {

if ($sayfa == $i) {
echo " <OPTION value=sozluk.php?process=adm&islem=ispit&sayfa=$i selected>$i</OPTION>";
} // if
else {
echo "<OPTION value=sozluk.php?process=adm&islem=ispit&sayfa=$i>$i</OPTION>";
} // new

}
echo "</SELECT>";

if ($sayfa >= 1 or !$sayfa) {
if (!$sayfa)
$sayfa = 1;

$linksayfa = $sayfa + 1;

if ($linksayfa <= $goster) {
echo "<a class=link href=?process=adm&islem=ispit&sayfa=$linksayfa><font face=verdana size=1>>></font></a>";
}

}

echo "</center>";
}



$sorgu = "SELECT id,statu FROM mesajlar WHERE `statu`='ispit' limit $alt,$max";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$eid=$kayit["id"];

$sorgu1 = "SELECT id,sira FROM mesajlar WHERE `id` = '$eid'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$konusira=$kayit2["sira"];
$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$konusira'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];

$baslik = preg_replace("/ş/","s",$baslik);
$baslik = preg_replace("/Ş/","S",$baslik);
$baslik = preg_replace("/ç/","c",$baslik);
$baslik = preg_replace("/Ç/","C",$baslik);
$baslik = preg_replace("/ı/","i",$baslik);
$baslik = preg_replace("/İ/","I",$baslik);
$baslik = preg_replace("/ğ/","g",$baslik);
$baslik = preg_replace("/Ğ/","G",$baslik);
$baslik = preg_replace("/ö/","o",$baslik);
$baslik = preg_replace("/Ö/","O",$baslik);
$baslik = preg_replace("/ü/","u",$baslik);
$baslik = preg_replace("/Ü/","U",$baslik);
$baslik = preg_replace("/Ö/","O",$baslik);

$baslik = strtolower($baslik);

$yazar = $kullaniciAdi;

$link = preg_replace("/ /","+",$baslik);

echo "
      <H3><FONT size=3><A href=\"sozluk.php?process=word&q=$link\">$baslik</A>$basliksil $baslikduzenle</FONT>
      </H3>
";

$sorgu1 = "SELECT * FROM mesajlar WHERE `id` = '$eid'";
$sorgu2 = mysql_query($sorgu1);
$kayit=mysql_fetch_array($sorgu2);

$id=$kayit["id"];
$sira=$kayit["sira"];
$mesaj=$kayit["mesaj"];
$updater=$kayit["updater"];
$yazar=$kayit["yazar"];
$tarih=$kayit["tarih"];
$gun=$kayit["gun"];
$ay=$kayit["ay"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];
$silen=$kayit["silen"];
$silsebep=$kayit["silsebep"];
$update=$kayit["update2"];
$updatesebep=$kayit["updatesebep"];
$ayazar = $yazar;

$yazarlink = preg_replace("/&/","",$yazar); // adminlerden ~ kaldırıyoruz
$yazartitle = preg_replace("/&/","Administrator / ",$yazar); // adminlerden ~ kaldırıyoruz

$link = preg_replace("/ş/","s",$link);
$link = preg_replace("/Ş/","S",$link);
$link = preg_replace("/ç/","c",$link);
$link = preg_replace("/Ç/","C",$link);
$link = preg_replace("/ı/","i",$link);
$link = preg_replace("/İ/","I",$link);
$link = preg_replace("/ğ/","g",$link);
$link = preg_replace("/Ğ/","G",$link);
$link = preg_replace("/ö/","o",$link);
$link = preg_replace("/Ö/","O",$link);
$link = preg_replace("/ü/","u",$link);
$link = preg_replace("/Ü/","U",$link);
$link = preg_replace("/Ö/","O",$link);

$mesaj = preg_replace("/Ş/","ş",$mesaj);
$mesaj = preg_replace("/Ç/","ç",$mesaj);
$mesaj = preg_replace("/İ/","i",$mesaj);
$mesaj = preg_replace("/Ğ/","ğ",$mesaj);
$mesaj = preg_replace("/Ö/","ö",$mesaj);
$mesaj = preg_replace("/Ü/","ü",$mesaj);

$mesaj = strtolower($mesaj);

$mesaj = preg_replace("'\(bkz: (.*)\)'Ui","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
$mesaj = preg_replace("'\(gbkz: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
$mesaj = preg_replace("'\(u: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);
$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $mesaj);
$mesaj = preg_replace("'\#([0-9]{1,9})'","<a href=sozluk.php?process=view&eid=\\1>#\\1</a>",$mesaj);


$uzunluk = 142;
if($mesaj && strlen($mesaj)>$uzunluk) {
$mesaj=preg_replace("/([^\n\r -]{".$uzunluk."})/i"," \\1\n<br />",$mesaj);
}


$say++;

if (!$ayazar)
die;

if ($ayazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod")
$sil = "<a href=sozluk.php?process=adm&islem=ispit&canlandir=$id><font size=1>Yanlış ispit</a>";

if ($ayazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod")
$duzenle = "<a href=sozluk.php?process=esil&id=$id&sr=$sira><font size=1>Onayla ve Patlat</a> -";
else
$duzenle = "";

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
$yazar = "<font color=white title=Administrator><b>&$yazar</b></font>";
}
if ($yetki == "mod") {
$yazar = "<font title=Moderatör><b>+$yazar</b></font>";
}
if ($yetki == "user") {
$yazar = "<font title=Ispitci>$yazar</font>";
}
// admin check
if ($kullaniciAdi)
$msg = "<A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$yazartitle&gkonu=$id nolu isptilenen entryiniz\"><font size=1>msg</A>|</font>";
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
  echo "
  </DIV>
  <DIV class=div2 align=right><font size=1>$duzenle $sil (#$id) <B><A
  href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A></B>|$gun/$ay/$yil $saat $bastir| $msg
  </DIV>
  <DIV class=div2 align=right><font size=1>Ispitleyen: <A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$silen&gkonu=[MOD] $id nolu ispitlediğiniz entry\">$silen</a> | Ispitleme Sebebi: $silsebep</DIV>
  </li>
  </ol>
  </center>
";
} // if
} // while
} // else
?>
