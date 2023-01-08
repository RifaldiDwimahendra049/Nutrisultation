-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 04:18 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutrisultation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id`, `username`, `email`, `pesan`, `jawaban`) VALUES
(3, 'Nurul, S. Gz.', 'nurul0101@gmail.com', 'jhdkhakdha', 'jawa'),
(11, 'Faldi, S. T.', 'faldi123@gmail.com', 'hallo', 'hai');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `no_konsultasi` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `tinggi_badan` varchar(10) NOT NULL,
  `berat_badan` varchar(10) NOT NULL,
  `keluhan` text NOT NULL,
  `pola_makan` text NOT NULL,
  `nutrisionist` varchar(50) NOT NULL,
  `email_nutrisionist` varchar(50) NOT NULL,
  `diagnosa` text NOT NULL,
  `saran_diet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `no_konsultasi`, `username`, `email`, `jenis_kelamin`, `umur`, `tinggi_badan`, `berat_badan`, `keluhan`, `pola_makan`, `nutrisionist`, `email_nutrisionist`, `diagnosa`, `saran_diet`) VALUES
(17, 'konsultasi-010', 'Faldi, S. T.', 'faldi123@gmail.com', 'Laki-laki', '20', '160', '53', 'Maag, Sering sakit perut tiba-tiba', 'Makan dua kali sehari. \r\nsekali makan : Nasi,Tempe/Tahu, Sambal, dan sayur', 'Nurul, S. Gz.', 'nurul0101@gmail.com', 'NI.2.2 Asupan Oral Berlebih Kurang pengetahuan terkait makanan dan zat gizi ditandai dengan kebiasaan pasien yang suka menunda  waktu makan.', 'Memperaiki asupan makan dan zat gizi dengan  memperaiki pola makan dan memperhatikan bahan makanan yang dianjurkan dan tidak dianjurkan oleh dokter.  '),
(18, 'konsultasi-011', 'random', 'random@gmail.com', 'Laki-laki', '19', '170', '60', 'Jantung\r\n\r\nsakit bagian samping kiri perut', '4 kali sehari\r\n\r\nNasi putih 3 piring\r\ndaging / ayam / ikan\r\nsayur ', 'n/a', 'n/a', 'n/a', 'n/a'),
(19, 'konsultasi-012', 'Muhammad rifaldi', 'admin2@gmail.com', 'Laki-laki', '20', '150', '45', 'jantung \r\n\r\nsering mengalami sakit diagian kanan perut', '2kali sehari\r\n\r\nnasi 2 piring\r\ntempe dan tahu\r\nsayur bayam', 'Nurul, S. Gz.', 'nurul0101@gmail.com', 'maag', 'makan teratur');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `password` varchar(12) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `jenis_kelamin`, `password`, `status`) VALUES
(1, 'Rifaldi, S. Kom.', 'rfldi.mhndra512@gmail.com', 'Laki-laki', 'rifaldi123', 'admin'),
(7, 'Mahendra, S. Gz.', 'mahendra401@gmail.com', 'Laki-laki', 'nutrisi', 'nutrisionist'),
(9, 'Faldi, S. T.', 'faldi123@gmail.com', 'Laki-laki', 'faldi123', 'client'),
(27, 'Dwimahendra, S. Stat.', 'dwimahen111@gmail.com', 'Laki-laki', 'mahendra1', 'client'),
(32, 'Nurul, S. Gz.', 'nurul0101@gmail.com', 'Perempuan', 'nurul112', 'nutrisionist'),
(40, 'random', 'random@gmail.com', 'Laki-laki', 'mail-mail', 'client'),
(42, 'nutrisionist', 'nutrisionist@gmail.com', 'Perempuan', 'nutrisultati', 'nutrisionist'),
(43, 'admin', 'admin1@gmail.com', 'Laki-laki', 'admin111', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
