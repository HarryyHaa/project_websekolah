<div class="row">
    <div class="col-md-12">
        <?php
        $id_siswa = $this->session->userdata('iduser');
        $siswa = $this->db->get_where('siswa', ['id_siswa' => $id_siswa])->row_array();
        $cek = $this->db->query("select * from absen_siswa where date(tgl)=DATE(NOW()) and id_user='$id_siswa'")->num_rows();
        if ($cek == 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Hai <?= $siswa['nama'] ?>!</strong> Hari ini kamu belum absen, Ayo Absen dulu!.
            </div>
        <?php } ?>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Pengumuman
                </h3>
                <div class="card-tools">

                </div>
            </div><!-- /.card-header -->
            <div class="card-body">

                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <!-- <div class="time-label">
                                <span class="bg-red">10 Feb. 2014</span>
                            </div> -->
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <?php foreach ($info as $info) : ?>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= $info['date'] ?></span>
                                        <h3 class="timeline-header"><a href="#"><?= $info['judul'] ?></a></h3>

                                        <div class="timeline-body">
                                            <?= $info['text'] ?>
                                        </div>
                                        <!-- <div class="timeline-footer">
                                            <a class="btn btn-primary btn-sm">Read more</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </div> -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.timeline -->
        </div><!-- /.card-body -->
    </div>
</div>
</div>