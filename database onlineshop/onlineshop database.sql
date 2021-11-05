-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2021 at 06:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `foto_profil`) VALUES
(15, 'argya', '$2y$10$72bzu82yCz0oUY3k.hMcIeFVKUiHqFGHA.Qap6/83NUymm5h9awsa', 'argya rijal rafi', '_MG_4577.JPG'),
(18, 'rijal', '$2y$10$z93mlhbMm1tTmdXXu/V3n.T9ZdKTQXT7uXS.pW/51QsV0GncZTNEK', 'inrico', '_MG_0090.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(250) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(29, 'emans6050@gmail.com', '$2y$10$Le0WN.SWqd3pqYTbni.PHe.rLOaJHxSwia42qmNFRwZHpHjmNLo2.', 'bimo arga ', '0814132112'),
(30, 'abah@gmail.com', '$2y$10$nKp2K/pv0Z5GfOoZgOsKY.CGDH5RTnaA/mZcoIFhv1FWJ8xO64iNu', 'abah', '0813136717'),
(31, 'dani@gmail.com', '$2y$10$5bsfWxtQE.2fRTEXc5oaCubx0aRHLNdkR0HddXt8XQp3pNtTbA85i', 'dani maripola', '081545635'),
(32, 'emans6050@gmail.com', '$2y$10$UoXEDNflmU3UVBAEqXpSTeJtfemDLAJiiGGhteOqJE5R4JjTukdQu', 'argya rjal', '081394728945');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_rumah` varchar(100) NOT NULL,
  `status_pembelian` varchar(50) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `id_ongkir`, `nama_kota`, `tarif`, `alamat_rumah`, `status_pembelian`, `resi_pengiriman`) VALUES
(38, 29, '2021-01-28', 110000, 2, 'bandung', 20000, 'cimahi kota sampah', 'Barang Dikirim', 'ABCDSF12345432'),
(39, 30, '2021-01-28', 60000, 1, 'Pangandaran', 10000, 'kuningan jawbarat', 'Barang Dikirim', 'ABCDSF12345432'),
(40, 29, '2021-01-29', 100000, 1, 'Pangandaran', 10000, 'desa sindangjaya kec mangunjaya kab pangandaran', 'pending', ''),
(41, 31, '2021-01-29', 200000, 2, 'bandung', 20000, 'sarijadi desa ciwaruga', 'Barang Dikirim', 'ASBGH123454231'),
(42, 30, '2021-01-29', 80000, 1, 'Pangandaran', 10000, 'desa sindangjaya', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `berat` float NOT NULL,
  `sub_berat` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `nama`, `harga`, `berat`, `sub_berat`, `sub_harga`, `jumlah`) VALUES
(38, 33, 34, 'kerudung muslimah ', 50000, 1, 1, 50000, 1),
(39, 34, 33, 'cardigan kekinian', 70000, 1, 1, 70000, 1),
(40, 35, 27, 'cardigan pria', 50000, 1, 1, 50000, 1),
(41, 36, 27, 'cardigan pria', 50000, 1, 1, 50000, 1),
(42, 37, 28, 'cardigan all gender', 70000, 350, 350, 70000, 1),
(43, 37, 29, 'cardigan merah jambu', 50000, 150, 300, 100000, 2),
(44, 38, 24, 'cardigan coffee', 90000, 250, 250, 90000, 1),
(45, 39, 27, 'cardigan pria', 50000, 300, 300, 50000, 1),
(46, 40, 24, 'cardigan coffee', 90000, 250, 250, 90000, 1),
(47, 41, 24, 'cardigan coffee', 90000, 250, 500, 180000, 2),
(48, 42, 28, 'cardigan all gender', 70000, 350, 350, 70000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` float NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(27, 1, 'cardigan pria', 50000, 300, '10.png', 'cardigan pria yang elegant dan membuat kita terliat fashionable dengan bahan sutra sehingga lembut saat di gunakan                             ', 0),
(28, 1, 'cardigan all gender', 70000, 350, '12.png', 'cardigan ini cocok untuk pria maupun wanita dengan bahan kain rajutan tangan sehingga terlihat lebih elegant dan nyaman di gunakan dalam cuaca panas atau pun dingin                      ', 0),
(29, 1, 'cardigan merah jambu', 50000, 150, '5.png', 'cardigan wanita yang lucu dan imut dengan bahan yang lembut mampu membuat anda terlihat lebih feminim       ', 3),
(30, 1, 'cardigan musim dingin', 100000, 200, '11.png', 'cardigan ini cocok untuk musim pancaroba karena memiliki bahan dari kain wol sehingga bisa membuat anda hangat sehangat anda dalam pelukan nya               ', 4),
(31, 1, 'cardigan vanila', 65000, 400, '4.png', 'cardigan nyaman dengan warna yang relatif lebih sejuk dan hangat saaat di gunakan         ', 5),
(33, 1, 'cardigan kekinian', 70000, 400, '8.png', 'cardigan yang sangat cocok untuk wanita yang luar biasa               ', 4),
(34, 2, 'kerudung muslimah ', 50000, 150, 'kerudung 3.jpg', 'kerudung segi empat untuk muslimah yang ingin berhijrah dengan corak bunga yang indah                                                                ', 4),
(35, 2, 'kerudung muslimah edan parah', 100000, 119, 'ker 2.png', 'kerudung dengan bahan sutra yang lembut dan tidak gatal saat di kenakan                      ', 10),
(36, 2, 'cardiBy.me segi4 for muslimah', 230000, 500, 'ker3.png', 'couple muslimah style untuk sahabat atau hadiah kepada adik sangat cocok sekali dengan design yang elegant dan mewah dan bahan yang lembut        ', 9),
(37, 2, 'kerudung muslimah segi empat', 100000, 150, 'ker4.png', 'bahan ringan dan sejuk saat di kenakan dan memiliki tingkan kelembutan yang super sotf sehingga bisa membuat anda betah memakai kerudung ini meskipun di kenakan seharian       ', 11),
(38, 2, 'Kerudung cardiBy.me muslimah', 120000, 140, 'kerudung 8.jpg', 'bahan karet gelang yang istimewa sehingga bisa membuat para pengguna nya dapat ketenangan dan kedaimaian        ', 5),
(39, 5, 'CardiBy.me Gamis Muslimah', 250000, 250, 'muslim.png', 'gamis yang lembut dan tidak gerah pada saat cuaca panas tapi juga tidak tipis karena bahan yng di gunakan adakan bahan sintesis wol yaitu bahan yang menjadi alternatif di autralia agar hemat dan ramah lingkungan       ', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
