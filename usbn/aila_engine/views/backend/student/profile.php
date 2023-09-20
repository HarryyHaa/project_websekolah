<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Profil  <?php echo $this->session->userdata('name');?> </h5>
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
				<div class="row">
					<div class="col m12 s12">
						<table>
						<tr>
							<td>NIS</td>
							<td>:</td>
							<td><?=$profile->code;?></td>
						</tr>
						<tr>
							<td>Nama Lengkap</td>
							<td>:</td>
							<td><?=$profile->name;?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?=$profile->email;?></td>
						</tr>
						<tr>
							<td>No. HP</td>
							<td>:</td>
							<td><?=$profile->phone_number;?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td><?=($profile->status == 1) ? 'Aktif' : 'Non Aktif';?></td>
						</tr>
						<tr>
							<td>Terakhir Masuk</td>
							<td>:</td>
							<td><?=$profile->last_login;?></td>
						</tr>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

