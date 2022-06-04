-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2022 pada 12.05
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
(11, 2, 2);

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
(1, '001', '001', 1, 'Paku Payung', '20000', '20000', 24, '01 Juni 2022', 6, 5, 'paku payung', 1, 1),
(2, '002', '002', 2, 'Paku Besi', '20000', '20000', 23, '01 Juni 2022', 6, 5, 'paku besi', 1, 1),
(3, '003', '003', 3, 'Paku Beton ya', '20000', '120000', 25, '02 Juni 2022', 7, 6, 'paku beton ya', 1, 0),
(4, '004', '004', 4, 'Besi', '0', '2000000', 10, '04 Juni 2022', 6, 5, 'besi', 0, 0);

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
(7, 'Tripleks', 1, '28 Mei 2022'),
(8, 'Lem', 1, '04 Juni 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfigurasi`
--

CREATE TABLE `tb_konfigurasi` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(128) DEFAULT NULL,
  `icon_web` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_konfigurasi`
--

INSERT INTO `tb_konfigurasi` (`id`, `nama_web`, `icon_web`, `logo_web`, `updated_at`) VALUES
(1, 'Toko Mebel', '9f2c4e3dee541dffd77fe87790c528a8.png', NULL, '02 Juni 2022');

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
(6, 'Faktor Lingkungan', '0812638172', 'nurulhijab@gmail.com', 'asdfasdfsd', 1, '02 Juni 2022', '02 Juni 2022');

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
(3, 'Pengaturan', 3),
(4, 'Menu Manajemen', 4);

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
(9, 2, '001', '202206021', 240000, 240000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '240000', '240000', '0', 0, '0', NULL, 3, 1),
(10, 1, '002', '202206022', 30000, 30000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '30000', '30000', '0', 0, '0', NULL, 3, 1),
(11, 3, '003', '202206023', 90000, 90000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '90000', '90000', '0', 0, '0', NULL, 3, 1),
(12, 1, '003', '202206024', 270000, 270000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '270000', '270000', '0', 0, '0', NULL, 3, 1),
(13, 2, '004', '202206025', 30000, 30000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '30000', '30000', '0', 0, '0', NULL, 3, 1),
(14, 3, '005', '202206026', 190000, 190000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '190000', '190000', '0', 1, '0', '03 Juni 2022', 3, 1),
(15, 2, '003', '202206027', 300000, 300000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '300000', '300000', '0', 1, '0', '03 Juni 2022', 3, 1),
(16, 2, '004', '202206028', 900000, 900000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '900000', '900000', '0', 0, '0', NULL, 3, 1),
(17, 2, '005', '202206029', 2700000, 2700000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '2700000', '2700000', '0', 1, '0', '03 Juni 2022', 3, 1),
(18, 2, '005', '2022060210', 30000, 30000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '30000', '30000', '0', 1, '0', '03 Juni 2022', 3, 1),
(19, 3, '006', '2022060211', 60000, 60000, 0, 1, '03 Juni 2022', '03 Juni 2022', NULL, NULL, '60000', '60000', '0', 1, '0', '03 Juni 2022', 3, 1);

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
(25, 3, 3, 3, 1, '001', '202206021', '03 Juni 2022', '3', '3', 20000, NULL),
(26, 2, 2, 4, 1, '001', '202206021', '03 Juni 2022', '4', '4', 20000, NULL),
(27, 1, 1, 5, 1, '001', '202206021', '03 Juni 2022', '5', '5', 20000, NULL),
(28, 3, 3, 1, 1, '002', '202206022', '03 Juni 2022', '1', '1', 10000, NULL),
(29, 2, 2, 1, 1, '002', '202206022', '03 Juni 2022', '1', '1', 10000, NULL),
(30, 1, 1, 1, 1, '002', '202206022', '03 Juni 2022', '1', '1', 10000, NULL),
(31, 3, 3, 2, 1, '003', '202206023', '03 Juni 2022', '2', '2', 10000, NULL),
(32, 2, 2, 3, 1, '003', '202206023', '03 Juni 2022', '3', '3', 10000, NULL),
(33, 1, 1, 4, 1, '003', '202206023', '03 Juni 2022', '4', '4', 10000, NULL),
(34, 1, 1, 1, 1, '003', '202206024', '03 Juni 2022', '1', '1', 90000, NULL),
(35, 2, 2, 1, 1, '003', '202206024', '03 Juni 2022', '1', '1', 90000, NULL),
(36, 3, 3, 1, 1, '003', '202206024', '03 Juni 2022', '1', '1', 90000, NULL),
(37, 1, 1, 1, 1, '004', '202206025', '03 Juni 2022', '1', '1', 10000, NULL),
(38, 2, 2, 1, 1, '004', '202206025', '03 Juni 2022', '1', '1', 10000, NULL),
(39, 3, 3, 1, 1, '004', '202206025', '03 Juni 2022', '1', '1', 10000, NULL),
(40, 3, 3, 3, 1, '005', '202206026', '03 Juni 2022', '3', '3', 20000, NULL),
(41, 2, 2, 2, 1, '005', '202206026', '03 Juni 2022', '2', '2', 21000, NULL),
(42, 1, 1, 4, 1, '005', '202206026', '03 Juni 2022', '4', '4', 22000, NULL),
(43, 1, 1, 1, 1, '003', '202206027', '03 Juni 2022', '1', '1', 100000, NULL),
(44, 2, 2, 1, 1, '003', '202206027', '03 Juni 2022', '1', '1', 100000, NULL),
(45, 3, 3, 1, 1, '003', '202206027', '03 Juni 2022', '1', '1', 100000, NULL),
(46, 1, 1, 1, 1, '004', '202206028', '03 Juni 2022', '1', '1', 300000, NULL),
(47, 2, 2, 1, 1, '004', '202206028', '03 Juni 2022', '1', '1', 300000, NULL),
(48, 3, 3, 1, 1, '004', '202206028', '03 Juni 2022', '1', '1', 300000, NULL),
(49, 1, 1, 1, 1, '005', '202206029', '03 Juni 2022', '1', '1', 900000, NULL),
(50, 2, 2, 1, 1, '005', '202206029', '03 Juni 2022', '1', '1', 900000, NULL),
(51, 3, 3, 1, 1, '005', '202206029', '03 Juni 2022', '1', '1', 900000, NULL),
(52, 1, 1, 1, 1, '005', '2022060210', '03 Juni 2022', '1', '1', 10000, NULL),
(53, 2, 2, 1, 1, '005', '2022060210', '03 Juni 2022', '1', '1', 10000, NULL),
(54, 3, 3, 1, 1, '005', '2022060210', '03 Juni 2022', '1', '1', 10000, NULL),
(55, 1, 1, 1, 1, '006', '2022060211', '03 Juni 2022', '1', '1', 20000, NULL),
(56, 2, 2, 1, 1, '006', '2022060211', '03 Juni 2022', '1', '1', 20000, NULL),
(57, 3, 3, 1, 1, '006', '2022060211', '03 Juni 2022', '1', '1', 20000, NULL);

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
(1, '202206021', 1, '02 Juni 2022 - 09:35:32', 5, 'Adi Murdayani', 1, 0, 40000, 140000, NULL, 140000, 40000, 0, 1, '02 Juni 2022', NULL, NULL, 40000, 140000, NULL, 140000, 40000, 100000, NULL, NULL, NULL, NULL, 0, 40000, '2022-06-05', 1, 1),
(2, '202206022', 2, '02 Juni 2022 - 12:25:03', 5, NULL, 1, 0, 40000, 140000, NULL, 140000, 10000, 130000, 1, '02 Juni 2022', NULL, NULL, 40000, 140000, NULL, 140000, 10000, 130000, NULL, NULL, NULL, NULL, 1, 10000, '02 Juni 2022', NULL, 1),
(4, '202206024', 4, '02 Juni 2022 - 12:30:56', 6, NULL, 1, 1, 20000, 120000, NULL, 120000, 20000, 100000, 1, '02 Juni 2022', NULL, NULL, 20000, 120000, NULL, 120000, 20000, 100000, NULL, NULL, NULL, NULL, 1, 20000, '12 Juni 2022', NULL, 1),
(5, '202206025', 5, '03 Juni 2022 - 20:40:14', 5, NULL, 1, 0, 60000, 160000, NULL, 160000, 160000, 0, 1, '03 Juni 2022', NULL, NULL, 60000, 160000, NULL, 160000, 160000, 0, NULL, NULL, NULL, NULL, 0, 0, '0', NULL, 1),
(6, '202206026', 6, '03 Juni 2022 - 20:41:43', 5, NULL, 1, 0, 60000, 160000, NULL, 160000, 160000, 0, 1, '03 Juni 2022', NULL, NULL, 60000, 160000, NULL, 160000, 160000, 0, NULL, NULL, NULL, NULL, 1, 160000, '03 Juni 2022', NULL, 1);

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
(1, 2, 2, 1, 20000, 20000, 1, '202206021', NULL, 1, 1, 1),
(2, 3, 3, 1, 20000, 120000, 1, '202206021', NULL, 1, 1, 1),
(3, 2, 2, 1, 20000, 20000, 1, '202206022', NULL, 1, 1, 1),
(4, 3, 3, 1, 20000, 120000, 1, '202206022', NULL, 1, 1, 1),
(5, 3, 3, 1, 20000, 120000, 1, '202206023', NULL, 1, 1, 1),
(6, 3, 3, 1, 20000, 120000, 1, '202206024', NULL, 1, 1, 1),
(7, 1, 1, 1, 20000, 20000, 1, '202206025', NULL, 1, 1, 1),
(8, 2, 2, 1, 20000, 20000, 1, '202206025', NULL, 1, 1, 1),
(9, 3, 3, 1, 20000, 120000, 1, '202206025', NULL, 1, 1, 1),
(10, 1, 1, 1, 20000, 20000, 1, '202206026', NULL, 1, 1, 1),
(11, 2, 2, 1, 20000, 20000, 1, '202206026', NULL, 1, 1, 1),
(12, 3, 3, 1, 20000, 120000, 1, '202206026', NULL, 1, 1, 1);

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
(2, 202206021, '02 Juni 2022', '02 Juni 2022 - 11:52:19', 1, 10000, 1, 1),
(3, 202206021, '02 Juni 2022', '02 Juni 2022 - 11:52:32', 1, 80000, 1, 1);

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
(6, 'Cm', 1, '28 Mei 2022'),
(7, 'm', 1, '28 Mei 2022');

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
  `nomor_urut` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_submenu`
--

INSERT INTO `tb_submenu` (`id_submenu`, `id_menu`, `submenu`, `icon`, `url`, `collapse`, `nomor_urut`) VALUES
(1, 4, 'Menu', 'fe-menu', 'menu', 0, 1),
(2, 4, 'Submenu', 'fe-folder', 'menu/submenu', 0, 2),
(4, 3, 'User Manajemen', 'fe-users', 'user', 1, 3),
(5, 1, 'Dashboard', 'fe-grid', 'dashboard', 0, 1),
(7, 2, 'Penjualan', 'fe-shopping-cart', 'penjualan', 1, 2),
(8, 2, 'Pembelian', 'fe-shopping-bag', 'pembelian', 1, 3),
(11, 2, 'Master Data', 'fe-hash', 'master', 1, 4),
(12, 2, 'Laporan User', 'fe-file-text', 'laporan', 1, 4),
(13, 2, 'Laporan Barang', 'fe-file', 'laporan_barang', 1, 5),
(14, 2, 'Laporan Penjualan', 'fe-file', 'laporan_penjualan', 1, 6),
(15, 2, 'Laporan Pembelian', 'fe-file', 'laporan_pembelian', 1, 7),
(16, 3, 'Log Users', 'fe-git-pull-request', 'log_user', 0, 2),
(17, 3, 'Toko', 'fe-flag', 'toko', 0, 1),
(18, 3, 'Atur Web', 'fe-globe', 'konfigurasi', 0, 4);

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
(3, 2, 7, 'Invoice Penjualan', 'penjualan', 1, 5),
(4, 2, 7, 'Piutang Belum Lunas', 'penjualan/piutang', 1, 6),
(5, 2, 7, 'Piutang Lunas', 'penjualan/piutang/lunas', 1, 7),
(7, 2, 8, 'Invoice Pembelian', 'pembelian', 1, 3),
(8, 2, 8, 'Hutang Belum Selesai', 'pembelian/belum_lunas', 1, 4),
(9, 2, 8, 'Hutang Lunas', 'pembelian/lunas', 1, 5),
(10, 2, 8, 'Suplier', 'pembelian/suplier', 1, 2),
(11, 2, 8, 'Transaksi Pembelian', 'pembelian/transaksi_cash', 1, 1),
(12, 2, 11, 'Kategori', 'master/kategori', 1, 1),
(13, 2, 11, 'Barang', 'master/barang', 1, 3),
(14, 2, 11, 'Satuan', 'master/satuan', 1, 2),
(16, 2, 7, 'Kostumer', 'kostumer', 1, 4),
(17, 2, 7, 'Kasir', 'penjualan/transaksi_cash', 1, 3),
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
(29, 2, 7, 'Pesanan', 'penjualan/pesanan', 1, 1),
(30, 2, 7, 'Produksi', 'penjualan/produksi', 1, 2);

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
  `toko_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, '::1', '2022-06-02', 10, 'Windows 10', 'Chrome', '102.0.5005.63', '1654174002', '2022-06-02 08:29:51');

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
(1, '127.0.0.1', 'administrator', '$2y$10$MQ6bm3qGJZQnT7rntIKI6OgbWv2Y1.qWyxYlCTnloyve0i8NwsjfW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1654174002, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '', 'tokomebel', '$2y$10$nADyBE4CZmDjUE2jfSiSZ.lNFqnZloo25Jrfnb7tjxOK.B0nVQuim', 'tokomebel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1654173989, 1, 'Toko', 'Mebel', 'Toko Mebel', '08123124123');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_hutang`
--
ALTER TABLE `tb_hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_keranjang`
--
ALTER TABLE `tb_pembelian_keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_session`
--
ALTER TABLE `tb_pembelian_session`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_keranjang`
--
ALTER TABLE `tb_penjualan_keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_piutang`
--
ALTER TABLE `tb_penjualan_piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_submenu`
--
ALTER TABLE `tb_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_submenu_expan`
--
ALTER TABLE `tb_submenu_expan`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_visitor`
--
ALTER TABLE `tb_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
