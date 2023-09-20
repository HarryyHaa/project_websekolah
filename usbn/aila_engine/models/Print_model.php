<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Print_model extends CI_Model
{

	private $_table = 'student';

	public function student_rules()
	{
		return [
			['field' => 'code',
			'label' => 'Kode Ujian',
			'rules' => 'required'],

			['field' => 'name',
			'label' => 'Nama Siswa',
			'rules' => 'required'],

			['field' => 'class',
			'label' => 'Kelas',
			'rules' => 'required']
		];
	}

	public function show_print_card()
	{
		$query = $this->db->get('student');
		return $query->row();
	}

	public function classroom_join_rules()
	{
		return [
			['field' => 'code',
			'label' => 'Kode Kelas',
			'rules' => 'required']
		];
	}

	public function get_classroom($status = NULL)
	{	
		$this->db->select('a.*, b.title as quiz_name');
		$this->db->join('quiz_name b', 'b.ID=a.quiz_name_ID');
		if ($status != NULL) {
			$this->db->where('a.status', $status);
		}
		return $this->db->get($this->_table.' a')->result();
	}

	public function get_classroom_by_teacher_id($id, $status)
	{
		return $this->db->get_where($this->_table, ['teacher_ID' => $id, 'status' => $status])->result();
	}

	public function get_classroom_code_by_id($id)
	{
		return $this->db->select('code')->from($this->_table)->where('ID', $id)->get()->row()->code;
	}

	public function get_student_by_code($code)
	{
		//$this->db->select('a.*, b.title');
		//$this->db->from($this->_table. ' a');
		//$this->db->join('quiz_name b','a.quiz_name_ID=b.ID');
		//$this->db->where('a.code', $code);
		$this->db->select('code');
		$this->db->from($this->_table);
		return $this->db->get()->row();

		//$query = $this->db->get('student');
		//return $query->row();
	}

	public function get_classroom_by_id($classroom_ID)
	{
		return $this->db->get_where($this->_table, array('ID' => $classroom_ID))->row();
	}

	public function get_classroom_by_student_id($id)
	{
		return $this->db
		->select('a.classroom_ID, b.name, b.description, b.code, b.quiz_name_ID, b.status, b.working_status')
		->from('quiz_answer a')
		->join('classroom b', 'a.classroom_ID=b.ID')
		->where('a.student_ID', $id)
		->where('b.status', 1)
		->group_by('a.classroom_ID')
		->get()
		->result();
	}

	public function get_classroom_by_group_id($group_id)
	{
		return $this->db->get_where($this->_table, array('student_group' => $group_id, 'status' => 1));
	}

	public function student_by_print()
	{
		$this->db->select('a.code, a.name, a.class');
		$this->db->from($this->_table.' a');
		//$this->db->join('student_group b', 'a.ID=b.ID');
		$this->db->group_by('a.class');
		return $this->db->get()->result();
		//return $this->db->get()->row();
	}

}