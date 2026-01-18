<?php

// 1. ADIM: Değişkenlerin tanımlı olup olmadığını kontrol edelim (Hata almamak için)
$yazar = isset($_REQUEST["yazar"]) ? guvenlikKontrol($_REQUEST["yazar"],"hard") : "";
$ok    = isset($_REQUEST["ok"]) ? guvenlikKontrol($_REQUEST["ok"],"hard") : "";

// 2. ADIM: Yetki kontrolü (Boş ekranın sebebi buradaki die olabilir)
if ($kullanici != 1) {
    echo "Bu işlem için gerekli yetkiye sahip değilsiniz. Mevcut yetkiniz: " . $kullanici;
    die;
}

// 3. ADIM: İşlem bloğu
if ($yazar && $ok == "ok") {
    $sorgu = "SELECT id,yazar FROM mesajlar WHERE yazar = '$yazar' and statu = 'silindi'";
    $sorgulama = mysql_query($sorgu) or die("Sorgu hatası: " . mysql_error());
    
    if (mysql_num_rows($sorgulama) > 0){
        while ($kayit = mysql_fetch_array($sorgulama)){
            $id = $kayit["id"];
            $updateSorgu = "UPDATE mesajlar SET `statu` = '' WHERE id='$id'";
            mysql_query($updateSorgu);
            echo "<b>$id ($yazar) </b> geri gelenler listesine eklendi.<br>";
        }
    } else {
        echo "<b>$yazar</b> nickine ait silinmiş entry bulunamadı.";
    }
} 
// 4. ADIM: Form bloğu (Eğer işlem yapılmadıysa formu göster)
else {
    ?>
    <form name="deleteUser" method="post" action="">
        <?php echo htmlspecialchars($yazar); ?> nickine ait tüm entry'lar geri getirilecek.<br>
        Emin misiniz?
        <input name="Submit" type="submit" value="Evet, geri getir!">
        <input name="yazar" type="hidden" id="yazar" value="<?php echo htmlspecialchars($yazar); ?>">
        <input name="ok" type="hidden" id="ok" value="ok">
    </form>
    <?php 
} 
?>
