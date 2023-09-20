<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>DATA SISWA BINAAN AKTIF </h5> <!-- <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <button type="button" data-toggle="modal" data-target="#pilihkm" class="btn btn-primary mb-2" btn-lg btn-block">Pilih Ketua Kelas</button>
                <div class="table-responsive">
                    <table style="font-size:12px" class="table table-hover table-striped table-bordered table-sm" id="tablesiswa" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>STAT</th>
                                <!-- <th>KELAS</th> -->
                                <th>NISN</th>
                                <th>NIK</th>
                                <!-- <th>ASAL SEKOLAH</th> -->
                                <th>JK</th>
                                <th>TEMPAT</th>
                                <th>TGL LAHIR</th>
                                <th>IBU KANDUNG</th>
                                <th>NO KIP</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetsiswa'>
                            <?php $no = 0; ?>
                            <?php foreach ($siswa as $siswa) : ?>
                                <?php $no++ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?> <span class="badge badge-primary"><?= strtoupper($siswa['level']) ?></span></td>
                                    <td align='center'><?php cekstatus($siswa['nis']); ?></td>
                                    <!-- <td><?= $siswa['kelas'] ?></td> -->
                                    <td><?= $siswa['nisn'] ?></td>
                                    <td><?= $siswa['nik'] ?></td>
                                    <!-- <td><?= $siswa['asal_sekolah'] ?></td> -->
                                    <td><?= $siswa['jenkel'] ?></td>
                                    <td><?= $siswa['tempat_lahir'] ?></td>
                                    <td><?= $siswa['tgl_lahir'] ?></td>
                                    <td><?= $siswa['nama_ibu'] ?></td>
                                    <td><?= $siswa['no_kip'] ?></td>

                                    <td>
                                        <a name="" id="" class="btn btn-sm btn-primary" href="<?= base_url('siswa/edit/') . $siswa['id'] ?>" role="button"><i class="fas fa-search    "></i></a>
                                        <a class="hapus btn btn-sm btn-danger" data-id="<?= $siswa['id'] ?>" href="javascript:void(0);" role="button"><i class="fas fa-trash    "></i></a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="hapussiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keluarkan Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-keluar'>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_siswa" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="" disabled>
                        <small id="helpid" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Tanggal Keluar</label>
                        <input type="text" name="tgl_keluar" id="tgl_keluar" class="tanggal form-control" placeholder="">
                        <small id="helptgl" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Alasan Keluar</label>
                        <select class="form-control" name="alasan" id="alasan">
                            <option value="">Pilih Alasan Keluar</option>
                            <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                            <option value="Pindah Sekolah">Pindah Sekolah</option>
                            <option value="Dikeluarkan">Dikeluarkan</option>
                        </select>
                        <small id="helpalasan" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Surat Keluar <small>(file pdf)</small></label>
                        <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelpId">
                        <small id="fileHelpId" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="pilihkm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Ketua Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-km'>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="siswa">Pilih Siswa</label>
                            <select class="form-control" name="nis" id="nis">
                                <?php foreach ($siswax as $siswax) : ?>
                                    <option value="<?= $siswax['nis'] ?>"><?= $siswax['nis'] . '-' . $siswax['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function notify(pesan) {
        toastr.success(pesan);
    }

    function pilihform(x) {
        if (x == 'tambah') {
            $('#btn-submit').show();
            $('#btn-edit').hide();
            $("[name='nis']").val('');
            $("[name='nama']").val('');

        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();

        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nama = $("[name='nama']").val();
        var kelas = $("[name='kelas']").val();
        var nis = $("[name='nis']").val();
        var jurusan = $("[name='jurusan']").val();
        var jenjang = $("[name='jenjang']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/tambahdata') ?>",
            data: 'nama=' + nama + '&nis=' + nis + '&kelas=' + kelas + '&jurusan=' + jurusan + '&jenjang=' + jenjang,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsiswa').modal('hide');
                    $('#tablesiswa').DataTable().ajax.reload();
                    $("[name='nama']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpnis").html(data.nis);
                    $("#helpasal").html(data.kelas);
                    $("#helptempat").html(data.jurusan);
                }

            }
        })
    });
    $('#tablesiswa').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        $('#hapussiswa').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>siswa/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $("#id_siswa").val(data[0].id);
                $("[name='nama']").val(data[0].nama);
            }
        });

    });
    $('#form-keluar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/keluarkansiswa/') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,

            ajaxSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $("#tablesiswa").load(window.location + " #tablesiswa");
                    $('#hapussiswa').modal('hide');
                    notify('Data berhasil diubah');
                } else {
                    $("#helptgl").html(data.tgl);
                    $("#helpalasan").html(data.alasan);

                }
            }
        })
    });
    $(function() {
        //hang on event of form with id=myform
        $("#form-km").submit(function(e) {
            //prevent Default functionality
            e.preventDefault();
            //do your own request an handle the results
            $.ajax({
                url: '<?= base_url('siswa/pilihkm') ?>',
                type: 'post',
                data: $("#form-km").serialize(),
                success: function(data) {
                    console.log(data);
                    $('#pilihkm').modal('hide');
                    $("#tablesiswa").load(window.location + " #tablesiswa");
                    toastr.success('Data Berhasil Disimpan');
                }
            });

        });

    });
    //**end**
    // AMBIL ID data table
    $('#tablesiswa').on('click', '.edit', function() {
        var id = $(this).data('id');
        window.location.href = "<?php echo base_url('siswa/edit/'); ?>" + id;
        // pilihform();
        // $('#tambahsiswa').modal('show');
        // $.ajax({
        //     url: "siswa/ambilid",
        //     method: "POST",
        //     dataType: 'json',
        //     data: {
        //         id: id
        //     },
        //     success: function(data) {
        //         $("[name='id']").val(data[0].id);
        //         $("[name='nama']").val(data[0].nama);
        //     }
        // });

    });
</script>