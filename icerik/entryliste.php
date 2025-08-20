<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
<style>
.style2 {
    font-size: 10px;
}
table {
    table-layout: fixed;
}
table td {
    overflow: hidden;
}
</style>
<?
$kimdirbu = isset($_REQUEST["kimdirbu"]) ? guvenlikKontrol($_REQUEST["kimdirbu"], "hard") : "";
include "mobframe.php";
if ($kulYetki != "null")
{
$sorgu = "SELECT id,sira,mesaj,yazar,tarih,statu,ip FROM mesajlar WHERE (statu != 'silindi' and statu!='wait' and statu!='kenar' and yazar = '$kimdirbu') ORDER by `id` desc LIMIT 0,500";  
//echo "<strong>$kimdirbu kişisine ait bol bol (son 500) entry aşağıya fişlendi.</strong><br><br>";
}
//echo $kulYetki;
$gdsmobile = "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=soru';\" value='soru' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol paneli' class='butx'><input type='button' onclick=\"location.href='sozluk.php?process=entrylerim&kimdirbu=$kullaniciAdi';\" value='ben' class='butx'></center><br>";
if ($kulYetki == "admin" or $kulYetki == "mod")
{
$sorgu = "SELECT id,sira,mesaj,yazar,tarih,statu,ip FROM mesajlar WHERE yazar = '$kimdirbu' and statu != 'silindi' ORDER by `id` desc LIMIT 0,1500";
}
$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){
$listeSayi = mysql_num_rows($sorgulama);
echo "<strong>$kimdirbu kişisine ait bol bol ($listeSayi adet) entry aşağıya fişlendi.</strong><br><br>";
echo "
<table width=\"100%\" border=\"5%\">
  <tr>
    <td width=\"30%\"><strong>BASLIK</strong></td>
    <td width=\"35%\"><strong>METIN</strong></td>
    <td width=\"15%\"><strong>LINK</strong></td>";

    if ($kulYetki == "admin" or $kulYetki == "mod"){echo " <td width=\"20%\"><strong>IP</strong></td>";}
  echo"</tr>";
//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$sira=$kayit["sira"];
$mesaj=$kayit["mesaj"];
$yazar=$kayit["yazar"];
$tarih=$kayit["tarih"];
$ip=$kayit["ip"];

$blistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$id'"));
$bbase11 = $blistele11["sira"];
$bsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$bbase11'"));
$bsonbaslik1 = $bsonbaslik11["baslik"];
$gds = $bsonbaslik11["gds"];

if ($gds != 's'){
$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'"; // AND `gds` != 's' 
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];
$kesbaslik = substr ($baslik, 0, 60);
$titlebaslik = $baslik;
$baslik = str_replace(" ","+",$baslik);
$mesaj = str_replace("<br>","",$mesaj);
$mesaj = substr ($mesaj, 0, 250);
$mesaj = "$mesaj...";

echo "
  <tr>
    <td  width=\"30%\"> <a href=\"sozluk.php?process=word&q=$baslik\" title=\"$titlebaslik\">$kesbaslik</a></td>
    <td  width=\"35%\"><font size=1><i>$mesaj</i></td>
    <td  width=\"15%\"><font size=1><i><a href=?process=eid&eid=$id target=new>#$id</a></i></td>";
 if ($kulYetki == "admin" or $kulYetki == "mod") {echo "  <td  width=\"20%\"><font size=1><i><a href=http://whatismyipaddress.com/ip/$ip target=new>$ip</a></i></td>";}
  echo"</tr>
";
}}
echo "
</table>";
}
else {
echo "Bu asi styla hiç entry girmemiş daha, yahut görmeye yetkin yok.";
}
?>
