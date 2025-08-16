<div class="div1">
<a href="sozluk.php?process=cp">kontrol panelim</a> | <a href="sozluk.php?process=entrylerim">yazdıklarım</a> | <a href="sozluk.php?process=arkadaslarim">arkada$larım</a> | <a href="sozluk.php?process=dusmanlarim">dü$manlarım</a> | <a href="sozluk.php?process=yorumlarim">yorumlarım</a> | <a href="sozluk.php?process=gorunum">görünüm</a>
<fieldset>
<legend>dü$manlarım</legend>
<div style="width:170px;height:275px;overflow:scroll;overflow-x:hidden">
<?
$sorgu=mysql_query("select * from rehber where kimin='$kullaniciAdi' and num='1' order by id desc");
$no=@mysql_num_rows($sorgu);
echo "<div>$no düşmanın var</div><br>";
while ($oku=mysql_fetch_array($sorgu)) {
$sorgu2=mysql_query("select * from online where nick='$oku[kim]'");
$bul=@mysql_result($sorgu2,0,'ondurum');
if ($bul=="on") {
 $verifyStatus="online";
} else {
 $verifyStatus="ofline";
}
echo "<div><a href='sozluk.php?process=privmsg&islem=yenimsj&gkime=$oku[kim]'>$oku[kim]</a> <a href='sozluk.php?process=rehbersil&num=1&kim=$oku[kim]' title='listemden çıksın'>(-)</a> $verifyStatus</div>";
}
?>
</div>
</fieldset>
</div>
