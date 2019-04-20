<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }
//public variable
	private $column_user_order = array(null, 'ion_auth_users.username', 'ion_auth_users.email');
	private $column_user_search = array('ion_auth_users.username', 'ion_auth_users.email');
	private $order_user = array('ion_auth_users.id' => 'asc');

	private $column_product_order = array(null, 'nama_product', 'harga', 'deskripsi', 'gambar','diskon','status');
	private $column_product_search = array('nama_product', 'harga', 'deskripsi', 'gambar','diskon','status');
	private $order_product = array('id_product' => 'asc');

	private $column_pemesanan_order = array(null, 'a.id_pemesanan', 'a.waktu_pemesanan', 'a.status', 'b.username');
	private $column_pemesanan_search = array('a.id_pemesanan', 'a.waktu_pemesanan', 'a.status', 'b.username');
	private $pemesanan_order = array('id_pemesanan', 'asc');


//Top Rank
	public function getTopRank($par='quantity',$tanggal_awal=NULL,$tanggal_akhir=NULL) {
		$this->db->select('sum('.$par.') as top_rank, nama_product as nama_product');
		$this->db->from('laporan_penjualan');
		$this->db->group_by('nama_product');
		$this->db->order_by('top_rank', 'desc');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	
	public function statistik_penjualan($par='total_bersih',$tanggal_awal=NULL,$tanggal_akhir=NULL) {
		$this->db->select('sum('.$par.') as total_penjualan, month(eod) as waktu_penjualan');
		$this->db->from('laporan_penjualan');
		$this->db->group_by('waktu_penjualan');
		$this->db->order_by('waktu_penjualan', 'asc');
		return $this->db->get()->result_array();
	}
}