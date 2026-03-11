-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2026 pada 04.14
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
-- Database: `db_task_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `initial_tasks`
--

CREATE TABLE `initial_tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `assignedTo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`assignedTo`)),
  `assignedBy` int(11) NOT NULL,
  `status` enum('pending','in-progress','done') NOT NULL DEFAULT 'pending',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `dueDate` date NOT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`comments`)),
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`attachments`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `initial_tasks`
--

INSERT INTO `initial_tasks` (`id`, `title`, `description`, `assignedTo`, `assignedBy`, `status`, `priority`, `dueDate`, `comments`, `attachments`) VALUES
(1, 'Maintenance Server Pusat', 'Update patch OS.', '[6]', 3, 'in-progress', 'high', '2026-03-05', '[]', '[]'),
(2, 'Rekap Penjualan Q1', 'Pastikan angka.', '[7]', 4, 'pending', 'high', '2026-03-15', '[]', '[]'),
(10, 'Draft Konten Sosmed Feb W1', 'Buat 5 draft konten Instagram untuk minggu pertama.', '[5]', 2, 'done', 'high', '2026-02-05', '[]', '[]'),
(11, 'Setup Iklan Meta Ads (Valentine)', 'Siapkan materi dan targeting.', '[5]', 2, 'done', 'high', '2026-02-08', '[]', '[]'),
(12, 'Laporan Performa Sosmed Jan 2026', 'Rekap insight Instagram.', '[5]', 2, 'done', 'medium', '2026-02-10', '[]', '[]'),
(13, 'Draft Konten Sosmed Feb W2', 'Buat konten.', '[5]', 2, 'done', 'medium', '2026-02-12', '[]', '[]'),
(14, 'Live Streaming Promo', 'Host sesi live.', '[5]', 2, 'done', 'high', '2026-02-14', '[]', '[]'),
(17, 'Riset Kompetitor Q1', 'Analisa pergerakan campaign.', '[5]', 2, 'in-progress', 'low', '2026-03-05', '[]', '[]'),
(18, 'Persiapan Campaign Ramadhan', 'Brainstorming ide awal.', '[5]', 2, 'done', 'high', '2026-03-10', '[]', '[]'),
(19, 'test', 'test', '[5]', 5, 'done', 'medium', '2026-03-10', '[]', '[]'),
(20, 'geagag', 'test lagi aja\nsagegarra', '[5]', 5, 'done', 'high', '2026-03-19', '[]', '[]'),
(21, 'artartra', 'rtart', '[5]', 5, 'done', 'medium', '2026-03-11', '[]', '[]'),
(22, 'testststs', 'tests', '[5]', 5, 'done', 'medium', '2026-03-28', '[]', '[]'),
(23, 'ragrag', 'grar', '[5]', 5, 'done', 'medium', '2026-03-11', '[]', '[]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `initial_users`
--

CREATE TABLE `initial_users` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('admin','direksi','manager','staff') NOT NULL,
  `avatar` varchar(5) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `initial_users`
--

INSERT INTO `initial_users` (`id`, `nik`, `password`, `name`, `role`, `avatar`, `division`, `position`) VALUES
(1, 'MGR001', 'password123', 'Budi Santoso', 'manager', 'BS', 'Operasional', 'Manager Operasional'),
(2, 'MGR002', 'password123', 'Anita Wijaya', 'manager', 'AW', 'Marketing', 'Manager Marketing'),
(3, 'MGR003', 'password123', 'Handoko', 'manager', 'HD', 'IT', 'IT Manager'),
(4, 'MGR004', 'password123', 'Diana Putri', 'manager', 'DP', 'Sales', 'Sales Manager'),
(5, 'STF001', 'password123', 'Siti Aminah', 'staff', 'SA', 'Marketing', 'Social Media Specialist'),
(6, 'STF002', 'password123', 'Rudi Hermawan', 'staff', 'RH', 'IT', 'Network Admin'),
(7, 'STF003', 'password123', 'Dewi Lestari', 'staff', 'DL', 'Sales', 'B2B Sales'),
(8, 'STF004', 'password123', 'Ahmad Faisal', 'staff', 'AF', 'Operasional', 'Staff Logistik'),
(99, 'DIR001', 'password123', 'Bapak Direktur', 'direksi', 'BD', 'Direksi', 'Direktur Utama'),
(100, 'ADM001', 'password123', 'System Admin', 'admin', 'SA', 'Pusat', 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `initial_tasks`
--
ALTER TABLE `initial_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `initial_users`
--
ALTER TABLE `initial_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `initial_tasks`
--
ALTER TABLE `initial_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `initial_users`
--
ALTER TABLE `initial_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
