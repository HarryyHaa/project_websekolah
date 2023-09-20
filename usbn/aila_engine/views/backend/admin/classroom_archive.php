<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Arsip Kelas Ujian
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
				</div>
			</div>
		</div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table" id="dataTables">
					<thead>
						<tr>
							<th>Nama Kelas</th>
							<th>Deskripsi</th>
							<th>Kode</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($classroom as $row) { ?>
							<tr>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->description;?></td>
								<td><span style="font-family: Sans-serif"><a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>"><?php echo strtoupper($row->code);?></a></span></td>
								<td><a onclick="return confirm('Apakah yakin kelas ini akan diaktifkan kembali?')" href="<?=site_url('admin/classroom/re_active/'.$row->code);?>" class="btn-small green" title="Aktifkan Kelas">Aktifkan</a> <a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>" class="btn-small blue" title="Lihat Detail">Detail</a>  <a onclick="return confirm('Apakah yakin kelas ini mau dihapus permanen?')" href="<?=site_url('admin/classroom/delete/'.$row->code);?>" class="btn-small red" title="Arsipkan Kelas">Hapus</a> </td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

