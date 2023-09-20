<?php
function buat_tanggal($format, $time = null)
{
    $time = ($time == null) ? time() : strtotime($time);
    $str = date($format, $time);
    for ($t = 1; $t <= 9; $t++) {
        $str = str_replace("0$t ", "$t ", $str);
    }
    $str = str_replace("Jan", "Januari", $str);
    $str = str_replace("Feb", "Februari", $str);
    $str = str_replace("Mar", "Maret", $str);
    $str = str_replace("Apr", "April", $str);
    $str = str_replace("May", "Mei", $str);
    $str = str_replace("Jun", "Juni", $str);
    $str = str_replace("Jul", "Juli", $str);
    $str = str_replace("Aug", "Agustus", $str);
    $str = str_replace("Sep", "September", $str);
    $str = str_replace("Oct", "Oktober", $str);
    $str = str_replace("Nov", "Nopember", $str);
    $str = str_replace("Dec", "Desember", $str);
    $str = str_replace("Mon", "Senin", $str);
    $str = str_replace("Tue", "Selasa", $str);
    $str = str_replace("Wed", "Rabu", $str);
    $str = str_replace("Thu", "Kamis", $str);
    $str = str_replace("Fri", "Jumat", $str);
    $str = str_replace("Sat", "Sabtu", $str);
    $str = str_replace("Sun", "Minggu", $str);
    return $str;
}
function jump($page)
{
    echo "<script>location=('$page');</script>";
}
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function hari_ini($hari)
{
    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}
function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
}
function progresdata($kelas)
{
    $ci = get_instance();
    $where = [
        'kelas'  => $kelas,
        'nisn <>'   => '',
        'no_kk <>'  => '',
        'nik <>' => '',
        'tempat_lahir <>' => '',
        'tgl_lahir <>' => '',
        'asal_sekolah <>' => '',
        'nama_ibu <>' => '',
        'tgl_lahir_ibu <>' => '',
        'pendidikan_ibu <>' => '',
        'pekerjaan_ibu <>' => '',
        'penghasilan_ibu <>' => '',
        'nama_ayah <>' => '',
        'tgl_lahir_ayah <>' => '',
        'pendidikan_ayah <>' => '',
        'pekerjaan_ayah <>' => '',
        'penghasilan_ayah <>' => '',
        'alamat <>' => '',
        'rt <>' => '',
        'rw <>' => '',
        'desa <>' => '',
        'kecamatan <>' => '',
        'kota <>' => '',
        'tinggal <>' => '',
        'transportasi <>' => '',
        'jarak <>' => '',
        'waktu <>' => '',
        'tinggi <>' => '',
        'berat <>' => '',
        'anak_ke <>' => '',
        'saudara <>' => '',
        'aktif' => 1
    ];

    $progress = $ci->db->get_where('si_siswa', $where)->num_rows();
    return $progress;
}
function cekstatus($nis)
{
    $ci = get_instance();
    $where = [
        'nis'  => $nis,
        'nisn <>'   => '',
        'no_kk <>'  => '',
        'nik <>' => '',
        'tempat_lahir <>' => '',
        'tgl_lahir <>' => '',
        'asal_sekolah <>' => '',
        'nama_ibu <>' => '',
        'tgl_lahir_ibu <>' => '',
        'pendidikan_ibu <>' => '',
        'pekerjaan_ibu <>' => '',
        'penghasilan_ibu <>' => '',
        'nama_ayah <>' => '',
        'tgl_lahir_ayah <>' => '',
        'pendidikan_ayah <>' => '',
        'pekerjaan_ayah <>' => '',
        'penghasilan_ayah <>' => '',
        'alamat <>' => '',
        'rt <>' => '',
        'rw <>' => '',
        'desa <>' => '',
        'kecamatan <>' => '',
        'kota <>' => '',
        'tinggal <>' => '',
        'transportasi <>' => '',
        'jarak <>' => '',
        'waktu <>' => '',
        'tinggi <>' => '',
        'berat <>' => '',
        'anak_ke <>' => '',
        'saudara <>' => '',
        'aktif' => 1
    ];

    $cek = $ci->db->get_where('siswa', $where)->num_rows();
    if ($cek <> 1) {
        echo "<span class='text-danger'><i class='fas fa-times'></i></span>";
    } else {
        echo "<span class='text-success'><i class='fas fa-check'></i></span>";
    }
}
function ceklogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('iduser')) {
        redirect('Login');
        exit;
    }
}
function ceklogin_admin()
{
    $ci = get_instance();
    $akses = $ci->session->userdata('akses');
    if ($akses == '1') {
    } else {
        redirect('Home');
        exit;
    }
}
function ceklogin_guru()
{
    $ci = get_instance();
    $akses = $ci->session->userdata('akses');
    if ($akses == '2' or $akses == '1') {
    } else {
        redirect('Home');
        exit;
    }
    //else {
    //     $role_id = $ci->session->userdata('role_id');
    //     $menu = $ci->uri->segment(1);
    //     $qmenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    //     $menu_id = $qmenu['id'];
    //     $userakses = $ci->db->get_where(
    //         'user_access_menu',
    //         [
    //             'role_id' => $role_id,
    //             'menu_id' => $menu_id
    //         ]
    //     );
    //     if ($userakses->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}
