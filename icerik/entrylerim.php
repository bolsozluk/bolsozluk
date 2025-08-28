<?
$kimdirbu = guvenlikKontrol(
    isset($_REQUEST["kimdirbu"]) ? $_REQUEST["kimdirbu"] : "", "hard"
);
include "mobframe.php";
echo "<br>";


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
?>
<FORM action=sozluk.php?process=entrylerim&kimdirbu method=post>
  <table width="280" border="0">
    <tr>
      <td width="30"><strong>Nick</strong></td>
      <td width="3">:</td>
      <td width="264"><input maxlength=50 type=text size=30 name=kimdirbu>
      <input type="submit" name="Submit" value="GBT"></td>
    </tr>
    </table>
    </form> 
    <head>
    <style>
        table {
              font-size: 10pt;
  border:1px solid red;
  width:100%;
  table-layout:fixed;
}
table tr th,
table tr td{
  font-size: 10pt;
  height:25px;
  overflow:hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  border:1px solid blue;
}
    </style>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">  
   $(document).ready(
  function() {
  $('td p').slideUp();
    $('td h2').click(
      function(){
       $(this).siblings('p').slideToggle();
      }
      );
  }
  );
    </script>        
</head>


<body>
<div class=div1>
<?
//$kimdirbu =$_GET["kimdirbu"] 
$aktifTema = guvenlikKontrol($_REQUEST["tema"],"hard");
$yuklenecekSayfa = guvenlikKontrol($_REQUEST["process"],"hard");
$ucur = guvenlikKontrol($_REQUEST["ucur"],"ultra");
$oks = guvenlikKontrol($_REQUEST["oks"],"hard");
$yemail = guvenlikKontrol($_REQUEST["yemail"],"hard");

if ($kimdirbu == "0"){$kimdirbu = $kullaniciAdi;}

//entry id çek
$kimse1=mysql_fetch_array(mysql_query("SELECT * from user where nick='$kimdirbu'"));
$kimse = $kimse1["nick"];
$sontarih = $kimse1["sontarih"];
$verified = $kimse1["verified"];
$saysil = $kimse1["saysil"];
$saycaylak = $kimse1["saycaylak"];

$caylaksin= mysql_fetch_array(mysql_query("SELECT durum FROM user WHERE `nick`='$kimdirbu'"));
$yazarlik= $caylaksin["durum"];

$yetkisi= mysql_fetch_array(mysql_query("SELECT yetki FROM user WHERE `nick`='$kimdirbu'"));
$yetki= $yetkisi["yetki"];

if (($yetki == "mod") or ($yetki=="admin"))
{
  $yetki = "yöneticisi";  
}
else {
  $yetki = "yazarı";
  }

$nesilsira= mysql_fetch_array(mysql_query("SELECT id FROM user WHERE `nick`='$kimdirbu'"));
$nesilid= $nesilsira["id"];

if ($nesilid >= "3907")
{
  $nesil = "üçüncü";  
}

if (($nesilid >= "1428") && ($nesilid < "3907"))
{
  $nesil = "ikinci";  
}

if ($nesilid < "1428")
{
  $nesil = "birinci";  
}
if ($yazarlik == "off")
{
$profilinfo = "$nesil nesil bol sözlük çaylağı ";
}

if ($yazarlik == "on" or $yazarlik =="kurumsal")
{
$profilinfo = "$nesil nesil bol sözlük $yetki ";
}

if ($yazarlik == "sus")
{
$profilinfo = "$nesil nesil bol sözlük siliği ";
}

//if ($yazarlik == "rahmetli")
//{
//$profilinfo = "hala yaşıyor";
//}

if ($kimdirbu == "anonim" or $kimdirbu == "Anonim"  )
{
$profilinfo = "gizemli nesil halk kahramanı ";
}

function strtrlower($text)
{
    $search=array("Ç","İ","i̇","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","i","ı","ğ","ö","ş","ü");

    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}

    $kimdirbu=strtolower($kimdirbu);

if ($kimdirbu == "hayatitelgeler" or $kimdirbu == "fikirsiz" or $kimdirbu == "pek" or $kimdirbu == "lord voldemort" )
{
$profilinfo = "ikinci nesil içerik editörü ";
}


if ($kimdirbu == "bolsozluk" or $kimdirbu == "Bolsozluk"  )
{
$profilinfo = "birinci nesil bol otomasyonu";
}



$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kimdirbu' and `statu` = '' ");
$kactop = mysql_num_rows($sor);

