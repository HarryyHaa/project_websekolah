<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Setting extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        ceklogin();

        $this->load->model('Setting_model', 'sm');
        $this->load->library('datatables');
    }
    function index()
    {
        ceklogin_admin();
        $data = [
            'isi' => 'Setting/v_setting',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array()
        ];
        $this->template->candy($data);
    }

    public function editdata()
    {
        ceklogin_admin();
        $setting = $this->db->get_where('setting', ['id_setting' => 1])->row_array();
        $sekolah = $this->input->post('sekolah');
        $alamat = $this->input->post('alamat');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $jenjang = $this->input->post('jenjang');
        $bottoken = $this->input->post('bottoken');
        $kepsek = $this->input->post('kepsek');
        $nipkepsek = $this->input->post('nipkepsek');
        $where = ['id_setting' => 1];
        $data = [
            'nama_sekolah' => $sekolah,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kabupaten,
            'jenjang' => $jenjang,
            'bot_token' => $bottoken,
            'kepsek' => $kepsek,
            'nip' => $nipkepsek
        ];
        $logo = $_FILES['file']['name'];
        if ($logo) {
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                unlink(FCPATH . 'assets/img/' . $setting['logo']);
                $new_logo = $this->upload->data('file_name');
                $this->db->set('logo', $new_logo);
            }
        }
        $logo2 = $_FILES['file2']['name'];
        if ($logo2) {
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file2')) {
                //unlink(FCPATH . 'assets/img/' . $setting['header']);
                $new_logo = $this->upload->data('file_name');
                $this->db->set('header', $new_logo);
            }
        }
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('setting');
        echo json_encode('sukses');
    }
    function myprofil()
    {
        $akses = $this->session->userdata('akses');
        if ($akses == 2) {
            $data = [
                'isi' => 'Setting/v_setting_guru',
                'guru' => $this->db->get_where('guru', ['id_guru' => $this->session->userdata('iduser')])->row_array()
            ];
        } elseif ($akses == 3) {
            $data = [
                'isi' => 'Setting/v_setting_siswa',
                'siswa' => $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('iduser')])->row_array()
            ];
        }
        $this->template->candy($data);
    }
    public function editprofil()
    {

        $siswa = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('iduser')])->row_array();
        $password = $this->input->post('password');
        $nohp = $this->input->post('nohp');
        $where = ['id_siswa' => $this->session->userdata('iduser')];
        if ($password <> '') {
            $data = [
                'no_hp' => $nohp,
                'password' => $password
            ];
        } else {
            $data = [
                'no_hp' => $nohp
            ];
        }
        $logo = $_FILES['file']['name'];
        if ($logo) {
            $config['upload_path'] = './assets/img/profil/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/profil/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 215;
                $config['height'] = 230;
                $config['new_image'] = './assets/img/profil/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                if ($siswa['foto'] <> 'default.png') {
                    unlink(FCPATH . 'assets/img/profil/' . $siswa['foto']);
                }
                $this->db->set('foto', $gambar);
            }
        }
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('siswa');
        echo json_encode('sukses');
    }
    public function editprofilguru()
    {
        ceklogin_guru();
        $guru = $this->db->get_where('guru', ['id_guru' => $this->session->userdata('iduser')])->row_array();
        $password = $this->input->post('password');
        $nohp = $this->input->post('nohp');
        $chatid = $this->input->post('chatid');
        $alamat = $this->input->post('alamat');
        $where = ['id_guru' => $this->session->userdata('iduser')];
        if ($password <> '') {
            $data = [
                'no_hp' => $nohp,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'chatid' => $chatid,
                'alamat' => $alamat
            ];
        } else {
            $data = [
                'no_hp' => $nohp,
                'chatid' => $chatid,
                'alamat' => $alamat
            ];
        }
        $logo = $_FILES['file']['name'];
        if ($logo) {
            $config['upload_path'] = './assets/img/profil/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/profil/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 215;
                $config['height'] = 230;
                $config['new_image'] = './assets/img/profil/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                if ($guru['foto'] <> 'default.png' or $guru['foto'] <> 'default2.png') {
                    unlink(FCPATH . 'assets/img/profil/' . $guru['foto']);
                }
                $this->db->set('foto', $gambar);
            }
        }
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('guru');
        echo json_encode('sukses');
    }
}
