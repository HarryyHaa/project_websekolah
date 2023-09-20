<?php
defined('BASEPATH') or exit('No direct script access allowed');

class level extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('level_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Level/v_level'
        ];
        $this->template->candy($data);
    }
    function get_idt_level()
    {
        echo $this->sm->Ignited_dt('id_level,nama_level', 'level', array());
    }


    public function tambahdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('id', 'id', 'is_unique[level.id_level]|required');
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
                'id_level' => $id,
                'nama_level' => $nama,
                'status' => 1

            ];
            $this->sm->createdata('level', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('id', 'Id', 'is_unique[si_level.id]');
        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_level' => $id];
            $data = [

                'nama_level' => $nama
            ];
            $this->sm->ubahdata('level', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_level' => $id
        ];
        $this->sm->deletedata('level', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_level' => $id
        ];
        $datalevel = $this->sm->ambilid('level', $where)->result();
        echo json_encode($datalevel);
    }
}
