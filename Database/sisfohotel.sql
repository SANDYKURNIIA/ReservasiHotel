-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2025 at 04:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfohotel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `loginAdmin` (IN `p_username` VARCHAR(50), IN `p_password` VARCHAR(250))   BEGIN
    SELECT * 
    FROM login
    WHERE username = p_username
      AND password = MD5(p_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUser` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    -- Memilih user yang username-nya sesuai dan password yang di-hash menggunakan SHA2
    SELECT * 
    FROM tamu
    WHERE username = p_username
      AND password = SHA2(p_password, 256);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_tamu`
--

CREATE TABLE `arsip_tamu` (
  `id` int NOT NULL,
  `idtamu` int DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `waktu_dihapus` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `arsip_tamu`
--

INSERT INTO `arsip_tamu` (`id`, `idtamu`, `username`, `email`, `nama`, `alamat`, `telepon`, `waktu_dihapus`) VALUES
(8, 26, 'nab', 'nabiha@gmail.com', 'nab', 'eer45t', '546', '2025-01-13 05:30:59'),
(9, 25, 'ss', 'ss@gmail.com', 'Sandy', 'sqs', '545345', '2025-01-13 05:31:18'),
(11, 21, 'yuli', 'sandybkng@gmail.com', 'user', 'sdsd', '545345', '2025-01-13 05:31:41'),
(13, 27, 'Sandy', 'sandy23trk@mahasiswa.pcr.ac.id', 'Sandy', 'JL PROF M YAMIN SH NO 53', '545345', '2025-01-13 05:35:58'),
(14, 18, 'sanss', 'keishaahfd@gmail.com', 'Sannn', 'JL PROF M YAMIN SH NO 53', '081363032647', '2025-01-13 05:37:18'),
(15, 24, 'dwi', 'dwi@gmail.com', 'dwi', 'balai pernikahan', '121', '2025-01-13 05:37:28'),
(16, 29, 'coba', 'sanmadan8@gmail.com', 'user', 'dadasas', '545345', '2025-01-15 06:41:10'),
(17, 30, 'snn', 'ss@gmail.com', 'dqwdqwd', 'dqwdqwd', 'dwqdqwd', '2025-01-15 06:43:16'),
(18, 28, 'sanss', 'sandy23trk@mahasiswa.pcr.ac.id', 'Sandy', 'bangkinang', '545345', '2025-01-18 08:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `deskripsi`, `gambar`) VALUES
(2, 'Fitnes', 'Kami Menawarkan fasilitas GYM yang dapat anda gunakan untuk memenuhi kebugaran anda.', 'fitnes.jpeg'),
(3, 'Restaurant', 'Kami menawarkan Fasilitas Restaurant yang tersedia setiap pagi dan siang untuk para tamu', 'Restaurant.jpeg'),
(4, 'Permainan Anak', 'Kami memiliki taman bermain untuk anak yang dapat anda nikmati.', 'Permainan Anak.jpeg'),
(14, 'Kolam Renang', 'Kami Menyediakan Fasilitas Kolam Renang', '../Gambar/KolamRenang.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `idkamar` int NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `ketersediaan` int NOT NULL,
  `harga` float NOT NULL,
  `gambar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`idkamar`, `tipe`, `ketersediaan`, `harga`, `gambar`) VALUES
(1, 'Superior', 0, 400000, 'superior.jpeg'),
(2, 'Deluxe', 6, 450000, 'deluxe.jpeg'),
(3, 'Junior Suite', 10, 700000, 'juniorsuite.jpeg'),
(4, 'Executive', 20, 1200000, 'Executive.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `idpesan` int NOT NULL,
  `tglpesan` datetime NOT NULL,
  `batasbayar` datetime NOT NULL,
  `idkamar` int NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `harga` float NOT NULL,
  `ketersediaan` int NOT NULL DEFAULT '1',
  `idtamu` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `tglmasuk` date NOT NULL,
  `tglkeluar` date NOT NULL,
  `lamahari` int NOT NULL,
  `totalbayar` float NOT NULL,
  `jamexpire` time DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Berhasil,Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`idpesan`, `tglpesan`, `batasbayar`, `idkamar`, `tipe`, `harga`, `ketersediaan`, `idtamu`, `nama`, `alamat`, `telepon`, `tglmasuk`, `tglkeluar`, `lamahari`, `totalbayar`, `jamexpire`, `order_id`, `status`) VALUES
(20, '2025-01-18 08:18:40', '2025-01-19 08:18:40', 2, 'Deluxe', 0.45, 1, 31, 'kelompok', 'rumbai', '545345', '2025-01-18', '2025-01-19', 1, 0.45, '13:18:40', NULL, 'Berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `idtamu` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`idtamu`, `username`, `email`, `nama`, `alamat`, `telepon`, `password`, `is_deleted`) VALUES
(31, 'kelompok10', 'kelompok@gmail.com', 'kelompok', 'rumbai', '545345', '$2y$10$1NLDzRBkqxpzc1s8h6b0Q.azd78jFBtWO9Qf5p5CRj2NTtbNjkYGG', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kamar`
-- (See below for the actual view)
--
CREATE TABLE `view_kamar` (
`gambar` varchar(50)
,`harga` float
,`idkamar` int
,`ketersediaan` int
,`tipe` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pemesanan_kamar`
-- (See below for the actual view)
--
CREATE TABLE `view_pemesanan_kamar` (
`alamat` text
,`batasbayar` datetime
,`gambar` varchar(50)
,`harga` float
,`idkamar` int
,`idpesan` int
,`ketersediaan` int
,`lamahari` int
,`nama` varchar(255)
,`status` varchar(20)
,`telepon` varchar(15)
,`tglkeluar` date
,`tglmasuk` date
,`tglpesan` datetime
,`tipe` varchar(50)
,`totalbayar` float
);

-- --------------------------------------------------------

--
-- Structure for view `view_kamar`
--
DROP TABLE IF EXISTS `view_kamar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kamar`  AS SELECT `kamar`.`idkamar` AS `idkamar`, `kamar`.`tipe` AS `tipe`, `kamar`.`ketersediaan` AS `ketersediaan`, `kamar`.`harga` AS `harga`, `kamar`.`gambar` AS `gambar` FROM `kamar``kamar`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_pemesanan_kamar`
--
DROP TABLE IF EXISTS `view_pemesanan_kamar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pemesanan_kamar`  AS SELECT `p`.`idpesan` AS `idpesan`, `p`.`tglpesan` AS `tglpesan`, `p`.`batasbayar` AS `batasbayar`, `p`.`idkamar` AS `idkamar`, `k`.`tipe` AS `tipe`, `k`.`harga` AS `harga`, `p`.`ketersediaan` AS `ketersediaan`, `p`.`nama` AS `nama`, `p`.`alamat` AS `alamat`, `p`.`telepon` AS `telepon`, `p`.`tglmasuk` AS `tglmasuk`, `p`.`tglkeluar` AS `tglkeluar`, `p`.`lamahari` AS `lamahari`, `p`.`totalbayar` AS `totalbayar`, `p`.`status` AS `status`, `k`.`gambar` AS `gambar` FROM (`pemesanan` `p` join `kamar` `k` on((`p`.`idkamar` = `k`.`idkamar`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_tamu`
--
ALTER TABLE `arsip_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`idkamar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`idpesan`),
  ADD KEY `idkamar` (`idkamar`),
  ADD KEY `pemesanan_ibfk_2` (`idtamu`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`idtamu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip_tamu`
--
ALTER TABLE `arsip_tamu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `idkamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `idpesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `idtamu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`idkamar`) REFERENCES `kamar` (`idkamar`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`idtamu`) REFERENCES `tamu` (`idtamu`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
