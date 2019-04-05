<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_point extends CI_Controller {

public $nama_template='template_admin';
public $id_kasir='kasir';
public $id_group='kasir';

public $data_product=[];
public $uniqid=NULL;
public $coa_kas=0;

public function __construct() {
    parent::__construct();
    $this->load->model('Model_Kasir');
    $this->data_product=$this->Model_Kasir->allproduct();
    $this->load->library('Konfigurasi');
    $user = wp_get_current_user();
        if ( !in_array( 'kasir', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            }
    
    $this->id_kasir=get_current_user_id();
    
    
    
}

    
    public function index()
    {
            $this->template->load($this->nama_template,'kasir');
        
    }

    public function status_kasir()
    {
        $this->template->load($this->nama_template,'status_kasir');
    }
    
/* Kontent */
    public function list_customer()
    {
        $daftar_customer=$this->Model_Kasir->list_customer();
        echo json_encode($daftar_customer);

    }

    public function cart()
    {
        //if($this->cart->contents()){
        
        $data['itemcart']=$this->cart->contents();
        $itemcart = array(  'draw'=>0,
                            'recordsTotal'=>count($data['itemcart']),
                            'recordsFiltered'=>count($data['itemcart']),
                            'data' =>array_values($data['itemcart']));
        echo json_encode($itemcart);
            
        //}

    }

    public function tampilproduct()
    {
        $data_product=$this->Model_Kasir->allproduct();
        echo '<script src="'.base_url().'assets/Jquery/jquery.spinner.js"></script>
        <table class="table table-bordered table-striped" id="table-product">
        <thead>
        <tr>
            <th style="width: 20px;">No</th>
            <td>Nama Produk</td>
            <td>Qty</td>
            <td style="width: 50px;">Harga</td>
            <td style="width: 70px;">Aksi</td>
        </tr>
        </thead>
        <tbody>';
        $no=0;
        $nomor=0;
        foreach ($data_product as $product) {
     echo'  <tr>
            <th>'.++$nomor.'</th>
            <td>'.$product['nama_product'].'</td>
            <td style="width: 100px;">
            <div data-trigger="spinner">
                <input type="text" style="width: 45px; border: none; border: 1px solid #999; text-align: center; border-radius: 4px;" class="input-number quantity" id="quantity'.$no.'" name="quantity" value="1" data-rule="quantity">
                <a class="btn btn-primary btn-xs" href="javascript:;" data-spin="up" style="cursor: pointer;"><i class="fa fa-plus"></i></a>&nbsp;
                <a class="btn btn-primary btn-xs" href="javascript:;" data-spin="down" style="cursor: pointer;"><i class="fa fa-minus"></i></a>&nbsp;
            </div>
            </td>
            <td style="width: 50px;">'.$product['harga_point'].'</td>
            <td style="width: 70px;"><button class="btn btn-success btn-xs" onclick="masukcart('.$no.')"> Pilih </button></td>
        </tr>';
        ++$no;
        } 
    echo' </tbody>
      </table>';
      
    }
function tampiltebuspoint()
{
    echo $this->cart->total();
}
    
/* Aksi */
    
    function masukcart()
    { 
     $index=$this->input->post('index');
     $index=intval($index);
     $quantity=$this->input->post('quantity');
     $data = array(
        'id'      => $this->data_product[$index]['id_product'],
        'qty'     => $quantity,
        'price'   => $this->data_product[$index]['harga_point'],
        'name'    => $this->data_product[$index]['nama_product'],
        
        );   
         
     $this->cart->insert($data);
     print_r($this->cart->contents());
       
      //print_r($this->data_product);  
    }

    function hapusitemcart($rowid)
    {
        if($this->cart->remove($rowid))
        {
            echo "Berhasil Menghapus";
        }

    } 
    
    function updateitemcart()
    {
        $tambahan_harga=$_POST['tambahan_harga'];
        $item=$this->cart->get_item($_POST["rowid"]);
        $data = array(
        'rowid' => $_POST["rowid"],
        'price'   =>$item['price']+$tambahan_harga,
        'qty'   => $_POST["quantity"]
        );
        
        if($this->cart->update($data))
        {
            echo "Berhasil Merubah Data";
        }
    }

    function destroyitemcart()
    {
        $this->cart->destroy();
    } 

    function saldo_point($id_customer)
    {
        $record=$this->Model_Kasir->saldo_point($id_customer);
        echo $record['saldo'];
        return $record['saldo'];
    }

    function masukpesanan()
    {
        $uniqid=uniqid('pt',TRUE);  
    
        $id_kasir=$this->id_kasir;
        $id_customer=$_POST['pelanggan'];
        $jumlah_tebus=$this->cart->total();
        $point_saldo=$this->saldo_point($id_customer);

        if ($this->cart->contents() && $jumlah_tebus<=$point_saldo) {
            $pemesanan = array('id_kasir' =>$id_kasir ,
                                'id_customer'=>$id_customer,
                                'status'=>1 );
            //Header
            $this->Model_Kasir->pemesanan('h_transaksi_point',$pemesanan,$uniqid);
            
            //Detail Pemesanan
            foreach ($this->cart->contents() as $items) {
                $insert = array('id_product' =>$items['id'],
                                    'quantity'=>$items['qty'],
                                    'kredit'=>$items['price'],
                                    'keterangan'=>$items['name']
                                    );
                $this->Model_Kasir->detailpemesanan('detail_transaksi_point',$insert,$uniqid);
            }
            
            $this->cart->destroy();
            $this->session->set_flashdata('message_success', 'Barang berhasil ditebus');
        
        }
        else {
            $this->session->set_flashdata('message_failed', 'Saldo tidak mencukupi atau barang kosong');
            
        }
    
    redirect(base_url('menu_point'),'refresh');

    }

    function print_struk($uniqid)
    {
        $this->Model_Kasir->status_print($uniqid);
        $data_print=$this->Model_Kasir->urut_jenis($uniqid);
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();
        $data['title']='Struk';
        $data['print']=$data_print;
	

        //$this->template->load('template_home','strukjs', $data);
	    //Load html view
	    $html=$this->load->view('struk', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper(array(0,0,220,1250));
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        

    }

    
}

/* End of file Controllername.php */

