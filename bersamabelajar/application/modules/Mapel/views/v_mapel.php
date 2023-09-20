<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data mapel</div>
                <div class="card-tools">
                    <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahmapel"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalimport"><i class="fas fa-fw fa-upload"></i> Import Excel</button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tablemapel" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID mapel</th>
                                <th>Nama mapel</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetmapel'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA MAPEL</h5>
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
<div class="modal fade" id="tambahmapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">

                    </div>
                    <div class="form-group">
                        <label for="nama">Id mapel</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="">
                        <small id="helpid" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama mapel</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
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
            $("[name='id']").prop('readonly', false);
            $("[name='id']").val('');
            $("[name='nama']").val('');
        } else {
            $('#btn-submit').prop('disabled', true);
            $('#btn-submit').hide();
            $('#btn-edit').show();
            $('#btn-edit').prop('disabled', false);
            $("[name='id']").prop('readonly', true);
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nama = $("[name='nama']").val();
        var id = $("[name='id']").val();
        console.log(nama + id);
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Mapel/tambahdata') ?>",
            data: 'nama=' + nama + '&id=' + id,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahmapel').modal('hide');
                    $('#tablemapel').DataTable().ajax.reload();
                    $("[name='nama']").val('');
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

        var nama = $("[name='nama']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('Mapel/editdata') ?>",
            data: 'id=' + id + '&nama=' + nama,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahmapel').modal('hide');
                    $('#tablemapel').DataTable().ajax.reload();
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
    $('#tablemapel').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Mapel/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablemapel').DataTable().ajax.reload();
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
    $('#tablemapel').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        pilihform();
        $('#tambahmapel').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Mapel/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_mapel);
                $("[name='nama']").val(data[0].nama_mapel);
            }
        });

    });
    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>Mapel/import_mapel",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#file').val('');
                $('#modalimport').modal('hide');
                iziToast.success({
                    title: 'Hemm!',
                    message: 'Berhasil Diimport',
                    position: 'topRight'
                });
                $('#tablemapel').DataTable().ajax.reload();
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

        var table = $("#tablemapel").dataTable({
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
                "url": "<?php echo base_url('Mapel/get_idt_mapel') ?>",
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
                    "data": "nama_mapel",
                    "width": 100
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