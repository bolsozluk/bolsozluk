<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?


//var_dump($ok, $mesaj, $yazar, $kullaniciAdi, $kulYetki);
//exit;


$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");
$mesaj = guvenlikKontrol($_REQUEST["mesaj"],"med");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
$akillandim = guvenlikKontrol($_REQUEST["akillandim"],"hard");

$sorgu1 = "SELECT id,sira,statu FROM konular WHERE `id` = '$sr'";
$sorgu2 = mysql_query($sorgu1);
$kayit2 = mysql_fetch_array($sorgu2);
$statu = $kayit2["statu"];

if ($statu == "silindi") {
	echo "<center><font size=2><img src=img/unlem.gif> Bu entry'in bagli oldugu baslik ucurulmus.</center>";
	die;
}

$sorgu1 = "SELECT id,statu FROM mesajlar WHERE `id` = '$id'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$statu=$kayit2["statu"];

if ($statu == "wait" and $kulYetki != "admin") {
	echo "<center><font size=2><img src=img/unlem.gif> Deneme entry'lari düzenlenemez.</center>";
	die;
}


if (($ok and $mesaj) and ($yazar == $kullaniciAdi or $kulYetki == "admin" or $kulYetki == "mod") and ($yazar !="" and $kullaniciAdi !="" and $kulYetki !="")) {

	$mesaj = ereg_replace("\n","<br>",$mesaj);
	$tarih = date("d/m/Y G:i");
	$sorgu = "UPDATE mesajlar SET `update2` = '$tarih' WHERE id='$id'";
	mysql_query($sorgu);
	
	$sorgu = "UPDATE mesajlar SET `updater` = '$kullaniciAdi' WHERE id='$id'";
	mysql_query($sorgu);


	if ($kulYetki == "mod" or $kulYetki == "admin") {
		$sorgu1 = "SELECT baslik FROM konular WHERE `id` = '$id'";
		$sorgu2 = mysql_query($sorgu1);
		$kayit2=mysql_fetch_array($sorgu2);
		$baslik=$kayit2["baslik"];
		
		$tarih = date("YmdHi");
		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
		
		//$sebep = strtolower($sebep);
	}

	if ($sebep) {
		$sorgu = "UPDATE mesajlar SET `updatesebep` = '$sebep' WHERE id='$id'";
		mysql_query($sorgu);
	}
	
	$mesaj = mysql_real_escape_string($mesaj);
	
	$sorgu = "UPDATE mesajlar SET mesaj = '$mesaj' WHERE id='$id'";
	mysql_query($sorgu);

	
	if ($statu == "kenar")
	{
	
	$tarih = date("YmdHi");
	$gun = date("d");
	$ay = date("m");
	$yil = date("Y");
	$saat = date("H:i");
	$ip = getenv('REMOTE_ADDR');

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('booyaka','kenardan entry var!','#$id','$kullaniciAdi bildirimi','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('dragunov','kenardan entry var!','#$id','$kullaniciAdi bildirimi','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);

	$xsorgu = "INSERT INTO privmsg ";
	$xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
	$xsorgu .= " VALUES ";
	$xsorgu .= "('abra yutpa','kenardan entry var!','#$id','$kullaniciAdi bildirimi','$tarih','2','$gun','$ay','$yil','$saat')";
	mysql_query($xsorgu);

	}
		

	if ($akillandim) {
		$sorgu = "UPDATE mesajlar SET statu = 'akillandim' WHERE id='$id'";
		mysql_query($sorgu);
		echo "<center><font size=2><img src=img/unlem.gif> Entry önceden patlatıldığı için yayına girmek için admin onayına sunuldu.</center>";
	} else {
		$sorgu = "UPDATE mesajlar SET statu = '' WHERE id='$id'";
		mysql_query($sorgu);
	}
	
	if ($yazar != $kullaniciAdi) {
		$sorgu = "SELECT id,baslik FROM konular WHERE id='$sr'";
		$sorgulama = mysql_query($sorgu);
		if (mysql_num_rows($sorgulama)>0){
			while ($kayit=mysql_fetch_array($sorgulama)){
				$baslik=$kayit["baslik"];
			}
		}else{
			echo "yok lan";
		}

		$tarih = date("YmdHi");
		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
	}

echo "<center>Mesaj Apdeyt edildi.</center>
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"1;URL=sozluk.php?process=eid&eid=$id\">
";
}
else {
if ($id) {
$sorgu = "SELECT * FROM mesajlar WHERE `id` = '$id' ORDER BY `tarih`";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$mesaj=$kayit["mesaj"];
$yazar=$kayit["yazar"];
	

	if ($yazar != $kullaniciAdi and $kulYetki != "admin" and $kulYetki != "mod")  {

		$ip = getenv('REMOTE_ADDR');
		echo "Dikkat!<br>$ip numarası ile gerçekleştirdiğiniz bu illegal işlem kayıtlara geçmiştir.";
		die;
	}


//EDIT BAŞLANGICI
		$tarih = date("YmdHi");
$sorgu = "SELECT * FROM mesajlar WHERE `id` = '$id' ORDER BY `tarih`";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$edithistory=$kayit["edithistory"];
}
}

$edithistory = $edithistory.$tarih;
$edithistory = $edithistory.'--------------BEGIN------------';
$edithistory = $edithistory.$mesaj;
$edithistory = $edithistory.'---------------------END-------';



	$sorgu = "UPDATE mesajlar SET edithistory = '$edithistory' WHERE id='$id'";
	mysql_query($sorgu);
	
$mesaj = ereg_replace("<br>","\n",$mesaj);
$mesaj = ereg_replace("<br />","",$mesaj);
echo "
<form method=\"post\" action=\"\">
  <table width=\"100%\" align=\"left\" class=\"dash\">
    <tr>
      <td colspan=\"2\">
<input type=text name=sebep size=90 value=\"$updatesebep\"> (Sebep)
          </td>
    </tr>
    <tr>
      <td colspan=\"2\">
                  <textarea id=\"entry\" name=\"mesaj\" rows=\"8\" style=\"width:100%;height:12em;max-height:12em;\">$mesaj</textarea>
          </td>
    </tr>
<tr>
<td width=\"90\">
<input id=\"kaydet\" class=\"but\" type=\"submit\" name=\"kaydet\" value=\"gönder\">
<input type=\"hidden\" name=\"ok\" value=\"kaydet\">
<input type=\"hidden\" name=\"yazar\" value=\"$yazar\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<input type=\"hidden\" name=\"akillandim\" value=\"$akillandim\">
<input type=\"hidden\" name=\"sr\" value=\"$sr\">
<input type=hidden name=id value=$id>
</td>
<td width=\"788\"align=\"right\" valign=\"top\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"bkz\" onClick=\"return insert('entry','(bkz: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"gizli bkz\" onClick=\"return insert('entry','`','`');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"foto\" onClick=\"return insert('entry','(foto: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"youtube\" onClick=\"return insert('entry','(youtube: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"spotify albüm\" onClick=\"return insert('entry','(spoalbum: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"spotify track\" onClick=\"return insert('entry','(spotrack: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"soundcloud\" onClick=\"return insert('entry','(soundcloud: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"kalın\" onClick=\"return insert('entry','(kalin: ',')');\">
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"*\" onClick=\"return insert('entry','~','~');\">	
<input class=\"but\" type=\"button\" name=\"bkz\" value=\"-s!-\" onClick=\"return insert('entry','--`spoiler`--','--`spoiler`--');\">
</td>
</tr>

  </table>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
";
}
}
}
}

?>
