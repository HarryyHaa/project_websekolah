<div class="row">
    <div class="col-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" style="color:darkslategray" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Laporan Perbulan</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <form id="formcari">
                            <input type="hidden" name="kelas" value="<?= $kelas ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Pilih Bulan</label>
                                        <select name="bulan" class="form-control">
                                            <?php
                                            $query = $this->db->query("SELECT * FROM absen_siswa GROUP BY MONTH(tgl)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tgl']);
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
                                            $query = $this->db->query("SELECT * FROM absen_siswa GROUP BY year(tgl)")->result_array();
                                            foreach ($query as $query) {
                                                $data = explode('-', $query['tgl']);
                                                $tahun = $data[0]; ?>
                                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>
                        </form>
                        <div id='hasilcari'></div>
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
                url: "<?= base_url('Absen/getrekap') ?>",
                data: $("#formcari").serialize(),
                success: function(data) {
                    $("#hasilcari").html(data);
                }
            });

        });

    });
</script>