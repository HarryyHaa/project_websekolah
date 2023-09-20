<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Classroom_model extends CI_Model
{

	private $_table = 'classroom';

	public function classroom_rules()
	{
		return [
			['field' => 'name',
			'label' => 'Nama Kelas',
			'rules' => 'required'],

			['field' => 'description',
			'label' => 'Deskripsi',
			'rules' => 'required'],

			['field' => 'quiz_name_ID',
			'label' => 'Paket Ujian',
			'rules' => 'required']
		];
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

	public function get_classroom_by_code($code)
	{
		$this->db->select('a.*, b.title');
		$this->db->from($this->_table. ' a');
		$this->db->join('quiz_name b','a.quiz_name_ID=b.ID');
		$this->db->where('a.code', $code);
		return $this->db->get()->row();
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

	public function create($teacher_ID)
	{
		$data = array(
			'name' 			=> $this->input->post('name', TRUE),
			'description'	=> $this->input->post('description', TRUE),
			'code'			=> 1,
			'teacher_ID'	=> $teacher_ID,
			'quiz_name_ID'	=> $this->input->post('quiz_name_ID', TRUE),
			'multiple_choice_limit' 	=> $this->input->post('limit', TRUE),
			'show_result'	=> $this->input->post('show_result', TRUE),
			'student_group'	=> $this->input->post('student_group', TRUE),
			'random_number'	=> $this->input->post('random_number', TRUE)
		);
		$this->db->insert($this->_table, $data);

		$insert_id = $this->db->insert_id();

		$this->create_class_code($insert_id);
	}

	public function create_class_code($insert_id)
	{
		$new_code = random_string(2).''.$insert_id.''.random_string(2);
		$this->db->where('ID', $insert_id);
		$this->db->set('code', $new_code);
		$this->db->update($this->_table);
	}

	public function update()
	{
		$data = array(
			'name' 			=> $this->input->post('name', TRUE),
			'description'	=> $this->input->post('description', TRUE),
			'quiz_name_ID'	=> $this->input->post('quiz_name_ID', TRUE),
			'multiple_choice_limit' => $this->input->post('limit', TRUE),
			'show_result'	=> $this->input->post('show_result', TRUE),
			'student_group'	=> $this->input->post('student_group', TRUE),
			'random_number'	=> $this->input->post('random_number', TRUE)
		);
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->update($this->_table, $data);
	}

	public function start($code)
	{
		$this->db->where('code', $code);
		$this->db->set('working_status', 1);
		$this->db->update($this->_table);
	}

	public function stop($code)
	{
		$this->db->where('code', $code);
		$this->db->set('working_status', 2);
		$this->db->update($this->_table);
	}

	public function make_an_archive($code)
	{
		$this->db->where('code', $code);
		$this->db->set('status', 2);
		$this->db->update($this->_table);
	}

	public function delete($code)
	{
		// delete all data from quiz answe by classroom code
		$this->quiz_answer_delete_by_clasroom_code($code);

		$this->db->where('code', $code);
		$this->db->where('status', 2);
		$this->db->delete($this->_table);
	}

	public function quiz_answer_delete_by_clasroom_code($code)
	{
		$classroom = $this->get_classroom_by_code($code);
		$this->db->where('classroom_ID', $classroom->ID);
		$this->db->delete('quiz_answer');
	}

	
	public function is_the_code_has_been_used($code, $student_ID)
	{
		$query = $this->db
		->select('a.code')
		->from('classroom a')
		->join('quiz_answer b','b.classroom_ID=a.ID','inner')
		->where('a.code', $code)
		->where('b.student_ID', $student_ID)
		->get()
		->num_rows();
		if ($query > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function working_status($classroom_ID)
	{
		return $this->db
		->select('working_status')
		->where('ID', $classroom_ID)
		->get($this->_table)
		->row()
		->working_status;
	}

	public function insert_quiz_timer($student_ID, $classroom_ID)
	{
		$data = array(
			'classroom_ID' 	=> $classroom_ID,
			'student_ID'	=> $student_ID,
			'join_time'		=> time()
		);
		return	$this->db->insert('quiz_timer', $data);
	}

	public function get_quiz_timer($classroom_ID, $student_ID)
	{
		return $this->db
		->select('start_time, status, join_time')
		->where('classroom_ID', $classroom_ID)
		->where('student_ID', $student_ID)
		->get('quiz_timer')
		->row();
	}

	public function start_quiz_timer($classroom_ID, $student_ID)
	{
		return $this->db
		->where('classroom_ID', $classroom_ID)
		->where('student_ID', $student_ID)
		->set('status', 1)
		->set('start_time', time())
		->update('quiz_timer');
	}

	public function end_quiz_timer($classroom_ID, $student_ID)
	{
		return $this->db
		->where('classroom_ID', $classroom_ID)
		->where('student_ID', $student_ID)
		->set('status', 2)
		->update('quiz_timer');
	}

	public function reset_student($student_ID, $classroom_ID)
	{
		$where = array(
			'student_ID' 	=> $student_ID,
			'classroom_ID'	=> $classroom_ID
		);	
		$this->db->where($where);
		$this->db->delete('quiz_timer');

		$this->db->where($where);
		$this->db->delete('quiz_answer');
	}

	public function re_active($code)
	{
		return $this->db->where('code', $code)->set('status', 1)->update($this->_table);
	}

	public function lock($code)
	{
		return $this->db->where('code', $code)->set('lock', '1')->update($this->_table);
	}

	public function unlock($code)
	{
		return $this->db->where('code', $code)->set('lock', '0')->update($this->_table);
	}

};