-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 09:39 AM
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
-- Database: `proyekpw`
--
CREATE DATABASE IF NOT EXISTS `proyekpw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyekpw`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '../asset/image/profile/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `email`, `hp`, `tgl_lahir`, `jenis_kelamin`, `url`) VALUES
('anderson', '89ba023086e37a345839e0c6a0d272eb', 'Anderson', NULL, NULL, NULL, NULL, '../asset/image/profile/default.png'),
('owner', '72122ce96bfec66e2396d2e25225d70a', 'Owner', 'owner@ahihistore.masuk.id', '081234567890', '2000-11-23', 'Female', '../asset/image/profile/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_jenis`
--

DROP TABLE IF EXISTS `daftar_jenis`;
CREATE TABLE `daftar_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_jenis`
--

INSERT INTO `daftar_jenis` (`id_jenis`, `jenis_barang`) VALUES
(1, 'Monitor'),
(2, 'Mouse'),
(3, 'Mouse Pad'),
(4, 'Audio'),
(5, 'Keyboard'),
(6, 'PC'),
(7, 'Motherboard'),
(8, 'Storage'),
(9, 'RAM'),
(10, 'Processor'),
(11, 'VGA'),
(12, 'PSU'),
(13, 'Cooler');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

DROP TABLE IF EXISTS `data_transaksi`;
CREATE TABLE `data_transaksi` (
  `id_datatransaksi` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

DROP TABLE IF EXISTS `diskon`;
CREATE TABLE `diskon` (
  `id_diskon` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_diskon` varchar(100) NOT NULL,
  `jumlah_diskon` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `id_barang`, `nama_diskon`, `jumlah_diskon`) VALUES
('D001', 'MON0013369', 'Black Friday', '0.10');

-- --------------------------------------------------------

--
-- Table structure for table `history_transaksi`
--

DROP TABLE IF EXISTS `history_transaksi`;
CREATE TABLE `history_transaksi` (
  `id_historytransaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `status` enum('proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(100) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `id_jenis_barang`, `deskripsi`, `urlgambar`) VALUES
('MON0013369', 'ASUS TUF Gaming VG24VQ 24\" Full HD 1920 x 1080 1ms MPRT 144Hz 2 x HDMI, DisplayPort AMD FreeSync Asus Eye Care with Ultra Low-Blue Light & Flicker-Free LED Height Adjustable Curved Gaming Monitor', 2697858, 9999, 1, '[\"Pixel Pitch: 0.272mm\",\"Cabinet Color: Black\",\"Response Time: 1ms MPRT\",\"Widescreen: Yes\",\"Model #: 90LM0570-B011B0\",\"Item #: N82E16824281027\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-027-S01.jpg'),
('MON0028674', 'GIGABYTE G27Q 27\" 144Hz 1440P Gaming Monitor, 2560 x 1440 IPS Display, 1ms (MPRT) Response Time, 92% DCI-P3, VESA Display HDR400, FreeSync Premium, 1x DisplayPort 1.2, 2x HDMI 2.0, 2x USB 3.0', 4685858, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Cabinet Color: Black\",\"Response Time: 1ms (MPRT)\",\"Widescreen: Yes\",\"Model #: G27Q\",\"Item #: N82E16824012015\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-015-01.jpg'),
('MON0031845', 'ASUS VG278Q 27\" Full HD 1920 x 1080 144Hz 1ms DisplayPort HDMI DVI Asus Eye Care with Ultra Low-Blue Light & Flicker-Free AMD Free Sync G-Sync Compatible Built-in Speakers LED Backlit Gaming Monitor', 3549858, 9999, 1, '[\"Pixel Pitch: 0.311mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: 90LM03P0-B013B0\",\"Item #: N82E16824236821\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-821-V06.jpg'),
('MON0041518', 'Samsung Odyssey Neo G9 49\" S49AG952N 5120 x 1440 (2K) 240Hz 1ms (GTG) FreeSync Premium Pro G-Sync Compatible, DisplayPort HDMI, Height Adjust VESA Tilt Swivel Curved Gaming Monitor', 35499858, 9999, 1, '[\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GTG)\",\"Widescreen: Yes\",\"Model #: LS49AG952NNXZA\",\"Item #: N82E16824027035\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-027-035-02.jpg'),
('MON0053018', 'Acer Nitro ED270 Xbmiipx 27\" 1ms Full HD 1920 x 1080 240Hz Adaptive-Sync HDMI, DisplayPort Built-in Speakers Curved Gaming Monitor', 4259858, 9999, 1, '[\"Pixel Pitch: 0.3114mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (VRB)\",\"Model #: UM.HE0AA.X01\",\"Item #: N82E16824011367\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-367-V01.jpg'),
('MON0062580', 'GIGABYTE M32Q 32\" 165Hz/170Hz(OC) 1440P QHD KVM Gaming Monitor, 2560 x 1440 SS IPS, 0.8ms (MPRT), 94% DCI-P3, HDR Ready, FreeSync Premium, 1x DisplayPort 1.2, 2x HDMI 2.0, 3x USB 3.0, 1x USB Type-C', 7099858, 9999, 1, '[\"Pixel Pitch: 0.273mm\",\"Display Colors: 8 bits\",\"Response Time: 0.8ms (MPRT) \\/ 1ms (GTG)\",\"Widescreen: Yes\",\"Model #: M32Q\",\"Item #: N82E16824012039\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-039-V01.jpg'),
('MON0077832', 'ASUS ROG Swift PG259QN eSports G-SYNC Gaming Monitor 24.5\" FHD (1920 x 1080), 360 Hz, Fast IPS, 1 ms (GTG), HDR, NVIDIA ULMB', 11018064, 9999, 1, '[\"Pixel Pitch: 0.283mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GTG)\",\"Model #: 90LM05Q0-B013B0\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-082-01.jpg'),
('MON0083271', 'GIGABYTE M34WQ 34\" 144Hz Ultrawide KVM Gaming Monitor, 3440 x 1440 IPS Display, 1ms (MPRT) Response Time, 91% DCI-P3, HDR Ready, 1x Display Port 1.4, 2x HDMI 2.0, 2x USB 3.0, 1x USB Type-C', 7099858, 9999, 1, '[\"Pixel Pitch: 0.2325mm x 0.2325mm\",\"Display Colors: 8 bits\",\"Response Time: 1 ms MPRT\",\"Widescreen: Yes\",\"Model #: M34WQ\",\"Item #: N82E16824012043\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-043-V01.jpg'),
('MON0095821', 'LG UltraGear 32GP850-B 32\" 2560 x 1440 (2K) QHD 1ms 165Hz (180Hz OC) Nano IPS HDMI DisplayPort USB 3.0 G-Sync Compatible FreeSync Premium VESA Tilt Pivot Height Adjust Gaming Monitor', 6773258, 9999, 1, '[\"Pixel Pitch: 0.2724 x 0.2724 mm\",\"Display Colors: 1.07 Billion\",\"Response Time: 1 ms (GtG at Faster)\",\"Widescreen: Yes\",\"Model #: 32GP850-B\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/A4P0D210607R7VAE.jpg'),
('MON0104338', 'GIGABYTE G32QC A 32\" 165Hz 2K QHD 1ms (MPRT), 93% DCI-P3, VESA HDR400, FreeSync Premium Pro, 1 x DisplayPort 1.2, 2 x HDMI 2,0, 2 x USB 3.0 Curved Gaming Monitor', 5253858, 9999, 1, '[\"Pixel Pitch: 0.2724mm x 0.2724mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (MPRT)\",\"Model #: G32QC A\",\"Item #: N82E16824012036\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-036-V09.jpg'),
('MON0119044', 'GIGABYTE M32U 32\" (31.5\" Viewable) 3840 x 2160 4K 144Hz Adaptive Sync Compatible, SS IPS, 1ms (MPRT), 1x Display Port 1.4, 2x HDMI 2.1, 2x USB 3.0, 1x USB Type C Height Adjust VESA Gaming Monitor', 11359858, 9999, 1, '[\"Pixel Pitch: 0.181mm\",\"Display Colors: 10-bit (8-bit + FRC)\",\"Cabinet Color: Black\",\"Response Time: 1 ms MPRT\",\"Model #: M32U\",\"Item #: N82E16824012042\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-042-V01.jpg'),
('MON0121456', 'Westinghouse WM27PX9019 27\" Full HD 1920 x 1080 144Hz HDMI VGA DisplayPort AMD FreeSync Technology Flicker-Free Edgeless Design Eye Care Technology Widescreen Backlit LED Gaming Monitor', 2839858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Widescreen: Yes\",\"D-Sub: 1\",\"Model #: WM27PX9019\",\"Item #: N82E16824569006\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-569-006-V13.jpg'),
('MON0133171', 'SAMSUNG C24F396 24\" (23.5\" Viewable) Full HD 1920 x 1080 VGA, HDMI AMD FreeSync Flicker Free Low Blue Light LED Backlit Curved Gaming Monitor', 2697858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Glossy Black\",\"Response Time: 4ms (GTG)\",\"Widescreen: Yes\",\"Model #: LC24F396FHNXZA\",\"Item #: 15Z-001C-00AJ4\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/15Z-001C-00AJ4-V04.jpg'),
('MON0146481', 'MSI 29.5\" Optix MAG301RF Full HD 2560 x 1080 200Hz SS IPS 1ms (GTG) DisplayPort HDMI Tilt Swivel Height Adjust VESA G-Sync Compatible Gaming Monitor', 4685858, 9999, 1, '[\"Pixel Pitch: 0.2697mm x 0.2697mm\",\"Display Colors: 1.07 Billion (8bits + FRC)\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: OptixMAG301RF\",\"Item #: N82E16824475143\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-143-V11.jpg'),
('MON0156358', 'ASUS TUF Gaming 24.5\" 1080P HDR Monitor VG258QM -  Full HD, 280Hz (Supports 144Hz), 0.5ms, Extreme Low Motion Blur Sync, G-SYNC Compatible, DisplayHDR 400, Speaker, DisplayPort HDMI, Height Adjustable', 4401858, 9999, 1, '[\"Pixel Pitch: 0.2832mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 0.5ms (GTG)\",\"Model #: 90LM0450-B023B0\",\"Item #: N82E16824281113\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-113-S07.jpg'),
('MON0164525', 'ASUS TUF Gaming VG35VQ Curved Gaming Monitor 35\" WQHD (3440 x 1440), 100Hz, Extreme Low Motion Blur, Adaptive-Sync, 1ms (MPRT)', 6815858, 9999, 1, '[\"Pixel Pitch: 0.23mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms MPRT  *1ms MPRT spec is based on internal testes. Response time may vary depending on test conditions\",\"Model #: 90LM0520-B011B0\",\"Item #: N82E16824281004\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-004-S01.jpg'),
('MON0171831', 'ASUS ROG Strix XG438Q 43\" 3840 x 2160 4K Resolution 120Hz 3xHDMI DisplayPort FreeSync Flicker Free HDR 600 Remote Control Built-in Speakers Backlit LED Gaming Monitor', 15605800, 9999, 1, '[\"Pixel Pitch: 0.2451mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 4ms (GTG)\",\"Model #: XG438Q\",\"Item #: N82E16824236989\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-989-V01.jpg'),
('MON0183931', 'AORUS FI32U 32\" (31.5\" Viewable) 4K SS IPS Exclusive Built-in ANC, 3840x2160 144Hz 1ms GTG, DP 1.4, HDMI 2.1, 2x USB 3.0, KVM w/ USB Type-C, AMD FreeSync Premium Pro Height Adjust Gaming Monitor', 14199858, 9999, 1, '[\"Pixel Pitch: 0.181mm x 0.181mm\",\"Display Colors: 10 bits (8 bits + FRC)\",\"Response Time: 1ms GTG \\/ 1ms MPRT\",\"Widescreen: Yes\",\"Model #: AORUS FI32U\",\"Item #: N82E16824716004\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-716-004-V01.jpg'),
('MON0198495', 'Acer Nitro Gaming Series VG240Y bmiix 24\" (Actual size 23.8\") Full HD 1920 x 1080 1ms 75 Hz D-Sub, 2x HDMI AMD FreeSync Built-in Speakers IPS Gaming Monitor', 2555858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms MPRT\",\"Widescreen: Yes\",\"Model #: UM.QV0AA.002\",\"Item #: N82E16824011232\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-232-V01.jpg'),
('MON0209660', 'ASUS TUF Gaming 28\" 4K 144Hz DSC HDMI 2.1 Gaming Monitor (VG28UQL1A) - UHD (3840 x 2160), Fast IPS, 1ms, Extreme Low Motion Blur Sync, G-SYNC Compatible, FreeSync Premium, Eye Care, DCI-P3 90%', 11359858, 9999, 1, '[\"Pixel Pitch: 0.16mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GtG)\",\"Model #: 90LM0780-B011B0\",\"Item #: N82E16824281157\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-157-V08.jpg'),
('MON0213510', 'ASUS ROG Strix 27\" 1440P HDR Gaming Monitor (XG27AQ) - QHD (2560 x 1440), Fast IPS, 170Hz, 1ms, G-SYNC Compatible, Extreme Low Motion Blur Sync, Eye Care, HDMI DisplayPort USB 3.0 Hub, DisplayHDR 400', 7085800, 9999, 1, '[\"Pixel Pitch: 0.233mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: 90LM06U0-B013B0\",\"Item #: N82E16824281107\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-107-V03.jpg'),
('MON0222219', 'ASUS VP278QGL 27\" Full HD 1920 x 1080 1ms DP HDMI VGA Adaptive Sync/FreeSync Eye Care Monitor, Height Adjustable', 3229222, 9999, 1, '[\"Pixel Pitch: 0.311mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: 90LM01M0-B061B0\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-919-V04.jpg'),
('MON0235254', 'Pixio PXC325 32\" (31.5\" Viewable) FHD 1920 x 1080 DCI P3 97%, 165Hz 1ms FreeSync Premium and G-Sync Compatible HDR, 1500R Curved Gaming Monitor', 4401858, 9999, 1, '[\"Response Time: 1 ms (MPRT)\",\"Widescreen: Yes\",\"HDMI: 2 x HDMI 2.0\",\"Stand Adjustments: Tilt\",\"Model #: PXC325\",\"Item #: N82E16824737018\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-737-018-V01.jpg'),
('MON0249322', 'ASUS ROG Strix XG279Q 27\" WQHD 2560 x 1440 (2K) 1ms (GTG) 170Hz (Overclocking) 2 x HDMI, DisplayPort G-Sync Compatible Built-in Speakers DisplayHDR 400 Frameless Design LED Backlit IPS Gaming Monitor', 8505800, 9999, 1, '[\"Pixel Pitch: 0.233mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GTG)\",\"Model #: 90LM05D0-B013B0\",\"Item #: N82E16824281026\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-026-S01.jpg'),
('MON0252362', 'Z-EDGE UG32 32\" 1080P 165Hz 1ms 1500R Curved Gaming Monitor, HDR10, FreeSync, HDMI x2, DisplayPort x2, 178° View Angle, with RGB Light, Built in Speakers, Eye-Care Technology', 4543858, 9999, 1, '[\"Pixel Pitch: 0.36375mm x 0.36375mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms\",\"Model #: UG32_ZE\",\"Item #: 9SIAT2EDRW2811\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/AT2ES211103Bztj2.jpg'),
('MON0261988', 'ASUS ROG Swift PG32UQ 32\" 4K HDR 144Hz DSC HDMI 2.1 Gaming Monitor, UHD (3840 x 2160), IPS, 1ms, G-SYNC Compatible, Extreme Low Motion Blur Sync, Eye Care, DisplayPort, USB, DisplayHDR 600', 14199858, 9999, 1, '[\"Pixel Pitch: 0.185mm\",\"Display Colors: 1073.7M (10 bit)\",\"Response Time: 1 ms MPRT\",\"Widescreen: Yes\",\"Model #: 90LM0770-B011B0\",\"Item #: N82E16824281166\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-166-V01.jpg'),
('MON0275768', 'ASUS ROG Strix XG16AHPE 15.6\" 1080P Full HD, 144Hz, IPS, G-SYNC Compatible, Built-in Battery, Kickstand, USB-C Power Delivery, Micro HDMI, For Laptop, PC, Phone, Console Portable Gaming Monitor', 5679858, 9999, 1, '[\"Pixel Pitch: 0.179mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 3ms (GTG)\",\"Model #: 90LM06I1-B011B0\",\"Item #: N82E16824281126\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-126-V08.jpg'),
('MON0288144', 'GIGABYTE G24F 24\" (23.8\" Viewable) 165Hz/170Hz(OC) 1920 x 1080 SS IPS, 1ms (MPRT), 90% DCI-P3, FreeSync Premium, 1x DisplayPort 1.2 (HDR Ready), 2x HDMI 2.0, 2x USB 3.0 Height Adjust Gaming Monitor', 2981858, 9999, 1, '[\"Pixel Pitch: 0.2745mm x 0.2745mm\",\"Display Colors: 8 bits\",\"Response Time: 1ms (MPRT) \\/ 2ms (GTG)\",\"Widescreen: Yes\",\"Model #: G24F\",\"Item #: N82E16824012041\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-041-V05.jpg'),
('MON0293541', 'MSI Optix G273QF 27\" QHD 2560 x 1440 (2K) 1ms (GTG) 165 Hz 2 x HDMI, DisplayPort NVIDIA G-Sync Compatible Rapid IPS Gaming Monitor', 4401290, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black - RGB\",\"Response Time: 1ms (GTG)\",\"Model #: Optix G273QF\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-101-S01.jpg'),
('MON0308504', 'AORUS FV43U 43\" QLED UHD 4K 3840 x 2160 144Hz 1ms (MPRT) FreeSync Premium Pro, 1 x Display Port 1.4, 2 x HDMI 2.1, 2 x USB 3.0, KVM w/ USB Type-C Gaming Monitor', 15619858, 9999, 1, '[\"Pixel Pitch: 0.2451mm x 0.2451mm\",\"Display Colors: 1.07 Billion \\/ 10bits (8bits + FRC)\",\"Cabinet Color: Black\",\"Response Time: 1ms (MPRT)\",\"Model #: AORUS FV43U\",\"Item #: N82E16824716002\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-716-002-V09.jpg'),
('MON0318907', 'ASUS TUF Gaming 27\" 1440P Monitor (VG27AQL1A) - QHD (2560 x 1440), IPS, 170Hz (Supports 144Hz), 1ms, Extreme Low Motion Blur, DisplayHDR, Speaker, G-SYNC Compatible, VESA Mountable, DisplayPort, HDMI', 5395858, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1 ms (MPRT) *1ms MPRT spec is based on internal testes. Response time may vary depending on test conditions\",\"Model #: 90LM05Z0-B013B0\",\"Item #: N82E16824281067\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-067-S01.jpg'),
('MON0324547', 'AORUS FO48U 48\" 4K OLED 3840x2160 120Hz 1ms GTG, 1x DisplayPort 1.4, 2x HDMI 2.1, 2x USB 3.0, KVM w/ USB Type-C, Space Audio, AMD FreeSync Premium Gaming Monitor', 21299858, 9999, 1, '[\"Pixel Pitch: 0.274mm x 0.274mm\",\"Display Colors: 10 bits\",\"Response Time: 1ms GTG\",\"Widescreen: Yes\",\"Model #: AORUS FO48U\",\"Item #: N82E16824716003\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-716-003-V09.jpg'),
('MON0336656', 'Acer Nitro XZ322Q Pbmiiphx 32\" (31.5\" Viewable) FULL HD 165Hz 1ms FreeSync HDMI DP Build-in-Speaker HDR400 Curved Gaming Monitor w/ Height Adjustable', 4969858, 9999, 1, '[\"Pixel Pitch: 0.36375mm x 0.36375mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black \\/ Red\",\"Response Time: 1ms (VRB)\",\"Model #: UM.JX2AA.P01\",\"Item #: N82E16824011375\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-375-V01.jpg'),
('MON0345342', 'ASUS VP278QG 27\" Full HD 1920 x 1080 1ms DP HDMI VGA Adaptive Sync/FreeSync Eye Care Monitor', 2555858, 9999, 1, '[\"Pixel Pitch: 0.311mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: 90LM01M0-B051B0\",\"Item #: N82E16824236830\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-830-V01.jpg'),
('MON0353055', 'LG 32UD59-B 32\" 4K UHD 3840 x 2160 60hz 2 x HDMI DisplayPort Flicker Safe Anti-Glare FreeSync Height Adjustable LCD Monitor', 4955800, 9999, 1, '[\"Pixel Pitch: 0.181mm x 0.181mm\",\"Cabinet Color: Black\",\"Response Time: 5ms (GTG)\",\"Widescreen: Yes\",\"Model #: 32UD59-B\",\"Item #: N82E16824025172\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-025-172-V21.jpg'),
('MON0366899', 'SAMSUNG Odyssey G7 C27G75T 27\" Quad HD 2560 x 1440 2K 240Hz 1ms 2 x DisplayPort, HDMI G-Sync Compatible Flicker-Free Backlit LED Curved Gaming Monitor', 9939858, 9999, 1, '[\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GTG)\",\"Widescreen: Yes\",\"Model #: LC27G75TQSNXZA\",\"Item #: N82E16824022815\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-022-815-S02.jpg'),
('MON0373934', 'Acer ED242QR Abidpx 24\" Full HD 1920 x 1080 144Hz DVI HDMI DisplayPort AMD FreeSync Technology Widescreen Backlit LED Curved Gaming Monitor', 2697858, 9999, 1, '[\"Pixel Pitch: 0.2715mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 4ms (GTG)\",\"Model #: UM.UE2AA.A01\",\"Item #: N82E16824011162\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-162-V08.jpg'),
('MON0387776', 'ASUS TUF Gaming VG289Q1A 28\" UHD 3840 x 2160 (4K) 60 Hz 2 x HDMI, DisplayPort, Audio FreeSync Built-in Speakers HDR 10 IPS Gaming Monitor', 4685858, 9999, 1, '[\"Pixel Pitch: 0.16mm\",\"Display Colors: 1.073 Billion\",\"Cabinet Color: Black\",\"Response Time: 5ms (Gray to Gray)\",\"Model #: VG289Q1A\",\"Item #: N82E16824281095\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-095-S06.jpg'),
('MON0396247', 'ASUS VG248QG 24\" Full HD 1920 x 1080 0.5ms 165Hz(overclockable) Gaming Monitor, G-SYNC Compatible, Adaptive-Sync, ASUS Eye Care with Ultra Low-blue Light & Flicker-Free Technology', 2839858, 9999, 1, '[\"Pixel Pitch: 0.276mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 0.5ms (GTG, Min.), 1ms (GTG, Ave.)\",\"Model #: 90LMGG901Q022EUL\",\"Item #: N82E16824236978\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-978-V01.jpg'),
('MON0409536', 'Westinghouse WM32DX9019 32\" WQHD 2560 x 1440 2K Resolution 144Hz HDMI DisplayPort AMD FreeSync Technology Flicker-Free Anti-Glare Widescreen Backlit LED Gaming Monitor', 4259858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 5 ms\",\"Widescreen: Yes\",\"Model #: WM32DX9019\",\"Item #: N82E16824569005\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-569-005-V01.jpg'),
('MON0419539', 'Acer EI272UR Pbmiiipx 27\" WQHD 2560 x 1440 2K 144Hz 3xHDMI DisplayPort Built-in Speakers AMD FreeSync 2 Backlit LED Curved Gaming Monitor', 4969858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 4 ms GTG\",\"Widescreen: Yes\",\"Model #: UM.HE2AA.P01\",\"Item #: N82E16824011355\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-355-V01.jpg'),
('MON0425772', 'LG Ultragear 27GL850-B 27\" 2K QHD 2560 x 1440 1ms GTG 144Hz 2 x HDMI DisplayPort USB 3.0 Hub AMD FreeSync NVIDIA G-Sync Compatible HDR 10 Nano IPS Gaming Monitor', 7085800, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG at Faster)\",\"Model #: 27GL850-B\",\"Item #: N82E16824025955\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-025-955-V11.jpg'),
('MON0436645', 'GIGABYTE G27QC A 27\" 165Hz 2560 x 1440 1ms (MPRT) 88% DCI-P3, HDR Ready, FreeSync Premium, 1 x Display Port 1.2, 2 x HDMI 2.0, 2 x USB 3.0 Curved Gaming Monitor', 4685858, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (MPRT)\",\"Model #: G27QC A\",\"Item #: N82E16824012038\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-012-038-V01.jpg'),
('MON0442950', 'MSI Optix MAG271VCR 27\" Full HD 1920 x 1080 1ms (MPRT) 165Hz 2 x HDMI, DisplayPort FreeSync Height Adjustable Curved Gaming Monitor', 3549858, 9999, 1, '[\"Pixel Pitch: 0.3114mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Dark Gray\",\"Response Time: 1ms (MPRT) \\/ 4ms (GTG)\",\"Model #: Optix MAG271VCR\",\"Item #: N82E16824475092\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-092-V21.jpg'),
('MON0454318', 'MSI Optix MAG321QR 31.5\" WQHD 2560 x 1440 (2K) 165 Hz HDMI, DisplayPort, USB, Audio G-Sync Compatible Gaming Monitor', 6105858, 9999, 1, '[\"Pixel Pitch: 0.272mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Metallic Black - RGB\",\"Response Time: 1 ms (MPRT)\",\"Model #: 9S6-3DB97A-003\",\"Item #: N82E16824475163\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-163-17.jpg'),
('MON0463174', 'Z-EDGE UG32P 32\" 1080P Curved Gaming Monitor, 240Hz, 1ms, HDR, FreeSync, HDMI x2, DisplayPort x1, USB x1, Built-in Speakers, VESA Mountable, with RGB Breathing Light', 4969858, 9999, 1, '[\"Pixel Pitch: 0.36375mm x 0.36375mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms\",\"Model #: UG32P\",\"Item #: 9SIAT2EDNA0728\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/AT2ES211103bqMw5.jpg'),
('MON0475941', 'SAMSUNG Odyssey G5 C32G57T 32\" WQHD 2560 x 1440 (2K) 1 ms (MPRT) 144 Hz HDMI, DisplayPort FreeSync Premium HDR10 Curved Gaming Monitor', 6105858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms (MPRT)\",\"Widescreen: Yes\",\"Model #: LC32G57TQWNXDC\",\"Item #: N82E16824022909\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-022-909-V01.jpg'),
('MON0488381', 'ASUS TUF Gaming 27\" 1440P HDR Gaming Monitor (VG27AQ) - QHD (2560 x 1440), 165Hz (Supports 144Hz), 1ms, Extreme Low Motion Blur, Speaker, G-SYNC Compatible, VESA Mountable, DisplayPort, HDMI', 4969858, 9999, 1, '[\"Pixel Pitch: 0.233mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms MPRT\",\"Model #: 90LM0500-B013B0\",\"Item #: N82E16824236987\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-987-S01.jpg'),
('MON0498699', 'ASUS VP28UQG 28\" Ultra HD 3840 x 2160 4K Resolution 1ms 2 x HDMI, DisplayPort FreeSync Technology Asus Eye Care with Ultra Low-Blue Light Flicker-Free Technology Widescreen LED Backlit LCD Monitor', 3549858, 9999, 1, '[\"Pixel Pitch: 0.16mm x 0.16mm\",\"Display Colors: 1073.7M (10bit)\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: 90LM03M0-B011B0\",\"Item #: N82E16824236825\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-825-V01.jpg'),
('MON0502366', 'LG 32GK650F-B 32\" (Actual size 31.5\") Quad HD 2560 x 1440 2K 144Hz 2xHDMI DisplayPort AMD Radeon FreeSync 3-Side Borderless Anti-Glare Backlit LED Gaming Monitor', 5665800, 9999, 1, '[\"Pixel Pitch: 0.2724mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms (MBR)\",\"Model #: 32GK650F-B\",\"Item #: N82E16824025915\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-025-915-V01.jpg'),
('MON0511165', 'MSI 24.5\" Oculux NXG253R 1920 x 1080 FHD 360Hz Rapid IPS 1ms GTG DisplayPort HDMI USB 3.2 Tilt Swivel Pivot Height Adjust VESA G-Sync Gaming Monitor', 8519858, 9999, 1, '[\"Pixel Pitch: 0.2829mm x 0.2802mm\",\"Display Colors: 1.07 Billion (8bits + FRC)\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: Oculux NXG253R\",\"Item #: N82E16824475144\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-144-V14.jpg'),
('MON0521498', 'Nixeus EDG 27\" IPS (AHVA) 2560 x 1440 AMD Radeon FreeSync Certified 144Hz Gaming Monitor with Base Tilt Only Stand(NX-EDG27Sv2)', 5679858, 9999, 1, '[\"Pixel Pitch: 0.233mm\",\"Display Colors: 16.7 Million (True 8 bit)\",\"Cabinet Color: Black\",\"Response Time: 4 ms\",\"Model #: NX-EDG27Sv2\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/A0ZW_132164257521384437Xi7cCMcUJJ.jpg'),
('MON0538458', 'SAMSUNG Odyssey G5 C34G55T 34\" WQHD 3440 x 1440 (2K) 1ms (MPRT) 165Hz HDR10, HDMI, DisplayPort FreeSync Premium Curved Gaming Monitor', 8945858, 9999, 1, '[\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms (MPRT)\",\"Widescreen: Yes\",\"Model #: LC34G55TWWNXZA\",\"Item #: N82E16824022912\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-022-912-V01.jpg'),
('MON0547668', 'MSI Optix MAG274QRF 27\" WQHD 2560 x 1440 (2K) 1ms (GTG) 165 Hz 2 x HDMI, DisplayPort, USB-C NVIDIA G-Sync Compatible Height Adjustable IPS Gaming Monitor', 5679858, 9999, 1, '[\"Pixel Pitch: 0.2331mm\",\"Display Colors: 1.07 Billion (8bits + FRC)\",\"Cabinet Color: Black\",\"Response Time: 1ms (GTG)\",\"Model #: Optix MAG274QRF\",\"Item #: N82E16824475097\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-475-097-V01.jpg'),
('MON0554912', 'Acer Nitro VG280K bmiipx 28\" IPS 3840 x 2160P 4K 1ms UHD AMD FreeSync HDR 2 x HDMI, DisplayPort, Built-in Speaker Gaming Monitor', 4259858, 9999, 1, '[\"Pixel Pitch: 0.16mm\",\"Display Colors: 1.07 Billion\",\"Cabinet Color: Black\",\"Response Time: 1ms (VRB)\",\"Model #: UM.PV0AA.001\",\"Item #: N82E16824011381\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-381-08.jpg'),
('MON0568933', 'Acer KA272U biipx UM.HX2AA.004 27\" QHD 2560 x 1440 (2K) 1ms VBR 75 Hz 2 x HDMI, DisplayPort AMD RADEON FreeSync Technology Gaming Monitor', 3549858, 9999, 1, '[\"Pixel Pitch: 0.3114mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms VBR\",\"Model #: UM.HX2AA.004\",\"Item #: N82E16824011372\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-372-V01.jpg'),
('MON0574502', 'Acer Gaming Series ED323QUR Abidpx 32\" (Actual size 31.5\") 2560 x 1440 2K Resolution 144Hz DisplayPort HDMI DVI AMD FreeSync LED Backlit Curved Gaming Monitor', 5679858, 9999, 1, '[\"Pixel Pitch: 0.2724mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 4ms (GTG)\",\"Model #: UM.JE3AA.A01\",\"Item #: N82E16824011234\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-011-234-V01.jpg'),
('MON0582859', 'ASUS VG278QR 27\" Full HD 1920 x 1080 165Hz 0.5ms DisplayPort HDMI DVI-D G-SYNC Compatible Asus Eye Care Flicker-Free Technology Low Blue Light Built-in Speakers Backlit LED Gaming Monitor', 3549858, 9999, 1, '[\"Pixel Pitch: 0.311mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 0.5ms (GTG, Min.), 1ms (GTG, Ave.)\",\"Model #: 90LM03P3-B013B0\",\"Item #: N82E16824236994\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-236-994-V01.jpg'),
('MON0597509', 'ASUS TUF Gaming VG279QM 27\" Full HD 1920 x 1080 1 ms (GTG) 280Hz (Overclocking) 2 x HDMI, DisplayPort G-SYNC ELMB SYNC HDR Built-in Speakers LED Backlit Height Adjustable IPS Gaming Monitor', 4969858, 9999, 1, '[\"Pixel Pitch: 0.311mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1 ms (GTG)\",\"Model #: 90LM05H0-B013B0\",\"Item #: N82E16824281037\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-037-S01.jpg'),
('MON0603859', 'ASUS TUF Gaming VG259QR 24.5\" Gaming Monitor, 1080P Full HD, 165Hz (Supports 144Hz), 1ms, Extreme Low Motion Blur, G-SYNC Compatible ready, Eye Care, 2 x HDMI DisplayPort, Shadow Boost', 3549858, 9999, 1, '[\"Pixel Pitch: 0.2832 x 0.2802mm\",\"Display Colors: 16.7 Million\",\"Cabinet Color: Black\",\"Response Time: 1ms MPRT* *1ms MPRT is the fastest based on internal tests. Response time may vary depending on test conditions\",\"Model #: 90LM0530-B043B0\",\"Item #: N82E16824281099\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/24-281-099-S01.jpg'),
('RAM0012500', 'v-color DDR4 32GB (2x16GB) 2400MHz (PC4-19200) SO-DIMM SK Hynix IC Laptop Memory Model TN416G24D817-VC', 2115658, 9999, 9, '[\"Voltage: 1.20V\",\"Multi-channel Kit: Dual Channel Kit\",\"Features: v-color DDR4 32GB (2x16GB) 2400MHz (PC4-19200) SO-DIMM SK Hynix IC Laptop Memory Model\",\"Model #: TN416G24D817-VC\",\"Item #: 9SIAMCMCHG3083\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/0RM-00BF-00005-S01.jpg'),
('RAM0024365', 'CORSAIR Vengeance 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 2400 (PC4 19200) Memory (Notebook Memory) Model CMSX32GX4M2A2400C16', 2030458, 9999, 9, '[\"CAS Latency: 16\",\"Timing: 16-16-16-39\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CMSX32GX4M2A2400C16\",\"Item #: N82E16820236067\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-236-067-01.jpg'),
('RAM0034141', 'CORSAIR Vengeance 8GB 260-Pin DDR4 SO-DIMM DDR4 2400 (PC4 19200) Laptop Memory Model CMSX8GX4M1A2400C16', 582058, 9999, 9, '[\"CAS Latency: 16\",\"Timing: 16-16-16-39\",\"Voltage: 1.20V\",\"Features: 8GB (1x8GB) DDR4 SODIMM kit for 6th and 7th Generation Intel Core i7 notebooks and NUCs Auto-overclocking with compatible notebooks (no BIOS configuration required)\",\"Model #: CMSX8GX4M1A2400C16\",\"Item #: N82E16820236292\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-236-292-Z01.jpg'),
('RAM0047649', 'CORSAIR Vengeance 16GB 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model CMSX16GX4M1A2666C18', 1036457, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-19-19-39\",\"Voltage: 1.20V\",\"Features: 16GB (1x16GB) DDR4 SODIMM kit for Intel DDR4 notebooks and NUCs 2666MHz 18-19-19-39 latency 1.2V Auto-overclocking with compatible notebooks (no BIOS configuration required)\",\"Model #: CMSX16GX4M1A2666C18\",\"Item #: N82E16820236372\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-236-372-V01.jpg'),
('RAM0054180', 'G.SKILL Ripjaws SO-DIMM 8GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C18S-8GRS', 709858, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C18S-8GRS\",\"Item #: N82E16820232725\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-725-Z01.jpg'),
('RAM0064758', 'CORSAIR Vengeance 8GB 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model CMSX8GX4M1A2666C18', 553658, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-19-19-39\",\"Voltage: 1.20V\",\"Heat Spreader: Yes\",\"Model #: CMSX8GX4M1A2666C18\",\"Item #: N82E16820236371\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-236-371-V01.jpg'),
('RAM0076796', 'G.SKILL Ripjaws Series 64GB (2 x 32GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C22D-64GRS', 2882458, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C22D-64GRS\",\"Item #: N82E16820374025\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-374-025-S01.jpg'),
('RAM0085071', 'G.SKILL Ripjaws Series 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C22D-16GRS', 851858, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C22D-16GRS\",\"Item #: N82E16820374023\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-374-023-S01.jpg'),
('RAM0096937', 'G.SKILL Ripjaws Series 32GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C22S-32GRS', 1561858, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C22S-32GRS\",\"Item #: N82E16820374028\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-374-028-S01.jpg'),
('RAM0108819', 'Crucial 16GB (2 x 8GB) 204-Pin DDR3 SO-DIMM DDR3L 1600 (PC3L 12800) Laptop Memory Model CT2KIT102464BF160B', 1344030, 9999, 9, '[\"CAS Latency: 11\",\"Timing: 11-11-11\",\"Voltage: 1.35V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2KIT102464BF160B\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-148-614-02.jpg'),
('RAM0115728', 'Crucial 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CT2K16G4SFRA32A', 2010720, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K16G4SFRA32A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-263-V01.jpg'),
('RAM0128662', 'Team Elite 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model TED432G3200C22DC-S01', 1462458, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Features: All new generation product of DRAM module 1.2V memory module Massive 32GB Kit\",\"Model #: TED432G3200C22DC-S01\",\"Item #: N82E16820331504\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-331-504-V04.jpg'),
('RAM0138529', 'G.SKILL Ripjaws Series 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C18D-32GRS', 2413858, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C18D-32GRS\",\"Item #: N82E16820232714\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-714-S01.jpg'),
('RAM0144083', 'Crucial 64GB Kit (32GBx2) DDR4 3200 MT/s CL22 SODIMM 260-Pin Memory - CT2K32G4SFD832A', 3720400, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K32G4SFD832A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-242-01.jpg'),
('RAM0155147', 'Crucial 8GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CT8G4SFRA32A', 425574, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT8G4SFRA32A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-258-V01.jpg'),
('RAM0167605', 'Crucial 16GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CT16G4SFRA32A', 986616, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT16G4SFRA32A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-262-V01.jpg'),
('RAM0175399', 'Crucial 8GB 204-Pin DDR3 SO-DIMM DDR3L 1600 (PC3L 12800) Laptop Memory Model CT102464BF160B', 385956, 9999, 9, '[\"CAS Latency: 11\",\"Timing: 11-11-11\",\"Voltage: 1.35V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT102464BF160B\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-148-679-V01.jpg'),
('RAM0181935', 'Crucial 16GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CT16G4SFD832A', 1129042, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT16G4SFD832A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-219-V01.jpg'),
('RAM0199120', 'G.SKILL Ripjaws Series 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model F4-2666C18D-32GRS', 1533458, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-2666C18D-32GRS\",\"Item #: N82E16820232169\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-169-01.jpg'),
('RAM0202376', 'G.SKILL Ripjaws Series 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C16D-16GRS', 1419858, 9999, 9, '[\"CAS Latency: 16\",\"Timing: 16-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C16D-16GRS\",\"Item #: N82E16820232632\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-632-V01.jpg'),
('RAM0219099', 'Crucial 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CT2K16G4SFD832A', 2037132, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K16G4SFD832A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-220-V01.jpg'),
('RAM0223570', 'Crucial 4GB 204-Pin DDR3 SO-DIMM DDR3L 1600 (PC3L 12800) Laptop Memory Model CT51264BF160B', 229472, 9999, 9, '[\"CAS Latency: 11\",\"Voltage: 1.35V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT51264BF160B\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-191-394-03.jpg'),
('RAM0232177', 'Crucial 32GB Single DDR4 3200 MT/s CL22 SODIMM 260-Pin Memory - CT32G4SFD832A', 1818736, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT32G4SFD832A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/A24GD200509HDBKY.jpg'),
('RAM0242365', 'G.SKILL Ripjaws Series 8GB 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C22S-8GRS', 454258, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C22S-8GRS\",\"Item #: N82E16820374026\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-374-026-S01.jpg'),
('RAM0256689', 'CORSAIR Vengeance 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model CMSX32GX4M2A3200C22', 2101458, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-53\",\"Voltage: 1.20V\",\"Features: 32GB (2x16GB) DDR4 SODIMM kit for 8th Generation or newer Intel Core i7, and AMD Ryzen 4000 Seires notebooks 3200MHz 22-22-22-53 latency 1.2V Auto-overclocking with compatible notebooks (no BIOS configuration required)\",\"Model #: CMSX32GX4M2A3200C22\",\"Item #: N82E16820236681\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-236-681-V01.jpg'),
('RAM0268474', 'Crucial 16GB 260-Pin DDR4 2666 (PC4-21300) SDRAM SODIMM Memory Module, CL19, Unbuffered, Dual Ranked x8, 2048M x 64, Non-ECC, 1.2V (CT16G4SFD8266)', 943731, 9999, 9, '[\"CAS Latency: 19\",\"Timing: 19-19-19\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT16G4SFD8266\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/1X5-001S-002N6-V01.jpg'),
('RAM0274372', 'G.SKILL Ripjaws Series 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 2400 (PC4 19200) Laptop Memory Model F4-2400C16D-32GRS', 1490858, 9999, 9, '[\"CAS Latency: 16\",\"Timing: 16-16-16-39\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-2400C16D-32GRS\",\"Item #: N82E16820232156\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-156-01.jpg'),
('RAM0286850', 'Crucial 32GB (2 x 16GB) DDR4 2666MHz DRAM (Notebook Memory) CL19 1.2V DR SODIMM (260-pin) CT2K16G4SFD8266', 1942844, 9999, 9, '[\"CAS Latency: 19\",\"Timing: 19-19-19\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K16G4SFD8266\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-182-V01.jpg'),
('RAM0298210', 'Crucial 16GB Kit (8GBx2) DDR4 2400 MT/S (PC4-19200) SR x8 SODIMM 260-Pin Memory - CT2K8G4SFS824A', 794490, 9999, 9, '[\"CAS Latency: 17\",\"Timing: 17-17-17\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K8G4SFS824A\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/0ZK-0070-00010-S01.jpg'),
('RAM0306496', 'Team T-CREATE CLASSIC 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model TTCCD416G3200HC22DC-S01', 823458, 9999, 9, '[\"CAS Latency: 22\",\"Timing: 22-22-22-52\",\"Voltage: 1.20V\",\"Multi-channel Kit: Dual Channel Kit\",\"Model #: TTCCD416G3200HC22DC-\",\"Item #: N82E16820331685\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-331-685-V01.jpg'),
('RAM0315406', 'Crucial 8GB (2 x 4GB) 204-Pin DDR3 SO-DIMM DDR3 1333 (PC3 10600) Laptop Memory Model CT2KIT51264BC1339', 428982, 9999, 9, '[\"CAS Latency: 9\",\"Voltage: 1.50V\",\"Buffered\\/Registered: Unbuffered\",\"Multi-channel Kit: Dual Channel Kit\",\"Model #: CT2KIT51264BC1339\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-148-345-04.jpg'),
('RAM0324618', 'Crucial 32GB (2 x 16GB) 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model CT2K16G4SFRA266', 1491000, 9999, 9, '[\"CAS Latency: 19\",\"Timing: 19-19-19\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K16G4SFRA266\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-260-V01.jpg'),
('RAM0335478', 'Crucial Ballistix 3200 MHz DDR4 DRAM Laptop Gaming Memory Kit 16GB (8GBx2) CL16 BL2K8G32C16S4B', 1259682, 9999, 9, '[\"CAS Latency: 16\",\"Timing: 16-18-18-36\",\"Voltage: 1.35V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: BL2K8G32C16S4B\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-243-01.jpg'),
('RAM0345562', 'G.SKILL Ripjaws Series 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model F4-2666C18D-16GRS', 823458, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-2666C18D-16GRS\",\"Item #: N82E16820232166\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-166-01.jpg'),
('RAM0356274', 'G.SKILL Ripjaws SO-DIMM 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 3200 (PC4 25600) Laptop Memory Model F4-3200C18D-16GRS', 1348858, 9999, 9, '[\"CAS Latency: 18\",\"Timing: 18-18-18-43\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: F4-3200C18D-16GRS\",\"Item #: N82E16820232724\",\"Return Policy: Extended Holiday Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-232-724-Z01.jpg'),
('RAM0362499', 'Crucial 16GB (2 x 8GB) 260-Pin DDR4 SO-DIMM DDR4 2666 (PC4 21300) Laptop Memory Model CT2K8G4SFRA266', 932372, 9999, 9, '[\"CAS Latency: 19\",\"Timing: 19-19-19\",\"Voltage: 1.20V\",\"Buffered\\/Registered: Unbuffered\",\"Model #: CT2K8G4SFRA266\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/20-156-255-V01.jpg'),
('VGA0015650', 'ASRock OC Formula Radeon RX 6900 XT 16GB GDDR6 PCI Express 4.0 ATX Video Card RX6900XT OCF 16G', 26979858, 9999, 11, '[\"Core Clock: 2125 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4 with DSC\",\"HDMI: 1 x HDMI 2.1 VRR\",\"Model #: RX6900XT OCF 16G\",\"Item #: N82E16814930057\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-930-057-V01.jpg'),
('VGA0024281', 'MSI Gaming GeForce GTX 1050 Ti 4GB GDDR5 PCI Express 3.0 x16 ATX Video Card GTX 1050 Ti GAMING X 4G', 4401858, 9999, 11, '[\"Core Clock: 1379 MHz (OC) 1354 MHz (Gaming) 1290 MHz (Silent)\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 1 x DisplayPort 1.4\",\"DVI: 1 x DL-DVI-D\",\"Model #: GTX1050Ti GAMINGX 4G\",\"Item #: N82E16814137054\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-054-07.jpg'),
('VGA0038636', 'MSI GeForce GTX 1050 Ti 4GB GDDR5 PCI Express 3.0 x16 ATX Video Card GTX 1050 Ti 4GT OC', 3975858, 9999, 11, '[\"Core Clock: 1341 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 1 x DisplayPort 1.4\",\"DVI: 1 x DL-DVI-D\",\"Model #: GTX 1050 Ti 4GT OC\",\"Item #: N82E16814137055\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-055-08.jpg'),
('VGA0049204', 'ASUS TUF Gaming NVIDIA GeForce RTX 3080 V2 OC Edition Graphics Card (PCIe 4.0, 10GB GDDR6X, LHR, HDMI 2.1, DisplayPort 1.4a, Dual Ball Fan Bearings, Military-grade Certification, GPU Tweak II)', 23258890, 9999, 11, '[\"Core Clock: 1440 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Model #: TUF-RTX3080-O10G-V2-\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-525-V01.jpg'),
('VGA0057084', 'GIGABYTE GeForce RTX 3060 EAGLE 12G Graphics Card, 2 x WINDFORCE Fans, 12GB 192-bit GDDR6, GV-N3060EAGLE OC-12GD (rev. 2.0) (LHR) Video Card', 11743258, 9999, 11, '[\"Model #: B-GV-N3060EAGLE-12GD\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/APBUD210706PM10S.jpg'),
('VGA0062739', 'MSI Ventus GeForce RTX 3060 Ti 8GB GDDR6 PCI Express 4.0 Video Card RTX 3060 Ti VENTUS 2X 8G OCV1 LHR', 13433058, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 9.25\\\" x 4.88\\\"\",\"Model #: RTX306TVENTUS2X8OCV1\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-673-V13.jpg'),
('VGA0072723', 'ZOTAC GAMING GeForce GTX 1650 OC 4GB GDDR6 128-bit Gaming Graphics Card, Super Compact, ZT-T16520F-10L', 5253858, 9999, 11, '[\"DisplayPort: 1 x DisplayPort 1.4\",\"DVI: Dual Link DVI-D\",\"HDMI: 1 x HDMI 2.0b\",\"Card Dimensions (L x H): 5.94\\\" x 4.38\\\"\",\"Model #: ZT-T16520F-10L\",\"Item #: N82E16814500494\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-500-494-S01.jpg'),
('VGA0082426', 'GIGABYTE AORUS GeForce RTX 3070 MASTER 8GB GDDR6 PCI Express 4.0 ATX Video Card GV-N3070AORUS M-8GD (rev. 2.0) (LHR)', 17039858, 9999, 11, '[\"Core Clock: 1845 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1, 1 x HDMI 2.0 (The middle HDMI output supports up to HDMI 2.0)\",\"Model #: GV-N3070AORUS M-8GR2\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-466-V01.jpg'),
('VGA0098487', 'Yeston Radeon RX6700XT 12GB D6 GDDR6 192bit 7nm Desktop computer PC Video Graphics Cards support PCI-Express 4.0 3*DP+1*HDMI-compatible   RGB light effect Fragrant graphics card', 15605800, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort\",\"HDMI: 1 x HDMI\",\"DirectX: DirectX 12\",\"Model #: Yeston RX6700XT-12G D6 YA\",\"Item #: 9SIAZUEFG03135\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/AZUES210810Es1bW.jpg');
INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `id_jenis_barang`, `deskripsi`, `urlgambar`) VALUES
('VGA0107125', 'Yeston Radeon RX6800XT 16GB D6 GDDR6 256bit 7nm Desktop computer PC Video Graphics Cards support PCI-Express 4.0 2*DP+1*HDMI-compatible +1*Type c  RGB light effect Fragrant graphics card', 22421800, 9999, 11, '[\"Core Clock: 2065MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 2 x DisplayPort\",\"HDMI: 1 x HDMI\",\"Model #: RX6800XT-16G D6 YA\",\"Item #: 9SIAZUEEWF9229\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/AZUES210617UyeXt.jpg'),
('VGA0117124', 'MSI Gaming Radeon RX 6900 XT 16GB GDDR6 PCI Express 4.0 Video Card RX 6900 XT GAMING Z TRIO 16G', 26979858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 12.76\\\" x 5.55\\\"\",\"Model #: RX 6900XTGAMINGZTRIO\",\"Item #: N82E16814137654\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-654-01.jpg'),
('VGA0121500', 'GIGABYTE Gaming OC GeForce RTX 3080 10GB GDDR6X PCI Express 4.0 ATX Video Card GV-N3080GAMING OC-10GD (rev. 2.0) (LHR)', 21540974, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 12.60\\\" x 5.08\\\"\",\"Model #: GV-N3080GAMING OC-10\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-459-V11.jpg'),
('VGA0138564', 'GIGABYTE GeForce RTX 3090 GAMING OC 24G Video Card, GV-N3090GAMING OC-24GD', 43948716, 9999, 11, '[\"Core Clock: 1755 MHz\",\"Max Resolution: 7680 x 4320 @ 60 Hz\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Model #: GVN3090GAMINGOC24GD\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-327-V11.jpg'),
('VGA0146853', 'MSI Gaming GeForce RTX 3060 Ti 8GB GDDR6 PCI Express 4.0 Video Card RTX 3060 Ti Gaming X 8G LHR', 14625858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 10.94\\\" x 5.16\\\"\",\"Model #: RTX3060TGamingX8GLHR\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-672-V02.jpg'),
('VGA0158607', 'MSI Gaming GeForce RTX 3070 8GB GDDR6 PCI Express 4.0 Video Card 3070 GAMING Z TRIO 8G LHR', 16755858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 12.72\\\" x 5.51\\\"\",\"Model #: RTX307GamingZTrioLHR\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-670-V05.jpg'),
('VGA0161255', 'ASRock Radeon RX 6900 XT PHANTOM GAMING D Graphics Card 16GB GDDR6, AMD RDNA2 (RX6900XT PGD 16GO)', 22719858, 9999, 11, '[\"Core Clock: 1925 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4 with DSC\",\"HDMI: 1 x HDMI 2.1 VRR\",\"Model #: RX6900XT PGD 16GO\",\"Item #: N82E16814930052\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-930-052-01.jpg'),
('VGA0172605', 'Yeston Radeon RX6800 16GB D6 GDDR6 256bit 7nm Desktop computer PC Video Graphics Cards support PCI-Express 4.0 3*DP+1*HDMI-compatible graphics card', 24125800, 9999, 11, '[\"Core Clock: 1980MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort\",\"HDMI: 1 x HDMI\",\"Model #: Yeston RX6800-16G D6 PA\",\"Item #: 9SIAZUEGA78740\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/AZUES211020mGebc.jpg'),
('VGA0184715', 'ASUS ROG Strix GeForce RTX 3080 10GB GDDR6X PCI Express 4.0 Video Card ROG-STRIX-RTX3080-O10G-GAMING', 26238618, 9999, 11, '[\"Core Clock: 1440 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Model #: ROG-STRIX-RTX3080-O1\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-457-V01.jpg'),
('VGA0193289', 'XFX SPEEDSTER MERC319 AMD Radeon RX 6900XT LIMITED BLACK Gaming Graphics Card with 16GB GDDR6, AMD RDNA 2, RX-69XTACSD9', 24139858, 9999, 11, '[\"Core Clock: 2150 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 2 x DisplayPort 1.4\",\"HDMI: 1 x HDMI 2.1\",\"Model #: RX-69XTACSD9\",\"Item #: N82E16814150859\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-150-859-V04.jpg'),
('VGA0207389', 'ASUS ROG Strix NVIDIA GeForce RTX 3080 Ti OC Edition Gaming Graphics Card (PCIe 4.0, 12GB GDDR6X, HDMI 2.1, Axial-tech Fan Design, 2.9-Slot, Super Alloy Power II, ASUS Auto-Extreme Technology)', 36919858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 12.53\\\" x 5.51\\\"\",\"Model #: STRIX-RTX3080TI-O12G\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-508-V19.jpg'),
('VGA0213580', 'GIGABYTE AORUS GeForce RTX 3070 Ti 8GB GDDR6X PCI Express 4.0 ATX Video Card GV-N307TAORUS M-8GD', 19240432, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1  1 x HDMI 2.0 (The middle HDMI output supports up to HDMI 2.0)\",\"Card Dimensions (L x H): 12.76\\\" x 5.59\\\"\",\"Model #: GV-N307TAORUS M-8GD\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-441-01.jpg'),
('VGA0229075', 'ASUS GeForce RTX 2060 DUAL EVO 6 GB GDDR6 Graphics Card (DUAL-RTX2060-6G-EVO)', 9485600, 9999, 11, '[\"Core Clock: OC Mode: 1395 MHz Gaming Mode (Default): 1365 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 1 x DisplayPort 1.4\",\"DVI: 1 x DVI-D\",\"Model #: DUAL-RTX2060-6G-EVO\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/1FT-000Y-00496-V04.jpg'),
('VGA0236220', 'ASUS ROG STRIX GeForce RTX 3080 10GB GDDR6X PCI Express 4.0 x16 ATX Video Card ROG-STRIX-RTX3080-O10G-WHITE-V2 (LHR)', 24862496, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 12.53\\\" x 5.51\\\"\",\"Model #: RTX3080-O10G-WHT-V2\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-533-V01.jpg'),
('VGA0241749', 'GIGABYTE AORUS GeForce RTX 3090 XTREME WATERFORCE WB 24G Graphics Card, WATERFORCE Water Block Cooling System, 24GB 384-bit GDDR6X, GV-N3090AORUSX WB-24GD Video Card', 45439858, 9999, 11, '[\"Core Clock: 1785 MHz\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1, 1 x HDMI 2.0 (The middle HDMI output supports up to HDMI 2.0)\",\"Card Dimensions (L x H): 9.92\\\" x 6.42\\\"\",\"Model #: GV-N3090AORUSXWB24GD\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-386-V12.jpg'),
('VGA0254150', 'SAPPHIRE Toxic Radeon RX 6900 XT 16GB GDDR6 PCI Express 4.0 ATX Video Card 11308-06-20G', 26979858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): Board: 10.63\\\" x 5.12\\\" Hex \\/ Radiator: 14.17\\\" x 4.72\\\" Standard Rubber Tubing: 18.50\\\"\",\"Model #: 11308-06-20G\",\"Item #: N82E16814202396\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-202-396-01.jpg'),
('VGA0269158', 'GIGABYTE Radeon RX 6600 EAGLE 8G Graphics Card, WINDFORCE 3X Cooling System, 8GB 128-bit GDDR6, GV-R66EAGLE-8GD Video Card', 8945858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 2 x DisplayPort\",\"HDMI: 2 x HDMI\",\"Card Dimensions (L x H): 11.10\\\" x 4.45\\\"\",\"Model #: GV-R66EAGLE-8GD\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-481-V01.jpg'),
('VGA0273073', 'GIGABYTE Eagle OC GeForce RTX 3060 12GB GDDR6 PCI Express 4.0 ATX Video Card GV-N3060EAGLE OC-12GD (rev. 2.0) (LHR)', 11927858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 2 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 9.53\\\" x 4.88\\\"\",\"Model #: GV-N3060EAGLE OC-12G\",\"Item #: 9SIAPMXFCV6628\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-434-V01.jpg'),
('VGA0282910', 'GIGABYTE Vision OC GeForce RTX 3080 10GB GDDR6X PCI Express 4.0 ATX Video Card GV-N3080VISION OC-10GD (rev. 2.0) (LHR)', 22498338, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 12.60\\\" x 4.96\\\"\",\"Model #: GV-N3080VISION OC-10\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-460-V01.jpg'),
('VGA0295394', 'MSI Ventus GeForce GTX 1660 SUPER 6GB GDDR6 PCI Express 3.0 x16 Video Card GTX 1660 SUPER VENTUS XS OC', 9200180, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.0b\",\"Card Dimensions (L x H): 8.03\\\" x 5.04\\\"\",\"Model #: 1660SuperVentusXSOC\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-475-01.jpg'),
('VGA0306716', 'ASUS ROG Strix GeForce RTX 3080 V2 OC Edition 10GB GDDR6X PCI Express 4.0 x16 Video Card ROG-STRIX-RTX3080-O10G-V2-GAMING (LHR)', 24707858, 9999, 11, '[\"Core Clock: 1440 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Model #: STRX-RTX3080-O10G-V2\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-534-V19.jpg'),
('VGA0319096', 'ASUS TUF Gaming GeForce RTX 3090 24GB GDDR6X PCI Express 4.0 SLI Support Video Card TUF-RTX3090-O24G-GAMING', 44942716, 9999, 11, '[\"Core Clock: 1770 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Model #: TUF-RTX3090-O24G-GAM\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-454-01.jpg'),
('VGA0329968', 'EVGA GeForce RTX 3070 FTW3 ULTRA GAMING Video Card, 08G-P5-3767-KL, 8GB GDDR6, iCX3 Technology, ARGB LED, Metal Backplate, LHR', 16244658, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 11.81\\\" x 5.38\\\"\",\"Model #: 08G-P5-3767-KL\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-487-544-V04.jpg'),
('VGA0338457', 'MSI Gaming GeForce GTX 1660 SUPER 6GB GDDR6 PCI Express 3.0 x16 Video Card GTX 1660 SUPER GAMING X', 9797858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.0b\",\"Card Dimensions (L x H): 9.72\\\" x 5.00\\\"\",\"Model #: 1660SuperGamingX\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-476-V01.jpg'),
('VGA0346029', 'ASUS TUF Gaming GeForce GTX 1650 OC Edition 4GB GDDR6 PCI Express 3.0 Video Card TUF-GTX1650-O4GD6-P-GAMING', 4876138, 9999, 11, '[\"Core Clock: 1410 MHz\",\"Max Resolution: 7680 x 4320\",\"DisplayPort: 1 x DisplayPort 1.4\",\"DVI: 1 x DVI-D\",\"Model #: TUF-GTX1650-O4GD6-P-\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-126-445-01.jpg'),
('VGA0354022', 'MSI Gaming GeForce RTX 3080 Ti 12GB GDDR6X PCI Express 4.0 Video Card RTX 3080 Ti Gaming X Trio 12G', 31026289, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 3 x DisplayPort 1.4a\",\"HDMI: 1 x HDMI 2.1\",\"Card Dimensions (L x H): 12.76\\\" x 5.51\\\"\",\"Model #: 3080tiGamingXTrio12G\",\"Return Policy: View Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-137-650-V01.jpg'),
('VGA0362148', 'GIGABYTE AORUS Radeon RX 6900 XT 16GB GDDR6 PCI Express 4.0 ATX Video Card GV-R69XTAORUSX WB-16GD', 25559858, 9999, 11, '[\"Max Resolution: 7680 x 4320\",\"DisplayPort: 2 x DisplayPort 1.4a\",\"HDMI: 2 x HDMI 2.1\",\"Card Dimensions (L x H): 11.10\\\" x 5.75\\\"\",\"Model #: GV-R69XTAORUSX WB-16\",\"Item #: N82E16814932446\",\"Return Policy: Extended Holiday Replacement-Only Return Policy\"]', 'https://c1.neweggimages.com/ProductImageCompressAll300/14-932-446-V04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_review`
--

DROP TABLE IF EXISTS `produk_review`;
CREATE TABLE `produk_review` (
  `id_review` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `rating` int(10) NOT NULL,
  `tanggal_review` date NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `userrname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relasi_jenis`
--

DROP TABLE IF EXISTS `relasi_jenis`;
CREATE TABLE `relasi_jenis` (
  `id_jenis` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `id_datatransaksi` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `saldo` int(100) NOT NULL,
  `id_wishlist` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id_wishlist` varchar(10) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga` int(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `urlgambar` varchar(1000) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `daftar_jenis`
--
ALTER TABLE `daftar_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`id_datatransaksi`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `history_transaksi`
--
ALTER TABLE `history_transaksi`
  ADD PRIMARY KEY (`id_historytransaksi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `produk_review`
--
ALTER TABLE `produk_review`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `nama_barang` (`nama_barang`(768)),
  ADD KEY `userrname` (`userrname`);

--
-- Indexes for table `relasi_jenis`
--
ALTER TABLE `relasi_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_datatransaksi` (`id_datatransaksi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_wishlist` (`id_wishlist`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_jenis`
--
ALTER TABLE `daftar_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
