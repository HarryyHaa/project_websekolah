<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $verifikasi = (isset($_POST['verifikasi'])) ? 1 : 0;
    $data = [
        'nama_bayar' => $_POST['nama'],
        'verifikasi' => $verifikasi
    ];
    $id_bayar = $_POST['id_bayar'];
    $excec = update($koneksi, 'bayar', $data, ['id_bayar' => $id_bayar]);
    echo $exec;
}
if ($pg == 'tambah') {
    $today = date("Ymd");

    // cari id transaksi terakhir yang berawalan tanggal hari ini
    $query = "SELECT max(id_bayar) AS last FROM bayar WHERE id_bayar LIKE '$today%'";
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_array($hasil);
    $lastNoTransaksi = $data['last'];
    $lastNoUrut = substr($lastNoTransaksi, 8, 4);
    $nextNoUrut = $lastNoUrut + 1;
    $nextNoTransaksi = $today . sprintf('%04s', $nextNoUrut);
    $data = [
        'id_bayar'      => $nextNoTransaksi,
        'id_daftar'     => $_POST['id'],
        'jumlah'        => str_replace(",", "", $_POST['jumlah']),
        'tgl_bayar'     => $_POST['tgl'],
        'id_user'       => $_SESSION['id_user']

    ];
    $exec = insert($koneksi, 'bayar', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_bayar = $_POST['id_bayar'];
    delete($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
}
if ($pg == 'verifikasi') {
    $id_bayar = $_POST['id_bayar'];
    $data = [
        'verifikasi' => 1
    ];
    update($koneksi, 'bayar', $data, ['id_bayar' => $id_bayar]);
}
if ($pg == 'batalverifikasi') {
    $id_bayar = $_POST['id_bayar'];
    $data = [
        'verifikasi' => 0
    ];
    update($koneksi, 'bayar', $data, ['id_bayar' => $id_bayar]);
}
