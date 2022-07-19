-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 10:37 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujikom_11505143`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_pelanggan`
--
CREATE TABLE IF NOT EXISTS `query_pelanggan` (
`id_pelanggan` varchar(7)
,`no_meter` varchar(12)
,`nama` varchar(50)
,`password` varchar(50)
,`alamat` text
,`tgl_daftar` date
,`id_tarif` varchar(7)
,`daya` int(5)
,`tarif_per_kwh` int(7)
,`denda_keterlambatan` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_pembayaran`
--
CREATE TABLE IF NOT EXISTS `query_pembayaran` (
`id_pembayaran` varchar(15)
,`id_tagihan` varchar(7)
,`id_pelanggan` varchar(7)
,`no_meter` varchar(12)
,`nama` varchar(50)
,`alamat` text
,`tgl_daftar` date
,`id_tarif` varchar(7)
,`daya` int(5)
,`tarif_per_kwh` int(7)
,`denda_keterlambatan` int(10)
,`bulan` int(2)
,`tahun` int(4)
,`jumlah_meter` int(7)
,`total_tagihan` int(10)
,`tgl_bayar` date
,`total_denda` int(10)
,`biaya_admin` int(5)
,`total_pembayaran` int(10)
,`atas_nama` varchar(50)
,`no_rekening` int(20)
,`bukti_pembayaran` varchar(100)
,`status` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_penggunaan`
--
CREATE TABLE IF NOT EXISTS `query_penggunaan` (
`id_penggunaan` varchar(7)
,`id_pelanggan` varchar(7)
,`no_meter` varchar(12)
,`nama` varchar(50)
,`alamat` text
,`bulan` int(2)
,`tahun` int(4)
,`meter_awal` int(7)
,`meter_akhir` int(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_tagihan`
--
CREATE TABLE IF NOT EXISTS `query_tagihan` (
`id_tagihan` varchar(7)
,`id_pelanggan` varchar(7)
,`no_meter` varchar(12)
,`nama` varchar(50)
,`alamat` text
,`bulan` int(2)
,`tahun` int(4)
,`jumlah_meter` int(7)
,`total_tagihan` int(10)
,`status` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` varchar(7) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `password`) VALUES
('AM00001', 'Raka', '123'),
('AM00002', 'Igun', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` varchar(7) NOT NULL,
  `no_meter` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_daftar` date NOT NULL,
  `id_tarif` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `no_meter`, `nama`, `password`, `alamat`, `tgl_daftar`, `id_tarif`) VALUES
('PN00003', '00000000003', 'Zulfikar', '123', 'Jl. Batutulis Gg. Balekambang Rt. 07 Rw. 02 No. 21 Kec. Bogor Selatan, Kota Bogor, Jawa Barat', '2018-01-08', 'TF00003');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `id_pembayaran` varchar(15) NOT NULL,
  `id_tagihan` varchar(7) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `denda_keterlambatan` int(10) NOT NULL,
  `biaya_admin` int(5) NOT NULL,
  `total_pembayaran` int(10) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `no_rekening` int(20) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_tagihan`, `tanggal`, `denda_keterlambatan`, `biaya_admin`, `total_pembayaran`, `atas_nama`, `no_rekening`, `bukti_pembayaran`, `status`) VALUES
('PM2018020415103', 'TN00001', '2018-02-04', 3000, 2000, 148175, '148175Mukhlis', 1062741061, 'transfer_mandiri1.jpg', '-'),
('PM2018020415302', 'TN00002', '0000-00-00', 0, 2000, 141855, 'mukhlis', 2147483647, 'transfer_mandiri1.jpg', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penggunaan`
--

CREATE TABLE IF NOT EXISTS `tbl_penggunaan` (
  `id_penggunaan` varchar(7) NOT NULL,
  `id_pelanggan` varchar(7) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `meter_awal` int(7) NOT NULL,
  `meter_akhir` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penggunaan`
--

INSERT INTO `tbl_penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
('PG00001', 'PG00001', 12, 2017, 0, 345),
('PG00002', 'PG00001', 1, 2018, 345, 682),
('PG00003', 'PN00003', 2, 2018, 0, 12302);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tagihan`
--

CREATE TABLE IF NOT EXISTS `tbl_tagihan` (
  `id_tagihan` varchar(7) NOT NULL,
  `id_penggunaan` varchar(7) NOT NULL,
  `id_pelanggan` varchar(7) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_meter` int(7) NOT NULL,
  `total_tagihan` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tagihan`
--

INSERT INTO `tbl_tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `total_tagihan`, `status`) VALUES
('TN00003', 'PG00003', 'PN00003', 1, 2018, 340, 144000, '-'),
('TN00004', 'PG00004', 'PN00003', 2, 2018, 415, 187000, 'Belum'),
('TN00003', 'PG00003', 'PN00003', 2, 2018, 12302, 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tarif`
--

CREATE TABLE IF NOT EXISTS `tbl_tarif` (
  `id_tarif` varchar(7) NOT NULL,
  `daya` int(5) NOT NULL,
  `tarif_per_kwh` int(7) NOT NULL,
  `denda_keterlambatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tarif`
--

INSERT INTO `tbl_tarif` (`id_tarif`, `daya`, `tarif_per_kwh`, `denda_keterlambatan`) VALUES
('TF00001', 450, 415, 3000),
('TF00002', 900, 1350, 3000),
('TF00003', 1300, 1350, 5000),
('TF00004', 2200, 1350, 10000),
('TF00005', 900, 12000, 1000);

-- --------------------------------------------------------

--
-- Structure for view `query_pelanggan`
--
DROP TABLE IF EXISTS `query_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_pelanggan` AS select `tbl_pelanggan`.`id_pelanggan` AS `id_pelanggan`,`tbl_pelanggan`.`no_meter` AS `no_meter`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`password` AS `password`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`tgl_daftar` AS `tgl_daftar`,`tbl_pelanggan`.`id_tarif` AS `id_tarif`,`tbl_tarif`.`daya` AS `daya`,`tbl_tarif`.`tarif_per_kwh` AS `tarif_per_kwh`,`tbl_tarif`.`denda_keterlambatan` AS `denda_keterlambatan` from (`tbl_pelanggan` join `tbl_tarif` on((`tbl_pelanggan`.`id_tarif` = `tbl_tarif`.`id_tarif`)));

-- --------------------------------------------------------

--
-- Structure for view `query_pembayaran`
--
DROP TABLE IF EXISTS `query_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_pembayaran` AS select `tbl_pembayaran`.`id_pembayaran` AS `id_pembayaran`,`tbl_pembayaran`.`id_tagihan` AS `id_tagihan`,`tbl_tagihan`.`id_pelanggan` AS `id_pelanggan`,`tbl_pelanggan`.`no_meter` AS `no_meter`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`tgl_daftar` AS `tgl_daftar`,`tbl_pelanggan`.`id_tarif` AS `id_tarif`,`tbl_tarif`.`daya` AS `daya`,`tbl_tarif`.`tarif_per_kwh` AS `tarif_per_kwh`,`tbl_tarif`.`denda_keterlambatan` AS `denda_keterlambatan`,`tbl_tagihan`.`bulan` AS `bulan`,`tbl_tagihan`.`tahun` AS `tahun`,`tbl_tagihan`.`jumlah_meter` AS `jumlah_meter`,`tbl_tagihan`.`total_tagihan` AS `total_tagihan`,`tbl_pembayaran`.`tanggal` AS `tgl_bayar`,`tbl_pembayaran`.`denda_keterlambatan` AS `total_denda`,`tbl_pembayaran`.`biaya_admin` AS `biaya_admin`,`tbl_pembayaran`.`total_pembayaran` AS `total_pembayaran`,`tbl_pembayaran`.`atas_nama` AS `atas_nama`,`tbl_pembayaran`.`no_rekening` AS `no_rekening`,`tbl_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`,`tbl_pembayaran`.`status` AS `status` from (((`tbl_pembayaran` join `tbl_tagihan` on((`tbl_pembayaran`.`id_tagihan` = `tbl_tagihan`.`id_tagihan`))) join `tbl_pelanggan` on((`tbl_tagihan`.`id_pelanggan` = `tbl_pelanggan`.`id_pelanggan`))) join `tbl_tarif` on((`tbl_pelanggan`.`id_tarif` = `tbl_tarif`.`id_tarif`)));

-- --------------------------------------------------------

--
-- Structure for view `query_penggunaan`
--
DROP TABLE IF EXISTS `query_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_penggunaan` AS select `tbl_penggunaan`.`id_penggunaan` AS `id_penggunaan`,`tbl_penggunaan`.`id_pelanggan` AS `id_pelanggan`,`tbl_pelanggan`.`no_meter` AS `no_meter`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_penggunaan`.`bulan` AS `bulan`,`tbl_penggunaan`.`tahun` AS `tahun`,`tbl_penggunaan`.`meter_awal` AS `meter_awal`,`tbl_penggunaan`.`meter_akhir` AS `meter_akhir` from (`tbl_penggunaan` join `tbl_pelanggan` on((`tbl_penggunaan`.`id_pelanggan` = `tbl_pelanggan`.`id_pelanggan`)));

-- --------------------------------------------------------

--
-- Structure for view `query_tagihan`
--
DROP TABLE IF EXISTS `query_tagihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_tagihan` AS select `tbl_tagihan`.`id_tagihan` AS `id_tagihan`,`tbl_tagihan`.`id_pelanggan` AS `id_pelanggan`,`tbl_pelanggan`.`no_meter` AS `no_meter`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_tagihan`.`bulan` AS `bulan`,`tbl_tagihan`.`tahun` AS `tahun`,`tbl_tagihan`.`jumlah_meter` AS `jumlah_meter`,`tbl_tagihan`.`total_tagihan` AS `total_tagihan`,`tbl_tagihan`.`status` AS `status` from (`tbl_tagihan` join `tbl_pelanggan` on((`tbl_tagihan`.`id_pelanggan` = `tbl_pelanggan`.`id_pelanggan`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  ADD PRIMARY KEY (`id_tarif`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
