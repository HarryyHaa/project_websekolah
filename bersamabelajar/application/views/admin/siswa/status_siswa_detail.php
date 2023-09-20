<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>DATA SISWA BINAAN </h5> <!-- <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm" id="tablesiswa" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>STATUS</th>
                                <th>KELAS</th>
                                <th>NISN</th>
                                <th>NIK</th>
                                <th>ASAL SEKOLAH</th>
                                <th>JK</th>
                                <th>TEMPAT</th>
                                <th>TGL LAHIR</th>
                                <th>IBU KANDUNG</th>
                                <th>NO KIP</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetsiswa'>
                            <?php $no = 0; ?>
                            <?php foreach ($siswa as $siswa) : ?>
                                <?php $no++ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td align='center'><?php cekstatus($siswa['nis']); ?></td>
                                    <td><?= $siswa['kelas'] ?></td>
                                    <td><?= $siswa['nisn'] ?></td>
                                    <td><?= $siswa['nik'] ?></td>
                                    <td><?= $siswa['asal_sekolah'] ?></td>
                                    <td><?= $siswa['jenkel'] ?></td>
                                    <td><?= $siswa['tempat_lahir'] ?></td>
                                    <td><?= $siswa['tgl_lahir'] ?></td>
                                    <td><?= $siswa['nama_ibu'] ?></td>
                                    <td><?= $siswa['no_kip'] ?></td>

                                    <td>
                                        <a name="" id="" class="btn btn-sm btn-primary" href="<?= base_url('siswa/edit/') . $siswa['id'] ?>" role="button"><i class="fas fa-search    "></i></a>
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
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/tambahdata') ?>",
            data: 'nama=' + nama + '&nis=' + nis + '&kelas=' + kelas + '&jurusan=' + jurusan + '&jenjang=' + jenjang,
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
</script>