<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">
<?

$eskinick = $kullaniciAdi;
$sorset= mysql_fetch_array(mysql_query("SELECT reset FROM user WHERE `nick`='$kullaniciAdi'"));
$reset=$sorset["reset"];


if ($ayb != 146)
		{
		$ayb = 0;
		}

$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);


	$nick = strtolower($nick);
echo " kapatılan hesaplar tekrar açılamayacak olup bu işlemi gerçekleştirdiğiniz takdirde sözlükteki mevcut hak ve sorumluluklarınızı sözlüğe iade etmiş olacak ve kapatılan hesabınızla ilgili sözlükten herhangi bir talepte bulunamayacaksınız. onaylıyor musunuz?<br>";


		    if ($eskinick and $ayb==146)
		    {
					echo "değiştiriliyor"; 

  $tarih = date("YmdHi");

	$sorgu2 = "UPDATE user SET silsebep='kendini uçurdu' WHERE nick='$eskinick'";
	mysql_query($sorgu2);
	$sorgu4 = "UPDATE user SET durum='sus' WHERE nick='$eskinick'";
	mysql_query($sorgu4);
	$sorgu5 = "UPDATE user SET silen='$eskinick' WHERE nick='$eskinick'";
	mysql_query($sorgu5);
	$sorgu6 = "UPDATE user SET bantarih='$tarih' WHERE nick='$eskinick'";
	mysql_query($sorgu6);
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR

$msg = "hesabınız kapatıldı. yeni hesabınızla, yine bekleriz.";
 echo '<script type="text/javascript">alert("' . $msg . '"); window.location="http://www.bolsozluk.com/logout.php"; </script>';

			exit;
			}
	
?>
<form method="POST" action="sozluk.php?process=anon3">
<table cellpadding="10px" border="0">
<tr>
<td align="right">sayıyla 145+1: </td>
<td> <div align="left"><input name="ayb"  size="30"  type="text"></div></td>
</tr>
<tr>
<td colspan="2" align="">
<input class=but value="onaylıyorum" name="send" type="submit" id="send">
</td>
</tr>
</table>
</form>

