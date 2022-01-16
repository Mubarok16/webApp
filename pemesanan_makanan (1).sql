-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 04:00 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_makanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(100) NOT NULL,
  `id_makanan` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `sub_total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_makanan`, `qty`, `sub_total`) VALUES
(9, 1, 2, 20000),
(10, 2, 2, 50000),
(10, 1, 2, 20000),
(11, 3, 2, 20000),
(11, 5, 3, 21000),
(11, 4, 4, 60000),
(12, 4, 4, 60000),
(12, 5, 2, 14000),
(13, 3, 21, 210000),
(14, 2, 3, 75000),
(15, 2, 1, 25000),
(15, 5, 5, 35000),
(16, 2, 2, 50000),
(16, 4, 3, 45000),
(17, 2, 1, 25000),
(17, 3, 2, 20000),
(18, 2, 2, 50000),
(19, 1, 2, 14000),
(20, 1, 2, 14000),
(21, 2, 6, 150000);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `penjualan` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE menu SET stok=stok-NEW.qty WHERE id_makanan = NEW.id_makanan;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_makanan` int(100) NOT NULL,
  `nama_makanan` varchar(100) NOT NULL,
  `jenis_makanan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `stok` int(100) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_makanan`, `nama_makanan`, `jenis_makanan`, `gambar`, `stok`, `harga`) VALUES
(1, 'Nasi Lengko', 'Makanan', '', 0, 7000),
(2, 'Pindang Gombyang', 'Makanan', '', 0, 25000),
(3, 'Nasi Kucing', 'makanan', '', 8, 10000),
(4, 'Jus Mangga', 'minuman', '', 7, 15000),
(5, 'Es Teh', 'minuman', '', 3, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `id_user`, `total`) VALUES
(9, '2021-02-27', 1, 20000),
(10, '2021-03-01', 1, 70000),
(11, '2021-03-15', 1, 101000),
(12, '2021-03-15', 3, 74000),
(13, '2021-03-15', 1, 210000),
(14, '2021-03-15', 1, 75000),
(15, '2021-03-16', 1, 60000),
(16, '2021-03-16', 1, 95000),
(17, '2021-03-18', 1, 45000),
(18, '2021-03-19', 1, 50000),
(19, '2021-03-19', 1, 14000),
(20, '2021-03-19', 1, 14000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `level` int(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `status`) VALUES
(1, 'Bagus', 'kasir', 'kasir', 2, 1),
(2, 'ahmad farhan', 'admin', 'admin', 1, 1),
(3, 'Sri', 'kasir1', '123', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_menu` (`id_makanan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_kasir` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_makanan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
