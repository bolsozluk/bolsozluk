<style>

input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
</style>

<?

if (!isset($_SESSION['kulYetki_S']) || ($_SESSION['kulYetki_S'] != 'admin' && $_SESSION['kulYetki_S'] != 'mod')) {
    $user = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : 'Unknown';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    error_log("Yetkisiz erişim girişimi: " . $user . " - IP: " . $ip);
    header("Location: /sozluk.php?process=refresh");
    die;
}



$toDo = guvenlikKontrol($_REQUEST["submit"],"hard");
$ok = guvenlikKontrol($_REQUEST["ok"],"hard");
$id = $_REQUEST["id"];

echo "22.05.2021 - yönetici notu, kullanıcı düzenleme ekranından girilebilir. çaylağı kasten bekletiyorsak niteliksiz entry vs. buraya not düşebiliriz. cezalı yazarlarda feyktahmin gösterilmeyecek. <br><br>";

//echo "$kulYetki";

if ($yazaronayla != 1) {
	echo "Bu işlem için gerekli yetkiye sahip değilsiniz";
	die;
}

if ($ok && $toDo=="yasakla") {
	foreach($id as $kayit){
		mysql_query("UPDATE user SET durum = 'sus' WHERE id='$kayit'");
	
		$sorgu1 = mysql_fetch_array(mysql_query("SELECT nick,id,email FROM user WHERE `id` = '$kayit'"));

		$userNickName=$sorgu1["nick"];
	
		mysql_query("UPDATE mesajlar SET statu='silindi' WHERE yazar='$userNickName'");
		
		mysql_query("UPDATE user SET silsebep='$silsebep' WHERE yazar='$userNickName'");
		
		echo " $userNickName yasaklandi.<br>";

	$tarih = date("YmdHi");
		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
		$dakika = date("i");
/*
		$mesaj = "`$userNickName` yazarlık için yeterli düzeyde içerik girmediğinden üyelik başvurusu reddedilmiştir. (gerekçe: $silsebep) "; //<br> ayrıca (bkz: sözlükle ilgili duyurular)
			$sorgu2 = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu2 .= " VALUES ('27920','$mesaj','bolsozluk','127.0.0.1','$tarih','$gun','$ay','$yil','$saat','','$dakika','bolsozluk')";
			mysql_query($sorgu2);

				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='27920'";
				mysql_query($sorgux); 

*/

	}
	die();
}

