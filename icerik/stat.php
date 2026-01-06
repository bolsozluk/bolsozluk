<style type="text/css">
.vertical-scrollbar
{
	overflow-y: hidden; /*for vertical scroll bar*/
}

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



<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
	'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
	'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );


include "mobframe.php";

$cMon = date("m");
$cYea = date("Y");

if($isMobile == 1 and $kullaniciAdi == "")
{ 
}

if($isMobile == 1)
{ 

	if(($kullaniciAdi == ""))
	{ 
		?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
		crossorigin="anonymous"></script>

		<?
	}

echo "<div class='menu-row'>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=neleroldu&ay=$cMon&yil=$cYea';\">bu ay neler oldu</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=ucay';\">ayın yazarları</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=ebe';\">en beğenilenler</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=yazar';\">bol yazanlar</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=oycu';\">oy kralları</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=aylik';\">bol geçmiş</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=pmsg';\">en arananlar</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=arge';\">arge kasanlar</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=modpower';\">moderasyon gücü</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=bekciler';\">gece bekçileri</div>";
echo "<div class='tab' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\">genel</div>";
	echo "</div>";
	
	echo "<br>";

}

if($isMobile == 1)
{ 
	?>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-53237593-1', 'auto');
	ga('require', 'displayfeatures');
	ga('send', 'pageview');
	</script>
	<?
}

