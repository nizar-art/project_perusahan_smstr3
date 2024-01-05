-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Jan 2024 pada 18.14
-- Versi server: 10.5.22-MariaDB-cll-lve
-- Versi PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recj5556_recoveryu_computer_form`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `email`, `password`, `user_type`, `id`) VALUES
(7, 'amir syahrul ramadhan', 'amirramadhan768@gmail.com', '46be0750cc9ae225acc3cf8206e95e88', 'admin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `name`, `email`, `password`, `user_type`, `id`) VALUES
(6, 'nizar zul islami', 'nizarzull@gmail.com', '0e5d8bb0d92f43dc1c05661b9c697c1a', 'user', 20),
(7, 'Reffifz', 'reffifauzi@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `create_at`, `update_at`) VALUES
(52, 'SSD VENOM', 249900, 'path/to/upload/directory/1704426835-f582d39eedcf5ae47b0ef86fd821bac0-venom.jpg', '2024-01-05 03:53:55', NULL),
(53, 'SSD SATA', 260000, 'path/to/upload/directory/1704426920-614ee4b3236fc814bcd17a8eef0c22a9-foto.jpeg', '2024-01-05 03:55:20', NULL),
(54, 'SSD MidasForce', 390000, 'path/to/upload/directory/1704426940-003289c6ec4f14fa2136fe7eef7d31a5-ssd.jpeg', '2024-01-05 03:55:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_requests`
--

CREATE TABLE `service_requests` (
  `id_pesan` int(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `price` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `service_requests`
--

INSERT INTO `service_requests` (`id_pesan`, `merk`, `detail`, `create_at`, `token`, `tanggal`, `jam`, `nama_lengkap`, `telepon`, `status`, `price`) VALUES
(180, 'Acer', 'speaker tidak bunyi', '2023-12-28 03:55:33', '658cf1a120c09', '2023-12-28', '06.00 - 09.00', 'reffi fauzi', '088213456445', 'pending', 0),
(182, 'Asus', 'baterai tidak mengisi', '2023-12-28 03:57:31', '658cf20f847a2', '2023-12-29', '06.00 - 09.00', 'nizar zul islami', '088213456271', 'accepted', 0),
(183, 'Lenovo', 'keyboard tidak bisa ditekan', '2023-12-28 03:57:56', '658cf22b4e1d6', '2023-12-30', '06.00 - 09.00', 'amir syahrul ramadhan', '088213456271', 'sedang_proses', 125000),
(184, 'HP', 'port usb tidak berfungsi', '2023-12-28 03:58:30', '658cf2444eb4e', '2023-12-31', '06.00 - 09.00', 'nizar zul islami', '088213456271', 'pesanan_selesai', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_form`
--

CREATE TABLE `user_form` (
  `id` int(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `verification` varchar(255) NOT NULL,
  `exp_code` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_logged_in` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `verification`, `exp_code`, `is_logged_in`) VALUES
(1, 'amir syahrul ramadhan', 'amirramadhan768@gmail.com', '8aff7782ffd51900fb8f9f377d3f37e9', 'admin', '077689', '2024-01-06 03:47:26', 0),
(20, 'nizar zul islami', 'nizarzull03@gmail.com', '8e57688d03f7d49d183eb3e6771c653f', 'user', '5aeffd', '2024-01-06 11:07:47', 0),
(21, 'Reffifz', 'reffifauzi@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', '', '2024-01-05 07:34:34', 0);

--
-- Trigger `user_form`
--
DELIMITER $$
CREATE TRIGGER `register_after_insert` AFTER INSERT ON `user_form` FOR EACH ROW BEGIN
    IF NEW.user_type = 'admin' THEN
        INSERT INTO admin (id, name, email, password, user_type)
        VALUES (NEW.id, NEW.name, NEW.email, NEW.password, NEW.user_type);
    ELSEIF NEW.user_type = 'user' THEN
        INSERT INTO pelanggan (id, name, email, password, user_type)
        VALUES (NEW.id, NEW.name, NEW.email, NEW.password, NEW.user_type);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `FK-admin_form` (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `FK-user` (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id_pesan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT untuk tabel `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK-admin_form` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `FK-user` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
