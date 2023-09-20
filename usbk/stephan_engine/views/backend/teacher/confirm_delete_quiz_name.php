<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content center">
				<h5>Konfirmasi Hapus Permanen Paket Soal</h5>
				<p>Sebelum menghapus permanen paket soal, Anda harus menghapus permanen terlebih dahulu kelas ujian yang menggunakan paket soal ini.</p>
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
				<table class="table">
					<thead>
						<tr>
							<th>Nama Kelas</th>
							<th>Deskripsi</th>
							<th>Kode</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($classroom->result() as $row) { ?>
							<tr>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->description;?></td>
								<td><span style="font-family: Sans-serif"><a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>"><?php echo strtoupper($row->code);?></a></span></td>
								<td> <a onclick="return confirm('Apakah yakin kelas ini mau dihapus permanen?')" href="<?=site_url('teacher/classroom/delete_archive/'.$row->code.'/'.encode($quiz_name->ID));?>" class="btn-small red" title="Arsipkan Kelas">Hapus Permanen</a></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

