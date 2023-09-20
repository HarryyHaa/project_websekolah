-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 10.4.6-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk kelulusan


-- membuang struktur untuk table kelulusan.kelompok
CREATE TABLE IF NOT EXISTS `kelompok` (
  `id_kelompok` varchar(2) NOT NULL,
  `nama_kelompok` varchar(250) NOT NULL,
  PRIMARY KEY (`id_kelompok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel kelulusan.kelompok: ~0 rows (lebih kurang)

-- membuang struktur untuk table kelulusan.log
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `log` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.log: ~3 rows (lebih kurang)
REPLACE INTO `log` (`id_log`, `id_user`, `type`, `log`, `tgl`) VALUES
	(4, 1, 1, 'Membuka amplop kelulusan', '2020-04-27 08:00:53'),
	(5, 171819023, 1, 'Membuka amplop kelulusan', '2021-05-25 13:38:07'),
	(6, 171819025, 1, 'Membuka amplop kelulusan', '2022-05-16 06:46:36'),
	(7, 171819024, 1, 'Membuka amplop kelulusan', '2022-05-23 04:21:50');

-- membuang struktur untuk table kelulusan.mapel
CREATE TABLE IF NOT EXISTS `mapel` (
  `kode_mapel` varchar(50) NOT NULL,
  `nama_mapel` varchar(250) NOT NULL,
  `no_urut` int(2) NOT NULL,
  `kelompok` varchar(10) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `aktif_skl` int(1) NOT NULL,
  `aktif_transkip` int(1) NOT NULL,
  PRIMARY KEY (`kode_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel kelulusan.mapel: ~20 rows (lebih kurang)
REPLACE INTO `mapel` (`kode_mapel`, `nama_mapel`, `no_urut`, `kelompok`, `jurusan`, `aktif_skl`, `aktif_transkip`) VALUES
	('KODE1', 'PUSING', 1, 'A', 'semua', 1, 1),
	('KODE10', 'MAPEL10', 10, 'B', 'semua', 1, 1),
	('KODE11', 'MAPEL11', 11, 'B', 'semua', 1, 1),
	('KODE12', 'MAPEL12', 12, 'C', 'Teknik Komputer Jaringan', 1, 1),
	('KODE13', 'MAPEL13', 13, 'C', 'Teknik Komputer Jaringan', 1, 1),
	('KODE14', 'MAPEL14', 14, 'C', 'Teknik Komputer Jaringan', 1, 1),
	('KODE15', 'MAPEL15', 15, 'C', 'Teknik Komputer Jaringan', 1, 1),
	('KODE16', 'MAPEL16', 16, 'C', 'Teknik Pemesinan', 1, 1),
	('KODE17', 'MAPEL17', 17, 'C', 'Teknik Pemesinan', 1, 1),
	('KODE18', 'MAPEL18', 18, 'C', 'Teknik Pemesinan', 1, 1),
	('KODE19', 'MAPEL19', 19, 'C', 'Teknik Kendaraan Ringan', 1, 1),
	('KODE2', 'TEU PUGUH', 2, 'A', 'semua', 1, 1),
	('KODE20', 'MAPEL20', 20, 'C', 'Teknik Kendaraan Ringan', 1, 1),
	('KODE3', 'MAPEL3', 3, 'A', 'semua', 1, 1),
	('KODE4', 'MAPEL4', 4, 'A', 'semua', 1, 1),
	('KODE5', 'MAPEL5', 5, 'A', 'semua', 1, 1),
	('KODE6', 'MAPEL6', 6, 'A', 'semua', 0, 1),
	('KODE7', 'MAPEL7', 7, 'B', 'semua', 0, 1),
	('KODE8', 'MAPEL8', 8, 'B', 'semua', 1, 1),
	('KODE9', 'MAPEL9', 9, 'B', 'semua', 1, 1);

-- membuang struktur untuk table kelulusan.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(50) NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `semester` int(1) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel kelulusan.nilai: ~72 rows (lebih kurang)
REPLACE INTO `nilai` (`id_nilai`, `nis`, `kode_mapel`, `nilai`, `semester`) VALUES
	(5, '171819023', 'KODE2', '79', 6),
	(6, '171819024', 'KODE2', '79', 6),
	(7, '171819025', 'KODE2', '79', 6),
	(8, '171819026', 'KODE2', '79', 6),
	(9, '171819023', 'KODE3', '65', 6),
	(10, '171819024', 'KODE3', '65', 6),
	(11, '171819025', 'KODE3', '65', 6),
	(12, '171819026', 'KODE3', '65', 6),
	(13, '171819023', 'KODE4', '65', 6),
	(14, '171819024', 'KODE4', '65', 6),
	(15, '171819025', 'KODE4', '65', 6),
	(16, '171819026', 'KODE4', '65', 6),
	(17, '171819023', 'KODE6', '84', 6),
	(18, '171819024', 'KODE6', '84', 6),
	(19, '171819025', 'KODE6', '84', 6),
	(20, '171819026', 'KODE6', '84', 6),
	(21, '171819023', 'KODE7', '89', 6),
	(22, '171819024', 'KODE7', '89', 6),
	(23, '171819025', 'KODE7', '89', 6),
	(24, '171819026', 'KODE7', '89', 6),
	(25, '171819023', 'KODE8', '79', 6),
	(26, '171819024', 'KODE8', '79', 6),
	(27, '171819025', 'KODE8', '79', 6),
	(28, '171819026', 'KODE8', '79', 6),
	(29, '171819023', 'KODE10', '89', 6),
	(30, '171819024', 'KODE10', '89', 6),
	(31, '171819025', 'KODE10', '89', 6),
	(32, '171819026', 'KODE10', '89', 6),
	(33, '171819023', 'KODE11', '79', 6),
	(34, '171819024', 'KODE11', '79', 6),
	(35, '171819025', 'KODE11', '79', 6),
	(36, '171819026', 'KODE11', '79', 6),
	(37, '171819023', 'KODE12', '79', 6),
	(38, '171819024', 'KODE12', '79', 6),
	(39, '171819025', 'KODE12', '79', 6),
	(40, '171819026', 'KODE12', '79', 6),
	(41, '171819023', 'KODE13', '84', 6),
	(42, '171819024', 'KODE13', '84', 6),
	(43, '171819025', 'KODE13', '84', 6),
	(44, '171819026', 'KODE13', '84', 6),
	(45, '171819023', 'KODE14', '79', 6),
	(46, '171819024', 'KODE14', '79', 6),
	(47, '171819025', 'KODE14', '79', 6),
	(48, '171819026', 'KODE14', '79', 6),
	(49, '171819023', 'KODE15', '84', 6),
	(50, '171819024', 'KODE15', '84', 6),
	(51, '171819025', 'KODE15', '84', 6),
	(52, '171819026', 'KODE15', '84', 6),
	(53, '171819023', 'KODE16', '89', 6),
	(54, '171819024', 'KODE16', '89', 6),
	(55, '171819025', 'KODE16', '89', 6),
	(56, '171819026', 'KODE16', '89', 6),
	(57, '171819023', 'KODE17', '79', 6),
	(58, '171819024', 'KODE17', '79', 6),
	(59, '171819025', 'KODE17', '79', 6),
	(60, '171819026', 'KODE17', '79', 6),
	(61, '171819023', 'KODE18', '84', 6),
	(62, '171819024', 'KODE18', '84', 6),
	(63, '171819025', 'KODE18', '84', 6),
	(64, '171819026', 'KODE18', '84', 6),
	(65, '171819023', 'KODE19', '79', 6),
	(66, '171819024', 'KODE19', '79', 6),
	(67, '171819025', 'KODE19', '79', 6),
	(68, '171819026', 'KODE19', '79', 6),
	(69, '171819023', 'KODE20', '84', 6),
	(70, '171819024', 'KODE20', '84', 6),
	(71, '171819025', 'KODE20', '84', 6),
	(72, '171819026', 'KODE20', '84', 6),
	(81, '171819023', 'KODE1', '89', 6),
	(82, '171819024', 'KODE1', '89', 6),
	(83, '171819025', 'KODE1', '89', 6),
	(84, '171819026', 'KODE1', '89', 6);

-- membuang struktur untuk table kelulusan.pengumuman
CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text DEFAULT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jenis` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.pengumuman: ~1 rows (lebih kurang)
REPLACE INTO `pengumuman` (`id_pengumuman`, `id_user`, `judul`, `pengumuman`, `tgl`, `jenis`) VALUES
	(2, 3, 'SURAT SKL', '<p>Untuk pengambilan Surat Keterangan Lulus (SKL) bisa diambil disekolah mulai hari senin, 3 Juni 2022</p>', '2022-05-15 19:40:40', 2);

-- membuang struktur untuk table kelulusan.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `id_setting` int(1) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `npsn` varchar(30) DEFAULT NULL,
  `nama_kepsek` varchar(50) DEFAULT NULL,
  `nip_kepsek` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `tgl_pengumuman` datetime DEFAULT NULL,
  `klikchat` text DEFAULT NULL,
  `livechat` text DEFAULT NULL,
  `nolivechat` varchar(50) DEFAULT NULL,
  `infobayar` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  `banner` varchar(50) DEFAULT NULL,
  `login` int(1) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `semester` int(1) NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.setting: ~1 rows (lebih kurang)
REPLACE INTO `setting` (`id_setting`, `nama_sekolah`, `npsn`, `nama_kepsek`, `nip_kepsek`, `alamat`, `kota`, `provinsi`, `logo`, `favicon`, `email`, `no_telp`, `tgl_pengumuman`, `klikchat`, `livechat`, `nolivechat`, `infobayar`, `syarat`, `banner`, `login`, `tahun_lulus`, `semester`) VALUES
	(1, 'Sekolah Kejujuran', '99', 'Amanah, S.Pd', '9999', 'Jl Bahagia', 'Damai', NULL, 'assets/img/logo/logo232.jpg', NULL, NULL, NULL, '2022-05-03 07:50:00', '', '', '08986204405', NULL, NULL, 'assets/img/header/banner573.jpg', 2, '2022', 0);

-- membuang struktur untuk table kelulusan.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `keterangan` int(1) NOT NULL,
  `skl` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `wali` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.siswa: ~25 rows (lebih kurang)
REPLACE INTO `siswa` (`id`, `nama`, `nis`, `nisn`, `kelas`, `jurusan`, `tempat`, `tgl_lahir`, `password`, `keterangan`, `skl`, `status`, `nohp`, `tahun_lulus`, `wali`) VALUES
	('171819001', 'NAMA 1', '171819001', '171819001', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 1', 'TANGGAL 1', 'ps001', 1, 1, 1, '', '2021', ''),
	('171819002', 'NAMA 2', '171819002', '171819002', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 2', 'TANGGAL 2', 'ps002', 1, 1, 1, '', '2021', ''),
	('171819003', 'NAMA 3', '171819003', '171819003', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 3', 'TANGGAL 3', 'ps003', 1, 0, 1, '', '2021', ''),
	('171819004', 'NAMA 4', '171819004', '171819004', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 4', 'TANGGAL 4', 'ps004', 1, 1, 1, '', '2021', ''),
	('171819005', 'NAMA 5', '171819005', '171819005', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 5', 'TANGGAL 5', 'ps005', 1, 1, 1, '', '2021', ''),
	('171819006', 'NAMA 6', '171819006', '171819006', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 6', 'TANGGAL 6', 'ps006', 1, 1, 1, '', '2021', ''),
	('171819007', 'NAMA 7', '171819007', '171819007', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 7', 'TANGGAL 7', 'ps007', 1, 1, 1, '', '2021', ''),
	('171819008', 'NAMA 8', '171819008', '171819008', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 8', 'TANGGAL 8', 'ps008', 1, 1, 1, '', '2021', ''),
	('171819009', 'NAMA 9', '171819009', '171819009', 'XIITKJ', 'Teknik Komputer Jaringan', 'TEMPAT 9', 'TANGGAL 9', 'ps009', 1, 1, 1, '', '2021', ''),
	('171819010', 'NAMA 10', '171819010', '171819010', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 10', 'TANGGAL 10', 'ps010', 1, 1, 1, '', '2021', ''),
	('171819011', 'NAMA 11', '171819011', '171819011', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 11', 'TANGGAL 11', 'ps011', 1, 1, 1, '', '2021', ''),
	('171819012', 'NAMA 12', '171819012', '171819012', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 12', 'TANGGAL 12', 'ps012', 1, 1, 1, '', '2021', ''),
	('171819013', 'NAMA 13', '171819013', '171819013', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 13', 'TANGGAL 13', 'ps013', 1, 1, 1, '', '2021', ''),
	('171819014', 'NAMA 14', '171819014', '171819014', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 14', 'TANGGAL 14', 'ps014', 1, 1, 1, '', '2021', ''),
	('171819015', 'NAMA 15', '171819015', '171819015', 'XIITP', 'Teknik Pemesinan', 'TEMPAT 15', 'TANGGAL 15', 'ps015', 1, 1, 1, '', '2021', ''),
	('171819016', 'NAMA 16', '171819016', '171819016', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 16', 'TANGGAL 16', 'ps016', 1, 1, 1, '', '2021', ''),
	('171819017', 'NAMA 17', '171819017', '171819017', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 17', 'TANGGAL 17', 'ps017', 1, 1, 1, '', '2021', ''),
	('171819018', 'NAMA 18', '171819018', '171819018', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 18', 'TANGGAL 18', 'ps018', 1, 1, 1, '', '2021', ''),
	('171819019', 'NAMA 19', '171819019', '171819019', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 19', 'TANGGAL 19', 'ps019', 1, 1, 1, '', '2021', ''),
	('171819020', 'NAMA 20', '171819020', '171819020', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 20', 'TANGGAL 20', 'ps020', 1, 1, 1, '', '2021', ''),
	('171819021', 'NAMA 21', '171819021', '171819021', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 21', 'TANGGAL 21', 'ps021', 1, 1, 1, '', '2021', ''),
	('171819022', 'NAMA 22', '171819022', '171819022', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 22', 'TANGGAL 22', 'ps022', 1, 1, 1, '', '2021', ''),
	('171819024', 'NAMA 24', '171819024', '171819024', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 24', 'TANGGAL 24', 'ps024', 1, 1, 1, '', '2022', ''),
	('171819025', 'NAMA 25', '171819025', '171819025', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 25', 'TANGGAL 25', 'ps025', 1, 1, 1, '', '2022', ''),
	('171819026', 'NAMA 26', '171819026', '171819026', 'XIITKR', 'Teknik Kendaraan Ringan', 'TEMPAT 26', 'TANGGAL 26', 'ps026', 1, 1, 1, '', '2022', '');

-- membuang struktur untuk table kelulusan.skl
CREATE TABLE IF NOT EXISTS `skl` (
  `id_skl` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `tgl_surat` varchar(50) NOT NULL,
  `header` text NOT NULL,
  `pembuka` text NOT NULL,
  `isi_surat` text NOT NULL,
  `penutup` text NOT NULL,
  `ttd` text NOT NULL,
  `stempel` text NOT NULL,
  `wttd` varchar(50) NOT NULL,
  `wstempel` varchar(50) NOT NULL,
  `sttd` int(1) NOT NULL,
  `sstempel` int(1) NOT NULL,
  `nilai` int(1) NOT NULL,
  `kelompok` int(1) NOT NULL,
  `nilaisiswa` int(1) NOT NULL,
  `foto` int(1) NOT NULL,
  `ttd_qrcode` int(1) NOT NULL,
  `wali` int(1) NOT NULL,
  PRIMARY KEY (`id_skl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.skl: ~1 rows (lebih kurang)
REPLACE INTO `skl` (`id_skl`, `no_surat`, `nama_surat`, `tgl_surat`, `header`, `pembuka`, `isi_surat`, `penutup`, `ttd`, `stempel`, `wttd`, `wstempel`, `sttd`, `sstempel`, `nilai`, `kelompok`, `nilaisiswa`, `foto`, `ttd_qrcode`, `wali`) VALUES
	(1, '001/SMKKKK/KELULUSN/V/2022', 'SURAT KETERANGAN LULUS', '29 Mei 2022', 'assets/img/header/header601.png', '<p>Yang bertanda tangan dibawah ini Kepala SMK DAMAI (NPSN : 12345678) Kabupaten Bandung Provinsi Jawa Barat. Dengan ini menerangkan :</p>', '', '<p>Surat Keterangan ini bersifat sementara dan berlaku sampai ditertibkannya ijazah untuk siswa yang bersangkutan.</p><p>Demikian Surat Keterangan diberikan agar dapat dipergunakan sebagaimana mestinya.</p>', 'assets/img/header/ttdskl377.png', 'assets/img/header/stempel963.jpg', '160', '100', 1, 0, 0, 0, 0, 0, 0, 0);

-- membuang struktur untuk table kelulusan.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kelulusan.user: ~2 rows (lebih kurang)
REPLACE INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`) VALUES
	(4, 'Administrator', 'admin', 'jajatriharja', '$2y$10$VfZJ6Py1JhhEhpXkKwpLZ.EfiT6jXJAx6S.Vrj35gHjOvZ1nDuzA.', 1),
	(5, 'pratamaadismk', 'admin', 'pratamaadismk', '$2y$10$p9AlHJm6vnLd3AHs7P5k8uCwC5YmXcaflE.lXfS4D9CIRTvAjF/r.', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
