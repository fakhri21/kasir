<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_struk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Daftar_Struk');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public $nama_template='template_admin';

    public function index()
    {
        $this->template->load($this->nama_template,'daftar_struk/daftar_struk_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_Daftar_Struk->json();
    }

    public function read($id) 
    {
        //$data_print = $this->Model_Daftar_Struk->get_by_id($id);
        $this->Model_Daftar_Struk->status_print($id);
        $data_print = $this->Model_Daftar_Struk->urut_jenis($id);
        $data['title']='Struk';
        $data['print']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('struk', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper(array(0,0,220,1250));
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
         
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('daftar_struk'));
        }
    }

    
    public function _rules() 
    {
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file daftar_struk.php */
/* Location: ./application/controllers/M_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */