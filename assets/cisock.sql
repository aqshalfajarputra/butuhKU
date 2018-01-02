-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Jan 2018 pada 06.06
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cisock`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(12) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `foto_barang` varchar(255) NOT NULL,
  `stok_barang` int(12) NOT NULL,
  `status_barang` set('available','empty') NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `foto_barang`, `stok_barang`, `status_barang`, `id_kategori`) VALUES
(1, 'Mikrotik M12', 'mikrotik.jpg', 74, 'available', 2),
(2, 'Cisco K233', 'cisco.jpg', 77, 'available', 2),
(3, 'Lenovo Ideapad  310', 'lenovo.jpg', 60, 'available', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_peminjaman`
--

CREATE TABLE `detil_peminjaman` (
  `id_detil_peminjaman` int(12) NOT NULL,
  `id_peminjaman` int(12) NOT NULL,
  `id_barang` int(12) NOT NULL,
  `jumlah` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detil_peminjaman`
--

INSERT INTO `detil_peminjaman` (`id_detil_peminjaman`, `id_peminjaman`, `id_barang`, `jumlah`) VALUES
(51, 42, 3, 1),
(52, 43, 3, 1),
(53, 44, 3, 1),
(54, 45, 3, 1),
(55, 45, 1, 1),
(56, 45, 2, 1),
(57, 46, 3, 1),
(58, 46, 1, 1),
(59, 46, 2, 1),
(60, 47, 3, 1),
(61, 50, 1, 1),
(62, 50, 2, 1),
(63, 51, 3, 1),
(64, 52, 3, 1),
(65, 53, 3, 1),
(66, 54, 3, 1),
(67, 55, 3, 1),
(68, 57, 3, 1),
(69, 58, 3, 1),
(70, 59, 3, 1),
(71, 60, 3, 1),
(72, 0, 1, 1),
(73, 0, 2, 1),
(74, 0, 1, 1),
(75, 0, 2, 1),
(76, 0, 1, 1),
(77, 0, 2, 1),
(78, 65, 1, 1),
(79, 65, 2, 1),
(80, 66, 3, 1),
(81, 66, 1, 1),
(82, 66, 2, 1),
(83, 67, 1, 1),
(84, 67, 2, 1),
(85, 68, 3, 1),
(86, 68, 1, 1),
(87, 68, 2, 1),
(88, 69, 1, 1),
(89, 69, 2, 1),
(90, 70, 1, 1),
(91, 70, 2, 1),
(92, 71, 3, 1),
(93, 72, 1, 1),
(94, 72, 2, 1),
(95, 73, 1, 1),
(96, 73, 2, 1),
(97, 74, 1, 1),
(98, 74, 2, 1),
(99, 76, 1, 1),
(100, 76, 2, 1),
(101, 77, 1, 1),
(102, 77, 2, 1),
(103, 78, 3, 1),
(104, 78, 1, 1),
(105, 78, 2, 1),
(106, 79, 3, 1),
(107, 79, 1, 1),
(108, 79, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Komputer'),
(2, 'Router');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_laporan` varchar(250) NOT NULL,
  `foto_laporan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `status_laporan` set('pending','proses','selesai','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `waktu_peminjaman` varchar(17) NOT NULL,
  `waktu_pengembalian` text NOT NULL,
  `penanggung` varchar(255) NOT NULL,
  `status_peminjaman` set('pending','verifikasi') NOT NULL,
  `telp_peminjam` int(12) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `nama_user`, `waktu_peminjaman`, `waktu_pengembalian`, `penanggung`, `status_peminjaman`, `telp_peminjam`, `keterangan`) VALUES
(63, 3, 'gjhkjl', '2018-01-02 07:56', '', 'gfhjhkj', 'pending', 6576879, 'jhkjl;l'),
(64, 3, 'gjnk', '2018-01-02 07:59', '', 'dgfhgjh', 'pending', 3456, 'fgjhkjl'),
(65, 3, 'hjbhkjl', '2018-01-02 09:22', '', 'dgfhgjhkj', 'pending', 46576, 'ghbjnmkp'),
(66, 3, 'Ea neque laborum', '2018-01-02 09:26', '', 'Sunt excepturi eu at aut sus', 'pending', 31, 'Sequi velit magna ea aliqua Enim esse numquam ratione'),
(67, 3, 'gvjhbknkl', '2018-01-02 09:27', '', 'fghjklk', 'pending', 4657687, 'fchhbjnmk;l'),
(68, 3, 'In est vitae n', '2018-01-02 09:28', '', 'Numquam quia', 'pending', 13, 'Nesciunt fugiat dolor est natus'),
(69, 3, 'fhgbjklk', '2018-01-02 09:34', '', 'fghjk', 'pending', 57687, 'jhbkl'),
(70, 3, 'vhjbkn', '2018-01-02 09:39', '', 'fhgjk', 'pending', 5768, 'jhkjlk'),
(71, 3, 'hgbjk', '2018-01-02 09:42', '', 'hjk', 'pending', 6789, 'hgbjnkl'),
(72, 3, 'fcghjkk', '2018-01-02 09:44', '', 'guhjkm', 'pending', 46578, 'gvubhimk'),
(73, 3, 'vhbjnk', '2018-01-02 09:45', '', 'hgbjlk', 'pending', 6576879, 'cfguhjk'),
(74, 3, 'vgbhj', '2018-01-02 09:46', '', 'fvhbj', 'pending', 678, 'hbjkmkl'),
(75, 3, 'vgjbhkn', '2018-01-02 09:52', '', 'hbjnkl', 'pending', 78989, 'hbjnm'),
(76, 3, 'gvjbhk', '2018-01-02 09:53', '', 'gvbhkjn', 'pending', 678798, 'jnkm'),
(77, 3, 'cfgvjbkn', '2018-01-02 09:56', '', 'hjhkjkm', 'pending', 678, 'nkml,;.'),
(78, 3, 'Ut sunt sint exercit', '2018-01-02 12:03', '', 'Voluptatem do qui aspernatur nostrud rerum est nihil', 'pending', 97, 'Anim ut est proident molestiae r\\'),
(79, 3, 'Ut sunt sint exercit', '2018-01-02 12:03', '', 'Voluptatem do qui aspernatur nostrud rerum est nihil', 'pending', 97, 'Anim ut est proident molestiae r\\');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` set('s_admin','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'sadmin', 'sadmin', 'sadmin', 's_admin'),
(2, 'admin', 'admin', 'admin', 'admin'),
(3, 'user', 'user', 'user', 'user'),
(4, 'uhij', 'aa', 'jhkl', 's_admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detil_peminjaman`
--
ALTER TABLE `detil_peminjaman`
  ADD PRIMARY KEY (`id_detil_peminjaman`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detil_peminjaman`
--
ALTER TABLE `detil_peminjaman`
  MODIFY `id_detil_peminjaman` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