$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kimdirbu'");
$kachamx = mysql_num_rows($sor);
$sor = mysql_query("select yazar,statu from mesajlar WHERE `ilkyazar`='$kimdirbu'");
$kachamy = mysql_num_rows($sor);
if ($kachamx > $kachamy) $kacham = $kachamx;
if ($kachamx <= $kachamy) $kacham = $kachamy;



$sor = mysql_query("select yazar,statu from mesajlar WHERE `yazar`='$kimdirbu' and `statu` = 'silindi' ");
$kac = mysql_num_rows($sor);

$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kimdirbu' and `oy` = '1'");
$arti = mysql_num_rows($sor);

$sor = mysql_fetch_array(mysql_query("select karma from user WHERE `nick`='$kimdirbu'"));
$karma = $sor["karma"];

if ($kulYetki == "allah") //KARMATEST
{
echo "--kH:";
echo $kacham;

echo "--k0:";
echo $karmak0;
echo "--k1:";
echo $karmak1;
echo "--k2:";
echo $karmak2;

echo "--kN:";
echo $karmaneg;
echo "--saysil:";
echo $saysil;
echo "--saycaylak:";
echo $saycaylak;
echo "--kpi:";
echo $kpi;
echo "--karma:";
echo $karma;
}

if ($kactop < 300) $karma = 0; 
if ($karma < -300) $karma = -300; 
if ($karma > 1000) $karma = 1000; 


//ROZET GÖSTERME
/*
1 imececi: compilation başlıklarına entry girmiş (organizasyon başlıklarına >3)
10 gece tayfası: gece entry girenler (şimdilik gece tayfası > 125)
100 ebe: en babalarda entrysi olan
1000 respectful: 100'den fazla artı vermiş

10000 9 canlı: hiç çaylaklanmamış
100000 sevilen: 2500'den fazla artı almış
1000000 arsivci: bulunamayan album ve parcalar basligina 10'dan fazla katki vermis
10000000 temiz: hukuki sebeplerle hiç entrysi silinmemiş

100000000 bol yazar: 2000'den fazla entry girmiş
1000000000 sol frame canavarı: 250'den fazla başlık açan
10000000000 rapstar: 100'den fazla takipçisi olan yazar
100000000000 argeci: sözlükle ilgili isteklere 10'dan fazla katkı vermiş
*/

$sor = mysql_fetch_array(mysql_query("select rozet from user WHERE `nick`='$kimdirbu'"));
$rozet= $sor["rozet"];

$imece = 0;
$gececi = 0;
$sevilen = 0;
$bolyazar = 0;
$solfc = 0;
$argeci = 0;
$arsivci = 0;

if ($rozet>=1) $imece = substr($rozet, -1, 1); 
if ($rozet>=10) $gececi = substr($rozet, -2, 1);
if ($rozet>=100000) $sevilen = substr($rozet, -6, 1); 
if ($rozet>=1000000) $arsivci = substr($rozet, -7, 1); 
if ($rozet>=100000000) $bolyazar = substr($rozet, -9, 1); 
if ($rozet>=1000000000) $solfc = substr($rozet, -10, 1); 
if ($rozet>=10000000000) $argeci = substr($rozet, -11, 1);
?>
  <table>
  <thead>
    <tr>
      <th><? /* if($verified=="1"){ echo "<img src=\"https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-gold-512.png\" title=\"onaylı hesap\" width=32 height=32> <font size=1>";}*/?> 
        <? if($kimse){ echo "<a href=\"sozluk.php?process=word&q=$kimdirbu\" title=\"$kimdirbu\" ><font size=1>$kimdirbu </A> -  $profilinfo"; //desktop için target main eklenebilir.
echo "<br><a class=link> <a href='sozluk.php?process=arkadasekle&n=$kimdirbu' title='arkadaşım olsun'>(arkadaş ekle)</a> <a href='sozluk.php?process=dusmanekle&n=$kimdirbu' title='düşmanım olsun'>(engelle)</a><br>";
      }else{echo "böyle biri yok";die;exit;}
      
      
      $sorgu = "SELECT * FROM user WHERE `nick` = '$kimdirbu'";
			$sorgulama = @mysql_query($sorgu);
			
			if (@mysql_num_rows($sorgulama)>0){
			
				while ($kayit=@mysql_fetch_array($sorgulama)){
					
					$avatar=$kayit["avatar"];
					if ($avatar == "") $avatar = "https://ekstat.com/img/default-profile-picture-light.svg"; 
				}}
      
      
      echo "<br><center><div style=\"width: 125px; height: 125px; border-radius: 50%; overflow: hidden;\">
			<img src=\"$avatar\" alt=\"Avatar\" style=\"width: 100%; height: 100%; object-fit: cover;\">
		  </div></center>";
      ?>

      

        <? if($verified=="1"){ echo "<img src=\"https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-gold-512.png\" title=\"onaylı hesap\" width=32 height=32> <font size=1>";}?>
