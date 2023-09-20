<!-- Begin Page Content -->


<div class="card-body">
    <form enctype="multipart/form-data" id="fupForm">
        <div class="form-group row">
            <label for="sekolah" class="col-sm-2 col-form-label">Nama Siswa</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $siswa['nama'] ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">No HP</label>
            <div class="col-sm-10">
                <input class="form-control" name="nohp" id="nohp" rows="3" value="<?= $siswa['no_hp'] ?>" required />
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Ganti Password</label>
            <div class="col-sm-10">
                <input class="form-control" name="password" id="password" rows="3" placeholder="Kosongkan jika tidak ingin rubah password" />
            </div>
        </div>
        <div class="form-group row">
            <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
            <div class="col-sm-3">
                <img src="<?= base_url('assets/img/profil/') . $siswa['foto'] ?>" alt="..." class="img-thumbnail">
            </div>
            <div class="col-sm-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name='file' id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" id='btn-submit' class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
<script type='text/javascript'>
    function notify(pesan) {
        toastr.success(pesan);
    }
    $(document).ready(function(e) {
        $("#fupForm").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Setting/editprofil') ?>',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,


                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data == 'sukses') {
                        location.reload();

                    }
                }
            })
        });
    });
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>