<div class="table-responsive">
    <form id='myform'>
        <table class="table table-hover table-striped table-sm" id="tablesiswa" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>NO</th>
                    <th>Nama Siswa</th>
                    <th>Absensi <input type="checkbox" name="all" id="checkall" />Hadir Semua</br></th>
                    <th>Ket</th>
                </tr>
            </thead>

            <tbody id='targetsiswa'>
                <?php $no = 0; ?>
                <input type='hidden' value="<?= $jumdata ?>" name="jumlahdata">
                <input type='hidden' value="<?= $tanggal ?>" name="tanggal">
                <?php foreach ($siswa as $siswa) : ?>
                    <?php $no++; ?>
                    <?php
                    $nis = $siswa['nis'];
                    $absen = $this->db->get_where('si_absen', ['nis' => $nis, 'tanggal' => $tanggal])->row_array();

                    if ($absen['absen'] == 'H') {
                        $ket1 = 'checked';
                    } else {
                        $ket1 = '';
                    }
                    if ($absen['absen'] == 'I') {
                        $ket2 = 'checked';
                    } else {
                        $ket2 = '';
                    }
                    if ($absen['absen'] == 'A') {
                        $ket3 = 'checked';
                    } else {
                        $ket3 = '';
                    }
                    if ($absen['absen'] == 'S') {
                        $ket4 = 'checked';
                    } else {
                        $ket4 = '';
                    }
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><input type='hidden' value="<?= $siswa['nis'] ?>" name="<?= $no ?>nis">
                            <?= $siswa['nama'] ?>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="absen form-check-input" type="radio" name="<?= $no ?>absen" value="H" <?= $ket1 ?> required> H
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="S" <?= $ket4 ?> required> S
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="I" <?= $ket2 ?> required> I
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class=" form-check-input" type="radio" name="<?= $no ?>absen" value="A" <?= $ket3 ?> required> A
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group" style="margin-bottom: 0px">

                                <input type="text" class="form-control" name="<?= $no ?>ket" aria-describedby="helpId" value="<?= $absen['ket'] ?>">

                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">Simpan Absen</button>
        </div>
    </form>
</div>
<script>
    $(function() {
        //hang on event of form with id=myform
        $("#myform").submit(function(e) {
            //prevent Default functionality
            e.preventDefault();
            //do your own request an handle the results
            $.ajax({
                url: '<?= base_url('absen/simpanabsen') ?>',
                type: 'post',
                data: $("#myform").serialize(),
                success: function(data) {

                    toastr.success('Data Berhasil Disimpan');
                }
            });

        });

    });
    var checked = false;

    $('#checkall').change(function() {
        $('.absen').prop('checked', this.checked);
    });

    // $('.cb-element').change(function() {
    //     if ($('.cb-element:checked').length == $('.cb-element').length) {
    //         $('#checkall').prop('checked', true);
    //     } else {
    //         $('#checkall').prop('checked', false);
    //     }
    // });
</script>