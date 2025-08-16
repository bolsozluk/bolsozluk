<center>·&nbsp;senden sonra&nbsp;·</center>
<hr>
<TABLE cellSpacing=0 cellPadding=0 border=0>
<SCRIPT language=javascript src="inc/vsozluk.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<body class=bgleft>
<?
extract($_REQUEST); //bunu silebilirim
$s4=mysql_query("select * from mesajlar where yazar='$kullaniciAdi' and statu != 'silindi' group by sira desc limit 60");

while ($o3=mysql_fetch_array($s4)) {
$nam=$o3['sira'];
$sql_beer=mysql_query("select baslik from konular where id = '$nam'");
$sql_fetch_beer=mysql_fetch_array($sql_beer);
$baslk=$sql_fetch_beer['baslik'];

$k=mysql_query("select * from mesajlar where yazar='$kullaniciAdi' and sira='$nam' order by id desc limit 1");
$z=mysql_fetch_array($k);
$sid=$z['id'];
$m=mysql_query("select * from mesajlar where sira='$nam' and id>$sid");
$y=mysql_num_rows($m);
$link = str_replace(" ","+",$baslk);

$sorgu = "SELECT * FROM konular WHERE `baslik`='$baslk'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$gid=$kayit["id"];
$sor = mysql_query("select id from mesajlar WHERE `sira`=$gid and `statu` = '' ");
			$w = mysql_num_rows($sor);
			$max = 25;
			$goster = $w/$max;
			$goster=ceil($goster);

if($y==0){
echo "";
} else {

 echo "<li><a href='sozluk.php?process=word&q=$link#son' target='main'>$baslk </a><a title='entry girilmiş'>($y)</a></li>";
//	 echo "<li><a href='/bol/$link/$goster#son' target='main'>$baslk </a><a title='entry girilmiş'>($y)</a></li>";
}
}


?>

