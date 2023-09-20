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
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=site_url('admin/home');?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb"><?=$this->config->item('teacher');?></a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<?php if ($this->session->userdata('teacher_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Arsip Akun <?=$this->config->item('teacher');?> </h5>
					<p class="center">Disini Anda bisa mengkatifkan kembali atau menghapus secara permanen akun <?=$this->config->item('teacher');?></p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
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
				<h5>Daftar Arsip Akun <?=$this->config->item('teacher');?> 
				</h5>

				<table class=" responsive-table" id="dataTables">
					<thead>
						<tr>
							<th>No.</th>
							<th><?=$this->config->item('teacher_code');?></th>
							<th>Nama</th>
							<th>Email</th>
							<th>No. HP</th>
							<th>Terakhir Masuk</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no =1; foreach ($teacher as $row) { ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->code;?></td>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->email;?></td>
								<td><?php echo $row->phone_number;?></td>
								<td><?php echo $row->last_login;?></td>
								<td>
									<a onclick="return confirm('Apakah Anda yakin akan mengaktifkan kembali akun <?=$this->config->item('teacher');?> ini ?');" href="<?php echo site_url('admin/teacher/reactivate/'.encode($row->ID));?>" class="btn-small blue modal-trigger">Aktifkan Kembali</a>
									<a onclick="return confirm('Apakah Anda yakin akan menghapus akun <?=$this->config->item('teacher');?> ini secara permanen ?');" href="<?php echo site_url('admin/teacher/permanen_delete/'.encode($row->ID));?>" class="btn-small red">Hapus Permanen</a>
								</td>
								
							</tr>
							<?php $no++; } ;?>
						</tbody>
					</table>
				</div>
			</div>

		</div>

	</div>
	<!-- Start Second Row -->

