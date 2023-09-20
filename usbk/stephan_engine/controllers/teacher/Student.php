<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// cek login
		if ($this->session->userdata('level') != 2) 
		{
			$this->session->set_flashdata('info','Maaf, hanya guru yang sudah masuk yang berhak mengakses halaman ini');
			redirect('main/teacher_login');
		}

		// Set template and directori content
		$this->template->set_template('backend/template/teacher-template');
		$this->template->set_directory_content('backend/teacher');
	}

	public function index()
	{
		$this->template->view('student');
	}

	public function create()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->student_model->create_rules());

			if ($validation->run()) {

				// If student code has been registered
				if ($this->student_model->get_student_code($this->input->post('code')) >=1 ) 
				{
					$this->session->set_flashdata('failed', 'Maaf, siswa dengan '.$this->config->item('student_code').' tersebut sudah terdaftar!');
				}
				else
				{
					// Create new student
					$this->student_model->create();
					$this->session->set_flashdata('success', 'Selamat, siswa berhasil ditambah!');
				}
				
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, siswa gagal ditambah!');
		}
		redirect('teacher/student');
	}

	public function search()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required|max_length[20]');
		if ($this->form_validation->run() == FALSE) 
		{
			redirect('teacher/student');
		}
		else
		{
			$students = $this->student_model->search_by_name();
			if ($students->num_rows() >= 1) 
			{
				$data['students'] = $students->result();
				$this->template->view('search', $data);
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, tidak ditemukan siswa dengan nama tersebut');
				redirect('teacher/student');
			}
		}
	}

	public function password_reset($id = NULL)
	{
		if (!$id) redirect('teacher/student');

		if ($this->student_model->get_student_by_id(decode($id))) 
		{
			$this->student_model->password_reset(decode($id));
			$this->session->set_flashdata('success', 'Selamat, password berhasil dirubah menjadi 12345678');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, reset password gagal, siswa tidak ditemukan');
		}
		redirect('teacher/student');
	}


}
