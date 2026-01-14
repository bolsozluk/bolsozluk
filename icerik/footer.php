<?php
// PHP 5.4 uyumlu sorgu yapısı
$sorgu = mysql_query("SELECT aylikentry FROM user WHERE nick='$kullaniciAdi'");
$aylikentry = 0;
if ($sorgu && mysql_num_rows($sorgu) > 0) {
    $aylikentry = mysql_result($sorgu, 0);
}

if ($kullaniciAdi == "") { $aylikentry = 0; }
$entryBaraji = 1;
$pasifyazar = ($aylikentry < $entryBaraji);

$isMobile = (bool)preg_match(
    '#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
    '|s(ymbian|eries60|amsung)|p(laybook|alm|proﬁle/midp|laystation portable)|nokia|fennec|htc[\-_]'.
    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i',
    $_SERVER['HTTP_USER_AGENT']
);
?>

<style>
/* Footer Stilleri */
.footer { text-align: center; font-size: <?php echo $isMobile ? '11px' : '14px'; ?>; margin-top: 20px; color: #555; }
.footer-links { text-align: center; font-size: inherit; line-height: 1.2; }
.footer-links a { color: #006699; text-decoration: none; margin: 0 2px; font-size: inherit; }
.footer-info { font-size: 11px; margin-top: 8px; color: #888; }

/* Noticebar Stili */
#noticebar {
    position: fixed; left: 0; right: 0; top: 0; z-index: 99999;
    background: #fffbe6; color:#444; border-bottom:1px solid #e9dfb3;
    padding: 14px; text-align:center;
    font: 14px system-ui, sans-serif;
    display: none; /* Başlangıçta gizli */
}
#noticebar.visible { display: block; transform: translateY(0); animation: slideDown 0.3s ease-out; }

@keyframes slideDown {
    from { transform: translateY(-100%); }
    to { transform: translateY(0); }
}

@media (max-width: 600px) {
    .footer, .footer-links a, .footer-info { font-size: 9px; }
}
</style>

<div class="footer">
    <div class="footer-links">
        <a href="https://chat.bolsozluk.com" target="_blank">chat</a> |
        <a href="https://www.youtube.com/BolSozluk" target="_blank">youtube</a> |
        <a href="https://open.spotify.com/artist/6cbqsKLbEyJZ7LhiuIqe7z" target="_blank">spotify</a> |
        <a href="https://anket.bolsozluk.com" target="_blank">anket</a> |
        <a href="https://www.bolsozluk.com/raple" target="_blank">raple</a> |
        <a href="https://github.com/bolsozluk/" target="_blank">source</a> |
        <a href="/sozlesme.html" target="_blank">uyarı</a> |
        <a href="/devlog.txt" target="_blank">devlog</a>
    </div>
    <div class="footer-info">
        bol'da yer alan içeriğin edilmemektedir. burada okuduklarınız sizi dehşete düşürürse türkçe rap ansiklopedisine de göz atmayı deneyebilirsiniz.<?php if (!$isMobile) echo "<br>"; ?>
        hukuka aykırı olabileceğini düşündüğünüz içerikler titizlikle incelenip gereği düşünülmektedir. reklamsız görüntülemek isterseniz sözlüğe hemen kaydolup entry girmeye başlayabilirsiniz. soğuk içiniz. (2014-2026)
    </div>
</div>

<?php if (($kullaniciAdi == "") || ($pasifyazar)) { ?>
<div id="tester-wrap" class="ads ad-zone ads-container" style="position:absolute; left:-9999px; width:1px; height:1px;">&nbsp;</div>

<script>
(function(){
    function checkAdBlock() {
        var tester = document.getElementById('tester-wrap');
        
        // 1. Durum: Eğer eleman DOM'dan silinmişse (Bazı engelleyiciler siler)
        // 2. Durum: Eğer yüksekliği 0'a çekilmişse (En yaygın engelleme yöntemi)
        // 3. Durum: Eğer display: none yapılmışsa
        if (!tester || tester.offsetParent === null || tester.offsetHeight === 0) {
            showNotice();
        }
    }

    function showNotice() {
        // Eğer zaten eklenmediyse barı ekle
        if(!document.getElementById("noticebar")) {
            document.body.insertAdjacentHTML("afterbegin", '<div id="noticebar">Reklam engelleyici aktif görünüyor. Lütfen BOL\'u desteklemek için devre dışı bırakın. 💛</div>');
            setTimeout(function(){
                document.getElementById("noticebar").classList.add("visible");
            }, 100);
        }
    }

    // Sayfa tamamen yüklendikten sonra kontrol et (biraz gecikmeli)
    if (window.onload) {
        var cur = window.onload;
        window.onload = function() { cur(); setTimeout(checkAdBlock, 500); };
    } else {
        window.onload = function() { setTimeout(checkAdBlock, 500); };
    }
})();
</script>
<?php } ?>
