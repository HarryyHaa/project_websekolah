<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data soal</div>
                <div class="card-tools">
                    <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsoal"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 11px" class="table table-bordered table-sm" id="tablesoal" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Guru</th>
                                <th>Jurusan</th>
                                <th>Level</th>
                                <th>Kelas</th>
                                <th>PG</th>
                                <th>Esai</th>
                                <th>Opsi</th>
                                <th>KKM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetsoal'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahsoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <input type="hidden" name='id' id="id" class="form-control" placeholder="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Nama Bank Soal</label>
                                <input type="text" name='nama' id="nama" class="form-control" placeholder="">
                                <small id="helpid" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="mapel">Nama Mapel</label>
                                <select class="form-control " name="mapel" id="mapel">
                                    <option value="">Pilih mapel</option>
                                    <?php foreach ($mapel as $mapel) { ?>
                                        <option value="<?= $mapel['id_mapel'] ?>"><?= $mapel['id_mapel'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="helpmapel" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="level">Tingkatan</label>
                                <select class="select2 form-control" multiple="multiple" name="level[]" id="level">
                                    <option value="semua">Semua</option>
                                    <?php foreach ($level as $level) { ?>
                                        <option value="<?= $level['id_level'] ?>"><?= $level['id_level'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="helplevel" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="level">Kelas</label>
                                <select class="select2 form-control" multiple="multiple" name="kelas[]" id="kelas">
                                    <option value="semua">Semua</option>
                                    <?php foreach ($kelas as $kelas) { ?>
                                        <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['id_kelas'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="helpkelas" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="select2bs4 form-control" multiple="multiple" name="jurusan[]" id="jurusan">
                                    <option value="semua">Semua</option>
                                    <?php foreach ($jurusan as $jurusan) { ?>
                                        <option value="<?= $jurusan['id_jurusan'] ?>"><?= $jurusan['id_jurusan'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="helpjurusan" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kkm">KKM</label>
                                <input type="text" name='kkm' id="kkm" class="form-control" placeholder="">
                                <small id="helpkkm" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="opsi">Opsi</label>
                                <select name='opsi' id="opsi" class="form-control" placeholder="">
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <small id="helpopsi" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="jmlpg">Soal PG</label>
                                <input type="text" name="jmlpg" id="jmlpg" class="form-control" placeholder="">
                                <small id="helpjmlpg" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="bobotpg">Bobot PG</label>
                                <input type="text" name="bobotpg" id="bobotpg" class="form-control" placeholder="">
                                <small id="helpbobotpg" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="jmlesai">Soal esai</label>
                                <input type="text" name="jmlesai" id="jmlesai" class="form-control" placeholder="">
                                <small id="helpjmlesai" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="bobotesai">Bobot esai</label>
                                <input type="text" name="bobotesai" id="bobotesai" class="form-control" placeholder="">
                                <small id="helpbobotesai" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="guru">Guru Pengampu</label>
                                <select class="select2bs4 form-control" name="guru" id="guru">
                                    <?php foreach ($guru as $guru) { ?>
                                        <option value="<?= $guru['id_guru'] ?>"><?= $guru['nama'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="helpguru" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="agama">Soal Agama</label>
                                <input type="text" name='agama' id="agama" class="form-control" placeholder="">
                                <small id="helpagama" class="text-danger"></small>
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
            $("[name='nopes']").val('');
            $("[name='nama']").val('');
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
        var mapel = $("[name='mapel']").val();
        var nama = $("[name='nama']").val();
        var level = $("[name='level[]']").val();
        var jurusan = $("[name='jurusan[]']").val();
        var kelas = $("[name='kelas[]']").val();
        var jmlpg = $("[name='jmlpg']").val();
        var jmlesai = $("[name='jmlesai']").val();
        var bobotpg = $("[name='bobotpg']").val();
        var bobotesai = $("[name='bobotesai']").val();
        var opsi = $("[name='opsi']").val();
        var guru = $("[name='guru']").val();
        var kkm = $("[name='kkm']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Soal/tambahbank') ?>",
            data: {
                'nama': nama,
                'mapel': mapel,
                'level': level,
                'jurusan': jurusan,
                'kelas': kelas,
                'jmlpg': jmlpg,
                'jmlesai': jmlesai,
                'bobotpg': bobotpg,
                'bobotesai': bobotesai,
                'opsi': opsi,
                'guru': guru,
                'kkm': kkm
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsoal').modal('hide');
                    $('#tablesoal').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Ditambah',
                        position: 'topRight'
                    });
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpmapel").html(data.mapel);
                    $("#helpjmlpg").html(data.jmlpg);
                    $("#helpbobotpg").html(data.bobotpg);
                    $("#helpjmlesai").html(data.jmlesai);
                    $("#helpbobotesai").html(data.bobotesai);
                    $("#helpopsi").html(data.opsi);
                    $("#helpkkm").html(data.kkm);
                    $("#helpguru").html(data.guru);
                    iziToast.error({
                        title: 'Maaf!',
                        message: data,
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
        var mapel = $("[name='mapel']").val();
        var nama = $("[name='nama']").val();
        var level = $("[name='level[]']").val();
        var jurusan = $("[name='jurusan[]']").val();
        var kelas = $("[name='kelas[]']").val();
        var jmlpg = $("[name='jmlpg']").val();
        var jmlesai = $("[name='jmlesai']").val();
        var bobotpg = $("[name='bobotpg']").val();
        var bobotesai = $("[name='bobotesai']").val();
        var guru = $("[name='guru']").val();
        var kkm = $("[name='kkm']").val();
        var opsi = $("[name='opsi']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Soal/editbank') ?>",
            data: {
                'id': id,
                'nama': nama,
                'mapel': mapel,
                'level': level,
                'jurusan': jurusan,
                'kelas': kelas,
                'jmlpg': jmlpg,
                'jmlesai': jmlesai,
                'bobotpg': bobotpg,
                'bobotesai': bobotesai,
                'opsi': opsi,
                'guru': guru,
                'kkm': kkm
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsoal').modal('hide');
                    $('#tablesoal').DataTable().ajax.reload();
                    $("[name='nama']").val('');
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
    $('#tablesoal').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Soal/hapusbank",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablesoal').DataTable().ajax.reload();
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
    $('#tablesoal').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        pilihform();
        $('#tambahsoal').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Soal/ambilidbank",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {

                $("[name='id']").val(data[0].id_banksoal);
                $("[name='nama']").val(data[0].nama_banksoal);
                $("[name='mapel']").val(data[0].mapel);
                $("[name='jurusan[]']").val(data[0].jurusan);
                $("[name='kelas[]']").val(data[0].kelas);
                $("[name='jmlpg']").val(data[0].jml_pg);
                $("[name='jmlesai']").val(data[0].jml_esai);
                $("[name='bobotpg']").val(data[0].bobot_pg);
                $("[name='bobotesai']").val(data[0].bobot_esai);
                $("[name='opsi']").val(data[0].opsi);
                $("[name='kkm']").val(data[0].kkm);
            }
        });

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

        var table = $("#tablesoal").dataTable({
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
                "url": "<?php echo base_url('Soal/get_idt_bank') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 5
                },
                {
                    "data": "nama_banksoal",
                    "width": 100
                },
                {
                    "data": "guru",
                    "width": 100
                },
                {
                    "data": "jurusan",
                    "width": 50
                },
                {
                    "data": "level",
                    "width": 50
                },
                {
                    "data": "kelas",
                    "width": 50
                },
                {
                    "data": "jml_pg",
                    "width": 10
                },
                {
                    "data": "jml_esai",
                    "width": 10
                },
                {
                    "data": "opsi",
                    "width": 10
                },
                {
                    "data": "kkm",
                    "width": 10
                },
                {
                    "data": "action",
                    "width": 50
                }
            ],
            order: [
                [2, 'desc']
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