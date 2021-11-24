-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 05:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekpw`
--
DROP DATABASE IF EXISTS `proyekpw`;
CREATE DATABASE IF NOT EXISTS `proyekpw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyekpw`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_jenis`
--

CREATE TABLE IF NOT EXISTS `daftar_jenis` (
  `jenis_barang` varchar(100) NOT NULL,
  PRIMARY KEY (`jenis_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_jenis`
--

INSERT INTO `daftar_jenis` (`jenis_barang`) VALUES
('baru'),
('bekas');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

CREATE TABLE IF NOT EXISTS `data_transaksi` (
  `id_datatransaksi` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_datatransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE IF NOT EXISTS `diskon` (
  `id_diskon` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_diskon` varchar(100) NOT NULL,
  `jumlah_diskon` int(10) NOT NULL,
  PRIMARY KEY (`id_diskon`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_transaksi`
--

CREATE TABLE IF NOT EXISTS `history_transaksi` (
  `id_historytransaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `status` enum('proses','selesai') NOT NULL,
  PRIMARY KEY (`id_historytransaksi`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE IF NOT EXISTS `master_barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `jenis_barang`, `deskripsi`, `urlgambar`) VALUES
('MB28760879', '123', 900, 22, 'aa', 'redi bapaknya viktor', ''),
('MB98360893', 'aaaa', 900, 22, 'bukan ak', 'maaf', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk_review`
--

CREATE TABLE IF NOT EXISTS `produk_review` (
  `id_review` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `rating` int(10) NOT NULL,
  `tanggal_review` date NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `userrname` varchar(100) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `nama_barang` (`nama_barang`(768)),
  KEY `userrname` (`userrname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relasi_jenis`
--

CREATE TABLE IF NOT EXISTS `relasi_jenis` (
  `id_jenis` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `id_datatransaksi` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_datatransaksi` (`id_datatransaksi`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `saldo` int(100) NOT NULL,
  `id_wishlist` varchar(10) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `id_wishlist` (`id_wishlist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id_wishlist` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_wishlist`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
