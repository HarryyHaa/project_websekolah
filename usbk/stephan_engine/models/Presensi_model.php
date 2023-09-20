<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi_model extends CI_Model
{

	private $_table = 'student';
	var $column_order = array(NULL,  'a.code', 'a.name', 'jumlah_benar', 'jumlah_benar', NULL, 'a.code', 'a.code');
	var $column_search = array('a.name', 'a.code');

	private function _get_student_query($classroom_ID = NULL)
	{
		$this->db->select('a.ID, a.code, a.name, COUNT(b.number) AS jumlah_soal, SUM(IFNULL(b.is_correct, 0)) AS jumlah_benar');
		$this->db->from($this->_table.' a');
		$this->db->join('quiz_answer b', 'b.student_ID=a.ID', 'left');
		$this->db->join('quiz d', 'd.ID=b.quiz_ID');
		$this->db->where('b.classroom_ID', $classroom_ID);
		$this->db->where('d.quiz_type', '1');
		$this->db->group_by('b.student_ID');

		$i = 0;

		foreach ($this->column_search as $item)
		{
			if($this->input->post('search', TRUE))
			{
				if ($i === 0) 
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) -1 == $i) 
					$this->db->group_end();
				
			}
			$i++;
		}
		if (isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($this->order)) 
		{
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_presensi_with_datatables($classroom_ID = NULL)
	{
		$this->_get_student_query($classroom_ID);
		if ($this->input->post('length', TRUE) != -1) 
			$this->db->limit($this->input->post('length', TRUE),$this->input->post('start', TRUE));
		
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($classroom_ID)
	{
		$this->_get_student_query($classroom_ID);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($classroom_ID)
	{
		$this->_get_student_query($classroom_ID);
		return $this->db->get()->num_rows();
	}

}