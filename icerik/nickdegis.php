<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">
<?
$eskinick = $kullaniciAdi = isset($_REQUEST['kullaniciAdi']) ? $_REQUEST['kullaniciAdi'] : '';
$nick = isset($_REQUEST['nick']) ? $_REQUEST['nick'] : '';
$ayb  = isset($_REQUEST['ayb'])  ? $_REQUEST['ayb']  : 0;
$sorset= mysql_fetch_array(mysql_query("SELECT reset FROM user WHERE `nick`='$kullaniciAdi'"));
$reset=$sorset["reset"];
if ($reset >0)
{
	echo"kotanızı geçici bir süreliğine doldurmuşsunuz.";
	die;
}
$id=0;
if ($ayb != 146)
		{
		$ayb = 0;
		}

$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);
$nick = strtolower($nick);
echo "güzel insan <i>$kullaniciAdi</i> için özel <b>t</b>anık <b>k</b>oruma <b>p</b>rogramı arayüzü: <br>";
echo "not: bu imkanı şimdilik 1 defa kullanabilirsiniz. <br>";
echo "izinizi kaybettirmek için yeni nickinizi girin: <br>";
//echo "<br>:$reset";
	if (mysql_num_rows($sorgulama)>0)
	{
		while ($kayit=mysql_fetch_array($sorgulama))
		{
		if ($kayit["id"] > 0)
		{
		$id=$kayit["id"];	
		}
	//	$bos = is_null($id);
			if ($id>0 or $reset>0) // or $reset
			{ 
			echo "...kontenjan yetersiz";
			exit;
			} 
		} 
    } 	
	if ($ayb == 146 && !preg_match("/^[' A-Za-z0-9]+$/", $nick)) {
		echo "Nickinizde;
		<br>sadece kucuk ve ingilizce harfler,
		<br>bosluk {space},
		<br>ve rakamlar bulunabilir.
		<br>Lötfen bu kurallara uygun bir nick yazin.
		<br>Bak lütfen diyorum.
		";
		die();
	}
	if ($nick == "" and $ayb == 146) {
		echo "O boşlukları neyle dolduracaksın ?";
		exit;
	}
		    if ($id==0 and $reset==0 and $nick and $ayb==146)
		    {
			echo "değiştiriliyor"; 
	$sorgu1 = "UPDATE mesajlar SET yazar='$nick' WHERE yazar='$eskinick'";
	mysql_query($sorgu1);
	$sorgu2 = "UPDATE oylar SET nick='$nick' WHERE nick='$eskinick'";
	mysql_query($sorgu2);
	$sorgu3 = "UPDATE oylar SET entry_sahibi='$nick' WHERE entry_sahibi='$eskinick'";
	mysql_query($sorgu3);
	$sorgu4 = "UPDATE privmsg SET gonderen='$nick' WHERE gonderen='$eskinick'";
	mysql_query($sorgu4);
	$sorgu5 = "UPDATE privmsg SET kime='$nick' WHERE kime='$eskinick'";
	mysql_query($sorgu5);
	$sorgu6 = "UPDATE rehber SET kim='$nick' WHERE kim='$eskinick'";
	mysql_query($sorgu6);
	$sorgu7 = "UPDATE rehber SET kimin='$nick' WHERE kimin='$eskinick'";
	mysql_query($sorgu7);
	++$reset;
	$sorgu9 = "UPDATE user SET reset='$reset' WHERE nick='$eskinick'"; 
	mysql_query($sorgu9); 
	$sorgu8 = "UPDATE user SET nick='$nick' WHERE nick='$eskinick'";
	mysql_query($sorgu8);
	$sorgu9 = "UPDATE takip SET nick = REPLACE('$eskinick', '$eskinick', '$nick' )";
	mysql_query($sorgu9);
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR
$msg = "yeni yüzünüzle tekrar ortama giriş yapın";
echo '<script type="text/javascript">alert("' . $msg . '"); window.location="http://www.bolsozluk.com/logout.php"; </script>';
			exit;
			}
    // echo "<br> değiştiriliyor"; 
?>
<form method="POST" action="sozluk.php?process=nickdegis">
<table cellpadding="10px" border="0">
<tr>
<td align="right">eskisi: </td>
<td>
	<div align="left"><input name="eskisi" size="30" readonly="1" value="<?php echo isset($_REQUEST['kullaniciAdi']) ? htmlspecialchars($_REQUEST['kullaniciAdi']) : ''; ?>" type="text"></div>
</tr>
<tr>
<td align="right">yenisi: </td>
<td> <div align="left"><input name="nick"  size="30"  type="text"></div></td>
</tr>
<tr>
<td align="right">sayıyla 145+1: </td>
<td> <div align="left"><input name="ayb"  size="30"  type="text"></div></td>
</tr>
<tr>
<td colspan="2" align="">
<input class=but value="al beni ne yaparsan yap" name="send" type="submit" id="send">
</td>
</tr>
</table>
</form>
