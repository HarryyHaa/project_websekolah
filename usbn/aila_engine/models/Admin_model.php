<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	private $_table = 'admin';
	
	public function check_old_password($id)
	{
		return $this->db->select('password')->where('ID', $id)->get($this->_table)->row()->password;
	}

	
	public function password_reset_by_admin($id)
	{
		return $this->db
		->where('ID', $id)
		->set('name', $this->input->post('name', TRUE))
		->set('email', $this->input->post('email', TRUE))
		->set('password', password_hash($this->input->post('new_password', TRUE), PASSWORD_BCRYPT))
		->update($this->_table);
	}

	public function update_profile($id, $data)
	{
		return $this->db
		->where('ID', $id)
		->update($this->_table, $data);
	}

}