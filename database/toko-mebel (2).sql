-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2022 pada 19.33
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-mebel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akses_menu`
--

CREATE TABLE `tb_akses_menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_akses_menu`
--

INSERT INTO `tb_akses_menu` (`id`, `user_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 1, 4),
(6, 1, 2),
(10, 2, 1),
(11, 2, 2),
(14, 2, 3),
(15, 1, 6),
(16, 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `barang_kode` varchar(500) DEFAULT NULL,
  `barang_kode_slug` varchar(500) DEFAULT NULL,
  `barang_kode_count` int(11) DEFAULT NULL,
  `barang_nama` varchar(200) DEFAULT NULL,
  `barang_harga_beli` varchar(250) DEFAULT NULL,
  `barang_harga` varchar(250) DEFAULT NULL,
  `barang_stok` int(200) DEFAULT NULL,
  `barang_tanggal` varchar(128) DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_satuan_id` int(11) DEFAULT NULL,
  `barang_deskripsi` varchar(128) DEFAULT NULL,
  `barang_terjual` int(11) DEFAULT NULL,
  `status_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `barang_kode`, `barang_kode_slug`, `barang_kode_count`, `barang_nama`, `barang_harga_beli`, `barang_harga`, `barang_stok`, `barang_tanggal`, `barang_kategori_id`, `barang_satuan_id`, `barang_deskripsi`, `barang_terjual`, `status_barang`) VALUES
