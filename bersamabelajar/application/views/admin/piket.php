<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahpiket"><i class="fas fa-fw fa-plus"></i> Tambah piket</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="tablepiket" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Nip</th>
                                <th>Nama</th>
                                <th>Shift</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetpiket'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahpiket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data piket</h5>
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
                        <label for="nip">Pilih Hari</label>
                        <select class="form-control" name="hari" id="hari">
                            <option value="">Pilih Hari</option>
                            <option value='Senin'>Senin</option>
                            <option value='Selasa'>Selasa</option>
                            <option value='Rabu'>Rabu</option>
                            <option value='Kamis'>Kamis</option>
                            <option value='Jumat'>Jumat</option>
                            <option value='Sabtu'>Sabtu</option>
                        </select>
                        <small id="helphari" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip">Nama Guru</label>
                        <select class="form-control" name="nip" id="nip">
                            <option value="">Pilih Guru</option>
                            <?php foreach ($guru as $guru) : ?>
                                <option value='<?= $guru['nip'] ?>'><?= $guru['nip'] . ' - ' . $guru['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="helpnip" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip">Shift Piket</label>
                        <select class="form-control" name="shift" id="shift">
                            <option value="">Pilih Shift</option>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                        </select>
                        <small id="helpshift" class="text-danger"></small>
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
            $("[name='hari']").val('');
            $("[name='shift']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }

    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nip = $("[name='nip']").val();
        var hari = $("[name='hari']").val();
        var shift = $("[name='shift']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('piket/tambahdata') ?>",
            data: '&nip=' + nip + '&hari=' + hari + '&shift=' + shift,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahpiket').modal('hide');
                    $('#tablepiket').DataTable().ajax.reload();
                    $("[name='nip']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    $("#helpnip").html(data.nip);
                    $("#helphari").html(data.hari);
                    $("#helpshift").html(data.shift);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var nip = $("[name='nip']").val();
        var hari = $("[name='hari']").val();
        var shift = $("[name='shift']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('piket/editdata') ?>",
            data: 'id=' + id + '&nip=' + nip + '&hari=' + hari + '&shift=' + shift,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahpiket').modal('hide');
                    $('#tablepiket').DataTable().ajax.reload();
                    $("[name='nip']").val('');
                    $("[name='hari']").val('');
                    $("[name='shift']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpnip").html(data.nip);
                    $("#helphari").html(data.hari);
                    $("#helpshift").html(data.shift);
                }
            }
        })
    });
    // Delete Records
    $('#tablepiket').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>piket/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablepiket').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablepiket').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahpiket').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>piket/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id);
                $("[name='nip']").val(data[0].nip);
                $("[name='hari']").val(data[0].hari);
                $("[name='shift']").val(data[0].shift);

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

        var table = $("#tablepiket").dataTable({
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
                "url": "<?php echo base_url('piket/get_idt_piket') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "hari",
                    "width": 100
                },
                {
                    "data": "nip",
                    "width": 100
                },
                {
                    "data": "nama",
                    "width": 100
                },
                {
                    "data": "shift",
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