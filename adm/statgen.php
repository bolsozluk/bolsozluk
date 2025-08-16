<?

//

$sorgu = "SELECT entry_id,entry_sahibi,oy FROM oylar ORDER by oy desc";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$entry_id=$kayit["entry_id"];
$entry_sahibi=$kayit["entry_sahibi"];
$oy=$kayit["oy"];

$sorgu = "SELECT id,sira FROM mesajlar WHERE id = '$entry_id'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$sira=$kayit["sira"];

$sorgu = "SELECT id,baslik FROM konular WHERE id = '$sira'";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$baslik=$kayit["baslik"];

}
}



$sor = mysql_query("select tema from user where tema = '' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);

$sor = mysql_query("select tema from user where tema = 'default'");
$aktifTemasay2 = mysql_num_rows($sor);

$aktifTemasay = $aktifTemasay + $aktifTemasay2;

$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='default'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'turuncu' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='turuncu'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'dark' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='dark'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'siyahyesil' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='siyahyesil'";
mysql_query($sorgu);


$sor = mysql_query("select tema from user where tema = 'sut' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='sut'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'ufuk' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='ufuk'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'pembe' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='pembe'";
mysql_query($sorgu);

$sor = mysql_query("select tema from user where tema = 'ilktema' and durum != 'sus'");
$aktifTemasay = mysql_num_rows($sor);
$sorgu = "UPDATE temalar SET stat = '$aktifTemasay' WHERE tema ='ilktema'";
mysql_query($sorgu);






$sorgu = "SELECT id FROM konular ORDER by id desc";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$baslik=$kayit["id"];

$sor = mysql_query("select id from konular where statu = 'silindi'");
$silbaslik = mysql_num_rows($sor);

$sorgu = "SELECT id FROM mesajlar ORDER by id desc";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$entry=$kayit["id"];

$yyil = date("Y");
$cMon = date("m");
$dMon = $cMon - 1;
$eMon = $cMon - 2;
$gyil = $yyil;
$gyilold = $yyil;
$gyilnew = $yyil;

if ($cMon == 1)
{
	$dMon = 12;
	$eMon = 11;
	$gyilold = $yyil-1;
	$gyilnew = $yyil-1;
}

if ($cMon == 2)
{
	$dMon = 1;
	$eMon = 12;
	$gyilold = $yyil-1;
	$gyilnew = $yyil;
}


$sorgu = "SELECT id FROM mesajlar WHERE ay='$eMon' and yil ='$gyilold' ORDER by id desc ";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$g2entry=$kayit["id"];
//echo $g2entry;
$sorgu = "SELECT id FROM mesajlar WHERE ay='$dMon' and yil ='$gyilnew' ORDER by id desc ";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$g1entry=$kayit["id"];
//echo $g1entry;
//$gentry=$g1entry-$g2entry;
$sorgu = "SELECT * from mesajlar WHERE statu ='' AND id between $g2entry and $g1entry";
$sorgulama = mysql_query($sorgu);
$gentry=mysql_num_rows($sorgulama);
//echo $g2entry;
//echo $g1entry;
//echo $gentry;
//$gentry=$kayit["id"];
$sorgu = "SELECT id FROM mesajlar WHERE ay='$dMon' and yil ='$gyilnew' ORDER by id desc ";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$g3entry=$kayit["id"];
echo $g3entry;
$sorgu = "SELECT id FROM mesajlar WHERE ay='$cMon' and yil ='$yyil' ORDER by id desc ";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$g4entry=$kayit["id"];
echo $g4entry;
//$gentry=$g1entry-$g2entry;
$sorgu = "SELECT * from mesajlar WHERE statu ='' AND id between $g3entry and $g4entry";
$sorgulama = mysql_query($sorgu);
$bentry=mysql_num_rows($sorgulama);
//echo $bentry;




$sorgu = "SELECT * from mesajlar WHERE statu ='' AND id between $g3entry and $g4entry";
$sorgulama = mysql_query($sorgu);
$bentry=mysql_num_rows($sorgulama);
//echo $bentry;



$sor = mysql_query("select id from mesajlar where statu = 'silindi'");
$silentry = mysql_num_rows($sor);


$t = 0;
$sorgu = "SELECT hit,id,baslik FROM konular WHERE statu = ''";
$sorgulama = mysql_query($sorgu);
if (mysql_num_rows($sorgulama)>0){
while ($kayit=mysql_fetch_array($sorgulama)){
$hit=$kayit["hit"];
$gbaslik=$kayit["baslik"];
$id=$kayit["id"];
if ($hit > $tophit and $gbaslik != "bol sözlük gece tayfası" and $gbaslik != "bol sözlük gündüz tayfası" and $gbaslik != "bol itiraf" and $gbaslik != "çalbendinlerim" and $gbaslik != "şu an ne dinliyorsun" and $gbaslik != "sözlükle ilgili istekler" and $gbaslik != "yazarların yaptığı beatler") {
$tophit = $hit;
$enhit = $id;
}
}
}
$sorgu = "SELECT hit,id,baslik FROM konular WHERE id = $enhit";
$sorgulama = mysql_query($sorgu);
$kayit=mysql_fetch_array($sorgulama);
$enhitbaslik=$kayit["baslik"];


$listele = mysql_query("SELECT hit FROM konular");
while ($kayit=mysql_fetch_array($listele)) {
$hit=$kayit["hit"];
$totalhit = $totalhit + $hit;
}
$hits = $totalhit;

$listele = mysql_query("SELECT hit FROM ayar");
$kayit=mysql_fetch_array($listele);
$tekil=$kayit["hit"];

$sor3 = mysql_query("select id from user WHERE durum = 'on'");
$yazar = mysql_num_rows($sor3);

$sor3 = mysql_query("select id from user WHERE durum = 'off'");
$okur = mysql_num_rows($sor3);

$sor3 = mysql_query("select id from user WHERE yetki = 'mod'");
$mod = mysql_num_rows($sor3);

$sor3 = mysql_query("select id from user WHERE durum = 'sus'");
$pilot = mysql_num_rows($sor3);

$sor3 = mysql_query("select id from user WHERE durum = 'rahmetli'");
$rahmetli = mysql_num_rows($sor3);

$sor3 = mysql_query("select id from user WHERE yetki = 'admin'");
$admin = mysql_num_rows($sor3);

$biryazq = mysql_query("select id from user WHERE durum = 'on' AND id<1419");
$biryaz = mysql_num_rows($biryazq);

$ikiyazq = mysql_query("select id from user WHERE durum = 'on' AND id>=1419 AND id<3907");
$ikiyaz = mysql_num_rows($ikiyazq);

$ucyazq = mysql_query("select id from user WHERE durum = 'on' AND id>=3907");
$ucyaz = mysql_num_rows($ucyazq);

$ortbaslik = $baslik / $yazar;
$ortentry = $entry / $yazar;

$ortbaslik = ceil($ortbaslik);
$ortentry = ceil($ortentry);

$sorgu = "UPDATE stat SET baslik = '$baslik'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET entry = '$entry'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET silbaslik = '$silbaslik'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET silentry = $silentry";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET hit = '$hits'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET tekil = '$tekil'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET yazar = '$yazar'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET okur = '$okur'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET moderat = '$mod'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET op = '$op'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET pilot = '$pilot'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET rahmetli = '$rahmetli'";
mysql_query($sorgu);


$sorgu = "UPDATE stat SET admin = '$admin'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET ortbaslik = '$ortbaslik'";
mysql_query($sorgu);


$sorgu = "UPDATE stat SET ortentry = '$ortentry'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET enhitbaslik = '$enhitbaslik'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET biryaz = '$biryaz'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET ikiyaz = '$ikiyaz'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET ucyaz = '$ucyaz'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET gentry = '$gentry'";
mysql_query($sorgu);

$sorgu = "UPDATE stat SET bentry = '$bentry'";
mysql_query($sorgu);

$tarih = date("d/m/Y H:i");

$sorgu = "UPDATE stat SET tarih = '$tarih'";
mysql_query($sorgu);






$listele = mysql_query("SELECT entry_id, SUM(oy) as toplam FROM oylar GROUP BY entry_id ORDER BY toplam DESC LIMIT 0,20");
while ($kayit=mysql_fetch_array($listele)) {
$entry_id=$kayit["entry_id"];
$sayi++;
$sorgu = "UPDATE stat SET eniyientry$sayi = '$entry_id'";
mysql_query($sorgu);
}
	


	$sorgu1 = "SELECT * FROM stat";
	$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit3=mysql_fetch_array($sorgu2);
	$eniyientry1=$kayit3["eniyientry1"];
	$eniyientry2=$kayit3["eniyientry2"];
	$eniyientry3=$kayit3["eniyientry3"];
	$eniyientry4=$kayit3["eniyientry4"];
	$eniyientry5=$kayit3["eniyientry5"];
	$eniyientry6=$kayit3["eniyientry6"];
	$eniyientry7=$kayit3["eniyientry7"];
	$eniyientry8=$kayit3["eniyientry8"];
	$eniyientry9=$kayit3["eniyientry9"];
	$eniyientry10=$kayit3["eniyientry10"];
    $eniyientry11=$kayit3["eniyientry11"];
	$eniyientry12=$kayit3["eniyientry12"];
	$eniyientry13=$kayit3["eniyientry13"];
	$eniyientry14=$kayit3["eniyientry14"];
	$eniyientry15=$kayit3["eniyientry15"];
    $eniyientry16=$kayit3["eniyientry16"];
  $eniyientry17=$kayit3["eniyientry17"];
  $eniyientry18=$kayit3["eniyientry18"];
  $eniyientry19=$kayit3["eniyientry19"];
  $eniyientry20=$kayit3["eniyientry20"];
$sira11 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry1'"));
$sira1 = $sira11["sira"];
$eniyibaslik11=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira1'"));
$eniyibaslik1 = $eniyibaslik11["baslik"];
mysql_query("UPDATE stat SET eniyibaslik1 = '$eniyibaslik1'");

$sira22 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry2'"));
$sira2 = $sira22["sira"];
$eniyibaslik22=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira2'"));
$eniyibaslik2 = $eniyibaslik22["baslik"];
mysql_query("UPDATE stat SET eniyibaslik2 = '$eniyibaslik2'");

$sira33 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry3'"));
$sira3 = $sira33["sira"];
$eniyibaslik33=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira3'"));
$eniyibaslik3 = $eniyibaslik33["baslik"];
mysql_query("UPDATE stat SET eniyibaslik3 = '$eniyibaslik3'");

$sira44 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry4'"));
$sira4 = $sira44["sira"];
$eniyibaslik44=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira4'"));
$eniyibaslik4 = $eniyibaslik44["baslik"];
mysql_query("UPDATE stat SET eniyibaslik4 = '$eniyibaslik4'");

$sira55 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry5'"));
$sira5 = $sira55["sira"];
$eniyibaslik55=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira5'"));
$eniyibaslik5 = $eniyibaslik55["baslik"];
mysql_query("UPDATE stat SET eniyibaslik5 = '$eniyibaslik5'");

$sira66 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry6'"));
$sira6 = $sira66["sira"];
$eniyibaslik66=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira6'"));
$eniyibaslik6 = $eniyibaslik66["baslik"];
mysql_query("UPDATE stat SET eniyibaslik6 = '$eniyibaslik6'");

$sira77 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry7'"));
$sira7 = $sira77["sira"];
$eniyibaslik77=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira7'"));
$eniyibaslik7 = $eniyibaslik77["baslik"];
mysql_query("UPDATE stat SET eniyibaslik7 = '$eniyibaslik7'");

$sira88 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry8'"));
$sira8 = $sira88["sira"];
$eniyibaslik88=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira8'"));
$eniyibaslik8 = $eniyibaslik88["baslik"];
mysql_query("UPDATE stat SET eniyibaslik8 = '$eniyibaslik8'");

$sira99 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry9'"));
$sira9 = $sira99["sira"];
$eniyibaslik99=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira9'"));
$eniyibaslik9 = $eniyibaslik99["baslik"];
mysql_query("UPDATE stat SET eniyibaslik9 = '$eniyibaslik9'");

$siraxx = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry10'"));
$sirax = $siraxx["sira"];
$eniyibaslikxx=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sirax'"));
$eniyibaslik10 = $eniyibaslikxx["baslik"];
mysql_query("UPDATE stat SET eniyibaslik10 = '$eniyibaslik10'");

$siraonbir = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry11'"));
$siraonbirx = $siraonbir["sira"];
$eniyibaslik11x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonbirx'"));
$eniyibaslik11 = $eniyibaslik11x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik11 = '$eniyibaslik11'");

$siraoniki = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry12'"));
$siraonikix = $siraoniki["sira"];
$eniyibaslik12x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonikix'"));
$eniyibaslik12 = $eniyibaslik12x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik12 = '$eniyibaslik12'");

$siraonuc = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry13'"));
$siraonucx = $siraonuc["sira"];
$eniyibaslik13x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonucx'"));
$eniyibaslik13 = $eniyibaslik13x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik13 = '$eniyibaslik13'");

$siraondort = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry14'"));
$siraondortx = $siraondort["sira"];
$eniyibaslik14x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraondortx'"));
$eniyibaslik14 = $eniyibaslik14x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik14 = '$eniyibaslik14'");

$siraonbes = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry15'"));
$siraonbesx = $siraonbes["sira"];
$eniyibaslik15x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonbesx'"));
$eniyibaslik15 = $eniyibaslik15x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik15 = '$eniyibaslik15'");

$siraonalti = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry16'"));
$siraonaltix = $siraonalti["sira"];
$eniyibaslik16x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonaltix'"));
$eniyibaslik16 = $eniyibaslik16x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik16 = '$eniyibaslik16'");

$siraonyedi = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry17'"));
$siraonyedix = $siraonyedi["sira"];
$eniyibaslik17x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonyedix'"));
$eniyibaslik17 = $eniyibaslik17x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik17 = '$eniyibaslik17'");

$siraonsekiz = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry18'"));
$siraonsekizx = $siraonsekiz["sira"];
$eniyibaslik18x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraonsekizx'"));
$eniyibaslik18 = $eniyibaslik18x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik18 = '$eniyibaslik18'");

$siraondokuz = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry19'"));
$siraondokuzx = $siraondokuz["sira"];
$eniyibaslik19x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$siraondokuzx'"));
$eniyibaslik19 = $eniyibaslik19x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik19 = '$eniyibaslik19'");

$sirayirmi = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$eniyientry20'"));
$sirayirmix = $sirayirmi["sira"];
$eniyibaslik20x=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sirayirmix'"));
$eniyibaslik20 = $eniyibaslik20x["baslik"];
mysql_query("UPDATE stat SET eniyibaslik20 = '$eniyibaslik20'");



$listele2 = mysql_query("SELECT yazar, COUNT(*) as adet FROM mesajlar WHERE statu !='silindi' AND yazar !='uim' AND yazar !='anonim'  GROUP BY yazar ORDER BY adet DESC LIMIT 0,19");
while ($kayit2=mysql_fetch_array($listele2)) {
$yazar1=$kayit2["yazar"];
$adetx=$kayit2["adet"];
$sayix++;
$sorgu3 = "UPDATE stat SET encokyazar$sayix = '$yazar1'";
$sorgu4 = "UPDATE stat SET adet$sayix = '$adetx'";
mysql_query($sorgu3);
mysql_query($sorgu4);

}

$listelep = mysql_query("SELECT kime, COUNT(*) as adet FROM privmsg GROUP BY kime ORDER BY adet DESC LIMIT 0,10");
while ($kayitp2=mysql_fetch_array($listelep)) {
$yazarp1=$kayitp2["kime"];
$adetpx=$kayitp2["adet"];
$sayipx++;
$sorgup3 = "UPDATE stat SET pyazar$sayipx = '$yazarp1'";
$sorgup4 = "UPDATE stat SET padet$sayipx = '$adetpx'";
mysql_query($sorgup3);
mysql_query($sorgup4);

}


$listele3 = mysql_query("SELECT nick, COUNT(*) as oyadet FROM oylar WHERE nick !='uim' GROUP BY nick ORDER BY oyadet DESC LIMIT 0,15");
while ($kayit3=mysql_fetch_array($listele3)) {
$yazar2=$kayit3["nick"];
$oyadet=$kayit3["oyadet"];
$sayixx++;
$sorgu5 = "UPDATE stat SET oycu$sayixx = '$yazar2'";
$sorgu6 = "UPDATE stat SET encokoy$sayixx = '$oyadet'";
mysql_query($sorgu5);
mysql_query($sorgu6);

}

/////////////////////////////DEBE

$gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
		$julyend = ($julyen - 1);
		$sayi=0;

//JULYEND
$listeled = mysql_query("SELECT entry_id, SUM(oy) as toplam FROM oylar WHERE julyen='$julyend' GROUP BY entry_id ORDER BY toplam DESC LIMIT 0,5");
while ($kayitd=mysql_fetch_array($listeled)) {
$dentry_id=$kayitd["entry_id"];
$sayi++;
$sorgu = "UPDATE debe SET eniyientry$sayi = '$dentry_id'";
mysql_query($sorgu);
}

$sorgu1 = "SELECT * FROM debe";
$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$deniyientry1=$kayit2["eniyientry1"];
	$deniyientry2=$kayit2["eniyientry2"];
	$deniyientry3=$kayit2["eniyientry3"];

	$deniyientry4=$kayit2["eniyientry4"];
	$deniyientry5=$kayit2["eniyientry5"];

$sira11 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$deniyientry1'"));
$sira1 = $sira11["sira"];
$eniyibaslik11=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira1'"));
$eniyibaslik1 = $eniyibaslik11["baslik"];
mysql_query("UPDATE debe SET eniyibaslik1 = '$eniyibaslik1'");

$sira22 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$deniyientry2'"));
$sira2 = $sira22["sira"];
$eniyibaslik22=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira2'"));
$eniyibaslik2 = $eniyibaslik22["baslik"];
mysql_query("UPDATE debe SET eniyibaslik2 = '$eniyibaslik2'");

$sira33 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$deniyientry3'"));
$sira3 = $sira33["sira"];
$eniyibaslik33=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira3'"));
$eniyibaslik3 = $eniyibaslik33["baslik"];
mysql_query("UPDATE debe SET eniyibaslik3 = '$eniyibaslik3'");


$sira44 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$deniyientry4'"));
$sira4 = $sira44["sira"];
$eniyibaslik44=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira4'"));
$eniyibaslik4 = $eniyibaslik44["baslik"];
mysql_query("UPDATE debe SET eniyibaslik4 = '$eniyibaslik4'");


$sira55 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$deniyientry5'"));
$sira5 = $sira55["sira"];
$eniyibaslik55=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira5'"));
$eniyibaslik5 = $eniyibaslik55["baslik"];
mysql_query("UPDATE debe SET eniyibaslik5 = '$eniyibaslik5'");

/////////////////////////////DEBE

/////////////////////////////HEBE
$gun = date("d");
    $ay = date("m");
    $yil = date("Y");
		$julyen = GregorianToJD($ay, $gun, $yil);
		$julyend = ($julyen - 1);
		$julyene = ($julyen - 2);
		$julyenf = ($julyen - 3);
		$julyeng = ($julyen - 4);
		$julyenh = ($julyen - 5);
		$julyeni = ($julyen - 6);
		$julyenj = ($julyen - 7);
		$sayi=0;

//julyen -> JULYEND
$listeled = mysql_query("SELECT entry_id, SUM(oy) as toplam FROM oylar WHERE (julyen='$julyend' or julyen='$julyene' or julyen='$julyenf' or julyen='$julyeng' or julyen='$julyenh' or julyen='$julyeni' or julyen='$julyenj')   GROUP BY entry_id ORDER BY toplam DESC LIMIT 0,10");
while ($kayitd=mysql_fetch_array($listeled)) {
$dentry_id=$kayitd["entry_id"];
$sayi++;
$sorgu = "UPDATE debe SET hebe$sayi = '$dentry_id'";
mysql_query($sorgu);
}

$sorgu1 = "SELECT * FROM debe";
$sorgu2 = mysql_query($sorgu1);
	mysql_num_rows($sorgu2);
	$kayit2=mysql_fetch_array($sorgu2);
	$heniyientry1=$kayit2["hebe1"];
	$heniyientry2=$kayit2["hebe2"];
	$heniyientry3=$kayit2["hebe3"];
	$heniyientry4=$kayit2["hebe4"];
	$heniyientry5=$kayit2["hebe5"];
	$heniyientry6=$kayit2["hebe6"];
	$heniyientry7=$kayit2["hebe7"];

	$heniyientry8=$kayit2["hebe8"];
	$heniyientry9=$kayit2["hebe9"];
	$heniyientry10=$kayit2["hebe10"];
	

$sira11 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry1'"));
$sira1 = $sira11["sira"];
$eniyibaslik11=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira1'"));
$eniyibaslik1 = $eniyibaslik11["baslik"];
mysql_query("UPDATE debe SET hebeb1 = '$eniyibaslik1'");

$sira22 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry2'"));
$sira2 = $sira22["sira"];
$eniyibaslik22=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira2'"));
$eniyibaslik2 = $eniyibaslik22["baslik"];
mysql_query("UPDATE debe SET hebeb2 = '$eniyibaslik2'");

$sira33 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry3'"));
$sira3 = $sira33["sira"];
$eniyibaslik33=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira3'"));
$eniyibaslik3 = $eniyibaslik33["baslik"];
mysql_query("UPDATE debe SET hebeb3 = '$eniyibaslik3'");

$sira44 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry4'"));
$sira4 = $sira44["sira"];
$eniyibaslik44=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira4'"));
$eniyibaslik4 = $eniyibaslik44["baslik"];
mysql_query("UPDATE debe SET hebeb4 = '$eniyibaslik4'");

$sira55 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry5'"));
$sira5 = $sira55["sira"];
$eniyibaslik55=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira5'"));
$eniyibaslik5 = $eniyibaslik55["baslik"];
mysql_query("UPDATE debe SET hebeb5 = '$eniyibaslik5'");

$sira66 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry6'"));
$sira6 = $sira66["sira"];
$eniyibaslik66=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira6'"));
$eniyibaslik6 = $eniyibaslik66["baslik"];
mysql_query("UPDATE debe SET hebeb6 = '$eniyibaslik6'");

$sira77 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry7'"));
$sira7 = $sira77["sira"];
$eniyibaslik77=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira7'"));
$eniyibaslik7 = $eniyibaslik77["baslik"];
mysql_query("UPDATE debe SET hebeb7 = '$eniyibaslik7'");

$sira88 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry8'"));
$sira8 = $sira88["sira"];
$eniyibaslik88=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira8'"));
$eniyibaslik8 = $eniyibaslik88["baslik"];
mysql_query("UPDATE debe SET hebeb8 = '$eniyibaslik8'");

$sira99 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry9'"));
$sira9 = $sira99["sira"];
$eniyibaslik99=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira9'"));
$eniyibaslik9 = $eniyibaslik99["baslik"];
mysql_query("UPDATE debe SET hebeb9 = '$eniyibaslik9'");

$sira100 = mysql_fetch_array(mysql_query("SELECT sira from mesajlar where id='$heniyientry10'"));
$sira10 = $sira100["sira"];
$eniyibaslik100=mysql_fetch_array(mysql_query("SELECT baslik from konular where id='$sira10'"));
$eniyibaslik10 = $eniyibaslik100["baslik"];
mysql_query("UPDATE debe SET hebeb10 = '$eniyibaslik10'");

/////////////////////////////HEBE

////karma puanı START 

/* 
şuku/entry oranı

$i=0;
while ($i <= 10){
$y=($i+1);
$listelek1 = mysql_query("SELECT yazar, COUNT(*) as adet FROM mesajlar WHERE statu !='silindi' AND yazar !='anonim'  GROUP BY yazar ORDER BY adet DESC LIMIT $i,$y");
$kayitk1=mysql_fetch_array($listelek1); 
$karma1=$kayitk1["yazar"];
$karma2=$kayitk1["adet"];
$listelek2 = mysql_query("SELECT entry_sahibi, SUM(oy) as toplam FROM oylar WHERE (oy='1' AND entry_sahibi='$karma1') GROUP BY entry_sahibi ORDER BY toplam DESC LIMIT 0,1");
$kayitk2=mysql_fetch_array($listelek2);
$karma3=$kayitk2["toplam"];
$karma4=($karma3/$karma2);
$karma4=round($karma4, 3);	
echo "$karma1 - $karma4 <br>";
$i++;
}
*/
////karma puanı END

$cMon = date("m") - 0;
$cMon1 = date("m") - 1;
$cMon2 = date("m") - 2;
//echo "__:";
//echo $cMon;
//echo $cMon1;
//echo $cMon2;

$listele4 = mysql_query("SELECT yazar, COUNT(*) as adet FROM mesajlar WHERE statu !='silindi' AND (yil = '$yil' AND ay = $cMon) GROUP BY yazar ORDER BY adet DESC LIMIT 0,10");
while ($kayit4=mysql_fetch_array($listele4)) {
$yazar3=$kayit4["yazar"];
$ucadetx=$kayit4["adet"];
$sayixxx++;
$sorgu7 = "UPDATE stat SET ucyazar$sayixxx = '$yazar3'";
$sorgu8 = "UPDATE stat SET ucadet$sayixxx = '$ucadetx'";
mysql_query($sorgu7);
mysql_query($sorgu8);

}

//$sorgureset = "UPDATE user set reset=0";
//mysql_query($sorgureset);
$fladreset = "UPDATE user set flood=0";
mysql_query($fladreset);

echo "<center><b>istatistikler güncelleniyor...($tarih)</b></center>";
//echo $listele2;
//echo $kayit2;
//echo $yazar1;
?>