<SCRIPT src="inc/new.js" type=text/javascript></SCRIPT>
<?

if ($kulYetki != "gammaz" or $id == "")
die;

if ($sebep and $ok and $id) {
$sorgu1 = "SELECT id,statu FROM mesajlar WHERE `id` = '$id'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$statu=$kayit2["statu"];

$sorgu = "UPDATE mesajlar SET `statu` = 'ispit' WHERE id='$id'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `silen` = '$kullaniciAdi' WHERE id='$id'";
mysql_query($sorgu);
$sorgu = "UPDATE mesajlar SET `silsebep` = '$sebep' WHERE id='$id'";
mysql_query($sorgu);


echo "<center><font size=2><img src=img/unlem.gif> #$id silindi ve onaylanmak üzere ispit listesine gönderildi.</center>";
die;
}
else {
echo "
      <FORM name=a method=post action=>

<table width=\"564\" height=\"52\" border=\"0\">
  <tr>
    <td width=\"232\"><input name=\"sebep\" type=\"radio\" value=\"formata uygun degil\">
      format uygun degil </td>
    <td width=\"322\"><input name=\"sebep\" type=\"radio\" value=\"daha önce ki entry ile ayni anlamda\">
      daha &ouml;nce ki entry ile ayni anlamda </td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"bkz hedeleri yanlis kullanilmis\">
      bkz hedeleri yanlis kullanilmis </td>
    <td><input name=\"sebep\" type=\"radio\" value=\"önceki entry'lara cevap niteliginde\">
      &ouml;nceki entry'lara cevap niteliginde</td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"belali entry\">
      belali entry </td>
    <td><input name=\"sebep\" type=\"radio\" value=\"kaynak belirtilmemis\">
      kaynak belirtilmemis </td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"chat dili kullanimi\">
      chat dili kullanimi
</td>
    <td><input name=\"sebep\" type=\"radio\" value=\"forum tarzi entry\">
    forum tarzi entry </td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"imla hatasi\">
imla hatas&#305;</td>
    <td><input name=\"sebep\" type=\"radio\" value=\"yazim hatasi\">
      yaz&#305;m hatas&#305;
</td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"baslikla alakasiz entry \">
      baslikla alakasiz entry  </td>
    <td><input name=\"sebep\" type=\"radio\" value=\"gereksiz entry\">
      gereksiz entry </td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"sadece küfürden olusan entry\">
    sadece k&uuml;f&uuml;rden olusan entry </td>
    <td><input name=\"sebep\" type=\"radio\" value=\"hakaret içeren entry\">
      hakaret i&ccedil;eren entry
</td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"hatali baslik\">
      hatali baslik
</td>
  </tr>
  <tr>
    <td><input name=\"sebep\" type=\"radio\" value=\"bkz kullanilmasi gereken entry\">
      bkz kullan&#305;lmas&#305; gereken entry
</td>
    <td><input name=\"sebep\" type=\"radio\" value=\"Diger\">
diger</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type=hidden name=sira value=$sr>
        <input type=hidden name=id value=$id>
        <INPUT type=hidden value=gonder name=gonder>
        <INPUT class=buton id=kaydet type=submit value=ISPITLE name=kaydet></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<input type=hidden name=ok value=ok>
      </FORM>
";
}
?>