<?php
defined('BASEPATH') or exit('No direct script access allowed');

class siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ceklogin();
        ceklogin_guru();
        $this->load->model('siswa_model', 'sm');
        $this->load->library('datatables');
        $this->load->library('excel');
    }
    public function index()
    {
        $data = [
            'isi' => 'Siswa/v_siswa',
            'level' => $this->db->get('level')->result_array(),
            'sesi' => $this->db->get('sesi')->result_array(),
            'kelas' => $this->db->get('kelas')->result_array(),
            'jurusan' => $this->db->get('jurusan')->result_array()
        ];
        $this->template->candy($data);
    }
    function get_idt_siswa()
    {
        if ($this->session->userdata('akses') == 1) {
            echo $this->sm->Ignited_dt('id_siswa,nis,no_hp,nama,level,kelas,jurusan,sesi,no_hp,password', 'siswa', array());
        } elseif ($this->session->userdata('akses') == 2) {
            echo $this->sm->Ignited_dt_guru('id_siswa,nis,no_hp,nama,level,kelas,jurusan,sesi,no_hp,password', 'siswa', array());
        } else {
            redirect('Home');
        }
    }


    public function tambahdata()
    {
        $nohp = $this->input->post('nohp');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $kelas = $this->input->post('kelas');
        $jurusan = $this->input->post('jurusan');
        $sesi = $this->input->post('sesi');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        //FORM VALIDASI
        $this->form_validation->set_rules('nohp', 'No HP', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            // $errors = validation_errors();
            $data = [
                'nohp' => form_error('nohp'),
                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {

            $data = [
                'no_hp' => $nohp,
                'nama' => $nama,
                'nis' => $nis,
                'level' => $level,
                'kelas' => $kelas,
                'jurusan' => $jurusan,
                'sesi' => $sesi,
                'username' => $username,
                'password' => $password,
                'status' => 1

            ];
            $this->sm->createdata('siswa', $data);
            echo json_encode('sukses');
        }
    }
    public function editdata()
    {
        $id = $this->input->post('id');
        $nohp = $this->input->post('nohp');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $kelas = $this->input->post('kelas');
        $jurusan = $this->input->post('jurusan');
        $sesi = $this->input->post('sesi');
        $password = $this->input->post('password');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [

                'nama' => form_error('nama')

            ];
            echo json_encode($data);
        } else {
            $where = ['id_siswa' => $id];
            if ($password == '') {
                $data = [
                    'no_hp' => $nohp,
                    'nis' => $nis,
                    'nama' => $nama,
                    'level' => $level,
                    'kelas' => $kelas,
                    'jurusan' => $jurusan,
                    'sesi' => $sesi,
                    'status' => 1
                ];
            } else {
                $data = [
                    'no_hp' => $nohp,
                    'nis' => $nis,
                    'nama' => $nama,
                    'level' => $level,
                    'kelas' => $kelas,
                    'jurusan' => $jurusan,
                    'sesi' => $sesi,
                    'status' => 1,
                    'password' => $password
                ];
            }
            $this->sm->ubahdata('siswa', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = [
            'id_siswa' => $id
        ];
        $this->sm->deletedata('siswa', $where);
        echo json_encode('ok');
    }
    public function ambilid()
    {
        $id = $this->input->post('id');
        $where = [
            'id_siswa' => $id
        ];
        $datasiswa = $this->sm->ambilid('siswa', $where)->result();
        echo json_encode($datasiswa);
    }
    function import_siswa()
    {
        if (isset($_FILES["file"]["name"])) {
            //$this->db->query('truncate siswa');
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nis = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $level = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $kelas = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jur = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $sesi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $hp = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $pass = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $nisn = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $jk = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $tempat = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $tgl_lahir = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $agama = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $anakke = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $saudara = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $rt = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $rw = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $desa = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $kec = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $kota = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $tinggal = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                    $asal = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    $nik = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                    $nik_ibu = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    $nama_ibu = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    $tgl_lahir_ibu = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                    $pendidikan_ibu = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                    $pekerjaan_ibu = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                    $penghasilan_ibu = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                    $nik_ayah = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                    $nama_ayah = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                    $tgl_lahir_ayah = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                    $pendidikan_ayah = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                    $pekerjaan_ayah = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                    $penghasilan_ayah = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                    $transportasi = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                    $kip = $worksheet->getCellByColumnAndRow(38, $row)->getValue();


                    $cek = $this->db->get_where('siswa', ['nis' => $nis])->num_rows();
                    if ($cek == 0) {
                        $data = [
                            'nis'   => $nis,
                            'nama'    => $nama,
                            'sesi'  => $sesi,
                            'level'  => $level,
                            'kelas'   => $kelas,
                            'jurusan' => $jur,
                            'no_hp' => $hp,
                            'password' => $pass,
                            'foto' => 'default.png',
                            'jenkel' => $jk,
                            'tempat_lahir' => $tempat,
                            'tgl_lahir' => $tgl_lahir,
                            'agama' => $agama,
                            'asal_sekolah' => $asal,
                            'alamat' => $alamat,
                            'rt' => $rt,
                            'rw' => $rw,
                            'desa' => $desa,
                            'kecamatan' => $kec,
                            'kota' => $kota,
                            'tinggal' => $tinggal,
                            'transportasi' => $transportasi,
                            'anak_ke' => $anakke,
                            'saudara' => $saudara,
                            'nik' => $nik,
                            'nik_ayah' => $nik_ayah,
                            'nama_ayah' => $nama_ayah,
                            'tgl_lahir_ayah' => $tgl_lahir_ayah,
                            'pendidikan_ayah' => $pendidikan_ayah,
                            'pekerjaan_ayah' => $pekerjaan_ayah,
                            'penghasilan_ayah' => $penghasilan_ayah,
                            'nik_ibu' => $nik_ibu,
                            'nama_ibu' => $nama_ibu,
                            'tgl_lahir_ibu' => $tgl_lahir_ibu,
                            'pendidikan_ibu' => $pendidikan_ibu,
                            'pekerjaan_ibu' => $pekerjaan_ibu,
                            'penghasilan_ibu' => $penghasilan_ibu,
                            'nisn' => $nisn,
                            'no_kip' => $kip
                        ];
                        $this->db->insert('siswa', $data);
                    } else {
                        $data = [

                            'jenkel' => $jk,
                            'tempat_lahir' => $tempat,
                            'tgl_lahir' => $tgl_lahir,
                            'agama' => $agama,
                            'asal_sekolah' => $asal,
                            'alamat' => $alamat,
                            'rt' => $rt,
                            'rw' => $rw,
                            'desa' => $desa,
                            'kecamatan' => $kec,
                            'kota' => $kota,
                            'tinggal' => $tinggal,
                            'transportasi' => $transportasi,
                            'anak_ke' => $anakke,
                            'saudara' => $saudara,
                            'nik' => $nik,
                            'nik_ayah' => $nik_ayah,
                            'nama_ayah' => $nama_ayah,
                            'tgl_lahir_ayah' => $tgl_lahir_ayah,
                            'pendidikan_ayah' => $pendidikan_ayah,
                            'pekerjaan_ayah' => $pekerjaan_ayah,
                            'penghasilan_ayah' => $penghasilan_ayah,
                            'nik_ibu' => $nik_ibu,
                            'nama_ibu' => $nama_ibu,
                            'tgl_lahir_ibu' => $tgl_lahir_ibu,
                            'pendidikan_ibu' => $pendidikan_ibu,
                            'pekerjaan_ibu' => $pekerjaan_ibu,
                            'penghasilan_ibu' => $penghasilan_ibu,
                            'nisn' => $nisn,
                            'no_kip' => $kip
                        ];
                        $this->db->update('siswa', $data, ['nis' => $nis]);
                    }
                }
            }

            echo 'Data Imported successfully';
        }
    }
    public function kelas($kelas = null)

    {
        $siswa = $this->db->get_where('siswa', ['kelas' => $kelas])->result_array();
        $data = [
            'isi' => 'Siswa/v_siswa_walas',
            'siswa' => $siswa,
            'kelas' => $kelas
        ];
        $this->template->candy($data);
    }
    public function editsiswabinaan()
    {
        $id = $this->input->post('id');
        $nohp = $this->input->post('nohp');
        $nama = $this->input->post('nama');
        $status = $this->input->post('status');
        $tunggakan = $this->input->post('tunggakan');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'nama' => form_error('nama')
            ];
            echo json_encode($data);
        } else {
            $where = ['id_siswa' => $id];
            $data = [
                'no_hp' => $nohp,
                'nama' => $nama,
                'status' => $status,
                'tunggakan' => $tunggakan
            ];

            $this->sm->ubahdata('siswa', $data, $where);
            echo json_encode('sukses');
        }
    }
    public function export_siswa($id = null)
    {

        ceklogin_guru();
        $this->load->library('excel');
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Elearning Candy')
            ->setLastModifiedBy('Elearning Candy')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Data Semua Siswa")
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
        // $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SEMUA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        // $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        // $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        // $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        // $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "ID"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "LEVEL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "KELAS"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "JURUSAN");
        $excel->setActiveSheetIndex(0)->setCellValue('G1', "SESI");
        $excel->setActiveSheetIndex(0)->setCellValue('H1', "NO HP");
        $excel->setActiveSheetIndex(0)->setCellValue('I1', "PASSWORD");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
        $styleArray = array(
            'font'  => array(
                'size'  => 10
            )
        );
        $excel->getDefaultStyle()
            ->applyFromArray($styleArray);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->db->get('siswa')->result_array();


        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($siswa as $data) {

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data['id_siswa']);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['nis']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['level']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['jurusan']);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['sesi']);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['no_hp']);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['password']);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(5); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("DATA SISWA");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $object_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA SISWA '  . date('Y-m-d') . '.xlsx"');
        $object_writer->save('php://output');
    }
}
