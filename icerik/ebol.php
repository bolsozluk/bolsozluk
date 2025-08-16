<?

$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");

if ($id and $sira) {
	$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$baslik=$kayit2["baslik"];
	
	$sorgu1 = "SELECT mesaj,id,yazar FROM mesajlar WHERE `id` = '$id'";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$mesaj=$kayit2["mesaj"];
	$dbyazar=$kayit2["yazar"];
	
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

	
	$sebep = strtolower($sebep);

		if (!$ucur) {
		$sorgu = "UPDATE mesajlar SET `yazar` = 'bolsozluk' WHERE id='$id'";
		mysql_query($sorgu);		
		$sorgu = "UPDATE oylar SET entry_sahibi='bolsozluk' WHERE entry_id='$id'";
		mysql_query($sorgu);		
		echo "<div class=dash><center><b>$id anonimleştirildi.</div>";
	}
	
}else if ($id) {
?>
<form name="a" method="post" action="">
    <table width="564" height="52" border="0">
    	entry bolsozluk hesabı üzerine geçirilecektir?
      <tr>
        <td width="232"><input name="kabul" type="radio" value="kabul">kabul ediyorum</td>        
      </tr>     
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="sira" value="<?php echo $sr; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" value="gonder" name="gonder">
            <input class="buton" id="kaydet" type="submit" value="patlat" name="kaydet"></td>
      </tr>
    </table>
</form>
<?php } ?>