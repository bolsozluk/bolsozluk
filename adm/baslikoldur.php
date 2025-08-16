<LINK href="inc/<?echo "$aktiftema";?>.css" type=text/css rel=stylesheet>
<?
//extract($_REQUEST); //bunu silebilirim
$bid = guvenlikKontrol($_REQUEST["bid"],"ultra");
$sira = guvenlikKontrol($_REQUEST["sira"],"ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"],"hard");
$sr = guvenlikKontrol($_REQUEST["sr"],"ultra");

echo "bid:$bid";

if ($baslik != 1) {
	echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
	die;
}

if ($bid and $sebep) {

$sorgu1 = "SELECT baslik FROM konular WHERE `id` = '$bid'";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");


$sorgu = "UPDATE konular SET tarih='$tarih' WHERE id='$gid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET gun='$gun' WHERE id='$gid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET ay='$ay' WHERE id='$gid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET yil='$yil' WHERE id='$gid'";
mysql_query($sorgu);

$sorgu = "UPDATE konular SET statu = 'silindi' WHERE id='$bid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET silmod = '$kullaniciAdi' WHERE id='$bid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET siltarih = '$gun/$ay/$yil $saat' WHERE id='$bid'";
mysql_query($sorgu);
$sorgu = "UPDATE konular SET silsebep = '$sebep' WHERE id='$bid'";
mysql_query($sorgu);



echo "($baslik) baslik silindi.<br>Basliga bagli olan mesajlar silindi.";

$sorgu = "UPDATE mesajlar SET statu = 'silindi' WHERE sira = '$bid'";
mysql_query($sorgu);

}
else if ($bid) {
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
            <input type=hidden name=bid value=$bid>
        </TR>
          <TD>&nbsp;</TD>
          <TD><INPUT type=hidden value=gonder name=gonder> <INPUT class=buton id=kaydet type=submit value=Sil name=kaydet>
          </TD></TR></TBODY></TABLE>
      </FORM>
";
}
?>