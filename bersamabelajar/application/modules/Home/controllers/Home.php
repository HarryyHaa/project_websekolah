<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
    }
    public function index()
    {

        $akses = $this->session->userdata('akses');
        if ($akses == 1 or $akses == 2) {
            $data = [
                'isi' => 'Home/v_home',
                'info' => $this->db->get('pengumuman')->result_array()
            ];
        } else {
            $data = [
                'isi' => 'Home/v_home_siswa',
                'info' => $this->db->get('pengumuman')->result_array()
            ];
        }
        $this->template->candy($data);
    }
}
