<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <h3 class="mb-30">Data Siswa</h3>
            <div class="progress-table-wrap">
                <div class="progress-table">
                    <div class="table-head">
                        <div class="serial">#</div>
                        <div class="country">NICT</div>
                        <div class="country">Nama Siswa</div>
                        <div class="visit">Kelas</div>
                        <div class="percentage">Jurusan</div>
                    </div>
                    <?php
                    $siswa = $this->db->get('siswa')->result_array();
                    $no = 1;
                    foreach ($siswa as $siswa) :
                    ?>
                        <div class="table-row">
                            <div class="serial"><?= $no++ ?></div>
                            <div class="country"><?= $siswa['nis'] ?></div>
                            <div class="country"><?= $siswa['nama'] ?></div>
                            <div class="visit"><?= $siswa['kelas'] ?></div>
                            <div class="percentage"><?= $siswa['jurusan'] ?></div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>