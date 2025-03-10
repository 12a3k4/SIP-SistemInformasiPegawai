-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2025 pada 03.37
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
-- Database: `pegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `hadir` int(100) NOT NULL,
  `izin` int(100) NOT NULL,
  `tidak_hadir` int(100) NOT NULL,
  `bulan` int(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `id_pegawai`, `hadir`, `izin`, `tidak_hadir`, `bulan`, `tanggal`) VALUES
(13, 10, 20, 0, 0, 1, '2020-05-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `level`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Database', 'admin'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `golongan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `golongan`) VALUES
(5, 'PTT', 'Pramubakti'),
(6, 'PTT', 'Satpam'),
(7, 'PTT', 'Pengemudi'),
(8, 'Staff Pendukung', 'Pengemudi'),
(9, 'Staff Pendukung', 'Ajudan'),
(18, 'Staff Pendukung', 'WALMOR / VOORIJDER'),
(19, 'Staff Pendukung', 'Tim Ahli'),
(20, 'Staff Pendukung', 'Staff Kediaman'),
(21, 'Outsource', 'Taman'),
(22, 'Outsource', 'Cleaning Service'),
(23, 'Outsource', 'Teknisi'),
(24, 'Magang', 'Biro Umum'),
(25, 'Magang', 'Biro Data dan Informasi'),
(26, 'ANGGOTA WANTIMPRES', ''),
(27, 'SEKRETARIS ANGGOTA WANTIMPRES', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_jabatan` int(110) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `ket_jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tempat_lhr` varchar(255) NOT NULL,
  `tanggal_lhr` varchar(255) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `status_kep` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_masuk` varchar(255) NOT NULL,
  `sk_masuk` varchar(255) NOT NULL,
  `tgl_keluar` varchar(255) NOT NULL,
  `sk_keluar` varchar(255) NOT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `ktp_sim` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `dok_sk_masuk` varchar(255) DEFAULT NULL,
  `dok_sk_keluar` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `dok_lainnya` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_jabatan`, `nip`, `nik`, `nama`, `jk`, `ket_jabatan`, `foto`, `tempat_lhr`, `tanggal_lhr`, `agama`, `pendidikan`, `status_kep`, `alamat`, `tgl_masuk`, `sk_masuk`, `tgl_keluar`, `sk_keluar`, `kk`, `ktp_sim`, `id_card`, `dok_sk_masuk`, `dok_sk_keluar`, `cv`, `dok_lainnya`, `username`, `password`) VALUES
(17, 26, '', '', 'Wiranto', 'L', '', 'foto_1739234187.jpg', 'Yogyakarta', '1947-04-04', 'Islam', '', 'Aktif', 'Jl. Rumahnya', '2019-12-12', 'XXX/P TAHUN 2019', '2024-10-19', 'XXX/P TAHUN 2024', 'placeholder.png', 'placeholder.png', 'placeholder.png', 'dok_sk_masuk_1741572807.pdf', 'dok_sk_keluar_1741572807.pdf', 'cv_1739188292.pdf', NULL, '0', ''),
(32, 24, '', '', 'ALI AKBAR SAID', 'L', '', 'foto_1739282780.jpg', 'Jakarta', '2003-10-18', 'Islam', 'Strata 1 (S1) / Sarjana', 'Aktif', 'Jakarta Selatan', '2025-01-01', '', '', '', 'kk_1741572962.jpg', 'ktp_sim_1741572962.jpeg', 'id_card_1741572962.png', 'placeholder.png', 'placeholder.png', 'cv_1739282780.pdf', 'dok_lainnya_1741572962.pdf', '0', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpp`
--

CREATE TABLE `tpp` (
  `id_tpp` int(11) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `jumlah_tpp` varchar(100) NOT NULL,
  `jumlah_potongan` varchar(100) NOT NULL,
  `bulan_t` int(100) NOT NULL,
  `tahun` int(100) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tpp`
--

INSERT INTO `tpp` (`id_tpp`, `id_pegawai`, `jumlah_tpp`, `jumlah_potongan`, `bulan_t`, `tahun`, `tgl`) VALUES
(7, 8, '300000', '0%', 1, 2018, '2018-04-02'),
(9, 9, '12750000', '0%', 5, 2020, '2020-05-01'),
(10, 10, '8749970', '30%', 1, 2020, '2020-05-17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tpp`
--
ALTER TABLE `tpp`
  ADD PRIMARY KEY (`id_tpp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tpp`
--
ALTER TABLE `tpp`
  MODIFY `id_tpp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
