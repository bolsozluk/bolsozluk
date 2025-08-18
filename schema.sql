SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bol`
--
DROP DATABASE IF EXISTS `bol`;
CREATE DATABASE IF NOT EXISTS `bol` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bol`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

DROP TABLE IF EXISTS `ayar`;
CREATE TABLE IF NOT EXISTS `ayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) NOT NULL,
  `reg` varchar(255) NOT NULL,
  `hit` varchar(255) NOT NULL,
  `g` varchar(5) NOT NULL,
  `d` varchar(5) NOT NULL,
  `l` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `site` (`site`),
  KEY `reg` (`reg`),
  KEY `hit` (`hit`),
  KEY `site_2` (`site`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aylikentry`
--

DROP TABLE IF EXISTS `aylikentry`;
CREATE TABLE IF NOT EXISTS `aylikentry` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `ay` int(4) NOT NULL,
  `yil` int(4) NOT NULL,
  `entry` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `debe`
--

DROP TABLE IF EXISTS `debe`;
CREATE TABLE IF NOT EXISTS `debe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `eniyientry1` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eniyientry2` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eniyientry3` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eniyientry4` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eniyientry5` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `eniyibaslik1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `eniyibaslik2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `eniyibaslik3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `eniyibaslik4` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `eniyibaslik5` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebe1` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe2` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe3` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe4` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe5` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe6` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe7` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe8` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe9` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebe10` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb4` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb5` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb6` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb7` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb8` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb9` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hebeb10` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eniyiler`
--

DROP TABLE IF EXISTS `eniyiler`;
CREATE TABLE IF NOT EXISTS `eniyiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` text NOT NULL,
  `oysayisi` text NOT NULL,
  `yazar` text NOT NULL,
  `baslik` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `esikayet`
--

DROP TABLE IF EXISTS `esikayet`;
CREATE TABLE IF NOT EXISTS `esikayet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konu` text COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `gonderen` text COLLATE utf8_turkish_ci NOT NULL,
  `ip` text COLLATE utf8_turkish_ci NOT NULL,
  `mail` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` text COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(1) NOT NULL,
  `gun` text COLLATE utf8_turkish_ci NOT NULL,
  `ay` text COLLATE utf8_turkish_ci NOT NULL,
  `yil` text COLLATE utf8_turkish_ci NOT NULL,
  `saat` text COLLATE utf8_turkish_ci NOT NULL,
  `kapatan` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

DROP TABLE IF EXISTS `haberler`;
CREATE TABLE IF NOT EXISTS `haberler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konu` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `gun` int(5) NOT NULL,
  `ay` int(5) NOT NULL,
  `yil` int(5) NOT NULL,
  `saat` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `konu` (`konu`),
  KEY `tarih` (`tarih`),
  KEY `gun` (`gun`),
  KEY `ay` (`ay`),
  KEY `yil` (`yil`),
  KEY `saat` (`saat`),
  KEY `yazar` (`yazar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `olay` text NOT NULL,
  `mesaj` text NOT NULL,
  `moderat` text NOT NULL,
  `tarih` text NOT NULL,
  `gun` text NOT NULL,
  `ay` text NOT NULL,
  `yil` text NOT NULL,
  `saat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ipban`
--

DROP TABLE IF EXISTS `ipban`;
CREATE TABLE IF NOT EXISTS `ipban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iptables`
--

DROP TABLE IF EXISTS `iptables`;
CREATE TABLE IF NOT EXISTS `iptables` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `yazar` text COLLATE utf8_turkish_ci NOT NULL,
  `ip` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` text COLLATE utf8_turkish_ci NOT NULL,
  `ipdecimal` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iptables3`
--

DROP TABLE IF EXISTS `iptables3`;
CREATE TABLE IF NOT EXISTS `iptables3` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `yazar` text COLLATE utf8_turkish_ci NOT NULL,
  `ip` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` text COLLATE utf8_turkish_ci NOT NULL,
  `ipdecimal` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ispiyon`
--

