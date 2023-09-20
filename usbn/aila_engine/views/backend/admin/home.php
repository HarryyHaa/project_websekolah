<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=site_url('admin/home');?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb">Dashboard</a>
				</div>
			</div>
		</nav> 
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m3 s6">
		<div class="icon-menu">
			<a href="<?php echo site_url('admin/teacher');?>">
				<div class="card gradient-45deg-light-blue-cyan white-text">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">people</i>
							</div>
							<div class="col s8 right right-menu">
								<span class="number"> <?=$teacher;?></span>
								<br/>
								<span> GURU</span>
							</div>
						</div>
					</div>
					<div class="card-action" style="">
						Selengkapnya
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="col m3 s6">
		<div class="icon-menu">
			<a href="<?php echo site_url('admin/student');?>">
				<div class="card gradient-45deg-red-pink white-text">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">people</i>
							</div>
							<div class="col s8 right right-menu">
								<span class="number"> <?=$student;?></span>
								<br/>
								<span> SISWA</span>
							</div>
						</div>
					</div>
					<div class="card-action" style="">
						Selengkapnya
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="col m3 s6">
		<div class="icon-menu">
			<a href="<?php echo site_url('admin/quiz');?>">
				<div class="card gradient-45deg-amber-amber white-text ">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">folder_open</i>
							</div>
							<div class="col s8 right right-menu">
								<span class="number"> <?=$quiz_name;?></span>
								<br/>
								<span> BANK SOAL</span>
							</div>
						</div>
					</div>
					<div class="card-action" style="">
						Selengkapnya
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="col m3 s6">
		<div class="icon-menu">
			<a href="<?php echo site_url('admin/classroom');?>">
				<div class="card gradient-45deg-green-teal white-text">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">folder_open</i>
							</div>
							<div class="col s8 right right-menu">
								<span class="number"> <?=$classroom;?></span>
								<br/>
								<span> KELAS <span class="hide-on-small-only">UJIAN</span></span>
							</div>
						</div>
					</div>
					<div class="card-action" style="">
						Selengkapnya
					</div>
				</div>
			</a>
		</div>
	</div>
	
</div>
<!-- Start Second Row -->



<div class="row">
	<div class="col m6 s12">
		<div class="card">
			<div class="card-content">
				<h5>Terakhir Masuk</h5>
				<table class="table responsive-table">
					<thead>
						<tr>
							<th>NIS</th>
							<th>Nama Lengkap</th>
							<th>No. HP</th>
							<th>Waktu</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($last_login as $row) { ?>
							<tr>
								<td><?=$row->code;?></td>
								<td><?=$row->name;?></td>
								<td><?=$row->phone_number;?></td>
								<td><?php
								if ($row->last_login != '') {
									echo date('d M Y - H:i', strtotime($row->last_login))." WIB";
								}else{
									echo "-";
								}
								;?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col m6 s12">
		<div class="card">
			<div class="card-content">
				<canvas id="studentReport"></canvas>
			</div>
		</div>
	</div>

</div>