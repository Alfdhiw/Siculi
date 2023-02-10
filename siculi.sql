-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 11:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siculi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `user` varchar(256) DEFAULT NULL,
  `nik` varchar(256) DEFAULT NULL,
  `psw` varchar(256) DEFAULT NULL,
  `nama` varchar(256) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `user`, `nik`, `psw`, `nama`, `level`, `waktu`) VALUES
(13, 'agus@gmail.com', '001', '25d55ad283aa400af464c76d713c07ad', 'Agus Salim', 'admin', '2022-03-09 22:14:53'),
(14, 'karyawan@gmail.com', '01', 'ee11cbb19052e40b07aac0ca060c23ee', 'Arthur Julio Risa', 'karyawan', '2022-08-11 19:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `kd_admin` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nik` varchar(120) NOT NULL,
  `jabatan` varchar(110) NOT NULL,
  `golongan` varchar(110) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_role` int(11) NOT NULL,
  `jeniskel` char(20) NOT NULL,
  `status` varchar(120) NOT NULL,
  `foto` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`kd_admin`, `nama`, `nik`, `jabatan`, `golongan`, `email`, `password`, `id_role`, `jeniskel`, `status`, `foto`) VALUES
(1, 'Admin Siculi', '3374050505004', 'Admin', 'IA', 'admin@gmail.com', 'admin', 4, 'P', 'Aktif', '230124-pngegg.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_atasan`
--

CREATE TABLE `tbl_atasan` (
  `kd_atasan` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nik` varchar(120) NOT NULL,
  `masuk_kerja` date DEFAULT NULL,
  `jabatan` varchar(120) NOT NULL,
  `golongan` varchar(120) NOT NULL,
  `atasan` int(11) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `telp` varchar(120) NOT NULL,
  `id_role` int(11) NOT NULL,
  `jeniskel` char(11) NOT NULL,
  `status` varchar(120) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `sisa_cuti` int(11) NOT NULL,
  `tgl_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_atasan`
--

INSERT INTO `tbl_atasan` (`kd_atasan`, `nama`, `nik`, `masuk_kerja`, `jabatan`, `golongan`, `atasan`, `email`, `password`, `telp`, `id_role`, `jeniskel`, `status`, `foto`, `sisa_cuti`, `tgl_masuk`) VALUES
(1, 'Arif', '12345678', '2023-02-06', 'KASUBBAG KEPEGAWAIAN DAN ORTALA PENGADILAN NEGERI SEMARANG', 'II B', 2, 'arif@gmail.com', '12345', '0897556655645', 5, 'L', 'Aktif', 'default.jpg', 12, NULL),
(2, 'Sultan', '123456789', '2023-02-06', 'KABAG UMUM PENGADILAN NEGERI SEMARANG', 'II B', 3, 'sultan@gmail.com', '12345', '0897556655645', 5, 'L', 'Aktif', 'default.jpg', 12, NULL),
(3, 'Sekretaris', '1234567890', '2023-02-06', 'SEKRETARIS', 'II D', 4, 'sekretaris@gmail.com', '12345', '0897556655645', 5, 'P', 'Aktif', 'default.jpg', 12, NULL),
(4, 'Ketua', '12223221232', '2023-02-06', 'KETUA', 'I A', 0, 'ketuaatasan@gmail.com', '12345', '0897556655645', 5, 'L', 'Aktif', 'default.jpg', 12, NULL),
(5, 'Susi', '337407020445', '2023-02-06', 'KASUBBAG TATA USAHA DAN KEUANGAN PENGADILAN NEGERI SEMARANG', 'IV A', 2, 'susi@gmail.com', '12345', '0897556655645', 5, 'P', 'Aktif', 'default.jpg', 12, NULL),
(6, 'Ari', '44554433445656', '2023-02-06', 'KASUBBAG PERENCANAAN, TI DAN PELAPORAN PENGADILAN NEGERI SEMARANG', 'III D', 2, 'ari@gmail.com', '12345', '0895544345', 5, 'L', 'Cuti', 'default.jpg', 11, '2023-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti`
--

CREATE TABLE `tbl_cuti` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `atasan` int(11) NOT NULL,
  `tgl_cuti` date DEFAULT NULL,
  `jenis_cuti` varchar(50) NOT NULL DEFAULT '0',
  `jumlah_cuti` varchar(50) NOT NULL DEFAULT '0',
  `keperluan` varchar(256) NOT NULL DEFAULT '0',
  `alamat` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `tgl_masuk` date NOT NULL,
  `surat` varchar(120) DEFAULT NULL,
  `tgl_upload` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cuti`
--

INSERT INTO `tbl_cuti` (`id`, `id_karyawan`, `atasan`, `tgl_cuti`, `jenis_cuti`, `jumlah_cuti`, `keperluan`, `alamat`, `status`, `tgl_masuk`, `surat`, `tgl_upload`) VALUES
(67, 16, 1, '2023-02-05', 'Cuti Khusus', '12', 'tes', 'tes', 'Disetujui', '2023-02-06', NULL, '2023-02-05'),
(69, 6, 2, '2023-02-06', 'Cuti Khusus', '12', 'libur dulu ', 'lamper tengah', 'Ditangguhkan', '2023-02-10', NULL, '2023-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departement`
--

CREATE TABLE `tbl_departement` (
  `id` int(11) NOT NULL,
  `dept` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departement`
--

INSERT INTO `tbl_departement` (`id`, `dept`) VALUES
(6, 'II A'),
(7, 'II B'),
(8, 'II C'),
(9, 'II D'),
(10, 'III A'),
(11, 'III B'),
(12, 'III C'),
(13, 'III D'),
(14, 'IV A'),
(15, 'IV B'),
(16, 'IV C'),
(17, 'IV D'),
(18, 'I A'),
(19, 'V D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ijin`
--

CREATE TABLE `tbl_ijin` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `atasan` int(11) NOT NULL,
  `waktu_pergi` time NOT NULL,
  `waktu_pulang` time DEFAULT NULL,
  `keperluan` varchar(250) NOT NULL,
  `tgl_ijin` date DEFAULT NULL,
  `status` varchar(120) NOT NULL,
  `jenis` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ijin`
--

INSERT INTO `tbl_ijin` (`id`, `id_karyawan`, `atasan`, `waktu_pergi`, `waktu_pulang`, `keperluan`, `tgl_ijin`, `status`, `jenis`) VALUES
(24, 16, 1, '13:48:00', '14:49:00', 'tes', '2023-02-06', 'Disetujui', 'Normal'),
(25, 16, 1, '14:50:00', NULL, 'tes', '2023-02-06', 'Disetujui', 'Cepat'),
(26, 1, 2, '16:39:00', '17:39:00', 'tes atasan', '2023-02-06', 'Disetujui', 'Normal'),
(27, 1, 2, '18:40:00', NULL, 'sholat magrib', '2023-02-06', 'Disetujui', 'Cepat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id`, `jabatan`) VALUES
(4, 'STAF SUB BAG TATA USAHA DAN KEUANGAN'),
(5, 'PENGELOLA SISTEM DAN JARINGAN SUB BAG PERENCANAAN, TI DAN PELAPORAN'),
(6, 'ANALIS SDM APARATUR SUB BAG KEPEGAWAIAN DAN ORTALA'),
(7, 'PENGADMINISTRASI PERPUSTAKAAN SUB BAG TATA USAHA DAN KEUANGAN'),
(8, 'PENGELOLA SISTEM DAN JARINGAN SUB BAG PERENCANAAN, TI DAN PELAPORAN'),
(9, 'STAF SUB BAG KEPEGAWAIAN DAN ORTALA'),
(10, 'Hakim'),
(11, 'Hakim ADHOC'),
(12, 'HAKIM ADHOC PHI '),
(13, 'HAKIM ADHOC TIPIKOR'),
(14, 'WAKIL KETUA'),
(15, 'KETUA'),
(16, 'SEKRETARIS'),
(17, 'KABAG UMUM PENGADILAN NEGERI SEMARANG'),
(18, 'PANMD PIDANA'),
(19, 'PANMUD PERDATA KHUSUS NIAGA '),
(20, 'PANMUD PERDATA'),
(21, 'PANMUD PERDATA KHUSUS PHI '),
(22, 'PANMUD HUKUM'),
(23, 'PANMUD PIDANA KHUSUS TIPIKOR'),
(24, 'KASUBBAG KEPEGAWAIAN DAN ORTALA PENGADILAN NEGERI SEMARANG'),
(25, 'KASUBBAG PERENCANAAN, TI DAN PELAPORAN PENGADILAN NEGERI SEMARANG'),
(26, 'KASUBBAG TATA USAHA DAN KEUANGAN PENGADILAN NEGERI SEMARANG'),
(27, 'ANALIS PERKARA PERADILAN PANITERA MUDA NIAGA'),
(28, 'PENGADMINISTRASI PERKARA'),
(29, 'PENGADMINISTRASI PERSURATAN SUB BAG TATA USAHA DAN KEUANGAN'),
(30, 'JURU SITA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_cuti`
--

CREATE TABLE `tbl_jenis_cuti` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_cuti`
--

INSERT INTO `tbl_jenis_cuti` (`id`, `jenis`) VALUES
(1, 'Cuti Tahunan'),
(2, 'Cuti Khusus'),
(4, 'Cuti Melahirkan'),
(5, 'Cuti di Luar Tanggungan Negara'),
(6, 'Cuti Sakit'),
(7, 'Cuti Besar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(256) DEFAULT NULL,
  `nama` varchar(256) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `masuk_kerja` date DEFAULT NULL,
  `jenis_kelamin` char(50) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(120) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `atasan` int(11) NOT NULL,
  `jabatan` varchar(120) NOT NULL,
  `golongan` varchar(120) NOT NULL,
  `sisa_cuti` int(3) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id`, `nik`, `nama`, `id_role`, `foto`, `masuk_kerja`, `jenis_kelamin`, `email`, `password`, `alamat`, `telp`, `atasan`, `jabatan`, `golongan`, `sisa_cuti`, `tgl_masuk`, `status`) VALUES
(16, '1234567890', 'tes1', 3, '230205-selfi.jpeg', '2020-02-05', 'L', 'tes@gmail.com', '12345', 'lamper', '123456789', 1, 'KASUBBAG KEPEGAWAIAN DAN ORTALA PENGADILAN NEGERI SEMARANG', 'III B', 11, '0000-00-00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kepegawaian`
--

CREATE TABLE `tbl_kepegawaian` (
  `kd_kepegawaian` int(20) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nik` varchar(120) NOT NULL,
  `jabatan` varchar(110) NOT NULL,
  `golongan` varchar(110) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_role` int(11) NOT NULL,
  `jeniskel` char(11) NOT NULL,
  `status` varchar(120) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ketua`
--

CREATE TABLE `tbl_ketua` (
  `kd_ketua` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nik` varchar(120) NOT NULL,
  `jabatan` varchar(110) NOT NULL,
  `golongan` varchar(110) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_role` int(11) NOT NULL,
  `jeniskel` char(20) NOT NULL,
  `status` varchar(120) NOT NULL,
  `foto` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ketua`
--

INSERT INTO `tbl_ketua` (`kd_ketua`, `nama`, `nik`, `jabatan`, `golongan`, `email`, `password`, `id_role`, `jeniskel`, `status`, `foto`) VALUES
(1, 'RIZA FAUZIA, S.H.', '19650326 199103 1 001', 'KETUA', 'IV D', 'ketua@gmail.com', '12345', 1, 'L', 'Aktif', '221227-riza-fauzi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indexes for table `tbl_atasan`
--
ALTER TABLE `tbl_atasan`
  ADD PRIMARY KEY (`kd_atasan`);

--
-- Indexes for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_departement`
--
ALTER TABLE `tbl_departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ijin`
--
ALTER TABLE `tbl_ijin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jenis_cuti`
--
ALTER TABLE `tbl_jenis_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kepegawaian`
--
ALTER TABLE `tbl_kepegawaian`
  ADD PRIMARY KEY (`kd_kepegawaian`);

--
-- Indexes for table `tbl_ketua`
--
ALTER TABLE `tbl_ketua`
  ADD PRIMARY KEY (`kd_ketua`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `kd_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_atasan`
--
ALTER TABLE `tbl_atasan`
  MODIFY `kd_atasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_departement`
--
ALTER TABLE `tbl_departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_ijin`
--
ALTER TABLE `tbl_ijin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_jenis_cuti`
--
ALTER TABLE `tbl_jenis_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_kepegawaian`
--
ALTER TABLE `tbl_kepegawaian`
  MODIFY `kd_kepegawaian` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ketua`
--
ALTER TABLE `tbl_ketua`
  MODIFY `kd_ketua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