if($stat=="tema"){
	$sorgu1 = "SELECT tema FROM temalar";
	$sorgu2 = mysql_query($sorgu1);
	echo "<td><strong>zevkler ve renkler: </strong></td><br>
	<table align=center width=200 border=0 cellSpacing=0 cellPadding=0><br>";
	while ($oku=mysql_fetch_array($sorgu2)) {
		$tsrg = mysql_query("select stat from temalar where tema='$oku[tema]'");
		$tsrgf = mysql_fetch_array($tsrg);
//	 $tsrg=mysql_query("select * from user where tema='$oku[tema]'");
		$kactsrg=$tsrgf["stat"];
		?>
		<tr>
			<td><a href="sozluk.php?process=word&q=<?=$oku[tema]?>" target="main"><?=$oku[tema]?></a></td>
			<td><?=$kactsrg?></td>
		</tr>
		<?
	}
	echo "</table>";
	echo"<small><br>bu istatistiğe çaylak statüsündeki hesaplar da dahildir.</b></small>" ;	



	die();
}
?>
<?
if($stat=="genel"){
	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$baslik=$kayit2["baslik"];
	$entry=$kayit2["entry"];
	$gentry=$kayit2["gentry"];
	$bentry=$kayit2["bentry"];
	$silbaslik=$kayit2["silbaslik"];
	$silentry=$kayit2["silentry"];
	$hit=$kayit2["hit"];
	$tekil=$kayit2["tekil"];
	$yazar=$kayit2["yazar"];
	$okur=$kayit2["okur"];
	$mod=$kayit2["moderat"];
	$op=$kayit2["op"];
	$pilot=$kayit2["pilot"];
	$rahmetli=$kayit2["rahmetli"];
	$admin=$kayit2["admin"];
	$ortbaslik=$kayit2["ortbaslik"];
	$ortentry=$kayit2["ortentry"];
	$enhitbaslik=$kayit2["enhitbaslik"];
	$tarih=$kayit2["tarih"];
	$biryaz=$kayit2["biryaz"];
	$ikiyaz=$kayit2["ikiyaz"];
	$ucyaz=$kayit2["ucyaz"];
	$gammaz=@mysql_num_rows(mysql_query("select * from user where yetki='gammaz'"));
	
	$basliklink = ereg_replace(" ","+",$enhitbaslik);

	$sonid = mysql_fetch_assoc(mysql_query("SELECT * FROM user ORDER BY id DESC LIMIT 1"));
	$son = $sonid['id'];  

	$yonet = $mod + $admin - 1;

	$ikincinesil = $son - 1419;

	$total = $pilot + $okur + $yazar;

	echo "
	<SCRIPT src=\"inc/sozluk.js\" type=text/javascript></SCRIPT>
	<META http-equiv=Content-Type content=\"text/html; charset=iso-8859-9\">
	<center><a class=link><b>Genel Istatistikler</b></center><br><br>
	<table align=center width=\"100%\" border=\"0\" cellSpacing=0 cellPadding=0>
	<tr>
	<td width=\"65%\"><a class=div><b>ba\$lik sayisi</td>
	<td width=\"1%\">:</td>
	<td width=\"34%\">$baslik</td>
	</tr>
	<tr>
	<td><a class=div><b>entry sayısı</a> </td>
	<td>:</td>
	<td>$entry</td>
	</tr>
	<tr>
	<td><a class=div><b>geçen ay girilen entry</a> </td>
	<td>:</td>
	<td>$gentry</td>
	</tr>
	<tr>
	<td><a class=div><b>bu ay girilen entry</a> </td>
	<td>:</td>
	<td>$bentry</td>
	</tr>
	<tr>
	<td><a class=div><b>uçurulan başlık sayısı </td>
	<td>:</td>
	<td>$silbaslik</td>
	</tr>
	<tr>
	<td><a class=div><b>uçurulan entry sayısı </td>
	<td>:</td>
	<td>$silentry</td>
	</tr>
	<tr>
	<td><a class=div><b>başlık gösterimi </td>
	<td>:</td>
	<td>$hit</td>
	</tr>
	<tr>
	<td><a class=div><b>kaç ziyaretçi gelmiş </td>
	<td>:</td>
	<td>$tekil</td>
	</tr>
	<tr>
	<td colspan=\"3\"></td>
	</tr>
	<tr>	  	   
	<td><a class=div><b>birinci nesil yazar sayısı </td>
	<td>:</td>
	<td>$biryaz</td>
	</tr>
	<tr>
	<td><a class=div><b>ikinci nesil yazar sayısı </td>
	<td>:</td>
	<td>$ikiyaz</td>
	</tr>
	<tr>
	<td><a class=div><b>üçüncü nesil yazar sayısı </td>
	<td>:</td>
	<td>$ucyaz</td>
	</tr>
	<tr>
	<td><a class=div><b>aktif yazar sayısı </td>
	<td>:</td>
	<td>$yazar</td>
	</tr>
	<tr>
	<td><a class=div><b>çömez yazar sayısı </td>
	<td>:</td>
	<td>$okur</td>
	</tr>
	<tr>
	<td><a class=div><b>uçurulmuş yazar sayısı </td>
	<td>:</td>
	<td>$pilot</td>
	</tr>
	<tr>
	<td><a class=div><b>toplam kayıtlı sayısı</td>
	<td>:</td>
	<td>$total</td>
	</tr>
	<tr>
	<td><a class=div><b>editör sayısı </td>
	<td>:</td>
	<td>3</td>
	</tr>	  
	<tr>
	<td><a class=div><b>yönetici sayısı</td>
	<td>:</td>
	<td>$yonet</td>
	</tr>
	<tr>
	<td><a class=div><b>en rağbet gören başlık </td>
	<td>:</td>
	<td><a href=sozluk.php?process=word&q=$basliklink target='main'>$enhitbaslik</a></td>
	</tr>
	
	<tr>
	<td colspan=\"3\"></td>
	</tr>
	<tr>
	<td><a class=div>yazar basina du\$en ortama ba\$lik </td>
	<td>:</td>
	<td>$ortbaslik</td>
	</tr>
	<tr>
	<td><a class=div>yazar basina du\$en ortalama entry </td>
	<td>:</td>
	<td>$ortentry</td>
	</tr>
	</table>
	";


//  -- <a href="?process=stat&stat=arge" target="gostert">En çok arge kasanlar</a><br>
	if($isMobile == 1)
	{ 
		$sorgu = "SELECT tarih FROM stat";
		$sorgulama = mysql_query($sorgu);
		$kayit=mysql_fetch_array($sorgulama);
		$tarih=$kayit["tarih"];
		echo "<br></a><center>Son güncelleme: $tarih</center>";
	}

	if(($kullaniciAdi == ""))
	{ 
		?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
		crossorigin="anonymous"></script>

		<?
	}

	die();	
}
?>
<?

if($stat=="entri"){
	$sorgu = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu);

	if (mysql_num_rows($sorgu2) > 0) {
		$kayit = mysql_fetch_array($sorgu2);

		$entries = array();
		$basliklar = array();

		for ($i = 1; $i <= 20; $i++) {
			$entries[$i] = $kayit["eniyientry" . $i];
			$basliklar[$i] = $kayit["eniyibaslik" . $i];
			$basliklink[$i] = ereg_replace(" ", "+", $basliklar[$i]);
		}

		echo "<br><font size=2><strong>en babalar:</strong></font><br><br>";

		for ($i = 1; $i <= 20; $i++) {
			echo "$i. <a href=?process=word&q={$basliklink[$i]} target=main>{$basliklar[$i]}</a> - <a href=?process=eid&eid={$entries[$i]} target=main>#{$entries[$i]}</a><br>";
		}

//		echo "<br>";

$sorgu1 = mysql_query("SELECT entry_id, SUM(oy) as toplam FROM oylar GROUP BY entry_id ORDER BY toplam DESC LIMIT 20,22"); 
$x = 20;

while ($kayit2 = mysql_fetch_array($sorgu1)) {
    $x++;
    $entry_id = $kayit2["entry_id"];
    $toplam = $kayit2["toplam"];

    $sira11 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$entry_id'"));
    $sira1 = $sira11["sira"];
    $eniyibaslik11 = mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira1'"));
    $eniyibaslik1 = $eniyibaslik11["baslik"];
	$eniyilink  = ereg_replace(" ", "+", $eniyibaslik1);
    echo "$x. <a href=?process=word&q=$eniyilink target=main>$eniyibaslik1</a> - <a href=?process=eid&eid=$entry_id target=main>#$entry_id</a><br>";
}
	}
	die();
}

