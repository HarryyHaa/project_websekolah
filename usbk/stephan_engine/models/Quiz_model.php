<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Quiz_model extends CI_Model
{

	private $_table_quiz_name = 'quiz_name',
	$_table_quiz = 'quiz',
	$_table_quiz_answer = 'quiz_answer';

	public 	$ID,
	$title,
	$description,
	$time;

	var $column_order = array('a.ID', 'a.teacher_ID', 'a.title', 'a.description', 'a.time', 'a.regulations', 'a.status',  'b.name');
	var $column_search = array('a.title','b.name');
	var $order  = array('ID' => 'desc');

	

	private function get_quiz_name_query($status = NULL, $teacher_ID = NULL)
	{
		$this->db->select('a.ID, a.teacher_ID, a.title, a.description, a.time, a.regulations, a.status, b.ID as teacher_ID, b.name');
		$this->db->join('teacher b','b.ID=a.teacher_ID');
		$this->db->from($this->_table_quiz_name.' a');

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

	public function get_quiz_name_with_datatables($status = NULL, $teacher_ID = NULL)
	{
		$this->get_quiz_name_query($status, $teacher_ID);
		if ($this->input->post('length', TRUE) != -1) 
			$this->db->limit($this->input->post('length', TRUE),$this->input->post('start', TRUE));
		
		
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($status = NULL, $teacher_ID = NULL)
	{
		$this->get_quiz_name_query($status, $teacher_ID);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($status = NULL, $teacher_ID = NULL)
	{
		$this->db->from($this->_table_quiz_name);
		if ($status != NULL) {
			$this->db->where('status', $status);
		}
		if ($teacher_ID != NULL) 
		{
			$this->db->where('teacher_ID', $teacher_ID);
		}
		return $this->db->get()->num_rows();
	}


	public function get_quiz_name($status = NULL)
	{
		if ($status != NULL) 
		{
			$this->db->where('a.status', $status);
		}
		return $this->db
		->select('a.ID, a.teacher_ID, a.title, a.description, a.time, a.regulations, a.status, b.ID as teacher_ID, b.name')
		->join('teacher b','b.ID=a.teacher_ID')
		->order_by('a.ID', 'desc')
		->get($this->_table_quiz_name.' a')
		->result();
	}

	public function count_mutiple_choice($quiz_name_ID )
	{
		return $this->db->select('COUNT(ID) as total')->from('quiz')->where(['quiz_type' => 1, 'quiz_name_ID' => $quiz_name_ID])->get()->row()->total;
	}

	public function count_mutiple_essay($quiz_name_ID )
	{
		return $this->db->select('COUNT(ID) as total')->from('quiz')->where(['quiz_type' => 2, 'quiz_name_ID' => $quiz_name_ID])->get()->row()->total;
	}

	public function count_mutiple_choice_active($quiz_name_ID)
	{
		return $this->db->select('COUNT(ID) as total')->from('quiz')->where(['quiz_type' => 1, 'quiz_name_ID' => $quiz_name_ID, 'status' => 1])->get()->row()->total;
	}

	public function count_mutiple_essay_active($quiz_name_ID)
	{
		return $this->db->select('COUNT(ID) as total')->from('quiz')->where(['quiz_type' => 2, 'quiz_name_ID' => $quiz_name_ID, 'status' => 1])->get()->row()->total;
	}

	public function get_quiz_name_by_id($id)
	{
		return $this->db
		->select('a.ID, a.teacher_ID, a.title, a.description, a.time, a.regulations, a.multiple_choice_percentage, a.essay_percentage, a.status, b.ID as teacher_ID, b.name')
		->where('a.ID', $id)
		->join('teacher b', 'b.ID=a.teacher_ID')
		->get($this->_table_quiz_name.' a')
		->row();
	}


	public function get_quiz_name_by_teacher_id($id, $status = NULL)
	{
		$this->db->where('teacher_ID', $id);
		if ($status != NULL) 
		{
			$this->db->where('status', $status);
		}
		return $this->db->get($this->_table_quiz_name)->result();
	}

	public function quiz_name_rules()
	{
		return [
			['field' 	=> 'title',
			'label' 	=> 'Judul',
			'rules' 	=> 'required|trim'],

			['field' 	=> 'multiple_choice_percentage',
			'label' 	=> 'Bobot Pilihan ganda',
			'rules' 	=> 'required'],

			['field' 	=> 'essay_percentage',
			'label' 	=> 'Bobot Essai',
			'rules' 	=> 'required'],

			['field' 	=> 'time',
			'label' 	=> 'Waktu Pengerjaan',
			'rules' 	=> 'required|numeric|trim']
		];
	}

	public function quiz_rules()
	{
		return [
			['field' 	=> 'question',
			'label' 	=> 'Pertanyaan',
			'rules' 	=> 'required']
			// ,

			// ['field' 	=> 'answer_1',
			// 'label' 	=> 'Jawaban A',
			// 'rules' 	=> 'required'],

			// ['field' 	=> 'answer_2',
			// 'label' 	=> 'Jawaban B',
			// 'rules' 	=> 'required'],

			// ['field' 	=> 'answer_3',
			// 'label' 	=> 'Jawaban C',
			// 'rules' 	=> 'required'],

			// ['field' 	=> 'answer_4',
			// 'label' 	=> 'Jawaban D',
			// 'rules' 	=> 'required'],

			// ['field' 	=> 'answer_key',
			// 'label' 	=> 'Kunthis Jawaban',
			// 'rules' 	=> 'required|max_length[1]']
		];
	}

	public function create_quiz_name($teacher_ID)
	{
		$data 	= array(
			'teacher_ID'	=> $teacher_ID,
			'title' 		=> clear_text($this->input->post('title', TRUE)),
			'description'	=> clear_text($this->input->post('description', TRUE)),
			'time'			=> clear_text($this->input->post('time', TRUE)),
			'multiple_choice_percentage' => clear_text($this->input->post('multiple_choice_percentage', TRUE)),
			'essay_percentage' => clear_text($this->input->post('essay_percentage', TRUE))
		);
		$this->db->insert($this->_table_quiz_name, $data);
	}

	public function update_quiz_name()
	{
		if ($this->input->post('teacher', TRUE)) 
		{
			$data 	= array(
				'teacher_ID'=> $this->input->post('teacher', TRUE),
				'title' 		=> clear_text($this->input->post('title', TRUE)),
				'description'	=> clear_text($this->input->post('description', TRUE)),
				'time'			=> clear_text($this->input->post('time', TRUE)),
				'multiple_choice_percentage' => clear_text($this->input->post('multiple_choice_percentage', TRUE)),
				'essay_percentage' => clear_text($this->input->post('essay_percentage', TRUE))
			);

			$this->update_teacher_classroom($this->input->post('ID', TRUE), $this->input->post('teacher', TRUE));
		}
		else
		{
			$data 	= array(
				'title' 		=> clear_text($this->input->post('title', TRUE)),
				'description'	=> clear_text($this->input->post('description', TRUE)),
				'time'			=> clear_text($this->input->post('time', TRUE)),
				'multiple_choice_percentage' => clear_text($this->input->post('multiple_choice_percentage', TRUE)),
				'essay_percentage' => clear_text($this->input->post('essay_percentage', TRUE))
			);
		}
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->update($this->_table_quiz_name, $data);
	}

	public function update_teacher_classroom($quiz_name_ID, $teacher_ID)
	{
		$this->db->where('quiz_name_ID', $quiz_name_ID)->set('teacher_ID', $teacher_ID)->update('classroom');
	}

	public function create_quiz($id, $audio_name = NULL)
	{
		if (($this->input->post('answer_1', TRUE) == '')  && ($this->input->post('answer_2', TRUE) == '')) 
		{
			$data['question'] 		= $this->input->post('question');
			$data['quiz_type']		= 2;
			$data['quiz_name_ID']	= $id;
			$data['weight']			= $this->input->post('weight', TRUE);
			$data['explanation']	= $this->input->post('explanation', TRUE);
		}
		else
		{
			$data['question'] 	= $this->input->post('question');
			$data['answer_1']	= $this->input->post('answer_1');
			$data['answer_2']	= $this->input->post('answer_2');
			$data['answer_3']	= $this->input->post('answer_3');
			$data['answer_4'] 	= $this->input->post('answer_4');
			$data['answer_5']	= $this->input->post('answer_5');
			$data['answer_key']	= $this->input->post('answer_key', TRUE);
			$data['explanation']	= $this->input->post('explanation');
			$data['quiz_name_ID']	= $id;
		}

		if ($audio_name != NULL) {
			$data['audio']	= $audio_name;
		}
		
		$this->db->insert($this->_table_quiz, $data);
	}


	// Data From Import
	public function create_data($data)
	{
		$this->db->insert($this->_table_quiz, $data);
	}

	public function update_data($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table_quiz, $data);
	}

	public function get_question($question)
	{
		$this->db
		->select('question')
		->where('question', $question);
		return  $this->db->get($this->_table_quiz)->num_rows();
	}
	// End Data From Import

	public function update_quiz($audio_name = NULL)
	{
		if ($audio_name != NULL) {
			$data 	= array(
				'question'		=> $this->input->post('question'),
				'audio'			=> $audio_name,
				'answer_1' 		=> $this->input->post('answer_1'),
				'answer_2'		=> $this->input->post('answer_2'),
				'answer_3'		=> $this->input->post('answer_3'),
				'answer_4'		=> $this->input->post('answer_4'),
				'answer_5'		=> $this->input->post('answer_5'),
				'answer_key'	=> $this->input->post('answer_key', TRUE),
				'weight'		=> $this->input->post('weight', TRUE),
				'explanation'	=> $this->input->post('explanation'),
			);
		}else{
			$data 	= array(
				'question'		=> $this->input->post('question'),
				'answer_1' 		=> $this->input->post('answer_1'),
				'answer_2'		=> $this->input->post('answer_2'),
				'answer_3'		=> $this->input->post('answer_3'),
				'answer_4'		=> $this->input->post('answer_4'),
				'answer_5'		=> $this->input->post('answer_5'),
				'answer_key'	=> $this->input->post('answer_key', TRUE),
				'weight'		=> $this->input->post('weight', TRUE),
				'explanation'	=> $this->input->post('explanation'),
			);
		}
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->update($this->_table_quiz, $data);
	}

	public function get_quiz_by_id($id)
	{
		return $this->db->get_where($this->_table_quiz, ['ID' => $id ])->row();
	}

	public function get_question_by_quiz_name_id($id)
	{
		return $this->db
		->select('a.ID, a.teacher_ID, a.title, a.description, a.time, a.regulations, a.multiple_choice_percentage, a.essay_percentage, a.status,b.question, b.quiz_type, b.answer_1, b.answer_2, b.answer_3, b.answer_4, b.answer_5, b.answer_key, b.weight')
		->where('a.ID', $id)
		->join('quiz b', 'b.quiz_name_ID=a.ID')
		->order_by('b.quiz_type', 'asc')
		->get($this->_table_quiz_name.' a')
		->result();
	}

	public function get_quiz_by_quiz_name_id($id)
	{
		return $this->db
		->select('ID, quiz_type, question, audio, status, answer_key, answer_1, answer_2, answer_3, answer_4, answer_5, explanation')
		->from('quiz')
		->where('quiz_name_ID', $id)
		->get()
		->result();
	}

	// public function get_quiz_rand_by_quiz_name_id($id, $limit = NULL, $quiz_type = '1')
	// {
	// 	$this->db->select('ID');
	// 	$this->db->from('quiz');
	// 	$this->db->where('quiz_name_ID', $id);
	// 	$this->db->where('quiz_type', $quiz_type);
	// 	$this->db->where('status', '1');
	// 	if ($limit != NULL) 
	// 	{
	// 		$this->db->limit($limit);
	// 	}
	// 	$this->db->order_by('rand()');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function get_essay_by_quiz_name_id($id, $quiz_type = '2')
	// {
	// 	return $this->db
	// 	->select('ID')
	// 	->from('quiz')
	// 	->where('quiz_name_ID', $id)
	// 	->where('quiz_type', $quiz_type)
	// 	->where('status', '1')
	// 	->order_by('rand()')
	// 	->get()
	// 	->result();
	// }


	public function get_quiz_rand_by_quiz_name_id($id, $limit = NULL, $quiz_type = '1', $student_ID, $classroom_ID, $random_number = 1)
	{
		$sql1 = "SET @number=0, @student_ID = $student_ID,  @classroom_ID = $classroom_ID";
		$this->db->query($sql1);

		if ($limit != NULL) {

			if ($random_number == 1) {
				$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='1' and status='1' order by rand() limit $limit ";
			}else{
				$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='1' and status='1' order by ID asc limit $limit ";
			}
		}else{
			if ($random_number == 1) {
				$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='1' and status='1' order by rand()";	
			}else{
				$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='1' and status='1' order by ID asc";	
			}
		}

		
		$sql3 = "SELECT @student_ID as student_ID, @classroom_ID as classroom_ID, @number := @number+1 as number, quiz_table.ID as quiz_ID from ($sql2) as quiz_table join (SELECT @number:=0) t2";

		if ($this->db->query($sql3)->num_rows() < 1) {
			return FALSE;
		}else{
			$query4 = $this->db->query("INSERT INTO quiz_answer (student_ID,classroom_ID, number, quiz_ID) $sql3 ");
			return $this->db->query($sql3)->num_rows();
		}
	}

	public function get_essay_by_quiz_name_id($id, $student_ID, $classroom_ID, $number = 0, $random_number = 1)
	{
		$sql1 = "SET @number=$number, @student_ID = $student_ID,  @classroom_ID = $classroom_ID";
		$this->db->query($sql1);

		if ($random_number == 1) {
			$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='2' and status='1' order by rand()";
		}else{
			$sql2 = "select ID from quiz where quiz_name_ID=$id and quiz_type='2' and status='1' order by ID asc";
		}

		$sql3 = "SELECT @student_ID as student_ID, @classroom_ID as classroom_ID, @number := @number+1 as number, quiz_table.ID as quiz_ID from ($sql2) as quiz_table";
		
		$query = $this->db->query($sql3);

		if ($query->num_rows() < 1) {
			return FALSE;
		}else{
			return $this->db->insert_batch('quiz_answer', $query->result_array() );
		}
	}


	
	public function get_multiple_choice_review($classroom_ID, $student_ID)
	{
		return $this->db
		->select('a.answer, a.is_correct, b.question, b.answer_key, b.answer_1, b.answer_2, b.answer_3, b.answer_4, b.answer_5, b.explanation, b.ID')
		->from('quiz_answer a')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->where('a.classroom_ID', $classroom_ID)
		->where('a.student_ID', $student_ID)
		->where('b.quiz_type', 1)
		->order_by('a.number', 'asc')
		->get();
	}

	public function set_secore_essay()
	{
		return $this->db
		->where('ID', $this->input->post('ID', TRUE))
		->set('answer_score', $this->input->post('answer_score', TRUE))
		->update('quiz_answer');
	}

	public function get_essay_review($classroom_ID, $student_ID)
	{
		return $this->db
		->select('b.ID, a.answer_essay, a.answer_score, b.question, b.explanation')
		->from('quiz_answer a')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->where('a.classroom_ID', $classroom_ID)
		->where('a.student_ID', $student_ID)
		->where('b.quiz_type', 2)
		->order_by('a.number', 'asc')
		->get();
	}

	public function make_an_archive($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', 2)
		->update($this->_table_quiz_name);
	}

	public function make_active($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', 1)
		->update($this->_table_quiz_name);
	}

	public function enable_quiz($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', 1)
		->update($this->_table_quiz);
	}

	public function disable_quiz($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', 2)
		->update($this->_table_quiz);
	}

	public function delete_quiz($id)
	{
		return $this->db
		->where('ID', $id)
		->delete($this->_table_quiz);
	}

	public function get_quiz_for_student($student_ID, $classroom_ID, $number)
	{
		return $this->db
		->select('a.ID, a.quiz_ID, a.number, a.classroom_ID, a.answer, a.answer_essay, b.quiz_type, b.question, b.audio, b.quiz_name_ID, b.answer_1, b.answer_2, b.answer_3, b.answer_4, b.answer_5, a.is_doubtful')
		->from('quiz_answer a')
		->join('quiz b', 'a.quiz_ID=b.ID', 'inner')
		->where('student_ID', $student_ID)
		->where('classroom_ID', $classroom_ID)
		->where('number', $number)
		->get()
		->row();
	}

	public function get_quiz_numbers($student_ID, $classroom_ID)
	{
		return $this->db
		->select('classroom_ID, number, answer, answer_essay, is_doubtful')
		->from('quiz_answer')
		->where('student_ID', $student_ID)
		->where('classroom_ID', $classroom_ID)
		->order_by('number', 'asc')
		->get()
		->result();
	}

	public function get_correct_answer($quiz_id)
	{
		return $this->db
		->select('a.answer_key')
		->from('quiz a')
		->join('quiz_answer b', 'b.quiz_ID=a.ID')
		->where('b.ID', $quiz_id)
		->get()
		->row()
		->answer_key;
	}

	public function save_essay_answer()
	{
		return $this->db
		->where('ID', decode($this->input->post('ID', TRUE)))
		->where('student_ID', $this->session->userdata['ID'])
		->set('answer_essay', addslashes($this->input->post('answer', TRUE)))
		->update('quiz_answer');
	}

	public function save_answer($is_correct)
	{
		$data = ['answer' => $this->input->post('answer'), 'is_doubtful' => $this->input->post('doubtful', TRUE), 'is_correct' => $is_correct];

		return $this->db
		->where('ID', decode($this->input->post('ID', TRUE)))
		->where('student_ID', $this->session->userdata['ID'])
		->update('quiz_answer', $data);
	}

	public function set_doubtful($doubtful)
	{
		return $this->db
		->where('ID', decode($this->input->post('ID', TRUE)))
		->where('student_ID', $this->session->userdata['ID'])
		->set('is_doubtful', $doubtful)
		->update('quiz_answer');
	}

	public function get_quiz_total($classroom_ID, $student_ID = NULL)
	{
		$this->db->select('ID');
		$this->db->where('classroom_ID', $classroom_ID);
		if ($student_ID != NULL) {
			$this->db->where('student_ID', $student_ID);
		}
		return $this->db->get($this->_table_quiz_answer)->num_rows();
	}

	public function count_mutiple_choice_by_cc($classroom_code = NULL, $classroom_ID = NULL)
	{
		$query1 =  $this->db
		->select('a.multiple_choice_limit')
		->from('classroom a')
		->where('a.code', $classroom_code)
		->get()
		->row()
		->multiple_choice_limit;

		if ($query1 > 0) 
		{
			return $query1;
		}
		else
		{
			$query2 = $this->db
			->select('a.quiz_ID')
			->from('quiz_answer a')
			->where('a.classroom_ID', $classroom_ID)
			->join('quiz b', 'b.ID=a.quiz_ID', 'left')
			->where('b.quiz_type', 1)
			->group_by('a.quiz_ID')
			->get()
			->num_rows();
			return $query2;
		}
	}

	public function count_essay_by_cc($classroom_code)
	{
		return $this->db
		->select('a.quiz_ID')
		->join('quiz c', 'c.ID=a.quiz_ID', 'left')
		->join('classroom b', 'b.quiz_name_ID=c.quiz_name_ID')
		->where('b.code', $classroom_code)
		->where('a.classroom_ID=b.ID')
		->where('c.quiz_type', 2)
		->group_by('a.quiz_ID')
		->get('quiz_answer a')
		->num_rows();
	}

	public function count_quiz_by_classroom_id($classroom_ID, $quiz_type = NULL)
	{
		if ($quiz_type == 1) {
			$multiple_choice_limit = $this->db->select('multiple_choice_limit')->where('ID', $classroom_ID)->get('classroom')->row()->multiple_choice_limit;
			if ($multiple_choice_limit > 0 ) {
				return $multiple_choice_limit;
			}else{
				$query = $this->db
				->select('a.ID')
				->from('quiz_answer a')
				->where('a.classroom_ID', $classroom_ID)
				->join('quiz b', 'b.ID=a.quiz_ID', 'left')
				->where('b.quiz_type', $quiz_type)
				->group_by('a.quiz_ID')
				->get()
				->num_rows();
				return $query;
			}
		}else{
			$query = $this->db
			->select('a.ID')
			->from('quiz_answer a')
			->where('a.classroom_ID', $classroom_ID)
			->join('quiz b', 'b.ID=a.quiz_ID', 'left')
			->where('b.quiz_type', $quiz_type)
			->group_by('a.quiz_ID')
			->get()
			->num_rows();
			return $query;
		}
		
	}
	
	public function get_correct_answer_total($classroom_ID, $student_ID)
	{
		return $this->db
		->select('a.ID')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->where('a.classroom_ID', $classroom_ID)
		->where('a.student_ID', $student_ID)
		->where('a.is_correct', 1)
		->where('b.quiz_type', 1)
		->get($this->_table_quiz_answer.' a')
		->num_rows();
	}

	public function get_score_weight($quiz_name_ID)
	{
		return $this->db
		->select('SUM(weight) as score')
		->where('quiz_name_ID', $quiz_name_ID)
		->where('quiz_type', 2)
		->get('quiz')
		->row()
		->score;
	}

	public function get_score_essay($classroom_ID, $student_ID)
	{
		$query =  $this->db
		->select('SUM(a.answer_score) as score')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->where('a.classroom_ID', $classroom_ID)
		->where('a.student_ID', $student_ID)
		->where('b.quiz_type', 2)
		->get('quiz_answer a')
		->row()
		->score;

		// if ($query <= 0) {
		// 	return 0;
		// }else{
		// 	return $query;
		// }
		return $query;
	}

	public function get_student_by_classroom_code($classroom_code)
	{
		return $this->db
		->select('a.ID, a.code, a.name')
		->from('student a')
		->join('quiz_answer b', 'b.student_ID=a.ID', 'left')
		->join('classroom c', 'c.ID=b.classroom_ID')
		->where('c.code', $classroom_code)
		->group_by('a.ID')
		->get();
	}

	public function get_student_multiple_choice($classroom_code, $student_ID = NULL)
	{
		if ($student_ID == NULL) {
			$query = "SELECT a.ID, a.code, a.name, COUNT(b.number) AS jumlah_soal, SUM(IFNULL(b.is_correct, 0)) AS jumlah_benar FROM student AS a LEFT JOIN quiz_answer as b on b.student_ID=a.ID INNER JOIN quiz d ON d.ID=b.quiz_ID INNER JOIN classroom as c on c.ID=b.classroom_ID where c.code='$classroom_code' AND d.quiz_type='1' GROUP BY b.student_ID";
		}else{
			$query = "SELECT a.ID, a.code, a.name, a.phone_number, a.school, a.province, a.email, COUNT(b.number) AS jumlah_soal, SUM(b.is_correct) AS jumlah_benar, SUM(b.answer_score) AS score FROM student AS a LEFT JOIN quiz_answer as b on b.student_ID=a.ID INNER JOIN quiz d ON d.ID=b.quiz_ID INNER JOIN classroom as c on c.ID=b.classroom_ID where c.ID='$classroom_code' AND b.student_ID='$student_ID' AND d.quiz_type='1' GROUP BY b.student_ID";
		}
		return $this->db->query($query);
	}

	public function get_student_essai($classroom_code, $student_ID = NULL)
	{

		$query = "SELECT a.ID, a.code, a.name FROM student AS a LEFT JOIN quiz_answer as b on b.student_ID=a.ID INNER JOIN quiz d ON d.ID=b.quiz_ID INNER JOIN classroom as c on c.ID=b.classroom_ID where c.code='$classroom_code' AND d.quiz_type='2' GROUP BY b.student_ID";
		return $this->db->query($query);
	}

	public function get_essay_answer($classroom_ID, $student_ID)
	{
		return $this->db
		->select('a.ID, a.answer_essay, answer_score, b.question, b.weight')
		->from('quiz_answer a')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->join('quiz_name c', 'c.ID=b.quiz_name_ID')
		->where('b.quiz_type', 2)
		->where('a.classroom_ID', $classroom_ID)
		->where('a.student_ID', $student_ID)
		->group_by('a.ID')
		->group_by('a.student_ID')
		->group_by('a.answer_essay')
		->group_by('a.answer_score')
		->group_by('b.question')
		->get();
	}

	public function get_essay_by_paggination($number,$offset, $classroom_ID)
	{
		$this->db
		->select('a.student_ID, e.ID')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->join('quiz_name c', 'c.ID=b.quiz_name_ID')
		->join('student e', 'e.ID=a.student_ID')
		->where('b.quiz_type', 2)
		->where('a.classroom_ID', $classroom_ID)
		->group_by('a.student_ID');
		$data = $this->db->get('quiz_answer a', $number, $offset);
		return $data;
	}

	public function get_essay_answer_student($classroom_ID='', $quiz_type='2')
	{
		return $this->db
		->select('a.student_ID')
		->from('quiz_answer a')
		->join('quiz b', 'b.ID=a.quiz_ID')
		->where('a.classroom_ID', $classroom_ID)
		->where('b.quiz_type', $quiz_type)
		->group_by('a.student_ID')
		->get()->num_rows();
	}

	public function get_quiz_name_time($classroom_ID)
	{
		return $this->db
		->select('a.time, a.ID')
		->from('quiz_name a')
		->join('classroom b', 'b.quiz_name_ID=a.ID')
		->where('b.ID', $classroom_ID)
		->group_by('a.ID')
		->group_by('a.ID')
		->get()
		->row()
		->time;
	}

	public function get_answer_key($code)
	{
		return $this->db
		->select('c.answer_key')
		->join('quiz c', 'c.ID=a.quiz_ID', 'left')
		->join('classroom b', 'b.quiz_name_ID=c.quiz_name_ID')
		->where('b.code', $code)
		->where('a.classroom_ID=b.ID')
		->where('c.quiz_type', 1)
		->group_by('c.ID')
		->get('quiz_answer a')
		->result();
	}

	public function get_analisa_pilihan_ganda($student_ID, $classroom_ID)
	{
		return $this->db
		->select('a.quiz_ID, a.answer, a.is_correct')
		->from('quiz_answer a')
		->where('a.student_ID', $student_ID)
		->where('a.classroom_ID', $classroom_ID)
		->order_by('a.quiz_ID', 'asc')
		->get();
	}

	public function check_quiz_type($classroom_ID)
	{
		return $this->db
		->select('IFNULL(COUNT(a.ID),0) as jumlah')
		->from('quiz_answer a')
		->join('quiz b', 'a.quiz_ID=b.ID', 'left')
		->where('a.classroom_ID', $classroom_ID)
		->where('b.quiz_type', '2')
		->get()
		->row()
		->jumlah;
	}

	public function delete_all_archive()
	{
		$query = "DELETE FROM quiz_answer WHERE quiz_ID IN(SELECT ID from quiz where quiz_name_ID IN(select ID from quiz_name where status='2'))";
		$this->db->query($query);

		$query = "DELETE  from quiz where quiz_name_ID IN(select ID from quiz_name where status='2')";
		$this->db->query($query);

		$query = "DELETE from quiz_name where status='2'";
		$this->db->query($query);
	}

	public function get_explanation($ID)
	{
		return $this->db->where('ID', $ID)->get('quiz');
	}

	public function delete_quiz_name($ID)
	{
		return $this->db->where('ID', $ID)->delete('quiz_name');
	}

}