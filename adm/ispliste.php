<style type="text/css">
<!--
.style2 {font-size: 10px}
-->

input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
</style>

<?

  $tarih = date("YmdHi");
  $gun = date("d");
  $ay = date("m");
  $yil = date("Y");
  $saat = date("H:i");
    $ip = getenv('REMOTE_ADDR');

echo "<br>";
echo "<input type='button' onclick=\"location.href='sozluk.php?process=adm&islem=ispliste';\" value='ispiyon listesi' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=adm&islem=prlist';\" value='praetör günlükleri' class='but'>";
echo "<br>";
echo "<br>";


$eno = isset($_POST['eno']) ? $_POST['eno'] : array();

//if (!empty($_POST["sil3"])) {
if(isset($_POST['sil3'])){
foreach($eno as $kayi)
{



//seçilenleri sil
  echo "<strong>bol sözlüğün kirli çamaşırları:</strong><br><br>";
  $sorgu = "UPDATE esikayet SET durum = '0' WHERE konu='$kayi'";
  mysql_query($sorgu);

 $sorgu = "UPDATE esikayet SET kapatan = '$kullaniciAdi' WHERE konu='$kayi'";
 mysql_query($sorgu);

$sorgum = "UPDATE mesajlar SET esikayet = '0' WHERE id='$kayi'";
mysql_query($sorgum);


$ksx = mysql_fetch_array(mysql_query("SELECT gonderen FROM esikayet WHERE konu='$kayi' LIMIT 1"));
$kisi = $ksx['gonderen'];
  
 echo "<br>$kayi işleniyor... <br>";

 echo "şikayet bildirimleri siliniyor... <br>";

$sorgu = "DELETE FROM privmsg WHERE kime = 'deepsky' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'ret1arius' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'if rap gets jealous' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'komutana sniper neresinden' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'booyaka' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'semttenbirses' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'abra yutpa' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);

$sorgu = "DELETE FROM privmsg WHERE kime = 'dragunov' and konu = 'otomatik şikayet entry no:$kayi'";
mysql_query($sorgu);


 echo "$kisi'ye mesaj gönderiliyor... <br>";

  $sorgu2 = "INSERT INTO privmsg ";
  $sorgu2 .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
  $sorgu2 .= " VALUES ";
  $sorgu2 .= "('$kisi','otomatik şikayet entry no:$kayi','ilgili şikayetiniz moderasyon tarafından kapatılmıştır.','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
  mysql_query($sorgu2);




die;
}
}


echo "<strong>bol sözlüğün kirli çamaşırları:</strong><br><br>";

$sorgu = "SELECT id,konu,mesaj,gonderen,mail,tarih,ip FROM esikayet WHERE durum = '1' ORDER by `id` desc LIMIT 0,1000";
$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){

echo "
<table width=\"700\" height=\"77\" border=\"1\">
  <tr>
    <td width=\"174\"><strong>ispiyon no</strong></td>
    <td width=\"534\"><strong>gonderen</strong></td>
    <td width=\"534\"><strong>mesaj</strong></td>
    <td width=\"534\"><strong>ip</strong></td>
    <td width=\"534\"><strong>tarih</strong></td>
    <td width=\"534\"><strong>link</strong></td>
  </tr>
";

//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$ip=$kayit["ip"];
$mesaj=$kayit["mesaj"];
$tarih=$kayit["tarih"];
$konu=$kayit["konu"];
$gonderen=$kayit["gonderen"];
$mail=$kayit["mail"];

/*$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];

$kesbaslik = substr ($baslik, 0, 60);
$titlebaslik = $baslik;
$baslik = ereg_replace(" ","+",$baslik);
$mesaj = ereg_replace("<br>","",$mesaj);

$mesaj = substr ($mesaj, 0, 250);
$mesaj = "$mesaj...";*/

echo"
<input type=hidden name=ok value=ok>
 <form action='' method='POST'>
 ";

echo "
  <tr>
    <td><font size=1><i>$id</i></td>
    <td><font size=1><i>$gonderen</i></td>
    <td><font size=1><i>$mesaj</i></td>
    <td><font size=1><i>$ip</i></td>
    <td><font size=1><i>$tarih</i></td>
    <td><font size=1><i><a href=?process=eid&eid=$konu target=new>$konu</a></i></td>
    <td width=\"27\"><center>&nbsp;<input name=\"eno[]\" class=inp type=\"checkbox\" id=\"$eno\" value=\"$konu\"></td>
    </tr>
";
}

echo " <input class=\"but\" type=\"submit\" name=\"sil3\" value=\"Seçilenleri Sil\" onclick=\"top.main.location.href='sozluk.php?process=adm&islem=ispliste'\">
 </form>
</table>";

echo "UYARI: şimdilik tek tek seçip silelim, çoklu ispiyon silme henüz yeterince test edilmedi.";
}
//<input class='but' type='submit' name='sil4' value='Tümünü Sil' onclick=\"top.main.location.href='sozluk.php?process=adm&islem=ispliste'\">
else {
echo "aktif şikayet kaydı bulunan herhangi bir entry mevcut değildir.";
}
?>
