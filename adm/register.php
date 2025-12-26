<?
if ($oluler != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
$ip = getenv('REMOTE_ADDR');
if ($userNickName and $email) { // basla

// degiskenleri ata
$userNickName =@$HTTP_POST_VARS["nick"];
if ($userNickName == "" or $email == "" or $day == "" or $month == "" or $year == "" or $cinsiyet == "" or $sehir == "") {
echo "
Heryeri doldur canım..";
exit;
}

if (!ereg ("^[' A-Za-z0-9]+$", $userNickName)) {
echo "Nickinizde;<br>sadece kucuk ve ingilizce harfler,<br>bosluk {space},<br>ve rakamlar bulunabilir.<br>Lütfen bu kurallara uygun bir nick yazin.";
die;
}

if (!eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $email)) {
die ("E-Mail Adresiniz Geçersiz");
}

$sorgu = "SELECT email FROM user WHERE `email` = '$email'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)){
$email=$kayit["email"];
echo "Belirttiğiniz e-mail adresi zaten sistemde kayıtlı.";
die;
}

$sorgu1 = "SELECT * FROM ayar";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$registerStyle=$kayit2["reg"];
if ($registerStyle == "off") {
$sifre =@$HTTP_POST_VARS["sifre"];
$sifre2 =@$HTTP_POST_VARS["sifre2"];
if (!$sifre or !$sifre2) {
echo "Sifre yaz hocam..";
exit;
}
if ($sifre != $sifre2) {
echo "Alti üstü sifreyi 2 yere birden yazican onuda beceremiyosun..Gencligine yazik hocam..";
exit;
}

}

$isim =@$HTTP_POST_VARS["isim"];
$userNickName =@$HTTP_POST_VARS["nick"];
$email =@$HTTP_POST_VARS["email"];
$day =@$HTTP_POST_VARS["day"];
$month =@$HTTP_POST_VARS["month"];
$year =@$HTTP_POST_VARS["year"];
$cinsiyet =@$HTTP_POST_VARS["cinsiyet"];
$sehir =@$HTTP_POST_VARS["sehir"];

$userNickName = preg_replace("/ş/","s",$userNickName);
$userNickName = preg_replace("/Ş/","S",$userNickName);
$userNickName = preg_replace("/ç/","c",$userNickName);
$userNickName = preg_replace("/Ç/","C",$userNickName);
$userNickName = preg_replace("/ı/","i",$userNickName);
$userNickName = preg_replace("/İ/","I",$userNickName);
$userNickName = preg_replace("/ğ/","g",$userNickName);
$userNickName = preg_replace("/Ğ/","G",$userNickName);
$userNickName = preg_replace("/ö/","o",$userNickName);
$userNickName = preg_replace("/Ö/","O",$userNickName);
$userNickName = preg_replace("/ü/","u",$userNickName);
$userNickName = preg_replace("/Ü/","U",$userNickName);
$userNickName = preg_replace("/Ö/","O",$userNickName);

$email = preg_replace("/ş/","s",$email);
$email = preg_replace("/Ş/","S",$email);
$email = preg_replace("/ç/","c",$email);
$email = preg_replace("/Ç/","C",$email);
$email = preg_replace("/ı/","i",$email);
$email = preg_replace("/İ/","I",$email);
$email = preg_replace("/ğ/","g",$email);
$email = preg_replace("/Ğ/","G",$email);
$email = preg_replace("/ö/","o",$email);
$email = preg_replace("/Ö/","O",$email);
$email = preg_replace("/ü/","u",$email);
$email = preg_replace("/Ü/","U",$email);
$email = preg_replace("/Ö/","O",$email);


$sehir = preg_replace("/ş/","s",$sehir);
$sehir = preg_replace("/Ş/","S",$sehir);
$sehir = preg_replace("/ç/","c",$sehir);
$sehir = preg_replace("/Ç/","C",$sehir);
$sehir = preg_replace("/ı/","i",$sehir);
$sehir = preg_replace("/İ/","I",$sehir);
$sehir = preg_replace("/ğ/","g",$sehir);
$sehir = preg_replace("/Ğ/","G",$sehir);
$sehir = preg_replace("/ö/","o",$sehir);
$sehir = preg_replace("/Ö/","O",$sehir);
$sehir = preg_replace("/ü/","u",$sehir);
$sehir = preg_replace("/Ü/","U",$sehir);
$sehir = preg_replace("/Ö/","O",$sehir);


$isim = preg_replace("/ş/","s",$isim);
$isim = preg_replace("/Ş/","S",$isim);
$isim = preg_replace("/ç/","c",$isim);
$isim = preg_replace("/Ç/","C",$isim);
$isim = preg_replace("/ı/","i",$isim);
$isim = preg_replace("/İ/","I",$isim);
$isim = preg_replace("/ğ/","g",$isim);
$isim = preg_replace("/Ğ/","G",$isim);
$isim = preg_replace("/ö/","o",$isim);
$isim = preg_replace("/Ö/","O",$isim);
$isim = preg_replace("/ü/","u",$isim);
$isim = preg_replace("/Ü/","U",$isim);
$isim = preg_replace("/Ö/","O",$isim);

