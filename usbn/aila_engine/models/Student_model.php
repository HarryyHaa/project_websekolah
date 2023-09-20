<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model
{

	private $_table = 'student';
	var $column_order = array('name', 'code','password', 'group_ID', 'status','last_login');
	var $column_search = array('name', 'code', 'password', 'group_ID', 'status', 'last_login');
	var $order  = array('id' => 'asc');

	public 	$ID,
	$name,
	$code,
	$password,
	$group_ID,
	$status;

	private function _get_student_query()
	{
		// return $this->db->get($this->_table)->result();
		$this->db->from($this->_table);

		$i = 0;

		foreach ($this->column_search as $item)
		{
			if($this->input->post('search', TRUE))
			{
				if ($i === 0) 
				{
					$this->db->group_start();
					$this->db->like($like, $_POST['search']['value']);
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

	public function get_student_with_datatables($status = NULL, $group_ID = NULL)
	{
		$this->_get_student_query();
		if ($this->input->post('length', TRUE) != -1) 
			$this->db->limit($this->input->post('length', TRUE),$this->input->post('start', TRUE));
		
		if ($status != NULL) 
		{
			$this->db->where('status', $status);
		}
		if ($group_ID != NULL) 
		{
			$this->db->where('group_ID', $group_ID);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_student_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->_table);
		return $this->db->get()->num_rows();
	}

	public function get_student_active()
	{
		return $this->db->get_where($this->_table, ['status' => '1'] )->result();
	}

	public function get_student_by_group($id)
	{
		return $this->db->get_where($this->_table, ['group_ID' => $id] );
	}

	public function get_student_active_by_group($id)
	{
		return $this->db->get_where($this->_table, ['status' => '1', 'group_ID' => $id] )->result();
	}

	public function get_student_archive()
	{
		return $this->db->get_where($this->_table, ['status' => '2'] )->result();
	}

	public function get_student_by_id($id)
	{
		return $this->db->get_where($this->_table, ['ID' => $id] )->row();
	}

	public function get_student_by_code($code)
	{
		return $this->db->get_where($this->_table, ['code' => $code] )->row();
	}

	public function get_student_code($code, $id = NULL)
	{
		$this->db
		->select('code')
		->where('code', $code);
		if ($id != NULL) {
			$this->db->where('ID !=', $id);
		}
		return  $this->db->get($this->_table)->num_rows();
	}

	public function get_studnet_last_login($limit= 10)
	{
		$this->db->select('name, code, phone_number, last_login');
		$this->db->where(1,1);
		$this->db->order_by('last_login', 'desc');
		$this->db->limit($limit);
		return $this->db->get($this->_table);
	}

	public function create_rules()
	{
		return [
			['field' => 'code',
			'label' => 'NIS',
			'rules' => 'required|trim'],

			['field' => 'name',
			'label' => 'Nama Lengkap',
			'rules' => 'required'],
			['field' => 'group',
			'label' => 'Kelas / Jurusan',
			'rules' => 'required|trim']
		];
	}

	public function create()
	{
		$input 			= $this->input->post();
		$this->code 	= clear_text($input['code']);
		$this->name 	= clear_text($input['name']);
		$this->group_ID 	= $input['group'];
		$this->password = password_hash('12345678', PASSWORD_BCRYPT);
		$this->status 	= 1;
		$this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$input 			= $this->input->post();
		$data = [
			'code' 		=> clear_text($input['code']),
			'name' 		=> clear_text($input['name']),
			'group_ID' 	=> $input['group'],
			'status'	=> 1
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

	public function search_by_name()
	{
		return $this->db
		->like('name', clear_text($this->input->post('name', TRUE)))
		->limit(10)
		->get($this->_table);
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
	
	public function password_reset_by_student($id)
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

	// Update last login student
	public function update_last_login($id, $session_id)
	{
		return $this->db
		->where('ID', $id)
		->set('last_login', date('Y-m-d H:i:s'))
		->set('session_id', $session_id)
		->update($this->_table);
	}

	public function count_studnet_by_group()
	{
		$this->db->select('b.name, COUNT(a.group_ID) as total');
		$this->db->from($this->_table.' a');
		$this->db->join('student_group b', 'b.ID=a.group_ID');
		$this->db->group_by('b.name');
		$this->db->order_by('total' ,'desc');
		return $this->db->get()->result();
	}
}