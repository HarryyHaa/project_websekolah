<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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
				redirect('admin/student');
			}
			else
			{

				$data['group_name'] 	= $groups->row()->name;
			}
		}
		$data['group_id'] = $id;
		$this->template->view('student_index', $data);
	}

	public function ajax_student_list($group_ID=NULL)
	{	
		if ($group_ID == '0') {
			$group_ID = NULL;
		}
		$student_status = 1;
		$list = $this->student_model->get_student_with_datatables($student_status, $group_ID);
		$data = array();
		$no = $this->input->post('start', TRUE);

		foreach ($list as $students) 
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $students->code;
			$row[] = $students->name;
			$row[] = $students->last_login;
			$row[] = $students->ip;
			$row[] = $students->device;
			$row[] = $students->user_agent;

			$row[] = '<a class="btn-small blue" href="'.site_url("admin/student/update/".encode($students->ID)).'" title="Ubah">Ubah</a>
			<a class="btn-small brown" href="'.site_url("admin/student/soft_delete/".encode($students->ID)).'" title="Hapus" onclick="return confirm(\'Apakah yakin akun siswa ini hendak diarsipkan ?\');">Arsipkan</a>';

			$row[] = '<a class="btn-small green" href="'.site_url("admin/student/password_reset/".encode($students->ID)).'" title="Reset" onclick="return confirm(\'Apakah yakin mau mereset password menjadi 12345678 ?\');">Reset</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw', TRUE),
			"recordsTotal" => $this->student_model->count_all(),
			"recordsFiltered" => $this->student_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	public function student_ajax_edit($id)
	{
		$data = $this->student_model->get_student_by_id($id);
		echo json_encode($data);
	}

	public function detail($id)
	{
		$data_student 	= $this->student_model->get_student_by_id(decode($id));

		if ($data_student) 
		{
			$data['student'] = $data_student;
			$this->template->view('student_detail', $data);
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, siswa tidak ditemukan!');
			redirect('admin/student');
		}
	}

	public function group($id= NULL)
	{
		if (!$id) 
		{
			$data['groups'] = $this->group_model->get_groups()->result();
			$this->template->view('group', $data);
		}
	}

	public function create_group()
	{
		if ($this->input->post()) 
		{
			if ($this->group_model->create_group()) 
			{
				$this->session->set_flashdata('success', 'Selamat, jurusan berhasil ditambah!');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, jurusan gagal ditambah');
			}
			redirect('admin/student/group');
		}
		else
		{
			redirect('admin/student/group');
		}
	}

	public function update_group()
	{
		if ($this->input->post()) 
		{
			if ($this->group_model->update_group()) 
			{
				$this->session->set_flashdata('success', 'Selamat, jurusan berhasil dirubah!');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Maaf, jurusan gagal dirubah');
			}
			redirect('admin/student/group');
		}
		else
		{
			redirect('admin/student/group');
		}
	}

	public function delete_group($id= NULL )
	{
		if (!$id) redirect('admin/student/group');
		$group			= $this->group_model->get_group_by_id($id);
		if ($group->num_rows() == 1) {
			if ($this->input->post('password', TRUE)) 
			{
				$this->load->model('login_model');
				$password = $this->input->post('password', TRUE);
				$admin_id = $this->session->userdata['ID'];
				if ($this->login_model->cek_auth('admin', $admin_id, $password)) {
					
					if ($this->group_model->delete_group($id)) 
					{
						$this->session->set_flashdata('success', 'Selamat, jurusan berhasil dihapus!');
					}
					else
					{
						$this->session->set_flashdata('failed', 'Maaf, jurusan gagal dihapus');
					}
					redirect('admin/student/group');

				}else{
					$this->session->set_flashdata('failed', 'Maaf, password yang Anda masukan salah');
					redirect(current_url());
				}
			}else{
				$data['group'] = $group->row();
				$students 		= $this->student_model->get_student_by_group($id);
				$data['student_total'] 	= $students->num_rows();
				$this->template->view('delete_group_confirm', $data);
			}
		}else{
			$this->session->set_flashdata('failed', 'Maaf, kelas/jurusan tidak ditemukan');
			redirect('admin/student/group');
		}
	}

	public function delete_group_go($id= NULL )
	{
		if (!$id) redirect('admin/student/group');
		if ($this->group_model->delete_group($id)) 
		{
			$this->session->set_flashdata('success', 'Selamat, jurusan berhasil dihapus!');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, jurusan gagal dihapus');
		}
		redirect('admin/student/group');
	}

	public function create()
	{
		if (($this->input->post()) && (!empty($this->input->post()))) 
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->student_model->create_rules());

			if ($validation->run()) {

				// If student code has been registered
				if ($this->student_model->get_student_code($this->input->post('code', TRUE)) >=1 ) 
				{
					$this->session->set_flashdata('failed', 'Maaf, siswa dengan '.$this->config->item('student_code').' tersebut sudah terdaftar!');
				}
				else
				{
					// Create new student
					$this->student_model->create();
					$this->session->set_flashdata('success', 'Selamat, siswa berhasil ditambah!');
				}
				
			}else{
				$this->session->set_flashdata('failed', 'Maaf, tambah siswa gagal, pastikan semua kolom sudah diisi, termasuk pemilihan jurusan');
			}
		}
		else
		{
			$this->session->set_flashdata('failed', 'Maaf, siswa gagal ditambah!');
		}
		redirect($this->input->post('url', TRUE));
	}

	public function import()
	{
		ini_set('max_execution_time', 1000);
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
						"code"		=> clear_text($rowData[0][0]),
						"name"		=> clear_text($rowData[0][1]),
						"password"	=> password_hash('12345678', PASSWORD_BCRYPT),
						"group_ID"		=> $rowData[0][2],
						"status"	=> 1
						
					);

           

					$this->student_model->update_on_duplicate($data);
				}

				// Delete all file trash
				delete_files('././stephan_cbt/xls_file/');

				$this->session->set_flashdata('success','<b>'. ($highestRow - 1).' Data berhasil ditambahkan / dirubah.</b> <br/>');
				redirect('admin/student');
			}

			public function update($id = NULL)
			{
				if (($this->input->post()) && (!empty($this->input->post()))) 
				{
					$validation = $this->form_validation;
					$validation->set_rules($this->student_model->create_rules());

					if ($validation->run()) {

				// If student code has been registered
						if ($this->student_model->get_student_code($this->input->post('code', TRUE), $this->input->post('ID', TRUE)) >= 1 ) 
						{
							$this->session->set_flashdata('failed', 'Maaf, '.$this->config->item('student_code').' tidak boleh sama dengan siswa lain!');
						}
						else
						{
					// Create new student
							$this->student_model->update();
							$this->session->set_flashdata('success', 'Selamat, siswa berhasil dirubah!');
						}

					}
					redirect('admin/student');
				}
				else
				{
					$data_student 	= $this->student_model->get_student_by_id(decode($id));

					if ($data_student) 
					{
						$data['student'] = $data_student;
						$data['groups'] = $this->group_model->get_groups()->result();
						$this->template->view('student_update', $data);
					}
					else
					{
						$this->session->set_flashdata('failed', 'Maaf, siswa tidak ditemukan!');
						redirect('admin/student');
					}
				}
			}

			public function password_reset($id = NULL)
			{
				if (!$id) redirect('admin/student');

				$student_model 	= $this->student_model;
				$data_student 	= $student_model->get_student_by_id(decode($id));

				if ($data_student) 
				{
					$student_model->password_reset($data_student->ID);
					$this->session->set_flashdata('success', 'Berhasil, password untuk <b>'.$data_student->name.'</b> dirubah menjadi <b>12345678</b>');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, password gagal dirubah, terjadi kesalahan sistem');
				}

				redirect('admin/student');
			}

			public function soft_delete($id = NULL)
			{
				if (!$id) redirect('admin/student');

				$student_model 	= $this->student_model;
				$data_student 	= $student_model->get_student_by_id(decode($id));

				if ($data_student) 
				{
					$student_model->soft_delete($data_student->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun siswa dengan nama <b>'.$data_student->name.'</b> sudah dihapus sementara dan dimasukan ke arsip');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, akun siswa gagal dihapus, terjadi kesalahan sistem');
				}

				redirect('admin/student');
			}

			public function reactivate($id = NULL)
			{
				if (!$id) redirect('admin/student');

				$student_model 	= $this->student_model;
				$data_student 	= $student_model->get_student_by_id(decode($id));

				if ($data_student) 
				{
					$student_model->reactivate($data_student->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun siswa dengan nama <b>'.$data_student->name.'</b> sudah diaktifkan kembali');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, akun siswa gagal diaktifkan kembali, terjadi kesalahan sistem');
				}

				redirect('admin/student/archive');
			}

			public function permanen_delete($id = NULL)
			{
				if (!$id) redirect('admin/student');

				$student_model 	= $this->student_model;
				$data_student 	= $student_model->get_student_by_id(decode($id));

				if ($data_student) 
				{
					$student_model->permanen_delete($data_student->ID);
					$this->session->set_flashdata('success', 'Berhasil, akun siswa dengan nama <b>'.$data_student->name.'</b> sudah dihapus permanen');
				}
				else
				{
					$this->session->set_flashdata('failed', 'Maaf, akun siswa gagal dihapus permanen, terjadi kesalahan sistem');
				}

				redirect('admin/student/archive');
			}

			public function student_guide_hide()
			{
				$this->session->set_userdata('student_guide', FALSE);
				redirect('admin/student');
			}

			public function student_guide_show()
			{
				$this->session->set_userdata('student_guide', TRUE);
				redirect('admin/student');
			}

			public function genret()
			{
				if (!$this->input->post()) redirect('admin/student');

				$group_ID = $this->input->post('group', TRUE);
				$prefik_code = $this->input->post('code', TRUE);
				$new_code = $group_ID."000";
				$total 	= $this->input->post('total', TRUE);

				$code = $prefik_code.($new_code+1);

				if ($this->student_model->get_student_by_code($code)) 
				{
					$this->session->set_flashdata('failed', 'Maaf, kode prefik tersebut sudah pernah digunakan');
					redirect('admin/student');
				}
				else
				{
					$data = [];
					for ($i=1; $i <= $total ; $i++) 
					{ 
						$data[] = array(
							'code' 		=> $prefik_code.($new_code+$i),
							'password'	=> password_hash('12345678', PASSWORD_BCRYPT),
							'group_ID' => $group_ID
						);
					}

				// inset to database
					$this->db->insert_batch('student', $data);
					$this->session->set_flashdata('success', 'Selamat, '.($i-1).' akun berhasil digenret');
					redirect('admin/student');
				}
			}


			public function archive($value='')
			{
				$data['students'] = $this->student_model->get_student_archive();
				$this->template->view('student_archive', $data);
			}

		}



