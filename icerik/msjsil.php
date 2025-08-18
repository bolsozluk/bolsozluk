
<?php
$id = isset($_REQUEST["id"]) ? guvenlikKontrol($_REQUEST["id"], "ultra") : "";
$kullaniciAdi = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : "";

$sorgu = "DELETE FROM privmsg WHERE kime = '$kullaniciAdi' and id = '$id' LIMIT 1";
mysql_query($sorgu);

Header("Location: sozluk.php?process=privmsg");
exit;
?>
