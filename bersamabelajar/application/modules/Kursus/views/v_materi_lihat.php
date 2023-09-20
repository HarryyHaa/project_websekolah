<div class="card card-primary card-outline">
    <?php if ($this->session->userdata('akses') <> 3) { ?>
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-success" href="<?= base_url('Kursus/viewers/') . $materi['id_materi'] ?>" role="button"><i class="fas fa-eye    "></i> Lihat Viewer</a>
                <a class="btn btn-danger" href="<?= base_url('Kursus/viewtugas/') . $materi['id_materi'] ?>" role="button"><i class="fas fa-edit    "></i> Lihat Tugas</a>
            </h3>
        </div>
    <?php } ?>
    <div class="card-body">
        <div class="post">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="<?= base_url('assets/dist/img/materi.png') ?>" alt="user image">
                <span class="username">
                    <a href="#"><?= $materi['materi'] ?></a>
                </span>
                <span class="description">Tgl dibuka - <?= $materi['tgl_buka'] ?></span>
            </div>
            <!-- /.user-block -->
            <table class="table table-sm table-striped">
                <tbody>
                    <tr>
                        <td scope="row">Pertemuan ke - <?= $materi['pertemuan'] ?></td>
                        <td>Ditutup : <i class="fas fa-calendar   "></i>
                            <span class="text-red"><?= $materi['tgl_tutup'] ?></span></td>

                    </tr>
                    <tr>
                        <td scope="row">KD - <?= $materi['kd'] ?></td>
                        <td>
                            Dibaca : <i class="fas fa-user   "></i> <?= $logmateri ?> |
                            Dikerjakan : <i class="fas fa-user   "></i> <?= $tugas ?>
                        </td>

                    </tr>
                </tbody>
            </table>

            <p>
                <?= $materi['isi'] ?>
            </p>


            <!-- <p>
                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
            </p> -->

            <div class="alert 
                alert-danger alert-dismissible fade show" role="alert">
                <strong>Mohon!</strong> Absen sesuai dengan jadwal yang sudah ditentukan ! klo tidak akan dianggap tidak hadir
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="form-group">
                <a class="btn btn-success" href="https://wa.me/62<?= $guru['no_hp'] ?>?text=Assalamualaikum.%20Saya%20<?= $siswa['nama'] ?>%20Kelas%20<?= $siswa['kelas'] ?>%20Absen%20Materi%20<?= $materi['materi'] ?>%20PertemuanKe%20<?= $materi['pertemuan'] ?>%20tgl%20<?= date('Y-m-d') ?>" role="button"><i class="fab fa-whatsapp    "></i> Absen Whatsapp</a>
            </div>
            <?php if ($this->session->userdata('akses') == 3) { ?>
                <?php if ($materi['jawab'] == 1) { ?>
                    <?php
                    $cek = $this->db->get_where('tugas_jawab', ['id_siswa' => $this->session->userdata('iduser'), 'id_materi' => $materi['id_materi']])->num_rows();
                    if ($cek == 0) {
                        if (date('Y-m-d H:i:s') <= $materi['tgl_tutup']) {
                    ?>
                            <form action="<?= base_url('Kursus/kirim_jawaban/') . $materi['id_materi'] ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="jawaban">Tulis Jawaban Disini</label>
                                    <textarea class="form-control" name="jawaban" id="jawaban" rows="3"></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="file">Atau Upload Jawaban Disini</label>
                                    <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId" required>
                                    <small id="fileHelpId" class="form-text text-muted">Upload hanya png, jpg, docx, pdf, rec</small>
                                </div> -->
                                <label for="file">Atau Kirim Jawaban (pdf,jpg,png)</label>
                                <div class="file-loading">
                                    <input id="file-inp" class="file" name="file" type="file" data-min-file-count="0" data-theme="fas">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning"><i class="fab fa-telegram"></i> Kirim Jawaban</button>
                                </div>
                            </form>
                            <script>
                                $("#file-inp").fileinput({
                                    maxFileCount: 4,
                                    validateInitialCount: true,
                                    overwriteInitial: false,
                                    allowedFileExtensions: ["jpg", "png", "gif", "pdf"]
                                });
                            </script>
                        <?php } else { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Terima Kasih!</strong> Upload Sudah ditutup
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Terima Kasih!</strong> Jawaban Sudah Terkirim dan akan dinilai
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Jawaban</th>
                                    <th>File</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data = $this->db->get_where('tugas_jawab', ['id_siswa' => $this->session->userdata('iduser'), 'id_materi' => $materi['id_materi']])->row_array(); ?>
                                <tr>
                                    <td scope="row"> Jawaban sudah terkirim</td>
                                    <td><?= $data['jawaban'] ?></td>
                                    <td>
                                        <?php if ($data['file'] <> null) : ?>
                                            <a class="btn btn-primary" href="<?= base_url('assets/tugas/') . $data['file'] ?>" role="button">Lihat</a>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if ($data['nilai'] == "") {
                                            echo "<span class='badge badge-danger'>Belum dinilai</span>";
                                        } else {
                                            echo $data['nilai'];
                                        } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>

        <?php if ($materi['komentar'] == 1) { ?>
            <form id="formkomentar">
                <div class="form-group">
                    <label for="komentar">Ada yang ingin ditanyakan ?</label>
                    <textarea name="komentar" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
                </div>
            </form>
            <script>
                $("#formkomentar").submit(function(e) {
                    e.preventDefault(); // avoid to execute the actual submit of the form.
                    var form = $(this);
                    var url = "<?= base_url('Kursus/addkomentar/') . $materi['id_materi'] ?>";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data) {
                            alert(data); // show response from the php script.
                            location.reload();
                        }
                    });
                });
            </script>
            <?php foreach ($komentar as $komentar) { ?>
                <?php
                if ($komentar['jenis'] == 3) {
                    $user = $this->db->get_where('siswa', ['id_siswa' => $komentar['id_user']])->row_array();
                } else {
                    $user = $this->db->get_where('guru', ['id_guru' => $komentar['id_user']])->row_array();
                }
                ?>
                <div class="post">
                    <div class="user-block" style="margin-bottom:0px">
                        <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/profil/') . $user['foto'] ?>" alt="user image">
                        <span class="username">
                            <a href="#"><?= $user['nama'] ?></a>
                            <?php if ($komentar['id_user'] == $this->session->userdata('iduser')) { ?>
                                <button data-id="<?= $komentar['id'] ?>" class="hapus float-right btn-default"><i class="fas fa-times"></i></button>
                            <?php } ?>
                        </span>
                        <span class="description">Post Comment - <?= $komentar['tgl'] ?></span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        <?= $komentar['komentar'] ?>
                    </p>
                    <form class="form-horizontal" id="formbalas<?= $komentar['id'] ?>">
                        <div class="input-group input-group-sm mb-0">
                            <input type="hidden" class="form-control" value="<?= $komentar['id'] ?>" name="id">
                            <input class="form-control form-control-sm" name="balas" placeholder="Response" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Send</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $("#formbalas<?= $komentar['id'] ?>").submit(function(e) {
                            e.preventDefault(); // avoid to execute the actual submit of the form.
                            var form = $(this);
                            var url = "<?= base_url('Kursus/addbalaskomentar') ?>";
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: form.serialize(), // serializes the form's elements.
                                success: function(data) {
                                    location.reload();
                                }
                            });
                        });
                    </script>
                </div>
                <?php
                $balas = $this->db->get_where('komentar_balas', ['id_komentar' => $komentar['id']])->result_array();
                foreach ($balas as $balas) {

                    if ($balas['jenis'] == 3) {
                        $userbalas = $this->db->get_where('siswa', ['id_siswa' => $balas['id_user']])->row_array();
                    } else {
                        $userbalas = $this->db->get_where('guru', ['id_guru' => $balas['id_user']])->row_array();
                    }
                ?>

                    <div class="col-md-12" style="padding-left:30px">
                        <div class="post">
                            <div class="user-block" style="margin-bottom:0px">
                                <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/profil/') . $userbalas['foto'] ?>" alt="user image">
                                <span class="username">
                                    <a href="#"><?= $userbalas['nama'] ?></a>
                                    <?php if ($balas['id_user'] == $this->session->userdata('iduser')) { ?>
                                        <button data-id="<?= $balas['id'] ?>" class="hapusbalas float-right btn-danger"><i class="fas fa-times"></i></button>
                                    <?php } ?>
                                </span>
                                <span class="description">Post Comment - <?= $balas['tgl'] ?></span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                <?= $balas['balas'] ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
    <!-- /.card -->
</div>
<script>
    $('.post').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/hapuskomentar",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                if (data == 'ok') {
                    location.reload();
                }
            }
        });

    });
    $('.post').on('click', '.hapusbalas', function() {
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/hapusbalaskomentar",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                if (data == 'ok') {
                    location.reload();
                }
            }
        });

    });
</script>