<?php
session_start();
?>
<LINK href="inc/<?php echo $aktiftema; ?>.css" type="text/css" rel="stylesheet">
<SCRIPT src="inc/new.js" type="text/javascript"></SCRIPT>
<?php

// Yetki kontrolü (session başlamış olmalı)
if (!isset($_SESSION['kulYetki_S']) || ($_SESSION['kulYetki_S'] !== 'admin' && $_SESSION['kulYetki_S'] !== 'mod')) {
    $user = isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : 'Unknown';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    error_log("Yetkisiz erişim girişimi: " . $user . " - IP: " . $ip);
    header("Location: /sozluk.php?process=refresh");
    die;
}

$bid = guvenlikKontrol(isset($_REQUEST["bid"]) ? $_REQUEST["bid"] : '', "hard");
$a = guvenlikKontrol(isset($_REQUEST["a"]) ? $_REQUEST["a"] : '', "hard");
$ybaslik = guvenlikKontrol(isset($_REQUEST["ybaslik"]) ? $_REQUEST["ybaslik"] : '', "hard");
$baslik = guvenlikKontrol(isset($_REQUEST["baslik"]) ? $_REQUEST["baslik"] : '', "hard");
$sebep = guvenlikKontrol(isset($_REQUEST["sebep"]) ? $_REQUEST["sebep"] : '', "hard");

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");
$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

// NOT: mysql_real_escape_string kullanımı için veritabanı bağlantısının daha önce açılmış olması gerekir.

if ($bid && $a) {

    $a_esc = mysql_real_escape_string($a);
    $bid_esc = mysql_real_escape_string($bid);
    $sorgu = "UPDATE mesajlar SET `istekhatti` = '" . $a_esc . "' WHERE id='" . $bid_esc . "'";
    $res = mysql_query($sorgu);
    if (!$res) {
        error_log("MySQL Hatası (UPDATE mesajlar): " . mysql_error() . " -- Query: " . $sorgu);
    }

    echo htmlspecialchars($a, ENT_QUOTES, 'UTF-8');
    echo htmlspecialchars($bid, ENT_QUOTES, 'UTF-8');
    echo "<br><center><b>istek bilgisi kaydedildi.</b></center>";
}

if ($a == 1 || $a == 2 || $a == 3 || $a == 4)
{
    $bid_esc = mysql_real_escape_string($bid);
    $select_q = "SELECT * FROM mesajlar WHERE id = '" . $bid_esc . "' ORDER BY id desc limit 0,1";
    $select_res = mysql_query($select_q);
    if (!$select_res) {
        error_log("MySQL Hatası (SELECT mesajlar): " . mysql_error() . " -- Query: " . $select_q);
    } else {
        $listele1 = mysql_fetch_array($select_res);
        $yazar = isset($listele1["yazar"]) ? $listele1["yazar"] : '';

        $kime = mysql_real_escape_string($yazar);
        $konu = mysql_real_escape_string($bid . ' nolu talebiniz');
        $gonderen = mysql_real_escape_string(isset($_SESSION['kullaniciAdi_S']) ? $_SESSION['kullaniciAdi_S'] : '');
        $mesaj = "sözlükle ilgili istekler başlığında yer alan <a href=/sozluk.php?process=eid&eid=" . intval($bid) . " target=\"_blank\"><font face=verdana size=1>#" . intval($bid) . "</font></a>";

        $xsorgu = "INSERT INTO privmsg ";
        $xsorgu .= "(kime,konu,mesaj,gonderen,tarih,okundu,gun,ay,yil,saat)";
        $xsorgu .= " VALUES ";
        $xsorgu .= "('" . $kime . "','" . $konu . "','" . mysql_real_escape_string($mesaj) . "','" . $gonderen . "','" . mysql_real_escape_string($tarih) . "','0','" . mysql_real_escape_string($gun) . "','" . mysql_real_escape_string($ay) . "','" . mysql_real_escape_string($yil) . "','" . mysql_real_escape_string($saat) . "')";
        $ins = mysql_query($xsorgu);
        if (!$ins) {
            error_log("MySQL Hatası (INSERT privmsg): " . mysql_error() . " -- Query: " . $xsorgu);
        }
    }
}

?>
