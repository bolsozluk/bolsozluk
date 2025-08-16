// send an ajax request
function ajaxReq(phpAndQuery, ansID){
	var HttpReq = false
	if (window.XMLHttpRequest) // if Mozilla, Safari etc
		HttpReq = new XMLHttpRequest()
	else if (window.ActiveXObject){ // if IE
		try {
			HttpReq = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e){
			try{
				HttpReq = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	} else
		return false
	HttpReq.onreadystatechange=function(){
		showAnswer(HttpReq, ansID)
	}
	HttpReq.open('GET', phpAndQuery, true)
	HttpReq.send(null)
}

// show answer in element
function showAnswer(HttpReq, ansID){
	if (HttpReq.readyState == 4 && (HttpReq.status==200 || window.location.href.indexOf("https")==-1)) {
		document.getElementById(ansID).innerHTML=HttpReq.responseText;
		//setTimeout("closeAnswer('"+ansID+"')",400);        
	}else{
       
        document.getElementById(ansID).innerHTML="dur bi sn.."; 
  
		

	}
}



// close answer element
function closeAnswer(ansID){
	document.getElementById(ansID).style.visibility = "hidden";
}

// rate
function oylama(id,oy){
    ajaxReq('https://www.bolsozluk.com/icerik/oyla.php?id='+id+'&oy='+oy,'oySonuc'+id);
 //location.reload();
    //setTimeout(function(){ajaxReq('http://www.bolsozluk.com/icerik/oyla.php?id='+id+'&oy='+oy,'oySonuc'+id)}, 3000);	 
}

function kanaat(id,kanaat){
    ajaxReq('https://www.bolsozluk.com/icerik/kanaat.php?id='+id+'&knt='+kanaat,'oySonuc'+id);
  
}



// show or hide entry div
function showEntryDiv(divNum) {
	document.getElementById(divNum).style.visibility = "visible";
	}
function hideEntryDiv(divNum) {
	document.getElementById(divNum).style.visibility = "visible";
	}
 


// insert something	
function insert(id,ilk,son) {
	var t = document.getElementById(id);
	if (document.selection){
		var sonuc = document.selection.createRange();
		var el = sonuc.parentElement();
		if(el!=t){
			alert('metni seç, sonra tuşa bas.');
		}else{
			sonuc.text  = ilk+sonuc.text+son; sonuc.select();
		}
	}else if (t.selectionStart || t.selectionStart == '0') {
		var tilk = t.value.substring(0,t.selectionStart);
		var sonuc = t.value.substring(t.selectionStart,t.selectionEnd);
		var tson = t.value.substring(t.selectionEnd,t.value.length);
		t.value  = tilk+ilk+sonuc+son+tson;
	} else {
		t.value += ilk+son;
	}
	t.focus();
	if(window.event)
		event.returnValue = false;
	return false;
}

// get a topic
function getir(){
	var kelime = document.getElementById('q').value.toLowerCase();
	top.main.location.href='sozluk.php?process=word&q='+kelime;
}

function mobgetir(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

// search a topic
function ara() {
    var kelime = document.getElementById('q').value;
    top.left.location.href='sozluk.php?process=search&q='+kelime;
}

function getir2(){
    var kelime = document.getElementById('q').value.toLowerCase();
    self.location.href='sozluk.php?process=word&q='+kelime;
}

function ara2() {
    var kelime = document.getElementById('q').value;
    self.location.href='sozluk.php?process=search2&q='+kelime;
}

// open radio
function radyo() {
	var left = ((screen.width)-660)/2;
	var top = ((screen.height)-480)/2;
	window.open("http://tinychat.com/bolsozluk", "myWindow", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, top="+top+", left="+left+", status = 1," )

}

// submit topic when press enter
function submitenter(myfield,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13)    {
	   var kelime = document.getElementById('q').value;
	   top.main.location.href='sozluk.php?process=word&q='+kelime;
	   return false;
	   } else return true;
}




// ilkel

function popup( sname,kalinlik,yukseklik,isim ) {
        window.open(sname,isim,"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,width=" + kalinlik+ ",height=" + yukseklik+"resizeable=0");
}

function at(sel)
{
        frames['stmain'].location.href = sel;
}

function dis(f)
{
        if(document.getElementById)
        {
                var obj = document.getElementById(f);
                obj.disabled = true;

        }
        else if (document.all)
        {
                var obj = document.all(f);
                obj.disabled = true;
        }
}

function kontrol() {
        var hata = '';
        var dd = document.getElementById;
        var i = dd('e').value;
        var j = dd('f').value;
        var ads = dd('a').value;
        var email = dd('b').value;
        var kadi = dd('d').value;
        var il = dd('il').value;
        if(i != j) {
                hata = 'Sifreler birbirini tutmuyor. Kontrol edip, tekrar deneyin';
                alert(hata);
        }
                if((i == '') || (j == '') || (ads == '') || (email == '') || (kadi == '') || (il == ''))
        {
                hata = 'Asagidaki hucreler bos birakilamaz : \n - Sifre \n - Adi Soyad \n - E-Mail \n - Kullanici Adi \n - Sehir ';
                alert(hata);
        }
        document.hedeValue = (hata == '');
}



function jm(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}



function jump(selObj,restore){
var url = selObj.options[selObj.selectedIndex].value;

if (url) {

remote = window.open(url, 'other');

if (remote != null) {

if (remote.opener == null)

remote.opener = self;

}

}

if (restore) selObj.selectedIndex=0;

}



function changeStyle(tagName,styleName)

{

                tagName.className = styleName;

}



function goUrl(url,frm)

{

                open(url,frm);

}





function bkzver(a)

{

    if(document.selection)

    {

            var sel = document.selection.createRange();

        if(sel.parentElement() == document.getElementById("aciklama"))

        {

           var b = a;

            sel.text = "("+b+": "+sel.text+")";

            sel.select();

        return false;

        }

    }

    else

    {

        var nedir="";

        var b="";

        if(a == 'url') b = 'adresi';

        else b = 'kelimeyi';

        nedir = prompt(a+" verilecek "+b+" giriniz","");

        if(nedir != "" && nedir != null)

        {

                document.getElementById("aciklama").value += "("+a+": "+nedir+")";

                document.getElementById("aciklama").focus();

                return false;

        }

        else return false;

    }

}



function sec(){

for (var i=0;i<document.mesajform.elements.length;i++)

{

        var e=document.mesajform.elements[i];

        if ((e.name != 'allbox') && (e.type=='checkbox'))

        {

                if (e.checked != true)

                {

                        e.checked = true;

                }

                else

                {

                        e.checked = false;

                }

        }

}

}



var dlara=null;

var dara=null;



function brcont(){

        if (document.getElementById)

        {

                dlara = document.getElementById("lara");

                dara = document.getElementById("ara");

        }

        else if (document.all)
        {

                dlara = document.all("lara");

                dara = document.all("ara");
        }

else if (document.layers){

        dlara = document.layers["lara"];

        dara = document.layers["ara"];

}

}



function goster(){

        brcont();

        dlara.style.visibility = 'visible';

        dara.style.visibility = 'hidden';

}



function gizle(){

        brcont();

        dlara.style.visibility = 'hidden';

        dara.style.visibility = 'visible';

}

function h(obj,drm)
{
                if(drm == "goster")
                        document.getElementById(obj).style.visibility = 'visible';
                else
                        document.getElementById(obj).style.visibility = 'hidden';
}

function gG(obj) {
        if (document.getElementById(obj).style.display == 'block')

                document.getElementById(obj).style.display = 'none';

        else

                document.getElementById(obj).style.display = 'block';

}