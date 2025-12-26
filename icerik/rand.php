<HTML><HEAD><TITLE>iletisim</TITLE> 
<META http-equiv=Content-Type content="text/html; charset=windows-1254"><LINK href="inc/default.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>
</HEAD>
<BODY>
<?

$sor = mysql_query("select id from konular where statu = '' and gds ='g'");
$w = mysql_num_rows($sor);

mt_srand ((double)microtime()*1000000);
$maxran = $w;
$sayi = mt_rand(1, $maxran);
if (!$sayi)
echo "var bisiler var";	

$sorgu = "select * from konular WHERE id = $sayi and statu = '' and gds ='g'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$baslik=$kayit["baslik"];
$link = preg_replace("/ /","+",$baslik);
//header ("Location: sozluk.php?process=word&q=$link");
header ("Location: /sozluk.php?process=word&q=$link");
}
}
else {
header ("Location: /sozluk.php?process=word&q=bol+sozluk");
}
?>
</BODY></HTML>