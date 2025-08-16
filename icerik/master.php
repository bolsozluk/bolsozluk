<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?
//<tr><td>Unutama Beni</td><td> : </td><td style="text-align:left;"><input name="remme" type="checkbox" id="remme"></td></tr>
$login = guvenlikKontrol($_REQUEST["login"],"hard");;

if ($kullaniciAdi) {
	header ("Location: sozluk.php?process=panel&islem=onlines");
}else if (!$login) {
	$sorgu1 = "SELECT hit FROM ayar";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2=mysql_fetch_array($sorgu2);
	$hit=$kayit2["hit"];
	$hit++;
	$sorgu = "UPDATE ayar SET hit='$hit'";
	mysql_query($sorgu);
	header ("Location: sozluk.php?process=rand");
} else {

    include "mobframe.php";
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <body>
    <div id="container">
        <form name="loginForm" method="post" action="sozluk.php?process=login">
        <table>
            <tr><td>Yazar Adı</td><td> : </td><td><input name="gnick" type="text" id="gnick"></td></tr>
            <tr><td>Şifre</td><td> : </td><td><input name="gsifre" type="password" id="gsifre"></td></tr>
            

            <tr><td colspan="2"></td><td class="submitButton"><input type="submit" name="Submit" class="but" value="Giriş"></td></tr>
        </table>
        <br />
        <b><a href="sozluk.php?process=reg1">[kayıt ol]</a></b>
        </form>
    </div>
    </body>
    </html>
<? } ?>