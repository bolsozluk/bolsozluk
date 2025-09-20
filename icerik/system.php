<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Bol Sözlük</title>
    <meta charset="windows-1254">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="favicon.ico" rel="shortcut Icon">
    <link href="images/nostalcik.css" type="text/css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .column {
            display: flex;
            flex-direction: column;
            gap: 15px;
            min-width: 300px;
        }
        .item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .item-icon {
            width: 88px;
            height: 31px;
            object-fit: contain;
        }
        .item-info {
            display: flex;
            flex-direction: column;
        }
        .status-icon {
            width: 32px;
            height: 12px;
            margin-right: 5px;
        }
        .item-info a {
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .item-info span {
            font-size: 0.9em;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8em;
            color: #999;
        }
        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: stretch;
            }
            .column {
                min-width: unset;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <script src="images/top.js"></script>
    <script src="inc/sozluk.js"></script>
    <script src="inc/vsozluk.js"></script>

    <div class="container">
        <div class="column">
            <div class="item">
                <img class="item-icon" src="images/entryizle.png" alt="Entryler">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="#" onclick="window.open('/sozluk.php?process=entryliste&kimdirbu=<?php echo htmlspecialchars($kullaniciAdi); ?>','yenientry','width=800,height=600,navbar=0,scrollbars=1');">entryler</a>
                    <span>bol bol yazdıkların</span>
                </div>
            </div>

            <div class="item">
                <img class="item-icon" src="images/tanik.jpg" alt="Tanık Koruma Programı">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="/sozluk.php?process=nickdegis">t'anık k'oruma p'rogramı</a>
                    <span>izini kaybettirmek için ideal</span>
                </div>
            </div>

            <div class="item">
                <img class="item-icon" src="images/radyo.png" alt="Çalbendinlerim">
                <div class="item-info">
                    <img class="status-icon" src="images/offline.png" alt="offline">
                    <a href="http://www.plug.dj/çalbendinlerim" target="_blank">çalbendinlerim</a>
                    <span>yeniden/yenisi açılana dek kapalı</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="images/gelen.jpg" alt="Mesaj (Gelen)">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="/sozluk.php?process=mesajyedek">mesaj (gelen) yedek</a>
                    <span>yedeklemekten hoşlananlara</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="images/leak.jpg" alt="Yoleaks">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="/yoleaks/index.php">yoleaks</a>
                    <span>yoleaks'ten sızar koku araştırın soruşturun</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="https://cdn-icons-png.freepik.com/512/5962/5962463.png" alt="Bolchat">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="sozluk.php?process=bolchat">bolchat</a>
                    <span>underground'ta kim var diye her gece düşünülen yer</span>
                </div>
            </div>
            
        </div>

        <div class="column">
            <div class="item">
                <img class="item-icon" src="images/dara.png" alt="Detaylı Ara">
                <div class="item-info">
                    <img class="status-icon" src="images/offline.png" alt="offline">
                    <a href="#" onclick="window.open('/sozluk.php?process=dasearch&dsearch=resolve','yenientry','width=230,height=230,navbar=0,scrollbars=1');">detaylı ara</a>
                    <span>henüz hazır değil</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="images/saladin.gif" alt="Selahaddin Eyyubi">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="http://tr.wikipedia.org/wiki/Selahaddin_Eyyubi" target="_blank">selahaddin eyyubi</a>
                    <span>tarihteki üç büyük selahaddin'den en büyüğü</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="images/eyedek.jpg" alt="Entry Yedek">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="/sozluk.php?process=entryyedek">entry yedek</a>
                    <span>yedeklemekten hoşlananlara</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="images/gelen.jpg" alt="Mesaj (Giden)">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="sozluk.php?process=mesajyedek&tip=giden">mesaj (giden) yedek</a>
                    <span>yedeklemekten hoşlananlara</span>
                </div>
            </div>
            
            <div class="item">
                <img class="item-icon" src="https://cdn4.iconfinder.com/data/icons/clipboards/32/file-document-clipboard-survey-512.png" alt="Bol Anket">
                <div class="item-info">
                    <img class="status-icon" src="images/online.png" alt="online">
                    <a href="http://anket.bolsozluk.com">bol anket</a>
                    <span>milli iradenin buluşma noktası</span>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="footer">
        <small><span>Bir <b>Bol Sözlük</b> hizmetidir.</span></small><br>
        <small><span>copyleft&nbsp;©&nbsp;2014&nbsp;-&nbsp;&infin;&nbsp;</span></small>
    </div>

</body>
</html>
