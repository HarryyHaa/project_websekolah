<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-eye"></i>
            PREVIEW <?= $materi['materi'] ?>
        </h3>
    </div>
    <div class="card-body">
        <form id="formedit">
            <input type="hidden" name="id" value="<?= $materi['id_materi'] ?>">
            <div class="form-group">
                <label for="mapel">Nama Mapel</label>
                <select class="form-control" name="mapel" id="mapel">
                    <option value=""></option>
                    <?php foreach ($mapel as $mapel) : ?>
                        <option value="<?= $mapel['nama_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kd">KD</label>
                <input type="text" name="kd" id="kd" class="form-control" value="<?= $materi['kd'] ?>" placeholder="">
                <small id="helpkd" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="materi">Nama Materi</label>
                <input type="text" name="materi" id="materi" class="form-control" value="<?= $materi['materi'] ?>" placeholder="">
                <small id="helpmateri" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="isi">Materi</label>
                <textarea id="ckeditor" class="form-control" name="isi"><?= $materi['isi'] ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="buka">Tgl Dibuka</label>
                        <input type="text" name="buka" id="buka" class="tanggalwaktu form-control" placeholder="" value="<?= $materi['tgl_buka'] ?>" autocomplete="off">
                        <small id="helpbuka" class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tutup">Tgl Ditutup</label>
                        <input type="text" name="tutup" id="tutup" class="tanggalwaktu form-control" placeholder="" value="<?= $materi['tgl_tutup'] ?>" autocomplete="off">
                        <small id="helptutup" class="text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Guru">Guru</label>
                <select class="form-control" name="guru" id="guru">
                    <option value="1">Guru</option>
                    <option value="2">Siswa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
    </form>

</div>

<script>
    $(function() {
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '<?= base_url('assets/plugins/kcfinder/browse.php'); ?>',
            height: '300px'
        });
    });
</script>