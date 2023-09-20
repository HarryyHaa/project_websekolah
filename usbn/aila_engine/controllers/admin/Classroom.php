<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {

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
		$data['classroom'] 	= $this->classroom_model->get_classroom($status = 1);
		$this->template->view('classroom', $data);
	}

	public function create()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->classroom_model->classroom_rules());

			if ($validation->run() == TRUE) 
			{
				// Create new quiz name
				$quiz_name_ID = $this->input->post('quiz_name_ID', TRUE);
				$teacher_ID = $this->quiz_model->get_quiz_name_by_id($quiz_name_ID)->teacher_ID;
				$this->classroom_model->create($teacher_ID);
				$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil ditambah!');
				
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, kelas ujian gagal ditambah!');
			}
			redirect('admin/classroom');
		}
		else
		{
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name( $status = 1);
			$data['student_groups'] = $this->group_model->get_groups()->result();
			$this->template->view('classroom_create', $data);
		}
	}

	public function update($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->classroom_model->classroom_rules());

			if ($validation->run() == TRUE) 
			{
				$this->classroom_model->update();
				$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil dirubah!');
				
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, kelas ujian gagal dirubah!');
			}
			redirect('admin/classroom/check_code/'.$code);
		}
		else
		{
			$classroom = $this->classroom_model->get_classroom_by_code($code);
			if ($classroom)
			{
				$data['classroom'] 	= $classroom;
				$data['quiz_name'] 	= $this->quiz_model->get_quiz_name( $status = 1);
				$data['student_groups'] = $this->group_model->get_groups()->result();
				$this->template->view('classroom_update', $data);
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
				redirect('admin/classroom');
			}
		}
	}

	public function check_code($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$data['classroom'] 	= $classroom;
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$data['mutiple_choice_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
			$data['essay_total'] = $this->quiz_model->count_quiz_by_classroom_id($classroom->ID, 2);
			// $data['nilai_siswa']= $this->quiz_model->get_student_by_classroom_code($code)->result();
			$data['student_score']= $this->quiz_model->get_student_multiple_choice($code)->result();
			$this->template->view('check_code', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function classroom_qrcode($code = NULL)
	{
		$this->load->library('ciqrcode');
		header("Content-Type: image/png");
		$params['size']			= 200;
		$params['data'] = base_url('student/qrcode/join/'.$code.'/'.md5(sha1($code)));
		$this->ciqrcode->generate($params);
	}

	public function download_excel_old($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$data['classroom'] 	= $classroom;
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$data['quiz_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
			$data['nilai_siswa']= $this->quiz_model->get_student_by_classroom_code($code)->result();
			$this->load->view('backend/teacher/download_excel', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function download_excel($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$quiz_name	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$quiz_total = $this->quiz_model->count_mutiple_choice_by_cc($code);
			$nilai_siswa = $this->quiz_model->get_student_by_classroom_code($code)->result();

			$this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle($classroom->name)
			->setDescription($classroom->description);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$classroom->name.'.xlsx"');
			header('Cache-Control: max-age=0');
			
			$objPHPExcel->setActiveSheetIndex(0);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Nama Kelas : ");
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, $classroom->name);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, "Nama Paket Soal : ");
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, $classroom->title);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, "Deskripsi kelas : ");
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 3, $classroom->description);

			$table_columns = array("No.", "NIS", "Nama Lengkap", "Perolehan PG", "Nilai PG", "Nilai Essai", "Nilai Total");
			$column = 0;
			foreach($table_columns as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
				$column++;
			}

			$excel_row = 5;
			$no = 1;
			foreach($nilai_siswa as $row)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, strip_tags($row->code));
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->name);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, count_correct_multiple_choice($row->ID, $classroom->ID).' / '. $quiz_total);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, count_score_multiple_choice($row->ID, $classroom->ID, $quiz_total));
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, count_score_essay($row->ID, $classroom->ID, $classroom->quiz_name_ID));
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, count_score_total($row->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage));
				
				$excel_row++;
				$no++;
			}
			//PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			//define( 'PCLZIP_TEMPORARY_DIR', APPPATH.'/logs/' );

			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function export_excel($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$quiz_name	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$quiz_total = $this->quiz_model->count_mutiple_choice_by_cc($code);
			$nilai_siswa = $this->quiz_model->get_student_multiple_choice($code)->result();

			$writer = WriterFactory::create(Type::XLSX);
			$writer->openToBrowser($classroom->name.".xlsx");

			$classroom_name = [
				'Nama Kelas',
				':',
				$classroom->name
			];
			$writer->addRow($classroom_name); 

			$classroom_title = [
				'Nama Paket Soal',
				':',
				$classroom->title
			];
			$writer->addRow($classroom_title);

			$classroom_desc = [
				'Nama Paket Soal',
				':',
				$classroom->description
			];
			$writer->addRow($classroom_desc); 

			$header = [
				'No.',
				'NIS',
				'Nama Lengkap',
				'Perolehan PG',
				'Nilai PG',
				'Nilai Essai',
				'Nilai Total'
			];
			$headerStyle = (new Style())
			->setBackgroundColor('00B0E0')->setFontColor('FFFFFF')->setFontBold();
			$writer->addRowWithStyle($header, $headerStyle);

			$writer->getCurrentSheet()->setName('Hasil Ujian');

			$no = 1;
			$rows = array();
			foreach($nilai_siswa as $row) {
				$rows[] = [
					$no, 
					$row->code,
					$row->name,
					$row->jumlah_benar.' / '. $row->jumlah_soal,
					number_format((($row->jumlah_benar / $row->jumlah_soal) * 100), 2),
					count_score_essay($row->ID, $classroom->ID, $classroom->quiz_name_ID),
					count_score_total($row->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage)
				];
			};

			$writer->addRows($rows);
			$writer->close();
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function print_classroom($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{

			$data['classroom'] 	= $classroom;
			$data['quiz_name'] 	= $this->quiz_model->get_quiz_name_by_id($classroom->quiz_name_ID);
			$data['quiz_total'] = $this->quiz_model->count_mutiple_choice_by_cc($code);
			$data['essay_total'] = $this->quiz_model->count_essay_by_cc($code);
			$data['nilai_siswa']= $this->quiz_model->get_student_by_classroom_code($code)->result();

			$this->load->view('backend/teacher/print_classroom', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}	

	public function start($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{
			$this->classroom_model->start($code);
			$this->session->set_flashdata('success', 'Selamat, waktu pengerjaan ujian berhasil dimulai!');
			redirect('admin/classroom/check_code/'.$code);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, waktu pengerjaan ujian gagal dimulai!');
		}
		redirect('admin/classroom');
	}

	public function stop($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{
			$this->classroom_model->stop($code);
			$this->session->set_flashdata('success', 'Selamat, waktu pengerjaan ujian berhasil dihentikan!');
			redirect('admin/classroom/check_code/'.$code);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, waktu pengerjaan ujian gagal dihentikan!');
		}
		redirect('admin/classroom');
	}

	public function reset($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$satu = decode($code);
		$array = explode('/', $satu);

		if ($array[0] AND $array[1]  AND $array[2]) {
			$student_ID = decode($array[0]);
			$classroom_ID = decode($array[1]);
			$classroom_code = decode($array[2]);

			$this->classroom_model->reset_student($student_ID, $classroom_ID);
			$this->session->set_flashdata('success', 'Pesrta berhasil dikeluarkan dari kelas');
			redirect('admin/classroom/check_code/'.$classroom_code);
		}else{
			redirect('admin/classroom');
		}

	}

	public function make_an_archive($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{

			$this->classroom_model->make_an_archive($code);
			$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil dirubah!');

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas ujian tidak ditemukan!');
		}
		redirect('admin/classroom');
	}

	public function archive()
	{
		$data['classroom'] 	= $this->classroom_model->get_classroom($status = 2);
		$this->template->view('classroom_archive', $data);
	}

	public function delete($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{

			$this->classroom_model->delete($code);
			$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil dihapus!');

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas ujian tidak ditemukan!');
		}
		redirect('admin/classroom/archive');
	}


	public function analisa_pilihan_ganda($code = NULL)
	{
		if (!$code) redirect('admin/classroom');

		$classroom = $this->classroom_model->get_classroom_by_code($code);
		if ($classroom)
		{
			$quiz_name_ID 	= $classroom->quiz_name_ID;
			$class_name 	= $classroom->name;
			$student_list 	= $this->quiz_model->get_student_by_classroom_code($code);
			$quiz 			= $student_list->result();
			$jumlah_siswa 	= $student_list->num_rows();
			$jumlah_siswa 	= $jumlah_siswa+3;
			$data['answer_key']	= $this->quiz_model->get_answer_key($code); 

			foreach ($quiz as $row) 
			{
				$analisa = $this->quiz_model->get_analisa_pilihan_ganda($row->ID, $classroom->ID);
				$classroom_ID				= $classroom->ID;
				$jumlah_soal 				= $analisa->num_rows();
				$student_code[$row->ID]		= $row->code;
				$student_name[$row->ID]		= $row->name;
				$analisa_soal[$row->ID] 	= $analisa->result();

			}

			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
        // set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
			$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
			$jumlah = ($jumlah_soal+8);
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$jumlah_siswa,'JUMLAH BENAR');
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$jumlah_siswa.':F'.$jumlah_siswa);

			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NIS');
			$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nama');
			$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Jumlah Benar');
			$objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Nilai PG');
			$objPHPExcel->getActiveSheet()->mergeCells('E1:E2');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'No. Soal');
			$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Kunci Jawaban');

			$limit = $jumlah_soal;

			$start = 1;
			$G = 'G';
			foreach ($data['answer_key'] as $row) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($G.'1', $start);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($G.'2', $row->answer_key);
				$start++;
				$G++;
			}

			$no = 3;
			foreach ($analisa_soal as $key => $value){
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$no, $no-2);
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$no, $student_code[$key]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$no, $student_name[$key]);

				$cell_g = 'G';
				$benar 	= 0;
				$no2 	= $no+1;
				foreach ($value as $row) {

					if ($row->is_correct == 1) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_g.$no, $row->answer);
						$benar += 1;
					} else{

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_g.$no, $row->answer);
						$objPHPExcel->getActiveSheet()->getStyle($cell_g.$no, $row->answer)->applyFromArray(
							array(
								'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'FF0000')
								)
							)
						);
					}

					$cell_g++;
				}

				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$no, $benar);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$no, count_score_multiple_choice($key, $classroom_ID, $jumlah_soal));

				$benar = 0;
				$no++;
			}

			$cell_new = 'G';
			for ($i2=0; $i2 < $jumlah_soal ; $i2++) {
				$jumlah_benar = 0;
				foreach ($analisa_soal as $key1 => $value1) {
					$jumlah_benar += $value1[$i2]->is_correct ;
				}
				$objPHPExcel->getActiveSheet()->SetCellValue($cell_new.$no2, $jumlah_benar);$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_new.$no, $jumlah_benar);

				$objPHPExcel->getActiveSheet()->getColumnDimension($cell_new)->setWidth(3);
				$cell_new++;
			}


			$objPHPExcel->getActiveSheet()->setTitle('Analisis Soal');

			$objPHPExcel->setActiveSheetIndex(0);  
			$filename = $class_name.".xlsx";

			header('Content-Type: application/vnd.ms-excel'); 
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');

			//$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');  
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');              
			$objWriter->save('php://output');

			//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			//header('Content-Disposition: attachment;filename="'.$filename.'"');

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	
	public function regenerate_code($code)
	{
		if (!$code) redirect('admin/classroom');

		$id = decode($code);
		$classroom = $this->classroom_model->get_classroom_by_id($id);
		if ($classroom)
		{
			$this->classroom_model->create_class_code($id);
			$new_code = $this->classroom_model->get_classroom_by_id($id)->code;
			$this->session->set_flashdata('success', 'Selamat, kode kelas berhasil dirubah');
			redirect('admin/classroom/check_code/'.$new_code);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kode kelas tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function re_active($code)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{

			$this->classroom_model->re_active($code);
			$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil diaktifkan kembali!');

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas ujian tidak ditemukan!');
		}
		redirect('admin/classroom/archive');
	}

	public function lock($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{

			$this->classroom_model->lock($code);
			$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil dikunci!');
			redirect('admin/classroom/check_code/'.$code);

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas ujian tidak ditemukan!');
			redirect('admin/classroom');
		}
	}

	public function unlock($code = NULL)
	{
		if (!$code)redirect('admin/quiz');

		$classroom 	= $this->classroom_model->get_classroom_by_code($code);

		if ($classroom) 
		{

			$this->classroom_model->unlock($code);
			$this->session->set_flashdata('success', 'Selamat, kelas ujian berhasil dikunci!');
			redirect('admin/classroom/check_code/'.$code);

		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, kelas ujian tidak ditemukan!');
			redirect('admin/classroom');
		}
	}
}
