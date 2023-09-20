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
        'nama_biaya' => $_POST['nama'],
        'jumlah'       => $_POST['jumlah'],
        'status' => $status
    ];
    $id_biaya = $_POST['id_biaya'];
    update($koneksi, 'biaya', $data, ['id_biaya' => $id_biaya]);
}
if ($pg == 'tambah') {
    $data = [
        'id_biaya'     => $_POST['id_biaya'],
        'nama_biaya'   => $_POST['nama'],
        'jumlah'       => $_POST['jumlah'],
        'status'         => 1
    ];
    $exec = insert($koneksi, 'biaya', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_biaya = $_POST['id_biaya'];
    delete($koneksi, 'biaya', ['id_biaya' => $id_biaya]);
}
