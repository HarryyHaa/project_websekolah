<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Lengkapi profil dulu ya bapak/ibu <?php echo $this->session->userdata('name');?> ^^</h5>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<?php echo form_open();?>
				<input type="hidden" name="ID" value="<?php echo $this->session->userdata('ID');?>">
				<div class="row">
					<div class="input-field col m6 s12">
						<input type="email" name="email" id="email" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" >
						<label for="#email">Email</label>
					</div>
					<div class="input-field col m6 s12">
						<input type="number" name="phone_number" id="phone_number" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" >
						<label for="#phone_number">Nomor HP</label>
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

