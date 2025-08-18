
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = guvenlikKontrol($_REQUEST["id"], "ultra");
$sira = guvenlikKontrol($_REQUEST["sira"], "ultra");
$sebep = guvenlikKontrol($_REQUEST["sebep"], "hard");
$sr = guvenlikKontrol($_REQUEST["sr"], "ultra");
$kullaniciAdi = $_SESSION['kullaniciAdi_S'];
$kulYetki = $_SESSION['kulYetki_S'];

if ($kulYetki != "admin" && $kulYetki != "mod") {
    $ip = getenv('REMOTE_ADDR');
    echo "Dikkat!<br>$ip ispitledin!";
    die;
}

if (!$kullaniciAdi) {
    header("Location:sozluk.php?process=master&login=yescanim");
    exit;
}

if ($_POST['tasi'] && $sira > 1) {
    // Güncellenmeden önce eski sira alınır
    $sorgu1 = "SELECT sira FROM mesajlar WHERE id = '$id'";
    $sorgu2 = mysql_query($sorgu1);
    $kayit2 = mysql_fetch_array($sorgu2);
    $tasiorji = $kayit2["sira"];

    // Orijinal sıra kaydedilir
    $sorgu = "UPDATE mesajlar SET tasiorji = '$tasiorji' WHERE id='$id'";
    mysql_query($sorgu);

    // Sıra güncellenir
    $degistir = mysql_query("UPDATE mesajlar SET sira='$sira' WHERE id='$id'");

    // Taşıyan ve tarih kaydedilir
    $tarih = date("YmdHi");
    mysql_query("UPDATE mesajlar SET tasiyan = '$kullaniciAdi' WHERE id='$id'");
    mysql_query("UPDATE mesajlar SET tasitarih = '$tarih' WHERE id='$id'");

    $no = mysql_affected_rows(); // Doğru fonksiyon!

    echo "entryniz #$sira numaralı başlığa taşınmıştır";
    ?>
    <script language="JavaScript" type="text/javascript">
        setTimeout("window.history.go(-2)",500);
    </script>
    <?php
}
?>

<form action="" method="POST">
  <input type="hidden" name="id" value="<?=$id?>">
  #<?=$id?> numaralı entry'yi #<input type="number" size="5" name="sira"> numaralı başlığa taşı!<br>
  <input type="submit" name="tasi" value="tamamdir">
</form>
<?php

if (isset($no) && ($no < 1 || $sira < 1)) {
    echo "sözlük sıçtı sonra tekrar deneyiniz, belki de kusur sözlükte değildir.";
}
?>
