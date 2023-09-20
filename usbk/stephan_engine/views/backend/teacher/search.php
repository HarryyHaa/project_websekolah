<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Akun <?=$this->config->item('student');?></h5>
				<p>Disini Anda berhak menambah atau merubah akun <?=$this->config->item('student');?> jika sewaktu-waktu ketika ujian berlangsung terdapat <?=$this->config->item('student');?> yang belum mempunyai akun atau lupa kata sandi.</p>
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
				<table>
					<thead>
						<tr>
							<th><?=$this->config->item('student_code');?></th>
							<th>Nama</th>
							<th>Password</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($students as $row) { ?>
							<tr>
								<td><?php echo $row->code;?></td>
								<td><?php echo $row->name;?></td>
								<td><a onclick="return confirm('Apakah mau mereset password menjadi 12345678 ?');" href="<?php echo site_url('teacher/student/password_reset/'.encode($row->ID));?>" class="btn-small blue">Reset</a></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

