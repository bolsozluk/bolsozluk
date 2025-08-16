	<?
	echo "SIFIR ENTRYLİLER<br>";
$listele3 = mysql_query("SELECT nick, email from user left outer join mesajlar on (nick= yazar)
where yazar is null and durum='on'
order by nick desc ");

	//SELECT yazar, COUNT(*) as entryler FROM mesajlar WHERE statu ='' GROUP BY yazar ORDER BY entryler ASC LIMIT 0,1500");
while ($kayit3=mysql_fetch_array($listele3)) {
$yazar2=$kayit3["nick"];
$yazarm=$kayit3["email"];
$oyadet=$kayit3["entryler"];
$sayixx++;
	echo "$sayixx . <a href=\"https://www.bolsozluk.com/sozluk.php?process=adm&islem=kullanici&update=ok&gnick='$yazar2'\"><b>$yazar2</b></a>nin ";
		echo "<b>0</b> entrysi var, maili <b>[$yazarm]</b>.<br>";
}

echo "<br>";

echo "AZ ENTRYLİLER";
echo "<br>";
$sayixx = 0;

$listele4 = mysql_query("SELECT yazar, COUNT(*) as entryler FROM mesajlar WHERE statu ='' GROUP BY yazar ORDER BY entryler ASC LIMIT 0,300");
while ($kayit4=mysql_fetch_array($listele4)) 
{
$yazar3=$kayit4["yazar"];
$listele5 = mysql_query("SELECT email FROM user WHERE nick ='$yazar3'");
$kayit5=mysql_fetch_array($listele5);
$azmail=$kayit5["email"];
$oyadetx=$kayit4["entryler"];
$sayixx++;
	echo "$sayixx . <a href=\"https://www.bolsozluk.com/sozluk.php?process=adm&islem=kullanici&update=ok&gnick='$yazar3'\"><b>$yazar3</b></a>nin ";
		echo "	<a href=\"https://www.bolsozluk.com/sozluk.php?process=entryliste&kimdirbu=$yazar3\" title\"GBT\"> [$oyadetx]</a> entrysi var, maili <b>[$azmail]</b>.<br>";
}

echo "<br>";


		?>