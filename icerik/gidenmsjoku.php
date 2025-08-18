<?
$id = guvenlikKontrol($_REQUEST["id"],"ultra");

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

$mesaj = preg_replace("'\(bkz: (.*)\)'Ui","(bkz: <a href=\"sozluk.php?process=word&q=\\1\">\\1</a>)",$mesaj);
$mesaj = preg_replace("'\(gbkz: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\">\\1</a>",$mesaj);
$mesaj = preg_replace("'\(u: (.*)\)'Ui","<a href=\"sozluk.php?process=word&q=\\1\" title=\"\\1\">*</a>",$mesaj);
$mesaj = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>", $mesaj);
$mesaj = preg_replace("'\#([0-9]{1,9})'","<a href=sozluk.php?process=eid&eid=\\1>#\\1</a>",$mesaj);

//<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"top.main.location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>
echo "
<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"top.main.location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>

<br><a class=link><b>Gönderen: $gonderen<br>
Konu: $konu</b><br><br>
Mesaj: </a><br>
----------------------------------------------------------<br>
<font size=2>
$mesaj
</font>
<br>
----------------------------------------------------------
<br>

<input class=\"but\" type=\"button\" name=\"cevapla\" value=\"Cevapla\" onclick=\"top.main.location.href='?process=privmsg&islem=yenimsj&gkime=$gonderen&cevap=$id'\" accesskey=v>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Gelen mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg'\" accesskey=c>
<input class=\"but\" type=\"button\" name=\"gmsj\" value=\"Giden mesajlar\" onclick=\"top.main.location.href='sozluk.php?process=privmsg&islem=gidenler'\" accesskey=c>

";
//<input class=\"but\" type=\"button\" name=\"sil\" value=\"Sil\" onclick=\"top.main.location.href='?process=privmsg&islem=msjsil&id=$id'\" accesskey=a>

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
