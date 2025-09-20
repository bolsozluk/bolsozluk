<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?

$kullaniciAdi = $_SESSION['kullaniciAdi'];
$ayb = (int)($_GET['ayb'] ?? 0);
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
echo "anonimleştirilen entrylerinizniz yazar kimliğinizden ayrıştırılacak ve üzerindeki geçmiş oylamalar dahil olmak üzere hiçbir şekilde yazarlık hesabınızla ilişkili olarak bol sözlük'te geçmişe dönük kaydı tutulmayacaktır. bu nedenle de anonimleştirdiğiniz entry üzerinde hiçbir sorumluluk taşıyamayacak olduğunuz gibi, entry'nin tekrar yazar hesabınızla ilişkilendirilmesi gibi bir hak da iddia edemeyeceksiniz. onaylıyor musunuz?<br>";


		    if ($eskinick and $ayb==146)
		    {
					echo "değiştiriliyor"; 
	$sorgu1 = "UPDATE mesajlar SET yazar='anonim' WHERE yazar='$eskinick'";
	mysql_query($sorgu1);
	$sorgu3 = "UPDATE oylar SET entry_sahibi='anonim' WHERE entry_sahibi='$eskinick'";
	mysql_query($sorgu3);	
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR

$msg = "işlem başarılı. lütfen yeniden sözlüğe giriş yapın.";
 echo '<script type="text/javascript">alert("' . $msg . '"); window.location="http://www.bolsozluk.com/logout.php"; </script>';

			exit;
			}
	
?>




<form method="POST" action="sozluk.php?process=anon2">
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

