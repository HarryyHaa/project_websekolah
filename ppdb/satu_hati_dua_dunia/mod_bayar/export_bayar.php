<?php
require("../../config/database.php");
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=datasemua_pembayaran.xls");
?>

<table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                #
            </th>
            <th>No Transaksi</th>
            <th>Nama Pendaftar</th>
            <th>Asal Sekolah</th>
            <th>Jumlah Bayar</th>
            <th>Tgl Bayar</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($koneksi, "select * from bayar a join daftar b ON a.id_daftar=b.id_daftar order by a.id_daftar");
        $no = 0;
        while ($daftar = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $daftar['id_bayar'] ?></td>
                <td><?= $daftar['nama'] ?></td>
                <td><?= $daftar['asal_sekolah'] ?></td>
                <td><?= $daftar['jumlah'] ?></td>
                <td><?= $daftar['tgl_bayar'] ?></td>
                <td>
                    <?php if ($daftar['verifikasi'] == 1) { ?>
                        <span class="badge badge-success">sudah dicek</span>

                    <?php } else { ?>
                        <span class="badge badge-warning">belum dicek</span>
                    <?php } ?>
                </td>

            </tr>

        <?php }
        ?>


    </tbody>
</table>