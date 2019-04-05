<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_jenis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_jenis');
        $this->load->library('form_validation');
        $this->load->helper('nuris_helper');
                
	$this->load->library('datatables');
    $user = wp_get_current_user();
        if ( !in_array( 'administrator', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            }
        
    }
    public $nama_template='template_admin';

    public function index()
    {
        $this->template->load($this->nama_template,'m_jenis/m_jenis_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_jenis->json();
    }

    public function read($id) 
    {
        $row = $this->Model_jenis->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_jenis' => $row->id_jenis,
		'nama_jenis' => $row->nama_jenis,
		'urutan' => $row->urutan,
		'coa' => $row->id_coa,
		'coa_potongan' => $row->id_coa_potongan,
	    );
            $this->template->load($this->nama_template,'m_jenis/m_jenis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_jenis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('m_jenis/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_jenis' => set_value('id_jenis'),
	    'nama_jenis' => set_value('nama_jenis'),
	    'id_coa' => set_value('coa'),
	    'id_coa_potongan' => set_value('coa_potongan'),
	);
        $this->template->load($this->nama_template,'m_jenis/m_jenis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_jenis' => $this->input->post('id_jenis',TRUE),
		'nama_jenis' => $this->input->post('nama_jenis',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'id_coa' => $this->input->post('coa',TRUE),
		'id_coa_potongan' => $this->input->post('coa_potongan',TRUE),
	    );

            $this->Model_jenis->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_jenis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_jenis->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('m_jenis/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_jenis' => set_value('id_jenis', $row->id_jenis),
		'nama_jenis' => set_value('nama_jenis', $row->nama_jenis),
		'urutan' => set_value('urutan', $row->urutan),
        'coa' => set_value('coa',$row->id_coa),
	    'coa_potongan' => set_value('coa_potongan',$row->id_coa_potongan),
	    );
            $this->template->load($this->nama_template,'m_jenis/m_jenis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_jenis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_jenis' => $this->input->post('id_jenis',TRUE),
		'nama_jenis' => $this->input->post('nama_jenis',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
	    'id_coa' => $this->input->post('coa',TRUE),
		'id_coa_potongan' => $this->input->post('coa_potongan',TRUE)
        );

            $this->Model_jenis->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_jenis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_jenis->get_by_id($id);

        if ($row) {
            $this->Model_jenis->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_jenis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_jenis', 'id jenis', 'trim|required');
	$this->form_validation->set_rules('nama_jenis', 'nama jenis', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	
	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file M_jenis.php */
/* Location: ./application/controllers/M_jenis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-01-31 04:17:14 */
/* http://harviacode.com */