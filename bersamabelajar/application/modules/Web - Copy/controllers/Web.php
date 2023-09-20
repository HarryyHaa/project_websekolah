<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ceklogin_guru();
        //$this->load->model('Web_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_beranda',$data);
        $this->load->view('Web/v_footer',$data);
    }
    public function siswa()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_siswa');
        $this->load->view('Web/v_footer');
    }
    public function guru()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_guru');
        $this->load->view('Web/v_footer');
    }
    public function materi()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_materi');
        $this->load->view('Web/v_footer');
    }
    public function pengumuman()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_pengumuman');
        $this->load->view('Web/v_footer');
    }
    public function video()
    {
        $data=[
            'setting'=>$this->db->get_where('setting',['id_setting'=>1])->row_array()
            ];
        $this->load->view('Web/v_header',$data);
        $this->load->view('Web/v_video');
        $this->load->view('Web/v_footer');
    }
}
