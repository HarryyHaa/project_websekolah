<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Detail <?=$this->config->item('student');?></h5>
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
				<?php 
				echo form_open();
				echo form_hidden('ID', $student->ID);
				?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="code" id="code"  autocomplete="off" required="" value="<?=$student->code;?>">
						<label for="#code"><?=$this->config->item('student_code');?></label>
						<span class="red-text"><?=form_error('code');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="name" id="name"  autocomplete="off" required="" value="<?=$student->name;?>">
						<label for="#name">Nama <?=$this->config->item('student');?></label>
						<span class="red-text"><?=form_error('name');?></span>
					</div>
				</div>


				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Simpan</button>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

