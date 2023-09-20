<?php
defined('BASEPATH') or exit('No direct script access allowed');
class soal_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function Ignited_dt_bank()
    {
        $this->datatables->select('id_banksoal,nama_banksoal,jurusan,level,kelas,jurusan,jml_pg,jml_esai,bobot_pg,bobot_esai,guru,opsi,kkm');
        $this->datatables->from('banksoal');
        $this->datatables->add_column('action', '<a href="javascript:void(0);" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a> <a href="' . base_url('Soal/list/$1') . '" class=" btn btn-sm btn-primary " data-id="$1"><i class="fas fa-eye"></i></a>', 'id_banksoal');

        return $this->datatables->generate();
    }

    public function createdata($selec, $data)
    {
        $this->db->insert($selec, $data);
    }
    public function deletedata($table, $where)
    {
        $this->db->delete($table, $where);
    }
    public function ambilid($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    public function ubahdata($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
    public function editdata($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
}
