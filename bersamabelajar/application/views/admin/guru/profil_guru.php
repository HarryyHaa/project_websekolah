<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <label class="label" data-toggle="tooltip" title="Change your avatar">
                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/foto/') . $guru['foto'] ?>" alt="User profile picture">
                        <!-- <input type="file" class="sr-only" id="profilinput" name="image" accept="image/jpg"> -->
                    </label>
                </div>

                <h3 class="profile-username text-center"><?= $guru['nama'] ?></h3>

                <p class="text-muted text-center"><?= $guru['nip'] ?></p>

                <!-- <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                    </li>
                </ul> -->

                <!-- <b href="#" class="btn btn-primary btn-block"><b>Ganti Foto</b></a> -->
                <a href="<?= base_url('guru/edit/') . $guru['id'] ?>" class="btn btn-danger btn-block"><b>Edit Data</b></a>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Identitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alamat" data-toggle="tab">Data Pribadi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pegawai" data-toggle="tab">Kepegawaian</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tugas" data-toggle="tab">Tugas Tambahan</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">

                    <div class="active tab-pane" id="profil">

                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>

                                <tr>
                                    <th scope='row'>NIGK</th>
                                    <td><?= $guru['nip'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NO KK</th>
                                    <td><?= $guru['no_kk'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIK</th>
                                    <td><?= $guru['nik'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Lengkap</th>
                                    <td><?= $guru['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Tempat, Tanggal Lahir</th>
                                    <td><?= $guru['tempat'] ?>, <?= tgl_indo($guru['tgl_lahir']) ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jenis Kelamin</th>
                                    <td><?= $guru['jenkel'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Agama</th>
                                    <td><?= $guru['agama'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Email</th>
                                    <td><?= $guru['email'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>No HP</th>
                                    <td><?= $guru['no_hp'] ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="alamat">
                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>

                                <tr>
                                    <th scope='row'>Alamat</th>
                                    <td><?= $guru['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>RT</th>
                                    <td><?= $guru['rt'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>RW</th>
                                    <td><?= $guru['rw'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kelurahan</th>
                                    <td><?= $guru['desa'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kecamatan</th>
                                    <td><?= $guru['kecamatan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Kode Pos</th>
                                    <td><?= $guru['kodepos'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NPWP</th>
                                    <td><?= $guru['npwp'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama NPWP</th>
                                    <td><?= $guru['nama_npwp'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Ibu Kandung</th>
                                    <td><?= $guru['nama_ibu'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Status Perkawinan</th>
                                    <td><?= $guru['status_kawin'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Nama Pasangan</th>
                                    <td><?= $guru['nama_pasangan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Pekerjaan Pasangan</th>
                                    <td><?= $guru['pekerjaan_pasangan'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="pegawai">
                        <table class='table table-sm table-striped table-bordered'>
                            <tbody>

                                <tr>
                                    <th scope='row'>Status Kepegawaian</th>
                                    <td><?= $guru['status_pegawai'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIGK</th>
                                    <td><?= $guru['nip'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NIP</th>
                                    <td><?= $guru['nigk'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>NUPTK</th>
                                    <td><?= $guru['nuptk'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Jenis PTK</th>
                                    <td><?= $guru['jenis_ptk'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>SK Pengangkatan</th>
                                    <td><?= $guru['sk_pengangkatan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>TMT Pengangkatan</th>
                                    <td><?= $guru['tmt_pengangkatan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Lembaga Pengangkat</th>
                                    <td><?= $guru['lembaga_pengangkat'] ?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Sumber Gaji</th>
                                    <td><?= $guru['sumber_gaji'] ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="pendidikan">
                        <div class="table-responsive">
                            <table id='tablependidikan' class="table table-striped table-sm">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Bidang Studi</th>
                                        <th>Jenjang</th>
                                        <th>Satuan Pendidikan</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tahun Lulus</th>
                                        <th>Gelar Akademik</th>
                                        <th>NIM</th>
                                        <th>Fakultas</th>
                                        <th>IPK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($riwayat as $riwayat) : $no++; ?>
                                    <tr>
                                        <td scope="row"><?= $no ?></td>
                                        <td><?= $riwayat['bidang_studi'] ?></td>
                                        <td><?= $riwayat['jenjang'] ?></td>
                                        <td><?= $riwayat['satuan'] ?></td>
                                        <td><?= $riwayat['tahun_masuk'] ?></td>
                                        <td><?= $riwayat['tahun_keluar'] ?></td>
                                        <td><?= $riwayat['gelar'] ?></td>
                                        <td><?= $riwayat['nim'] ?></td>
                                        <td><?= $riwayat['fakultas'] ?></td>
                                        <td><?= $riwayat['ipk'] ?></td>

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class=" tab-pane" id="tugas">


                        <div class="table-responsive">
                            <table id='tabletugas' class="table table-striped table-sm">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Tugas Tambahan</th>
                                        <th>Nomor SK</th>
                                        <th>TMT</th>
                                        <th>TST</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($tugas as $tugas) : $no++; ?>
                                    <tr>
                                        <td scope="row"><?= $no ?></td>
                                        <td><?= $tugas['tugas_tambahan'] ?></td>
                                        <td><?= $tugas['sk'] ?></td>
                                        <td><?= $tugas['tmt'] ?></td>
                                        <td><?= $tugas['tst'] ?></td>

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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