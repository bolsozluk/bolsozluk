<? 
ini_set('display_errors', 1);
error_reporting(E_ALL);

$kim = guvenlikKontrol($_REQUEST["kim"],"hard");
$kullaniciAdi = $kim;
karmaUpdate();

echo "<b>$kim:</b>"; 
echo "<pre>";
echo "oy verme oranı: " . htmlspecialchars($oy_verme_orani) . "\n";
echo "oy alma oranı: " . htmlspecialchars($oy_alma_orani) . "\n";
echo "kactop (Onaylı Entry): " . htmlspecialchars($kactop) . "\n";
echo "arti (Artı Oy): " . htmlspecialchars($arti) . "\n";
echo "eksi (Eksi Oy): " . htmlspecialchars($eksi) . "\n";
echo "verarti (Verilen Artı Oy): " . htmlspecialchars($verarti) . "\n";
echo "anonim entry sayisi:" . $anonimsayi . "\n";
echo "saysil (moderasyonca Silinen Entry): " . htmlspecialchars($saysil) . "\n";
echo "saycaylak (Çaylak Cezası): " . htmlspecialchars($saycaylak) . "\n\n";

echo "HESAPLAMALAR:\n";
echo "karmak0 (Kalite Puanı): " . round($karmak0, 2) . "\n";
echo "karmak1 (Aktivite Puanı): " . round($karmak1, 2) . "\n";
echo "karmak2 (Topluluk Katkısı): " . round($karmak2, 2) . "\n";
echo "deneyim_bonus: " . round($deneyim_bonus, 2) . "\n";
echo "kalite oranı: " . round($kalite_orani, 2) . "\n";
echo "kpi (Kalite Çarpanı): " . round($kpi, 2) . "\n";
echo "karmaneg (Silinen Ceza): " . round($karmaneg, 2) . "\n";
echo "caylak_ceza: " . round($caylak_ceza, 2) . "\n";
echo "anonimlik cezasi:" . $anonimceza . "\n";

echo "SONUÇ:\n";
echo "Karma Puanı: " . $karma . "\n";
echo "</pre>";

?>
