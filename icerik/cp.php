<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
html {
overflow: -moz-scrollbars-vertical; 
overflow-y: scroll;
}
</style>
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
$okupdate = guvenlikKontrol($_REQUEST["okupdate"],"hard");
$email = guvenlikKontrol($_REQUEST["email"], "hard");
$avatarURL = guvenlikKontrol($_REQUEST["avatarURL"],"hard");
$mottoTXT = guvenlikKontrol($_REQUEST["mottoTXT"],"hard");
$aktifTema = guvenlikKontrol($_REQUEST["tema"],"hard");
$yuklenecekSayfa = guvenlikKontrol($_REQUEST["process"],"hard");
$ucur = guvenlikKontrol($_REQUEST["ucur"],"ultra");
$oks = guvenlikKontrol($_REQUEST["oks"],"hard");
$moks = guvenlikKontrol($_REQUEST["moks"],"hard");
$yemail = guvenlikKontrol($_REQUEST["yemail"],"hard");
$yevilayet = guvenlikKontrol($_REQUEST["yevilayet"],"hard");

if ($okupdate) {
    $sorgu = "SELECT * FROM user WHERE nick='".$kullaniciAdi."' LIMIT 1";
    $sorgulama = mysql_query($sorgu);
    if ($kayit = mysql_fetch_array($sorgulama)) {
        $email  = $kayit["email"];
        $motto  = $kayit["motto"];
        $avatar = $kayit["avatar"];
    }
}

if ($okupdate == "") {

	$sorgu = "SELECT * FROM user WHERE `nick` = '$kullaniciAdi'";
	$sorgulama = @mysql_query($sorgu);	
	
	if (@mysql_num_rows($sorgulama)>0){
	
		while ($kayit=@mysql_fetch_array($sorgulama)){			
			$userNickName=$kayit["nick"];
			$email=$kayit["email"];
			$motto=$kayit["motto"];
			$avatar=$kayit["avatar"];
}
}
}
	
	$sorgu = "SELECT tema,id FROM temalar WHERE tema = '$aktifTema'";
	$sorgulama = mysql_query($sorgu);
	
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$dbtema=$kayit["tema"];
			if ($dbtema == $aktifTema) {
				if ($kullaniciAdi) {
						$mysqlSentence = "UPDATE user SET tema = '$aktifTema' WHERE nick='$kullaniciAdi'";
					mysql_query($mysqlSentence);
					$_SESSION['aktifTema_S'] = $aktifTema;
					if (!$aktifTema)	$aktifTema = "default";
				} else {
					$aktifTema = "default";
				}
				header("Location: sozluk.php?process=refresh");
			}else{
				echo "Böyle bir tema yok ki ?";
				die;
			}
		}
	}


if ($ucur) {
	$sorgu = "SELECT yazar,id FROM mesajlar WHERE `id` = '$ucur' and yazar = '$kullaniciAdi'";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$id=$kayit["id"];
		//	$sorgu = "DELETE FROM mesajlar WHERE id = '$id' LIMIT 1";
			$sorgu = "UPDATE mesajlar SET ucur='1' WHERE id = '$id' LIMIT 1";
			mysql_query($sorgu);
			echo "<div class=dash><center><b>(#$id) entry'iniz sistemden uçuruldu.</div>";
			echo '<script type="text/javascript"> window.location="sozluk.php?process=panel&islem=cp"; </script>';
			die;
		}
	}
}

?>
<body>
not: şifre hanesini boş bırakarak yaptığınız güncellemeler mevcut şifrenizi değiştirmez.
<br>
<br>
	<form method="post" action="">
			<fieldset>
			<table width="351" border="0">			
			  <tr> 
			  <tr> 
              	<td width="111">Nick</td><td width="9">:</td>
				<td width="217"><input name="nick" type="text" id="nick" value="<?php echo $kullaniciAdi; ?>" readonly></td>
			  </tr>
			  <tr>
				<td>Şifre</td><td>:</td>
				<td><input name="sifre" type="text" id="sifre"></td>
			  </tr>
			  <tr>
				<td>E-Mail</td><td>:</td>
				<td><input name="email" type="text" id="email" value="<?php echo $email; ?>"></td>
			  </tr>
			<tr><td>Motto:</td><td>:</td>
			    <td><input name="mottoTXT" type="text" id="mottoTXT" value="<?php echo $motto; ?>"></td>
			</tr>
			<tr><td>Avatar URL:</td><td>:</td>
			    <td><input name="avatarURL" type="text" id="avatarURL" value="<?php echo $avatar; ?>"></td>
			</tr>
              <tr>
              	<td></td><td></td>
                <input type="hidden" name="okupdate" value="ok">
    			<td><input type="submit" name="Submit" value="Apdeyt"></td>
    		</tr>
    		</tr>
			</table>
			</form>
<br>
<?

