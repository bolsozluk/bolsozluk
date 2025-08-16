function ov(o){
  o.id="butOver";
}

function md(o){
  o.id="butDown";
}

function bn(o){
  o.id="";
}

var id=0,bid=0,lo=null,is="",bis="",se="",pr='<td onmousedown="md(this)" onmouseup="bn(this)" onmouseover="ov(this)" onmouseout="bn(this)" class="but" onclick=';

function hr(o)
{
        if(o)o.click();
}

function b(t,u,c,tt)
{
  is="a"+(id++);
  document.write(pr+'"hr('+is+')"><a id='+is);
  if(tt)document.write(" title='"+tt+"'");
  document.write(' target='+t+' href="'+u+'">&nbsp;'+c+'&nbsp;</a></td>');
}

function bjs(t,js,c,tt)
{
  document.write(pr+'"'+js+'"><a href="#" onclick="'+js+'">&nbsp;'+c+'&nbsp;</a></td>');
}

function b2(t,u,c,s)
{
  is="a"+(id++);
  document.write(pr+'"hr('+is+')" colspan='+s+'><a id='+is+' target='+t+' href="'+u+'">&nbsp;'+c+'&nbsp;</a></td>');
}

function s(f,c)
{
  document.write(pr+'"document.getElementById(\''+f+'\').submit()" style="cursor:hand">&nbsp;&nbsp;'+c+'&nbsp;</td>');
}

function a(u,c,t)
{
  is="a"+(id++);
  document.write(pr+'"hr('+is+')" title="'+t+'"><a id='+is+' href="'+u+'" class=icon>&nbsp;'+c+'&nbsp;</a></td>');
}

function p(u,c,t,m)
{
  is="a"+(id++);
  document.write(pr+'"hr('+is+')" title="'+t+'"><a id='+is+' onclick="return confirm(\''+m+'\')" href="'+u+'" class=icon>&nbsp;'+c+'&nbsp;</a></td>');
}

function al()
{
  for(var c='a';c <= 'z';c++) document.write('<a target=index href=index.asp?ix='+c+'>'+c+'</a> ');
}

function mch()
{
  var u="t="
  var c=document.getElementsByTagName("input")
  for(i=0;i<c.length;i++){if(c[i].type=="checkbox"){if(c[i].checked){u+="&"+c[i].id+"=y"}}}
  od('movemulti.asp?'+u);
}
function ct()
{
  tc=document.getElementById('ctf');
  if(tc)
  {
    var i=document.getElementsByTagName("input")
    var c=0;
    for(j=0;j<i.length;j++){if(i[j].type=="checkbox"){if(i[j].checked)c++;}}
    tc.style.display=c>0?'inline':'none';
  }
}

function ci(i)
{
  ic=document.getElementById('c'+i);
  with(ic)
  {
    style.display=style.display=='none'?'inline':'none';
    checked=checked?false:true;
    ct();
  }
}
function e(f,i,an)
{
        with(document)
        {
          write('<div align=right style="width:100%"><table id=m'+i+' style="visibility:hidden"><tr><td class=ei><a name="cid'+i+'"></a><a href="#cid" onclick="copyid('+i+','+f+');">#'+i+'</a></td>');
          if(f&16){
                  a("javascript:od('vote.asp?id="+i+"&v=1')",":)","$ukela!");
                  a("javascript:od('vote.asp?id="+i+"&v=0')",":O","oeehh");
                  a("javascript:od('vote.asp?id="+i+"&v=-1')",":(","cok kotu");
                  document.write('<td>&nbsp;</td>');
                  a("javascript:od('msg.asp?to="+an+"&re="+i+"')","/msg","mesaj at");
                  a("javascript:od('info.asp?n="+an+"',350,420)","?","yazar hakkinda");
          }
          if(f&2)a("javascript:od('gammaz.asp?id="+i+"')",":P","ispiyonla");
      if(f&128)a("javascript:od('addfave.asp?id="+i+"')","-D","favorilere ekle");
          //if(f&1) a("javascript:od('move.asp?id="+i+"')",">","ta$i");
          if(f&1) document.write(pr+'"ci('+i+')" title="ta$i"><a id=m'+i+' href="javascript:ci('+i+')" onclick="javascript:ci('+i+')" class=icon>&nbsp;>&nbsp;</a></td>');
          if(f&4)a("edit.asp?id="+i,"...","duzelt");
          if(f&32)a("show.asp?a=eh&id="+i,"~","duzeltme tarihcesi");
          if(f&64)a("javascript:od('showmodhistory.asp?id="+i+"',500,300)","!","moderasyon tarihcesi");
          if(f&8)a("javascript:od('del.asp?id="+i+"')","X","sil");
          if(f&256){document.write('<td>&nbsp;</td>');a("javascript:location.href='iletisim.asp?s=1&id="+i+"'","!?", "$ikayet et");}
          write('</tr></table></div>');
          var d=getElementById('d'+i);
          var m="document.getElementById('m"+i+"').style.visibility=";
          d.onmouseover=new Function(m+"'visible'");
          d.onmouseout=new Function(m+"'hidden'");
        }
}

