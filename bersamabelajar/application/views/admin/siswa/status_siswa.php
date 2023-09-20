<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>DATA WALI KELAS </h5> <!-- <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm" id="tablesiswa" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>KELAS</th>
                                <th>WALI KELAS</th>
                                <th>PROGRESS DATA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id='targetsiswa'>
                            <?php $no = 0; ?>
                            <?php foreach ($kelas as $kelas) : ?>
                                <?php $no++; ?>
                                <?php 
                                $walas=$this->db->get_where('si_guru',['nip'=>$kelas['walas']])->row_array(); 
                                $jumsiswa = $this->db->get_where('si_siswa', ['kelas' => $kelas['id']])->num_rows();
                                $progres=round(progresdata($kelas['id'])/$jumsiswa*100,2);
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $kelas['id'] ?></td>
                                    <td><?= $walas['nama'] ?></td>
                                    <td><span class='badge badge-success'><?= $progres ?> % </span></td>

                                    <td>
                                        <a name="" id="" class="btn btn-sm btn-primary" href="<?= base_url('siswa/cekstatus/') . $kelas['id'] ?>" role="button"><i class="fas fa-search    "></i></a>
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