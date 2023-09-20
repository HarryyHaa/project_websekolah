<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PJJ</title>
    <!-- Theme style -->
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        table {
            border-collapse: collapse;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table th {
            padding: .75rem;
        }

        .table td,
        .table th {
            padding: .75rem;
            border-top: 1px solid #dee2e6;
        }

        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body>
    <div class="table-responsive">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 70px;">
                        <img src="<?= base_url('assets/img/') . $setting['logo'] ?>" style="width: 70px;">
                    </td>
                    <td style="text-align: center;">
                        <span style="font-size: 30px;"><?= $setting['nama_sekolah'] ?></span>
                        <br><small> <?= $setting['alamat'] ?></small>
                        <br><small> Website : <?= $setting['web'] ?> Email: <?= $setting['email'] ?> no Telp : <?= $setting['telp'] ?></small>
                    </td>
                    <td style="width:70px;">

                    </td>

                </tr>

            </tbody>
        </table>
        <hr>
        <center>
            <p style="font-size: 20px;">LAPORAN PJJ KELAS <?= $kelas ?></p>
        </center>
        <table style="font-size: 12px;" id="tablesiswa" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th width='5'>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Absen Tanggal</th>
                    <th>Keterangan</th>
                    <th width='50'>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $hadir = 0;
                $alfa = 0;
                foreach ($siswa as $siswa) {
                    $absen = $this->db->get_where('absen_siswa', ['id_user' => $siswa['id_siswa'], 'date(tgl)' => $tgl])->row_array();
                    if ($absen['absen'] == 'H') {
                        $hadir++;
                    } else {
                        $alfa++;
                    }
                ?>
                    <tr>
                        <td>
                            <?= $no++ ?>
                        </td>
                        <td>
                            <?= $siswa['nama'] ?>
                        </td>
                        <td><?= $siswa['kelas'] ?></td>
                        <td>
                            <?= $absen['tgl'] ?>
                        </td>
                        <td>
                            <?= $absen['ket'] ?>
                        </td>
                        <td>
                            <?php if ($absen['foto'] <> "") { ?>
                                <img src="<?= base_url('assets/img/absen/') . $absen['foto'] ?>" style="width: 70px;">
                            <?php } ?>

                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td scope="row">
                        Yang Mengikuti &nbsp;: <?= $hadir ?><br>
                        Tidak Mengikuti : <?= $alfa ?><br>
                        Prosentase : <?= round($hadir / ($hadir + $alfa) * 100, 2) ?> %

                    </td>
                    <td style="text-align: center;">
                        <br>
                        Kepala <?= $setting['nama_sekolah'] ?><br>
                        <br><br><br><br>
                        <?= $setting['kepsek'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $setting['kota'] ?>, <?= tgl_indo($tgl) ?><br>
                        Wali Kelas <?= $kelas ?><br>
                        <br><br><br><br>
                        <?= $guru['nama'] ?>
                    </td>

                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>