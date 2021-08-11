-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2021 pada 07.33
-- Versi server: 10.4.14-MariaDB-log
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emonik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'restapiemonik', 1, 0, 0, '192.165.12.12', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `kode_material` varchar(20) NOT NULL,
  `quantity` int(7) DEFAULT NULL,
  `satuan` varchar(7) DEFAULT NULL,
  `nama_suplier` varchar(20) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`kode_material`, `quantity`, `satuan`, `nama_suplier`, `gambar`) VALUES
('a34', 12, 'kg', 'wahid', NULL),
('a341', 12, 'kg', 'wahid', 'uploads/tugas data.JPG'),
('a3d', 12, '', 'wahid', ''),
('as3', 12, '', 'wahid', ''),
('granul', 2, 'kg', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(20) NOT NULL,
  `bahan1` varchar(15) DEFAULT NULL,
  `bahan2` varchar(15) DEFAULT NULL,
  `bahan3` varchar(15) DEFAULT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `presentase_bahan_baku1` int(20) DEFAULT NULL,
  `presentase_bahan_baku2` int(30) DEFAULT NULL,
  `presentase_bahan_baku3` int(30) DEFAULT NULL,
  `total_percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `bahan1`, `bahan2`, `bahan3`, `nama_produk`, `presentase_bahan_baku1`, `presentase_bahan_baku2`, `presentase_bahan_baku3`, `total_percentage`) VALUES
('a0', 'asap', 'api', 'air', 'pupukcoba', 10, 10, 80, 100),
('A1', '', '', '', '', 0, 0, 0, 0),
('A1111', '', '', '', 'produk 2', 12, 12, 12, 100),
('A2', '', '', '', '', 0, 0, 0, 0),
('A3', '', '', '', '', 0, 0, 0, 0),
('A4', '', '', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `email` varchar(20) DEFAULT NULL,
  `id` int(8) NOT NULL,
  `name` varchar(8) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email`, `id`, `name`, `password`, `level`) VALUES
('admin@gmail.com', 10, 'adminemo', 'pwadmin123', 'admin'),
('member@gmail.com', 11, 'memberem', 'pwmember', 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kode_material`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
