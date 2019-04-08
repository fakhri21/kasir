<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Kasir extends CI_Model {

/* Aksi */    
    public function buka_kasir()
    {
        $this->db->where_in('nama_konfigurasi','buka_kasir');
        $this->db->set('isi','CURRENT_DATE()',FALSE);
        $this->db->update('konfigurasi');
        
    }

    public function eod($table,$data)
    {
        $this->db->where('DATE(eod)<=DATE(0) ');
        $this->db->set('eod',$data);
        $this->db->update($table);
        
		$this->db->set('status',0);
        $this->db->update('m_meja');

        $this->db->where_in('nama_konfigurasi','buka_kasir');
        $this->db->set('isi','');
        $this->db->update('konfigurasi');
        
        
    }

	function bookingmeja($meja,$status)
	{
		$this->db->update('m_meja',array('status' =>$status ),array('id_meja' =>$meja  ));
	}

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
	
	function tambahpoint($table,$data,$uniqid)
	{
		$this->db->set('uniqid','UUID_SHORT()',FALSE);
		$this->db->set('uniqid_transaksi',$uniqid);
		$this->db->insert($table,$data);
	}

    function tambahan_discount($discount,$uniqid)
	{
		
		$this->db->where('uniqid_transaksi', $uniqid);
		$this->db->set('diskon_persen',$discount);
		$this->db->update('detail_transaksi');
		 

		 /* $sql="UPDATE detail_transaksi d 
				 SET d.potongan = (quantity*harga_jual)*'.$discount.'/100,d.diskon_persen = '.$discount.' 
				 WHERE d.uniqid_transaksi='.$uniqid.'";
		$this->db->query($sql);
		 */
	}
    
	function tambah_pajak($pajak,$uniqid)
	{
		$this->db->where('uniqid_transaksi', $uniqid);
		$this->db->set('pajak',$pajak);
		$this->db->update('detail_transaksi');
		 

		 /* $sql="UPDATE detail_transaksi d 
				 SET d.potongan = (quantity*harga_jual)*'.$discount.'/100,d.diskon_persen = '.$discount.' 
				 WHERE d.uniqid_transaksi='.$uniqid.'";
		$this->db->query($sql);
		 */
	}

	// void
    function void_item($uniqid)
    {
		$this->db->where('uniqid',$uniqid);
        if ($this->db->update('detail_transaksi',array('void' =>1))) {
			return TRUE;
		}
		
    }

	// Status print
    function status_print($uniqid)
    {
		$this->db->where('uniqid',$uniqid);
		$this->db->set('status_print','status_print+1',FALSE);
        $this->db->update('h_transaksi');
    }

	function checkout($uniqid,$data)
	{
		
		$this->db->where('uniqid', $uniqid);
		$this->db->update('h_transaksi',$data);
	}

	function jurnal_penjualan_header($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function jurnal_penjualan($table,$data,$uniqid_header)
	{
		
		$this->db->set('uniqid','UUID_SHORT()',FALSE);
		$this->db->set('uniqid_voucher',$uniqid_header);
		$this->db->insert($table,$data);
	}

	function id_atasan($email)
	{
		$this->db->where('email', $email);
		$id=$this->db->get('pekerja_atasan')->row();
		return $id->id;
	}
	
	function cek_pangkat($email,$pangkat)
	{
		$this->db->where('email', $email);
		$this->db->where('nama_group', $pangkat);
		return $this->db->get('pekerja_atasan')->num_rows();
	}

/* Kontent */

	function get_count_penjualan() {
		return $this->db->get('laporan_penjualan')->num_rows();
	}

	function get_count_penjualan_hari_ini() {
		$this->db->where('date(eod)=0');
		return $this->db->get('laporan_penjualan')->num_rows();
	}

	function list_customer()
	{
		$this->db->select('*');
		$this->db->from('m_customer');
		return $this->db->get()->result_array();
		
	}

	function billmeja($id_meja)
	{
		$this->db->select('a.id_meja,
							a.nama_meja,
							concat(prefix_bill,DATE_FORMAT(b.waktu_order,"%y%m"),b.id_metode,right(concat(prefix_number,id_transaksi),4))as id_bill,
							b.uniqid,
							b.id_transaksi,
							b.waktu_order,
							(`d`.`harga_jual` * `d`.`quantity`) AS `total_kotor`,
        					(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100) AS `nilai_pajak`,
        					(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100) AS `nilai_potongan`,
        					(((`d`.`harga_jual` * `d`.`quantity`) + (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100)) - (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100)) AS `total_bersih`,
							d.uniqid as uniqid_item,
							d.harga_jual,
							d.quantity,
							d.pajak,
							e.nama_product,
							f.*');
		$this->db->from('h_transaksi b');
		$this->db->join('m_meja a','a.id_meja=b.id_meja','right');
		
		$this->db->where('a.id_meja',$id_meja);
		$this->db->where('date(b.eod)=date(0)');
		$this->db->where('b.status',0);
		if ($id_meja<>0) {
			$this->db->where('a.status',1);
		}		
		//$this->db->join('m_customer c','c.username=b.id_customer','right');
		$this->db->join('detail_transaksi d','d.uniqid_transaksi=b.uniqid','left');
		$this->db->where('d.void',0);
		$this->db->join('m_product e','d.id_product=e.id_product','left');
		$this->db->join('m_metode_pembayaran f','b.id_metode=f.id_metode','left');
		$this->db->order_by('b.waktu_order', 'desc');
		return $this->db->get()->result_array();
		
		//this->db->join('Table', 'table.column = table.column', 'left');
		
	}

	function tampilbill($uniqid,$id_jenis) //print
	{
		$this->db->select('
							concat(prefix_bill,DATE_FORMAT(b.waktu_order,"%y%m"),b.id_metode,right(concat(prefix_number,id_transaksi),4))as id_bill,
							a.nama_meja,
							b.waktu_order,
							b.status_print,

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
		
		$this->db->where('b.uniqid',$uniqid);
		//$this->db->where('b.status',$status_bill);		
		$this->db->join('m_customer c','c.uniqid=b.id_customer','left');
		$this->db->join('detail_transaksi d','d.uniqid_transaksi=b.uniqid','inner');
		$this->db->join('m_product e','d.id_product=e.id_product','left');
		$this->db->join('m_jenis f','e.id_jenis=f.id_jenis','left');
		$this->db->join('m_pekerja g','g.uniqid_login=b.id_kasir','left');
		$this->db->join('m_pekerja h','h.uniqid_login=b.id_waiters','left');
		$this->db->join('m_metode_pembayaran i','b.id_metode=i.id_metode','left');
		$this->db->where('f.id_jenis',$id_jenis);
		$this->db->where('d.void',0);
		$this->db->order_by('f.id_jenis','ASC');
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
            $detail=$this->tampilbill($id,$data['id_jenis']);
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


	function kelompok_jenis($uniqid)
	{
		$this->db->select('total_kotor as total_harga ,
							nilai_potongan as total_potongan,
							f.nama_jenis,
							nama_product,
							f.id_coa_potongan,
							f.id_coa');
		$this->db->from('laporan_penjualan b');
		$this->db->join('m_jenis f','b.id_jenis=f.id_jenis','inner');
		$this->db->where('b.uniqid',$uniqid);		
		
		$this->db->group_by('f.id_jenis');
		
		return $this->db->get()->result_array();
		
	}

	function tampilmeja()
	{
		$this->db->select('id_meja as id_meja,nama_meja as nama_meja,urutan as urutan,status as status') ;
		$this->db->from('m_meja');
		$this->db->order_by('urutan');
		return $this->db->get()->result_array();
	}

	function tampilmetode()
	{
		$this->db->select('*');
		$this->db->from('m_metode_pembayaran');
		$this->db->where('id_metode<>1');
		$this->db->order_by('id_metode');
		return $this->db->get()->result_array();
	}

	function allproduct ()
	{
	
		$this->db->select('a.id_product,a.nama_product,a.harga,a.id_kategori,a.gambar,a.status,a.id_jenis,a.discount,harga-(harga*a.discount/100) as harga_jual');
		$this->db->from('m_product a');
		$this->db->where('status',0);
		$this->db->order_by('nama_product', 'asc');
		return $this->db->get()->result_array();
		
	}





}