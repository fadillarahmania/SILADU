-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2022 at 04:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siladu`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrasi`
--

CREATE TABLE `administrasi` (
  `id` int(11) NOT NULL,
  `userId` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `data` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrasi`
--

INSERT INTO `administrasi` (`id`, `userId`, `nama`, `jenis`, `deskripsi`, `data`, `tanggal`) VALUES
(2, 'warga1', 'Warga sini', 'Surat Keterangan Ahli Waris', 'ini deskripsi', 'Case Time Management.pdf', '2022-06-12 12:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `aturan_layanan`
--

CREATE TABLE `aturan_layanan` (
  `id` int(10) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `aturan` longtext NOT NULL,
  `template_data` varchar(500) CHARACTER SET latin1 NOT NULL,
  `petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan_layanan`
--

INSERT INTO `aturan_layanan` (`id`, `id_layanan`, `aturan`, `template_data`, `petugas`) VALUES
(1, 2, '- Surat pengantar dan keterangan RT hingga dukuh setempat;\r\n- Surat pernyataan belum terekam pada DTKS (Data Terpadu Kesejahteraan Sosial);\r\n- Rincian pembiayaan biaya pendidikan atau biaya rumah sakit;\r\n- Fotokopi Kartu Keluarga dan menunjukkan yang asli;\r\n- Fotokopi dan e-KTP asli;\r\n- Beberapa daerah akan diminta membuat surat pernyataan tidak mampu yang diketahui RT dan 2 orang saksi;\r\n- Tanda lunas Pajak Bumi dan Bangunan (PBB);\r\n- Pas foto rumah yang bersangkutan dari posisi depan dan samping rumah masing-masing ukuran 5R.', '3d animasi apresiasimu.pdf', ''),
(13, 4, 'cekcek', 'Document 8.pdf', 'Administrator1');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `tanggapan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `userId`, `tanggapan`) VALUES
(1, 'administrator001', 'ini adalah tanggapan dariku');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_administrasi`
--

CREATE TABLE `hasil_administrasi` (
  `id` int(11) NOT NULL,
  `administrasiId` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_administrasi`
--

INSERT INTO `hasil_administrasi` (`id`, `administrasiId`, `nama`, `deskripsi`, `file`, `tanggal`, `petugas`) VALUES
(1, 2, 'Warga sini', 'ini tanggapan', 'Tugas Problem Solving GANJIL.pdf', '2022-06-12', 'Siti Aminah');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pengaduan`
--

CREATE TABLE `hasil_pengaduan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pengaduanId` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_pengaduan`
--

INSERT INTO `hasil_pengaduan` (`id`, `nama`, `pengaduanId`, `deskripsi`, `file`, `tanggal`, `petugas`) VALUES
(2, '', 280, 'ini tanggapan', 'realllll.pdf', '2022-06-11', 'Administrator1'),
(4, '', 281, 'cecek', 'TSE.2016.2632115.pdf', '2022-06-11', 'Administrator1'),
(6, '', 288, 'gpp', 'TEKNIK MENCARI ARTIKEL ILMIAH.pdf', '2022-06-11', 'Administrator1'),
(7, '', 288, 'gpp', 'TEKNIK MENCARI ARTIKEL ILMIAH.pdf', '2022-06-11', 'Administrator1'),
(8, 'Warga sini', 288, 'yayaya', 'Case Time Management.pdf', '2022-06-12', ''),
(9, 'Warga sini', 289, 'ini tanggapan', '1-article.en.id.pdf', '2022-06-12', 'Administrator1');

-- --------------------------------------------------------

--
-- Table structure for table `kepengurusan`
--

CREATE TABLE `kepengurusan` (
  `id` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kepengurusan`
--

INSERT INTO `kepengurusan` (`id`, `nip`, `foto`, `nama`, `jabatan`) VALUES
(1, '123456789098765432', '852-mleyot-removebg-preview.png', 'Bambang Eka', 'Kepala Desa'),
(18, '888888888888888888', '480-himatif_store.png', 'coba', 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(10) NOT NULL,
  `jenis` enum('Pengaduan','Administrasi') NOT NULL,
  `spesifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `jenis`, `spesifikasi`) VALUES
