<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <?php if ($this->session->userdata('akses') == 2) {
                    $idguru = $this->session->userdata('iduser');
                } else {
                    $idguru = "";
                } ?>
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahagenda"><i class="fas fa-fw fa-plus"></i> Tambah agenda</button>
                <a class="btn btn-success" href="<?= base_url('Agenda/export_agenda/') . $idguru ?>" role="button"><i class="fas fa-file-excel    "></i> Export Excel</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-bordered" id="tableagenda" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pembelajaran</th>
                                <th>Pembahasan</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id='targetagenda'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahagenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control" placeholder="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kursus">Nama Pembelajaran</label>
                                <select class="form-control" name="kursus" id="kursus">
                                    <option value=""></option>
                                    <?php foreach ($kursus as $kursus) : ?>
                                        <option value="<?= $kursus['id_kursus'] ?>"><?= $kursus['id_mapel'] ?></option>
                                    <?php endforeach; ?>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agenda">Tanggal</label>
                                <input type="text" name="tgl" id="tgl" class="tanggal form-control" placeholder="">
                                <small id="helptanggal" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label for="agenda">Jam Mulai</label>
                                <input type="text" name="mulai" id="mulai" class="waktu form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label for="agenda">Jam Selesai</label>
                                <input type="text" name="selesai" id="selesai" class="waktu form-control" placeholder="">

                            </div>
                        </div>
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
                    <div class="form-group">
                        <label for="kegiatan">Agenda Kegiatan</label>
                        <textarea id="ckeditor" class="form-control" name="kegiatan"></textarea>
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
    $('#tambahagenda').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
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
            $("[name='id']").val('');
            $("[name='kursus']").val('');
            $("[name='tgl']").val('');
            CKEDITOR.instances['ckeditor'].setData('');
            $("[name='mulai']").val('');
            $("[name='selesai']").val('');
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
        var kursus = $("[name='kursus']").val();
        var guru = $("[name='guru']").val();
        var tgl = $("[name='tgl']").val();
        var kegiatan = $("[name='kegiatan']").val();
        var mulai = $("[name='mulai']").val();
        var selesai = $("[name='selesai']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Agenda/tambahdata') ?>",
            data: {
                'kursus': kursus,
                'guru': guru,
                'tgl': tgl,
                'mulai': mulai,
                'selesai': selesai,
                'kelas': kelas,
                'kegiatan': kegiatan
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahagenda').modal('hide');
                    $('#tableagenda').DataTable().ajax.reload();
                    notify('Data berhasil ditambahkan');
                } else {
                    // console.log('gagal');
                    // $("#helpkd").html(data.kd);
                    // $("#helpagenda").html(data.agenda);
                    // $("#helpjumlah").html(data.jumlah);
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
        var kursus = $("[name='kursus']").val();
        var guru = $("[name='guru']").val();
        var tgl = $("[name='tgl']").val();
        var kegiatan = $("[name='kegiatan']").val();
        var mulai = $("[name='mulai']").val();
        var selesai = $("[name='selesai']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Agenda/editdata') ?>",
            data: {
                'id': id,
                'kursus': kursus,
                'guru': guru,
                'tgl': tgl,
                'mulai': mulai,
                'selesai': selesai,
                'kelas': kelas,
                'kegiatan': kegiatan
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahagenda').modal('hide');
                    $('#tableagenda').DataTable().ajax.reload();
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    // $("#helpkd").html(data.kd);
                    // $("#helpagenda").html(data.agenda);
                    // $("#helpjumlah").html(data.jumlah);
                }
            }
        })
    });
    // Delete Records
    $('#tableagenda').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Agenda/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tableagenda').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tableagenda').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahagenda').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Agenda/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_agenda);
                $("[name='kursus']").val(data[0].id_kursus);
                $("[name='guru']").val(data[0].id_guru);
                $("[name='tgl']").val(data[0].tgl);
                CKEDITOR.instances['ckeditor'].setData(data[0].kegiatan);
                $("[name='mulai']").val(data[0].jam_mulai);
                $("[name='selesai']").val(data[0].jam_selesai);
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

        var table = $("#tableagenda").dataTable({
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
                "url": "<?php echo base_url('Agenda/get_idt_agenda') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "id_mapel",

                },
                {
                    "data": "kegiatan",
                    "width": 100
                },
                {
                    "data": "kelas"
                },
                {
                    "data": "tgl"
                },
                {
                    "data": "jam_mulai"
                },
                {
                    "data": "jam_selesai"
                },

                {
                    "data": "action",
                    "width": 70
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