/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `bayar` (
  `id_bayar` varchar(20) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_daftar` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `keterangan` int(10) DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL,
  `verifikasi` int(1) NOT NULL DEFAULT 0,
  `hapus` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `bayar` DISABLE KEYS */;
INSERT INTO `bayar` (`id_bayar`, `id_user`, `id_daftar`, `jumlah`, `tgl_bayar`, `keterangan`, `bukti`, `verifikasi`, `hapus`) VALUES
	('202004100001', 0, 1, 500000, '2020-04-10', NULL, 'bukti_transaksi/bukti_202004100001.png', 0, NULL),
	('202004100002', 0, 1, 600000, '2020-04-10', NULL, 'bukti_transaksi/bukti_202004100002.png', 0, NULL),
	('202004110001', 0, 346, 500000, '2020-04-11', NULL, 'bukti_transaksi/bukti_202004110001.jpg', 1, NULL),
	('202004110002', 5, 1, 200000, '2020-04-18', NULL, NULL, 0, NULL),
	('202004110003', 0, 347, 500000, '2020-04-11', NULL, 'bukti_transaksi/bukti_202004110003.jpg', 1, NULL),
	('202004120001', 5, 10, 2000000, '2020-04-12', NULL, NULL, 1, NULL),
	('202004120002', 18, 7, 400000, '2020-04-12', NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `bayar` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `biaya` (
  `id_biaya` varchar(50) NOT NULL,
  `nama_biaya` varchar(200) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id_biaya`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `biaya` DISABLE KEYS */;
INSERT INTO `biaya` (`id_biaya`, `nama_biaya`, `jumlah`, `status`) VALUES
	('LAINLAIN', 'LAIN LAIN', 500000, '1'),
	('SERAGAM', 'SERAGAM', 450000, '1'),
	('SPP', 'SPP', 500000, '1');
/*!40000 ALTER TABLE `biaya` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `daftar` (
  `id_daftar` int(11) NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(20) DEFAULT NULL,
  `jenis` int(1) DEFAULT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `no_kk` varchar(30) DEFAULT NULL,
  `nisn` varchar(30) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `jenkel` varchar(1) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `asal_sekolah` varchar(128) DEFAULT NULL,
  `npsn_asal` varchar(20) DEFAULT NULL,
  `kelas` varchar(11) DEFAULT NULL,
  `jurusan` varchar(11) DEFAULT '',
  `jenjang` varchar(11) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `desa` varchar(128) DEFAULT NULL,
  `kecamatan` varchar(128) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `provinsi` varchar(128) DEFAULT NULL,
  `kode_pos` varchar(6) DEFAULT NULL,
  `transportasi` varchar(128) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `anak_ke` int(2) DEFAULT NULL,
  `saudara` int(11) DEFAULT NULL,
  `tinggi` int(3) DEFAULT NULL,
  `berat` int(3) DEFAULT NULL,
  `status_keluarga` varchar(50) DEFAULT NULL,
  `tinggal` varchar(128) DEFAULT NULL,
  `jarak` varchar(128) DEFAULT NULL,
  `waktu` varchar(128) DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `nama_ayah` varchar(128) DEFAULT NULL,
  `tempat_ayah` varchar(128) DEFAULT NULL,
  `tgl_lahir_ayah` date DEFAULT NULL,
  `status_ayah` varchar(128) DEFAULT NULL,
  `pendidikan_ayah` varchar(128) DEFAULT NULL,
  `pekerjaan_ayah` varchar(128) DEFAULT NULL,
  `penghasilan_ayah` varchar(128) DEFAULT NULL,
  `no_hp_ayah` varchar(16) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `nama_ibu` varchar(128) DEFAULT NULL,
  `tempat_ibu` varchar(128) DEFAULT NULL,
  `tgl_lahir_ibu` date DEFAULT NULL,
  `status_ibu` varchar(128) DEFAULT NULL,
  `pendidikan_ibu` varchar(128) DEFAULT NULL,
  `pekerjaan_ibu` varchar(128) DEFAULT NULL,
  `penghasilan_ibu` varchar(128) DEFAULT NULL,
  `no_hp_ibu` varchar(16) DEFAULT NULL,
  `nik_wali` varchar(16) DEFAULT NULL,
  `nama_wali` varchar(128) DEFAULT NULL,
  `tempat_wali` varchar(128) DEFAULT NULL,
  `tgl_lahir_wali` date DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `no_hp_wali` varchar(16) DEFAULT NULL,
  `no_ijazah` varchar(128) DEFAULT NULL,
  `no_shun` varchar(128) DEFAULT NULL,
  `no_ujian` varchar(128) DEFAULT NULL,
  `no_kip` varchar(30) DEFAULT NULL,
  `file_kip` varchar(256) DEFAULT NULL,
  `file_kk` varchar(256) DEFAULT NULL,
  `file_ijazah` varchar(256) DEFAULT NULL,
  `file_akte` varchar(256) DEFAULT NULL,
  `file_shun` varchar(256) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `alasan_keluar` varchar(100) DEFAULT NULL,
  `surat_keluar` varchar(255) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `aktif` int(1) DEFAULT 0,
  `status` int(1) DEFAULT 0,
  `petugas_daftar` varchar(10) DEFAULT NULL,
  `petugas_konfirmasi` varchar(10) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `tgl_konfirmasi` date DEFAULT NULL,
  `baju` varchar(10) DEFAULT NULL,
  `bayar` varchar(100) DEFAULT NULL,
  `online` int(1) DEFAULT 0,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id_daftar`),
  UNIQUE KEY `no_daftar` (`no_daftar`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `daftar` DISABLE KEYS */;
INSERT INTO `daftar` (`id_daftar`, `no_daftar`, `jenis`, `nis`, `nik`, `no_kk`, `nisn`, `nama`, `foto`, `jenkel`, `tempat_lahir`, `tgl_lahir`, `asal_sekolah`, `npsn_asal`, `kelas`, `jurusan`, `jenjang`, `agama`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `transportasi`, `no_hp`, `email`, `anak_ke`, `saudara`, `tinggi`, `berat`, `status_keluarga`, `tinggal`, `jarak`, `waktu`, `nik_ayah`, `nama_ayah`, `tempat_ayah`, `tgl_lahir_ayah`, `status_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `no_hp_ayah`, `nik_ibu`, `nama_ibu`, `tempat_ibu`, `tgl_lahir_ibu`, `status_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `no_hp_ibu`, `nik_wali`, `nama_wali`, `tempat_wali`, `tgl_lahir_wali`, `pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `no_hp_wali`, `no_ijazah`, `no_shun`, `no_ujian`, `no_kip`, `file_kip`, `file_kk`, `file_ijazah`, `file_akte`, `file_shun`, `tgl_keluar`, `alasan_keluar`, `surat_keluar`, `level`, `aktif`, `status`, `petugas_daftar`, `petugas_konfirmasi`, `tgl_daftar`, `tgl_konfirmasi`, `baju`, `bayar`, `online`, `password`) VALUES
	(1, '001', NULL, '', '1111111111111111', '121212', '121212', 'Yogi Alviansyach\'a', 'default.png', 'L', 'BEKASI', '2020-04-07', 'MTS AL-WATHONIYAH 55', ' 20279305', '', 'belum', 'SMK', 'Islam', 'Kp. Kepuh', '002', '002', 'Karang bahagia', 'Karang bahagia', 'Bekasi', 'Jawa barat', '41314', 'Angkutan Umum', '0831161069391111', '', 1, 1, 2, 3, 'Anak Kandung', 'Bersama Orang Tua', '5', '30', '1231313', 'ayah', 'bekasi', '2020-04-16', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1 jt s/d Rp 2jt', '', '1111111', 'ibu', 'bekasi', '2020-04-10', '', 'SD Sederajat', 'Petani', 'Rp. 2jt s/d Rp. 4 jt', '', '88989898', 'wali', 'bbnbnbn', '2020-04-17', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 5 jt s/d Rp. 20 jt', '', '', '', '', '123', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, 'M', '', 1, '0'),
	(2, '002', NULL, '', '', '', '', 'Suwandi', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '088291355512', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, '', '', 0, '0'),
	(3, '003', NULL, '', '', '', '', 'Adam Suhaimi', 'default.png', 'L', '', NULL, 'SMP NEGERI 1 KARANG BAHAGIA', '20252899', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '08985349105', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, '', '', 0, '0'),
	(4, '004', NULL, '', '', '', '', 'Bambang Bayu Saputra', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '089513760418', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, '', '', 0, '0'),
	(5, '005', NULL, '', '1111111', '11111111111111', '121212', 'Yogi Alviansyach', 'default.png', 'L', 'Yogi Alviansyach', '2020-04-10', 'MTS AL-WATHONIYAH 55', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '083116106939', '', 1, 2, 3, 40, 'Anak Kandung', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, '', '', 0, '0'),
	(6, '006', NULL, '', '3216101809050002', '', '0054255635', 'Sigit Sugianto', 'default.png', 'L', 'Bekasi', '2005-09-18', 'MTS AS-SIRAAJ', '20279306', '', 'TP', 'SMK', '0', 'Kp.pelaukan', '', '', 'Karang rahayu', 'Karang bahagia', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', 'Lisma lasari', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-13', NULL, 'L', '', 0, '0'),
	(7, '007', NULL, '', '', '', '', 'Ahmad Salim', 'default.png', 'L', '', NULL, 'SMP NEGERI 1 KARANG BAHAGIA', '20252899', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '089514687549', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(8, '008', NULL, '', '3216101907050001', '', '-', 'Nur Rahmat Hidayat', 'default.png', 'L', 'bekasi', '2020-02-14', 'SMP NEGERI 1 KARANG BAHAGIA', '20252899', '', 'TKR', 'SMK', '0', 'karang setia', '', '', 'karang setia', 'karang bahagia', '', '', '', '', '085719311477', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', 'diroh', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 1, '', '', '2020-02-14', NULL, 'L', '', 0, '0'),
	(9, '009', NULL, '', '3216140804072482', '', '0053819333', 'Muhammad Jamil', 'default.png', 'L', 'Bekasi', '2005-10-15', 'MTSN 3 BEKASI', '20279336', '', 'TKR', 'SMK', '0', 'Kp. Keranding', '', '', 'Sukajadi', 'Sukakarya', '', '', '', '', '0895333122505', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', 'Janah', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 1, '', '', '2020-02-14', NULL, 'XL', '', 0, '0'),
	(10, '010', NULL, '', '', '', '', 'Dinda', 'default.png', 'P', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'TKJ', 'SMK', '0', '', '', '', '', '', '', '', '', '', '089689474700', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(11, '011', NULL, '', '', '', '', 'Abdul Muhammad Sopian', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '089635317048', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(12, '012', NULL, '', '', '', '', 'Angga Wijaya', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(13, '013', NULL, '', '', '', '', 'Rayhan Herdiyawan', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '085779419529', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(14, '014', NULL, '', '', '', '', 'Ismail', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0895406046688', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(15, '015', NULL, '', '', '', '', 'Debby Crisdian Rahayu', 'default.png', 'P', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'TKJ', 'SMK', '0', '', '', '', '', '', '', '', '', '', '085882252809', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(16, '016', NULL, '', '', '', '', 'Anisa Salsabila', 'default.png', 'P', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'TKJ', 'SMK', '0', '', '', '', '', '', '', '', '', '', '081299805976', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(17, '017', NULL, '', '', '', '', 'Bintang Wijayah', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(19, '018', NULL, '', '', '', '', 'Dwi Salsabila Khairani', 'default.png', 'P', '', NULL, 'MTSN 3 BEKASI', '20279336', '', 'TKJ', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-14', NULL, '', '', 0, '0'),
	(21, '020', NULL, '', '', '', '', 'Haikal', 'default.png', 'L', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(22, '021', NULL, '', '', '', '', 'Lisa Nur Milati', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0895402900770', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(23, '022', NULL, '', '', '', '', 'Ahmad Fauzi', 'default.png', 'L', '', NULL, 'MTS AS-SIRAAJ', '20279306', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '089513681943', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(24, '023', NULL, '', '3216101504040006', '', '0046132591', 'Aldi Irwansyah', 'default.png', 'L', 'Bekasi', '2005-04-05', 'SMP NEGERI 1 KARANG BAHAGIA', '20252899', '', 'TKR', 'SMK', '0', 'Kp.pule', '', '', 'Karang setia ', 'Karang bahagia', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', 'Nopiyanti', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 1, '', '', '2020-02-15', NULL, 'XL', '', 0, '0'),
	(25, '024', NULL, '', '', '', '', 'Novita Rahman', 'default.png', 'P', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(26, '025', NULL, '', '3216225205040003', '', '0047556637', 'Andin Hidayat', 'default.png', 'L', 'bekasi', '2005-01-30', 'MTSN 2 BEKASI', ' 20279304', '', 'TKR', 'SMK', '0', 'Kp. Pulo Besar', '', '', 'Karang Satu', 'karang bahagia', '', '', '', '', '081222924340', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', 'sarnah', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 1, '', '', '2020-02-15', NULL, 'L', '', 0, '0'),
	(27, '026', NULL, '', '', '', '', 'Niko Hermawan', 'default.png', 'L', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(28, '027', NULL, '', '', '', '', 'Iren Saputra', 'default.png', 'L', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(29, '028', NULL, '', '', '', '', 'Imam Sutiawan', 'default.png', 'L', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0895330157872', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(30, '029', NULL, '', '', '', '', 'Elsa Fitriya', 'default.png', 'P', '', NULL, 'MTSN 2 BEKASI', ' 20279304', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '0895802236788', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(31, '030', NULL, '', '', '', '', 'Dewi Lestari', 'default.png', 'P', '', NULL, 'SMP NEGERI 1 KARANG BAHAGIA', '20252899', '', 'belum', 'SMK', '0', '', '', '', '', '', '', '', '', '', '08978489511', '', 0, 0, 0, 0, '0', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL, '0000-00-00', '0', '0', NULL, '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 0, 0, '', '', '2020-02-15', NULL, '', '', 0, '0'),
	(324, NULL, NULL, NULL, NULL, NULL, '11111155', 'Pajar Sidik', 'default.png', NULL, NULL, NULL, 'SMK HS AGUNG', '20238548', NULL, 'TKJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0898 6204 405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0'),
	(326, 'PPDB2020001', 1, NULL, NULL, NULL, '767676', 'Agagagag', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89898989', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '123456'),
	(330, 'PPDB2020002', 1, NULL, NULL, NULL, '5678568', 'Pajar Sidik', 'default.png', NULL, 'Bekasi', '2020-04-09', 'SMK 2', '1235', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08986204405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'bekasi'),
	(331, 'PPDB2020003', 1, NULL, NULL, NULL, '5678568', 'Pajar Sidik', 'default.png', NULL, 'Bekasi', '2020-04-09', 'SMK 2', '1235', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08986204405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'bekasi'),
	(332, 'PPDB2020004', 1, NULL, NULL, NULL, '1234', 'Pajar Sidik', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08986204405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1234'),
	(333, 'PPDB2020005', 1, NULL, NULL, NULL, '12345', 'Pajar', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08989787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1234'),
	(334, 'PPDB2020006', 1, NULL, NULL, NULL, '6676767', 'Pajar', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8989898', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1234'),
	(335, 'PPDB2020007', 1, NULL, NULL, NULL, '12348789', 'Adadad', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89898989', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '12345'),
	(336, 'PPDB2020008', 1, NULL, NULL, NULL, '1781728718', '89898989', 'default.png', NULL, '8989898', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '898989', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '787878'),
	(337, 'PPDB2020009', 1, NULL, NULL, NULL, '34134134', 'Nanda Aditya', 'default.png', NULL, 'Bekasi', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1234'),
	(338, 'PPDB2020010', 1, NULL, NULL, NULL, '121212', '21212', 'default.png', NULL, '21212', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '12121'),
	(339, 'PPDB2020011', 1, NULL, NULL, NULL, '898989', 'Pajar Sidik', 'default.png', NULL, 'BEKASI', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '089898998', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '123456'),
	(340, 'PPDB2020012', 1, NULL, NULL, NULL, '1235', '1234', 'default.png', NULL, '1234', '2020-04-09', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1234'),
	(341, 'PPDB2020013', 1, NULL, NULL, NULL, '123456', 'Admin Candy', 'default.png', NULL, 'BEKASI', '2020-04-07', 'SMK 2', '1235', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08986204405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '123456'),
	(342, 'PPDB2020014', 1, NULL, NULL, NULL, '12345678', 'Pajar Sidik', 'default.png', NULL, 'BEKASI', '2020-04-15', 'SMK 1', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08986204405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '123456'),
	(343, 'PPDB2020015', 1, NULL, '123', '111', '88888', 'ANDRE', 'default.png', 'L', 'BEKASI', '2020-04-11', 'SMK 1', '1234', NULL, 'TKR', NULL, 'Islam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0898989', NULL, 1, 1, 1, 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 1, '123456'),
	(344, 'PPDB2020016', 1, NULL, NULL, NULL, '1234131', '121212', 'default.png', NULL, '', '2020-04-11', 'SMK 1', '1234', NULL, 'TKJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
	(345, 'PPDB2020017', 1, NULL, '3216101612000004', '1111', '12121212', 'Yusuf', 'default.png', 'L', 'BEKASI', '2020-04-13', 'SMK 1', '1234', NULL, 'TKJ', NULL, 'Islam', 'KP. KOBAK LOMPONG', '1', '2', 'KARANG SENTOSA', 'KARANG BAHAGIA', 'BEKASI', 'JAWA BARAT', '17520', 'Jalan Kaki', '0898989898', NULL, 1, 2, 3, 4, '5', 'Bersama Orang Tua', '12', '15', '12121212', 'ASEP', 'BEKASI', '2020-04-15', NULL, 'SD Sederajat', 'Karyawan Swasta', 'Rp. 500.000 s/d Rp. 999.000', '898989', '898989898', 'NNN', 'BKSI', '2020-04-11', NULL, 'SD Sederajat', 'Karyawan Swasta', 'Rp. 1 jt s/d Rp 2jt', '099090', '90907897', 'NMNMNM', 'NMNMNM', '2020-04-20', 'SMP Sederajat', 'Tenaga Kerja Indonesia', 'Rp. 1 jt s/d Rp 2jt', '7878787', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'XL', NULL, 1, '12345'),
	(346, 'PPDB2020018', 1, NULL, '3175072605020013', '1111', '123456789', 'Pajar Sidik', 'default.png', 'L', 'BEKASI', '2020-04-14', 'SMK 2', '1235', NULL, 'TKJ', NULL, 'Islam', 'KP. KOBAK LOMPONG', '001', '002', 'KARANG SENTOSA', 'KARANG BAHAGIA', 'BEKASI', 'JAWA BARAT', '17520', 'Jalan Kaki', '08986204405', NULL, 2, 3, 160, 60, 'ANAK KANDUNG', 'Bersama Orang Tua', '60', '48', '1111111', 'ASEP', 'BEKASI', '2020-04-11', NULL, 'SD Sederajat', 'Buruh', 'Rp. 500.000 s/d Rp. 999.000', '', '1111111', 'NNN', 'BKSI', '2020-04-11', NULL, 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '2020-04-11', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'XL', NULL, 1, '123456'),
	(347, 'PPDB2020019', 1, NULL, '3175072605020013', '1111', '112211', 'Pajar Sidik', 'default.png', 'L', 'BEKASI', '2020-04-15', 'SMK 2', '1235', NULL, 'TKJ', NULL, 'Islam', 'KP. KOBAK LOMPONG', '1', '2', 'KARANG SENTOSA', 'KARANG BAHAGIA', 'BEKASI', 'JAWA BARAT', '17520', 'Jalan Kaki', '08986204405', NULL, 1, 2, 3, 4, '5', 'Bersama Orang Tua', '12', '12', '121212', 'ASEP', 'BEKASI', '2020-04-16', NULL, 'SD Sederajat', 'Buruh', 'Rp. 2jt s/d Rp. 4 jt', '111111', '11111111', 'NNN', 'BEKASI', '2020-04-14', NULL, 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '555555', '211212', 'NMNMNM', 'NMNMNM', '2020-04-21', 'SD Sederajat', 'Wirausaha', 'Rp. 500.000 s/d Rp. 999.000', '4324234234', NULL, NULL, NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'XL', NULL, 1, '123456');
/*!40000 ALTER TABLE `daftar` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `histori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permohonan` varchar(30) NOT NULL,
  `nik` int(30) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `histori` DISABLE KEYS */;
INSERT INTO `histori` (`id`, `id_permohonan`, `nik`, `status`, `tanggal`, `keterangan`) VALUES
	(1, '201907070001', 123, 1, '2019-07-07 22:57:31', 'Silahkan datang ke desa/kelurahan setempat untuk pengumpulan berkas persyaratan permohonan  dan konfirmasi'),
	(2, '201907070001', 0, 2, '2019-07-08 05:26:33', 'pemberkasan sedang kami proses silahkan untuk menunggu'),
	(4, '202004040001', 12, 1, '2020-04-05 01:25:29', 'Silahkan datang ke desa/kelurahan setempat untuk pengumpulan berkas persyaratan permohonan  dan konfirmasi'),
	(5, '202004040002', 12, 1, '2020-04-05 01:25:55', 'Permohonan sudah berhasil masuk, mohon untuk menunggu proses pengecekan data');
/*!40000 ALTER TABLE `histori` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` varchar(50) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `status`) VALUES
	('PD', 'Pindahan', 1),
	('SB', 'Siswa Baru', 1);
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `jenjang` (
  `id_jenjang` varchar(5) NOT NULL,
  `nama_jenjang` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_jenjang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `jenjang` DISABLE KEYS */;
INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`, `status`) VALUES
	('SMK', 'SMK', 1),
	('SMP', 'SMP', 1);
/*!40000 ALTER TABLE `jenjang` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` varchar(50) NOT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `kuota` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `jurusan` DISABLE KEYS */;
INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `kuota`, `status`) VALUES
	('TKJ', 'Teknik Komputer Jaringan', 108, 1),
	('TKR', 'Teknik Otomotif', 108, 1),
	('TP', 'Teknik Pemesinan', 108, 1);
/*!40000 ALTER TABLE `jurusan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `kontak` (
  `id_kontak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kontak` varchar(50) DEFAULT NULL,
  `no_kontak` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `kontak` DISABLE KEYS */;
INSERT INTO `kontak` (`id_kontak`, `nama_kontak`, `no_kontak`, `status`) VALUES
	(1, 'Roy Kurniawan', '081210654096', 1),
	(2, 'Tugiman', '081282656407', 1);
/*!40000 ALTER TABLE `kontak` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text DEFAULT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jenis` int(1) DEFAULT 0,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `pengumuman` DISABLE KEYS */;
INSERT INTO `pengumuman` (`id_pengumuman`, `id_user`, `judul`, `pengumuman`, `tgl`, `jenis`) VALUES
	(2, 5, 'INFORMASI DAFTAR ULANG', '<p>Kepada Calon Siswa Siswi SMK HS AGUNG yang sudah mendaftar silahkan untuk melakukan <b>DAFTAR ULANG</b> Ke Sekolah dengan membawa persyaratan Formulir Pendaftaran dan membayar <b>Biaya Pendaftaran</b>.Â </p>', '2020-04-09 15:10:52', 2);
/*!40000 ALTER TABLE `pengumuman` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `sekolah` (
  `npsn` varchar(16) NOT NULL,
  `nama_sekolah` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`npsn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `sekolah` DISABLE KEYS */;
INSERT INTO `sekolah` (`npsn`, `nama_sekolah`, `alamat`, `status`) VALUES
	('1234', 'SMK 1', 'ALAMAT 1', 1),
	('1235', 'SMK 2', 'ALAMAT 2', 1),
	('1236', 'SMK 3', 'ALAMAT 3', 1),
	('1237', 'SMK 4', 'ALAMAT 4', 1),
	('1238', 'SMK 5', 'ALAMAT 5', 1),
	('1239', 'SMK 6', 'ALAMAT 6', 1),
	('1240', 'SMK 7', 'ALAMAT 7', 1),
	('1241', 'SMK 8', 'ALAMAT 8', 1),
	('1242', 'SMK 9', 'ALAMAT 9', 1),
	('1243', 'SMK 10', 'ALAMAT 10', 1);
/*!40000 ALTER TABLE `sekolah` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `setting` (
  `id_setting` int(1) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `npsn` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `klikchat` text DEFAULT NULL,
  `livechat` text DEFAULT NULL,
  `nolivechat` varchar(50) DEFAULT NULL,
  `infobayar` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id_setting`, `nama_sekolah`, `npsn`, `alamat`, `kota`, `provinsi`, `logo`, `favicon`, `email`, `no_telp`, `klikchat`, `livechat`, `nolivechat`, `infobayar`, `syarat`) VALUES
	(1, 'SMK HS AGUNG', '69787351', 'Kp. Pulo Bambu Desa Karang Bahagia Kec Karang Bahagia', 'Bekasi', 'Jawa Barat', 'assets/img/logo/logo2.png', NULL, NULL, NULL, 'Assalamualaikum+selamat+siang', 'Assalamualaikum%2C+mohon+info+pendaftaran', '08986204405', '<p>Silahkan melakukan proses pembayaran melalui No Rekening dibawah ini :</p><p>0000000000000</p><p>A/N SMK HS AGUNG</p><p>BANK NASIONAL INDONESIA</p><p>Setelah melakukan proses pembayaran harap konfirmasikan pembayaran di menu tambah pembayaran.</p><p>setelah itu akan dilakukan pengechekan oleh Panitia PPDB SMK HS AGUNG.</p>', '<p>SYARAT PENDAFTARAN</p>');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`) VALUES
	(4, 'SMK HS AGUNG', 'admin', 'smk', '$2y$10$xKPLPqNPcOSzxuRo2aOHuemIKMi58b/xTLBVkC6jT5BezVOYLk3qS', 1),
	(5, 'Administrator', 'admin', 'admin', '$2y$10$j5STRMVkhno25h93TJGDUupdr4L7CDEQQZCOwyFyqFO5QfCteP3H.', 1),
	(6, 'Ujang Admin', 'kepala', 'ujang', '$2y$10$O6R3PXNT7Ue.HVz8K9qV4OHU2JmulT8vf0zdJaDPLuU1CuO2H3d6W', 1),
	(17, 'Vitria AF Alatas', 'bendahara', 'vitria', '$2y$10$zknt/OPv3hlBkcuIwq5XWutVNcEChfOgNWiaUsRyn0CDajWdkmcj2', 1),
	(18, 'PAJAR SIDIK', 'operator', 'pajar', '$2y$10$HmaSqcVkUkBhVvrcxgOxDetV0RLoOK2wF5AcZFeUAJfMt.cd9DcCO', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
