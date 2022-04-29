-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 04:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webabsensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `rfid` int(11) DEFAULT NULL,
  `status_kehadiran` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_istirahat` time DEFAULT NULL,
  `jam_kembali` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `rfid`, `status_kehadiran`, `tanggal`, `jam_masuk`, `jam_istirahat`, `jam_kembali`, `jam_pulang`) VALUES
(3, 99004, 'Hadir', '2022-04-10', '11:48:42', '12:48:19', '14:10:51', '18:43:45'),
(4, 99004, 'Hadir', '2022-04-11', '09:29:18', NULL, NULL, '17:24:08'),
(5, 99005, 'Hadir', '2022-04-11', NULL, NULL, '15:27:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id_administrator` int(11) NOT NULL,
  `rfid` int(11) DEFAULT NULL,
  `nidn` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status_jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id_administrator`, `rfid`, `nidn`, `nama`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `status_jabatan`, `email`) VALUES
(1, 99002, '1905878', 'Muhammad Rafli', 'Laki - Laki', '2001-12-03', 'Purwakarta', 'Administrator', ''),
(2, 99003, '1901900', 'Admin', 'Perempuan', '0000-00-00', 'Purwakarta', 'Administrator', '');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Administrator'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `rfid` int(11) DEFAULT NULL,
  `nidn` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status_jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `rfid`, `nidn`, `nama`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `status_jabatan`, `email`) VALUES
(1, 99004, '1234566', 'Wulandari', 'Perempuan', '0000-00-00', '', 'Karyawan', ''),
(2, 99005, '111111', 'Wulandari', 'Perempuan', '0000-00-00', '', 'Karyawan', '');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `id_absensi` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `id_absensi`, `id_status`, `kegiatan`) VALUES
(1, 3, 3, 'Halo Dunia'),
(4, 4, 1, 'Mengerjakan Tugas');

-- --------------------------------------------------------

--
-- Table structure for table `status_absen`
--

CREATE TABLE `status_absen` (
  `id_status` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_absen`
--

INSERT INTO `status_absen` (`id_status`, `status`, `jam_mulai`, `jam_selesai`) VALUES
(1, 'Jam Masuk', '08:00:00', '12:00:00'),
(2, 'Jam Istirahat', '12:01:00', '14:00:00'),
(3, 'Jam Kembali', '14:01:00', '16:00:00'),
(4, 'Jam Pulang', '16:01:00', '07:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `rfid` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `rfid`, `username`, `password`, `jabatan`) VALUES
(1, 99002, 'shiota03', 'e821a8bfc2c786f275e5d5ea94d519a7', 'Administrator'),
(2, 99003, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
(6, 99004, '123456', 'e10adc3949ba59abbe56e057f20f883e', 'Karyawan'),
(7, 99005, '111111', 'e10adc3949ba59abbe56e057f20f883e', 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_administrator`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `status_absen`
--
ALTER TABLE `status_absen`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `rfid` (`rfid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_administrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_absen`
--
ALTER TABLE `status_absen`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
