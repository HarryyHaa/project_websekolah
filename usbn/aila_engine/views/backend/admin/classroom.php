<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Kelas Ujian <a href="<?=site_url('admin/classroom/create');?>" class="btn-small green" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a></h5>
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
				<table class="table responsive-table" id="dataTables">
					<thead>
						<tr>
							<th>Nama Kelas</th>
							<th>Paket Soal</th>
							<th>Kode</th>
							<th>Status</th>
							<th class="center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($classroom as $row) { ?>
							<tr>
								<td><a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>" title="Lihat Detail"><?php echo $row->name;?></a></td>
								<td><a target="_blank" href="<?=site_url('admin/quiz/questions_list/'.encode($row->quiz_name_ID));?>" title="Lihat Detail"><?php echo $row->quiz_name;?></a></td>
								<td><span style="font-family: Sans-serif"><a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>"><?php echo strtoupper($row->code);?></a> <a  onclick="return confirm('Apakah anda yakin ingin menggenerate ulang kode kelas?')"  title="Genrate Ulang" class="btn btn-small btn-floating blue" href="<?=site_url('admin/classroom/regenerate_code/'.encode($row->ID));?>"><i class="material-icons">autorenew</i></a></span></td>
								<td><?php if ($row->working_status == '0') {
									echo "Belum dimulai";
								}elseif ($row->working_status == '1') {
									echo "Berlangsung";
								}else{
									echo "Selesai";
								};?></td>
								<td class="center">
									<?php if ($row->lock == 0) { ?>
										<a  onclick="return confirm('Dengan mengunci kelas ujian, maka tidak akan ada peserta yang bisa bergabung ke kelas ujian ini. Apakah anda yakin?')" href="<?=site_url('admin/classroom/lock/'.$row->code);?>" class="btn-small btn-floating orange" title="Kunci Kelas Ujian"><i class="material-icons">lock_open</i></a>
									<?php } else{ ?>
										<a onclick="return confirm('Dengan membuka kelas ujian, maka peserta bisa bergabung ke kelas ujian ini. Apakah anda yakin?')" href="<?=site_url('admin/classroom/unlock/'.$row->code);?>" class="btn-small btn-floating black" title="Buka Kelas Ujian"><i class="material-icons">lock</i></a>
									<?php } ?>
									<a href="<?=site_url('admin/classroom/update/'.$row->code);?>" class="btn-small btn-floating green" title="Ubah Kelas"><i class="material-icons">edit</i></a> <a onclick="return confirm('Apakah yakin kelas ini mau diarsipkan?')" href="<?=site_url('admin/classroom/make_an_archive/'.$row->code);?>" class="btn-small btn-floating brown" title="Arsipkan Kelas"><i class="material-icons">archive</i></a> <a href="<?=site_url('admin/classroom/check_code/'.$row->code);?>" class="btn-small btn-floating blue" title="Lihat Detail"><i class="material-icons">arrow_forward</i></a></td>
							</tr>
						<?php }?>
					</tbody>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

