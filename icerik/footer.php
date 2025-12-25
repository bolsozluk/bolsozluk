<?php

$aylikentry = mysql_result(mysql_query("SELECT aylikentry FROM user WHERE nick='$kullaniciAdi'"), 0);
if ($kullaniciAdi == "") $aylikentry = 0;
$entryBaraji = 1; 
$pasifyazar = ($aylikentry < $entryBaraji);

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

<?
if (($kullaniciAdi == "") || ($pasifyazar))
{
?>


<style>
  /* Neutral names: no "ad/ads" */
  #noticebar {
    position: fixed; left: 0; right: 0; top: 0; z-index: 9999;
    background: #fffbe6; color: #3d3d3d; border-bottom: 1px solid #f0e6b3;
    box-shadow: 0 2px 10px rgba(0,0,0,.06);
    font: 14px/1.45 system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
    transform: translateY(-100%); transition: transform .25s ease;
  }
  #noticebar.is-visible { transform: translateY(0); }
  .nb-wrap { max-width:1100px; margin:0 auto; padding:10px 16px; display:grid; grid-template-columns:1fr auto; gap:12px; align-items:center; }
  .nb-actions { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .nb-btn { appearance:none; border:1px solid #cfcfcf; background:#fff; color:#333; padding:6px 12px; border-radius:10px; cursor:pointer; }
  .nb-btn:hover { background:#fafafa; }
  #nb-details { display:none; border-top:1px solid #f0e6b3; padding:10px 16px 14px; }
  #nb-details.is-open { display:block; }
  #nb-details .cols { display:grid; gap:12px; grid-template-columns:repeat(auto-fit, minmax(240px,1fr)); margin-top:8px; }
  #nb-details h4 { margin:8px 0 6px; font-size:13px; }
</style>

<script>
(function(){
  // FORCE SHOW for render test. Set to false after you confirm it shows.
  const FORCE_SHOW = true;

  const TEXTS = {
    title: "🙏 Merhaba!",
    body:  "Reklam engelleyici kullanıyor olabilirsiniz. <br> BOL'u seviyorsanız bizi beyaz listeye almanızı rica ederiz.",
    learn: "Nasıl beyaz listeye eklerim?",
    close: "Kapat",
    foot:  "Reklamlar sözlüğümüzün yaşaması için önemli. 💛"
  };

  const HOWTO = [
    { name: "uBlock Origin", steps: ["Kalkan simgesine tıklayın.","“Bu site için” anahtarını kapatın.","Sayfayı yenileyin."] },
    { name: "Adblock / ABP", steps: ["Eklenti simgesine tıklayın.","“Bu sitede etkin değil” deyin.","Sayfayı yenileyin."] },
    { name: "Brave", steps: ["Aslan simgesine tıklayın.","Bu site için kalkanları kapatın.","Sayfayı yenileyin."] }
  ];

  function build(){
    if (document.getElementById('noticebar')) return;
    const bar = document.createElement('section');
    bar.id = 'noticebar';
    bar.setAttribute('role','region');
    bar.setAttribute('aria-label','Bilgilendirme');
    bar.innerHTML = `
      <div class="nb-wrap">
        <div><b>${TEXTS.title}</b> ${TEXTS.body} <span style="opacity:.8;font-size:12px"> ${TEXTS.foot}</span></div>
        <div class="nb-actions">
          <button type="button" id="nb-learn" class="nb-btn" aria-expanded="false" aria-controls="nb-details">${TEXTS.learn}</button>
          <button type="button" id="nb-close" class="nb-btn" aria-label="${TEXTS.close}">${TEXTS.close}</button>
        </div>
      </div>
      <div id="nb-details" aria-hidden="true">
        <div class="cols">
          ${HOWTO.map(b=>`<div><h4>${b.name}</h4><ol>${b.steps.map(s=>`<li>${s}</li>`).join('')}</ol></div>`).join('')}
        </div>
      </div>`;
    document.body.appendChild(bar);
    if (!document.body.style.scrollMarginTop) document.body.style.scrollMarginTop = "56px";
    const details = bar.querySelector('#nb-details');
    bar.querySelector('#nb-learn').onclick = ()=>{
      const open = details.classList.toggle('is-open');
      details.setAttribute('aria-hidden', String(!open));
      bar.querySelector('#nb-learn').setAttribute('aria-expanded', String(open));
    };
    bar.querySelector('#nb-close').onclick = ()=> bar.remove();
    requestAnimationFrame(()=> bar.classList.add('is-visible'));
  }

  function run(){
    if (FORCE_SHOW) { build(); return; }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', run, {once:true});
  } else { run(); }

  // Console helper to force again later:
  window.__nb_force = build;
})();
</script>

<? } ?>
