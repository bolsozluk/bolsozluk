<?
session_start();
include "icerik/baglan.php";
vtBaglan();

$sorgu = "DELETE FROM online WHERE nick = '".$_SESSION['kullaniciAdi_S']."' LIMIT 1";
mysql_query($sorgu);

mysql_close($databaseConnection);
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="inc/top.js"></script>
<script type="text/javascript" src="inc/sozluk.js"></script>
<link href="favicon.ico" rel="shortcut Icon">
<link href="favicon.ico" rel="icon">
<link href="inc/sozluk.css" type="text/css" rel="stylesheet">
<link href="inc/<? echo $aktifTema ?>.css" type="text/css" rel="stylesheet">
</head>
<body>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Çıkış yapıyorum</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
    }
    .logout-container {
      background-color: #ffffff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .logout-message {
      font-size: 24px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="logout-container">
    <h2 class="logout-message">Yine bekleriz.</h2>
    BOL senin evin...
    <br><br>
    <small>3 saniye içinde ana sayfaya yönlendirileceksin.</small>
  </div>
  <script>
    setTimeout(function() {
      window.parent.location.href = "https://www.bolsozluk.com";
    }, 2000); // 5 saniye sonra ana sayfaya yönlendirme yapar
  </script>

<?
//<script type="text/javascript">top.main.location.href='sozluk.php?process=word&q=24'</script>
//<script type="text/javascript">top.menu.location.href='sozluk.php?process=top'</script>
?>

</body>
</html>
