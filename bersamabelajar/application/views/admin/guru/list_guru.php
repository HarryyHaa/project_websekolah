<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahguru"><i class="fas fa-fw fa-plus"></i> Tambah guru</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalimport"><i class="fas fa-fw fa-upload"></i> Import Excel</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="tableguru" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                                <th>JENKEL</th>
                                <th>ALAMAT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetguru'>

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
<div class="modal fade" id="tambahguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data guru</h5>
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
                        <label for="nip">Nip Guru</label>
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="">
                        <small id="helpnip" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama guru</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
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
            $("[name='nip']").val('');
            $("[name='nama']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>import/import_guru",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#file').val('');
                $('#modalimport').modal('hide');
                notify('data berhasil diimport');
                $('#tableguru').DataTable().ajax.reload();
            }
        })
    });
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nip = $("[name='nip']").val();
        var nama = $("[name='nama']").val();
        var aktif = $("[name='is_active']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/tambahdata') ?>",
            data: 'nip=' + nip + '&nama=' + nama + '&aktif=' + aktif,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahguru').modal('hide');
                    $('#tableguru').DataTable().ajax.reload();
                    $("[name='nip']").val('');
                    $("[name='nama']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    $("#helpnip").html(data.nip);
                    $("#helpnama").html(data.nama);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var nip = $("[name='nip']").val();
        var nama = $("[name='nama']").val();
        var aktif = $("[name='is_active']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/editdata') ?>",
            data: 'id=' + id + '&nip=' + nip + '&nama=' + nama + '&aktif=' + aktif,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahguru').modal('hide');
                    $('#tableguru').DataTable().ajax.reload();
                    $("[name='nip']").val('');
                    $("[name='nama']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpnip").html(data.nip);
                    $("#helpnama").html(data.nama);
                }
            }
        })
    });
    // Delete Records
    $('#tableguru').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>guru/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tableguru').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
     $('#tableguru').on('click', '.edit', function() {
        var id = $(this).data('id');
        window.location.href = "<?php echo base_url('guru/profil/'); ?>" + id;
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

        var table = $("#tableguru").dataTable({
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
                "url": "<?php echo base_url('guru/get_idt_guru') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "nip",
                    "width": 100
                },
                {
                    "data": "nama"
                },
                {
                    "data": "jenkel",
                    "width": 100
                },
                {
                    "data": "alamat",
                    "width": 100
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