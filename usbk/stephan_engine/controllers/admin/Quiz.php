<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

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
		$data['teacher']= $this->teacher_model->get_teacher($status = 1);
		$this->template->view('quiz_name', $data);
	}

	public function get_quiz_name_json($status=1)
	{
		$quiz_name =  $this->quiz_model->get_quiz_name_with_datatables($status);
		$data = array();
		$no = $this->input->post('start', TRUE);
		foreach ($quiz_name as $quiz) 
		{

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $quiz->name;
			$row[] = $quiz->title;
			$row[] = $this->quiz_model->count_mutiple_choice($quiz->ID);
			$row[] = $this->quiz_model->count_mutiple_essay($quiz->ID);
			$row[] = $quiz->time.' menit';

			$row[] = "<a href=\"".site_url('admin/quiz/questions_list/'.encode($quiz->ID))."\" class=\"btn-small blue\">Selengkapnya</a>";
			
			$row[] = "<a  href=\"".site_url('admin/quiz/update_quiz_name/').encode($quiz->ID)."\" class=\"btn-small green modal-trigger\">Ubah</a>
			<a onclick=\"return confirm('Apakah mau mengarsipkan quiz ini beserta seluruh pertanyaannya?');\" href=\"".site_url('admin/quiz/make_an_archive/'.encode($quiz->ID))."\" class=\"btn-small orange\">Arsipkan</a>
			<a target=\"_blank\" class=\"btn-small blue\" href=\"".site_url('admin/quiz/export_question/'.encode($quiz->ID));"\">Eksport Soal</a>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw', TRUE),
			"recordsTotal" => $this->quiz_model->count_all($status),
			"recordsFiltered" => $this->quiz_model->count_filtered($status),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function get_quiz_name_archive_json($status=2)
	{
		$quiz_name =  $this->quiz_model->get_quiz_name_with_datatables($status);
		$data = array();
		$no = $this->input->post('start', TRUE);
		foreach ($quiz_name as $quiz) 
		{

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $quiz->name;
			$row[] = $quiz->title;
			$row[] = $this->quiz_model->count_mutiple_choice($quiz->ID);
			$row[] = $this->quiz_model->count_mutiple_essay($quiz->ID);
			$row[] = $quiz->time.' menit';

			$row[] = "<a href=\"".site_url('admin/quiz/questions_list/'.encode($quiz->ID))."\" class=\"btn-small blue\">Selengkapnya</a>";
			
			$row[] = "<a onclick=\"return confirm('Apakah mau mengaktifkan paket soal ini beserta seluruh pertanyaannya?');\" href=\"".site_url('admin/quiz/make_active/'.encode($quiz->ID))."\" class=\"btn-small green\">Aktifkan</a>
			<a target=\"_blank\" class=\"btn-small blue\" href=\"".site_url('admin/quiz/export_question/'.encode($quiz->ID))."\">Eksport Soal</a>
			<a onclick=\"return confirm('Apakah Anda yakin akan menghapus permanen paket soal ini beserta seluruh data yang terkait?');\" href=\"".site_url('admin/quiz/confirm_delete_quiz_name/'.encode($quiz->ID))."\" class=\"btn-small red\">Hapus Permanen</a>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw', TRUE),
			"recordsTotal" => $this->quiz_model->count_all($status),
			"recordsFiltered" => $this->quiz_model->count_filtered($status),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function questions_list($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		$quiz_model = $this->quiz_model;

		if ($quiz_model->get_quiz_name_by_id(decode($id))) 
		{
			$data['ID']		= $this->uri->segment(4);
			$data['quiz'] 	= $this->quiz_model->get_quiz_by_quiz_name_id(decode($id));
			$data['quiz_name'] = $this->quiz_model->get_quiz_name_by_id(decode($id));
			$this->template->view('questions_list', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, berkas ujian tidak ditemukan');
			redirect('admin/quiz');
		}
	}

	public function export_question_old($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		$quiz_model = $this->quiz_model;

		if ($quiz_model->get_quiz_name_by_id(decode($id))) 
		{
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id(decode($id));
			$data['quiz'] 	= $this->quiz_model->get_question_by_quiz_name_id(decode($id));
			$this->load->view('backend/admin/export_question', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, berkas ujian tidak ditemukan');
			redirect('admin/quiz');
		}
	}

	public function export_question($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		$quiz_name = $this->quiz_model->get_quiz_name_by_id(decode($id));

		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle($quiz_name->title)
		->setDescription($quiz_name->description);

		// Assign cell values
		$objPHPExcel->setActiveSheetIndex(0);
		$table_columns = array("Pertanyaan", "Jenis (1=PD, 2=Essai)", "Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D", "Jawaban E", "Kunci Jawaban", "Bobot Essai");

		$column = 0;

		foreach($table_columns as $field)
		{
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$quiz	= $this->quiz_model->get_question_by_quiz_name_id(decode($id));

		$excel_row = 2;
		foreach($quiz as $row)
		{
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, strip_tags($row->question));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->quiz_type);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, strip_tags($row->answer_1));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, strip_tags($row->answer_2));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, strip_tags($row->answer_3));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, strip_tags($row->answer_4));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, strip_tags($row->answer_5));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->answer_key);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->weight);
			$excel_row++;
		}
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$quiz_name->title.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');  
		$objWriter->save('php://output');
	}

	public function question_management_guide_hide($id = NULL)
	{
		if (!$id) redirect('admin/quiz');
		$this->session->set_userdata('question_management_guide', FALSE);
		redirect('admin/quiz/questions_list/'.$id);
	}

	public function question_management_guide_show($id = NULL)
	{
		if (!$id) redirect('admin/quiz');
		$this->session->set_userdata('question_management_guide', TRUE);
		redirect('admin/quiz/questions_list/'.$id);
	}

	public function create_quiz_name()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->quiz_model->quiz_name_rules());

			if ($validation->run() == TRUE) 
			{
					// Create new quiz name
				$this->quiz_model->create_quiz_name($this->input->post('teacher', TRUE));
				$this->session->set_flashdata('success', 'Selamat, quiz berhasil ditambah!');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf,quiz gagal ditambah!');
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, quiz gagal ditambah!');
		}
		redirect('admin/quiz');
	}

	public function update_quiz_name($ID = NULL)
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->quiz_model->quiz_name_rules());

			if ($validation->run() == TRUE) 
			{
					// Create new quiz name
				$this->quiz_model->update_quiz_name();
				$this->session->set_flashdata('success', 'Selamat, quiz berhasil dirubah!');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf,quiz gagal dirubah!');
			}
			redirect('admin/quiz');
		}
		else
		{
			if (!$ID) redirect('admin/quiz');
			$new_id 	= decode($ID);
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($new_id);
			if ($data['quiz_name']) 
			{
				$data['teacher']= $this->teacher_model->get_teacher($status = 1);
				$this->template->view('quiz_name_update', $data);
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, quiz tidak ditemukan!');
				redirect('admin/quiz');
			}
		}
	}

	public function make_an_archive($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		$quiz_model = $this->quiz_model;
		
		if ($quiz_model->get_quiz_name_by_id(decode($id))) 
		{
			$quiz_model->make_an_archive(decode($id));
			$this->session->set_flashdata('success', 'Soal berhasil dijadikan arsip');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Soal tidak ditemukan');
		}
		redirect('admin/quiz');
	}

	public function make_active($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		$quiz_model = $this->quiz_model;
		
		if ($quiz_model->get_quiz_name_by_id(decode($id))) 
		{
			$quiz_model->make_active(decode($id));
			$this->session->set_flashdata('success', 'Soal berhasil diaktifkan kembali');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Soal tidak ditemukan');
		}
		redirect('admin/quiz/quiz_name_archive');
	}

	public function create_quiz($id = NULL)
	{
		if (!$id) redirect('admin/quiz');

		if ($this->quiz_model->get_quiz_name_by_id(decode($id))) 
		{
			if ($this->input->post()) 
			{
				$validation = $this->form_validation;
				$validation->set_rules($this->quiz_model->quiz_rules());

				if ($validation->run() === FALSE) 
				{
					
					$data['ID'] 	= $this->uri->segment(4);
					$this->template->view('create_quiz', $data);
				}
				else
				{
					$audio = $_FILES['audio_file']['name'];

					if(!empty($audio)){


						$folder_audio = './stephan_cbt/audio/'.decode($id);

						if(!is_dir($folder_audio)){
							mkdir($folder_audio, 0777);
						}


						$config['upload_path'] 	= $folder_audio;
						$config['allowed_types']= 'mp3';
						$config['max_size']		= '0';
						$config['overwrite'] 	= true;
						$config['file_name'] 	= 'audio_'.time();

						$this->upload->initialize($config);
						if (!$this->upload->do_upload('audio_file')){
							$this->session->set_flashdata('failed', $this->upload->display_errors());
							redirect('admin/quiz/questions_list/'.$id);
						}else{
							$upload_data 	= $this->upload->data();
							$audio_name 	= $upload_data['file_name'];

							$this->quiz_model->create_quiz(decode($id), $audio_name);
							$this->session->set_flashdata('success', 'Selamat, quiz berhasil ditambah!');
							redirect('admin/quiz/questions_list/'.$id);
						}
					}
					else
					{
						$this->quiz_model->create_quiz(decode($id));
						$this->session->set_flashdata('success', 'Selamat, quiz berhasil ditambah!');
						redirect('admin/quiz/questions_list/'.$id);
					}
				}
			}
			else
			{
				$data['ID'] 	= $this->uri->segment(4);
				$this->template->view('create_quiz', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Judul soal tidak ditemukan');
			redirect('admin/quiz');
		}
	}


	function tinymce_upload() {
		$this->load->library('upload');
		$this->load->library('image_lib');
        // $nmfile 					= "post_".time(); 
		$config['file_name'] 	= 'quiz_'.time();
        //path folder
		$config['upload_path'] 		= './stephan_cbt/images/trash'; 
        //type yang dapat diakses bisa Anda sesuaikan
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp'; 
        //maksimum besar file 1 MB
		$config['max_size'] 		= '5000'; 
        //lebar maksimum 1000 px
		$config['max_width']  		= '5000'; 
        //tinggi maksimu 1000 px
		$config['max_height']  		= '5000'; 
        //nama yang terupload nantinya
		// $config['file_name'] 		= $nmfile; 
        //inisialis konfigurasi

		$this->upload->initialize($config);


		if ( ! $this->upload->do_upload('file')) {
			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;
		} else {
			$gbr = $this->upload->data();
			$config1['image_library'] 	= 'gd2'; 
        		// folder tempat menyimpan gambar asal
			$config1['source_image'] 	= $this->upload->upload_path.$this->upload->file_name;
        		// folder tempat menyimpan hasil resize
			$config1['new_image'] 		= './stephan_cbt/images/quiz/'; 
                //
			$config1['maintain_ratio'] 	= TRUE;
                //lebar setelah resize menjadi 700 px
			$config1['width'] 			= 1000; 
                //lebar setelah resize menjadi 500 px
			$config1['height'] 			= 800; 
                //
			$this->image_lib->initialize($config1); 
                //lakukan resize gambar
			$this->image_lib->resize();

			$resize = $this->image_lib->clear();

			       //hapus gambar setelah selesai di resize
			unlink($this->upload->upload_path.$this->upload->file_name);

			$file = $this->upload->data();
			$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(['location' => base_url('stephan_cbt/images/quiz/'.$file['file_name'])]))
			->_display();
			exit;
		}
	}

	public function import($ID)
	{
		$quiz_name_ID = decode($ID);

		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

		$fileName = time().$_FILES['file']['name'];

		$config['upload_path'] = '././stephan_cbt/xls_file/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('file') )
			$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = $this->upload->data('full_path');

		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
	$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
		NULL,
		TRUE,
		FALSE);
//Sesuaikan sama nama kolom tabel di database              
	$data = array(
		"question"		=> (($rowData[0][0]) == NULL ? '-' : $rowData[0][0]),
		"quiz_type"		=> (($rowData[0][1]) == NULL ? '1' : $rowData[0][1]),
		"answer_1"		=> $rowData[0][2],
		"answer_2"		=> $rowData[0][3],
		"answer_3"		=> $rowData[0][4],
		"answer_4"		=> $rowData[0][5],
		"answer_5"		=> $rowData[0][6],
		"answer_key"	=> $rowData[0][7],
		"weight"		=> $rowData[0][8],
		"quiz_name_ID"	=>$quiz_name_ID 

	);

// Cek apakah Quiz sudah ada atau belum, kalau ada maka lakukan proses update kalau belum ada maka lakukan proses insert
	// $where      = array(
	// 	'question' => $rowData[0][0], 
	// );

	// $cek_quiz = $this->quiz_model->get_question($rowData[0][0]);
	// if ($cek_quiz >=1 ) {
	// 	$this->quiz_model->update_data($where,$data);
	// }
	// else
	// {
	//sesuaikan nama dengan nama tabel
	$insert = $this->quiz_model->create_data($data);
	// }
}

