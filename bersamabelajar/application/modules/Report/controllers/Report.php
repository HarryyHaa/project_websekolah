<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_admin();

        $this->load->library('datatables');
    }
    public function index()
    {
        $data = [
            'isi' => 'Mapel/v_mapel'
        ];
        $this->template->candy($data);
    }
    function guru()
    {
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporanguru.pdf";
        $this->pdf->load_view('Report/v_report_guru');
    }
}
