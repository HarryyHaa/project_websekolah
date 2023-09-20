<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalimport"><i class="fas fa-fw fa-upload"></i> Import Excel</button>
                <a class="btn btn-success" href="<?= base_url('import/export_siswa') ?>"><i class="fas fa-fw fa-download"></i> Export Excel</a>
                <a class="btn btn-primary" href="<?= base_url('import/export_siswainduk') ?>"><i class="fas fa-fw fa-download"></i> Format Buku Induk</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="tablesiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>KELAS</th>
                                <th>JURUSAN</th>
                                <th>NISN</th>
                                <th>NIK</th>
                                <th>TEMPAT</th>
                                <th>TGL LAHIR</th>
                                <th>IBU</th>
                                <th>ACTION</th>
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
<!-- Button trigger modal -->

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
                    <div class="alert alert-danger" style="display:none">

                    </div>

                    <input type="hidden" name="id" id="id" class="form-control" placeholder="">

                    <div class="form-group">
                        <label for="nama">NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control" placeholder="">
                        <small id="helpnis" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jk">Pilih Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama">Kelas</label>
                                <select class="form-control" name="kelas" id="kelas">
                                    <?php foreach ($kelas as $kelas) : ?>
                                        <option value='<?= $kelas['id'] ?>'><?= $kelas['id'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nama">Jurusan</label>
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <?php foreach ($jurusan as $jurusan) : ?>
                                        <option value='<?= $jurusan['id'] ?>'><?= $jurusan['id'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- <small id="helpnama" class="text-danger"></small> -->
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Pilih Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang">
                            <?php foreach ($jenjang as $jenjang) : ?>
                                <option value='<?= $jenjang['id'] ?>'><?= $jenjang['id'] . ' - ' . $jenjang['nama'] ?></option>
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
            $("[name='nis']").val('');
            $("[name='nama']").val('');

        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();

        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nama = $("[name='nama']").val();
        var kelas = $("[name='kelas']").val();
        var nis = $("[name='nis']").val();
        var jurusan = $("[name='jurusan']").val();
        var jenjang = $("[name='jenjang']").val();
        var jenkel = $("[name='jenkel']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/tambahdata') ?>",
            data: 'nama=' + nama + '&nis=' + nis + '&kelas=' + kelas + '&jurusan=' + jurusan + '&jenjang=' + jenjang + '&jenkel=' + jenkel,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsiswa').modal('hide');
                    $('#tablesiswa').DataTable().ajax.reload();
                    $("[name='nama']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpnis").html(data.nis);
                    $("#helpasal").html(data.kelas);
                    $("#helptempat").html(data.jurusan);
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

        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/editdata') ?>",
            data: 'id=' + id + '&nama=' + nama + '&jenjang=' + jenjang,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsiswa').modal('hide');
                    $('#tablesiswa').DataTable().ajax.reload();
                    $("[name='nama']").val('');
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpnama").html(data.nama);

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
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>siswa/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablesiswa').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
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
        window.location.href = "<?php echo base_url('siswa/edit/'); ?>" + id;
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

    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>import/import_siswa",
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
                "url": "<?php echo base_url('siswa/get_idt_siswa') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "nis",
                    "width": 100
                },
                {
                    "data": "nama",
                    "width": 100
                },
                {
                    "data": "kelas",
                    "width": 100
                },
                {
                    "data": "jurusan",
                    "width": 100
                },
                {
                    "data": "nisn",
                    "width": 100
                },
                {
                    "data": "nik",
                    "width": 100
                },
                {
                    "data": "tempat_lahir",
                    "width": 100
                },
                {
                    "data": "tgl_lahir",
                    "width": 100
                },
                {
                    "data": "nama_ibu",
                    "width": 100
                },
                {
                    "data": "action",
                    "width": 50
                }
            ],
            order: [
                [1, 'asc']
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