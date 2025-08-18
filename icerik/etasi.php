
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = guvenlikKontrol(isset($_POST["id"]) ? $_POST["id"] : (isset($_GET["id"]) ? $_GET["id"] : ""), "ultra");
$sira = guvenlikKontrol(isset($_POST["sira"]) ? $_POST["sira"] : (isset($_GET["sira"]) ? $_GET["sira"] : ""), "ultra");
$sebep = guvenlikKontrol(isset($_REQUEST["sebep"]) ? $_REQUEST["sebep"] : "", "hard");
$sr = guvenlikKontrol(isset($_REQUEST["sr"]) ? $_REQUEST["sr"] : "", "ultra");
$kullaniciAdi = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : "";
$kulYetki = isset($_SESSION['kulYetki_S']) ? $_SESSION['kulYetki_S'] : "";

if ($kulYetki != "admin" && $kulYetki != "mod") {
    $ip = getenv('REMOTE_ADDR');
    echo "Dikkat!<br>$ip ispitledin!";
    die;
}

if (!$kullaniciAdi) {
    header("Location:sozluk.php?process=master&login=yescanim");
    exit;
}

// Form POST edildi mi?
if (isset($_POST['tasi']) && $sira > 1 && $id > 0) {
    // Eski sira alınır
    $sorgu1 = "SELECT sira FROM mesajlar WHERE id = '$id'";
    $sorgu2 = mysql_query($sorgu1);
    $kayit2 = mysql_fetch_array($sorgu2);
    $tasiorji = $kayit2["sira"];

    // Orijinal sıra kaydedilir
    mysql_query("UPDATE mesajlar SET tasiorji = '$tasiorji' WHERE id='$id'");

    // Sıra güncellenir
    $degistir = mysql_query("UPDATE mesajlar SET sira='$sira' WHERE id='$id'");

    // Taşıyan ve tarih kaydedilir
    $tarih = date("YmdHi");
    mysql_query("UPDATE mesajlar SET tasiyan = '$kullaniciAdi' WHERE id='$id'");
    mysql_query("UPDATE mesajlar SET tasitarih = '$tarih' WHERE id='$id'");

    $no = mysql_affected_rows();

    if ($no > 0) {
        echo "entryniz #$sira numaralı başlığa taşınmıştır";
        ?>
        <script type="text/javascript">
            setTimeout("window.history.go(-2)",500);
        </script>
        <?php
        exit;
    } else {
        echo "sözlük sıçtı sonra tekrar deneyiniz, belki de kusur sözlükte değildir.";
    }
}
?>

<form action="" method="POST">
  <input type="hidden" name="id" value="<?=$id?>">
  #<?=$id?> numaralı entry'yi
  #<input type="number" size="5" name="sira" value="<?=$sira?>">
  numaralı başlığa taşı!<br>
  <input type="submit" name="tasi" value="tamamdir">
</form>
