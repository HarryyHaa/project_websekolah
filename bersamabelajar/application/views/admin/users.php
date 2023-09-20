<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahusers"><i class="fas fa-fw fa-plus"></i> Tambah users</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableusers" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>EMAIL</th>
                                <th>NAMA</th>

                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetusers'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahusers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data users</h5>
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
                        <label for="email">email users</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="">
                        <small id="helpemail" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama users</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="text" name="pass" id="pass" class="form-control" placeholder="">
                        <small id="helppass" class="text-danger"></small>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" checked>
                            is active ?
                        </label>
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
            $('#btn-edit').hide();
            $("[name='email']").val('');
            $("[name='nama']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var email = $("[name='email']").val();
        var nama = $("[name='nama']").val();
        var password = $("[name='pass']").val();
        var aktif = $("[name='is_active']").val();
        console.log(email + nama + password)
        $.ajax({
            type: 'POST',
            url: "<?= base_url('users/tambahdata') ?>",
            data: 'email=' + email + '&nama=' + nama + '&password=' + password + '&aktif=' + aktif,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahusers').modal('hide');
                    $('#tableusers').DataTable().ajax.reload();
                    $("[name='email']").val('');
                    $("[name='nama']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    console.log('gagal');
                    $("#helpemail").html(data.email);
                    $("#helpnama").html(data.nama);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var email = $("[name='email']").val();
        var nama = $("[name='nama']").val();
        var password = $("[name='password']").val();
        var aktif = $("[name='is_active']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('users/editdata') ?>",
            data: 'id=' + id + '&email=' + email + '&nama=' + nama + '&password=' + password + '&aktif=' + aktif,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahusers').modal('hide');
                    $('#tableusers').DataTable().ajax.reload();
                    $("[name='email']").val('');
                    $("[name='nama']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpemail").html(data.email);
                    $("#helpnama").html(data.nama);
                }
            }
        })
    });
    // Delete Records
    $('#tableusers').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan menghapus data ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>users/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tableusers').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tableusers').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahusers').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>users/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id);
                $("[name='email']").val(data[0].email);
                $("[name='nama']").val(data[0].name);
               // $("[name='pass']").val(data[0].password);
                console.log(data)
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

        var table = $("#tableusers").dataTable({
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
                "url": "<?php echo base_url('users/get_idt_users') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "email",
                    "width": 100
                },
                {
                    "data": "name"
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