$userNickName = strtolower($userNickName);
$email = strtolower($email);

$sorgu = "SELECT nick,id FROM user WHERE `nick`='$userNickName'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
if ($id) {
echo "Böyle bi yazar zaten var, özenti olmayalim ve farkli bir nick secelim lütfen :)";
exit;
}
}
}

$tarih = date("Y/m/d G:i");
$dt = "$day/$month/$year";
$verifyStatus = "on";
if ($registerStyle == "on") {
$ifade = md5(rand(0,99999));
$sifre = substr($ifade, 17, 6);
$betasifre = sha1($sifre);
}
else {
$betasifre = sha1($sifre);
}
$yetki = "user";

$sorgu = "INSERT INTO user ";
$sorgu .= "(isim,nick,sifre,email,dt,cinsiyet,sehir,durum,yetki,regip,regtarih)";
$sorgu .= " VALUES ";
$sorgu .= "('$isim','$userNickName','$betasifre','$email','$dt','$cinsiyet','$sehir','$verifyStatus','$yetki','$ip','$tarih')";
mysql_query($sorgu);
$kime = $email;
$konu = "Yazar şifreniz";
$icerik = "Merhaba $isim\n
\n
Kullanıcı adınız: $userNickName\n
Şifreniz: $sifre\n
\n
(bolsozluk.com)
";

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");

$konu = "<img src=img/unlem.gif> Hoşgeldiniz!";
$admtem = "admTEM";
$yazi = "
<b>Yazarlığınız $kullaniciAdi tarafından direk olarak aktif edildi.</b>
";


$yazi = preg_replace("/\n/","<br>",$yazi);

$konu = mysql_real_escape_string($konu);
$mesaj = mysql_real_escape_string($mesaj);

$sorgu = "INSERT INTO privmsg ";
$sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
$sorgu .= " VALUES ";
$sorgu .= "('$userNickName','$konu','$yazi','$admtem','$tarih','1','$gun','$ay','$yil','$saat')";
mysql_query($sorgu);
$mailkonu = "bolsozluk.com'e Hoşgeldiniz!";
mail("$kime", "$mailkonu", "$icerik", "From: bolsozluk.com <info@bolsozluk.com>");
echo "
<div class=div1>
Yazar eklendi.
</div>
";
die;
} // bitir

?>
<script src="inc/sozluk.js" type=text/javascript></SCRIPT>
<script href="inc/default.css" type=text/css rel=stylesheet>

