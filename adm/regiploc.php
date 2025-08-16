<?

 echo "ip geolocation update modülü <br>";
 echo "------------------------------<br>";
 
 	$sorgu = "SELECT nick,durum,email,id,regip,regsehir FROM user WHERE regsehir =''";
	$sorgulama = mysql_query($sorgu);


if (mysql_num_rows($sorgulama)>0)
{
		while ($kayit=mysql_fetch_array($sorgulama)){
			$userNickName=$kayit["nick"];
			$isim=$kayit["isim"];
			$email=$kayit["email"];
			$regip=$kayit["regip"];
			$id=$kayit["id"];

			$details = json_decode(file_get_contents("http://ipinfo.io/{$regip}/json"));
			$sehir = $details->city;

$kaydet = "UPDATE user SET regsehir = '$sehir' WHERE id= '$id'";
mysql_query($kaydet);
			echo $sehir;
		//	 echo " | ";
			//die();
		//	echo "kaydedildi..";
				 echo "<br>";
			}
			}


			




mysql_close($databaseConnection);
ob_end_flush();
?>