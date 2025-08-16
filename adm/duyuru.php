<?
extract($_REQUEST); //bunu silebilirim
if ($duyuru != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
$aciklama =@$_POST["aciklama"];
$kime =@$_POST["kime"];
$ok =@$_POST["ok"];
$gmesaj =@$_POST["gmesaj"];
$gkime =@$_POST["gkime"];
$ip =@$_POST["ip"];

/* echo "mesaj: ";
echo $aciklama;
echo "kime: ";
echo $kime;
echo "ok: ";
echo $ok; */

if ($ok and $aciklama and $kime) {
$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");
$ip = getenv('REMOTE_ADDR');

$aciklama = ereg_replace("<","(",$aciklama);
$aciklama = ereg_replace(">",")",$aciklama);
$aciklama = ereg_replace("\n","<br>",$aciklama);

$konu = "DUYURU!";
$aciklama = strtolower($aciklama);


if ($kime == "all")
$sorgu = "SELECT email,nick,durum FROM user WHERE durum != 'sus'";
if ($kime == "mods")
$sorgu = "SELECT email,nick,yetki FROM user WHERE yetki = 'mod' or yetki = 'admin'";
if ($kime == "yazars")
$sorgu = "SELECT email,nick,durum FROM user WHERE durum = 'on'";
if ($kime == "okurs")
$sorgu = "SELECT email,nick,durum FROM user WHERE durum = 'off'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$userNickName=$kayit["nick"];
$gkime=$kayit["nick"];
$email=$kayit["email"];
//mail("$email", "$konu", "$aciklama", "From: bolsozluk.com <info@bolsozluk.com>");

//
$gmesaj = mysql_real_escape_string($aciklama);
  $gkonu = mysql_real_escape_string($konu);
  $gmesaj = ereg_replace("&#039;","\'",$gmesaj);
  $sorgu = "INSERT INTO privmsg ";
  $sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat,ip)";
  $sorgu .= " VALUES ";
  $sorgu .= "('$gkime','$gkonu','$gmesaj','$kullaniciAdi','$tarih','2','$gun','$ay','$yil','$saat','$ip')";
  mysql_query($sorgu);
  
  mysql_query("UPDATE user SET msg=1 WHERE nick='".$gkime."'");
//
$saydir++;
}
}
echo "<center>$saydir Ki\$iye Gönderildi. .";
}
else {

?>
<form name="form1" method="post" action="">
  <p>
    <select name="kime" id="kime">
      <option value="all">Herkes</option>
      <option value="mods">Modlar</option>
      <option value="yazars">Yazarlar</option>
      <option value="okurs">Okurlar</option>
    </select>
    <br>
    <textarea name="aciklama" cols="100" rows="6" wrap="VIRTUAL" id="aciklama"></textarea>
    <br>
    <input type=hidden name=ok value=ok>
    <input type="submit" name="Submit" value="Duyduk Duymadik Demesinler">
</p>
</form>
<?
}
?>