	<?
$listele3 = mysql_query("SELECT nick, COUNT(*) as oyadet FROM oylar WHERE oy ='0' GROUP BY nick ORDER BY oyadet DESC LIMIT 0,30");
while ($kayit3=mysql_fetch_array($listele3)) {
$yazar2=$kayit3["nick"];
$oyadet=$kayit3["oyadet"];
$sayixx++;
//	echo "<b>$yazar2</b>nin ";
		// echo "<b>$oyadet</b> eksisi var.<br>";
}

echo "<br>";

$listele4 = mysql_query("SELECT nick, COUNT(*) as oyadet FROM oylar GROUP BY nick ORDER BY oyadet DESC LIMIT 0,30");
while ($kayit4=mysql_fetch_array($listele4)) {
$yazar3=$kayit4["nick"];
$oyadet2=$kayit4["oyadet"];
$sayixx++;
//	echo "<b>$yazar3</b>nin ";
//		echo "<b>$oyadet2</b> oyu var.<br>";
}

echo "<br>";


$listele5 = mysql_query("SELECT nick, COUNT(*) as oyadet FROM oylar WHERE oy ='0' GROUP BY nick ORDER BY oyadet DESC LIMIT 0,150");
while ($kayit5=mysql_fetch_array($listele5)) {
$yazar4=$kayit5["nick"];
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$yazar4' and `statu` = '' ");
$kac = mysql_num_rows($sor);
$oyadet3=$kayit5["oyadet"];
$sayixx++;
	
	++$kac;
	$oran = ($oyadet3/$kac);
	--$kac;
	if ($oran > 1){
		echo "<b>$yazar4</b>nin ";
		echo "<b>$oyadet3</b> eksisi, $kac adet entrysi var. oranı $oran.<br>";
}
}


		?>