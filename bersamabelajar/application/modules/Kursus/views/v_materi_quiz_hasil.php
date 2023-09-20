<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-text-width"></i>
            Hasil Ujian
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Terima Kasih!</h5>
            Hasil Ujian sudah berhasil disimpan
        </div>
        <div class="callout callout-success">
            <h3>Nilai : <?= $skor ?></h3>

            <p><i class="fas fa-check-circle text-success   "></i> <?= $betul ?> Benar
                <i class="fas fa-times-circle text-danger  "></i> <?= $salah ?> Salah</p>
        </div>
        <a href="<?= base_url('Kursus') ?>" class="btn btn-primary"><i class="fas fa-backward    "></i> Kembali</a>

    </div>
    <!-- /.card-body -->
</div>