if ($ok && $toDo=="onayla") {
	foreach($id as $kayit){
		$sorgu = "UPDATE user SET durum = 'on' WHERE id='$kayit'";
		mysql_query($sorgu);

		$sorgu = "UPDATE user SET onaylayan = '$kullaniciAdi' WHERE id='$kayit'";
		mysql_query($sorgu);
	
		$sorgu1 = "SELECT nick,id,email FROM user WHERE `id` = '$kayit'";
		$sorgu2 = mysql_query($sorgu1);
		mysql_num_rows($sorgu2);
		$kayit2=mysql_fetch_array($sorgu2);
		$userNickName=$kayit2["nick"];
		$email=$kayit2["email"];
	
		$sorgu = "UPDATE mesajlar SET statu = '' WHERE yazar='$userNickName' and statu!='silindi'";
		mysql_query($sorgu);
	
		$tarih = date("YmdHi");
		$gun = date("d");
		$ay = date("m");
		$yil = date("Y");
		$saat = date("H:i");
			$dakika = date("i");
	
		$konu = "<img src=img/unlem.gif> Yazar oldunuz!";
		$konumail = "Yazar oldunuz!";
		$admtem = "admTEM";
		$yazi = "
		Yazarlığınız yöneticiler tarafından onaylanmıştır.<br>
		Şu an yazar statüsüne geçtiniz.
		<b></b>
		";
	
		$konu = mysql_real_escape_string($konu);
		$mesaj = mysql_real_escape_string($mesaj);
	
		$sorgu = "INSERT INTO privmsg ";
		$sorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
		$sorgu .= " VALUES ";
		$sorgu .= "('$userNickName','$konu','$yazi','$admtem','$tarih','1','$gun','$ay','$yil','$saat')";
		mysql_query($sorgu);

			$mesaj = "`$userNickName` aramıza katılmıştır. hoş gelmiş.";
			$sorgu2 = "INSERT INTO mesajlar (sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,statu,dakika,ilkyazar)";
			$sorgu2 .= " VALUES ('24729','$mesaj','bolsozluk','127.0.0.1','$tarih','$gun','$ay','$yil','$saat','','$dakika','bolsozluk')";
			mysql_query($sorgu2);

				$sorgux = "UPDATE konular SET tarih='$tarih',gun='$gun',ay='$ay',yil='$yil' WHERE id='24729'";
				mysql_query($sorgux); 
	
		echo "$userNickName [$email] onaylandi.<br>";
		$icerik = "
		merhaba,\n
		$userNickName nickinize ait yazarlik basvurunuz kabul edilmistir.\n
		direk giris yaparak entry girmeye baslayabilirsiniz!\n
		\n
		hayırlı isler, bol girisler dileriz.\n
		www.bolsozluk.com
		";
		mail("$email", "$konumail", "$icerik", "From: bolsozluk.com <info@bolsozluk.com>");
	}

}else{
	echo "
	<strong>Onay bekleyen çömler:</strong><br>
	<form method=post action=>
	<table width=\"606\" border=\"1\">
	";
	$sorgu = "SELECT nick,cezali,admnot, durum,email,id,regip,regsehir,regip FROM user WHERE durum = 'wait' or durum='off'";
	$sorgulama = mysql_query($sorgu);


			echo "

			  <tr>
				<td width=\"229\"><b>yazar ve lokasyonu</b></td>
				<td width=\"229\"><b>yönetici notu</b></td>
				<td width=\"229\"><b>cezalı mı?</b></td>
				<td width=\"344\"><b>mail adresi ve entryleri</b></td>
				<td width=\"229\"><b>kimin feyki olabilir?</b></td>
			  </tr>
			";
	
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$userNickName=$kayit["nick"];
			$isim=$kayit["isim"];
			$email=$kayit["email"];
			$regip=$kayit["regip"];
			$id=$kayit["id"];
			$regsehir=$kayit["regsehir"];
			$cezali=$kayit["cezali"];
			$admnot=$kayit["admnot"];
			

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$userNickName' and statu != 'silindi' ");
$kac = mysql_num_rows($sor);




if (($kac >1) or ($userNickName == "elenko")) { 
//PANELE DÜŞME VE YAZAR ONAYLAMA EŞİĞİ

if (($cezali != "2")) // $feyktahmin = "bilinmiyor";
{

$sorgu4 = mysql_query("SELECT ip,yazar FROM `iptables` WHERE ip = '$regip' LIMIT 0,1");
$kayit=mysql_fetch_array($sorgu4);
$feyktahmin=$kayit["yazar"];

$sorgu4 = mysql_query("SELECT ip,yazar FROM `iptables` WHERE ip = '$regip' LIMIT 1,2");
$kayit=mysql_fetch_array($sorgu4);
$feyktahmin2=$kayit["yazar"];

$sorgu4 = mysql_query("SELECT ip,yazar FROM `iptables` WHERE ip = '$regip' LIMIT 2,3");
$kayit=mysql_fetch_array($sorgu4);
$feyktahmin3=$kayit["yazar"];

$sorgu4 = mysql_query("SELECT ip,yazar FROM `iptables` WHERE ip = '$regip' LIMIT 3,4");
$kayit=mysql_fetch_array($sorgu4);
$feyktahmin4=$kayit["yazar"];

//$sorgu4 = mysql_query("SELECT ip,yazar FROM `iptables` WHERE ip = '$regip' LIMIT 4,5");
//$kayit=mysql_fetch_array($sorgu4);
//$feyktahmin5=$kayit["yazar"];

if($userNickName == $feyktahmin) $feyktahmin = "bilinmiyor";
if($userNickName == $feyktahmin2) $feyktahmin2 = "bilinmiyor";
if($userNickName == $feyktahmin3) $feyktahmin3 = "bilinmiyor";
if($userNickName == $feyktahmin4) $feyktahmin4 = "bilinmiyor";
//if($userNickName == $feyktahmin5) $feyktahmin5 = "bilinmiyor";

if ($feyktahmin2 == $feyktahmin) $feyktahmin2 = "";
if ($feyktahmin3 == $feyktahmin2) $feyktahmin3 = "";
if ($feyktahmin3 == $feyktahmin) $feyktahmin3 = "";
if ($feyktahmin4 == $feyktahmin) $feyktahmin4 = "";
if ($feyktahmin4 == $feyktahmin2) $feyktahmin4 = "";
if ($feyktahmin4 == $feyktahmin3) $feyktahmin4 = "";
//if ($feyktahmin5 == $feyktahmin) $feyktahmin5 = "";
//if ($feyktahmin5 == $feyktahmin2) $feyktahmin5 = "";
//if ($feyktahmin5 == $feyktahmin3) $feyktahmin5 = "";
//if ($feyktahmin5 == $feyktahmin4) $feyktahmin5 = "";


if($userNickName == $feyktahmin) $feyktahmin = "bilinmiyor";
if($feyktahmin == "") $feyktahmin = "bilinmiyor";

}


if (($cezali == "1")) // ($admnot != NULL))
{
$feyktahmin = "gösterilmiyor";
}




	//$details = json_decode(file_get_contents("http://ipinfo.io/{$regip}/json"));
	// <a href=fakes.php?fak=$regip target=new> - [feykmi]</a>
			echo "

			  <tr>
				<td width=\"229\"><a href=\"sozluk.php?process=adm&islem=kullanici&update=ok&gnick=$userNickName\" title=\"$isim\">$userNickName - [$regsehir]</a><a href=http://whatismyipaddress.com/ip/$regip target=new> - $regip</a></td>
				<td width=\"229\">$admnot</td>";


				echo"</td> <td width=\"229\">";
				if ($cezali == "1") {echo "<b>CEZALI</b>";} echo"</td>";

			

				echo"</td>

				<td width=\"344\">$email
					<a href=\"sozluk.php?process=entryliste&kimdirbu=$userNickName\" title\"GBT\"> [çaylaklık entryleri] - [$kac]</a></td>
				<input type=hidden name=nick value=\"$userNickName\">

				<td width=\"229\">"; {echo "<b>$feyktahmin $feyktahmin2 $feyktahmin3 $feyktahmin4 $feyktahmin5</b>";}

				echo"<td width=\"19\"><input name=\"id[]\" type=\"checkbox\" id=\"$id\" value=\"$id\"></td>
			  </tr>
			";


		}

	}
	}
	echo "
	</table>
	<input type=hidden name=ok value=ok>
	<input type=\"submit\" name=\"submit\" value=\"onayla\">
	<input type=\"submit\" name=\"submit\" value=\"yasakla\">
	  <tr><td>Ban Sebebi:</td><td>:</td><td width=\"173\"><input name=\"silsebep\" type=\"text\" id=\"silsebep\" value=\"\"></td>
	</form>
	";

	echo "<br>";
echo "eski notlar:";
echo "<br>"; echo "<br>";
echo "07.11.2014 - kullanici tablosuna kayit olurken baglandigi ip ve son giri$ iplerinin dokumunu verdim, feyk kontrolde faydasi olur.<br>";
echo "11.08.2017 - çaylak onaylanınca tüm entryleri görünür olacaktır. onayı uygun bulunmayan çaylağı yasakla butonuyla banlayalım. <br>";
echo "20.07.2019 - çaylak yasakla butonuna basmadan önce ban sebebi bilgisi de aşağıdaki kutucuğa girilmelidir. <br>";
echo "31.10.2019 - tkp reset eklenecek > UPDATE table_name SET column_name = 0<br>";
echo "08.07.2020 - feyk tahmin bilgisi, yurtdışı şehirlerden kayıt olan yazarlarda doğru çalışmayabilir. (muhtemel VPN kullanımı nedeniyle)<br>";
echo "18.03.2024 - silinmemiş anonim entryleri geri getir özelliği kullanıcı kontrol paneline eklendi.";
}
?>

