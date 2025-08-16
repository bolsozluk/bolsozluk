<?

$id = guvenlikKontrol($_REQUEST["id"],"hard");

if ($haber != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
$sorgu = "DELETE FROM haberler WHERE id = '$id' LIMIT 1";
mysql_query($sorgu);
echo "($id) haber silindi";
?>