<?

if (!isset($_SESSION['kulYetki_S']) || ($_SESSION['kulYetki_S'] != 'admin' && $_SESSION['kulYetki_S'] != 'mod')) {
    $user = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : 'Unknown';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    error_log("Yetkisiz erişim girişimi: " . $user . " - IP: " . $ip);
    header("Location: /sozluk.php?process=refresh");
    die;
}

$islem = guvenlikKontrol($_REQUEST["islem"],"hard");
$ip = guvenlikKontrol($_REQUEST["ip"],"hard");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");

if ($ipban != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}

if ($ok) {

$sorgu = "INSERT INTO ipban ";
$sorgu .= "(ip)";
$sorgu .= " VALUES ";
$sorgu .= "('$ip')";
mysql_query($sorgu);
echo "$ip blocklandi.";
}
else {
?>
<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>
</head>

<body>
<form METHOD=post action>
<table width="600" border="0">
  <tr>
    <td width="116">IP</td>
    <td width="8">:</td>
    <td width="341"><input name="ip" size=60 type="text" id="ip" value="<? echo $ip; ?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <input TYPE=hidden name=ok value=ok>
    <td><input type="submit" name="Submit" value="IP Ban"></td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>
