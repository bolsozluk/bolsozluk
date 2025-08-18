<center>·&nbsp;moderasyon frame'i&nbsp;·</center><br>
<TABLE cellSpacing=0 cellPadding=0 border=0>
<SCRIPT language=javascript src="inc/vsozluk.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<body class=bgleft>
<?

$t1=mysql_query("SELECT *, COUNT(sira) FROM mesajlar WHERE statu != 'silindi' GROUP BY sira ORDER BY COUNT(sira) desc limit 500");
//echo "test1";
while ($t2=mysql_fetch_array($t1)) {
$nam=$t2['sira'];
$sql_beer=mysql_query("select baslik from konular where id = '$nam'");
$sql_fetch_beer=mysql_fetch_array($sql_beer);
$baslk=$sql_fetch_beer['baslik'];

$link = str_replace(" ","+",$baslk);
//echo "test2";

	$k=mysql_query("select * from mesajlar where sira='$nam' and statu != 'silindi' order by id");
	$y=mysql_num_rows($k);


echo "<li><a href='sozluk.php?process=word&q=$link#son' target='main'>$baslk </a><a title='dolu dolu'>($y)</a></li>";

}


?>

