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
					<a href="#!" class="breadcrumb">Profil Sekolah</a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5>Profil Sekolah</h5>
				<!--<p>Untuk merubah profil ini, silahkan edit di file <pre style="color: #920000;">aila_engine/config/seetings.php</pre></p>-->
				<hr/>
				<table class="table">
					<tr>
						<td width="150">Nama Sekolah</td>
						<td width="20">:</td>
						<td><?=strip_tags($this->config->item('cbt_name'));?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?=strip_tags($this->config->item('address'));?></td>
					</tr>
					<tr>
						<td>Desa / Kelurahan</td>
						<td>:</td>
						<td><?=strip_tags($this->config->item('village'));?></td>
					</tr>
					<tr>
						<td>Kecamatan</td>
						<td>:</td>
						<td><?=strip_tags($this->config->item('sub_district'));?></td>
					</tr>
					<tr>
						<td>Kabupaten</td>
						<td>:</td>
						<td><?=strip_tags($this->config->item('district'));?></td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td>:</td>
						<td><?=strip_tags($this->config->item('province'));?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">



</div>
<!-- Start Second Row -->

