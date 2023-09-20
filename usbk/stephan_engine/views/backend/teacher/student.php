<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Akun <?=$this->config->item('student');?></h5>
				<p>Disini Anda berhak menambah atau merubah kata sandi <?=$this->config->item('student');?> jika sewaktu-waktu ketika ujian berlangsung terdapat <?=$this->config->item('student');?> yang lupa kata sandi.</p>
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
				<h5 class="center">Cari <?=$this->config->item('student');?></h5>
				<?php echo form_open('teacher/student/search');?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="name" id="name" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right">
						<label for="#name">Nama <?=$this->config->item('student');?></label>
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

