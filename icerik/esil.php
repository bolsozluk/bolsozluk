<?

$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");
$ispitle = guvenlikKontrol($_REQUEST["ispitle"],"hard");

if ($id and $sira) {
	$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$baslik=$kayit2["baslik"];
	
	$sorgu1 = "SELECT mesaj,id,yazar,tarih FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$mesaj=$kayit2["mesaj"];
	$dbyazar=$kayit2["yazar"];
	$mesajtarih=$kayit2["tarih"];
	
	if ($dbyazar != $kullaniciAdi and $kulYetki != "admin" and $kulYetki != "mod")  {
		$ip = getenv('REMOTE_ADDR');
		echo "Dikkat!<br>$ip ispitledin!";
		die;
	}

	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");

//if ($tarih - $mesajtarih <= 1)
//{
//echo "bu kadar hızlı entry silemezsiniz";

//$sorgu = "UPDATE mesajlar SET tarih = '$tarih' WHERE id='$id'";
//mysql_query($sorgu);

//die;
//}
 
	$sebep = strtolower($sebep);

	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

	if (!$ucur) {
		$sorgu = "UPDATE mesajlar SET `statu` = 'silindi' WHERE id='$id'";
		mysql_query($sorgu);
		$sorgu = "UPDATE mesajlar SET `silen` = '$kullaniciAdi' WHERE id='$id'";
		mysql_query($sorgu);
		$sorgu = "UPDATE mesajlar SET `silsebep` = '$sebep' WHERE id='$id'";
		mysql_query($sorgu);
		$sorgu = "UPDATE mesajlar SET `siltarih` = '$tarih' WHERE id='$id'";
		mysql_query($sorgu);
		$sorgu = "UPDATE mesajlar SET `praetornotu` = '$praetornotu' WHERE id='$id'";
		mysql_query($sorgu);

		//BAŞLIK TARİHİ UPDATE
		
	$tarihcek = mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE `sira` = '$sira' AND statu = '' ORDER BY `id` DESC limit 0,1"));
	$xtarih = $tarihcek["tarih"];
	$xgun = $tarihcek["gun"];
	$xay = $tarihcek["ay"];
	$xyil = $tarihcek["yil"];

	$sorgux = "UPDATE konular SET tarih='$xtarih',gun='$xgun',ay='$xay',yil='$xyil' WHERE id='$sira'";
	mysql_query($sorgux); 

	echo "<br>başlık tarihi son girilen entrye göre güncelleniyor...<br>";

	//eşikayet

$ksx = mysql_fetch_array(mysql_query("SELECT durum FROM esikayet WHERE konu='$id'"));
$esikayet_flag = $ksx['durum'];

if ($silen != $kullaniciAdi)
{
if (($sebep != "link kırılmış") and ($sebep != "refere ettiği entry silinmiş") and ($sebep != "daha önce yazılmış ki bu") and ($sebep != ""))
{
$sorgu = "UPDATE user SET saysil = saysil + 1 WHERE nick='$dbyazar'";
mysql_query($sorgu);
}
}


if ($esikayet_flag == 1)
{

$sorgu = "UPDATE mesajlar SET esikayet = '0' WHERE id='$id'";
mysql_query($sorgu);

$sorgu = "UPDATE esikayet SET kapatan = '$kullaniciAdi' WHERE konu='$id'";
mysql_query($sorgu);

$sorgu = "UPDATE esikayet SET durum = '0' WHERE konu='$id'";
mysql_query($sorgu);




$sorgu = "DELETE FROM privmsg WHERE kime = 'deepsky' and konu = 'otomatik şikayet entry no:$id'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'ret1arius' and konu = 'otomatik şikayet entry no:$id'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'if rap gets jealous' and konu = 'otomatik şikayet entry no:$id'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'komutana sniper neresinden' and konu = 'otomatik şikayet entry no:$id'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'booyaka' and konu = 'otomatik şikayet entry no:$id'";
mysql_query($sorgu);

$ksx = mysql_fetch_array(mysql_query("SELECT gonderen FROM esikayet WHERE konu='$id'"));
$kisi = $ksx['gonderen'];


  $sorgu2 = "INSERT INTO privmsg ";
  $sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
  $sorgu2 .= " VALUES ";
  $sorgu2 .= "('$kisi','otomatik şikayet entry no:$id','şikayetinize konu olan entry silinmiştir.','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
  mysql_query($sorgu2);

}

echo "<div class=dash><center><b>$id silinenler listesine eklendi.</div>";




			if ($isMobile == 1)
			{
			echo "
			<script>location.href='left.php?list=today'</script>";
			exit;
	
			}

	}
	
}else if ($id) {
?>
<form name="a" method="post" action="">
		<b> entry silme modülü </b>
    <table width="100%" height="52" border="0">
      <tr>
        <td width="232"><input name="sebep" type="radio" value="link kırılmış">link kırılmış</td>
        <td width="322"><input name="sebep" type="radio" value="hakaret">hakaret</td>
      </tr>
      <tr>
        <td width="232"><input name="sebep" type="radio" value="içerik başlıkla uyumlu değil">içerik başlıkla uyumlu değil</td>
        <td width="322"><input name="sebep" type="radio" value="daha önce yazılmış ki bu">daha önce yazılmış ki bu</td>
      </tr>
       <tr>
        <td width="232"><input name="sebep" type="radio" value="şikayet gereği">şikayet gereği</td>
        <td width="322"><input name="sebep" type="radio" value="konudışı ikili diyalog">konudışı ikili diyalog</td>
      </tr>
      <tr>
        <td width="232"><input name="sebep" type="radio" value="refere ettiği entry silinmiş">refere ettiği entry silinmiş</td>
        <td width="322"><input name="sebep" type="radio" value="nefret söylemi">nefret söylemi</td>
      </tr>
            <tr>
        <td width="232"><input name="sebep" type="radio" value="hukuki sakınca">hukuki sakınca</td>
        <td width="322"><input name="sebep" type="radio" value="sözlüğün bekası">sözlüğün bekası</td>
      </tr>



                <tr>


<td colspan="2">
<br>

<?
if ($ispitle != $kullaniciAdi)
{
?>

<b>praetör notu: (opsiyonel)</b>
<br>
                        <textarea id="entry" name="praetornotu" rows="8" style="width:100%;height:12em;max-height:12em;resize:none;text-transform:none !important;"></textarea>

<?
}
?>

                        <br><br>
<input class="buton" id="kaydet" style="width:50%" type="submit" value="patlat" name="kaydet"></td>
                    </td>
                </tr>

      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="sira" value="<?php echo $sr; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" value="gonder" name="gonder">
            


      </tr>


    </table>
<?
if ($ispitle != $kullaniciAdi)
{
?>

sözlük içi entry silme gerekçelerine dair bu notlarla bir veritabanı oluşacaktır. ör:<br>
-"....." cümlesi tck md.126'ya aykırı, yargıtay 3.cd 2021/123<br>
-"salak" sözcüğü tck md.125'e göre hakarettir... gibi<br>
<br>
<?
}
?>

</form>
<?php } ?>