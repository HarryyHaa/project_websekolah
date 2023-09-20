<h3>Rekap Absensi Bulan <?= bulan($bulan) . " " . $tahun ?></h3>
<div class="table-responsive">
    <table style="font-size:12px" class="table table-hover table-bordered table-striped table-sm" id="tablesiswa" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>Nama Siswa</th>
                <?php $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                for ($i = 1; $i < $tgl + 1; $i++) { ?>
                    <th><?= $i ?></th>
                <?php } ?>
                <th>H</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
        </thead>
        <tbody id='targetsiswa'>
            <?php $no = 0; ?>
            <?php foreach ($siswa as $siswa) : ?>
                <?php $no++; ?>
                <?php
                $id_user = $siswa['id_siswa'];
                $hitunghadir = $this->db->get_where('absen_siswa', ['MONTH(tgl)' => $bulan, 'YEAR(tgl)' => $tahun, 'id_user' => $id_user, 'absen' => 'H'])->num_rows();
                $hitungsakit = $this->db->get_where('absen_siswa', ['MONTH(tgl)' => $bulan, 'YEAR(tgl)' => $tahun, 'id_user' => $id_user, 'absen' => 'S'])->num_rows();
                $hitungizin = $this->db->get_where('absen_siswa', ['MONTH(tgl)' => $bulan, 'YEAR(tgl)' => $tahun, 'id_user' => $id_user, 'absen' => 'I'])->num_rows();
                $hitungalfa = $this->db->get_where('absen_siswa', ['MONTH(tgl)' => $bulan, 'YEAR(tgl)' => $tahun, 'id_user' => $id_user, 'absen' => 'A'])->num_rows();
                ?>
                <tr>
                    <td><?= $no ?></td>

                    <td>
                        <?= $siswa['nama'] ?>
                    </td>

                    <?php $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tgl + 1; $i++) { ?>
                        <?php $tglbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = $this->db->query("select * from absen_siswa where date(tgl)='$tglbaru' and id_user='$id_user'")->row_array();
                        if ($cekabsen) { ?>
                            <td><?= $cekabsen['absen'] ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                    <?php } ?>

                    <td>
                        <?= $hitunghadir ?>
                    </td>
                    <td>
                        <?= $hitungsakit ?>
                    </td>
                    <td>
                        <?= $hitungizin ?>
                    </td>
                    <td>
                        <?= $hitungalfa ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

    <button id="btnExport" class="btn btn-primary" btn-lg btn-block">EXPORT EXCEL</button>
</div>
<script>
    $("#btnExport").click(function(e) {
        e.preventDefault();

        //getting data from our table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('tablesiswa');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');

        var a = document.createElement('a');
        a.href = data_type + ', ' + table_html;
        a.download = 'RekapAbsen_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
        a.click();
    });
</script>