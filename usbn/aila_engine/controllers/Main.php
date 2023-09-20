<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$this->cek_login();

		// Set template and directori content
		$this->template->set_template('frontend/template/login-template');
		$this->template->view('main');
	}

	public function admin_login()
	{
		$this->cek_login();

		if ($this->input->post()) 
		{
			// Load login model and form validation
			$login = $this->login_model;
			$validation = $this->form_validation;
			$validation->set_rules($login->admin_rules(''));

			if ($validation->run()) {

				// get email and password
				$email 		= $this->input->post('email');
				$password 	= $this->input->post('password');

				$table 		= 'admin';
				$column 	= 'email';

				// Get user ID only
				$user = $login->get_user_id($table,$column, $email);
				if ($user) 
				{
					// Check password combination
					if ($login->cek_auth($table, $user->ID, $password)) 
					{
						// Get user detail and set session
						$user = $login->get_user_by_id($table, $user->ID);
						$data = array(
							'ID' 	=> $user->ID,
							'name'	=> $user->name,
							'email'	=> $user->email,
							'level'	=> 1,
							'teacher_guide' => TRUE,
							'student_guide' => TRUE
						);

						$this->session->set_userdata($data);
						redirect('admin/home');
					}
					else
					{
					// Wrong password
						$this->session->set_flashdata('info', 'Wrong password!');
						redirect('main/admin_login');
					}
				}
				else
				{
				// User not found!
					$this->session->set_flashdata('info', 'User not found!');
					redirect('main/admin_login');
				}
			}
			else
			{
				// Show login form if vorm validation false
				$this->template->set_template('frontend/template/login-template');
				$this->template->view('login/admin-login');
			}
		}
		else
		{
			// Show login form if not input set
			$this->template->set_template('frontend/template/login-template');
			$this->template->view('login/admin-login');
		}
	}


	public function teacher_login()
	{
		$this->cek_login();

		if ($this->input->post()) 
		{
			// Load login model and form validation
			$login = $this->login_model;
			$validation = $this->form_validation;
			$validation->set_rules($login->teacher_rules());

			if ($validation->run()) {

				// get nip and password
				$nip 		= $this->input->post('code');
				$password 	= $this->input->post('password');

				$table 		= 'teacher';
				$column 	= 'code';

				// Get user ID only
				$user = $login->get_user_id($table,$column, $nip);
				if ($user) 
				{
					// Check password combination
					if ($login->cek_auth($table, $user->ID, $password)) 
					{
						// Get user detail
						$user = $login->get_user_by_id($table, $user->ID);
						if ($user->status == 1) 
						{
							$data = array(
								'ID' 			=> $user->ID,
								'name'			=> $user->name,
								'code'			=> $user->code,
								'email' 		=> $user->email,
								'phone_number' 	=> $user->phone_number,
								'level'			=> 2,
								'teacher_guide' => TRUE,
								'question_management_guide' => TRUE
							);
						 // set session
							$this->session->set_userdata($data);
							$this->teacher_model->update_last_login($user->ID);
							redirect('teacher/home');
						}
						else
						{
							// Teacher inactive
							$this->session->set_flashdata('info', 'Teacher Inactive!');
							redirect('main/teacher_login');
						}
					}
					else
					{
					// Wrong password
						$this->session->set_flashdata('info', 'Wrong password!');
						redirect('main/teacher_login');
					}
				}
				else
				{
				// Teacher not found!
					$this->session->set_flashdata('info', 'Teacher not found!');
					redirect('main/teacher_login');
				}
			}
			else
			{
				// Show login form if vorm validation false
				$this->template->set_template('frontend/template/login-template');
				$this->template->view('login/teacher-login');
			}
		}
		else
		{
			// Show login form if not input set
			$this->template->set_template('frontend/template/login-template');
			$this->template->view('login/teacher-login');
		}
	}

	public function student_login()
	{
		$this->cek_login();
		
		if ($this->input->post()) 
		{
			// Load login model and form validation
			$login = $this->login_model;
			$validation = $this->form_validation;
			$validation->set_rules($login->student_rules());

			if ($validation->run()) {

				// get nip and password
				$nis 		= $this->input->post('code');
				$password 	= $this->input->post('password');

				$table 		= 'student';
				$column 	= 'code';

				// Get user ID only
				$user = $login->get_user_id($table,$column, $nis);
				if ($user) 
				{
					// Check password combination
					if ($login->cek_auth($table, $user->ID, $password)) 
					{
						// Get user detail and set session
						$user = $login->get_user_by_id($table, $user->ID);
						
						if ($user->status != '1') {
							$this->session->set_flashdata('info', 'Anda tidak bisa masuk karena akun anda tidak aktif!');
							redirect('main/student_login');
						}else{

							$session_id = time();
							$data = array(
								'ID' 			=> $user->ID,
								'name'			=> $user->name,
								'code'			=> $user->code,
								'email' 		=> $user->email,
								'phone_number' 	=> $user->phone_number,
								'group_id'		=> $user->group_ID,
								'session_id'	=> $session_id,
								'level'			=> 3
							);

							$this->session->set_userdata($data);
							$this->student_model->update_last_login($user->ID, $session_id);
							redirect('student/home');
						}
					}
					else
					{
					// Wrong password
						$this->session->set_flashdata('info', 'Password Yang Dimasukan Salah!');
						redirect('main/student_login');
					}
				}
				else
				{
				// student not found!
					$this->session->set_flashdata('info', 'Nama Siswa Tidak Terdata!');
					redirect('main/student_login');
				}
			}
			else
			{
				// Show login form if vorm validation false
				$this->template->set_template('frontend/template/login-template');
				$this->template->view('login/student-login');
			}
		}
		else
		{
			// Show login form if not input set
			$this->template->set_template('frontend/template/login-template');
			$this->template->view('login/student-login');
		}
	}

	public function not_found()
	{
		$this->template->set_template('frontend/template/login-template');
		$this->template->view('not_found');
	}

	public function logout()
	{
		$data = array('ID', 'name',	'email', 'level' );
		$this->session->unset_userdata($data);
		$this->student_login();
	}

	private function cek_login()
	{
		if ($this->session->userdata('level') == 1) 
		{
			redirect('admin/home');
		}

		if ($this->session->userdata('level') == 2) 
		{
			redirect('teacher/home');
		}

		if ($this->session->userdata('level') == 3) 
		{
			redirect('student/home');
		}
	}
}
