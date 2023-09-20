<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start Sidenav -->
<ul class="sidenav sidenav-fixed side-nav" id="slide-out">
	<li class="sidenav-header blue hide-on-med-and-up">
		<div class="row avatar">
			<div class="col s4">
				<img src="<?=base_url('aila_cbt/images/logo.png');?>" width="55px" height="55px" alt="" class="circle responsive-img valign profile-image">
			</div>
			<div class="col s8">
				<a class="btn-flat dropdown-button waves-effect waves-light white-text" href="#" data-activates="profile-dropdown"><?=$this->session->userdata['name'];?><i class="mdi-navigation-arrow-drop-down right"></i></a>
			</div>
		</div>
	</li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/home');?>">Dashboard <i class="material-icons left">dashboard</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/home/guide');?>">Alur Aplikasi<i class="material-icons left">book</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/student/group');?>">Kelas / Jurusan<i class="material-icons left">folder_open</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/teacher');?>">Guru <i class="material-icons left">people</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/student');?>">Siswa <i class="material-icons left">people</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/quiz');?>">Bank Soal <i class="material-icons left">folder_open</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/classroom');?>">Kelas Ujian<i class="material-icons left">folder_open</i> </a></li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/home/school_profile');?>">Profil Sekolah <i class="material-icons left">school</i> </a></li>
	<li class="white">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header dropdown-sidenav waves-effect waves-blue"><i class="material-icons">archive</i>Arsip <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a class="waves-effect waves-blue" href="<?php echo site_url('admin/student/archive');?>"><i class="material-icons">people</i>Siswa</a></li>
						<li><a class="waves-effect waves-blue" href="<?php echo site_url('admin/teacher/archive');?>"><i class="material-icons">people</i>Guru</a></li>
						<li><a class="waves-effect waves-blue" href="<?php echo site_url('admin/quiz/quiz_name_archive');?>"><i class="material-icons">folder_open</i>Bank Soal</a></li>
						<li><a class="waves-effect waves-blue" href="<?php echo site_url('admin/classroom/archive');?>"><i class="material-icons">folder_open</i>Kelas Ujian</a></li>
						<li><div class="divider"></div></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/print_card');?>">Cetak Kartu <i class="material-icons left">print</i> </a></li>
	<li class="white">
	<li class='white'><a class="waces-effect" href="<?php echo site_url('admin/home/logout');?>">Keluar <i class="material-icons left">exit_to_app</i> </a></li>
	
</ul>
	<!-- End Sidenav -->