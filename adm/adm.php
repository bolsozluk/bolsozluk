<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>
<LINK href="inc/<? echo $aktifTema; ?>.css" type=text/css rel=stylesheet>
<title>Admin</title>
</head>
<style>
.but {
  font-size: 12px
    display:inline-block;
    width: 100px;
    height: 40px;
}

</style>

<style>
table, th, td {
  border: 1px solid black;
}
</style>
<body>


<?
extract($_REQUEST); //bunu silebilirim
$islem = guvenlikKontrol($_REQUEST["islem"],"hard");
$ip = guvenlikKontrol($_REQUEST["ip"],"ip");
$ok = guvenlikKontrol($_REQUEST["ok"],"ip");
$userNickName = guvenlikKontrol($_REQUEST["nick"],"hard");
$update = guvenlikKontrol($_REQUEST["update"],"hard");
$gnick = guvenlikKontrol($_REQUEST["gnick"],"hard");
$id = guvenlikKontrol($_REQUEST["id"],"hard");
$girisNick = guvenlikKontrol($_REQUEST["gnick"],"hard");
$okupdate = guvenlikKontrol($_REQUEST["okupdate"],"hard");
$durum = guvenlikKontrol($_REQUEST["durum"],"hard");
$verifyStatus = guvenlikKontrol($_REQUEST["durum"],"hard");
$yetki = guvenlikKontrol($_REQUEST["yetki"],"hard");
$sifre = guvenlikKontrol($_REQUEST["sifre"],"hard");
$email = guvenlikKontrol($_REQUEST["email"],"hard");

  $isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

include "mobframe.php";

//$kullaniciAdi = guvenlikKontrol($_REQUEST["kullaniciAdi"],"hard");

/*if ($kulYetki != "admin" and $kulYetki != "mod" and $kulYetki != "gammaz") {
  echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=sozluk.php?process=refresh\">";
  die;
}
*/
echo "<b>$kullaniciAdi - yönetici paneli</b>";

if (($kulYetki != "admin") and ($kulYetki != "mod")) {
  echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=sozluk.php?process=refresh\">";
  die;
}


$entry = 1;
$ispit = 1;
$baslik = 1;
$kullanici = 1;
$sozluk = 1;
$haber = 1;
$duyuru = 1;
$gecmis = 1;
$oluler = 1;
$stat = 1;
$yazaronayla = 1;
$basliktasi = 1;
$registerStyleister = 1;
$akillananlar = 1;
$ipban = 1;
//<button onclick="window.location.href='sozluk.php?process=adm&islem=sozluk'">sözlük işlemleri</button>
//
?>
<table>
  <tr>
<?
if ($kulYetki == "admin")
{
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=akillananlar'\" class=but>akıllanan entryler </button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=haber'\"class=but>haber işlemleri</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=statgen'\"class=but>istatistik güncelle</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=kullanici'\"class=but>kullanıcı işlemleri</button></td>";
//echo "<button onclick=\"top.left.location.href='sozluk.php?process=frame'\">moderasyon frame</button>";
}

if ($kulYetki == "mod")
{
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=akillananlar'\" class=but>akıllanan entryler </button></td>";
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=haber'\"class=but>haber işlemleri</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=statgen'\"class=but>istatistik güncelle</button></td>";
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=kullanici'\"class=but>kullanıcı işlemleri</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=frame'\"class=but>moderasyon frame</button></td>";
}


?>

<br>
</tr><tr>

<?
if ($kulYetki == "admin")
{
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=duyuru'\"class=but>duyuru işlemleri</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=okurlar'\"class=but>yazar onayla</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=nickdegis'\"class=but>nick değiştir</button></td>";
}
?>

<br>
</tr><tr>

<?
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=oluler'\"class=but>ölü entryler</button></td>";
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=baslik'\"class=but>başlık işlemleri</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=olubasliklar'\"class=but>ölü başlıklar</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=ipbanlist'\"class=but>ip banla</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=ispliste'\"class=but>ispiyonlananlar</button></td>";
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=sifircilar'\"class=but>sıfırcılar</button></td>";
?>


</tr>


<tr>

<?
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=eksiciler'\"class=but>eksiciler</button></td>";
echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=akillananlar'\" class=but>akıllanan entryler </button></td>";
//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=feyk'\"class=but>feyk kontrol</button></td>";
echo "<td><button onclick=\"top.left.location.href='sozluk.php?process=frame'\" class=but>mod frame</button></td>";

?>


</tr>
<tr>

<?


//echo "<td><button onclick=\"window.location.href='sozluk.php?process=adm&islem=eksiciler'\"class=but>eksiciler</button></td>";
//if ($kulYetki == "admin" or $kullaniciAdi=="deepsky")
//{echo "<button onclick=\"window.location.href='sozluk.php?process=adm&islem=iptal'\">feyk dedektif</button>";}
?>

</tr>
</table>
<br>
<?
echo "
  </tr>
  <tr>
    <td colspan=\"6\"><hr></td>
  </tr>
  <tr>
    <td colspan=\"6\">
    ";

if ($yuklenecekSayfaSub) {
if (file_exists("adm/$yuklenecekSayfaSub.php"))
include "adm/$yuklenecekSayfaSub.php";
else
echo "
Bu bölüm geçici olarak servis dışı.";
}

echo "
    </td>
  </tr>
</table>
";

?>
</body>
</html>