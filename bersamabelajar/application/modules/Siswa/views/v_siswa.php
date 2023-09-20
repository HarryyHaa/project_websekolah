<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data siswa</div>
                <div class="card-tools">
                    <?php if ($this->session->userdata('akses') == 1) { ?>
                        <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalimport"><i class="fas fa-fw fa-upload"></i> Import Excel</button>
                    <?php } ?>
                    <a class="btn btn-success" href="<?= base_url('Siswa/export_siswa') ?>" role="button">Export Excel</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm" id="tablesiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <!-- <th>No Peserta</th> -->
                                <th>Nama siswa</th>
                                <th>Level</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <!-- <th>Sesi</th> -->
                                <th>No Hp</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetsiswa'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA SISWA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <form method="post" id="import_form" enctype="multipart/form-data">
                        <p><label>Pilih file Excel xls | xlsx</label><br>
                            <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
                        <br />
                        <input type="submit" name="import" value="Import" class="btn btn-info" />
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <input type="hidden" name='id' id="id" class="form-control" placeholder="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" name='nis' id="nis" class="form-control" placeholder="">
                                <small id="helpnis" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">No HP</label>
                                <input type="text" name='nohp' id="nohp" class="form-control" placeholder="">
                                <small id="helpid" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="level">Tingkatan</label>
                                <select class="form-control" name="level" id="level">
                                    <option value="">Pilih Level</option>
                                    <?php foreach ($level as $level) { ?>
                                        <option value="<?= $level['id_level'] ?>"><?= $level['id_level'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="level">Kelas</label>
                                <select class="form-control" name="kelas" id="kelas">
                                    <option value="">Pilih Kelas</option>
                                    <?php foreach ($kelas as $kelas) { ?>
                                        <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['id_kelas'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <option value="">Pilih Jurusan</option>
                                    <?php foreach ($jurusan as $jurusan) { ?>
                                        <option value="<?= $jurusan['id_jurusan'] ?>"><?= $jurusan['id_jurusan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sesi">Sesi</label>
                                <select class="form-control" name="sesi" id="sesi">
                                    <option value="">Pilih sesi</option>
                                    <?php foreach ($sesi as $sesi) { ?>
                                        <option value="<?= $sesi['id_sesi'] ?>"><?= $sesi['id_sesi'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="">
                                <small id="helpusername" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" placeholder="">
                                <small id="helppassword" class="text-danger"></small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id='btn-submit' class="btn btn-primary">Save changes</button>
                    <button id='btn-edit' class="btn btn-primary" display='none'>Ubah Data</button>
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
            $('#btn-submit').prop('disabled', false);
            $('#btn-edit').hide();
            $('#btn-edit').prop('disabled', true);
            $("[name='nohp']").val('');
            $("[name='nama']").val('');
            $("[name='nis']").val('');
            $("[name='level']").val('');
            $("[name='jurusan']").val('');
            $("[name='kelas']").val('');
            $("[name='sesi']").val('');
            $("[name='username']").val('');
            $("[name='password']").val('');
        } else {
            $('#btn-submit').prop('disabled', true);
            $('#btn-submit').hide();
            $('#btn-edit').show();
            $('#btn-edit').prop('disabled', false);

        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nohp = $("[name='nohp']").val();
        var nis = $("[name='nis']").val();
        var nama = $("[name='nama']").val();
        var level = $("[name='level']").val();
        var jurusan = $("[name='jurusan']").val();
        var sesi = $("[name='sesi']").val();
        var kelas = $("[name='kelas']").val();
        var username = $("[name='username']").val();
        var password = $("[name='password']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('Siswa/tambahdata') ?>",
            data: {
                'nama': nama,
                'nohp': nohp,
                'nis': nis,
                'level': level,
                'jurusan': jurusan,
                'sesi': sesi,
                'kelas': kelas,
                'username': username,
                'password': password
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsiswa').modal('hide');
                    $('#tablesiswa').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Ditambah',
                        position: 'topRight'
                    });
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpid").html(data.id);
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Update Gagal',
                        position: 'topCenter'
                    });
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var nohp = $("[name='nohp']").val();
        var nis = $("[name='nis']").val();
        var nama = $("[name='nama']").val();
        var level = $("[name='level']").val();
        var jurusan = $("[name='jurusan']").val();
        var sesi = $("[name='sesi']").val();
        var kelas = $("[name='kelas']").val();
        var username = $("[name='username']").val();
        var password = $("[name='password']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Siswa/editdata') ?>",
            data: {
                'id': id,
                'nama': nama,
                'nohp': nohp,
                'nis': nis,
                'level': level,
                'jurusan': jurusan,
                'sesi': sesi,
                'kelas': kelas,
                'username': username,
                'password': password
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsiswa').modal('hide');
                    $('#tablesiswa').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Update Berhasil',
                        position: 'topRight'
                    });
                } else if (data == 'gagal') {
                    iziToast.error({
                        title: 'Horee!',
                        message: 'Update Gagal',
                        position: 'topCenter'
                    });
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpid").html(data.id);
                }
            }
        })
    });
    // Delete Records
    $('#tablesiswa').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan menghapus data ini!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Siswa/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablesiswa').DataTable().ajax.reload();
                            iziToast.success({
                                title: 'Hemm!',
                                message: 'Berhasil Dihapus',
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablesiswa').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        pilihform();
        $('#tambahsiswa').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Siswa/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_siswa);
                $("[name='nohp']").val(data[0].no_hp);
                $("[name='nis']").val(data[0].nis);
                $("[name='nama']").val(data[0].nama);
                $("[name='level']").val(data[0].level);
                $("[name='jurusan']").val(data[0].jurusan);
                $("[name='kelas']").val(data[0].kelas);
                $("[name='sesi']").val(data[0].sesi);
                $("[name='username']").val(data[0].username);
            }
        });

    });
    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>Siswa/import_siswa",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#file').val('');
                $('#modalimport').modal('hide');
                notify('data berhasil diimport');
                $('#tablesiswa').DataTable().ajax.reload();
            }
        })
    });
</script>
<script>
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        //data table load setting
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var table = $("#tablesiswa").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#data-table_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: '<p style="color: green"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></p><span class="sr-only">Loading…</span>',

            },
            bprocessing: true,
            bserverSide: true,
            ajax: {
                "url": "<?php echo base_url('Siswa/get_idt_siswa') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 5
                },
                {
                    "data": "nis",
                    "width": 100
                },

                {
                    "data": "nama",
                    "width": 150
                },
                {
                    "data": "level",
                    "width": 50
                },
                {
                    "data": "jurusan",
                    "width": 50
                },
                {
                    "data": "kelas",
                    "width": 50
                },
                {
                    "data": "no_hp",
                    "width": 10
                },
                {
                    "data": "password",
                    "width": 10
                },
                {
                    "data": "action",
                    "width": 100
                }
            ],
            order: [
                [2, 'asc']
            ],

            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }

        });


    });
</script>