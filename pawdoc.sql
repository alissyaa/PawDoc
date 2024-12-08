-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 04:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawdoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` varchar(5) NOT NULL,
  `gejala` text NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `gejala`, `bobot`) VALUES
('G01', 'Kucing sering menggaruk', 50),
('G02', 'Bulu rontok di area tertentu', 60),
('G03', 'Kulit memerah atau iritasi', 70),
('G04', 'Muncul luka basah', 80),
('G05', 'Nafsu makan berkurang', 50),
('G06', 'Muncul bercak hitam di kulit', 75),
('G07', 'Kucing sering bersin', 60),
('G08', 'Telinga kotor dan berbau', 90),
('G09', 'Diare', 85),
('G10', 'Kelemahan atau lesu', 70);

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `solusi`) VALUES
('P01', 'Scabies', 'Isolasi kucing, bersihkan area terinfeksi, oleskan salep khusus atau minyak kelapa. Jika tidak membaik, bawa ke dokter hewan.'),
('P02', 'Jamur', 'Mandikan dengan air hangat dan sampo anti-jamur, keringkan dengan baik. Jika tidak membaik, gunakan obat anti-jamur.'),
('P03', 'Flu Kucing', 'Berikan makanan bernutrisi tinggi, pastikan kucing tetap hangat, dan bawa ke dokter hewan jika kondisi memburuk.'),
('P04', 'Otitis', 'Bersihkan telinga dengan cairan khusus, gunakan obat tetes telinga sesuai resep dokter hewan.'),
('P05', 'Diare', 'Pastikan kucing tetap terhidrasi, berikan makanan yang mudah dicerna. Jika berlanjut, konsultasikan ke dokter hewan.');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit_gejala`
--

CREATE TABLE `penyakit_gejala` (
  `kode_penyakit` varchar(5) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit_gejala`
--

INSERT INTO `penyakit_gejala` (`kode_penyakit`, `kode_gejala`) VALUES
('P01', 'G01'),
('P01', 'G02'),
('P01', 'G03'),
('P02', 'G01'),
('P02', 'G02'),
('P02', 'G06'),
('P03', 'G05'),
('P03', 'G07'),
('P03', 'G10'),
('P04', 'G08'),
('P05', 'G09'),
('P05', 'G10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indexes for table `penyakit_gejala`
--
ALTER TABLE `penyakit_gejala`
  ADD PRIMARY KEY (`kode_penyakit`,`kode_gejala`),
  ADD KEY `kode_gejala` (`kode_gejala`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penyakit_gejala`
--
ALTER TABLE `penyakit_gejala`
  ADD CONSTRAINT `penyakit_gejala_ibfk_1` FOREIGN KEY (`kode_penyakit`) REFERENCES `penyakit` (`kode_penyakit`),
  ADD CONSTRAINT `penyakit_gejala_ibfk_2` FOREIGN KEY (`kode_gejala`) REFERENCES `gejala` (`kode_gejala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