if ($stat == "aylik") {
    ?>
    <center><td><strong>aylık entry geçmişi: </strong></td><br><br>
    <?php

    // Şu anki yıl ve ay
    $cYea = date("Y");
    $cMon = date("n"); // n: başı sıfırsız 1-12

    // 1. Sadece bugüne ait (bu yıl ve ay) entry sayısını hesaplatalım
    $curr_yil = intval($cYea);
    $curr_ay  = intval($cMon);

    // Entry sayısı (silinenler dahil)
    $result = mysql_query("SELECT COUNT(*) as toplam FROM mesajlar WHERE yil = '$curr_yil' AND ay = '$curr_ay'");
    $row    = mysql_fetch_assoc($result);
    $curr_sayi = intval($row["toplam"]);

    // 2. Bu ay için kayıt var mı?
    $check = mysql_query("SELECT id FROM aylikentry WHERE yil='$curr_yil' AND ay='$curr_ay'");
    if (mysql_num_rows($check) > 0) {
        // Güncelle
        mysql_query("UPDATE aylikentry SET entry='$curr_sayi' WHERE yil='$curr_yil' AND ay='$curr_ay'");
    } else {
        // Kayıt yoksa ekle
        mysql_query("INSERT INTO aylikentry (yil, ay, entry) VALUES ('$curr_yil', '$curr_ay', '$curr_sayi')");
    }

	// 3. Bir önceki yıl ve ayı hesaplayalım

$prev_date = strtotime("-1 month", mktime(0, 0, 0, $cMon, 1, $cYea));
$prev_yil = date("Y", $prev_date);
$prev_ay  = date("n", $prev_date); // n: başı sıfırsız 1-12

// 4. Bir önceki aya ait entry sayısını hesaplatalım

$prev_yil_int = intval($prev_yil);
$prev_ay_int  = intval($prev_ay);
$result_prev = mysql_query("SELECT COUNT(*) as toplam FROM mesajlar WHERE yil = '$prev_yil_int' AND ay = '$prev_ay_int'");
$row_prev    = mysql_fetch_assoc($result_prev);
$prev_sayi   = intval($row_prev["toplam"]);

// 5. Bir önceki ay için kayıt var mı?
$check_prev = mysql_query("SELECT id FROM aylikentry WHERE yil='$prev_yil_int' AND ay='$prev_ay_int'");

if (mysql_num_rows($check_prev) > 0) {
    // Güncelle
    mysql_query("UPDATE aylikentry SET entry='$prev_sayi' WHERE yil='$prev_yil_int' AND ay='$prev_ay_int'");
} else {
    // Kayıt yoksa ekle
    mysql_query("INSERT INTO aylikentry (yil, ay, entry) VALUES ('$prev_yil_int', '$prev_ay_int', '$prev_sayi')");
}

    // 5. Grafik için, 2014'ten günümüze tüm verileri çekelim
    $x_vals = array();
    $y_vals = array();

    $istat_sorgu = mysql_query("SELECT yil, ay, entry FROM aylikentry WHERE (yil > 2013) ORDER BY yil, ay");
    while ($row = mysql_fetch_assoc($istat_sorgu)) {
        // Son güncel ayı gösterme (eski kod uyumluluğu!)
        if ($row["yil"] == $curr_yil && $row["ay"] == $curr_ay) continue;
        $x_vals[] = $row["yil"] . "_" . str_pad($row["ay"], 2, '0', STR_PAD_LEFT);
        $y_vals[] = intval($row["entry"]);
    }

    // Array'leri js'ye string olarak aktaralım
    $x_js = "[" . implode(',', array_map(function($v) { return '"' . $v . '"'; }, $x_vals)) . "]";
    $y_js = "[" . implode(',', $y_vals) . "]";

    ?>
    <div id="arrayContent"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <canvas id="myChart" style="background-color: #dfdfdf;width:100%;max-width:700px"></canvas>

    <script>
        let xValues = <?php echo $x_js; ?>;
        let yValues = <?php echo $y_js; ?>;

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max: 15000}}],
                }
            }
        });
    </script>

    <?php
    //echo "<br>silinen entryler de hesaplamaya dahil edilmiştir.</center>";
    die();
}


    if ($stat == "neleroldu") {

sleep(1); // 1 saniye bekler

$cYea = rand("2015", (date("Y")-1));
$cMon = date("m");


if (isset($_GET['ay']) && isset($_GET['yil'])) {
	$cMon = $_GET['ay'];
	$cYea = $_GET['yil'];
}


//echo "<a class=link href=\"/sozluk.php?process=stat&stat=neleroldu&ay=$cMon-1&yil=$cYea\"><font color=red face=verdana size=1><b><<</b></font></a> ";
//echo "<a class=link href=\"/sozluk.php?process=stat&stat=neleroldu&ay=$cMon+1&yil=$cYea\"><font color=red face=verdana size=1><b>>></b></font></a>";				
//echo "<br>";
//echo "<br>";

echo "<strong>ayın özeti:</strong><br><br>";
	//$cDay = date("d");
    //$cMon = date("m");
    //$cYea = date("Y");

$sorgu1 = "SELECT konular.id, konular.baslik, COUNT(mesajlar.sira) as toplam FROM mesajlar RIGHT JOIN konular ON mesajlar.sira=konular.id WHERE (mesajlar.yil=$cYea AND mesajlar.ay=$cMon) GROUP BY mesajlar.sira ORDER BY toplam DESC LIMIT 0,25";
$sorgu2 = mysql_query($sorgu1);
$x = 0;

while ($kayit2=mysql_fetch_array($sorgu2)) 
{
	$x++;
	$nobaslik=$kayit2["baslik"];
	$notoplam=$kayit2["toplam"];
	$basliklink = ereg_replace(" ","+",$nobaslik);
	echo "$x. <a href=?process=word&q=$basliklink  target=main>$nobaslik</a> ($notoplam)<br>";
}

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}

