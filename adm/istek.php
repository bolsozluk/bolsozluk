<LINK href="inc/<?echo "$aktiftema";?>.css" type=text/css rel=stylesheet>
<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?

$bid = guvenlikKontrol($_REQUEST["bid"],"hard");
$a = guvenlikKontrol($_REQUEST["a"],"hard");
$ybaslik = guvenlikKontrol($_REQUEST["ybaslik"],"hard");
$baslik = guvenlikKontrol($_REQUEST["baslik"],"hard");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");


	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");
	$ip = getenv('REMOTE_ADDR');


if ($bid and $a) {

// (if $a == 4){$a=0;}



$sorgu = "UPDATE mesajlar SET `istekhatti` = '$a' WHERE id='$bid'";
mysql_query($sorgu);

echo $a;
echo $bid;
echo "<br><center><b>istek bilgisi kaydedildi.</center>";
}

if ($a == 1)
{
$listele1 = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE id = '$bid' ORDER BY id desc limit 0,1"));
$yazar = $listele1["yazar"];

//echo ". ";
//echo $bid;
//echo $yazar;
//echo " .";

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$yazar','$bid nolu talebiniz','sözlükle ilgili istekler başlığında yer alan <a href=/sozluk.php?process=eid&eid=$bid target=%22%5Fblank%22><font face=verdana size=1>#$bid</font></a> nolu entrydeki talep çözümlenmiştir. ilgin ve desteğin için teşekkür ederiz. var ol! (otomatik mesaj) ','bolsozluk','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);
}

if ($a == 2)
{
$listele1 = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE id = '$bid' ORDER BY id desc limit 0,1"));
$yazar = $listele1["yazar"];

//echo ". ";
//echo $bid;
//echo $yazar;
//echo " .";

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$yazar','$bid nolu talebiniz','sözlükle ilgili istekler başlığında yer alan <a href=/sozluk.php?process=eid&eid=$bid target=%22%5Fblank%22><font face=verdana size=1>#$bid</font></a> nolu entrydeki talep reddedilmiştir. ilgin ve desteğin için teşekkür ederiz. var ol! (otomatik mesaj) ','bolsozluk','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);
}

if ($a == 3)
{
$listele1 = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE id = '$bid' ORDER BY id desc limit 0,1"));
$yazar = $listele1["yazar"];

//echo ". ";
//echo $bid;
//echo $yazar;
//echo " .";

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$yazar','$bid nolu talebiniz','sözlükle ilgili istekler başlığında yer alan <a href=/sozluk.php?process=eid&eid=$bid target=%22%5Fblank%22><font face=verdana size=1>#$bid</font></a> nolu entrydeki talep alınmıştır. ilgin ve desteğin için teşekkür ederiz. var ol! (otomatik mesaj) ','bolsozluk','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);
}

if ($a == 4)
{
$listele1 = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE id = '$bid' ORDER BY id desc limit 0,1"));
$yazar = $listele1["yazar"];

//echo ". ";
//echo $bid;
//echo $yazar;
//echo " .";

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('$yazar','$bid nolu talebiniz','sözlükle ilgili istekler başlığında yer alan <a href=/sozluk.php?process=eid&eid=$bid target=%22%5Fblank%22><font face=verdana size=1>#$bid</font></a> nolu entrydeki talep daha sonra değerlendirilecektir. ilgin ve desteğin için teşekkür ederiz. var ol! (otomatik mesaj) ','bolsozluk','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);
}



?>
