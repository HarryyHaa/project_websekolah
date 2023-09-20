<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i>
            DAFTAR NILAI
        </h3>
        <div class="card-tools">
            <a href="<?= base_url('Kursus/export_nilai/') . $id_materi ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel    "></i> Export</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th width='10'>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($nilai as $nilai) {
                    $siswa = $this->db->get_where('siswa', ['id_siswa' => $nilai['id_siswa']])->row_array();
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
                            <?= $nilai['nilai'] ?>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card -->
</div>