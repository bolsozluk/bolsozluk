<?php

$aylikentry = mysql_result(mysql_query("SELECT aylikentry FROM user WHERE nick='$kullaniciAdi'"), 0);
if ($kullaniciAdi == "") $aylikentry = 0;

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
?>
<style>  
  #adblock-warning {
  position:fixed; bottom:15px; left:15px; right:15px;
  box-shadow:0 0 10px rgba(0,0,0,0.1);
  text-align:center;
  z-index:9999;
}  
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
    letter-spacing: 0;
    word-spacing: 0;
    line-height: 1.2;
}
.footer-links a {
    color: #006699;
    text-decoration: none;
    margin: 0 2px;
    padding: 0;
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
@media (max-width: 600px) {
    .footer {
        font-size: 9px;
    }
    .footer-links {
        font-size: 9px;
    }
    .footer-links a {
        margin: 0 1px;
        font-size: 9px;
    }
    .footer-info {
        font-size: 8.5px;
    }
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
        bol'da yer alan içeriğin doğru veya güncel olduğu hiçbir şekilde iddia veya garanti edilmemektedir. burada okuduklarınız sizi dehşete düşürürse türkçe rap ansiklopedisine de göz atmayı deneyebilirsiniz.<?php if (!$isMobile) echo "<br>"; ?>
        hukuka aykırı olabileceğini düşündüğünüz içerikler titizlikle incelenip gereği düşünülmektedir. reklamsız görüntülemek isterseniz sözlüğe hemen kaydolup entry girmeye başlayabilirsiniz. soğuk içiniz. (2014-2026)
    </div>
</div>

<?php
if (($kullaniciAdi == "") || ($aylikentry < 1)) {
?>

<div id="adblock-warning" style="display:none; background:#fff3cd; color:#856404; border:1px solid #ffeeba; padding:10px; margin:10px; border-radius:6px;">
  🙏 Merhaba! Görünüşe göre bir reklam engelleyici kullanıyorsun.<br>
  Reklamlar sitemizin yaşaması için önemli. Lütfen bu siteyi beyaz listeye eklemeyi düşün. 💛
</div>

<script>
// "reklam yemi" oluştur
var ad = document.createElement('div');
ad.className = 'ads banner ad-unit ad'; // adblock genelde bunu gizler
ad.style.display = 'none';
document.body.appendChild(ad);

// 100ms sonra görünürlük kontrol et
setTimeout(function() {
  if (ad.offsetParent === null || ad.offsetHeight === 0) {
    document.getElementById('adblock-warning').style.display = 'block';
  }
}, 100);
</script>

<?php
}
?>
