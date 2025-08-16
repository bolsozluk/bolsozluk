<?
$xml_ciktisi1="<?xml version=\"1.0\" encoding=\"utf-8\"?><urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">\n";
echo $xml_ciktisi1;
//include "config.php";
session_start();
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();
?>    
<?php           

//$xml_ciktisi = '<' . '?xml version="1.0" encoding="iso 8859-9"?' . '>' . "\n";
//$xml_ciktisi .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";



function strtrlower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}


$isimx=mysql_query("SELECT * FROM konular WHERE statu!='silindi' ORDER BY baslik DESC");;

while($link = mysql_fetch_array($isimx))
{
$haber_id = $link["baslik"];
  $date = date("20y-m-d");

/*$haber_id = ereg_replace("ş","s",$haber_id);
$haber_id = ereg_replace("Ş","S",$haber_id);
$haber_id = ereg_replace("ç","c",$haber_id);
$haber_id = ereg_replace("Ç","C",$haber_id);
$haber_id = ereg_replace("ı","i",$haber_id);
$haber_id = ereg_replace("İ","I",$haber_id);
$haber_id = ereg_replace("ğ","g",$haber_id);
$haber_id = ereg_replace("Ğ","G",$haber_id);
$haber_id = ereg_replace("ö","o",$haber_id);
$haber_id = ereg_replace("Ö","O",$haber_id);
$haber_id = ereg_replace("ü","u",$haber_id);
$haber_id = ereg_replace("Ü","U",$haber_id);
$haber_id = ereg_replace("Ö","O",$haber_id); */
$haber_id = strtrlower($haber_id);
$haber_id = ereg_replace(" ","+",$haber_id); //xml

$xml_ciktisi .= "<url>
                          <loc>http://www.bolsozluk.com/$haber_id-1.html</loc>
                          <lastmod>$date</lastmod>
                              <changefreq>hourly</changefreq>
                              <priority>1.0</priority>
                              </url>\n";


                       
};

$xml_ciktisi .= "</urlset>\n";

echo $xml_ciktisi;
        
?>