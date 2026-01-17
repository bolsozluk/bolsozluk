<?php
// 1. Hata Raporlama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Session Başlat
if (session_id() == "") { session_start(); }

// 3. Değişkenleri Yakala (Hibrit Yaklaşım)
//$kullaniciAdi = isset($_SESSION['kullaniciAdi']) ? $_SESSION['kullaniciAdi'] : '';
$eskinick = $kullaniciAdi;

// Veriyi hem POST hem REQUEST içinden yakalıyoruz
$ayb = 0;
if (isset($_POST['ayb'])) {
    $ayb = (int)$_POST['ayb'];
} elseif (isset($_GET['ayb'])) {
    $ayb = (int)$_GET['ayb'];
}

// --- HATA AYIKLAMA (Eğer işlem gerçekleşmezse nedenini ekrana basar) ---
if (isset($_POST['send']) && ($ayb !== 146 || empty($eskinick))) {
    echo "<div style='color:red; background:#ffeded; padding:10px; border:1px solid red;'>";
    if (empty($eskinick)) echo "Hata: Oturumunuz kapalı görünüyor. Lütfen giriş yapın.<br>";
    if ($ayb !== 146) echo "Hata: Girdiğiniz sayı ($ayb) hatalı. Lütfen 146 yazın.";
    echo "</div>";
}

// 4. İŞLEM BAŞLATMA ŞARTI
if ($eskinick && $ayb === 146) {
    
    // SQL Sorguları (mysql_ bağlantısı aktif olmalıdır)
    $sorgu1 = "UPDATE mesajlar SET yazar='anonim' WHERE yazar='$eskinick'";
    $islem1 = mysql_query($sorgu1);

    $sorgu3 = "UPDATE oylar SET entry_sahibi='anonim' WHERE entry_sahibi='$eskinick'";
    $islem3 = mysql_query($sorgu3);

    if ($islem1 && $islem3) {
        $msg = "Islem basarili. Entryleriniz anonimlestirildi.";
        echo '<script type="text/javascript">alert("' . $msg . '"); window.location="logout.php"; </script>';
        exit;
    } else {
        die("Veritabanı Hatası: " . mysql_error());
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <title>Anonimleştirme Onayı</title>
</head>
<body>

<p>Anonimleştirilen entryleriniz yazar kimliğinizden ayrıştırılacak ve üzerindeki geçmiş oylamalar dahil olmak üzere anonimleştirilecektir. Onaylıyor musunuz?</p>

<form method="POST" action="sozluk.php?process=anon2"> 
    <table cellpadding="10px" border="0">
        <tr>
            <td align="right">Sayıyla 145+1: </td>
            <td><input name="ayb" size="10" type="text" autocomplete="off" value=""></td>
        </tr>
        <tr>
            <td colspan="2">
                <input value="Onaylıyorum" name="send" type="submit" style="cursor:pointer;">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
