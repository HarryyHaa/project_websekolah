<div class="section-header">
    <h1>Hai!, <?= $user['nama_user'] ?></h1>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pendaftar</h4>
                </div>
                <div class="card-body">
                    <?= rowcount($koneksi, 'daftar') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Daftar Ulang</h4>
                </div>
                <div class="card-body">
                    <?= rowcount($koneksi, 'daftar', ['status' => 1]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Data Transaksi</h4>
                </div>
                <div class="card-body">
                    <?= rowcount($koneksi, 'bayar') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Online Users</h4>
                </div>
                <div class="card-body">
                    <?= rowcount($koneksi, 'daftar', ['online' => 1]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Statistik Sekolah</h4>
                <div class="card-header-action">

                </div>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="sortable-table">
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
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>INFO KUOTA</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Jurusan</th>
                            <th>Peminat</th>
                            <th>Sisa Kuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query = mysqli_query($koneksi, "select * from jurusan");
                        while ($data = mysqli_fetch_array($query)) {
                            $hitung = rowcount($koneksi, 'daftar', ['jurusan' => $data['id_jurusan']]);
                        ?>
                            <tr>
                                <td scope="row"><?= $data['id_jurusan'] ?></td>
                                <td><?= $hitung ?></td>
                                <td><?= $data['kuota'] - $hitung ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>