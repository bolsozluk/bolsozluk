<? 
ini_set('display_errors', 1);
error_reporting(E_ALL);

$kim = guvenlikKontrol($_REQUEST["kim"],"hard");

//KARMA UPDATE SİSTEMİ

//entry id çek
$kimse1=mysql_fetch_array(mysql_query("SELECT * from user where nick='$kim'"));
$kimse = $kimse1["nick"];
$saysil = $kimse1["saysil"];
$saycaylak = $kimse1["saycaylak"];

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = '' ");
$kactop = mysql_num_rows($sor);

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim'");
$kachamx = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `ilkyazar`='$kim'");
$kachamy = mysql_num_rows($sor);

if ($kachamx > $kachamy) $kacham = $kachamx;
if ($kachamx <= $kachamy) $kacham = $kachamy;

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kim' and `statu` = 'silindi' ");
$kac = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '1'");
$arti = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kim' and `oy` = '0'");
$eksi = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `nick`='$kim' and oy = 1");
$verarti = mysql_num_rows($sor);

// Katsayıları ayarla
$aktivite_carpani = 0.07;         // Düşürüldü (0.12 → 0.07)
$kalite_agirlik = 0.59;           // Düşürüldü (0.65 → 0.59)
$topluluk_carpani = 25;           // Artirildi (18 → 25)
$deneyim_bonus_carpani = 0.04;    // Düşürüldü (0.07 → 0.04)
$silinen_ceza = 4.0;              // Arttırıldı (1.2 → 4.0)
$caylak_ceza = 30;                // Arttırıldı (7 → 30)
$sadakat_indirim_carpani = 0.01;  // Düşürüldü (0.02 → 0.01)
$kpi_carpani = 1.8;               // Düşürüldü (2.2 → 1.8)
$kpi_max = 1.5;                   // Düşürüldü (1.8 → 1.5)

// Karma hesaplama
$karmak0 = (($arti - $eksi) / $kactop) * 100 * $kalite_agirlik;
$karmak1 = $kactop * $aktivite_carpani;
$karmak2 = ($verarti / $kactop) * $topluluk_carpani;
$deneyim_bonus = ($kactop > 2000) ? min(($kactop - 2000) * $deneyim_bonus_carpani, 50) : 0;
$kpi = min(max(($arti / $kactop) * $kpi_carpani, 0.8), $kpi_max);
$karmaneg = $saysil * $silinen_ceza;
$caylak_ceza = $saycaylak * $caylak_ceza;

$karma = ($karmak0 + $karmak1 + $karmak2 + $deneyim_bonus) * $kpi;
$karma = $karma - $karmaneg - $caylak_ceza 
$karma = round($karma);


echo "<b>$kim:</b>"; 
echo "<pre>";
echo "kactop (Onaylı Entry): " . htmlspecialchars($kactop) . "\n";
echo "arti (Artı Oy): " . htmlspecialchars($arti) . "\n";
echo "eksi (Eksi Oy): " . htmlspecialchars($eksi) . "\n";
echo "verarti (Verilen Artı Oy): " . htmlspecialchars($verarti) . "\n";
echo "saysil (Silinen Entry): " . htmlspecialchars($saysil) . "\n";
echo "saycaylak (Çaylak Cezası): " . htmlspecialchars($saycaylak) . "\n\n";

echo "HESAPLAMALAR:\n";
echo "karmak0 (Kalite Puanı): " . round($karmak0, 2) . "\n";
echo "karmak1 (Aktivite Puanı): " . round($karmak1, 2) . "\n";
echo "karmak2 (Topluluk Katkısı): " . round($karmak2, 2) . "\n";
echo "deneyim_bonus: " . round($deneyim_bonus, 2) . "\n";
echo "kpi (Kalite Çarpanı): " . round($kpi, 2) . "\n";
echo "karmaneg (Silinen Ceza): " . round($karmaneg, 2) . "\n";
echo "caylak_ceza: " . round($caylak_ceza, 2) . "\n";

echo "SONUÇ:\n";
echo "Karma Puanı: " . $karma . "\n";
echo "</pre>";

?>
