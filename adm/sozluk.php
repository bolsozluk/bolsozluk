<?
session_start();
ob_start();
extract($_REQUEST); //bunu silebilirim
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE);

$oke = guvenlikKontrol($_REQUEST["oke"],"hard");

  $sorgu = "SELECT * FROM ayar WHERE `id` = '1'";
  $sorgulama = @mysql_query($sorgu);
  
  if (@mysql_num_rows($sorgulama)>0){
  
    while ($kayit=@mysql_fetch_array($sorgulama)){
      
      $siteStatus=$kayit["site"];
      $registerStyle=$kayit["reg"];
      $gundem=$kayit["g"];

    }}
    

      if ($siteStatus == "on") $acik = "selected";
            if ($siteStatus == "off") $kapali = "selected";
                  if ($siteStatus == "tech") $bakim = "selected";

            if ($registerStyle == "on") $onayiste = "selected";
                  if ($registerStyle == "off") $onaysiz = "selected";

            if ($gundem == "on") $gundemacik = "selected";
                  if ($gundem == "off") $gundemkisitli = "selected";



if ($sozluk != 1) {
echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
die;
}
if ($oke and $gundem ) {
// $siteStatus = $_POST["site"];
//$registerStyle = $_POST["reg"];
$gundem = $_POST["gundem"];
/*
$sorgu = "UPDATE ayar SET site = '$siteStatus'";
mysql_query($sorgu);
$sorgu = "UPDATE ayar SET reg = '$registerStyle'";
mysql_query($sorgu);
*/
$sorgu = "UPDATE ayar SET g = '$gundem'";
mysql_query($sorgu);
echo "Site ayarlari Apdeyt edildi.";
}
else {
?>
<form method="post" action="sozluk.php?process=adm&islem=sozluk">
<table width="428" border="0">



        <td>Gündem Modu </td>
    <td>:</td>
    <td><select name="gundem" id="gundem">
      <option value="on" <?php echo $gundemacik; ?>>açık</option>
      <option value="off"<?php echo $gundemkisitli; ?>  >kısıtlı</option>
            </select></td>
 </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Apdeyt"></td>
		<input type="hidden" name="oke" value="oke">
  </tr>
</table>
</form>
<? }


/*

  <tr>
    <td width="135">Site</td>
    <td width="8">:</td>
    <td width="263"><select name="site" id="site">
      <option value="on"    <?php echo $acik; ?>>A&ccedil;&#305;k</option>
      <option value="off" <?php echo $kapali; ?>>Kapal&#305;</option>
      <option value="tech" <?php echo $bakim; ?>>Bak&#305;mda</option>
    </select></td>
  </tr>

  <tr>    
    <td>Register Modu </td>
    <td>:</td>
    <td><select name="reg" id="reg">
      <option value="on" <?php echo $onayiste; ?>>Email Onayl&#305;</option>
      <option value="off"<?php echo $onaysiz; ?>  >Email Onays&#305;z</option>
            </select></td>
  </tr>

<tr>

*/


 ?>