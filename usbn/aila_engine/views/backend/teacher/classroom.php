<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Kelas Ujian <a href="<?=site_url('teacher/classroom/create');?>" class="btn-small green" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a></h5>
				<p>Disini anda bisa membuat, merubah dan mengarsipkan kelas ujian, kelas ujian ini dibuat supaya satu paket soal bisa digunakan berkali-kali dalam kelas yang berbeda.</p>
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
							<th class="hide-on-med-and-down">Deskripsi</th>
							<th>Kode</th>
							<th class="hide-on-med-and-down">Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($classroom as $row) { ?>
							<tr>
								<td><?php echo $row->name;?></td>
								<td class="hide-on-med-and-down"><?php echo $row->description;?></td>
								<td><span style="font-family: Sans-serif"><a href="<?=site_url('teacher/classroom/check_code/'.$row->code);?>"><?php echo strtoupper($row->code);?></a> <a  onclick="return confirm('Apakah anda yakin ingin menggenerate ulang kode kelas?')"  title="Genrate Ulang" class="btn btn-small btn-floating blue" href="<?=site_url('teacher/classroom/regenerate_code/'.encode($row->ID));?>"><i class="material-icons">autorenew</i></a></span></td>
								<td class="hide-on-med-and-down"><?php if ($row->working_status == '0') {
									echo "Belum dimulai";
								}elseif ($row->working_status == '1') {
									echo "Berlangsung";
								}else{
									echo "Selesai";
								};?></td>
								<td><a href="<?=site_url('teacher/classroom/update/'.$row->code);?>" class="btn-small btn-floating green" title="Ubah Kelas"><i class="material-icons">edit</i></a> <a onclick="return confirm('Apakah yakin kelas ini mau diarsipkan?')" href="<?=site_url('teacher/classroom/make_an_archive/'.$row->code);?>" class="btn-small btn-floating brown" title="Arsipkan Kelas"><i class="material-icons">archive</i></a> <a href="<?=site_url('teacher/classroom/check_code/'.$row->code);?>" class="btn-small btn-floating blue" title="Lihat Detail"><i class="material-icons">arrow_forward</i></a></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

