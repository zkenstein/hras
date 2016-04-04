<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
* BPJS Controllers
 *
 * @package     HRA CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */
class Bpjs extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Bpjs_model', 'Activity_log_model'));
        $this->load->helper('string');
    }

    // Bpjs view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $f = $this->input->get(NULL, TRUE);

        $data['f'] = $f;

        $params = array();
        // Nip
        if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
            $params['bpjs_npp'] = $f['n'];
        }

        // Nip
        if (isset($f['k']) && !empty($f['k']) && $f['k'] != '') {
            $params['bpjs_ktp'] = $f['k'];
        }
        
        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['bpjs'] = $this->Bpjs_model->get($params);

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/bpjs/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Bpjs_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'BPJS';
        $data['main'] = 'admin/bpjs/bpjs_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {        
        if ($this->Bpjs_model->get(array('id' => $id)) == NULL) {
            redirect('admin/bpjs');
        }
        $data['bpjs'] = $this->Bpjs_model->get(array('id' => $id));        
        $data['title'] = 'Detail Bpjs';
        $data['main'] = 'admin/bpjs/bpjs_view';
        $this->load->view('admin/layout', $data);
    }
    

    // Add Bpjs and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bpjs_noka', 'Noka', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_ktp', 'Ktp', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_npp', 'NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_name', 'Nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_hub', 'Hub Kel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_tmt', 'TMT Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_faskes', 'Faskes', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bpjs_kelas', 'Kelas', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('bpjs_id')) {
                $params['bpjs_id'] = $this->input->post('bpjs_id');
            } else {                
                $params['bpjs_noka'] = $this->input->post('bpjs_noka');
            }

            $params['bpjs_ktp'] = $this->input->post('bpjs_ktp');
            $params['bpjs_npp'] = $this->input->post('bpjs_npp');
            $params['bpjs_name'] = stripslashes($this->input->post('bpjs_name'));
            $params['bpjs_hub'] = stripslashes($this->input->post('bpjs_hub'));
            $params['bpjs_date'] = $this->input->post('bpjs_date');
            $params['bpjs_tmt'] = $this->input->post('bpjs_tmt');            
            $params['bpjs_faskes'] = $this->input->post('bpjs_faskes'); 
            $params['bpjs_kelas'] = $this->input->post('bpjs_kelas');         
            $status = $this->Bpjs_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                array(
                    'log_date' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->userdata('user_id'),
                    'log_module' => 'BPJS',
                    'log_action' => $data['operation'],
                    'log_info' => 'ID:'.$status.';Title:' . $params['bpjs_name']
                    )
                );

            $this->session->set_flashdata('success', $data['operation'] . ' BPJS berhasil');
            redirect('admin/bpjs');
        } else {
            if ($this->input->post('bpjs_id')) {
                redirect('admin/bpjs/edit/' . $this->input->post('bpjs_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['bpjs'] = $this->Bpjs_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' BPJS';
            $data['main'] = 'admin/bpjs/bpjs_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Bpjs
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Bpjs_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                array(
                    'log_date' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->userdata('user_id'),
                    'log_module' => 'BPJS',
                    'log_action' => 'Hapus',
                    'log_info' => 'ID:' . $this->input->post('del_id') . ';Title:' . $this->input->post('del_name')
                    )
                );
            $this->session->set_flashdata('success', 'Hapus Bpjs berhasil');
            redirect('admin/bpjs');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/bpjs/edit/' . $id);
        }
    }

    function multiple() {
        $action = $this->input->post('action');
        if ($action == "delete") {
            $delete = $this->input->post('msg');
            for ($i = 0; $i < count($delete); $i++) {
                $this->Bpjs_model->delete($delete[$i]);
            }
        } elseif ($action == "printPdf") {
            $this->load->helper(array('dompdf'));
            $this->load->helper(array('tanggal'));
            $bpjsk = $this->input->post('msg');
            for ($i = 0; $i < count($bpjsk); $i++) {
                $print[] = $bpjsk[$i];
            }
            $data['bpjs'] = $this->Bpjs_model->get(array('multiple_id' => $print));

            for($i = 0; $i < count($data['bpjs']); $i++ ){
            $this->barcode2($data['bpjs'][$i]['bpjs_noka'], '');
        }
            $html = $this->load->view('admin/bpjs/bpjs_multiple_pdf', $data, true);
            $data = pdf_create($html, 'HRD_BPJS_'.date('d_m_Y'), TRUE, [0,0,325,620], 'landscape');
        }   
        elseif ($action == "cetak") {
            $cetak = $this->input->post('msg');
            for ($i = 0; $i < count($cetak); $i++) {
                $this->Bpjs_model->add(array('bpjs_id' => $cetak[$i], 'bpjs_cetak' => 1));
                $this->session->set_flashdata('success', 'Sunting Cetak berhasil');
            }
        }
        redirect('admin/bpjs');
    }


    function printPdf($id = NULL) {
        $this->load->helper(array('dompdf'));
        $this->load->helper(array('tanggal'));
        if ($id == NULL)
            redirect('admin/bpjs');

        $data['bpjs'] = $this->Bpjs_model->get(array('id' => $id));
        $this->barcode2($data['bpjs']['bpjs_noka'], '');

        $html = $this->load->view('admin/bpjs/bpjs_pdf', $data, true);
        $data = pdf_create($html, $data['bpjs']['bpjs_name'], TRUE, [0,0,325,620], 'landscape');
    }

    function cetak($id = NULL) {
        $this->Bpjs_model->add(array('bpjs_id' => $id, 'bpjs_cetak' => 1));
        $this->session->set_flashdata('success', 'Sunting Cetak berhasil');
        redirect('admin/bpjs');
    }
   

    private function barcode2($sparepart_code, $barcode_type=39, $scale=6, $fontsize=1, $thickness=30,$dpi=72) {
    // CREATE BARCODE GENERATOR
    // Including all required classes
    require_once( APPPATH . 'libraries/barcodegen/BCGFontFile.php');
    require_once( APPPATH . 'libraries/barcodegen/BCGColor.php');
    require_once( APPPATH . 'libraries/barcodegen/BCGDrawing.php');

    // Including the barcode technology
    // Ini bisa diganti-ganti mau yang 39, ato 128, dll, liat di folder barcodegen
    require_once( APPPATH . 'libraries/barcodegen/BCGcode39.barcode.php');

    // Loading Font
    // kalo mau ganti font, jangan lupa tambahin dulu ke folder font, baru loadnya di sini
    $font = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);
    
    // Text apa yang mau dijadiin barcode, biasanya kode produk
    $text = $sparepart_code;

    // The arguments are R, G, B for color.
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode39(); // kalo pake yg code39, klo yg lain mesti disesuaikan
        $code->setScale($scale); // Resolution
        $code->setThickness($thickness); // Thickness
        $code->setForegroundColor($color_black); // Color of bars
        $code->setBackgroundColor($color_white); // Color of spaces
        $code->setFont($font); // Font (or 0)
        $code->parse($text); // Text
    } catch(Exception $exception) {
        $drawException = $exception;
    }

    /* Here is the list of the arguments
    1 - Filename (empty : display on screen)
    2 - Background color */
    $drawing = new BCGDrawing('', $color_white);
    if($drawException) {
        $drawing->drawException($drawException);
    } else {
        $drawing->setDPI($dpi);
        $drawing->setBarcode($code);
        $drawing->draw();
    }
    // ini cuma labeling dari sisi aplikasi saya, penamaan file menjadi png barcode.
    $filename_img_barcode = $sparepart_code .'_'.$barcode_type.'.png';
    // folder untuk menyimpan barcode
    $drawing->setFilename( FCPATH .'uploads/bpjs/'. $sparepart_code.'.png');
    // proses penyimpanan barcode hasil generate
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    return $filename_img_barcode;
}

}

/* End of file bpjs.php */
/* Location: ./application/controllers/admin/bpjs.php */
