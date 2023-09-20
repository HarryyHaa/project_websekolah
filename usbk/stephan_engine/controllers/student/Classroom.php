<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// cek login
		if ($this->session->userdata('level') != 3) 
		{
			$this->session->set_flashdata('info','Maaf, hanya siswa yang sudah masuk yang berhak mengakses halaman ini');
			redirect('main/student_login');
		}

		limit_login($this->config->item('limit_login'));

		// Set template and directori content
		$this->template->set_template('backend/template/student-template');
		$this->template->set_directory_content('backend/student');
	}

	public function index()
	{
		$data['classroom'] 	= $this->classroom_model->get_classroom_by_student_id($this->session->userdata['ID']);
		$this->template->view('classroom', $data);
	}

	public function available()
	{
		$data['classroom'] = $this->classroom_model->get_classroom_by_group_id($this->session->userdata('group_id'))->result();
		$this->template->view('classroom_available', $data);
	}

	public function join()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->classroom_model->classroom_join_rules());

			if ($validation->run() == TRUE) 
			{				
				$classroom_code = trim($this->input->post('code'));
				$classroom = $this->classroom_model->get_classroom_by_code($classroom_code);

				if ($classroom) 
				{
					if ($this->classroom_model->is_the_code_has_been_used($classroom_code, $this->session->userdata['ID'])) 
					{
						$this->session->set_flashdata('failed', 'Maaf, Anda anda sudah bergabung dengan kelas ini!');
						redirect('student/classroom');
					}
					else
					{

						if ($classroom->lock == 1) {
							$this->session->set_flashdata('failed', 'Maaf, Anda tidak bisa bergabung ke eklas ujian ini, karea kelas ujian dikunci, silahkan hubungi admin!');
							redirect('student/classroom');
						}else{

						// Join Classroom
							if ($this->get_question_and_insert($classroom->ID, $classroom->quiz_name_ID, $classroom->multiple_choice_limit, $classroom->random_number)) 
							{
								$this->session->set_flashdata('success', 'Selamat, Anda berhasil bergabung ke kelas baru!');
								redirect(site_url('student/classroom/detail/'.$classroom_code));
							}
							else
							{
								$this->session->set_flashdata('failed', 'Maaf, gagal bergabung dengan kelas karena tidak ditemukan soal pada kelas ini!');
								redirect('student/classroom');
							}
						}
					}
				}
				else
				{
					// Class code not found
					$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan, pastikan Anda memasukan kode kelas dengan benar tanpa spasi dan tanpa tanda baca apapun!');
					redirect('student/classroom');
				}

			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, silahkan masukan kode kelas dengan benar tanpa spasi!');
				redirect('student/classroom');
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, silahkan ikuti aturan dengan benar!');
			redirect('student/classroom');
		}
	}

	public function join_available($classroom_code = NULL)
	{
		if ($classroom_code == NULL) redirect('student/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($classroom_code);

		if ($classroom) 
		{
			if ($this->classroom_model->is_the_code_has_been_used($classroom_code, $this->session->userdata['ID'])) 
			{
				redirect('student/classroom/detail/'.$classroom_code);
			}
			else
			{

				if ($classroom->lock == 1) {
					$this->session->set_flashdata('failed', 'Maaf, Anda tidak bisa bergabung ke eklas ujian ini, karea kelas ujian dikunci, silahkan hubungi admin!');
					redirect('student/classroom');
				}else{

						// Join Classroom
					if ($this->get_question_and_insert($classroom->ID, $classroom->quiz_name_ID, $classroom->multiple_choice_limit, $classroom->random_number)) 
					{
						$this->session->set_flashdata('success', 'Selamat, Anda berhasil bergabung ke kelas baru!');
						redirect(site_url('student/classroom/detail/'.$classroom_code));
					}
					else
					{
						$this->session->set_flashdata('failed', 'Maaf, gagal bergabung dengan kelas karena tidak ditemukan soal pada kelas ini!');
						redirect('student/classroom');
					}
				}
			}
		}
		else
		{
					// Class code not found
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan, pastikan Anda memasukan kode kelas dengan benar tanpa spasi dan tanpa tanda baca apapun!');
			redirect('student/classroom');
		}
	}

	public function get_question_and_insert($classroom_ID, $quiz_name_ID, $multiple_choice_limit, $random_number)
	{
		if ($multiple_choice_limit != '' AND $multiple_choice_limit != NULL AND $multiple_choice_limit != 0) 
		{
			$limit = $multiple_choice_limit;
		}
		else
		{
			$limit = NULL;
		}
		$question_list = $this->quiz_model->get_quiz_rand_by_quiz_name_id($quiz_name_ID, $limit, 1, $this->session->userdata['ID'], $classroom_ID, $random_number);

		if ($question_list == FALSE) 
		{
			$number = 0;
		}
		else{
			$number = $question_list;
		}

		$essay_list = $this->quiz_model->get_essay_by_quiz_name_id($quiz_name_ID, $this->session->userdata['ID'], $classroom_ID, $number, $random_number);

		if ( ($question_list == FALSE) && ($essay_list == FALSE)) 
		{
			return FALSE;
		}
		else
		{
			$this->classroom_model->insert_quiz_timer($this->session->userdata['ID'], $classroom_ID);

			return TRUE;
		}
	}

	public function detail($code = NULL)
	{
		if (!$code) redirect('student/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{
			if ($this->classroom_model->is_the_code_has_been_used($code, $this->session->userdata['ID']) == FALSE)
			{
				$this->session->set_flashdata('failed', 'Maaf Anda tidak berhak masuk ke kelas ini!');
				redirect('student/classroom');
			} 
			else
			{
				$data['classroom'] 	= $classroom;
				$data['quiz']		= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID); 

				// check working status student
				$student_working_status = $this->classroom_model->get_quiz_timer($classroom->ID, $this->session->userdata['ID']);

				$data['student_working_status'] = $student_working_status;
				
				if (($data['classroom']->working_status == 2) ||  ($data['student_working_status']->status == 2)) {
					if ($classroom->show_result == 1) {


						$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
						$data['multiple_choice_score'] = count_score_multiple_choice($this->session->userdata['ID'], $classroom->ID, $data['mutiple_choice_total']);
						$data['essay_score'] = count_score_essay($this->session->userdata['ID'], $classroom->ID, $classroom->quiz_name_ID);

						$data['score_total'] = count_score_total($this->session->userdata['ID'], $classroom->ID, $classroom->quiz_name_ID, $data['quiz']->multiple_choice_percentage, $data['quiz']->essay_percentage);
					}
				}
				$this->template->view('detail', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas tidak ditemukan!');
			redirect('student/classroom');
		}
	}

	public function review($code = NULL)
	{
		if (!$code) redirect('student/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{
			if ($this->classroom_model->is_the_code_has_been_used($code, $this->session->userdata['ID']) == FALSE)
			{
				$this->session->set_flashdata('failed', 'Maaf Anda tidak berhak masuk ke kelas ini!');
				redirect('student/classroom');
			} 
			else
			{
				$classroom_ID 	= $classroom->ID;
				$student_ID 	= $this->session->userdata['ID'];

				if (empty($classroom_ID) or empty($student_ID)) redirect('admin/classroom');

				$data['classroom']	= $this->classroom_model->get_classroom_by_id($classroom_ID);

				$multiple_choice = $this->quiz_model->get_multiple_choice_review($classroom_ID, $student_ID);
				$data['multiple_choice'] 		= $multiple_choice->result();
				$data['total_mc_quiz'] = $multiple_choice->num_rows();

				$essay 	= $this->quiz_model->get_essay_review($classroom_ID, $student_ID);
				$data['essay'] 		= $essay->result();
				$data['total_essay_quiz'] = $essay->num_rows();

				$data['total_quiz'] = ($data['total_mc_quiz'] + $data['total_essay_quiz']);

				$data['correct_answer'] = $this->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
				
				$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($data['classroom']->quiz_name_ID);
				
				$this->template->view('review', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas tidak ditemukan!');
			redirect('student/classroom');
		}
	}

	public function explanation($code = NULL)
	{
		if (!$code) redirect('student/classroom');

		$explanation = $this->quiz_model->get_explanation(decode($code));
		if ($explanation->num_rows() > 0) {
			$data['explanation'] = $explanation->row();
			$this->template->view('explanation', $data);
		}else{
			$this->session->set_flashdata('failed', 'Maaf, pembahasan soal tidak ditemukan!');
			redirect('student/classroom');
		}
	}
}