-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 05:51 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiddos_catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `id_detail_jadwal` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal_jadwal` date NOT NULL,
  `id_makanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`id_detail_jadwal`, `id_jadwal`, `tanggal_jadwal`, `id_makanan`) VALUES
(88, 7, '2020-06-01', 12),
(89, 7, '2020-06-02', 13),
(90, 7, '2020-06-03', 12),
(91, 7, '2020-06-04', 8),
(92, 7, '2020-06-05', 8),
(93, 7, '2020-06-08', 7),
(94, 7, '2020-06-09', 7),
(95, 7, '2020-06-10', 7),
(96, 7, '2020-06-11', 8),
(97, 7, '2020-06-12', 7),
(98, 7, '2020-06-15', 12),
(99, 7, '2020-06-16', 8),
(100, 7, '2020-06-17', 12),
(101, 7, '2020-06-18', 15),
(102, 7, '2020-06-19', 12),
(103, 7, '2020-06-22', 15),
(104, 7, '2020-06-23', 15),
(105, 7, '2020-06-24', 15),
(106, 7, '2020-06-25', 12),
(107, 7, '2020-06-26', 16),
(108, 7, '2020-06-29', 7),
(109, 7, '2020-06-30', 15),
(156, 10, '2020-01-01', 21),
(157, 10, '2020-01-02', 15),
(158, 10, '2020-01-03', 12),
(159, 10, '2020-01-06', 13),
(160, 10, '2020-01-07', 12),
(161, 10, '2020-01-08', 12),
(162, 10, '2020-01-09', 13),
(163, 10, '2020-01-10', 12),
(164, 10, '2020-01-13', 8),
(165, 10, '2020-01-14', 12),
(166, 10, '2020-01-15', 13),
(167, 10, '2020-01-16', 13),
(168, 10, '2020-01-17', 13),
(169, 10, '2020-01-20', 8),
(170, 10, '2020-01-21', 7),
(171, 10, '2020-01-22', 13),
(172, 10, '2020-01-23', 13),
(173, 10, '2020-01-24', 7),
(174, 10, '2020-01-27', 8),
(175, 10, '2020-01-28', 7),
(176, 10, '2020-01-29', 13),
(177, 10, '2020-01-30', 8),
(178, 10, '2020-01-31', 7),
(179, 11, '2020-10-01', 12),
(180, 11, '2020-10-02', 0),
(181, 11, '2020-10-05', 0),
(182, 11, '2020-10-06', 0),
(183, 11, '2020-10-07', 0),
(184, 11, '2020-10-08', 0),
(185, 11, '2020-10-09', 0),
(186, 11, '2020-10-12', 0),
(187, 11, '2020-10-13', 0),
(188, 11, '2020-10-14', 0),
(189, 11, '2020-10-15', 0),
(190, 11, '2020-10-16', 0),
(191, 11, '2020-10-19', 0),
(192, 11, '2020-10-20', 0),
(193, 11, '2020-10-21', 0),
(194, 11, '2020-10-22', 0),
(195, 11, '2020-10-23', 0),
(196, 11, '2020-10-26', 0),
(197, 11, '2020-10-27', 0),
(198, 11, '2020-10-28', 0),
(199, 11, '2020-10-29', 0),
(200, 11, '2020-10-30', 0),
(201, 12, '2020-02-03', 8),
(202, 12, '2020-02-04', 7),
(203, 12, '2020-02-05', 12),
(204, 12, '2020-02-06', 12),
(205, 12, '2020-02-07', 8),
(206, 12, '2020-02-10', 0),
(207, 12, '2020-02-11', 0),
(208, 12, '2020-02-12', 0),
(209, 12, '2020-02-13', 12),
(210, 12, '2020-02-14', 0),
(211, 12, '2020-02-17', 0),
(212, 12, '2020-02-18', 0),
(213, 12, '2020-02-19', 0),
(214, 12, '2020-02-20', 0),
(215, 12, '2020-02-21', 0),
(216, 12, '2020-02-24', 0),
(217, 12, '2020-02-25', 0),
(218, 12, '2020-02-26', 0),
(219, 12, '2020-02-27', 0),
(220, 12, '2020-02-28', 0),
(221, 13, '2020-05-01', 8),
(222, 13, '2020-05-04', 0),
(223, 13, '2020-05-05', 0),
(224, 13, '2020-05-06', 0),
(225, 13, '2020-05-07', 0),
(226, 13, '2020-05-08', 8),
(227, 13, '2020-05-11', 0),
(228, 13, '2020-05-12', 0),
(229, 13, '2020-05-13', 0),
(230, 13, '2020-05-14', 0),
(231, 13, '2020-05-15', 0),
(232, 13, '2020-05-18', 0),
(233, 13, '2020-05-19', 0),
(234, 13, '2020-05-20', 0),
(235, 13, '2020-05-21', 0),
(236, 13, '2020-05-22', 0),
(237, 13, '2020-05-25', 0),
(238, 13, '2020-05-26', 0),
(239, 13, '2020-05-27', 0),
(240, 13, '2020-05-28', 0),
(241, 13, '2020-05-29', 0),
(242, 14, '2020-07-01', 8),
(243, 14, '2020-07-02', 21),
(244, 14, '2020-07-03', 16),
(245, 14, '2020-07-06', 14),
(246, 14, '2020-07-07', 15),
(247, 14, '2020-07-08', 21),
(248, 14, '2020-07-09', 16),
(249, 14, '2020-07-10', 18),
(250, 14, '2020-07-13', 14),
(251, 14, '2020-07-14', 8),
(252, 14, '2020-07-15', 16),
(253, 14, '2020-07-16', 16),
(254, 14, '2020-07-17', 13),
(255, 14, '2020-07-20', 7),
(256, 14, '2020-07-21', 8),
(257, 14, '2020-07-22', 12),
(258, 14, '2020-07-23', 13),
(259, 14, '2020-07-24', 14),
(260, 14, '2020-07-27', 15),
(261, 14, '2020-07-28', 12),
(262, 14, '2020-07-29', 7),
(263, 14, '2020-07-30', 12),
(264, 14, '2020-07-31', 13),
(265, 15, '2020-09-01', 16),
(266, 15, '2020-09-02', 12),
(267, 15, '2020-09-03', 18),
(268, 15, '2020-09-04', 14),
(269, 15, '2020-09-07', 21),
(270, 15, '2020-09-08', 16),
(271, 15, '2020-09-09', 13),
(272, 15, '2020-09-10', 14),
(273, 15, '2020-09-11', 21),
(274, 15, '2020-09-14', 7),
(275, 15, '2020-09-15', 12),
(276, 15, '2020-09-16', 16),
(277, 15, '2020-09-17', 8),
(278, 15, '2020-09-18', 15),
(279, 15, '2020-09-21', 21),
(280, 15, '2020-09-22', 15),
(281, 15, '2020-09-23', 18),
(282, 15, '2020-09-24', 16),
(283, 15, '2020-09-25', 7),
(284, 15, '2020-09-28', 15),
(285, 15, '2020-09-29', 16),
(286, 15, '2020-09-30', 16),
(287, 16, '2021-06-01', 0),
(288, 16, '2021-06-02', 0),
(289, 16, '2021-06-03', 0),
(290, 16, '2021-06-04', 0),
(291, 16, '2021-06-07', 0),
(292, 16, '2021-06-08', 0),
(293, 16, '2021-06-09', 0),
(294, 16, '2021-06-10', 0),
(295, 16, '2021-06-11', 0),
(296, 16, '2021-06-14', 0),
(297, 16, '2021-06-15', 0),
(298, 16, '2021-06-16', 12),
(299, 16, '2021-06-17', 0),
(300, 16, '2021-06-18', 0),
(301, 16, '2021-06-21', 0),
(302, 16, '2021-06-22', 0),
(303, 16, '2021-06-23', 15),
(304, 16, '2021-06-24', 0),
(305, 16, '2021-06-25', 0),
(306, 16, '2021-06-28', 0),
(307, 16, '2021-06-29', 0),
(308, 16, '2021-06-30', 0),
(309, 17, '2021-05-03', 0),
(310, 17, '2021-05-04', 0),
(311, 17, '2021-05-05', 0),
(312, 17, '2021-05-06', 0),
(313, 17, '2021-05-07', 0),
(314, 17, '2021-05-10', 0),
(315, 17, '2021-05-11', 0),
(316, 17, '2021-05-12', 8),
(317, 17, '2021-05-13', 0),
(318, 17, '2021-05-14', 0),
(319, 17, '2021-05-17', 0),
(320, 17, '2021-05-18', 0),
(321, 17, '2021-05-19', 0),
(322, 17, '2021-05-20', 0),
(323, 17, '2021-05-21', 0),
(324, 17, '2021-05-24', 0),
(325, 17, '2021-05-25', 0),
(326, 17, '2021-05-26', 0),
(327, 17, '2021-05-27', 0),
(328, 17, '2021-05-28', 0),
(329, 17, '2021-05-31', 0),
(330, 18, '2021-07-01', 8),
(331, 18, '2021-07-02', 12),
(332, 18, '2021-07-05', 0),
(333, 18, '2021-07-06', 0),
(334, 18, '2021-07-07', 0),
(335, 18, '2021-07-08', 0),
(336, 18, '2021-07-09', 0),
(337, 18, '2021-07-12', 0),
(338, 18, '2021-07-13', 0),
(339, 18, '2021-07-14', 0),
(340, 18, '2021-07-15', 0),
(341, 18, '2021-07-16', 0),
(342, 18, '2021-07-19', 15),
(343, 18, '2021-07-20', 15),
(344, 18, '2021-07-21', 16),
(345, 18, '2021-07-22', 18),
(346, 18, '2021-07-23', 16),
(347, 18, '2021-07-26', 0),
(348, 18, '2021-07-27', 0),
(349, 18, '2021-07-28', 0),
(350, 18, '2021-07-29', 0),
(351, 18, '2021-07-30', 0),
(352, 19, '2021-08-02', 8),
(353, 19, '2021-08-03', 12),
(354, 19, '2021-08-04', 18),
(355, 19, '2021-08-05', 13),
(356, 19, '2021-08-06', 16),
(357, 19, '2021-08-09', 14),
(358, 19, '2021-08-10', 15),
(359, 19, '2021-08-11', 16),
(360, 19, '2021-08-12', 18),
(361, 19, '2021-08-13', 18),
(362, 19, '2021-08-16', 15),
(363, 19, '2021-08-17', 16),
(364, 19, '2021-08-18', 18),
(365, 19, '2021-08-19', 21),
(366, 19, '2021-08-20', 8),
(367, 19, '2021-08-23', 7),
(368, 19, '2021-08-24', 14),
(369, 19, '2021-08-25', 15),
(370, 19, '2021-08-26', 18),
(371, 19, '2021-08-27', 21),
(372, 19, '2021-08-30', 14),
(373, 19, '2021-08-31', 7);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id` int(11) NOT NULL,
  `no_pemesanan` varchar(225) NOT NULL,
  `tgl_detail` date NOT NULL,
  `pesan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `no_pemesanan`, `tgl_detail`, `pesan`) VALUES
