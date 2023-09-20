<?php
class Excel_import_model extends CI_Model
{
    function select($table)
    {
        $this->db->order_by('nis', 'ASC');
        $query = $this->db->get($table);
        return $query->result();
    }
    public function selectsiswa($table, $where)
    {
        $query= $this->db->get_where($table, $where);
        return $query->result();
    }
    function insert($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }
}
