<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-9">
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

// Kullanıcı varsa kontrol et
$id = 0;
$sorgu = "SELECT nick, id FROM user WHERE nick='$nick'";
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

// Update işlemleri
if ($id == 0 && $nick && $ayb == 146) {
    echo "değiştiriliyor<br>"; 

    mysql_query("UPDATE mesajlar SET yazar='$nick' WHERE yazar='$eskinick'");
    mysql_query("UPDATE oylar SET nick='$nick' WHERE nick='$eskinick'");
    mysql_query("UPDATE oylar SET entry_sahibi='$nick' WHERE entry_sahibi='$eskinick'");
    mysql_query("UPDATE privmsg SET gonderen='$nick' WHERE gonderen='$eskinick'");
    mysql_query("UPDATE privmsg SET kime='$nick' WHERE kime='$eskinick'");
    mysql_query("UPDATE rehber SET kim='$nick' WHERE kim='$eskinick'");
    mysql_query("UPDATE rehber SET kimin='$nick' WHERE kimin='$eskinick'");
    mysql_query("UPDATE user SET nick='$nick' WHERE nick='$eskinick'");
    mysql_query("UPDATE takip SET nick = REPLACE(nick, '$eskinick', '$nick')");

    $msg = "Nick başarıyla değiştirildi!";
    echo '<script type="text/javascript">alert("' . $msg . '"); window.location="https://www.bolsozluk.com/sozluk.php?process=adm"; </script>';
    exit;
}
?>

<form method="POST" action="admin_nickdegis.php">
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
