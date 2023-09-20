<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
?>
<div class="card animated bounceIn">
    <div class="card-body">
        <div class="table-responsive">
            <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>No Pendaftaran</th>
                        <th>Nama Pendaftar</th>
                        <th>Asal Sekolah</th>

                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "select * from daftar");
                    $no = 0;
                    while ($daftar = mysqli_fetch_array($query)) {
                        $no++;
                        $bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(jumlah) as total from bayar where id_daftar='$daftar[id_daftar]' "));
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $daftar['no_daftar'] ?></td>
                            <td><?= $daftar['nama'] ?></td>
                            <td><?= $daftar['asal_sekolah'] ?></td>
                            <td>
                                <?php if ($daftar['status'] == 1) { ?>
                                    <span class="badge badge-success">Sudah Diterima</span>
                                <?php } elseif ($daftar['status'] == 2) { ?>
                                    <span class="badge badge-danger">Cadang </span>
                                <?php } else { ?>
                                    <span class="badge badge-warning">Belum Daftar Ulang</span>
                                <?php } ?>
                            </td>

                        </tr>

                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $("#table-1").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }]
    });
</script>