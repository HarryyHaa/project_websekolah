<?php
defined('BASEPATH') or exit('No direct script access allowed');

class soal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_guru();
        $this->load->model('soal_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $this->output->cache(1);
        $data = [
            'isi' => 'Soal/v_bank',
            'mapel' => $this->db->get('mapel')->result_array(),
            'level' => $this->db->get('level')->result_array(),
            'sesi' => $this->db->get('sesi')->result_array(),
            'kelas' => $this->db->get('kelas')->result_array(),
            'jurusan' => $this->db->get('jurusan')->result_array(),
            'guru' => $this->db->get('guru')->result_array(),
            'agama' => ['Islam', 'Kristen']
        ];
        $this->template->candy($data);
    }
    function get_idt_bank()
    {
        echo $this->sm->Ignited_dt_bank();
    }
    function get_idt_soal()
    {
        echo $this->sm->Ignited_dt('id_soal,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE', 'soal', array());
    }


    public function tambahbank()
    {
        $nama = $this->input->post('nama');
        $mapel = $this->input->post('mapel');
        $level = $this->input->post('level');
        $kelas = $this->input->post('kelas');
        $jurusan = $this->input->post('jurusan');
        $jmlpg = $this->input->post('jmlpg');
        $bobotpg = $this->input->post('bobotpg');
        $jmlesai = $this->input->post('jmlesai');
        $bobotesai = $this->input->post('bobotesai');
        $guru = $this->input->post('guru');
        $kkm = $this->input->post('kkm');
        $opsi = $this->input->post('opsi');
        //FORM VALIDASI
        $this->form_validation->set_rules('nama', 'Nama Bank', 'is_unique[banksoal.nama_banksoal]|required');
        $this->form_validation->set_rules('mapel', 'mapel', 'trim|required');
        // $this->form_validation->set_rules('level', 'level', 'required');
        // $this->form_validation->set_rules('kelas', 'kelas', 'required');
        // $this->form_validation->set_rules('jurusan', 'jurusan', 'required');
        $this->form_validation->set_rules('jmlpg', 'jmlpg', 'trim|required');
        $this->form_validation->set_rules('jmlesai', 'jmlesai', 'trim|required');
        $this->form_validation->set_rules('bobotpg', 'bobotpg', 'trim|required');
        $this->form_validation->set_rules('bobotesai', 'bobotesai', 'trim|required');
        $this->form_validation->set_rules('guru', 'guru', 'trim|required');
        $this->form_validation->set_rules('kkm', 'kkm', 'trim|required');
        $this->form_validation->set_rules('opsi', 'opsi', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // $errors = validation_errors();
            $data = [
                'mapel' => form_error('mapel'),
                'nama' => form_error('nama'),
                // 'level' => form_error('level'),
                // 'kelas' => form_error('kelas'),
                // 'jurusan' => form_error('jurusan'),
                'jmlpg' => form_error('jmlpg'),
                'jmlesai' => form_error('jmlesai'),
                'bobotpg' => form_error('bobotpg'),
                'bobotesai' => form_error('bobotesai'),
                'guru' => form_error('guru'),
                'kkm' => form_error('kkm')

            ];
            echo json_encode($data);
        } else {

            $data = [
                'mapel' => $mapel,
                'nama_banksoal' => $nama,
                'level' => json_encode($level),
                'kelas' => json_encode($kelas),
                'jurusan' => json_encode($jurusan),
                'jml_pg' => $jmlpg,
                'jml_esai' => $jmlesai,
                'bobot_pg' => $bobotpg,
                'bobot_esai' => $bobotesai,
                'opsi' => $opsi,
                'guru' => $guru,
                'kkm' => $kkm

            ];
            $this->sm->createdata('banksoal', $data);
            echo json_encode('sukses');
        }
    }
    public function editbank()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $mapel = $this->input->post('mapel');
        $level = $this->input->post('level');
        $kelas = $this->input->post('kelas');
        $jurusan = $this->input->post('jurusan');
        $jmlpg = $this->input->post('jmlpg');
        $bobotpg = $this->input->post('bobotpg');
        $jmlesai = $this->input->post('jmlesai');
        $bobotesai = $this->input->post('bobotesai');
        $guru = $this->input->post('guru');
        $kkm = $this->input->post('kkm');
        $opsi = $this->input->post('opsi');
        $this->form_validation->set_rules('mapel', 'Mapel', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [

                'mapel' => form_error('mapel')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_banksoal' => $id];
            $data = [
                'mapel' => $mapel,
                'nama_banksoal' => $nama,
                'level' => json_encode($level),
                'kelas' => json_encode($kelas),
                'jurusan' => json_encode($jurusan),
                'jml_pg' => $jmlpg,
                'jml_esai' => $jmlesai,
                'bobot_pg' => $bobotpg,
                'bobot_esai' => $bobotesai,
                'opsi' => $opsi,
                'guru' => $guru,
                'kkm' => $kkm
            ];
            $this->sm->ubahdata('banksoal', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusbank()
    {
        $id = $this->input->post('id');
        $where = [
            'id_banksoal' => $id
        ];
        $this->sm->deletedata('banksoal', $where);
        echo json_encode('ok');
    }
    public function ambilidbank()
    {
        $id = $this->input->post('id');
        $where = [
            'id_banksoal' => $id
        ];
        $datasoal = $this->sm->ambilid('banksoal', $where)->result();
        echo json_encode($datasoal);
    }

    // FUNGSI LIST SOAL 
    public function list($id)
    {

        //$this->output->cache(1);
        $where = [
            'id_banksoal' => $id
        ];
        $data = [
            'isi' => 'Soal/v_listsoal',
            'soal' => $this->db->get_where('soal', $where)->result_array(),
            'id' => $id
        ];
        $this->template->candy($data);
    }
    public function simpansoal()
    {
        $data = [
            'soal' => $this->input->post('soal'),
            'pilA' => $this->input->post('pilA'),
            'pilB' => $this->input->post('pilB'),
            'pilC' => $this->input->post('pilC'),
            'pilD' => $this->input->post('pilD'),
            'pilE' => $this->input->post('pilE'),
            'jenis' => $this->input->post('jenis'),
            'jawaban' => $this->input->post('jawaban'),
            'id_banksoal' => $this->input->post('id')
        ];
        $this->sm->createdata('soal', $data);
        echo json_encode('sukses');
    }
    public function hapussoal()
    {
        $id = $this->input->post('id');
        $where = [
            'id_soal' => $id
        ];
        $this->sm->deletedata('soal', $where);
        echo json_encode('ok');
    }
}
