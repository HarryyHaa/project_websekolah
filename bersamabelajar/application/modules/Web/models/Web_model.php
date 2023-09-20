<?php
class Web_model extends CI_Controller{
	function __construct(){
		parent::__construct();
		//$this->load->model('m_tulisan');
		//$this->m_pengunjung->count_visitor();
	}
	function index(){
			$x['tot_guru']=$this->db->get('guru')->num_rows();
			$x['tot_siswa']=$this->db->get('siswa')->num_rows();
			$x['tot_materi']=$this->db->get('materi')->num_rows();
			$this->load->view('modules/Web/models/Web_model',$x);
	}

}
