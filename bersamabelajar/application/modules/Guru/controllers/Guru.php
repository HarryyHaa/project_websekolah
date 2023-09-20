<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guru extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();

        $this->load->model('guru_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        ceklogin_admin();
        $data = [
            'isi' => 'Guru/v_guru',
            'kelas' => $this->db->get('kelas')->result_array()

        ];
        $this->template->candy($data);
    }
    function get_idt_guru()
    {
        echo $this->sm->Ignited_dt('id_guru,nip,nama,no_hp,walas', 'guru', array());
    }


    public function tambahdata()
    {
        ceklogin_admin();
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $walas = $this->input->post('kelas');
        //FORM VALIDASI
        $this->form_validation->set_rules('nip', 'Nip', 'is_unique[guru.nip]|required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // $errors = validation_errors();
            $data = [
                'nip' => form_error('nip'),
                'nama' => form_error('nama'),
                'pass' => form_error('password')
            ];
            echo json_encode($data);
        } else {

            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'walas' => $walas

            ];
            $this->sm->createdata('guru', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        ceklogin_admin();
        $id = $this->input->post('id');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('password');
        $walas = $this->input->post('kelas');
        $this->form_validation->set_rules('nip', 'Nip', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'nip' => form_error('nip'),
                'nama' => form_error('nama')
            ];
            echo json_encode($data);
        } else {
            $where = ['id_guru' => $id];
            if ($pass <> '') {
                $data = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'password' => password_hash($pass, PASSWORD_DEFAULT),
                    'status' => 1,
                    'walas' => $walas
                ];
            } else {
                $data = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'status' => 1,
                    'walas' => $walas
                ];
            }
            $this->sm->ubahdata('guru', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        ceklogin_admin();
        $id = $this->input->post('id');
        $where = [
            'id_guru' => $id
        ];
        $this->sm->deletedata('guru', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        ceklogin_admin();
        $id = $this->input->post('id');
        $where = [
            'id_guru' => $id
        ];
        $dataguru = $this->sm->ambilid('guru', $where)->result();
        echo json_encode($dataguru);
    }
    function import_guru()
    {
        ceklogin_admin();
        $this->load->library('excel');
        if (isset($_FILES["file"]["name"])) {
            $this->db->query('truncate guru');
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nip = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $pass = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $hp = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $foto = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tempat = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tgllahir = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $mapel = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $walas = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $data[] = array(
                        'nip'   => $nip,
                        'nama'    => $nama,
                        'password'  => password_hash($pass, PASSWORD_DEFAULT),
                        'no_hp'  => $hp,
                        'foto' => $foto,
                        'tempat' => $tempat,
                        'tgl_lahir' => $tgllahir,
                        'mapel' => $mapel,
                        'walas' => $walas
                    );
                }
            }
            $this->db->insert_batch('guru', $data);
            echo 'Data Imported successfully';
        }
    }

    //menu di siswa
    public function listsiswa()
    {
        $data = [
            'isi' => 'Guru/v_guru_list',
            'guru' => $this->db->get('guru')->result_array(),
            'siswa' => $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('iduser')])->row_array()

        ];
        $this->template->candy($data);
    }
}