DROP TABLE IF EXISTS `ispiyon`;
CREATE TABLE IF NOT EXISTS `ispiyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gonderen` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gun` int(5) NOT NULL,
  `ay` int(5) NOT NULL,
  `yil` int(5) NOT NULL,
  `saat` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konular`
--

DROP TABLE IF EXISTS `konular`;
CREATE TABLE IF NOT EXISTS `konular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sira` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `sahibi` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `gun` int(5) NOT NULL,
  `ay` int(5) NOT NULL,
  `yil` int(5) NOT NULL,
  `saat` varchar(255) NOT NULL,
  `hit` int(11) NOT NULL,
  `statu` varchar(255) NOT NULL,
  `tasi` varchar(255) NOT NULL,
  `silmod` varchar(255) NOT NULL,
  `siltarih` varchar(255) NOT NULL,
  `silsebep` varchar(255) NOT NULL,
  `kanal` varchar(20) DEFAULT NULL,
  `kanal2` varchar(20) DEFAULT NULL,
  `kanal3` varchar(20) DEFAULT NULL,
  `veto` int(2) NOT NULL,
  `editlendi` int(1) NOT NULL,
  `editsebep` text NOT NULL,
  `editleyen` text NOT NULL,
  `eskibaslik` text NOT NULL,
  `edittarih` text NOT NULL,
  `gds` text NOT NULL,
  `mesajcount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sira` (`sira`),
  KEY `baslik` (`baslik`),
  KEY `ip` (`ip`),
  KEY `tarih` (`tarih`),
  KEY `gun` (`gun`),
  KEY `ay` (`ay`),
  KEY `yil` (`yil`),
  KEY `saat` (`saat`),
  KEY `hit` (`hit`),
  KEY `statu` (`statu`),
  KEY `tasi` (`tasi`),
  KEY `silmod` (`silmod`),
  KEY `siltarih` (`siltarih`),
  KEY `silsebep` (`silsebep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `loginfail`
--

DROP TABLE IF EXISTS `loginfail`;
CREATE TABLE IF NOT EXISTS `loginfail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text COLLATE utf8_turkish_ci NOT NULL,
  `yazar` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

DROP TABLE IF EXISTS `mesajlar`;
CREATE TABLE IF NOT EXISTS `mesajlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sira` int(11) NOT NULL,
  `mesaj` text NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `tarih` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `gun` int(5) NOT NULL,
  `ay` int(5) NOT NULL,
  `yil` int(5) NOT NULL,
  `saat` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `oy` int(11) NOT NULL,
  `update2` varchar(255) NOT NULL,
  `updater` varchar(255) NOT NULL,
  `updatesebep` varchar(255) NOT NULL,
  `statu` varchar(255) NOT NULL,
  `silen` varchar(255) NOT NULL,
  `silsebep` varchar(255) NOT NULL,
  `dakika` int(3) NOT NULL,
  `ucur` int(1) NOT NULL,
  `siltarih` text NOT NULL,
  `tasiyan` text NOT NULL,
  `tasiorji` text NOT NULL,
  `tasitarih` text NOT NULL,
  `istekhatti` int(3) NOT NULL,
  `ilkyazar` text NOT NULL,
  `kanaat` text NOT NULL,
  `esikayet` int(1) NOT NULL DEFAULT 0,
  `kulliyat` int(1) NOT NULL,
  `edithistory` text NOT NULL,
  `praetornotu` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sira` (`sira`),
  KEY `yazar` (`yazar`),
  KEY `ip` (`ip`),
  KEY `tarih` (`tarih`),
  KEY `gun` (`gun`),
  KEY `ay` (`ay`),
  KEY `yil` (`yil`),
  KEY `saat` (`saat`),
  KEY `oy` (`oy`),
  KEY `update2` (`update2`),
  KEY `updater` (`updater`),
  KEY `updatesebep` (`updatesebep`),
  KEY `statu` (`statu`),
  KEY `silen` (`silen`),
  KEY `silsebep` (`silsebep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `online`
--

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `sira` int(10) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `islem_zamani` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ondurum` varchar(255) NOT NULL,
  `mesgul` int(1) NOT NULL,
  PRIMARY KEY (`sira`),
  KEY `nick` (`nick`),
  KEY `islem_zamani` (`islem_zamani`),
  KEY `ip` (`ip`),
  KEY `ondurum` (`ondurum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oylar`
--

DROP TABLE IF EXISTS `oylar`;
CREATE TABLE IF NOT EXISTS `oylar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `entry_sahibi` varchar(255) NOT NULL,
  `oy` int(1) NOT NULL,
  `dakika` int(3) NOT NULL,
  `julyen` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `nick` (`nick`),
  KEY `entry_sahibi` (`entry_sahibi`),
  KEY `oy` (`oy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `poll`
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE IF NOT EXISTS `poll` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ip` text NOT NULL,
  `kapali` text NOT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `option_string` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `poll_id` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `poll_responses`
--

DROP TABLE IF EXISTS `poll_responses`;
CREATE TABLE IF NOT EXISTS `poll_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ip_addr` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `poll_id` text NOT NULL,
  `long2ip` text NOT NULL,
  `tarih` text NOT NULL,
  `sehir` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=ucs2;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `privmsg`
--

DROP TABLE IF EXISTS `privmsg`;
CREATE TABLE IF NOT EXISTS `privmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konu` varchar(255) NOT NULL,
  `mesaj` text NOT NULL,
  `kime` varchar(255) NOT NULL,
  `gonderen` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `okundu` varchar(255) NOT NULL,
  `gun` int(5) NOT NULL,
  `ay` int(5) NOT NULL,
  `yil` int(5) NOT NULL,
  `saat` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `konu` (`konu`),
  KEY `kime` (`kime`),
  KEY `gonderen` (`gonderen`),
  KEY `tarih` (`tarih`),
  KEY `okundu` (`okundu`),
  KEY `gun` (`gun`),
  KEY `ay` (`ay`),
  KEY `yil` (`yil`),
  KEY `saat` (`saat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `puanlar`
--

DROP TABLE IF EXISTS `puanlar`;
CREATE TABLE IF NOT EXISTS `puanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik_id` int(11) NOT NULL,
  `nick` text COLLATE utf8_turkish_ci NOT NULL,
  `oy` text COLLATE utf8_turkish_ci NOT NULL,
  `dakika` text COLLATE utf8_turkish_ci NOT NULL,
  `julyen` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rehber`
--

DROP TABLE IF EXISTS `rehber`;
CREATE TABLE IF NOT EXISTS `rehber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kim` varchar(250) NOT NULL DEFAULT '',
  `kimin` varchar(250) NOT NULL DEFAULT '',
  `num` varchar(1) NOT NULL,
  `tarih` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorular`
--

DROP TABLE IF EXISTS `sorular`;
CREATE TABLE IF NOT EXISTS `sorular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stat`
--

DROP TABLE IF EXISTS `stat`;
CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` text NOT NULL,
  `entry` text NOT NULL,
  `silbaslik` text NOT NULL,
  `silentry` text NOT NULL,
  `hit` text NOT NULL,
  `tekil` text NOT NULL,
  `yazar` text NOT NULL,
  `okur` text NOT NULL,
  `moderat` text NOT NULL,
  `op` text NOT NULL,
  `admin` text NOT NULL,
  `ortbaslik` text NOT NULL,
  `ortentry` text NOT NULL,
  `tarih` text NOT NULL,
  `enhitbaslik` text NOT NULL,
  `gun` text NOT NULL,
  `pilot` text NOT NULL,
  `rahmetli` text NOT NULL,
  `temadefault` text NOT NULL,
  `eniyientry1` text NOT NULL,
  `eniyientry2` text NOT NULL,
  `eniyientry3` text NOT NULL,
  `eniyientry4` text NOT NULL,
  `eniyientry5` text NOT NULL,
  `eniyientry6` text NOT NULL,
  `eniyientry7` text NOT NULL,
  `eniyientry8` text NOT NULL,
  `eniyientry9` text NOT NULL,
  `eniyientry10` text NOT NULL,
  `eniyientry11` int(11) DEFAULT NULL,
  `eniyientry12` int(11) DEFAULT NULL,
  `eniyientry13` int(11) DEFAULT NULL,
  `eniyientry14` int(11) DEFAULT NULL,
  `eniyientry15` int(11) DEFAULT NULL,
  `eniyientry16` int(11) DEFAULT NULL,
  `eniyientry17` int(11) DEFAULT NULL,
  `eniyientry18` int(11) DEFAULT NULL,
  `eniyientry19` int(11) DEFAULT NULL,
  `eniyientry20` int(11) DEFAULT NULL,
  `eniyibaslik1` text DEFAULT NULL,
  `eniyibaslik2` text DEFAULT NULL,
  `eniyibaslik3` text DEFAULT NULL,
  `eniyibaslik4` text DEFAULT NULL,
  `eniyibaslik5` text DEFAULT NULL,
  `eniyibaslik6` text DEFAULT NULL,
  `eniyibaslik7` text DEFAULT NULL,
  `eniyibaslik8` text DEFAULT NULL,
  `eniyibaslik9` text DEFAULT NULL,
  `eniyibaslik10` text DEFAULT NULL,
  `eniyibaslik11` text DEFAULT NULL,
  `eniyibaslik12` text DEFAULT NULL,
  `eniyibaslik13` text DEFAULT NULL,
  `eniyibaslik14` text DEFAULT NULL,
  `eniyibaslik15` text DEFAULT NULL,
  `eniyibaslik16` text NOT NULL,
  `eniyibaslik17` text NOT NULL,
  `eniyibaslik18` text NOT NULL,
  `eniyibaslik19` text NOT NULL,
  `eniyibaslik20` text NOT NULL,
  `encokyazar1` text NOT NULL,
  `encokyazar2` text NOT NULL,
  `encokyazar3` text NOT NULL,
  `encokyazar4` text NOT NULL,
  `encokyazar5` text NOT NULL,
  `encokyazar6` text NOT NULL,
  `encokyazar7` text NOT NULL,
  `encokyazar8` text NOT NULL,
  `encokyazar9` text NOT NULL,
  `encokyazar10` text NOT NULL,
  `encokyazar11` text DEFAULT NULL,
  `encokyazar12` text DEFAULT NULL,
  `encokyazar13` text DEFAULT NULL,
  `encokyazar14` text DEFAULT NULL,
  `encokyazar15` text DEFAULT NULL,
  `encokyazar16` text NOT NULL,
  `encokyazar17` text NOT NULL,
  `encokyazar18` text NOT NULL,
  `encokyazar19` text NOT NULL,
  `adet1` int(11) NOT NULL,
  `adet2` int(11) NOT NULL,
  `adet3` int(11) NOT NULL,
  `adet4` int(11) NOT NULL,
  `adet5` int(11) NOT NULL,
  `adet6` int(11) NOT NULL,
  `adet7` int(11) NOT NULL,
  `adet8` int(11) NOT NULL,
  `adet9` int(11) NOT NULL,
  `adet10` int(11) NOT NULL,
  `adet11` int(11) DEFAULT NULL,
  `adet12` int(11) DEFAULT NULL,
  `adet13` int(11) DEFAULT NULL,
  `adet14` int(11) DEFAULT NULL,
  `adet15` int(11) DEFAULT NULL,
  `adet16` int(11) NOT NULL,
  `adet17` int(11) NOT NULL,
  `adet18` int(11) NOT NULL,
  `adet19` int(11) NOT NULL,
  `oycu1` text DEFAULT NULL,
  `oycu2` text DEFAULT NULL,
  `oycu3` text DEFAULT NULL,
  `oycu4` text DEFAULT NULL,
  `oycu5` text DEFAULT NULL,
  `oycu6` text DEFAULT NULL,
  `oycu7` text DEFAULT NULL,
  `oycu8` text DEFAULT NULL,
  `oycu9` text DEFAULT NULL,
  `oycu10` text DEFAULT NULL,
  `oycu11` tinytext DEFAULT NULL,
  `oycu12` tinytext DEFAULT NULL,
  `oycu13` tinytext DEFAULT NULL,
  `oycu14` tinytext DEFAULT NULL,
  `oycu15` tinytext DEFAULT NULL,
  `encokoy1` int(11) DEFAULT NULL,
  `encokoy2` int(11) DEFAULT NULL,
  `encokoy3` int(11) DEFAULT NULL,
  `encokoy4` int(11) DEFAULT NULL,
  `encokoy5` int(11) DEFAULT NULL,
  `encokoy6` int(11) DEFAULT NULL,
  `encokoy7` int(11) DEFAULT NULL,
  `encokoy8` int(11) DEFAULT NULL,
  `encokoy9` int(11) DEFAULT NULL,
  `encokoy10` int(11) DEFAULT NULL,
  `encokoy11` int(11) DEFAULT NULL,
  `encokoy12` int(11) DEFAULT NULL,
  `encokoy13` int(11) DEFAULT NULL,
  `encokoy14` int(11) DEFAULT NULL,
  `encokoy15` int(11) DEFAULT NULL,
  `ucyazar1` text NOT NULL,
  `ucyazar2` text NOT NULL,
  `ucyazar3` text NOT NULL,
  `ucyazar4` text NOT NULL,
  `ucyazar5` text NOT NULL,
  `ucyazar6` text NOT NULL,
  `ucyazar7` text NOT NULL,
  `ucyazar8` text NOT NULL,
  `ucyazar9` text NOT NULL,
  `ucyazar10` text NOT NULL,
  `ucadet1` int(11) NOT NULL,
  `ucadet2` int(11) NOT NULL,
  `ucadet3` int(11) NOT NULL,
  `ucadet4` int(11) NOT NULL,
  `ucadet5` int(11) NOT NULL,
  `ucadet6` int(11) NOT NULL,
  `ucadet7` int(11) NOT NULL,
  `ucadet8` int(11) NOT NULL,
  `ucadet9` int(11) NOT NULL,
  `ucadet10` int(11) NOT NULL,
  `biryaz` int(4) NOT NULL,
  `ikiyaz` int(4) NOT NULL,
  `ucyaz` int(4) NOT NULL,
  `pyazar1` text NOT NULL,
  `pyazar2` text NOT NULL,
  `pyazar3` text NOT NULL,
  `pyazar4` text NOT NULL,
  `pyazar5` text NOT NULL,
  `pyazar6` text NOT NULL,
  `pyazar7` text NOT NULL,
  `pyazar8` text NOT NULL,
  `pyazar9` text NOT NULL,
  `pyazar10` text NOT NULL,
  `padet1` int(11) NOT NULL,
  `padet2` int(11) NOT NULL,
  `padet3` int(11) NOT NULL,
  `padet4` int(11) NOT NULL,
  `padet5` int(11) NOT NULL,
  `padet6` int(11) NOT NULL,
  `padet7` int(11) NOT NULL,
  `padet8` int(11) NOT NULL,
  `padet9` int(11) NOT NULL,
  `padet10` int(11) NOT NULL,
  `gentry` int(40) NOT NULL,
  `bentry` int(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `statmonth`
--

DROP TABLE IF EXISTS `statmonth`;
CREATE TABLE IF NOT EXISTS `statmonth` (
  `baslik` text NOT NULL,
  `entry` text NOT NULL,
  `silbaslik` text NOT NULL,
  `silentry` text NOT NULL,
  `hit` text NOT NULL,
  `tekil` text NOT NULL,
  `ortbaslik` text NOT NULL,
  `ortentry` text NOT NULL,
  `tarih` text NOT NULL,
  `enhitbaslik` text NOT NULL,
  `gun` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takip`
--

DROP TABLE IF EXISTS `takip`;
CREATE TABLE IF NOT EXISTS `takip` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `baslik` int(4) NOT NULL,
  `nick` text COLLATE utf8_turkish_ci NOT NULL,
  `check` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `temalar`
--

DROP TABLE IF EXISTS `temalar`;
CREATE TABLE IF NOT EXISTS `temalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(255) NOT NULL,
  `stat` int(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tema` (`tema`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yazar` text COLLATE utf8_turkish_ci NOT NULL,
  `test` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nick` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sifre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `yetki` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `durum` varchar(255) CHARACTER SET latin1 NOT NULL,
  `dt` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cinsiyet` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sehir` varchar(255) CHARACTER SET latin1 NOT NULL,
  `regsehir` text NOT NULL,
  `sonip` varchar(255) NOT NULL,
  `sontarih` text NOT NULL,
  `regip` varchar(255) CHARACTER SET latin1 NOT NULL,
  `regtarih` varchar(255) CHARACTER SET latin1 NOT NULL,
  `online` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tema` varchar(255) CHARACTER SET latin1 NOT NULL,
  `reset` int(5) DEFAULT NULL,
  `ilknick` varchar(255) DEFAULT NULL,
  `flood` int(3) NOT NULL,
  `youtube` tinyint(1) NOT NULL,
  `not` text NOT NULL,
  `silen` varchar(255) NOT NULL,
  `onaylayan` varchar(255) NOT NULL,
  `silsebep` varchar(255) NOT NULL,
  `admnot` varchar(255) NOT NULL,
  `bantarih` text NOT NULL,
  `msgblok` int(1) NOT NULL,
  `eksiyasak` int(1) NOT NULL,
  `verified` int(1) NOT NULL,
  `cezali` int(1) NOT NULL,
  `muddet` text NOT NULL,
  `infaztarih` text NOT NULL,
  `muddettarih` varchar(12) NOT NULL DEFAULT '9999999999',
  `saysil` int(11) NOT NULL DEFAULT 0,
  `saycaylak` int(11) NOT NULL DEFAULT 0,
  `karma` varchar(255) NOT NULL,
  `rozet` bigint(15) NOT NULL,
  `motto` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `isim` (`isim`),
  KEY `nick` (`nick`),
  KEY `sifre` (`sifre`),
  KEY `yetki` (`yetki`),
  KEY `email` (`email`),
  KEY `durum` (`durum`),
  KEY `dt` (`dt`),
  KEY `cinsiyet` (`cinsiyet`),
  KEY `sehir` (`sehir`),
  KEY `regip` (`regip`),
  KEY `regtarih` (`regtarih`),
  KEY `online` (`online`),
  KEY `tema` (`tema`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `md5_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `full_name` tinytext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `avatar` varchar(700) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_email` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT 1,
  `about` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `sex` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `favart` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `location` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pwd` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `users_ip` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `approved` int(1) NOT NULL DEFAULT 0,
  `activation_code` int(10) NOT NULL DEFAULT 0,
  `banned` int(1) NOT NULL DEFAULT 0,
  `ckey` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ctime` varchar(220) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `veto`
--

DROP TABLE IF EXISTS `veto`;
CREATE TABLE IF NOT EXISTS `veto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `veto1` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `veto2` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `veto3` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `gun` int(3) NOT NULL,
  `veto1kim` text COLLATE utf8_turkish_ci NOT NULL,
  `veto2kim` text COLLATE utf8_turkish_ci NOT NULL,
  `veto3kim` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

DROP TABLE IF EXISTS `yorum`;
CREATE TABLE IF NOT EXISTS `yorum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kime` varchar(250) NOT NULL DEFAULT '',
  `kimden` varchar(250) NOT NULL DEFAULT '',
  `yorum` text NOT NULL,
  `num` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kime` (`kime`),
  KEY `kimden` (`kimden`),
  KEY `num` (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar` ADD FULLTEXT KEY `site_3` (`site`);

--
-- Tablo için indeksler `konular`
--
ALTER TABLE `konular` ADD FULLTEXT KEY `baslik_2` (`baslik`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users` ADD FULLTEXT KEY `idx_search` (`full_name`,`user_email`,`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