if ($okupdate) {

	if ($sifre) $sifre = sha1($sifre);

	$sorgu = "UPDATE user SET email='".$email."' WHERE nick='".$kullaniciAdi."'";
	mysql_query($sorgu);


	$byteLimit = 180000; // 128 KB
	
	$headers = get_headers($avatarURL, 1);
	
	if ($headers && isset($headers['Content-Length'])) {
		$dosya_boyutu = $headers['Content-Length'];
	
		if ($dosya_boyutu > $byteLimit) {
			echo 'Avatar boyutu belirtilen sınırı aşıyor.';
		} else {
			$sorgu = "UPDATE user SET avatar='$avatarURL' WHERE nick='$kullaniciAdi'";
			mysql_query($sorgu);
			echo 'Avatar guncellendi.';
		}
	}


	$sorgu = "UPDATE user SET motto='$mottoTXT' WHERE nick='$kullaniciAdi'";
	mysql_query($sorgu);

	if ($sifre) {
		$sorgu = "UPDATE user SET sifre = '$sifre' WHERE nick='$kullaniciAdi'";
		mysql_query($sorgu);
	}

  
echo "<center><b>$kullaniciAdi Apdeytıd.</center></b>";
}

//ÖZEL MESAJ ALIMI
if ($msgdurum == 0){$msgdurum='açık';}
if ($msgdurum == 1){$msgdurum='kapalı';}
?>
Hesabın Özel Mesaj Alımına: <?echo $msgdurum;?><br><br>
<input type='button' onclick="javascript:location.href='sozluk.php?process=msgblok'" value='Hesabımı Mesaj Alımına Aç/Kapat' class='butx'> 
<input type='button' onclick="javascript:location.href='sozluk.php?process=anon2'" value='Tüm Entrylerimi Anonimleştir' class='butx'> 
<br><br>
<input type='button' onclick="javascript:location.href='sozluk.php?process=hesapkapa'" value='Hesabımı Kapat' class='butx'> 
<input type='button' onclick="javascript:location.href='sozluk.php?process=anon3'" value='Entrylerimi Anonimleştir ve Hesabımı Kapat' class='butx'> <br> 
</form>
    </td>
  </tr>
</table>
</div>
</fieldset>
<br>
<div class=div1>
<? 
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kullaniciAdi' and `statu` = '' ");
$kactop = mysql_num_rows($sor);
echo "<b><font size=1>Entry sayiniz:</b> $kactop<br>";

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kullaniciAdi' and `statu` = 'silindi' ");
$kac = mysql_num_rows($sor);
echo "<b>Patlayan entry sayiniz:</b> $kac<br>";

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kullaniciAdi' and oy = 1");
$arti = mysql_num_rows($sor);
echo "<b>Toplam arti oy sayiniz:</b> $arti<br>";

//$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kullaniciAdi' and oy = 0");
//$eksi = mysql_num_rows($sor);
//echo "<b>Toplam eksi oy sayiniz:</b> $eksi<br>";

$ortalama = $arti - $eksi;
$toplam = $arti + $eksi;

?>
</div>
<div class=div1>
<?
$max = 500;

if (!$_GET["sayfa"])  { $_GET["sayfa"]=1; }

$alt = ($_GET["sayfa"] - 1)  * $max;

echo "
<OL>
";
$say = 0;
$sor = mysql_query("select * from mesajlar WHERE `yazar`='$kullaniciAdi' and `statu` = 'silindi' and 'ucur' = '0' ");
$w = mysql_num_rows($sor);

$listele = mysql_query("SELECT * FROM mesajlar WHERE `yazar`='$kullaniciAdi' and `statu` = 'silindi' and `ucur` = '0' ORDER BY `id` desc limit $alt,$max");
if (mysql_num_rows($listele)>0){
while ($kayit=mysql_fetch_array($listele)) {

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

// Türkçe karakterleri normal harfe çevirme
$lower = array(
    "ş"=>"s","Ş"=>"S","ç"=>"c","Ç"=>"C",
    "ı"=>"i","İ"=>"I","ğ"=>"g","Ğ"=>"G",
    "ö"=>"o","Ö"=>"O","ü"=>"u","Ü"=>"U"
);
$link  = strtr($link, $lower);
$mesaj = mb_strtolower($mesaj, "UTF-8"); // büyük Türkçe harfleri küçültür
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
$sorgu1 = "SELECT * FROM konular WHERE id = $sira";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];
$say++;
if (!$ayazar) die;
echo "
  <LI value=$say>
  <DIV class=dash>
  <b>Başlık:</b> $baslik<br>
  $mesaj<BR>
  <b>Patlatan:</b> <A href=\"sozluk.php?process=word&q=$silen\" title=\"$silen\"><font size=1><b>$silen</b></font></A> (<b><A  href=\"sozluk.php?process=privmsg&islem=yenimsj&gkime=$silen&gkonu=$id patlayan entry\"><font size=1>msg</A></font></b>)<br>
  <b>Sebep:</b> $silsebep<br>
  (<a href=sozluk.php?process=cp&ucur=$id>tamamen sil</a>) - (<a href=sozluk.php?process=eduzenle&id=$id&sr=$sira&akillandim=$id>düzelt ve onaya gönder</a>)
  ";
  echo "
  </DIV>
  <DIV class=div2 align=right><font size=1>(#$id) <B><A href=\"sozluk.php?process=word&q=$echoyazar\" title=\"$yazartitle\"><font size=1>$yazar</A></B>|$gun/$ay/$yil $saat
  </DIV><BR><BR>
  </li>
";}
}
?>
</div>
<p>&nbsp;</p>
</body>
