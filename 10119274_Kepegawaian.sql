-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2021 at 02:59 PM
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
-- Database: `db_ingtiaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `Kd_departemen` int(11) NOT NULL,
  `Nm_departemen` varchar(30) NOT NULL,
  `Tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`Kd_departemen`, `Nm_departemen`, `Tgl_masuk`) VALUES
(1, 'Accounting', '2021-06-04'),
(2, 'IT', '2021-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `Kd_jabatan` int(11) NOT NULL,
  `Nm_Jabatan` varchar(50) NOT NULL,
  `Lama_jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`Kd_jabatan`, `Nm_Jabatan`, `Lama_jabatan`) VALUES
(1, 'Chief Accountant', '2'),
(2, 'IT Support Officer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `NIP_pegawai` int(20) NOT NULL,
  `Nm_pegawai` varchar(80) NOT NULL,
  `Kd_departemen` int(11) NOT NULL,
  `Status_kepegawaian` varchar(20) NOT NULL,
  `Kd_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`NIP_pegawai`, `Nm_pegawai`, `Kd_departemen`, `Status_kepegawaian`, `Kd_jabatan`) VALUES
(1210604, 'Elly Suharti', 1, 'Tetap', 1),
(12210603, 'Sindy Amani A', 2, 'Tidak Tetap', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`Kd_departemen`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Kd_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD KEY `Kd_departemen` (`Kd_departemen`),
  ADD KEY `Kd_jabatan` (`Kd_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `Kd_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Kd_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `Kd_departemen` FOREIGN KEY (`Kd_departemen`) REFERENCES `departemen` (`Kd_departemen`),
  ADD CONSTRAINT `Kd_jabatan` FOREIGN KEY (`Kd_jabatan`) REFERENCES `jabatan` (`Kd_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
