<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalimport"><i class="fas fa-fw fa-upload"></i> Import Excel</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                                    <td><?= $voucher['status'] ?></td>

                                    <td>
                                        <a class="hapus btn btn-sm btn-danger" data-id="<?= $voucher['id'] ?>" href="javascript:void(0);" role="button"><i class="fas fa-times    "></i> hapus</a>
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
<div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA VOUCHER</h5>
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


<script type="text/javascript">
    function notify(pesan) {
        toastr.success(pesan);
    }


    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>import/import_voucher",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#file').val('');
                $('#modalimport').modal('hide');
                notify('data berhasil diimport');
                $("#tablevoucher").load(window.location + " #tablevoucher");
            }
        })
    });

    // Delete Records
    $('#tablevoucher').on('click', '.hapus', function() {
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
                    url: "<?php echo base_url(); ?>voucher/hapusdata",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $("#tablevoucher").load(window.location + " #tablevoucher");
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
</script>