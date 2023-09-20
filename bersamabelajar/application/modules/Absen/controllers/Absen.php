<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        $this->load->model('Absen_model', 'sm');
        $this->load->library('datatables');
        $this->load->library('upload');
    }
    public function index()
    {
        ceklogin_guru();
        $data = [
            'isi' => 'Absen/v_absen',
            'kelas' => $this->db->get('kelas')->result_array()

        ];
        $this->template->candy($data);
    }
    public function siswa()
    {
        $id = $this->session->userdata('iduser');
        $data = [
            'isi' => 'Absen/v_absen_disiswa',
            'absen' => $this->db->get_where('absen_siswa', ['id_user' => $id])->result_array()
        ];
        $this->template->candy($data);
    }

    public function simpan_absen_bysiswa()
    {
        $id = $this->session->userdata('iduser');
        $latitude = $this->input->post('lat');
        $longitude = $this->input->post('long');
        $cek = $this->db->get_where('absen_siswa', ['id_user' => $id, 'date(tgl)' => date('Y-m-d')])->num_rows();
        $config['upload_path'] = './assets/img/absen'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/absen/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 400;
                $config['height'] = 510;
                $config['new_image'] = './assets/img/absen/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                $data = [
                    'id_user' => $id,
                    'absen' => 'H',
                    'ket' => 'Hadir mengikuti PJJ',
                    'foto' => $gambar,
                    'tgl' => date('Y-m-d H:i:s'),
                    'latitude' => $latitude,
                    'longitude' => $longitude
                ];
                if ($cek == 0) {
                    $foto = FCPATH . 'assets/img/absen/' . $gambar;
                    $this->sm->createdata('absen_siswa', $data);
                    $siswa = $this->db->get_where('siswa', ['id_siswa' => $id])->row_array();
                    $guru = $this->db->get_where('guru', ['walas' => $siswa['kelas']])->row_array();
                    $chatid = $guru['chatid'];
                    $mesage = "Nama : " . $siswa['nama'] . "\nKelas : " . $siswa['kelas'] . "\nBerhasil Absen\n" . date('Y-m-d H:i:s');
                    //$this->telegram_lib->sendmsg($chatid, $mesage);
                    $this->telegram_lib->sendimg($chatid, $foto, $mesage);
                    //$this->telegram_lib->sendvenue($chatid, $latitude, $longitude, "test", "address");

                }
            }
        }
        redirect('Absen/siswa');
    }

    public function walas($kelas)
    {
        ceklogin_guru();
        $id = $this->session->userdata('iduser');
        $data = [
            'isi' => 'Absen/v_absen_siswa_diguru',
            'absen' => $this->db->query("select * from absen_siswa a join siswa b on a.id_user=b.id_siswa where b.kelas='$kelas'")->result_array(),
            'siswa' => $this->db->get_where('siswa', ['kelas' => $kelas])->result_array(),
            'kelas' => $kelas,
            'jumdata' => $this->db->get_where('siswa', ['kelas' => $kelas])->num_rows()

        ];
        $this->template->candy($data);
    }
    public function simpanabsen()
    {
        $jumlahdata = $this->input->post('jumlahdata');
        //$tanggal = $this->input->post('tanggal');
        $tanggal = date('Y-m-d H:i:s');

        for ($i = 1; $i <= $jumlahdata; $i++) {
            $id = $this->input->post($i . 'id');
            $radio = $this->input->post($i . 'absen');
            $ket = $this->input->post($i . 'ket');
            $cek = $this->db->get_where('absen_siswa', ['id_user' => $id, 'date(tgl)' => date('Y-m-d')])->num_rows();
            if ($radio) {
                if ($cek <> 0) {
                    $this->db->where('id_user', $id);
                    $this->db->update('absen_siswa', ['absen' => $radio, 'ket' => $ket]);
                } else {
                    $this->db->insert('absen_siswa', ['absen' => $radio, 'id_user' => $id, 'tgl' => $tanggal,  'ket' => $ket]);
                }
            }
        }
    }
    public function siswarekap($kelas = null)
    {
        ceklogin_guru();
        $id = $this->session->userdata('iduser');
        $data = [
            'isi' => 'Absen/v_absen_siswa_rekap',
            'absen' => $this->db->query("select * from absen_siswa a join siswa b on a.id_user=b.id_siswa where b.kelas='$kelas'")->result_array(),
            'siswa' => $this->db->get_where('siswa', ['kelas' => $kelas])->result_array(),
            'kelas' => $kelas
        ];
        $this->template->candy($data);
    }
    public function getrekap()
    {
        ceklogin_guru();
        $kelas = $this->input->post('kelas');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas])->result_array();
        $this->load->view('Absen/v_absen_siswa_getrekap', $data);
    }
    public function getabsen($kelas)
    {
        ceklogin_guru();
        $tgl = $this->input->post('tgl');
        $data['tgl'] = $tgl;
        $data['kelas'] = $kelas;
        $data['siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas])->result_array();
        $data['jumdata'] = $this->db->get_where('siswa', ['kelas' => $kelas])->num_rows();
        $this->load->view('Absen/v_absen_siswa_get', $data);
    }
    public function export_absen($id, $tgl = null)
    {
        if (!$tgl) {
            $tgl = date('Y-m-d');
        }
        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Elearning Candy')
            ->setLastModifiedBy('Elearning Candy')
            ->setTitle("Data Absen Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Absen Siswa")
            ->setKeywords("Data Siswa");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA ABSEN SISWA KELAS " . $id); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "ABSEN TANGGAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "FOTO");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $siswa = $this->db->get_where('siswa', ['kelas' => $id])->result_array();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($siswa as $data) {
            $absen = $this->db->get_where('absen_siswa', ['id_user' => $data['id_siswa'], 'date(tgl)' => $tgl])->row_array();
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $absen['tgl']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $absen['ket']);
            if ($absen['foto'] <> "") {
                if (file_exists('./assets/img/absen/' . $absen['foto'])) {
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $foto = realpath(FCPATH . 'assets/img/absen/' . $absen['foto']);
                    $objDrawing->setPath($foto);
                    $objDrawing->setCoordinates('F' . $numrow);
                    $objDrawing->setHeight(100);
                    $objDrawing->setWorksheet($excel->getActiveSheet());
                    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(75);
                } else {
                    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, "");
                }
            } else {
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, "");
            }

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(11); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Kelas " . $id . " Tgl " . $tgl);
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Absen Kelas ' . $id . ' tgl ' . $tgl . '.xlsx"');
        $object_writer->save('php://output');
    }
    function reportwalas($kelas, $tgl)
    {
        ceklogin_guru();
        if (!$tgl) {
            $tgl = date('Y-m-d');
        }
        $data['tgl'] = $tgl;
        $data['kelas'] = $kelas;
        $data['siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas])->result_array();
        $data['setting']  = $this->db->get_where('setting', ['id_setting' => 1])->row_array();
        $data['guru'] = $this->db->get_where('guru', ['id_guru' => $this->session->userdata('iduser')])->row_array();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $this->pdf->filename = "laporanguru.pdf";
        $this->pdf->load_view('Absen/v_absen_report_walas.php', $data);
    }
}