function copyid(id,f)
{
        var c = document.getElementById('cidtxt');
        var u = "http://sozluk.sourtimes.org/show.asp?id="+id;
        if(!c) {alert("bu entry'nin adresi "+u);return;}
        if(document.selection) {
          if(f&256){c.innerText = u;}else{c.innerText="#"+id;}
          var ct = c.createTextRange();
          ct.execCommand("Copy");
        } else {
          alert("bu entry'nin adresi "+u);
        }
}


function dd(i)
{
        od('domsg.asp?a=d&id='+i);
        document.getElementById('d'+i).style.visibility='hidden';
}

function me(f,i,an)
{
        with(document)
        {
          write('<div align=right style="width:100%"><table id=m'+i+' style="visibility:hidden"><tr>');
          if(f&4){
                  a("javascript:with(document.getElementById('ssg')){to.value='"+an+"';ta.focus()}","cevapla","popup beklemeden mesaj yazma aparati");
                  a("javascript:od('msg.asp?to="+an+"')","/msg","mesaj at");
                  a("javascript:od('info.asp?n="+an+"',350,420)","?","yazar hakkinda");
          }
          if(f&2)a("javascript:od('domsg.asp?a=a&id="+i+"')","->","ar$ivle");
          if(f&1)a("javascript:dd("+i+")","X","sil");

          write('</tr></table></div>');
          var d=getElementById('d'+i);
          var m="document.getElementById('m"+i+"').style.visibility=";
          d.onmouseover=new Function(m+"'visible'");
          d.onmouseout=new Function(m+"'hidden'");
  }
}

function tr(i)
{
  document.write('<tr style="cursor:default" onmouseover="document.getElementById("m'+i+'").style.visibility=\'visible\'" onmouseout="style.borderWidth=\'0\';document.getElementById("m'+i+'").style.visibility=\'hidden\'">');
}

function od(u,w,h,x,y)
{
  if(!w)w=320;if(!h)h=200;if(!x)x=(screen.width-w)/2;if(!y)y=(screen.height-h)/2;
  var w=window.open(u,"_blank","resizable=yes,scrollbars=yes,top="+x.toString()+",left="+y.toString()+",width="+w.toString()+",height="+h.toString());
  w.focus();
}

function odf(u,w,h,x,y)
{
        od(u,w,h,x,y);return false;
}

function au(d)
{
  document.write('<tr><td nowrap align=right class=aul>(<a class=aul href="?t='+an+'">'+an+'</a>, '+d+')</td></tr>');
}

function sets(doc,fn)
{
  if(doc) {
    var len = doc.styleSheets.length;
    if(doc.createStyleSheet)
    {
            if (fn=="") {
              if(len>1) doc.styleSheets[1].href="";
            } else {
              if (len<2) doc.createStyleSheet(fn); else doc.styleSheets[1].href=fn;
            }
    }
    else
    {
      doc.location.reload();
    }
  }
}

function bp(o,m,c)
{
        var oo;
        for(var n=1;n<=m;n++) {
                oo = document.createElement("OPTION");
                o.options.add(oo);
                oo.innerText = n;
                oo.Value = n;
                oo.selected = n==c;
        }
}

var inpp=false,o=null,maxs=11,lx=20,w=213,bi=false,sint=new Array(20,23,30,43,61,82,107,135,166,197,213);

