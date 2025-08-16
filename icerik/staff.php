<body>
      <div id="staff" style="overflow:hidden; cursor:default; height:300px; text-align:center; margin:100px auto; width:300px;">
<marquee align="middle" scrollamount="3" height="300" direction="up"scrolldelay="1">
             <center><b>flowlarıyla hatırlanacaklar</b><br />
            bülent "boe b" ipek - 2000<br /> 
            murat "oflaz" oflaz - 2005<br /> 
            sabri "sena" tüyen - 2009<br /> 
            nejdet "kargaşa" fettah - 2016 <br />
            serhat "ferman mc" önder - 2016 <br /> 
            cengiz "murda" yılmaz - 2017<br /> 
            aşkın mert "vio" şalcıoğlu - 2018<br /> 
            volkan "volkan b" bekar - 2021<br /> 
            berk "beta" bayındır - 2022<br /> 
            selim muran - 2022 <br />
            hikmet "p-fox" dönmezer - 2023 <br />
            berk "maestro" karadaş - 2023  <br />         
            emrah "firavun anubis" ulu - 2023  <br />       
            halil "kuşku" çiçek - 2024<br />   
            ...
            <br /><br />
            <b>kickleriyle hatırlanacaklar</b><br />
            arda sertkol - 2023<br /> 
            yiğit güney "slaughter" dolgun - 2023<br /> 
            ...
            <br /><br />
            <b>tagleriyle hatırlanacaklar</b><br />
            hüseyin "misk" ok - 2013<br /> 
            ...
            <br /><br />
            <b>entryleriyle hatırlanacaklar</b><br />
            semttenbirses - kasım 2015<br /> 
            kanibal organizmalar - kasım 2015<br /> 
            ...
            <br /><br />            
            <b>teşekkürler</b><br />
            sedat "ssg" kapanoğlu<br /> 
            olgar "caesar" verim<br />
            zeykur valekov<br />
            iwgu<br />          
            suuulh<br />          
            fifiri
            <br /> <br />
            <? if ($kullaniciAdi){
           echo "<b>onur konuğumuz</b><br />";
            echo "$kullaniciAdi<br /><br />";} ?>
            <b>sözlüğün sahipleri</b><br />
            <?
            $sorgu = "SELECT nick FROM user WHERE `durum`='on' and nick!='admin' order by nick";
            $sorgulama = mysql_query($sorgu);
            while ($kayit=mysql_fetch_array($sorgulama)){
            $yazarlar = $kayit["nick"];
            echo"tüm yazarlarımızdır.";
            //echo"$yazarlar, ";
            }
            ?>
            <br /> <br />
            <b>bol sözlük - temmuz 2014<br /></b></center>
            <div style="width: 1px; height: 300px"></div>
    </div>
</marquee>

<?
//header('Refresh: 87; URL="http://www.bolsozluk.com/surpriz.bol"');
            /*<b>adminler</b><br />
            asker<br />
            <br />
            <b>yazarlar</b><br />
            süngümüzdür<br />*/
?>

</body>
</html>