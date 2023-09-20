<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $this->db->get_where('siswa', ['status' => 1])->num_rows() ?></h3>

                <p>JUMLAH SISWA</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $this->db->get('guru')->num_rows() ?></h3>
                <p>DATA GURU</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $this->db->get('kelas')->num_rows() ?></h3>

                <p>JUMLAH ROMBEL</p>
            </div>
            <div class="icon">
                <i class="fas fa-home    "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $this->db->get('jurusan')->num_rows() ?></h3>

                <p>DATA JURUSAN</p>
            </div>
            <div class="icon">
                <i class="fas fa-toolbox    "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Keaktifan Siswa Per Hari</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 444px;" width="666" height="375" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <script>
        $(function() {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Ikut',
                    'Tidak ikut',
                ],
                datasets: [{
                    data: [
                        <?= $hadir = $this->db->get_where('absen_siswa', ['date(tgl)' => date('Y-m-d'), 'absen' => 'H'])->num_rows() ?>,
                        <?= $this->db->get('siswa')->num_rows() - $hadir ?>
                    ],
                    backgroundColor: ['#00a65a', '#f56954'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        });
    </script>
    <div class="col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Pengumuman</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
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