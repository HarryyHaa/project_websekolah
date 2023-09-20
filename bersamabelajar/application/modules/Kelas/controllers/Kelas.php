<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('kelas_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Kelas/v_kelas',
            'level' => $this->db->get('level')->result_array()
        ];
        $this->template->candy($data);
    }
    function get_idt_kelas()
    {
        echo $this->sm->Ignited_dt('id_kelas,nama_kelas,level_kelas', 'kelas', array());
    }


    public function tambahdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $this->form_validation->set_rules('id', 'id', 'is_unique[kelas.id_kelas]|required');
        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            // $errors = validation_errors();
            $data = [
                'id' => form_error('id'),
                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {

            $data = [
                'id_kelas' => $id,
                'nama_kelas' => $nama,
                'level_kelas' => $level,
                'status' => 1

            ];
            $this->sm->createdata('kelas', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('id', 'Id', 'is_unique[si_kelas.id]');
        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_kelas' => $id];
            $data = [

                'nama_kelas' => $nama,
                'level_kelas' => $level
            ];
            $this->sm->ubahdata('kelas', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_kelas' => $id
        ];
        $this->sm->deletedata('kelas', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_kelas' => $id
        ];
        $datakelas = $this->sm->ambilid('kelas', $where)->result();
        echo json_encode($datakelas);
    }
}
