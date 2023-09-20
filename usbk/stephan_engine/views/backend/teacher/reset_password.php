<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content center">
				<h5>Ganti Password</h5>
				<p>Ganti dulu ya passwordnya bapak/ibu <?php echo $this->session->userdata('name');?>, biar akunnya tetap aman.. ^^<br/>Gunakan password yang susah ditebak dan minimal jumlahnya 8 digit.</p>
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
				<?php echo form_open();?>
				<input type="hidden" name="ID" value="<?php echo $this->session->userdata('ID');?>">
				<div class="row">
					<div class="input-field col m4 s12">
						<input type="password" name="old_password" id="old_password" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" required="">
						<label for="#old_password">Masukan Password Lama</label>
					</div>
					<div class="input-field col m4 s12">
						<input type="password" name="new_password" id="new_password" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" required="">
						<label for="#new_password">Masukan Password Baru</label>
					</div>
					<div class="input-field col m4 s12">
						<input type="password" name="password_confirm" id="password_confirm" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" required="">
						<label for="#password_confirm">Konfirmasi Password Baru (Masukan lagi)</label>
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

