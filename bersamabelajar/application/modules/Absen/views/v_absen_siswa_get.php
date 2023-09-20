<div class="form-group float-right">
    <a class="btn btn-success" href="<?= base_url('Absen/export_absen/') . $kelas . '/' . $tgl ?>" role="button"><i class="fas fa-file-excel    "></i> Export Excel</a>
    <a class="btn btn-primary" href="<?= base_url('Absen/reportwalas/') . $kelas . '/' . $tgl ?>" role="button"><i class="fas fa-file-pdf    "></i> Save Pdf</a>
</div>
<div class="table-responsive">
    <table id="tablesiswa" class="table table-striped table-hover table-valign-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Absen Tanggal</th>
                <th>Keterangan</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;

            foreach ($siswa as $siswa) {
                $absen = $this->db->get_where('absen_siswa', ['id_user' => $siswa['id_siswa'], 'date(tgl)' => $tgl])->row_array();
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
                            <a href="#" data-toggle="modal" data-target="#modelId<?= $no ?>"><img src="<?= base_url('assets/img/absen/') . $absen['foto'] ?>" class="img-size-32 mr-2"></a>
                        <?php } ?>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modelId<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Foto Absensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <center>
                                    <img src="<?= base_url('assets/img/absen/') . $absen['foto'] ?>" class="img-responsive">
                                </center>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>
</div>