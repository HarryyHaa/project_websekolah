<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahkursus"><i class="fas fa-fw fa-plus"></i> Tambah kursus</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-bordered" id="tablekursus" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id='targetkursus'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahkursus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kursus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="mapel">Nama Kursus</label>
                        <select class="form-control" name="mapel" id="mapel">
                            <option value=""></option>
                            <?php foreach ($mapel as $mapel) : ?>
                                <option value="<?= $mapel['nama_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="helpmapel" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Untuk Kelas</label>
                        <select class="select2 form-control" multiple="multiple" name="kelas[]" id="kelas">
                            <option value="semua">Semua</option>
                            <?php foreach ($kelas as $kelas) { ?>
                                <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['id_kelas'] ?></option>
                            <?php } ?>
                        </select>
                        <small id="helpkelas" class="text-danger"></small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Guru">Guru</label>
                                <select class="form-control" name="guru" id="guru">
                                    <?php foreach ($guru as $guru) { ?>
                                        <option value="<?= $guru['id_guru'] ?>"><?= $guru['nama'] ?></option>
                                    <?php } ?>
                                </select>
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

<script>
    $('#tambahkursus').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
    // $(function() {
    //     CKEDITOR.replace('ckeditor', {
    //         filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
    //         height: '300px'
    //     });
    // });

    function notify(pesan) {
        toastr.success(pesan);
    }

    function pilihform(x) {
        if (x == 'tambah') {
            $('#btn-submit').show();
            $('#btn-edit').hide();
            $("[name='id']").val('');
            $("[name='mapel']").val('');
            $("[name='guru']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var mapel = $("[name='mapel']").val();
        var guru = $("[name='guru']").val();
        var status = $("[name='status']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/tambahdata') ?>",
            data: {
                'mapel': mapel,
                'guru': guru,
                'status': status,
                'kelas': kelas
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahkursus').modal('hide');
                    $('#tablekursus').DataTable().ajax.reload();
                    notify('Data berhasil ditambahkan');
                } else {
                    console.log('gagal');
                    $("#helpkelas").html(data.kelas);
                    $("#helpmapel").html(data.mapel);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var id = $("[name='id']").val();
        var mapel = $("[name='mapel']").val();
        var guru = $("[name='guru']").val();
        var status = $("[name='status']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/editdata') ?>",
            data: {
                'id': id,
                'mapel': mapel,
                'guru': guru,
                'status': status,
                'kelas': kelas
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahkursus').modal('hide');
                    $('#tablekursus').DataTable().ajax.reload();
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpkelas").html(data.kelas);
                    $("#helpmapel").html(data.mapel);
                }
            }
        })
    });
    // Delete Records
    $('#tablekursus').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Kursus/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablekursus').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablekursus').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahkursus').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_kursus);
                $("[name='mapel']").val(data[0].id_mapel);
                $("[name='guru']").val(data[0].id_guru);
                $("[name='status']").val(data[0].status);
                $("[name='kelas[]']").val(data[0].kelas);
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

        var table = $("#tablekursus").dataTable({
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
                "url": "<?php echo base_url('Kursus/get_idt_kursus') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "id_mapel",
                    "width": 100
                },

                {
                    "data": "kelas"
                },
                {
                    "data": "id_guru"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action",
                    "width": 100
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