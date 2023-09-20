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
					<a href="#!" class="breadcrumb">Konfirmasi Penghapusan Kelas/Jurusan</a>
				</div>
			</div>
		</nav> 
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Konfirmasi Penghapusan Kelas/Jurusan</h5>
				<h5 class="center">Nama Kelas/Jurusan : <?=$group->name;?></h5>
				<p class="center card-content  bold lighten-1">Ketika anda menghapus kelas/jurusan ini, maka semua akun siswa beserta seluruh riwayat ujiannya akan ikut terhapus. Apabila anda yakin ingin menghapus semua data tersebut, silahkan konfirasi dengan memasukan password anda dibawah ini:</p>

				<?php if ($this->session->flashdata()) { ?>
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
				<?php };?>

				<form method="post" action="">
					<div class="row">
						<div class="input-field col m4 s12">
						</div>
						<div class="input-field col m4 s12">
							<input type="password" name="password" id="password"  autocomplete="off" required="" value="">
							<label for="#password">Masukan Password</label>
							<span class="red-text"><?=form_error('password');?></span>
						</div>
					</div>
					<div class="row">
						<div class="input-field col m4 s12">
						</div>
						<div class="col m4 s12">
							<button style="width: 100%;" type="submit" class="btn red">Hapus!</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	
</div>
