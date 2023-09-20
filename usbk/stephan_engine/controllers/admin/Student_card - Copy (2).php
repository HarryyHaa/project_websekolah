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

	public function index()
	{
		$this->template->view('classroom_index_cetak_kartu');
	}


	public function get_classroom_json($status=1)
	{
		$classroom =  $this->classroom_model->get_classroom_with_datatables($status);
		$data = array();
		$no = $this->input->post('start', TRUE);

		foreach ($classroom as $class) 
		{
			$no++;
			if ($class->scheduled == 1) {
				$status_detail =  "Dijadwalkan ".$class->date_start.' - '.$class->time_start;
			}else{
				if ($class->working_status == '0') {
					$status_detail =  "Belum dimulai";
				}elseif ($class->working_status == '1') {
					$status_detail = "Berlangsung";
				}else{
					$status_detail = "Selesai";
				}
			};

			 if ($class->lock == 0) {
			 	$aksi = "<a  onclick=\"return confirm('Dengan mengunci kelas ujian, maka tidak akan ada peserta yang bisa bergabung ke kelas ujian ini. Apakah Anda yakin?')\" href=\"".site_url('admin/classroom/lock/'.$class->code)."\" class=\"btn-small btn-floating orange\" title=\"Kunci Kelas Ujian\"><i class=\"material-icons\">lock_open</i></a>";
			 }else{
			 	$aksi = "<a onclick=\"return confirm('Dengan membuka kelas ujian, maka peserta bisa bergabung ke kelas ujian ini. Apakah Anda yakin?')\" href=\"".site_url('admin/classroom/unlock/'.$class->code)."\" class=\"btn-small btn-floating black\" title=\"Buka Kelas Ujian\"><i class=\"material-icons\">lock</i></a>";
			 }

			$row = array();
			$row[] = $no;
			$row[] = "<a href=\"".site_url('admin/student_card/check_code_cetak_kartu/'.$class->code)."\" title=\"Lihat Detail\">".$class->name."</a>";
			$row[] = "<a target=\"_blank\" href=\"".site_url('admin/quiz/questions_list/'.encode($class->quiz_name_ID))."\" title=\"Lihat Detail\">".$class->quiz_name."</a>";
			$row[] = $status_detail;
			$row[] = "<span style=\"font-family: Sans-serif\"><a href=\"".site_url('admin/student_card/check_code_cetak_kartu/'.$class->code)."\">".strtoupper($class->code)."</a> <a  onclick=\"return confirm('Apakah Anda yakin ingin menggenerate ulang kode kelas?')\"  title=\"Genrate Ulang\" class=\"btn btn-small btn-floating blue\" href=\"".site_url('admin/classroom/regenerate_code/'.encode($class->ID))."\"><i class=\"material-icons\">autorenew</i></a></span>";

			$row[] = $aksi. " <a href=\"".site_url('admin/classroom/update/'.$class->code)."\" class=\"btn-small btn-floating green\" title=\"Ubah Kelas\"><i class=\"material-icons\">edit</i></a> <a onclick=\"return confirm('Apakah yakin kelas ini mau diarsipkan?')\" href=\"".site_url('admin/classroom/make_an_archive/'.$class->code)."\" class=\"btn-small btn-floating brown\" title=\"Arsipkan Kelas\"><i class=\"material-icons\">archive</i></a> <a href=\"".site_url('admin/student_card/check_code_cetak_kartu/'.$class->code)."\" class=\"btn-small btn-floating blue\" title=\"Lihat Detail\"><i class=\"material-icons\">arrow_forward</i></a>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw', TRUE),
			"recordsTotal" => $this->classroom_model->count_all($status),
			"recordsFiltered" => $this->classroom_model->count_filtered($status),
			"data" => $data,
		);

		echo json_encode($output);
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

	public function print_classroom($code = NULL)
	{
		if (!$code) redirect('admin/student_card');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{

			$data['classroom'] 	= $classroom;
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$data['quiz_total'] = $this->quiz_model->get_quiz_total($classroom->ID);
			$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code, $classroom->ID);
			$data['essay_total'] = $this->quiz_model->count_quiz_by_classroom_id($classroom->ID, 2);
			$student_score= $this->quiz_model->get_student_multiple_choice($code);
			if ($student_score->num_rows() == 0) {
				$data['student_essai'] = $this->quiz_model->get_student_essai($code)->result();
			}else{
				$data['student_score'] = $student_score->result();
			}

			$this->load->view('backend/admin/print_classroom_card', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/student_card');
		}
	}	

}
