<div class="div1">
<fieldset>
<?
//<a href="sozluk.php?process=cp">kontrol panelim</a> | <a href="sozluk.php?process=entrylerim">yazdıklarım</a> | <a href="sozluk.php?process=arkadaslarim">arkada$larım</a> | <a href="sozluk.php?process=dusmanlarim">dü$manlarım</a> | <a href="sozluk.php?process=yorumlarim">yorumlarım</a> | <a href="sozluk.php?process=gorunum">görünüm</a>
$sorgutema=mysql_query("select * from temalar order by id desc");
$kactema=@mysql_num_rows($sorgutema);
echo "<div>Toplam $kactema adet tema bulunmaktadır</div>";
while ($oku=mysql_fetch_array($sorgutema)) {
$sorgukisi=mysql_query("select * from user where tema='$oku[tema]'");
$say=@mysql_num_rows($sorgukisi);
?>
<table width="100%" border="1">
 <tr>
  <td width="50%"><a href="sozluk.php?process=cp&tema=<?=$oku[tema]?>"><?=$oku[tema]?></a></td>
  <td width="50%"><?echo("$say kişi tarafından kullanılıyor");?></td>
 </tr>
</table><br>
<?
}
?>
</fieldset>
</div>