die();
}

if ($stat == "bekciler") {

	sleep(1); // 1 saniye bekler

	echo "<strong>moderasyona en çok destek olanlar:</strong><br><br>";

	$sorgu1 = "SELECT gonderen, COUNT(*) as toplam_sikayet 
	FROM esikayet
	WHERE (gonderen != 'harameynalamut fedaisi')
	GROUP BY gonderen 
	ORDER BY toplam_sikayet DESC 
	LIMIT 20;";
	$sorgu2 = mysql_query($sorgu1);
	$x = 0;

	while ($kayit2=mysql_fetch_array($sorgu2)) 
	{
		$x++;
		$gonderen=$kayit2["gonderen"];
		if ($gonderen == "") $gonderen = "anonim";
		$notoplam=$kayit2["toplam_sikayet"];
		$basliklink = ereg_replace(" ","+",$gonderen);
		echo "$x. <a href=?process=word&q=$basliklink  target=main>$gonderen</a> - $notoplam<br>";
	}	

	die();
}


if($stat=="yazar"){
	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	$num_rows = mysql_num_rows($sorgu2);

	if ($num_rows > 0) {
		$kayit2 = mysql_fetch_array($sorgu2);

		$encokyazarlar = array();
		$adetler = array();

		for ($i = 1; $i <= 20; $i++) {
			$encokyazarlar[$i] = $kayit2["encokyazar" . $i];
			$adetler[$i] = $kayit2["adet" . $i];
		}

		$enhitbaslik = $kayit2["enhitbaslik"];
		$basliklink = str_replace(" ", "+", $enhitbaslik);

		$listele2 = mysql_query("SELECT yazar, COUNT(*) as adet FROM mesajlar WHERE statu !='silindi' AND yazar !='uim' GROUP BY yazar ORDER BY adet DESC LIMIT 0,1");

		while ($kayit2 = mysql_fetch_array($listele2)) {
			$adet = $kayit2["adet"];
		}

		echo "<strong>büyük ortaklar: </strong><br><br>";

		for ($i = 1; $i <= 19; $i++) {
			echo "$i) <a href=\"?process=word&q={$encokyazarlar[$i]}\" target=main>{$encokyazarlar[$i]} - {$adetler[$i]}</a><br>";
}

echo "<br><br>";
echo "<strong>anonim entry adedi: </strong> $adet<br><br>";
}

die();
}
if($stat=="ucay"){
	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	$num_rows = mysql_num_rows($sorgu2);

	if ($num_rows > 0 && $kayit2 = mysql_fetch_array($sorgu2)) {
		$ucyazarlar = $ucadetler = array();

		for ($i = 1; $i <= 10; $i++) {
			$ucyazarlar[] = $kayit2["ucyazar" . $i];
			$ucadetler[] = $kayit2["ucadet" . $i];
		}

		$basliklink = str_replace(" ", "+", $enhitbaslik);

		echo "
		<table width=\"516\" height=\"279\" border=\"0\">
		<tr>
		<td><strong>bu ay en çok yazanlar: </strong></td>
		</tr>
		<tr>
		<td>
		";

		foreach ($ucyazarlar as $index => $ucyazar) {
			echo ($index + 1) . ") <a href=\"?process=word&q={$ucyazar}\" target=main>{$ucyazar} - {$ucadetler[$index]}</a><br>";
}

echo "
</td>
</tr>
</table>
";
} else {
	echo "Veri bulunamadı.";
}

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}


