-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Agu 2019 pada 17.45
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kriteria_id` int(11) NOT NULL,
  `kriteria_nama` varchar(100) DEFAULT NULL,
  `kriteria_bobot` double DEFAULT NULL,
  `kriteria_attribute` enum('cost','benefit') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kriteria_id`, `kriteria_nama`, `kriteria_bobot`, `kriteria_attribute`) VALUES
(15, 'C4', 2, 'benefit'),
(16, 'C5', 5, 'benefit'),
(14, 'C3', 4, 'cost'),
(12, 'C1', 5, 'cost'),
(13, 'C2', 3, 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `nilai_id` int(11) NOT NULL,
  `user_nip` char(25) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `nilai_nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`nilai_id`, `user_nip`, `kriteria_id`, `nilai_nilai`) VALUES
(80, '333', 16, 1),
(79, '333', 15, 4),
(78, '333', 14, 1),
(77, '333', 13, 3),
(76, '333', 12, 5),
(75, '222', 16, 1),
(74, '222', 15, 3),
(73, '222', 14, 1),
(72, '222', 13, 1),
(71, '222', 12, 5),
(70, '111', 16, 1),
(69, '111', 15, 4),
(68, '111', 14, 1),
(67, '111', 13, 2),
(66, '111', 12, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_nip` char(25) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role` enum('admin','dosen','pimpinan') NOT NULL,
  `user_foto` varchar(50) NOT NULL DEFAULT 'team_1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_nip`, `user_nama`, `user_password`, `user_role`, `user_foto`) VALUES
('111', 'Paijo', 'e10adc3949ba59abbe56e057f20f883e', 'dosen', 'team_1.jpg'),
('123', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'team_1.jpg'),
('222', 'Bambank', 'e10adc3949ba59abbe56e057f20f883e', 'pimpinan', 'team_1.jpg'),
('333', 'Mawar', 'e10adc3949ba59abbe56e057f20f883e', 'dosen', 'team_1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kriteria_id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
