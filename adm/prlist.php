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
extract($_REQUEST); //bunu silebilirim

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


echo "<strong>praetör günlükleri:</strong><br><br>";

$sorgu = "SELECT id,sira,mesaj,yazar,silen,silsebep,praetornotu FROM mesajlar WHERE praetornotu !='' ORDER by `id` asc LIMIT 1,1000";
$sorgulama = @mysql_query($sorgu);
if (@mysql_num_rows($sorgulama)>0){


echo "
<table width=\"700\" height=\"77\" border=\"1\">
  <tr>
    <td width=\"174\"><strong>entry no</strong></td>
    <td width=\"534\"><strong>yazar</strong></td>
    <td width=\"534\"><strong>entry</strong></td>
    <td width=\"534\"><strong>silen</strong></td>
    <td width=\"534\"><strong>silsebep</strong></td>
    <td width=\"534\"><strong>praetornotu</strong></td>
  </tr>
";

//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$id=$kayit["id"];
$yazar=$kayit["yazar"];
$mesaj=$kayit["mesaj"];
$silen=$kayit["silen"];
$silsebep=$kayit["silsebep"];
$praetornotu=$kayit["praetornotu"];

if ($silen == "booyaka") ($silen = "admin");


echo "
  <tr>
    <td><font size=1><i>$id</i></td>
    <td><font size=1><i>$yazar</i></td>
    <td><font size=1><i>$mesaj</i></td>
    <td><font size=1><i>$silen</i></td>
    <td><font size=1><i>$silsebep</i></td>
    <td><font size=1><i>$praetornotu</i></td>
    </tr>
";
}

}
//<input class='but' type='submit' name='sil4' value='Tümünü Sil' onclick=\"top.main.location.href='sozluk.php?process=adm&islem=ispliste'\">
else {
echo "henüz praetörler burayı doldurmamış.";
}

?>