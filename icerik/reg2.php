<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>

<?
$okmu = guvenlikKontrol($_REQUEST["okmu"],"hard");
$ip = getenv('REMOTE_ADDR');

if ($okmu != "ok") {
echo "Devam etmek için onay kutucuğunu işaretlemen gerekiyor. ;)";
exit;
}
if (!$okmu) {
echo "Adam gibi form doldur adamin canını sıkma!($ip logged)";
}
else {
  // YAŞ KONTROLÜ
  if (isset($_POST["dogum_yili"])) {
      $dogum_yili = intval($_POST["dogum_yili"]);
      $guncel_yil = date("Y");
      if (($guncel_yil - $dogum_yili) < 15) {
          echo "Üzgünüz, 15 yaşından küçükler yazar olamazlar. ($ip logged)";
          exit;
      }
  }
?>
<style type="text/css">
</style>
<body>
<span class="link"><B>Yazarlik basvurunuzun tamamlanmasi için asagidakileri doldurunuz. </B>:<BR>
<BR>
</span>
<FORM action="sozluk.php?process=regok" method="post">
  <p>
    <INPUT type=hidden value=ok name=okmu>
    <INPUT type=hidden value=y name=submit>
</p>
  <table width="580" border="0">
    <tr>
      <td width="91"><strong>kullanıcı adı</strong></td>
      <td width="3">:</td>
      <td width="464"><input maxlength=30 type=text size=30 name=nick></td>
    </tr>
    <tr>
      <td colspan="3">S&ouml;zl&uuml;kte kullanmak istediginiz nick. (t&uuml;rk&ccedil;e karakterler i&ccedil;eremez.)</td>
    </tr>

    <tr>
      <br>
      <td>şehriniz?</td><td>:</td>
      <td>
        <select name="vilayet" id="vilayet">
          <option value="0">Gurbet</option>
          <?php
          $iller = array(
              "Adana", "Adıyaman", "Afyonkarahisar", "Ağrı", "Amasya", "Ankara", "Antalya", "Artvin", "Aydın", "Balıkesir", "Bilecik", "Bingöl", "Bitlis", "Bolu", "Burdur", "Bursa", "Çanakkale", "Çankırı", "Çorum", "Denizli", "Diyarbakır", "Edirne", "Elazığ", "Erzincan", "Erzurum", "Eskişehir", "Gaziantep", "Giresun", "Gümüşhane", "Hakkâri", "Hatay", "Isparta", "Mersin", "İstanbul", "İzmir", "Kars", "Kastamonu", "Kayseri", "Kırklareli", "Kırşehir", "Kocaeli", "Konya", "Kütahya", "Malatya", "Manisa", "Kahramanmaraş", "Mardin", "Muğla", "Muş", "Nevşehir", "Niğde", "Ordu", "Rize", "Sakarya", "Samsun", "Siirt", "Sinop", "Sivas", "Tekirdağ", "Tokat", "Trabzon", "Tunceli", "Şanlıurfa", "Uşak", "Van", "Yozgat", "Zonguldak", "Aksaray", "Bayburt", "Karaman", "Kırıkkale", "Batman", "Şırnak", "Bartın", "Ardahan", "Iğdır", "Yalova", "Karabük", "Kilis", "Osmaniye", "Düzce"
          );
          foreach ($iller as $anahtar => $il_adi) {
              $plaka = $anahtar + 1;
              echo "<option value='$plaka'>$il_adi</option>";
          }
          ?>
        </select>
      </td>
    </tr>

<?
$sorgu1 = "SELECT * FROM ayar";
$sorgu2 = mysql_query($sorgu1);
$kayit2=mysql_fetch_array($sorgu2);
$registerStyle=$kayit2["reg"];
if ($registerStyle == "off") {
echo "
    <tr>
      <td><strong>sifre</strong></td>
      <td>:</td>
      <td><INPUT type=password maxLength=50 size=40 name=sifre></td>
    </tr>
    <tr>
      <td><strong>sifre (onay)</strong></td>
      <td>:</td>
      <td><INPUT type=password maxLength=50 size=40 name=sifre2></td>
    </tr>
";
}
?>

    <tr>
      <td><strong>mail adresi</strong></td>
      <td>:</td>
      <td><input maxlength=50 size=40 name=email></td>
    </tr>
    <tr>
      <td><strong>doğum yılınız</strong></td>
      <td>:</td>
      <td>
        <select name="dogum_yili">
          <?php
          $guncel_yil = date("Y");
          for($i = $guncel_yil; $i >= 1930; $i--) {
            echo "<option value='$i'>$i</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="3">15 yaş sınırı mevcuttur.</td>
    </tr>
    <tr>
     <td><strong>doğrulama kodu:</strong></td>
     <td>:</td>
     <td><img src="captcha.php"> <input type="text" name="dogKodu" /></td>
    </tr>
  </table>
  <p>
    <input type=submit class=but value="Yazar Olayim Artik">
</FORM>
    <br>
    <form action=sozluk.php?process=rand method="post">
    <input type=submit class=but value="Çok Geç Degil">
    </form>
</p>
</body>
</html>
<? } ?>
