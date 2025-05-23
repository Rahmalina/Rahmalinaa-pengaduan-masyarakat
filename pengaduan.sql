-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 07:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `pengaduan_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `pengaduan_id`, `admin_id`, `isi_komentar`, `tanggal`) VALUES
(1, 3, 11, 'Mohon kirim lokasi detail ya.', '2025-05-18 23:37:42'),
(2, 2, 11, 'Berikan keterangan puskesmas daerah mana dengan detail ya.', '2025-05-18 23:46:33'),
(7, 6, 11, 'Terima kasih atas laporan Anda. Akan segera kami tindak lanjuti.', '2025-05-19 18:43:19'),
(8, 7, 11, 'Terima kasih atas laporan Anda. Akan segera kami tindak lanjuti.', '2025-05-19 18:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `nik` char(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` char(16) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','proses','selesai') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`, `nama`, `kategori`) VALUES
(2, '2025-05-15', '', 'Puskesmas tidak melayani dengan baik', '', '0', 'jeno', 'Layanan Publik'),
(3, '2025-05-18', '', 'Ada pencuri motor, mohon segera ditindak lanjuti. ini motornya', 'uploads/1747583119_download (6).jpeg', '0', 'taeyong', 'Keamanan'),
(6, '2025-05-19', '', 'ada yg balap liar di jalan jetis-sikuang desa kendalsari petarukan. Tolong itu berbahaya untuk warga yang lewat malam-malam', '', '0', 'pinuut', 'Lingkungan'),
(7, '2025-05-19', '', 'Sampah berserakan di jalan Sirangkang-Karangasem. Mohon segera ditindak', '', '0', 'lina', 'Lingkungan');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('masyarakat','petugas','admin') DEFAULT 'masyarakat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'jaemin', 'afhsihkaq@gmail.com', '$2y$10$stbqKT9lxaGV833qlKXV5uYw3Gic0UjSXc2jLqeFd73h3tvF2gAgK', 'masyarakat'),
(2, 'jaemin', 'jaemin@gmail.com', '$2y$10$DXMPJq6YJLUbkh2c0CTlgOG48RiwkAKEyTQCjBfBVJvko5lWcbOaO', 'masyarakat'),
(3, 'jeno', 'jeno@gmail.com', '$2y$10$rNIe7o2OAv1QzdSsio0dsebAXP79y.cp/7izLJ9GJ1Ni1ez8u8fxq', 'masyarakat'),
(4, 'jeno', 'shdeuwgdke@gmail.com', '$2y$10$Mvijk6qXso9b7HSyi1jKbeNK8c14sEu2YfEZMASyYiVMK3eMuZgy2', 'masyarakat'),
(7, 'lina', 'cimuy@gmail.com', '$2y$10$KTTsf2Ck6TLILgBZ.RCjy.ayFM6wLJiWH3qZkdlAF3tb9322hfB6S', 'masyarakat'),
(9, 'jaemin', 'jaeming@gmail.com', '$2y$10$AG/3cJosvx3AJCjj7mmT.uE6mBN9ZptnqTrKEHRyIj7Ba8HwAeBVe', 'masyarakat'),
(11, 'admin', 'admin@gmail.com', '$2y$10$vtuzc6GCJVhNtIif97ojw.Gx74OHzxUjXfRwJgHyx6P0EO6JTDzai', 'admin'),
(12, 'renjun', 'renjun@gmail.com', '$2y$10$brTWVlbMyqm4S0AKNIi9qua9..RMdJg2hRTUA5YXed58JyZWFDXnm', 'masyarakat'),
(15, 'salma jelek', 'bahasainggriskukeren@gmail.com', '$2y$10$M6XfTnvF6Mb8zwBAvT2MXeLVCYC9CCDnSAigX6DajaxAF2QdMyRUy', 'masyarakat'),
(16, 'izin', 'izin@gmail.com', '$2y$10$FJpQPpWbuIO6E8SvFXRV4uuGYvky3WK9XDZNrY2tjdUfDzT1TPvIy', 'masyarakat'),
(18, 'taeyong', 'taeyong@gmail.com', '$2y$10$DojyvHdhaScmSLepDxE4x./85ofDbpQOTV//D0y7Y/AD5mCMp7vN6', 'masyarakat'),
(19, 'taehyung', 'taehyung@gmail.com', '$2y$10$4uAf34tsGFGb48Zhk9miWenVZhfmk1lY5BLtJGozZ5cwCmrw2lcMy', 'masyarakat'),
(20, 'pinut', 'pinus@gmail.com', '$2y$10$/fQJ0oK47dCr35bmitVxmOkwhzV0bWuuXDPYyEnF787HqiP7Y1V3y', 'masyarakat'),
(21, 'lina', 'lina@gmail.com', '$2y$10$xokOJT52JAnvUiWy.2HKGuE6Jkp6zOTzWHUTozN3UAD0cL0Cv8ZKG', 'masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugtgas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `level` enum('admin','petugas','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `pengguna` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
