<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=site_url('admin/home');?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb">Panduan Singkat</a>
				</div>
			</div>
		</nav> 
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<p>Penjelasan menu:</p>
				<p>
					<ol>
						<li><b>Profil Saya</b>, adalah menu tentang profil anda,</li>
						<li><b>Kleas Ujian</b>, adalah daftar kelas yang sudah Anda ikuti / sudah bergabung ,</li>
						<li><b>Gabung Kelas Baru</b>, adalah menu untuk Anda bergabung ke kelas ujian menggunakan kode kelas yang diberikan oleh <?=$this->config->item('teacher');?> / panitia ujian.</li>
					</ol>
				</p>

				<p style="padding-top: 20px;">Untuk bisa mengikuti kegiatan ujian, silahkan ikuti langkah-langkah berikut:</p>
				<p>
					<ol>
						<li>Klik  <b>Keas Ujian</b> untuk melihat daftar kelas ujian,</li>
						<li>Apabila <?=$this->config->item('teacher');?> memberikan kode kelas, klik <b>Gabung Kelas Baru</b> dan masukan kode kelasnya.</li>
						<li>Setelah nama kelas ujiannya tampil, klik tombol <b>Masuk Kelas</b>,</li>
						<li>Apabila sudah bisa dikerjakan, klik tombol <b>Mulai Kerjakan</b>,</li>
						<li>Pergantian soal tidak membutuhkan <i>refresh</i> halaman,</li>
						<li>Apabila sudah dikerjakan semua dan dianggap sudah benar, Anda bisa langsung tutup browser atau tekan tombol hentikan ujian,</li>
						<li>Jawaban disimpan ke server dari setiap nomor yang dikerjakan, jadi tidak perlu khawatir jawaban tidak tersimpan,</li>
						<li>Selesai.</li>
					</ol>
				</p>
			</div>
		</div>
	</div>

	
</div>
