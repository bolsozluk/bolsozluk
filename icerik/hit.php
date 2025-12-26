<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML lang=tr><HEAD><TITLE>en iyi basliklar | netsözlük.net</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1254">
<META content=noarchive,nosnippet name=robots>
<script src="inc/top.js" type="text/javascript"></script>
<LINK href="favicon.ico" rel="shortcut Icon"><LINK href="favicon.ico" rel=icon>
<SCRIPT src="inc/sozluk.js" type=text/javascript></SCRIPT>
<META content="MSHTML 6.00.2800.1106" name=GENERATOR></HEAD>
<STYLE TYPE="text/css">
BODY
{
scrollbar-base-color: orange;
scrollbar-arrow-color: green;
scrollbar-DarkShadow-Color: blue;
}
</STYLE>
<BODY>
<SCRIPT type=text/javascript>
function sch(s) { var o = document.getElementById("cf");o.checked=(o.disabled=(s=="r"))?true:o.checked; }
function vi(s,v) { var o = document.getElementById(s); if(o) o.style.visibility=v?"visible":"hidden"; }
</SCRIPT>
          <DIV style="OVERFLOW-X: hidden; WIDTH: 100%; HEIGHT: 405px">
<?
if (!$kac)
$kac = 40;

echo "
<br>
<center>En hit <b>$kac</b> baslik<br><br>
Seçiniz: <SELECT onchange=\"jm('self',this,0);\" name=kac>
<OPTION value=sozluk.php?process=hit&kac=40>40</OPTION>
<OPTION value=sozluk.php?process=hit&kac=60>60</OPTION>
<OPTION value=sozluk.php?process=hit&kac=100>100</OPTION>
</select>
</center>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
";


$sor = mysql_query("select id from konular WHERE statu='' ORDER BY 'hit' desc limit $kac");
$w = mysql_num_rows($sor);

$listele = mysql_query("SELECT id,baslik,hit FROM konular WHERE statu='' ORDER BY 'hit' desc limit $kac");
while ($kayit=mysql_fetch_array($listele)) {
$baslik=$kayit["baslik"];
$hit=$kayit["hit"];
$link = preg_replace("/ /","+",$baslik);
echo "
  <TR onmouseover=\"vi('m0',true)\" onmouseout=\"vi('m0',false)\">
    <TD>·&nbsp;</TD>
  <TD width=190><A title=\"\"href=\"sozluk.php?process=word&q=$link\"
      target=main>$baslik</A></TD></TR>
";
}
echo "</TBODY></TABLE>";



echo "<center><p class=eol><font face=Verdana size=1>
$w adet baslik listeleniyor<br>
";

echo "</div>";
?>
