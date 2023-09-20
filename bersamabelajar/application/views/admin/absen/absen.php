<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>DATA ABSENSI </h5> <!-- <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tanggal Hari Ini</label>
                            <input type="text" id='tanggal' class="form-control tanggal" value="<?= date('Y-m-d') ?>" name="tanggal">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Pilih Kelas</label>
                            <select class="form-control" id='pilihkelas' name="kelas">
                                <option value=""></option>

                                <?php foreach ($kelas as $kelas) { ?>
                                    <option><?= $kelas['id'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id='hasilcari'></div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function() {

        $("#pilihkelas").change(function() {

            $("#loader").show();

            var getUserID = $(this).val();
            var tanggal = $('#tanggal').val();
            if (getUserID != '0') {
                $.ajax({
                    type: 'GET',
                    url: '<?= base_url('absen/getsiswa/') ?>' + getUserID,
                    data: {
                        kelas: getUserID,
                        tanggal: tanggal
                    },
                    success: function(data) {

                        $("#hasilcari").html(data);
                    }
                });
            } else {
                $("#hasilcari").html('');

            }
        });

    });
</script>