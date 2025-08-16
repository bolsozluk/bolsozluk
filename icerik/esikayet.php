<?

$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");


if ($kullaniciAdi == "")
{
echo "şikayet için elektronik posta ve sosyal medya kanallarımıza ulaşabilirsiniz.";
die;
}

if ($id and $sira) {
	$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$baslik=$kayit2["baslik"];
	
	$sorgu1 = "SELECT mesaj,id,yazar,esikayet FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$mesaj=$kayit2["mesaj"];
	$dbyazar=$kayit2["yazar"];
	$esikayet=$kayit2["esikayet"];


	$ip = getenv('REMOTE_ADDR');


	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");

	$sebep = strtolower($sebep);

	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );


if ($esikayet ==1)
{

$msg = "UYARI: bu entry daha önceden şikayet edildi, moderasyon görüşü bekliyor.";
echo '<script type="text/javascript">alert("' . $msg . '");</script>';



			if ($isMobile == 1)
			{
			echo "
			<script>location.href='left.php?list=today'</script>";
			exit;
		}

					if ($isMobile == 0)
			{
			echo "bu entry zaten şikayet edilmiş.";
			exit;
		}

		die;

}

	if (!$ucur) {
			$sorgu = "UPDATE mesajlar SET `esikayet` = '1' WHERE id='$id' ";			
		mysql_query($sorgu);
		$sorgu = "UPDATE esikayet SET `durum` = '1' WHERE konu='$id' ORDER BY id desc limit 0,1";
		mysql_query($sorgu);
		echo "<div class=dash><center><b>$id şikayet edilenler listesine eklendi.</div>";



	//YÖNETİME CC ÖZELLİĞİ 

	$gmesaj = "http://www.bolsozluk.com/sozluk.php?process=eid&eid=$id <br> sebep:$sebep <br> ip: $ip";


	$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('ret1arius','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

	$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('deepsky','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

		$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('booyaka','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

		$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('komutana sniper neresinden','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

		$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('if rap gets jealous','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

		$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('semttenbirses','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

			$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('abra yutpa','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

			$sorgu2 = "INSERT INTO privmsg ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('dragunov','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);


		$sorgu2 = "INSERT INTO esikayet ";
	$sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
	$sorgu2 .= " VALUES ";
	$sorgu2 .= "('semttenbirses','otomatik şikayet entry no:$id','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
	mysql_query($sorgu2);

	$ysorgu = "INSERT INTO esikayet ";
	$ysorgu .= "(mesaj,konu,ip,gonderen,tarih,gun,ay,yil,saat,durum)";
	$ysorgu .= " VALUES ";
	$ysorgu .= "('$gmesaj','$id','$ip','$kullaniciAdi','$tarih','$gun','$ay','$yil','$saat','1')";
	mysql_query($ysorgu);


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
	<b> entry şikayet modülü </b>
    <table width="564" height="52" border="0">
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
        <td width="322"><input name="sebep" type="radio" value="nefret söylemi">nefret söylemi ve hukuki sakınca</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="sira" value="<?php echo $sr; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" value="gonder" name="gonder">
            <br>
            <input class="buton" id="kaydet" type="submit" value="moderasyona havale et" name="kaydet"></td>
      </tr>
    </table>
</form>

</small>
<?php }

/*

<small>
<br>
(<b>link kırlmış:</b>) entryde kırık doğrudan link, ya da kırık linkli gömülü materyalden başka bir içerik olmadığı takdirde bu gerekçeyle silinecektir. 
<br>
<br>(<b>hakaret:</b>) hakaret t.c.k madde 225 uyarınca suç teşkil etmektedir. sözlükte 3.şahıslarla ya da doğrudan sözlük yazarları arasındaki hakaret içeren diyaloglar, sözlüğü de bağlayıcı nitelikte olduğundan sözlüğün devamlılığı ve hukuki güvencesini korumak adına bu kapsamdaki içerikler şikayet üzerine ya da re'sen silinecektir.
<br>
<br>(<b>içerik başlıkla uyumlu değil:</b>) entry başlığı tanımlamıyor ya da var olan tanımlara dair örnek, alıntı, bkz ya da bütünleme içermiyorsa, ya da başlığın refere ettiği kavramla değil başlığın sözlükteki haliyle ilgiliyse bu nedenle silinecektir. 
<br>
<br>(<b>daha önce yazılmış ki bu:</b>) başlık içerisindeki akışın daha nitelikli olması için aynı entrynin, aynı ifadelerle tekrar girildiği entryler bu kapsamda silinecektir.
<br>
<br>(<b>şikayet gereği:</b>) sözlük dışı ya da sözlük yazarlarından gelen şikayetler sonucu, diğer gerekçelere uygun olmayan ancak kişisel verilerin korunması kanunu ve özel hayata ilişkin diğer mevzuat uyarınca moderasyon ekibi tarafından silinmesi uygun bulunan içerikler bu kapsamda işlem görecektir.
<br>
<br>(<b>konudışı ikili diyalog:</b>) başlık içi akışta doğrudan konuya ilişkin bir nitelik barındırmayan, özel mesajla iletilebilecek "@2 sana ne ulan sorduk mu", "@3 trabzonda mı yaşıyorsun" gibi ifadeler içeren entryler bu kapsamda değerlendirilecektir.
<br>
<br>(<b>refere ettiği entry silinmiş:</b>) @12'den bahseden ama başlığın 12.numaralı entrysiyle ilgisi bulunmayan entryler bu kapsamda silinecektir.
<br>
<br>(<b>nefret söylemi ve hukuki sakınca:</b>) dini inanç, ırk, cinsel tercih vb. kimlikleri aşağılayıcı entryler ile, sözlüğün varlığını tehlikeye sokabilecek tüm hukuki sakınca içerir entryler bu kapsamda değerlendirilecektir.
<br>

*/


 ?>