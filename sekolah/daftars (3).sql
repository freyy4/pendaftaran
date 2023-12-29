-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2023 at 12:54 PM
-- Server version: 10.3.38-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjtki`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftars`
--

CREATE TABLE `daftars` (
  `id` bigint(30) NOT NULL,
  `id_daftar` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pendaftaran` bigint(30) DEFAULT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_desa` bigint(30) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `selfie_ktp` varchar(255) NOT NULL,
  `pas` varchar(100) NOT NULL,
  `telepon` bigint(30) NOT NULL,
  `terima` enum('terima','tolak') NOT NULL,
  `aktif` enum('aktif','nonaktif') NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `negara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftars`
--

INSERT INTO `daftars` (`id`, `id_daftar`, `id_pendaftaran`, `nik`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `status`, `tinggi`, `berat`, `id_provinsi`, `id_kota`, `id_kecamatan`, `id_desa`, `alamat_lengkap`, `foto_ktp`, `selfie_ktp`, `pas`, `telepon`, `terima`, `aktif`, `pekerjaan`, `negara`) VALUES
(35, 3, NULL, '1234567890987654', 'Fast One', 'Jakarta', '1212-12-12', 'Sudah Menikah', 123, 123, 13, 1376, 137601, 1376011003, 'Gg. Baja Raya No. 912', 'ktp/icons8-visual-studio-code-64.png', 'selfie/Screenshot_2023-09-10-09-23-23-69-removebg-preview.png', 'pas/Screenshot_2023-09-10-09-23-23-69.jpg', 85808331804, 'terima', 'aktif', '0', '0'),
(37, 3, NULL, '3576014403910003', 'Indonesia', 'Jakarta', '1212-12-12', 'Belum Menikah', 123, 123, 11, 1171, 117101, 1171012004, 'Gg. Baja Raya No. 912', 'ktp/icons8-visual-studio-code-64.ico', 'selfie/Screenshot_2023-09-10-09-23-23-69_clipdrop-cleanup.jpg', 'pas/ppig.jpg', 85808331804, 'tolak', 'nonaktif', 'Perawat Orang Tua', 'Taiwan'),
(38, 3, NULL, '392939207303', 'Indonesia', 'Jakarta', '1212-12-12', 'Belum Menikah', 123, 12, 32, 3201, 320106, 3201062009, 'Gg. Baja Raya No. 912', '../ktp/icons8-visual-studio-code-64.png', '../selfie/Screenshot_2023-09-10-09-23-23-69_clipdrop-cleanup.jpg', 'pas/ppig.jpg', 85808331804, 'tolak', 'nonaktif', 'Perawat Orang Tua', 'Taiwan'),
(39, NULL, 3, '392939207303', 'Indonesia', 'Jakarta', '1212-12-12', 'Belum Menikah', 123, 12, 13, 1374, 137401, 1374011002, 'Gg. Baja Raya No. 912', '../ktp/icons8-visual-studio-code-64.png', '../selfie/Screenshot_2023-09-10-09-23-23-69_clipdrop-cleanup.jpg', 'pas/ppig.jpg', 85808331804, 'terima', 'aktif', 'Baby Sitter', 'Malaysia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftars`
--
ALTER TABLE `daftars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provinsi` (`id_provinsi`),
  ADD KEY `id_kota` (`id_kota`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_daftar` (`id_daftar`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftars`
--
ALTER TABLE `daftars`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftars`
--
ALTER TABLE `daftars`
  ADD CONSTRAINT `daftars_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`),
  ADD CONSTRAINT `daftars_ibfk_2` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`),
  ADD CONSTRAINT `daftars_ibfk_3` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `daftars_ibfk_4` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`),
  ADD CONSTRAINT `daftars_lbfk_5` FOREIGN KEY (`id_daftar`) REFERENCES `login` (`id_daftar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
