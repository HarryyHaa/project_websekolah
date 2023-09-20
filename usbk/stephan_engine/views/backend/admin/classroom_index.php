<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Kelas Ujian <a href="<?=site_url('admin/classroom/create');?>" class="btn-small green" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a> <a href="#lock_all" class="btn-small orange modal-trigger">Kunci Semua <i class="material-icons right" title="Tambah baru">lock_open</i></a> <a href="#unlock_all" class="btn-small black modal-trigger">Buka Semua <i class="material-icons right" title="Tambah baru">lock</i></a></h5>
				<p># Disini Bapak/Ibu bisa membuat, merubah dan mengarsipkan kelas ujian, kelas ujian ini dibuat supaya satu paket soal bisa digunakan berkali-kali dalam kelas yang berbeda. </p>
				<p># Supaya server tidak berat dan tidak down, masukan <?=$this->config->item('student');?> ke kelas ujian oleh admin atau <?=$this->config->item('teacher');?>, meskipun bisa juga  <?=$this->config->item('student');?> bergabung sendiri ke kelas ujiannya, akan tetapi beresiko membuat sever penuh hingga down apabila proses memasukan kode kelas ujiannya dilakukan oleh <?=$this->config->item('student');?> secara bersamaan.</p></p>
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
				<table class="table responsive-table" id="classroom_list">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Kelas</th>
							<th>Paket Soal</th>
							<th>Status</th>
							<th>Kode</th>
							<th class="center">Aksi</th>
						</tr>
					</thead>
					
					</div>
				</div>
			</div>

		</div>
		<!-- Start Second Row -->

		<div id="lock_all" class="modal">
			<div class="modal-content center">
				<h4>Kunci Semua Kelas </h4>
				<p>Pergunakan menu ini ketika kegiatan ujian hendak dimulai. Dengan mengunci semua kelas, maka tidak ada lagi peserta yang bisa masuk ke kelas ujiannya, sehingga server akan tetap ringan karena tidak terbebani oleh proses bergabung ke kelas ujian.</p>
				<br/>
				<center>
					<a class="btn orange" href="<?=base_url('admin/classroom/lock_all');?>">Kunci Sekarang!</a>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</center>
			</div>
		</div>

		<div id="unlock_all" class="modal">
			<div class="modal-content center">
				<h4>Buka Semua Kelas </h4>
				<p>Sebaiknya pergunakan menu ini ketika tidak ada kegiatan ujian yang berlangsung. Dengan membuka semua kelas, maka peserta bisa bergabung ke kelas ujian.</p>
				<br/>
				<center>
					<a class="btn black" href="<?=base_url('admin/classroom/unlock_all');?>">Buka Sekarang!</a>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</center>
			</div>
		</div>