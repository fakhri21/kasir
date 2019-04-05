<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_meja extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_meja');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
        
    }

    public $nama_template='template_admin';

    public function index()
    {
        $this->template->load($this->nama_template,'m_meja/m_meja_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_meja->json();
    }

    public function read($id) 
    {
        $row = $this->Model_meja->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_meja' => $row->id_meja,
		'urutan' => $row->urutan,
		'nama_meja' => $row->nama_meja,
		'harga_tambahan_meja' => $row->harga_tambahan_meja,
		'status' => $row->status,
		'kondisi' => $row->kondisi,
	    );
            $this->template->load($this->nama_template,'m_meja/m_meja_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_meja'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('m_meja/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_meja' => set_value('id_meja'),
	    'urutan' => set_value('urutan'),
	    'nama_meja' => set_value('nama_meja'),
	    'harga_tambahan_meja' => set_value('harga_tambahan_meja'),
	    'status' => set_value('status'),
	    'kondisi' => set_value('kondisi'),
	);
        $this->template->load($this->nama_template,'m_meja/m_meja_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_meja' => $this->input->post('id_meja',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'nama_meja' => $this->input->post('nama_meja',TRUE),
		'harga_tambahan_meja' => $this->input->post('harga_tambahan_meja',TRUE),
		'status' => $this->input->post('status',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
	    );

            $this->Model_meja->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_meja'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_meja->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('m_meja/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_meja' => set_value('id_meja', $row->id_meja),
		'urutan' => set_value('urutan', $row->urutan),
		'nama_meja' => set_value('nama_meja', $row->nama_meja),
		'harga_tambahan_meja' => set_value('harga_tambahan_meja', $row->harga_tambahan_meja),
		'status' => set_value('status', $row->status),
		'kondisi' => set_value('kondisi', $row->kondisi),
	    );
            $this->template->load($this->nama_template,'m_meja/m_meja_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_meja'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_meja' => $this->input->post('id_meja',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'nama_meja' => $this->input->post('nama_meja',TRUE),
		'harga_tambahan_meja' => $this->input->post('harga_tambahan_meja',TRUE),
		'status' => $this->input->post('status',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
	    );

            $this->Model_meja->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_meja'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_meja->get_by_id($id);

        if ($row) {
            $this->Model_meja->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_meja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_meja'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_meja', 'id meja', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	$this->form_validation->set_rules('nama_meja', 'nama meja', 'trim|required');
	$this->form_validation->set_rules('harga_tambahan_meja', 'harga tambahan meja', 'trim|required|numeric');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('kondisi', 'kondisi', 'trim|required');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file M_meja.php */
/* Location: ./application/controllers/M_meja.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-01-31 04:27:25 */
/* http://harviacode.com */