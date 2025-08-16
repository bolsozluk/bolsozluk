<?

$query = mysql_query("SELECT ip, yazar FROM `iptables`");
$numrows = mysql_num_rows($query);
echo $numrows;
echo " işlem incelendi.<br><br>";

/*for ($i=1;$i<=$numrows;$i++) 
{
$sorgu3 = mysql_query("SELECT id, ip, yazar FROM `iptables` WHERE id = '$i'");
$kayit=mysql_fetch_array($sorgu3);
$ip=$kayit["ip"];
$ipdecimal = ip2long($ip);
mysql_query("UPDATE iptables SET ipdecimal='$ipdecimal' WHERE id='$i'");
}*/


mysql_query("CREATE TABLE `iptables2` LIKE `iptables`");
mysql_query("INSERT INTO `iptables2` (`yazar`, `ip`,`tarih`,`ipdecimal`) SELECT `yazar`, `ip`,`tarih`,`ipdecimal` FROM `iptables` ORDER BY `ipdecimal`");
mysql_query("RENAME TABLE `iptables` TO `iptables1`");
mysql_query("RENAME TABLE `iptables2` TO `iptables`");
mysql_query("DROP TABLE iptables1");
mysql_query("DROP TABLE iptables2");

$z = 1;
for ($i=1;$i<=$numrows;$i++) 
{
$j=($i+1);
$k=($i-1);
$l=($i-2);



$sorgu1 = mysql_query("SELECT id, ip, yazar,tarih FROM `iptables` WHERE id = '$i'");
$kayit=mysql_fetch_array($sorgu1);
$yazar=$kayit["yazar"];

$sorgu2 = mysql_query("SELECT id, ip, yazar,tarih FROM `iptables` WHERE id = '$j'");
$kayit=mysql_fetch_array($sorgu2);
$yazar1=$kayit["yazar"];


$c = strcmp($yazar, $yazar1);
if ($c == -1)
{
	//echo "ilk yazar önce";	
}

if ($c == 1)
{
	$yazar2 = $yazar1;
	$yazar1 = $yazar;
	$yazar = $yazar2;
}

//echo "<br>";
//echo $i;echo "<br>";
//echo $j;echo "<br>";
//echo $yazar;echo "<br>";
//echo $yazar1;echo "<br>";

$sorgu3 = mysql_query("SELECT id, ip, yazar, ipdecimal,tarih FROM `iptables` WHERE id = '$i'");
$kayit=mysql_fetch_array($sorgu3);
$ip=$kayit["ip"];
$ipdecimal=$kayit["ipdecimal"];
$tarih=$kayit["tarih"];
$tarihx=strtotime($tarih);
//echo $ipdecimal;


$sorgu4 = mysql_query("SELECT id, ip, yazar, ipdecimal,tarih FROM `iptables` WHERE id = '$j'");
$kayit=mysql_fetch_array($sorgu4);
$ip1=$kayit["ip"];
$ip1decimal=$kayit["ipdecimal"];
$tarih1=$kayit["tarih"];
$tarih1x=strtotime($tarih1);


//echo $ipdecimal;echo "<br>";
//echo $ip1decimal;echo "<br>";


// ($ipdecimal == $ip1decimal and $yazar != $yazar1 and ($oncekiyazar != $yazar and $oncekiyazar1 != $yazar1))
if ($ipdecimal == $ip1decimal and $yazar != $yazar1 )
{
	
	if ($yazar == 'admin' or $yazar1 =='admin')
	{

	}
	else
	{
    $z = ($z+1);
	$ekran[$z] = "<b>$yazar</b> ve <b>$yazar1</b> birbirinin feyki olabilir. <a href=http://whatismyipaddress.com/ip/$ip target=new>$ip</a> ";
	$y = ($z-1);
//echo $ekran[$z]; 

	
	if ($ekran[$z] != $ekran[$y])
{
	echo $ekran[$z];
	//echo $tarihx;
	//echo "_";
	//echo $tarih1x;
//echo "_";
//echo abs(intval(($tarih-$tarih1)));
echo "<br>";

	 }

}}
//echo $yazar;
}
?>