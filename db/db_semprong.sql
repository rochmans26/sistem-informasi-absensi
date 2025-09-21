-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Sep 2025 pada 11.24
-- Versi server: 8.0.30
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_semprong`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `tgl_absensi` date NOT NULL,
  `foto_masuk` varchar(255) NOT NULL,
  `foto_keluar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('hadir','sakit','alpha','izin') NOT NULL DEFAULT 'alpha'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `id_karyawan`, `jam_masuk`, `jam_keluar`, `tgl_absensi`, `foto_masuk`, `foto_keluar`, `status`) VALUES
(1, 5, '17:10:10', '17:10:33', '2025-09-21', '68cfcf0203dda.png', '68cfcf1947efe.png', 'hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id` int NOT NULL,
  `kode_jabatan` varchar(255) NOT NULL,
  `nama_jabatan` varchar(150) NOT NULL,
  `gaji_jabatan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id`, `kode_jabatan`, `nama_jabatan`, `gaji_jabatan`) VALUES
(1, 'JB001', 'Karyawan Packing', 6000000),
(2, 'JB002', 'Karyawan Wipping', 5500000),
(3, 'JBTM4D5D9M', 'Karyawan Cetak', 4550000),
(5, 'JB2GB90AFI', 'Produksi', 5200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nm_karyawan` varchar(255) NOT NULL,
  `id_jabatan` int NOT NULL,
  `kode_karyawan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(150) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `alamat_ktp` varchar(255) DEFAULT NULL,
  `alamat_domisili` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Konguchu') DEFAULT NULL,
  `kewarganegaraan` enum('WNI','WNA') DEFAULT 'WNI',
  `jenis_kelamin` enum('L','P') NOT NULL DEFAULT 'L',
  `pendidikan_terakhir` enum('SMA','SMK','S-1','S-2','SD','SMP') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `uuid`, `nm_karyawan`, `id_jabatan`, `kode_karyawan`, `tempat_lahir`, `tanggal_lahir`, `email`, `telp`, `alamat_ktp`, `alamat_domisili`, `agama`, `kewarganegaraan`, `jenis_kelamin`, `pendidikan_terakhir`) VALUES
(1, 'c280eacf-8d37-4d76-a5c9-6874d5d140a9', 'Rochman Setiono', 5, '$2y$10$vdtNFnr5vN/9bL46BhwNduY/u/bpsJsP5xnQh3GPzVyl/KANFgqfC', 'Bandung', '1998-10-26', 'rochmansetiono26@gmail.com', '089622162615', 'Bandung', 'Bandung', 'Islam', 'WNI', 'L', 'S-1'),
(2, 'e6d6ad1f-e170-4750-8503-74f6f8184824', 'Rizal Juniar', 1, '$2y$10$DMIv5SdFd7KPErtiHmif6uyk6TGhHvfc.ddwqS2xHApf/ucdIfDJG', 'Bandung', '1997-10-26', 'aldysuparhan@gmail.com', '089754356575', 'Bandung', 'Bandung', 'Islam', 'WNI', 'L', 'SMK'),
(5, 'ebadd9df-2077-4a90-8b9d-7bdc32631ac9', 'Achmad Zacki', 5, '$2y$10$KtQ2KM/SV0fMkY.P9eVGleV.8n7eIpFJZMuwqCAx3o0vEehmH.SOm', 'Bandung', '1998-10-26', 'romanochannel98@gmail.com', '089622162615', 'Bandung', 'Bandung', 'Islam', 'WNI', 'L', 'S-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `created_at`) VALUES
(1, 'Yuga', '2025-09-13 04:55:58'),
(2, 'Rochman Setiono', '2025-09-13 04:56:02'),
(3, 'Mikha', '2025-09-13 04:56:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
