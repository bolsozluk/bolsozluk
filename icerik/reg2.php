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
?>
<style type="text/css">
<!--
.style2 {color: #CCCCCC}
-->
</style>
<body>
<span class="link"><B>Yazarlik basvurunuzun tamamlanmasi için asagidakileri doldurunuz. </B>:<BR>
<BR>
</span>
<FORM action="sozluk.php?process=regok" method="post">
  <p>
    <INPUT type=hidden value=ok name=okmu>
    <INPUT
type=hidden value=y name=submit>
</p>
  <table width="580" border="0">
    <tr>
      <td width="91"><strong>kullanıcı adı</strong></td>
      <td width="3">:</td>
      <td width="464"><input maxlength=30 type=text size=30 name=nick>
          </td>
    </tr>
    <tr>
      <td colspan="3">S&ouml;zl&uuml;kte kullanmak istediginiz nick. (t&uuml;rk&ccedil;e karakterler i&ccedil;eremez, &ouml;zel karakterler olan @'^,.~ gibi karakterler i&ccedil;eremez.)</td>
    </tr>

                <tr>
                  <br>
        <td>şehriniz?</td><td>:</td>
                <td><select name="vilayet" id="vilayet">
    <option value="0">Gurbet</option>
    <option value="1">Adana</option>
    <option value="2">Adıyaman</option>
    <option value="3">Afyonkarahisar</option>
    <option value="4">Ağrı</option>
    <option value="5">Amasya</option>
    <option value="6">Ankara</option>
    <option value="7">Antalya</option>
    <option value="8">Artvin</option>
    <option value="9">Aydın</option>
    <option value="10">Balıkesir</option>
    <option value="11">Bilecik</option>
    <option value="12">Bingöl</option>
    <option value="13">Bitlis</option>
    <option value="14">Bolu</option>
    <option value="15">Burdur</option>
    <option value="16">Bursa</option>
    <option value="17">Çanakkale</option>
    <option value="18">Çankırı</option>
    <option value="19">Çorum</option>
    <option value="20">Denizli</option>
    <option value="21">Diyarbakır</option>
    <option value="22">Edirne</option>
    <option value="23">Elazığ</option>
    <option value="24">Erzincan</option>
    <option value="25">Erzurum</option>
    <option value="26">Eskişehir</option>
    <option value="27">Gaziantep</option>
    <option value="28">Giresun</option>
    <option value="29">Gümüşhane</option>
    <option value="30">Hakkâri</option>
    <option value="31">Hatay</option>
    <option value="32">Isparta</option>
    <option value="33">Mersin</option>
    <option value="34">İstanbul</option>
    <option value="35">İzmir</option>
    <option value="36">Kars</option>
    <option value="37">Kastamonu</option>
    <option value="38">Kayseri</option>
    <option value="39">Kırklareli</option>
    <option value="40">Kırşehir</option>
    <option value="41">Kocaeli</option>
    <option value="42">Konya</option>
    <option value="43">Kütahya</option>
    <option value="44">Malatya</option>
    <option value="45">Manisa</option>
    <option value="46">Kahramanmaraş</option>
    <option value="47">Mardin</option>
    <option value="48">Muğla</option>
    <option value="49">Muş</option>
    <option value="50">Nevşehir</option>
    <option value="51">Niğde</option>
    <option value="52">Ordu</option>
    <option value="53">Rize</option>
    <option value="54">Sakarya</option>
    <option value="55">Samsun</option>
    <option value="56">Siirt</option>
    <option value="57">Sinop</option>
    <option value="58">Sivas</option>
    <option value="59">Tekirdağ</option>
    <option value="60">Tokat</option>
    <option value="61">Trabzon</option>
    <option value="62">Tunceli</option>
    <option value="63">Şanlıurfa</option>
    <option value="64">Uşak</option>
    <option value="65">Van</option>
    <option value="66">Yozgat</option>
    <option value="67">Zonguldak</option>
    <option value="68">Aksaray</option>
    <option value="69">Bayburt</option>
    <option value="70">Karaman</option>
    <option value="71">Kırıkkale</option>
    <option value="72">Batman</option>
    <option value="73">Şırnak</option>
    <option value="74">Bartın</option>
    <option value="75">Ardahan</option>
    <option value="76">Iğdır</option>
    <option value="77">Yalova</option>
    <option value="78">Karabük</option>
    <option value="79">Kilis</option>
    <option value="80">Osmaniye</option>
    <option value="81">Düzce</option>
<br>





          </select>
                </td>
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
      <td><strong>mail adresi</strong></td>
      <td>:</td>
      <td><input maxlength=50 size=40 name=email></td>
    </tr>
    <tr>
      <td colspan="3">E-mail adresiniz.<br></td>
    </tr>
    <tr>
     <td width=\"91\"><strong>doğrulama kodu:</strong></td>
    <td><img src="captcha.php"></td><td><input type="text" name="dogKodu" /></td>
     <tr>
     <!-- <td width=\"91\"><strong>  yeraltı operasyonu albümünün çıkış yılı?:</strong></td> -->
<!--       <? $_SESSION["dogKodu2"] = '1999'; ?>-->
 <!--    <td><td><input type="text" name="dogKodu2" /></td>-->

  </table>
  <p>Evet eminim :
    <input type=submit class=but value="Yazar Olayim Artik">
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
<? } ?>