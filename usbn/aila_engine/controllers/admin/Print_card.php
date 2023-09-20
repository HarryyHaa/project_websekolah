<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Print_card extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// cek login
		if ($this->session->userdata('level') != 1) {
			$this->session->set_flashdata('info', 'Maaf, hanya admin yang berhak mengakses halaman ini');
			redirect('main/admin_login');
		}


		// Set template and directori content
		$this->template->set_template('backend/template/admin-template');
		$this->template->set_directory_content('backend/admin');
	}

	public function index()
	{
		$data['print_card_student'] = $this->print_model->student_by_print();
		$this->template->view('print_card_student', $data);
	}

	public function check_code_print($code = NULL)
	{
		if (!$code) redirect('admin/print_card_student');

		$print_card_student = $this->print_model->student_by_print();
		if ($print_card_student) {
			$data['print_card_student'] = $print_card_student;
			$data['code'] = $this->print_model->student_by_print();
			$data['name'] = $this->print_model->student_by_print();
			$data['class'] = $this->print_model->student_by_print();
			$this->template->view('riview_print_card_student', $data);
			//$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($print_card_student->quiz_name_ID);
			//$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
			//$data['essay_total'] = $this->quiz_model->count_quiz_by_classroom_id($print_card_student->ID, 2);
			// $data['nilai_siswa']= $this->quiz_model->get_student_by_classroom_code($code)->result();
			//$data['student_print']= $this->quiz_model->get_student_multiple_choice($code)->result();
			//$this->template->view('check_code_print', $data);
		} else {
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/print_card_student');
		}
	}

	public function check_print_classroom($code = NULL)
	{
		/*if (!$code) redirect('admin/print_card_student');

		$print_card_student = $this->print_model->get_classroom_by_code($code);
		if ($print_card_student)
		{

			$data['print_card_student'] = $print_card_student;
			//$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			//$data['quiz_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
			//$data['essay_total'] = $this->quiz_model->count_essay_by_cc($code);
			//$data['nilai_siswa']= $this->quiz_model->get_student_by_classroom_code($code)->result();

			$this->load->view('backend/teacher/print_classroom_check', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/print_card_student');
		}*/
	}
}
