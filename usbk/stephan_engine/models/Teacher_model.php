<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model
{

	private $_table = 'teacher';
	var $column_order = array('ID', 'code', 'status','last_login', 'phone_number', 'email', 'name', 'password');
	var $column_search = array('name', 'code',  'status', 'last_login','phone_number', 'email', 'password');
	var $order  = array('ID' => 'asc');

	public 	$ID,
	$name,
	$code,
	$password,
	$status;

	private function _get_teacher_query()
	{
		$this->db->from($this->_table);

		$i = 0;

		foreach ($this->column_search as $item)
		{
			if($this->input->post('search', TRUE))
			{
				if ($i === 0) 
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) -1 == $i) 
					$this->db->group_end();
				
			}
			$i++;
		}
		if (isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($this->order)) 
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_teacher_with_datatables($status = NULL)
	{
		$this->_get_teacher_query();
		if ($this->input->post('length', TRUE) != -1) 
			$this->db->limit($this->input->post('length', TRUE),$this->input->post('start', TRUE));
		
		if ($status != NULL) 
		{
			$this->db->where('status', $status);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_teacher_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->_table);
		return $this->db->get()->num_rows();
	}


	public function get_teacher($status = NULL)
	{
		$this->db->select('id as ID, code, name, email, phone_number, last_login, status');
		if ($status != NULL) {
			$this->db->where('status', $status);
		}
		return $this->db->get($this->_table)->result();
	}

	public function get_teacher_active()
	{
		$this->db->select('id as ID, code, name, email, phone_number, last_login, status');
		return $this->db->get_where($this->_table, ['status' => '1'] )->result();
	}

	public function get_teacher_archive()
	{
		$this->db->select('id as ID, code, name, email, phone_number, last_login, status');
		return $this->db->get_where($this->_table, ['status' => '2'] )->result();
	}

	public function get_teacher_by_id($id)
	{
		$this->db->select('id as ID, code, name, email, phone_number, last_login, status, password');
		return $this->db->get_where($this->_table, ['ID' => $id] )->row();
	}

	public function get_teacher_code($code, $id = NULL)
	{
		$this->db
		->select('code')
		->where('code', $code);
		if ($id != NULL) {
			$this->db->where('ID !=', $id);
		}
		return  $this->db->get($this->_table)->num_rows();
	}

	public function create_rules()
	{
		return [
			['field' => 'code',
			'label' => 'NIP',
			'rules' => 'required|trim'],

			['field' => 'name',
			'label' => 'Nama Lengkap',
			'rules' => 'required']
		];
	}

	public function create()
	{
		$input 			= $this->input->post();
		$this->code 	= clear_text($input['code']);
		$this->name 	= clear_text($input['name']);
		$this->password = password_hash('12345678', PASSWORD_BCRYPT);
		$this->status 	= 1;
		$this->db->insert($this->_table, $this);
	}

	// Data From Import
	public function create_data($data)
	{
		$this->db->insert($this->_table, $data);
	}

	public function update_data($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
	}
	// End Data From Import
	
	public function update()
	{
		$input 			= $this->input->post();
		$data = [
			'code' 	=> clear_text($input['code']),
			'name' 	=> clear_text($input['name']),
			'status'=> 1
		];
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->update($this->_table, $data);
	}

	public function complete_profile()
	{
		$input 			= $this->input->post();
		$data = [
			'phone_number' 	=> $input['phone_number'],
			'email' 	=> $input['email']
		];
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->update($this->_table, $data);
	}

	public function check_old_password($id)
	{
		return $this->db->select('password')->where('ID', $id)->get($this->_table)->row()->password;
	}

	public function password_reset($id)
	{
		return $this->db
		->where('ID', $id)
		->set('password', password_hash('12345678', PASSWORD_BCRYPT))
		->update($this->_table);
	}

	public function password_reset_by_teacher($id)
	{
		return $this->db
		->where('ID', $id)
		->set('password', password_hash($this->input->post('new_password', TRUE), PASSWORD_BCRYPT))
		->update($this->_table);
	}
	
	public function soft_delete($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', '2')
		->update($this->_table);
	}

		public function reactivate($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', '1')
		->update($this->_table);
	}

	public function permanen_delete($id)
	{
		return $this->db
		->where('ID', $id)
		->set('status', '1')
		->delete($this->_table);
	}

	// Update last login teacger
	public function update_last_login($id)
	{
		return $this->db
		->where('ID', $id)
		->set('last_login', date('Y-m-d H:i:s'))
		->update($this->_table);
	}
}
