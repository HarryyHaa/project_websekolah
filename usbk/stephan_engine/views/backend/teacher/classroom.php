<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Kelas Ujian <a href="<?=site_url('teacher/classroom/create');?>" class="btn-small green" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a></h5>
				<p># Disini Bapak/Ibu bisa membuat, merubah dan mengarsipkan kelas ujian, kelas ujian ini dibuat supaya satu paket soal bisa digunakan berkali-kali dalam kelas yang berbeda. </p>
				<p># <?=$this->config->item('student');?> bisa bergabung ke kelas ujiannya menggunakan kode kelas, tetapi sebaiknya supaya hemat penggunaan server dan server tidak down ketika banyak <?=$this->config->item('student');?> yang measukan kode kelasnya secara bersama-sama, maka <?=$this->config->item('student');?> bisa dimasukan kedalam kelas ujiannya oleh admin ataupun juga <?=$this->config->item('teacher');?>.</p></p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table" id="classroom_list">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Kelas</th>
							<th class="hide-on-med-and-down">Deskripsi</th>
							<th>Kode</th>
							<th class="hide-on-med-and-down">Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

