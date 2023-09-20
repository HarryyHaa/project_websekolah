<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Profile_model extends CI_Model
{

	private $_table = 'school_profile';
	

	public function get_school_profile()
	{
		return $this->db->get($this->_table)->row();
	}

	public function update()
	{
		$input 			= $this->input->post();
		$this->name 	= clear_text($input['name']);
		$this->nspn 	= clear_text($input['nspn']);
		$this->type 	= clear_text($input['type']);
		$this->status 	= clear_text($input['status']);
		$this->ownership = clear_text($input['ownership']);
		$this->operational_permit_decree = clear_text($input['operational_permit_decree']);
		$this->decree_date = clear_text($input['decree_date']);
		$this->address 	= clear_text($input['address']);
		$this->village 	= clear_text($input['village']);
		$this->sub_district = clear_text($input['sub_district']);
		$this->district = clear_text($input['district']);
		$this->province = clear_text($input['province']);
		$this->db->update($this->_table, $this);
	}

	public function get_admin_profile($id='')
	{
		return $this->db->where('ID', $id)->get('admin')->row();
	}
	
}