(1, 'Pengaduan', 'Pengaduan Listrik'),
(2, 'Administrasi', 'Surat Keterangan Tidak Mampu'),
(4, 'Administrasi', 'Surat Keterangan Ahli Waris'),
(5, 'Pengaduan', 'Pengaduan Sembako'),
(6, 'Administrasi', 'Surat Keterangan Miskin');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(10) NOT NULL,
  `userId` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `data` varchar(255) NOT NULL DEFAULT '-',
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `userId`, `nama`, `jenis`, `deskripsi`, `data`, `tanggal`) VALUES
(6, 'administrator001', 'Administrator1', 'Pengaduan Listrik', 'ini deskripsi setelah update', 'to do list 404.pdf', '2022-06-12 18:17:58'),
(280, 'administrator001', 'Administrator1', '(1Pengaduan Listrik)', 'deskripsi keempat', '', '2022-06-04 21:06:11'),
(281, 'administrator001', 'Administrator1', 'Pengaduan Listrik', 'ya ini coba saja keempat', '', '2022-06-05 10:08:20'),
(288, 'warga1', 'Warga sini', 'Pengaduan Sembako', 'ini deskripsi', '', '2022-06-07 09:46:07'),
(289, 'warga1', 'Warga sini', 'Pengaduan Listrik', 'ini deskripsi', 'surat izin ortu 001.pdf', '2022-06-12 19:51:48'),
(290, 'administrator001', 'Administrator1', 'Pengaduan Sembako', 'ini deskripsi', '', '2022-06-12 17:53:47'),
(292, 'administrator001', 'Administrator1', 'Pengaduan Listrik', 'ini deskripsi', 'Berita Acara HMPS-TI.pdf', '2022-06-12 18:08:29'),
(293, 'administrator001', 'Administrator1', 'Pengaduan Listrik', 'ini deskripsi', 'tang2010.pdf', '2022-06-13 09:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` enum('Pengaduan','Administrasi') NOT NULL,
  `request` varchar(100) NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `userId`, `nama`, `jenis`, `request`, `alasan`) VALUES
(2, 'administrator001', 'Administrator1', 'Pengaduan', 'Pengaduan Sembako mahal', 'sembako makin mahal, sedangkan pendapatan saya tetap'),
(3, 'warga1', 'Warga sini', 'Administrasi', 'cek', 'yaya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `level` enum('admin','petugas','warga') NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`, `alamat`, `tlp`, `level`, `nip`) VALUES
('3561234567894560', 'c73f227db1b523334ea3aef35bf06af8', 'Faris Yahya', 'faris@gmail.com', 'Perum Citra Land B-2 ', '089765893443', 'warga', ''),
('54321', '0192023a7bbd73250516f069df18b500', 'Administrator1', 'admin1@gmail.com', 'disini', '087675144322', 'admin', ''),
('administrator001', '0192023a7bbd73250516f069df18b500', 'Administrator1', 'admin1@gmail.com', 'disini', '-', 'admin', ''),
('petugas1', '570c396b3fc856eceb8aa7357f32af1a', 'Siti Aminah', 'sitiaminah@gmail.com', 'Jalan Nuri no. 9', '087678987678', 'petugas', '356418279057438920'),
('petugas2', '6fb35e77d7c816fd0ee7c305e77a1156', 'Yayan', 'yayan@gmail.com', 'Disini', '0123', 'petugas', '123456789098765432'),
('warga1', '8bee83f98002668cb8f55ba3ba2a6d3b', 'Warga sini', 'warga@gmail.con', 'disini', '0123', 'warga', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `aturan_layanan`
--
ALTER TABLE `aturan_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `hasil_administrasi`
--
ALTER TABLE `hasil_administrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrasiId` (`administrasiId`);

--
-- Indexes for table `hasil_pengaduan`
--
ALTER TABLE `hasil_pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduanId` (`pengaduanId`);

--
-- Indexes for table `kepengurusan`
--
ALTER TABLE `kepengurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrasi`
--
ALTER TABLE `administrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aturan_layanan`
--
ALTER TABLE `aturan_layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil_administrasi`
--
ALTER TABLE `hasil_administrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil_pengaduan`
--
ALTER TABLE `hasil_pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrasi`
--
ALTER TABLE `administrasi`
  ADD CONSTRAINT `administrasi_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`username`);

--
-- Constraints for table `aturan_layanan`
--
ALTER TABLE `aturan_layanan`
  ADD CONSTRAINT `aturan_layanan_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`username`);

--
-- Constraints for table `hasil_administrasi`
--
ALTER TABLE `hasil_administrasi`
  ADD CONSTRAINT `hasil_administrasi_ibfk_1` FOREIGN KEY (`administrasiId`) REFERENCES `administrasi` (`id`);

--
-- Constraints for table `hasil_pengaduan`
--
ALTER TABLE `hasil_pengaduan`
  ADD CONSTRAINT `hasil_pengaduan_ibfk_1` FOREIGN KEY (`pengaduanId`) REFERENCES `pengaduan` (`id`);

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`username`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
