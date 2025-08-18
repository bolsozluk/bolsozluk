<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?

//$nick = guvenlikKontrol($_REQUEST["nick"],"hard");
$eskinick = $eskisi;


//echo "ayb:$ayb id:$id reset:$reset nick:$nick kuladi:$kullaniciAdi <br>";


//$sorset = "SELECT reset FROM user WHERE `nick`='$kullaniciAdi";
//$sorset1 = mysql_query($sorset);
//$kayset=mysql_fetch_array($sorset1);
//$siraondortx = $siraondort["sira"];

$id=0;

if ($ayb != 146)
		{
		$ayb = 0;
		}

$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);


	$nick = strtolower($nick);
echo "özel <b>t</b>anık <b>k</b>oruma <b>p</b>rogramı arayüzü: <br>";
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

			if ($id>0) // or $reset
			{ 
			echo "...kontenjan yetersiz";
			exit;
			} 
		} 


    } 	


	if ($ayb==146 and (!ereg ("^[' A-Za-z0-9]+$", $nick))) {
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





		    if ($id==0 and $nick and $ayb==146)
		    {
		//    echo "ayb:$ayb id:$id reset:$reset nick:$nick kuladi:$kullaniciAdi <br>";
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
	//++$reset;
	//$sorgu9 = "UPDATE user SET reset='$reset' WHERE nick='$eskinick'"; 
	//mysql_query($sorgu9); 
	$sorgu8 = "UPDATE user SET nick='$nick' WHERE nick='$eskinick'";
	mysql_query($sorgu8);

//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR

			exit;
			}
    // echo "<br> değiştiriliyor"; 

    	// BU DEĞİL		echo "id:$id reset:$reset nick:$nick kuladi:$kullaniciAdi";
			
//MESAJLAR YAZAR
//OYLAR NICK
//OYLAR ENTRY_SAHIBI
//PRIVMSG GONDEREN
//PRIVMSG KIME
//REHBER KIM
//REHBER KIMIN
//USER NICK
	
	
?>




<form method="POST" action="sozluk.php?process=adm&islem=nickdegis">
<table cellpadding="10px" border="0">
<tr>
<td align="right">eskisi: </td>
<td><div align="left"><input name="eskisi"  size="30" type="text"></div></td>
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

