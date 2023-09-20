<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>INFO PEMBAYARAN</h4>
            </div>
            <form id="infobayar">
                <div class="card-body">
                    <div class="form-group">
                        <label>Isi dengan cara pembayaran</label>
                        <textarea name="info" class="summernote" required><?= $setting['infobayar'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Info</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#infobayar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_setting/crud_setting.php?pg=infobayar',
            data: $(this).serialize(),
            success: function(data) {
                if (data == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data Berhasil ditambahkan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    $('#tambahdata').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Data Gagal ditambahkan atau username sudah ada',
                        position: 'topRight'
                    });
                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
</script>