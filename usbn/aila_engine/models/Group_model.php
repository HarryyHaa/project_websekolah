<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model
{
	private $_table = 'student_group';
	public 	$ID, $name;

	public function get_groups()
	{
		return $this->db->get($this->_table);
	}

	public function get_group_by_id($id)
	{
		return $this->db->where('ID', $id)->get($this->_table);
	}

	public function create_group()
	{
		return $this->db->insert($this->_table, ['name' => clear_text($this->input->post('name', TRUE))]);
	}

	public function update_group()
	{
		$this->db->where('ID', $this->input->post('ID', TRUE));
		$this->db->set('name', clear_text($this->input->post('name', TRUE)));
		return $this->db->update($this->_table);
	}

	public function delete_group($id)
	{

		// delete quiz answer
		$query_quiz_answer = ('DELETE FROM quiz_answer WHERE student_ID IN(SELECT ID from student WHERE group_ID='.$id.')');
		$this->db->query($query_quiz_answer);

		// delete quiz timer
		$query_quiz_timer = ('DELETE FROM quiz_timer WHERE student_ID IN(SELECT ID from student WHERE group_ID='.$id.')');
		$this->db->query($query_quiz_timer);

		// delete students
		$this->db->where('group_ID', $id)->delete('student');

		// delete group
		$this->db->where('ID', $id);
		return $this->db->delete($this->_table);
	}
	
	
}