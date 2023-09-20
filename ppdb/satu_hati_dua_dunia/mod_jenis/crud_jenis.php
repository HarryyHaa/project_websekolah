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
        'nama_jenis' => $_POST['nama'],
        'status' => $status
    ];
    $id_jenis = $_POST['id_jenis'];
    update($koneksi, 'jenis', $data, ['id_jenis' => $id_jenis]);
}
if ($pg == 'tambah') {
    $data = [
        'id_jenis'     => $_POST['id_jenis'],
        'nama_jenis'   => $_POST['nama'],
        'status'         => 1
    ];
    $exec = insert($koneksi, 'jenis', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_jenis = $_POST['id_jenis'];
    delete($koneksi, 'jenis', ['id_jenis' => $id_jenis]);
}
