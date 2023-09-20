<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Pengumuman extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_guru();
        $this->load->model('Pengumuman_model', 'sm');
        $this->load->library('datatables');
    }
    function index()
    {
        $data = [
            'isi' => 'Pengumuman/v_pengumuman',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array()
        ];
        $this->template->candy($data);
    }
    function get_idt_pengumuman()
    {
        echo $this->sm->Ignited_dt('id_pengumuman,type,judul,text', 'pengumuman', array());
    }


    public function tambahdata()
    {
        $type = $this->input->post('jenis');
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('isi', 'isi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'judul' => form_error('judul'),
                'isi' => form_error('isi')
            ];
            echo json_encode($data);
        } else {
            echo json_encode('sukses');
            $data = [
                'text' => $isi,
                'judul' => $judul,
                'type' => $type
            ];
            $this->sm->createdata('pengumuman', $data);
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('jenis');
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('isi', 'isi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'judul' => form_error('judul'),
                'isi' => form_error('isi')
            ];
            echo json_encode($data);
        } else {
            $where = ['id_pengumuman' => $id];
            $data = [
                'text' => $isi,
                'judul' => $judul,
                'type' => $type
            ];
            $this->sm->ubahdata('pengumuman', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_pengumuman' => $id
        ];
        $this->sm->deletedata('pengumuman', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_pengumuman' => $id
        ];
        $datasiswa = $this->sm->ambilid('pengumuman', $where)->result();
        echo json_encode($datasiswa);
    }
}