<style type="text/css">
<!--
.style2 {color: #666666}
-->
</style>
<span class="link"><B>Yazarliga giden yolda son adimlarimizi atalim </B>:<BR>
<BR>
</span>
<FORM method=post action=>
  <p>
    <INPUT type=hidden value=ok name=okmu>
    <INPUT
type=hidden value=y name=submit>
</p>
  <table width="580" border="0">
    <tr>
      <td width="91"><strong>Yazar Adi</strong></td>
      <td width="3">:</td>
      <td width="464"><input maxlength=30 type=text size=30 name=nick>
          </td>
    </tr>
    <tr>
      <td colspan="3" class="style2">S&ouml;zl&uuml;kte kullanmak istediginiz nick. (t&uuml;rk&ccedil;e karakterler i&ccedil;eremez, &ouml;zel karakterler olan @'^,.~ gibi karakterler i&ccedil;eremez.)</td>
    </tr>
      <?
$sorgu1 = "SELECT * FROM ayar";
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$registerStyle=$kayit2["reg"];
if ($registerStyle == "off") {
echo "
    <tr>
      <td width=\"91\"><strong>sifre</strong></td>
      <td width=\"3\">:</td>
      <td width=\"464\"><INPUT type=password maxLength=50 size=40 name=sifre>
          </td>
    </tr>
    <tr>
      <td width=\"91\"><strong>sifre (onay)</strong></td>
      <td width=\"3\">:</td>
      <td width=\"464\"><INPUT type=password maxLength=50 size=40 name=sifre2>
          </td>
    </tr>
    <tr>
      <td colspan=\"3\"><span class=\"style2\">Türk kisilerin genelde \"dogum tarihi, kendi isimleri, kendi isimler + il plaka kodu\" gibi kombinasyonlar kullandigi sanal unsur.Onay icin iki defa yazmalisiniz.</span></td>
    </tr>


";
}
?>
    <tr>
      <td><strong>Mail</strong></td>
      <td>:</td>
      <td><input maxlength=50 size=40 name=email></td>
    </tr>
    <tr>
      <td colspan="3" class="style2">E-mail adresiniz. ($ifreniz bu E-mail'e g&ouml;nderilece&#287;i i&ccedil;in gene k&#305;&ccedil;&#305;n&#305;zdan uydurmaman&#305;z &ouml;nerilir.$ifre bazen dandik e-mail'lere [mynet,mail2web,yahoo hatta bazen hotmail ve gmail gibi] gelmeyebilir.Bu y&uuml;zden adam gibi bir mail hesab&#305;n&#305;z varsa onu kullanman&#305;z toplumun ve sizin a&ccedil;&#305;n&#305;zdan daha sa&#287;l&#305;kl&#305; olacakt&#305;r.)</td>
    </tr>
    <tr>
      <td><strong>isim soyisim</strong></td>
      <td>:</td>
      <td><INPUT name=isim id="isim" size=30 maxLength=50></td>
    </tr>
    <tr>
      <td colspan="3" class="style2">Adiniz ve Soyadiniz </td>
    </tr>
    <tr>
      <td><strong>Dogum Tarihi</strong></td>
      <td>:</td>
      <td><SELECT name=day class="ksel">
        <OPTION
selected>
        <OPTION>1
          <OPTION>2
          <OPTION>3
          <OPTION>4
          <OPTION>5
          <OPTION>6
          <OPTION>7
          <OPTION>8
          <OPTION>9
          <OPTION>10
          <OPTION>11
          <OPTION>12
          <OPTION>13
          <OPTION>14
          <OPTION>15
          <OPTION>16
          <OPTION>17
          <OPTION>18
          <OPTION>19
          <OPTION>20
          <OPTION>21
          <OPTION>22
          <OPTION>23
          <OPTION>24
          <OPTION>25
          <OPTION>26
          <OPTION>27
          <OPTION>28
          <OPTION>29
          <OPTION>30
          <OPTION>31</OPTION>
      </SELECT>
        <SELECT name=month class="ksel">
          <OPTION selected>
          <OPTION value=1>ocak
          <OPTION
value=2>subat
          <OPTION value=3>mart
          <OPTION value=4>nisan
          <OPTION
value=5>mayis
          <OPTION value=6>haziran
          <OPTION value=7>temmuz
          <OPTION
value=8>agustos
          <OPTION value=9>eylul
          <OPTION value=10>ekim
          <OPTION
value=11>kasim
          <OPTION value=12>aralik</OPTION>
        </SELECT>
        <SELECT name=year class="ksel">
          <OPTION
selected>
          <OPTION>1987
          <OPTION>1986
          <OPTION>1985
          <OPTION>1984
          <OPTION>1983
          <OPTION>1982
          <OPTION>1981
          <OPTION>1980
          <OPTION>1979
          <OPTION>1978
          <OPTION>1977
          <OPTION>1976
          <OPTION>1975
          <OPTION>1974
          <OPTION>1973
          <OPTION>1972
          <OPTION>1971
          <OPTION>1970
          <OPTION>1969
          <OPTION>1968
          <OPTION>1967
          <OPTION>1966
          <OPTION>1965
          <OPTION>1964
          <OPTION>1963
          <OPTION>1962
          <OPTION>1961
          <OPTION>1960
          <OPTION>1959
          <OPTION>1958
          <OPTION>1957
          <OPTION>1956
          <OPTION>1955
          <OPTION>1954
          <OPTION>1953
          <OPTION>1952
          <OPTION>1951
          <OPTION>1950
          <OPTION>1949
          <OPTION>1948
          <OPTION>1947
          <OPTION>1946
          <OPTION>1945
          <OPTION>1944
          <OPTION>1943
          <OPTION>1942
          <OPTION>1941
          <OPTION>1940
          <OPTION>1939
          <OPTION>1938
          <OPTION>1937
          <OPTION>1936
          <OPTION>1935
          <OPTION>1934
          <OPTION>1933
          <OPTION>1932
          <OPTION>1931
          <OPTION>1930</OPTION>
        </SELECT></td>
    </tr>
    <tr>
      <td colspan="3" class="style2">Dogum Tarihiniz</td>
    </tr>
    <tr>
      <td><strong>cinsiyet</strong></td>
      <td>:</td>
      <td><SELECT name=cinsiyet class="ksel" id="cinsiyet">
        <OPTION value=\"m\">Erkek
          <option value="f">Bayan </option>
      </SELECT></td>
    </tr>
    <tr>
    </tr>
    <tr>
      <td><strong>Sehir</strong></td>
      <td>:</td>
      <td><INPUT name=sehir id="sehir" size=20 maxLength=50></td>
    </tr>
    <tr>
      <td colspan="3"><span class="style2">(Yasadiginiz Kent)</span>
      </td>
    </tr>
  </table>
  <p>Ben :
    <input type=submit class=but value="Yazar Olmaliyim!">
</FORM>
    <br>
          <form action=sozluk.php?process=rand method="post">
    Geri d&ouml;nmek i&ccedil;in:
    <input type=submit class=but value="Çok Geç Degil">
        </form>
</p>
  <p></P>
</body>
</html>