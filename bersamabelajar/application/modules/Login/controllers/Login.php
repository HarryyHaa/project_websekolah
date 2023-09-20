<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $guru = $this->db->get_where('guru', ['nip' => $username])->row_array();
        $siswa = $this->db->get_where('siswa', ['nis' => $username])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'iduser' => $user['id_user'],
                        'username' => $user['username'],
                        'nama' => $user['nama_user'],
                        'akses' => '1',
                        'upload_image_file_manager' => true
                    ];
                    $this->session->set_userdata($data);

                    redirect('Home');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert 
                    alert-danger alert-dismissible fade show" role="alert">
                   <strong>Ooops!</strong> Password salah !
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   </div>');
                    redirect('Login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert 
                 alert-danger alert-dismissible fade show" role="alert">
                <strong>Ooops!</strong> Gagal Login user is not activated
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Login');
            }
        } elseif ($siswa) {
            if ($siswa['status'] == 1) {
                if ($password == $siswa['password']) {
                    $data = [
                        'iduser' => $siswa['id_siswa'],
                        'nis' => $siswa['nis'],
                        'nama' => $siswa['nama'],
                        'akses' => '3',
                        'level' => $siswa['level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Home');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert 
                alert-danger alert-dismissible fade show" role="alert">
               <strong>Ooops!</strong> Password salah !
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
               </div>');
                    redirect('Login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert 
                 alert-danger alert-dismissible fade show" role="alert">
                <strong>Ooops!</strong> Gagal Login Akun belum aktif silahkan hubungi wali kelasnya
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Login');
            }
        } elseif ($guru) {
            if (password_verify($password, $guru['password'])) {
                $nip = $guru['nip'];
                // $piket = $this->db->get_where('si_piket', ['nip' => $nip])->row_array();
                // if ($nip == $piket['nip']) {
                //     $akses = 4;
                // } else {
                $akses = 2;
                // }
                $data = [
                    'iduser' => $guru['id_guru'],
                    'nip' => $nip,
                    'nama' => $guru['nama'],
                    'akses' => $akses,
                    'upload_image_file_manager' => true
                ];
                $this->session->set_userdata($data);

                redirect('Home');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert 
                    alert-danger alert-dismissible fade show" role="alert">
                   <strong>Ooops!</strong> Password salah !
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   </div>');
                redirect('Login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert 
            alert-danger alert-dismissible fade show" role="alert">
                <strong>Ooops!</strong> Gagal Login silahkan registrasi terlebih dahulu
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>');
            redirect('Login');
        }
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'required|trim|valid_username');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'isi' => 'Login/v_login',
                'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array()
            ];
            $this->template->themeblank($data);
        } else {
            $this->login();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('iduser');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('akses');
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('nis');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('pesan', '<div class="alert 
            alert-success alert-dismissible fade show" role="alert">
                You have been log out !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>');
        redirect('Login');
    }
}
