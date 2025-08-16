<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="article">
<meta property="og:image" content="http://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>
</head>
<SCRIPT language=javascript src="inc/sozluk.js"></SCRIPT>

<?
extract($_REQUEST);
//bunu silebilirim
$gkime = guvenlikKontrol($_REQUEST["gkime"],"hard");
$cevap = guvenlikKontrol($_REQUEST["cevap"],"ultra");
$gmesaj = guvenlikKontrol($_REQUEST["gmesaj"],"med");

echo "
<TABLE cellSpacing=3 cellPadding=3 width=\"100%\" align=center border=0>
  <TBODY>
  <TR>

";

if ($kulYetki == "mod" or $kulYetki == "admin")
echo "

    <TDvAlign=top>
    ";
	
if ($yuklenecekSayfaSub) {
	if (file_exists("icerik/$yuklenecekSayfaSub.php"))
	include "icerik/$yuklenecekSayfaSub.php";
	else if (file_exists("$yuklenecekSayfaSub.php"))
	include "$yuklenecekSayfaSub.php";
	else
	echo "
	Bu bölüm geçici olarak servis dışı.";
} else {
	include "msjana.php";
}

echo "
    </TD>
</TR></TBODY></TABLE>
";

?>