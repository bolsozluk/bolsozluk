<?

$ok = guvenlikKontrol($_REQUEST["ok"],"ip");
$userNickName = guvenlikKontrol($_REQUEST["nick"],"hard");
$update = guvenlikKontrol($_REQUEST["update"],"hard");
$gnick = guvenlikKontrol($_REQUEST["gnick"],"hard");
$id[] = guvenlikKontrol($_REQUEST["id[]"],"hard");
$girisNick = guvenlikKontrol($_REQUEST["gnick"],"hard");
$okupdate = guvenlikKontrol($_REQUEST["okupdate"],"hard");
$durum = guvenlikKontrol($_REQUEST["durum"],"hard");
$verifyStatus = guvenlikKontrol($_REQUEST["durum"],"hard");
$yetki = guvenlikKontrol($_REQUEST["yetki"],"hard");
$sifre = guvenlikKontrol($_REQUEST["sifre"],"hard");
$email = guvenlikKontrol($_REQUEST["email"],"hard");


if ($kullanici != 1) {
	echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
	die;
}

if ($ok and $girisNick) {
	$sorgu = "SELECT * FROM user WHERE `nick` = '$girisNick'";
	$sorgulama = @mysql_query($sorgu);
	
	if (@mysql_num_rows($sorgulama)>0){
	
		while ($kayit=@mysql_fetch_array($sorgulama)){
			
			$userNickName=$kayit["nick"];
			$yetki=$kayit["yetki"];
			$email=$kayit["email"];
			$verifyStatus=$kayit["durum"];
			
			if ($yetki == "admin") $admin = "selected";
			if ($yetki == "user") $user = "selected";
			if ($yetki == "gammaz") $gammaz = "selected";
			if ($yetki == "mod") $mod = "selected";
			
			if ($verifyStatus == "on") $on = "selected";
			if ($verifyStatus == "off") $off = "selected";
			if ($verifyStatus == "sus") $sus = "selected";

			?>
			<form name="editForm" method="post" action="sozluk.php?process=adm&islem=entrysilall">
			  <input name="Submit" type="submit" value="<?php echo $userNickName; ?> nickine ait tüm entryleri sil!">
			   <input name="yazar" type="hidden" id="yazar" value="<?php echo $userNickName; ?>">
</form>

			  <form name="silForm" method="post" action="sozluk.php?process=adm&islem=oysilall">
			  <input name="Submit" type="submit" value="<?php echo $userNickName; ?> nickine ait tüm oyları sil!">

			  <input name="yazar" type="hidden" id="yazar" value="<?php echo $userNickName; ?>">
			</form>
			
			<form method="post" action="">
			<table width="351" border="0">
			  <tr>
              	<td width="111">Nick</td><td width="9">:</td>
				<td width="217"><input name="nick" type="text" id="nick" value="<?php echo $userNickName; ?>" readonly></td>
			  </tr><tr>
				<td>Şifre</td><td>:</td>
				<td><input name="sifre" type="text" id="sifre"></td>
			  </tr><tr>
				<td>E-Mail</td><td>:</td>
				<td><input name="email" type="text" id="email" value="<?php echo $email; ?>"></td>
			  </tr>
              <?php if($_SESSION['kulYetki_S']=="admin"){ ?>
              <tr>
				<td>Yetki</td><td>:</td>
				<td><select name="yetki" id="yetki">
				  <option value="user" <?php echo $user; ?>>Kullanıcı</option>
				  <option value="gammaz" <?php echo $gammaz; ?>>Ispitci</option>
				  <option value="mod" <?php echo $mod; ?>>Moderatör</option>
				  <option value="admin" <?php echo $admin; ?>>Admin</option>
				</select></td>
			  </tr>
              <?php } ?>
              <tr>
				<td>Durum</td><td>:</td>
                <td><select name="durum" id="durum">
						<option value="on" <?php echo $on; ?>>Yazar</option>
						<option value="off" <?php echo $off; ?>>Okur</option>
						<option value="sus" <?php echo $sus; ?>>Yasaklı</option>
						<option value="rahmetli" <?php echo $sus; ?>>Rahmetli</option>
						<option value="kurumsal" <?php echo $sus; ?>>Kurumsal</option>
					</select>
                </td>
			  </tr>
              <tr>
              	<td></td><td></td>
                <input type="hidden" name="okupdate" value="ok">
    			<td><input type="submit" name="Submit" value="Apdeyt"></td>
              </tr>
			</table>
			</form>
			<?php
		}
	}
} else if ($okupdate) {

	if ($sifre) $sifre = sha1($sifre);

	echo "<script>alert(".$verifyStatus.");</script>";

	$sorgu = "UPDATE user SET email='".$email."', durum='".$verifyStatus."' WHERE nick='".$userNickName."'";
	mysql_query($sorgu);

	if ($sifre) {
		$sorgu = "UPDATE user SET sifre = '$sifre' WHERE nick='$userNickName'";
		mysql_query($sorgu);
	}

	if($_SESSION['kulYetki_S']=="admin"){
		$sorgu = "UPDATE user SET yetki = '$yetki' WHERE nick='$userNickName'";
		mysql_query($sorgu);
	}

echo "<center><b>$userNickName Apdeytıd.</center></b>";
}
else if (!$update) {
echo "
<img src=img/new.gif><a href=?process=adm&islem=kullanici&update=ok>Kullanıcı düzenle</a>


<img src=img/new.gif><a href=?process=adm&islem=kullanici>Aktif hesaplar</a>


<img src=img/new.gif><a href=?process=adm&islem=kullanicib>Banlanan hesaplar</a>


<img src=img/new.gif><a href=?process=adm&islem=kullanicic>Çaylak hesaplar</a>
<table width=\"601\" border=\"1\">

  <tr>
    <td width=\"170\"><div align=\"center\"><strong>NICK</strong></div></td>
  <td width=\"170\"><div align=\"center\"><strong>TARIH</strong></div></td>
  <td width=\"100\"><div align=\"center\"><strong>ilk ip</strong></div></td>
  <td width=\"100\"><div align=\"center\"><strong>son ip</strong></div></td>
    <td width=\"80\"><div align=\"center\"><strong>DURUM</strong></div></td>
        <td width=\"80\"><div align=\"center\"><strong>nerden</strong></div></td>

  </tr>
  ";

$sorgu = "SELECT * FROM user WHERE `durum` = 'sus' ORDER BY `regtarih` desc LIMIT 5000";
$sorgulama = @mysql_query($sorgu); 
if (@mysql_num_rows($sorgulama)>0){
//kayıtları listele
while ($kayit=@mysql_fetch_array($sorgulama)){
###################### var ##############################################
$userNickName=$kayit["nick"];
$email=$kayit["email"];
$verifyStatus=$kayit["durum"];
$regtarih=$kayit["regtarih"];
$ilkip=$kayit["regip"];
$sonip=$kayit["sonip"];
$regsehir=$kayit["regsehir"];

echo "<tr>
    <td><a href=\"sozluk.php?process=adm&islem=kullanici&update=ok&gnick=$userNickName\">$userNickName</a></td>
    <td>$regtarih</td>
    <td>$ilkip</td>
    <td>$sonip</td>
    <td>$verifyStatus</td>
         <td>$regsehir</td>
  </tr>";
}

 //<td>$verifyStatus</td>
//üç üst satırdaki email = $email olarak düzeltilecek 
}
echo "</table>";

}
else if ($update) {
echo "
<form method=post action=>
<table width=\"306\" border=\"0\">
  <tr>
    <td width=\"116\">Yazar Nick</td>
    <td width=\"10\">:</td>
    <td width=\"173\"><input name=\"gnick\" type=\"text\" id=\"gnick\" value=\"$girisNick\"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type=\"submit\" name=\"Submit\" value=\"Getir Bakam\"></td>
    <input type=hidden name=ok value=ok>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
";
}
?>