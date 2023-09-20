<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Kelas Ujian Tersedia</h5>
				<p class="center">Halaman ini menampilkan daftar kelas ujian yang tersedia untuk anda, yaitu kelas ujian yang disetting khusus untuk kelas/jurusan anda.</p>
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
				<table class="table" id="dataTables">
					<thead>
						<tr>
							<th class="hide-on-med-and-down">No.</th>
							<th>Nama Kelas</th>
							<th class="hide-on-med-and-down">Deskripsi</th>
							<th>Kode</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($classroom as $row) { ?>
							<tr>
								<td class="hide-on-med-and-down"><?=$no;?></td>
								<td><?php echo $row->name;?></td>
								<td class="hide-on-med-and-down"><?php echo $row->description;?></td>
								<td><?php echo $row->code;?></td>
								<td><a href="<?=site_url('student/classroom/join_available/'.$row->code);?>" class="btn-small blue">Masuk Kelas</a></td>
							</tr>
						<?php $no++; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

