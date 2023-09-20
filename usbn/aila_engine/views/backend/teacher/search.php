<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Akun Siswa</h5>
				<p>Disini anda berhak menambah atau merubah akun siswa jika sewaktu-waktu ketika ujian berlangsung terdapat siswa yang belum mempunyai akun atau lupa kata sandi.</p>
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
							<th>NIS</th>
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

