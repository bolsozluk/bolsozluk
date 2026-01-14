<?php
// Hata göster
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Güvenli ID ve değer al
$id = isset($_REQUEST["id"]) ? guvenlikKontrol($_REQUEST["id"], "ultra") : '';
$deger = isset($_REQUEST["kanal2"]) ? mysql_real_escape_string($_REQUEST["kanal2"]) : '';

if (!$id || $deger == '') {
    die("gecersiz istek: id veya kanal2 yok");
}

$allowed = array(
    "mc",
    "album",
    "yabancirap",
    "graffiti",
    "turntablism",
    "produktor",
    "polemik",
    "magazin",
    "lyrics",
    "konser",
    "kultur"
);

if (!$id || $deger === '' || !in_array($deger, $allowed, true)) {
    die("geçersiz istekler istiyorsunuz.");
}


// --------------------
// KANAL SİLME (ADMIN / MOD)
// --------------------
if ($kulYetki == "admin" || $kulYetki == "mod") {

    $silme = false; // flag

    if (isset($_GET['kanal2'])) {

        if ($_GET['kanal2'] == 'kanal1sil') {
            mysql_query("UPDATE konular SET kanal1='' WHERE id='$id'");
            echo "$id numarali basligin kanal1 slotu silindi.";
            $silme = true;
        }

        if ($_GET['kanal2'] == 'kanal2sil') {
            mysql_query("UPDATE konular SET kanal2='' WHERE id='$id'");
            echo "$id numarali basligin kanal2 slotu silindi.";
            $silme = true;
        }

        if ($_GET['kanal2'] == 'kanal3sil') {
            mysql_query("UPDATE konular SET kanal3='' WHERE id='$id'");
            echo "$id numarali basligin kanal3 slotu silindi.";
            $silme = true;
        }

        if ($_GET['kanal2'] == 'reset') {
        mysql_query("UPDATE konular SET kanal1='' WHERE id='$id'");
        mysql_query("UPDATE konular SET kanal2='' WHERE id='$id'");
        mysql_query("UPDATE konular SET kanal3='' WHERE id='$id'");
        echo "$id numarali basligin kanal bilgileri silindi.";
        $silme = true;
        }

        // Sadece silme işlemi yapıldıysa geri dön
        if ($silme) {
            ?>
            <script type="text/javascript">
                setTimeout(function () {
                    window.history.go(-2);
                }, 500);
            </script>
            <?php
            exit;
        }

    }
}

/* Sorgu kontrolü */
$sorgu = mysql_query("SELECT kanal1, kanal2, kanal3 FROM konular WHERE id='$id'");
if (!$sorgu) {
    die("SQL hatasi: ".mysql_error());
}

$kayit = mysql_fetch_array($sorgu);

// Önce kontrol et: değer zaten herhangi bir slotta varsa tekrar yazma
if ($kayit['kanal1'] === $deger || $kayit['kanal2'] === $deger || $kayit['kanal3'] === $deger) {
    die("Bu değer zaten bir slotta mevcut, tekrar eklenemez.");
}

/* Slot mantığı */
$hedefKanal = '';
if ($kayit['kanal1'] == '' || $kayit['kanal1'] == 'NULL') {
    $hedefKanal = 'kanal1';
}
elseif ($kayit['kanal2'] == '' || $kayit['kanal2'] == 'NULL') {
    $hedefKanal = 'kanal2';
}
elseif ($kayit['kanal3'] == '' || $kayit['kanal3'] == 'NULL') {
    $hedefKanal = 'kanal3';
}
else {
    die("Bu baslik icin tum kanal slotlari dolu.");
}

/* Slotu güncelle */
if (!mysql_query("UPDATE konular SET $hedefKanal='$deger' WHERE id='$id'")) {
    die("SQL update hatasi: ".mysql_error());
}

echo "$id numarali basliga $hedefKanal slotuna '$deger' yazildi.";

?>

<script language="JavaScript" type="text/javascript">
        setTimeout("window.history.go(-1)",500);
</script>
