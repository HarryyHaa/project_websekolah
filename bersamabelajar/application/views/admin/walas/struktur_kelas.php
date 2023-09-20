<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahstrukturkelas"><i class="fas fa-fw fa-plus"></i> Tambah strukturkelas</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablestrukturkelas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>JABATAN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($struktur as $struktur) {
                                $siswax = $this->db->get_where('si_siswa', ['nis' => $struktur['nis']])->row_array(); ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $struktur['nis'] ?></td>
                                    <td><?= $siswax['nama'] ?></td>
                                    <td><?= $struktur['jabatan'] ?></td>
                                    <td><button type="button" data-id="<?= $struktur['id'] ?>" class="hapus btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                </tr>
                            <?php $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="tambahstrukturkelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data strukturkelas</h5>
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
                        <label for="nama">Nama Siswa</label>
                        <select class="form-control" name="nis" id="nis">
                            <?php foreach ($siswa as $siswa) : ?>
                                <option value='<?= $siswa['nis'] ?>'><?= $siswa['nis'] . ' - ' . $siswa['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Jabatan</label>
                        <select class="form-control" name="jabatan" id="jabatan">
                            <option value="Ketua Kelas">Ketua Kelas</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
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
            $("[name='nama']").val('');
        } else {
            $('#btn-submit').hide();
            $('#btn-edit').show();
        }
    }
    $("#btn-submit").click(function(e) {
        e.preventDefault();
        var nis = $("[name='nis']").val();
        var jabatan = $("[name='jabatan']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('struktur/tambahdata') ?>",
            data: '&nis=' + nis + '&jabatan=' + jabatan,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahstrukturkelas').modal('hide');
                    //$('#tablestrukturkelas').DataTable().ajax.reload();
                    $("[name='nis']").val('');
                    notify('Data berhasil ditambahkan');
                } else {
                    toastr.error('Data Sudah Ada');
                    $("#helpnama").html(data.nis);
                }

            }
        })
    });
    //tombol edit modal
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var id = $("[name='id']").val();

        var nama = $("[name='nama']").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('struktur/editdata') ?>",
            data: 'id=' + id + '&nama=' + nama,
            datatype: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $(".alert-danger").css('display', 'none');
                    $('#tambahstrukturkelas').modal('hide');
                    $('#tablestrukturkelas').DataTable().ajax.reload();
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
    $('#tablestrukturkelas').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>struktur/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            //$('#tablestrukturkelas').DataTable().ajax.reload();
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    //**end**
    // AMBIL ID data table
    $('#tablestrukturkelas').on('click', '.edit', function() {
        var id = $(this).data('id');
        pilihform();
        $('#tambahstrukturkelas').modal('show');
        $.ajax({
            url: "<?php echo base_url(); ?>struktur/ambilid",
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