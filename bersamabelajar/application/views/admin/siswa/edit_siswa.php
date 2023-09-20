<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <button class="btn-sm btn btn-primary mb-1" data-toggle="modal" data-target="#modalfoto"><i class="fas fa-edit"></i> Ganti Foto</button>
                <div class="text-center">
                    <form id=''>
                        <label class="label" data-toggle="tooltip" title="Change your avatar">
                            <img style='width:120px' class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/foto/') . $siswa['foto'] ?>" alt="User profile picture">
                            <!-- <input type="file" class="sr-only" id="profilinput" name="image" accept="image/jpg"> -->
                        </label>
                    </form>
                    <!-- <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/') . $siswa['foto'] ?>" alt="User profile picture"> -->
                </div>

                <h3 class="profile-username text-center"><?= $siswa['nama'] ?></h3>

                <p class="text-muted text-center"><?= $siswa['nis'] ?></p>

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
                    <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Data Siswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alamat" data-toggle="tab">Alamat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ortu" data-toggle="tab">Orang Tua</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sekolah" data-toggle="tab">Asal Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berkas" data-toggle="tab">Berkas</a></li>
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
                                <label class="col-sm-3 control-label">NOMER INDUK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nis' value="<?= $siswa['nis'] ?>" <?= $dis ?><?= $dis2 ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA LENGKAP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama' value="<?= $siswa['nama'] ?>" <?= $dis ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KELAS SEKARANG</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kelas" <?= $dis ?> <?= $dis2 ?>>
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $val) : ?>
                                            <?php if ($siswa['kelas'] == $val['id']) : ?>
                                                <option value='<?= $val['id'] ?>' selected><?= $val['id'] ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val['id'] ?>'><?= $val['id'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JURUSAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jurusan" <?= $dis ?> <?= $dis2 ?>>
                                        <option value="">Pilih Jurusan</option>
                                        <?php foreach ($jurusan as $val) : ?>
                                            <?php if ($siswa['jurusan'] == $val['id']) : ?>
                                                <option value='<?= $val['id'] ?>' selected><?= $val['id'] ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val['id'] ?>'><?= $val['id'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NISN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nisn' value="<?= $siswa['nisn'] ?>">
                                    <small id="helpnisn" class="text-danger"></small>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO KARTU KELUARGA</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='nokk' value="<?= $siswa['no_kk'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO KIP <small>(jika ada)</small></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nokip' value="<?= $siswa['no_kip'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nik' value="<?= $siswa['nik'] ?>">
                                    <small id="helpnik" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TEMPAT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tempat" value="<?= $siswa['tempat_lahir'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TANGGAL LAHIR</label>
                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name='tgl_lahir' value="<?= $siswa['tgl_lahir'] ?>" autocomplete='off'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JENIS KELAMIN</label>
                                <div class="col-sm-9">
                                    <select class='form-control' name='jk' required>
                                        <option value=''>Pilih Jenis Kelamin</option>
                                        <option value='L' <?php if ($siswa['jenkel'] == 'L') {
                                                                echo 'selected';
                                                            } ?>>Laki-laki</option>
                                        <option value='P' <?php if ($siswa['jenkel'] == 'P') {
                                                                echo 'selected';
                                                            } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">ANAK KE</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='anak_ke' value="<?= $siswa['anak_ke'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JUMLAH SAUDARA</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='saudara' value="<?= $siswa['saudara'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TINGGI BADAN (Cm)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='tinggi' value="<?= $siswa['tinggi'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">BERAT BADAN (Kg)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='berat' value="<?= $siswa['berat'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO HP</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='hp' value="<?= $siswa['no_hp'] ?>">
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
                                    <input type="text" class="form-control" name='alamat' value="<?= $siswa['alamat'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='rt' value="<?= $siswa['rt'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='rw' value="<?= $siswa['rw'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">DESA/KELURAHAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='desa' value="<?= $siswa['desa'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KECAMATAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kecamatan" value="<?= $siswa['kecamatan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">KOTA/KABUPATEN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='kota' value="<?= $siswa['kota'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PROVINSI</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='provinsi' value="<?= $siswa['provinsi'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">ALAT TRANSPORTASI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="transport">
                                        <option value="">Pilih Alat Transportasi</option>
                                        <?php foreach ($transport as $val) : ?>
                                            <?php if ($siswa['transportasi'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JENIS TINGGAL</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="tinggal">
                                        <option value="">Pilih Jenis Tinggal</option>
                                        <?php foreach ($jenistinggal as $val) : ?>
                                            <?php if ($siswa['tinggal'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">JARAK KE SEKOLAH</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='jarak' value="<?= $siswa['jarak'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">WAKTU TEMPUH</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='waktu' value="<?= $siswa['waktu'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="ortu">
                        <form id="formortu" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIK AYAH</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='nik_ayah' value="<?= $siswa['nik_ayah'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA AYAH</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama_ayah' value="<?= $siswa['nama_ayah'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TGL LAHIR AYAH</label>
                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name='tgl_ayah' value="<?= $siswa['tgl_lahir_ayah'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">STATUS AYAH</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_ayah">
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($status as $val) : ?>
                                            <?php if ($siswa['status_ayah'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PEKERJAAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pekerjaan_ayah">
                                        <option value="">Pilih Pekerjaan</option>
                                        <?php foreach ($pekerjaan as $val) : ?>
                                            <?php if ($siswa['pekerjaan_ayah'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PENDIDIKAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pendidikan_ayah">
                                        <option value="">Pilih Pendidikan</option>
                                        <?php foreach ($pendidikan as $val) : ?>
                                            <?php if ($siswa['pendidikan_ayah'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PENGHASILAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="penghasilan_ayah">
                                        <option value="">Pilih Penghasilan</option>
                                        <?php foreach ($penghasilan as $val) : ?>
                                            <?php if ($siswa['penghasilan_ayah'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NIK IBU</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name='nik_ibu' value="<?= $siswa['nik_ibu'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NAMA IBU</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nama_ibu' value="<?= $siswa['nama_ibu'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">TGL LAHIR IBU</label>
                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name='tgl_ibu' value="<?= $siswa['tgl_lahir_ibu'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">STATUS IBU</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_ibu">
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($status as $val) : ?>
                                            <?php if ($siswa['status_ibu'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PEKERJAAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pekerjaan_ibu">
                                        <option value="">Pilih Pekerjaan</option>
                                        <?php foreach ($pekerjaan as $val) : ?>
                                            <?php if ($siswa['pekerjaan_ibu'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PENDIDIKAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="pendidikan_ibu">
                                        <option value="">Pilih Pendidikan</option>
                                        <?php foreach ($pendidikan as $val) : ?>
                                            <?php if ($siswa['pendidikan_ibu'] == $val) : ?>
                                                <option value='<?= $val ?>' selected><?= $val ?></option>
                                            <?php else : ?>
                                                <option value='<?= $val ?>'><?= $val ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">PENGHASILAN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="penghasilan_ibu">
                                        <option value="">Pilih Penghasilan</option>
                                        <?php foreach ($penghasilan as $val) : ?>
                                            <?php if ($siswa['penghasilan_ibu'] == $val) : ?>
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

                    <div class="tab-pane" id="sekolah">
                        <form id='formsekolah' class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">ASAL SEKOLAH</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='asal' value="<?= $siswa['asal_sekolah'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO PESERTA UJIAN SMP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='nopes' value="<?= $siswa['no_ujian'] ?>" placeholder='contoh: 2-17-02-12-628-001-8'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO IJAZAH</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='ijazah' value="<?= $siswa['no_ijazah'] ?>" placeholder='Ex SMP: DN-02 DI/06 0201007 MTS:MTs-06 100047959'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">NO SHUN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='shun' value="<?= $siswa['no_shun'] ?>" placeholder='Contoh : DN-02 0198213'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="berkas">
                        <form id='formberkas' class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">KARTU KELUARGA <small>(format harus .jpg max-size 2mb)</small></label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="filekk" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Kartu Keluarga</label>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-success">Simpan</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= base_url('assets/berkas/') . $siswa['file_kk'] ?>"> <img src="<?= base_url('assets/berkas/') . $siswa['file_kk'] ?>" alt="..." class="img-thumbnail"></a>
                                </div>
                            </div>
                        </form>
                        <form id='formberkasakte' class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">AKTE KELAHIRAN <small>(format harus .jpg max-size 2mb)</small></label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileakte" id="fileakte" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Kartu Keluarga</label>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-success">Simpan</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= base_url('assets/berkas/') . $siswa['file_akte'] ?>"> <img src="<?= base_url('assets/berkas/') . $siswa['file_akte'] ?>" alt="..." class="img-thumbnail"></a>
                                </div>
                            </div>
                        </form>
                        <form id='formberkasijazah' class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">IJAZAH SMP/MTS <small>(format harus .jpg max-size 2mb)</small></label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileijazah" id="fileijazah" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Kartu Keluarga</label>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-success">Simpan</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= base_url('assets/berkas/') . $siswa['file_ijazah'] ?>"> <img src="<?= base_url('assets/berkas/') . $siswa['file_ijazah'] ?>" alt="..." class="img-thumbnail"></a>
                                </div>
                            </div>
                        </form>
                        <form id='formberkasshun' class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">SHUN SMP/MTS <small>(format harus .jpg max-size 2mb)</small></label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileshun" id="fileshun" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Kartu Keluarga</label>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-success">Simpan</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= base_url('assets/berkas/') . $siswa['file_shun'] ?>"> <img src="<?= base_url('assets/berkas/') . $siswa['file_shun'] ?>" alt="..." class="img-thumbnail"></a>
                                </div>
                            </div>
                        </form>

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
    $('#formfoto').submit(function(e) {
        e.preventDefault();
        var id = "<?= $siswa['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanfotoprofil/') ?>" + id,
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
                    $('#modalfoto').modal('hide');
                    notify('Foto Berhasil diperbarui');
                } else {
                    pesangagal('Foto Gagal diperbarui');
                }
            }
        })
    });
    $('#formprofil').submit(function(e) {
        var id;
        id = "<?= $siswa['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanprofil/') ?>" + id,
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
                    $("#helpnisn").html('');
                    $("#helpnik").html('');
                    notify('Data berhasil diubah');
                } else {
                    $("#helpnisn").html(data.nisn);
                    $("#helpnik").html(data.nik);
                    pesangagal('Data gagal diubah');

                }


            }
        })
        return false;
    });
    $('#formalamat').submit(function(e) {
        var id;
        id = "<?= $siswa['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanalamat/') ?>" + id,
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
    $('#formortu').submit(function(e) {
        var id;
        id = "<?= $siswa['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanortu/') ?>" + id,
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
    $('#formberkas').submit(function(e) {
        e.preventDefault();
        var id = "<?= $siswa['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanfilekk/') ?>" + id,
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

    $('#formberkasakte').submit(function(e) {
        e.preventDefault();
        var id = "<?= $siswa['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanfileakte/') ?>" + id,
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
    $('#formberkasijazah').submit(function(e) {
        e.preventDefault();
        var id = "<?= $siswa['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanfileijazah/') ?>" + id,
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
        var id = "<?= $siswa['id'] ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpanfileshun/') ?>" + id,
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
        id = "<?= $siswa['id'] ?>";
        console.log(id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('siswa/simpansekolah/') ?>" + id,
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
    var id = "<?= $siswa['id'] ?>";
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
                    $.ajax("<?= base_url('siswa/simpanfotoprofil/') ?>" + id, {
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