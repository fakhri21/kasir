<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_product');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->helper('nuris_helper');
        $this->uniqid_user=$this->ion_auth->user()->row()->uniqid;
       $user = wp_get_current_user();
       if ( !in_array( 'administrator', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            }
        

        
    }

    public $nama_template='template_admin';
    public $uniqid_user='$this->ion_auth->get_users_groups()->row()->id';

    public function index()
    {
        $this->template->load($this->nama_template,'m_product/m_product_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_product->json();
    }

    public function read($id) 
    {
        $row = $this->Model_product->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_product' => $row->id_product,
		'id_kategori' => $row->id_kategori,
		'id_jenis' => $row->id_jenis,
		'nama_product' => $row->nama_product,
		'harga' => $row->harga,
		'deskripsi' => $row->deskripsi,
		'gambar' => $row->gambar,
		'discount' => $row->discount,
		'tgl_dibuat' => $row->tgl_dibuat,
		'user_pembuat' => $row->user_pembuat,
		'status' => $row->status,
	    );
            $this->template->load($this->nama_template,'m_product/m_product_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_product'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('m_product/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_product' => set_value('id_product'),
	    'id_kategori' => set_value('id_kategori'),
	    'id_jenis' => set_value('id_jenis'),
	    'nama_product' => set_value('nama_product'),
	    'harga' => set_value('harga'),
	    'deskripsi' => set_value('deskripsi'),
	    'gambar' => set_value('gambar'),
	    'discount' => set_value('discount'),
	    'tgl_dibuat' => set_value('tgl_dibuat'),
	    'user_pembuat' => set_value('user_pembuat'),
	    'status' => set_value('status'),
	);
        $this->template->load($this->nama_template,'m_product/m_product_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $config['upload_path']          = './img_product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } 
        else {

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('upload_failed', $this->upload->display_errors());
                $this->create();
                
            }
            else {
                if ($this->upload->data()) {
                
                    $data = array(
                'id_product' => $this->input->post('id_product',TRUE),
                'id_kategori' => $this->input->post('id_kategori',TRUE),
                'id_jenis' => $this->input->post('id_jenis',TRUE),
                'nama_product' => $this->input->post('nama_product',TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'gambar' => $this->upload->data()['file_name'],
                'discount' => $this->input->post('discount',TRUE),
                //'tgl_dibuat' => $this->input->post('tgl_dibuat',TRUE),
                'user_pembuat' => $this->uniqid_user,
                'status' => $this->input->post('status',TRUE),
                );

                    $this->Model_product->insert($data);
                    $this->session->set_flashdata('message', 'Create Record Success');
                    redirect(base_url('m_product'));
                }
                
                else {
                    $this->session->set_flashdata('upload_failed', $this->upload->display_errors());
                    $this->create();
                }

        }
        
        }
        
    }
    
    public function update($id) 
    {
        $row = $this->Model_product->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('m_product/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_product' => set_value('id_product', $row->id_product),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'id_jenis' => set_value('id_jenis', $row->id_jenis),
		'nama_product' => set_value('nama_product', $row->nama_product),
		'harga' => set_value('harga', $row->harga),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'gambar' => set_value('gambar', $row->gambar),
		'discount' => set_value('discount', $row->discount),
		'tgl_dibuat' => set_value('tgl_dibuat', $row->tgl_dibuat),
		'user_pembuat' => set_value('user_pembuat', $row->user_pembuat),
		'status' => set_value('status', $row->status),
	    );
            $this->template->load($this->nama_template,'m_product/m_product_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_product'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $config['upload_path']          = './img_product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_product' => $this->input->post('id_product',TRUE),
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'id_jenis' => $this->input->post('id_jenis',TRUE),
		'nama_product' => $this->input->post('nama_product',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'discount' => $this->input->post('discount',TRUE),
		//'tgl_dibuat' => $this->input->post('tgl_dibuat',TRUE),
		//'user_pembuat' => $this->input->post('user_pembuat',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

        $record_uniqid=$this->input->post('uniqid', TRUE);

        if ($_FILES['gambar']['name']) {
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('upload_failed', $this->upload->display_errors());
                redirect(base_url('m_product/update/'.$record_uniqid.''));
                
                
            } else {
                if ($this->upload->data()) {
                    $data['gambar']=$_FILES['gambar']['name'];
                }
                else {
                    $this->session->set_flashdata('upload_failed', $this->upload->display_errors());
                    redirect(base_url('m_product/update/'.$record_uniqid.''));
               
                }
            }
        }

            $this->Model_product->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_product'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_product->get_by_id($id);

        if ($row) {
            $this->Model_product->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_product'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_product', 'id product', 'trim|required');
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('id_jenis', 'id jenis', 'trim|required');
	$this->form_validation->set_rules('nama_product', 'nama product', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim');
	$this->form_validation->set_rules('discount', 'discount', 'trim|numeric');
	
	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    

}

/* End of file M_product.php */
/* Location: ./application/controllers/M_product.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-01-27 09:43:23 */
/* http://harviacode.com */