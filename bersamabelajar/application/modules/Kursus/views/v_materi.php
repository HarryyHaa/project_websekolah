<!-- <div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $this->db->get_where('siswa', ['status' => 1])->num_rows() ?></h3>

                <p>JUMLAH SISWA</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-edit"></i>
                    Materi
                </h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahmateri"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-bordered" id="tablemateri" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pert-</th>
                                <th>KD</th>
                                <th>Materi</th>
                                <th>Tgl Dibuka</th>
                                <th>Aksi</th>
                                <th>Kuis</th>
                            </tr>
                        </thead>
                        <tbody id='targetmateri'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-edit"></i>
                    Daftar Tugas Khusus
                </h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" onclick="pilihform2('tambah')" data-toggle="modal" data-target="#tambahtugas"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-bordered" id="tabletugas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tgl DiBuka</th>
                                <th>Tgl Ditutup</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id='targettugas'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="tambahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 0px !important;">
    <div class="modal-dialog full_modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data materi</h5>
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
                                <label for="kd">KD 3 / 4</label>
                                <input type="text" name="kd" id="kd" class="form-control" placeholder="">
                                <small id="helpkd" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Pertemuan">Pertemuan</label>
                                <input type="number" name="pertemuan" id="pertemuan" class="form-control">
                                <small id="helppertemuan" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi Pokok</label>
                        <input type="text" name="materi" id="materi" class="form-control" placeholder="">
                        <small id="helpmateri" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="isi">Pembahasan Materi</label>
                        <textarea id="ckeditor" class=" form-control" name="isi"></textarea>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="buka">Tgl Dibuka</label>
                                <input type="text" name="buka" id="buka" class="tanggalwaktu form-control" placeholder="" autocomplete="off">
                                <small id="helpbuka" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tutup">Tgl Ditutup</label>
                                <input type="text" name="tutup" id="tutup" class="tanggalwaktu form-control" placeholder="" autocomplete="off">
                                <small id="helptutup" class="text-danger"></small>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="tutup">Lampiran File</label>-->
                            <!--    <input type="file" name="file" id="file" class="form-control" >-->

                            <!--</div>-->

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jawab">Kuis</label>
                                <select class="form-control" name="kuis" id="kuis">
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <select class="form-control" name="komentar" id="komentar">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jawab">Form Upload</label>
                                <select class="form-control" name="jawab" id="jawab">
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Guru">Guru</label>
                                <select class="form-control" name="guru" id="guru">
                                    <?php foreach ($guru as $gurux) { ?>
                                        <option value="<?= $gurux['id_guru'] ?>"><?= $gurux['nama'] ?></option>
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

<div class="modal fade" id="tambahtugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-modal2'>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">
                    </div>
                    <input type="hidden" name="idtugas" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="tugas">Judul Tugas</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="">
                        <small id="helptugas" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="tugas">Deskripsi Tugas</label>
                        <textarea id="ckeditor2" class=" form-control" name="tugas"></textarea>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="buka">Tgl Dibuka</label>
                                <input type="text" name="bukatugas" class="tanggalwaktu form-control" placeholder="" autocomplete="off">
                                <small id="helpbuka" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tutup">Tgl Ditutup</label>
                                <input type="text" name="tutuptugas" class="tanggalwaktu form-control" placeholder="" autocomplete="off">
                                <small id="helptutup" class="text-danger"></small>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <select class="form-control" name="komentartugas">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Guru">Guru</label>
                                <select class="form-control" name="gurutugas">
                                    <?php foreach ($guru as $gurus) { ?>
                                        <option value="<?= $gurus['id_guru'] ?>"><?= $gurus['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id='btn-submit2' class="btn btn-primary">Save changes</button>
                    <button id='btn-edit2' class="btn btn-primary" display='none'>Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#tambahmateri').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
    $(function() {
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
            height: '300px'
        });
    });
    $(function() {
        CKEDITOR.replace('ckeditor2', {
            filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
            height: '300px'
        });
    });


    function pilihform(x) {
        if (x == 'tambah') {
            $('#btn-submit').show();
            $('#btn-edit').hide();
            $("[name='id']").val('');
            $("[name='pertemuan']").val('');
            $("[name='kd']").val('');
            $("[name='materi']").val('');
            CKEDITOR.instances['ckeditor'].setData('');
            $("[name='buka']").val('');
            $("[name='tutup']").val('');

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
        var pertemuan = $("[name='pertemuan']").val();
        var kd = $("[name='kd']").val();
        var materi = $("[name='materi']").val();
        var isi = $("[name='isi']").val();
        var buka = $("[name='buka']").val();
        var tutup = $("[name='tutup']").val();
        var guru = $("[name='guru']").val();
        var komentar = $("[name='komentar']").val();
        var jawab = $("[name='jawab']").val();
        var kuis = $("[name='kuis']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/add_materi') ?>",
            data: {
                'pertemuan': pertemuan,
                'kd': kd,
                'materi': materi,
                'isi': isi,
                'buka': buka,
                'tutup': tutup,
                'guru': guru,
                'komentar': komentar,
                'id_kursus': <?= $id_kursus ?>,
                'jawab': jawab,
                'kuis': kuis
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahmateri').modal('hide');
                    $('#tablemateri').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Diperbarui',
                        position: 'topRight'
                    });
                } else {
                    console.log('gagal');
                    $("#helpkd").html(data.kd);
                    $("#helpmateri").html(data.materi);
                    $("#helpjumlah").html(data.jumlah);
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
        var pertemuan = $("[name='pertemuan']").val();
        var kd = $("[name='kd']").val();
        var materi = $("[name='materi']").val();
        var isi = $("[name='isi']").val();
        var buka = $("[name='buka']").val();
        var tutup = $("[name='tutup']").val();
        var guru = $("[name='guru']").val();
        var komentar = $("[name='komentar']").val();
        var jawab = $("[name='jawab']").val();
        var kuis = $("[name='kuis']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/edit_materi') ?>",
            data: {
                'id': id,
                'pertemuan': pertemuan,
                'kd': kd,
                'materi': materi,
                'isi': isi,
                'buka': buka,
                'tutup': tutup,
                'guru': guru,
                'komentar': komentar,
                'id_kursus': <?= $id_kursus ?>,
                'jawab': jawab,
                'kuis': kuis

            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahmateri').modal('hide');
                    $('#tablemateri').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Diperbarui',
                        position: 'topRight'
                    });
                } else if (data == 'gagal') {

                } else {
                    $("#helpkd").html(data.kd);
                    $("#helpmateri").html(data.materi);
                    $("#helpjumlah").html(data.jumlah);
                }
            }
        })
    });
    // Delete Records
    $('#tablemateri').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Kursus/hapus_materi",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablemateri').DataTable().ajax.reload();
                            iziToast.success({
                                title: 'Horee!',
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
    $('#tablemateri').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahmateri').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/ambil_materi",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_materi);
                $("[name='pertemuan']").val(data[0].pertemuan);
                $("[name='kd']").val(data[0].kd);
                $("[name='materi']").val(data[0].materi);
                CKEDITOR.instances['ckeditor'].setData(data[0].isi);
                $("[name='buka']").val(data[0].tgl_buka);
                $("[name='tutup']").val(data[0].tgl_tutup);
                $("[name='guru']").val(data[0].id_guru);
                $("[name='komentar']").val(data[0].komentar);
                $("[name='jawab']").val(data[0].jawab);
                $("[name='kuis']").val(data[0].kuis);

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

        var table = $("#tablemateri").dataTable({
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
                "url": "<?= base_url('Kursus/get_idt_materi/') . $id_kursus ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "pertemuan"

                },
                {
                    "data": "kd"
                },
                {
                    "data": "materi"
                },

                {
                    "data": "tgl_buka"
                },

                {
                    "data": "action",
                    "width": 100
                },
                {
                    "data": "kuis",
                    "width": 50
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

<script>
    $('#tambahtugas').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });

    function pilihform2(x) {
        if (x == 'tambah') {
            $('#btn-submit2').show();
            $('#btn-edit2').hide();
            $("[name='judul']").val('');
            CKEDITOR.instances['ckeditor'].setData('');
            $("[name='bukatugas']").val('');
            $("[name='tutuptugas']").val('');

        } else {
            $('#btn-submit2').hide();
            $('#btn-edit2').show();
        }
    }
    $("#btn-submit2").click(function(e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var judul = $("[name='judul']").val();
        var tugas = $("[name='tugas']").val();
        var buka = $("[name='bukatugas']").val();
        var tutup = $("[name='tutuptugas']").val();
        var guru = $("[name='gurutugas']").val();
        var komentar = $("[name='komentartugas']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/add_tugas') ?>",
            data: {
                'judul': judul,
                'tugas': tugas,
                'buka': buka,
                'tutup': tutup,
                'guru': guru,
                'komentar': komentar,
                'id_kursus': <?= $id_kursus ?>
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahtugas').modal('hide');
                    $('#tabletugas').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Diperbarui',
                        position: 'topRight'
                    });
                } else {
                    $("#helpkd").html(data.kd);
                    $("#helpmateri").html(data.materi);
                    $("#helpjumlah").html(data.jumlah);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit2").click(function(e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var id = $("[name='idtugas']").val();
        var judul = $("[name='judul']").val();
        var tugas = $("[name='tugas']").val();
        var buka = $("[name='bukatugas']").val();
        var tutup = $("[name='tutuptugas']").val();
        var guru = $("[name='gurutugas']").val();
        var komentar = $("[name='komentartugas']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/edit_tugas') ?>",
            data: {
                'id': id,
                'judul': judul,
                'tugas': tugas,
                'buka': buka,
                'tutup': tutup,
                'guru': guru,
                'komentar': komentar,
                'id_kursus': <?= $id_kursus ?>

            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahtugas').modal('hide');
                    $('#tabletugas').DataTable().ajax.reload();
                    iziToast.success({
                        title: 'Horee!',
                        message: 'Berhasil Diperbarui',
                        position: 'topRight'
                    });
                } else if (data == 'gagal') {
                    iziToast.error({
                        title: 'Horee!',
                        message: 'Gagal Diperbarui',
                        position: 'topRight'
                    });
                } else {

                }
            }
        })
    });
    // Delete Records
    $('#tabletugas').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Kursus/hapus_tugas",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tabletugas').DataTable().ajax.reload();
                            iziToast.success({
                                title: 'Horee!',
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
    $('#tabletugas').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        pilihform2();
        $('#tambahtugas').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/ambil_tugas",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='idtugas']").val(data[0].id_tugas);
                $("[name='judul']").val(data[0].judul);
                CKEDITOR.instances['ckeditor2'].setData(data[0].tugas);
                $("[name='bukatugas']").val(data[0].tgl_buka);
                $("[name='tutuptugas']").val(data[0].tgl_tutup);
                $("[name='gurutugas']").val(data[0].id_guru);
                $("[name='komentartugas']").val(data[0].komentar);

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

        var table = $("#tabletugas").dataTable({
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
                "url": "<?= base_url('Kursus/get_idt_tugas/') . $id_kursus ?>",
                "type": "POST"
            },
            columns: [{
                    "data": null,
                    "width": 10
                },
                {
                    "data": "judul"
                },
                {
                    "data": "tgl_buka"
                },
                {
                    "data": "tgl_tutup"
                },
                {
                    "data": "action",
                    "width": 100
                },

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