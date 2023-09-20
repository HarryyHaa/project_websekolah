<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Sampah</h5>
				<p class="center">Ini adalah halaman daftar sampah, data sampah bisa diaktifkan kembali dan juga dihapus permanen.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m3 s6">
		<div class="icon-menu">
			<a href="<?=site_url('admin/student/archive');?>">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">archive</i>
							</div>
							<div class="col s8 right right-menu">
								<h5><?=strtoupper($this->config->item('student'));?></h5>
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
			<a href="<?=site_url('admin/quiz/quiz_name_archive');?>">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">archive</i>
							</div>
							<div class="col s8 right right-menu">
								<h5>BANK SOAL</h5>
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
			<a href="<?=site_url('admin/classroom/archive');?>">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col s4">
								<i class="material-icons medium">archive</i>
							</div>
							<div class="col s8 right right-menu">
								<h5>KELAS UJIAN</h5>
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

