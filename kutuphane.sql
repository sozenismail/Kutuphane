-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 16 Haz 2019, 14:29:05
-- Sunucu sürümü: 10.1.40-MariaDB
-- PHP Sürümü: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `burakolm_kutuphane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeni`
--

CREATE TABLE `begeni` (
  `begeniId` int(11) NOT NULL,
  `kitapId` int(11) NOT NULL,
  `uyeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `begeni`
--

INSERT INTO `begeni` (`begeniId`, `kitapId`, `uyeId`) VALUES
(12, 2, 4),
(23, 3, 5),
(24, 2, 5),
(28, 5, 5),
(29, 10, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `islemler`
--

CREATE TABLE `islemler` (
  `islemId` int(11) NOT NULL,
  `islemDurum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `baslangicTarihi` date NOT NULL,
  `bitisTarihi` date NOT NULL,
  `teslimTarihi` date DEFAULT NULL,
  `islemUcreti` varchar(6) COLLATE utf8_turkish_ci NOT NULL,
  `uyeId` int(11) NOT NULL,
  `kitapId` int(11) NOT NULL,
  `uzatmaSayisi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `islemler`
--

INSERT INTO `islemler` (`islemId`, `islemDurum`, `baslangicTarihi`, `bitisTarihi`, `teslimTarihi`, `islemUcreti`, `uyeId`, `kitapId`, `uzatmaSayisi`) VALUES
(1, '1', '2019-05-01', '2019-05-22', NULL, '', 4, 2, 0),
(2, '0', '2019-05-03', '2019-05-24', '2019-05-09', '0.5', 5, 3, 0),
(3, '0', '2019-05-01', '2019-05-15', '2019-05-17', '1', 4, 2, 0),
(4, '1', '2019-05-27', '2019-06-03', NULL, '0', 4, 2, 0),
(5, '0', '2019-05-03', '2019-05-24', '2019-05-09', '0.5', 4, 3, 0),
(6, '0', '2019-05-03', '2019-05-24', '2019-05-09', '0.5', 5, 2, 0),
(7, '1', '2019-06-07', '2019-07-05', NULL, '0.5', 5, 2, 0),
(8, '0', '2019-06-14', '2019-07-12', '2019-06-14', '-14', 4, 4, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategoriId` int(11) NOT NULL,
  `kategoriAd` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `kategoriResim` varchar(200) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategoriId`, `kategoriAd`, `kategoriResim`) VALUES
(1, 'Bilim Kurgu', 'dimg/kategori/24225213552716920083bilim.jpg'),
(2, 'Tarih', 'dimg/kategori/20872226252535126686tarih.jpg'),
(3, 'Korku', 'dimg/kategori/27705273752414220357korku.jpg'),
(4, 'Dini', 'dimg/kategori/29128241622874021304dini.jpg'),
(5, 'Edebiyat', 'dimg/kategori/30246310912782220795edebiyat.jpg'),
(7, 'Çocuk', 'dimg/kategori/31673201072613130039cocuk.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap`
--

CREATE TABLE `kitap` (
  `kitapId` int(11) NOT NULL,
  `kitapAd` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kitapOzet` varchar(1200) COLLATE utf8_turkish_ci NOT NULL,
  `kitapResim` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `basimYili` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `sayfaSayisi` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kategoriId` int(11) NOT NULL,
  `yazarId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kitap`
--

INSERT INTO `kitap` (`kitapId`, `kitapAd`, `kitapOzet`, `kitapResim`, `basimYili`, `sayfaSayisi`, `isbn`, `kategoriId`, `yazarId`) VALUES
(7, 'KAYIP ROMANLAR', 'Vedat Türkali, \"Kayıp Romanlar\"da artık seksenine yaklaşmış ve hayatının önemli bir bölümünü sürgün olarak yurtdışında geçirmek zorunda kalmış bir TKP\'linin; yasal sorunları aşıp yeni bin yılın başında Türkiye\'ye dönüşünü ve eski hatiralari ile karşilaştigi Türkiye arasindaki gerilimleri anlatiyor.\r\n', 'dimg/kitap/210793187326872252550000000164520-1.jpg', '2001', '56', 'asder3', 1, 2),
(8, 'YAPRAK DÖKÜMÜ', 'Vedat Türkali, Türkiye romanının \'sıradışı\' kalemlerinden birisi. İlk romanı \"Bir Gün Tek Başina\"nın yayınlanmasıyla birlikte farklı üslubu ile hem Türkiye romanına, hem de siyasal romana yeni bir soluk getirmişti. Daha sonraki romanları, \"Mavi Karanlık\", \"Yeşilçam Dedikleri Türkiye\", \"Tek Kişilik Ölüm\" ve \"Güven\"le bu çizgisini devam ettiren Türkali\'nin romanları aynı zamanda Türkiye Komünist Partisi\'nin gayri resmi tarihi olarak da okunabilir. Türkali, \"Bir gün Tek Başina\" ile 50\'li yılların son dönemlerini anlatarak başlatığı bu \'tarih yazıcılığını\' daha sonra kronolojik olmayan bir sırayla devam ettirdi. İkinci Dünya Savaşı yıllarında bir grup TKP\'li gencin İstanbul\'da yaşadiklarini anlatan \"Güven\"in ardından şimdi de TKP\'den kalanların bugünkü hallerini anlatan romanı \"Kayıp Romanlar\" ile en azından bu defteri kapatıyor. \r\n', 'dimg/kitap/25406269312683730656yaprak.jpg', '2009', '986', 'er569a', 2, 8),
(9, 'BUZDAKİ KIZ', 'Komünist aşkı \"Kayıp Romanlar\", Türkali romanlarının vazgeçilmez iki unsuru olan aşk ve siyaset unsurlarının ele alınışı bakımından daha önceki romanlarının gerisine düşüyor. Aşk, Vedat Türkali romanlarının en önemli unsurlarından birisi. Hatta kimi zaman \'erotizme\' kaçmakla bile eleştirilen yazar; \"Kayıp Romanları\"ın kahramanı Doktor Nahit\'i de aşik ediyor. Hem de kendisinden onlarca yaş küçük bir kadina. Bunda herhangi bir problem yok. Ama Türkali\'nin bu aşki ele alişi; daha önceki romanlarinin aşklarini inkâr ediyor. Doktor Nahit\'in onca yıla, seksen yıllık yaşanmışlığa hiç aşk sığdıramamış olması, Esme\'de tattığı duyguları daha önce hiçbir kadında yaşamamış olması, komünist hayatın ona bu fırsatı vermemiş olması gibi Türkali\'nin önceki roman kahramanlarını yaşadığı aşkların hepsini yalanlıyor sanki. Son yirmi yılda komünistleri anlattığını iddia eden her romanın, nedense erkek kahramanları, aşka fazlasıyla aç, o duyguyu hiç yaşamamış olarak resmedildiler. Türkali de bu egemen söylemden kaçamıyor. Oysa, Dortor Nahit, pekala Güven\'in Turgut\'u da olabilir! Türkali\'nin önceki romanlarının kahramanları, ki birçoğu TKP\'lidirler, aşklarini doya doya yaşiyorlardi. Ama Türkali, kahraman', 'dimg/kitap/20043211632927226890buz.jpg', '1997', '659', 'ert886', 3, 6),
(10, 'FESLEĞEN', 'Değerli Dostlarım,\r\n\r\nKısaca iş dünyası ve çalışma hayatının geleceğine dair 5 adet Fütürolojik kitabın özetini peş peşe sizler ile paylaşacağımızı belirtmiştik. Bu serinin üçüncü özeti: Kendi Evrimimizi Yönetmek\r\n\r\nAyrıca www.ozetkitap.com isimli sitemizde bugüne kadar bu alanda paylaşmış olduğumuz tüm Fütüroloji ile ilgili kitapların özetleri de halan sitede ve güncelliklerini koruyor.\r\n\r\nBu özetler siz gençlerin ve geleceğinden endişe duyan tüm kişilerin mutlaka okuması gereken kitaplardan oluşuyor. Özetler ile yetinmeyip pek çok kitabın aslını alıp okuyacağınızdan hiç şüphemiz yok.\r\n\r\nDünyamız yepyeni bir çağa doğru inanılmaz bir sürat ile değişerek ilerler iken buna kayıtsız kalamazsınız. Kendiniz için değil ise çocuklarınız ve/veya torunlarınız için mutlaka bu bilgilere ihtiyacınız var.\r\n\r\nOkuyun lütfen. Okudukça bir sonraki özeti sabırsızlıkla beklediğinizi fark edeceksiniz.\r\n\r\nEn İçten Sevgi ve Saygılarımla\r\nUğur Yüce\r\n\r\n', 'dimg/kitap/313912810721644298485.jpg', '1997', '200', '4wqe51sd3a', 7, 7),
(11, 'ÜÇÜNCÜ ADAM', 'Cumhuriyetin kadınları, kadınlarımız, insanımız ne kadar güçlüymüş dedirten bir aile düşünün. Onların yanında da savaşı İstanbul’da yaşayan yani hiç yaşamayan insanlar. Edebiyat dersinde anlatılan eski yeni çatışmasından daha öte bir çatışma yaşanmış; savaşı yaşayan ve yaşamayan.\r\n\r\nCumhuriyetin kadınlarının tek başına verdikleri mücadele gözümüzün önünden geçiyor. Birbirlerine tutunuşlarını, zamanında taş üstünde taş kalmamış dünyalarından nasıl küllerinden doğduklarını, yaralarını nasıl ‘cumhuriyet kadını’ olarak sardıklarını ve saracaklarını okuyoruz. Çünkü bu kitap bir serinin başlangıç kitabı. Bir mahşere kafa tutuşun kitabı, haklı bir kafa tutuşun yani Ülkü’nün. \r\n\r\nEn iyi eğitim okullarda mı alınır diye sordurtuyor kitap. Çünkü savaşın kızı var karşımızda; Ülkü.ve bir de sadrazamın oğlu olan Selim duruyor diğer köşede. En iyi okullarda okumuş, dünyanın tüm nimetlerinden yararlanmış bir şekilde karşımıza çıkıyor. Osmanlı’yı tekrar canlandırma düşüncesiyle yanıp kavruluyor olsa da kitap boyunca düşünen insanın evrilişini görüyoruz. Bu evrilişin bir aşaması da aşk. Aşkın adı Ülkü, Ülkü’nün adı aşk. İlk görüşte olan. Ama arada kültür farkı, zenginlik ve fakirlik, savaşı yaşamanı', 'dimg/kitap/227722407228228315461.jpg', '2004', '489', 'a67t5g4eds', 2, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE `personel` (
  `personelId` int(11) NOT NULL,
  `personelResim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `personelAdSoyad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciAd` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciSifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_yetki` int(5) NOT NULL,
  `kullanici_durum` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `personel`
--

INSERT INTO `personel` (`personelId`, `personelResim`, `personelAdSoyad`, `kullaniciAd`, `kullaniciSifre`, `kullanici_yetki`, `kullanici_durum`) VALUES
(1, 'dimg/kullanici/2348021145kullanici-resim-yok.jpg', 'İsmail Sözen', 'admin', 'admin', 5, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

CREATE TABLE `uye` (
  `uyeId` int(11) NOT NULL,
  `uyeAdSoyad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `uyeBolum` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `uyeCinsiyet` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `uyeTc` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `uyeTelefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `uyeSifre` varchar(200) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`uyeId`, `uyeAdSoyad`, `uyeBolum`, `uyeCinsiyet`, `uyeTc`, `uyeTelefon`, `uyeSifre`) VALUES
(4, 'Hasan Kurt', 'Bilgisayar Mühendisliği', 'Erkek', '12345678912', '05455256565', 'admin'),
(5, 'Burak Ölmez', 'Makina Mühendisliği', 'Erkek', '12345678911', '0589656656', 'admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazar`
--

CREATE TABLE `yazar` (
  `yazarId` int(11) NOT NULL,
  `yazarAdSoyad` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `yazarUyruk` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `yazarCinsiyet` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yazar`
--

INSERT INTO `yazar` (`yazarId`, `yazarAdSoyad`, `yazarUyruk`, `yazarCinsiyet`) VALUES
(2, 'Halit Ziya Uşaklıgil', 'Türkiye', 'Erkek'),
(5, 'Lev Tolstoy', 'Rusya', 'Erkek'),
(6, 'Franz Kafka', 'Azerbaycan', 'Erkek'),
(7, 'George Orwell', 'Hindistan', 'Erkek'),
(8, 'Ahmet Hamdi Tanpınar', 'Türkiye', 'Erkek');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorumId` int(11) NOT NULL,
  `kitapId` int(11) NOT NULL,
  `uyeId` int(11) NOT NULL,
  `yorumIcerik` varchar(1000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`yorumId`, `kitapId`, `uyeId`, `yorumIcerik`) VALUES
(1, 3, 4, 'Test yorum'),
(2, 3, 4, 'Test yorum 2'),
(7, 3, 5, 'wqeqetgrzdxfŞGLnkşg.fdbvsd'),
(10, 6, 5, 'asdasd'),
(11, 3, 5, 'sadweqfa'),
(12, 9, 5, 'Test Yorum');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `begeni`
--
ALTER TABLE `begeni`
  ADD PRIMARY KEY (`begeniId`);

--
-- Tablo için indeksler `islemler`
--
ALTER TABLE `islemler`
  ADD PRIMARY KEY (`islemId`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriId`);

--
-- Tablo için indeksler `kitap`
--
ALTER TABLE `kitap`
  ADD PRIMARY KEY (`kitapId`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`personelId`);

--
-- Tablo için indeksler `uye`
--
ALTER TABLE `uye`
  ADD PRIMARY KEY (`uyeId`);

--
-- Tablo için indeksler `yazar`
--
ALTER TABLE `yazar`
  ADD PRIMARY KEY (`yazarId`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorumId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `begeni`
--
ALTER TABLE `begeni`
  MODIFY `begeniId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `islemler`
--
ALTER TABLE `islemler`
  MODIFY `islemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `kitap`
--
ALTER TABLE `kitap`
  MODIFY `kitapId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `personel`
--
ALTER TABLE `personel`
  MODIFY `personelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `uye`
--
ALTER TABLE `uye`
  MODIFY `uyeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `yazar`
--
ALTER TABLE `yazar`
  MODIFY `yazarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
