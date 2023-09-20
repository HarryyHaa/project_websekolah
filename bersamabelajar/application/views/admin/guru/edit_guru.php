<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <button class="btn-sm btn btn-primary mb-1" data-toggle="modal" data-target="#modalfoto"><i class="fas fa-edit"></i> Ganti Foto</button>
                <div class="text-center">
                    <form id=''>
                        <label class="label" data-toggle="tooltip" title="Change your avatar">

                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/foto/') . $guru['foto'] ?>" alt="User profile picture">

                            <!-- <input type="file" class="sr-only" id="profilinput" name="image" accept="image/jpg"> -->
                        </label>
                    </form>
                    <!-- <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/') . $guru['foto'] ?>" alt="User profile picture"> -->
                </div>

                <h3 class="profile-username text-center"><?= $guru['nama'] ?></h3>

                <p class="text-muted text-center"><?= $guru['nip'] ?></p>

                <!-- Modal -->
                <div class="modal fade" id="modalfoto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ganti Foto Profil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id='formfoto'>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="foto">Pilih Foto</label>
                                        <input type="file" class="form-control-file" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" required>
                                        <small id="fileHelpId" class="form-text text-muted">Foto Harus *jpg atau *png max size 1024 kb</small>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="alert" role="alert"></div>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <img id="image" src="base_url('assets/img/') . $guru['foto']">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="crop">Crop</button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


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
                    <?php if ($akses == '3') {
                        $dis = 'readonly';
                    } else {
                        $dis = '';
                    } ?>
                    <?php if ($akses == '2') {
                        $dis2 = 'readonly';
                    } else {
                        $dis2 = '';
                    } ?>
                    <div class="active tab-pane" id="profil">
                        <form id="formprofil" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIY/NIGK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nip' value="<?= $guru['nip'] ?>" <?= $dis ?><?= $dis2 ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA LENGKAP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama' value="<?= $guru['nama'] ?>" <?= $dis ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO KK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nokk' value="<?= $guru['no_kk'] ?>">
                                    <small id="helpkk" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nik' value="<?= $guru['nik'] ?>">
                                    <small id="helpnik" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TEMPAT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tempat" value="<?= $guru['tempat'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TANGGAL LAHIR</label>
                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name='tgl_lahir' value="<?= $guru['tgl_lahir'] ?>" autocomplete='off'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JENIS KELAMIN</label>
                                <div class="col-sm-9">
                                    <select class='form-control' name='jk' required>
                                        <option value=''>Pilih Jenis Kelamin</option>
                                        <option value='L' <?php if ($guru['jenkel'] == 'L') {
                                                                echo 'selected';
                                                            } ?>>Laki-laki</option>
                                        <option value='P' <?php if ($guru['jenkel'] == 'P') {
                                                                echo 'selected';
                                                            } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">AGAMA</label>
                                <div class="col-sm-9">
                                    <select class='form-control' name='agama'>
                                        <option value='islam'>ISLAM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">EMAIL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='email' value="<?= $guru['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO HP</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='hp' value="<?= $guru['no_hp'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">GANTI PASSWORD</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='password'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="alamat">
                        <form id="formalamat" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">ALAMAT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='alamat' value="<?= $guru['alamat'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='rt' value="<?= $guru['rt'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='rw' value="<?= $guru['rw'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KAMPUNG/DUSUN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='dusun' value="<?= $guru['dusun'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">DESA/KELURAHAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='desa' value="<?= $guru['desa'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KECAMATAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kecamatan" value="<?= $guru['kecamatan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KODE POS</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='kodepos' value="<?= $guru['kodepos'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NPWP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='npwp' value="<?= $guru['npwp'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA WAJIB PAJAK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama_npwp' value="<?= $guru['nama_npwp'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">STATUS PERKAWINAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" id="">
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($status as $val) : ?>
                                            <?php if ($guru['status_kawin'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA SUAMI/ISTRI</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama_pasangan' value="<?= $guru['nama_pasangan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PEKERJAAN SUAMI/ISTRI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pekerjaan_pasangan" id="">
                                        <option value="">Pilih Pekerjaan</option>
                                        <?php foreach ($pekerjaan as $val) : ?>
                                            <?php if ($guru['pekerjaan_pasangan'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA IBU KANDUNG</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama_ibu' value="<?= $guru['nama_ibu'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class=" tab-pane" id="pegawai">
                        <form id="formpegawai" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIY/NIGK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='niy' value="<?= $guru['nip'] ?>" <?= $dis ?><?= $dis2 ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NUPTK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nuptk' value="<?= $guru['nuptk'] ?>">
                                    <small id="helpnama" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nip' value="<?= $guru['nigk'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">STATUS KEPEGAWAIAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_pegawai" id="">
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($status_pegawai as $val) : ?>
                                            <?php if ($guru['status_pegawai'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JENIS PTK</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jenis_ptk" id="">
                                        <option value="">Pilih Jenis</option>
                                        <?php foreach ($jenis_ptk as $val) : ?>
                                            <?php if ($guru['jenis_ptk'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">SK PENGANGKATAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='sk' value="<?= $guru['sk_pengangkatan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TMT PENGANGKATAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name='tmt' value="<?= $guru['tmt_pengangkatan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">LEMBAGA PENGANGKAT</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="lembaga" id="">
                                        <option value="">Pilih Lembaga</option>
                                        <?php foreach ($lembaga as $val) : ?>
                                            <?php if ($guru['lembaga_pengangkat'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">SUMBER GAJI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="sumber" id="">
                                        <option value="">Pilih Sumber</option>
                                        <?php foreach ($sumber as $val) : ?>
                                            <?php if ($guru['sumber_gaji'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pendidikan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id='formpendidikan'>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Bidang Studi <small>jurusan pendidikan</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='bidang'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Jenjang Pendidikan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="jenjang" id="">
                                                    <option value="">Pilih Jenjang</option>
                                                    <?php foreach ($jenjang as $val) : ?>

                                                        <option value='<?= $val ?>'><?= $val ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Gelar Akademik</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='gelar'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Satuan Pendidikan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='satuan'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Tahun Masuk</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name='masuk'>
                                            </div>
                                            <label class="col-sm-3 control-label">Tahun Lulus</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name='keluar'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">NIM/NIS/NISN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='nim'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Fakultas</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='fakultas'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Rata Ujian Akhir/IPK/GPA</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name='ipk'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class=" tab-pane" id="pendidikan">

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modelId"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='tablependidikan' class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
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
                                            <td><button data-id="<?= $riwayat['id'] ?>" class="hapusriwayat btn btn-sm btn-default"><i class="fas fa-trash"></i></button></td>
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
                    <div class="modal fade" id="modaltugas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tugas Tambahan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id='formtugas'>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Tugas Tambahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='tugas' required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Nomor SK</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name='sk' required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">TMT</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="tanggal form-control" name='tmt' required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">TST</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="tanggal form-control" name='tst'>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class=" tab-pane" id="tugas">

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaltugas"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='tabletugas' class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
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
                                            <td><button data-id="<?= $tugas['id'] ?>" class="hapustugas btn btn-sm btn-default"><i class="fas fa-trash"></i></button></td>
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
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function notify(pesan) {
        toastr.success(pesan);
    }

    function pesangagal(pesan) {
        toastr.error(pesan);
    }
    // $('#filekk').onchange(function(e) {
    //     e.preventDefault();
    // });
    $('#tablependidikan').on('click', '.hapusriwayat', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan menghapus data ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>guru/hapusriwayat",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $("#tablependidikan").load(window.location + " #tablependidikan");
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    $('#tabletugas').on('click', '.hapustugas', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "akan menghapus data ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>guru/hapustugas",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $("#tabletugas").load(window.location + " #tabletugas");
                            notify('Data berhasil dihapus');
                        }
                    }
                });
            }
        })

    });
    $('#formprofil').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanprofil/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({

                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $("#helpnama").html('');
                    $("#helpnik").html('');
                    notify('Data berhasil diubah');
                } else {
                    $("#helpnama").html(data.nama);
                    $("#helpnik").html(data.nik);
                    pesangagal('Data gagal diubah');

                }


            }
        })
        return false;
    });
    $('#formalamat').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanalamat/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({

                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    notify('Data berhasil diubah');
                } else {
                    pesangagal('Data gagal diubah');

                }
            }
        })
        return false;
    });
    $('#formpegawai').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanpegawai/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({

                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    notify('Data berhasil diubah');
                } else {
                    pesangagal('Data gagal diubah');

                }
            }
        })
        return false;
    });
    $('#formpendidikan').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanpendidikan/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({

                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $("#tablependidikan").load(window.location + " #tablependidikan");
                    $('#modelID').modal('hide');
                    notify('Data berhasil diubah');
                } else {
                    pesangagal('Data gagal diubah');

                }
            }
        })
        return false;
    });
    $('#formtugas').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpantugas/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({

                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $("#tabletugas").load(window.location + " #tabletugas");
                    $('#modaltugas').modal('hide');
                    notify('Data berhasil diubah');
                } else {
                    pesangagal('Data gagal diubah');

                }
            }
        })
        return false;
    });

    $('#formfoto').submit(function(e) {
        e.preventDefault();
        var id = "<?= $guru['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanfotoprofil/') ?>" + id,
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,

            beforeSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {

                    notify('Foto Berhasil diperbarui');
                } else {
                    pesangagal('Foto Gagal diperbarui');
                }
            }
        })
    });
    $('#formberkasijazah').submit(function(e) {
        e.preventDefault();
        var id = "<?= $guru['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanfileijazah/') ?>" + id,
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,

            beforeSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $('#fupForm').css("opacity", "");
                    notify('Data berhasil diperbarui');
                } else if (data == 'gagal') {
                    notify('Data gagal diperbarui');
                    $('#fupForm').css("opacity", "");
                } else {
                    notify('Isi Data terlebih dahulu');
                    $('#fupForm').css("opacity", "");
                }
            }
        })
    });
    $('#formberkasshun').submit(function(e) {
        e.preventDefault();
        var id = "<?= $guru['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpanfileshun/') ?>" + id,
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,

            beforeSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    $('#fupForm').css("opacity", "");
                    notify('Data berhasil diperbarui');
                } else if (data == 'gagal') {
                    notify('Data gagal diperbarui');
                    $('#fupForm').css("opacity", "");
                } else {
                    notify('Isi Data terlebih dahulu');
                    $('#fupForm').css("opacity", "");
                }
            }
        })
    });

    $('#formsekolah').submit(function(e) {
        var id;
        id = "<?= $guru['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('guru/simpansekolah/') ?>" + id,
            data: $(this).serialize(),
            beforeSend: function() {
                swal.fire({
                    text: 'Proses menyimpan data',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == 'sukses') {
                    notify('Data berhasil diubah');
                } else {
                    notify('Data gagal diubah');
                }
            }
        })
        return false;
    });
