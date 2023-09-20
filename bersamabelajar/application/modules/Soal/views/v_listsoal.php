<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Daftar Soal <?= $id ?> </div>
                <div class="card-tools">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSoal">
                        <i class="fas fa-file-code    "></i> Tambah Soal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahSoal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Soal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form-soal">
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" name='id' value="<?= $id ?>" class="form-control" placeholder="">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <textarea class="form-control ckeditor" name="soal"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="kunci">Jenis Soal</label>
                                                    <select class="form-control" name="jenis" id="jenis">
                                                        <option value="1">PG</option>
                                                        <option value="2">ESAI</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kunci">Kunci Jawaban</label>
                                                    <select class="form-control" name="jawaban" id="jawaban">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jawaban A</label>
                                                    <textarea class="form-control ckeditor" name="pilA"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jawaban B</label>
                                                    <textarea class="form-control ckeditor" name="pilB"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jawaban C</label>
                                                    <textarea class="form-control ckeditor" name="pilC"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jawaban D</label>
                                                    <textarea class="form-control ckeditor" name="pilD"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jawaban E</label>
                                                    <textarea class="form-control ckeditor" name="pilE"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tablesoal" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width=10>No</th>
                                <th>Daftar Soal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($soal as $soal) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $soal['soal'] ?></td>
                                    <td>
                                        <button class="btn btn-danger hapus btn-sm" data-id="<?= $soal['id_soal'] ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<script type="text/javascript">
    function notify(pesan) {
        toastr.success(pesan);
    } +
    $('#tablesoal').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Soal/hapussoal",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            location.reload();
                            iziToast.success({
                                title: 'Hemm!',
                                message: 'Berhasil Dihapus',
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        })

    });
    $(document).ready(function(e) {
        // Delete Records

        $(function() {
            CKEDITOR.replace('.ckeditor', {
                filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
                height: '400px'
            });
        });
        $("#form-soal").on('submit', function(e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Soal/simpansoal') ?>',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,

                // beforeSend: function() {
                //     $('#btn-submit').attr("disabled", "disabled");
                //     $('#fupForm').css("opacity", ".5");
                // },
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data == 'sukses') {
                        $('#fupForm').css("opacity", "");
                        $("#btn-submit").removeAttr("disabled");
                        notify('Data berhasil diperbarui');
                    } else {
                        notify('Data gagal diperbarui');
                        $('#fupForm').css("opacity", "");
                        $("#btn-submit").removeAttr("disabled");
                    }
                }
            })
        });
    });
</script>