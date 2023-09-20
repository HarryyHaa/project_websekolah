<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $_student;

	public function __construct()
	{
		parent::__construct();

		// cek login
		if ($this->session->userdata('level') != 3) 
		{
			$this->session->set_flashdata('info','Maaf, hanya siswa yang sudah masuk yang berhak mengakses halaman ini');
			redirect('main/student_login');
		}

		// get data student
		$this->_student = $this->student_model->get_student_by_id($this->session->userdata['ID']);

		limit_login($this->config->item('limit_login'));

		// Set template and directori content
		$this->template->set_template('backend/template/student-template');
		$this->template->set_directory_content('backend/student');
	}

	public function index()
	{
		if ($this->check_profile() == false) 
		{
			redirect('student/home/complete_profile');
		}
		if ($this->check_password() == false) 
		{
			redirect('student/home/reset_password');
		}

		$data['joined_classroom'] 	= $this->classroom_model->get_classroom_by_student_id($this->session->userdata['ID']);
		$this->template->view('home', $data);
	}

	public function check_profile()
	{
		$data = $this->_student;
		if (($data->phone_number == null) || ($data->email == null)) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function complete_profile()
	{
		if ($this->input->post()) 
		{
			$this->student_model->complete_profile();
				$this->session->set_flashdata('success','Selamat, profil Anda berhasil diperbaharui.');
			redirect('student/home/profile');
		}
		else
		{
			$data['profile'] 	= $this->_student;
			$this->template->view('complete_profile', $data);
		}
	}

	public function profile()
	{
		$data['profile'] 	= $this->_student;
		$this->template->view('profile', $data);
	}

	public function check_password()
	{
		$data = $this->_student;
		if (password_verify('12345678', $data->password)) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function reset_password()
	{
		if ($this->input->post()) 
		{
			
				// Verfy is confirmation password is same or not
			if ($this->input->post('new_password') == $this->input->post('password_confirm')) 
			{
				$this->student_model->password_reset_by_student($this->session->userdata['ID']);
				$this->session->set_flashdata('success','Selamat, password Anda berhasil dirubah, silahkan jaga keamanan akun Anda dengan merubah passwordnya secara berkala. Terimakasih.');
				redirect('student/home/profile');
			}
			else
			{
				$this->session->set_flashdata('failed','Maaf, konfirmasi password baru yang Anda masukan salah, silahan ulangi kembali');
				redirect('student/home/reset_password');
			}

		}
		else
		{
			$this->template->view('reset_password');
		}
	}

	public function guide()
	{
		$this->template->view('guide');
	}
	
	public function logout()
	{
		$data = array('ID', 'name',	'email', 'level' );
		$this->session->unset_userdata($data);
		redirect('main/student_login');
	}

}