function os()
{
  if((o=document.getElementById('a'))!=null) with(o.style) with(document.body)
  {
          bi=n<=0;left=scrollLeft+sint[bi?0:(maxs-1)]+(clientWidth-233)+2;
          if(o.clientHeight+44<clientHeight) top=scrollTop+44;
  }
}

function ca()
{
        with(document.body) with(o.style) {
                left=(scrollLeft+sint[n]+(clientWidth-233))+"px";width=((w+lx)-sint[n])+"px";
                if(bi){if(++n<maxs)setTimeout("ca()",20); else {inpp=false;document.body.focus();document.getElementById('amain').disabled=true}}
                else{if(n-->0)setTimeout("ca()",20); else {inpp=false;document.getElementById('amain').disabled=false;document.getElementById('kw').focus()}}
  }
}

function pp()
{
        if(!inpp) { inpp=true;o=document.getElementById('a');bi=n<=0;n=bi?0:(maxs-1);ca(); }
}

function tgb(i)
{
  t=document.getElementById('t'+i);
  m=document.getElementById('m'+i);
  b=document.getElementById('b'+i);
  if(t&&m&&b) {
    for(var j=0;j<bid;j++) {
      if(i==("b"+j))continue;
      document.getElementById('bb'+j).style.display='inline';
      document.getElementById('tb'+j).innerHTML='&rsaquo;&rsaquo;'+'&nbsp;';
      document.getElementById('mb'+j).style.display='none';
    }
    t.innerHTML=m.style.display=='none'?'&lsaquo;&lsaquo;':'&rsaquo;&rsaquo;'+'&nbsp;';
    m.style.display=m.style.display=='none'?'inline':'none';
    b.style.display=b.style.display=='none'?'inline':'none';
  }
}

function obba(n,t)
{
  bis="b"+(bid++);
  document.write('<a style="vertical-align:middle;" id=t'+bis+' href="#" onclick="tgb(\''+bis+'\');">&rsaquo;&rsaquo;&nbsp;</a>'+
    '<div id=m'+bis+' style="vertical-align:middle;width:90%;display:none;"><a href="msg.asp?to='+escape(n)+'" onclick="tgb(\''+bis+'\');od(\'msg.asp?to='+escape(n)+'\');return false">&nbsp;/msg</a>'+
    '&nbsp;&middot;<a href="info.asp?n='+escape(n)+'" onclick="tgb(\''+bis+'\');od(\'info.asp?n='+escape(n)+'\',350,420);return false">&nbsp;?</a>'+
    '&nbsp;&middot;<a href="index.asp?a=sr&so=y&f=y&au='+escape(n)+'" target="sozindex" onclick="tgb(\''+bis+'\');top.sozindex.location.href=\'index.asp?a=sr&so=y&f=y&au='+escape(n)+'\'">&nbsp;son</a>'+
    '</div><div id=b'+bis+' style="vertical-align:middle;width:90%;display:inline;"><a href="#" onclick="od(\'msg.asp?to='+escape(n)+'\');return false" id='+bis+'>'+n+'</a></div><br>');
}
function ob(n,t)
{
        t = (15-t)/15.0;
        document.write('<a href="msg.asp?to='+escape(n)+'" onclick="od(\'msg.asp?to='+escape(n)+'\');return false">'+n+'</a><br>');
}

function ors(t)
{
        document.write('<select style="width:120px" class=tedit onchange="if(this.selectedIndex>0){window.open(this.options[this.selectedIndex].value+\''+t+'\');this.selectedIndex=0;}">'+
      '<option>..ara$tir..</option>'+
      '<option value="http://www.google.com/search?q=">google</option>'+
      '<option value="http://www.tdk.gov.tr/tdksozluk/sozbul.asp?kelime=">tdk sozlugu</option>'+
      '<option value="http://www.seslisozluk.com/?word=">seslisozluk.com</option>'+
      '<option value="http://en.wikipedia.org/wiki/Special:Search?fulltext=Search&search=">wikipedia</option>'+
      '<option value="http://us.imdb.com/find?q=">imdb</option>'+
      '<option value="http://foldoc.doc.ic.ac.uk/foldoc/foldoc.cgi?query=">foldoc</option>'+
      '<optgroup label="allmusic">'+
      '<option value="http://www.allmusic.com/cg/amg.dll?p=amg&opt1=1&sql=">artists</option>'+
      '<option value="http://www.allmusic.com/cg/amg.dll?p=amg&opt1=2&sql=">albums</option>'+
      '<option value="http://www.allmusic.com/cg/amg.dll?p=amg&opt1=3&sql=">songs</option>'+
      '</optgroup>'+
      '<option value="http://www.acronymfinder.com/af-query.asp?Acronym=">acronymfinder</option>'+
      '<option value="http://www.mobygames.com/search/quick?q=">mobygames</option>'+
    '</select>');
}

