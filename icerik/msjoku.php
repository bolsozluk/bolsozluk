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
</head>
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


<?
error_reporting(E_ALL ^ E_NOTICE);
$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );


if ($id) {
$sorgu1 = "SELECT gonderen,id,kime,konu,mesaj FROM privmsg WHERE `id` = '$id'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$gonderen=$kayit2["gonderen"];
$konu=$kayit2["konu"];
$id=$kayit2["id"];
$mesaj=$kayit2["mesaj"];
$kime=$kayit2["kime"];
$oku=0;
if ($kime == $kullaniciAdi)
{
$oku = ++$oku;
}
if ($gonderen == $kullaniciAdi)
{
$oku = ++$oku;
}




if ($oku<1) 
{
echo "Lütfen tekrar giris yapin.";
die;
}

$sorgu = "UPDATE privmsg SET okundu = '0' WHERE `id` ='$id'";
mysql_query($sorgu);


$mesaj = preg_replace("'\(bkz: (.*)\)'Ui","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
$mesaj = preg_replace("'\(gbkz: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
$mesaj = preg_replace("'\(u: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);
$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $mesaj);
$mesaj = preg_replace("'\#([0-9]{1,9})'","<a href=sozluk.php?process=eid&eid=\\1>#\\1</a>",$mesaj);
$mesaj = ereg_replace("&#039;","\'",$mesaj);

if ($isMobile == 0)
{
echo "
<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"top.main.location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"top.main.location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>
<br><a class=link><b>Gönderen: $gonderen</b></a> <a href='sozluk.php?process=arkadasekle&n=$gonderen' title='arkadaşım olsun'>(arkadaş ekle)</a> <a href='sozluk.php?process=dusmanekle&n=$gonderen' title='düşmanım olsun'>(engelle)</a><br>
Konu: $konu</b><br><br>
Mesaj: </a><br>
----------------------------------------------------------<br>
<font size=2>
$mesaj
</font>
<br>
----------------------------------------------------------
<br>

";
}

if ($isMobile == 1)
{
echo "
<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>
<br><a class=link><b>Gönderen: $gonderen</b></a> <a href='sozluk.php?process=arkadasekle&n=$gonderen' title='arkadaşım olsun'>(arkadaş ekle)</a> <a href='sozluk.php?process=dusmanekle&n=$gonderen' title='düşmanım olsun'>(engelle)</a><br>
Konu: $konu</b><br><br>
Mesaj: </a><br>
----------------------------------------------------------<br>
<font size=2>
$mesaj
</font>
<br>
----------------------------------------------------------
<br>

";
}


if ($konu == "<img src=img/unlem.gif> Yazar oldunuz!") {
	
	$sorgu = "UPDATE user SET aktifDurum = 'on' WHERE nick= '$kullaniciAdi'";
	mysql_query($sorgu);
	$aktifDurum = "on";
	$_SESSION['aktifDurum_S'] = $aktifDurum;
	$sorgu = "UPDATE online SET ondurum = '$aktifDurum' WHERE nick= '$kullaniciAdi'";
	mysql_query($sorgu);

	$sorgu = "DELETE FROM privmsg WHERE kime = '$kullaniciAdi' and id = '$id' LIMIT 1";
	mysql_query($sorgu);
	
	if (mysql_query($sorgu))
		echo "<center><b>Bu mesaj kendi kendini imha etti!</b></center>";
	}

}
?>

<?

if ($isMobile == 0)
{
echo "
<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"top.main.location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"top.main.location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>";
}

if ($isMobile == 1)
{
echo "
<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>";
}

echo"
<br>
<br>
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- bolsözlük-3 -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:728px;height:90px\"
     data-ad-client=\"ca-pub-7994669731946359\"
     data-ad-slot=\"7236998758\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>";



?>
