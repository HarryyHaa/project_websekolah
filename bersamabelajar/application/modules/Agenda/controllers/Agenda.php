<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Agenda extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_guru();
        $this->load->model('Agenda_model', 'sm');
        $this->load->library('datatables');
    }
    function index()
    {
        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {
            $guru = $this->db->get('guru')->result_array();
        } else {
            $guru = $this->db->get_where('guru', ['id_guru' => $id])->result_array();
        }
        $data = [
            'isi' => 'Agenda/v_agenda',
            'setting' => $this->db->get_where('setting', ['id_setting' => 1])->row_array(),
            'kursus' => $this->db->get_where('kursus', ['id_guru' => $id])->result_array(),
            'guru' => $guru,
            'kelas' => $this->db->get('kelas')->result_array()
        ];
        $this->template->candy($data);
    }
    function get_idt_agenda()
    {
        $id = $this->session->userdata('iduser');
        $akses = $this->session->userdata('akses');
        if ($akses == 1) {

            echo $this->sm->Ignited_dt('id_agenda,kegiatan,kelas,tgl,jam_mulai,jam_selesai,id_mapel', 'agenda', array());
        } else {
            $where = [
                'id_guru' => $id
            ];
            echo $this->sm->Ignited_dt('id_agenda,kegiatan,kelas,tgl,jam_mulai,jam_selesai,id_mapel', 'agenda', $where);
        }
    }
    public function tambahdata()
    {
        $kursus = $this->input->post('kursus');
        $guru = $this->input->post('guru');
        $tgl = $this->input->post('tgl');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        $kegiatan = $this->input->post('kegiatan');
        $kelas = $this->input->post('kelas');
        $this->form_validation->set_rules('kursus', 'kursus', 'required');
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'kursus' => form_error('kursus'),
                'kegiatan' => form_error('kegiatan')
            ];
            echo json_encode($data);
        } else {
            $mapel = $this->db->get_where('kursus', ['id_kursus' => $kursus])->row_array();
            echo json_encode('sukses');
            $data = [
                'id_kursus' => $kursus,
                'id_guru' => $guru,
                'tgl' => $tgl,
                'jam_mulai' => $mulai,
                'jam_selesai' => $selesai,
                'kegiatan' => $kegiatan,
                'kelas' => implode(",", $kelas),
                'id_mapel' => $mapel['id_mapel']
            ];
            $this->sm->createdata('agenda', $data);
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $kursus = $this->input->post('kursus');
        $guru = $this->input->post('guru');
        $tgl = $this->input->post('tgl');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        $kegiatan = $this->input->post('kegiatan');
        $kelas = $this->input->post('kelas');
        $this->form_validation->set_rules('kursus', 'kursus', 'required');
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $data = [
                'kursus' => form_error('kursus'),
                'kegiatan' => form_error('kegiatan')
            ];
            echo json_encode($data);
        } else {
            $mapel = $this->db->get_where('kursus', ['id_kursus' => $kursus])->row_array();
            $where = ['id_agenda' => $id];
            $data = [
                'id_kursus' => $kursus,
                'id_guru' => $guru,
                'tgl' => $tgl,
                'jam_mulai' => $mulai,
                'jam_selesai' => $selesai,
                'kegiatan' => $kegiatan,
                'kelas' => implode(",", $kelas),
                'id_mapel' => $mapel['id_mapel']
            ];
            $this->sm->ubahdata('agenda', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_agenda' => $id
        ];
        $this->sm->deletedata('agenda', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_agenda' => $id
        ];
        $datasiswa = $this->sm->ambilid('agenda', $where)->result();
        echo json_encode($datasiswa);
    }
    public function export_agenda($id = null)
    {

        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Elearning Candy')
            ->setLastModifiedBy('Elearning Candy')
            ->setTitle("Data Agenda Guru")
            ->setSubject("Guru")
            ->setDescription("Laporan Agenda Guru")
            ->setKeywords("Data Guru");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA AGENDA GURU"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "GURU"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "PEMBELAJARAN"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "PEMBAHASAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JAM MULAI");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "JAM SELESAI");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        if (!$id) {
            $agenda = $this->db->get_where('agenda', ['id_guru' => $id])->result_array();
        } else {
            $agenda = $this->db->get('agenda')->result_array();
        }

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($agenda as $data) {
            $guru = $this->db->get_where('guru', ['id_guru' => $data['id_guru']])->row_array();
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $guru['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['id_mapel']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['kegiatan']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['jam_mulai']);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['jam_selesai']);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['tgl']);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Agenda Guru");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Agenda Guru '  . date('Y-m-d') . '.xlsx"');
        $object_writer->save('php://output');
    }
}
