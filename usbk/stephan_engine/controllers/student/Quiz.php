<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		date_default_timezone_get();

		// cek login
		if ($this->session->userdata('level') != 3) 
		{
			$this->session->set_flashdata('info','Maaf, hanya siswa yang sudah masuk yang berhak mengakses halaman ini');
			redirect('main/student_login');
		}

		limit_login($this->config->item('limit_login'));

		// Set template and directori content
		$this->template->set_template('backend/template/student-template');
		$this->template->set_directory_content('backend/student');

		// $this->output->enable_profiler(true);

	}

	public function index()
	{
		redirect(site_url('student/classroom'));
	}

	public function question($encode_id = NULL, $classroom_code = NULL)
	{
		// $this->output->enable_profiler(true);

		if (!$encode_id) redirect(site_url('student/classroom'));

		$decode_id 	= decode($encode_id);
		$array_id 		= explode('/', $decode_id);

		// check is record empty or not
		if (empty($array_id[0]) || empty($array_id[1])) redirect(site_url('student/classroom'));

		$classroom_ID	= $array_id[0];
		$number 		= $array_id[1];

		$quiz_timer = $this->classroom_model->get_quiz_timer(decode($classroom_ID), $this->session->userdata['ID']);

		if (!$quiz_timer) redirect(site_url('student/classroom'));

		// cek waktu join
		if ($quiz_timer->join_time != NULL) {
			$join_time = ((time() - ($quiz_timer->join_time)) / 60);

			// Waktu tunggu dari selesai siswa bergabung ke mulai mengerjakan
			$limit_time= 0;
			$remainder_time = $limit_time - $join_time;

			if ( $join_time < $limit_time ) {
				$this->session->set_flashdata('failed', 'Maaf, dafar soal untuk Anda masih dipersiapkan, silahkan tunggu '.number_format($remainder_time, 2).' menit lagi.');
				redirect(site_url('student/classroom/detail/'.$classroom_code));
			}
		}

		if ($quiz_timer->status == 0) 
		{
			$this->classroom_model->start_quiz_timer(decode($classroom_ID), $this->session->userdata['ID']);
		}
		elseif ($quiz_timer->status == 2) 
		{
			$this->session->set_flashdata('failed', 'Maaf waktu pengerjaan sudah habis!');
			redirect(site_url('student/classroom'));
		}

		// ambil wakt pengerjaan
		$quiz_time = $this->quiz_model->get_quiz_name_time(decode($classroom_ID)); // 50 menit

		$awal = $quiz_timer->start_time;

		

		$akhir = time();
		if (($akhir <= 10 || $awal <= 0)) {
			date_default_timezone_set('Asia/Kolkata');
			date_default_timezone_get();
			redirect(current_url(), 'refresh');
		}
		else
		{
			$diff  		= $akhir - $awal;
			$menit   	= floor($diff / 60);
			$sisa_detik =  ($diff % 60);
			$detik 		= 60 - $sisa_detik;

			$waktu_kerja 	= $quiz_time * 60;
			$new 			=  $awal + $waktu_kerja;
			$data['coundown_time'] = date('F d,Y H:i:s', $new);


		// parsing sisa wktu
			$data['remaining_time'] = ($quiz_time - $menit - 1);
			$data['detik']			= $detik;

		// check classroom working status, if working is not available (1), then redirect to quiz
			if ($this->classroom_model->working_status(decode($classroom_ID)) != 1) 
			{
				$this->session->set_flashdata('failed', 'Maaf waktu pengerjaan sudah habis!');
				redirect(site_url('student/classroom'));
			}

		// get quiz number by number
			$data['quiz'] 	= $this->quiz_model->get_quiz_for_student($this->session->userdata['ID'], decode($classroom_ID), $number);
			if ($data['quiz']) 
			{
				$data['number_option'] = $this->quiz_model->get_quiz_numbers($this->session->userdata['ID'], decode($classroom_ID));

				if ($quiz_time == $menit) 
				{
					$this->classroom_model->end_quiz_timer(decode($classroom_ID), $this->session->userdata['ID']);
				}


				// $this->output->enable_profiler(TRUE);
				$this->load->view('backend/student/question', $data);
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf pertanyaan tidak ditemukan, sistem mendeteksi aktifitas terlarang oleh akun siswa atas nama <b>'.$this->session->userdata['name'].'</b>!');
				redirect('student/classroom');
			}
		}
		
	}

	public function save_answer()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$classroom_ID 	= decode($this->input->post('classroom_ID'));
			$number 		= decode($this->input->post('number'));
			$classroom_ID = $this->input->post('classroom_ID');
			$submit = $this->input->post('submit');
			$new_number 	= intval($number) + 1;
			$prev_number 	= intval($number) - 1;

			if ($submit == 'next') 
			{
				$quiz 	= $this->quiz_model->get_quiz_for_student($this->session->userdata['ID'], decode($classroom_ID), $new_number);
				if ($quiz) 
				{
					$encode_id = encode($classroom_ID."/".$new_number);
					redirect('student/quiz/question/'.$encode_id);
				}
				else
				{
					$encode_id = encode($classroom_ID."/1");
					redirect('student/quiz/question/'.$encode_id);
				}
			}
			else
			{
				$quiz 	= $this->quiz_model->get_quiz_for_student($this->session->userdata['ID'], decode($classroom_ID), $prev_number);
				if ($quiz) 
				{
					$encode_id = encode($classroom_ID."/".$prev_number);
					redirect('student/quiz/question/'.$encode_id);
				}
				else
				{
					$encode_id = encode($classroom_ID."/1");
					redirect('student/quiz/question/'.$encode_id);
				}
			}
		}
		else
		{
			redirect('student/classroom');	
		}
	}		

	public function quiz_stop($classroom_ID)
	{

		$this->classroom_model->end_quiz_timer($classroom_ID, $this->session->userdata['ID']);
		$code = $this->classroom_model->get_classroom_code_by_id($classroom_ID);
		$this->session->set_flashdata('failed', 'Maaf, waktu pengisian soal sudah habis.');
		redirect('student/classroom/detail/'.$code);
	}

	public function forced_stop($classroom_ID)
	{
		$this->classroom_model->end_quiz_timer($classroom_ID, $this->session->userdata['ID']);
		$code = $this->classroom_model->get_classroom_code_by_id($classroom_ID);
		$this->session->set_flashdata('success', 'Selamat, waktu pengerjaan ujian Anda telah selesai dihentikan.');
		redirect('student/classroom/detail/'.$code);
	}

	public function save_ajax_answer()
	{
		$correct 	= $this->quiz_model->get_correct_answer(decode($this->input->post('ID')));
		if ($correct == $this->input->post('answer')) 
		{
			$is_correct = 1;
		}
		else
		{
			$is_correct = 0;
		}
		$save_answer =  $this->quiz_model->save_answer($is_correct);
	}

	public function set_doubtful()
	{
		if ($this->input->post('ID')) {
			$doubtful = ($this->input->post('doubtful') == 'NULL' ? NULL : $this->input->post('doubtful'));


			if ($this->input->post('doubtful') == 'NULL') {
				$doubtful = NULL;
				$resposne = 0;
			}else{
				$doubtful = $this->input->post('doubtful');
				$resposne = 1;
			}

			$this->quiz_model->set_doubtful($doubtful);
			echo json_encode(['doubtful' => $resposne]);
		}else
		{
			redirect('student/classroom');
		}

	}

	public function next_number()
	{
		if (!$this->input->post()) {
			redirect('student/classroom');
		}
		
		$classroom_ID 	= $this->input->post('classroom');
		$number 		= $this->input->post('number');
		$number 		= intval($number);
		$working_status = $this->classroom_model->working_status(decode($classroom_ID));


		if ($this->input->post('type') == 'next') {
			$new_number 	= $number + 1;
		}elseif ($this->input->post('type') == 'prev'){
			$new_number 	= $number - 1;
		}else{
			$new_number 	= $number;
		}
		
		$quiz 	= $this->quiz_model->get_quiz_for_student($this->session->userdata['ID'], decode($classroom_ID), $new_number);
		if ($quiz) 
		{
			if ($quiz->audio != NULL AND $quiz->audio != '') {
				if (file_exists('./stephan_cbt/audio/'.$quiz->quiz_name_ID.'/'.$quiz->audio)) {
					$audio = "available";
				}else{
					$audio = 'unavailable';
				}

			}else{
				$audio = 'unavailable';
			}
			$data = [
				'ID' 		=> $quiz->ID,
				'classroomId'	=> $quiz->classroom_ID,
				'number' 	=> trim($quiz->number),
				'quiz_type' => $quiz->quiz_type,
				'question' 	=> set_host_server($quiz->question),
				'answer1'	=> set_host_server($quiz->answer_1),
				'answer2'	=> set_host_server($quiz->answer_2),
				'answer3'	=> set_host_server($quiz->answer_3),
				'answer4'	=> set_host_server($quiz->answer_4),
				'answer5'	=> set_host_server($quiz->answer_5),
				'is_doubtful'=> $quiz->is_doubtful,
				'answer'	=> trim(str_replace(' ', '', $quiz->answer)),
				'answer_essay'=> stripslashes($quiz->answer_essay),
				'audio'		=> $audio,
				'audio_core'=> site_url('stephan_cbt/audio/'.$quiz->quiz_name_ID.'/'.$quiz->audio),
				'cek' => "./stephan_cbt/audio/".$quiz->quiz_name_ID."/".$quiz->audio,
				'encodedId'	=> encode($quiz->ID),
				'encodedClassroomId' => encode($quiz->classroom_ID),
				'encodedNumber' => encode($quiz->number),
				'encodedQuizType' => encode($quiz->quiz_type),
				'status'	=> $working_status
			];
			echo json_encode($data);
		}
		else
		{
			$new_quiz 	= $this->quiz_model->get_quiz_for_student($this->session->userdata['ID'], decode($classroom_ID), 1);
			if ($new_quiz->audio != NULL AND $new_quiz->audio != '') {
				if (file_exists('./stephan_cbt/audio/'.$new_quiz->quiz_name_ID.'/'.$new_quiz->audio)) {
					$audio = "available";
				}else{
					$audio = 'unavailable';
				}

			}else{
				$audio = 'unavailable';
			}

			$data = [
				'ID' 		=> $new_quiz->ID,
				'classroomId'	=> $new_quiz->classroom_ID,
				'number' 	=> $new_quiz->number,
				'quiz_type' => $new_quiz->quiz_type,
				'question' 	=> set_host_server($new_quiz->question),
				'answer1'	=> set_host_server($new_quiz->answer_1),
				'answer2'	=> set_host_server($new_quiz->answer_2),
				'answer3'	=> set_host_server($new_quiz->answer_3),
				'answer4'	=> set_host_server($new_quiz->answer_4),
				'answer5'	=> set_host_server($new_quiz->answer_5),
				'is_doubtful'=> $new_quiz->is_doubtful,
				'answer'	=> $new_quiz->answer,
				'answer_essay'=> stripslashes($new_quiz->answer_essay),
				'audio'		=> $audio,
				'audio_core'		=> site_url('stephan_cbt/audio/'.$new_quiz->quiz_name_ID.'/'.$new_quiz->audio),
				'cek' 		=> './stephan_cbt/audio/'.$new_quiz->quiz_name_ID.'/'.$new_quiz->audio,
				'encodedId'	=> encode($new_quiz->ID),
				'encodedClassroomId'=> encode($new_quiz->classroom_ID),
				'encodedNumber' 	=> encode($new_quiz->number),
				'encodedQuizType' 	=> encode($new_quiz->quiz_type),
				'status'	=> $working_status
			];
			echo json_encode($data);

		}
	}

	public function save_essai()
	{
		if ($this->input->post('ID', TRUE) and $this->input->post('answer', TRUE)) 
		{
			$save_essai = $this->quiz_model->save_essay_answer();
			echo json_encode($save_essai);
		}else{
			echo json_encode('Gagal');
		}
	}


	public function vvv($value='')
	{
		echo base64_decode($value);
	}

}