<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Kelas Ujian <a href="#join_classroom" class="btn-small green modal-trigger" title="Gabung Kelas"><i class="material-icons left">add</i>Gabung Kelas</a></h5>
				<p>Disini Anda bisa bergabung kedalam kelas ujian yang kode kelasnya sudah diberikan oleh <?=$this->config->item('teacher');?>.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


	<!-- Start Moadal Join Class Exam-->
	<div id="join_classroom" class="modal">
		<div class="modal-content center">
			<h5>Gabung Kelas Ujian</h5>
			<?php echo form_open(site_url('student/classroom/join'));?>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="code" id="code" autocomplete="off" required="">
					<label for="#code"> Masukan Kode Kelas</label>
				</div>
				<div class="col s12">
					<button type="submit" class="waves-effect waves-green btn green">Gabung</button>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
<!-- End Modal Moadal Join Class Exam-->

<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table" id="dataTables">
					<thead>
						<tr>
							<th class="hide-on-med-and-down">No.</th>
							<th>Nama Kelas</th>
							<th class="hide-on-med-and-down">Deskripsi</th>
							<th >Kode</th>
							<th class="hide-on-med-and-down">Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($classroom as $row) { ?>
							<tr>
								<td class="hide-on-med-and-down"><?=$no;?></td>
								<td><?php echo $row->name;?></td>
								<td class="hide-on-med-and-down"><?php echo $row->description;?></td>
								<td><?php echo $row->code;?></td>
								<td class="hide-on-med-and-down"><?php
									if ($row->scheduled == 1) {
										echo "Dijadwalkan ".$row->date_start.' - '.$row->time_start;
									}else{
										if ($row->working_status == '0') {
											echo "Belum dimulai";
										}elseif ($row->working_status == '1') {
											echo "Berlangsung";
										}else{
											echo "Selesai";
										}
									};
									?></td>
								<td><a href="<?=site_url('student/classroom/detail/'.$row->code);?>" class="btn-small blue">Masuk Kelas</a></td>
							</tr>
						<?php $no++; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

