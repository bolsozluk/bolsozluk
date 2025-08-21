<?
$sql = "
    SELECT ip, GROUP_CONCAT(DISTINCT yazar) AS yazarlar, COUNT(DISTINCT yazar) AS yazar_sayisi
    FROM iptables
    WHERE yazar != 'admin'
    GROUP BY ip
    HAVING yazar_sayisi > 1
    ORDER BY INET_ATON(ip) ASC
";

$result = $mysqli->query($sql);

// Sonuçları ekrana yazdır
if ($result->num_rows > 0) {
    echo $result->num_rows . " işlem incelendi.<br><br>";
    while ($row = $result->fetch_assoc()) {
        $ip = $row['ip'];
        $yazarlar = $row['yazarlar'];
        echo "<b>$yazarlar</b> birbirinin feyki olabilir. <a href='http://whatismyipaddress.com/ip/$ip' target='_blank'>$ip</a><br>";
    }
} else {
    echo "Şüpheli IP bulunamadı.";
}
?>
