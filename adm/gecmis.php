<?
if ($gecmis != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
echo "
<table width=\"750\" border=\"1\">
  <tr>
    <td width=\"150\"><div align=\"center\"><strong>AKSIYON</strong></div></td>
    <td width=\"200\"><div align=\"center\"><strong>MOD</strong></div></td>
    <td width=\"400\"><div align=\"center\"><strong>DETAY</strong></div></td>
  </tr>
  ";
$sorgu = "SELECT * FROM history ORDER BY `tarih` desc";
$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$olay=$kayit["olay"];
$mesaj=$kayit["mesaj"];
$gun=$kayit["gun"];
$ay=$kayit["ay"];
$yil=$kayit["yil"];
$saat=$kayit["saat"];
$mod=$kayit["mod"];
echo "<tr>
    <td>$olay</td>
    <td><a href=sozluk.php?process=privmsg&islem=yenimsj&gkime=$mod>$mod</a></td>
    <td>$mesaj | $gun/$ay/$yil $saat</td>
  </tr>";
}
}
echo "</table>";

?>