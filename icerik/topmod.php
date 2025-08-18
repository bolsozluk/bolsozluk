<?
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
?>

<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>

<style>
.but {font-size: 12px}
</style>


<?
if($isMobile == 1)
{ 
?>              
<style type="text/css">
table {
    table-layout:fixed;
}

table td {
    overflow:hidden;
}
</style>
<?
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?

$sorgu = "SELECT * FROM konular WHERE `editlendi` = '1' ORDER BY `sira` DESC LIMIT 100";
$sorgulama = @mysql_query($sorgu);

$sorgu2 = "SELECT * FROM user WHERE `durum` = 'sus' ORDER BY `siltarih` desc LIMIT 750";
$sorgulama2 = @mysql_query($sorgu2); 
echo "<br>";
echo "<input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog';\" value='silinen entryler' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog2';\" value='banlog' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=modlog3';\" value='editlog' class='but'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=topmod';\" value='moderasyon gücü' class='but'>";
echo "<br>";
echo "<br>";

echo "yapım aşamasında...";

echo "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- bolsözlük-3 -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:728px;height:90px\"
     data-ad-client=\"ca-pub-7994669731946359\"
     data-ad-slot=\"7236998758\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

";
?>
