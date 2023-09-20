<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_card extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// cek login
		if ($this->session->userdata('level') != 1) 
		{
			$this->session->set_flashdata('info','Maaf, hanya admin yang berhak mengakses halaman ini');
			redirect('main/admin_login');
		}

		// Set template and directori content
		$this->template->set_template('backend/template/admin-template');
		$this->template->set_directory_content('backend/admin');
	}

	public function index($id = NULL)
	{
		$data['groups'] = $this->group_model->get_groups()->result();
		if ($id == NULL) 
		{

			$data['student'] = $this->student_model->get_student_active();
		}
		else
		{
			$groups = $this->group_model->get_group_by_id($id);
			if ($groups->num_rows() == 0) 
			{
				redirect('admin/student_card');
			}
			else
			{

				$data['group_name'] = $groups->row()->name;
			}
		}
		$data['group_id'] = $id;
		$this->template->view('student_index_card', $data);
	}

	public function student_index_card($id= NULL)
	{
		if (!$id) 
		{
			$data['groups'] = $this->group_model->get_groups()->result();
			$this->template->view('student_index_card', $data);
		}
	}

	public function check_code_cetak_kartu($code = NULL)
	{
		if (!$code) redirect('admin/student_card');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$data['classroom'] 	= $classroom;
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code, $classroom->ID);
			$data['essay_total'] = $this->quiz_model->count_quiz_by_classroom_id($classroom->ID, 2);
			$present = $this->classroom_model->get_present($classroom->ID);
			if ($present->num_rows() <= 0 ) {
				$this->session->set_flashdata('info', 'Silahkan pilih '.$this->config->item('student').' yang akan dimasukan ke kelas ujian. Lalu klik proses.');
				redirect('admin/classroom/add_students/'.encode($classroom->ID));
			}
			$data['present'] = $present->result();
			$this->template->view('list_score_kartu', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/student_card');
		}
	}

	public function print_card_student($id=NULL)
	{
		if (!$id) redirect('admin/student_card');

		$classroom = $this->student_model->print_student_by_group($id);
		if ('classroom');
		{
			$data['classroom'] = $classroom;
			$data['id'] = $this->student_model->print_student_by_group($id);	 
		}
		//$data['kartu'] = $classroom;
		$this->load->view('backend/admin/print_card_student', $data);
	}

}	