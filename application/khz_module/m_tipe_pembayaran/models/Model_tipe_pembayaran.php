<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_tipe_pembayaran extends CI_Model
{

    public $table = 'm_tipe_pembayaran';
    public $id = 'id_tipe';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_tipe,nama_tipe');
        $this->datatables->from('m_tipe_pembayaran');
        //add this line for join
        //$this->datatables->join('table2', 'm_tipe_pembayaran.field = table2.field');
        $this->datatables->add_column('action', anchor(base_url('m_tipe_pembayaran/read/$1'),'Read')." | ".anchor(base_url('m_tipe_pembayaran/update/$1'),'Update')." | ".anchor(base_url('m_tipe_pembayaran/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_tipe');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_tipe', $q);
	$this->db->or_like('nama_tipe', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_tipe', $q);
	$this->db->or_like('nama_tipe', $q);
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

/* End of file Model_tipe_pembayaran.php */
/* Location: ./application/models/Model_tipe_pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 08:16:00 */
/* http://harviacode.com */