</script>
<!-- <script>
    var id = "<?= $guru['id'] ?>";
    window.addEventListener('DOMContentLoaded', function() {
        var avatar = document.getElementById('avatar');
        var image = document.getElementById('image');
        var input = document.getElementById('input');
        var $progress = $('.progress');
        var $progressBar = $('.progress-bar');
        var $alert = $('.alert');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function(e) {
            var files = e.target.files;
            var done = function(url) {
                input.value = '';
                image.src = url;
                $alert.hide();
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                $progress.show();
                $alert.removeClass('alert-success alert-warning');
                canvas.toBlob(function(blob) {
                    var formData = new FormData();

                    formData.append(avatar, blob);
                    console.log(formData);
                    $.ajax("<?= base_url('guru/simpanfotoprofil/') ?>" + id, {
                        type: 'POST',

                        data: formData,
                        processData: false,
                        contentType: false,

                        xhr: function() {
                            var xhr = new XMLHttpRequest();

                            xhr.upload.onprogress = function(e) {
                                var percent = '0';
                                var percentage = '0%';

                                if (e.lengthComputable) {
                                    percent = Math.round((e.loaded / e.total) * 100);
                                    percentage = percent + '%';
                                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                }
                            };

                            return xhr;
                        },

                        success: function() {
                            $alert.show().addClass('alert-success').text('Upload success');
                        },

                        error: function() {
                            avatar.src = initialAvatarURL;
                            $alert.show().addClass('alert-warning').text('Upload error');
                        },

                        complete: function() {
                            $progress.hide();
                        },
                    });
                });
            }
        });
    });
</script> -->