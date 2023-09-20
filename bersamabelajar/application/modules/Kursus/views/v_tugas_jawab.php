<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i>
            DAFTAR YANG MENGERJAKAN
        </h3>
        <div class="card-tools">
            <a href="<?= base_url('Kursus/export_nilai_tugas2/') . $id_tugas ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel    "></i> Export</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table id="tabletugas" class="table table-valign-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>File</th>
                    <th width='100'>Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tugas as $tugas) {
                    $siswa = $this->db->get_where('siswa', ['id_siswa' => $tugas['id_siswa']])->row_array();
                ?>
                    <tr>
                        <td width='5' style="color: white;"><?= $tugas['id'] ?></td>
                        <td width='5'><?= $no++ ?></td>
                        <td>
                            <?= $siswa['nama'] ?>
                        </td>
                        <td><?= $siswa['kelas'] ?></td>
                        <td>
                            <?= $tugas['tgl'] ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" target="_blank" href="<?= base_url('assets/tugas/') . $tugas['file'] ?>" role="button"><i class="fas fa-eye    "></i></a>
                        </td>
                        <td>
                            <?= $tugas['nilai'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card -->
</div>
<script>
    $('#tabletugas').Tabledit({
        url: '<?= base_url('Kursus/edit_nilai') ?>',
        columns: {
            identifier: [0, 'id'],
            editable: [

                [6, 'nilai']
            ]
        },
        onSuccess: function(data, textStatus, jqXHR) {
            iziToast.success({
                title: 'OK',
                message: 'Successfully edit record!',
            });
        },
    });
</script>