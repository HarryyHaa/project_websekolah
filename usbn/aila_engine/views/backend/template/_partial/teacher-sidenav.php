<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start Sidenav -->
	<ul class="sidenav sidenav-fixed" id="slide-out">
		<li><a class="waces-effect" href="<?php echo site_url('teacher/home');?>">Beranda <i class="material-icons left">home</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('teacher/home/profile');?>">Profil <i class="material-icons left">person</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('teacher/student');?>">Siswa <i class="material-icons left">people</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('teacher/quiz');?>">Paket Soal <i class="material-icons left">folder_open</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('teacher/classroom');?>">Kelas Ujian	 <i class="material-icons left">folder_open</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('teacher/home/logout');?>">Keluar <i class="material-icons left">exit_to_app</i> </a></li>
	</ul>
	<!-- End Sidenav -->