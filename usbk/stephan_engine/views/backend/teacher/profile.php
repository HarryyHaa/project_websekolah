<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Profil bapak/ibu <?php echo $this->session->userdata('name');?> </h5>
				<p>Disini Anda bisa melakukan perubahan terhadap data pribadi anda, untuk memperbaharui password, silahkan <a href="<?=site_url('teacher/home/reset_password');?>"><b>klik disini</b></a>.</p>
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
						<input type="text" name="code" id="code" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right"  value="<?=$profile->code;?>" disabled="">
						<label for="#code"><?=$this->config->item('teacher_code');?> (Tidak bisa diubah)</label>
					</div>
					<div class="input-field col m6 s12">
						<input type="text" name="name" id="name" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right"  value="<?=$profile->name;?>">
						<label for="#name">Nama Lengkap</label>
					</div>
					<div class="input-field col m6 s12">
						<input type="email" name="email" id="email" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right"  value="<?=$profile->email;?>">
						<label for="#email">Email</label>
					</div>
					<div class="input-field col m6 s12">
						<input type="number" name="phone_number" id="phone_number" autocomplete="off"  aria-required="true" data-error="wrong" data-success="right" value="<?=$profile->phone_number;?>">
						<label for="#phone_number">Nomor HP</label>
					</div>
				</div>
				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Simpan</button>
						<a href="<?=site_url('teacher/home/reset_password');?>"  class="btn green">Ubah Password</a>
					</div>	
					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

