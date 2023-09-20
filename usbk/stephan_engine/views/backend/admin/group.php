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
					<a href="#!" class="breadcrumb">Kelas / Jurusan</a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Jurusan / Kelompok <a href="#add_group" class="btn-small green modal-trigger" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a></h5>
				<p>Disini Anda bisa membuat, merubah dan mengarsipkan Jurusan.</p>
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
							<th>ID Jurusan</th>
							<th>Nama Jurusan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($groups as $row) { ?>
							<tr>
								<td><?php echo $row->ID;?></td>
								<td><a href="<?php echo site_url('admin/student/index/'.$row->ID);?>"><?php echo $row->name;?></a></td>
								<td>
									<a href="<?php echo site_url('admin/student/index/'.$row->ID);?>" class="btn btn-small green"><?=$this->config->item('student');?></a>

									<a href="#edit_student<?php echo encode($row->ID);?>" class="btn-small blue modal-trigger">Ubah</a>

									<!-- Start Moadal Add student-->
									<div ID="edit_student<?php echo encode($row->ID);?>" class="modal">
										<div class="modal-content">
											<h5>Ubah Jurusan</h5>
											<?php echo form_open(site_url('admin/student/update_group'));?>
											<input type="hIDden" name="ID" value="<?php echo $row->ID;?>">
											<div class="row">
												<div class="input-field col s12">
													<input type="text" name="name" ID="name" autocomplete="off" required=""  value="<?php echo $row->name;?>">
													<label for="#name">Nama <?=$this->config->item('student');?></label>
												</div>
												<div class="col s12">
													<button type="submit" class="waves-effect waves-green btn green">Ubah</button>
													<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
												</div>
											</div>
											<?php echo form_close();?>
										</div>
									</div>
									<!-- End Modal Add student-->

									<a  href="<?=site_url('admin/student/delete_group/'.$row->ID);?>" class="btn-small red" title="Hapus Jurusan">Hapus</a> </td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- Start Second Row -->


	<!-- Start Moadal Add Group-->
	<div ID="add_group" class="modal">
		<div class="modal-content">
			<h5>Tambah Jurusan</h5>
			<?php echo form_open(site_url('admin/student/create_group'));?>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="name" ID="name" autocomplete="off" required="">
					<label for="#name">Nama Jurusan</label>
				</div>
				<div class="col s12">
					<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
	<!-- End Modal Add Group-->