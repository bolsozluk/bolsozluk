<style>
.butx {
        border-right: #a6b4d4 2px outset; border-TOP: #a6b4d4 2px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 2px outset; CURSOR: default; color: white; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}
</style>

<center>
<table cellpadding="0" cellspacing="1" class="nav">
<tr>
<td style="height:10px;white-space:nowrap;padding:1px;font-size:x-small"><u>b</u>a$lik <input maxLength=55 onKeyPress="return submitenter(this,event)" class="input" style="height:12px" accesskey="b" id="q" name="q" size="30" placeholder="aramaya inanın"/></td>
<td onClick="javascript:getir2();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="butx"><a title="ogrenelim nedir"> getir </a></td>
<td onClick="javascript:ara2();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="butx"><a title="ara bul"> ara </a></td>
<br>
</tr>
</table></center>
<br>


<?php
session_start();

function strtrlower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}

$sonuc ="";
$q = guvenlikKontrol($_REQUEST["q"],"hard");

if ($q) {
$string=$_GET['q'];

if (!$q) {
echo "<div class=dash><center><b><img src=img/unlem.gif> Müneccim miyim ben ?";
die;
}
echo "<center><input type='button' onclick=\"location.href='basliklar.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='basliklar.php?list=soru';\" value='soru' class='butx'></center><br> ";
    echo "<font class=link>$q ile alakali basliklar..</font><br>";
 //   echo "<small><font class=link>en az 4 harfle aramanız önerilir.</font></small><br><br>";
 
//$SQL="SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik LIKE ('%$string%') LIMIT 1,25 ";
//$SQL="SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik LIKE ('%$string%') ORDER BY (baslik = '$string') desc, length(baslik) LIMIT 1,75";
//$SQL = "SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik LIKE ('%$string%') ORDER BY CHAR_LENGTH(baslik) LIMIT 1,75";
$SQL = "SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik LIKE '%$q%' ORDER BY CHAR_LENGTH(baslik) LIMIT 0,75";




//$SQL2="SELECT baslik,id FROM konular WHERE (statu != 'silindi' and tasi = '') and baslik = '$string'";
 //          $kontrol=mysql_query($SQL2);
 //          $kontrol=mysql_fetch_array($kontrol) ;
  //              if ($kontrol){
   //                 $string = strtrlower($string);
   //         echo "* <a target=\"main\" href=\"sozluk.php?process=word&q=$string\"><font size=2>$string</font></a><br>";

  //      }
    }


    $sorgu=mysql_query($SQL) ;
    if (!$sorgu)
        {
            header('Location: '."left.php?list=today"); 
            //echo "<div class=dash><center><b><img src=img/unlem.gif> başlık ismini gir.";  exit();
        }

        if($q)
        $arguman=0;
        $adet=0;

        while($sira=mysql_fetch_array($sorgu))
            {
                $sonuc[$arguman]=$sira["id"];
                $arguman++;

            }
      
        echo "<div class=div1>";
        for($i=0;$i<(count($sonuc));$i++)
        {
        $SQLx="SELECT * FROM konular WHERE id='$sonuc[$i]' and statu=''";
        $sorgu=mysql_query($SQLx) ;
        while($sira=mysql_fetch_array($sorgu))
        {
        $baslik = $sira["baslik"];
        $baslik = strtolower($baslik);

        echo "* <a target=\"main\" href=\"sozluk.php?process=word&q=$baslik\"><font size=2>$baslik</font></a><br>";
        }
        }
        $SQL="SELECT id FROM konular WHERE baslik='$q' and statu=''";
        $sorgu=mysql_query($SQL);
              ?>
<br>
<script type="text/javascript">
    google_ad_client = "ca-pub-7994669731946359";
    google_ad_slot = "6678616589";
    google_ad_width = 197;
    google_ad_height = 56;
</script>
<!-- bolsearch -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>