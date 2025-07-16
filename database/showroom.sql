-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2025 pada 09.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showroom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `jenis`, `nominal`, `keterangan`, `tanggal`) VALUES
(1, 'Pemasukan', 10000.00, 'boba', '2025-07-08'),
(2, 'Pengeluaran', 5000.00, 'pls what eskrim', '2025-07-08'),
(3, 'Pemasukan', 5000000.00, 'dp hangus\r\n', '2025-07-14'),
(4, 'Pemasukan', 10000.00, 'abc\r\n', '2025-07-14'),
(5, 'Pengeluaran', 5000.00, '1oxsd', '2025-07-14'),
(6, 'Pengeluaran', 100000.00, 'acbs', '2025-07-14'),
(7, 'Pengeluaran', 100000.00, 'acbs', '2025-07-14'),
(8, 'Pengeluaran', 100000.00, 'acbs', '2025-08-22'),
(9, 'Pemasukan', 500000.00, '123', '2025-08-19'),
(10, 'Pemasukan', 10000000.00, 'dp\r\n', '2025-07-14'),
(11, 'Pemasukan', 100000.00, 'abhs', '2025-07-14'),
(12, 'Pemasukan', 10000000.00, 'beli anjeng\r\n', '2025-10-03'),
(13, 'Pemasukan', 10000000.00, 'dapat anjeng\r\n', '2025-10-14'),
(14, 'Pemasukan', 10000000.00, 'dapat babi', '2025-11-14'),
(15, 'Pengeluaran', 70000000.00, 'gtw\r\n', '2025-11-01'),
(16, 'Pengeluaran', 1000000000.00, '123', '2025-12-02'),
(17, 'Pemasukan', 500000000.00, '120o3\r\n', '2025-12-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laba_bulanan`
--

CREATE TABLE `laba_bulanan` (
  `id_laba` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `total_laba` decimal(10,2) DEFAULT NULL,
  `total_rugi` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laba_bulanan`
--

INSERT INTO `laba_bulanan` (`id_laba`, `bulan`, `tahun`, `total_laba`, `total_rugi`, `created_at`) VALUES
(1, 7, 2025, 15110000.00, 105000.00, '2025-07-14 05:16:52'),
(2, 8, 2025, 500000.00, 100000.00, '2025-07-14 05:35:02'),
(3, 10, 2025, 20000000.00, 0.00, '2025-07-14 06:22:27'),
(4, 11, 2025, 10000000.00, 70000000.00, '2025-07-14 06:23:47'),
(5, 12, 2025, 99999999.99, 99999999.99, '2025-07-14 06:49:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `alamat`, `created_at`, `updated_at`, `deleted_at`, `status_delete`) VALUES
(1, 'Julie', '093849284', 'Rumah', '2025-06-25 07:51:41', '2025-06-25 00:43:43', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tanggal_jual` date DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `total_perbaikan` decimal(10,2) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `dokumen_pembeli` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_mobil`, `id_pelanggan`, `tanggal_jual`, `harga_jual`, `total_perbaikan`, `profit`, `dokumen_pembeli`, `catatan`, `created_at`, `updated_at`, `deleted_at`, `status_delete`) VALUES
(1, 3, 1, '2025-06-25', 800000.00, NULL, NULL, NULL, 'ok', '2025-06-25 08:48:32', '2025-06-25 01:41:16', NULL, 0),
(2, 5, 1, '2025-06-30', 7000.00, NULL, NULL, NULL, 'plis', '2025-06-28 14:37:11', '2025-06-28 07:21:36', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sold_mobil`
--

CREATE TABLE `sold_mobil` (
  `id_sold` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `foto_mobil` text DEFAULT NULL,
  `plat_mobil` varchar(255) DEFAULT NULL,
  `pembeli` varchar(255) DEFAULT NULL,
  `dokumen_pembeli` text DEFAULT NULL,
  `metode_pembayaran` enum('Cash','Kredit') DEFAULT NULL,
  `harga_beli` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `total_perbaikan` decimal(15,2) DEFAULT NULL,
  `profit` decimal(15,2) DEFAULT NULL,
  `profit_credit` decimal(15,2) DEFAULT NULL,
  `tanggal_jual` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sold_mobil`
--

INSERT INTO `sold_mobil` (`id_sold`, `id_mobil`, `foto_mobil`, `plat_mobil`, `pembeli`, `dokumen_pembeli`, `metode_pembayaran`, `harga_beli`, `harga_jual`, `total_perbaikan`, `profit`, `profit_credit`, `tanggal_jual`, `created_at`, `updated_at`) VALUES
(8, 4, '1752469948_138a5d78837f55e311f9.png', 'q', 'ani', '[\"687491e401889-GreyandYellowCarSalePromoFacebookPost1.png\"]', 'Kredit', 100000000.00, 140000000.00, 5000000.00, 0.00, 15000000.00, '2025-08-14', '2025-07-14 05:13:08', '2025-07-14 05:13:23'),
(9, 5, '1752472556_f636713adb43f2167521.jpg', 'wewe', 'awd', '[\"68749bfe2068b-b.jpg\"]', 'Kredit', 200000000.00, 270000000.00, 10000000.00, 0.00, 10000000.00, '2025-07-14', '2025-07-14 05:56:14', '2025-07-14 05:56:24'),
(10, 3, '1752051818_6ed0a86fb0ea4cfe9946.jpg', 'YT12', 'facebook', '[\"68749cf948097-DJI_0008.JPG\"]', 'Kredit', 800000000.00, 1000000000.00, 5000000.00, 0.00, 100000000.00, '2025-09-01', '2025-07-14 06:00:25', '2025-07-14 06:00:34'),
(11, 6, '1752474044_da6c7a73b332f1c78eb5.jpg', 'dji', 'fpv', '[\"6874a1d3a2a50-DJI_0008.JPG\"]', 'Kredit', 100000000.00, 150000000.00, 5000000.00, 0.00, 10000000.00, '2025-11-01', '2025-07-14 06:21:07', '2025-07-14 06:21:59'),
(12, 2, '1752051420_6c2c3c37edd5fbd24706.jpg', 'TY03', 'titit', '[]', 'Cash', 200000000.00, 500000000.00, 10000000.00, 290000000.00, NULL, '2025-12-01', '2025-07-14 06:26:09', NULL),
(13, 7, '1752478325_53662445438a1446e1c9.jpg', 'hrv', 'akhai', '[\"6874b2b0032f4-Grey and Yellow Car Sale Promo Facebook Post (1).png\"]', 'Kredit', 100000000.00, 200000000.00, 10000000.00, 90000000.00, NULL, '2026-01-01', '2025-07-14 07:33:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_mobil`
--

CREATE TABLE `stok_mobil` (
  `id_mobil` int(11) NOT NULL,
  `foto_mobil` text DEFAULT NULL,
  `nama_mobil` varchar(255) DEFAULT NULL,
  `plat_mobil` varchar(255) DEFAULT NULL,
  `harga_beli` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `total_perbaikan` decimal(15,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('Tersedia','Sold') NOT NULL DEFAULT 'Tersedia',
  `status_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_mobil`
--

INSERT INTO `stok_mobil` (`id_mobil`, `foto_mobil`, `nama_mobil`, `plat_mobil`, `harga_beli`, `harga_jual`, `total_perbaikan`, `keterangan`, `tanggal_masuk`, `created_at`, `updated_at`, `status`, `status_delete`) VALUES
(2, '1752051420_6c2c3c37edd5fbd24706.jpg', 'Tayo', 'TY03', 200000000.00, 500000000.00, 10000000.00, 'bagus', '2025-07-09', '2025-07-09 01:57:00', '2025-07-14 06:26:09', 'Sold', 0),
(3, '1752051818_6ed0a86fb0ea4cfe9946.jpg', 'Yota', 'YT12', 800000000.00, 1000000000.00, 5000000.00, 'ya', '2025-07-09', '2025-07-09 02:03:38', '2025-07-14 06:00:25', 'Sold', 0),
(4, '1752469948_138a5d78837f55e311f9.png', 'w', 'q', 100000000.00, 140000000.00, 5000000.00, 'y', '2025-07-14', '2025-07-13 22:12:28', '2025-07-14 05:13:08', 'Sold', 0),
(5, '1752472556_f636713adb43f2167521.jpg', 'wewe', 'wewe', 200000000.00, 270000000.00, 10000000.00, '1', '2025-07-14', '2025-07-13 22:55:56', '2025-07-14 05:56:14', 'Sold', 0),
(6, '1752474044_da6c7a73b332f1c78eb5.jpg', 'dji', 'dji', 100000000.00, 150000000.00, 5000000.00, '1', '2025-07-14', '2025-07-13 23:20:44', '2025-07-14 06:21:07', 'Sold', 0),
(7, '1752478325_53662445438a1446e1c9.jpg', 'hrv', 'hrv', 100000000.00, 200000000.00, 10000000.00, 'nye', '2026-01-01', '2025-07-14 00:32:05', '2025-07-14 07:33:04', 'Sold', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukar_tambah`
--

CREATE TABLE `tukar_tambah` (
  `id` int(11) NOT NULL,
  `id_sold` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(255) DEFAULT NULL,
  `tukar_mobil` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `harga_tukar` decimal(15,2) DEFAULT NULL,
  `tambahan_harga` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tukar_tambah`
--

INSERT INTO `tukar_tambah` (`id`, `id_sold`, `nama_pembeli`, `tukar_mobil`, `foto`, `harga_tukar`, `tambahan_harga`, `created_at`, `updated_at`) VALUES
(3, 13, 'akhai', 'Jazz', '1752478384_2eb44cdf839129875d06.png', 110000000.00, 90000000.00, '2025-07-14 00:33:04', '2025-07-14 00:33:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status_delete` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `foto`, `username`, `nama_user`, `password`, `level`, `email`, `created_at`, `updated_at`, `deleted_at`, `status_delete`) VALUES
(1, NULL, 'supadm@', 'super admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'superadm@gmail.com', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indeks untuk tabel `laba_bulanan`
--
ALTER TABLE `laba_bulanan`
  ADD PRIMARY KEY (`id_laba`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `sold_mobil`
--
ALTER TABLE `sold_mobil`
  ADD PRIMARY KEY (`id_sold`);

--
-- Indeks untuk tabel `stok_mobil`
--
ALTER TABLE `stok_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `tukar_tambah`
--
ALTER TABLE `tukar_tambah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `laba_bulanan`
--
ALTER TABLE `laba_bulanan`
  MODIFY `id_laba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sold_mobil`
--
ALTER TABLE `sold_mobil`
  MODIFY `id_sold` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `stok_mobil`
--
ALTER TABLE `stok_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tukar_tambah`
--
ALTER TABLE `tukar_tambah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
