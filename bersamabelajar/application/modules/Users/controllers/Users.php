<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('Users_model', 'sm');
        $this->load->library('datatables');
    }
    function index()
    {
        $data = [
            'isi' => 'Users/v_user'
        ];
        $this->template->candy($data);
    }
    function get_idt_users()
    {
        echo $this->sm->Ignited_dt('id_user,username,nama_user', 'user', array());
    }
    public function tambahdata()
    {
        $aktif = $this->input->post('aktif');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('password');
        $username = $this->input->post('username');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'nama' => form_error('nama'),
                'username' => form_error('username')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'username' => $username,
                'nama_user' => $nama,
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'is_active' => $aktif
            ];
            $this->sm->createdata('user', $data);
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $aktif = $this->input->post('aktif');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('password');
        $username = $this->input->post('username');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'nama' => form_error('nama'),
                'username' => form_error('username')
            ];
            echo json_encode($data);
        } else {
            $where = ['id_user' => $id];
            if ($pass == '') {
                $data = [
                    'username' => $username,
                    'nama_user' => $nama,
                    'is_active' => $aktif
                ];
            } else {
                $data = [
                    'username' => $username,
                    'nama_user' => $nama,
                    'password' => password_hash($pass, PASSWORD_DEFAULT),
                    'is_active' => $aktif
                ];
            }
            $this->sm->ubahdata('user', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_user' => $id
        ];
        $this->sm->deletedata('user', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_user' => $id
        ];
        $datasiswa = $this->sm->ambilid('user', $where)->result();
        echo json_encode($datasiswa);
    }
}
