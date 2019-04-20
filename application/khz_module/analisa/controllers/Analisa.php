<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Analisa extends CI_Controller {

    private $data_admin;

    public function __construct()
//parent construct
    {

        parent::__construct();
        $this->load->model(array('Model_Admin'));
        $this->load->library('datatables');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('nuris_helper');
        
    }

    public function index()

    {
        $this->template->load('template_admin','dashboard'); 
    }

    public function toprank() {

        $data['toprank'] = $this->Model_Admin->getTopRank();
        
        if ($_POST) {
            $status=$_POST['status'];
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
        $data['toprank'] = $this->Model_Admin->getTopRank($status,$tanggal_awal,$tanggal_akhir);
        }

        $data['toprank_name'] = array_column($data['toprank'],'nama_product');
        $data['toprank_value'] = array_column($data['toprank'],'top_rank');
        
        //print_r($data);
        $this->load->view('top_rank', $data);
        
    }

    public function statistik_penjualan() {

        $data['toprank'] = $this->Model_Admin->statistik_penjualan();
        
        if ($_POST) {
            $status=$_POST['status'];
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
        $data['toprank'] = $this->Model_Admin->statistik_penjualan($status,$tanggal_awal,$tanggal_akhir);
        }

        $data['toprank_waktu'] = array_column($data['toprank'],'waktu_penjualan');
        $data['toprank_value'] = array_column($data['toprank'],'total_penjualan');
        
        $this->load->view('statistik_penjualan', $data);
        
    }


}

