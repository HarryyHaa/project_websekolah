<div class="row">
    <div class="col-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" style="color:darkslategray" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Laporan Perbulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:darkslategray" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Laporan Custom</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <form id="formcari">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Pilih Bulan</label>
                                        <select name="bulan" class="form-control">
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY MONTH(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $bulan = $data[1]; ?>
                                                <option value="<?= $bulan ?>"><?= bulan($bulan) ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Tahun</label>
                                        <select class='form-control' name='tahun'>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY year(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $tahun = $data[0]; ?>
                                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pilih Kelas</label>
                                        <select class="form-control" id='pilihkelas' name="kelas" required>
                                            <option value=""></option>

                                            <?php foreach ($kelas as $kelas) { ?>
                                                <option><?= $kelas['id'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>
                        </form>
                        <div id='hasilcari'></div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <form id="formcari2">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Pilih Bulan</label>
                                        <select name="bulan" class="form-control">
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY MONTH(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $bulan = $data[1]; ?>
                                                <option value="<?= $bulan ?>"><?= bulan($bulan) ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Tahun</label>
                                        <select class='form-control' name='tahun'>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY year(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $tahun = $data[0]; ?>
                                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 table-bordered">
                                    <div class="form-group ">
                                        <label for="">Pilih Bulan</label>
                                        <select name="bulan2" class="form-control">
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY MONTH(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $bulan = $data[1]; ?>
                                                <option value="<?= $bulan ?>"><?= bulan($bulan) ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 table-bordered">
                                    <div class="form-group">
                                        <label for="">Tahun</label>
                                        <select class='form-control' name='tahun2'>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM si_absen GROUP BY year(tanggal)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tanggal']);
                                                $tahun = $data[0]; ?>
                                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pilih Kelas</label>
                                        <select class="form-control" id='pilihkelas' name="kelas" required>
                                            <option value=""></option>

                                            <?php foreach ($kelas2 as $kelas2) { ?>
                                                <option><?= $kelas2['id'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>
                        </form>
                        <div id='hasilcari2'></div>
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#formcari").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "<?= base_url('absen/getrekap') ?>",
                data: $("#formcari").serialize(),
                success: function(data) {
                    $("#hasilcari").html(data);
                }
            });

        });

    });
    $(document).ready(function() {

        $("#formcari2").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "<?= base_url('absen/getrekapcustom') ?>",
                data: $("#formcari2").serialize(),
                success: function(data) {
                    $("#hasilcari2").html(data);
                }
            });

        });

    });
</script>