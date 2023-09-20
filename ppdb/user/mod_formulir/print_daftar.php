<?php ob_start();
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
include "../../assets/modules/phpqrcode/qrlib.php";
$siswa = fetch($koneksi, 'daftar', ['id_daftar' => dekripsi($_GET['id'])]);
// $tempdir = "../../temp/"; //Nama folder tempat menyimpan file qrcode
// if (!file_exists($tempdir)) //Buat folder bername temp
//     mkdir($tempdir);

// //isi qrcode jika di scan
// $codeContents = $bayar['id_bayar'] . '-' . $siswa['nama'];

// //simpan file kedalam temp
// //nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

// QRcode::png($codeContents, $tempdir . $id_bayar . '.png', QR_ECLEVEL_L, 3, 6);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Formulir_<?= $siswa['nama'] ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../../assets/modules/bootstrap/css/bootstrap.min.css">


</head>

<body>
    <h3><?= $setting['nama_sekolah'] ?></h3>
    <p><small> <?= $setting['alamat'] ?></small></p>
    <hr>
    <center>
        <h4><u>Formulir Pendaftaran</u></h4>
        <p>No. Pendaftaran : <?= $siswa['no_daftar'] ?> </p>
    </center>

    <div class="table-responsiv">
        <table style="font-size: 12px" class="table table-striped table-bordered table-sm ">
            <tbody>
                <tr>
                    <th width="90">FOTO SISWA</th>
                    <td align="center" colspan="2"><b>DATA PRIBADI SISWA</b></td>
                </tr>
                <tr>
                    <td rowspan="4"><img src="../../assets/img/avatar/avatar-3.png" width="120" /></td>
                    <td><b>NISN</b></td>
                    <td><?= $siswa['nisn'] ?></td>
                </tr>

                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td align="left"><?= $siswa['nama'] ?></td>
                </tr>
                <tr>
                    <td><b>Tempat Tgl Lahir</b></td>
                    <td align="left"><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td align="left"><?= ($siswa['jenkel'] == 'L') ? "Laki-Laki" : "Perempuan"; ?></td>
                </tr>

            </tbody>
        </table>
        <table style="font-size: 12px" class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 150px"><b>Jurusan / Peminatan</b></td>
                    <td align="left"><?= $siswa['jurusan']  ?></td>
                    <td><b>Ukuran Baju</b></td>
                    <td align="left"><?= $siswa['baju']  ?></td>
                </tr>
                <tr>
                    <td style="width: 150px"><b>No NIK</b></td>
                    <td align="left"><?= $siswa['nik']  ?></td>
                    <td><b>No. Kartu Keluarga</b></td>
                    <td align="left"><?= $siswa['no_kk']  ?></td>
                </tr>
                <tr>
                    <td><b>Agama</b></td>
                    <td align="left"><?= $siswa['agama'] ?></td>
                    <td><b>Anak Ke</b></td>
                    <td align="left"><?= $siswa['anak_ke']  ?></td>
                </tr>
                <tr>
                    <td><b>No Handphone</b></td>
                    <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp']  ?></td>
                    <td><b>Saudara</b></td>
                    <td align="left"><?= $siswa['saudara']  ?></td>
                </tr>
                <tr>
                    <td><b>Asal Sekolah</b></td>
                    <td align="left"><?= $siswa['asal_sekolah']  ?></td>
                    <td><b>Tinggi Badan (Cm)</b></td>
                    <td align="left"><?= $siswa['tinggi']  ?></td>
                </tr>
                <tr>
                    <td><b>Alamat Siswa</b></td>
                    <td align="left"><?= $siswa['alamat']  ?></td>
                    <td><b>Berat Badan (Kg)</b></td>
                    <td align="left"><?= $siswa['berat']  ?></td>
                </tr>
                <tr>
                    <td><b>RT / RW</b></td>
                    <td align="left"><?= $siswa['rt']  ?>, <?= $siswa['rw']  ?></td>
                    <td><b>Berat Badan (Kg)</b></td>
                    <td align="left"><?= $siswa['berat']  ?></td>
                </tr>
                <tr>
                    <td><b>Desa</b></td>
                    <td align="left"><?= $siswa['desa']  ?></td>
                    <td><b>Status Dalam Keluarga</b></td>
                    <td align="left"><?= $siswa['status_keluarga']  ?></td>
                </tr>
                <tr>
                    <td><b>Kecamatan</b></td>
                    <td align="left"><?= $siswa['kecamatan']  ?></td>
                    <td><b>Tinggal Bersama</b></td>
                    <td align="left"><?= $siswa['tinggal']  ?></td>
                </tr>
                <tr>
                    <td><b>Kota / Kabupaten</b></td>
                    <td align="left"><?= $siswa['kota']  ?></td>
                    <td><b>Jarak KeSekolah (Meter)</b></td>
                    <td align="left"><?= $siswa['jarak']  ?></td>
                </tr>
                <tr>
                    <td><b>Provinsi</b></td>
                    <td align="left"><?= $siswa['provinsi']  ?></td>
                    <td><b>Waktu Tempuh (Menit)</b></td>
                    <td align="left"><?= $siswa['waktu']  ?></td>
                </tr>
                <tr>
                    <td><b>Kode Pos</b></td>
                    <td align="left"><?= $siswa['kode_pos']  ?></td>
                    <td><b>No. KIP</b></td>
                    <td align="left"><?= $siswa['no_kip']  ?></td>
                </tr>

            </tbody>
        </table>
        <table style="font-size: 12px" class="table table-bordered table-striped table-sm ">
            <tbody>
                <tr>
                    <td align="center" style="width: 150px"><i class="fas fa-user-friends"></i> <b>Data Orang Tua</b></td>
                    <td align="center"><i class="fas fa-user-friends"></i> <b>Data Ayah</b></td>
                    <td align="center"><i class="fas fa-user-friends"></i> <b>Data Ibu</b></td>
                    <td align="center"><i class="fas fa-user-friends"></i> <b>Data Wali</b></td>
                </tr>
                <tr>
                    <td><b>NIK</b></td>
                    <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_ayah'] ?></td>
                    <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_ibu'] ?></td>
                    <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_wali'] ?></td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td align="left"><?= $siswa['nama_ayah'] ?></td>
                    <td align="left"><?= $siswa['nama_ibu'] ?></td>
                    <td align="left"><?= $siswa['nama_wali'] ?></td>
                </tr>
                <tr>
                    <td><b>Tempat Tgl Lahir</b></td>
                    <td align="left"><?= $siswa['tempat_ayah'] ?>, <?= $siswa['tgl_lahir_ayah'] ?></td>
                    <td align="left"><?= $siswa['tempat_ibu'] ?>, <?= $siswa['tgl_lahir_ibu'] ?></td>
                    <td align="left"><?= $siswa['tempat_wali'] ?>, <?= $siswa['tgl_lahir_wali'] ?></td>
                </tr>
                <tr>
                    <td><b>Pendidikan</b></td>
                    <td align="left"><?= $siswa['pendidikan_ayah']  ?></td>
                    <td align="left"><?= $siswa['pendidikan_ibu']  ?></td>
                    <td align="left"><?= $siswa['pendidikan_wali']  ?></td>
                </tr>
                <tr>
                    <td><b>Pekerjaan</b></td>
                    <td align="left"> <?= $siswa['pekerjaan_ayah']  ?></td>
                    <td align="left"> <?= $siswa['pekerjaan_ibu']  ?></td>
                    <td align="left"> <?= $siswa['pekerjaan_wali']  ?></td>
                </tr>
                <tr>
                    <td><b>Penghasilan</b></td>
                    <td align="left"><?= $siswa['penghasilan_ayah']  ?></td>
                    <td align="left"><?= $siswa['penghasilan_ibu']  ?></td>
                    <td align="left"><?= $siswa['penghasilan_wali']  ?></td>
                </tr>
                <tr>
                    <td><b>No Hp</b></td>
                    <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_ayah']  ?></td>
                    <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_ibu']  ?></td>
                    <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_wali']  ?></td>
                </tr>
            </tbody>
        </table>
        <table style="font-size: 12px">
            <tbody>
                <!-- DATA LENGKAP WALI -->
                <tr>
                    <td align="center" colspan="2">Print Date : <?= date('Y-m-d H:is') ?></td>
                </tr>

            </tbody>
        </table>

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