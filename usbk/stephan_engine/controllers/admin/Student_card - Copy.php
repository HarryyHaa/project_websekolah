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

	public function print_card_student($id=NULL)
	{
		
		if (!$id) redirect('admin/student_card');

		$student = $this->classroom_model->get_classroom_by_code($code);
		if ($student)
		{

			$data['student'] 	= $student;
			//$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			//$data['quiz_total'] = $this->quiz_model->get_quiz_total($classroom->ID);
			//$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code, $classroom->ID);
			//$data['essay_total'] = $this->quiz_model->count_quiz_by_classroom_id($classroom->ID, 2);
			$student_score= $this->quiz_model->get_student_multiple_choice($code);
			if ($student_score->num_rows() == 0) {
				$data['student_essai'] = $this->quiz_model->get_student_essai($code)->result();
			}else{
				$data['student_score'] = $student_score->result();
			}

			$this->load->view('backend/admin/print_card_student', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/student_card');
		}


		/*$data = $this->student_model->print_student_by_group($id);
		if (!$id) 
		{
			$data['groups'] = $this->group_model->get_groups()->result();
			$this->template->view('print_card_student', $data);
		}*/
	  /*	$kartu = '<h3>Data Peserta Masih Kosong</h3>';
		if(!empty($group_id)){
			$query_user = $this->student_model->get_by_kolom('user_group_id',$group_id);
			if($query_user->num_rows()>0){
				$kartu = '';
				$query_user = $query_user->result();

				$query_group = $this->student_model->get_by_kolom_limit('ID',ID);
				$group = 'NULL';
				if($query_group->num_rows()>0){
					$group = $query_group->row()->grup_nama;
				}

				foreach ($query_user AS $temp) {
					$kartu = $kartu.'
						<div class="kartu">
							<div class="header">"CBT PANCEN"</div>
							<hr />
						<table>
							<tr>
								<td width="95px">Nama</td>
								<td width="5px">:</td>
								<td width="210px">'.$temp->name.'</td>
							</tr>
						</table>	
						</div>
					';
				}
			}
		}

		$data['kartu'] = $kartu;

		$this->template->view('print_card_student',$data);
		if (!$id) redirect('admin/student_card');

		$student_card = $this->student_model->print_student_by_group($id);
		if ($student_card)
		{
			$data['student_card'] = $student_card;
			$data['code'] = $this->student_model->print_student_by_group($student_card->code);
			$data['name'] = $this->student_model->print_student_by_group($student_card->name);
			$this->load->view('print_card_student',$data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/student_card');
		}*/
	}
}
