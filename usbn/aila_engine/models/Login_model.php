<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Login_model extends CI_Model
{

	public $ID 			= 'ID';
	public $password 	= 'password';
	
	public function admin_rules()
	{
		return [
			['field' => 'email',
			'label' => 'Email',
			'rules' => 'required|trim'],

			['field' => 'password',
			'label' => 'Password',
			'rules' => 'required']
		];
	}

	public function teacher_rules()
	{
		return [
			['field' => 'code',
			'label' => 'NIP',
			'rules' => 'required|trim'],

			['field' => 'password',
			'label' => 'Password',
			'rules' => 'required']
		];
	}

	public function student_rules()
	{
		return [
			['field' => 'code',
			'label' => 'NIP',
			'rules' => 'required|trim'],

			['field' => 'password',
			'label' => 'Password',
			'rules' => 'required']
		];
	}

	public function get_user_id($table, $column, $value)
	{
		$this->db->select('ID');
		$this->db->where($column, $value);
		return $this->db->get($table)->row();
	}

	public function cek_auth($table, $id, $password)
	{
		$this->db->select($this->password);
		$this->db->from($table);
		$this->db->where($this->ID, $id);
		$hash = $this->db->get()->row($this->password);

		return password_verify($password, $hash);
	}

	public function get_user_by_id($table, $id)
	{
		return $this->db->get_where($table, array($this->ID => $id))->row();
	}

	
}