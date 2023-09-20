<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		
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
		$this->template->view('home');
	}

	public function join($code = NULL, $token = NULL)
	{
		if ($code == NULL OR $token == NULL) {
			echo "Ilegal access detected!";
		}else{
			echo "string";
		}
	}

}
