<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kategori');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    $user = wp_get_current_user();
    if ( !in_array( 'administrator', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            }
        
    }

    public $nama_template='template_admin';

    public function index()
    {
        $this->template->load($this->nama_template,'m_kategori/m_kategori_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_kategori->json();
    }

    public function read($id) 
    {
        $row = $this->Model_kategori->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_kategori' => $row->id_kategori,
		'nama_kategori' => $row->nama_kategori,
		'urutan' => $row->urutan,
		'isi' => $row->isi,
	    );
            $this->template->load($this->nama_template,'m_kategori/m_kategori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kategori'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('m_kategori/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_kategori' => set_value('id_kategori'),
	    'nama_kategori' => set_value('nama_kategori'),
	    'urutan' => set_value('urutan'),
	    'isi' => set_value('isi'),
	);
        $this->template->load($this->nama_template,'m_kategori/m_kategori_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'isi' => $this->input->post('isi',TRUE),
	    );

            $this->Model_kategori->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_kategori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_kategori->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('m_kategori/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),
		'urutan' => set_value('urutan', $row->urutan),
		'isi' => set_value('isi', $row->isi),
	    );
            $this->template->load($this->nama_template,'m_kategori/m_kategori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kategori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'isi' => $this->input->post('isi',TRUE),
	    );

            $this->Model_kategori->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_kategori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_kategori->get_by_id($id);

        if ($row) {
            $this->Model_kategori->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kategori'));
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

/* End of file M_kategori.php */
/* Location: ./application/controllers/M_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */