<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                KERJAKAN SOAL DENGAN BENAR
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsiv">
                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- The time line -->
                            <form action="<?= base_url('Kursus/cekquiz/') . encrypt_url($id_materi) ?>" method="post">

                                <?php
                                $no = 1;
                                foreach ($soal as $soal) :
                                ?>
                                    <div>

                                        <div class="card">
                                            <div class="card-header">
                                                <span class="time">Soal No : <?= $no++; ?></span>

                                                <?= $soal['soal'] ?>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-hover table-sm">
                                                    <tbody>
                                                        <?php
                                                        $opsi = $this->db->get_where('soal_opsi', ['id_soal' => $soal['id_soal']])->result_array();
                                                        foreach ($opsi as $opsi) :
                                                        ?>
                                                            <tr>
                                                                <td scope="row" style="width:10px">
                                                                    <input type="radio" name="jawab[<?= $opsi['id_soal'] ?>]" value="<?= $opsi['id_opsi'] ?>" id="jawab-<?= $opsi['id_opsi'] ?>" />
                                                                </td>
                                                                <td><?= $opsi['opsi'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <button type="submit" class="float-right btn btn-primary">Selesai</button>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>