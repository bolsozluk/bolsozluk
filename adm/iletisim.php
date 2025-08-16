<html>
<head>

<style>
td{
font-size: 13px;
font-weight:bold; 
font-family: Verdana;
color: #333333;
}
</style>

</head>
<body>

<center>
<h3>İletişim Formu</h3>
<form method="POST" action="/icerik/iletis2.php">
<input name="id" type="hidden" value=<?echo"#$id";?>>
<table cellpadding="10px" border="0">
<tr>
<td align="right">Ad, Soyad: </td>
<td><div align="left"><input name="GONDERENIN_ADI_SOYADI" size="30" type="text"></div></td>
</tr>
<tr>
<td align="right">E-Posta: </td>
<td><div align="left"><input name="EPOSTA_ADRESI" size="30" type="text"></div></td>
</tr>
<tr>
<td align="right">Konu: </td>
<td><div align="left"><input name="MESAJIN_KONUSU" size="30" type="text"></div></td>
</tr>
<tr>
<td align="right" valign="top">Mesaj: </td>
<td>
<textarea rows="10" cols="40" name="GONDERENIN_MESAJI">
</textarea></td>
</tr>

<tr>
<td colspan="2" align="">
<input value="Gönder" name="send" type="submit" id="send" style="margin-left: 10px; width: 75px; float: right; color:#333333;">
<input value="Temizle" name="reset" type="reset" id="reset" style="width: 75px; float: right; color:#333333;">
</td>
</tr>
</table>
</form>
</center>

</body>
</html>