<?php

if (!isset($_SESSION['kulYetki_S']) || ($_SESSION['kulYetki_S'] !== 'admin' && $_SESSION['kulYetki_S'] !== 'mod')) {
    error_log("Yetkisiz erişim girişimi: " . ($_SESSION['kullaniciAdi_S'] ?? 'Unknown') . " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown'));
    header("Location: /sozluk.php?process=refresh");
    die;
}

$sql = "
    SELECT ip, GROUP_CONCAT(DISTINCT yazar) AS yazarlar, COUNT(DISTINCT yazar) AS yazar_sayisi
    FROM iptables
    WHERE yazar != 'admin'
    GROUP BY ip
    HAVING yazar_sayisi > 1
    ORDER BY INET_ATON(ip) ASC
";

$result = mysql_query($sql);

if (!$result) {
    die("Sorgu hatası: " . mysql_error());
}

// Satır sayısını kontrol et
$num_rows = mysql_num_rows($result);

if ($num_rows > 0) {
    echo $num_rows . " işlem incelendi.<br><br>";
    while ($row = mysql_fetch_assoc($result)) {
        $ip = $row['ip'];
        $yazarlar = $row['yazarlar'];
        echo "<b>$yazarlar</b> birbirinin feyki olabilir. <a href='http://whatismyipaddress.com/ip/$ip' target='_blank'>$ip</a><br>";
    }
} else {
    echo "Şüpheli IP bulunamadı.";
}
?>
