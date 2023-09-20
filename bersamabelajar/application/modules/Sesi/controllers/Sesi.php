<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('Sesi_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Sesi/v_sesi'
        ];
        $this->template->candy($data);
    }
    function get_idt_sesi()
    {
        echo $this->sm->Ignited_dt('id_sesi,nama_sesi', 'sesi', array());
    }


    public function tambahdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('id', 'id', 'is_unique[sesi.id_sesi]|required');
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
                'id_sesi' => $id,
                'nama_sesi' => $nama,
                'status' => 1

            ];
            $this->sm->createdata('sesi', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('id', 'Id', 'is_unique[si_sesi.id]');
        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_sesi' => $id];
            $data = [

                'nama_sesi' => $nama
            ];
            $this->sm->ubahdata('sesi', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_sesi' => $id
        ];
        $this->sm->deletedata('sesi', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_sesi' => $id
        ];
        $datasesi = $this->sm->ambilid('sesi', $where)->result();
        echo json_encode($datasesi);
    }
}
