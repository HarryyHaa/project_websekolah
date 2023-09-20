<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                DATA VOUCHER WIFI
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Satu Kode Login untuk 36 Siswa.
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="tablevoucher" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>KODE LOGIN</th>
                                <th>STATUS</th>
                                <th>AKSI</th>

                            </tr>
                        </thead>
                        <tbody id='targetvoucher'>
                            <?php $no = 0; ?>
                            <?php foreach ($voucher as $voucher) : ?>
                                <?php $no++ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $voucher['kode'] ?></td>
                                    <td><?php
                                            if ($voucher['status'] == 0) {
                                                $dis = '';
                                                echo "<span class='badge badge-success'>Masih Bisa</span>";
                                            } else {
                                                $dis = 'disabled';
                                                echo "<span class='badge badge-danger'>Sudah Terpakai</span>";
                                            } ?></td>
                                    <td>
                                        <button class="pakai btn btn-sm btn-primary" data-id="<?= $voucher['id'] ?>" <?= $dis ?>><i class="fas fa-wifi    "></i> Pakai Kode</button>
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


    // Delete Records
    $('#tablevoucher').on('click', '.pakai', function() {
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan menggunakan voucher ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>guru/gantistatusvoucher",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {

                        if (data == 'ok') {
                            $("#tablevoucher").load(window.location + " #tablevoucher");
                            notify('Voucher berhasil digunakan');
                        }
                    }
                });
            }
        })

    });
</script>