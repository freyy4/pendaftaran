-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2023 at 09:26 PM
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
-- Table structure for table `tindak_lanjut`
--

CREATE TABLE `tindak_lanjut` (
  `id` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `input_oleh` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `dokumen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tindak_lanjut`
--

INSERT INTO `tindak_lanjut` (`id`, `id_pengaduan`, `tgl`, `input_oleh`, `catatan`, `dokumen`) VALUES
(3, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/successfully-upload-in-wattpad-@frd.isme (1).png'),
(4, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698754398_successfully-upload-in-wattpad-@frd.isme (1).png'),
(5, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698754434_successfully-upload-in-wattpad-@frd.isme (1).png'),
(6, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698754623_startbootstrap-grayscale-gh-pages.zip'),
(7, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698756860_startbootstrap-grayscale-gh-pages.zip'),
(8, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698756876_startbootstrap-grayscale-gh-pages.zip'),
(9, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698756901_startbootstrap-grayscale-gh-pages.zip'),
(10, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698757023_successfully-upload-in-wattpad-@frd.isme (1).png'),
(13, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698757789_pengaduan.sql'),
(14, 47, '2023-10-31', 'Aadmin', 'Ini Kurang satu', 'dokumen/1698757839_pengaduan.sql'),
(15, 47, '2023-10-31', 'Aadmin', 'Ini kurang dua', 'dokumen/1698757840_coming-soon-in-wattpad-@frd.isme.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengaduan` (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD CONSTRAINT `tindak_lanjut_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
