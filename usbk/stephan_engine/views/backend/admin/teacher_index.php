<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	.card-content ul li{
		list-style: disc !important;
		margin-left: 20px;
	}
</style>
<!-- Start First Row -->

<div class="row">
	<div class="col m12 s12">
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=site_url('admin/home');?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb"><?=$this->config->item('teacher');?></a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<?php if ($this->session->userdata('teacher_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Panduan Manajemen Akun <?=$this->config->item('teacher');?> </h5>
					<ul>
						<li>Disini admin bisa menambah, merubah dan mengarsipkan akun <?=$this->config->item('teacher');?>.</li>
						<li>Untuk menambah akun <?=$this->config->item('teacher');?> baru, cukup dengan memasukan <?=$this->config->item('teacher_code');?> dan nama lengkap, karena passwordnya akan otomatis di genret menjadi <b>12345678</b>.</li>
						<li><?=$this->config->item('teacher');?> bisa masuk ke aplikasi ini menggunakan <?=$this->config->item('teacher_code');?> dan password default (12345678), begitu <?=$this->config->item('teacher');?> masuk pertama kali maka <?=$this->config->item('teacher');?> diwajibkan untuk mlengkapi profil dan juga merubah passwordnya.</li>
					</ul>
					<p class="center">(<a href="<?php echo site_url('admin/teacher/teacher_guide_hide') ;?>">Klik disini untuk menutup panduan</a>)</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				
				<?php if ($this->session->flashdata()) { ?>
					<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
					<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
				<?php };?>
				
				<h5>Daftar Akun <?=$this->config->item('teacher');?> <a href="#add_teacher" class="btn-small green modal-trigger"><i class="material-icons" title="Tambah baru">add</i></a> 
					<a href="#techer_import" class="btn-small green modal-trigger"><i class="material-icons" title="Upload Banyak">add</i><i class="material-icons" title="Upload Banyak">add</i></a> 
					<?php if ($this->session->userdata('teacher_guide') == FALSE) { ?>
						<a href="<?php echo site_url('admin/teacher/teacher_guide_show');?>" class="right"><small style="font-size: 15px;">(Tampilkan panduan)</small></a>
					<?php }?>
				</h5>

				<table class=" responsive-table" id="teacherTable">
					<thead>
						<tr>
							<th>No.</th>
							<th><?=$this->config->item('teacher_code');?></th>
							<th>Nama</th>
							<th>Email</th>
							<th>No. HP</th>
							<th>Terakhir Masuk</th>
							<th>Aksi</th>
							<th>Password</th>
						</tr>
					</thead>
					
					</table>
				</div>
			</div>

		</div>

	</div>
	<!-- Start Second Row -->


	<!-- Start Moadal Add teacher-->
	<div id="add_teacher" class="modal">
		<div class="modal-content">
			<h5>Tambah <?=$this->config->item('teacher');?></h5>
			<?php echo form_open(site_url('admin/teacher/create'));?>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="code" id="code" autocomplete="off" required="">
					<label for="#code"><?=$this->config->item('teacher_code');?></label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="name" id="name" autocomplete="off" required="">
					<label for="#name">Nama <?=$this->config->item('teacher');?></label>
				</div>
				<div class="col s12">
					<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
	<!-- End Modal Add teacher-->

	<!-- Start Modal Import Mahasiswa -->
	<div id="techer_import" class="modal">
		<div class="modal-content">
			<h4>Import <?=$this->config->item('teacher');?></h4>
			<p>Untuk mengimport data <?=$this->config->item('teacher');?>, silahkan gunakan  <a href="<?php echo base_url('stephan_cbt/xls_template/template_guru.xls');?>"> template ini</a></p>
			<hr/>
			<?php echo form_open_multipart(site_url('admin/teacher/import')) ;?>
			<div class="row">
				<div class="input-field col s10">
					<div class="file-field input-field">
						<div class="btn">
							<span>File</span>
							<input type="file" name="file" class="green">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Pilih photo profil anda">
						</div>
					</div>
				</div>
				<div class="col s2">
					<button type="submit" class="waves-effect waves-green btn green" style="margin-top: 25px;">Import</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- End Modal Import Mahasiswa -->