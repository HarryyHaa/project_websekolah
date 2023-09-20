<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('Jurusan_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Jurusan/v_jurusan'
        ];
        $this->template->candy($data);
    }
    function get_idt_jurusan()
    {
        echo $this->sm->Ignited_dt('id_jurusan,nama_jurusan', 'jurusan', array());
    }


    public function tambahdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('id', 'id', 'is_unique[jurusan.id_jurusan]|required');
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
                'id_jurusan' => $id,
                'nama_jurusan' => $nama,
                'status' => 1

            ];
            $this->sm->createdata('jurusan', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('id', 'Id', 'is_unique[si_jurusan.id]');
        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_jurusan' => $id];
            $data = [

                'nama_jurusan' => $nama
            ];
            $this->sm->ubahdata('jurusan', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_jurusan' => $id
        ];
        $this->sm->deletedata('jurusan', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_jurusan' => $id
        ];
        $datajurusan = $this->sm->ambilid('jurusan', $where)->result();
        echo json_encode($datajurusan);
    }
}
