<?php
$setting = $this->db->get_where('setting', ['id_setting' => 1])->row_array();
$akses = $this->session->userdata('akses');
$iduser = $this->session->userdata('iduser');
$guru = $this->db->get_where('guru', ['id_guru' => $iduser])->row_array();
$siswa = $this->db->get_where('siswa', ['id_siswa' => $iduser])->row_array();
?>
<aside class="main-sidebar  elevation-4 sidebar-dark-primary">
    <a href="<?= base_url() ?>" class="brand-link ">
        <img src="<?= base_url('assets/img/') . $setting['logo'] ?>" alt="AdminLTE Logo" class="brand-image  " style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $setting['nama_sekolah'] ?></span>
    </a>
    <div class="sidebar ">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                if ($akses == 2) { ?>
                    <img src="<?= base_url('assets/img/profil/') . $guru['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                <?php } elseif ($akses == 3) { ?>
                    <img src="<?= base_url('assets/img/profil/') . $siswa['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                <?php } else { ?>
                    <img src="<?= base_url() ?>assets/img/profil/default.png" class="img-circle elevation-2" alt="User Image">
                <?php } ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-compact nav-sidebar  nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Main Menu</li>
                <?php if ($akses == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('Home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Beranda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li class="nav-item ">
                                <a href="<?= base_url('Mapel') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Data Mata Pelajaran</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?= base_url('Jurusan') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Data Jurusan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Level') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Data Level</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Kelas') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Data Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Sesi') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Data Sesi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Siswa') ?>" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Guru') ?>" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Data Guru</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="<?= base_url('Soal') ?>" class="nav-link">
                            <i class="fas fa-edit nav-icon"></i>
                            <p>Bank Soal</p>
                        </a>
                    </li> -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                E-learning
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li class="nav-item ">
                                <a href="<?= base_url('Kursus') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Courses Aktif</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="<?= base_url('Agenda') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Agenda Guru</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?= base_url('Absen') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chevron-circle-right    "></i>
                                    <p>Absen Siswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Pengumuman') ?>" class="nav-link">
                            <i class="fas fa-umbrella nav-icon   "></i>
                            <p>Pengumuman</p>
                        </a>
                    </li>
                    <li class="nav-header">Pengaturan</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Users') ?>" class="nav-link">
                            <i class="fas fa-user-cog nav-icon   "></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Setting') ?>" class="nav-link">
                            <i class="fas fa-toolbox nav-icon   "></i>
                            <p>Setting App</p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($akses == 2) { //GURU 
                ?>
                    <li class="nav-item">
                        <a href="<?= base_url('Home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Beranda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Siswa') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users    "></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Kursus') ?>" class="nav-link">
                            <i class="nav-icon fas fa-edit    "></i>
                            <p>Pembelajaran</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Agenda') ?>" class="nav-link">
                            <i class="nav-icon fas fa-briefcase    "></i>
                            <p>Isi Agenda</p>
                        </a>
                    </li>
                    <?php $guru = $this->db->get_where('guru', ['id_guru' => $this->session->userdata('iduser')])->row_array() ?>
                    <?php if ($guru['walas'] <> '') { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Menu Walas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item ">
                                    <a href="<?= base_url('Siswa/kelas/') . $guru['walas'] ?>" class="nav-link">
                                        <i class="nav-icon fas fa-users    "></i>
                                        <p>Data Siswa Binaan</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="<?= base_url('Absen/walas/') . $guru['walas'] ?>" class="nav-link">
                                        <i class="nav-icon fas fa-calendar    "></i>
                                        <p>Absensi Siswa Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="<?= base_url('Absen/siswarekap/') . $guru['walas'] ?>" class="nav-link">
                                        <i class="nav-icon fas fa-clock    "></i>
                                        <p>Absensi Siswa Rekap</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                    <?php } ?>
                    <li class="nav-item ">
                        <a href="<?= base_url('Setting/myprofil') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user   "></i>
                            <p>My Profil</p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($akses == 3) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('Home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Beranda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Kursus') ?>" class="nav-link">
                            <i class="nav-icon fas fa-edit    "></i>
                            <p>Pembelajaran</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Absen/siswa') ?>" class="nav-link">
                            <i class="nav-icon fas fa-calendar    "></i>
                            <p>Isi Absensi</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Guru/listsiswa') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users   "></i>
                            <p>Daftar Guru</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?= base_url('Setting/myprofil') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user   "></i>
                            <p>My Profil</p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?= base_url('Login/logout') ?>" class="nav-link">
                        <i class="fas fa-sign nav-icon   "></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $setting['nama_sekolah'] ?></h1>
                </div>
                <div class="col-sm-6 " style="text-align: right;">
                    <div class="btn btn-sm bg-purple">
                        <script type='text/javascript'>
                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                            var date = new Date();
                            var day = date.getDate();
                            var month = date.getMonth();
                            var thisDay = date.getDay(),
                                thisDay = myDays[thisDay];
                            var yy = date.getYear();
                            var year = (yy < 1000) ? yy + 1900 : yy;
                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                            //
                        </script>
                    </div>
                    <div class=" btn btn-sm btn-danger" id="clock"></div>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <script type="text/javascript">
        function showTime() {
            var a_p = "";
            var today = new Date();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            if (curr_hour < 12) {
                a_p = "AM";
            } else {
                a_p = "PM";
            }
            if (curr_hour == 0) {
                curr_hour = 12;
            }
            if (curr_hour > 12) {
                curr_hour = curr_hour - 12;
            }
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
            document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
    </script>
    <section class="content">