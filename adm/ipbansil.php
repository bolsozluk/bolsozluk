<?

$id = guvenlikKontrol($_REQUEST["id"],"hard");

if ($ipban != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
$sorgu = "DELETE FROM ipban WHERE id = '$id' LIMIT 1";
mysql_query($sorgu);
echo "($id) ipsi silindi.";
?>