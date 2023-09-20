<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
if ($pg == '') {
    include "home.php";
} elseif ($pg == 'daftar') {
    include "mod_daftar/daftar.php";
} elseif ($pg == 'detail') {
    include "mod_daftar/detail.php";  //Modul Detail Pendaftaran
} elseif ($pg == 'diterima') {
    include "mod_daftar/daftar_diterima.php";  //modul pendaftar diterima
} elseif ($pg == 'ditolak') {
    include "mod_daftar/daftar_ditolak.php";  //modul pendaftar ditolak / cadangan
} elseif ($pg == 'sekolah') {
    cek_login_admin();
    include "mod_sekolah/sekolah.php";
} elseif ($pg == 'jenjang') {
    cek_login_admin();
    include "mod_jenjang/jenjang.php";
} elseif ($pg == 'jurusan') {
    cek_login_admin();
    include "mod_jurusan/jurusan.php";
} elseif ($pg == 'jenis') {
    cek_login_admin();
    include "mod_jenis/jenis.php";
} elseif ($pg == 'biaya') {
    cek_login_admin();
    include "mod_biaya/biaya.php";
} elseif ($pg == 'bayar') {
    include "mod_bayar/bayar.php";
} elseif ($pg == 'pengumuman') {
    include "mod_pengumuman/pengumuman.php";
} elseif ($pg == 'user') {
    cek_login_admin();
    include "mod_user/user.php";
} elseif ($pg == 'setting') {
    cek_login_admin();
    include "mod_setting/setting.php";
} elseif ($pg == 'kontak') {
    cek_login_admin();
    include "mod_kontak/kontak.php";
} elseif ($pg == 'infobayar') {
    cek_login_admin();
    include "mod_web/pembayaran.php";
} elseif ($pg == 'syarat') {
    cek_login_admin();
    include "mod_web/syarat.php";
}
