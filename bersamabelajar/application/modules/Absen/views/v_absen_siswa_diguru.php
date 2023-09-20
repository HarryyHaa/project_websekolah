<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i>
            DAFTAR ABSEN KELAS <?= $kelas ?>
        </h3>
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body ">
        <form id="formcari">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        <input type="text" class="tanggal form-control" name="tgl" id="tgl" aria-describedby="helpId" placeholder="Pilih Tanggal" required autocomplete="off">

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>
                    </div>
                </div>

            </div>

        </form>
        <div id="hasilcari">
            <form id='myform'>
                <div class="form-group float-right">
                    <a class="btn btn-success" href="<?= base_url('Absen/export_absen/') . $kelas ?>" role="button"><i class="fas fa-file-excel    "></i> Export Excel</a>
                    <button type="submit" class=" btn btn-primary"><i class="fas fa-sync    "></i> Perbarui</button>
                </div>
                <div class="table-responsive">
                    <table id="tablesiswa" class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Absen Tanggal</th>
                                <th>Absen</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type='hidden' value="<?= $jumdata ?>" name="jumlahdata">
                            <!-- <input type='hidden' value="<?= $tanggal ?>" name="tanggal"> -->
                            <?php $no = 1;
                            foreach ($siswa as $siswa) {
                                $absen = $this->db->get_where('absen_siswa', ['id_user' => $siswa['id_siswa'], 'date(tgl)' => date('Y-m-d')])->row_array();
                                if ($absen['absen'] == 'H') {
                                    $ket1 = 'checked';
                                } else {
                                    $ket1 = '';
                                }
                                if ($absen['absen'] == 'I') {
                                    $ket2 = 'checked';
                                } else {
                                    $ket2 = '';
                                }
                                if ($absen['absen'] == 'A') {
                                    $ket3 = 'checked';
                                } else {
                                    $ket3 = '';
                                }
                                if ($absen['absen'] == 'S') {
                                    $ket4 = 'checked';
                                } else {
                                    $ket4 = '';
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                        <input type="hidden" class="form-control" name="<?= $no ?>id" value="<?= $siswa['id_siswa'] ?>" aria-describedby="helpId">
                                    </td>
                                    <td>
                                        <?= $siswa['nama'] ?>
                                    </td>

                                    <td>
                                        <?= $absen['tgl'] ?>
                                    </td>
                                    <td> <?php if ($absen['absen'] <> "H") { ?>
                                            <!-- <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="absen form-check-input" type="radio" name="<?= $no ?>absen" value="H" <?= $ket1 ?>> H
                                                </label>
                                            </div> -->
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="S" <?= $ket4 ?>> S
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="I" <?= $ket2 ?>> I
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="A" <?= $ket3 ?>> A
                                                </label>
                                            </div>
                                        <?php } else {
                                                echo $absen['absen'];
                                            } ?>
                                    </td>
                                    <td>
                                        <?php if ($absen['ket'] == "") { ?>

                                            <input type="text" class="form-control-sm form-control" name="<?= $no ?>ket" style="width: 100px;" aria-describedby="helpId">

                                        <?php  } else { ?>
                                            <?= $absen['ket'] ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($absen['foto'] <> "") { ?>
                                            <a href="#" data-toggle="modal" data-target="#modelId<?= $no ?>"><img src="<?= base_url('assets/img/absen/') . $absen['foto'] ?>" class="img-size-32 mr-2"></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modelId<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Foto Absensi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <img src="<?= base_url('assets/img/absen/') . $absen['foto'] ?>" class="img-responsive">
                                                </center>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("#formcari").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "<?= base_url('Absen/getabsen/') . $kelas ?>",
                data: $("#formcari").serialize(),
                success: function(data) {
                    $("#hasilcari").html(data);
                }
            });

        });


        //hang on event of form with id=myform
        $("#myform").submit(function(e) {
            //prevent Default functionality
            e.preventDefault();
            //do your own request an handle the results
            $.ajax({
                url: '<?= base_url('Absen/simpanabsen') ?>',
                type: 'post',
                data: $("#myform").serialize(),
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(data) {
                    $('.loader').hide();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Disimpan',
                        position: 'topRight'
                    });
                }
            });

        });

    });
</script>