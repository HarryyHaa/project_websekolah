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
					<a href="#!" class="breadcrumb">Alur Aplikasi</a>
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
				<p>Untuk bisa menjalankan kegiatan ujian online, silahkan ikuti langkah-langkah berikut:</p>
				<p>
					<ol>
						<li>Buat <b>Jurusan</b>, jurusan ini bisa diisi dengan nama jurusan sekolah seperti <b>XI IPA A, XII IPA B, XI IPS A, IX RPL B, XII TKJC</b> dll.</li>
						<li>Buat <b>Akun <?=$this->config->item('teacher');?></b> untuk materi yang akan di ujikan,</li>
						<li>Buat <b><?=$this->config->item('student');?></b>, bisa dengan input manua, import dari excel, atau genret masal,</li>
						<li>Buat <b>Bank Soal</b>, bank soal ini berupa nama paket soal ujian,</li>
						<li>Setelah membuat bank soal / paket soal, lalu buat <b>daftar pertanyaan</b>, bisa diinput manual bisa juga diimport dari excel untuk soal text nya,</li>
						<li>Buat <b>kelas ujian</b>, bisa dijadwalkan sehingga lebih mudah,</li>
						<li><b>Masukan <?=$this->config->item('student');?>	</b> yang diinginkan kedalam kelas ujian, bisa langsung puluhan dan bisa per jurusan,</li>
						<li>Berikan <b>akun</b> (<?=$this->config->item('student_code');?> dan Password) kepada <?=$this->config->item('student');?>,</li>
						<li><?=$this->config->item('student');?> login ke sistem lalu mengikuti kegiatan ujian</li>
						<li><?=$this->config->item('student');?> mengikuti kegiatan <b>ujian</b> dengan hasilnya bisa dipantau langsung oleh admin dan juga <?=$this->config->item('teacher');?>,</li>
						<li><b>Cetak</b> atau <b>eksport</b> laporan nilai dari kegiatan ujian,</li>
						<li>Selesai.</li>
					</ol>
				</p>
			</div>
		</div>
	</div>

	
</div>
