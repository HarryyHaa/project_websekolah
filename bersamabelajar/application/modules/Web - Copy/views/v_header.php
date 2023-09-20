<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> E-Learning Candy </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/web/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/slicknav.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/gijgo.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/slick.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/web/css/style.css">
</head>

<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url() ?>assets/web/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <!-- Left Social -->
                    <div class="header-left-social">
                        <ul class="header-social">
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><a href="https://cbtcandy.com" style="color: blue;">E-Learning Candy</a></li>
                                        <!-- <li>0896</li> -->
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul>
                                        <li><a href="<?= base_url('Login') ?>"><i class="ti-user"></i>Login</a></li>
                                        <!-- <li><a href="#"><i class="ti-lock"></i>Register</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <!-- Logo -->
                    <div class="logo d-none d-lg-block">
                        <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/') . $setting['header'] ?>" alt="" style="width: 120px;"></a>
                    </div>
                    <div class="container">
                        <div class="menu-wrapper">
                            <!-- Logo -->
                            <div class="logo logo2 d-block d-lg-none">
                                <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/') . $setting['header'] ?>" style="width: 100px;"></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="<?= base_url() ?>"><i class="fas fa-home"></i> Home</a></li>
                                        <li><a href="<?= base_url('Web/siswa') ?>">Siswa</a></li>
                                        <li><a href="<?= base_url('Web/guru') ?>">Guru</a></li>
                                        <li><a href="<?= base_url('Web/materi') ?>">Materi</a></li>
                                        <li><a href="<?= base_url('Web/pengumuman') ?>">Pengumuman</a></li>
                                        <!-- <li><a href="<?= base_url('Web/video') ?>">Tentang Sekolahku</a></li> -->
                                        <!-- <li><a href="blog.html">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                                <li><a href="elements.html">Element</a></li>
                                            </ul>
                                        </li> -->
                                        <!-- <li><a href="http://smkhsagung.sch.id" target="_blank">Web Sekolah</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header-btn -->
                            <div class="header-search d-none d-lg-block">
                                <form action="#" class="form-box f-right ">
                                    <input type="text" name="Search" placeholder="Search Courses">
                                    <div class="search-icon">
                                        <i class="fas fa-search special-tag"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>