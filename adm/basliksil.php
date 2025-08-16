<?

$id = guvenlikKontrol($_REQUEST["id"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");

if ($baslik != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
if ($id and $sebep) {

$sorgu1 = "SELECT baslik FROM konular WHERE `id` = '$id'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];


$sorgu = "DELETE FROM konular WHERE id = '$id' LIMIT 1";
mysql_query($sorgu);
echo "($baslik) baslik silindi.<br>Basliga bagli olan mesajlar silindi.";
$sorgu = "DELETE FROM mesajlar WHERE sira = '$id'";
mysql_query($sorgu);


$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");

$sebep = strtolower($sebep);
$olay = "Baslik silindi.";
$mesaj = "<i>$baslik</i> Sebep: <b>$sebep</b>";

$sorgu = "INSERT INTO `history` ";
$sorgu .= "(`olay` , `mesaj` , `mod` , `tarih` , `gun` , `ay` , `yil` , `saat`)";
$sorgu .= " VALUES ";
$sorgu .= "('$olay','$mesaj','$kullaniciAdi','$tarih','$gun','$ay','$yil','$saat')";
mysql_query($sorgu);
}
else if ($id) {
echo "
      <FORM name=mesform method=post action=>
      <TABLE class=dash cellSpacing=0 cellPadding=3 width=\"100%\" align=center
      border=0>
        <TBODY>
        <TR>
          <TD width=\"11%\" height=\"18\"><p>Silinme Sebebi</p>
            </TD>
          <TD width=\"89%\"><INPUT class=inp maxLength=50 size=35 name=sebep>
            (admin tarafından görüntülenecek) </TD>
            <input type=hidden name=sira value=$sira>
            <input type=hidden name=id value=$id>
        </TR>
          <TD>&nbsp;</TD>
          <TD><INPUT type=hidden value=gonder name=gonder> <INPUT class=buton id=kaydet type=submit value=Sil name=kaydet>
          </TD></TR></TBODY></TABLE>
      </FORM>
";
}
?>