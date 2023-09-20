<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data level</div>
                <div class="card-tools">
                    <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahlevel"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tablelevel" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID level</th>
                                <th>Nama level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetlevel'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahlevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">

                    </div>
                    <div class="form-group">
                        <label for="nama">Id level</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="">
                        <small id="helpid" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama level</label>
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
            url: "<?= base_url('Level/tambahdata') ?>",
            data: 'nama=' + nama + '&id=' + id,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahlevel').modal('hide');
                    $('#tablelevel').DataTable().ajax.reload();
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
            url: "<?= base_url('Level/editdata') ?>",
            data: 'id=' + id + '&nama=' + nama,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahlevel').modal('hide');
                    $('#tablelevel').DataTable().ajax.reload();
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
    $('#tablelevel').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Level/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablelevel').DataTable().ajax.reload();
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
    $('#tablelevel').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        pilihform();
        $('#tambahlevel').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Level/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_level);
                $("[name='nama']").val(data[0].nama_level);
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

        var table = $("#tablelevel").dataTable({
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
                "url": "<?php echo base_url('Level/get_idt_level') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "id_level",
                    "width": 100
                },
                {
                    "data": "nama_level",
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