die();
}


//OY VERENLER
if($stat=="oycu"){

	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	$num_rows = mysql_num_rows($sorgu2);

	if ($num_rows > 0 && $kayit2 = mysql_fetch_array($sorgu2)) {
		$oyculer = $encokoylar = array();

		for ($i = 1; $i <= 15; $i++) {
			$oyculer[] = $kayit2["oycu" . $i];
			$encokoylar[] = $kayit2["encokoy" . $i];
		}

		$basliklink = str_replace(" ", "+", $enhitbaslik);

		echo "
		<strong>tıpış tıpış sandığa gidenler:</strong><br><br>
		";

		foreach ($oyculer as $index => $oycu) {
			echo ($index + 1) . ") <a href=\"?process=word&q={$oycu}\" target=main>{$oycu} - {$encokoylar[$index]}</a><br>";
}
} 

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}

die();
}

//pmsg
if($stat=="pmsg"){
	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$pyazar1=$kayit2["pyazar1"];
	$pyazar2=$kayit2["pyazar2"];
	$pyazar3=$kayit2["pyazar3"];
	$pyazar4=$kayit2["pyazar4"];
	$pyazar5=$kayit2["pyazar5"];
	$pyazar6=$kayit2["pyazar6"];
	$pyazar7=$kayit2["pyazar7"];
	$pyazar8=$kayit2["pyazar8"];
	$pyazar9=$kayit2["pyazar9"];
	$pyazar10=$kayit2["pyazar10"];


	$padet1=$kayit2["padet1"];
	$padet2=$kayit2["padet2"];
	$padet3=$kayit2["padet3"];
	$padet4=$kayit2["padet4"];
	$padet5=$kayit2["padet5"];
	$padet6=$kayit2["padet6"];
	$padet7=$kayit2["padet7"];
	$padet8=$kayit2["padet8"];
	$padet9=$kayit2["padet9"];
	$padet10=$kayit2["padet10"];


	$basliklink = ereg_replace(" ","+",$enhitbaslik);

	echo "
	<table width=\"516\" height=\"279\" border=\"0\">
	<tr>
	<td><strong>aranan adamlar: </strong></td>
	</tr>
	<tr>
	<td><p>1) <a href=\"?process=word&q=$pyazar1\" target=main>$pyazar1 - $padet1</a><br>
2) <a href=\"?process=word&q=$pyazar2\" target=main>$pyazar2 - $padet2</a><br>
3) <a href=\"?process=word&q=$pyazar3\" target=main>$pyazar3 - $padet3</a><br>
4) <a href=\"?process=word&q=$pyazar4\" target=main>$pyazar4 - $padet4</a><br>
5) <a href=\"?process=word&q=$pyazar5\" target=main>$pyazar5 - $padet5</a><br>
6) <a href=\"?process=word&q=$pyazar6\" target=main>$pyazar6 - $padet6</a><br>
7) <a href=\"?process=word&q=$pyazar7\" target=main>$pyazar7 - $padet7</a><br>
8) <a href=\"?process=word&q=$pyazar8\" target=main>$pyazar8 - $padet8</a><br>
9) <a href=\"?process=word&q=$pyazar9\" target=main>$pyazar9 - $padet9</a><br>
10) <a href=\"?process=word&q=$pyazar10\" target=main>$pyazar10 - $padet10</a><br>
</td>
</tr>
</table>
";

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}

die();
}


if($stat=="argeeski"){
	echo "
	<strong>isviçreli bilim adamları ve alman mühendisler:</strong>
	<table width=\"516\" height=\"279\" border=\"0\">



	<tr>
	<td><p>1) <a href=\"?process=word&q=dj mic check\" target=main>dj mic check - 5</a><br>
