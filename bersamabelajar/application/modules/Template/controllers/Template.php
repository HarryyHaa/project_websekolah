<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Template extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function candy($data = NULL)
    {
        $this->load->view('Template/v_wrapper', $data);
    }
    function themeblank($data = NULL)
    {
        $this->load->view('Template/v_blank', $data);
    }
}
