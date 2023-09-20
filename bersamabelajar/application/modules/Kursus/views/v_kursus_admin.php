<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">DAFTAR PEMBELAJARAN AKTIF</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-valign-middle" id="tabledata">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Guru</th>
                    <th>Kursus</th>
                    <th>Materi</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($guru as $guru) {
                    $kursus = $this->db->get_where('kursus', ['id_guru' => $guru['id_guru']])->num_rows();
                    $materi = $this->db->get_where('materi', ['id_guru' => $guru['id_guru']])->num_rows();
                ?>
                    <tr>
                        <td> <?= $no++ ?></td>
                        <td>
                            <?= $guru['nama'] ?>
                        </td>

                        <td>
                            <?= $kursus ?>
                        </td>
                        <td>
                            <?= $materi ?>
                        </td>
                        <td>
                            <a href="<?= base_url('Kursus/gurulist/') . $guru['id_guru'] ?>" class="btn btn-sm btn-default">
                                <i class="fas fa-search"></i> Lihat
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>