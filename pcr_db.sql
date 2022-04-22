-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 02:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `status_pulang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_pegawai`, `periode`, `tahun`, `tanggal`, `jam_masuk`, `jam_pulang`, `status_pulang`) VALUES
('ABS001', 'P001', '3', '2022', '06/03/2022', '12:19:52', '01:01:35', '1'),
('ABS002', 'P002', '3', '2022', '06/03/2022', '12:20:13', '01:07:26', '1'),
('ABS003', 'P001', '3', '2022', '07/03/2022', '12:06:09', '11:31:32', '1'),
('ABS004', 'P002', '3', '2022', '07/03/2022', '12:06:32', '11:31:35', '1'),
('ABS005', 'P004', '3', '2022', '09/03/2022', '12:48:16', '00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_gaji`
--

CREATE TABLE `tbl_data_gaji` (
  `id_data_gaji` int(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `gapok` decimal(22,2) NOT NULL,
  `tunjangan_ijazah` decimal(22,2) NOT NULL,
  `potongan_keterlambatan` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_data_gaji`
--

INSERT INTO `tbl_data_gaji` (`id_data_gaji`, `id_pegawai`, `gapok`, `tunjangan_ijazah`, `potongan_keterlambatan`) VALUES
(23, 'P001', '800000.00', '50000.00', '15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gaji`
--

CREATE TABLE `tbl_gaji` (
  `id_pegawai` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `gapok` decimal(22,2) NOT NULL,
  `tunjangan_ijazah` decimal(22,2) NOT NULL,
  `tunjangan_jabatan` decimal(22,2) NOT NULL,
  `tunjangan_wk` decimal(22,2) NOT NULL,
  `ttl_tunjangan` decimal(22,2) NOT NULL,
  `potongan` decimal(22,2) NOT NULL,
  `potongan_terlambat` decimal(22,2) NOT NULL,
  `ttl_potongan` decimal(22,2) NOT NULL,
  `total_gaji` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gaji`
--

INSERT INTO `tbl_gaji` (`id_pegawai`, `periode`, `tahun`, `tanggal`, `gapok`, `tunjangan_ijazah`, `tunjangan_jabatan`, `tunjangan_wk`, `ttl_tunjangan`, `potongan`, `potongan_terlambat`, `ttl_potongan`, `total_gaji`) VALUES
('P001', '12', '2021', '03/08/2022', '800000.00', '50000.00', '0.00', '0.00', '50000.00', '0.00', '195000.00', '195000.00', '655000.00'),
('P002', '12', '2021', '03/08/2022', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('P003', '12', '2021', '03/08/2022', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('P004', '3', '2022', '03/09/2022', '0.00', '0.00', '50000.00', '0.00', '50000.00', '100000.00', '0.00', '100000.00', '-50000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_golongan`
--

CREATE TABLE `tbl_golongan` (
  `id_gol` int(11) NOT NULL,
  `golongan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `gapok` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_golongan`
--

INSERT INTO `tbl_golongan` (`id_gol`, `golongan`, `gapok`) VALUES
(1, 'Gol I', '1500000'),
(2, 'Gol II', '2000000'),
(3, 'GOL III', '2500000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kt`
--

CREATE TABLE `tbl_kt` (
  `id_kt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `id_pegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tgl_kt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `periode_kt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tahun_kt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jml_tunjangan_wk` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kt`
--

INSERT INTO `tbl_kt` (`id_kt`, `id_pegawai`, `tgl_kt`, `periode_kt`, `tahun_kt`, `jml_tunjangan_wk`) VALUES
('KT001', 'P003', '2022-03-08', '3', '2022', '50000'),
('KT002', 'P003', '2022-03-09', '3', '2022', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` varchar(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_mulai_kerja` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `sk` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(50) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `status_user` varchar(50) NOT NULL,
  `status_data_gaji` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `jk`, `tgl_lahir`, `alamat`, `tgl_mulai_kerja`, `jabatan`, `sk`, `pendidikan_terakhir`, `no_telepon`, `bank`, `no_rekening`, `status_user`, `status_data_gaji`) VALUES
('P001', 'Urbanus Manggo, S.Pd', 'Laki-laki', '2020-11-18', 'Jln. Tukad Punggawa', '2020-11-18', 'Kepsek', 'Ketua Yayasan', 'Sarjana', '0987767676', 'BRI', '464594540594590', 'Ok', 'Ok'),
('P002', 'Maria Elestina Wona, S.Ak', 'Perempuan', '2020-11-18', 'Jln. Tukad Punggawa', '2020-11-18', 'Bendahara Komite', 'Guru Tetap', 'Sarjana', '082339368112', 'BRI', '464594540594590', 'Ok', ''),
('P003', 'Natan', 'Laki-laki', '2022-03-07', 'Br. Cempaka, Desa Pikat', '2022-03-01', 'Guru', 'Guru Tetap', 'Sarjana Muda', '082339368112', 'BRI', '531201554620', 'Ok', ''),
('P004', 'Anselmus Y. Yopi, S.Kom', 'Laki-laki', '2022-03-10', 'Br. Cempaka, Desa Pikat', '2022-03-11', 'Pegawai', 'Guru Tetap', 'Sarjana', '082339368112', 'BNI', '531201554620', 'Ok', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_potongan`
--

CREATE TABLE `tbl_potongan` (
  `id_potongan` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `tgl_ptngn` varchar(50) NOT NULL,
  `periode_ptngn` varchar(50) NOT NULL,
  `tahun_ptngn` varchar(50) NOT NULL,
  `jenis_ptngn` varchar(50) NOT NULL,
  `jml_ptngn` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_potongan`
--

INSERT INTO `tbl_potongan` (`id_potongan`, `id_pegawai`, `tgl_ptngn`, `periode_ptngn`, `tahun_ptngn`, `jenis_ptngn`, `jml_ptngn`) VALUES
('PT001', 'P001', '2022-03-08', '3', '2022', 'Arisan', '100000.00'),
('PT002', 'P003', '2022-03-09', '3', '2022', 'Arisan', '100000.00'),
('PT003', 'P004', '2022-03-10', '3', '2022', 'Arisan', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_a`
--

CREATE TABLE `tbl_rekap_a` (
  `id_absensi` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `jam_masuk` time NOT NULL,
  `masuk` time NOT NULL,
  `status_masuk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rekap_a`
--

INSERT INTO `tbl_rekap_a` (`id_absensi`, `id_pegawai`, `periode`, `tahun`, `jam_masuk`, `masuk`, `status_masuk`) VALUES
('ABS001', 'P001', '12', '2021', '07:00:00', '08:00:00', 'Telat'),
('ABS003', 'P001', '12', '2021', '07:00:00', '08:00:00', 'Telat'),
('ABS006', 'P001', '12', '2021', '07:00:00', '08:00:00', 'Telat'),
('ABS008', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS009', 'P001', '12', '2021', '07:00:00', '07:30:00', 'Telat'),
('ABS010', 'P001', '12', '2021', '07:00:00', '07:35:00', 'Telat'),
('ABS011', 'P001', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS012', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS013', 'P001', '12', '2021', '07:00:00', '07:30:00', 'Telat'),
('ABS014', 'P001', '12', '2021', '07:00:00', '07:35:00', 'Telat'),
('ABS015', 'P001', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS016', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS017', 'P001', '12', '2021', '07:00:00', '07:30:00', 'Telat'),
('ABS018', 'P001', '12', '2021', '07:00:00', '07:35:00', 'Telat'),
('ABS019', 'P001', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS020', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS021', 'P001', '12', '2021', '07:00:00', '07:30:00', 'Telat'),
('ABS022', 'P001', '12', '2021', '07:00:00', '07:35:00', 'Telat'),
('ABS023', 'P001', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS024', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS025', 'P001', '12', '2021', '07:00:00', '06:45:00', 'Tepat Waktu'),
('ABS026', 'P001', '12', '2021', '07:00:00', '07:30:00', 'Telat'),
('ABS027', 'P001', '12', '2021', '07:00:00', '07:35:00', 'Telat'),
('ABS028', 'P001', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS029', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS030', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS031', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS032', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS033', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS034', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS035', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS036', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS037', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS038', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS039', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS040', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS041', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS042', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS043', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS044', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS045', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS046', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS047', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS048', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS049', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS050', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS051', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS052', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS053', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS054', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS055', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS056', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu'),
('ABS057', 'P002', '12', '2021', '07:00:00', '07:00:00', 'Tepat Waktu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_absen`
--

CREATE TABLE `tbl_rekap_absen` (
  `id_rekap` int(11) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `jlh_terlambat` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rekap_absen`
--

INSERT INTO `tbl_rekap_absen` (`id_rekap`, `id_pegawai`, `periode`, `tahun`, `jlh_terlambat`) VALUES
(23, 'P001', '12', '2021', 13),
(25, 'P002', '12', '2021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_kehadiran`
--

CREATE TABLE `tbl_rekap_kehadiran` (
  `id_rekap_k` int(11) NOT NULL,
  `id_pegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `periode` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tahun` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jml_hadir` int(50) NOT NULL,
  `jml_tdk_hadir` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rekap_kehadiran`
--

INSERT INTO `tbl_rekap_kehadiran` (`id_rekap_k`, `id_pegawai`, `periode`, `tahun`, `jml_hadir`, `jml_tdk_hadir`) VALUES
(5, 'P001', '12', '2021', 24, 2),
(7, 'P002', '12', '2021', 29, -3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_kt`
--

CREATE TABLE `tbl_rekap_kt` (
  `id_rkt` int(11) NOT NULL,
  `id_pegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `periode_rkt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tahun_rkt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jml_kt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rekap_kt`
--

INSERT INTO `tbl_rekap_kt` (`id_rkt`, `id_pegawai`, `periode_rkt`, `tahun_rkt`, `jml_kt`) VALUES
(7, 'P003', '3', '2022', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_ptngn`
--

CREATE TABLE `tbl_rekap_ptngn` (
  `id_rp` int(11) NOT NULL,
  `id_pegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `periode_ptngn` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tahun_ptngn` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ttl_ptngn` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rekap_ptngn`
--

INSERT INTO `tbl_rekap_ptngn` (`id_rp`, `id_pegawai`, `periode_ptngn`, `tahun_ptngn`, `ttl_ptngn`) VALUES
(7, 'P001', '3', '2022', '100000.00'),
(8, 'P003', '3', '2022', '100000.00'),
(9, 'P004', '3', '2022', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_tunjangan`
--

CREATE TABLE `tbl_rekap_tunjangan` (
  `id_rt` int(11) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `periode_tjng` varchar(50) NOT NULL,
  `tahun_tjng` varchar(50) NOT NULL,
  `ttl_tnjngn` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rekap_tunjangan`
--

INSERT INTO `tbl_rekap_tunjangan` (`id_rt`, `id_pegawai`, `periode_tjng`, `tahun_tjng`, `ttl_tnjngn`) VALUES
(50, 'P001', '3', '2022', '25000.00'),
(51, 'P001', '4', '2022', '25000.00'),
(52, 'P003', '3', '2022', '25000.00'),
(53, 'P004', '3', '2022', '50000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tunjangan`
--

CREATE TABLE `tbl_tunjangan` (
  `id_tunjangan` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `tgl_tnjngn` varchar(50) NOT NULL,
  `periode_tjn` varchar(50) NOT NULL,
  `tahun_tjn` varchar(50) NOT NULL,
  `tnjngn_jabatan` varchar(50) NOT NULL,
  `jml_tnjngn_jbtn` decimal(22,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tunjangan`
--

INSERT INTO `tbl_tunjangan` (`id_tunjangan`, `id_pegawai`, `tgl_tnjngn`, `periode_tjn`, `tahun_tjn`, `tnjngn_jabatan`, `jml_tnjngn_jbtn`) VALUES
('TNJ001', 'P001', '2022-03-08', '3', '2022', 'Kepala Sekolah', '25000.00'),
('TNJ002', 'P001', '2022-04-08', '4', '2022', 'Kepala Sekolah', '25000.00'),
('TNJ003', 'P003', '2022-03-09', '3', '2022', 'Pembina Kesenian', '25000.00'),
('TNJ004', 'P004', '2022-03-10', '3', '2022', 'Penjaga Sekolah', '50000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_pegawai`, `nama_user`, `username`, `password`, `level`) VALUES
('USR001', 'P001', 'Ravi', 'Ravi', '123456', 'Kepsek'),
('USR002', 'P002', '1234', '1234', '1234', 'Bendahara Komite'),
('USR003', 'P003', '', 'Natan', '1234', 'Guru'),
('USR004', 'P004', '', 'Yopi', '1234', 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_waktu`
--

CREATE TABLE `tbl_waktu` (
  `id_waktu` int(11) NOT NULL,
  `jam_mulau` varchar(50) NOT NULL,
  `jam_selesai` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `tbl_data_gaji`
--
ALTER TABLE `tbl_data_gaji`
  ADD PRIMARY KEY (`id_data_gaji`);

--
-- Indexes for table `tbl_golongan`
--
ALTER TABLE `tbl_golongan`
  ADD PRIMARY KEY (`id_gol`);

--
-- Indexes for table `tbl_kt`
--
ALTER TABLE `tbl_kt`
  ADD PRIMARY KEY (`id_kt`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tbl_potongan`
--
ALTER TABLE `tbl_potongan`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indexes for table `tbl_rekap_absen`
--
ALTER TABLE `tbl_rekap_absen`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Indexes for table `tbl_rekap_kehadiran`
--
ALTER TABLE `tbl_rekap_kehadiran`
  ADD PRIMARY KEY (`id_rekap_k`);

--
-- Indexes for table `tbl_rekap_kt`
--
ALTER TABLE `tbl_rekap_kt`
  ADD PRIMARY KEY (`id_rkt`);

--
-- Indexes for table `tbl_rekap_ptngn`
--
ALTER TABLE `tbl_rekap_ptngn`
  ADD PRIMARY KEY (`id_rp`);

--
-- Indexes for table `tbl_rekap_tunjangan`
--
ALTER TABLE `tbl_rekap_tunjangan`
  ADD PRIMARY KEY (`id_rt`);

--
-- Indexes for table `tbl_tunjangan`
--
ALTER TABLE `tbl_tunjangan`
  ADD PRIMARY KEY (`id_tunjangan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  ADD PRIMARY KEY (`id_waktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_data_gaji`
--
ALTER TABLE `tbl_data_gaji`
  MODIFY `id_data_gaji` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_golongan`
--
ALTER TABLE `tbl_golongan`
  MODIFY `id_gol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_rekap_absen`
--
ALTER TABLE `tbl_rekap_absen`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_rekap_kehadiran`
--
ALTER TABLE `tbl_rekap_kehadiran`
  MODIFY `id_rekap_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_rekap_kt`
--
ALTER TABLE `tbl_rekap_kt`
  MODIFY `id_rkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_rekap_ptngn`
--
ALTER TABLE `tbl_rekap_ptngn`
  MODIFY `id_rp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_rekap_tunjangan`
--
ALTER TABLE `tbl_rekap_tunjangan`
  MODIFY `id_rt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  MODIFY `id_waktu` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
