<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahkelas"><i class="fas fa-fw fa-plus"></i> Tambah kelas</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tablekelas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID KELAS</th>
                                <th>NAMA KELAS</th>
                                <th>JURUSAN</th>
                                <th>JENJANG</th>
                                <th>WALAS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetkelas'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahkelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">

                    </div>
                    <div class="form-group">
                        <label for="nama">Id kelas</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="">
                        <small id="helpid" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama kelas</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Jurusan</label>
                        <select class="form-control" name="jurusan" id="jurusan">
                            <?php foreach ($jurusan as $jurusan) : ?>
                                <option value='<?= $jurusan['id'] ?>'><?= $jurusan['id'] . ' - ' . $jurusan['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Pilih Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang">
                            <?php foreach ($jenjang as $jenjang) : ?>
                                <option value='<?= $jenjang['id'] ?>'><?= $jenjang['id'] . ' - ' . $jenjang['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilih Walas</label>
                        <select class="form-control" name="walas" id="walas">
                            <option value="">Pilih Walas</option>
                            <?php foreach ($walas as $walas) : ?>
                                <option value='<?= $walas['nip'] ?>'><?= $walas['nip'] . ' - ' . $walas['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
            $("[name='id']").prop('readonly', false);
            $("[name='id']").val('');
            $("[name='nama']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
            $("[name='id']").prop('readonly', true);
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nama = $("[name='nama']").val();
        var id = $("[name='id']").val();
        var jenjang = $("[name='jenjang']").val();
        var jur = $("[name='jurusan']").val();
        var walas = $("[name='walas']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('kelas/tambahdata') ?>",
            data: '&nama=' + nama + '&id=' + id + '&jenjang=' + jenjang + '&jurusan=' + jur + '&walas=' + walas,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahkelas').modal('hide');
                    $('#tablekelas').DataTable().ajax.reload();
                    $("[name='nama']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpid").html(data.id);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var jenjang = $("[name='jenjang']").val();
        var nama = $("[name='nama']").val();
        var jur = $("[name='jurusan']").val();
        var walas = $("[name='walas']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('kelas/editdata') ?>",
            data: 'id=' + id + '&nama=' + nama + '&jenjang=' + jenjang + '&jurusan=' + jur + '&walas=' + walas,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahkelas').modal('hide');
                    $('#tablekelas').DataTable().ajax.reload();
                    $("[name='nama']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpid").html(data.id);
                }
            }
        })
    });
    // Delete Records
    $('#tablekelas').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>kelas/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablekelas').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablekelas').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahkelas').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>kelas/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id);
                $("[name='nama']").val(data[0].nama);
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

        var table = $("#tablekelas").dataTable({
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
                "url": "<?php echo base_url('kelas/get_idt_kelas') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "id",
                    "width": 100
                },
                {
                    "data": "nama",
                    "width": 100
                },
                {
                    "data": "jurusan",
                    "width": 100
                },
                {
                    "data": "jenjang",
                    "width": 100
                },
                {
                    "data": "walas",
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