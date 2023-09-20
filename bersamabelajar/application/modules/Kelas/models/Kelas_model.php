<?php
defined('BASEPATH') or exit('No direct script access allowed');
class kelas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function Ignited_dt($select, $table, $where)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);
        $this->datatables->where($where);
        $this->datatables->add_column('action', '<a href="javascript:void(0);" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a>', 'id_kelas');

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
