<head>
<body class="bodyTopFrame">

<? 
error_reporting(E_ALL ^ E_NOTICE);



if ($kullaniciAdi) { 
/*<td onClick="javascript:od('sozluk.php?process=entrylerim&kimdirbu=<?echo"$kullaniciAdi";?>',400,400)" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="evet sen" target='main'> ben </a></td>*/
//<td onClick="javascript:radyo()" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="radyo"> radyochat </a></td>
    ?>
<table cellspacing="0" cellpadding="0" style="margin:0;padding:0">
    <tr>
    <td style="white-space:nowrap;" onClick="top.main.location.href='/sozluk.php?process=staff'" class="logo">
    <img id="logopic" alt="bol sözlük" src="img/1.gif" width="197" height="56" />
    </td>
    <td>
        <table cellpadding="0" cellspacing="1" class="nav">
        <tr>
        <td onClick="top.left.location.href='left.php?list=mix'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a id="m1" title="ortayi donat dayi" target="left"> rast getir </a></td>
        
<td onClick="top.left.location.href='sozluk.php?process=son'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="senden sonra" target="left"> son </a></td>        

        <td onClick="top.left.location.href='left.php?list=tb'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="tarihte bugün" target="main"> #tb </a></td>

        
        
        <td onClick="top.main.location.href='sozluk.php?process=stat'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="rakamlar ve getirdikleri" target="main"> istatistikler </a></td>
                
        <td onClick="top.main.location.href='sozluk.php?process=panel&islem=onlines'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="gizli i$ler cevirme aparati" target="main"> kontrol merkezi </a></td>			
        <td onClick="top.main.location.href='sozluk.php?process=word&q=gururlarımız'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="gururlarımız" target="main"> ⭐gururlarımız⭐ </a></td>              
        <td onClick="top.main.location.href='logout.php'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="logout.php" target="main"> çık </a></td>
        
        
       <script type="text/javascript">function forceLower(strInput){strInput.value=strInput.value.toLowerCase();}​</script>

        

        </tr>
        <tr>
            <td onClick="top.left.location.href='left.php?list=today'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="bugun girilen entryler" target="left"> gündem </a></td>
            <td onClick="top.left.location.href='left.php?list=kenar'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="kenarda duranların" target="left"> kenar </a></td>         
        <td onClick="top.left.location.href='left.php?list=ebe'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="ebe" target="left"> ebe </a></td>        

        

            <td onClick="top.main.location.href='sozluk.php?process=iletisim'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="küfür şikayet tehdit" target="main"> iletişim </a></td>
            
            <td onClick="top.main.location.href='sozluk.php?process=rand'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="Rastgele" target="main"> $ </a></td>

            <td colspan="4" style="margin:0;padding:0">
                <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td style="height:10px;white-space:nowrap;padding:1px;font-size:x-small"><u>b</u>a$lik <input maxLength=55 onKeyPress="return submitenter(this,event)" class="input" style="height:12px" accesskey="b" id="q" name="q" size="30" onkeyup="javascript:ara()" placeholder="aramaya inanın"/></td>
                <td onClick="javascript:getir();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="ogrenelim nedir"> getir </a></td>
                <td onClick="javascript:ara();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="ara bul"> ara </a></td>
<script type="text/javascript">
 function On_KeyUp() {
     document.getElementById('q').innerHTML = Sira +". : onKeyUp oldu!";
    Sira++; }
    </script>



                              <td onClick="top.main.location.href='sozluk.php?process=word&q=sözlükle+ilgili+istekler'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="sözlüke ilgili istekler" target="main">istek hattı</a></td>
<td onClick="top.main.location.href='sozluk.php?process=entrylerim&kimdirbu=<?echo"$kullaniciAdi";?>'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="evet sen" target='main'> ben </a></td>
                </tr>
                                 
                </table>

            </td>
        </tr>
        </table>

        </td>
<td>



</td>
    </tr>
</table>
<? } else { ?>
<table cellspacing="0" cellpadding="0" style="margin:0;padding:0">
    <tr>
    <td style="white-space:nowrap;" onClick="top.main.location.href='/sozluk.php?process=staff'" class="logo">
    <img id="logopic" alt="bol sözlük" src="img/1.gif" width="197" height="56" />
    </td>

    <td>
    <td>

        <table cellpadding="0" cellspacing="1" class="nav">

        <tr>

        <td onClick="top.left.location.href='left.php?list=mix'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a id="m1" title="ortayi donat dayi" target="left"> rast getir </a></td>
        <td onClick="top.left.location.href='left.php?list=tb'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="tarihte bugün" target="main"> #tb </a></td>
        <td onClick="top.main.location.href='sozluk.php?process=stat'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="rakamlar ve getirdikleri" target="main"> istatistikler  </a></td>
        <td onClick="top.main.location.href='sozluk.php?process=master&login=onair'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="gizli i$ler cevirme aparati" target="main"> kullanıcı girişi </a></td>			
        <td onClick="top.main.location.href='sozluk.php?process=reg1'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="logout.php" target="main"> kayıt ol </a></td>
        <td onClick="top.main.location.href='sozluk.php?process=word&q=gururlarımız'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="gururlarımız"> ⭐gururlarımız⭐ </a></td>
                           
     </tr>

 

        <tr>

        <td onClick="top.left.location.href='left.php?list=today'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="bugun girilen entryler" target="left"> gündem </a></td>
            <td onClick="top.left.location.href='left.php?list=ebe'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="en beğenilenler" target="left"> ebe </a></td>        
            <td onClick="top.main.location.href='sozluk.php?process=iletisim'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="küfür şikayet tehdit" target="main"> iletişim </a></td>
            <td onClick="top.main.location.href='sozluk.php?process=rand'" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but" colspan="2"><a title="Rastgele" target="main"> $ukela </a></td>
            <td colspan="4" style="margin:0;padding:0">
                <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td style="height:10px;white-space:nowrap;padding:1px;font-size:x-small"><u>b</u>a$lik <input maxLength=55 onKeyPress="return submitenter(this,event)" class="input" style="height:12px" accesskey="b" id="q" name="q" size="30" onkeyup="javascript:ara()" placeholder="aramaya inanın"/></td>
                <td onClick="javascript:getir();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="ogrenelim nedir"> getir </a></td>

                <td onClick="javascript:ara();" onMouseDown="md(this)" onMouseUp="bn(this)" onMouseOver="ov(this)" onMouseOut="bn(this)" class="but"><a title="ara bul"> ara </a></td>

                </tr>

                </table>

            </td>

        </tr>

        </table>

    </td>
      

    </tr>




</table>


<? } ?>
</head>
</body>