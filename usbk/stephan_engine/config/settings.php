<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Setting Identitas Aplikasi

$config['cbt_name'] 	= 'SMK PLUS PRATAMA ADI'; // Nama aplikasi
$config['address'] 	= 'Jl. Tabrik No.8'; // Alamat
$config['village'] 	= 'Banjaran'; // Desa / kelurahan
$config['sub_district'] = 'Banjaran'; // Kecamatan
$config['district'] = 'Kabupaten Bandung'; // Kota / Kabupate
$config['province'] = 'Jawa Barat'; // Propinsi
$config['card_test'] = 'KARTU PESERTA UJIAN';
$config['head_master'] ='Henry Saeful Khadi, ST';
$config['nik_card'] ='-';


// Setting Penamaan

$config['school']	= 'Sekolah'; // Sekolah, Bimbel, Kampus, Yayasan, Lembaga, Dst.
$config['teacher']	= 'Guru'; // Guru, Dosen, Pengajar, Tutor, Instruktur, Dst.
$config['student']	= 'Siswa'; // Siswa, Mahasiswa, Peserta, Pelajar, Dst.
$config['student_code']	= 'NIS/ID/KODE'; // NIS, NIM, NIO, NIY, Kode Peserta, Dst.
$config['teacher_code']	= 'NIP/KODE/ID'; // NIP, NIDN, Kode Pengajar, Dst.


// Setting limit login
// Ubah menjadi true untuk mengaktifkan pembatasan masuk hanya di satu perangkat
$config['limit_login']	= false;