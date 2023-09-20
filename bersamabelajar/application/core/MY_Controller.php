<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->module('Template');
    }
}
