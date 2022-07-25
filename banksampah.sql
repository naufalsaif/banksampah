-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 10.05
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksampah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `aktif` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `aktif`, `created_at`, `updated_at`) VALUES
('K003', 'Aluminium', 4000, '1', '2022-06-22 10:31:46', '2022-06-22 10:31:46'),
('kb001', 'Plastik', 1000, '1', '2022-06-15 13:46:31', '2022-06-15 13:46:31'),
('kb002', 'besi', 5000, '1', '2022-06-21 13:01:35', '2022-06-21 13:01:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_setoran`
--

CREATE TABLE `detail_setoran` (
  `id_transaksi` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `berat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_setoran`
--

INSERT INTO `detail_setoran` (`id_transaksi`, `id_barang`, `berat`) VALUES
('T1657267360246', 'K003', 2),
('T1657267360246', 'kb002', 1),
('T1657267360246', 'kb001', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dompet`
--

CREATE TABLE `dompet` (
  `id_dompet` varchar(255) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dompet`
--

INSERT INTO `dompet` (`id_dompet`, `id_user`, `saldo`) VALUES
('D1652687797819', 'U1652687797511', 0),
('D1655868496642', 'U1655868496447', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(255) NOT NULL,
  `id_dompet` varchar(255) NOT NULL,
  `tipe` enum('setoran','pembayaran') NOT NULL,
  `total` int(11) NOT NULL,
  `saldo_terakhir` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_dompet`, `tipe`, `total`, `saldo_terakhir`, `created_at`, `updated_at`) VALUES
('T1657267360246', 'D1655868496642', 'setoran', 15000, 15000, '2022-07-08 15:02:40', '2022-07-08 15:02:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `blok` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '1.jpg',
  `level` enum('anggota','admin') DEFAULT 'anggota',
  `aktif` enum('0','1') DEFAULT '1',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `telepon`, `blok`, `image`, `level`, `aktif`, `last_active`, `created_at`, `updated_at`) VALUES
('U1652687797511', 'Muhammad Naufal', 'noval', '$2y$10$ZgLfgWB6IEz4yU31btmBDOOcmgxtX/zXJZ.9xrOBWrKwgJkJ0xwu.', '081255886633', 'Blok A7 NO 88', '8.jpg', 'admin', '1', '2022-07-08 14:57:41', '2022-05-16 14:56:37', '2022-05-16 14:56:37'),
('U1655868496447', 'Bright Koo', 'Koo10', '$2y$10$IldANmrrPALhETCEk/Q99On8qFJA./bGfrCRHkT9YLzOdGOULyuqq', '0893728632', 'A8 NO 10', '1.jpg', 'anggota', '1', '2022-07-08 14:54:56', '2022-06-22 10:28:16', '2022-06-22 10:28:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_setoran`
--
ALTER TABLE `detail_setoran`
  ADD KEY `fk_setoran_transaksi` (`id_transaksi`),
  ADD KEY `fk_setoran_barang` (`id_barang`);

--
-- Indeks untuk tabel `dompet`
--
ALTER TABLE `dompet`
  ADD PRIMARY KEY (`id_dompet`),
  ADD KEY `fk_dompet_users` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_dompet` (`id_dompet`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `telepon_unique` (`telepon`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_setoran`
--
ALTER TABLE `detail_setoran`
  ADD CONSTRAINT `fk_setoran_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `fk_setoran_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `dompet`
--
ALTER TABLE `dompet`
  ADD CONSTRAINT `fk_dompet_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_dompet` FOREIGN KEY (`id_dompet`) REFERENCES `dompet` (`id_dompet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
