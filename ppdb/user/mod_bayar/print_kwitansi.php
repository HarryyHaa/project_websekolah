<?php ob_start();
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
include "../../assets/modules/phpqrcode/qrlib.php";
$id_bayar = dekripsi($_GET['id']);
$bayar = fetch($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
$siswa = fetch($koneksi, 'daftar', ['id_daftar' => $bayar['id_daftar']]);

$tempdir = "../../temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

//isi qrcode jika di scan
$codeContents = $bayar['id_bayar'] . '-' . $siswa['nama'];

//simpan file kedalam temp
//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

QRcode::png($codeContents, $tempdir . $id_bayar . '.png', QR_ECLEVEL_L, 3, 6);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Bukti_<?= $siswa['nama'] ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../../assets/modules/bootstrap/css/bootstrap.min.css">


</head>

<body>
    <h3><?= $setting['nama_sekolah'] ?></h3>
    <p><small> <?= $setting['alamat'] ?></small></p>
    <hr>
    <center>
        <h3><u>BUKTI PEMBAYARAN PPDB</u></h3>
        <p>NO TRANSAKSI : <?= $id_bayar ?> </p>
    </center>
    <br>
    <h5>Telah Terima dari :</h5>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Jumlah Bayar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $siswa['nama'] ?></td>
                <td><?= "Rp " . number_format($bayar['jumlah'], 2, ",", ".") ?></td>
                <td><?= $bayar['tgl_bayar'] ?></td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div>
            <h5>Terbilang : <?= terbilang($bayar['jumlah'], 2) ?></h5>
            <small>Print Date : <?= date('Y-m-d H:i:s') ?></small>
        </div>
        <div style="text-align: right">
            <img src="<?= $tempdir . $id_bayar . '.png' ?>" />
        </div>
    </div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

exit(0);
?>