<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">DAFTAR MATERI</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Pertemuan</th>
                    <th>Materi</th>
                    <th>Guru</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($materi as $materi) {
                    $guru = $this->db->get_where('guru', ['id_guru' => $materi['id_guru']])->row_array();
                ?>
                    <tr>
                        <td>Ke- <?= $materi['pertemuan'] ?></td>
                        <td>
                            <img src="<?= base_url('assets/dist/img/materi.png') ?>" alt="Product 1" class="img-circle img-size-32 mr-2">
                            <?= $materi['materi'] ?>
                        </td>

                        <td>
                            <?= $guru['nama'] ?>
                        </td>
                        <td>
                            <a href="<?= base_url('Kursus/lihat/') . $materi['id_materi'] ?>" class="btn btn-sm btn-default">
                                <i class="fas fa-search"></i> Baca
                            </a>
                            <?php if ($materi['kuis'] == 1) { ?>
                                <?php
                                $ceknilai = $this->db->get_where('nilai_quiz', ['id_siswa' => $this->session->userdata('iduser'), 'id_materi' => $materi['id_materi']])->num_rows();
                                $ceksoal = $this->db->get_where('soal', ['id_materi' => $materi['id_materi']])->num_rows();
                                if ($ceknilai == 0) { ?>
                                    <?php if ($ceksoal <> 0) {  ?>
                                        <a href="<?= base_url('Kursus/quiz/') . encrypt_url($materi['id_materi']) ?>" class="btn btn-sm btn-default">
                                            <i class="fas fa-file"></i> Quiz
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>

                                    <a href="#" class="btn btn-sm btn-success">
                                        <i class="fas fa-check-circle"></i> Nilai
                                    </a>

                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">DAFTAR TUGAS TERSTRUKTUR</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tugas</th>
                    <th>Guru</th>
                    <th>Status</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($tugas as $tugas) {
                    $guru = $this->db->get_where('guru', ['id_guru' => $tugas['id_guru']])->row_array();
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('assets/dist/img/materi.png') ?>" alt="Product 1" class="img-circle img-size-32 mr-2">
                            <?= $tugas['judul'] ?>
                        </td>
                        <td>
                            <?= $guru['nama'] ?>
                        </td>
                        <td>
                            <?php
                            $cekjawab = $this->db->get_where('tugas_jawab', ['id_siswa' => $this->session->userdata('iduser'), 'id_tugas' => $tugas['id_tugas']])->num_rows();

                            if ($cekjawab == 0) { ?>
                                <span class="badge badge-danger">
                                    <i class="fas fa-times-circle"></i> Belum Dikerjakan
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle"></i> Sudah Dikerjakan
                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?= base_url('Kursus/lihattugas/') . $tugas['id_tugas'] ?>" class="btn btn-sm btn-default">
                                <i class="fas fa-search"></i> Baca
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>