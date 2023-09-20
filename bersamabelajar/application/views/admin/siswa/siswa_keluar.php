<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>DATA SISWA YANG KELUAR </h5> <!-- <button class="btn btn-primary" onclick="pilihform('tambah')" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-fw fa-plus"></i> Tambah siswa</button> -->
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
                                <th>KELAS</th>
                                <th>TGL KELUAR</th>
                                <th>ALASAN KELUAR</th>
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
                                     <td><?= $siswa['kelas'] ?></td>
                                    <td><?= $siswa['tgl_keluar'] ?></td>
                                    <td><?= $siswa['alasan_keluar'] ?></td>

                                    <td>
                                        <?php if($siswa['surat_keluar']<>''){ ?>
                                        <a class=" btn btn-sm btn-primary" target='_blank' href="<?= base_url('assets/surat/').$siswa['surat_keluar'] ?>" role="button"><i class="fas fa-eye    "></i> surat</a>
                                        <?php } ?>
                                        <a class="hapus btn btn-sm btn-danger" data-id="<?= $siswa['id'] ?>" href="javascript:void(0);" role="button"><i class="fas fa-times    "></i> Batal</a>
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
<div class="modal fade" id="hapussiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keluarkan Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form-keluar'>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_siswa" class="form-control" placeholder="">
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="" disabled>
                        <small id="helpid" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Tanggal Keluar</label>
                        <input type="text" name="tgl_keluar" id="tgl_keluar" class="tanggal form-control" autocomplete="off">
                        <small id="helptgl" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Alasan Keluar</label>
                        <select class="form-control" name="alasan" id="alasan">
                            <option value="">Pilih Alasan Keluar</option>
                            <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                            <option value="Pindah Sekolah">Pindah Sekolah</option>
                            <option value="Dikeluarkan">Dikeluarkan</option>
                        </select>
                        <small id="helpalasan" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Surat Keluar <small>(file pdf)</small></label>
                        <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelpId">
                        <small id="fileHelpId" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $('#form-keluar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/keluarkansiswa/') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,

            ajaxSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $("#tablesiswa").load(window.location + " #tablesiswa");
                    $('#hapussiswa').modal('hide');
                    notify('Data berhasil diubah');
                } else {
                    $("#helptgl").html(data.tgl);
                    $("#helpalasan").html(data.alasan);

                }
            }
        })
    });
    $('#tablesiswa').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan membatalkan siswa yang telah keluar!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>siswa/batalkeluar",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                             $("#tablesiswa").load(window.location + " #tablesiswa");
                            notify('Data berhasil disimpan');
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