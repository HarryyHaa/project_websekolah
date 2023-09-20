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
					<a href="#!" class="breadcrumb">Siswa</a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<?php if ($this->session->userdata('student_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Panduan Manajemen Akun Siswa </h5>
					<ul>
						<li>Disini admin bisa menambah, merubah dan mengarsipkan akun siswa.</li>
						<li>Untuk menambah akun siswa baru, cukup dengan memasukan NIS dan nama lengkap, karena passwordnya akan otomatis di genret menjadi <b>12345678</b>.</li>
						<li>Untuk menambahkan siswa secara masal, bisa dengan menggunakan fitur import Siswa.</li>
						<li>Siswa bisa masuk ke aplikasi ini menggunakan NIS dan password default (12345678), begitu Siswa masuk pertama kali maka Siswa diwajibkan untuk mlengkapi profil dan juga merubah passwordnya.</li>
					</ul>
					<p class="center">(<a href="<?php echo site_url('admin/student/student_guide_hide') ;?>">Klik disini untuk menutup panduan</a>)</p>
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
				<?php if ($this->session->flashdata()) 
				{
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}
				};?>

				<?php 
				if (isset($group_name)) {
					echo "<h4 class='center'>Jurusan ".$group_name."</h4><hr/>";
				}
				?>
				<h5>Daftar Akun Siswa 
					<a href="#filter_group" class="btn-small green modal-trigger">Filter <i class="material-icons right" title="Filter Jurusan">filter_list</i></a>

					<a href="#add_student" class="btn-small green modal-trigger">Tambah <i class="material-icons right" title="Tambah baru">add</i></a>

					<a href="#student_import" class="btn-small green modal-trigger">Import <i class="material-icons right" title="Upload Banyak">cloud_upload</i></a> 

					<a href="#student_genret" class="btn-small green modal-trigger">Genret<i class="material-icons right">all_inclusive</i></a>
					<?php if ($this->session->userdata('student_guide') == FALSE) { ?>
						<a href="<?php echo site_url('admin/student/student_guide_show');?>" class="right"><small style="font-size: 15px;">(Tampilkan panduan)</small></a>
					<?php }?>
				</h5>

				<table class=" responsive-table" id="studentTable">
					<thead>
						<tr>
							<th>No.</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Terakhir Masuk</th>
							<th>Aksi</th>
							<th>Password</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

	</div>

</div>
<!-- Start Second Row -->


<!-- Start Moadal Add student-->
<div id="add_student" class="modal">
	<div class="modal-content">
		<h5>Tambah Siswa</h5>
		<?php echo form_open(site_url('admin/student/create'));?>
		<input type="hidden" name="url" value="<?=current_url();?>">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="code" id="code" autocomplete="off" required="">
				<label for="#code">NIS</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="name" id="name" autocomplete="off" required="">
				<label for="#name">Nama Siswa</label>
			</div>
			<div class="input-field col s12">
				<select name="group">
					<option value="" disabled selected>Pilih Jurusan</option>
					<?php foreach ($groups as $gr) {?>
						<option value="<?=$gr->ID;?>"><?=$gr->name;?></option>
					<?php } ?>
				</select>
				<label>Pilih Jurusan</label>
			</div>
			<div class="col s12">
				<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
				<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<!-- End Modal Add student-->

<!-- Start Modal Import Siswa -->
<div id="student_import" class="modal">
	<div class="modal-content">
		<h4>Import Siswa</h4>
		<p>Untuk mengimport data siswa, silahkan gunakan  <a href="<?php echo base_url('aila_cbt/xls_template/template_siswa.xls');?>"> template ini</a></p>
		<hr/>
		<?php echo form_open_multipart(site_url('admin/student/import')) ;?>
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
<!-- End Modal Import Siswa -->



<!-- Start Filter Group -->
<div id="filter_group" class="modal">
	<div class="modal-content">
		<h4>Pilih Jurusan </h4>
		<?php foreach ($groups as $group) {?>
			<a href="<?=site_url('admin/student/index/'.$group->ID);?>">
				<div class="card">
					<div class="card-content center">
						<?=strtoupper($group->name);?>
					</div>
				</div>
			</a>
		<?php }?>
	</div>
</div>
<!-- End Modal Filter Group -->


<!-- Start Modal Genret Siswa -->
<div id="student_genret" class="modal">
	<div class="modal-content">
		<h4>Genret Siswa</h4>
		<p>Disini anda bisa menggenret ratusan akun siswa sekaligus<br/> Untuk mengenret data siswa, silahkan pilih grup/jurusan, kode prefik awal, diikuti jumlah data siswa</p>
		<br/>
		<?php echo form_open_multipart(site_url('admin/student/genret')) ;?>
		<div class="row">
			<div class="input-field col s12">
				<select name="group">
					<option value="" disabled selected>Pilih Jurusan</option>
					<?php foreach ($groups as $gr) {?>
						<option value="<?=$gr->ID;?>"><?=$gr->name;?></option>
					<?php } ?>
				</select>
				<label>Pilih Jurusan</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="code" id="code" autocomplete="off" required="">
				<label for="#code">Kode Prefik </label>
			</div>
			<div class="input-field col s12">
				<input type="number" name="total" id="total" autocomplete="off" required="">
				<label for="#total">Jumlah Data</label>
			</div>
			<div class="col s12">
				<button type="submit" class="waves-effect waves-green btn green">Genret!</button>
				<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
			</div>
		</div>
	</form>
</div>
</div>
<!-- End Modal Genret Siswa -->
