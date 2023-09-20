<div class="card">
    <div class="card-header">
        <h3 class="card-title">SILAHKAN ABSEN UNTUK HARI INI <?= buat_tanggal('d-m-Y') ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <p id="tampilkan"></p>
        <?php
        $id_siswa = $this->session->userdata('iduser');
        $cek = $this->db->query("select * from absen_siswa where date(tgl)=DATE(NOW()) and id_user='$id_siswa'")->num_rows();
        if ($cek == 0) {
        ?>
            <form action="<?= base_url('Absen/simpan_absen_bysiswa') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="form-control" name='long' id="long">
                    <input type="hidden" class="form-control" name='lat' id="lat">
                </div>
                <div class="form-group">
                    <label for="filefoto">Masukan Foto menggunakan Seragam</label>
                    <input type="file" class="form-control-file" name="filefoto" id="filefoto" aria-describedby="fileHelpId" required>
                    <small id="fileHelpId" class="form-text text-muted">Masukan foto berformat jpg</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Klik Absen</button>
                </div>
            </form>
        <?php } else {
            echo "KAMU SUDAH ABSEN HARI INI";
        } ?>
    </div>
    <!-- /.card-body -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Histori Absensi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tgl Absen</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absen as $absen) { ?>
                    <tr>
                        <td>#</td>
                        <td><?= $absen['tgl'] ?></td>
                        <td>
                            <?= $absen['ket'] ?>
                        </td>
                        <td>
                            <a href="<?= base_url('assets/img/absen/') . $absen['foto'] ?>"><i class="fas fa-eye"></i> Lihat</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
    window.onload = function() {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {

                var latitude = position.coords.latitude,
                    longitude = position.coords.longitude;
                document.getElementById("lat").value = latitude;
                document.getElementById("long").value = longitude;

            }, handleError);

            function handleError(error) {
                //Handle Errors
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        console.log("User denied the request for Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        console.log("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log("An unknown error occurred.");
                        break;
                }
            }
        } else {
            // container.innerHTML = "Geolocation is not Supported for this browser/OS.";
            alert("Geolocation is not Supported for this browser/OS");
        }
    };
</script>