<?if (($rozet!="0") and ($rozet!="000000000000")) {?>

<br><br><? if($imece=="1"){ echo "<img src=\"/bolrozet/imececi.png\" title=\"imececi\" width=32 height=32> <font size=1>";}
if($gececi=="1"){ echo "<img src=\"/bolrozet/gececi.png\" title=\"gece tayfası\" width=32 height=32> <font size=1>";}
if($sevilen=="1"){ echo "<img src=\"/bolrozet/sevilen.png\" title=\"sevilen\" width=32 height=32> <font size=1>";}
if($bolyazar=="1"){ echo "<img src=\"/bolrozet/bolyazar.png\" title=\"bol yazar\" width=32 height=32> <font size=1>";}
if($solfc=="1"){ echo "<img src=\"/bolrozet/solfc.png\" title=\"sol frame canavarı\" width=32 height=32> <font size=1>";}
if($argeci=="1"){ echo "<img src=\"/bolrozet/argeci.png\" title=\"argeci\" width=32 height=32> <font size=1>";}
if($arsivci=="1"){ echo "<img src=\"/bolrozet/arsivci.png\" title=\"arşivci\" width=32 height=32> <font size=1>";}
}

?>

        <br><i><h2><? if(($kimse) and ($karma !=0)){
//GEÇİCİ DEVRE DIŞI


      if ($karma <=-300) echo"wack emcee ($karma)" ;
      if (($karma >=-250) & ($karma <-200)) echo"kebo gang ($karma)" ;
      if (($karma >=-200) & ($karma <-150)) echo"bağcılar şamanı ($karma)" ;  
      if (($karma >=-150) & ($karma <-100)) echo"kavdeşim helikoptev ($karma)" ;
      if (($karma >=-100) & ($karma <-50)) echo"lil funky ($karma)" ;  
      if (($karma >=-50) & ($karma <0)) echo"mc ökkeş ($karma)" ;
      if (($karma >=0) & ($karma <50)) echo"newschool yazar ($karma)" ;  
      if (($karma >=50) & ($karma <100)) echo"rapin oğlu ($karma)" ;
      if (($karma >=100) & ($karma <150)) echo"baby scratch ($karma)" ;  
      if (($karma >=150) & ($karma <200)) echo"fl studio müptelası ($karma)" ;
      if (($karma >=200) & ($karma <250)) echo"crew member ($karma)" ;  
      if (($karma >=250) & ($karma <300)) echo"gecelerin writerı ($karma)" ;
      if (($karma >=300) & ($karma <350)) echo"bol type beat ($karma)" ;  
      if (($karma >=350) & ($karma <400)) echo"sokaktan gelen ses ($karma)" ;  
      if (($karma >=400) & ($karma <450)) echo"fıttırık flow ($karma)" ;
      if (($karma >=450) & ($karma <500)) echo"fatalrhymer ($karma)" ;  
      if (($karma >=500) & ($karma <550)) echo"bombing canavarı ($karma)" ;
      if (($karma >=550) & ($karma <600)) echo"freestyle king ($karma)" ;  
      if (($karma >=600) & ($karma <650)) echo"rapstar ($karma)" ;
      if (($karma >=650) & ($karma <700)) echo"psikopat yazar ($karma)" ;  
      if (($karma >=700) & ($karma <750)) echo"kafakopter ($karma)" ;
      if (($karma >=750) & ($karma <800)) echo"karizmatik emmi ($karma)" ;  
      if (($karma >=800) & ($karma <850)) echo"nkvt liste başı ($karma)" ;  
      if (($karma >=850) & ($karma <900)) echo"kabus kerim ($karma)" ;
      if (($karma >=900) & ($karma <950)) echo"rapüstad ($karma)" ;  
      if (($karma >=950) & ($karma <=1000)) echo"grandmaster ($karma)" ;  
 

      //GEÇİCİ DEVRE DIŞI

$sor = mysql_fetch_array(mysql_query("select motto from user WHERE `nick`='$kimdirbu'"));
$motto= $sor["motto"];

       }

       if ($motto != "")
       {
       echo "<font size=1><br>";
       echo '"'.$motto.'"';
       echo "</font>";
       }
       
       ?></h4></i>
        <i><h4><?
$sontarih = date("m/Y", strtotime($sontarih));
if ($sontarih == "01/1970") $sontarih = "uzun süredir görülmedi." ;
echo"son görülme: $sontarih" ; 

         ?></h2></i>

        </th>
    </tr>
  </thead>
  <tbody>
    <tr>
       <tr>
<td><h2><font size=2>genel istatistikler <img src="https://i.imgur.com/nN02j0l.png" width=32 height=32> </h2><p>
   <?

echo "<b><font size=1>Entry sayınız:</b> $kactop<br>";
echo "<b>Silinen entry sayınız:</b> $kac<br>";
echo "<b>Toplam artı oy sayınız:</b> $arti<br>";
$artioran = round($arti / $kactop,2);
echo "<b>artılanma oranınız:</b> $artioran<br>";
echo "<b>Silinen sakıncalı entry sayınız:</b> $saysil<br>";
echo "<b>Çaylaklık cezası alma sayınız:</b> $saycaylak<br>";

//$sor = mysql_query("select oy from oylar WHERE `entry_sahibi`='$kimdirbu' and oy = 0");
//$eksi = mysql_num_rows($sor);
//echo "<b>Toplam eksi oy sayınız:</b> $eksi<br>";

//$ortalama = $arti - $eksi;
//$toplam = $arti + $eksi;
//echo "<b>Toplam oy sayınız:</b> $toplam<br>";



//echo "<b>Toplam oy sayiniz:</b> $toplam<br>";
//echo "<b>Ortalama oy sayiniz:</b> $ortalama<br>";


if ($karma != NULL) echo "<b>Karma puanınız:</b> $karma<br>";
if ($karma == NULL) echo "<b>Karma puanınız:</b> geçici olarak gösterilememektedir.<br>";

?>
</tr>
<td><h2><font size=2>son sözleri <img src="https://i.imgur.com/nN02j0l.png" width=32 height=32> </h2><p>
<?
$listele1 = mysql_query("SELECT id FROM mesajlar WHERE yazar='$kimdirbu' AND statu='' ORDER BY id desc limit 0,10");
while($row = mysql_fetch_array($listele1)){

$base1 = $row["id"];
$listele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$base1'"));
$base11 = $listele11["sira"];
$sonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$base11'"));
$sonbaslik1 = $sonbaslik11["baslik"];
$gds = $sonbaslik11["gds"];
$ssonbaslik2 = ereg_replace(" ","+",$sonbaslik1);
if ($gds !='s') {
  ++$sayi;
echo "<font size=1>$sayi. <a href=?process=word&q=$ssonbaslik2 target=blank>$sonbaslik1</a> - <a href=?process=eid&eid=$base1 target=blank>#$base1</a><br>"; }
}
?> 

    </tr>
    <tr>
<td><h2><font size=2>best of <img src="https://i.imgur.com/nN02j0l.png" width=32 height=32></h2><p>
<?
//bestof
$bestofs = mysql_query("SELECT entry_id, SUM(oy) as toplam FROM oylar WHERE entry_sahibi='$kimdirbu' GROUP BY entry_id ORDER BY toplam DESC LIMIT 0,10");
$sayi=0;
while($row = mysql_fetch_array($bestofs) ){

$bentry = $row['entry_id'];
$bentryt = $row['toplam'];
$silindimi =  mysql_fetch_array(mysql_query("SELECT id FROM mesajlar WHERE id='$bentry' and statu !='silindi'"));
if ($silindimi){
$blistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$bentry'"));
$bbase11 = $blistele11["sira"];
$bsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$bbase11'"));
$bsonbaslik1 = $bsonbaslik11["baslik"];
$gds = $bsonbaslik11["gds"];
$bsonbaslik2 = ereg_replace(" ","+",$bsonbaslik1);
if ($gds !='s') {
    ++$sayi;
echo "<font size=1>$sayi. <a href=?process=word&q=$bsonbaslik2 target=blank>$bsonbaslik1</a> - <a href=?process=eid&eid=$bentry target=blank>#$bentry</a> - $bentryt oy<br>";
}
}
}
?>
</tr>
       <tr>
<td><h2><font size=2>son alkışlananları <img src="https://i.imgur.com/nN02j0l.png" width=32 height=32></h2><p>
<?
$sayi=0;
$sayiecho=0;
$ylistele1 = mysql_query("SELECT nick FROM oylar WHERE entry_sahibi='$kimdirbu' AND oy='1' ORDER BY id DESC LIMIT 0,10");

