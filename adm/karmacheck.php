<? 
ini_set('display_errors', 1);
error_reporting(E_ALL);

$kim = guvenlikKontrol($_REQUEST["kim"],"hard");

//KARMA UPDATE SİSTEMİ

//entry id çek
$kimse1=mysql_fetch_array(mysql_query("SELECT * from user where nick='$kim'"));
$kimse = $kimse1["nick"];
$saycaylak = $kimse1["saycaylak"];
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = '' ");
$kactop = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim'");
$kachamx = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `ilkyazar`='$kim'");
$kachamy = mysql_num_rows($sor);

if ($kachamx > $kachamy) $kacham = $kachamx;
if ($kachamx <= $kachamy) $kacham = $kachamy;

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = 'silindi' AND silen<>'$kim'"); //kendi sildiklerini dahil etme
$saysil = mysql_num_rows($sor);

$yil = date("Y");
$ay = date("n");

if ($ay == 12) {
    $ilkAy = 1;
    $ilkYil = $yil;
} else {
    $ilkAy = $ay + 1;
    $ilkYil = $yil - 1;
}

$sorgu = "SELECT COUNT(*) FROM mesajlar WHERE yazar='anonim' AND ilkyazar='$kim' AND ((yil='$ilkYil' AND ay>='$ilkAy') OR (yil='$yil' AND ay<='$ay'))";
$res = mysql_query($sorgu);
$anonimsayi = mysql_result($res, 0);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '1'");
$arti = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '0'");
$eksi = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `nick`='$kim' and oy = 1");
$verarti = mysql_num_rows($sor);

// Şüpheli oy oranı tespiti
$oy_verme_orani = $verarti / max($kactop, 1);
$oy_alma_orani = $arti / max($kactop, 1);

// Kalite puanı hesaplamasından önce net oy oranını sınırla
$net_oy_orani = ($arti - $eksi) / max($kactop, 1);
$maksimum_oran = 4; // Entry başına maksimum 2 net oy

if ($net_oy_orani > $maksimum_oran) {
    $net_oy_orani = $maksimum_oran;
}

// Katsayıları ayarla
$aktivite_carpani = 0.07;         // Düşürüldü (0.12 → 0.07)
$kalite_agirlik = 0.59;           // Düşürüldü (0.65 → 0.59)
$topluluk_carpani = 25;           // Artirildi (18 → 25)
$deneyim_bonus_carpani = 0.04;    // Düşürüldü (0.07 → 0.04)
$silinen_ceza = 2.0;              // Düşürüldü (4 → 2)
$caylak_ceza = 25;                // Düşürüldü (30 → 25)
$sadakat_indirim_carpani = 0.01;  // Düşürüldü (0.02 → 0.01)
$kpi_carpani = 1.8;               // Düşürüldü (2.2 → 1.8)
$kpi_max = 1.5;                   // Düşürüldü (1.8 → 1.5)
$anon_carpan = 0.4;			      // initial (0.4)
$bot_cezasi = 1.0; 

if ($kactop > 1000) {
    $caylak_ceza = 15; // 15 puan
} else {
    $caylak_ceza = 25; // 25 puan
}

if ($oy_verme_orani > 5 || $oy_alma_orani > 5) $bot_cezasi = 0.8; // %20 ceza
if ($oy_verme_orani > 10 || $oy_alma_orani > 10) $bot_cezasi = 0.3; // %70 ceza
if ($oy_verme_orani > 15 || $oy_alma_orani > 15) $bot_cezasi = 0.1; // %90 ceza
if ($oy_verme_orani > 30 || $oy_alma_orani > 30) $bot_cezasi = 0.01; // %99 ceza

