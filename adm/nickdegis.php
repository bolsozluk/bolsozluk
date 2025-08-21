<SCRIPT src="inc/sozluk.js" type="text/javascript"></SCRIPT>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
// Formdan gelen değerler
$eskinick = isset($_REQUEST['eskisi']) ? trim($_REQUEST['eskisi']) : '';
$nick     = isset($_REQUEST['nick'])   ? trim($_REQUEST['nick'])   : '';
$ayb      = isset($_REQUEST['ayb'])    ? (int)$_REQUEST['ayb']     : 0;

// Eskisi ve yeni nick kontrolleri
if ($ayb != 146) {
    $ayb = 0;
}

if ($ayb == 146 && !preg_match("/^[' A-Za-z0-9]+$/", $nick)) {
    echo "Yeni nickte sadece küçük ve İngilizce harfler, boşluk ve rakam bulunabilir.<br>";
    exit;
}

if ($nick == "" && $ayb == 146) {
    echo "Yeni nick boş olamaz!<br>";
    exit;
}

if ($eskinick == "" && $ayb == 146) {
    echo "Eski nick boş olamaz! Lütfen değiştirmek istediğiniz nicki yazın.<br>";
    exit;
}

// Kullanıcı varsa kontrol et
$id = 0;
$sorgu = "SELECT nick, id FROM user WHERE nick='" . mysql_real_escape_string($nick) . "'";
$sorgulama = mysql_query($sorgu);
$nick = strtolower($nick);

if (mysql_num_rows($sorgulama) > 0) {
    while ($kayit = mysql_fetch_array($sorgulama)) {
        if ($kayit['id'] > 0) {
            $id = $kayit['id'];
        }
        if ($id > 0) {
            echo "...kontenjan yetersiz<br>";
            exit;
        }
    }
}

// Update işlemleri (önceki SQL mantığını koruyoruz)
if ($id == 0 && $nick && $ayb == 146) {
    echo "değiştiriliyor<br>"; 

    $sql1 = "UPDATE mesajlar SET yazar='" . mysql_real_escape_string($nick) . "' WHERE yazar='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql1) or die("Hata: " . mysql_error());

    $sql2 = "UPDATE oylar SET nick='" . mysql_real_escape_string($nick) . "' WHERE nick='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql2) or die("Hata: " . mysql_error());

    $sql3 = "UPDATE oylar SET entry_sahibi='" . mysql_real_escape_string($nick) . "' WHERE entry_sahibi='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql3) or die("Hata: " . mysql_error());

    $sql4 = "UPDATE privmsg SET gonderen='" . mysql_real_escape_string($nick) . "' WHERE gonderen='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql4) or die("Hata: " . mysql_error());

    $sql5 = "UPDATE privmsg SET kime='" . mysql_real_escape_string($nick) . "' WHERE kime='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql5) or die("Hata: " . mysql_error());

    $sql6 = "UPDATE rehber SET kim='" . mysql_real_escape_string($nick) . "' WHERE kim='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql6) or die("Hata: " . mysql_error());

    $sql7 = "UPDATE rehber SET kimin='" . mysql_real_escape_string($nick) . "' WHERE kimin='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql7) or die("Hata: " . mysql_error());

    $sql8 = "UPDATE user SET nick='" . mysql_real_escape_string($nick) . "' WHERE nick='" . mysql_real_escape_string($eskinick) . "'";
    mysql_query($sql8) or die("Hata: " . mysql_error());

    $sql9 = "UPDATE takip SET nick = REPLACE(nick, '" . mysql_real_escape_string($eskinick) . "', '" . mysql_real_escape_string($nick) . "')";
    mysql_query($sql9) or die("Hata: " . mysql_error());

    $msg = "Nick başarıyla değiştirildi!";
    echo '<script type="text/javascript">alert("' . utf8_encode($msg) . '"); window.location="https://www.bolsozluk.com/sozluk.php?process=adm";</script>';
    exit;
}
?>

<form method="POST" action="https://www.bolsozluk.com/sozluk.php?process=adm&islem=nickdegis">
<table cellpadding="10px" border="0">
<tr>
<td align="right">eskisi (değiştirilecek nick): </td>
<td>
    <div align="left">
        <input name="eskisi" size="30" type="text" value="<?php echo htmlspecialchars($eskinick); ?>">
    </div>
</td>
</tr>
<tr>
<td align="right">yenisi: </td>
<td>
    <div align="left">
        <input name="nick" size="30" type="text">
    </div>
</td>
</tr>
<tr>
<td align="right">sayıyla 145+1: </td>
<td>
    <div align="left">
        <input name="ayb" size="30" type="text" value="146">
    </div>
</td>
</tr>
<tr>
<td colspan="2" align="">
<input class="but" value="değiştir" name="send" type="submit">
</td>
</tr>
</table>
</form>
