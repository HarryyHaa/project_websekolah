<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $this->db->get_where('si_siswa',['aktif'=>1])->num_rows() ?></h3>

                <p>JUMLAH SISWA</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $this->db->get('si_guru')->num_rows() ?></h3>
                <p>DATA GURU</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $this->db->get('si_kelas')->num_rows() ?></h3>

                <p>JUMLAH ROMBEL</p>
            </div>
            <div class="icon">
                <i class="fas fa-home    "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $this->db->get('si_jurusan')->num_rows() ?></h3>

                <p>DATA JURUSAN</p>
            </div>
            <div class="icon">
                <i class="fas fa-toolbox    "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-7">
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">DATA STATISTIK SISWA</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#yatim" data-toggle="tab">Anak Yatim</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kip" data-toggle="tab">Memiliki KIP</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="yatim">
                        <table class="table table-sm mt-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $yatim = $this->db->query("select * from si_siswa where status_ayah='meninggal' or status_ibu='meninggal' and aktif='1'")->result_array(); ?>
                                <?php foreach ($yatim as $yatim) : ?>
                                    <?php $i++ ?>
                                    <tr>
                                        <td scope="row"><?= $i ?></td>
                                        <td><?= $yatim['nis'] ?></td>
                                        <td><?= $yatim['nama'] ?></td>
                                        <td><?= $yatim['kelas'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="kip">
                        <table class="table table-sm mt-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>No. KIP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $a = 0;
                                $kip = $this->db->query("select * from si_siswa where no_kip<>'' and no_kip<>'-' and aktif='1'")->result_array(); ?>
                                <?php foreach ($kip as $kip) : ?>
                                    <?php $a++ ?>
                                    <tr>
                                        <td scope="row"><?= $a ?></td>
                                        <td><?= $kip['nis'] ?></td>
                                        <td><?= $kip['nama'] ?></td>
                                        <td><?= $kip['kelas'] ?></td>
                                        <td><?= $kip['no_kip'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>

        </div>
    </div>
    <div class="col-md-5">
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">DATA ROMBEL SISWA</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm m-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>L</th>
                                <th>P</th>
                                <th>Jumlah</th>
                                <th>Progress</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($kelas as $kelas) : ?>
                                <?php
                                $no++;
                                $total = $this->db->query("select * from si_siswa where kelas='$kelas[id]' and aktif='1'")->num_rows();
                                $progres = progresdata($kelas['id']);
                                $prosentase = round($progres / $total * 100,2);
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="badge badge-success"><?= $kelas['id'] ?></span></td>
                                    <td><?= $this->db->get_where('si_siswa', ['kelas' => $kelas['id'], 'jenkel' => 'L','aktif'=>1])->num_rows() ?></td>
                                    <td><?= $this->db->get_where('si_siswa', ['kelas' => $kelas['id'], 'jenkel' => 'P','aktif'=>1])->num_rows() ?></td>
                                    <td><?= $total ?></td>
                                    <td><span class="badge badge-primary"><?= $prosentase ?> %</span></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

        </div>
    </div>
    <!-- /.card -->

    <!-- /.col -->
</div>