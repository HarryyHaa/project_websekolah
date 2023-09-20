<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsoal"><i class="fas fa-fw fa-plus"></i> Tambah soal</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline" id="divsoal">

                                <?php
                                $no = 1;
                                foreach ($soal as $soal) : ?>
                                    <div>
                                        <i class="fas fa-envelope bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time">Soal No : <?= $no++ ?> <a href="#" data-id="<?= $soal['id_soal'] ?>" class="hapus badge badge-danger"> Hapus</a> </span>
                                            <h3 class="timeline-header">
                                                <?= $soal['soal'] ?>
                                            </h3>
                                            <div class="timeline-body">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <?php
                                                        $opsi = $this->db->get_where('soal_opsi', ['id_soal' => $soal['id_soal']])->result_array();
                                                        foreach ($opsi as $opsi) :
                                                            if ($opsi['benar'] == 1) {
                                                                $kunci = '<span class="badge badge-success">o</span>';
                                                            } else {
                                                                $kunci = '<span class="badge badge-primary">o</span>';
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td scope="row" style="width:10px"><?= $kunci ?></td>
                                                                <td><?= $opsi['opsi'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <!-- <div class="timeline-footer">
                                            <a class="btn btn-primary btn-sm">Read more</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </div> -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahsoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id='form-soal' enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="alert alert-danger" style="display:none">
                    </div>
                    <input type="hidden" name="id" id="id" class="form-control" placeholder="">
                    <input type="hidden" name="id_materi" value="<?= $id_materi ?>" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea class="ckeditor form-control" name="soal"></textarea>
                    </div>
                    <!-- <div class="form-group control-group after-add-more">
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-success add-more" type="button"><i class="fas fa-plus-circle    "></i> Add Opsi</button>
                    </div> -->
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Opsi</th>
                                <th width="50px">Kunci</th>
                                <th width="50px"></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><textarea name="opsi[0]" class="form-control"></textarea></td>
                                <td><input type="checkbox" name="kunci[0]" class="form-control" /></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-success" onclick="additem(); return false"><i class="fas fa-plus-circle    "></i></button>

                                </td>
                            </tr>
                        </tfoot>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id='btn-submit' type="submit" class="btn btn-primary">Save changes</button>
                    <button id='btn-edit' class="btn btn-primary" display='none'>Ubah Data</button>
                </div>
            </form>
            <!-- Copy Fields -->
            <!-- <div class="copy" style="display: none;">
                <div class="form-group control-group ">
                    <div class="input-group">
                        <textarea name="opsi[]" class=" form-control" placeholder="Masukan Opsi Jawaban"></textarea>
                        <div class="input-group-btn">
                            <button class="btn btn-danger remove" type="button"><i class="fas fa-times    "></i></button>
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="kunci[0]" value="1">
                            Display value
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="kunci[0]" value="0">
                            Display value
                        </label>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<script>
    var i = 1;

    function additem() {
        //                menentukan target append
        var itemlist = document.getElementById('itemlist');
        //                membuat element
        var row = document.createElement('tr');
        var jenis = document.createElement('td');
        var jumlah = document.createElement('td');
        var aksi = document.createElement('td');
        //                meng append element
        itemlist.appendChild(row);
        row.appendChild(jenis);
        row.appendChild(jumlah);
        row.appendChild(aksi);
        //                membuat element input
        var jenis_input = document.createElement('textarea');
        jenis_input.setAttribute('name', 'opsi[' + i + ']');
        jenis_input.setAttribute('class', 'form-control');
        var jumlah_input = document.createElement('input');
        jumlah_input.setAttribute('name', 'kunci[' + i + ']');
        jumlah_input.setAttribute('class', 'form-control');
        jumlah_input.setAttribute('type', 'checkbox');
        var hapus = document.createElement('span');
        //                meng append element input
        jenis.appendChild(jenis_input);
        jumlah.appendChild(jumlah_input);
        aksi.appendChild(hapus);
        hapus.innerHTML = '<button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>';
        //                membuat aksi delete element
        hapus.onclick = function() {
            row.parentNode.removeChild(row);
        };
        i++;
    }
</script>
<script>
    $('#tambahsoal').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
    });
    $('#form-soal').submit(function(e) {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('Kursus/add_soal') ?>',
            data: $(this).serialize(),
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {
                location.reload();

            }
        });
        return false;
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
            // $("[name='id']").val('');
            // $("[name='pertemuan']").val('');
            // $("[name='kd']").val('');
            // $("[name='soal']").val('');

            // $("[name='buka']").val('');
            // $("[name='tutup']").val('');
            // $("[name='guru']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    // $("#btn-submit").click(function(e) {
    //     e.preventDefault();
    //     for (instance in CKEDITOR.instances) {
    //         CKEDITOR.instances[instance].updateElement();
    //     }
    //     var soal = $("[name='soal']").val();
    //     var pilA = $("[name='pilA']").val();
    //     var pilB = $("[name='pilB']").val();
    //     var pilC = $("[name='pilC']").val();
    //     var pilD = $("[name='pilD']").val();
    //     var pilE = $("[name='pilE']").val();
    //     var kunci = $("[name='kunci']").val();

    //     $.ajax({
    //         type: 'POST',
    //         url: "<?= base_url('Kursus/tambah_soal') ?>",
    //         data: {
    //             'soal': soal,
    //             'pilA': pilA,
    //             'pilB ': pilB,
    //             'pilC': pilC,
    //             'pilD': pilD,
    //             'pilE': pilE,
    //             'kunci': kunci,
    //             'id_materi': <?= $id_materi ?>
    //         },
    //         datatype: 'json',
    //         success: function(data) {
    //             data = JSON.parse(data);
    //             console.log(data);
    //             if (data == 'sukses') {
    //                 $(".alert-danger").css('display', 'none');
    //                 $('#tambahsoal').modal('hide');
    //                 location.reload();
    //                 notify('Data berhasil ditambahkan');
    //             } else {
    //                 console.log('gagal');
    //                 $("#helpkd").html(data.kd);
    //                 $("#helpsoal").html(data.soal);
    //                 $("#helpjumlah").html(data.jumlah);
    //             }

    //         }
    //     })
    // });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var id = $("[name='id']").val();
        var pertemuan = $("[name='pertemuan']").val();
        var kd = $("[name='kd']").val();
        var soal = $("[name='soal']").val();
        var isi = $("[name='isi']").val();
        var buka = $("[name='buka']").val();
        var tutup = $("[name='tutup']").val();
        var guru = $("[name='guru']").val();
        var komentar = $("[name='komentar']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('Kursus/edit_soal') ?>",
            data: {
                'id': id,
                'pertemuan': pertemuan,
                'kd': kd,
                'soal': soal,
                'isi': isi,
                'buka': buka,
                'tutup': tutup,
                'guru': guru,
                'komentar': komentar,
                'id_materi': <?= $id_materi ?>

            },
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahsoal').modal('hide');
                    $('#tablesoal').DataTable().ajax.reload();
                    notify('Data berhasil diubah');
                } else if (data == 'gagal') {
                    notify('Data gagal diubah');
                } else {
                    $("#helpkd").html(data.kd);
                    $("#helpsoal").html(data.soal);
                    $("#helpjumlah").html(data.jumlah);
                }
            }
        })
    });
    // Delete Records
    $('#divsoal').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Kursus/hapus_soal",
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
    $('#tablesoal').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahsoal').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Kursus/ambil_soal",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_soal);
                $("[name='pertemuan']").val(data[0].pertemuan);
                $("[name='kd']").val(data[0].kd);
                $("[name='soal']").val(data[0].soal);
                CKEDITOR.instances['ckeditor'].setData(data[0].isi);
                $("[name='buka']").val(data[0].tgl_buka);
                $("[name='tutup']").val(data[0].tgl_tutup);
                $("[name='guru']").val(data[0].id_guru);
                $("[name='komentar']").val(data[0].komentar);

            }
        });

    });
</script>