2) <a href=\"?process=word&q=kobaysos\" target=main>kobaysos - 3</a><br>
3) <a href=\"?process=word&q=efz sioux\" target=main>efz sioux - 2</a><br>
4) <a href=\"?process=word&q=buralar degerlenir\" target=main>buralar degerlenir - 2</a><br>
5) <a href=\"?process=word&q=penguen\" target=main>penguen - 1</a><br>
6) <a href=\"?process=word&q=retiarius\" target=main>retiarius - 1</a><br>
7) <a href=\"?process=word&q=hangikadirabi\" target=main>hangikadirabi -1</a><br>
8) <a href=\"?process=word&q=acapella\" target=main>acapella - 1</a><br>
9) <a href=\"?process=word&q=deepsky\" target=main>deepsky - 1</a><br>
10) <a href=\"?process=word&q=komutana sniper neresinden\" target=main>komutana sniper neresinden - 1</a></p>
</td>
</tr>
</table>
";
die();
}

if($stat=="debe"){
	$sorgu1 = "SELECT * FROM debe";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$eniyientry1=$kayit2["eniyientry1"];
	$eniyientry2=$kayit2["eniyientry2"];
	$eniyientry3=$kayit2["eniyientry3"];
	$eniyientry4=$kayit2["eniyientry4"];
	$eniyientry5=$kayit2["eniyientry5"];

	$eniyibaslik1=$kayit2["eniyibaslik1"];
	$eniyibaslik2=$kayit2["eniyibaslik2"];
	$eniyibaslik3=$kayit2["eniyibaslik3"];
	$eniyibaslik4=$kayit2["eniyibaslik4"];
	$eniyibaslik5=$kayit2["eniyibaslik5"];

	$eniyibaslikl1 = ereg_replace(" ","+",$eniyibaslik1);
	$eniyibaslikl2 = ereg_replace(" ","+",$eniyibaslik2);
	$eniyibaslikl3 = ereg_replace(" ","+",$eniyibaslik3);
	$eniyibaslikl4 = ereg_replace(" ","+",$eniyibaslik4);
	$eniyibaslikl5 = ereg_replace(" ","+",$eniyibaslik5);


	echo "
	<strong>dünün en beğenilenleri:<br></strong><br>";


	echo "1. <a href=?process=word&q=$eniyibaslikl1 target=main>$eniyibaslik1</a> - <a href=?process=eid&eid=$eniyientry1 target=main>#$eniyientry1</a><br>";
	echo "2. <a href=?process=word&q=$eniyibaslikl2 target=main>$eniyibaslik2</a> - <a href=?process=eid&eid=$eniyientry2 target=main>#$eniyientry2</a><br>";
	echo "3. <a href=?process=word&q=$eniyibaslikl3 target=main>$eniyibaslik3</a> - <a href=?process=eid&eid=$eniyientry3 target=main>#$eniyientry3</a><br>";
	echo "4. <a href=?process=word&q=$eniyibaslikl4 target=main>$eniyibaslik4</a> - <a href=?process=eid&eid=$eniyientry4 target=main>#$eniyientry4</a><br>";
	echo "5. <a href=?process=word&q=$eniyibaslikl5 target=main>$eniyibaslik5</a> - <a href=?process=eid&eid=$eniyientry5 target=main>#$eniyientry5</a><br>";
	echo "";

	if(($ismobile == 0) and ($kullaniciAdi == ""))
	{ 
		?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
		crossorigin="anonymous"></script>

		<?
	}


	die();
}

if($stat=="hebe"){
	$sorgu1 = "SELECT * FROM debe";
	$sorgu2 = mysql_query($sorgu1);
	$kayit2 = mysql_fetch_array($sorgu2);

	$eniyiBasliklar = array();
	$eniyiEntryler = array();

	for ($i = 1; $i <= 10; $i++) {
		$eniyiBasliklar[] = $kayit2["hebeb$i"];
		$eniyiLinkler[] = ereg_replace(" ", "+", $kayit2["hebeb$i"]);
		$eniyiEntryler[] = $kayit2["hebe$i"];
	}

	echo "<strong>son yedi günün en beğenilenleri:</strong>
	<table width=\"516\" height=\"279\" border=\"0\">
	<tr>
	<td><p>";

	for ($i = 0; $i < 10; $i++) {
		$index = $i + 1;
		echo "$index. <a href=?process=word&q={$eniyiBasliklar[$i]} target=main>{$eniyiBasliklar[$i]}</a> - <a href=?process=eid&eid={$eniyiEntryler[$i]} target=main>#{$eniyiEntryler[$i]}</a><br>";
	}

	echo "</p></td></tr></table>";

	if(($ismobile == 0) and ($kullaniciAdi == ""))
	{ 
		?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
		crossorigin="anonymous"></script>

		<?
	}


	die();
}

