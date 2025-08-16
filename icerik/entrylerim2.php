<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcı Profil Sayfası</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    .profile-image {
      width: 125px;
      height: 125px;
      border-radius: 50%;
      overflow: hidden;
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .rozet {
      margin-top: 20px;
    }

    .rozet img {
      width: 32px;
      height: 32px;
      margin-right: 5px;
    }

    .stats {
      margin-top: 20px;
    }

    .stats b {
      display: block;
      margin-bottom: 5px;
    }

    .latest-entries {
      margin-top: 20px;
    }

    .latest-entries a {
      text-decoration: none;
      color: #333;
    }

    .latest-entries p {
      margin-bottom: 5px;
    }

    .cta-button {
      display: block;
      margin-top: 20px;
      padding: 10px;
      background-color: #333;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
    }

    .cta-button:hover {
      background-color: #555;
    }

    footer {
      margin-top: 20px;
      padding: 10px;
      background-color: #333;
      color: #fff;
      text-align: center;
    }
  </style>
</head>

<body>

  <header>
    <h1>Kullanıcı Profil Sayfası</h1>
  </header>

  <div class="container">

    <!-- Profil Bilgileri -->
    <h2>Profil Bilgileri</h2>
    <div class="profile-image">
      <!-- Profil Fotoğrafı -->
      <img src="https://ekstat.com/img/default-profile-picture-light.svg" alt="Profil Fotoğrafı">
    </div>

    <div class="rozet">
      <!-- Rozetler -->
      <img src="https://cdn2.iconfinder.com/data/icons/essentials-volume-i/128/verified-gold-512.png" title="Onaylı Hesap" width="32" height="32">
      <img src="/bolrozet/imececi.png" title="İmececi" width="32" height="32">
      <img src="/bolrozet/gececi.png" title="Gece Tayfası" width="32" height="32">
      <!-- Diğer Rozetler -->
    </div>

    <div class="stats">
      <!-- Genel İstatistikler -->
      <b>Entry Sayınız:</b> 123<br>
      <b>Silinen Entry Sayınız:</b> 5<br>
      <!-- Diğer İstatistikler -->
      <b>Karma Puanınız:</b> 456<br>
    </div>

    <!-- Son Sözleri -->
    <div class="latest-entries">
      <h2>Son Sözleri</h2>
      <p><a href="#">Başlık 1</a> - #123</p>
      <p><a href="#">Başlık 2</a> - #456</p>
      <!-- Diğer Son Sözler -->
    </div>

    <!-- Buton -->
    <a href="#" class="cta-button">Tüm Entrylerini Getir</a>

  </div>

  <footer>
    &copy; 2024 Kullanıcı Profil Sayfası
  </footer>

</body>

</html>
