<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	.card-content ul li{
		list-style: disc !important;
		margin-left: 20px;
	}
</style>
<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Arsip Akun <?=$this->config->item('student');?> </h5>
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
				<?php if ($this->session->flashdata()) 
				{
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}
				};?>

				<?php 
				if (isset($group_name)) {
					echo "<h4 class='center'>Jurusan ".$group_name."</h4><hr/>";
				}
				?>
				
				<table class=" responsive-table">
					<thead>
						<tr>
							<th>No.</th>
							<th><?=$this->config->item('student_code');?></th>
							<th>Nama</th>
							<th>Terakhir Masuk</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach ($students as $row) {
							?>
							<tr>
								<td><?=$no;?></td>
								<td><?=$row->code;?></td>
								<td><?=$row->name;?></td>
								<td><?=$row->last_login;?></td>
								<td>
									<a onclick="return confirm('Apakah Anda yakin ingin mengaktifkan kembali akun <?=$row->name;?> ?');" href="<?=site_url('admin/student/reactivate/'.encode($row->ID));?>" class="btn btn-small green">Aktifkan Kembali</a>
									<a onclick="return confirm('Apakah Anda yakin ingin menghapus permanen akun <?=$row->name;?> ?');" href="<?=site_url('admin/student/permanen_delete/'.encode($row->ID));?>" class="btn btn-small red">Hapus Permanen</a>
								</td>
							</tr>
							<?php 
							$no++; 
						}?>
					</tbody>
				</table>
			</div>
		</div>

	</div>

</div>
<!-- Start Second Row -->
