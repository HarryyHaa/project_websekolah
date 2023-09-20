<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-archive    "></i>
                    Pembelajaran</h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahkursus"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" id="tablekursus">

                    <?php
                    $warna = ['danger', 'warning', 'success', 'primary', 'purple', 'gray', 'navy'];
                    foreach ($kursus as $kursus) : ?>
                        <?php //$mapel = $this->db->get_where('mapel', ['id_mapel' => $kursus['id_mapel']])->row_array() 
                        ?>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-<?= $warna[array_rand($warna)]  ?>">
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="<?= base_url() ?>assets/dist/img/materi.png" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <a href="<?= base_url('Kursus/materi/') . $kursus['id_kursus'] ?>">
                                        <h3 class="widget-user-username">
                                            <?php if (strlen($kursus['id_mapel']) > 20) {
                                                echo substr($kursus['id_mapel'], 0, 20) . ' ...';
                                            } else {
                                                echo $kursus['id_mapel'];
                                            }
                                            ?></h3>
                                    </a>
                                    <h5 class="widget-user-desc">
                                        <?php if ($kursus['status'] == 1) : ?>
                                            <span class="badge badge-primary">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        <?php endif; ?>
                                        <button data-id="<?= $kursus['id_kursus'] ?>" class="edit float-right badge bg-primary">Edit</button>
                                        <button data-id="<?= $kursus['id_kursus'] ?>" class="hapus float-right badge bg-danger">Hapus</button>

                                    </h5>

                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <?= $kursus['kelas'] ?>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahkursus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kursus</h5>
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
                        <label for="mapel">Nama Pembelajaran</label>
                        <select class="form-control" name="mapel" id="mapel">
                            <option value=""></option>
                            <?php foreach ($mapel as $mapel) : ?>
                                <option value="<?= $mapel['nama_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="helpmapel" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Untuk Kelas</label>
                        <span id="klas"></span>
                        <select class="select2 form-control" multiple="multiple" name="kelas[]" id="kelas">
                            <!--<option value="semua">Semua</option>-->
                            <?php foreach ($kelas as $kelas) { ?>
                                <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['id_kelas'] ?></option>
                            <?php } ?>
                        </select>
                        <small id="helpkelas" class="text-danger"></small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
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
    $('#tambahkursus').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
    // $(function() {
    //     CKEDITOR.replace('ckeditor', {
    //         filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
    //         height: '300px'
    //     });
    // });

    function notify(pesan) {
        toastr.success(pesan);
    }

    function pilihform(x) {
        if (x == 'tambah') {
            $('#btn-submit').show();
            $('#btn-edit').hide();
            $("[name='id']").val('');
            $("[name='mapel']").val('');

        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var mapel = $("[name='mapel']").val();
        var guru = $("[name='guru']").val();
        var status = $("[name='status']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/tambahdata') ?>",
            data: {
                'mapel': mapel,
                'guru': guru,
                'status': status,
                'kelas': kelas
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    location.reload();
                } else {
                    iziToast.error({
                        title: 'Hemm!',
                        message: 'Gagal Menambahkan data sudah ada !',
                        position: 'topRight'
                    });
                    $("#helpkelas").html(data.kelas);
                    $("#helpmapel").html(data.mapel);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var id = $("[name='id']").val();
        var mapel = $("[name='mapel']").val();
        var guru = $("[name='guru']").val();
        var status = $("[name='status']").val();
        var kelas = $("[name='kelas[]']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/editdata') ?>",
            data: {
                'id': id,
                'mapel': mapel,
                'guru': guru,
                'status': status,
                'kelas': kelas
            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    location.reload();
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpkelas").html(data.kelas);
                    $("#helpmapel").html(data.mapel);
                }
            }
        })
    });
    // Delete Records
    $('#tablekursus').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Kursus/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            location.reload();
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablekursus').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahkursus').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_kursus);
                $("[name='mapel']").val(data[0].id_mapel);
                $("[name='guru']").val(data[0].id_guru);
                $("[name='status']").val(data[0].status);
                $("#klas").html(data[0].kelas);
            }
        });

    });
</script>