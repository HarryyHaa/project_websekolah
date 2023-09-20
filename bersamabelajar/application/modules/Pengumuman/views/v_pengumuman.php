<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahpengumuman"><i class="fas fa-fw fa-plus"></i> Tambah pengumuman</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablepengumuman" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pengumuman</th>
                                <th>Untuk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetpengumuman'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data pengumuman</h5>
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
                        <label for="username">Judul Pengumuman</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="">
                        <small id="helpjudul" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pengumuman</label>
                        <textarea id="ckeditor" class="form-control" name="isi"></textarea>
                        <small id="helpisi" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" name="jenis" id="jenis">
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
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

<script>
    $(function() {
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
            height: '300px'
        });
    });

    function notify(pesan) {
        toastr.success(pesan);
    }

    function pilihform(x) {
        if (x == 'tambah') {
            $('#btn-submit').show();
            $('#btn-edit').hide();
            $("[name='judul']").val('');
            $("[name='isi']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var judul = $("[name='judul']").val();
        var isi = $("[name='isi']").val();
        var jenis = $("[name='jenis']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Pengumuman/tambahdata') ?>",
            data: 'judul=' + judul + '&isi=' + isi + '&jenis=' + jenis,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahpengumuman').modal('hide');
                    $('#tablepengumuman').DataTable().ajax.reload();
                    $("[name='judul']").val('');
                    $("[name='isi']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    console.log('gagal');
                    $("#helpjudul").html(data.judul);
                    $("#helpisi").html(data.isi);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var id = $("[name='id']").val();
        var judul = $("[name='judul']").val();
        var isi = $("[name='isi']").val();
        var jenis = $("[name='jenis']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Pengumuman/editdata') ?>",
            data: 'id=' + id + '&judul=' + judul + '&isi=' + isi + '&jenis=' + jenis,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahpengumuman').modal('hide');
                    $('#tablepengumuman').DataTable().ajax.reload();
                    $("[name='judul']").val('');
                    $("[name='isi']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpjudul").html(data.judul);
                    $("#helpisi").html(data.isi);
                }
            }
        })
    });
    // Delete Records
    $('#tablepengumuman').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Pengumuman/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablepengumuman').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablepengumuman').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahpengumuman').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Pengumuman/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_pengumuman);
                $("[name='judul']").val(data[0].judul);
                $("[name='isi']").val(data[0].text);
                $("[name='jenis']").val(data[0].type);
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

        var table = $("#tablepengumuman").dataTable({
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
                "url": "<?php echo base_url('Pengumuman/get_idt_pengumuman') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "judul",
                    "width": 100
                },
                {
                    "data": "text"
                },
                {
                    "data": "type"
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