(5, '0001', '0001', 1, 'Tripleks', '2000000', '370000', 25, '07 Juni 2022', 7, 8, 'tripleks', 1, 1),
(6, '002', '002', 2, 'Staplas', '20000000', '62000', 12, '08 Juni 2022', 6, 9, 'staplas lolos', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_detail`
--

CREATE TABLE `tb_barang_detail` (
  `id_detail_barang` int(11) NOT NULL,
  `detail_kode_barang` varchar(100) DEFAULT NULL,
  `detail_panjang` int(11) DEFAULT NULL,
  `detail_lebar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang_detail`
--

INSERT INTO `tb_barang_detail` (`id_detail_barang`, `detail_kode_barang`, `detail_panjang`, `detail_lebar`) VALUES
(1, '0001', 7000, 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_biaya_kas`
--

CREATE TABLE `tb_biaya_kas` (
  `id_biaya` int(11) NOT NULL,
  `bank` int(11) DEFAULT NULL,
  `motor` int(11) DEFAULT NULL,
  `listrik` int(11) DEFAULT NULL,
  `perbaikan` int(11) DEFAULT NULL,
  `pemeliharaan` int(11) DEFAULT NULL,
  `sewa` int(11) DEFAULT NULL,
  `gaji` int(11) DEFAULT NULL,
  `telp_internet` int(11) DEFAULT NULL,
  `pengeluaran_lain` int(11) DEFAULT NULL,
  `biaya_tak_terduga` int(11) DEFAULT NULL,
  `biaya_tanggal` varchar(128) DEFAULT NULL,
  `biaya_kasir_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hutang`
--

CREATE TABLE `tb_hutang` (
  `hutang_id` int(11) NOT NULL,
  `hutang_invoice` text DEFAULT NULL,
  `hutang_invoice_parent` text DEFAULT NULL,
  `hutang_date` varchar(128) DEFAULT NULL,
  `hutang_date_time` varchar(128) DEFAULT NULL,
  `hutang_nominal` varchar(500) DEFAULT NULL,
  `hutang_tipe_pembayaran` int(11) DEFAULT NULL,
  `hutang_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hutang`
--

INSERT INTO `tb_hutang` (`hutang_id`, `hutang_invoice`, `hutang_invoice_parent`, `hutang_date`, `hutang_date_time`, `hutang_nominal`, `hutang_tipe_pembayaran`, `hutang_cabang`) VALUES
(1, '003', '202206102', '10 Juni 2022', '10 Juni 2022 - 11:03:28', '100000', 1, 1),
(2, '003', '202206102', '10 Juni 2022', '10 Juni 2022 - 11:03:36', '200000', 1, 1),
(3, '003', '202206102', '10 Juni 2022', '10 Juni 2022 - 11:04:08', '0', 1, 1),
(10, '002', '202206103', '10 Juni 2022', '10 Juni 2022 - 14:27:52', '300000', 1, 1),
(11, '007', '202206106', '11 Juni 2022', '11 Juni 2022 - 19:13:05', '400000', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(128) DEFAULT NULL,
  `status_kategori` int(1) DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama_kategori`, `status_kategori`, `created_at`) VALUES
(6, 'Paku', 1, '28 Mei 2022'),
(7, 'Tripleks', 1, '28 Mei 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfigurasi`
--

CREATE TABLE `tb_konfigurasi` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(128) DEFAULT NULL,
  `icon_web` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `logo_small_web` varchar(255) DEFAULT NULL,
  `logo_nota` varchar(255) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_konfigurasi`
--

INSERT INTO `tb_konfigurasi` (`id`, `nama_web`, `icon_web`, `logo_web`, `logo_small_web`, `logo_nota`, `updated_at`) VALUES
(1, 'Toko Mebel', '92ee6004b1112fcb190aea6893c9dc1f.png', '1b2aae7c0ea1233426bfc5d103f95090.png', 'd7525095ef234a9ed76d065f6557d2a8.png', 'b355dac263a432562a4bf46eb48f1f28.png', '09 Juni 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kostumer`
--

CREATE TABLE `tb_kostumer` (
  `id_kostumer` int(11) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_kostumer` int(1) NOT NULL,
  `created_at` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kostumer`
--

INSERT INTO `tb_kostumer` (`id_kostumer`, `nama`, `phone`, `email`, `alamat`, `status_kostumer`, `created_at`, `updated_at`) VALUES
(5, 'Adi Murdayani', '0812638172', 'nurulhijab@gmail.com', 'Jl. Salobulo Kecamatan Wara, Kota  Palopo', 1, '01 Juni 2022', '01 Juni 2022'),
(6, 'Faktor Lingkungan', '0812638172', 'nurulhijab@gmail.com', 'asdfasdfsd', 0, '02 Juni 2022', '02 Juni 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `nomor_urut` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `menu`, `nomor_urut`) VALUES
(1, 'Navigasi', 1),
(2, 'Modul Data', 2),
(3, 'Pengaturan', 4),
(4, 'Menu Manajemen', 5),
(6, 'Laporan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(11) NOT NULL,
  `invoice_suplier_id` int(11) DEFAULT NULL,
  `invoice_pembelian` text DEFAULT NULL,
  `invoice_parent` text DEFAULT NULL,
  `invoice_total` int(11) DEFAULT NULL,
  `invoice_bayar` int(11) DEFAULT NULL,
  `invoice_kembali` int(11) DEFAULT NULL,
  `invoice_kasir` int(11) DEFAULT NULL,
  `invoice_tgl` varchar(128) DEFAULT NULL,
  `invoice_created` varchar(128) DEFAULT NULL,
  `invoice_updated` varchar(128) DEFAULT NULL,
  `invoice_kasir_edit` int(100) DEFAULT NULL,
  `invoice_total_lama` varchar(500) DEFAULT NULL,
  `invoice_bayar_lama` varchar(500) DEFAULT NULL,
  `invoice_kembali_lama` varchar(500) DEFAULT NULL,
  `invoice_hutang` int(11) DEFAULT NULL,
  `invoice_hutang_dp` varchar(500) DEFAULT NULL,
  `invoice_hutang_jatuh_tempo` varchar(500) DEFAULT NULL,
  `invoice_hutang_lunas` int(11) DEFAULT NULL,
  `invoice_pembelian_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id`, `invoice_suplier_id`, `invoice_pembelian`, `invoice_parent`, `invoice_total`, `invoice_bayar`, `invoice_kembali`, `invoice_kasir`, `invoice_tgl`, `invoice_created`, `invoice_updated`, `invoice_kasir_edit`, `invoice_total_lama`, `invoice_bayar_lama`, `invoice_kembali_lama`, `invoice_hutang`, `invoice_hutang_dp`, `invoice_hutang_jatuh_tempo`, `invoice_hutang_lunas`, `invoice_pembelian_cabang`) VALUES
(1, 2, '0023', '202206111', 380000, 380000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '380000', '380000', '0', 0, '0', NULL, 0, 1),
(2, 2, '0042', '202206112', 370000, 370000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '370000', '370000', '0', 0, '0', NULL, 0, 1),
(3, 2, '0042', '202206113', 370000, 370000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '370000', '370000', '0', 0, '0', NULL, 0, 1),
(4, 2, '0032', '202206114', 350000, 350000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '350000', '350000', '0', 0, '0', NULL, 0, 1),
(5, 2, '0033', '202206115', 350000, 350000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '350000', '350000', '0', 0, '0', NULL, 0, 1),
(6, 2, '006', '202206116', 550000, 550000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '550000', '550000', '0', 0, '0', NULL, 0, 1),
(7, 2, '005', '202206117', 760000, 760000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '760000', '760000', '0', 0, '0', NULL, 0, 1),
(8, 2, '005', '202206118', 760000, 760000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '760000', '760000', '0', 0, '0', NULL, 0, 1),
(9, 2, '001', '202206119', 240000, 240000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '240000', '240000', '0', 0, '0', NULL, 0, 1),
(10, 2, '003', '2022061110', 1100000, 1100000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '1100000', '1100000', '0', 0, '0', NULL, 0, 1),
(11, 3, '004', '2022061111', 100000, 100000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '100000', '100000', '0', 0, '0', NULL, 0, 1),
(12, 2, '0010', '2022061112', 200000, 200000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '200000', '200000', '0', 0, '0', NULL, 0, 1),
(13, 3, '0011', '2022061113', 10000000, 10000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '10000000', '10000000', '0', 0, '0', NULL, 0, 1),
(14, 3, '0012', '2022061114', 30000000, 30000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '30000000', '30000000', '0', 0, '0', NULL, 0, 1),
(15, 2, '0013', '2022061115', 43000000, 43000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '43000000', '43000000', '0', 0, '0', NULL, 0, 1),
(16, 2, '0014', '2022061116', 40000000, 40000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '40000000', '40000000', '0', 0, '0', NULL, 0, 1),
(17, 2, '0015', '2022061117', 15000000, 15000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '15000000', '15000000', '0', 0, '0', NULL, 0, 1),
(18, 2, '0016', '2022061118', 8000000, 8000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '8000000', '8000000', '0', 0, '0', NULL, 0, 1),
(19, 2, '0017', '2022061119', 14000000, 14000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '14000000', '14000000', '0', 0, '0', NULL, 0, 1),
(20, 3, '0018', '2022061120', 160000000, 160000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '160000000', '160000000', '0', 0, '0', NULL, 0, 1),
(21, 2, '0019', '2022061121', 200000000, 200000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '200000000', '200000000', '0', 0, '0', NULL, 0, 1),
(22, 2, '0026', '2022061122', 8000000, 8000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '8000000', '8000000', '0', 0, '0', NULL, 0, 1),
(23, 2, '0026', '2022061123', 8000000, 8000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '8000000', '8000000', '0', 0, '0', NULL, 0, 1),
(24, 3, '0028', '2022061124', 85000000, 85000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '85000000', '85000000', '0', 0, '0', NULL, 0, 1),
(25, 3, '0029', '2022061125', 92000000, 92000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '92000000', '92000000', '0', 0, '0', NULL, 0, 1),
(26, 3, '0030', '2022061126', 5000000, 5000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '5000000', '5000000', '0', 0, '0', NULL, 0, 1),
(27, 2, '0040', '2022061127', 400000, 400000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '400000', '400000', '0', 0, '0', NULL, 0, 1),
(28, 3, '0043', '2022061128', 20200000, 20200000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '20200000', '20200000', '0', 0, '0', NULL, 0, 1),
(29, 3, '0045', '2022061129', 28000000, 28000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '28000000', '28000000', '0', 0, '0', NULL, 0, 1),
(30, 2, '0047', '2022061130', 22000000, 22000000, 0, 1, '11 Juni 2022', '11 Juni 2022', NULL, NULL, '22000000', '22000000', '0', 0, '0', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `id` int(11) NOT NULL,
  `pembelian_barang_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `barang_qty` int(11) DEFAULT NULL,
  `keranjang_id_kasir` int(11) DEFAULT NULL,
  `pembelian_invoice` text DEFAULT NULL,
  `pembelian_invoice_parent` text DEFAULT NULL,
  `pembelian_date` varchar(128) DEFAULT NULL,
  `barang_qty_lama` varchar(500) DEFAULT NULL,
  `barang_qty_lama_parent` varchar(500) DEFAULT NULL,
  `barang_harga_beli` int(11) DEFAULT NULL,
  `pembelian_cabang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian_detail`
--

INSERT INTO `tb_pembelian_detail` (`id`, `pembelian_barang_id`, `barang_id`, `barang_qty`, `keranjang_id_kasir`, `pembelian_invoice`, `pembelian_invoice_parent`, `pembelian_date`, `barang_qty_lama`, `barang_qty_lama_parent`, `barang_harga_beli`, `pembelian_cabang_id`) VALUES
(1, 6, 6, 1, 1, '0023', '202206111', '11 Juni 2022', '1', '1', 60000, NULL),
(2, 5, 5, 1, 1, '0023', '202206111', '11 Juni 2022', '1', '1', 320000, NULL),
(3, 6, 6, 1, 1, '0042', '202206112', '11 Juni 2022', '1', '1', 70000, NULL),
(4, 5, 5, 1, 1, '0042', '202206112', '11 Juni 2022', '1', '1', 300000, NULL),
(5, 6, 6, 1, 1, '0042', '202206113', '11 Juni 2022', '1', '1', 70000, NULL),
(6, 5, 5, 1, 1, '0042', '202206113', '11 Juni 2022', '1', '1', 300000, NULL),
(7, 6, 6, 1, 1, '0032', '202206114', '11 Juni 2022', '1', '1', 50000, NULL),
(8, 5, 5, 1, 1, '0032', '202206114', '11 Juni 2022', '1', '1', 300000, NULL),
(9, 6, 6, 1, 1, '0033', '202206115', '11 Juni 2022', '1', '1', 50000, NULL),
(10, 5, 5, 1, 1, '0033', '202206115', '11 Juni 2022', '1', '1', 300000, NULL),
(11, 6, 6, 1, 1, '006', '202206116', '11 Juni 2022', '1', '1', 50000, NULL),
(12, 5, 5, 1, 1, '006', '202206116', '11 Juni 2022', '1', '1', 500000, NULL),
(13, 6, 6, 1, 1, '005', '202206117', '11 Juni 2022', '1', '1', 60000, NULL),
(14, 5, 5, 1, 1, '005', '202206117', '11 Juni 2022', '1', '1', 700000, NULL),
(15, 6, 6, 1, 1, '005', '202206118', '11 Juni 2022', '1', '1', 60000, NULL),
(16, 5, 5, 1, 1, '005', '202206118', '11 Juni 2022', '1', '1', 700000, NULL),
(17, 6, 6, 2, 1, '001', '202206119', '11 Juni 2022', '2', '2', 20000, NULL),
(18, 5, 5, 1, 1, '001', '202206119', '11 Juni 2022', '1', '1', 200000, NULL),
(19, 6, 6, 1, 1, '003', '2022061110', '11 Juni 2022', '1', '1', 100000, NULL),
(20, 5, 5, 1, 1, '003', '2022061110', '11 Juni 2022', '1', '1', 1000000, NULL),
(21, 6, 6, 1, 1, '004', '2022061111', '11 Juni 2022', '1', '1', 100000, NULL),
(22, 6, 6, 1, 1, '0010', '2022061112', '11 Juni 2022', '1', '1', 200000, NULL),
(23, 6, 6, 1, 1, '0011', '2022061113', '11 Juni 2022', '1', '1', 10000000, NULL),
(24, 6, 6, 1, 1, '0012', '2022061114', '11 Juni 2022', '1', '1', 30000000, NULL),
(25, 5, 5, 1, 1, '0013', '2022061115', '11 Juni 2022', '1', '1', 43000000, NULL),
(26, 6, 6, 2, 1, '0014', '2022061116', '11 Juni 2022', '2', '2', 20000000, NULL),
(27, 5, 5, 3, 1, '0015', '2022061117', '11 Juni 2022', '3', '3', 5000000, NULL),
(28, 5, 5, 8, 1, '0016', '2022061118', '11 Juni 2022', '8', '8', 1000000, NULL),
(29, 5, 5, 7, 1, '0017', '2022061119', '11 Juni 2022', '7', '7', 2000000, NULL),
(30, 5, 5, 8, 1, '0018', '2022061120', '11 Juni 2022', '8', '8', 20000000, NULL),
(31, 5, 5, 10, 1, '0019', '2022061121', '11 Juni 2022', '10', '10', 20000000, NULL),
(32, 5, 5, 4, 1, '0026', '2022061122', '11 Juni 2022', '4', '4', 2000000, NULL),
(33, 5, 5, 4, 1, '0026', '2022061123', '11 Juni 2022', '4', '4', 2000000, NULL),
(34, 6, 6, 3, 1, '0028', '2022061124', '11 Juni 2022', '3', '3', 20000000, NULL),
(35, 5, 5, 5, 1, '0028', '2022061124', '11 Juni 2022', '5', '5', 5000000, NULL),
(36, 6, 6, 4, 1, '0029', '2022061125', '11 Juni 2022', '4', '4', 20000000, NULL),
(37, 5, 5, 3, 1, '0029', '2022061125', '11 Juni 2022', '3', '3', 4000000, NULL),
(38, 6, 6, 1, 1, '0030', '2022061126', '11 Juni 2022', '1', '1', 2000000, NULL),
(39, 5, 5, 1, 1, '0030', '2022061126', '11 Juni 2022', '1', '1', 3000000, NULL),
(40, 6, 6, 1, 1, '0040', '2022061127', '11 Juni 2022', '1', '1', 200000, NULL),
(41, 5, 5, 1, 1, '0040', '2022061127', '11 Juni 2022', '1', '1', 200000, NULL),
(42, 6, 6, 1, 1, '0043', '2022061128', '11 Juni 2022', '1', '1', 200000, NULL),
(43, 5, 5, 1, 1, '0043', '2022061128', '11 Juni 2022', '1', '1', 20000000, NULL),
(44, 6, 6, 1, 1, '0045', '2022061129', '11 Juni 2022', '1', '1', 20000000, NULL),
(45, 5, 5, 4, 1, '0045', '2022061129', '11 Juni 2022', '4', '4', 2000000, NULL),
(46, 6, 6, 1, 1, '0047', '2022061130', '11 Juni 2022', '1', '1', 2000000, NULL),
(47, 5, 5, 1, 1, '0047', '2022061130', '11 Juni 2022', '1', '1', 20000000, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_keranjang`
--

CREATE TABLE `tb_pembelian_keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `keranjang_nama` varchar(250) DEFAULT NULL,
  `keranjang_harga` varchar(250) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `keranjang_qty` int(11) DEFAULT NULL,
  `keranjang_id_kasir` int(11) DEFAULT NULL,
  `keranjang_id_cek` varchar(500) DEFAULT NULL,
  `keranjang_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_session`
--

CREATE TABLE `tb_pembelian_session` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_input` varchar(250) DEFAULT NULL,
  `pembelian_parent` text DEFAULT NULL,
  `pembelian_user` varchar(250) DEFAULT NULL,
  `pembelian_delete` varchar(250) DEFAULT NULL,
  `pembelian_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian_session`
--

INSERT INTO `tb_pembelian_session` (`pembelian_id`, `pembelian_input`, `pembelian_parent`, `pembelian_user`, `pembelian_delete`, `pembelian_cabang`) VALUES
(36, '0046', '2022061131', '1', '202206111643', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `invoice_id` int(11) NOT NULL,
  `penjualan_invoice` text NOT NULL,
  `penjualan_invoice_count` int(11) DEFAULT NULL,
  `invoice_tgl` varchar(128) NOT NULL,
  `invoice_costumer` int(11) DEFAULT NULL,
  `invoice_kurir` varchar(128) DEFAULT NULL,
  `invoice_status_kurir` int(11) DEFAULT NULL,
  `invoice_tipe_transaksi` int(11) DEFAULT NULL,
  `invoice_total_beli` int(11) DEFAULT NULL,
  `invoice_total` int(11) DEFAULT NULL,
  `invoice_ongkir` int(11) DEFAULT NULL,
  `invoice_sub_total` int(11) DEFAULT NULL,
  `invoice_bayar` int(11) DEFAULT NULL,
  `invoice_kembali` int(11) DEFAULT NULL,
  `invoice_kasir` int(11) DEFAULT NULL,
  `invoice_date` varchar(128) DEFAULT NULL,
  `invoice_date_edit` varchar(128) DEFAULT NULL,
  `invoice_kasir_edit` varchar(128) DEFAULT NULL,
  `invoice_total_beli_lama` int(11) DEFAULT NULL,
  `invoice_total_lama` int(11) DEFAULT NULL,
  `invoice_ongkir_lama` int(11) DEFAULT NULL,
  `invoice_sub_total_lama` int(11) DEFAULT NULL,
  `invoice_bayar_lama` int(11) DEFAULT NULL,
  `invoice_kembali_lama` int(11) DEFAULT NULL,
  `invoice_marketplace` varchar(200) DEFAULT NULL,
  `invoice_ekspedisi` int(11) DEFAULT NULL,
  `invoice_no_resi` varchar(200) DEFAULT NULL,
  `invoice_date_selesai_kurir` int(11) DEFAULT NULL,
  `invoice_piutang` int(11) DEFAULT NULL,
  `invoice_piutang_dp` int(11) DEFAULT NULL,
  `invoice_piutang_jatuh_tempo` varchar(128) DEFAULT NULL,
  `invoice_piutang_lunas` int(11) DEFAULT NULL,
  `invoice_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`invoice_id`, `penjualan_invoice`, `penjualan_invoice_count`, `invoice_tgl`, `invoice_costumer`, `invoice_kurir`, `invoice_status_kurir`, `invoice_tipe_transaksi`, `invoice_total_beli`, `invoice_total`, `invoice_ongkir`, `invoice_sub_total`, `invoice_bayar`, `invoice_kembali`, `invoice_kasir`, `invoice_date`, `invoice_date_edit`, `invoice_kasir_edit`, `invoice_total_beli_lama`, `invoice_total_lama`, `invoice_ongkir_lama`, `invoice_sub_total_lama`, `invoice_bayar_lama`, `invoice_kembali_lama`, `invoice_marketplace`, `invoice_ekspedisi`, `invoice_no_resi`, `invoice_date_selesai_kurir`, `invoice_piutang`, `invoice_piutang_dp`, `invoice_piutang_jatuh_tempo`, `invoice_piutang_lunas`, `invoice_cabang`) VALUES
(1, '202206101', 1, '11 Juni 2022 - 21:15:18', 5, NULL, 1, 0, 382000, 500000, NULL, 500000, 500000, 0, 2, '11 Juni 2022', NULL, NULL, 382000, 500000, NULL, 500000, 500000, 0, NULL, NULL, NULL, NULL, 0, 0, '0', NULL, 2),
(2, '202206102', 2, '11 Juni 2022 - 21:17:06', 5, NULL, 1, 1, 382000, 2000000, NULL, 2000000, 100000, 0, 2, '11 Juni 2022', NULL, NULL, 382000, 2000000, NULL, 2000000, 100000, 1900000, NULL, NULL, NULL, NULL, 0, 100000, '12 Juni 2022', 1, 2),
(3, '202206103', 3, '11 Juni 2022 - 21:20:09', 0, NULL, 1, 0, 382000, 2000000, NULL, 2000000, 2000000, 0, 2, '11 Juni 2022', NULL, NULL, 382000, 2000000, NULL, 2000000, 2000000, 0, NULL, NULL, NULL, NULL, 0, 0, '0', NULL, 2),
(4, '202206104', 4, '11 Juni 2022 - 21:21:59', 5, NULL, 1, 1, 382000, 2000000, NULL, 2000000, 100000, 1900000, 2, '11 Juni 2022', NULL, NULL, 382000, 2000000, NULL, 2000000, 100000, 1900000, NULL, NULL, NULL, NULL, 1, 100000, '12 Juni 2022', NULL, 2),
(5, '202206111', 1, '11 Juni 2022 - 00:05:39', 5, NULL, 1, 1, 482000, 2000000, NULL, 2000000, 100000, 0, 1, '11 Juni 2022', NULL, NULL, 482000, 2000000, NULL, 2000000, 100000, 1900000, NULL, NULL, NULL, NULL, 0, 100000, '11 Juni 2022', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `id_penjualan` int(11) NOT NULL,
  `penjualan_barang_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `barang_qty` int(11) DEFAULT NULL,
  `keranjang_harga_beli` int(11) DEFAULT NULL,
  `keranjang_harga` int(11) DEFAULT NULL,
  `keranjang_id_kasir` int(11) DEFAULT NULL,
  `penjualan_invoice` varchar(200) DEFAULT NULL,
  `penjualan_date` varchar(200) DEFAULT NULL,
  `barang_qty_lama` int(11) DEFAULT NULL,
  `barang_qty_lama_parent` int(11) DEFAULT NULL,
  `penjualan_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`id_penjualan`, `penjualan_barang_id`, `barang_id`, `barang_qty`, `keranjang_harga_beli`, `keranjang_harga`, `keranjang_id_kasir`, `penjualan_invoice`, `penjualan_date`, `barang_qty_lama`, `barang_qty_lama_parent`, `penjualan_cabang`) VALUES
(1, 2, 2, 1, 382000, 500000, 2, '202206101', '11 Juni 2022 - 21:15:18', 1, 1, 2),
(2, 3, 3, 1, 382000, 2000000, 2, '202206102', NULL, 1, 1, 2),
(3, 3, 3, 1, 382000, 2000000, 2, '202206103', '11 Juni 2022 - 21:20:09', 1, 1, 2),
(4, 3, 3, 1, 382000, 2000000, 2, '202206104', NULL, 1, 1, 2),
(5, 4, 4, 1, 482000, 2000000, 1, '202206111', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_keranjang`
--

CREATE TABLE `tb_penjualan_keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `keranjang_nama` varchar(200) DEFAULT NULL,
  `keranjang_harga_beli` int(11) DEFAULT NULL,
  `keranjang_harga` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `barang_kode_slug` int(11) DEFAULT NULL,
  `keranjang_qty` int(11) DEFAULT NULL,
  `keranjang_id_kasir` int(11) DEFAULT NULL,
  `keranjang_id_cek` int(11) DEFAULT NULL,
  `keranjang_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_piutang`
--

CREATE TABLE `tb_penjualan_piutang` (
  `id_piutang` int(11) NOT NULL,
  `piutang_invoice` int(11) DEFAULT NULL,
  `piutang_date` varchar(128) DEFAULT NULL,
  `piutang_date_time` varchar(128) DEFAULT NULL,
  `piutang_kasir` int(11) DEFAULT NULL,
  `piutang_nominal` int(11) DEFAULT NULL,
  `piutang_tipe_pembayaran` int(11) DEFAULT NULL,
  `piutang_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan_piutang`
--

INSERT INTO `tb_penjualan_piutang` (`id_piutang`, `piutang_invoice`, `piutang_date`, `piutang_date_time`, `piutang_kasir`, `piutang_nominal`, `piutang_tipe_pembayaran`, `piutang_cabang`) VALUES
(1, 202206102, '11 Juni 2022', '11 Juni 2022 - 21:17:32', 2, 1900000, 2, 2),
(2, 202206111, '11 Juni 2022', '11 Juni 2022 - 06:03:02', 1, 1900000, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kostumer_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksi`
--

CREATE TABLE `tb_produksi` (
  `id_produksi` int(11) NOT NULL,
  `produksi_nama` varchar(128) DEFAULT NULL,
  `produksi_keterangan` text DEFAULT NULL,
  `produksi_invoice` varchar(100) DEFAULT NULL,
  `produksi_harga_modal` int(11) DEFAULT NULL,
  `produksi_harga_jual` int(11) DEFAULT NULL,
  `produksi_harga_total` int(11) DEFAULT NULL,
  `produksi_stok` int(11) DEFAULT NULL,
  `produksi_status` varchar(128) DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL,
  `produksi_kasir` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `produksi_terjual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produksi`
--

INSERT INTO `tb_produksi` (`id_produksi`, `produksi_nama`, `produksi_keterangan`, `produksi_invoice`, `produksi_harga_modal`, `produksi_harga_jual`, `produksi_harga_total`, `produksi_stok`, `produksi_status`, `created_at`, `updated_at`, `produksi_kasir`, `is_active`, `produksi_terjual`) VALUES
(2, 'Lemari', 'adfsd', '0023', 382000, 500000, 500000, 0, 'Proses', '11 Juni 2022 - 21:13:13', '11 Juni 2022', 2, 1, 1),
(3, 'Meja', 'asda', '0017', 382000, 2000000, 2000000, -1, 'Proses', '11 Juni 2022 - 21:16:35', '11 Juni 2022', 2, 1, 1),
(4, 'Lemari', 'asdfasd', '002', 482000, 2000000, 2000000, -1, 'Proses', '11 Juni 2022 - 00:05:07', '11 Juni 2022', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksi_detail`
--

CREATE TABLE `tb_produksi_detail` (
  `id_produksi_detail` int(11) NOT NULL,
  `detail_invoice_produksi` varchar(100) DEFAULT NULL,
  `detail_material_id` int(11) DEFAULT NULL,
  `detail_kode_barang` varchar(128) DEFAULT NULL,
  `detail_kategori_barang` int(11) DEFAULT NULL,
  `detail_harga_modal` int(11) DEFAULT NULL,
  `detail_harga_jual` int(11) DEFAULT NULL,
  `detail_harga_total` int(11) DEFAULT NULL,
  `detail_tgl` varchar(128) DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL,
  `detail_kasir_id` int(11) DEFAULT NULL,
  `detail_cabang_id` int(11) DEFAULT NULL,
  `detail_barang_panjang` int(11) DEFAULT NULL,
  `detail_barang_lebar` int(11) DEFAULT NULL,
  `detail_barang_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produksi_detail`
--

INSERT INTO `tb_produksi_detail` (`id_produksi_detail`, `detail_invoice_produksi`, `detail_material_id`, `detail_kode_barang`, `detail_kategori_barang`, `detail_harga_modal`, `detail_harga_jual`, `detail_harga_total`, `detail_tgl`, `created_at`, `updated_at`, `detail_kasir_id`, `detail_cabang_id`, `detail_barang_panjang`, `detail_barang_lebar`, `detail_barang_qty`) VALUES
(1, '0021', 6, '002', 6, 70000, 62000, 382000, '11 Juni 2022 - 20:58:35', '11 Juni 2022', '11 Juni 2022', 2, 2, 0, 0, 1),
(2, '0021', 5, '0001', 7, 320000, 370000, 382000, '11 Juni 2022 - 20:58:35', '11 Juni 2022', '11 Juni 2022', 2, 2, 1000, 1000, 1),
(3, '0023', 6, '002', 6, 70000, 62000, 382000, '11 Juni 2022 - 21:13:13', '11 Juni 2022', '11 Juni 2022', 2, 2, 0, 0, 1),
(4, '0023', 5, '0001', 7, 320000, 370000, 382000, '11 Juni 2022 - 21:13:13', '11 Juni 2022', '11 Juni 2022', 2, 2, 1000, 1000, 1),
(5, '0017', 6, '002', 6, 70000, 62000, 382000, '11 Juni 2022 - 21:16:35', '11 Juni 2022', '11 Juni 2022', 2, 2, 0, 0, 1),
(6, '0017', 5, '0001', 7, 320000, 370000, 382000, '11 Juni 2022 - 21:16:35', '11 Juni 2022', '11 Juni 2022', 2, 2, 1000, 1000, 1),
(7, '002', 6, '002', 6, 70000, 62000, 482000, '11 Juni 2022 - 00:05:07', '11 Juni 2022', '11 Juni 2022', 1, 1, 0, 0, 1),
(8, '002', 5, '0001', 7, 420000, 370000, 482000, '11 Juni 2022 - 00:05:07', '11 Juni 2022', '11 Juni 2022', 1, 1, 2000, 2000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksi_keranjang`
--

CREATE TABLE `tb_produksi_keranjang` (
  `id_produksi_keranjang` int(11) NOT NULL,
  `keranjang_invoice_parent` varchar(100) DEFAULT NULL,
  `keranjang_id_barang` int(11) DEFAULT NULL,
  `keranjang_kategori_barang` int(11) DEFAULT NULL,
  `keranjang_kode_barang` varchar(128) DEFAULT NULL,
  `keranjang_barang_qty` int(11) DEFAULT NULL,
  `keranjang_harga_modal` int(11) DEFAULT NULL,
  `keranjang_harga_jual` int(11) DEFAULT NULL,
  `keranjang_harga_total` int(11) DEFAULT NULL,
  `keranjang_date` varchar(128) DEFAULT NULL,
  `keranjang_kasir_id` int(11) DEFAULT NULL,
  `keranjang_panjang` int(11) DEFAULT NULL,
  `keranjang_lebar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksi_session`
--

CREATE TABLE `tb_produksi_session` (
  `id_session` int(11) NOT NULL,
  `session_invoice` varchar(100) DEFAULT NULL,
  `session_date` varchar(128) DEFAULT NULL,
  `session_kasir_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL,
  `nama_satuan` varchar(128) DEFAULT NULL,
  `status_satuan` int(1) DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `nama_satuan`, `status_satuan`, `created_at`) VALUES
(5, 'Kg', 1, '28 Mei 2022'),
(6, 'Cm', 0, '07 Juni 2022'),
(7, 'Pcs', 1, '07 Juni 2022'),
(8, 'Lembar', 1, '07 Juni 2022'),
(9, 'Dos', 1, '08 Juni 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_submenu`
--

CREATE TABLE `tb_submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `submenu` varchar(100) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `collapse` int(1) NOT NULL,
  `nomor_urut` int(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_submenu`
--

INSERT INTO `tb_submenu` (`id_submenu`, `id_menu`, `submenu`, `icon`, `url`, `collapse`, `nomor_urut`, `active`) VALUES
(1, 4, 'Menu', 'fe-menu', 'menu', 0, 1, 1),
(2, 4, 'Submenu', 'fe-folder', 'menu/submenu', 0, 2, 1),
(4, 4, 'User Manajemen', 'fe-users', 'user', 1, 3, 1),
(5, 1, 'Dashboard', 'fe-grid', 'dashboard', 0, 1, 1),
(7, 2, 'Penjualan', 'fe-shopping-cart', 'penjualan', 1, 2, 1),
(8, 2, 'Pembelian', 'fe-shopping-bag', 'pembelian', 1, 3, 1),
(11, 2, 'Master Data', 'fe-hash', 'master', 1, 4, 1),
(12, 6, 'User', 'fe-file-text', 'laporan', 1, 1, 1),
(13, 6, 'Barang', 'fe-file', 'laporan_barang', 1, 4, 1),
(14, 6, 'Penjualan', 'fe-file', 'laporan_penjualan', 1, 2, 1),
(15, 6, 'Pembelian', 'fe-file', 'laporan_pembelian', 1, 3, 1),
(16, 4, 'Log Users', 'fe-git-pull-request', 'log_user', 0, 4, 1),
(17, 3, 'Toko', 'fe-flag', 'toko', 0, 1, 1),
(18, 3, 'Atur Web', 'fe-globe', 'konfigurasi', 0, 4, 1),
(19, 2, 'Laba Bersih', 'fe-bar-chart-2', 'laba', 1, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_submenu_expan`
--

CREATE TABLE `tb_submenu_expan` (
  `sub_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  `nomor_urut` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_submenu_expan`
--

INSERT INTO `tb_submenu_expan` (`sub_id`, `menu_id`, `submenu_id`, `judul`, `url`, `is_active`, `nomor_urut`) VALUES
(1, 3, 4, 'Users', 'user', 1, 1),
(2, 3, 4, 'Grup Users', 'grup', 1, 2),
(3, 2, 7, 'Invoice Penjualan', 'penjualan', 1, 4),
(4, 2, 7, 'Piutang Belum Lunas', 'penjualan/piutang', 1, 5),
(5, 2, 7, 'Piutang Lunas', 'penjualan/piutang/lunas', 1, 6),
(7, 2, 8, 'Invoice Pembelian', 'pembelian', 1, 3),
(8, 2, 8, 'Hutang Belum Selesai', 'pembelian/belum_lunas', 1, 4),
(9, 2, 8, 'Hutang Lunas', 'pembelian/lunas', 1, 5),
(10, 2, 8, 'Suplier', 'pembelian/suplier', 1, 2),
(11, 2, 8, 'Transaksi Pembelian', 'pembelian/transaksi_cash', 1, 1),
(12, 2, 11, 'Kategori', 'master/kategori', 1, 1),
(13, 2, 11, 'Material', 'master/barang', 1, 3),
(14, 2, 11, 'Satuan', 'master/satuan', 1, 2),
(16, 2, 7, 'Kostumer', 'kostumer', 1, 3),
(17, 2, 7, 'Transaksi Pesanan', 'penjualan/transaksi_cash', 1, 2),
(18, 2, 12, 'Kasir', 'laporan', 1, 1),
(19, 2, 12, 'Kostumer', 'laporan/kostumer', 1, 2),
(20, 2, 13, 'Terlaris', 'laporan_barang', 1, 1),
(21, 2, 13, 'Stok', 'laporan_barang/stok_barang', 1, 2),
(22, 2, 14, 'Per Periode', 'laporan_penjualan', 1, 1),
(23, 2, 14, 'Per Produk', 'laporan_penjualan/produk', 1, 2),
(24, 2, 14, 'Retur', 'laporan_penjualan/retur', 1, 3),
(25, 2, 15, 'Per Periode', 'laporan_pembelian', 1, 1),
(26, 2, 15, 'Per Produk', 'laporan_pembelian/produk', 1, 2),
(27, 2, 15, 'Retur', 'laporan_pembelian/retur', 1, 3),
(28, 2, 12, 'Suplier', 'laporan/suplier', 1, 3),
(30, 2, 7, 'Produksi', 'produksi', 1, 1),
(31, 2, 19, 'Data Operasional', 'laba', 1, 1),
(32, 2, 19, 'Laporan Laba Bersih', 'laba/laporan', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suplier`
--

CREATE TABLE `tb_suplier` (
  `id_suplier` int(11) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `nama_perusahaan` varchar(128) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_suplier` int(1) NOT NULL,
  `created_at` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_suplier`
--

INSERT INTO `tb_suplier` (`id_suplier`, `nama`, `nama_perusahaan`, `phone`, `email`, `alamat`, `status_suplier`, `created_at`, `updated_at`) VALUES
(1, 'sasdf', 'Tekno Empire', '0812638172', NULL, 'asdfasd', 1, '29 Mei 2022', '29 Mei 2022'),
(2, 'Admin', 'adsfs', '0812638172', 'nurulhijab@gmail.com', 'asdfasd', 1, '29 Mei 2022', '29 Mei 2022'),
(3, 'Adi Murdayani', 'Diskominfo Palopo', '0812638172', 'nurulhijab@gmail.com', 'Jl. Salobulo', 1, '02 Juni 2022', '02 Juni 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `toko_nama` varchar(128) DEFAULT NULL,
  `toko_kota` varchar(128) DEFAULT NULL,
  `toko_alamat` text DEFAULT NULL,
  `toko_tlpn` varchar(20) DEFAULT NULL,
  `toko_wa` varchar(20) DEFAULT NULL,
  `toko_email` varchar(128) DEFAULT NULL,
  `toko_status` int(11) DEFAULT NULL,
  `toko_ongkir` int(11) DEFAULT NULL,
  `toko_cabang` int(11) DEFAULT NULL,
  `toko_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `toko_nama`, `toko_kota`, `toko_alamat`, `toko_tlpn`, `toko_wa`, `toko_email`, `toko_status`, `toko_ongkir`, `toko_cabang`, `toko_user_id`) VALUES
(1, 'Toko Cabang', 'Bungku ', 'Jl. Salobulo', '088123124123', '0812312413', 'adimurdayani@gmail.com', 1, 0, 1, 1),
(3, 'Lombu Cipta Perkasa', 'Luwu', 'Desa Tettekang, Kec. Bajo Barat Kab. Luwu', '6282255817418', '6282255817418', 'tokomebel@gmail.com', 1, 0, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_visitor`
--

CREATE TABLE `tb_visitor` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `os` varchar(128) DEFAULT NULL,
  `browser` varchar(128) DEFAULT NULL,
  `versi` varchar(128) DEFAULT NULL,
  `online` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_visitor`
--

INSERT INTO `tb_visitor` (`id`, `ip`, `date`, `hits`, `os`, `browser`, `versi`, `online`, `time`) VALUES
(1, '::1', '2022-05-26', 5, 'Windows 10', 'Chrome', '102.0.5005.62', '1653580093', '2022-05-26 17:38:01'),
(2, '::1', '2022-05-27', 6, 'Windows 10', 'Chrome', '102.0.5005.62', '1653669368', '2022-05-27 11:34:53'),
(3, '::1', '2022-05-28', 6, 'Windows 10', 'Chrome', '102.0.5005.62', '1653752815', '2022-05-28 07:24:24'),
(4, '::1', '2022-05-29', 2, 'Windows 10', 'Chrome', '102.0.5005.62', '1653817589', '2022-05-29 11:46:24'),
(5, '::1', '2022-05-31', 19, 'Windows 10', 'Chrome', '102.0.5005.62', '1654008580', '2022-05-31 16:30:53'),
(6, '::1', '2022-06-01', 5, 'Windows 10', 'Chrome', '102.0.5005.63', '1654094774', '2022-06-01 07:35:30'),
(7, '::1', '2022-06-02', 10, 'Windows 10', 'Chrome', '102.0.5005.63', '1654174002', '2022-06-02 08:29:51'),
(8, '::1', '2022-06-04', 8, 'Windows 10', 'Chrome', '102.0.5005.63', '1654360634', '2022-06-04 12:28:23'),
(9, '::1', '2022-06-07', 2, 'Windows 10', 'Chrome', '102.0.5005.63', '1654596523', '2022-06-07 12:08:38'),
(10, '::1', '2022-06-08', 9, 'Windows 10', 'Chrome', '102.0.5005.63', '1654703310', '2022-06-08 02:06:33'),
(11, '::1', '2022-06-09', 4, 'Windows 10', 'Chrome', '102.0.5005.63', '1654774013', '2022-06-09 10:14:16'),
(12, '::1', '2022-06-10', 11, 'Windows 10', 'Chrome', '102.0.5005.63', '1654894344', '2022-06-10 03:55:26'),
(13, '::1', '2022-06-11', 12, 'Windows 10', 'Chrome', '102.0.5005.63', '1654965035', '2022-06-11 00:01:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$rknG.LEZTPIHfqhiyCBHWOuX4C4z3cuXQ8s0iJ3NM1Twfi5I/UPDy', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1654965035, 1, 'Adi', 'Murdayani', 'Dinas Komunikasi dan Informatika Kota Palopo', '081343703057'),
(2, '', 'tokomebel', '$2y$10$nADyBE4CZmDjUE2jfSiSZ.lNFqnZloo25Jrfnb7tjxOK.B0nVQuim', 'tokomebel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1654875810, 1, 'Toko', 'Mebel', 'Toko Mebel', '08123124123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_akses_menu`
--
ALTER TABLE `tb_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_barang_detail`
--
ALTER TABLE `tb_barang_detail`
  ADD PRIMARY KEY (`id_detail_barang`);

--
-- Indeks untuk tabel `tb_biaya_kas`
--
ALTER TABLE `tb_biaya_kas`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indeks untuk tabel `tb_hutang`
--
ALTER TABLE `tb_hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kostumer`
--
ALTER TABLE `tb_kostumer`
  ADD PRIMARY KEY (`id_kostumer`);

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pembelian_keranjang`
--
ALTER TABLE `tb_pembelian_keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indeks untuk tabel `tb_pembelian_session`
--
ALTER TABLE `tb_pembelian_session`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indeks untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `tb_penjualan_keranjang`
--
ALTER TABLE `tb_penjualan_keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indeks untuk tabel `tb_penjualan_piutang`
--
ALTER TABLE `tb_penjualan_piutang`
  ADD PRIMARY KEY (`id_piutang`);

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `tb_produksi`
--
ALTER TABLE `tb_produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indeks untuk tabel `tb_produksi_detail`
--
ALTER TABLE `tb_produksi_detail`
  ADD PRIMARY KEY (`id_produksi_detail`);

--
-- Indeks untuk tabel `tb_produksi_keranjang`
--
ALTER TABLE `tb_produksi_keranjang`
  ADD PRIMARY KEY (`id_produksi_keranjang`);

--
-- Indeks untuk tabel `tb_produksi_session`
--
ALTER TABLE `tb_produksi_session`
  ADD PRIMARY KEY (`id_session`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_submenu`
--
ALTER TABLE `tb_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indeks untuk tabel `tb_submenu_expan`
--
ALTER TABLE `tb_submenu_expan`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indeks untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `tb_visitor`
--
ALTER TABLE `tb_visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_akses_menu`
--
ALTER TABLE `tb_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_barang_detail`
--
ALTER TABLE `tb_barang_detail`
  MODIFY `id_detail_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_biaya_kas`
--
ALTER TABLE `tb_biaya_kas`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_hutang`
--
ALTER TABLE `tb_hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kostumer`
--
ALTER TABLE `tb_kostumer`
  MODIFY `id_kostumer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_keranjang`
--
ALTER TABLE `tb_pembelian_keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_session`
--
ALTER TABLE `tb_pembelian_session`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_keranjang`
--
ALTER TABLE `tb_penjualan_keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_piutang`
--
ALTER TABLE `tb_penjualan_piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_produksi`
--
ALTER TABLE `tb_produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_produksi_detail`
--
ALTER TABLE `tb_produksi_detail`
  MODIFY `id_produksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_produksi_keranjang`
--
ALTER TABLE `tb_produksi_keranjang`
  MODIFY `id_produksi_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_produksi_session`
--
ALTER TABLE `tb_produksi_session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_submenu`
--
ALTER TABLE `tb_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_submenu_expan`
--
ALTER TABLE `tb_submenu_expan`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_visitor`
--
ALTER TABLE `tb_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
