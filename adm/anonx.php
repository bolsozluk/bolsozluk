<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?
$yazar = guvenlikKontrol($_REQUEST["yazar"],"hard");
extract($_REQUEST); //bunu silebilirim

$eskinick = $yazar;
$sorset= mysql_fetch_array(mysql_query("SELECT reset FROM user WHERE `nick`='$yazar'"));
$reset=$sorset["reset"];


$sorgu = "SELECT nick,id FROM user WHERE `nick`='$nick'";
$sorgulama = mysql_query($sorgu);


	$nick = strtolower($nick);
		
					echo "değiştiriliyor...<br>"; 
	$sorgu1 = "UPDATE mesajlar SET yazar='anonim' WHERE yazar='$eskinick'";
	mysql_query($sorgu1);
	$sorgu3 = "UPDATE oylar SET entry_sahibi='anonim' WHERE entry_sahibi='$eskinick'";
	mysql_query($sorgu3);	
	$sorgu4 = "UPDATE user SET durum='sus' WHERE nick='$eskinick'";
	mysql_query($sorgu4);
//HELALDE BU SATIR BOŞTUR FAKAT SİLMEK ÇÖP TÜR

 echo '<b> entryler anonimleştirildi. <br> hesap kapatıldı. </b>';

				
	
?>
