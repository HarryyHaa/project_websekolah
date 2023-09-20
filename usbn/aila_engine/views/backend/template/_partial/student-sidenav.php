<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start Sidenav -->
	<ul class="sidenav sidenav-fixed" id="slide-out">
		<li><a class="waces-effect" href="<?php echo site_url('student/home');?>">Beranda <i class="material-icons left">home</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('student/home/profile');?>">Profil Saya<i class="material-icons left">person</i> </a></li>
		<li class="white">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header dropdown-sidenav waves-effect waves-blue"><i class="material-icons">folder_open</i>Kelas Ujian <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a class="waces-effect" href="<?php echo site_url('student/classroom/available');?>">Tersedia	 <i class="material-icons left">folder_open</i> </a></li>
						<li><a class="waces-effect" href="<?php echo site_url('student/classroom');?>">Kelas Saya	 <i class="material-icons left">folder_open</i> </a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
		<li><a class="waces-effect" href="<?php echo site_url('student/home/logout');?>">Keluar <i class="material-icons left">exit_to_app</i> </a></li>
	</ul>
	<!-- End Sidenav -->