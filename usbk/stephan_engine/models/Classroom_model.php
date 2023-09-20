<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Classroom_model extends CI_Model
{

	private $_table = 'classroom';
	var $column_order = array('a.name', 'a.code', 'a.working_status', 'a.ID', 'b.title');
	var $column_search = array('a.name', 'a.code', 'a.working_status', 'a.ID', 'b.title');
	var $order  = array('ID' => 'asc');

	

	private function _get_classroom_query($status = NULL, $teacher_ID = NULL)
	{
		$this->db->select('a.*, b.title as quiz_name');
		$this->db->join('quiz_name b', 'b.ID=a.quiz_name_ID');
		$this->db->from($this->_table.' a');

		if ($status != NULL) 
		{
			$this->db->where('a.status', $status);
		}

		if ($teacher_ID != NULL) 
		{
			$this->db->where('a.teacher_ID', $teacher_ID);
		}

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
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_classroom_with_datatables($status = NULL, $teacher_ID = NULL)
	{
		$this->_get_classroom_query($status, $teacher_ID);
		if ($this->input->post('length', TRUE) != -1) {
			$this->db->limit($this->input->post('length', TRUE),$this->input->post('start', TRUE));
		}
		
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($status = NULL, $teacher_ID = NULL)
	{
		$this->_get_classroom_query($status, $teacher_ID);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($status = NULL, $teacher_ID = NULL)
	{
		$this->db->from($this->_table);
		if ($status != NULL) {
			$this->db->where('status', $status);
		}
		if ($teacher_ID != NULL) {
			$this->db->where('teacher_ID', $teacher_ID);
		}
		return $this->db->get()->num_rows();
	}

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

	public function get_classroom_json($status)
	{
		return $this->datatables
		->select('a.ID, b.ID as quiz_name')
		->from('classroom a')
		->join('quiz_name b', 'b.ID=a.quiz_name_ID')
		->select('b.title as quiz_name')
		->where('a.status', $status)
		->generate();
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
		$this->db->select('a.*, b.title, c.name as teacher_name');
		$this->db->from($this->_table. ' a');
		$this->db->join('quiz_name b','a.quiz_name_ID=b.ID');
		$this->db->join('teacher c','b.teacher_ID=c.ID', 'left');
		$this->db->where('a.code', $code);
		return $this->db->get()->row();
	}

	public function get_classroom_by_id($classroom_ID)
	{
		return $this->db->get_where($this->_table, array('ID' => $classroom_ID))->row();
	}

	public function get_classroom_by_quiz_name($quiz_name_ID)
	{
		return $this->db->get_where($this->_table, array('quiz_name_ID' => $quiz_name_ID));
	}

	public function get_classroom_by_student_id($id)
	{
		return $this->db
		->select('a.classroom_ID, b.name, b.description, b.code, b.quiz_name_ID, b.status, b.working_status, b.scheduled, b.date_start, b.time_start')
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
		if (($this->input->post('scheduled') == 1) AND ($this->input->post('date_start') != NULL) AND ($this->input->post('time_start') != NULL) ) {
			$data['scheduled']		= '1';
			$data['date_start']		= $this->input->post('date_start', TRUE);
			$data['time_start']		= $this->input->post('time_start', TRUE);
			$data['status']			= '1';
			$data['working_status'] = '1';
		}else{
			$data['scheduled']		= '0';
		}
		$data['name']			= $this->input->post('name', TRUE);
		$data['description']	= $this->input->post('description', TRUE);
		$data['code']			= 1;
		$data['teacher_ID']		= $teacher_ID;
		$data['quiz_name_ID']	= $this->input->post('quiz_name_ID', TRUE);
		$data['multiple_choice_limit']	= $this->input->post('limit', TRUE);
		$data['show_result']	= $this->input->post('show_result', TRUE);
		$data['student_group']	= $this->input->post('student_group', TRUE);
		$data['random_number']	= $this->input->post('random_number', TRUE);

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
		if (($this->input->post('scheduled') == 1) AND ($this->input->post('date_start') != NULL) AND ($this->input->post('time_start') != NULL) ) {
			$data['scheduled']		= '1';
			$data['date_start']		= $this->input->post('date_start', TRUE);
			$data['time_start']		= $this->input->post('time_start', TRUE);
			$data['status']			= '1';
			$data['working_status'] = '1';
		}else{
			$data['scheduled']		= '0';
			$data['working_status'] = '0';
			$data['date_start']		= NULL;
			$data['time_start']		= NULL;
		}
		$data['name']			= $this->input->post('name', TRUE);
		$data['description']	= $this->input->post('description', TRUE);
		$data['quiz_name_ID']	= $this->input->post('quiz_name_ID', TRUE);
		$data['multiple_choice_limit']	= $this->input->post('limit', TRUE);
		$data['show_result']	= $this->input->post('show_result', TRUE);
		$data['student_group']	= $this->input->post('student_group', TRUE);
		$data['random_number']	= $this->input->post('random_number', TRUE);

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
		// $this->db->where('status', 2);
		$this->db->delete($this->_table);
	}

	public function quiz_answer_delete_by_clasroom_code($code)
	{
		$classroom = $this->get_classroom_by_code($code);
		$this->db->where('classroom_ID', $classroom->ID);
		$this->db->delete('quiz_answer');

		$this->db->where('classroom_ID', $classroom->ID);
		$this->db->delete('quiz_timer');
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
		->limit(1)
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
		$this->db->set('start_time', NULL);
		$this->db->set('status', 0);
		$this->db->update('quiz_timer');

		$this->db->where($where);
		$this->db->set('answer', NULL);
		$this->db->set('answer_essay', NULL);
		$this->db->set('is_correct', NULL);
		$this->db->set('answer_score', NULL);
		$this->db->update('quiz_answer');
	}

	public function re_active($code)
	{
		return $this->db->where('code', $code)->set('status', 1)->update($this->_table);
	}

	public function lock($code = NULL)
	{
		if ($code != NULL) {
			return $this->db->where('code', $code)->set('lock', '1')->update($this->_table);
		}else{
			return $this->db->set('lock', '1')->update($this->_table);
		}
	}

	public function unlock($code = NULL)
	{
		if ($code != NULL) {
			return $this->db->where('code', $code)->set('lock', '0')->update($this->_table);
		}else{
			return $this->db->set('lock', '0')->update($this->_table);
		}
	}

	public function get_students($student_group = NULL,$id)
	{
		if ($student_group == NULL) {
			$sql = "select ID, code, name from student where ID NOT IN( select student_ID as ID from quiz_answer where classroom_ID = '$id')";
		}else{
			$sql = "select ID, code, name from student where  group_ID='$student_group' AND ID NOT IN( select student_ID as ID from quiz_answer where classroom_ID = '$id')";
		}
		return $this->db->query($sql);
	}

	public function get_present($classroom_ID)
	{
		return $this->db->select('a.student_ID as ID,a.join_time, a.start_time, a.status, b.code, b.name, b.device, b.ip, b.user_agent')
		->from('quiz_timer a')
		->join('student b', 'b.ID=a.student_ID', 'left')
		->where('classroom_ID', $classroom_ID)
		->get();
	}

};