if($stat=="arge")
{
	$i = 1;
	echo "<strong>isviçreli bilim adamları ve alman mühendisler:</strong><br><br>";
	$sorgu = "SELECT yazar, COUNT(*) as arge FROM mesajlar WHERE(statu != 'silindi' and statu!='wait' and sira = '120' and istekhatti = '1') GROUP BY yazar ORDER BY arge DESC LIMIT 0,19";
	$sorgulama = mysql_query($sorgu);
	if (mysql_num_rows($sorgulama)>0){
		while ($kayit=mysql_fetch_array($sorgulama)){
			$yazar=$kayit["yazar"];
			$argepuan=$kayit["arge"];
			echo "$i) <a href=\"?process=word&q=$yazar\" target=main>$yazar</a> - $argepuan<br>";
$i++;
}

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}

die;

}
}


if($stat=="modpower")
{
	$i = 2;
	echo "<strong>moderasyon gücü:</strong><br><br>";
	echo "1) <a href=\"?process=word&q=semttenbirses\" target=main>semttenbirses</a> - ∞<br>";

$sorgu = "SELECT silen, COUNT(*) as silsay FROM mesajlar WHERE ((statu ='silindi' and statu!='wait' and yazar!=silen) and (silen='deepsky' or silen='booyaka' or silen='if rap gets jealous' or silen='ret1arius' or silen='komutana sniper neresinden' or silen='dragunov' or silen='abra yutpa'))  GROUP BY silen ORDER BY silsay DESC LIMIT 0,19";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0)
{
	while ($kayit=mysql_fetch_array($sorgulama)){
		$mod=$kayit["silen"];
		$silpuan=$kayit["silsay"];					
		echo "$i) <a href=\"?process=word&q=$mod\" target=main>$mod</a> - $silpuan<br>";
$i++;
}

}


$i = 2;

echo "<br><br>";
echo "<strong>misyoner gücü:</strong><br><br>";
echo "1) <a href=\"?process=word&q=semttenbirses\" target=main>semttenbirses</a> - ∞<br>";

$sorgu = "SELECT onaylayan, COUNT(*) as onaysay FROM user WHERE (onaylayan='deepsky' or onaylayan='booyaka' or onaylayan='if rap gets jealous' or onaylayan='ret1arius' or onaylayan='komutana sniper neresinden' or onaylayan='dragunov' or onaylayan='abra yutpa')  GROUP BY onaylayan ORDER BY onaysay DESC LIMIT 0,19";
$sorgulama = mysql_query($sorgu);		
if (mysql_num_rows($sorgulama)>0)
{
	while ($kayit=mysql_fetch_array($sorgulama)){
		$mod=$kayit["onaylayan"];
		$onaypuan=$kayit["onaysay"];				
		echo "$i) <a href=\"?process=word&q=$mod\" target=main>$mod</a> - $onaypuan<br>";
$i++;
}
}	


echo"<small><br>bu istatistiğe şimdilik sadece belirli bir tarihten sonra silinen entryler ve gözden geçirilen çaylaklar dahil edilmiştir, gözden geçirilip şikayeti reddedilen entryler, düzeltilen başlıklar, taşınan entryler vb. parametreler de ileride hesaba katılacaktır.</b></small>" ;

