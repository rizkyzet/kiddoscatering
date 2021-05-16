-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 04:52 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id` int(11) NOT NULL,
  `no_pemesanan` int(11) NOT NULL,
  `tgl_detail` date NOT NULL,
  `pesan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `no_pemesanan`, `tgl_detail`, `pesan`) VALUES
(317, 416585934, '2020-05-28', 's'),
(318, 416585934, '2020-05-29', 'ps'),
(319, 1879216169, '2020-05-29', 'ps'),
(320, 1165401848, '2020-05-29', 's'),
(321, 396052506, '2020-05-29', 's');

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
(51, 5, '1', 'Ibu Juminah', '089777732322');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_pembayaran` varchar(128) NOT NULL,
  `no_pemesanan` varchar(128) NOT NULL,
  `jenis_pembayaran` varchar(128) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `va_number` varchar(128) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `instruksi` varchar(255) NOT NULL,
  `status_pembayaran` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_pembayaran`, `no_pemesanan`, `jenis_pembayaran`, `bank`, `va_number`, `total_bayar`, `tanggal_dibuat`, `instruksi`, `status_pembayaran`) VALUES
('1843225190', '1165401848', 'bank_transfer', 'bca', '36702296008', 12000, '2020-05-28 14:31:39', 'https://app.sandbox.midtrans.com/snap/v1/transactions/28a8d244-f5d1-44a3-9177-a9bd627713c8/pdf', 'cancel'),
('1852947970', '1879216169', 'bank_transfer', 'bca', '36702414869', 24000, '2020-05-28 14:29:00', 'https://app.sandbox.midtrans.com/snap/v1/transactions/84f35f60-37ea-4a82-a8f0-64b21d2034ab/pdf', 'expired'),
('1992075679', '396052506', 'bank_transfer', 'bca', '36702325848', 12000, '2020-05-28 16:43:57', 'https://app.sandbox.midtrans.com/snap/v1/transactions/61af4398-4826-41f4-a183-345096599196/pdf', 'settlement'),
('901719624', '416585934', 'bank_transfer', 'bca', '36702347557', 36000, '2020-05-27 16:31:36', 'https://app.sandbox.midtrans.com/snap/v1/transactions/2b722723-daf9-47c7-bb48-56ba33a30081/pdf', 'expired');

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `status_expired` AFTER UPDATE ON `pembayaran` FOR EACH ROW BEGIN

 IF NEW.status_pembayaran = 'expired' OR NEW.status_pembayaran = 'cancel' THEN
	 DELETE FROM pemesanan WHERE pemesanan.no_pemesanan = new.no_pemesanan;
 END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status_settlement` AFTER UPDATE ON `pembayaran` FOR EACH ROW BEGIN

 IF NEW.status_pembayaran = 'settlement' THEN
	 UPDATE pemesanan SET pemesanan.status = 1
	 WHERE no_pemesanan = NEW.no_pemesanan;
 END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `tgl_mulai` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `nis`, `tgl_pesan`, `tgl_mulai`, `status`) VALUES
(396052506, 1201161042, '2020-05-28', '2020-05-29', 1);

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
  `nama_siswa` varchar(128) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat_siswa` varchar(128) NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `id_kelas`, `alamat_siswa`, `jk`, `account_id`) VALUES
('1020111111', 'tes', 19, 'Benggalaa', 'laki-laki', 0),
('10201112', 'Muhamad Rizkiee', 19, 'Benggala', 'laki-laki', 0),
('1201161041', 'Muhamad rizki', 19, 'Benggala', 'laki-laki', 0),
('1201161042', 'Rendy Pandugong', 19, 'Benggala', 'laki-laki', 16),
('1201161044', 'Rindu Kaamo', 2, 'Benggalaa', 'laki-laki', 0),
('1201161049', 'Marsekantuy', 19, 'tes', 'perempuan', 0),
('6767', 'Muhamad Rizkii', 30, 'Benggalaa', 'laki-laki', 0),
('676723', 'Muhamad Rizkii', 48, 'Ciceri', 'laki-laki', 0);

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
(2, 'Miss Rae Kochh', 'rae@gmail.com', '0895359449372', '20190706-redvelvetjpg.jpg', '$2y$10$DbvPvN0Rxow/hhWsPvfNJe.8MqAM6RNCFf4yM/2PKJrysK37x7r5e', 1, 1, 1584367630),
(7, 'Audrey Hepburn', 'audrey@gmail.com', '', 'default.png', '$2y$10$0HD1rWaHHYdz76eXMGPxIefJYlS8U6dTH/ZXCyrP2bH2YPa2lVpUe', 2, 0, 1584943180),
(12, 'Muhamad Rizkii', 'rizkyzetzet1212@gmail.com', '0895359449377', 'default.png', 'qwer121', 2, 0, 1589733235),
(13, 'Muhamad Rizkii', 'rizkyzetzet1212222@gmail.com', '0895359449377', 'default.png', '$2y$10$xz/c1h7WJS83nq0/pszHledb7UqJOATSVo2djUX8lRyHGlGj7/7E6', 2, 0, 1589733351),
(16, 'Muhamad Rizki', 'rizkyzetzet121@gmail.com', '0895359449377', 'default.png', '$2y$10$q0IG9/Qi3kir3sPy84CMs.qVMofpPK6Z1YEIM/BLr4B1bmeI4.ml2', 2, 1, 1589793229);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(45, 1, 3),
(46, 1, 2),
(48, 1, 15),
(49, 1, 16),
(52, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(15, 'Master'),
(16, 'Catering');

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
(1, 'Administrator'),
(2, 'Pelanggan'),
(7, 'Loper');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-users', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(15, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(16, 2, 'Change Password', 'user/changepassword', 'fas fa-gw fa-key', 1),
(17, 15, 'Data Sekolah', 'master', 'fas fa-fw fa-school', 1),
(18, 15, 'Data Siswa', 'master/siswa', 'fas fa-fw fa-user-friends', 1),
(19, 16, 'Pemesanan', 'catering', 'fas fa-fw fa-utensils', 1);

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
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_pembayaran`);

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
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
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
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `no_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1977582213;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
