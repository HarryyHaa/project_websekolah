<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Siswa Kelas </div>
                <div class="card-tools">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm" id="tablesiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width='5'>No</th>
                                <th>NIS</th>
                                <th>Nama siswa</th>
                                <th>Password</th>
                                <th>No HP</th>
                                <th>Tunggakan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='targetsiswa'>
                            <?php
                            $no = 1;
                            foreach ($siswa as $siswa) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $siswa['password'] ?></td>
                                    <td><?= $siswa['no_hp'] ?></td>
                                    <td><?= $siswa['tunggakan'] ?></td>
                                    <td><?php if ($siswa['status'] == 1) {
                                            echo "<span class='badge badge-success'>aktif</span>";
                                        } else {
                                            echo "<span class='badge badge-danger'>Tidak aktif</span>";
                                        } ?></td>
                                    <td>
                                        <button type="button" data-id="<?= $siswa['id_siswa'] ?>" class="edit btn btn-primary btn-sm"><i class="fas fa-edit    "></i> Edit Status</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
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
                    <input type="hidden" name='id' id="id" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="nama">No HP</label>
                        <input type="text" name='nohp' id="nohp" class="form-control" placeholder="">
                        <small id="helpid" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <small id="helpnama" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tunggakan">Tunggakan</label>
                        <input type="text" name="tunggakan" id="tunggakan" class="form-control" placeholder="">
                        <small id="helpusername" class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


    $('#tablesiswa').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>Siswa/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#tablesiswa').DataTable().ajax.reload();
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

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();
        var nohp = $("[name='nohp']").val();

        var nama = $("[name='nama']").val();
        var status = $("[name='status']").val();
        var tunggakan = $("[name='tunggakan']").val();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Siswa/editsiswabinaan') ?>",
            data: {
                'id': id,
                'nama': nama,
                'nohp': nohp,

                'status': status,
                'tunggakan': tunggakan
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    location.reload();
                }
            }
        })
    });
    //**end**
    // AMBIL ID data table
    $('#tablesiswa').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        $('#tambahsiswa').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>Siswa/ambilid",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("[name='id']").val(data[0].id_siswa);
                $("[name='nohp']").val(data[0].no_hp);
                $("[name='nis']").val(data[0].nis);
                $("[name='nama']").val(data[0].nama);
                $("[name='level']").val(data[0].level);
                $("[name='jurusan']").val(data[0].jurusan);
                $("[name='kelas']").val(data[0].kelas);
                $("[name='sesi']").val(data[0].sesi);
                $("[name='username']").val(data[0].username);
            }
        });

    });
</script>