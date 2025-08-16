<?
extract($_REQUEST); //bunu silebilirim
$sorgu = "DELETE FROM privmsg WHERE kime = '$kullaniciAdi' and id = '$id' LIMIT 1";
mysql_query($sorgu);
if (mysql_query($sorgu))
Header ("Location: sozluk.php?process=privmsg");
?>