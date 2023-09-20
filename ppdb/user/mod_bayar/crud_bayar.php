<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
$id = $_SESSION['id_siswa'];

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
    $query = "SELECT max(id_bayar) AS last FROM bayar WHERE id_bayar LIKE '$today%'";
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_array($hasil);
    $lastNoTransaksi = $data['last'];
    $lastNoUrut = substr($lastNoTransaksi, 8, 4);
    $nextNoUrut = $lastNoUrut + 1;
    $nextNoTransaksi = $today . sprintf('%04s', $nextNoUrut);
    $ektensi = ['jpg', 'png'];
    if ($_FILES['bukti']['name'] <> '') {
        $logo = $_FILES['bukti']['name'];
        $temp = $_FILES['bukti']['tmp_name'];
        $ext = explode('.', $logo);
        $ext = end($ext);
        //$siswa = fetch($koneksi, 'daftar', ['id_daftar' => $id]);
        if (in_array($ext, $ektensi)) {
            $dest = 'bukti_transaksi/bukti_' . $nextNoTransaksi . '.' . $ext;
            $upload = move_uploaded_file($temp,  $dest);
            if ($upload) {
                $data = [
                    'id_bayar'      => $nextNoTransaksi,
                    'id_daftar'     => $_POST['id'],
                    'jumlah'        => str_replace(",", "", $_POST['jumlah']),
                    'tgl_bayar'     => $_POST['tgl'],
                    'id_user'       => 0,
                    'bukti'         => $dest
                ];
                $exec = insert($koneksi, 'bayar', $data);
                if ($exec) {
                    echo 'ok';
                } else {
                    echo "pembayaran tidak tersimpan ulangi lagi yak";
                }
            } else {
                echo "pembayaran tidak tersimpan ulangi lagi yak";
            }
        }
    }
}
if ($pg == 'hapus') {
    $id_bayar = $_POST['id_bayar'];

    $bayar = fetch($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
    if (file_exists($bayar['bukti'])) {
        if (unlink($bayar['bukti'])) {
            delete($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
        }
    }
}
