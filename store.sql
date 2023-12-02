-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2023 pada 08.30
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `store`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('jony1111', '24c813b514da88431085eae7ec8b5c1a6a75065bc6db10d03bd5d6fe7e97fe7c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`) VALUES
(1, 'Mandiri'),
(2, 'BCA'),
(3, 'BRI'),
(4, 'BNI'),
(5, 'CIMB Niaga'),
(6, 'Permata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`username`, `password`, `nama`, `no_telepon`, `alamat`) VALUES
('jony1', 'bfb93779290d84d77f1f59c870546786c37fc0cdef831be509bac82cba73e6ee', 'John Doe', '546026372300', '123 Main St'),
('jony10', 'b19b6a91d08148ffca621c2a7c41da1efe69fea33194b16828fce6ce331ed1ff', 'Helen Turner', '728482191477', '707 Elm Ave'),
('jony2', 'fe403e47fe351da63e66e142265f3c7898f74bc96a8cb25bfb03f24076abd9db', 'Jane Smith', '765866192119', '456 Oak Ave'),
('jony3', 'a580291384145df7176c43e13da43afcefcf856ebb005bb1a2a46f9f6891972e', 'Bob Johnson', '291251871354', '789 Pine St'),
('jony4', 'd9e83bd7a318b8b56c96ceba41b8695899e17d98656ea14c0c1ec84ed9b14c82', 'Alice Williams', '858660808073', '101 Elm Rd'),
('jony4444', 'e3eb1eb3ffc8ed284779baed2ca7b820b8e31164832dafc3b41b1dcd25d5ead3', 'Albert Enstein', '082176764422', 'Amerika Serikat'),
('jony5', '8dec442eb6e72878773779a84db884393b6dbf943ce34ebde178c89f55cab896', 'Charlie Brown', '619548453967', '202 Maple Ave'),
('jony5555', '4096519cef775688443de922e8131013cfa0d54b9361924a81c48c7053f76bf1', 'Donald Trump', '082177778888', 'Irlandia'),
('jony6', 'e220a880c23388245d024d54750d44417c61737c8bcffa26a528d6acfd29868c', 'Eva Davis', '421759873276', '303 Birch St'),
('jony7', '03e90b316a82f67b44439c1999308ac6780bb0144dac56bc9ce0e32c1b378a44', 'David Lee', '150154032139', '404 Cedar Rd'),
('jony8', '1d247009488744b6c1d9c9371323e52bd5e6ee24c74bf145d18ef8b0b653ac61', 'Fiona Wilson', '285490568527', '505 Pine Ave'),
('jony9', '5028de0d27d08ea3a91563e016ed411135cf70217f68f9a86e8f0ab87b19ff07', 'George Miller', '876990773879', '606 Oak St'),
('tes3', 'cdbeadf064ea9d267afc24cc64086fb195deb0df2b42bdd940c666a8e1ec8863', 'Budi Sanjaya', '0187328197234', 'telang indah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Bonsai Buah'),
(3, 'Bonsai Bunga'),
(4, 'Bonsai Conifer'),
(5, 'Bonsai Daun Lebar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `username`) VALUES
(50, 'jony4444');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_detail`
--

CREATE TABLE `keranjang_detail` (
  `id_keranjang_detail` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `keranjang_detail`
--

INSERT INTO `keranjang_detail` (`id_keranjang_detail`, `id_keranjang`, `id_produk`) VALUES
(163, 50, 17),
(164, 50, 16),
(165, 50, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `manajer`
--

CREATE TABLE `manajer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `manajer`
--

INSERT INTO `manajer` (`username`, `password`) VALUES
('jony1234', 'cd9984ad7b5a8aff78d7ef83b641efecfccc4a0565ad49dc28d285f7557ed39b'),
('jony3333', '0c5ed5d3952a45ee6aea0952a8d5e8df3d575b39e025b55438ea6beddf95ab79');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `total_order` int(11) NOT NULL,
  `tanggal_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_bank` int(11) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `username`, `total_order`, `tanggal_order`, `id_bank`, `no_rekening`, `status`) VALUES
(58, 'jony4444', 180000, '2023-11-20 05:55:50', 2, '0128301381332235', 1),
(59, 'jony1', 300000, '2023-11-21 05:55:50', 2, '1234567890123456', 1),
(60, 'jony10', 240000, '2023-11-23 13:57:59', 2, '2345678901234567', 1),
(61, 'jony2', 600000, '2023-11-23 05:55:50', 2, '3456789012345678', 1),
(62, 'jony3', 600000, '2023-11-24 05:55:50', 2, '4567890123456789', 0),
(63, 'jony4', 360000, '2023-11-25 05:55:50', 2, '5678901234567890', 1),
(64, 'jony5', 640000, '2023-11-26 05:55:50', 2, '6789012345678901', 0),
(65, 'jony5555', 450000, '2023-11-27 05:55:50', 2, '7890123456789012', 1),
(66, 'jony6', 1260000, '2023-11-28 05:55:50', 2, '8901234567890123', 0),
(67, 'jony7', 1700000, '2023-11-29 05:55:50', 2, '9012345678901234', 1),
(69, 'jony4444', 310000, '2023-11-21 07:04:29', 3, '432985679239', 1),
(70, 'jony4444', 480000, '2023-11-22 07:44:29', 1, '0128301381332235', 1),
(76, 'jony4444', 150000, '2023-11-24 08:18:19', 1, '903218481723984', 1),
(78, 'jony4444', 900000, '2023-11-25 05:41:55', 1, '0128301381332235', 0),
(79, 'jony4444', 180000, '2023-11-26 13:53:06', 2, '109833848974', 0),
(81, 'jony4444', 340000, '2023-11-26 14:03:17', 5, '13807820353272', 0),
(82, 'tes3', 380000, '2023-11-29 07:50:54', 5, '23942935929943', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `id_order`, `id_produk`, `jumlah_produk`, `harga_total`) VALUES
(62, 58, 12, 1, 180000),
(63, 59, 11, 2, 300000),
(64, 60, 18, 3, 240000),
(65, 61, 19, 4, 600000),
(66, 62, 20, 5, 600000),
(67, 63, 22, 6, 360000),
(68, 64, 23, 7, 1260000),
(69, 65, 27, 8, 640000),
(70, 66, 28, 9, 450000),
(71, 67, 29, 10, 1700000),
(74, 69, 11, 1, 150000),
(75, 69, 14, 1, 160000),
(76, 70, 11, 2, 300000),
(77, 70, 12, 1, 180000),
(87, 76, 11, 1, 150000),
(90, 78, 11, 6, 900000),
(91, 79, 16, 1, 180000),
(94, 81, 11, 1, 150000),
(95, 81, 17, 1, 190000),
(96, 82, 17, 2, 380000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_supplier`, `nama_produk`, `harga_produk`, `stok_produk`, `gambar_produk`, `id_kategori`, `created_at`) VALUES
(11, 2, 'Bonsai Jeruk', 150000, 6, '655862559e56d.jpeg', 2, '2023-11-24 08:18:19'),
(12, 4, 'Bonsai Apel', 180000, 6, '6558636905db9.jpeg', 2, '2023-11-22 07:44:29'),
(13, 3, 'Bonsai Anggur', 100000, 15, '655863f28b5d7.jpeg', 2, '2023-11-18 07:12:50'),
(14, 2, 'Bonsai Plum', 160000, 6, '6558642fe0ce4.jpeg', 2, '2023-11-21 07:04:29'),
(15, 6, 'Bonsai Persik', 200000, 5, '6558647ba7906.jpeg', 2, '2023-11-18 07:15:07'),
(16, 2, 'Bonsai Delima', 180000, 9, '655864c40dc18.jpeg', 2, '2023-11-18 07:16:20'),
(17, 5, 'Bonsai Sakura', 190000, 3, '6568211045bd4.jpeg', 3, '2023-11-30 05:43:44'),
(18, 4, 'Bonsai Mawar', 80000, 15, '6558652e881e7.jpeg', 3, '2023-11-23 13:57:59'),
(19, 5, 'Bonsai Azalea', 150000, 10, '65586570403f4.jpeg', 3, '2023-11-18 07:19:12'),
(20, 6, 'Bonsai Camellia', 170000, 12, '655865979afea.jpeg', 3, '2023-11-18 07:19:51'),
(21, 3, 'Bonsai Lily', 120000, 15, '655865d847de3.jpeg', 3, '2023-11-18 07:20:56'),
(22, 2, 'Bonsai Bunga Matahari', 60000, 20, '655865f5aeea6.jpeg', 3, '2023-11-18 07:21:25'),
(23, 4, 'Bonsai Wisteria', 180000, 4, '6558662031437.jpeg', 3, '2023-11-18 07:22:08'),
(24, 2, 'Bonsai Pine', 150000, 6, '6558664d777fb.jpeg', 4, '2023-11-18 07:22:53'),
(25, 6, 'Bonsai Juniper', 120000, 8, '65586676e7583.jpeg', 4, '2023-11-18 07:23:34'),
(26, 5, 'Bonsai Maple', 130000, 7, '655866e09e5b6.jpeg', 5, '2023-11-18 07:26:41'),
(27, 6, 'Bonsai Ficus', 70000, 25, '6558679a575f6.jpeg', 5, '2023-11-18 07:28:26'),
(28, 4, 'Bonsai Jade', 50000, 30, '655867ca42393.jpeg', 5, '2023-11-18 07:29:14'),
(29, 3, 'Bonsai Oak', 170000, 10, '655867edf1c3f.jpeg', 5, '2023-11-18 07:29:49'),
(30, 4, 'Bonsai Spruce', 140000, 10, '65586839f3d63.jpeg', 4, '2023-11-18 07:31:06'),
(31, 5, 'Bonsai Cedar', 120000, 8, '6558685b11afc.jpeg', 4, '2023-11-18 07:31:39'),
(32, 6, 'Bonsai Yew', 160000, 12, '655868fe52be8.jpeg', 4, '2023-11-18 07:34:22'),
(33, 2, 'Bonsai Fir', 130000, 15, '6558692c842cf.jpeg', 4, '2023-11-18 07:35:08'),
(34, 3, 'Bonsai Larch', 150000, 7, '6558694d0854f.jpeg', 4, '2023-11-18 07:35:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telepon`) VALUES
(2, 'Bonsai World', 'Jl. Bonsai No. 123, Kota Bonsai', '081234567890'),
(3, 'Green Gardens', 'Jl. Kebun Bonsai 5, Kota Bonsai', '085678901234'),
(4, 'Nature\'s Art', 'Jl. Indah Bonsai 8, Desa Bonsai', '081112223344'),
(5, 'Bonsai Jaya', 'Jl. Bunga Indah No. 123, Kota Bonsai', '081234567890'),
(6, 'Bonsai Berkah', 'Jl. Cinta Alam 15, Perkampungan Bonsai', '089912345678');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `FK_Menambahkan` (`username`);

--
-- Indeks untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD PRIMARY KEY (`id_keranjang_detail`),
  ADD KEY `FK_keranjang_memiliki` (`id_keranjang`),
  ADD KEY `FK_menambahkan_produk` (`id_produk`);

--
-- Indeks untuk tabel `manajer`
--
ALTER TABLE `manajer`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_pesan` (`username`),
  ADD KEY `id_bank` (`id_bank`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `FK_memiliki_order` (`id_order`),
  ADD KEY `FK_pesan_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `FK_supply` (`id_supplier`),
  ADD KEY `FK_memiliki_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  MODIFY `id_keranjang_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_Menambahkan` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Ketidakleluasaan untuk tabel `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD CONSTRAINT `FK_keranjang_memiliki` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_menambahkan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_pesan` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`);

--
-- Ketidakleluasaan untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_memiliki_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  ADD CONSTRAINT `FK_pesan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `FK_memiliki_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `FK_supply` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
