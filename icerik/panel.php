</head>

<style>
.butx {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}


</style>

<body class="bodyMainFrame">

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


<?

getPrivateMessages();


$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

${"s_".$yuklenecekSayfaSub} =  'class="" id="menu"' ;
?>
<div id="controlPanel">
<table cellSpacing=0 cellPadding=0 width="100%">
<tr>




<?

include "mobframe.php";


?>

    <td>
    <table cellSpacing=0 cellPadding=0 width="100%"><tr>


        <td class="tab" <? echo $s_onlines; ?>><div><a href="sozluk.php?process=panel&islem=onlines">olan biten</a></div></td>        
        <? if (($kullaniciAdi) && ($isMobile ==0)) { ?>
        <td class="tab" <? echo $s_msjana; ?>><div><a href="sozluk.php?process=panel&islem=msjana">mesajlar</a></div></td>
        <? } ?>
        <td class="tab" <? echo $s_arkadaslarim; ?>><div><a href="sozluk.php?process=panel&islem=arkadaslarim">ilişkiler</a></div></td>
        <td class="tab" <? echo $s_cp; ?>><div><a href="sozluk.php?process=panel&islem=cp">çöp / ayarlar</a></div></td>
        <td class="tab" <? echo $s_gorunum; ?>><div><a href="sozluk.php?process=panel&islem=gorunum">temalar</a></div></td>
        <td class="tab" <? echo $s_system; ?>><div><a href="sozluk.php?process=panel&islem=system">bol malzeme</a></div></td>
        <td class="tab" <? echo $s_vol8; ?>><div><a href="sozluk.php?process=privmsg&islem=yenimsj&gkime=lord%20voldemort&gkonu=bol%20vol%2011">vol 11'e katıl</a></div></td>
       <!-- <td class="tab" <? echo $s_system; ?>><div><a href="sozluk.php?process=panel&islem=modlog">modlog</a></div></td> -->
        <? if ($kulYetki == "admin" or $kulYetki == "mod") { ?>
        <td class="tab" <? echo $s_modlog; ?>><div><a href="sozluk.php?process=panel&islem=modlog">modlog</a></div></td>
        <td class="tab" <? echo $s_oylog; ?>><div><a href="sozluk.php?process=panel&islem=oylog">oylog</a></div></td>
        <td class="tab" <? echo $s_okurlar; ?>><div><a href="sozluk.php?process=adm&islem=okurlar">yönetim</a></div></td>


        <? if (($kullaniciAdi) && ($isMobile ==0)) { ?>


        <? } ?>
        <? } ?>
        <td class="tab" style="width: 100%"></td>
    </tr></table>
</td></tr>
<tr><td class="tabin">
	<table cellSpacing=0 cellPadding=0 width="100%"><tr><td>
    <? if (file_exists("icerik/$yuklenecekSayfaSub.php")) include "icerik/$yuklenecekSayfaSub.php"; ?>
    </td></tr></table>
</td></tr>
</table>
</div>
<? if($notice)echo "<script>alert('$notice okunmayan mesajınız var.');</script>"; ?>
</body>