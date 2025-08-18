<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>

<?

$sorgu = "SELECT id,sira,mesaj,yazar,tarih,statu,istekhatti FROM mesajlar WHERE (statu != 'silindi' and statu!='wait' and sira = '120' and istekhatti = '1') ORDER by `id` desc LIMIT 0,5000";  
echo "<strong>çözülen talepler.</strong><br><br>";


$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){

echo "
<table width=\"700\" height=\"77\" border=\"1\">
  <tr>
    <td width=\"174\"><strong>talep eden</strong></td>
    <td width=\"534\"><strong>METIN</strong></td>
    <td width=\"534\"><strong>LINK</strong></td>
  </tr>
";

//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$sira=$kayit["sira"];
$mesaj=$kayit["mesaj"];
$yazar=$kayit["yazar"];
$tarih=$kayit["tarih"];

$sorgu1 = "SELECT baslik,id FROM konular WHERE `id` = '$sira'"; // AND `gds` != 's' 
$sorgu2 = mysql_query($sorgu1);
mysql_num_rows($sorgu2);
$kayit2=mysql_fetch_array($sorgu2);
$baslik=$kayit2["baslik"];

$kesbaslik = substr ($baslik, 0, 60);
$titlebaslik = $baslik;
$baslik = ereg_replace(" ","+",$baslik);
$mesaj = ereg_replace("<br>","",$mesaj);

$mesaj = substr ($mesaj, 0, 250);
$mesaj = "$mesaj...";


echo "
  <tr>
    <td><a href=\"sozluk.php?process=word&q=$yazar\" title=\"$yazar\">$yazar</a></td>
    <td><font size=1><i>$mesaj</i></td>
    <td><font size=1><i><a href=?process=eid&eid=$id target=new>#$id</a></i></td>
    </tr>
  <tr>
    <td colspan=\"4\"><hr></td>
  </tr>
";
}
echo "
</table>";
}
else {
echo "henüz bunu görmeye yetkin yok.";
}

?>
