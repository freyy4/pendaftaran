-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2023 at 02:00 PM
-- Server version: 10.3.38-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjtki3`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `hubungan_pm` varchar(20) NOT NULL,
  `permasalahan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nik_pmi` varchar(100) NOT NULL,
  `nama_pmi` varchar(100) NOT NULL,
  `alamat_pmi` text NOT NULL,
  `tgl_terbang` varchar(100) NOT NULL,
  `negara_tujuan` varchar(50) NOT NULL,
  `tanggal_pengaduan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