if(($ismobile == 0) and ($kullaniciAdi == ""))
{ 
	?>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
	crossorigin="anonymous"></script>

	<?
}
die;
}
if($stat=="ebe"){

	$sorgu1 = "SELECT * FROM debe";
	$sorgu2 = mysql_query($sorgu1);
	$num_rows = mysql_num_rows($sorgu2);

	if ($num_rows > 0) {
		$kayit2 = mysql_fetch_array($sorgu2);

		$eniyientryler = array();
		$eniyibasliklar = array();

			echo "<br><strong>dünün en beğenilenleri:</strong><br>";

		for ($i = 1; $i <= 3; $i++) {
			$eniyientryler[$i] = $kayit2["eniyientry" . $i];
			$eniyibasliklar[$i] = $kayit2["eniyibaslik" . $i];
			$eniyiLinkler[$i] =  ereg_replace(" ", "+", $eniyibasliklar[$i]);
			echo "$i. <a href=?process=eid&eid={$eniyientryler[$i]} target=main>#{$eniyientryler[$i]}</a> - <a href=?process=word&q={$eniyiLinkler[$i]} target=main>{$eniyibasliklar[$i]}</a><br>";


		}
	}



	$sorgu1 = "SELECT * FROM debe";
	$sorgu2 = mysql_query($sorgu1);
	$num_rows = mysql_num_rows($sorgu2);

	if ($num_rows > 0) {
		$kayit2 = mysql_fetch_array($sorgu2);

		$entryler = array();
		$basliklar = array();
		echo "<br><strong>son 7 günün en beğenilenleri:</strong><br>";

		for ($i = 1; $i <= 10; $i++) {
			$entryler[$i] = $kayit2["hebe" . $i];
			$basliklar[$i] = $kayit2["hebeb" . $i];
			$linkler[$i] = ereg_replace(" ", "+", $basliklar[$i]);
			echo "$i. <a href=?process=eid&eid={$entryler[$i]} target=main>#{$entryler[$i]} - <a href=?process=word&q={$linkler[$i]} target=main>{$basliklar[$i]}</a></a><br>";

		}

$sorgu = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu);

	if (mysql_num_rows($sorgu2) > 0) {
		$kayit = mysql_fetch_array($sorgu2);

		$entries = array();
		$basliklar = array();

		for ($i = 1; $i <= 20; $i++) {
			$entries[$i] = $kayit["eniyientry" . $i];
			$basliklar[$i] = $kayit["eniyibaslik" . $i];
			$basliklink[$i] = ereg_replace(" ", "+", $basliklar[$i]);
		}

		echo "<br><font size=2><strong>en babalar:</strong></font><br><br>";

		for ($i = 1; $i <= 20; $i++) {
			echo "$i. <a href=?process=word&q={$basliklink[$i]} target=main>{$basliklar[$i]}</a> - <a href=?process=eid&eid={$entries[$i]} target=main>#{$entries[$i]}</a><br>";
		}
}
	}
	if(($ismobile == 0) and ($kullaniciAdi == ""))
	{ 
		?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7994669731946359"
		crossorigin="anonymous"></script>
		<?
	}
	die();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Untitled Document</title>
</head>

<body>

	<style type="text/css">

	.element, .outer-container {
		width: 200px;
		height: 200px;
	}

	.outer-container {
		border: 5px solid purple;
		position: relative;
		overflow: hidden;
	}

	.inner-container {
		position: absolute;
		left: 0;
		overflow-x: hidden;
		overflow-y: scroll;
	}

	.inner-container::-webkit-scrollbar {
		display: none;
	}


	</style>

	<table width="925" height="497" border="0">
		<tr>
			<td width="250" height="42">&nbsp;</td>
			<td width="650" >&nbsp;</td>
		</tr>
		<tr>
			<td> - <a href="?process=stat&stat=genel" target="gostert">Genel istatistikler</a><br>
				-- <a href="?process=stat&stat=neleroldu&ay=<?echo $cMon;?>&yil=<?echo $cYea;?>" target="gostert">bu ay neler oldu</a><br>
				-- <a href="?process=stat&stat=ucay" target="gostert">ayın yazarları</a><br>
				-- <a href="?process=stat&stat=entri" target="gostert">En beğenilenler</a><br>
				-- <a href="?process=stat&stat=debe" target="gostert">Dünün en beğenilenleri</a><br>
				-- <a href="?process=stat&stat=hebe" target="gostert">Son yedi günün en beğenilenleri</a><br>
				-- <a href="?process=stat&stat=tema" target="gostert">tema seçimi</a><br>
				-- <a href="?process=stat&stat=yazar" target="gostert">bol yazanlar</a><br>
				-- <a href="?process=stat&stat=oycu" target="gostert">oy kralları</a><br>
				-- <a href="?process=stat&stat=arge" target="gostert">arge kasanlar</a><br>
				-- <a href="?process=stat&stat=modpower" target="gostert">moderasyon gücü</a><br>
				-- <a href="?process=stat&stat=bekciler" target="gostert">gece bekçileri</a><br>
				-- <a href="?process=stat&stat=pmsg" target="gostert">En arananlar</a><br>
				-- <a href="?process=stat&stat=aylik" target="gostert">bol geçmiş</a><br>
				<td>
					<iframe scrolling="no" name="gostert" id="gostert" width="100%" height="800" frameborder="0" src="sozluk.php?process=stat&stat=genel"></iframe>
				</td>
			</tr>
		</table>

		<?
		$sorgu = "SELECT tarih FROM stat";
		$sorgulama = mysql_query($sorgu);
		$kayit=mysql_fetch_array($sorgulama);
		$tarih=$kayit["tarih"];
		echo "<center>Son güncelleme: $tarih</center>";
include "footer.php";
		?>
	</body>
	</html>
