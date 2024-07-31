-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2024 pada 06.38
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
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_at`) VALUES
(43, 'as', 'sa', '2024-07-14 18:35:37'),
(44, 'as', 'as', '2024-07-17 15:06:44'),
(46, 'dzcdc', 'svd', '2024-07-19 19:09:31'),
(47, 'aa', 'aa', '2024-07-19 19:21:50'),
(48, 'bb', 'bb', '2024-07-19 19:22:10'),
(49, 'c', 'c', '2024-07-20 11:19:18'),
(50, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2024-07-24 23:55:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas`
--

CREATE TABLE `berkas` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `skhun` varchar(255) DEFAULT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `ktp_ayah` varchar(255) DEFAULT NULL,
  `ktp_ibu` varchar(255) DEFAULT NULL,
  `kbs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berkas`
--

INSERT INTO `berkas` (`id`, `siswa_id`, `ijazah`, `skhun`, `kk`, `ktp_ayah`, `ktp_ibu`, `kbs`) VALUES
(10, 12, '../uploads/Teknologi Mobile Pertemuan 6.pdf', '../uploads/Teknologi Mobile Pertemuan 6.pdf', '../uploads/Teknologi Mobile Pertemuan 6.pdf', '../uploads/Teknologi Mobile Pertemuan 6.pdf', '../uploads/Teknologi Mobile Pertemuan 6.pdf', '../uploads/Teknologi Mobile Pertemuan 6.pdf'),
(11, 14, '../uploads/bindo3.pdf', '../uploads/bindo3.pdf', '../uploads/bindo3.pdf', '../uploads/bindo3.pdf', '../uploads/bindo3.pdf', '../uploads/bindo3.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `nama`, `keterangan`, `gambar`) VALUES
(13, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbbbbcccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeefffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffggggggggggggggggggggggggggggggggggggggggggggggggghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'WhatsApp Image 2023-08-14 at 06.52.02.jpeg'),
(17, 'efa', 'dsc', 'PUTRA.jpg'),
(18, 'sa', 's', 'Capture.PNG'),
(19, 'xzsxza', 'sa', 'Capture1.PNG'),
(21, 'aaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'TUGAS 1 ANIMASI KOMPUTER.jpg'),
(23, 'sssssssssssssssssssssssssssss', 'sssssssssssssssssssssssssssssss', 'TUGAS 1 ANIMASI KOMPUTER.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(11) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `alamat_ayah` text NOT NULL,
  `telepon_ayah` varchar(20) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat_ibu` text NOT NULL,
  `telepon_ibu` varchar(20) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `nama_ayah`, `alamat_ayah`, `telepon_ayah`, `pekerjaan_ayah`, `nama_ibu`, `alamat_ibu`, `telepon_ibu`, `pekerjaan_ibu`, `siswa_id`) VALUES
(10, '1asw11111111', '1asw11111111', '1asw11111111', '1asw11111111', '1asw11111111', '1asw11111111', '1asw11111111', '1asw11111111', 11),
(11, '2', '2', '2', '2', '2g', '2', '22', '2', 12),
(12, 'budi', 'wanakarta', '082222222', 'petani', 'siti', 'wanakarta\r\n', '08233333333', 'ibu rumah tangga', 13),
(13, 'budi', 'makassar', '0844444444444', 'petani', 'siti', 'makassar', '089999999999', 'ibu rumah tangga', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_induk` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Konghucu') NOT NULL,
  `status_dalam_keluarga` varchar(50) NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `telepon_hp` varchar(20) DEFAULT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `nomor_induk`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_dalam_keluarga`, `anak_ke`, `alamat`, `telepon_hp`, `sekolah_asal`, `users_id`) VALUES
(11, 'abd rahman', 'wadqs1111', 'asw11111111', 'swaasw11111111', '2024-07-15', 'Laki-laki', 'Kristen', 'axasw11111111', 12, '1asw11111111', '1asw11111111', '1asw11111111', 33),
(12, 'asx', 'qswawSA', 'as', 'AQSW', '2024-07-01', 'Perempuan', 'Kristen', 'S', 2, 'C', 'C', 'C', 34),
(13, 'asep', '23', '3456789', 'wanakarta', '2002-03-23', 'Laki-laki', 'Islam', 'anak kandung', 3, 'desa wanakarte', '-', 'mi wanakarta', 35),
(14, 'Eka Ady Saputra', '20010', '200101011', 'makassar', '2024-07-25', 'Laki-laki', 'Islam', 'anak kandung', 1, 'makassar', '0833333333', 'sd negeri 3', 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '$2y$10$vaiSTgJ56XyZ/If9rDrdkOyQQIoZvV8rHPsBJNtUk8p1ZXCfE0cXO', 'admin'),
(33, '123456', '$2y$10$eCQe8.EB/Sh1iwUFTrWwvOWBFJSngjD8I3C3I2VZbX4OzXAeoNooq', 'siswa'),
(34, '123', '$2y$10$V.YsLkmn0.3Cln6HwUJkpuNVV6XHb/nM2X0ii1BR7cQPJ2J5AuLu2', 'siswa'),
(35, '12345', '$2y$10$RGTXqHxzd95BI6qnzg03n.j9Wz/knicuBeFCJ8DSH/Tv30nXMPpTa', 'siswa'),
(36, '1', '$2y$10$fXrEbSdAUl2UO1qmGf0omeE6qc3ikeZzIHOFgs5U0age30SZU.pGG', 'siswa'),
(37, '2', '$2y$10$Fe8kMwVFb5g6P7Dq9dlevOXJnUE0KRptOQnUK/jxq.XOB3yFeLKBm', 'siswa'),
(38, 'dsa', '$2y$10$ZlDN4ivAfeBbjDFjMdAm4eclCExAW.O/O1d7zHZVwTCMM04JJupJq', 'siswa'),
(39, 'saputra', '$2y$10$1R0fjNz3KNELIC1qFDVzauPRQ/EWG8QUejKTUGNhwfhwOZhQtn2JK', 'siswa'),
(40, 'aco', '$2y$10$i2dqfaO35L7ahksUK/mpN.oTTH6j5UW1oAGGjoK/sgdF45kA7vpZS', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indeks untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `berkas_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD CONSTRAINT `orang_tua_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
