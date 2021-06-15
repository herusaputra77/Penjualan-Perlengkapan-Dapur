-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2021 pada 03.58
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dapur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `satuan`, `jumlah`, `harga`, `gambar`) VALUES
(1, 'Bawang Merah', 'Kg', 37, 10000, 'bawang_merah.jpg'),
(8, 'Teplon', '', 30, 20000, 'teplon.jpg'),
(9, 'Wajan', 'Unit', 15, 15000, 'wajan.jpg'),
(10, 'Kuali Manis', 'Pcs', 12, 40000, 'wajan1.jpg'),
(11, 'spatula', 'Pcs', 41, 50000, 'spatula1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_barang`, `id_user`, `komentar`) VALUES
(1, 1, 10, 'hai'),
(2, 1, 10, ''),
(3, 1, 10, ''),
(4, 1, 10, 'bow'),
(6, 1, 6, 'kurang menarik'),
(7, 8, 10, 'kurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `id_user`) VALUES
(1, 1),
(3, 3),
(4, 8),
(5, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'penjual'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_toko`
--

CREATE TABLE `tb_barang_toko` (
  `id_barang` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_toko`
--

INSERT INTO `tb_barang_toko` (`id_barang`, `id_toko`, `id_penjual`) VALUES
(1, 1, 1),
(8, 3, 3),
(9, 4, 1),
(10, 1, 1),
(11, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_faktur`
--

CREATE TABLE `tb_faktur` (
  `id_faktur` int(11) NOT NULL,
  `tgl_order` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `metode_bayar` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_faktur`
--

INSERT INTO `tb_faktur` (`id_faktur`, `tgl_order`, `alamat`, `id_user`, `metode_bayar`, `ongkir`, `total_bayar`, `status_bayar`, `bukti_pembayaran`) VALUES
(3, '2021-02-23', 'jambi', 10, 1, 2000, 80000, 0, '23.PNG'),
(4, '2021-02-23', 'bungo', 10, 2, 2000, 139000, 2, '99-999679_telephone-icon-png-clipart-computer-icons-telephone-logo3.png'),
(5, '2021-02-24', 'Jln. Duku, SP 3. Kec. Limbur Lubuk Mengkuang', 6, 2, 2000, 90000, 2, 'bauk.png'),
(6, '2021-03-06', 'padang', 10, 2, 2000, 175000, 2, 'Action.jpg'),
(7, '2021-03-06', 'menado', 6, 2, 2000, 93000, 1, '231.PNG'),
(8, '2021-03-07', 'medan', 6, 1, 2000, 52000, 0, 'Belum ada'),
(9, '2021-03-07', 'ampang', 10, 2, 2000, 145000, 0, 'Belum ada'),
(10, '2021-03-15', 'muaro bungo', 10, 2, 2000, 114000, 2, '232.PNG'),
(11, '2021-03-16', 'padang', 10, 2, 2000, 58000, 1, 'baja_ringan2.jpg'),
(12, '2021-03-16', 'padang', 10, 1, 2000, 84000, 0, 'Belum ada'),
(13, '2021-03-18', 'jambi', 10, 2, 2000, 12000, 0, 'Belum ada'),
(14, '2021-03-22', 'bungo', 10, 1, 2000, 17000, 0, 'Belum ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_metode`
--

CREATE TABLE `tb_metode` (
  `id_metode` int(11) NOT NULL,
  `metode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_metode`
--

INSERT INTO `tb_metode` (`id_metode`, `metode`) VALUES
(1, 'COD'),
(2, 'Transfer BANK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_faktur`, `id_barang`, `id_toko`, `nama_brg`, `jumlah`, `harga`, `status_pengiriman`) VALUES
(2, 3, 1, 1, 'Bawang Merah', 3, 10000, 1),
(3, 3, 8, 3, 'Teplon', 2, 20000, 0),
(4, 4, 8, 3, 'Teplon', 4, 20000, 0),
(5, 4, 9, 4, 'Wajan', 3, 15000, 2),
(6, 5, 1, 1, 'Bawang Merah', 2, 10000, 2),
(7, 5, 8, 3, 'Teplon', 3, 20000, 0),
(8, 6, 1, 1, 'Bawang Merah', 3, 10000, 0),
(9, 6, 8, 3, 'Teplon', 4, 20000, 0),
(10, 6, 9, 4, 'Wajan', 3, 15000, 0),
(11, 7, 1, 1, 'Bawang Merah', 1, 10000, 1),
(12, 7, 8, 3, 'Teplon', 1, 20000, 2),
(13, 7, 9, 4, 'Wajan', 1, 15000, 0),
(14, 7, 10, 1, 'Kuali Manis', 1, 40000, 1),
(15, 8, 11, 4, 'spatula', 1, 50000, 1),
(16, 9, 1, 1, 'Bawang Merah', 1, 10000, 0),
(17, 9, 8, 3, 'Teplon', 1, 20000, 0),
(18, 9, 9, 4, 'Wajan', 1, 15000, 2),
(19, 9, 10, 1, 'Kuali Manis', 1, 40000, 0),
(20, 9, 11, 4, 'spatula', 1, 50000, 2),
(21, 10, 8, 3, 'Teplon', 3, 20000, 0),
(22, 10, 1, 1, 'Bawang Merah', 4, 10000, 2),
(23, 11, 1, 1, 'Bawang Merah', 3, 10000, 2),
(24, 11, 8, 3, 'Teplon', 1, 20000, 0),
(25, 12, 10, 1, 'Kuali Manis', 2, 40000, 1),
(26, 13, 1, 1, 'Bawang Merah', 1, 10000, 2),
(27, 14, 9, 4, 'Wajan', 1, 15000, 1);

--
-- Trigger `tb_order`
--
DELIMITER $$
CREATE TRIGGER `penjualan_barang` AFTER INSERT ON `tb_order` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah-NEW.jumlah
    WHERE id_barang = NEW.id_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `no_hp_pengirim` varchar(20) NOT NULL,
  `kendaraan` varchar(100) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL,
  `status_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`id_pengiriman`, `id_faktur`, `id_toko`, `id_user`, `nama_pengirim`, `no_hp_pengirim`, `kendaraan`, `alamat_pengiriman`, `status_pengiriman`) VALUES
(1, 13, 1, 1, 'Sofian', '2060596', 'Motor', 'jambi', 1),
(2, 9, 4, 1, 'Hafizudin', '2095824058', 'Mobil', 'ampang', 1),
(3, 12, 1, 1, 'heru', '958603680', 'Motor', 'padang', 1),
(4, 14, 4, 1, 'heru', '34645', 'Motor', 'bungo', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `satuan`, `keterangan`) VALUES
(1, 'Kg', 'Kilogram'),
(2, 'G', 'Gram'),
(3, 'Ons', 'Ons'),
(4, 'Pcs', 'Pieces');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `tgl_buat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_role`, `username`, `email`, `password`, `nama`, `jenis_kelamin`, `alamat`, `no_hp`, `image`, `tgl_buat`) VALUES
(1, 2, 'markonah98', 'markonah11@gmail.com', '1234', 'markonah', 'wanita', 'Rimbo bujang', '082307604711', 'user.png', 1612238999),
(2, 1, 'herusaputra77', 'herusaputra@gmail.com', '12051998', 'Heru Saputra', 'pria', 'Dharmasraya', '082384169797', 'user.png', 1612254245),
(3, 2, 'yana938', 'widuwifa98@yahoo.com', '1234', 'yana', 'wanita', 'Rimbo bujang', '082307604711', 'user.png', 1612437432),
(6, 3, 'julianto765', 'juljul56@yahoo.com', '1234', 'juloanto', 'pria', 'Padang', '320570452-', 'user.png', 1612443160),
(7, 3, 'nadia97', 'nadia97@gmail.com', '1234', 'nadia', 'wanita', 'Dharmasraya', '094802457', 'user.png', 1612712515),
(8, 2, 'toni45', 'toni@email.com', '1234', 'toni', 'pria', 'sp3', '805429680', 'user.png', 1613141531),
(10, 3, 'herusaputra98', 'heru@yahoo.com', '1234', 'Heru Saputra', 'pria', 'Dharmasraya', '082384169797', 'user.png', 1613142151);

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_penjual` int(11) DEFAULT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat_toko` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `id_penjual`, `nama_toko`, `alamat_toko`, `keterangan`, `logo`) VALUES
(1, 1, 'anugrah', 'padang', 'grosir', '232.PNG'),
(3, 3, 'terpercaya', 'dharmasraya', 'toserba', 'Nugget-Goreng-0-5975d08c0aac9860.jpg'),
(4, 1, 'Sayur SP3', 'Bungo', 'Grosir', 'img_137893.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_barang_toko`
--
ALTER TABLE `tb_barang_toko`
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tb_faktur`
--
ALTER TABLE `tb_faktur`
  ADD PRIMARY KEY (`id_faktur`);

--
-- Indeks untuk tabel `tb_metode`
--
ALTER TABLE `tb_metode`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_penjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_faktur`
--
ALTER TABLE `tb_faktur`
  MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_metode`
--
ALTER TABLE `tb_metode`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
