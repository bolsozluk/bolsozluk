<?php
// PHP 5.4 uyumlu veritabanı sorgusu
$sorgu = mysql_query("SELECT aylikentry FROM user WHERE nick='$kullaniciAdi'");
$aylikentry = 0;
if ($sorgu && mysql_num_rows($sorgu) > 0) {
    $aylikentry = mysql_result($sorgu, 0);
}

if ($kullaniciAdi == "") { $aylikentry = 0; }
$entryBaraji = 1;
$pasifyazar = ($aylikentry < $entryBaraji);

$userAgent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = (bool)preg_match(
    '#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
    '|s(ymbian|eries60|amsung)|p(laybook|alm|proﬁle/midp|laystation portable)|nokia|fennec|htc[\-_]'.
    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i',
    $userAgent
);
?>

<style>
.footer {
    text-align: center;
    font-size: <?php echo $isMobile ? '11px' : '14px'; ?>;
    margin-top: 20px;
    color: #555;
}
.footer-links {
    text-align: center;
    font-size: inherit;
    margin: 0;
    padding: 0;
    line-height: 1.2;
}
.footer-links a {
    color: #006699;
    text-decoration: none;
    margin: 0 2px;
    white-space: nowrap;
    font-size: inherit;
}
.footer-links a:hover {
    text-decoration: underline;
}
.footer-info {
    font-size: 11px;
    margin-top: 8px;
    color: #888;
}
#noticebar {
    position: fixed; left: 0; right: 0; top: 0; z-index: 99999;
    background: #fffbe6; color:#444; border-bottom:1px solid #e9dfb3;
    padding: 14px; text-align:center;
    font: 14px system-ui, sans-serif;
    transform: translateY(-100%); transition: .25s;
}
#noticebar.visible { transform: translateY(0); }

@media (max-width: 600px) {
    .footer, .footer-links a, .footer-links, .footer-info { font-size: 9px; }
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
        bol'da yer alan içeriğin doğru veya güncel olduğu hiçbir şekilde iddia veya garanti edilmemektedir.
        hukuka aykırı olabileceğini düşündüğünüz içerikler titizlikle incelenmektedir.
        reklamsız görüntülemek isterseniz sözlüğe hemen kaydolup entry girmeye başlayabilirsiniz. (2014–2026)
    </div>
</div>

<?php if (($kullaniciAdi == "") || ($pasifyazar)) { ?>
<script>
(function(){
    // Varsayılan olarak engelleyici var kabul ediyoruz
    window.adBlockerCheck = true;

    // ads.js dosyasını yüklemeye çalışıyoruz
    var script = document.createElement('script');
    script.src = '/ads-test.js'; // Bu isim eklentiler tarafından otomatik engellenir
    script.type = 'text/javascript';
    
    // Yükleme başarısız olursa (Adblock engellerse)
    script.onerror = function() {
        showNotice();
    };

    // Yükleme başarılı olursa kontrol et
    script.onload = function() {
        if (window.adBlockerCheck === true) {
            showNotice();
        }
    };

    function showNotice() {
        document.body.insertAdjacentHTML("afterbegin", '<div id="noticebar">Reklam engelleyici kullanıyor gibisiniz. Lütfen BOL\'u desteklemek için devre dışı bırakın. 💛</div>');
        setTimeout(function(){
            var el = document.getElementById("noticebar");
            if(el) el.classList.add("visible");
        }, 500);
    }

    document.head.appendChild(script);
})();
</script>
<?php } ?>
