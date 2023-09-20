<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kursus_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function Ignited_dt()
    {
        $this->datatables->select('id_kursus,id_mapel,id_guru,kelas,status');
        $this->datatables->from('kursus');
        $this->datatables->add_column('action', '<a href="#" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a> <a href="' . base_url('Kursus/materi/$1') . '" class="btn btn-sm btn-primary " data-id="$1"><i class="fas fa-eye"></i></a>', 'id_kursus');

        return $this->datatables->generate();
    }
    function Ignited_dt_guru()
    {
        $id = $this->session->userdata('iduser');
        $this->datatables->select('id_kursus,id_mapel,id_guru,kelas,status');
        $this->datatables->from('kursus');
        $this->datatables->where(['id_guru' => $id]);
        $this->datatables->add_column('action', '<a href="#" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a> <a href="' . base_url('Kursus/materi/$1') . '" class="btn btn-sm btn-primary " data-id="$1"><i class="fas fa-eye"></i></a>', 'id_kursus');

        return $this->datatables->generate();
    }
    function Ignited_dt_materi($select, $table, $where)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);
        $this->datatables->where($where);
        $this->datatables->add_column('action', '<a href="#" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a> <a href="' . base_url('Kursus/lihat/$1') . '" class="btn btn-sm btn-primary " data-id="$1"><i class="fas fa-eye"></i>', 'id_materi');
        $this->datatables->add_column('kuis', '<a href="' . base_url('Kursus/nilaiquis/$1') . '" class="btn btn-sm btn-primary " data-id="$1"><i class="fas fa-star"></i></a> <a href="' . base_url('Kursus/soal/$1') . '" class="btn btn-sm btn-warning " data-id="$1"><i class="fas fa-file"></i></a>', 'id_materi');
        return $this->datatables->generate();
    }
    function Ignited_dt_tugas($select, $table, $where)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);
        $this->datatables->where($where);
        $this->datatables->add_column('action', '<a href="#" class="edit btn btn-sm btn-success " data-id="$1"><i class="fas fa-edit"></i></a>  <a href="javascript:void(0);" class="hapus btn btn-sm btn-danger " data-id="$1"><i class="fas fa-trash"></i></a> <a href="' . base_url('Kursus/lihattugas/$1') . '" class="btn btn-sm btn-primary " data-id="$1"><i class="fas fa-eye"></i>', 'id_tugas');

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
