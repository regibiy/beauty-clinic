-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Jun 2024 pada 10.58
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beauty_clinic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `nama`, `password`) VALUES
(1, 'admin123', 'Admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jam_operasional`
--

CREATE TABLE `tbl_jam_operasional` (
  `id` int NOT NULL,
  `id_klinik` int NOT NULL,
  `hari_buka` varchar(20) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `keterangan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_jam_operasional`
--

INSERT INTO `tbl_jam_operasional` (`id`, `id_klinik`, `hari_buka`, `jam_buka`, `jam_tutup`, `keterangan`) VALUES
(1, 6, 'Senin-Sabtu', '09:00:00', '19:00:00', 'Buka'),
(9, 7, 'Senin-Minggu', '09:00:00', '20:00:00', 'Buka'),
(11, 6, 'Minggu', '00:00:00', '00:00:00', 'Tutup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klinik`
--

CREATE TABLE `tbl_klinik` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_klinik`
--

INSERT INTO `tbl_klinik` (`id`, `nama`, `alamat`, `no_telp`, `latitude`, `longitude`, `kecamatan`, `kelurahan`, `gambar`) VALUES
(6, 'Natasha Clinic', 'Sultan Abdurrahman No.85 (Depan Mitra Mart)', '08112979710', '-0.03927188885584165', '109.32779006717861', '6171031-PONTIANAK KOTA', 'SUNGAI BANGKONG', '666e689ba2f6f.jpg'),
(7, 'B Clinic', 'Jl. Sultan. Abdurrahman No.1, RW.2, Darat Sekip, Kec. Pontianak Kota', '081585558222', '-0.03926316378372879', '109.32846063735862', '6171031-PONTIANAK KOTA', 'DARAT SEKIP', '666f0dffe290d.jpg'),
(8, 'Klinik Oriskin', 'Jalan M. Sohor Nomor 3D', '05618100313', '-0.043939680956897584', '109.33120739502995', '6171010-PONTIANAK SELATAN', 'AKCAYA', '6671670251cf3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sosmed`
--

CREATE TABLE `tbl_sosmed` (
  `id` int NOT NULL,
  `id_klinik` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_sosmed`
--

INSERT INTO `tbl_sosmed` (`id`, `id_klinik`, `nama`, `username`, `link`) VALUES
(4, 6, 'Web Resmi', 'Natasha Clinic', 'https://natasha-skin.com/'),
(5, 6, 'Instagram', 'Natasha Pontianak', 'https://www.instagram.com/sahabatnatasha.pontianak'),
(6, 6, 'TikTok', 'Natasha Skincare', 'https://www.tiktok.com/@natashaskincare.id?lang=id-ID');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_treatment`
--

CREATE TABLE `tbl_treatment` (
  `id` int NOT NULL,
  `id_klinik` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_treatment`
--

INSERT INTO `tbl_treatment` (`id`, `id_klinik`, `nama`, `harga`) VALUES
(1, 6, 'Natasha Glow Lip laser', 500000),
(3, 6, 'Natasha Laser CO2', 500000),
(4, 6, 'Natasha Light Activated Therapy', 500000),
(5, 7, 'B Glowing', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ulasan`
--

CREATE TABLE `tbl_ulasan` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_klinik` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `ulasan` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_ulasan`
--

INSERT INTO `tbl_ulasan` (`id`, `id_user`, `id_klinik`, `tanggal`, `ulasan`, `status`) VALUES
(1, 2, 6, '2024-06-18 02:38:04', 'bagus tempatnya', 'Disetujui'),
(4, 18, 8, '2024-06-18 17:55:57', 'Datanya belum lengkap. Tolong dilengkapi', 'Ditolak'),
(5, 19, 8, '2024-06-18 17:57:27', 'Tempatnya bagus, tenang, enak untuk treatment', 'Disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `nama`, `email`, `password`) VALUES
(2, 'julvia123', 'julvia', 'julvia@gmail.com', '$2y$10$Wta4DE3fSF12mRzeEOdFp.HMtc1nAICuM4l4flZXHn3QTvMrKUoYi'),
(18, 'melin123', 'Melin', 'melin@gmail.com', '$2y$10$2sEV31MyE6/8wzGcY7z8F.QYrhDiGNde0q/4kxNfDYUBm0YoHUzOC'),
(19, 'beata123', 'Beata', 'beata@gmail.com', '$2y$10$5dVwcA6PbMET.hHl/SCapuF53GfYRhB7ghLwfNxUCTgPZ881CYiTm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jam_operasional`
--
ALTER TABLE `tbl_jam_operasional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indeks untuk tabel `tbl_klinik`
--
ALTER TABLE `tbl_klinik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_sosmed`
--
ALTER TABLE `tbl_sosmed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indeks untuk tabel `tbl_treatment`
--
ALTER TABLE `tbl_treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indeks untuk tabel `tbl_ulasan`
--
ALTER TABLE `tbl_ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_jam_operasional`
--
ALTER TABLE `tbl_jam_operasional`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_klinik`
--
ALTER TABLE `tbl_klinik`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_sosmed`
--
ALTER TABLE `tbl_sosmed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_treatment`
--
ALTER TABLE `tbl_treatment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ulasan`
--
ALTER TABLE `tbl_ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_jam_operasional`
--
ALTER TABLE `tbl_jam_operasional`
  ADD CONSTRAINT `tbl_jam_operasional_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `tbl_klinik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_sosmed`
--
ALTER TABLE `tbl_sosmed`
  ADD CONSTRAINT `tbl_sosmed_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `tbl_klinik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_treatment`
--
ALTER TABLE `tbl_treatment`
  ADD CONSTRAINT `tbl_treatment_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `tbl_klinik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_ulasan`
--
ALTER TABLE `tbl_ulasan`
  ADD CONSTRAINT `tbl_ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ulasan_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `tbl_klinik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
