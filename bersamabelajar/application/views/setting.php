<!-- Begin Page Content -->


<div class="card-body">
    <form enctype="multipart/form-data" id="fupForm">
        <div class="form-group row">
            <label for="sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sekolah" id="sekolah" value="<?= $setting['nama_sekolah'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat Sekolah</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $setting['alamat_sekolah'] ?></textarea>
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Jenjang Sekolah</legend>
                <div class="col-sm-10">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" value='SD' name="jenjang" class="custom-control-input" <?php if ($setting['jenjang'] == 'SD') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                        <label class="custom-control-label" for="customRadio1">SD</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" value='SMP' name="jenjang" class="custom-control-input" <?php if ($setting['jenjang'] == 'SMP') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                        <label class="custom-control-label" for="customRadio2">SMP</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio3" value='SMA' name="jenjang" class="custom-control-input" <?php if ($setting['jenjang'] == 'SMA') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                        <label class="custom-control-label" for="customRadio3">SMA</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio4" value='SMK' name="jenjang" class="custom-control-input" <?php if ($setting['jenjang'] == 'SMK') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                        <label class="custom-control-label" for="customRadio4">SMK</label>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="provinsi" value="<?= $setting['provinsi'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kabupaten" value="<?= $setting['kabupaten'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="sekolah" class="col-sm-2 col-form-label">Logo Sekolah</label>
            <div class="col-sm-3">
                <img src="<?= base_url('assets/img/') . $setting['logo'] ?>" alt="..." class="img-thumbnail">
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
                <button type="submit" id='btn-submit' class="btn btn-primary">Simpan Pengaturan</button>
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
                url: '<?= base_url('setting/editdata') ?>',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,

                beforeSend: function() {
                    $('#btn-submit').attr("disabled", "disabled");
                    $('#fupForm').css("opacity", ".5");
                },
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
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>