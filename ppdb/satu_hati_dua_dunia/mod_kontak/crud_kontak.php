<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $status = (isset($_POST['status'])) ? 1 : 0;
    $data = [
        'nama_kontak' => $_POST['nama'],
        'no_kontak'     => $_POST['nohp'],
        'status' => $status
    ];
    $id_kontak = $_POST['id_kontak'];
    update($koneksi, 'kontak', $data, ['id_kontak' => $id_kontak]);
}
if ($pg == 'tambah') {
    $data = [
        'no_kontak'     => $_POST['nohp'],
        'nama_kontak'   => $_POST['nama'],
        'status'         => 1
    ];
    $exec = insert($koneksi, 'kontak', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_kontak = $_POST['id_kontak'];
    delete($koneksi, 'kontak', ['id_kontak' => $id_kontak]);
}
