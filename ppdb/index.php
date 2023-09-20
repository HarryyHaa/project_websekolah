<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $setting['nama_sekolah'] ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="assets/modules/animate/animate.css">
    <link rel="stylesheet" href="assets/modules/bootstrap-icons/bootstrap-icons.css">
    
    <!-- CSS DATATABLE -->
    <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/img/spinner-primary.svg') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .9;
        }
    </style>
</head>

<body class="layout-3">
    <div class='loader'></div>
    <div class="chating" style=" z-index: 99999; width: 50px; padding: 15px;  bottom: 0; position: fixed; ">
       
       <!-- <a href="https://api.whatsapp.com/send?phone=+62<?= $setting['nolivechat'] ?>&text=<?= $setting['livechat'] ?>">-->

         <a href="https://api.whatsapp.com/send?phone=<?= $setting['nolivechat'] ?>&text=<?= $setting['livechat'] ?>">

           <img src="assets/img/wa.png" width="150"> </a>
    </div>
    <div id="app">
        <div class="main-wrapper container">
           <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="." class="navbar-brand sidfebar-gone-hide d-none d-sm-block">
                    <img src="<?= $setting['logo'] ?>" width="50"> <?= $setting['nama_sekolah'] ?>
                </a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="contact-info d-flex align-items-center">
                        <i class="bi bi-envelope d-flex align-items-center nav-link">smkpluspratamadi@smkpluspratamadi.sch.id</i>

                        <i class="bi bi-phone d-flex align-items-center ms-4 nav-link"><span>+62 22 5945961</span></i>
                        <i class="bi bi-phone d-flex align-items-center ms-4 nav-link"><span>+62 822-1839-7431</span></i>
                        
                    </div>

                </div>
                <form class="form-inline ml-auto">
                    <ul class="navbar-nav">

                    </ul>

                </form>
                <!--<ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Silakan Login</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="#" data-id="login" class=" klikmenu dropdown-item has-icon ">
                                <i class="fas fa-sign-out-alt"></i> Ayo Masuk
                            </a>
                        </div>
                    </li>
                </ul>-->
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link klikmenu" data-id="beranda"><i class="fas fa-home"></i><span>Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link klikmenu " data-id="pendaftaran"><i class="fas fa-heart"></i><span>Daftar Sekarang</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link klikmenu" data-id="daftarEDITDULU"><i class="fas fa-user-friends"></i><span>Data Sudah Daftar</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link klikmenu" data-id="pengumuman"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-clone"></i><span>Multiple Dropdown</span></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                                <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                        <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                    </span>

            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>MENERIMA TITIPAN SISWA BARU TAHUN PELAJARAN 2023/2024</h1>
                        <div class="section-header-breadcrumb">
                            <button id="btndaftar" data-id="pendaftaran" type="button" class="klikmenu btn btn-danger animated infinite pulse delay-2s">DAFTAR SEKARANG</button> &nbsp;
                            <button id="btnmasuk" data-id="login" type="button" class="klikmenu btn btn-primary">LOGIN SISWA</button>
                        </div>
                    </div>

                    <div class="section-body ">
                        <div id='isi_load'></div>
                        <!-- <div class="row">

                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators3" data-slide-to="0" class=""></li>
                                                <li data-target="#carouselExampleIndicators3" data-slide-to="1" class=""></li>
                                                <li data-target="#carouselExampleIndicators3" data-slide-to="2" class="active"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="assets/img/news/img01.jpg" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="assets/img/news/img07.jpg" alt="Second slide">
                                                </div>
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="assets/img/news/img08.jpg" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> -->
                        <div class="row animated bounceInUp">

                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4">
                                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link  active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Informasi Pendaftaran</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Syarat Pendaftaran</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="true">Kontak Pendaftaran</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-8">
                                                <div class="tab-content no-padding" id="myTab2Content">
                                                    <div class="tab-pane fade active show" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="activities">
                                                                    <div class="activity">
                                                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                                                            1
                                                                        </div>
                                                                        <div class="activity-detail">
                                                                            <p>Calon Siswa mendaftar di web pendaftaran.</p>
                                                                            <p><button type="button" data-id="pendaftaran" class="btn klikmenu btn-danger">Daftar Sekarang</button>.</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="activities">
                                                                    <div class="activity">
                                                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                                                            2
                                                                        </div>
                                                                        <div class="activity-detail">
                                                                            <p>Jika selesai pendaftaran silahkan login dengan username dan password saat pendaftaran</p>
                                                                            <p><button type="button" data-id="login" class="klikmenu btn btn-success">Silakan Login</button>.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="activities">
                                                                    <div class="activity">
                                                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                                                            3
                                                                        </div>
                                                                        <div class="activity-detail">
                                                                            <p>Lengkapi Formulir yang diberikan dengan data yang benar.</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                                        <?= $setting['syarat'] ?>
                                                    </div>
                                                    <div class="tab-pane fade " id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                                        <div class=" author-box">
                                                            <div class="card-body">
                                                                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                                                                    <?php $query = mysqli_query($koneksi, "select * from kontak where status='1'");
                                                                    while ($data = mysqli_fetch_array($query)) {
                                                                    ?>
                                                                        <li class="media">
                                                                            <img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png">
                                                                            <div class="media-body">
                                                                                <div class="media-title"><?= $data['nama_kontak'] ?></div>
                                                                                <div class="text-job text-muted"><a href="https://api.whatsapp.com/send?phone=+62<?=$data['no_kontak'] ?>&text=<?= $setting['livechat'] ?>"> <?= $data['no_kontak'] ?></a></div>
                                                                            </div>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row animated bounceIn">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Statistik Sekolah</h4>
                                        <div class="card-header-action">

                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="sortable-table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            <i class="fas fa-th"></i>
                                                        </th>
                                                        <th>NPSN</th>
                                                        <th>Nama Sekolah</th>

                                                        <th>Pendaftar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ui-sortable">
                                                    <?php $query = mysqli_query($koneksi, "select * from daftar group by asal_sekolah");
                                                    while ($sekolah = mysqli_fetch_array($query)) {
                                                        $hitung = rowcount($koneksi, 'daftar', ['asal_sekolah' => $sekolah['asal_sekolah']]);
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="sort-handler ui-sortable-handle">
                                                                    <i class="fas fa-th"></i>
                                                                </div>
                                                            </td>
                                                            <td><?= $sekolah['npsn_asal'] ?></td>
                                                            <td><?= $sekolah['asal_sekolah'] ?></td>

                                                            <td>
                                                                <div class="badge badge-success"><?= $hitung ?></div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    &copy; <?= date('Y') ?> PPDB SMK Plus Pratama Adi <div class="bullet"></div> Design By <a href="https://nauval.in/">Stisla</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>


    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
    <!-- Page Specific JS File -->

    <!-- JS DATATABLE -->
    <script src="assets/modules/datatables/datatables.min.js"></script>
    <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript">
        $('.loader').fadeOut('slow');
        $(document).ready(function() {
            $('.klikmenu').click(function() {
                var menu = $(this).data('id');
                if (menu == "beranda") {
                    $('#btndaftar').show();
                    $('#isi_load').load('home.php');
                } else if (menu == "pendaftaran") {
                    $('#btndaftar').hide();
                    $('#isi_load').load('pendaftaran.php');
                } else if (menu == "daftar") {
                    $('#isi_load').load('datadaftar.php');
                } else if (menu == "pengumuman") {
                    $('#isi_load').load('pengumuman.php');
                } else if (menu == "login") {
                    $('#isi_load').load('login.php');
                }
            });


            // halaman yang di load default pertama kali
            $('#isi_load').load('home.php');

        });
    </script>
    <!-- <a href="#" class="ignielToTop"></a> -->
</body>

</html>