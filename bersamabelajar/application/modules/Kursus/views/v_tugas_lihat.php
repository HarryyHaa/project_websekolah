<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-eye"></i>
            <?= $tugas['judul'] ?>
        </h3>
    </div>
    <div class="card-body">
        <div class="post">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="<?= base_url('assets/dist/img/materi.png') ?>" alt="user image">
                <span class="username">
                    <a href="#"><?= $tugas['judul'] ?></a>
                </span>
                <span class="description">Tgl dibuka - <?= $tugas['tgl_buka'] ?></span>
            </div>
            <!-- /.user-block -->
            <p>
                <?= $tugas['tugas'] ?>
            </p>
            Akan Ditutup Tanggal : <i class="fas fa-calendar   "></i>
            <span class="text-red"><?= $tugas['tgl_tutup'] ?></span>
            <br>
            <p>Tugas ini sudah dikerjakan : <i class="fas fa-user   "></i> <?= $jawabtugas ?>
                <?php if ($this->session->userdata('akses') <> 3) { ?>
                    <a href="<?= base_url('Kursus/jawabtugas/') . $tugas['id_tugas'] ?>" class="badge badge-primary">Lihat Jawaban</a>
                <?php } ?></p>
        </div>

        <?php
        $cek = $this->db->get_where('tugas_jawab', ['id_siswa' => $this->session->userdata('iduser'), 'id_tugas' => $tugas['id_tugas']])->num_rows();
        if ($cek == 0) {
            if (date('Y-m-d H:i:s') <= $tugas['tgl_tutup']) {
        ?>
                <form action="<?= base_url('Kursus/kirim_tugas/') . $tugas['id_tugas'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Upload Jawaban Disini</label>

                        <!--<input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId" required>-->

                        <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId" multiple="true" required>
                        <!--<input type="file" name="filename"  multiple="true">-->
                        <small id="fileHelpId" class="form-text text-muted">Upload hanya png, jpg, doc, pdf</small>
                    </div>
                    <div class="form-group">
                        
                        <button class="btn btn-warning"><i class="fab fa-telegram"></i> Kirim Jawaban</button>

                        <!--<button class="btn btn-warning"><input type="file" name="filename[]" multiple="true"><i class="fab fa-telegram"></i> Kirim Jawaban</button>-->

                       <!-- <button class="btn btn-warning"><input type="file" class="form-control-file"name="filename[]" multiple="true"><i class="fab fa-telegram"></i> Kirim Jawaban</button>-->
                    </div>
                </form>
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
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $data = $this->db->get_where('tugas_jawab', ['id_siswa' => $this->session->userdata('iduser'), 'id_tugas' => $tugas['id_tugas']])->row_array(); ?>
                    <tr>
                        <td scope="row"> Jawaban sudah terkirim</td>
                        <td>
                            <a class="btn btn-primary" href="<?= base_url('assets/tugas/') . $data['file'] ?>" role="button">Lihat</a>
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

        <?php if ($tugas['komentar'] == 0) { ?>
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
                    var url = "<?= base_url('Kursus/addkomentar/') . $tugas['id_tugas'] ?>";
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