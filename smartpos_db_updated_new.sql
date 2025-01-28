-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Jan 2025 pada 02.15
-- Versi server: 9.1.0
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartpos_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_barang` text NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `id_supplier` int DEFAULT NULL,
  `id_merk` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `stok` text NOT NULL,
  `upload_gambar` varchar(200) DEFAULT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `id_kategori`, `id_supplier`, `id_merk`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`, `upload_gambar`, `tgl_input`, `tgl_update`) VALUES
(18, 'BR002', 'test', 3, 26, 31, 1, '2500', '3000', '3', '6798267748bd6.jpg', '2025-01-26 18:56:42', '2025-01-28 07:36:07'),
(19, 'BR003', 'hhh', 3, 26, 30, 1, '1000', '1500', '4', '679826621fd20.jpg', '2025-01-26 18:58:08', '2025-01-28 08:52:07'),
(21, 'BR005', 'sdsdsdsd', 2, 25, 29, 4, '10000', '12000', '-5', '679826e631dc4.jpg', '2025-01-26 19:04:48', '2025-01-28 08:58:00'),
(24, 'BR006', 'Gehu Pedas', 2, 25, 29, 1, '1000', '2500', '65', '', '2025-01-28 08:24:30', '2025-01-28 09:15:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `tgl_input`, `tgl_update`) VALUES
(2, 'KAT 1', '2025-01-27 01:26:43', '2025-01-27 01:26:55'),
(3, 'KAT 3', '2025-01-27 13:31:31', '2025-01-27 13:31:31'),
(4, 'KAT 2', '2025-01-27 13:31:36', '2025-01-27 13:31:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(128) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `id_member` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `role`, `id_member`) VALUES
(1, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin', 1),
(19, 'steven', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'kasir', 15),
(20, 'steven123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin', 16),
(21, '1111', '0ffe1abd1a08215353c233d6e009613e95eec4253832a761af28ff37ac5a150c', 'admin', 17),
(22, 'herihadian', '246d4ea4e0e7fbea206843033c6005ea7c90f046212ba676555d23997d5c1406', 'admin', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
(1, 'SmartPoS', 'Universitas Siber Asia', '-', 'Smartpos@gmail.com', '17325911023.jpg', '-'),
(15, 'Admin', '2', '2', '2@gmail.com', '1714378963av2.png', '2'),
(16, 'steven', '', '', '', '1714378963av2.png', ''),
(17, '1111', '', '', '', '1714378963av2.png', ''),
(18, 'Heri', '', '', '', '1737917068Screenshot 2025-01-25 at 09.37.19.png', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id` int NOT NULL,
  `kode_merk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_merk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id`, `kode_merk`, `nama_merk`, `tgl_input`, `tgl_update`) VALUES
(29, 'MR001', 'NAMA MERK', '2025-01-27 01:09:51', '2025-01-27 01:09:51'),
(30, 'MR002', 'NAMA MERK 2', '2025-01-27 01:09:56', '2025-01-27 01:09:56'),
(31, 'MR003', 'NAMA MERK 3', '2025-01-27 01:10:01', '2025-01-27 01:10:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` int NOT NULL,
  `id_transaksi` int DEFAULT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` double DEFAULT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `periode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_transaksi`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
(1578, 8, 'BR005', 18, '5', 60000, '2025-01-28 08:52:25', '01-2025'),
(1579, 8, 'BR006', 18, '10', 25000, '2025-01-28 08:52:33', '01-2025'),
(1580, 9, 'BR006', 18, '4', 10000, '2025-01-28 09:06:52', '01-2025'),
(1581, 10, 'BR006', 18, '1', 2500, '2025-01-28 09:15:10', '01-2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `kode_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode_pelanggan`, `nama_pelanggan`, `alamat`, `telepon`, `tgl_input`, `tgl_update`) VALUES
(2, 'PL001', 'Heri Hadian', 'Jl. Babakan Ciparay', '0898989898', '2025-01-27 16:24:14', '2025-01-27 16:24:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` double DEFAULT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int NOT NULL,
  `kode_satuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_satuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `kode_satuan`, `nama_satuan`, `tgl_input`, `tgl_update`) VALUES
(1, 'S001', 'PCS', '2025-01-27 00:01:36', '2025-01-27 00:37:16'),
(2, 'S002', 'CM', '2025-01-27 00:01:36', '2025-01-27 00:01:36'),
(4, 'S003', 'Paket', '2025-01-28 07:36:27', '2025-01-28 07:36:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `kode_supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `nama_supplier`, `alamat`, `telepon`, `tgl_input`, `tgl_update`) VALUES
(25, 'SP001', 'PT. Kencana Yo', 'Jl. Korea A', '0899', '2025-01-27 00:41:01', '2025-01-27 00:41:01'),
(26, 'SP002', 'Heri Senang', 'Jl. Suka Senang', '08979822121', '2025-01-27 00:43:11', '2025-01-27 00:43:11'),
(27, 'SP003', 'PT. Cakue Odading', 'Jl. Cakue Enak', '089783723232', '2025-01-27 00:44:24', '2025-01-27 00:44:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
(1, 'SmartPoS | Sistem Penjualan Smart PoS Berbasis AI', 'Universitas Siber Asia', '-', 'Kelompok 2 - IF701 - 2024/2025 Ganjil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `kode_transaksi` varchar(100) DEFAULT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `total_transaksi` double NOT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `id_pelanggan`, `total_transaksi`, `tanggal_input`, `tanggal_update`) VALUES
(9, 'cKPShC3iuJ', 2, 10000, '2025-01-28 09:10:07', '2025-01-28 09:10:07'),
(10, 'JTZxAm37rh', 2, 2500, '2025-01-28 09:15:17', '2025-01-28 09:15:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1582;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
