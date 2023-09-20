<div class="row">
    <div class="col-12 col-sm-8 col-lg-8">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h4>Data Pendaftar</h4>
                <div class="card-header-action">
                    <a target="_blank" href="mod_daftar/print_daftar.php?id=<?= $_GET['id'] ?>" type="button" class="btn btn-success"><i class="fas fa-print    "></i> Cetak Form</a>
                </div>
            </div>
            <div class="card-body">
                <div class="author-box-left">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <br>
                    <div class="author-box-job">Status Pendaftaran</div>
                    <?php if ($siswa['status'] == 1) { ?>
                        <span class="badge badge-success">Diterima</span>
                    <?php } else { ?>
                        <span class="badge badge-success">Pending</span>
                    <?php } ?>
                </div>
                <div class="author-box-details">

                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user    "></i> Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-home    "></i> Data Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-friends    "></i> Orang Tua</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            <div class="table-responsiv">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <td align="right"><b>No Pendaftaran</b></td>
                                            <td align="left"><?= $siswa['no_daftar'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>NISN</b></td>
                                            <td align="left"><?= $siswa['nisn'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>No. NIK KK</b></td>
                                            <td align="left"><?= $siswa['nik'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Nama Lengkap</b></td>
                                            <td align="left"><?= $siswa['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tempat Tgl Lahir</b></td>
                                            <td align="left"><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Jenis Kelamin</b></td>
                                            <td align="left"><?= ($siswa['jenkel'] == 'L') ? "Laki-Laki" : "Perempuan"; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Agama</b></td>
                                            <td align="left"><?= $siswa['agama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>No Handphone</b></td>
                                            <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Asal Sekolah</b></td>
                                            <td align="left"><?= $siswa['asal_sekolah']  ?></td>
                                        </tr>

                                        <tr>
                                            <td align="right"><b>Anak Ke</b></td>
                                            <td align="left"><?= $siswa['anak_ke']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Saudara</b></td>
                                            <td align="left"><?= $siswa['saudara']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Saudara</b></td>
                                            <td align="left"><?= $siswa['saudara']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tinggi Badan (Cm)</b></td>
                                            <td align="left"><?= $siswa['tinggi']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Berat Badan (Kg)</b></td>
                                            <td align="left"><?= $siswa['berat']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Berat Badan (Kg)</b></td>
                                            <td align="left"><?= $siswa['berat']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Status Dalam Keluarga</b></td>
                                            <td align="left"><?= $siswa['status_keluarga']  ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="table-responsiv">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <td align="right"><b>Alamat Siswa</b></td>
                                            <td align="left"><i class="fas fa-home    "></i> <?= $siswa['alamat']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>RT / RW</b></td>
                                            <td align="left"><?= $siswa['rt']  ?>, <?= $siswa['rw']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Desa</b></td>
                                            <td align="left"><?= $siswa['desa']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Kecamatan</b></td>
                                            <td align="left"><?= $siswa['kecamatan']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Kota / Kabupaten</b></td>
                                            <td align="left"><?= $siswa['kota']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Provinsi</b></td>
                                            <td align="left"><?= $siswa['provinsi']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Kode Pos</b></td>
                                            <td align="left"><?= $siswa['kode_pos']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tinggal Bersama</b></td>
                                            <td align="left"><?= $siswa['tinggal']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Jarak KeSekolah (Meter)</b></td>
                                            <td align="left"><?= $siswa['jarak']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Waktu Tempuh (Menit)</b></td>
                                            <td align="left"><?= $siswa['waktu']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Alat Transportasi</b></td>
                                            <td align="left"><?= $siswa['transportasi']  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            <div class="table-responsiv">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <td align="center" colspan="2"><i class="fas fa-user-friends"></i> <b>Data Lengkap Ayah</b></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>NIK Ayah</b></td>
                                            <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_ayah'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Nama Lengkap Ayah</b></td>
                                            <td align="left"><?= $siswa['nama_ayah'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tempat Tgl Lahir</b></td>
                                            <td align="left"><?= $siswa['tempat_ayah'] ?>, <?= $siswa['tgl_lahir_ayah'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pendidikan Ayah</b></td>
                                            <td align="left"><?= $siswa['pendidikan_ayah']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pekerjaan Ayah</b></td>
                                            <td align="left"> <?= $siswa['pekerjaan_ayah']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Penghasilan Ayah</b></td>
                                            <td align="left"><?= $siswa['penghasilan_ayah']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>No Hp Ayah</b></td>
                                            <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_ayah']  ?></td>
                                        </tr>
                                        <!-- DATA LENGKAP IBU -->
                                        <tr>
                                            <td align="center" colspan="2"><i class="fas fa-user-friends"></i> <b>Data Lengkap Ibu</b></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>NIK Ibu</b></td>
                                            <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_ibu'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Nama Lengkap Ibu</b></td>
                                            <td align="left"><?= $siswa['nama_ibu'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tempat Tgl Lahir</b></td>
                                            <td align="left"><?= $siswa['tempat_ibu'] ?>, <?= $siswa['tgl_lahir_ibu'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pendidikan Ibu</b></td>
                                            <td align="left"><?= $siswa['pendidikan_ibu']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pekerjaan Ibu</b></td>
                                            <td align="left"> <?= $siswa['pekerjaan_ibu']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Penghasilan Ibu</b></td>
                                            <td align="left"><?= $siswa['penghasilan_ibu']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>No Hp Ibu</b></td>
                                            <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_ibu']  ?></td>
                                        </tr>

                                        <!-- DATA LENGKAP WALI -->
                                        <tr>
                                            <td align="center" colspan="2"><i class="fas fa-user-friends"></i> <b>Data Lengkap Wali</b></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>NIK Wali</b></td>
                                            <td align="left"><i class="fas fa-id-card text-success"></i> <?= $siswa['nik_wali'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Nama Lengkap Wali</b></td>
                                            <td align="left"><?= $siswa['nama_wali'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Tempat Tgl Lahir</b></td>
                                            <td align="left"><?= $siswa['tempat_wali'] ?>, <?= $siswa['tgl_lahir_wali'] ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pendidikan Wali</b></td>
                                            <td align="left"><?= $siswa['pendidikan_wali']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Pekerjaan Wali</b></td>
                                            <td align="left"> <?= $siswa['pekerjaan_wali']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Penghasilan Wali</b></td>
                                            <td align="left"><?= $siswa['penghasilan_wali']  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>No Hp Wali</b></td>
                                            <td align="left"><i class="fab fa-whatsapp text-success"></i> <?= $siswa['no_hp_wali']  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4 col-lg-4">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h4>Progres Pengisian Formulir</h4>
                <div class="card-header-action">

                </div>
            </div>
            <div class="card-body">
                <div class="activities">
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            1
                        </div>
                        <div class="activity-detail">
                            <h5>Data Diri Siswa</h5>
                            <p><span class="badge badge-danger"><i class="fas fa-times-circle    "></i>
                                    Belum lengkap</span></p>
                        </div>
                    </div>

                </div>
                <div class="activities">
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            2
                        </div>
                        <div class="activity-detail">
                            <h5>Data Alamat Siswa</h5>
                            <p><span class="badge badge-danger"><i class="fas fa-times-circle    "></i>
                                    Belum lengkap</span></p>
                        </div>
                    </div>
                </div>
                <div class="activities">
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            3
                        </div>
                        <div class="activity-detail">
                            <h5>Data Orang Tua</h5>
                            <p><span class="badge badge-danger"><i class="fas fa-times-circle    "></i>
                                    Belum lengkap</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>