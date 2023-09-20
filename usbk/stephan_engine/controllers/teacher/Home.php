<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		if ($this->check_profile() == false) 
		{
			redirect('teacher/home/complete_profile');
		}
		if ($this->check_password() == false) 
		{
			redirect('teacher/home/reset_password');
		}

		$data['classroom'] 	= $this->classroom_model->get_classroom_by_teacher_id($this->session->userdata['ID'], $status = 1);
		$this->template->view('home', $data);
	}

	public function profile()
	{
		if ($this->input->post()) 
		{
			$data = [
				'name' 			=> $this->input->post('name', TRUE),
				'email'			=> $this->input->post('email', TRUE),
				'phone_number'	=> $this->input->post('phone_number', TRUE)
			];
			$this->teacher_model->update_data(['ID' => $this->session->userdata['ID']], $data);
			redirect('teacher/home/profile');
		}
		else
		{
			$data['profile'] = $this->teacher_model->get_teacher_by_id($this->session->userdata['ID']);
			$this->template->view('profile', $data);
		}
	}

	public function check_profile()
	{
		$data = $this->teacher_model->get_teacher_by_id($this->session->userdata['ID']);
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
			$this->teacher_model->complete_profile();
			redirect('teacher/home');
		}
		else
		{
			$this->template->view('complete_profile');
		}
	}

	public function check_password()
	{
		$data = $this->teacher_model->get_teacher_by_id($this->session->userdata['ID']);
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
			// Get password old from databse
			$hash = $this->teacher_model->check_old_password($this->session->userdata['ID']);

			// Verify old password
			if (password_verify($this->input->post('old_password', TRUE), $hash))
			{
				// Verfy is confirmation password is same or not
				if ($this->input->post('new_password', TRUE) == $this->input->post('password_confirm', TRUE)) 
				{
					$this->teacher_model->password_reset_by_teacher($this->session->userdata['ID']);
					$this->session->set_flashdata('success','Selamat, password Anda berhasil dirubah, silahkan jaga keamanan akun Anda dengan merubah passwordnya secara berkala. Terimakasih.');
					redirect('teacher/home');
				}
				else
				{
					$this->session->set_flashdata('failed','Maaf, konfirmasi password baru yang Anda masukan salah, silahan ulangi kembali');
					redirect('teacher/home/reset_password');
				}
			}
			else
			{
				$this->session->set_flashdata('failed','Maaf, password lama yang Anda masukan salah, silahan ulangi kembali');
				redirect('teacher/home/reset_password');
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
		redirect('main/teacher_login');
	}

}
