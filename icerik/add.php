

<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
</head>
<body>
    <style>

input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.getElementById('entry');
    var form = textarea.closest('form');
    
    textarea.addEventListener('keydown', function(e) {
        // Ctrl+Enter veya Cmd+Enter (Mac için) tuş kombinasyonunu kontrol et
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 13) {
            e.preventDefault(); // Varsayılan davranışı engelle
            form.submit(); // Formu gönder
        }
    });
});
</script>

<?

$okmsj = guvenlikKontrol($_REQUEST["okmsj"],"hard");
$baslik = guvenlikKontrol($_REQUEST["baslik"],"hard");
$gds = guvenlikKontrol($_REQUEST["gds"],"hard");
$mesaj = nl2br(guvenlikKontrol($_REQUEST["mesaj"],"med"));
$test= mysql_query("SELECT * FROM online WHERE nick='$kullaniciAdi'");

//echo $gds;

while($test2= mysql_fetch_array($test))
{
$test3=$test2['ondurum'];
}

//BAŞLIKTA TIRNAK
//$q = preg_replace("/\'/","\`",$q); 
$q = preg_replace("/\./"," ",$q);
//$q = trim(preg_replace("'[^0-9a-zA-ZüÜşŞiİöÖçÇığĞ`\s]'", "", $q));
$q = trim(preg_replace('/[^A-Za-z0-9\-]/', '', $q)); 

//$q = trim(preg_replace('/[^0-9a-zA-ZüÜşŞiİöÖğĞçÇı\'\s ]/','',$q));

$baslik = mysql_real_escape_string($baslik);
$mesaj = mysql_real_escape_string($mesaj);
$mesaj = nl2br($mesaj);

if (!$kullaniciAdi || $test3 == "off") die;

if (!$okmsj) {
	echo "Kurcuklama lan!";
	exit;
} else {
	if ($baslik == "" or $mesaj == "") {
		if (!$okword) {
		echo "Heryeri doldur lan..";
		exit;
	}else{
		form($baslik);
		exit;
	}
}

$siteStatus = $_SERVER["HTTP_REFERER"];
$siteStatus = explode("/", $siteStatus);
$siteStatus = $siteStatus[2];

$tarih = date("YmdHi");
$gun = date("d");
$ay = date("m");
$yil = date("Y");
$saat = date("H:i");
$ip = getenv('REMOTE_ADDR');

$baslik = substr($baslik, 0, 65);
$baslik = strtolower($baslik);
$mesaj = substr($mesaj, 0, 16000);
$yazar = $kullaniciAdi;

$sorgu = "SELECT id FROM konular WHERE `baslik`='$baslik'";
$sorgulama = mysql_query($sorgu);

if (mysql_num_rows($sorgulama)>0){
	while ($kayit=mysql_fetch_array($sorgulama)){
		$id=$kayit["id"];
		if ($id) {
			echo "Var olm böyle bir başlık :)";
			die;
		}
	}
}

$sorgu = "INSERT INTO konular ";
$sorgu .= "(baslik,ip,tarih,gun,ay,yil,saat,gds,sahibi)";
$sorgu .= " VALUES ";
$sorgu .= "('$baslik','$ip','$tarih','$gun','$ay','$yil','$saat','$gds','$kullaniciAdi')";
mysql_query($sorgu);

$sorgu = "SELECT id FROM konular WHERE `baslik`='$baslik'";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
	$id=$kayit["id"];
	if (!$id) echo "Hata var beah: ID01. Operatöre haber ver :(";
}
}

$sorgu = "INSERT INTO mesajlar ";
$sorgu .= "(sira,mesaj,yazar,ip,tarih,gun,ay,yil,saat,ilkyazar)";
$sorgu .= " VALUES ";
$sorgu .= "('$id','$mesaj','$yazar','$ip','$tarih','$gun','$ay','$yil','$saat','$yazar')";
mysql_query($sorgu);
// mesajida yazdik
// ekranada basiyoz
echo "
<script type=\"text/javascript\">top.left.location.href='left.php?list=today'</script>
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=sozluk.php?process=word&q=$baslik\">";
} // bitirdik IF i

function form($baslik) {
?>
<form method="post" action="">
<table width="100%" align="left" class="dash">
    <tr>
        <td colspan="2">
            <input class=inp maxLength=65 SIZE=65 name=baslik value="<? if ($baslik) { echo "$baslik\" readonly"; }?>">
        </td>
    </tr>
    <tr>

        <td colspan="2">
            <textarea id="entry" name="mesaj" rows="8" style="width:100%;height:12em;max-height:12em;text-transform:none !important;"></textarea>
        </td>
    </tr>
    <tr>
        <td width="788">
            <input class="but" type="button" name="bkz" value="bkz" onClick="return insert('entry','(bkz: ',')');">
            <input class="but" type="button" name="bkz" value="gizli bkz" onClick="return insert('entry','`','`');">
            <input class="but" type="button" name="bkz" value="foto" onClick="return insert('entry','(foto: ',')');">
            <input class="but" type="button" name="bkz" value="youtube" onClick="return insert('entry','(youtube: ',')');">
            <input class="but" type="button" name="bkz" value="spotify albüm" onClick="return insert('entry','(spoalbum: ',')');">
            <input class="but" type="button" name="bkz" value="spotify track" onClick="return insert('entry','(spotrack: ',')');">
            <input class="but" type="button" name="bkz" value="soundcloud" onClick="return insert('entry','(soundcloud: ',')');">
            <input class="but" type="button" name="bkz" value="kalın" onClick="return insert('entry','(kalin: ',')');">
            <input class="but" type="button" name="bkz" value="*" onClick="return insert('entry','~','~');">
            <input class="but" type="button" name="bkz" value="-s!-" onClick="return insert('entry','\n--`spoiler`--\n','\n--`spoiler`--\n\n');" accesskey=v>
        </td>
        <td width="90" align="right" valign="top">
            <input id="kaydet" class=but type="submit" name="kaydet" value="gönder">
            <input type=hidden name=ok value=ok>
            <input type=hidden name=okmsj value=ok>
            <input type="hidden" name="gonder" value="kaydet">
        </td>
    </tr>
</table>
</form>
<p class="yazi">&nbsp;</p>
</body>
<? } ?>
