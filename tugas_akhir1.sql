-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Jul 2024 pada 15.20
-- Versi server: 5.7.33
-- Versi PHP: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `addk`
--

CREATE TABLE `addk` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `balasan_wa` text,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `addk`
--

INSERT INTO `addk` (`id`, `id_pegawai`, `id_user`, `id_satker`, `tanggal_pengajuan`, `jam_pengajuan`, `jam_selesai`, `jenis_pengajuan`, `status_ad`, `balasan_wa`, `status`, `created_at`, `updated_at`) VALUES
('9c9602f0-b475-4594-a942-0067edeb0183', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '03 July 2024', '11:01', '12:33', 'Konsultasi Addedum Kontrak', 'Di Terima', '*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *Badan Pusat Statisk* dengan Kode Satker *50041* untuk pertemuan jadwal konsultasi addk dengan pegawai KPPN Ketapang bagian *Customer Services* pada tanggal *03 July 2024* pada pukul *11:01 WIB* hingga pukul *12:33 WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *Irsyad Husain Jauhari* *10 Menit* sebelum Jam *11:01 WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.', 'Di Terima', '2024-07-22 20:44:43', '2024-07-22 20:45:26'),
('9c9b85e6-e5f5-4bb9-960d-bc7bf2117a29', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '10 July 2024', '10:00', '12:00', 'Konsultasi Addedum Kontrak', NULL, NULL, 'DiProses...', '2024-07-25 14:30:03', '2024-07-25 14:30:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `id` char(36) NOT NULL,
  `id_blastwa` varchar(1000) NOT NULL,
  `ids` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blastwa`
--

CREATE TABLE `blastwa` (
  `id` char(36) NOT NULL,
  `ids` varchar(255) NOT NULL,
  `judul_pesan` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `blastwa`
--

INSERT INTO `blastwa` (`id`, `ids`, `judul_pesan`, `tanggal`, `pesan`, `created_at`, `updated_at`) VALUES
('9ca3a0b4-c1d0-48d1-a927-6c3fdeea1595', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45,9c265bb4-c9dd-4099-99df-827d6983eecf', 'aaa', '19 July 2024', 'oke', '2024-07-29 15:11:38', '2024-07-29 15:11:38'),
('9ca3a215-6274-4180-9d5f-111deb7463dc', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'apa', '18 July 2024', 'mak', '2024-07-29 15:15:29', '2024-07-29 15:15:29'),
('9ca3a267-4ae8-4608-9579-cb4eaf1a114e', '9c265bb4-c9dd-4099-99df-827d6983eecf', 'fine', '25 July 2024', 'aap', '2024-07-29 15:16:22', '2024-07-29 15:16:22'),
('9ca3a370-d099-46a4-9ef5-52853e85eed7', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'sukes suke', '18 July 2024', 'apap', '2024-07-29 15:19:16', '2024-07-29 15:19:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `broadcast`
--

CREATE TABLE `broadcast` (
  `id` char(36) NOT NULL,
  `ids` varchar(255) NOT NULL,
  `judul_pesan` text NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `broadcast`
--

INSERT INTO `broadcast` (`id`, `ids`, `judul_pesan`, `tanggal`, `pesan`, `created_at`, `updated_at`) VALUES
('9c519a62-2a38-4437-a43c-dab8be90ec9a', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45,9b997664-e4ef-47c9-ab9c-fe595c0a5275,9c265bb4-c9dd-4099-99df-827d6983eecf', 'AGENDA PERBAIKAN DIPA TRIWULAN 5', '28 June 2024', 'apa', '2024-06-18 20:36:04', '2024-06-18 20:36:04'),
('9c96f402-8891-4e4e-936b-6bdbbb2b780d', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45,9b997664-e4ef-47c9-ab9c-fe595c0a5275,9c265bb4-c9dd-4099-99df-827d6983eecf,9c915f49-0f0f-4096-bc1b-339c1a381d9e', 'aaa', '15 July 2024', 'Ada Rapat Silahkan Pergi Jam 10.00', '2024-07-23 07:58:48', '2024-07-23 07:58:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calender1`
--

CREATE TABLE `calender1` (
  `id` char(36) NOT NULL,
  `nama_jadwal` varchar(255) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_lpj` char(36) DEFAULT NULL,
  `id_spd` char(36) DEFAULT NULL,
  `id_spm` char(36) DEFAULT NULL,
  `id_addk` char(36) DEFAULT NULL,
  `id_sp2d` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calender1`
--

INSERT INTO `calender1` (`id`, `nama_jadwal`, `tanggal_pengajuan`, `color`, `id_user`, `id_satker`, `id_pegawai`, `id_lpj`, `id_spd`, `id_spm`, `id_addk`, `id_sp2d`, `created_at`, `updated_at`) VALUES
('9c9bf0c5-7366-4586-8cfb-ff339f83ab66', 'Konsultasi Laporan Pertanggungjawaban', '13 July 2024', 'green', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '9b94627b-63fc-4837-9d41-ee890c711f81', '9c9ad133-ef7b-475d-b024-bcef91c29593', NULL, NULL, NULL, NULL, '2024-07-25 19:28:53', '2024-07-25 19:28:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calender2`
--

CREATE TABLE `calender2` (
  `id` char(36) NOT NULL,
  `nama_jadwal` varchar(255) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_khusus` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calender2`
--

INSERT INTO `calender2` (`id`, `nama_jadwal`, `tanggal_pengajuan`, `color`, `id_user`, `id_satker`, `id_pegawai`, `id_khusus`, `created_at`, `updated_at`) VALUES
('9c96e995-0efc-4881-b6bb-a8ead90a3a3c', 'Nama Jadwal Default', '15 July 2024', 'green', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '9b9578d0-2aa9-4c1e-865f-f088062cb74e', '9c96e106-99ab-4f1a-a4c0-1580468d1623', '2024-07-23 07:29:38', '2024-07-23 07:29:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `khusus`
--

CREATE TABLE `khusus` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `alasan_pengajuan` text NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `balasan_wa` text,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `khusus`
--

INSERT INTO `khusus` (`id`, `id_pegawai`, `id_user`, `id_satker`, `alasan_pengajuan`, `tanggal_pengajuan`, `jam_pengajuan`, `jam_selesai`, `balasan_wa`, `jenis_pengajuan`, `status_ad`, `status`, `created_at`, `updated_at`) VALUES
('9c95dd77-d8bf-4a3a-b703-9caa43951a63', '9b9578d0-2aa9-4c1e-865f-f088062cb74e', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'aaaa', '10 July 2024', '11:11', '11:02', '*Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi khusus dari Satker Badan Pusat Statisk dengan Kode Satker 50041 dengan pegawai kami *LUCKY HERRERA* dengan jabatan *Kasubag*. Yang ingin bertemu pada tanggal *10 July 2024* pada pukul *11:11 WIB*, hingga *11:02 WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih', 'Konsultasi Pengajuan Khusus', 'Di Tolak', 'Di Tolak', '2024-07-22 18:59:57', '2024-07-22 19:00:43'),
('9c96e106-99ab-4f1a-a4c0-1580468d1623', '9b9578d0-2aa9-4c1e-865f-f088062cb74e', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'baidab', '15 July 2024', '12:09', '14:09', '*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *Badan Pusat Statisk* dengan Kode Satker *50041* untuk pertemuan jadwal konsultasi khusus dengan pegawai KPPN Ketapang bagian *Kasubag* pada tanggal *15 July 2024* pada pukul *12:09 WIB* hingga pukul *14:09 WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *LUCKY HERRERA* *10 Menit* sebelum Jam *12:09 WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.', 'Konsultasi Pengajuan Khusus', 'Di Terima', 'Di Terima', '2024-07-23 07:05:43', '2024-07-23 07:06:17'),
('9c9be3b2-ca13-4aca-98b6-a1a285bf8416', '9b9578d0-2aa9-4c1e-865f-f088062cb74e', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'apa iya', '24 July 2024', '10:11', '12:00', NULL, 'Konsultasi Pengajuan Khusus', NULL, 'DiProses...', '2024-07-25 18:52:20', '2024-07-25 18:52:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lpj`
--

CREATE TABLE `lpj` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `balasan_wa` text,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lpj`
--

INSERT INTO `lpj` (`id`, `id_pegawai`, `id_user`, `id_satker`, `tanggal_pengajuan`, `jam_pengajuan`, `jam_selesai`, `balasan_wa`, `jenis_pengajuan`, `status_ad`, `status`, `created_at`, `updated_at`) VALUES
('9c9ad133-ef7b-475d-b024-bcef91c29593', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '13 July 2024', '11:11', '11:01', '*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *Badan Pusat Statisk* dengan Kode Satker *50041* untuk pertemuan jadwal konsultasi LPJ dengan pegawai KPPN Ketapang bagian *Customer Services* pada tanggal *13 July 2024* pada pukul *11:11 WIB* hingga pukul *11:01 WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *Irsyad Husain Jauhari* *10 Menit* sebelum Jam *11:11 WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.', 'Konsultasi LPJ', 'Di Terima', 'Di Terima', '2024-07-25 06:04:47', '2024-07-25 17:46:28'),
('9c9bd1b1-0848-4019-83a2-e697ace321dc', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '02 July 2024', '11:11', '11:11', NULL, 'Konsultasi LPJ', NULL, 'DiProses...', '2024-07-25 18:01:59', '2024-07-25 18:01:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` char(36) NOT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `jabatan`, `status`, `nomor_hp`, `created_at`, `updated_at`) VALUES
('9b94627b-63fc-4837-9d41-ee890c711f81', 'Irsyad Husain Jauhari', 'Customer Services', 'Aktif', '08981229812', '2024-03-16 19:08:17', '2024-03-16 19:08:17'),
('9b9578d0-2aa9-4c1e-865f-f088062cb74e', 'LUCKY HERRERA', 'Kasubag', 'Aktif', '0898129292', '2024-03-17 08:06:33', '2024-06-06 04:59:13'),
('9b958303-4c0b-49be-bcd4-f67365887086', 'Icaa', 'Customer Services', 'Cuti', '08981229812', '2024-03-17 08:35:04', '2024-03-17 08:35:04'),
('9bb86a6e-71f8-4aa0-9c7a-1ca1b132906e', 'dnd', 'Customer Services', 'Sakit', 'iqi', '2024-04-03 17:00:19', '2024-07-19 09:29:57'),
('9c382767-4fe1-4ec4-995f-6979014329a6', 'Wildan Shohabi', 'Bank', 'Sakit', '0812222222222', '2024-06-06 04:58:52', '2024-07-19 09:29:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satker`
--

CREATE TABLE `satker` (
  `id` char(36) NOT NULL,
  `nama_satker` varchar(255) DEFAULT NULL,
  `kode_satker` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satker`
--

INSERT INTO `satker` (`id`, `nama_satker`, `kode_satker`, `created_at`, `updated_at`) VALUES
('9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'Badan Pusat Statisk', '50041', '2024-03-16 19:09:40', '2024-03-16 19:09:40'),
('9b997664-e4ef-47c9-ab9c-fe595c0a5275', 'Poltek', '5001', '2024-03-19 07:43:06', '2024-05-27 18:33:29'),
('9c265bb4-c9dd-4099-99df-827d6983eecf', 'Politeknik Negeri Ketapang', '49915', '2024-05-28 08:40:12', '2024-05-28 08:40:12'),
('9c915f49-0f0f-4096-bc1b-339c1a381d9e', 'Kantor Pelayanan Pajak Ketapang', '90081', '2024-07-20 13:23:48', '2024-07-20 13:23:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sp2d`
--

CREATE TABLE `sp2d` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `balasan_wa` text,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sp2d`
--

INSERT INTO `sp2d` (`id`, `id_pegawai`, `id_user`, `id_satker`, `tanggal_pengajuan`, `balasan_wa`, `jam_pengajuan`, `jam_selesai`, `jenis_pengajuan`, `status_ad`, `status`, `created_at`, `updated_at`) VALUES
('9c9bcbf6-de4a-4745-8971-a544fc0956a1', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '26 July 2024', '*Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi sp2d dari Satker Badan Pusat Statisk dengan Kode Satker 50041 dengan pegawai kami *Irsyad Husain Jauhari* dengan jabatan *Customer Services*. Yang ingin bertemu pada tanggal *26 July 2024* pada pukul *11:01 WIB*, hingga *11:01 WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih', '11:01', '11:01', 'Konsultasi SP2D', 'Di Tolak', 'Di Tolak', '2024-07-25 17:45:58', '2024-07-25 17:46:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spd`
--

CREATE TABLE `spd` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `balasan_wa` text,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spd`
--

INSERT INTO `spd` (`id`, `id_pegawai`, `id_user`, `id_satker`, `tanggal_pengajuan`, `jam_pengajuan`, `jam_selesai`, `balasan_wa`, `jenis_pengajuan`, `status_ad`, `status`, `created_at`, `updated_at`) VALUES
('9c95ee18-d60a-4cb9-a0a0-da40179b9f45', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '27 July 2024', '11:02', '12:02', '*Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi spd dari Satker Badan Pusat Statisk dengan Kode Satker 50041 dengan pegawai kami *Irsyad Husain Jauhari* dengan jabatan *Customer Services*. Yang ingin bertemu pada tanggal *27 July 2024* pada pukul *11:02 WIB*, hingga *12:02 WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih', 'Konsultasi SPD', 'Di Tolak', 'Di Tolak', '2024-07-22 19:46:26', '2024-07-22 20:03:08'),
('9c9b30a9-4593-4759-b531-f38bd14e15f0', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '10 July 2024', '12:02', '13:55', '*Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi spd dari Satker Badan Pusat Statisk dengan Kode Satker 50041 dengan pegawai kami *Irsyad Husain Jauhari* dengan jabatan *Customer Services*. Yang ingin bertemu pada tanggal *10 July 2024* pada pukul *12:02 WIB*, hingga *13:55 WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih', 'Konsultasi SPD', 'Di Tolak', 'Di Tolak', '2024-07-25 10:31:43', '2024-07-25 17:47:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spm`
--

CREATE TABLE `spm` (
  `id` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_satker` char(36) NOT NULL,
  `tanggal_pengajuan` varchar(255) NOT NULL,
  `balasan_wa` text,
  `jam_pengajuan` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `jenis_pengajuan` varchar(255) NOT NULL,
  `status_ad` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spm`
--

INSERT INTO `spm` (`id`, `id_pegawai`, `id_user`, `id_satker`, `tanggal_pengajuan`, `balasan_wa`, `jam_pengajuan`, `jam_selesai`, `jenis_pengajuan`, `status_ad`, `status`, `created_at`, `updated_at`) VALUES
('9c95fa29-21ff-40db-9a02-20681d932a98', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '10 July 2024', '*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *Badan Pusat Statisk* dengan Kode Satker *50041* untuk pertemuan jadwal konsultasi spm dengan pegawai KPPN Ketapang bagian *Customer Services* pada tanggal *10 July 2024* pada pukul *12:22 WIB* hingga pukul *13:22 WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *Irsyad Husain Jauhari* *10 Menit* sebelum Jam *12:22 WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.', '12:22', '13:22', 'Konsultasi SPM', 'Di Terima', 'Di Terima', '2024-07-22 20:20:10', '2024-07-22 20:33:51'),
('9c9b7bce-fc1f-4aa6-a4d6-263f2ff46a8b', '9b94627b-63fc-4837-9d41-ee890c711f81', '9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', '17 July 2024', '*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *Badan Pusat Statisk* dengan Kode Satker *50041* untuk pertemuan jadwal konsultasi spm dengan pegawai KPPN Ketapang bagian *Customer Services* pada tanggal *17 July 2024* pada pukul *11:11 WIB* hingga pukul *12:02 WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *Irsyad Husain Jauhari* *10 Menit* sebelum Jam *11:11 WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.', '11:11', '12:02', 'Konsultasi SPM', 'Di Terima', 'Di Terima', '2024-07-25 14:01:50', '2024-07-25 17:47:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` char(36) NOT NULL,
  `id_satker` char(36) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `alamat_satker` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_satker`, `nama`, `username`, `email`, `password`, `jabatan`, `jenis_kelamin`, `level`, `no_hp`, `agama`, `alamat_satker`, `remember_token`, `created_at`, `updated_at`) VALUES
('9b946347-9222-4e54-bdcb-c4abc7fe8e91', '9b9462fa-96d6-4ef1-a3f1-6bd705861b45', 'Efgaaaa', 'ATOK', 'arikkk@gmail.com', '$2y$12$MEvBlRznqu5j81ksfW5fOuUSaBiOIHXKeMwMEsVFRp99NmC8gEN6K', 'Bendahara', 'Perempuan', 'satker', '08981229812', 'Islam', 'JL.Jendral Sudirman', NULL, '2024-03-16 19:10:31', '2024-07-25 05:41:46'),
('9b948ff8-aed6-4a9f-be08-5024d3ad8dce', NULL, 'Admin KPPN Ketapang', 'ari', 'ariktpa@gmail.com', '$2y$12$9jd657GaYusoM5ZwL4AoSuHieW2BrSeh9FI40O5jWlritnY5WOk0O', 'Customer Services', 'Laki-laki', 'admin', '08981229812', 'Islam', 'sididdi', NULL, '2024-03-16 21:15:29', '2024-07-19 20:36:19'),
('9bb85814-1090-4025-be22-61d3957f87e8', '9b997664-e4ef-47c9-ab9c-fe595c0a5275', 'panda', 'irsyad', 'kontol@gmail.com', '$2y$12$TyCTsnq7BB8vkWv7oNed4.EiTsvresniGxHfd3Of1cMk7fYsDqw3y', 'Bendahara', 'Laki-laki', 'satker', '08981229812', 'Islam', 'ldkdkdkd', NULL, '2024-04-03 16:09:00', '2024-05-29 13:11:51'),
('9c265ca4-d41b-401b-b95d-d711488d200e', '9c265bb4-c9dd-4099-99df-827d6983eecf', 'darmawan', 'mawan', 'mawan@gmail.com', '$2y$12$bGcNqWYqhjHO7DgysBBCSO3HCpAawhS3ezxI2ihkGmuYxPHNJSYh6', 'Bendahara Umum', 'Laki-laki', 'satker', '08981229812', 'Islam', 'Jln. Rangga Sentap, Kelurahan dalong', NULL, '2024-05-28 08:42:49', '2024-05-29 14:34:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `addk`
--
ALTER TABLE `addk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blastwa`
--
ALTER TABLE `blastwa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `broadcast`
--
ALTER TABLE `broadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `calender1`
--
ALTER TABLE `calender1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_lpj` (`id_lpj`);

--
-- Indeks untuk tabel `calender2`
--
ALTER TABLE `calender2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `khusus`
--
ALTER TABLE `khusus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satker`
--
ALTER TABLE `satker`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sp2d`
--
ALTER TABLE `sp2d`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `spd`
--
ALTER TABLE `spd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `spm`
--
ALTER TABLE `spm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_satker` (`id_satker`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
