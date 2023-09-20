<?php
require("../../config/database.php");
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pendaftar_diterima.xls");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
?>
<style>
    .str {
        mso-number-format: \@;
    }
</style>
<table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                #
            </th>
            <th>NISN</th>
            <th>NIK</th>
            <th>Nama Pendaftar</th>
            <th>Jenis Kelamin</th>
            <th>Tempat</th>
            <th>Tanggal Lahir</th>
            <th>Agama</th>
            <th>NPSN Asal</th>
            <th>Asal Sekolah</th>
            <th>Jenjang</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
            <th>Desa</th>
            <th>Kecamatan</th>
            <th>Kab/Kota</th>
            <th>Kode_Pos</th>
            <th>Transportasi</th>
            <th>Anak Ke</th>
            <th>Saudara</th>
            <th>Tinggi</th>
            <th>Berat</th>
            <th>Status Keluarga</th>
            <th>Tinggal</th>
            <th>Jarak</th>
            <th>Waktu</th>
            <th>NIK Ayah</th>
            <th>Nama Ayah</th>
            <th>Tempat</th>
            <th>Tgl Lahir</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>No Hp</th>
            <th>NIK Ibu</th>
            <th>Nama Ibu</th>
            <th>Tempat</th>
            <th>Tgl Lahir</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>No Hp</th>
            <th>NIK Wali</th>
            <th>Nama Wali</th>
            <th>Tempat</th>
            <th>Tgl Lahir</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>No Hp</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($koneksi, "select * from daftar where status='1'");
        $no = 0;
        while ($daftar = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td class="str"><?= $daftar['nisn'] ?></td>
                <td class="str"><?= $daftar['nik'] ?></td>
                <td><?= $daftar['nama'] ?></td>
                <td><?= $daftar['jenkel'] ?></td>
                <td><?= $daftar['tempat_lahir'] ?></td>
                <td><?= $daftar['tgl_lahir'] ?></td>
                <td><?= $daftar['agama'] ?></td>
                <td><?= $daftar['npsn_asal'] ?></td>
                <td><?= $daftar['asal_sekolah'] ?></td>
                <td><?= $daftar['jenjang'] ?></td>
                <td><?= $daftar['jurusan'] ?></td>
                <td class="str">
                    <i class="fab fa-whatsapp text-success   "></i>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=62<?= $daftar['no_hp'] ?>"><?= $daftar['no_hp'] ?></a>
                </td>
                <td><?= $daftar['alamat'] ?></td>
                <th><?= $daftar['rt'] ?></th>
                <td><?= $daftar['rw'] ?></td>
                <td><?= $daftar['desa'] ?></td>
                <td><?= $daftar['kecamatan'] ?></td>
                <td><?= $daftar['kota'] ?></td>
                <td><?= $daftar['kode_pos'] ?></td>
                <td><?= $daftar['transportasi'] ?></td>
                <td><?= $daftar['anak_ke'] ?></td>
                <td><?= $daftar['saudara'] ?></td>
                <td><?= $daftar['tinggi'] ?></td>
                <td><?= $daftar['berat'] ?></td>
                <td><?= $daftar['status_keluarga'] ?></td>
                <td><?= $daftar['tinggal'] ?></td>
                <td><?= $daftar['jarak'] ?></td>
                <td><?= $daftar['waktu'] ?></td>
                <td class="str"><?= $daftar['nik_ayah'] ?></td>
                <td><?= $daftar['nama_ayah'] ?></td>
                <td><?= $daftar['tempat_ayah'] ?></td>
                <td><?= $daftar['tgl_lahir_ayah'] ?></td>
                <td><?= $daftar['pendidikan_ayah'] ?></td>
                <td><?= $daftar['pekerjaan_ayah'] ?></td>
                <td><?= $daftar['penghasilan_ayah'] ?></td>
                <td class="str"><?= $daftar['no_hp_ayah'] ?></td>
                <td class="str"><?= $daftar['nik_ibu'] ?></td>
                <td><?= $daftar['nama_ibu'] ?></td>
                <td><?= $daftar['tempat_ibu'] ?></td>
                <td><?= $daftar['tgl_lahir_ibu'] ?></td>
                <td><?= $daftar['pendidikan_ibu'] ?></td>
                <td><?= $daftar['pekerjaan_ibu'] ?></td>
                <td><?= $daftar['penghasilan_ibu'] ?></td>
                <td class="str"><?= $daftar['no_hp_ibu'] ?></td>
                <td class="str"><?= $daftar['nik_wali'] ?></td>
                <td><?= $daftar['nama_wali'] ?></td>
                <td><?= $daftar['tempat_wali'] ?></td>
                <td><?= $daftar['tgl_lahir_wali'] ?></td>
                <td><?= $daftar['pendidikan_wali'] ?></td>
                <td><?= $daftar['pekerjaan_wali'] ?></td>
                <td><?= $daftar['penghasilan_wali'] ?></td>
                <td class="str"><?= $daftar['no_hp_wali'] ?></td>

                <td>
                    <?php if ($daftar['status'] == 1) { ?>
                        <span class="badge badge-success">diterima</span>
                    <?php } elseif ($daftar['status'] == 2) { ?>
                        <span class="badge badge-danger">Cadang </span>
                    <?php } else { ?>
                        <span class="badge badge-warning">pending</span>
                    <?php } ?>
                </td>

            </tr>

        <?php }
        ?>


    </tbody>
</table>