while($row = mysql_fetch_array($ylistele1)){

++$sayi;
++$sayiecho;
$sayix = ($sayi-1);
$ybase1 = $row["nick"];
$xlistele1 = mysql_fetch_array(mysql_query("SELECT entry_id FROM oylar WHERE entry_sahibi='$kimdirbu' AND oy='1' ORDER BY id DESC LIMIT $sayix,1"));
$xbase1 = $xlistele1["entry_id"];
$xlistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$xbase1'"));
$xbase11 = $xlistele11["sira"];
$xsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$xbase11'"));
$xsonbaslik1 = $xsonbaslik11["baslik"];
$gds = $xsonbaslik11["gds"];
$xsonbaslik2 = ereg_replace(" ","+",$xsonbaslik1);
if ($gds !='s') {
    --$sayi;
  echo "<font size=1>$sayiecho. <a href=?process=word&q=$xsonbaslik2 target=blank>$xsonbaslik1</a> - <a href=?process=eid&eid=$xbase1 target=blank>#$xbase1</a> - @$ybase1<br>"; //
  ++$sayi;
}
else{
  --$sayiecho;
  echo ""; //- @$ybase1

}

}
?>
   </tr>

  <? if ($kulYetki == "admin" or $kulYetki == "mod") { ?>

<td><h2><font size=2>son anlaşılamayanları <img src="https://i.imgur.com/nN02j0l.png" width=32 height=32></h2><p>
<?
////adminlere özel
$sayi=0;
$sayiecho=0;
$ylistele1 = mysql_query("SELECT nick FROM oylar WHERE entry_sahibi='$kimdirbu' AND oy='0' ORDER BY id DESC LIMIT 0,10");

while($row = mysql_fetch_array($ylistele1)){
++$sayi;
++$sayiecho;
$sayix = ($sayi-1);
$ybase1 = $row["nick"];
$xlistele1 = mysql_fetch_array(mysql_query("SELECT entry_id FROM oylar WHERE entry_sahibi='$kimdirbu' AND oy='0' ORDER BY id DESC LIMIT $sayix,1"));
$xbase1 = $xlistele1["entry_id"];
$xlistele11 = mysql_fetch_array(mysql_query("SELECT sira FROM mesajlar WHERE id='$xbase1'"));
$xbase11 = $xlistele11["sira"];
$xsonbaslik11=mysql_fetch_array(mysql_query("SELECT baslik,gds from konular where id='$xbase11'"));
$xsonbaslik1 = $xsonbaslik11["baslik"];
$gds = $xsonbaslik11["gds"];
$xsonbaslik2 = ereg_replace(" ","+",$xsonbaslik1);
if ($gds !='s') {
    --$sayi;
echo "<font size=1>$sayiecho. <a href=?process=word&q=$xsonbaslik2 target=blank>$xsonbaslik1</a> - <a href=?process=eid&eid=$xbase1 target=blank>#$xbase1</a> - @$ybase1 <br>";
 ++$sayi;
}
else{
  --$sayiecho;
  echo ""; //- @$ybase1

}
}
?>
   </tr>

         <? } ?>



  </tbody>
</table>
<?

if ($isMobile == 0)
{
?>
<FORM action="sozluk.php?process=entryliste&kimdirbu=<?echo"$kimdirbu";?>" method=post target=main>
  <p>
    <INPUT type=hidden value=ok name=okmu>
</p>

<?}

if ($isMobile == 1)
{
?>
<FORM action="sozluk.php?process=entryliste&kimdirbu=<?echo"$kimdirbu";?>" method=post>
  <p>
    <INPUT type=hidden value=ok name=okmu>
</p>

<?}


$sorgu = "SELECT * FROM user WHERE nick='$kullaniciAdi'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$yetki=$kayit["yetki"];

//if ($yetki == "admin" or $kullaniciAdi == "$kimdirbu") //GBT YETKİSİ
if ($kullaniciAdi)
{
  //echo $yetki;
  ?>

    <tr>
      <td><input type="submit" name="Submit" value="Tüm entrylerini getir"></td>
    </tr>
<?
}
?>
    </form>    <br><br>

</div>
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bolsözlük-3 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7994669731946359"
     data-ad-slot="7236998758"></ins>

     <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6313558988007422",
          enable_page_level_ads: true
     });
</script>


<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
<p>&nbsp;</p>
</body>
