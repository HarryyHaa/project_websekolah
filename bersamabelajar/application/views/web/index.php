<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>Web <?= $pengaturan['nama_sekolah'] ?></title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/linericon/style.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/animate-css/animate.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>vendors/popup/magnific-popup.css">
	<!-- main css -->
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>css/style.css">
	<link rel="stylesheet" href="<?= base_url('vendor/') ?>css/responsive.css">
</head>

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
			<div class="container">
				<div class="float-left">
					<ul class="list header_social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
						<li><a href="#"><i class="fa fa-behance"></i></a></li>
					</ul>
				</div>
				<div class="float-right">
					<a class="dn_btn" href="#"><?= $pengaturan['alamat_sekolah'] ?></a>

				</div>
			</div>
		</div>
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="assets/img/<?= $pengaturan['logo'] ?>" width="30" alt=""> <?= $pengaturan['nama_sekolah'] ?></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PROFIL</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="courses.html">Sejarah Singkat</a>
									<li class="nav-item"><a class="nav-link" href="course-details.html">Visi dan Misi</a></li>
									<li class="nav-item"><a class="nav-link" href="course-details.html">Struktur Organisasi</a></li>
									<li class="nav-item"><a class="nav-link" href="course-details.html">Sarana Prasarana</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="courses.html">Courses</a>
									<li class="nav-item"><a class="nav-link" href="course-details.html">Course Details</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

	<!--================Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
			<div class="container">
				<div class="banner_content text-center">
					<h3>Selamat Datang <br />Di Web <?= $pengaturan['nama_sekolah'] ?></h3>
					<p>Handal - Smart - Agamis - Unggul</p>
					<a class="main_btn" href="#">Lihat Profil</a>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Finance Area =================-->
	<!-- 	
	<section class="finance_area">
		<div class="container">
			<div class="finance_inner row">
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-rocket"></i>
							</div>
							<div class="media-body">
								<h5>Science & <br />Engineering</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-earth"></i>
							</div>
							<div class="media-body">
								<h5>Science & <br />Engineering</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-smile"></i>
							</div>
							<div class="media-body">
								<h5>Science & <br />Engineering</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-tag"></i>
							</div>
							<div class="media-body">
								<h5>Science & <br />Engineering</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!--================End Finance Area =================-->

	<!--================Courses Area =================-->
	<section class="courses_area p_120">
		<div class="container">
			<div class="main_title">
				<h2>Program Keahlian</h2>
				<p>Kami fokus membuka program keahlian dibidang teknologi untuk mencetak siswa yang Handal -Smart - Agamis - Unggul.</p>
			</div>
			<div class="row courses_inner">
				<div class="col-lg-12">
					<div class="grid_inner">
						<div class="grid_item wd44">
							<div class="courses_item">
								<img src="<?= base_url('vendor/') ?>img/courses/course-4.jpg" alt="">
								<div class="hover_text">
									<a class="cat" href="#">TP</a>
									<a href="#">
										<h4>Teknik Pemesinan</h4>
									</a>
									<ul class="list">
										<!-- <li><a href="#"><i class="lnr lnr-users"></i> 355</a></li>
										<li><a href="#"><i class="lnr lnr-bubble"></i> 35</a></li>
										<li><a href="#"><i class="lnr lnr-user"></i> T. Robert</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<div class="grid_item wd44">
							<div class="courses_item">
								<img src="<?= base_url('vendor/') ?>img/courses/course-2.jpg" alt="">
								<div class="hover_text">
									<a class="cat" href="#">TKJ</a>
									<a href="#">
										<h4>Teknik Komputer Jaringan</h4>
									</a>
									<ul class="list">
										<!-- <li><a href="#"><i class="lnr lnr-users"></i> 355</a></li>
										<li><a href="#"><i class="lnr lnr-bubble"></i> 35</a></li>
										<li><a href="#"><i class="lnr lnr-user"></i> T. Robert</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<div class="grid_item wd44">
							<div class="courses_item">
								<img src="<?= base_url('vendor/') ?>img/courses/course-4.jpg" alt="">
								<div class="hover_text">
									<a class="cat" href="#">TKRO</a>
									<a href="#">
										<h4>Teknik Kendaraan Ringan Otomotif</h4>
									</a>
									<ul class="list">
										<!-- <li><a href="#"><i class="lnr lnr-users"></i> 355</a></li>
										<li><a href="#"><i class="lnr lnr-bubble"></i> 35</a></li>
										<li><a href="#"><i class="lnr lnr-user"></i> T. Robert</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<!-- <div class="grid_item wd55">
							<div class="courses_item">
								<img src="<?= base_url('vendor/') ?>img/courses/course-5.jpg" alt="">
								<div class="hover_text">
									<a class="cat" href="#">Free</a>
									<a href="#">
										<h4>Japanease Language Class</h4>
									</a>
									<ul class="list">
										<li><a href="#"><i class="lnr lnr-users"></i> 355</a></li>
										<li><a href="#"><i class="lnr lnr-bubble"></i> 35</a></li>
										<li><a href="#"><i class="lnr lnr-user"></i> T. Robert</a></li>
									</ul>
								</div>
							</div>
						</div> -->
					</div>
				</div>
				<!-- <div class="col-lg-3">
					<div class="course_item">
						<img src="<?= base_url('vendor/') ?>img/courses/course-3.jpg" alt="">
						<div class="hover_text">
							<a class="cat" href="#">Free</a>
							<a href="#">
								<h4>Japanease Language Class</h4>
							</a>
							<ul class="list">
								<li><a href="#"><i class="lnr lnr-users"></i> 355</a></li>
								<li><a href="#"><i class="lnr lnr-bubble"></i> 35</a></li>
								<li><a href="#"><i class="lnr lnr-user"></i> T. Robert</a></li>
							</ul>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	<!--================End Courses Area =================-->

	<!--================Team Area =================-->
	<!-- <section class="team_area p_120">
		<div class="container">
			<div class="main_title">
				<h2>Meet Our Faculty</h2>
				<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station.</p>
			</div>
			<div class="row team_inner">
				<div class="col-lg-3 col-sm-6">
					<div class="team_item">
						<div class="team_img">
							<img class="rounded-circle" src="img/team/team-1.jpg" alt="">
							<div class="hover">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team_name">
							<h4>Ethel Davis</h4>
							<p>Managing Director (Sales)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="team_item">
						<div class="team_img">
							<img class="rounded-circle" src="img/team/team-2.jpg" alt="">
							<div class="hover">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team_name">
							<h4>Ethel Davis</h4>
							<p>Managing Director (Sales)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="team_item">
						<div class="team_img">
							<img class="rounded-circle" src="img/team/team-3.jpg" alt="">
							<div class="hover">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team_name">
							<h4>Ethel Davis</h4>
							<p>Managing Director (Sales)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="team_item">
						<div class="team_img">
							<img class="rounded-circle" src="img/team/team-4.jpg" alt="">
							<div class="hover">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="team_name">
							<h4>Ethel Davis</h4>
							<p>Managing Director (Sales)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!--================End Team Area =================-->

	<!--================Testimonials Area =================-->
	<!-- <section class="testimonials_area p_120">
		<div class="container">
			<div class="testi_slider owl-carousel">
				<div class="item">
					<div class="testi_item">
						<img src="img/testimonials/testi-3.png" alt="">
						<h4>Fannie Rowe</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<p>Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.</p>
					</div>
				</div>
				<div class="item">
					<div class="testi_item">
						<img src="img/testimonials/testi-3.png" alt="">
						<h4>Fannie Rowe</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<p>Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.</p>
					</div>
				</div>
				<div class="item">
					<div class="testi_item">
						<img src="img/testimonials/testi-3.png" alt="">
						<h4>Fannie Rowe</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<p>Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.</p>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!--================End Testimonials Area =================-->

	<!--================Pagkages Area =================-->
	<!-- <section class="packages_area p_120">
		<div class="container">
			<div class="row packages_inner">
				<div class="col-lg-4">
					<div class="packages_text">
						<h3>Choose <br />Course Packages</h3>
						<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="packages_item">
						<div class="pack_head">
							<i class="lnr lnr-graduation-hat"></i>
							<h3>Premium</h3>
							<p>For the individuals</p>
						</div>
						<div class="pack_body">
							<ul class="list">
								<li><a href="#">Secure Online Transfer</a></li>
								<li><a href="#">Unlimited Styles for interface</a></li>
								<li><a href="#">Reliable Customer Service</a></li>
							</ul>
						</div>
						<div class="pack_footer">
							<h4>£399.00</h4>
							<a class="main_btn" href="#">Join Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="packages_item">
						<div class="pack_head">
							<i class="lnr lnr-diamond"></i>
							<h3>Exclusive</h3>
							<p>For the individuals</p>
						</div>
						<div class="pack_body">
							<ul class="list">
								<li><a href="#">Secure Online Transfer</a></li>
								<li><a href="#">Unlimited Styles for interface</a></li>
								<li><a href="#">Reliable Customer Service</a></li>
							</ul>
						</div>
						<div class="pack_footer">
							<h4>£399.00</h4>
							<a class="main_btn" href="#">Join Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!--================End Pagkages Area =================-->

	<!--================Latest Blog Area =================-->
	<section class="latest_blog_area p_120">
		<div class="container">
			<div class="main_title">
				<h2>Berita Terbaru</h2>
				<p>Berikut ini adalah berita atau acara-acara yang sudah berlangsung di sekolah</p>
			</div>
			<div class="row latest_blog_inner">
				<div class="col-lg-3 col-md-6">
					<div class="l_blog_item">
						<img class="img-fluid" src="img/latest-blog/l-blog-1.jpg" alt="">
						<a class="date" href="#">25 October, 2018 | By Mark Wiens</a>
						<a href="single-blog.html">
							<h4>Addiction When Gambling Becomes A Problem</h4>
						</a>
						<p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="l_blog_item">
						<img class="img-fluid" src="img/latest-blog/l-blog-2.jpg" alt="">
						<a class="date" href="#">25 October, 2018 | By Mark Wiens</a>
						<a href="single-blog.html">
							<h4>Addiction When Gambling Becomes A Problem</h4>
						</a>
						<p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="l_blog_item">
						<img class="img-fluid" src="img/latest-blog/l-blog-3.jpg" alt="">
						<a class="date" href="#">25 October, 2018 | By Mark Wiens</a>
						<a href="single-blog.html">
							<h4>Addiction When Gambling Becomes A Problem</h4>
						</a>
						<p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="l_blog_item">
						<img class="img-fluid" src="img/latest-blog/l-blog-4.jpg" alt="">
						<a class="date" href="#">25 October, 2018 | By Mark Wiens</a>
						<a href="single-blog.html">
							<h4>Addiction When Gambling Becomes A Problem</h4>
						</a>
						<p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Latest Blog Area =================-->

	<!--================Impress Area =================-->
	<section class="impress_area p_120">
		<div class="container">
			<div class="impress_inner text-center">
				<h2>Penerimaan Peserta Didik Baru</h2>
				<p>Menerima Peserta Didik Baru dan menjadi bagian dari keluarga SMK HS AGUNG</p>
				<a class="main_btn2" href="#">DAFTAR SEKARANG</a>
			</div>
		</div>
	</section>
	<!--================End Impress Area =================-->

	<!--================ start footer Area  =================-->
	<footer class="footer-area p_120">
		<div class="container">
			<div class="row">
				<div class="col-lg-2  col-md-6 col-sm-6">
					<div class="single-footer-widget tp_widgets">
						<h6 class="footer_title">Top Products</h6>
						<ul class="list">
							<li><a href="#">Managed Website</a></li>
							<li><a href="#">Manage Reputation</a></li>
							<li><a href="#">Power Tools</a></li>
							<li><a href="#">Marketing Service</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2  col-md-6 col-sm-6">
					<div class="single-footer-widget tp_widgets">
						<h6 class="footer_title">Quick Links</h6>
						<ul class="list">
							<li><a href="#">Jobs</a></li>
							<li><a href="#">Brand Assets</a></li>
							<li><a href="#">Investor Relations</a></li>
							<li><a href="#">Terms of Service</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2  col-md-6 col-sm-6">
					<div class="single-footer-widget tp_widgets">
						<h6 class="footer_title">Features</h6>
						<ul class="list">
							<li><a href="#">Jobs</a></li>
							<li><a href="#">Brand Assets</a></li>
							<li><a href="#">Investor Relations</a></li>
							<li><a href="#">Terms of Service</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2  col-md-6 col-sm-6">
					<div class="single-footer-widget tp_widgets">
						<h6 class="footer_title">Resources</h6>
						<ul class="list">
							<li><a href="#">Guides</a></li>
							<li><a href="#">Research</a></li>
							<li><a href="#">Experts</a></li>
							<li><a href="#">Agencies</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<aside class="f_widget news_widget">
						<div class="f_title">
							<h3 class="footer_title">Newsletter</h3>
						</div>
						<p>Stay updated with our latest trends</p>
						<div id="mc_embed_signup">
							<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
								<div class="input-group d-flex flex-row">
									<input name="EMAIL" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
									<button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
								</div>
								<div class="mt-10 info"></div>
							</form>
						</div>
					</aside>
				</div>
			</div>
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-8 col-md-8 footer-text m-0">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
				<div class="col-lg-4 col-md-4 footer-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-dribbble"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->






	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?= base_url('vendor/') ?>js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url('vendor/') ?>js/popper.js"></script>
	<script src="<?= base_url('vendor/') ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('vendor/') ?>js/stellar.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/lightbox/simpleLightbox.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/isotope/isotope.pkgd.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/popup/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url('vendor/') ?>js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/counter-up/jquery.waypoints.min.js"></script>
	<script src="<?= base_url('vendor/') ?>vendors/counter-up/jquery.counterup.js"></script>
	<script src="<?= base_url('vendor/') ?>js/mail-script.js"></script>
	<script src="<?= base_url('vendor/') ?>js/theme.js"></script>
</body>

</html>