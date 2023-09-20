<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">DAFTAR KURSUS AKTIF</h3>
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
        <div class="card-body">
            <div class="row" id="tablekursus">

                <?php
                $warna = ['danger', 'warning', 'success', 'primary', 'purple', 'gray', 'navy'];
                foreach ($kursus as $kursus) :
                    $kelas = explode(",", $kursus['kelas']);
                    if (in_array($siswa['kelas'], $kelas)) {
                        $guru = $this->db->get_where('guru', ['id_guru' => $kursus['id_guru']])->row_array();
                ?>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-<?= $warna[array_rand($warna)]  ?>">
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="<?= base_url() ?>assets/dist/img/materi.png" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <a href="<?= base_url('Kursus/materi/') . $kursus['id_kursus'] ?>">
                                        <h3 class="widget-user-username"><?= substr($kursus['id_mapel'], 0, 20) . ' ...'; ?></h3>
                                    </a>
                                    <h5 class="widget-user-desc">
                                        <?php if ($kursus['status'] == 1) : ?>
                                            <span class="badge badge-primary">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </h5>
                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <?= $guru['nama'] ?>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    <?php } ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>