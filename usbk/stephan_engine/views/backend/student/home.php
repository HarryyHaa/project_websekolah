<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Welcome Back <?php echo $this->session->userdata('name');?>!</h5>
				<p>Disini Anda bisa bergabung dengan kelas ujian, mengerjakan soal-soal ujian dan langsung mengetahui hasil dari pengerjaan ujian begitu waktu ujian berakhir.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m4 s6">
		<a href="<?=site_url('student/home/profile');?>">
			<div class="card-panel center hoverable">
				<i class="material-icons medium">person</i>
				<p>Profil Saya</p>
			</div>
		</a>
	</div>

	<div class="col m4 s6">
		<a href="<?=site_url('student/classroom/available');?>">
			<div class="card-panel center hoverable">
				<i class="material-icons medium">folder_special</i>
				<p>Kelas Ujian</p>
			</div>
		</a>
	</div>

	<!-- <div class="col m3 s6">
		<a href="<?=site_url('student/classroom');?>">
			<div class="card-panel center hoverable">
				<i class="material-icons medium">folder_open</i>
				<p>Kelas Diikuti</p>
			</div>
		</a>
	</div> -->
	
	<div class="col m4 s6">
		<a href="#join_classroom" class="modal-trigger">
			<div class="card-panel center hoverable">
				<i class="material-icons medium">add</i>
				<p>Gabung Kelas <span class="hide-on-med-and-down">Baru</span> </p>
			</div>
		</a>
	</div>

</div>
<!-- Start Second Row -->

<div class="row">
	
		<div class="col m12 s12">
		<div class="card hoverable">
			<div class="card-content">
				<h5>Kelas Ujian</h5>
				<table class="table" id="dataTables">
					<thead>
						<tr>
							<th class="hide-on-med-and-down">No.</th>
							<th>Kode</th>
							<th>Nama Kelas</th>
							<th>Masuk</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($joined_classroom as $joined) { ?>
							<tr>
								<td class="hide-on-med-and-down"><?=$no;?></td>
								<td><?php echo $joined->code;?></td>
								<td><?php echo $joined->name;?></td>
								<td><a href="<?=site_url('student/classroom/detail/'.$joined->code);?>" class="btn-small blue btn-floating"><i class="material-icons">arrow_forward</i></a></td>
							</tr>
							<?php $no++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>


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