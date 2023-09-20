<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <label class="label" data-toggle="tooltip" title="Change your avatar">
                        <img style='width:120px' class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/foto/') . $siswa['foto'] ?>" alt="User profile picture">
                            <!-- <input type="file" class="sr-only" id="profilinput" name="image" accept="image/jpg"> -->
                      </label>
                </div>

                <h3 class="profile-username text-center"><?= $siswa['nama'] ?></h3>

                <p class="text-muted text-center"><?= $siswa['nis'] ?></p>

                <!-- <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                    </li>
                </ul> -->

                <!-- <b href="#" class="btn btn-primary btn-block"><b>Ganti Foto</b></a> -->
                <a href="<?= base_url('siswa/edit') ?>" class="btn btn-danger btn-block"><b>Edit Data</b></a>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Data Siswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alamat" data-toggle="tab">Alamat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ortu" data-toggle="tab">Orang Tua</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sekolah" data-toggle="tab">Asal Sekolah</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">

                    <div class="active tab-pane" id="profil">

                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>

                                <tr>
                                    <th scope='row'>NIS</th>
                                    <td><?= $siswa['nis'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIK / NISN</th>
                                    <td><?= $siswa['nik'] . " / " . $siswa['nisn'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NO Kartu Keluarga</th>
                                    <td><?= $siswa['no_kk'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NO KIP <small>(jika ada)</small></th>
                                    <td><?= $siswa['no_kip'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Lengkap</th>
                                    <td><?= $siswa['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Tempat, Tanggal Lahir</th>
                                    <td><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jenis Kelamin</th>
                                    <td><?= $siswa['jenkel'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Anak Ke</th>
                                    <td><?= $siswa['anak_ke'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jumlah Saudara Kandung</th>
                                    <td><?= $siswa['saudara'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Tinggi Badan</th>
                                    <td><?= $siswa['tinggi'] ?> Cm</td>
                                </tr>
                                <tr>
                                    <th scope='row'>Berat Badan</th>
                                    <td><?= $siswa['berat'] ?> Kg</td>
                                </tr>
                                <tr>
                                    <th scope='row'>No HP</th>
                                    <td><?= $siswa['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jurusan</th>
                                    <td><?= $siswa['jurusan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kelas Sekarang</th>
                                    <td><?= $siswa['kelas'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="alamat">
                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>
                                <tr align='center'>
                                    <td colspan='2'><b>DATA ALAMAT</b></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Alamat</th>
                                    <td><?= $siswa['alamat'] ?> RT <?= $siswa['rt'] ?>/<?= $siswa['rw'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kelurahan</th>
                                    <td><?= $siswa['desa'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kecamatan</th>
                                    <td><?= $siswa['kecamatan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Alat Transportasi ke Sekolah</th>
                                    <td><?= $siswa['transportasi'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jenis Tinggal</th>
                                    <td><?= $siswa['tinggal'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jarak Ke Sekolah</th>
                                    <td><?= $siswa['jarak'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Waktu Tempuh Ke Sekolah</th>
                                    <td><?= $siswa['waktu'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="ortu">
                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>
                                <tr align='center'>
                                    <td colspan='2'><b>DATA AYAH</b></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIK Ayah</th>
                                    <td><?= $siswa['nik_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Ayah</th>
                                    <td><?= $siswa['nama_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Tahun Lahir</th>
                                    <td><?= $siswa['tgl_lahir_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Pekerjaan</th>
                                    <td><?= $siswa['pekerjaan_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Pendidikan</th>
                                    <td><?= $siswa['pendidikan_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Penghasilan</th>
                                    <td><?= $siswa['penghasilan_ayah'] ?></td>
                                </tr>
                                <tr align='center'>
                                    <td colspan='2'><b>DATA IBU</b></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIK Ibu</th>
                                    <td><?= $siswa['nik_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Ibu</th>
                                    <td><?= $siswa['nama_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Tahun Lahir</th>
                                    <td><?= $siswa['tgl_lahir_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Pekerjaan</th>
                                    <td><?= $siswa['pekerjaan_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Pendidikan</th>
                                    <td><?= $siswa['pendidikan_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Penghasilan</th>
                                    <td><?= $siswa['penghasilan_ibu'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="sekolah">
                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>
                                <tr align='center'>
                                    <td colspan='2'><b>DATA ASAL SEKOLAH</b></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Asal Sekolah</th>
                                    <td><?= $siswa['asal_sekolah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>No Peserta Ujian SMP/MTS</th>
                                    <td><?= $siswa['no_ujian'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>No Ijazah</th>
                                    <td><?= $siswa['no_ijazah'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>No SHUN</th>
                                    <td><?= $siswa['no_shun'] ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>