<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<div class="row center">

					<h5>Masukan <?=$this->config->item('student');?></h5>
					<p>Masukan <?=$this->config->item('student');?> ke kelas ujian <b><?=$classroom->name;?></b> supaya server tidak down ketika terlalu banyak <?=$this->config->item('student');?> yang bergabung ke kelas ujian secara serentak</p>
					

					<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
		<p class="bold green white-text"><?=$this->session->flashdata('info');?></p>
	<?php };?>

					
				</div>
				
			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<form method="post" action="">
				<h5>Pilih <?=$this->config->item('student');?> <?=(($group_name != NULL) ? $group_name : '');?> &nbsp; <a href="#filter_group" class="btn-small green modal-trigger">Filter <i class="material-icons right" title="Filter Jurusan">filter_list</i></a> <button onclick="return confirm('Apakah Anda yakin akan memasukan <?=$this->config->item('student');?> tersebut ke kelas ujian? Proses ini akan membutuhkan waktu beberapa saat sesuai dengan jumlah <?=$this->config->item('student');?> yang dipilih')" type='submit' class="btn blue">Proses</button> 
						<a class="btn green" href="<?=site_url('teacher/classroom/check_code/'.$classroom->code);?>">Kembali</a></h5>
					<table class="table">
						<thead>
							<tr>
								<th><label><input type="checkbox" id="select-all" name="select-all" /><span></span></label></th>
								<th>No.</th>
								<th><?=$this->config->item('student_code');?></th>
								<th>Nama</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($students as $row) { ?>
								<tr>
									<td><label><input type="checkbox" value="<?=$row->ID;?>" name="student[<?=$row->ID;?>]"/><span></span></label></td>
									<td><?=$no;?></td>
									<td><?=$row->code;?></td>
									<td><?=$row->name;?></td>
								</tr>
								<?php $no++; } ?>
							</tbody>
						</table>
						<br/>
						<button onclick="return confirm('Apakah Anda yakin akan memasukan <?=$this->config->item('student');?> tersebut ke kelas ujian? Proses ini akan membutuhkan waktu beberapa saat sesuai dengan jumlah <?=$this->config->item('student');?> yang dipilih')" type='submit' class="btn blue">Proses</button> 
						<a class="btn green" href="<?=site_url('teacher/classroom/check_code/'.$classroom->code);?>">Kembali</a>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Start Filter Group -->
<div id="filter_group" class="modal">
	<div class="modal-content">
		<h4>Pilih Jurusan </h4>
			<a href="<?=site_url('teacher/classroom/un_filter_group/'.encode($classroom->ID));?>">
				<div class="card">
					<div class="card-content center">
						SEMUA <?=strtoupper($this->config->item('student'));?>
					</div>
				</div>
			</a>
		<?php foreach ($groups as $group) {?>
			<a href="<?=site_url('teacher/classroom/filter_group/'.$group->ID.'/'.encode($classroom->ID));?>">
				<div class="card">
					<div class="card-content center">
						<?=strtoupper($group->name);?>
					</div>
				</div>
			</a>
		<?php }?>
	</div>
</div>
<!-- End Modal Filter Group -->