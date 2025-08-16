<?
if (!$kullaniciAdi) {
 header("Location:sozluk.php?process=master&login=yescanim");
} else {

  $sil=mysql_query("delete from rehber where num='$_GET[num]' and kim='$_GET[kim]' and kimin='$kullaniciAdi'");
  $no=@mysql_num_rows($sil);
   if ($no>=1) {
    echo "bi sorun var yaw sonra dene";
   } else {
    if ($_GET['num']==0) {
     header("Location:sozluk.php?process=arkadaslarim");
    } else {
     header("Location:sozluk.php?process=arkadaslarim");
    }
   }
}
?>
