<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Kasir extends CI_Model {

/* Aksi */    
    
	
	function pemesanan($table,$data,$uniqid)
    {
        $this->db->set('uniqid',$uniqid);
		$this->db->insert($table,$data);
    }

	function detailpemesanan($table,$data,$uniqid)
	{
		$this->db->set('uniqid','UUID_SHORT()',FALSE);
		$this->db->set('uniqid_transaksi',$uniqid);
		$this->db->insert($table,$data);
	}
	
	
	
/* Kontent */
	function list_customer()
	{
		$this->db->select('*');
		$this->db->from('m_customer');
		return $this->db->get()->result_array();
	}
	
	function saldo_point($id_customer)
	{
		$this->db->select('	sum(debit*quantity) as total_debit,
							sum(kredit*quantity) as total_kredit,
        					sum(debit*quantity)-sum(kredit*quantity) as saldo');
		$this->db->where('id_customer', $id_customer);
		$this->db->from('laporan_point');
		return $this->db->get()->row_array();
		
	}
	
	function allproduct ()
	{	
		$this->db->select('*');
		$this->db->from('m_product_point a');
		$this->db->where('status',0);
		$this->db->order_by('nama_product', 'asc');
		return $this->db->get()->result_array();
		
	}





}