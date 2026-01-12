<?php
session_start();

// navigateSearch fonksiyonunu tanımla
function navigateSearch($q, $currentPage, $totalPage){
    if ($currentPage > 1) {
        $pageLink = $currentPage - 1;
        echo "<a class='but' href='sozluk.php?process=search&q=".urlencode($q)."&sayfa=".$pageLink."'><<</a>";
    }
    
    echo "<select class='pagis' onchange=\"jm('self',this,0);\" name='sayfa'>";
    
    for ($i = 1; $i <= $totalPage; $i++) {
        $selected = ($currentPage == $i) ? "selected" : "";
        echo "<option value='sozluk.php?process=search&q=".urlencode($q)."&sayfa=".$i."' $selected>$i</option>";
    }
    
    echo "</select> / $totalPage ";
    
    $pageLink = $currentPage + 1;
    if ($pageLink <= $totalPage) {
        echo "<a class='but' href='sozluk.php?process=search&q=".urlencode($q)."&sayfa=".$pageLink."'>>></a>";
    }
}

function strtrlower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}

$sonuc ="";
$flag ="";

$q = isset($_REQUEST["q"]) ? guvenlikKontrol($_REQUEST["q"],"hard") : '';

// 3 HARFTEN AZ KONTROLÜ - SADECE BURAYI EKLE
if ($q && strlen($q) < 3) {
    $q = ''; // q'yu boşalt ki normal arama formu gözüksün
    $flag ="1";
}




// SAYFALAMA DEĞİŞKENLERİ
$currentPage = isset($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
if ($currentPage < 1) $currentPage = 1;
$limitFrom = ($currentPage - 1) * $maxTopicPage;

?>


<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}
function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}

// left.php'deki jm fonksiyonunu kopyala
function jm(target, obj, flag){
    if (flag==0) {
        if (target=='self') {
            location.href=obj.options[obj.selectedIndex].value;
        }
        if (target=='main') {
            parent.main.location.href=obj.options[obj.selectedIndex].value;
        }
        if (target=='top') {
            parent.location.href=obj.options[obj.selectedIndex].value;
        }
    }
    if (flag==1) {
        if (target=='self') {
            location.href=obj.value;
        }
        if (target=='main') {
            parent.main.location.href=obj.value;
        }
        if (target=='top') {
            parent.location.href=obj.value;
        }
    }
}
</script>

