-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2023 at 09:24 PM
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
  `id_pengaduan` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `hubungan_pm` varchar(20) NOT NULL,
  `permasalahan` text NOT NULL,
  `foto_1` varchar(100) DEFAULT NULL,
  `nik_pmi` varchar(100) NOT NULL,
  `nama_pmi` varchar(100) NOT NULL,
  `alamat_pmi` text NOT NULL,
  `tgl_terbang` varchar(100) NOT NULL,
  `negara_tujuan` varchar(50) NOT NULL,
  `selesai` varchar(10) NOT NULL,
  `tanggal_pengaduan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `nik`, `nama_lengkap`, `email`, `nomor_hp`, `hubungan_pm`, `permasalahan`, `foto_1`, `nik_pmi`, `nama_pmi`, `alamat_pmi`, `tgl_terbang`, `negara_tujuan`, `selesai`, `tanggal_pengaduan`) VALUES
(47, '3576014403910003', 'Indonesia', 'frd.syf004@gmail.com', '085808331804', 'anak', 'Saya suka Anda', 'files/1698737935.sql', '2032139213227914', 'Fast One', 'Gg. Baja Raya No. 912', '1212-12-12', 'Indonesia', 'belum', '2023-10-31 07:38:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
