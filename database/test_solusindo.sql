-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2024 pada 12.02
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_solusindo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plat` varchar(10) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `tarif` decimal(10,0) NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `plat`, `merk`, `model`, `tarif`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'F 2010 GK', 'Toyota', 'Avanza', '100000', '', '2024-01-02 04:26:00', '2024-01-02 04:26:00', '2024-01-02 04:26:00'),
(2, 2, 'F 9929 SM', 'Toyota', 'Avanza', '100000', 'K', '2024-01-02 04:34:06', '2024-01-02 09:58:35', '2024-01-02 04:34:06'),
(3, 2, 'F 9393 KT', 'Honda', 'Jazz', '200000', 'K', '2024-01-02 04:34:57', '2024-01-02 09:41:00', '2024-01-02 04:34:57'),
(4, 6, 'B 0918 KK', 'Toyota', 'Yaris', '200000', 'K', '2024-01-02 07:46:04', '2024-01-02 10:07:39', '2024-01-02 07:46:04'),
(5, 9, 'B 0705 E', 'Toyota', 'Kijang', '100000', 'S', '2024-01-02 10:40:54', '2024-01-02 10:41:28', '2024-01-02 10:40:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `id_menu` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `urutan` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `id_menu`, `url`, `urutan`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Mobil', NULL, 'cars', NULL, 'icon-diamond', '2024-01-02 09:59:39', '2024-01-02 09:59:39', NULL),
(2, NULL, 'Penyewaan', NULL, 'rents', NULL, 'icon-diamond', '2024-01-02 09:59:56', '2024-01-02 09:59:56', NULL),
(3, NULL, 'Pengembalian', NULL, 'refunds', NULL, 'icon-diamond', '2024-01-02 10:00:15', '2024-01-02 10:00:15', NULL),
(4, NULL, 'Pengguna', NULL, 'users', NULL, 'icon-users', '2024-01-02 10:38:29', '2024-01-02 10:38:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `refunds`
--

CREATE TABLE `refunds` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `refunds`
--

INSERT INTO `refunds` (`id`, `car_id`, `payment_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '2024-01-12', '2024-01-02 09:41:00', '2024-01-02 09:41:00', '2024-01-02 09:41:00'),
(2, 2, '2024-01-04', '2024-01-02 09:58:35', '2024-01-02 09:58:35', '2024-01-02 09:58:35'),
(3, 4, '2024-01-04', '2024-01-02 10:07:39', '2024-01-02 10:07:39', '2024-01-02 10:07:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rents`
--

CREATE TABLE `rents` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rents`
--

INSERT INTO `rents` (`id`, `date_start`, `date_end`, `lama_sewa`, `car_id`, `status`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024-01-02', '2024-01-05', 3, 3, 'S', '600000', '2024-01-02 07:48:03', '2024-01-02 07:48:03', '2024-01-02 07:48:03'),
(2, '2024-01-02', '2024-01-03', 1, 2, 'S', '100000', '2024-01-02 09:55:50', '2024-01-02 09:55:50', '2024-01-02 09:55:50'),
(3, '2024-01-02', '2024-01-05', 3, 4, 'S', '600000', '2024-01-02 10:05:24', '2024-01-02 10:05:24', '2024-01-02 10:05:24'),
(4, '2024-01-06', '2024-01-12', 6, 5, 'S', '600000', '2024-01-02 10:41:28', '2024-01-02 10:41:28', '2024-01-02 10:41:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, '2017-11-10 00:22:01', '2023-12-28 17:41:43', NULL),
(2, 'User', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_menus`
--

CREATE TABLE `role_menus` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `role_menus`
--

INSERT INTO `role_menus` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 3, NULL, NULL, NULL),
(5, 1, 1, NULL, NULL, NULL),
(6, 1, 2, NULL, NULL, NULL),
(7, 1, 3, NULL, NULL, NULL),
(8, 1, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` int(12) NOT NULL,
  `sim` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `phone`, `sim`, `address`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'lukman', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', 0, '', '', NULL, NULL, NULL, NULL),
(2, 2, 'hadi', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', 2147483647, '92929', 'Kembangan Jakbar', NULL, NULL, '2024-01-02 10:11:55', NULL),
(3, 3, 'purchase', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', 0, '', '', NULL, NULL, NULL, NULL),
(4, 4, 'manager', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', 0, '', '', NULL, NULL, NULL, NULL),
(5, 2, 'ahmad', '$2y$10$ToGYFZZoRuOmN8kFtpotfeQj/LdBY8tjcRp3ZOufpmC//OCyefeIW', 202929, '24332', 'asdfa sdf', NULL, '2024-01-02 04:07:44', '2024-01-02 04:09:31', NULL),
(6, 2, 'Burhan', '$2y$10$3IZByD0GPgXH7TI8IRrgZefCk9/r3oMWDB4GsQ/PXJGarytp2OgEO', 81827722, '902919', 'Kembangan', NULL, '2024-01-02 07:45:12', '2024-01-02 07:45:12', NULL),
(7, 2, 'Vikran', '$2y$10$hGnPN84nsHz9L.k5XNztXOPvCebzUix4CnHfIJFExMkAqC1rwTDYy', 818181811, '92929292', 'Cisarua', NULL, '2024-01-02 10:04:46', '2024-01-02 10:04:46', NULL),
(8, 2, 'reza', '$2y$10$nBDabPbwHJF0ZXUWfxur9OBWL.dpE45aE.zIUkNIub7S6IqqxP2/S', 896727181, '928282828', 'Puri Niaga Kembangan', NULL, '2024-01-02 10:14:16', '2024-01-02 10:14:16', NULL),
(9, 2, 'Jasmin', '$2y$10$pO.1nHeKtw/GoGKEOZq5JOkGYELLBBsfwaT3dSNlhtMNwbsDT2JTS', 83178625, '999991111', 'Cakung Jakarta', NULL, '2024-01-02 10:39:33', '2024-01-02 10:39:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_menus_menus1_idx` (`parent_id`) USING BTREE;

--
-- Indeks untuk tabel `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `role_menus`
--
ALTER TABLE `role_menus`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_role_menu_role1_idx` (`role_id`) USING BTREE,
  ADD KEY `fk_role_menu_menu1_idx` (`menu_id`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_users_roles1_idx` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `role_menus`
--
ALTER TABLE `role_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
