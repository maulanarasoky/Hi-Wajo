-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 09:48 AM
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
(3, 'TACAR', 'Chrysanthemum.jpg', 'Roti Maryam', 'Jl. Sukabirus, Deket Tikungan', '1234567890', 'Bayarnya Harus Pakai Uang Pas.'),
(4, 'CNYWA', 'Jellyfish.jpg', 'Bakso Bakar', 'Pga, Sukabirus', '88888', 'Satu Tusuk Rp.2000, Bisa Deliv Minimal 10 Tusuk, Tq.'),
(5, 'ISYEO', 'Tulips.jpg', 'Rm Megaria', 'Jl. Sukabirus, Seberang Indomaret Banget', '124343243', 'Warning : Mahal. '),
(6, 'JQQAE', 'Desert.jpg', 'Pecel Lele Bunderan', 'Bunderan Telkom', '9876543', 'Kalo Malem Rame Banget.'),
(7, 'OKSAA', 'Hydrangeas.jpg', 'Ayam Bersih', 'Jl. Sukabirus, Seberang Tunggal', '5465645564', 'Buka Jam 11.00-22.00, Bisa Juga Order Dari Go-food.'),
(8, 'DLGTC', 'Penguins.jpg', 'Ayam Baek', 'Jl. Sukabirus, Sebelah Klontong', '876554645', 'Enak Banget'),
(9, 'JAYPN', 'Desert.jpg', 'Martabak Jayaraga', 'Seberang Yogya Bojongsoang', '432432', 'Paling Enak');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(20) NOT NULL,
  `category` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `title`, `author`, `date`, `location`, `category`, `description`) VALUES
(1, 'nature.jpg', 'Nature', 'Natural', '2019-07-10 06:57:24', 'World', 'Nature', 'Nature is so beautiful'),
(2, 'foto.jpg', 'Avengers', 'Marvel', '2019-07-10 07:50:48', 'USA', 'Action', 'Avengers: The Infinity Wars'),
(3, 'waterfall.png', 'Sdagh', 'Jshgd', '2019-07-12 08:27:28', 'Jhgsd', 'Health', 'Sjdgs'),
(4, 'waterfall.png', 'Dsjkfh', 'Dskjhf', '2019-07-12 08:32:19', 'Ksdjhf', 'Health', 'Skdjfh'),
(5, 'waterfall.png', 'Dkjfh', 'Dkjshf', '2019-07-12 08:35:23', 'Jkdfh', 'Health', 'Dkjfhksdj'),
(6, 'waterfall.png', 'Djkhf', 'Dsjkhf', '2019-07-12 08:37:31', 'Kjdshf', 'Health', 'Sdkjfh'),
(7, 'waterfall.png', 'A', 'A', '2019-07-12 08:39:52', 'A', 'Health', 'A'),
(8, 'Indonesia.png', 'Indonesia Raya', 'Indonesia', '2019-07-15 04:05:14', 'Indonesia', 'Health', 'This Is My Country !'),
(9, 'Koala.jpg', 'Testing', 'Cahya', '2019-07-16 06:50:16', 'Hq', 'Tech', 'Haiiii'),
(10, '1.jpg', 'Jerawat Di Punggung, Kenali Penyebab Dan Cara Mengatasinya  Baca Selengkapnya Di Artikel \"jerawat Di Punggung, Kenali Penyebab Dan Cara Mengatasinya', 'Yonada Nancy - Tirto-id', '2019-07-16 07:48:44', 'Indonesia', 'Health', 'Jerawat Merupakan Salah Satu Permasalahan Kulit Yang Paling Mengganggu Yang Biasanya Dialami Saat Fase Pubertas. Kebanyakan Orang Mengalami Kondisi Terparah Pada Akhir 20-an. Namun, Bukan Berarti Usia 30-an Juga Terbebas Dari Masalah Kulit Ini. Tingkat Keparahannya Dapat Bervariasi, Bisa Hanya Beberapa Titik Hingga Menjadi Kelompok-kelompok Yang Lebih Besar Di Area Tertentu. Jerawat Bisa Muncul Di Banyak Bagian Tubuh, Terutama Di Wajah Dan Punggung. Seperti Jerawat Di Wajah, Jerawat Di Daerah Punggung Juga Dapat Meninggalkan Bekas Berupa Titik-titik Kehitaman. Hal Ini Tentunya Mengganggu Penampilan Sehari-hari.\r\n\r\nGen Masalah Jerawat Bisa Diturunkan Secara Genetik. Jika Dalam Satu Keluarga Terdapat Orang Yang Memiliki Jerawat, Maka Yang Lain Juga Akan Mengalami Jerawat. Efek Samping Pengobatan Jerawat Dapat Berkembang Sebagai Efek Samping Dari Obat-obatan Tertentu Seperti Antidepresan. Hormon Perubahan Hormon Yang Dialami Oleh Remaja Selama Beberapa Tahun Dapat Menimbulkan Jerawat. Tetapi, Pada Wanita Setelah Pubertas, Jerawat Juga Dapat Berkaitan Dengan Perubahan Hormon Selama Menstruasi Atau Kehamilan. Keringat Keringat, Khususnya Yang Terkumpul Di Bawah Pakaian Yang Ketat Akan Membuat Jerawat Semakin Parah Stres Stres Tidak Berdampak Langsung Terhadap Munculnya Jerawat, Tetapi Menjadi Salah Satu Faktor Pemicu. Nutrisi Berdasarkan Penelitian Dari American Academy Of Dermatology, Membuktikan Bahwa Asupan Karbohidrat Tertentu (seperti Roti Dan Kentang Goreng) Dapat Meningkatkan Kadar Gula Dalam Darah Yang Juga Ikut Berkontribusi Dalam Pertumbuhan Jerawat. Pengobatan Untuk Jerawat Tentunya Ada Beberapa Cara. Baberapa Peneliti Menyarankan Penggunaan Krim Yang Mengandung Benzoul Peroxide Atau Dalicylic Acid. Perawatan Dengan Krim Akan Membutuhkan Waktu Beberapa Minggu. Sementara Ada Juga Pengobatan Menggunakan Pil Yang Ditunjukkan Untuk Membunuh Bakteri Dan Juga Menghambat Inflamasi (pembengkakan). Selain Itu, Saat Ini Juga Marak Penggunaan Laser Atau Light Therapies Yang Ditawarkan Oleh Klinik-klinik Kecantikan Untuk Mengatasi Masalh Kulit Salah Satunya Jerawat. Dikutip Dari Medical News Today, Ada Beberapa Langkah Yang Dapat Dilakukan Untuk Mengatasi Timbulnya Jerawat Di Punggung, Yaitu: - Mandi Setelah Melakukan Aktivitas Berkeringat. - Menggunakan Pembersih Yang Non-abrasif. - Menghindari Produk Kosmetik Yang Menyebabkan Iritasi Kulit. - Tidak Menggosok Area Yang Terdapat Jerawat. - Tidak Memencet Ataupun Memecahkan Jerawat Karena Hanya Akan Membuat Jerawat Menyebar Ke Bagian Kulit Yang Lain. - Jauhi Paparan Sinar Matahari Secara Langsung, Karena Akan Memperparah Kondisi Jerawat. Baca Juga Artikel Terkait Jerawat Atau Tulisan Menarik Lainnya Yonada Nancy');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(7) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `status`, `foto`) VALUES
(1, 'Admin', 'example@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Online', './assets/foto/nature.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `culinary`
--
ALTER TABLE `culinary`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `culinary`
--
ALTER TABLE `culinary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
