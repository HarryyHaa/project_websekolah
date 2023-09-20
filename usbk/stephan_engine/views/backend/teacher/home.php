<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Welcome Back <?php echo $this->session->userdata('name');?>!</h5>
				<p>Disini bapak/ibu bisa mengakses berbagai maca fitur seperti manajemen soal ujian, manajemen kelas ujian, rekap data ujian, dan lain sebagainya.</p>
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


	<div class="col m3 s6">
		<a href="<?php echo site_url('teacher/home/profile');?>">
			<div class="card-panel center">
				<i class="material-icons medium">person</i>
				<p>Profil Saya</p>
			</div>
		</a>
	</div>

	<div class="col m3 s6">
		<a href="<?php echo site_url('teacher/student');?>">
			<div class="card-panel center">
				<i class="material-icons medium">people</i>
				<p>Data <?=$this->config->item('student');?></p>
			</div>
		</a>
	</div>

	<div class="col m3 s6">
		<a href="<?php echo site_url('teacher/quiz');?>">
			<div class="card-panel center">
				<i class="material-icons medium">folder_open</i>
				<p>Paket Soal</p>
			</div>
		</a>
	</div>

	<div class="col m3 s6">
		<a href="<?php echo site_url('teacher/classroom');?>">
			<div class="card-panel center">
				<i class="material-icons medium">folder_open</i>
				<p>Kelas Ujian</p>
			</div>
		</a>
	</div>


</div>
<!-- Start Second Row -->

<div class="row">
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
								<td class="hide-on-med-and-down"><?php echo $no++;?></td>
								<td><?php echo $row->name;?></td>
								<td class="hide-on-med-and-down"><?php echo $row->description;?></td>
								<td><span style="font-family: Sans-serif"><a href="<?=site_url('teacher/classroom/check_code/'.$row->code);?>"><?php echo $row->code;?></a></span></td>
								<td><a href="<?=site_url('teacher/classroom/update/'.$row->code);?>" class="btn-small btn-floating green" title="Ubah Kelas"><i class="material-icons">edit</i></a> <a onclick="return confirm('Apakah yakin kelas ini mau diarsipkan?')" href="<?=site_url('teacher/classroom/make_an_archive/'.$row->code);?>" class="btn-small btn-floating brown" title="Arsipkan Kelas"><i class="material-icons">archive</i></a> <a href="<?=site_url('teacher/classroom/check_code/'.$row->code);?>" class="btn-small btn-floating blue" title="Lihat Detail"><i class="material-icons">arrow_forward</i></a></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>