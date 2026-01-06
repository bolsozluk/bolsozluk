<?
$xml_ciktisi1="<?xml version=\"1.0\" encoding=\"utf-8\"?><urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">\n";
echo $xml_ciktisi1;

$xml_ciktisi = "";

session_start();
include "icerik/baglan.php";
include "icerik/fonksiyonlar.php";
vtBaglan();
kontrolEt();
?>    
<?php           


function strtrlower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}


$isimx = mysql_query("SELECT * FROM konular WHERE statu!='silindi' ORDER BY baslik DESC LIMIT 49999");

while($link = mysql_fetch_array($isimx))
{
$haber_id = $link["baslik"];
  $date = date("20y-m-d");

$haber_id = strtrlower($haber_id);
$haber_id = preg_replace("/ /","+",$haber_id); //xml

$xml_ciktisi .= "<url>
                          <loc>https://www.bolsozluk.com/$haber_id-1.html</loc>
                          <lastmod>$date</lastmod>
                              <changefreq>hourly</changefreq>
                              <priority>1.0</priority>
                              </url>\n";
                       
};

$xml_ciktisi .= "</urlset>\n";

echo $xml_ciktisi;
        
?>
