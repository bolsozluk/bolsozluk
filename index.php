<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="_Svb1644J1YJgEcCSow60Vjl9zm90PqZz5m9WRDXdWw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="bol sözlük, bol, sözlük, rap sözlük" /> 
<meta name="description" content="bol sözlük." />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<meta property="og:locale" content="tr_TR" />
<meta property="og:type" content="article" />
<meta property="og:image" content="http://i.imgur.com/Osi2LRo.png"/>
<meta property="og:description" content="Hiphop ve Türkçe Rap'in kalbinin attığı sözlük."/>

<link rel="alternate" type="application/rss+xml" title="bol sözlük rss" href="sitemap.xml"/>
<title>Bol Sözlük</title>

</head>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Bol Sözlük",
  "url": "https://www.bolsozluk.com",
  "sameAs": [
    "https://www.facebook.com/bolsozluk",
    "https://www.instagram.com/bolsozluk",
    "https://www.youtube.com/bolsozluk"
  ]
}
</script>

<?
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );



if($isMobile == 1)
{ 
              header("Location: https://www.bolsozluk.com/left.php?list=today"); 

}
?>

<!--  yedek alınıyor lütfen bekleyiniz -->

<frameset rows="56,*" cols="*" frameborder="0" border="0" framespacing="0">
  <frame src="sozluk.php?process=top" name="menu" noresize="noresize" scrolling="no"/>
  <frameset rows="*" cols="250,*,0" frameborder="0" border="0" framespacing="0">
    <frame src="left.php?list=today" name="left" noresize="noresize" scrolling="auto"/>
    <frame src="sozluk.php?process=master" name="main" noresize="noresize"/>
<!--     <frame src="left.php?list=mix" name="sag" noresize="noresize" scrolling="auto">-->
  </frameset>
  <noframes>
    <body><p>Lütfen daha yeni bir internet tarayıcı kullanın.</p></body>
  </noframes>
</frameset>

</html>

