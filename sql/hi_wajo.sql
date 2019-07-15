-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 10:12 AM
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
(1, 'XXXXX', 'nature.jpg', 'sdfjh', 'skjdhf', '3463247', 'dskjfh');

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
(8, 'Indonesia.png', 'Indonesia Raya', 'Indonesia', '2019-07-15 04:05:14', 'Indonesia', 'Health', 'This Is My Country !');

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
(6, 'EPVCC', '', 'Klajidiuesrfi', 'Klajsisodufoiewrio', '34234', 'Klsdjfoiadsdlkajdloi'),
(7, 'IRYYS', '', 'kshdaskjdh', 'jkashdkasj', '8937498', ''),
(8, 'KLHTW', '', 'ieorjwerjoiw', 'sakjdoiwlk', '2893732984', ''),
(9, 'EIQMD', '', 'isudhasdjhiu', 'asduhsi', '9827492', ''),
(10, 'XSDKL', '', 'iojasddiojasoi', 'oiasjdoaisj', '928379', ''),
(11, 'AMYHQ', '', 'jkshadkjsahd', 'oiasdqioqw', '982743210', ''),
(12, 'WNZDB', '', 'oisfklsdjfoi', 'klnsdohfsdklo', '983248234', ''),
(14, 'VYKGT', '', 'uisdjkshfui', 'dkhaoqwknoih', '8934982374', ''),
(15, 'MCNUC', '', 'lvksldjvoshdf', 'dnmsandoacho', '38294729', ''),
(16, 'XVOMM', '', 'ds', 'sds', '222', ''),
(17, 'RGJUX', '', 'baru nih', 'klsfsl', '9748', 'kfjsdfkjh'),
(18, 'QLELH', '', 'Coba Tes Ya', 'Sdhfsdjkfh', '893749837', 'Kdshjfkhkjahkjha');

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
(1, 'admin', 'example@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Online', './assets/foto/nature.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
