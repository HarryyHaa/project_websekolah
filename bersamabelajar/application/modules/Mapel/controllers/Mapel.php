<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mapel extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();
        $this->load->model('mapel_model', 'sm');
        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Mapel/v_mapel'
        ];
        $this->template->candy($data);
    }
    function get_idt_mapel()
    {
        echo $this->sm->Ignited_dt('id_mapel,nama_mapel', 'mapel', array());
    }


    public function tambahdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('id', 'id', 'is_unique[mapel.id_mapel]|required');
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
                'id_mapel' => $id,
                'nama_mapel' => $nama,
                'status' => 1

            ];
            $this->sm->createdata('mapel', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('id', 'Id', 'is_unique[si_mapel.id]');
        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_mapel' => $id];
            $data = [

                'nama_mapel' => $nama
            ];
            $this->sm->ubahdata('mapel', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_mapel' => $id
        ];
        $this->sm->deletedata('mapel', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_mapel' => $id
        ];
        $datamapel = $this->sm->ambilid('mapel', $where)->result();
        echo json_encode($datamapel);
    }
    function import_mapel()
    {
        ceklogin_admin();
        $this->load->library('excel');
        if (isset($_FILES["file"]["name"])) {
            $this->db->query('truncate mapel');
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $kode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();


                    $data[] = array(
                        'id_mapel'   => $kode,
                        'nama_mapel'    => $nama,
                        'status' => 1
                    );
                }
            }
            $this->db->insert_batch('mapel', $data);
            echo 'Data Imported successfully';
        }
    }
}
