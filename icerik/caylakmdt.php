<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">

<?
//OTOMATİK ÇAYLAK KONTROLÜ
$tarih  = strtotime('now');

$listele1 = mysql_fetch_array(mysql_query("SELECT muddet, nick, infaztarih, muddettarih FROM user WHERE muddet > '0' and durum ='off' ORDER BY muddettarih asc limit 0,1"));
$yazar = $listele1["nick"];
$muddet=$listele1["muddet"];
$infaztarih=$listele1["infaztarih"];
$muddettarih=$listele1["muddettarih"];
//echo " $yazar ";
//echo " $tarih ";
//echo " $muddettarih ";

if ($tarih > $muddettarih)
{
	echo "Otomatik çaylaklık kontrolleri yapılıyor. ";

$msjcheck = mysql_query("SELECT muddet, nick, infaztarih,durum FROM user WHERE muddet > '0' and durum ='off'  ORDER BY id desc limit 0,1");
if(mysql_num_rows($msjcheck)==0)
{
	echo " Otomatik çaylaklık kontrolüne girecek yazar bulunamadı. <br> ";
}
if(mysql_num_rows($msjcheck)>0)
{
	echo " Otomatik çaylaklık düzeltmeleri gerçekleştiriliyor. <br>";

}


	$listele1 = mysql_fetch_array(mysql_query("SELECT muddet, nick, infaztarih,durum FROM user WHERE muddet > '0' and durum ='off'  ORDER BY id desc limit 0,1"));

	$sorgu2 = "UPDATE user SET durum='on' WHERE nick='$yazar'";
	mysql_query($sorgu2);

	$sorgu3 = "UPDATE user SET muddettarih='9999999999' WHERE nick='$yazar'";
	mysql_query($sorgu3);

	


}

if ($tarih < $muddettarih)
{
//	echo " fail.";
}




?>