<?php
if ($q) {
    $string=$_GET['q'];

    if (!$q) {
        echo "<div class=dash><center><b><img src=img/unlem.gif> Müneccim miyim ben ?";
        die;
    }

    $isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                        '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                        '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
    
    // left.php'deki arama formunu kopyala
    $aramobile = "<center> <b> </b>başlık <input maxLength=55 class=\"input\" style=\"height:12px\" onkeyup=\"araFocus()\" accesskey=\"b\" id=\"q\" name=\"q\" size=\"25\"  placeholder=\"aramaya inanın\"> <input type='button' onClick=\"javascript:mobgetir();\" value='getir' id='getir' class='butx'> <input type='button' onClick=\"javascript:mobara();\" value='ara' class='butx'></center>  <br>";                
    
    if($isMobile == 1) { 
        // left.php'deki mobile header'ı kopyala
        echo "<center><a id='gundem' href='left.php?list=today' target='_top' title='sol frame'> <img src=inc/turuncu.png width=150 border=1></a></center><br>";
        echo $aramobile;
        
        // left.php'deki butonları kopyala
        $ekmobile = "<input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'> <br><br>";
        
        if ($kullaniciAdi) {
            echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='left.php?list=kenar';\" value='kenar' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=entrylerim&kimdirbu=$kullaniciAdi';\" value='ben' class='butx'> <input type='button' onclick=\"location.href='logout.php';\" value='çık' class='butx'></center>"; 
        } else {
            echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=master&login=onair';\" value='giriş yap' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=word&q=gururlarımız';\" value='⭐gururlarımız⭐' class='butx'> </center> "; 
        }
        
        echo "<br>";
    }
    
    // left.php'deki gibi buton bar'ını göster
    if ($isMobile == 1) {
        echo "<center><input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> $ekmobile </center><br>";
    }
    
    // TOPLAM KAYIT SAYISI
    $countSQL = "SELECT COUNT(id) as total FROM konular 
                WHERE (statu != 'silindi' and tasi = '') 
                AND LOWER(baslik) LIKE LOWER('%$q%')";
    
    $countQuery = mysql_query($countSQL);
    $countRow = mysql_fetch_assoc($countQuery);
    $totalTopics = $countRow['total'];
    $totalPages = ceil($totalTopics / $maxTopicPage);
    
    // left.php STİLİNDE SAYFALAMA (navigateSearch kullanarak)
    echo "<div class='pagi'>\"$q\" için arama sonuçları: ($totalTopics başlık)<br />";
    
    if ($totalPages > 1) {
        // navigateSearch fonksiyonunu çağır
        navigateSearch($q, $currentPage, $totalPages);
    }
    
    echo "</div>\n";
    
    // left.php STİLİNDE BAŞLIK LİSTESİ
    echo "<ul id='listLeftFrame' style='list-style:none; padding-left:10px; margin-top:5px;'>";
    
    // ARAMA SORGUSU
    $SQL = "SELECT baslik, id 
            FROM konular 
            WHERE (statu != 'silindi' and tasi = '') 
              AND LOWER(baslik) LIKE LOWER('%$q%')
            ORDER BY 
              CASE 
                WHEN baslik LIKE '$q' THEN 1
                WHEN baslik LIKE '$q%' THEN 2
                WHEN baslik LIKE '%$q' THEN 3
                ELSE 4
              END,
              CHAR_LENGTH(baslik)
            LIMIT $limitFrom, $maxTopicPage";
    
    $sorgu = mysql_query($SQL);
    
    if (!$sorgu) {
        echo "</ul>";
        header('Location: '."left.php?list=today"); 
    }

    $arguman = 0;
    $adet = 0;
    $sonuc = array();

    while($sira = mysql_fetch_array($sorgu)) {
        $sonuc[$arguman] = $sira["id"];
        $arguman++;
    }
    
    $adet = $arguman;
    
    // left.php'deki gibi başlıkları listele
    for($i = 0; $i < $adet; $i++) {
        $SQLx = "SELECT * FROM konular WHERE id='$sonuc[$i]' and statu=''";
        $sorgu2 = mysql_query($SQLx);
        
        while($sira = mysql_fetch_array($sorgu2)) {
            $baslik = $sira["baslik"];
            $baslik_lower = strtolower($baslik);
            
            // Mesaj sayısını al (left.php'deki gibi)
            $gid = $sira["id"];
            if ($kulYetki == 'admin' or $kulYetki == 'mod') { 
                $sor = mysql_query("SELECT id FROM mesajlar WHERE sira=$gid");
            } else {
                $sor = mysql_query("SELECT id FROM mesajlar WHERE sira=$gid AND statu=''");
            }
            
            $w = mysql_num_rows($sor);
            $max = 20;
            $goster = ceil($w / $max);
            if ($goster < 1) $goster = 1;
            
            $link = str_replace(" ", "+", $baslik_lower);
            
            // left.php'deki gibi link oluştur
            if($isMobile == 1) { 
                echo "<font size=2><li>· <a href='/$link-$goster.html' target=\"_top\" title='$baslik ($w)'>$baslik</a>";
            } else { 
                echo "<font size=2><li>· <a href='/$link-$goster.html' target='main' title='$baslik ($w)'>$baslik</a>";
            }
            
            // Mesaj sayısını göster (left.php'deki gibi)
            if ($w > 1) {
                echo " ($w)";
            }
            
            echo "</li></font>\n";
        }
    }
    
    echo "</ul>";
    
    // Reklam (left.php'deki gibi)
    if ($adet > 1) {
?>
<br>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:197px;height:56px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="6678616589"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php
    }
    
} else {
    // ARAMA FORMU (q yoksa) - left.php stili
    ?>
    <center>
    <?php
    // Mobil kontrol
    $isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
    
    if($isMobile == 1) {
    //    echo "<a id='gundem' href='left.php?list=today' target='_top' title='sol frame'> <img src=inc/turuncu.png width=150 border=1></a><br><br>";
    }
    ?>
    <form method="get" action="sozluk.php">
    <input type="hidden" name="process" value="search">
    <input type="text" name="q" size="25" placeholder="aramaya inanın">
    <input type="submit" value="Ara" class="butx">
    </form>
    </center>
    
    <div style='text-align:center; color:#666; margin-top:20px;'>
    Bir kelime yazıp arama yapın.
    </div>
    <?php

    if ($flag == 1) {
    echo "<div class='pagi' style='text-align:center; color:red;'>";
    echo "<b>En az 3 harf ile arama yapmalısınız!</b><br>";
    echo "</div>";
}

}
?>