//karma hesaplama
$karmak0 = min($net_oy_orani * 100 * $kalite_agirlik,500)*$bot_cezasi;
$karmak1 = $kactop * $aktivite_carpani;
$karmak2 = min(($verarti / max($kactop, 1)) * 8, 250)*$bot_cezasi; // Maksimum sınır
$deneyim_bonus = ($kactop > 1000) ? min(($kactop - 1000) * $deneyim_bonus_carpani, 50) : 0;
$kpi = min(max(($arti / $kactop) * $kpi_carpani, 0.8), $kpi_max);
$karmaneg = $saysil * $silinen_ceza;
$caylak_ceza = $saycaylak * $caylak_ceza;
$anonimsayi = $anonimsayi * $anon_carpan;

$karma = ($karmak0 + $karmak1 + $karmak2 + $deneyim_bonus - $anonimsayi) * $kpi;
$karma = $karma - $karmaneg - $caylak_ceza;
$karma = round($karma);

echo "<b>$kim:</b>"; 
echo "<pre>";
echo "oy verme oranı: " . htmlspecialchars($oy_verme_orani) . "\n";
echo "oy alma oranı: " . htmlspecialchars($oy_alma_orani) . "\n";
echo "kactop (Onaylı Entry): " . htmlspecialchars($kactop) . "\n";
echo "arti (Artı Oy): " . htmlspecialchars($arti) . "\n";
echo "eksi (Eksi Oy): " . htmlspecialchars($eksi) . "\n";
echo "verarti (Verilen Artı Oy): " . htmlspecialchars($verarti) . "\n";
echo "saysil (moderasyonca Silinen Entry): " . htmlspecialchars($saysil) . "\n";
echo "saycaylak (Çaylak Cezası): " . htmlspecialchars($saycaylak) . "\n\n";

echo "HESAPLAMALAR:\n";
echo "karmak0 (Kalite Puanı): " . round($karmak0, 2) . "\n";
echo "karmak1 (Aktivite Puanı): " . round($karmak1, 2) . "\n";
echo "karmak2 (Topluluk Katkısı): " . round($karmak2, 2) . "\n";
echo "deneyim_bonus: " . round($deneyim_bonus, 2) . "\n";
echo "kpi (Kalite Çarpanı): " . round($kpi, 2) . "\n";
echo "karmaneg (Silinen Ceza): " . round($karmaneg, 2) . "\n";
echo "caylak_ceza: " . round($caylak_ceza, 2) . "\n";
echo "anonimlik cezasi:" . $anonimsayi . "\n";

echo "SONUÇ:\n";
echo "Karma Puanı: " . $karma . "\n";
echo "</pre>";

echo "<b>$kim:</b>"; 
echo "<pre>";
echo "oy verme oranı: " . htmlspecialchars($oy_verme_orani) . "\n";
echo "oy alma oranı: " . htmlspecialchars($oy_alma_orani) . "\n";
echo "kactop (Onaylı Entry): " . htmlspecialchars($kactop) . "\n";
echo "arti (Artı Oy): " . htmlspecialchars($arti) . "\n";
echo "eksi (Eksi Oy): " . htmlspecialchars($eksi) . "\n";
echo "verarti (Verilen Artı Oy): " . htmlspecialchars($verarti) . "\n";
echo "saysil (moderasyonca Silinen Entry): " . htmlspecialchars($saysil) . "\n";
echo "saycaylak (Çaylak Cezası): " . htmlspecialchars($saycaylak) . "\n\n";

echo "HESAPLAMALAR:\n";
echo "karmak0 (Kalite Puanı): " . round($karmak0, 2) . "\n";
echo "karmak1 (Aktivite Puanı): " . round($karmak1, 2) . "\n";
echo "karmak2 (Topluluk Katkısı): " . round($karmak2, 2) . "\n";
echo "deneyim_bonus: " . round($deneyim_bonus, 2) . "\n";
echo "kpi (Kalite Çarpanı): " . round($kpi, 2) . "\n";
echo "karmaneg (Silinen Ceza): " . round($karmaneg, 2) . "\n";
echo "caylak_ceza: " . round($caylak_ceza, 2) . "\n";
echo "anonimsayi:" . $anonimsayi . "\n";

echo "SONUÇ:\n";
echo "Karma Puanı: " . $karma . "\n";
echo "</pre>";

?>
