<?php
// 1. Hata Raporlama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Session Başlat
if (session_id() == "") { session_start(); }

// 3. Değişkenleri Tanımla
$eskinick = $kullaniciAdi;

// Sayı kontrolü (POST ve GET destekli)
$ayb = 0;
if (isset($_POST['ayb'])) {
    $ayb = (int)$_POST['ayb'];
} elseif (isset($_GET['ayb'])) {
    $ayb = (int)$_GET['ayb'];
}

// --- HATA AYIKLAMA PANELİ ---
if (isset($_POST['send'])) {
    if (empty($eskinick)) {
        echo "<div style='color:red; background:#fee; padding:10px; border:1px solid red;'>Hata: Oturumunuz kapalı veya sistem kullanıcı adınızı (SESSION) okuyamıyor.</div>";
    }
    if ($ayb !== 146) {
        echo "<div style='color:red; background:#fee; padding:10px; border:1px solid red;'>Hata: Doğrulama sayısı (146) hatalı girildi.</div>";
    }
}

// Bilgilendirme metni
if ($ayb !== 146) {
    echo "Anonimleştirilen entryleriniz yazar kimliğinizden ayrıştırılacak ve hesabınız kapatılacaktır. Onaylıyor musunuz?<br>";
}

// --- İŞLEM KISMI ---
if ($eskinick && $ayb === 146) {
    echo "<strong>Hesabınız kapatılıyor ve entryleriniz anonimleştiriliyor...</strong>";
    
    $tarih = date("YmdHi");
    $hatavar = false;

    // Sorgu listesi
    $sorgular = array(
        "UPDATE mesajlar SET yazar='anonim' WHERE yazar='$eskinick'",
        "UPDATE user SET silsebep='kendini anonimleştirdi' WHERE nick='$eskinick'",
        "UPDATE oylar SET entry_sahibi='anonim' WHERE entry_sahibi='$eskinick'",
        "UPDATE user SET durum='sus' WHERE nick='$eskinick'",
        "UPDATE user SET silen='$eskinick' WHERE nick='$eskinick'",
        "UPDATE user SET bantarih='$tarih' WHERE nick='$eskinick'"
    );

    foreach ($sorgular as $sql) {
        if (!mysql_query($sql)) {
            $hatavar = mysql_error();
            break; 
        }
    }

    if (!$hatavar) {
        $msg = "Entryleriniz anonimlestirildi. Hesabiniz kapatildi.";
        echo '<script type="text/javascript">alert("' . $msg . '"); window.location="logout.php"; </script>';
        exit;
    } else {
        echo "<div style='color:red;'>Veritabanı hatası oluştu: " . $hatavar . "</div>";
        exit;
    }
}
?>

<form method="POST" action="sozluk.php?process=anon3">
    <table cellpadding="10px" border="0">
        <tr>
            <td align="right">Sayıyla 145+1: </td>
            <td><input name="ayb" size="30" type="text" autocomplete="off" value=""></td>
        </tr>
        <tr>
            <td colspan="2">
                <input value="Onaylıyorum" name="send" type="submit" style="cursor:pointer;">
            </td>
        </tr>
    </table>
</form>
