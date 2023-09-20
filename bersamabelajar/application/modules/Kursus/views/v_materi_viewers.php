<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i>
            DAFTAR VIEWERS
        </h3>
        <div class="card-tools">
            <a href="<?= base_url('Kursus/export_view/') . $id_materi ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel    "></i> Export</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Akses Tanggal</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($logmateri as $logmateri) {
                    $siswa = $this->db->get_where('siswa', ['id_siswa' => $logmateri['id_user']])->row_array();
                ?>
                    <tr>
                        <td width='5'><?= $no++ ?></td>
                        <td>
                            <?= $siswa['nama'] ?>
                        </td>
                        <td><?= $siswa['kelas'] ?></td>
                        <td>
                            <?= $logmateri['tgl'] ?>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card -->
</div>