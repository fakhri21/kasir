<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Daftar_Struk extends CI_Model
{

    public $table = 'h_transaksi';
    public $id = 'uniqid';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('uniqid,id_transaksi,concat(prefix_bill,DATE_FORMAT(waktu_order,"%y%m"),id_metode,right(concat(prefix_number,id_transaksi),4))as id_bill,waktu_order,status');
        $this->datatables->from('h_transaksi');
        //add this line for join
        //$this->datatables->join('table2', 'Daftar_struk.field = table2.field');
        $this->datatables->add_column('action', anchor(base_url('daftar_struk/read/$1'),'Print Ulang'), 'uniqid');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Status print
    function status_print($id)
    {
		$this->db->where('uniqid',$id);
		$this->db->set('status_print','status_print+1',FALSE);
        $this->db->update('h_transaksi');
    }

    // get data by id
    function get_by_id($id,$jenis)
    {
        /* $this->db->select('
  							concat(prefix_bill,DATE_FORMAT(b.waktu_order,"%y%m"),b.id_metode,right(concat(prefix_number,id_transaksi),4))as id_bill,
							a.nama_meja,
							b.waktu_order,
                            b.id_metode,
							b.status_print,

							(`d`.`harga_jual` * `d`.`quantity`) AS `total_kotor`,
        					(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100) AS `nilai_pajak`,
        					(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100) AS `nilai_potongan`,
        					(((`d`.`harga_jual` * `d`.`quantity`) + (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100)) - (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100)) AS `total_bersih`,
                            d.harga_jual,
							d.quantity,
							d.diskon_persen,
							d.pajak as pajak_persen,
							
                            c.first_name as nama_customer,
							f.nama_jenis,
							e.nama_product,
							g.firstname as nama_kasir,
							h.firstname as nama_waiters,
                            i.*'); 
 		$this->db->from('h_transaksi b');
		$this->db->join('m_meja a','a.id_meja=b.id_meja','right');
		 */
        
        $this->db->select('*');
        $this->db->from('laporan_penjualan');
        
		$this->db->where('uniqid_transaksi',$id);
        if (!empty($jenis)) {
            $this->db->where('id_jenis',$jenis);
        }
		
		//$this->db->where('b.status',$status_bill);		
		//$this->db->join('m_customer c','c.uniqid=b.id_customer','left');
		//$this->db->join('detail_transaksi d','d.uniqid_transaksi=b.uniqid','inner');
		$this->db->where('void',0);
        /* $this->db->join('m_product e','d.id_product=e.id_product','left');
		$this->db->join('m_jenis f','e.id_jenis=f.id_jenis','left');
		$this->db->join('m_pekerja g','g.uniqid_login=b.id_kasir','left');
		$this->db->join('m_pekerja h','h.uniqid_login=b.id_waiters','left');
        $this->db->join('m_metode_pembayaran i','b.id_metode=i.id_metode','left'); */
		$this->db->order_by('id_jenis','ASC');
		return $this->db->get()->result_array();
		
    }
    //urut jenis

    function urut_jenis($id)
    {
        
        $this->db->select('id_jenis,nama_jenis');
        $this->db->from('m_jenis');
        $this->db->order_by('id_jenis', 'ASC');
        
        $header=$this->db->get()->result_array();
             $index=0;
        foreach ($header as $data) {
            $detail=$this->get_by_id($id,$data['id_jenis']);
            
            if ($detail<>NULL) {
				$header[$index]['detail']=$detail;
			}
			else {
				unset($header[$index]);
			}
            $index++;
        } 
        return array_values($header);
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('uniqid', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('nama_kategori', $q);
	$this->db->or_like('urutan', $q);
	$this->db->or_like('isi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('uniqid', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('nama_kategori', $q);
	$this->db->or_like('urutan', $q);
	$this->db->or_like('isi', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Model_kategori.php */
/* Location: ./application/models/Model_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */