<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class konfigurasi
{
     public function __construct() {
    //$this->config->load('Konfigurasi', TRUE);
    //$this->load->model('ion_auth_model');
    $this->CI =& get_instance();
    $this->CI->load->model('Model_Konfigurasi');
   
    }
 
    public function tes()
    {
        echo "Tes";
    }
    public function coa_kas()
    {
        $data=$this->CI->Model_Konfigurasi->get_coa_kas();
        return $data['isi'];
    }
    
    public function penyetuju_jurnal()
    {
        $data=$this->Model_Konfigurasi->get_penyetuju_jurnal();
        return $data['nama'];
    }
    
    public function pemeriksa_jurnal()
    {
        $data=$this->Model_Konfigurasi->get_penyetuju_jurnal();
        return $data['nama'];
    }
    
    public function facebook()
    {
        $data=$this->Model_Konfigurasi->get_facebook();
        return $data['isi'];
    }
    
    public function twitter()
    {
        $data=$this->Model_Konfigurasi->get_twitter();
        return $data['isi'];
    }
    
    public function blogger()
    {
        $data=$this->Model_Konfigurasi->get_blogger();
        return $data['isi'];
    }
    
    public function email()
    {
        $data=$this->Model_Konfigurasi->get_email();
        return $data['isi'];
    }
    
    public function maps()
    {
        $data=$this->Model_Konfigurasi->get_maps();
        return $data['isi'];
    }
    
    public function instagram()
    {
        $data=$this->Model_Konfigurasi->get_instagram();
        return $data['isi'];
    }
    
    public function priode_harian_akuntansi()
    {
        $data=$this->CI->Model_Konfigurasi->get_priode_harian_akuntansi();
        return $data;
    }
    
    public function priode_harian_kasir()
    {
        $data=$this->CI->Model_Konfigurasi->get_priode_harian_kasir();
        return $data['isi'];
    }
    
    
}
