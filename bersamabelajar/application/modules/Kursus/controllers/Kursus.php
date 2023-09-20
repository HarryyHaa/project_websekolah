<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Kursus extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        ceklogin();
        $this->load->model('Kursus_model', 'sm');
        $this->load->library('datatables');
    }
    function index()
    {

        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            $guru = $this->db->get('guru')->result_array();
            $data = [
                'isi' => 'Kursus/v_kursus_admin',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'mapel' => $this->db->get('mapel')->result_array(),
                'guru' => $guru,
                'kelas' => $this->db->get('kelas')->result_array()
            ];
            $this->template->candy($data);
        } elseif ($akses == 2) {
            $guru = $this->db->get_where('guru', ['id_guru' => $id])->result_array();
            $data = [
                'isi' => 'Kursus/v_kursus_guru',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'mapel' => $this->db->get('mapel')->result_array(),
                'guru' => $guru,
                'kelas' => $this->db->get('kelas')->result_array(),
                'kursus' => $this->db->get_where('kursus', ['id_guru' => $id])->result_array()
            ];
            $this->template->candy($data);
        } else {

            $data = [
                'isi' => 'Kursus/v_kursus_siswa',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'mapel' => $this->db->get('mapel')->result_array(),
                'kelas' => $this->db->get('kelas')->result_array(),
                'kursus' => $this->db->get_where('kursus', ['status' => 1])->result_array(),
                'siswa' => $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array()
            ];
            $this->template->candy($data);
        }
    }
    function gurulist($idguru)
    {
        $guru = $this->db->get_where('guru', ['id_guru' => $idguru])->result_array();
        $data = [
            'isi' => 'Kursus/v_kursus_guru',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array(),
            'guru' => $guru,
            'kelas' => $this->db->get('kelas')->result_array(),
            'kursus' => $this->db->get_where('kursus', ['id_guru' => $idguru])->result_array()
        ];
        $this->template->candy($data);
    }
    function get_idt_kursus()
    {

        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            echo $this->sm->Ignited_dt();
        } else {
            echo $this->sm->Ignited_dt_guru();
        }
    }
    public function tambahdata()
    {
        ceklogin_guru();
        $mapel = $this->input->post('mapel');
        $status = $this->input->post('status');
        $guru = $this->input->post('guru');
        $kelas = $this->input->post('kelas');
        //$this->form_validation->set_rules('kelas', 'kelas', 'required');
        $this->form_validation->set_rules('mapel', 'mapel', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [

                'mapel' => form_error('mapel')
            ];
            echo json_encode($data);
        } else {

            $data = [
                'id_mapel' => $mapel,
                'status' => $status,
                'id_guru' => $guru,
                'kelas' => implode(",", $kelas)
            ];
            $cek = $this->db->get_where('kursus', ['id_guru' => $guru, 'id_mapel' => $mapel, 'kelas' => implode(",", $kelas)])->num_rows();
            if ($cek == 0) {
                $this->sm->createdata('kursus', $data);
                echo json_encode('sukses');
            } else {
                echo json_encode('gagal');
            }
        }
    }
    public function editdata()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $mapel = $this->input->post('mapel');
        $guru = $this->input->post('guru');
        $status = $this->input->post('status');
        $kelas = $this->input->post('kelas');
        $this->form_validation->set_rules('mapel', 'mapel', 'required');
        //$this->form_validation->set_rules('kelas', 'kelas', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'mapel' => form_error('mapel')


            ];
            echo json_encode($data);
        } else {
            $where = ['id_kursus' => $id];
            if ($kelas <> '') {
                $data = [
                    'id_mapel' => $mapel,
                    'id_guru' => $guru,
                    'status' => $status,
                    'kelas' => implode(",", $kelas)
                ];
            } else {
                $data = [
                    'id_mapel' => $mapel,
                    'id_guru' => $guru,
                    'status' => $status

                ];
            }
            $this->sm->ubahdata('kursus', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_kursus' => $id
        ];
        //$materi = $this->db->get_where('id_kursus', $where)->row_array();
        $this->db->query("DELETE materi,komentar,nilai_quiz from materi 
                            inner join komentar on materi.id_materi= komentar.id_materi
                            inner join nilai_quiz on materi.id_materi= nilai_quiz.id_materi
                            where materi.id_kursus='$id'");
        $this->sm->deletedata('kursus', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_kursus' => $id
        ];
        $datasiswa = $this->sm->ambilid('kursus', $where)->result();
        echo json_encode($datasiswa);
    }
    public function materi($id_kursus)
    {
        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            $guru = $this->db->get('guru')->result_array();
            $data = [
                'isi' => 'Kursus/v_materi',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'mapel' => $this->db->get('mapel')->result_array(),
                'guru' => $guru,
                'kelas' => $this->db->get('kelas')->result_array(),
                'materi' => $this->db->get_where('materi', ['id_kursus' => $id_kursus])->result_array(),
                'id_kursus' => $id_kursus
            ];
        } elseif ($akses == 2) {
            $guru = $this->db->get_where('guru', ['id_guru' => $id])->result_array();
            $data = [
                'isi' => 'Kursus/v_materi',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'mapel' => $this->db->get('mapel')->result_array(),
                'guru' => $guru,
                'kelas' => $this->db->get('kelas')->result_array(),
                'materi' => $this->db->get_where('materi', ['id_kursus' => $id_kursus])->result_array(),
                'id_kursus' => $id_kursus
            ];
        } elseif ($akses == 3) {

            $data = [
                'isi' => 'Kursus/v_materi_list',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
                'materi' => $this->db->get_where('materi', ['id_kursus' => $id_kursus, 'tgl_buka<=' => date('Y-m-d H:i:s')])->result_array(),
                'id_kursus' => $id_kursus,
                'tugas' => $this->db->get_where('tugas', ['id_kursus' => $id_kursus, 'tgl_buka<=' => date('Y-m-d H:i:s')])->result_array(),
            ];
        }

        $this->template->candy($data);
    }


    // CONTROLLER GURU
    function guru()
    {
        ceklogin_guru();
        $data = [
            'isi' => 'Kursus/v_kursus_guru',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array(),
            'guru' => $this->db->get('guru')->result_array(),
            'kelas' => $this->db->get('kelas')->result_array()
        ];
        $this->template->candy($data);
    }

    //KHUSUS MATERI KURSUS
    function get_idt_materi($id_kursus)
    {
        ceklogin_guru();
        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            $where = [

                'id_kursus' => $id_kursus
            ];
            echo $this->sm->Ignited_dt_materi('id_materi,pertemuan,kd,materi,tgl_buka,tgl_tutup', 'materi', $where);
        } else {
            $where = [
                'id_guru' => $id,
                'id_kursus' => $id_kursus
            ];
            echo $this->sm->Ignited_dt_materi('id_materi,pertemuan,kd,materi,tgl_buka,tgl_tutup', 'materi', $where);
        }
    }
    private function _uploadFile($filename, $fileinput)
    {
        $config['upload_path']          = './assets/berkas/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $filename;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fileinput)) {
            return $this->upload->data("file_name");
        }
    }
    public function add_materi()
    {
        ceklogin_guru();
        $pertemuan = $this->input->post('pertemuan');
        $kd = $this->input->post('kd');
        $materi = $this->input->post('materi');
        $komentar = $this->input->post('komentar');
        $tgl_buka = $this->input->post('buka');
        $tgl_tutup = $this->input->post('tutup');
        $guru = $this->input->post('guru');
        $isi = $this->input->post('isi');
        $kursus = $this->input->post('id_kursus');
        $jawab = $this->input->post('jawab');
        $kuis = $this->input->post('kuis');
        $this->form_validation->set_rules('kd', 'kd', 'required');
        $this->form_validation->set_rules('materi', 'materi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'kd' => form_error('kd'),
                'materi' => form_error('materi')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'pertemuan' => $pertemuan,
                'kd' => $kd,
                'materi' => $materi,
                'isi' => $isi,
                'komentar' => $komentar,
                'tgl_buka' => $tgl_buka,
                'tgl_tutup' => $tgl_tutup,
                'id_guru' => $guru,
                'id_kursus' => $kursus,
                'jawab' => $jawab,
                'kuis' => $kuis
            ];
            $this->sm->createdata('materi', $data);
        }
    }

    public function edit_materi()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $pertemuan = $this->input->post('pertemuan');
        $kd = $this->input->post('kd');
        $isi = $this->input->post('isi');
        $materi = $this->input->post('materi');
        $tgl_buka = $this->input->post('buka');
        $tgl_tutup = $this->input->post('tutup');
        $guru = $this->input->post('guru');
        $komentar = $this->input->post('komentar');
        $kursus = $this->input->post('id_kursus');
        $jawab = $this->input->post('jawab');
        $kuis = $this->input->post('kuis');
        $this->form_validation->set_rules('kd', 'kd', 'required');
        $this->form_validation->set_rules('materi', 'materi', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'kd' => form_error('kd'),
                'materi' => form_error('materi')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_materi' => $id];
            $data = [
                'pertemuan' => $pertemuan,
                'kd' => $kd,
                'isi' => $isi,
                'materi' => $materi,
                'tgl_buka' => $tgl_buka,
                'tgl_tutup' => $tgl_tutup,
                'id_guru' => $guru,
                'komentar' => $komentar,
                'id_kursus' => $kursus,
                'jawab' => $jawab,
                'kuis' => $kuis
            ];
            $this->sm->ubahdata('materi', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapus_materi()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_materi' => $id
        ];
        $this->sm->deletedata('materi', $where);
        echo json_encode('ok');
    }
    public function ambil_materi()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_materi' => $id
        ];
        $datasiswa = $this->sm->ambilid('materi', $where)->result();
        echo json_encode($datasiswa);
    }

    public function lihat($id)
    {
        if ($this->session->userdata('akses') == 3) {
            $this->addlog($id);
        }
        $materi = $this->db->get_where('materi', ['id_materi' => $id])->row_array();
        $guru = $this->db->get_where('guru', ['id_guru' => $materi['id_guru']])->row_array();
        $siswa = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('iduser')])->row_array();
        $data = [
            'isi' => 'Kursus/v_materi_lihat',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'komentar' => $this->db->query("select * from komentar where id_materi='$id' order by tgl DESC")->result_array(),
            'materi' => $materi,
            'logmateri' => $this->db->get_where('materi_log', ['id_materi' => $id])->num_rows(),
            'tugas' => $this->db->get_where('tugas_jawab', ['id_materi' => $id])->num_rows(),
            'guru' => $guru,
            'siswa' => $siswa
        ];
        $this->template->candy($data);
    }
    public function viewers($id)
    {
        $data = [
            'isi' => 'Kursus/v_materi_viewers',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array(),
            'logmateri' => $this->db->get_where('materi_log', ['id_materi' => $id])->result_array(),
            'id_materi' => $id
        ];
        $this->template->candy($data);
    }
    //tambah komentar
    public function addkomentar($id)
    {
        $akses = $this->session->userdata('akses');
        $komentar = $this->input->post('komentar');
        $this->form_validation->set_rules('komentar', 'komentar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'komentar' => form_error('komentar'),
            ];
            echo json_encode($data);
        } else {

            $data = [
                'jenis' => $akses,
                'id_user' => $this->session->userdata('iduser'),
                'id_materi' => $id,
                'komentar' => $komentar,
            ];
            $this->sm->createdata('komentar', $data);

            echo json_encode('sukses');
        }
    }
    public function addbalaskomentar()
    {
        $akses = $this->session->userdata('akses');
        $id = $this->input->post('id');
        $balas = $this->input->post('balas');
        $this->form_validation->set_rules('balas', 'balas', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'balas' => form_error('balas'),
            ];
            echo json_encode($data);
        } else {

            $data = [
                'jenis' => $akses,
                'id_user' => $this->session->userdata('iduser'),
                'id_komentar' => $id,
                'balas' => $balas,
            ];
            $this->sm->createdata('komentar_balas', $data);

            echo json_encode('sukses');
        }
    }
    public function hapuskomentar()
    {
        $id = $this->input->post('id');
        $where = [
            'id' => $id
        ];
        $where2 = [
            'id_komentar' => $id
        ];
        $this->sm->deletedata('komentar', $where);
        $this->sm->deletedata('komentar_balas', $where2);
        echo json_encode('ok');
    }
    public function hapusbalaskomentar()
    {
        $id = $this->input->post('id');
        $where = [
            'id' => $id
        ];
        $this->sm->deletedata('komentar_balas', $where);
        echo json_encode('ok');
    }
    public function addlog($id)
    {
        $materi = $this->db->get_where('materi', ['id_materi' => $id])->row_array();
        $cek = $this->db->get_where('materi_log', ['id_user' => $this->session->userdata('iduser'), 'id_materi' => $id])->num_rows();
        if ($cek == 0) {
            $data = [
                'id_user' => $this->session->userdata('iduser'),
                'id_materi' => $id,
                'log' => 'kamu membuka materi "' . $materi['materi'] . '"',

            ];
            $this->sm->createdata('materi_log', $data);
            $siswa = $this->db->get_where('siswa', ['id_siswa' =>  $this->session->userdata('iduser')])->row_array();
            $guru = $this->db->get_where('guru', ['id_guru' => $materi['id_guru']])->row_array();
            $chatid = $guru['chatid'];
            $mesage = "Nama : " . $siswa['nama'] . "\nKelas : " . $siswa['kelas'] . "\nTelah Melihat Materi " . $materi['materi'] . "\n" . date('Y-m-d H:i:s');
            $this->telegram_lib->sendmsg($chatid, $mesage);
        }
    }

    //LATIHAN SOAL MATERI SETIAP PERTEMUAN
    public function soal($id) //$id itu id materi
    {
        $data = [
            'isi' => 'Kursus/v_materi_soal',
            'soal' => $this->db->get_where('soal', ['id_materi' => $id])->result_array(),
            'id_materi' => $id
        ];
        $this->template->candy($data);
    }
    public function tambah_soal()
    {
        ceklogin_guru();
        $soal = $this->input->post('soal');
        $pilA = $this->input->post('pilA');
        $pilB = $this->input->post('pilB');
        $pilC = $this->input->post('pilC');
        $pilD = $this->input->post('pilD');
        $pilE = $this->input->post('pilE');
        $kunci = $this->input->post('kunci');
        $id_materi = $this->input->post('id_materi');
        $this->form_validation->set_rules('soal', 'soal', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'soal' => form_error('soal')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'soal' => $soal,
                'pilA' => $pilA,
                'pilB' => $pilB,
                'pilC' => $pilC,
                'pilD' => $pilD,
                'pilE' => $pilE,
                'kunci' => $kunci,
                'id_materi' => $id_materi
            ];
            $this->sm->createdata('soal', $data);
        }
    }
    public function add_soal()
    {
        ceklogin_guru();
        $soal = $this->input->post('soal');
        $opsi = $this->input->post('opsi');
        $kunci = $this->input->post('kunci');
        $id_materi = $this->input->post('id_materi');
        $this->form_validation->set_rules('soal', 'soal', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'soal' => form_error('soal')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'soal' => $soal,
                'id_materi' => $id_materi
            ];
            $this->sm->createdata('soal', $data);
            $id_soal = $this->db->insert_id();

            foreach ($opsi as  $key => $opsi) {

                $benar = (isset($kunci[$key])) ? 1 : 0;
                $data = [
                    'id_soal' => $id_soal,
                    'opsi' => $opsi,
                    'benar' => $benar

                ];
                $this->sm->createdata('soal_opsi', $data);
            }
        }
    }
    public function hapus_soal()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_soal' => $id
        ];
        $this->sm->deletedata('soal', $where);
        $this->sm->deletedata('soal_opsi', $where);
        echo json_encode('ok');
    }

    //ini khusus kuiz siswa

    public function quiz($id) //$id itu id materi
    {

        $id = decrypt_url($id);
        $ceknilai = $this->db->get_where('nilai_quiz', ['id_siswa' => $this->session->userdata('iduser'), 'id_materi' => $id])->num_rows();
        if ($ceknilai <> 0) {
            redirect('Kursus/materi/' . $id);
        }
        $data = [
            'isi' => 'Kursus/v_materi_quiz',
            'soal' => $this->db->get_where('soal', ['id_materi' => $id])->result_array(),
            'id_materi' => $id
        ];
        $this->template->candy($data);
    }
    public function cekquiz($id) //id materi
    {
        $id = decrypt_url($id);
        $jawab = $this->input->post('jawab');
        $jumsoal = $this->db->get_where('soal', ['id_materi' => $id])->num_rows();
        $betul = 0;
        $salah = 0;
        foreach ($jawab as $id_soal => $jawaban) {
            $cek = $this->db->get_where('soal_opsi', ['id_soal' => $id_soal, 'id_opsi' => $jawaban, 'benar' => 1])->num_rows();
            if ($cek > 0) {
                $betul += 1;
            } else {
                $salah += 1;
            }
        }
        $bagi = $jumsoal / 100;
        $skor = $betul / $bagi;

        $skor = round($skor, 2);
        //simpan nilai ke database

        $ceknilai = $this->db->get_where('nilai_quiz', ['id_siswa' => $this->session->userdata('iduser'), 'id_materi' => $id])->num_rows();
        if ($ceknilai == 0) {
            $datanilai = [
                'id_siswa' => $this->session->userdata('iduser'),
                'id_materi' => $id,
                'nilai' => $skor,
                'benar' => $betul,
                'salah' => $salah
            ];
            $this->db->insert('nilai_quiz', $datanilai);
        }

        $data = [
            'isi' => 'Kursus/v_materi_quiz_hasil',
            'salah' => $salah,
            'betul' => $betul,
            'skor' => $skor

        ];
        $this->template->candy($data);
    }
    public function nilaiquis($id) //$id itu id materi
    {

        $data = [
            'isi' => 'Kursus/v_nilai_quiz',
            'nilai' => $this->db->get_where('nilai_quiz', ['id_materi' => $id])->result_array(),
            'id_materi' => $id
        ];
        $this->template->candy($data);
    }
    public function export_nilai($id)
    {
        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Lolipop')
            ->setLastModifiedBy('Lolipop')
            ->setTitle("Data Nilai Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NILAI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nilai = $this->db->get_where('nilai_quiz', ['id_materi' => $id])->result_array();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($nilai as $data) {
            $siswa = $this->db->get_where('siswa', ['id_siswa' => $data['id_siswa']])->row_array(); // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $siswa['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $siswa['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nilai']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, "");

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Nilai PJJ");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA SISWA.xlsx"');
        $object_writer->save('php://output');
    }
    public function export_view($id)
    {
        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Lolipop')
            ->setLastModifiedBy('Lolipop')
            ->setTitle("Data View Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA KEAKTIFAN SISWA PJJ"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "AKSES TANGGAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $log = $this->db->get_where('materi_log', ['id_materi' => $id])->result_array();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($log as $data) {
            $siswa = $this->db->get_where('siswa', ['id_siswa' => $data['id_user']])->row_array(); // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $siswa['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $siswa['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['tgl']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, "");

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Keaktifan PJJ");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA VIEW SISWA.xlsx"');
        $object_writer->save('php://output');
    }

    //khusus menu tugas 
    function get_idt_tugas($id_kursus)
    {
        ceklogin_guru();
        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            $where = [

                'id_kursus' => $id_kursus
            ];
            echo $this->sm->Ignited_dt_tugas('id_tugas,judul,tugas,tgl_buka,tgl_tutup', 'tugas', $where);
        } else {
            $where = [
                'id_guru' => $id,
                'id_kursus' => $id_kursus
            ];
            echo $this->sm->Ignited_dt_tugas('id_tugas,judul,tugas,tgl_buka,tgl_tutup', 'tugas', $where);
        }
    }
    public function add_tugas()
    {
        ceklogin_guru();
        $judul = $this->input->post('judul');
        $tugas = $this->input->post('tugas');
        $tgl_buka = $this->input->post('buka');
        $tgl_tutup = $this->input->post('tutup');
        $guru = $this->input->post('guru');
        $kursus = $this->input->post('id_kursus');
        $komentar = $this->input->post('komentar');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('buka', 'buka', 'required');
        $this->form_validation->set_rules('tutup', 'tutup', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'judul' => form_error('judul'),
                'tugas' => form_error('tugas'),
                'buka' => form_error('buka'),
                'tutup' => form_error('tutup')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'judul' => $judul,
                'tugas' => $tugas,
                'komentar' => $komentar,
                'tgl_buka' => $tgl_buka,
                'tgl_tutup' => $tgl_tutup,
                'id_guru' => $guru,
                'id_kursus' => $kursus
            ];
            $this->sm->createdata('tugas', $data);
        }
    }
    public function ambil_tugas()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_tugas' => $id
        ];
        $datasiswa = $this->sm->ambilid('tugas', $where)->result();
        echo json_encode($datasiswa);
    }
    public function edit_tugas()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $tugas = $this->input->post('tugas');
        $tgl_buka = $this->input->post('buka');
        $tgl_tutup = $this->input->post('tutup');
        $guru = $this->input->post('guru');
        $kursus = $this->input->post('id_kursus');
        $komentar = $this->input->post('komentar');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('buka', 'buka', 'required');
        $this->form_validation->set_rules('tutup', 'tutup', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'judul' => form_error('judul'),
                'tugas' => form_error('tugas'),
                'buka' => form_error('buka'),
                'tutup' => form_error('tutup')
            ];
            echo json_encode($data);
        } else {
            $where = ['id_tugas' => $id];
            $data = [
                'judul' => $judul,
                'tugas' => $tugas,
                'komentar' => $komentar,
                'tgl_buka' => $tgl_buka,
                'tgl_tutup' => $tgl_tutup,
                'id_guru' => $guru,
                'id_kursus' => $kursus
            ];
            $this->sm->ubahdata('tugas', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapus_tugas()
    {
        ceklogin_guru();
        $id = $this->input->post('id');
        $where = [
            'id_tugas' => $id
        ];
        $this->sm->deletedata('tugas', $where);
        echo json_encode('ok');
    }
    public function lihattugas($id)
    {

        $tugas = $this->db->get_where('tugas', ['id_tugas' => $id])->row_array();
        $guru = $this->db->get_where('guru', ['id_guru' => $tugas['id_guru']])->row_array();
        $siswa = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('iduser')])->row_array();
        $data = [
            'isi' => 'Kursus/v_tugas_lihat',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'komentar' => $this->db->query("select * from komentar where id_materi='$id' order by tgl DESC")->result_array(),
            'tugas' => $tugas,
            'guru' => $guru,
            'siswa' => $siswa,
            'jawabtugas' => $this->db->get_where('tugas_jawab', ['id_tugas' => $id])->num_rows()
        ];
        $this->template->candy($data);
    }
    public function kirim_tugas($idtugas)
    {
        $this->load->library('upload');
        $id = $this->session->userdata('iduser');
        $cek = $this->db->get_where('tugas_jawab', ['id_siswa' => $id, 'id_tugas' => $idtugas])->num_rows();
        $config['upload_path'] = './assets/tugas'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|docx|pptx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/tugas/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '90%';
                $config['width'] = 400;
                $config['height'] = 510;
                $config['new_image'] = './assets/tugas/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                $data = [
                    'id_tugas' => $idtugas,
                    'id_siswa' => $id,
                    'file' => $gambar

                ];
                if ($cek == 0) {
                    $this->sm->createdata('tugas_jawab', $data);
                }
            }
        }
        redirect('Kursus/lihattugas/' . $idtugas);
    }

    public function kirim_jawaban($idmateri)
    {
        
   
                $jawaban = $this->input->post('jawaban');
                $id = $this->session->userdata('iduser');
                $cek = $this->db->get_where('tugas_jawab', ['id_siswa' => $id, 'id_materi' => $idmateri])->num_rows();

                $config['upload_path'] = './assets/tugas'; //path folder
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|docx|pptx'; //type yang dapat diakses bisa anda sesuaikan
                 $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
                $this->upload->initialize($config);

                 if(isset($_FILES['filename']) && !empty($_FILES['filename']['name'])) {
                    $filesCount = count($_FILES['filename']['name']);
                     for($i = 0; $i < $filesCount; $i++){

                    $_FILES['file']['name']  = $_FILES['filename']['name'][$i];
                    $_FILES['file']['type']  = $_FILES['filename']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['filename']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['filename']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['filename']['size'][$i];


             //   if (!empty($_FILES['file']['name'])) {
           // if ($this->upload->do_upload('file')) {        
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/tugas/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '90%';
                $config['width'] = 500;
                $config['new_image'] = './assets/tugas/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                $data = [
                    'id_materi' => $idmateri,
                    'jawaban' => $jawaban,
                    'id_siswa' => $id,
                    'file' => $gambar

                ];
                if ($cek == 0) {
                    $this->sm->createdata('tugas_jawab', $data);
                }
            }
        } else {
            $data = [
                'id_materi' => $idmateri,
                'jawaban' => $jawaban,
                'id_siswa' => $id
            ];
            if ($cek == 0) {
                $this->sm->createdata('tugas_jawab', $data);
            }
        }
        redirect('Kursus/lihat/' . $idmateri);
    //  }
