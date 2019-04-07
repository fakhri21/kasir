<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Laporan');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->helper('nuris_helper');
    }

    public $nama_template='template_admin';

    public function index()
    {
        $data['data_jenis']=$this->Model_Laporan->get_jenis();
        $this->template->load($this->nama_template,'laporan',$data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_Laporan->json();
    }

    public function pdf_penjualan() 
    {
        $w_awal=NULL;
        $w_akhir=NULL;
        $jenis=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".get_gmt_from_date($_POST['tanggal_awal'])."\'");
            $w_akhir= stripslashes("\'".get_gmt_from_date($_POST['tanggal_akhir'])."\'");
            $status= $_POST['status'];
        }

        if ($_POST['id_jenis']) {
            $jenis=$_POST['id_jenis'];
        }

        $data_print = $this->Model_Laporan->laporan_penjualan($w_awal,$w_akhir,$jenis,$status);
        $data['title']='Laporan Penjualan';
        $data['w_awal']=$_POST['tanggal_awal'];
        $data['w_akhir']=$_POST['tanggal_akhir'];

        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('pdf_penjualan', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('daftar_struk'));
        }
    }

    public function excel_penjualan()
    {
        
        $this->load->helper('exportexcel_helper');
        $namaFile = "Daftar_penjualan.xls";
        $judul = "Daftar_penjualan";
        $w_akhir=NULL;
        $w_awal=NULL;
        $jenis=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".get_gmt_from_date($_POST['tanggal_awal'])."\'");
            $w_akhir= stripslashes("\'".get_gmt_from_date($_POST['tanggal_akhir'])."\'");
            $status= $_POST['status'];
        }

        if ($_POST['id_jenis']) {
            $jenis=$_POST['id_jenis'];
        }
        

        $detail=$this->Model_Laporan->laporan_penjualan($w_awal,$w_akhir,$jenis,$status);
        $w_awal=$_POST['tanggal_awal'];
        $w_akhir=$_POST['tanggal_akhir'];

    

        $tablehead = 4;
        $tablebody = $tablehead+1;
        $nourut = 1;
        
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
    xlsWriteLabel(0, 0, "Laporan Penjualan");
    xlsWriteLabel(1, 0, "Periode ".$w_awal." s/d ".$w_akhir." ");

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	
    xlsWriteLabel($tablehead, $kolomhead++, "Id Penjualan");
    xlsWriteLabel($tablehead, $kolomhead++, "Hari");
    xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
    xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Waiters");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Kasir");
    xlsWriteLabel($tablehead, $kolomhead++, "Metode");
    xlsWriteLabel($tablehead, $kolomhead++, "Tipe Pembayaran");
    xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
    xlsWriteLabel($tablehead, $kolomhead++, "Id produk");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Produk");
    xlsWriteLabel($tablehead, $kolomhead++, "Harga Jual");
    xlsWriteLabel($tablehead, $kolomhead++, "Quantity");
    xlsWriteLabel($tablehead, $kolomhead++, "Total Kotor");
    xlsWriteLabel($tablehead, $kolomhead++, "Tambahan Potongan (%)");
    xlsWriteLabel($tablehead, $kolomhead++, "Tambahan Potongan (Rp)");
    xlsWriteLabel($tablehead, $kolomhead++, "Pajak (%)");
    xlsWriteLabel($tablehead, $kolomhead++, "Pajak (Rp)");
    xlsWriteLabel($tablehead, $kolomhead++, "Total Bersih");
    
	$grand_total=0;
    $gt_tabelbody=0;
    $gt_kolombody=0;
    
    foreach ($detail as $data)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $data) {
            {

            $kolombody = 0;
            $grand_total=$grand_total+$data['total_bersih'];

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++,$data['id_bill']);
        xlsWriteLabel($tablebody, $kolombody++,$data['hari']);
        xlsWriteLabel($tablebody, $kolombody++,$data['waktu']);
        xlsWriteLabel($tablebody, $kolombody++,$data['tanggal']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_waiters']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_kasir']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_metode']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_tipe']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_jenis']);
        xlsWriteLabel($tablebody, $kolombody++,$data['id_product']);
        xlsWriteLabel($tablebody, $kolombody++,$data['nama_product']);
        xlsWriteNumber($tablebody, $kolombody++,$data['harga_jual']);
        xlsWriteNumber($tablebody, $kolombody++,$data['quantity']);
        xlsWriteNumber($tablebody, $kolombody++,$data['harga_jual']*$data['quantity']);
        xlsWriteNumber($tablebody, $kolombody++,$data['diskon_persen']);
        xlsWriteNumber($tablebody, $kolombody++,$data['nilai_potongan']);
        xlsWriteNumber($tablebody, $kolombody++,$data['pajak_persen']);
        xlsWriteNumber($tablebody, $kolombody++,$data['nilai_pajak']);
        xlsWriteNumber($tablebody, $kolombody++,$data['total_bersih']);                    

	    $tablebody++;
            $nourut++;

        $gt_tabelbody=$tablebody;
        $gt_kolombody=$kolombody-1;
        }

        xlsWriteLabel($gt_tabelbody, 1, 'Grand Total');
        xlsWriteNumber($gt_tabelbody, $gt_kolombody, $grand_total);



        xlsEOF();
        exit();
    }

    public function pdf_serah_terima_penjualan() 
    {
        $w_awal=NULL;
        $w_akhir=NULL;
        $jenis=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".$_POST['tanggal_awal']."\'");
            $w_akhir= stripslashes("\'".$_POST['tanggal_akhir']."\'");
            $status= $_POST['status'];
        }

        
        $data_print = $this->Model_Laporan->laporan_serah_terima($w_awal,$w_akhir,$status);
        $data['title']='Laporan Serah Terima ';
        $data['w_awal']=$w_awal;
        $data['w_akhir']=$w_akhir;
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('pdf_serah_terima', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('daftar_struk'));
        }
    }


public function tes()
{
    $record=$this->Model_Laporan->urut_jenis();

      foreach ($record as $data) {
        echo $data['id_jenis'];
        echo '<br>';
        foreach ($data['detail'] as $key) {
            echo $key['nama_product'];
            echo '<br>';
        }
    }
   

   // print_r($record);

}

}

/* End of file daftar_struk.php */
/* Location: ./application/controllers/M_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */