<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

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
		$data['teacher'] = $this->teacher_model->get_teacher_active();
		$this->template->view('teacher_index', $data);
	}

	public function create()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->teacher_model->create_rules());

			if ($validation->run()) {

				// If teacher code has been registered
				if ($this->teacher_model->get_teacher_code($this->input->post('code', TRUE)) >=1 ) 
				{
					$this->session->set_flashdata('failed', 'Maaf, guru dengan NIP tersebut sudah terdaftar!');
				}
				else
				{
					// Create new teacher
					$this->teacher_model->create();
					$this->session->set_flashdata('success', 'Selamat, guru berhasil ditambah!');
				}
				
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, guru gagal ditambah!');
		}
		redirect('admin/teacher');
	}


	public function import()
	{
		
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

		$fileName = time().$_FILES['file']['name'];

		$config['upload_path'] = '././aila_cbt/xls_file/'; 
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
						"code"		=> $rowData[0][0],
						"name"		=> $rowData[0][1],
						"password"	=> password_hash('12345678', PASSWORD_BCRYPT),
						"status"	=> 1
						
					);

            // Cek apakah NIM sudah ada atau belum, kalau ada maka lakukan proses update kalau belum ada maka lakukan proses insert
					$where      = array(
						'code' => $rowData[0][0], 
					);

					$cek_nip = $this->teacher_model->get_teacher_code($rowData[0][0]);
					if ($cek_nip >=1 ) {
						$this->teacher_model->update_data($where,$data);
					}
					else
					{
                //sesuaikan nama dengan nama tabel
						$insert = $this->teacher_model->create_data($data);
					}
				}

				// Delete all file trash
				delete_files('././aila_cbt/xls_file/');

				$this->session->set_flashdata('success','<b>'. ($highestRow - 1).' Data guru berhasil ditambahkan / dirubah.</b> <br/>');
				redirect('admin/teacher');
			}


			public function update()
			{
				if (($this->input->post()) && (!empty($this->input->post()))) 
				{
					$validation = $this->form_validation;
					$validation->set_rules($this->teacher_model->create_rules());

					if ($validation->run()) {

				// If teacher code has been registered
						if ($this->teacher_model->get_teacher_code($this->input->post('code', TRUE), $this->input->post('ID', TRUE)) >= 1 ) 
						{
							$this->session->set_flashdata('failed', 'Maaf, NIP tidak boleh sama dengan guru lain!');
						}
						else
						{
					// Create new teacher
							$this->teacher_model->update();
							$this->session->set_flashdata('success', 'Selamat, guru berhasil dirubah!');
						}

					}
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, guru gagal ditambah!');
				}
				redirect('admin/teacher');
			}

			public function password_reset($id = NULL)
			{
				if (!$id) redirect('admin/teacher');

				$teacher_model 	= $this->teacher_model;
				$data_teacher 	= $teacher_model->get_teacher_by_id(decode($id));

				if ($data_teacher) 
				{
					$teacher_model->password_reset($data_teacher->ID);
					$this->session->set_flashdata('success', 'Berhasil, password untuk <b>'.$data_teacher->name.'</b> dirubah menjadi <b>12345678</b>');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, password gagal dirubah, terjadi kesalahan sistem');
				}

				redirect('admin/teacher');
			}

			public function soft_delete($id = NULL)
			{
				if (!$id) redirect('admin/teacher');

				$teacher_model 	= $this->teacher_model;
				$data_teacher 	= $teacher_model->get_teacher_by_id(decode($id));

				if ($data_teacher) 
				{
					$teacher_model->soft_delete($data_teacher->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun guru dengan nama <b>'.$data_teacher->name.'</b> sudah dihapus sementara dan dimasukan ke tong sampah');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, password gagal dihapus, terjadi kesalahan sistem');
				}

				redirect('admin/teacher');
			}

			public function teacher_guide_hide()
			{
				$this->session->set_userdata('teacher_guide', FALSE);
				redirect('admin/teacher');
			}

			public function teacher_guide_show()
			{
				$this->session->set_userdata('teacher_guide', TRUE);
				redirect('admin/teacher');
			}

			public function archive($value='')
			{
				$data['teacher'] = $this->teacher_model->get_teacher_archive();
				$this->template->view('teacher_archive', $data);
			}

			public function reactivate($id = NULL)
			{
				if (!$id) redirect('admin/teacher');

				$teacher_model 	= $this->teacher_model;
				$data_teacher 	= $teacher_model->get_teacher_by_id(decode($id));

				if ($data_teacher) 
				{
					$teacher_model->reactivate($data_teacher->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun guru dengan nama <b>'.$data_teacher->name.'</b> sudah diaktifkan kembali');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, akun guru gagal diaktifkan kembali, terjadi kesalahan sistem');
				}

				redirect('admin/teacher/archive');
			}

			public function permanen_delete($id = NULL)
			{
				if (!$id) redirect('admin/student');

				$teacher_model 	= $this->teacher_model;
				$data_teacher	= $teacher_model->get_teacher_by_id(decode($id));

				if ($data_teacher) 
				{
					$teacher_model->permanen_delete($data_teacher->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun guru dengan nama <b>'.$data_teacher->name.'</b> sudah dihapus permanen');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, akun guru gagal dihapus permanen, terjadi kesalahan sistem');
				}

				redirect('admin/teacher/archive');
			}

		}
