<div class="section-header">
    <h1>Hai!, <?= $siswa['nama'] ?></h1>
</div>
<!-- <div class="row">
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
</div> -->
<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php //$siswa = fetch($koneksi, 'daftar', ['id_daftar' => $user['id_daftar']]); 
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    Silahkan lengkapi data diri anda klik tombol ini untuk isi formulir <a class="btn btn-success" href="?pg=formulir" role="button">Isi Formulir</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="activities">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman where jenis='2'");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary"><?= $data['tgl'] ?></span>
                                    <span class="bullet"></span>
                                    <a class="text-job" href="#">View</a>

                                </div>
                                <h5><?= $data['judul'] ?></h5>
                                <p><?= $data['pengumuman'] ?></p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</div>