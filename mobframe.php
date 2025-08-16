<script>
function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function mobara() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search&q='+kelime;
}


</script>


<style>
.butx {
        border-right: #a6b4d4 1px outset; border-TOP: #a6b4d4 1px outset; font: 10pt Arial,sans-serif; border-left: #a6b4d4 1px outset; CURSOR: default; color: white;  display: inline-block; border-BOTTOM: #a6b4d4 2px outset; WHITE-SPACE: nowrap; background-color: #242b3a; text-align: center
}

input {
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
    padding: 4px;
    display: inline-block;
}

</style>



<?


$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

if($isMobile == 1)
{ 
	echo "<center>";
	echo "<a id=\"gundem\" href=\"left.php?list=today\" target=\"_top\" title=sol&nbsp;frame> <img src=inc/turuncu.png width=50 border=1></a>";
    echo "<b> </b>başlık <input maxLength=55 class=\"input\" style=\"height:12px\" accesskey=\"b\" id=\"q\" name=\"q\" size=\"18\" placeholder=\"aramaya inanın\"> <input type='button' onClick=\"javascript:mobgetir();\" value='getir' class='butx'> <input type='button' onClick=\"javascript:mobara();\" value='ara' class='butx'>  <br><br>";                
    echo "</center>";
//onKeyPress=\"return submitenter(this,event)\"
}

if($isMobile == 1)
{ 
	//$mobframe = "<table cellspacing=\"0\" cellpadding=\"0\" style=\"margin:0;padding:0\"> class=\"logo\"> <img id=\"logopic\" alt=\"bol sözlük\" src=\"img/1.gif\" width=\"197\" height=\"56\" /> </table><br>";

    if($kullaniciAdi)
    {
   
        include "www.bolsozluk.com/icerik/fonksiyonlar.php";
        include "www.bolsozluk.com/icerik/baglan.php";
vtBaglan();
kontrolEt();
addMeOnlines();

    echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=privmsg';\" value='mesaj' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=panel&islem=onlines';\" value='kontrol' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='left.php?list=kenar';\" value='kenar' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=entrylerim&kimdirbu=$kullaniciAdi';\" value='ben' class='butx'> <input type='button' onclick=\"location.href='logout.php';\" value='çık' class='butx'></center>";
    echo "<center> <input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> <input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'></center> ";
    echo "<br>";
    
    }
    else
    {
    echo "<center> <input type='button' onclick=\"location.href='sozluk.php?process=master&login=onair';\" value='giriş yap' class='butx'> <input type='button' onclick=\"location.href='left.php?list=mix';\" value='rast' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=stat&stat=genel';\" value='istatistik' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=word&q=gururlarımız';\" value='⭐gururlarımız⭐' class='butx'>  </center>"; 	
    echo "<center> <input type='button' onclick=\"location.href='left.php?list=today';\" value='gündem' class='butx'> <input type='button' onclick=\"location.href='left.php?list=konudisi';\" value='konudışı' class='butx'> <input type='button' onclick=\"location.href='left.php?list=lobi';\" value='#lobi' class='butx'> <input type='button' onclick=\"location.href='left.php?list=tb';\" value='#tb' class='butx'> <input type='button' onclick=\"location.href='left.php?list=ebe';\" value='#ebe' class='butx'> <input type='button' onclick=\"location.href='sozluk.php?process=iletisim';\" value='iletişim' class='butx'> </center><br>";
    echo "<br>";
    }


}

?>