// Delete all file trash
delete_files('././stephan_cbt/xls_file/');

$this->session->set_flashdata('success','<b>'. ($highestRow - 1).' Data berhasil ditambahkan / dirubah.</b> <br/>');
redirect('admin/quiz/questions_list/'.$ID);
}

public function detail_quiz($id = NULL)
{
	if (!$id) redirect('admin/quiz');

	if ($this->quiz_model->get_quiz_by_id(decode($id))) 
	{
		$quiz = $this->quiz_model->get_quiz_by_id(decode($id));

		$data['ID'] 	= $quiz->quiz_name_ID;
		$data['quiz'] 	= $quiz;
		$this->template->view('detail_quiz', $data);
	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, soal tidak ditemukan');
		redirect('admin/quiz');
	}
}

public function update_quiz($id = NULL)
{
	if (!$id) redirect('admin/quiz');

	if ($this->quiz_model->get_quiz_by_id(decode($id))) 
	{
		$quiz = $this->quiz_model->get_quiz_by_id(decode($id));
		$quiz_name_ID = $quiz->quiz_name_ID;

		if ($this->input->post()) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->quiz_model->quiz_rules());

			if ($validation->run() === FALSE) 
			{

				$data['ID'] 	= $this->uri->segment(4);
				$data['quiz'] 	= $quiz;
				$this->template->view('update_quiz', $data);
			}
			else
			{
				
				$audio = $_FILES['audio_file']['name'];

				if(!empty($audio)){


					$folder_audio = './stephan_cbt/audio/'.$quiz_name_ID;

					if(!is_dir($folder_audio)){
						mkdir($folder_audio, 0777);
					}


					$config['upload_path'] 	= $folder_audio;
					$config['allowed_types']= 'mp3';
					$config['max_size']		= '0';
					$config['overwrite'] 	= true;
					$config['file_name'] 	= 'audio_'.time();

					$this->upload->initialize($config);
					if (!$this->upload->do_upload('audio_file')){
						$this->session->set_flashdata('failed', $this->upload->display_errors());
						redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
					}else{

						// hapus file audio lama
						unlink('./stephan_cbt/audio/'.$quiz_name_ID.'/'.$quiz->audio);

						$upload_data 	= $this->upload->data();
						$audio_name 	= $upload_data['file_name'];

						$this->quiz_model->update_quiz($audio_name);
						$this->session->set_flashdata('success', 'Selamat, quiz berhasil dirubah!');
						redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
					}
				}
				else
				{
					$this->quiz_model->update_quiz();
					$this->session->set_flashdata('success', 'Selamat, soal berhasil dirubah!');
					redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
				}
			}
		}
		else
		{
			$data['ID'] 	= $this->uri->segment(4);
			$data['quiz'] 	= $quiz;
			$this->template->view('update_quiz', $data);
		}
	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, soal tidak ditemukan');
		redirect('admin/quiz');
	}
}

public function disable_quiz($id = NULL)
{
	if (!$id) redirect('admin/quiz');

	if ($this->quiz_model->get_quiz_by_id(decode($id))) 
	{
		$quiz = $this->quiz_model->get_quiz_by_id(decode($id));
		$quiz_name_ID = $quiz->quiz_name_ID;

		$this->quiz_model->disable_quiz(decode($id));

		$this->session->set_flashdata('success', 'Selamat, soal berhasil dinonaktifkan!');
		redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, soal tidak ditemukan');
		redirect('admin/quiz');
	}
}

public function enable_quiz($id = NULL)
{
	if (!$id) redirect('admin/quiz');

	if ($this->quiz_model->get_quiz_by_id(decode($id))) 
	{
		$quiz = $this->quiz_model->get_quiz_by_id(decode($id));
		$quiz_name_ID = $quiz->quiz_name_ID;

		$this->quiz_model->enable_quiz(decode($id));

		$this->session->set_flashdata('success', 'Selamat, soal berhasil diaktifkan!');
		redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, soal tidak ditemukan');
		redirect('admin/quiz');
	}
}

public function delete_audio($name, $id)
{
	$quiz = $this->quiz_model->get_quiz_by_id(decode($id));
	if ($quiz) 
	{
		unlink('./stephan_cbt/audio/'.$quiz->quiz_name_ID.'/'.$quiz->audio);
		$this->db->where('ID', $quiz->ID);
		$this->db->set('audio', NULL);
		$this->db->update('quiz');
		redirect('admin/quiz/update_quiz/'.$id);
	}else{
		redirect('admin/quiz');
	}

}

public function delete_quiz($id = NULL)
{
	if (!$id) redirect('admin/quiz');

	if ($this->quiz_model->get_quiz_by_id(decode($id))) 
	{
		$quiz = $this->quiz_model->get_quiz_by_id(decode($id));
		$quiz_name_ID = $quiz->quiz_name_ID;

		$this->quiz_model->delete_quiz($quiz->ID);

		$this->session->set_flashdata('success', 'Selamat, soal berhasil dihapus!');
		redirect('admin/quiz/questions_list/'.encode($quiz_name_ID));
	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, soal tidak ditemukan');
		redirect('admin/quiz');
	}
}

public function set_secore_essay()
{
	if ($this->input->post('answer_score', TRUE)) 
	{
		$this->quiz_model->set_secore_essay();
		redirect($this->input->post('current_url', TRUE));
	}
	else
	{
		redirect('admin/quiz');
	}
}

public function review($encoded = NULL)
{
	if (!$encoded) redirect('admin/classroom');

	$decode 	= decode($encoded);
	$array_data = explode('/', $decode);

	$classroom_ID 	= $array_data[0];
	$student_ID 	= $array_data[1];

	if (empty($classroom_ID) or empty($student_ID)) redirect('admin/classroom');
	$data['encoded'] 	= $encoded;
	$data['student'] 	= $this->student_model->get_student_by_id($student_ID);
	$data['classroom']	= $this->classroom_model->get_classroom_by_id($classroom_ID);
	$data['multiple_choice'] 		= $this->quiz_model->get_multiple_choice_review($classroom_ID, $student_ID)->result();
	$data['essay'] 		= $this->quiz_model->get_essay_review($classroom_ID, $student_ID)->result();
	$data['total_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID);
	$data['total_mc_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID, 1);
	$data['total_essay_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID, 2);
	$data['correct_answer'] = $this->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
	$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($data['classroom']->quiz_name_ID);

	$this->template->view('review', $data);
}

public function review_print($encoded = NULL)
{
	if (!$encoded) redirect('admin/classroom');

	$decode 	= decode($encoded);
	$array_data = explode('/', $decode);

	$classroom_ID 	= $array_data[0];
	$student_ID 	= $array_data[1];

	if (empty($classroom_ID) or empty($student_ID)) redirect('admin/classroom');
	$data['encoded'] 	= $encoded;
	$data['student'] 	= $this->student_model->get_student_by_id($student_ID);
	$data['classroom']	= $this->classroom_model->get_classroom_by_id($classroom_ID);
	$data['multiple_choice'] 		= $this->quiz_model->get_multiple_choice_review($classroom_ID, $student_ID)->result();
	$data['essay'] 		= $this->quiz_model->get_essay_review($classroom_ID, $student_ID)->result();
	$data['total_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID);
	$data['total_mc_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID, 1);
	$data['total_essay_quiz'] = $this->quiz_model->count_quiz_by_classroom_id($classroom_ID, 2);
	$data['correct_answer'] = $this->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
	$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($data['classroom']->quiz_name_ID);
	
	$this->load->view('backend/admin/review_print', $data);
}

public function set_essay_score($encoded='')
{
	if (!$encoded) redirect('admin/classroom');

	$decode 	= decode($encoded);
	$array_data = explode('/', $decode);

	$classroom_ID 	= $array_data[0];
	$student_ID 	= $array_data[1];

	if (empty($classroom_ID) or empty($student_ID)) redirect('admin/classroom');

	if ($this->input->post()) 
	{
		$id = $this->input->post('ID', TRUE);
		$answer_score = $this->input->post('answer_score', TRUE);
		$data = [];
		foreach ($answer_score as $key => $value) {
			$data[] = array(
				'ID' => $id[$key],
				'answer_score' => $answer_score[$key]
			);
		}

		$this->db->update_batch('quiz_answer',$data, 'ID');
		$data['encoded'] = $encoded;
		$data['essay'] = $this->quiz_model->get_essay_answer($classroom_ID, $student_ID)->result();

		$this->template->view('set_essay_score', $data);
	}
	else
	{
		$data['encoded'] = $encoded;
		$data['essay'] = $this->quiz_model->get_essay_answer($classroom_ID, $student_ID)->result();

		$this->template->view('set_essay_score', $data);
	}

}

public function set_all_essay_score($code='', $offset = '')
{
	if (!$code) redirect('admin/classroom');

	$classroom = $this->classroom_model->get_classroom_by_code($code);
	if ($classroom)
	{
		if ($this->input->post()) 
		{
			$id = $this->input->post('ID', TRUE);
			$answer_score = $this->input->post('answer_score', TRUE);
			$data = [];
			foreach ($answer_score as $key => $value) {
				$data[] = array(
					'ID' => $id[$key],
					'answer_score' => $answer_score[$key]
				);
			}

			$this->db->update_batch('quiz_answer',$data, 'ID');
			redirect($this->input->post('current_url', TRUE));

		}

		$data['classroom'] 	= $classroom;

		// count total student
		$student_total = $this->quiz_model->get_essay_answer_student($classroom->ID);

		if (!$student_total) {
			$this->session->set_flashdata('failed', 'Maaf, tidak ditemukan jawaban essai pada kelas ini');
			redirect('admin/classroom/check_code/'.$code);
		}

		// get student id
		$student_ID = $this->quiz_model->get_essay_by_paggination('1', $offset,$classroom->ID)->row()->ID;

		// get essay answer
		$data['essay'] = $this->quiz_model->get_essay_answer($classroom->ID, $student_ID)->result();

		// parsing student data
		$data['student'] 	= $this->student_model->get_student_by_id($student_ID);

		// config pagination
		$url 		= 'admin/quiz/set_all_essay_score/'.$code;
		$total_rows = $student_total;
		$per_page 	= 1;

		// set and parsing pagination
		$data['page'] =  pagination($url, $total_rows, $per_page);

		$this->template->view('set_all_essay_score', $data);

	}
	else
	{
		$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
		redirect('admin/classroom');
	}

}


public function quiz_name_archive()
{
	$data['teacher']= $this->teacher_model->get_teacher($status = 1);
	$data['quiz'] 	= $this->quiz_model->get_quiz_name($status = 2);
	$this->template->view('quiz_name_archive', $data);
}

public function confirm_delete_quiz_name($code = NULL)
{
	if(!$code) redirect('admin/quiz/quiz_name_archive');

	$quiz_name = $this->quiz_model->get_quiz_name_by_id(decode($code));
	if ($quiz_name) {
		$classroom 			= $this->classroom_model->get_classroom_by_quiz_name($quiz_name->ID);
		if ($classroom->num_rows() > 0) {
			$data['classroom'] 	= $classroom;
			$data['quiz_name']	= $quiz_name;
			$this->template->view('confirm_delete_quiz_name', $data);
		}else{
			$this->quiz_model->delete_quiz_name($quiz_name->ID);
			$this->session->set_flashdata('success', 'Selamat, paket soal berhasil dihapus');
			redirect('admin/quiz/quiz_name_archive');
		}
	}else{
		$this->session->set_flashdata('failed', 'Maaf, paket soal tidak ditemukan!');
		redirect('admin/quiz/quiz_name_archive');
	}
}

}
