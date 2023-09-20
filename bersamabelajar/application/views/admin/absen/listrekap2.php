<h3>Rekap Absensi Bulan <?= bulan($bulan) . " " . $tahun ?> s/d <?= bulan($bulan2) . " " . $tahun2 ?></h3>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-striped table-sm" id="tablesiswa" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>Nama Siswa</th>

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
                $nis = $siswa['nis'];
                $tanggalawal = date('Y-m-d', mktime(0, 0, 0, $bulan, 01, $tahun));
                $tanggalakhir = date('Y-m-d', mktime(0, 0, 0, $bulan2, 31, $tahun2));
                $hitunghadir = $this->db->query("select * from si_absen where tanggal between '$tanggalawal' and '$tanggalakhir' and nis='$nis' and absen='H'")->num_rows();
                $hitungsakit = $this->db->query("select * from si_absen where tanggal between '$tanggalawal' and '$tanggalakhir' and nis='$nis' and absen='S'")->num_rows();
                $hitungizin = $this->db->query("select * from si_absen where tanggal between '$tanggalawal' and '$tanggalakhir' and nis='$nis' and absen='I'")->num_rows();
                $hitungalfa = $this->db->query("select * from si_absen where tanggal between '$tanggalawal' and '$tanggalakhir' and nis='$nis' and absen='A'")->num_rows();
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>
                        <?= $siswa['nis'] ?>
                    </td>
                    <td>
                        <?= $siswa['nama'] ?>
                    </td>
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
</script>