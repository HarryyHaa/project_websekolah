<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	public function index()
	{
		$where = ['status' => 1];
		$data['teacher']	= row_count('teacher', 'ID', $where);
		$data['student']	= row_count('student','ID', $where);
		$data['classroom']	= row_count('classroom','ID', $where);
		$data['quiz_name']	= row_count('quiz_name','ID', $where);
		$data['last_login']	= $this->student_model->get_studnet_last_login()->result();
		$data['groups_grafik'] 	= $this->student_model->count_studnet_by_group();
		$this->template->view('home', $data);
	}

	public function guide()
	{
		$this->template->view('guide');
	}


	public function school_profile()
	{
		if ($this->input->post()) 
		{
			$this->profile_model->update();
		}
		
		$data['profile'] = $this->profile_model->get_school_profile();
		$this->template->view('school_profile', $data);
	}

	public function admin_profile()
	{
		if ($this->input->post()) 
		{
			if ($this->input->post('old_password', TRUE)) 
			{
				// Get password old from databse
				$hash = $this->admin_model->check_old_password($this->session->userdata['ID']);

			// Verify old password
				if (password_verify($this->input->post('old_password', TRUE), $hash))
				{
				// Verfy is confirmation password is same or not
					if ( ($this->input->post('new_password', TRUE) == $this->input->post('password_confirm', TRUE))) 
					{
						$this->admin_model->password_reset_by_admin($this->session->userdata['ID']);
						$this->session->set_flashdata('success','Selamat, akun dan password anda berhasil dirubah, silahkan jaga keamanan akun anda dengan merubah passwordnya secara berkala. Terimakasih.');
						redirect('admin/home/admin_profile');
					}
					else
					{
						$this->session->set_flashdata('failed','Maaf, password baru dan konfirmasi password baru yang anda masukan salah, silahan ulangi kembali');
						redirect('admin/home/admin_profile');
					}
				}
				else
				{
					$this->session->set_flashdata('failed','Maaf, password lama yang anda masukan salah, silahan ulangi kembali');
					redirect('admin/home/admin_profile');
				}
			}
			else
			{
				$data = array(
					'name' 	=> $this->input->post('name', TRUE),
					'email'	=> $this->input->post('email', TRUE)
				);
				$this->admin_model->update_profile($this->session->userdata['ID'], $data);
				$this->session->set_flashdata('success','Selamat, akun anda berhasil diperbaharui, dan password anda masih menggunakan password yang lama.');
				redirect('admin/home/admin_profile');
			}
		}
		
		$data['profile'] = $this->profile_model->get_admin_profile($this->session->userdata('ID'));

		$this->template->view('admin_profile', $data);
	}

	public function archive()
	{
		$this->template->view('archive');
	}

	public function logout()
	{
		$data = array('ID', 'name',	'email', 'level' );
		$this->session->unset_userdata($data);
		redirect('main/admin_login');
	}

	
	
}
