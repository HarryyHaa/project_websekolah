<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Akun Siswa</h5>
				<p>Disini anda berhak menambah atau merubah kata sandi siswa jika sewaktu-waktu ketika ujian berlangsung terdapat siswa yang lupa kata sandi.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">
	<?php if ($this->session->flashdata()) { ?>
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
				</div>
			</div>
		</div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Cari Siswa</h5>
				<?php echo form_open('teacher/student/search');?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="name" id="name" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right">
						<label for="#name">Nama Siswa</label>
					</div>
				</div>
				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Cari</button>
					</div>	
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>


</div>
<!-- Start Second Row -->

