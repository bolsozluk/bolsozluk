<?
session_start();
include "icerik/baglan.php";
vtBaglan();
echo "
        <SCRIPT language=javascript src=\"inc/sozluk.js\"></SCRIPT>
<LINK href=\"inc/default.css\" type=text/css rel=stylesheet>
Sözlük boya/cila için bakıma çekildi.Lütfen daha sonra tekrar deneyiniz.
";
session_destroy();
?>