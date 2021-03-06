<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_tipe_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_tipe_pembayaran');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    
    }

    public function index()
    {
        $this->load->view('m_tipe_pembayaran/m_tipe_pembayaran_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_tipe_pembayaran->json();
    }

    public function read($id) 
    {
        $row = $this->Model_tipe_pembayaran->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tipe' => $row->id_tipe,
		'nama_tipe' => $row->nama_tipe,
	    );
            $this->load->view('m_tipe_pembayaran/m_tipe_pembayaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_tipe_pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => base_url('m_tipe_pembayaran/create_action'),
	    'id_tipe' => set_value('id_tipe'),
	    'nama_tipe' => set_value('nama_tipe'),
	);
        $this->load->view('m_tipe_pembayaran/m_tipe_pembayaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_tipe' => $this->input->post('nama_tipe',TRUE),
	    );

            $this->Model_tipe_pembayaran->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_tipe_pembayaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_tipe_pembayaran->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => base_url('m_tipe_pembayaran/update_action'),
		'id_tipe' => set_value('id_tipe', $row->id_tipe),
		'nama_tipe' => set_value('nama_tipe', $row->nama_tipe),
	    );
            $this->load->view('m_tipe_pembayaran/m_tipe_pembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_tipe_pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tipe', TRUE));
        } else {
            $data = array(
		'nama_tipe' => $this->input->post('nama_tipe',TRUE),
	    );

            $this->Model_tipe_pembayaran->update($this->input->post('id_tipe', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_tipe_pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_tipe_pembayaran->get_by_id($id);

        if ($row) {
            $this->Model_tipe_pembayaran->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_tipe_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_tipe_pembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_tipe', 'nama tipe', 'trim|required');

	$this->form_validation->set_rules('id_tipe', 'id_tipe', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file M_tipe_pembayaran.php */
/* Location: ./application/controllers/M_tipe_pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 08:16:00 */
/* http://harviacode.com */