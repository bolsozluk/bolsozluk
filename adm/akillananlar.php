<?
if ($akillananlar != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
if ($canlandir) {
$sorgu = "UPDATE mesajlar SET `statu` = '' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `update` = '$tarih' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `updater` = 'admtem Administrator' WHERE id='$canlandir'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `updatesebep` = 'Silinen entry tekrar basliga eklendi.' WHERE id='$canlandir'";
mysql_query($sorgu);
echo "$canlandir canlandirildi.";
}
else {
echo "Akillanan Entryler";
$max = 40;
if (!$_GET["sayfa"])  { $_GET["sayfa"]=1; }
$alt = ($_GET["sayfa"] - 1)  * $max;

$sor = mysql_query("SELECT id FROM mesajlar WHERE `statu`='akillandim'");
$w = mysql_num_rows($sor);
$goster = $w/$max;
$goster=ceil($goster);

echo "<center><p class=eol><font face=Verdana size=1>
<b>Toplam $w adet entry listeleniyor</b><br>
";
echo "</center>";

if ($goster >1) {
//echo "
//<SELECT class=ksel onchange=\"jm('self',this,0);\" name=sayfa>";
for ($i=1;$i<=$goster;$i++) {

if ($sayfa == $i) {
//echo " <OPTION value=sozluk.php?process=adm&islem=oluler&sayfa=$i selected>$i</OPTION>";
} // if
else {
//echo "<OPTION value=sozluk.php?process=adm&islem=oluler&sayfa=$i>$i</OPTION>";
}
}
echo "</SELECT>";

if ($sayfa >= 1 or !$sayfa) {
if (!$sayfa)
$sayfa = 1;
$linksayfa = $sayfa + 1;
      
if ($linksayfa <= $goster) {
//echo "<a class=link href=?process=adm&islem=oluler&sayfa=$linksayfa><font face=verdana size=1>>></font></a>";
}
}
}

$sorgu = "SELECT id,statu FROM mesajlar WHERE `statu`='akillandim' ORDER by id DESC limit 0,150";
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

$baslik = ereg_replace("ş","s",$baslik);
$baslik = ereg_replace("Ş","S",$baslik);
$baslik = ereg_replace("ç","c",$baslik);
$baslik = ereg_replace("Ç","C",$baslik);
$baslik = ereg_replace("ı","i",$baslik);
$baslik = ereg_replace("İ","I",$baslik);
$baslik = ereg_replace("ğ","g",$baslik);
$baslik = ereg_replace("Ğ","G",$baslik);
$baslik = ereg_replace("ö","o",$baslik);
$baslik = ereg_replace("Ö","O",$baslik);
$baslik = ereg_replace("ü","u",$baslik);
$baslik = ereg_replace("Ü","U",$baslik);
$baslik = ereg_replace("Ö","O",$baslik);

$baslik = strtolower($baslik);

$yazar = $kullaniciAdi;

$link = ereg_replace(" ","+",$baslik);

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

$yazarlink = ereg_replace("&","",$yazar); // adminlerden ~ kaldırıyoruz
$yazartitle = ereg_replace("&","Administrator / ",$yazar); // adminlerden ~ kaldırıyoruz

$link = ereg_replace("ş","s",$link);
$link = ereg_replace("Ş","S",$link);
$link = ereg_replace("ç","c",$link);
$link = ereg_replace("Ç","C",$link);
$link = ereg_replace("ı","i",$link);
$link = ereg_replace("İ","I",$link);
$link = ereg_replace("ğ","g",$link);
$link = ereg_replace("Ğ","G",$link);
$link = ereg_replace("ö","o",$link);
$link = ereg_replace("Ö","O",$link);
$link = ereg_replace("ü","u",$link);
$link = ereg_replace("Ü","U",$link);
$link = ereg_replace("Ö","O",$link);

$mesaj = ereg_replace("Ş","ş",$mesaj);
$mesaj = ereg_replace("Ç","ç",$mesaj);
$mesaj = ereg_replace("İ","i",$mesaj);
$mesaj = ereg_replace("Ğ","ğ",$mesaj);
$mesaj = ereg_replace("Ö","ö",$mesaj);
$mesaj = ereg_replace("Ü","ü",$mesaj);

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
$sil = "<a href=sozluk.php?process=adm&islem=entrysil&id=$id><font size=1>Yuh Hayvan(SIL)</a>";

if ($ayazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod")
$duzenle = "<a href=sozluk.php?process=eduzenle&id=$id&sr=$sira><font size=1>Düzenle ve Aktif et</a> -";
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
$msg = "<A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$yazartitle&gkonu=$id nolu patlayan entryiniz\"><font size=1>msg</A>|</font>";
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
  <DIV class=div2 align=right><font size=1>Patlatan: <A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$yazartitle&gkonu=[MOD] $id nolu patlattiğiniz entry\">$silen</a> | Patlama Sebebi: $silsebep</DIV>
  </li>
  </ol>
  </center>
";
} // if
} // while
} // else
?>
