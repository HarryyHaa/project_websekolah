<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start Header -->
	<header>
		
		<div class="navbar-fixed">
			<nav class="gradient-45deg-purple-deep-orange" role="navigation">
				<div class="nav-wrapper">
					<a href="#" data-target="slide-out" class="sidenav-trigger"> <i class="material-icons">menu</i> </a>
					<a href="<?php echo site_url('admin/home');?>" class="brand-logo">ADMIN</a>
					<ul class="right hide-on-med-and-down">
						<li>
							<a class="right dropdown-button" href="<?php echo site_url('admin/home/logout');?>" title="Keluar"> <i class="material-icons">exit_to_app</i> </a>
							<a class="right dropdown-button" href="<?php echo site_url('admin/home/admin_profile');?>" title="My Account"> <i class="material-icons">account_circle</i> </a>
						</li>
					</ul>
				</div>
			</nav>
		</div>

	</header>
	<!-- End Header -->