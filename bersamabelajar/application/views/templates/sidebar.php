<!-- Main Sidebar Container -->
<?php $akses = $this->session->userdata('akses') ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php $pengaturan = $this->db->query("select * from si_setting where id=1")->row_array(); ?>
    <a href="#" class="brand-link">
        <img src="<?= base_url('assets/') ?>img/<?= $pengaturan['logo'] ?>" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $pengaturan['nama_sekolah'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($akses == '1') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('jenjang') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Jenjang</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('agama') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Agama</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('jurusan') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Jurusan</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('kelas') ?>" class="nav-link">
                            <i class="fas fa-home nav-icon"></i>
                            <p>Data Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('guru') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Guru
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Siswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('siswa') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa Aktif</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('siswa/keluar') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('siswa/cekstatus') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Status Data Siswa</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('voucher') ?>" class="nav-link">
                            <i class="nav-icon fas fa-wifi"></i>
                            <p>
                                Kode Wifi Siswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('piket') ?>" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Jadwal Piket
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-coffee"></i>
                            <p>
                                Tugas Piket
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('absen/siswa') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Absen Siswa</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('absen/rekapabsen') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Absen Siswa</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>
                                Data Administrator
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('setting') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($akses == '3') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('siswa/profil') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Siswa
                            </p>
                        </a>
                    </li>
                    <?php if ($this->session->userdata('level') == 'km') : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('siswa/inputabsen') ?>" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Input Absen
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($akses == '2' or $akses == '4') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('guru/profil') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                My Profil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Siswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('siswa') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa Aktif</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('siswa/keluar') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('siswa/cekstatus') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Status Data Siswa</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('guru/voucher') ?>" class="nav-link">
                            <i class="nav-icon fas fa-wifi"></i>
                            <p>
                                Kode Wifi Siswa
                            </p>
                        </a>
                    </li>
                    <?php $cekwalas = $this->db->get_where('si_kelas', ['walas' => $this->session->userdata('nip')])->num_rows(); ?>
                    <?php if ($cekwalas <> 0) { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Data Siswa Binaan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('siswa/binaan') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Siswa Aktif</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('siswa/binaankeluar') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Siswa keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('struktur') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Struktur Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('absen/siswa') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Absen Siswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('absen/rekapabsen') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Absen Siswa</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <?php } ?>
                    <?php $cekpiket = $this->db->get_where('si_piket', ['nip' => $this->session->userdata('nip')])->num_rows(); ?>
                    <?php if ($cekpiket <> 0) { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-coffee"></i>
                                <p>
                                    Tugas Piket
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('absen/siswa') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Absen Siswa</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('absen/rekapabsen') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Absen Siswa</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <?php } ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
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
                    <h1>SMK HS AGUNG</h1>
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
    <section class="content">