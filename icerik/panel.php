<?php
include "mobframe.php";

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet' .
                '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]' .
                '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);

getPrivateMessages();

${"s_".$yuklenecekSayfaSub} =  'class="" id="menu"' ;

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bol Panel</title>
<style>
.menu-row {
    display: flex;
    flex-wrap: wrap; 
    gap: 5px; /* butonlar arası boşluk */
    justify-content: flex-start; /* sola hizala */
    margin-bottom: 10px;
}

.menu-row .tab {
    flex: 0 1 auto; /* genişlik içeriğe göre */
    padding: 5px 10px;
    background: #242b3a;
    color: white;
    font-size: 12px;
    border-radius: 4px;
    border: 1px solid #3a4354;
    white-space: nowrap;
}

.menu-row .tab a { color:white; text-decoration:none; display:block; }

.menu-row .tab:hover { background: #3a4354; }

@media(max-width:768px) {
    .menu-row { justify-content: center; }
    .menu-row .tab { flex: 1 1 45%; } /* tablet: 2 sütun */
}

@media(max-width:480px) {
    .menu-row .tab { flex: 1 1 30%; } /* telefon: 3 sütun */
}
</style>
</head>
<body>

<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}

</script>

<div id="controlPanel">
    <div class="menu-row">
        <div class="tab"><a href="sozluk.php?process=panel&islem=onlines">olan biten</a></div>
        <?php if ($kullaniciAdi && !$isMobile) { ?>
            <div class="tab"><a href="sozluk.php?process=panel&islem=msjana">mesajlar</a></div>
        <?php } ?>
        <div class="tab"><a href="sozluk.php?process=panel&islem=arkadaslarim">ilişkiler</a></div>
        <div class="tab"><a href="sozluk.php?process=panel&islem=cp">çöp / ayarlar</a></div>
        <div class="tab"><a href="sozluk.php?process=panel&islem=gorunum">temalar</a></div>
        <div class="tab"><a href="sozluk.php?process=panel&islem=system">bol malzeme</a></div>
        <div class="tab"><a href="sozluk.php?process=privmsg&islem=yenimsj&gkime=lord%20voldemort&gkonu=bol%20vol%2011">vol 11'e katıl</a></div>
        <?php if ($kulYetki=="admin" || $kulYetki=="mod") { ?>
            <div class="tab"><a href="sozluk.php?process=panel&islem=modlog">modlog</a></div>
            <div class="tab"><a href="sozluk.php?process=panel&islem=oylog">oylog</a></div>
            <div class="tab"><a href="sozluk.php?process=adm&islem=okurlar">yönetim</a></div>
        <?php } ?>
    </div>
</div>


        <?php 
        if(file_exists("icerik/$yuklenecekSayfaSub.php")) 
            include "icerik/$yuklenecekSayfaSub.php"; 
        ?>

<?php if($notice) echo "<script>alert('$notice okunmayan mesajınız var.');</script>"; ?>
</body>
</html>
