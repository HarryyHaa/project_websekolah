<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
?>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 animated flipInX">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrapedit">
                <div class="card-header">
                    <h4>Total Pendaftar</h4>
                </div>
                <div class="card-body">
                    <?= rowcount($koneksi, 'daftar') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 animated flipInX">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Data Sekolah</h4>
                </div>
                <div class="card-body">
                    <?= mysqli_num_rows(mysqli_query($koneksi, "select * from daftar group by asal_sekolah")) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 animated flipInX">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Kuota</h4>
                    <h4>Teknik Komputer & Jaringan</h4>
                </div>
                <div class="card-body">
                   <?php $kuota = mysqli_fetch_array(mysqli_query($koneksi, "select kuota from jurusan where id_jurusan='TKJ' "));
                   echo $kuota['kuota']; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12 animated flipInX">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Kuota</h4>
                    <h4>Akuntansi Dan Keuangan Lembaga</h4>
                </div>
                <div class="card-body">
                    <?php $kuota = mysqli_fetch_array(mysqli_query($koneksi, "select kuota from jurusan where id_jurusan='AK' "));
                    echo $kuota['kuota']; ?>
                </div>
            </div>
        </div>
    </div>
</div>