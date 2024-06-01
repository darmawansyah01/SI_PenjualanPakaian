-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2023 pada 09.11
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_pakaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--


CREATE TABLE `barang` (
  `ID_BARANG` char(10) NOT NULL,
  `NAMA_BARANG` char(10) NOT NULL,
  `WARNA` char(10) NOT NULL,
  `GAMBAR` text NOT NULL,
  `UKURAN` char(10) NOT NULL,
  `BAHAN` char(10) NOT NULL,
  `HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_trans_pembelian`
--

CREATE TABLE `detail_trans_pembelian` (
  `ID_TRANS_PEMBELIAN` char(10) NOT NULL,
  `ID_PEMBELIAN` char(10) NOT NULL,
  `ID_BARANG` char(10) NOT NULL,
  `NAMA_BARANG` char(10) NOT NULL,
  `HARGA` float NOT NULL,
  `TOTAL_HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_trans_penjualan`
--

CREATE TABLE `detail_trans_penjualan` (
  `ID_TRANS_PENJUALAN` char(10) NOT NULL,
  `ID_PENJUALAN` char(10) NOT NULL,
  `ID_BARANG` char(10) NOT NULL,
  `JENIS_PEMBAYARAN` char(10) NOT NULL,
  `HARGA` float NOT NULL,
  `TOTA_HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` char(10) NOT NULL,
  `NAMA` varchar(10) NOT NULL,
  `UMUR` int(10) NOT NULL,
  `ALAMAT` text NOT NULL,
  `EMAIL` int(15) NOT NULL,
  `PASSWORD` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_PENJUALAN` char(10) NOT NULL,
  `ID_USER` char(10) NOT NULL,
  `ID_BARANG` char(10) NOT NULL,
  `ID_PEGAWAI` char(10) NOT NULL,
  `NAMA_BARANG` varchar(15) NOT NULL,
  `HARGA` float NOT NULL,
  `ALAMAT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` char(10) NOT NULL,
  `ID_BARANG` varchar(10) NOT NULL,
  `NAMA_BARANG` varchar(10) NOT NULL,
  `ALAMAT` text NOT NULL,
  `HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `ID_PEMBELIAN` char(10) NOT NULL,
  `ID_USER` char(10) NOT NULL,
  `ID_BARANG` char(10) NOT NULL,
  `ID_SUPPLIER` char(10) NOT NULL,
  `ID_PEGAWAI` char(10) NOT NULL,
  `NAMA_BARANG` char(11) NOT NULL,
  `HARGA` float NOT NULL,
  `TOTAl_HARGA` float NOT NULL,
  `TGL_PEMBELIAN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID_USER` char(10) NOT NULL,
  `NAMA` char(10) NOT NULL,
  `ALAMAT` text NOT NULL,
  `GENDER` varchar(12) NOT NULL,
  `TGL_DAFTAR` date NOT NULL,
  `EMAIL` char(15) NOT NULL,
  `PASSWORD` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indeks untuk tabel `detail_trans_pembelian`
--
ALTER TABLE `detail_trans_pembelian`
  ADD PRIMARY KEY (`ID_TRANS_PEMBELIAN`),
  ADD UNIQUE KEY `ID_PEMBELIAN` (`ID_PEMBELIAN`,`ID_BARANG`);

--
-- Indeks untuk tabel `detail_trans_penjualan`
--
ALTER TABLE `detail_trans_penjualan`
  ADD PRIMARY KEY (`ID_TRANS_PENJUALAN`),
  ADD UNIQUE KEY `ID_PENJUALAN` (`ID_PENJUALAN`,`ID_BARANG`,`JENIS_PEMBAYARAN`),
  ADD KEY `ID_BARANG` (`ID_BARANG`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_PENJUALAN`),
  ADD UNIQUE KEY `ID_USER` (`ID_USER`,`ID_BARANG`,`ID_PEGAWAI`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`),
  ADD UNIQUE KEY `ID_BARANG` (`ID_BARANG`);

--
-- Indeks untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`ID_PEMBELIAN`),
  ADD UNIQUE KEY `ID_USER` (`ID_USER`,`ID_BARANG`),
  ADD UNIQUE KEY `ID_SUPPLIER` (`ID_SUPPLIER`,`ID_PEGAWAI`),
  ADD KEY `ID_BARANG` (`ID_BARANG`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_trans_pembelian`
--
ALTER TABLE `detail_trans_pembelian`
  ADD CONSTRAINT `detail_trans_pembelian_ibfk_1` FOREIGN KEY (`ID_PEMBELIAN`) REFERENCES `transaksi_pembelian` (`ID_PEMBELIAN`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_trans_penjualan`
--
ALTER TABLE `detail_trans_penjualan`
  ADD CONSTRAINT `detail_trans_penjualan_ibfk_1` FOREIGN KEY (`ID_PENJUALAN`) REFERENCES `penjualan` (`ID_PENJUALAN`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_trans_penjualan_ibfk_2` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD CONSTRAINT `transaksi_pembelian_ibfk_1` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaksi_pembelian_ibfk_2` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaksi_pembelian_ibfk_3` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
