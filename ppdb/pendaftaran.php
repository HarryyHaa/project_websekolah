<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";

?>
<div class="row">
    <div class="col-md-8 animated bounceInLeft">
        <div class="card">
            <div class="card-header">
                <h4>Form Pendaftaran (ISI DENGAN BENAR)</h4>
            </div>
            <form id="form-daftar">
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis">JENIS PENDAFTARAN</label>
                        <select class="form-control" name="jenis" id="jenis">
                            <option value="1">Siswa Baru</option>
                            <option value="2">Pindahan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nisn">NISN* (Klik disini untuk <a target="_blank" href="https://nisn.data.kemdikbud.go.id/index.php/Cindex/caribynama/">Cek NISN </a>)</label>
                        <input type="number" maxlength="10" class="form-control" name="nisn" placeholder="NISN" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">NAMA LENGKAP*</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="asal">JURUSAN / PEMINATAN</label>
                        <select class="form-control select2" style="width: 100%" name="jurusan" id="jurusan" required>
                            <option value="">PILIH JURUSAN</option>
                            <?php $qu = mysqli_query($koneksi, "select * from jurusan where status='1'");
                            while ($jur = mysqli_fetch_array($qu)) {
                            ?>
                                <option value="<?= $jur['id_jurusan'] ?>"> <?= $jur['nama_jurusan'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asal">ASAL SEKOLAH SMP/MTS</label>
                        <select class="form-control select2" style="width: 100%" name="asal" id="asal" required>
                            <option value="">PILIH SEKOLAH</option>
                            <?php $qu = mysqli_query($koneksi, "select * from sekolah where status='1'");
                            while ($data = mysqli_fetch_array($qu)) {
                            ?>
                                <option value="<?= $data['npsn'] ?>"> <?= $data['nama_sekolah'] ?></option>
                            <?php } ?>
                            <option value="lainnya">LAINNYA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nohp">NO HANDPHONE (diisi untuk info dan konfirmasi)</label>
                        <input type="number" class="form-control" name="nohp" placeholder="No HP Whatsapp" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tempat">TEMPAT LAHIR</label>
                            <input type="text" class="form-control" name="tempat" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgllahir">TANGGAL LAHIR</label>
                            <input type="text" class="form-control datepicker" name="tgllahir" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">PASSWORD (Mohon Diingat!)</label>
                        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
                    </div>
                    <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">Refresh Kode</a>

                    <img class="p-b-5" id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" style="height:70px" /><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" name="kodepengaman" placeholder="masukan kode" required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <p>* HARAP ISIKAN DATA DENGAN BENAR</p>
                        <p>* PASSWORD PIN AKAN DIGUNAKAN UNTUK LOGIN</p>

                    </div>
                </div>
                <div class="card-footer">
                    <button id='btnsimpan' type="submit" class="btn btn-lg btn-primary">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4 animated bounceInRight">
        <div class="card">
            <div class="card-header">
                <h4>Info Lebih Lanjut</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                    <?php $query = mysqli_query($koneksi, "select * from kontak where status='1'");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <li class="media">
                            <img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png">
                            <div class="media-body">
                                <div class="media-title"><?= $data['nama_kontak'] ?></div>
                                <div class="text-job text-muted"><a href="https://api.whatsapp.com/send?phone=+62<?= $data['no_kontak'] ?>&text=<?= $setting['livechat'] ?>"> <?= $data['no_kontak'] ?></a></div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $('#form-daftar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'crud_web.php?pg=simpan',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#btnsimpan').prop('disabled', true);
            },
            success: function(data) {
                var json = $.parseJSON(data);
                $('#btnsimpan').prop('disabled', false);
                if (json.pesan == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        $('#isi_load').load('konfirmasi.php?id=' + json.id + '&pass=' + json.pass + '&nama=' + json.nama);
                    }, 2000);

                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: json.pesan,
                        position: 'topCenter'
                    });
                    document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random();

                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }
        if ($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        }
    }
    if (jQuery().select2) {
        $(".select2").select2();
    }
</script>