<?
session_start();
include "icerik/baglan.php";
vtBaglan();

$sorgu = "DELETE FROM online WHERE nick = '".$_SESSION['kullaniciAdi_S']."' LIMIT 1";
mysql_query($sorgu);

mysql_close($databaseConnection);
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="inc/top.js"></script>
<script type="text/javascript" src="inc/sozluk.js"></script>
<link href="favicon.ico" rel="shortcut Icon">
<link href="favicon.ico" rel="icon">
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">
</head>
<body>
<script type="text/javascript">
	top.menu.location.href='sozluk.php?process=top';
	top.main.location.href='sozluk.php?process=word&q=bizi+seçtiğiniz+için+teşekkür+ederiz';
</script>
</body>
</html>