-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 10:36 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `id_role`, `status`) VALUES
(1, 'Superadmin', 'Superadmin', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
(2, 'karyawan1', 'karyawan1', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(3, 'karyawan2', 'karyawan2', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(4, 'karyawan3', 'karyawan3', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(5, 'karyawan4', 'karyawan4', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(6, 'karyawan5', 'karyawan5', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(7, 'karyawan6', 'karyawan6', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(8, 'superadmin2', 'superadmin2', 'e10adc3949ba59abbe56e057f20f883e', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id_artikel` int(11) NOT NULL,
  `id_kopi` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_kopi`, `deskripsi`) VALUES
(1, 1, 'Kopi Gayo merupakan salah satu komoditi unggulan yang berasal dari Dataran Tinggi Gayo. Perkebunan Kopi yang telah dikembangkan sejak tahun 1908 ini tumbuh subur di Kabupaten Bener Meriah, Aceh Tengah, serta Gayo Lues.\nGayo sendiri merupakan nama Suku Asli yang mendiami wilayah ini. Kopi yang ditanam di Tanah Gayo adalah kopi arabica, sebuah varietas kopi yang belakangan sangat masif perkembangannnya di Indonesia. Rasa kopi arabica yang ringan karena konon kafeinnya jauh lebih kecil dibanding robusta, menjadi penyebab mereka yang kerap bermasalah dengan asam lambung setelah minum kopi, memilih kopi arabica sebagai teman santai di pagi atau sore hari.'),
(2, 9, 'Meskipun dari segi letak geografisnya Timor Leste bersebelahan dengan Indonesia, tetapi Timor Leste menghasilkan kopi yang cita rasanya berbeda dengan jenis-jenis kopi yang ada di Indonesia. Keunikan Kopi Arabica Timor Leste Arabica adalah karena kopi ini tumbuh secara bebas dan liar. Sehingga menjadikannya salah satu kopi organik yang unik dan tentunya sangat diminati. Organik adalah sebuah label unggul bagi anda yang gemar menikmati kopi kualitas bagus yang dibesarkan oleh alam. Karakteristik jenis ini sendiri adalah aroma liquor yang kuat serta diberkahi aroma lembut yang membuat pengalaman minum kopi anda terasa lebih nikmat. Arabica Timor Leste sangat cocok untuk anda yang menyukai kebebasan tak terbatas dalam hidup: liar, kuat dan nikmat.'),
(3, 8, 'Sejenis kopi Arabika ini tumbuh subur di wilayah ketinggian sekitar 15.000 kaki dari permukaan laut dengan suhu 20–25 derajat celsius. Kopi-kopi ini merupakan kopi yang diklaim memiliki kualitas terbaik, dengan kandungan kafein yang sedikit. Kopi Wamena memiliki aroma yang wangi dan khas, bertekstur soft, serta bagi penikmat kopi, kopi Wamena juga memiliki after taste (rasa yang muncul setelah minum kopi) yang manis.'),
(4, 7, 'Kopi Jawa Indonesia tidak memiliki bentuk yang sama dengan kopi Sumatra dan Sulawesi, cita rasa juga tidak terlalu kaya sebagaimana kopi dari Sumatra atau Sulawesi karena sebagian besar kopi Jawa diproses secara basah (wet process). Meskipun begitu, sebagian kopi Jawa mengeluarkan aroma tipis rempah sehingga membuatnya lebih baik dari jenis kopi lainnya. Kopi Jawa memiliki keasaman yang rendah dikombinasikan dengan kondisi tanah, suhu udara, cuaca, serta kelembaban udara.Kopi ini sangatlah terkenal sehingga nama Jawa menjadi nama identitas untuk kopi.'),
(5, 6, 'Kopi flores Bajawa ini merupakan kopi jenis arabika. Aroma dan rasanya sangat khas dan nikmat, berbeda dengan kopi jenis robusta yang rasanya lebih cenderung pahit. Rasa dari kopi arabika ini lebih cenderung asam dan juga ringan. Kualitas dari kopi bajawa dari Flores ini pun memiliki kualitas yang bagus karena tidak menggunakan bahan kimia dalam pengolahannya. Ini lah salah satu yang menjadi keistimewaan dan keunggulan dari kopi ini dibandingkan dengan kopi lainnya'),
(6, 5, 'Sejak zaman Belanda kopi asal Jawa Barat sangat dikenal dengan sebutan "Java" dan karena pertama kali kopi ditanam di daerah priangan maka julukan yang dikenal masyarakat luas adalah "Java Preanger". Sejak itu kopi asal Jawa Barat selalu disebut Kopi Java Preanger, baik kopi jenis arabika maupun kopi jenis robusta. Tentunya untuk para pecinta kopi dengan citarasa lembut dan aroma yang unik, Kopi Arabika Java Preanger dapat dijadikan sebagai pilihan yang tepat untuk menemani aktivitas sehari-hari, untuk melahirkan ide-ide briliyan dan juga untuk bersantai.'),
(7, 4, 'Kopi yang berasal dari daerah Kintamani Bali nan sejuk ini memang memiliki keunikan cita rasa yang berbeda dari kopi di daerah lain di nusantara. Kopi Bali Kintamani memiliki cita rasa buah-buahan yang asam dan segar. Hal tersebut terjadi dikarenakan tanaman kopi di Bali Kintamani ditanam bersamaan dengan tanaman lain seperti aneka sayuran dan buah jeruk. Kopi jenis ini menggunakan sistem ‘tumpang sari’ bersama dengan jenis tanaman lain. Itu kenapa biji kopinya meresap rasa buah-buahan seperti jeruk. Selain memiliki cita rasa ‘buah’, kopi Bali Kintamani memiliki cita rasa yang lembut dan tidak berat. Keunikanya tersebut di dapat dari letak geografisnya yang unik juga. Bagi kamu yang menyukai cita rasa kopi berbeda, kopi Bali Kintamani bisa menjadi pilihan yang tepat. '),
(8, 3, 'Varian kopi yang satu ini sebenarnya sudah dikenal dunia sejak sekitar tahun 1878. Nama mandailing atau Mandheling sendiri diambil dari nama salah satu suku yang ada di Sumatera Utara. Ada beberapa hal yang harus diketahui jika anda ingin mengembangbiakkan varian kopi terbaik ini. Salah satunya yaitu kopi Mandheling dapat tumbuh dengan baik jika ditanam pada ketinggian sekitar 1200. Kopi Mandheling ini sangat istimewa karena mempunyai cita rasa yang kuat, tingkat keasaman medium, cita rasa floral, dan juga mempunyai after taste yang tidak dapat ditemukan pada varian kopi lainnya.'),
(9, 2, ' Biji kopi Toraja Kalosi di tanam di daerah pegunungan tinggi Sulawesi Selatan. Kalosi adalah nama kota kecil di Sulawesi yang merupakan tempat pengumpulan kopi dari daerah sekitarnya. Toraja adalah daerah pegunungan di Sulawesi, tempat dimana tumbuhnya kopi tersebut. Kopi Toraja juga sering disebut sebagai “Queen Of Coffee” karena memiliki taste yang seimbang dan unik  dengan tingkat keasaman yang rendah, halus, lembut, serta cita rasa yang floral dan fruity. Sensasi rasa kopinya kuat, menembus lidah. Juga ada rasa kecut. Pahitnya muncul di ujung lidah tak lama setelah di minum. '),
(11, 12, 'Tumbuh di pegunungan dari Columbia sampe ke Ekuador, lalu turun ke Brazil. Kopi yang berasal dari daerah ini adalah kopi Robusta yang penuh rasa, dan juga diproses dengan cara "basah".  Memiliki tingkat keasaman yang sedang, rasanya manis, dan memiliki efek rasa kopi yang tidak akan menghilang sesudah meminumnya (strong aftertaste). Kopi ini memiliki aroma kayu manis yang nikmat, sangat pas saat dicampur dengan gula maupun susu. Pilihan yang cocok bagi Anda yang gemar minum kopi susu (cafe au lait, cappucino, caffe latte), dan yang tidak begitu suka minum kopi hitam.'),
(12, 13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis faucibus eros id rhoncus. Etiam molestie orci ut odio accumsan, eget sollicitudin quam finibus. Suspendisse auctor, erat non rutrum condimentum, arcu nisi iaculis augue, vitae semper nunc magna eget sem. Sed ornare sapien sit amet auctor commodo. Maecenas bibendum maximus maximus. Quisque euismod velit vel risus aliquet lacinia. In tincidunt fringilla nisl sed sodales. Curabitur iaculis ex sit amet urna hendrerit suscipit. Morbi ullamcorper accumsan est, sit amet tristique magna vestibulum nec. Aenean auctor dictum odio, id mollis risus ornare non. In viverra augue sed libero convallis, a vulputate erat consequat.'),
(13, 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis faucibus eros id rhoncus. Etiam molestie orci ut odio accumsan, eget sollicitudin quam finibus. Suspendisse auctor, erat non rutrum condimentum, arcu nisi iaculis augue, vitae semper nunc magna eget sem. Sed ornare sapien sit amet auctor commodo. Maecenas bibendum maximus maximus. Quisque euismod velit vel risus aliquet lacinia. In tincidunt fringilla nisl sed sodales. Curabitur iaculis ex sit amet urna hendrerit suscipit. Morbi ullamcorper accumsan est, sit amet tristique magna vestibulum nec. Aenean auctor dictum odio, id mollis risus ornare non. In viverra augue sed libero convallis, a vulputate erat consequat.');

-- --------------------------------------------------------

--
-- Table structure for table `bijih_kopi`
--

CREATE TABLE IF NOT EXISTS `bijih_kopi` (
  `id_kopi` int(11) NOT NULL,
  `nama_kopi` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '100000',
  `status` int(11) NOT NULL DEFAULT '1',
  `foto_produk` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bijih_kopi`
--

INSERT INTO `bijih_kopi` (`id_kopi`, `nama_kopi`, `harga`, `stok`, `status`, `foto_produk`) VALUES
(1, 'Aceh Gayo', 7000, 100000, 1, 'images/produk/g-5.jpg'),
(2, 'Toraja', 9500, 100000, 1, 'images/produk/g-5.jpg'),
(3, 'Mandheling', 11500, 100000, 1, 'images/produk/g-5.jpg'),
(4, 'Bali Kintamani', 8000, 100000, 1, 'images/produk/g-5.jpg'),
(5, 'Java Preanger', 10000, 100000, 1, 'images/produk/g-5.jpg'),
(6, 'Flores Bajawa', 13000, 100000, 1, 'images/produk/g-5.jpg'),
(7, 'Java Ijen', 11000, 100000, 1, 'images/produk/g-5.jpg'),
(8, 'Papua Wawena', 14500, 100000, 1, 'images/produk/g-5.jpg'),
(9, 'Timor Leste', 145000, 99600, 1, 'images/produk/kopi_9.jpg'),
(12, 'Brazilian Santos', 7600, 78300, 1, 'images/produk/kopi_12.jpg'),
(13, 'test', 12000, 100, 1, 'images/produk/kopi_13.jpg'),
(14, 'test 2', 50000, 100, 1, 'images/produk/kopi_14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id_order_dtl` int(11) NOT NULL,
  `id_order_hdr` int(11) NOT NULL,
  `id_kopi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_dtl`, `id_order_hdr`, `id_kopi`, `jumlah`, `subtotal`) VALUES
(1, 1, 2, 100, 9500),
(2, 1, 8, 100, 14500),
(3, 3, 2, 100, 9500),
(4, 3, 8, 100, 14500),
(5, 4, 8, 1000, 145000),
(6, 4, 9, 6000, 870000),
(7, 5, 8, 10000, 1450000),
(8, 6, 13, 100, 12000),
(9, 7, 14, 100, 50000),
(10, 8, 14, 100, 50000),
(11, 9, 14, 100, 50000),
(12, 10, 13, 200, 24000),
(16, 15, 12, 100, 7600),
(17, 15, 9, 100, 145000),
(18, 16, 12, 21000, 1596000),
(19, 16, 9, 100, 145000),
(20, 17, 12, 100, 7600),
(21, 17, 9, 100, 145000),
(22, 18, 13, 100, 12000),
(23, 19, 12, 100, 7600),
(24, 20, 12, 100, 7600),
(25, 21, 13, 100, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE IF NOT EXISTS `order_header` (
  `id_order_hdr` int(11) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `biaya_pengiriman` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_berat` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`id_order_hdr`, `tgl_order`, `nama_customer`, `telp`, `alamat`, `biaya_pengiriman`, `total`, `total_berat`, `status`) VALUES
(1, '2018-02-07', 'Johan', '0863527632', 'jalan lohan 13\r\nkec: ikan asin\r\nkel: ikan laut\r\nnew york selatan', 8000, 32000, 1, 4),
(3, '2018-02-07', 'Johan', '0863527632', 'jalan lohan 13\r\nkec: ikan asin\r\nkel: ikan laut\r\nnew york selatan', 8000, 32000, 1, 1),
(4, '2018-02-07', 'Jhan', '0863527632', 'jalan lohan 13\r\nkec: ikan asin\r\nkel: ikan laut\r\nnew york selatan', 16000, 1031000, 7, 1),
(5, '2018-03-24', 'johan', '0863527632', 'jalan lohan 13\r\nkec: ikan asin\r\nkel: ikan laut\r\nnew york selatan', 80000, 1530000, 10, 1),
(6, '2018-04-04', 'johan', '0863527632', 'jalan lohan 13\r\nkec: ikan asin\r\nkel: ikan laut\r\nnew york selatan', 0, 12000, 1, 1),
(7, '2018-04-04', 'Johan', '0863527632', 'test', 0, 50000, 1, 1),
(8, '2018-04-04', 'test', '0863527632', 'asd', 0, 50000, 1, 1),
(9, '2018-04-04', 'test', '0863527632', 'ASDA', 0, 50000, 1, 1),
(10, '2018-04-04', 'test', '0863527632', 'test', 27000, 24000, 1, 1),
(15, '2018-04-07', 'admin (offline)', '-', 'Pembelian di toko', 0, 152600, 1, 3),
(16, '2018-04-07', 'admin (offline)', '-', 'Pembelian di toko', 0, 1741000, 22, 3),
(17, '2018-04-07', 'admin (offline)', '-', 'Pembelian di toko', 0, 152600, 1, 3),
(18, '2018-04-07', 'test', '08637392432', 'test', 8000, 20000, 1, 1),
(19, '2018-04-07', 'admin (offline)', '-', 'Pembelian di toko', 0, 7600, 1, 3),
(20, '2018-04-08', 'admin (offline)', '-', 'Pembelian di toko', 0, 7600, 1, 3),
(21, '2018-04-08', 'Superadmin (offline)', '-', 'Pembelian di toko', 0, 12000, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_order_hdr` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `dari_bank` varchar(25) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `foto_struk` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_order_hdr`, `tgl_pembayaran`, `dari_bank`, `atas_nama`, `foto_struk`) VALUES
(2, 1, '2018-04-08', 'BCA', 'Rachma', 'images/struk/payment_1jpg');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `status_order`
--

CREATE TABLE IF NOT EXISTS `status_order` (
  `id_status` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_order`
--

INSERT INTO `status_order` (`id_status`, `status`) VALUES
(1, 'New Order'),
(2, 'Paid'),
(3, 'Order Offline'),
(4, 'Shipped');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `bijih_kopi`
--
ALTER TABLE `bijih_kopi`
  ADD PRIMARY KEY (`id_kopi`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_dtl`);

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`id_order_hdr`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `status_order`
--
ALTER TABLE `status_order`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `bijih_kopi`
--
ALTER TABLE `bijih_kopi`
  MODIFY `id_kopi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_dtl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `id_order_hdr` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status_order`
--
ALTER TABLE `status_order`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
