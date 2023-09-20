<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Template Library 
 * By Ruswandi, S.T.
 */

class Template {

	public $template;
	public $directory_content = 'frontend';
	
	public function set_template($directory)
	{
		$this->template = $directory;
	}

	public function get_template()
	{
		return $this->template;
	}

	public function set_directory_content($directory)
	{
		$this->directory_content = $directory;
	}

	public function get_directory_content()
	{
		return $this->directory_content;
	}


	public function view($content='', $data= array())
	{
		$CI =& get_instance();

		$template = $this->get_template();
		$data['content'] 	= $this->get_directory_content().'/'.$content;

		// $CI->output->enable_profiler(true);

		$CI->load->view($template,$data);
	}
	
}