function hen(d,a,b)
{
  var o=document.getElementById(d);
  if(document.selection && !window.opera)
  {
          var rg=document.selection.createRange();
          if(rg.parentElement()==o) {
                  rg.text = a+rg.text+b;
                  rg.select();
                } else alert("lutfen once $eetmek istediginiz metni secin");
  }
  else if(o.textLength||window.opera)
  {
          var s = o.value;
          o.value = s.substring(0,o.selectionStart)+a+s.substring(o.selectionStart,o.selectionEnd)+b+s.substring(o.selectionEnd,o.textLength);
  } else o.value += a+b;
  o.focus();
  return false;
}

function osb(t)
{
        document.write('<tr><td><form action="show.asp"><input type=hidden name=t value="'+t+'"><input type=text id=kw name=kw maxlength=48 class=aratext style="width:96px"><input class=but title="ba$lik icinde ara" type=submit value="ara"></form></td></tr>');
}

function tac()
{
  var c = document.getElementsByTagName("input");
  for(var i=0;i<c.length;i++)if(c[i].type=="checkbox")c[i].checked=!c[i].checked;
}

function selcnt()
{
  var c = document.getElementsByTagName("input");
  var cnt = 0;
  for(var i=0;i<c.length;i++)if(c[i].type=="checkbox")cnt += c[i].checked?1:0;
  return cnt;
}

function dab()
{
  var c = document.getElementsByTagName("input");
  for(var i=0;i<c.length;i++)if(c[i].type=="submit"||c[i].type=="button")c[i].disabled=true;
}
function mpc()
{
  document.write('ek$i sozluk mesajla$ma arabirimi sadece cok temel ileti$im ihtiyaclarina yanit vermek uzere tasarlanmi$tir. gonderilen/alinan mesajlar ar$ivlenmedikleri takdirde bir kac hafta sonra (tam sureye bakmaya u$endim) otomatik silinirler. '+
    'herhangi bir veritabani arizasinda mesajlariniz geri getirilmeyecektir. bu sebepten guvenli/hizli ileti$im kurmaniz gerektiginde e-mail ya da instant messaging uygulamalarini kullanmanizi oneririz. '+
    'ek$i sozluk yetkilileri sozlukteki mesajlarinizi bir hakaret/kufur $ikayeti uzerine kontrol edebilirler. yolladiginiz/aldiginiz mesajlar ne veritabaninda ne de internet\'te aktarilirken $ifrelenmektedir. '+
    'bu yuzden cok ozel/gizli bilgilerinizi ek$i sozluk mesaj arabiriminden gondermemenizi guvenliginiz acisindan oneririz. (ne bu ya sanki savunma bakanligi sitesi)');
}
function bpc()
{
  document.write('Bu sitede yazilanlarin hicbiri dogru degildir. 18 ya$in altindakilerin kullanmasi hukuken sakincali olabilir (zaten o ya$ta ne i$iniz var internette sitede cikin, gezin, gezdirin). '+
    'Yazarlar Ek$i Sozluk\'e yazdiklari entry\'lerin telif haklarini Michael Jackson\'a devretmi$ sayilirlar. Sitede yazilanlari kaynak belirtmeden Word\'e aktarip "Fw: Turk astronot ve houston! cok komikkkk!" '+
    'diye arkada$larina yollayan pespayedir, hemzemindir, hincaldir, uluctur. Hukuki gereklilikler haricinde yazarlarin kimlik bilgileri saklidir. Sadece arada yoneticiler tarafindan onemli bir gerekceyle incelenip "tuh erkekmi$" denebilir. '+
    'Bir gun kapimiza biri gelirse "kim lan bunlar" diye "bi sn du$tayim" denir mutfak penceresinden kacilir.');
}