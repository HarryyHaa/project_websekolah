<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Arsip Paket Soal Ujian</h5>
				<p>Disini Anda bisa melihat arsip soal dan mengkatifkannya kembali. Fitur hapus belum tersedia karena paket soal ini berkaitan dengan kelas ujian dan jawaban ujian <?=$this->config->item('student');?>.</p>
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
				<table class="table" id="quizNameArchive">
					<thead>
						<tr>
							<th>No.</th>
							<th><?=$this->config->item('teacher');?></th>
							<th>Judul</th>
							<th>PG</th>
							<th>Essai</th>
							<th>Waktu</th>
							<th>Daftar Pertanyaan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- Start Second Row -->

