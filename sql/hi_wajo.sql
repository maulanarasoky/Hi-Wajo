-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2019 at 01:49 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hi_wajo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(7) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `username`, `password`, `status`, `foto`) VALUES
(1, 'Admin', 'example@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Online', './assets/foto/nature.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_finance`
--

CREATE TABLE `bank_finance` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_finance`
--

INSERT INTO `bank_finance` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(8, 'UNQAB', 'assets/foto/bank1.PNG', 'Pt. Bank Mandiri (persero) Tbk ', 'Jl. Bau Mahmud No.1, Teddaopu, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '0485324333', 'Jam: \r\nKamis	08:00 ?? 15:00\r\nJumat	08:00 ?? 15:00\r\nSabtu	Closed\r\nAhad	Closed\r\nSenin	08:00 ?? 15:00\r\nSelasa	08:00 ?? 15:00\r\nRabu	08:00 ?? 15:00'),
(9, 'VCBIX', 'assets/foto/bank2.PNG', 'Bank Bri Syariah', 'Jl. Jend Sudirman, Lapongkoda, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '14015', 'Jam: \r\nKamis	08:00 – 15:00\r\nJumat	08:00 – 15:00\r\nSabtu	Closed\r\nAhad	Closed\r\nSenin	08:00 – 15:00\r\nSelasa	08:00 – 15:00\r\nRabu	08:00 – 15:00');

-- --------------------------------------------------------

--
-- Table structure for table `cafe`
--

CREATE TABLE `cafe` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cafe`
--

INSERT INTO `cafe` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(2, 'IAMJJ', 'assets/foto/kopi1.PNG', 'Doctor Vape & Coffee Shop', 'Jl. Kejaksaan, Siengkang, Tempe, Kabupaten Wajo, Sulawesi Selatan 90911', '08114231151', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Open 24 Hours\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hours'),
(3, 'HFITJ', 'assets/foto/kopi4.PNG', 'Kedai Kopi Sarjana', 'Kedai Kopi Sarjana, Attakkae, Tempe, Kabupaten Wajo, Sulawesi Selatan 90911', '085256859603', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Open 24 Hours\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hours'),
(4, 'ONIMW', 'assets/foto/kopi3.PNG', 'Kedai Kopi Alena', 'Jl. Bau Baharuddin No.30, Tempe, Kabupaten Wajo, Sulawesi Selatan 90911', '081241941594', '-'),
(5, 'UGQQI', 'assets/foto/kopi6.PNG', 'Kedai Kopi Rumah Tua', 'Jl. A.p. Pettarani No. 17, Sengkang, Maddukelleng, Tempe, Kabupaten Wajo, Sulawesi Selatan 90914', '081998638150', 'Jam: \r\nKamis	10:00 ?? 23:00\r\nJumat	10:00 ?? 23:00\r\nSabtu	10:00 ?? 23:00\r\nAhad	10:00 ?? 23:00\r\nSenin	10:00 ?? 23:00\r\nSelasa	10:00 ?? 23:00\r\nRabu	10:00 ?? 23:00'),
(6, 'HOAAV', 'assets/foto/kopi5.PNG', 'Jenggo Coffee 2.0', 'Bulu Pabbulu, Tempe, Kabupat??n Wajo, Sulawesi Kidul 90911', '082338894444', 'Jam: \r\nKamis	11:00 ?? 23:00\r\nJumat	11:00 ?? 23:00\r\nSabtu	11:00 ?? 23:00\r\nAhad	11:00 ?? 23:00\r\nSenin	11:00 ?? 23:00\r\nSelasa	11:00 ?? 23:00\r\nRabu	11:00 ?? 23:00'),
(7, 'VRXAF', 'assets/foto/kopi2.PNG', 'Dominan Kopi', 'Badan Pelayanan Perizinan Terpadu Dan Penanaman Modal Kab. Wajo, Jl. Jend. Ahmad Yani, Siengkang, Tempe, Kabupaten Wajo, Sulawesi Selatan 90914', '085244234985', 'Jam: \r\nKamis	05:00 ?? 23:00\r\nJumat	05:00 ?? 23:00\r\nSabtu	05:00 ?? 23:00\r\nAhad	05:00 ?? 23:00\r\nSenin	05:00 ?? 23:00\r\nSelasa	05:00 ?? 23:00\r\nRabu	05:00 ?? 23:00');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `image` varchar(30) NOT NULL,
  `title` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(40) NOT NULL,
  `category` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `finished_image` varchar(30) NOT NULL,
  `finished_description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `confirm_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `image`, `title`, `date`, `location`, `category`, `description`, `status`, `finished_image`, `finished_description`, `id_user`, `confirm_status`) VALUES
(1, 'assets/foto/nature.jpg', 'test', '2019-08-05 14:09:10', 'loca', 'Banjir', 'desc', 'Finish', 'assets/foto/ic_launcher_nature', 'Coba ah', 1, 'Dikonfirmasi'),
(2, 'assets/foto/nature.jpg', 'Baru', '2019-08-06 03:36:01', 'location baru', 'Banjir', 'Banjir boi', 'Finish', 'assets/foto/waterfall.png', 'dkjshf', 1, 'Dikonfirmasi'),
(3, 'assets/foto/nature.jpg', 'wew', '2019-08-08 11:08:46', 'baru', 'Banjir', 'ini wew', 'Finish', 'assets/foto/Indonesia.png', 'Sudah selesai ya', 1, 'Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `culinary`
--

CREATE TABLE `culinary` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `culinary`
--

INSERT INTO `culinary` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(3, 'TACAR', 'assets/foto/Chrysanthemum.jpg', 'Roti Maryam', 'Jl. Sukabirus, Deket Tikungan', '1234567890', 'Bayarnya Harus Pakai Uang Pas.'),
(4, 'CNYWA', 'assets/foto/Jellyfish.jpg', 'Bakso Bakar', 'Pga, Sukabirus', '88888', 'Satu Tusuk Rp.2000, Bisa Deliv Minimal 10 Tusuk, Tq.'),
(5, 'ISYEO', 'assets/foto/40.jpg', 'Rm Megaria Sedap', 'Jl. Sukabirus, Seberang Indomaret Enak Banget', '839475983579', 'Warning : Mahal. \r\nNikmat'),
(6, 'JQQAE', 'assets/foto/Desert.jpg', 'Pecel Lele Bunderan', 'Bunderan Telkom', '9876543', 'Kalo Malem Rame Banget.'),
(7, 'OKSAA', 'assets/foto/Hydrangeas.jpg', 'Ayam Bersih', 'Jl. Sukabirus, Seberang Tunggal', '5465645564', 'Buka Jam 11.00-22.00, Bisa Juga Order Dari Go-food.'),
(8, 'DLGTC', 'assets/foto/Penguins.jpg', 'Ayam Baek', 'Jl. Sukabirus, Sebelah Klontong', '876554645', 'Enak Banget'),
(9, 'JAYPN', 'assets/foto/Desert.jpg', 'Martabak Jayaraga', 'Seberang Yogya Bojongsoang', '432432', 'Paling Enak'),
(10, 'FDYYJ', 'assets/foto/telu.png', 'Test', 'Test', '1', 'Tdw'),
(11, 'KELII', 'assets/foto/d3if.png', 'Coba', 'Coba', '123', 'Coba'),
(12, 'AXNVK', 'assets/foto/movie_logo.jpg', 'Test', 'Test', '123', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'UWLQZ', 'assets/foto/pendidikan1.jpg', 'Sman 1 Pammana', 'Jl. Poros Sengkang-bone No 229, Pammana, Pammana, Wajo, Sulawesi Selatan, Indonesia', '1234', 'Sman 1 Pammana Adalah Sekolah Menengah Atas Negeri Ke – 9 Di Kabupaten Wajo. Didirikan Berdasarkan Surat Keputusan Bupati Wajo Nomor 09/kpts/2004 Tanggal 4 Pebruari 2004.sman 1 Pammana Komitmen Dalam Mengembangkan Sumber Daya Manusia (sdm). Hal Tergambar Dalam Visinya Yakni ”membentuk Manusia Berkarakter Yang Cerdas, Berwawasan Lingkungan, Berbasis Aqidah Dan Budaya”. Visi Ini Dianggap Tepat Karena Kesinambungan Pembangunan Nasional Hanya Bisa Eksis Kalau Tersedia Sumber Daya Manusia Yang Andal, Yaitu Manusia Yang Cerdas Secara Intelektual, Cerdas Emosional Dan Cerdas Spiritual.'),
(2, 'AVERF', 'assets/foto/pendidikan2.jpg', 'Smp Negeri 2 Sengkang', 'Jl. Bau Baharuddin, Tempe, Kabupaten Wajo, Sulawesi Selatan 90911, Indonesia.', '48521836', 'Smp Negeri Favorit Se-wajo. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang.\r\n\r\nSmp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang. Smp Negeri 2 Sengkang.'),
(3, 'SKTXI', 'assets/foto/pendidikan5.jpg', 'Universitas Puangrimaggalatung Sengkang', 'Jl. Puangrimaggalatung No. 27 Kelurahan Maddukkelleng, Kecamatan Tempe, Kabupaten Wajo, Sulawesi Selatan, Indonesia.', '4853210838', 'Universitas Puangrimaggalatung Yang Selanjutnya Disebut Uniprima, Adalah Hasil Penyatuan Pts-pts Lingkup Ypp Puangrimaggalatung Di Sengkang, Kabupaten Wajo Dan Watampone, Kabupaten Bone Yang Disetujui Penyatuannya Oleh Kemenristekdikti Pada Tanggal 31 Desember 2018 Dengan Nomor Sk: 1329/kpt/i/2018.'),
(5, 'PNDAA', 'assets/foto/pendidikan3.jpg', 'Madrasah Aliyah adiyah Putri Sengkang', 'Jl. Veteran No.46, Siengkang, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912, Indonesia', '485 323250 ', 'SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.'),
(6, 'PNDIA', 'assets/foto/pendidikan4.jpg', 'Madrasah Ibtidaiyah Adiyah (MIA)', 'Jl. K.H.M Yunus Martan, Lepangeng, Belawa, Kabupaten Wajo, Sulawesi Selatan 90953, Indonesia', '081355229944 ', 'SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.SMP negeri favorit se-Wajo.');

-- --------------------------------------------------------

--
-- Table structure for table `entertainment`
--

CREATE TABLE `entertainment` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entertainment`
--

INSERT INTO `entertainment` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'BKUWQ', 'assets/foto/nature.jpg', 'Jkdfhds', 'Kjhdsfkj', '398274', 'Jkshdfkjd');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `poster` varchar(40) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `ticket` varchar(30) NOT NULL,
  `organizer` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `poster`, `title`, `date`, `location`, `ticket`, `organizer`, `description`, `status`, `id_user`) VALUES
(7, 'assets/foto/waterfall.png', 'Ksjhdksjf', '2019-08-24', 'Jkdsfh', 'Jkdhsk', 'Jhfdksjh', 'Jhdskjfh', 'Konfirmasi', 0),
(8, 'assets/foto/nature.jpg', 'jksdhf', '2019-08-29', 'dsjkfh', 'jkhdskj', 'jkhdskj', 'jjhdksjfhks', 'Konfirmasi', 1),
(9, 'assets/foto/waterfall.png', 'Jkxh', '2019-08-22', 'Jdkhfdk', '50000', 'Dsfdhsj', 'Sdjfkhdsk', 'Konfirmasi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `government`
--

CREATE TABLE `government` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `government`
--

INSERT INTO `government` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'IXTVF', 'assets/foto/one_piece.png', 'Jskhf', 'Kjshf', '873264', 'Jskhfk'),
(2, 'PMNKW', 'assets/foto/pemerintahan1.jpg', 'Kantor Kecamatan Wajo', 'Jl. Sarappo No.54, Melayu Baru, Wajo, Kota Makassar, Sulawesi Selatan 90174, Indonesia ', '411 3616649', 'Melalui kantor kecamatan ini, warga dapat mengurus berbagai bentuk perizinan. Beberapa perizinan yang sering dibuat terkait dengan penerbitan izin usaha mikro kecil (IUMK), rekomendasi surat pengantar SKCK, surar keterangan domisili, surat izin menutup jalan untuk pembangunan atau acara, pengesahaan surat keterangan miskin, dispensasi nikah, rekomendasi dan pengesahaan permohonan cerai, belum nikah, dan nikah. Surat-surat lainnya yang dapat diurus terkait perizinan tertentu seperti surat eksplorasi air tanah, penggalian mata air, surat perubahan penggunaan tanah, waris, hingga wakaf. Ada banyak fungsi dan tugas lain dari kantor kecamatan, segera kunjungi kantor kecamatan terdekat ini untuk informasi layanan-layanan lainnya.'),
(3, 'PMNKB', 'assets/foto/pemerintahan2.jpg', 'Kantor Bupati Wajo', 'Jl. Rusa No17, Siengkang, Tempe, Wajo, Sulawesi Selatan, Indonesia', '485 21001', 'Tempat bupati bekerja bersama pejabat-pejabat Kabupaten Wajo lainnya. info lebihlengkap kunjungi laman resmin milik Kabupaten Wajo.'),
(4, 'PMNDL', 'assets/foto/pemerintahan3.jpg', 'Kantor Desa Lamata', 'Jl. Poros Palopo - Makassar, Lamata, Gilireng, Kabupaten Wajo, Sulawesi Selatan 90954', '123666666', 'Beroperasional hari senin sampai jumat mulai pukul 08.00 - 13.00.'),
(5, 'PMNKM', 'assets/foto/pemerintahan4.jpg', 'Kantor Kecamatan Majauleng', 'Jl. Poros Sengkang - Atapange, Limpomajang, Majauleng, Kabupaten Wajo, Sulawesi Selatan 90991', '08674639937', 'instansi pemerintah daerah. instansi pemerintah daerah. instansi pemerintah daerah. instansi pemerintah daerah. instansi pemerintah daerah.'),
(6, 'PMNPA', 'assets/foto/pemerintahan5.jpg', 'Kantor Kecamatan Pammana', 'Pammana, Kabupaten Wajo, Sulawesi Selatan 90971', '13243646473', 'Kantor Pemerintahan Distrik Sulawesi Selatan. Kantor Pemerintahan Distrik Sulawesi Selatan. Kantor Pemerintahan Distrik Sulawesi Selatan. Kantor Pemerintahan Distrik Sulawesi Selatan.');

-- --------------------------------------------------------

--
-- Table structure for table `health`
--

CREATE TABLE `health` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health`
--

INSERT INTO `health` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(2, 'EKFBI', 'assets/foto/kesehatan2.PNG', 'Apotek Cipta Farma', 'Jl. Wolter Monginsidi, Maddukelleng, Tempe, Kabupaten Wajo, Sulawesi Selatan 90918', '14054', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Open 24 Hours\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hours'),
(3, 'TMCGG', 'assets/foto/kesehatan3.PNG', 'Apotek Indah Lestari', 'Jl. Pampanua - Sengkang, Kampiri, Pammana, Kabupaten Wajo, Sulawesi Selatan 90971', '085299611999', 'Jam: \r\nKamis	07:00 ?? 23:30\r\nJumat	07:00 ?? 23:30\r\nSabtu	07:00 ?? 23:30\r\nAhad	07:00 ?? 23:30\r\nSenin	07:00 ?? 23:30\r\nSelasa	07:00 ?? 23:30\r\nRabu	07:00 ?? 23:30'),
(4, 'ZWPPZ', 'assets/foto/kesehatan7.PNG', 'Rs Prima Husada', 'Paddupa, Tempe, Kabupat??n Wajo, Sulawesi Kidul 90914', '345678', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Open 24 Hours\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hoursa'),
(5, 'BGJFH', 'assets/foto/kesehatan4.PNG', 'Klinik Diamond Skin Care', 'Jl. Andi Parenrengi, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '081342680259', 'Jam: \r\nKamis	09:00 – 21:00\r\nJumat	09:00 – 21:00\r\nSabtu	09:00 – 21:00\r\nAhad	09:00 – 21:00\r\nSenin	09:00 – 21:00\r\nSelasa	09:00 – 21:00\r\nRabu	09:00 – 21:00'),
(6, 'EOJFW', 'assets/foto/kesehatan5.PNG', 'Puskesmas Tempe', 'Watallipue, Tempe, Kabupatèn Wajo, Sulawesi Kidul 90911', '243546', 'Jam: \r\nKamis	07:00 – 14:00\r\nJumat	07:00 – 11:00\r\nSabtu	07:00 – 13:00\r\nAhad	Closed\r\nSenin	07:00 – 14:00\r\nSelasa	07:00 – 14:00\r\nRabu	07:00 – 14:00'),
(7, 'NAWWP', 'assets/foto/kesehatan6.PNG', 'Klinik Ummi', 'Jl. Bau Mahmud, Teddaopu, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '048521437', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Closed\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hours');

-- --------------------------------------------------------

--
-- Table structure for table `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `housing`
--

INSERT INTO `housing` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'IWELX', 'assets/foto/waterfall.png', 'Djkfh', 'Jsdkhf', '3928749283', 'Jkdshfjsd'),
(2, 'TPWDO', 'assets/foto/penginapan3.jpg', 'Hotel Ayu Sengkang', 'Jalan Andi Paggaru No 18, Sengkang, Teddaopu, Tempe, Kabupaten Wajo, Sulawesi Selatan 90913', '048522634', 'Hotel Setara Bintang 3. Dilengkapi Dengan Fasilitas Ac, Restaurant, Layanan 24 Jam, Wifi, Dan Lahan Parkir Di Area Hotel. Hotel Setara Bintang 3. Dilengkapi Dengan Fasilitas Ac, Restaurant, Layanan 24 Jam, Wifi, Dan Lahan Parkir Di Area Hotel.\r\n\r\nHotel Setara Bintang 3. Dilengkapi Dengan Fasilitas Ac, Restaurant, Layanan 24 Jam, Wifi, Dan Lahan Parkir Di Area Hotel.'),
(3, 'TWTE', 'assets/foto/penginapan1.jpg', 'Sederhana Saja.', 'Tana Sitolo', '083456789001', 'Kamar yang sederhana, menyerupai kampus anak muda. Kawasan pengrajin kain sutra.'),
(4, 'CZCTG', 'assets/foto/penginapan2.jpg', 'Cozy Cottage', 'Tempe', '088822341987', 'Kamar pribadi di town house. Kapasitas 10 orang, studio, 2 kamar tidur, 1 kamar tidur'),
(5, 'YMKSN', 'assets/foto/penginapan5.jpg', 'Hotel Yasmin Makassar', 'Jl. Jampea No. 5 Makassar, Wajo, Makassar, Sulawesi Selatan, Indonesia, 90174', '04113628329', 'Hotel Bintang 3 terbaik di makkasar. parkiran tidak cukup luas untuk kendaraan roda empat. Fasilitas kamar mewah, restauran, ball room.'),
(6, 'KWHYT', 'assets/foto/penginapan6.jpg', 'B&B IZZI', 'Pitte Riase', '087866574839', 'Jika Anda mencari akomodasi otentik di daerah non-turis dan pedesaan maka Anda harus mengunjungi saya di B&B Rumah IZZI. Pada tahun 2017, saya membuka B&B tradisionil di desa saya, kabupaten(Sidrap) Sidereng Rappang, sekitar 210 km sebelah utara Makassar. Coba lihat sebelum Anda berkendara ke Tanah Toraja dan jelajahi alam unik yang indah di sini selama beberapa hari. Saya pribadi akan meng-host dan membantu berkeliling sekiranya di butuhkan.');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'RZCFN', 'assets/foto/game_of_throne.jpg', 'Fksjdh', 'Jkdhfsk', '89374', 'Kjdhskf');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(20) NOT NULL,
  `category` varchar(15) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `url`, `title`, `author`, `date`, `location`, `category`, `content`) VALUES
(1, 'assets/foto/nature.jpg', 'Nature', 'Natural', '2019-07-10 06:57:24', 'World', 'Nature', 'Nature is so beautiful'),
(2, 'assets/foto/foto.jpg', 'Avengers', 'Marvel', '2019-07-10 07:50:48', 'USA', 'Action', 'Avengers: The Infinity Wars'),
(3, 'assets/foto/waterfall.png', 'Sdagh', 'Jshgd', '2019-07-12 08:27:28', 'Jhgsd', 'Health', 'Sjdgs'),
(4, 'assets/foto/waterfall.png', 'Dsjkfh', 'Dskjhf', '2019-07-12 08:32:19', 'Ksdjhf', 'Health', 'Skdjfh'),
(5, 'assets/foto/waterfall.png', 'Dkjfh', 'Dkjshf', '2019-07-12 08:35:23', 'Jkdfh', 'Health', 'Dkjfhksdj'),
(6, 'assets/foto/waterfall.png', 'Djkhf', 'Dsjkhf', '2019-07-12 08:37:31', 'Kjdshf', 'Health', 'Sdkjfh'),
(7, 'assets/foto/waterfall.png', 'A', 'A', '2019-07-12 08:39:52', 'A', 'Health', 'A'),
(8, 'assets/foto/Indonesia.png', 'Indonesia Raya', 'Indonesia', '2019-07-15 04:05:14', 'Indonesia', 'Health', 'This Is My Country !'),
(9, 'assets/foto/Koala.jpg', 'Testing', 'Cahya', '2019-07-16 06:50:16', 'Hq', 'Tech', 'Haiiii'),
(10, 'assets/foto/1.jpg', 'Jerawat Di Punggung, Kenali Penyebab Dan Cara Mengatasinya  Baca Selengkapnya Di Artikel \"jerawat Di Punggung, Kenali Penyebab Dan Cara Mengatasinya', 'Yonada Nancy - Tirto-id', '2019-07-16 07:48:44', 'Indonesia', 'Health', 'Jerawat Merupakan Salah Satu Permasalahan Kulit Yang Paling Mengganggu Yang Biasanya Dialami Saat Fase Pubertas. Kebanyakan Orang Mengalami Kondisi Terparah Pada Akhir 20-an. Namun, Bukan Berarti Usia 30-an Juga Terbebas Dari Masalah Kulit Ini. Tingkat Keparahannya Dapat Bervariasi, Bisa Hanya Beberapa Titik Hingga Menjadi Kelompok-kelompok Yang Lebih Besar Di Area Tertentu. Jerawat Bisa Muncul Di Banyak Bagian Tubuh, Terutama Di Wajah Dan Punggung. Seperti Jerawat Di Wajah, Jerawat Di Daerah Punggung Juga Dapat Meninggalkan Bekas Berupa Titik-titik Kehitaman. Hal Ini Tentunya Mengganggu Penampilan Sehari-hari.\r\n\r\nGen Masalah Jerawat Bisa Diturunkan Secara Genetik. Jika Dalam Satu Keluarga Terdapat Orang Yang Memiliki Jerawat, Maka Yang Lain Juga Akan Mengalami Jerawat. Efek Samping Pengobatan Jerawat Dapat Berkembang Sebagai Efek Samping Dari Obat-obatan Tertentu Seperti Antidepresan. Hormon Perubahan Hormon Yang Dialami Oleh Remaja Selama Beberapa Tahun Dapat Menimbulkan Jerawat. Tetapi, Pada Wanita Setelah Pubertas, Jerawat Juga Dapat Berkaitan Dengan Perubahan Hormon Selama Menstruasi Atau Kehamilan. Keringat Keringat, Khususnya Yang Terkumpul Di Bawah Pakaian Yang Ketat Akan Membuat Jerawat Semakin Parah Stres Stres Tidak Berdampak Langsung Terhadap Munculnya Jerawat, Tetapi Menjadi Salah Satu Faktor Pemicu. Nutrisi Berdasarkan Penelitian Dari American Academy Of Dermatology, Membuktikan Bahwa Asupan Karbohidrat Tertentu (seperti Roti Dan Kentang Goreng) Dapat Meningkatkan Kadar Gula Dalam Darah Yang Juga Ikut Berkontribusi Dalam Pertumbuhan Jerawat. Pengobatan Untuk Jerawat Tentunya Ada Beberapa Cara. Baberapa Peneliti Menyarankan Penggunaan Krim Yang Mengandung Benzoul Peroxide Atau Dalicylic Acid. Perawatan Dengan Krim Akan Membutuhkan Waktu Beberapa Minggu. Sementara Ada Juga Pengobatan Menggunakan Pil Yang Ditunjukkan Untuk Membunuh Bakteri Dan Juga Menghambat Inflamasi (pembengkakan). Selain Itu, Saat Ini Juga Marak Penggunaan Laser Atau Light Therapies Yang Ditawarkan Oleh Klinik-klinik Kecantikan Untuk Mengatasi Masalh Kulit Salah Satunya Jerawat. Dikutip Dari Medical News Today, Ada Beberapa Langkah Yang Dapat Dilakukan Untuk Mengatasi Timbulnya Jerawat Di Punggung, Yaitu: - Mandi Setelah Melakukan Aktivitas Berkeringat. - Menggunakan Pembersih Yang Non-abrasif. - Menghindari Produk Kosmetik Yang Menyebabkan Iritasi Kulit. - Tidak Menggosok Area Yang Terdapat Jerawat. - Tidak Memencet Ataupun Memecahkan Jerawat Karena Hanya Akan Membuat Jerawat Menyebar Ke Bagian Kulit Yang Lain. - Jauhi Paparan Sinar Matahari Secara Langsung, Karena Akan Memperparah Kondisi Jerawat. Baca Juga Artikel Terkait Jerawat Atau Tulisan Menarik Lainnya Yonada Nancy'),
(12, 'assets/foto/sherlock.jpg', 'Jkdshf', 'Kjdfhs', '2019-07-23 07:42:07', 'Jdf', '4', 'Dsjkfhs');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'WZTBN', 'assets/foto/telu.png', 'Dsfjk', 'Jkashd', '324', 'Sjdhf');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(2, 'QJIMU', 'assets/foto/olahraga5.PNG', 'Sport Centre H. Andi Passaung', 'Lempong, Bola, Wajo, Kabupatèn Wajo, Sulawesi Kidul 90984', '14047', 'Jam: \r\nKamis	Open 24 Hours\r\nJumat	Open 24 Hours\r\nSabtu	Open 24 Hours\r\nAhad	Open 24 Hours\r\nSenin	Open 24 Hours\r\nSelasa	Open 24 Hours\r\nRabu	Open 24 Hours'),
(3, 'JSHFW', 'assets/foto/olahraga2.PNG', 'Lapangan Trikora Salojampu', 'Tolotenreng, Sabbang Paru, Wajo, Kabupatèn Wajo, Sulawesi Kidul 90961', '1234563456789', 'Lapangan Bola');

-- --------------------------------------------------------

--
-- Table structure for table `tourism`
--

CREATE TABLE `tourism` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourism`
--

INSERT INTO `tourism` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(3, 'IXNAC', 'assets/foto/pariwisata6.jpg', 'Danau Tempe', 'Sengkang, Kabupaten Wajo', '14045', 'Danau Tempe Merupakan Salah Satu Objek Wisata Unggulan Di Kabupaten Wajo, Yang Di Dalamnya Terdapat Rumah Yang Mengapung Di Atas Danau.\r\n\r\nPerjalanan Menuju Lokasi Ini Sekitar 30 Menit Dari Kota Sengkang, Dengan Menggunakan Perahu Tradisional ??katinting.’ Danau Ini Dikenal Sebagai Salah Satu Destinasi Wisata Di Asia Tenggara Dengan Branding ??equador Asia.’ Setiap Tahun Ada Festival Danau Tempe, Yang Dikemas Dalam Pesta Adat ??maccera Tappareng.’ '),
(4, 'AIVPK', 'assets/foto/pariwisata5.jpg', 'Saoraja Mallangga', 'Jl. Poros Anabanua - Sengkang No.55, Lapongkoda, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '14046', 'Situs Sejarah Ini Terletak Di Pusat Kota Sengkang Kecamatan Tempe Kabupaten Wajo. Rumah Ini Dibangun Pada Tahun 1933 Pada Masa Pemerintahan Agung Betteng Pola Ke-27.\r\n\r\nDi Dalam Saoraja Mallangga Terdapat Beberapa Benda Pusaka Yaitu Latea Kasih, Laula Balu, Cobok’e, Dan Balubu.'),
(5, 'RZWBU', 'assets/foto/pariwisata1.PNG', 'Bola Seratu', 'Attakkae, Tempe, Kabupatèn Wajo, Sulawesi Kidul 90918', '7898789', 'Rumah Adat Kabupaten Wajo');

-- --------------------------------------------------------

--
-- Table structure for table `travel_transportation`
--

CREATE TABLE `travel_transportation` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_transportation`
--

INSERT INTO `travel_transportation` (`id`, `code`, `image`, `name`, `address`, `phone_number`, `description`) VALUES
(1, 'BOGTN', 'assets/foto/travel5.PNG', 'Pt. Jujur Jaya Sakti (daihatsu Sengkang)', 'Mattirotappareng, Tempe, Kabupat??n Wajo, Sulawesi Kidul 90911', '14048', 'Dealer Mobil \r\n\r\nJam: \r\nKamis	08:00 ?? 17:00\r\nJumat	08:00 ?? 17:00\r\nSabtu	08:00 ?? 17:00\r\nAhad	Closed\r\nSenin	08:00 ?? 17:00\r\nSelasa	08:00 ?? 17:00\r\nRabu	08:00 ?? 17:00'),
(2, 'AQUMB', 'assets/foto/travel3.PNG', 'Pt. An-nur Maarif ', 'Jl. Jend Sudirman No.50, Lapongkoda, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '085299281271', 'Biro Perjalanan Wisata'),
(3, 'BKVNP', 'assets/foto/travel2.PNG', 'Amji Travel', 'Jl. Andi Paggaru, Teddaopu, Tempe, Kabupaten Wajo, Sulawesi Selatan 90912', '089670903663', 'Agen Tiket');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `image` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `image`, `name`, `email`, `username`, `password`, `phone_number`, `status`) VALUES
(1, 'nature.jpg', 'Anonymous', 'example@example.com', 'user123', 'e10adc3949ba59abbe56e057f20f883e', '1234567890', 'Offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_finance`
--
ALTER TABLE `bank_finance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `cafe`
--
ALTER TABLE `cafe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `culinary`
--
ALTER TABLE `culinary`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `entertainment`
--
ALTER TABLE `entertainment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government`
--
ALTER TABLE `government`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `health`
--
ALTER TABLE `health`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `tourism`
--
ALTER TABLE `tourism`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `travel_transportation`
--
ALTER TABLE `travel_transportation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_restaurant` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_finance`
--
ALTER TABLE `bank_finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cafe`
--
ALTER TABLE `cafe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `culinary`
--
ALTER TABLE `culinary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `entertainment`
--
ALTER TABLE `entertainment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `government`
--
ALTER TABLE `government`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `health`
--
ALTER TABLE `health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `travel_transportation`
--
ALTER TABLE `travel_transportation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
