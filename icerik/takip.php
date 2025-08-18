<center>·&nbsp;takip ettiklerin&nbsp;·</center><br>
<TABLE cellSpacing=0 cellPadding=0 border=0>
<SCRIPT language=javascript src="inc/vsozluk.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<body class=bgleft>
<?

$takip=mysql_query("select * from takip where nick='$kullaniciAdi'");
while ($takip2=mysql_fetch_array($takip)){
	$baslikid=$takip2['baslik'];
//	echo $baslikid;
	$baslikx=mysql_query("select baslik from konular where id = '$baslikid'");
	$baslik2=mysql_fetch_array($baslikx);
	$baslik=$baslik2['baslik'];
	$link = str_replace(" ","+",$baslik);
	////
 	
 echo "<li><a href='sozluk.php?process=word&q=$link#son' target='main'>$baslik </a></li>";
//	 echo "<li><a href='/bol/$link/$goster#son' target='main'>$baslk </a><a title='entry girilmiş'>($y)</a></li>";
}

?>