//
  //         }
    //      }

      //      }
       // }
    }
        

     /*   $this->load->library('upload');
        $jawaban = $this->input->post('jawaban');
        $id = $this->session->userdata('iduser');
        $cek = $this->db->get_where('tugas_jawab', ['id_siswa' => $id, 'id_materi' => $idmateri])->num_rows();

        $config['upload_path'] = './assets/tugas'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|docx|pptx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {        
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/tugas/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '90%';
                $config['width'] = 500;
                $config['new_image'] = './assets/tugas/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                $data = [
                    'id_materi' => $idmateri,
                    'jawaban' => $jawaban,
                    'id_siswa' => $id,
                    'file' => $gambar

                ];
                if ($cek == 0) {
                    $this->sm->createdata('tugas_jawab', $data);
                }
            }
        } else {
            $data = [
                'id_materi' => $idmateri,
                'jawaban' => $jawaban,
                'id_siswa' => $id
            ];
            if ($cek == 0) {
                $this->sm->createdata('tugas_jawab', $data);
            }
        }
        redirect('Kursus/lihat/' . $idmateri);*/
     // }

    //  }
  //  }

    public function viewtugas($id)
    {
        $data = [
            'isi' => 'Kursus/v_materi_lihat_tugas.php',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array(),
            'tugas' => $this->db->get_where('tugas_jawab', ['id_materi' => $id])->result_array(),
            'id_materi' => $id
        ];
        $this->template->candy($data);
    }
    public function edit_nilai()
    {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $aksi = $this->input->post('action');
        if ($aksi == 'edit') {
            $this->sm->ubahdata('tugas_jawab', ['nilai' => $nilai], ['id' => $id]);
        } else if ($aksi == 'delete') {
            $this->sm->deletedata('tugas_jawab', ['id' => $id]);
        }
        echo json_encode($aksi);
    }
    public function export_nilai_tugas($id)
    {
        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Lolipop')
            ->setLastModifiedBy('Lolipop')
            ->setTitle("Data Nilai Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NILAI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nilai = $this->db->get_where('tugas_jawab', ['id_materi' => $id])->result_array();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($nilai as $data) {
            $siswa = $this->db->get_where('siswa', ['id_siswa' => $data['id_siswa']])->row_array(); // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $siswa['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $siswa['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nilai']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['tgl']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Nilai PJJ");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA NILAI SISWA.xlsx"');
        $object_writer->save('php://output');
    }

    public function jawabtugas($id)
    {
        $data = [
            'isi' => 'Kursus/v_tugas_jawab.php',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'mapel' => $this->db->get('mapel')->result_array(),
            'tugas' => $this->db->get_where('tugas_jawab', ['id_tugas' => $id])->result_array(),
            'id_tugas' => $id
        ];
        $this->template->candy($data);
    }
    public function export_nilai_tugas2($id)
    {
        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Lolipop')
            ->setLastModifiedBy('Lolipop')
            ->setTitle("Data Nilai Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NILAI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nilai = $this->db->get_where('tugas_jawab', ['id_tugas' => $id])->result_array();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($nilai as $data) {
            $siswa = $this->db->get_where('siswa', ['id_siswa' => $data['id_siswa']])->row_array(); // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $siswa['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $siswa['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nilai']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['tgl']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Nilai PJJ");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA NILAI SISWA.xlsx"');
        $object_writer->save('php://output');
    }
}
