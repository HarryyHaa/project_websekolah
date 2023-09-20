<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5>Profil Admin</h5>
				<p>Isi bagian password jika Anda hendak merubah password dan biarkan kosong ketika Anda hanya merubah nama atau emailnya saja.</p>


				<?php if ($this->session->flashdata()) { ?>
					<br/>
					<?php if ($this->session->flashdata()) { ?>
					<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
					<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
				<?php };?>
					<br/>
				<?php };?>

				<hr/>
				<?php echo form_open();?>
				<div class="row">

					<div class="input-field col m4 s12">
						<input type="text" name="ID" id="ID" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" value="<?php echo $profile->ID;?>" disabled>
						<label for="#ID">ID Admin</label>
					</div>

					<div class="input-field col m4 s12">
						<input type="text" name="name" id="name" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" value="<?php echo $profile->name;?>">
						<label for="#name">Nama Admin</label>
					</div>

					<div class="input-field col m4 s12">
						<input type="text" name="email" id="email" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" value="<?php echo $profile->email;?>">
						<label for="#email">Email</label>
					</div>

					<div class="input-field col m4 s12">
						<input type="password" name="old_password" id="old_password" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" >
						<label for="#old_password">Password Lama</label>
					</div>

					<div class="input-field col m4 s12">
						<input type="password" name="new_password" id="new_password" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" >
						<label for="#new_password">Password Baru</label>
					</div>

					<div class="input-field col m4 s12">
						<input type="password" name="password_confirm" id="password_confirm" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" >
						<label for="#password_confirm">Ulangi Password Baru</label>
					</div>

				</div>

				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Simpan</button>
					</div>	
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">



</div>
<!-- Start Second Row -->

