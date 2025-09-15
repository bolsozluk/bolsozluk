<? 

$kim = guvenlikKontrol($_REQUEST["kim"],"ultra");

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
$topluluk_carpani = 12;           // Düşürüldü (18 → 12)
$deneyim_bonus_carpani = 0.04;    // Düşürüldü (0.07 → 0.04)
$silinen_ceza = 5.0;              // Arttırıldı (1.2 → 5.0)
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
$sadakat_indirim = min($kactop * $sadakat_indirim_carpani, 100);

$karma = ($karmak0 + $karmak1 + $karmak2 + $deneyim_bonus) * $kpi;
$karma = $karma - $karmaneg - $caylak_ceza + $sadakat_indirim;
$karma = round($karma);


echo "<script>
    var message = '';
    message += 'kactop (Onaylı Entry): ' + " . json_encode($kactop) . " + '\\\\n';
    message += 'arti (Artı Oy): ' + " . json_encode($arti) . " + '\\\\n';
    message += 'eksi (Eksi Oy): ' + " . json_encode($eksi) . " + '\\\\n';
    message += 'verarti (Verilen Artı Oy): ' + " . json_encode($verarti) . " + '\\\\n';
    message += 'saysil (Silinen Entry): ' + " . json_encode($saysil) . " + '\\\\n';
    message += 'saycaylak (Çaylak Cezası): ' + " . json_encode($saycaylak) . " + '\\\\n\\\\n';
    
    message += 'HESAPLAMALAR:\\\\n';
    message += 'karmak0 (Kalite Puanı): ' + " . json_encode(round($karmak0, 2)) . " + '\\\\n';
    message += 'karmak1 (Aktivite Puanı): ' + " . json_encode(round($karmak1, 2)) . " + '\\\\n';
    message += 'karmak2 (Topluluk Katkısı): ' + " . json_encode(round($karmak2, 2)) . " + '\\\\n';
    message += 'deneyim_bonus: ' + " . json_encode(round($deneyim_bonus, 2)) . " + '\\\\n';
    message += 'kpi (Kalite Çarpanı): ' + " . json_encode(round($kpi, 2)) . " + '\\\\n';
    message += 'karmaneg (Silinen Ceza): ' + " . json_encode(round($karmaneg, 2)) . " + '\\\\n';
    message += 'caylak_ceza: ' + " . json_encode(round($caylak_ceza, 2)) . " + '\\\\n';
    message += 'sadakat_indirim: ' + " . json_encode(round($sadakat_indirim, 2)) . " + '\\\\n\\\\n';
    
    message += 'SONUÇ:\\\\n';
    message += 'Karma Puanı: ' + " . json_encode($karma) . " + '\\\\n';
    
    alert(message);
</script>";

?>