(686, 'PSNJUN-20-1747912547', '2020-06-26', 'ps'),
(687, 'PSNJUN-20-1797912547', '2020-06-29', 'p'),
(688, 'PSNJUN-20-1797912547', '2020-06-30', 'p'),
(689, 'PSNJUN-20-1747912547', '2020-06-30', 'p'),
(691, 'PSNJUN-20-1747912547', '2020-06-29', 's'),
(692, 'PSNJUN-20-1797912547', '2020-06-26', 'ps'),
(874, 'PSNJUL-20-735819269', '2020-07-06', 'p'),
(875, 'PSNJUL-20-735819269', '2020-07-07', 'p'),
(876, 'PSNJUL-20-735819269', '2020-07-08', 'p'),
(877, 'PSNJUL-20-735819269', '2020-07-09', 's'),
(878, 'PSNJUL-20-735819269', '2020-07-10', 'p'),
(879, 'PSNJUL-20-735819269', '2020-07-13', 'p'),
(880, 'PSNJUL-20-735819269', '2020-07-14', 'p'),
(881, 'PSNJUL-20-735819269', '2020-07-15', 'p'),
(882, 'PSNJUL-20-735819269', '2020-07-16', 'p'),
(883, 'PSNJUL-20-735819269', '2020-07-17', 'p'),
(884, 'PSNJUL-20-735819269', '2020-07-20', 's'),
(885, 'PSNJUL-20-735819269', '2020-07-21', 's'),
(886, 'PSNJUL-20-735819269', '2020-07-22', 's'),
(887, 'PSNJUL-20-735819269', '2020-07-23', 'p'),
(888, 'PSNJUL-20-735819269', '2020-07-24', 'p'),
(889, 'PSNJUL-20-735819269', '2020-07-27', 'p'),
(890, 'PSNJUL-20-735819269', '2020-07-28', 'p'),
(891, 'PSNJUL-20-735819269', '2020-07-29', 'p'),
(892, 'PSNJUL-20-735819269', '2020-07-30', 'p'),
(893, 'PSNJUL-20-735819269', '2020-07-31', 'p'),
(921, 'PSNMEI-21-162400860', '2021-05-31', 's'),
(922, 'PSNMEI-21-1135760478', '2021-06-01', 's'),
(923, 'PSNMEI-21-1135760478', '2021-06-02', 'p'),
(924, 'PSNMEI-21-1135760478', '2021-06-03', 'p'),
(925, 'PSNMEI-21-1135760478', '2021-06-04', 'p'),
(926, 'PSNMEI-21-1135760478', '2021-06-07', 'p'),
(927, 'PSNMEI-21-1135760478', '2021-06-08', 's'),
(928, 'PSNMEI-21-1135760478', '2021-06-09', 'p'),
(929, 'PSNMEI-21-1135760478', '2021-06-10', 'p'),
(930, 'PSNMEI-21-1135760478', '2021-06-11', 'p'),
(931, 'PSNMEI-21-1135760478', '2021-06-14', 'p'),
(932, 'PSNMEI-21-1135760478', '2021-06-15', 's'),
(933, 'PSNMEI-21-1135760478', '2021-06-16', 'p'),
(934, 'PSNMEI-21-1135760478', '2021-06-17', 'p'),
(935, 'PSNMEI-21-1135760478', '2021-06-18', 'p'),
(936, 'PSNMEI-21-1135760478', '2021-06-21', 'p'),
(937, 'PSNMEI-21-1135760478', '2021-06-22', 's'),
(938, 'PSNMEI-21-1135760478', '2021-06-23', 'p'),
(939, 'PSNMEI-21-1135760478', '2021-06-24', 'p'),
(940, 'PSNMEI-21-1135760478', '2021-06-25', 'p'),
(941, 'PSNMEI-21-1135760478', '2021-06-28', 'p'),
(942, 'PSNMEI-21-1135760478', '2021-06-29', 's'),
(943, 'PSNMEI-21-1135760478', '2021-06-30', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `ganti_menu`
--

CREATE TABLE `ganti_menu` (
  `id_ganti_menu` int(11) NOT NULL,
  `nis` varchar(128) NOT NULL,
  `id_makanan` int(11) NOT NULL,
  `id_makanan_pengganti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ganti_menu`
--

INSERT INTO `ganti_menu` (`id_ganti_menu`, `nis`, `id_makanan`, `id_makanan_pengganti`) VALUES
(7, '10201112', 16, 7),
(8, '1201161042', 14, 15),
(11, '10201112', 7, 16),
(12, '1201161042', 21, 16),
(13, '1201161042', 12, 16);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `bulan` varchar(55) NOT NULL,
  `tahun` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `bulan`, `tahun`) VALUES
(7, '06', '2020'),
(10, '01', '2020'),
(11, '10', '2020'),
(12, '02', '2020'),
(13, '05', '2020'),
(14, '07', '2020'),
(15, '09', '2020'),
(16, '06', '2021'),
(17, '05', '2021'),
(18, '07', '2021'),
(19, '08', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(115) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'ayam'),
(2, 'sapi'),
(3, 'seafood'),
(4, 'snack');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama_kelas` varchar(128) NOT NULL,
  `wali_kelas` varchar(128) NOT NULL,
  `kontak_wali_kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_sekolah`, `nama_kelas`, `wali_kelas`, `kontak_wali_kelas`) VALUES
(2, 4, '2 Hamzah', 'Umi Sofi', '087213456789'),
(19, 1, '3 Abdurahman', 'Bunda bunda', '0875359449377'),
(30, 2, 'Watermelon', 'Bunda Soleha', '08979289323'),
(48, 1, '1 Abu Bakar', 'Bunda Saar', '08977773232'),
(49, 1, '3 Abu Ubaidah', 'Bunda Soleha', '08977773232'),
(50, 3, 'Waterproof', 'Bunda Goib', '089777732322'),
(51, 5, '1', 'Ibu Juminah', '089777732322'),
(52, 1, '3 Abu Hurairah', 'Bunda Sarki', '089422323'),
(53, 1, '2 Bilal', 'Bunda Antum', '21321321321');

-- --------------------------------------------------------

--
-- Table structure for table `menu_makanan`
--

CREATE TABLE `menu_makanan` (
  `id_makanan` int(11) NOT NULL,
  `nama_makanan` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi_makanan` longtext NOT NULL,
  `image_makanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_makanan`
--

INSERT INTO `menu_makanan` (`id_makanan`, `nama_makanan`, `id_kategori`, `deskripsi_makanan`, `image_makanan`) VALUES
(7, 'Ayam Goreng Serundeng', 1, 'Ayam Bakar - Nasi - Capcay - Sambal', 'ayam_goreng_serundeng.jpg'),
(8, 'Ayam Opor', 1, 'Ayam opor - Nasi - Sayur Kacang - Gorengan - Sambal', 'ayam_opor.jpg'),
(12, 'Ayam Bakar', 1, 'Ayam Bakar - Nasi - Telur Balado - Sambal', 'ayam_bakar.jpg'),
(13, 'Ayam Rica-rica', 1, 'Ayam Rica - Nasi - Bakwan Udang - Sayur Sawi', 'ayam_rica-rica.jpg'),
(14, 'Ayam Kecap', 1, 'Ayam Kecap - Nasi - Sayur Buncis - Nugget', 'ayam_kecap.jpg'),
(15, 'Ayam Tepung', 1, 'Ayam Tepung - Nasi - Sayur Buncis - Kentang', 'ayam_tepung.jpg'),
(16, 'Telur Dadar', 0, 'Telur Dadar - Nasi - Jamur - Sambal', 'telur_dadar.jpg'),
(18, 'Sapi Lada Hitam', 2, 'Sapi lada hitam - Nasi - Capcay', 'sapi_lada_hitam.jpg'),
(20, 'Udang goreng tepung', 3, 'Udang goreng tepung - nasi - sayur buncis - saus mayo', 'udang_goreng_tepung.jpeg'),
(21, 'Spaghetti', 4, 'Spaghetti - Ayam Fillet - Sayur', 'spaghetti.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` varchar(225) NOT NULL,
  `nis` int(11) NOT NULL,
  `jenis_pembayaran` varchar(128) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `va_number` varchar(128) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `tanggal_dibayar` datetime NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `instruksi` varchar(255) NOT NULL,
  `status_pemesanan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `nis`, `jenis_pembayaran`, `bank`, `va_number`, `total_bayar`, `tanggal_dibuat`, `tanggal_dibayar`, `tanggal_mulai`, `instruksi`, `status_pemesanan`) VALUES
('PSNAPR\r\n-21-1080029826', 1201161042, 'bank_transfer', 'bca', '36702837647', 12000, '2021-04-29 11:53:16', '2021-04-29 12:58:17', '0000-00-00', 'https://app.sandbox.midtrans.com/snap/v1/transactions/8a4cbb85-b10b-4c2b-9551-0d1d9ee10a2a/pdf', 'settlement'),
('PSNJUL-20-735819269', 1201161042, 'bank_transfer', 'bca', '36702923550', 240000, '2020-07-04 06:26:33', '2020-07-04 06:40:32', '2020-07-06', 'https://app.sandbox.midtrans.com/snap/v1/transactions/3f8dabcd-63a0-475c-a6a6-cfa7df9bade7/pdf', 'settlement'),
('PSNJUL-21-1270980211', 1201161042, 'bank_transfer', 'bca', '36702108843', 264000, '2021-07-18 13:50:41', '0000-00-00 00:00:00', '2021-09-01', 'https://app.sandbox.midtrans.com/snap/v1/transactions/515463db-0d63-4196-b196-5822b09804c3/pdf', 'cancel'),
('PSNJUL-21-1454728802', 1201161042, 'bank_transfer', 'bca', '36702850478', 72000, '2021-07-22 13:23:08', '0000-00-00 00:00:00', '2021-07-23', 'https://app.sandbox.midtrans.com/snap/v1/transactions/6500d294-b829-4849-8c87-9f6a24a289e5/pdf', 'cancel'),
('PSNJUL-21-1988412979', 1201161042, 'bank_transfer', 'bca', '36702932771', 264000, '2021-07-18 13:47:54', '0000-00-00 00:00:00', '2021-08-02', 'https://app.sandbox.midtrans.com/snap/v1/transactions/9fe1622d-88b5-48ee-948c-8e10d1f29ed5/pdf', 'cancel'),
('PSNJUL-21-302237237', 1201161042, 'bank_transfer', 'bca', '36702858410', 264000, '2021-07-22 13:19:35', '0000-00-00 00:00:00', '2021-08-02', 'https://app.sandbox.midtrans.com/snap/v1/transactions/e4c8d968-231e-46be-b003-5115629da73b/pdf', 'cancel'),
('PSNJUN-20-1747912547', 10201112, 'bank_transfer', 'bca', '36702477281', 36000, '2020-06-25 06:56:18', '2020-06-25 07:07:25', '2020-06-26', 'https://app.sandbox.midtrans.com/snap/v1/transactions/e9f855ca-b396-45ed-9cc3-3ee7dfe6cced/pdf', 'settlement'),
('PSNJUN-20-1797912547', 1201161042, 'bank_transfer', 'bca', '36702477289', 36000, '2020-06-25 06:56:18', '2020-06-25 07:07:25', '2020-06-26', 'https://app.sandbox.midtrans.com/snap/v1/transactions/e9f855ca-b396-45ed-9cc3-3ee7dfe6cced/pdf', 'settlement'),
('PSNMEI-21-1135760478', 1201161042, 'bank_transfer', 'bca', '36702106080', 264000, '2021-05-29 22:06:33', '2021-05-29 22:08:35', '2021-06-01', 'https://app.sandbox.midtrans.com/snap/v1/transactions/59274b68-32c2-4f58-807c-eb8d8e545d62/pdf', 'settlement'),
('PSNMEI-21-1517853889', 1201161042, 'bank_transfer', 'bca', '36702247702', 12000, '2021-05-29 11:44:49', '0000-00-00 00:00:00', '2021-05-31', 'https://app.sandbox.midtrans.com/snap/v1/transactions/59a72ac0-6aea-45d9-ad81-b1beaea79ef4/pdf', 'cancel'),
('PSNMEI-21-1543942166', 1201161042, 'bank_transfer', 'bca', '36702550054', 60000, '2021-05-24 20:44:28', '0000-00-00 00:00:00', '2021-05-25', 'https://app.sandbox.midtrans.com/snap/v1/transactions/48a922af-99dd-4c35-b87c-74f8cb6adf71/pdf', 'expire'),
('PSNMEI-21-162400860', 1201161042, 'bank_transfer', 'bca', '36702810920', 12000, '2021-05-29 21:45:16', '2021-05-29 21:57:19', '2021-05-31', 'https://app.sandbox.midtrans.com/snap/v1/transactions/8e7d618f-d4b9-45ca-bbee-7ad75a01702d/pdf', 'settlement'),
('PSNMEI-21-395502385', 1201161042, 'bank_transfer', 'bca', '36702773475', 264000, '2021-05-29 23:10:04', '0000-00-00 00:00:00', '2021-07-01', 'https://app.sandbox.midtrans.com/snap/v1/transactions/1825d405-dadc-4094-a3e4-465fc87d8811/pdf', 'expire'),
('PSNNOV-20-1685973721', 1201161042, 'bank_transfer', 'bca', '36702052031', 12000, '2020-11-28 15:13:19', '0000-00-00 00:00:00', '2020-11-30', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f0c4ada3-1e77-4f49-b2bf-944e78062845/pdf', 'expire'),
('PSNSEP-20-254693773', 1201161042, 'bank_transfer', 'bca', '36702538059', 144000, '2020-09-14 18:34:36', '0000-00-00 00:00:00', '2020-09-15', 'https://app.sandbox.midtrans.com/snap/v1/transactions/254820e6-eab0-4b7e-8a9f-c33a6db18ad1/pdf', 'expire');

--
-- Triggers `pemesanan`
--
DELIMITER $$
CREATE TRIGGER `delete` AFTER DELETE ON `pemesanan` FOR EACH ROW BEGIN

 DELETE FROM detail_pemesanan WHERE detail_pemesanan.no_pemesanan = old.no_pemesanan;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status_pemesanan` AFTER UPDATE ON `pemesanan` FOR EACH ROW BEGIN

 IF NEW.status_pemesanan = 'expire' OR NEW.status_pemesanan = 'cancel' THEN
	 DELETE FROM detail_pemesanan WHERE detail_pemesanan.no_pemesanan = old.no_pemesanan;
 END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(128) NOT NULL,
  `alamat_sekolah` varchar(128) NOT NULL,
  `kontak_sekolah` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`, `kontak_sekolah`) VALUES
(1, 'SDIT Khalifa Kota Serang', 'Ciracas', '08999992922'),
(2, 'TK Daarul Jannah', 'Benggala', '08989829892'),
(3, 'TK Zahira', 'Kaujon', '08989289820'),
(4, 'Yayasan Albantany', 'Sayabulu', '08989289820'),
(5, 'SDN 3 Kota Serang', 'Ciceri', '08989898299');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat_siswa` varchar(128) NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `account_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `image`, `nama_siswa`, `id_kelas`, `alamat_siswa`, `jk`, `account_id`, `password`) VALUES
('10201112', '', 'Muhamad Rizkiee', 48, 'Benggala', 'laki-laki', 19, ''),
('1201161041', '', 'Muhamad rizki', 19, 'Benggala', 'laki-laki', 0, ''),
('1201161042', '2.jpg', 'Rendy Pandugong', 49, 'Benggalaa', 'laki-laki', 16, '$2y$10$sDBJohJgWr5Uq16VwQYhbOght.0bGKVeepLfpofuqYLMyUOswAPwa'),
('12011610422', '', 'Rex Savior', 48, 'Benggala', 'perempuan', 20, ''),
('1201161044', '', 'Rindu Kaamo', 2, 'Benggalaa', 'laki-laki', 0, ''),
('1201161049', '', 'Marsekantuy', 19, 'tes', 'perempuan', 0, ''),
('1201161054', '', 'Muhamad Sulhi', 48, 'Benggala', 'laki-laki', 0, ''),
('1234567', '', 'Stain tes', 52, 'Benggalaa', 'laki-laki', 0, '$2y$10$vxw5fPOtSR.hCTIBRupvy.nMGcSwPWOhcBjz6lj1NphI23GOK0KFq'),
('6767', '', 'Muhamad Rizkii', 30, 'Benggalaa', 'laki-laki', 0, ''),
('676723', '', 'Muhamad Rizkii', 48, 'Ciceri', 'laki-laki', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` int(11) NOT NULL,
  `no_pemesanan` int(11) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `total_bayar` varchar(128) NOT NULL,
  `status_transaksi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `aktif` int(1) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `no_hp`, `image`, `password`, `role_id`, `aktif`, `tgl_dibuat`) VALUES
(2, 'Miss Rae Koch', 'rae@gmail.com', '0895359449372', '20190706-redvelvetjpg.jpg', '$2y$10$DbvPvN0Rxow/hhWsPvfNJe.8MqAM6RNCFf4yM/2PKJrysK37x7r5e', 1, 1, 1584367630),
(7, 'Audrey Hepburn', 'audrey@gmail.com', '1234567891012', 'default.png', '$2y$10$7/i82.tRiCHLePXegfN4gedpVVAYVpCl4EZ9.RVrE963uO4yz.HY.', 1, 0, 1584943180),
(12, 'Muhamad Rizkii', 'rizkyzetzet1212@gmail.com', '0895359449377', 'default.png', 'qwer121', 1, 0, 1589733235),
(13, 'Muhamad Rizkii', 'rizkyzetzet1212222@gmail.com', '0895359449377', 'default.png', '$2y$10$xz/c1h7WJS83nq0/pszHledb7UqJOATSVo2djUX8lRyHGlGj7/7E6', 1, 0, 1589733351),
(16, 'Muhamad Rizkiii', 'rizkyzetzet121@gmail.com', '08953594493772', '.jpg', '$2y$10$cxF4ie8h9s.CXTdkrpyrDeuVv9ADEVd/YPL6TzjlY559/KTriAYAS', 1, 1, 1589793229),
(19, 'Zae Awat', 'zaeawat@gmail.com', '08956567823', 'default.png', '$2y$10$8p6lRasDZtIi1G/IK0UKbecc6TtvoxQENR3MSvCGenhZ0wlwwWKUC', 1, 1, 1592456648),
(20, 'Ghamal Hizall', 'ghamal.hizal@gmail.com', '0895359449372', '1.jpg', '$2y$10$F7Utf9.UKcuVGAQ1lBEQdOysuGmQ0XphPIiDSklEaA/QUE1orNAoC', 7, 1, 1606553124),
(22, 'Derry Sulaiman', 'derry@gmail.com', '08953594493777', 'default.png', '$2y$10$b8kuEDlOLH7Df1EJfpTFhOk18y59hG0h7Hg/n96BMriKmuJsgiHaK', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Pelanggan'),
(7, 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `tgl_dibuat`) VALUES
(13, 'zaeawat@gmail.com', 'CqVJVHK/B8Ka2nfvpPFhMSsIEnu5QWlLPzU3B1vMVtk=', 1592456136),
(14, 'zaeawat@gmail.com', 'DC3ljwp7whD5pWCCaMlbhe758JnYd5I236PmXV+/UdU=', 1592456416),
(15, 'zaeawat@gmail.com', 'DjNZ5SwM+k1Ah8Gsp610BMpY2r8VfVrKNU2EJgXS8LE=', 1592456648);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`id_detail_jadwal`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ganti_menu`
--
ALTER TABLE `ganti_menu`
  ADD PRIMARY KEY (`id_ganti_menu`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `menu_makanan`
--
ALTER TABLE `menu_makanan`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pemesanan`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `id_detail_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `ganti_menu`
--
ALTER TABLE `ganti_menu`
  MODIFY `id_ganti_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `menu_makanan`
--
ALTER TABLE `menu_makanan`
  MODIFY `id_makanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
