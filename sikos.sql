-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 04:02 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikos`
--

-- --------------------------------------------------------

--
-- Table structure for table `datakos`
--

CREATE TABLE `datakos` (
  `id_kos` int(11) NOT NULL,
  `fk_pemilik` int(11) DEFAULT NULL,
  `dk_nama_kos` varchar(20) DEFAULT NULL,
  `dk_alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `p_username` varchar(20) DEFAULT NULL,
  `p_namakos` varchar(50) NOT NULL,
  `p_password` varchar(33) DEFAULT NULL,
  `p_email` varchar(30) NOT NULL,
  `p_rights` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`p_username`, `p_namakos`, `p_password`, `p_email`, `p_rights`) VALUES
('Gunawan', 'Kos Jaya Makmur', '202cb962ac59075b964b07152d234b70', 'jaya@gmail.com', 2),
('Siraj', 'Kos NCC', '202cb962ac59075b964b07152d234b70', 'ncc@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pencari`
--

CREATE TABLE `pencari` (
  `u_username` varchar(20) DEFAULT NULL,
  `u_password` varchar(33) DEFAULT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_rights` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pencari`
--

INSERT INTO `pencari` (`u_username`, `u_password`, `u_email`, `u_rights`) VALUES
('Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 3),
('Andri', '202cb962ac59075b964b07152d234b70', 'andri@gmail.com', 1),
('Budi', '81dc9bdb52d04dc20036dbd8313ed055', 'budi@gmail.com', 1),
('Ivan', '202cb962ac59075b964b07152d234b70', 'ivan@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `fk_kos` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL,
  `r_ukuran_kmr` varchar(10) DEFAULT NULL,
  `r_harga_kmr` int(11) DEFAULT NULL,
  `r_ac` char(1) DEFAULT NULL,
  `r_kmr_mandi` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datakos`
--
ALTER TABLE `datakos`
  ADD PRIMARY KEY (`id_kos`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`p_email`);

--
-- Indexes for table `pencari`
--
ALTER TABLE `pencari`
  ADD PRIMARY KEY (`u_email`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datakos`
--
ALTER TABLE `datakos`
  MODIFY `id_kos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
