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
        'nama_jurusan' => $_POST['nama'],
        'kuota'        => $_POST['kuota'],
        'status'       => $status
    ];
    $id_jurusan = $_POST['id_jurusan'];
    update($koneksi, 'jurusan', $data, ['id_jurusan' => $id_jurusan]);
}
if ($pg == 'tambah') {
    $data = [
        'id_jurusan'     => $_POST['id_jurusan'],
        'nama_jurusan'   => $_POST['nama'],
        'kuota'          => $_POST['kuota'],
        'status'         => 1
    ];
    $exec = insert($koneksi, 'jurusan', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_jurusan = $_POST['id_jurusan'];
    delete($koneksi, 'jurusan', ['id_jurusan' => $id_jurusan]);
}
