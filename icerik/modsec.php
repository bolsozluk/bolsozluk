<?

 echo "ip geolocation update modulu <br>";
 echo "------------------------------<br>";
 
 	$sorgu = "SELECT * FROM poll_responses WHERE poll_id ='38' AND sehir =''";
	$sorgulama = mysql_query($sorgu);


if (mysql_num_rows($sorgulama)>0)
{
		while ($kayit=mysql_fetch_array($sorgulama)){
			$regip=$kayit["long2ip"];
			$id=$kayit["id"];

			$details = json_decode(file_get_contents("http://ipinfo.io/{$regip}/json"));
			$sehir = $details->city;

$kaydet = "UPDATE poll_responses SET sehir = '$sehir' WHERE id= '$id'";
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