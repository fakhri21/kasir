<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

public $nama_template='template_admin';
public $id_kasir='kasir';
public $id_group='kasir';

public $data_product=[];
public $uniqid=NULL;
public $coa_kas=0;
public $kelipatan_point=0;
public $persen_pajak=0;
public $status_kasir='';

public function __construct() {
    parent::__construct();
    $this->load->model('Model_Kasir');
    $this->data_product=$this->Model_Kasir->allproduct();
    $user = wp_get_current_user();
    
        // if ( !in_array( 'kasir', (array) $user->roles ) ) {
        //         redirect(base_url('denied'));
        //     }
    $this->id_kasir=get_current_user_id();
    $this->group='kasir';
    //$this->group=$this->ion_auth->get_users_groups()->row()->name;

    $this->coa_kas=get_option( 'coa_kas_kasir' );
    $this->kelipatan_point=get_option( 'kelipatan_point' );
    $this->status_kasir=get_option( 'buka_kasir' );
    
    
}

    
    public function index()
    {
        if ($this->status_kasir=='') {
            
            $this->session->set_flashdata('message_failed', 'Buka Kasir terlebih dahulu');
            redirect(base_url('kasir/status_kasir'));
        } else {
         
            //print_r($this->group);
            $this->template->load($this->nama_template,'kasir');
        }
        
    }

    public function status_kasir()
    {
        $priode=get_option( 'buka_kasir' );
        $data['tanggal_buka']="";
        if ($priode<>'') {
            $x=strtotime($priode);
            $data['tanggal_buka']=date("d-m-Y", $x);
        }

        $this->template->load($this->nama_template,'status_kasir',$data);
    }
    
/* Kontent */
    public function list_customer()
    {
        $daftar_customer=$this->Model_Kasir->list_customer();
        echo json_encode($daftar_customer);

    }

    public function cart()
    {
        $data['itemcart']=$this->cart->contents();
        $itemcart = array(  'draw'=>0,
                            'recordsTotal'=>count($data['itemcart']),
                            'recordsFiltered'=>count($data['itemcart']),
                            'data' =>array_values($data['itemcart']));
        echo json_encode($itemcart);

    }

    public function kontent_metode()
    {
        $data_metode=$this->Model_Kasir->tampilmetode();

        
        echo '<div class="row">';
            foreach ($data_metode as $metode) { 
        echo    '<div class="col-md-2 col-sm-4 col-xs-12" style="margin-bottom: 10px;">
                <button class="btn btn-success btn-lg btn-block" onclick="pilihmetode('.$metode['id_metode'].')"> '.$metode['nama_metode'].'</button>
                </div>';
               } 
        echo  '</div>'; 
    }
    
    public function kontent_meja()
    {
        $data_meja=$this->Model_Kasir->tampilmeja();

        if ($data_meja) {
        
        echo '<div class="row">';
            foreach ($data_meja as $meja) { 
            $warna="is-green";
            $aksi='pilihmeja("'.$meja['id_meja'].'","'.$meja['nama_meja'].'")';
            if ($meja['status']== 1) {
              $warna="is-red";
              $aksi='tampildetailpemesanan("'.$meja['id_meja'].'","'.$meja['nama_meja'].'")';
            }
        echo    '<div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 10px;">
                <button data-dismiss="modal" class="button-meja '.$warna.'" onclick='.$aksi.'> '.$meja['nama_meja'].'</button>
                </div>';
               } 
        echo  '</div>';
        }  
    }

    public function tampildetailpemesanan($id_meja)
    {        
    $args = array(
    'name'                    => 'pelanggan', // string
    'id'                      => 'pelanggan', // integer
    'role'                    => 'user', // string|array,
    'echo'                    => false
    ); 
        $detailpemesanan= [];
        $detailpemesanan=$this->Model_Kasir->billmeja($id_meja);
        print_r($id_meja);
    if(isset($detailpemesanan)){
        echo '<div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>';
            if ($detailpemesanan) {
            $uniqid=$detailpemesanan[0]['uniqid'];
        echo' <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="hidden" id="uniqid" name="uniqid" value="'.$uniqid.'" />
                <h4 class="modal-title">'.$detailpemesanan[0]['nama_meja'].'</h4>
                <p>Waktu Order : '.$detailpemesanan[0]['waktu_order'].'</p>
                <p>No bill : '.$detailpemesanan[0]['id_bill'].'</p>
                <p>Pelanggan : '.wp_dropdown_users($args).'</p>
                <p>Metode : <select  id=metode name="" value=""> </select></p>
                <p>Tipe Bayar : <select  id=tipe name="" value=""> </select></p>
                </div>

                <table class="table">
                <thead>
                    <tr>
                    <td style="width: 15px;">No.</td>
                    <td>Nama Produk</td>
                    <td>qty</td>
                    <td>Harga</td>
                    <td>Void</td>
                    </tr>
                </thead>
                <tbody>';
                
                $subtotal=0;
                $total=0;
                $no=0;
                $nilai_pajak=0;
                $potongan=0;
                $point=0;
                foreach ($detailpemesanan as $items) {
                        $subtotal=$subtotal+($items['total_kotor']);
                        $nilai_pajak=$nilai_pajak+$items['nilai_pajak'];
                        $total=$subtotal+$nilai_pajak-$items['nilai_potongan'];
                        echo' 
                        <tr>
                        <td>'.++$no.'</td>
                        <td>'.$items['nama_product'].'</td>
                        <td>'.$items['quantity'].'</td>
                        <td>'.$items['harga_jual'].'</td>
                        <td><button data-toggle="modal" data-target="#modal-void" onclick="tampilformvoid('.stripcslashes("\'".$items['uniqid_item']."\'").')">Void</button></td>
                        </tr>';
                }
                if ($this->kelipatan_point>0) {
                    $point=$total/$this->kelipatan_point;
                }
                echo'
                </tbody>
                </table>
            </div>

            <div>
            
            </div>

                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
                <table class="table">
                <tr>
                    <th>Sub-Total</th>
                    <td><input type="text" id="sub_total" disabled name="" value="'.$subtotal.'"></td>
                </tr>
                <tr>
                    <th>Pajak</th>
                    <td><input disabled type="text" id="nilai_pajak" name="" value="'.$nilai_pajak.'"> ('.$this->persen_pajak.' %)</td>
                </tr>
                <tr>
                    <th>Tambahan Discount </th>
                    <td><input type="text" id="tambahan_discount" name="" value=""> %</td>
                    <td><button onclick="tambahan_potongan()">Potongan</button></td>
                    <td><input type="hidden" id="potongan" name="" value=""> </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><input disabled id="total" name="" value="'.$total.'"></td>
                </tr>
                
                </table>
            </div>
            </div>
            
            Point <input disabled id="point" name="" value="'.$point.'">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="bayar()">Bayar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>';
        }
        echo   '</div>
                    </div>';
        

        }
        else{
            echo '<div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Detail Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Tidak ada pemesanan.</p>
              </div>
            </div>
          </div>';
        }
    }
    

public function tampilproduct()
    {
        $data_product=$this->Model_Kasir->allproduct();
        echo '<script src="'.base_url().'assets/Jquery/jquery.spinner.js"></script>
        <table class="table table-bordered table-striped" id="table-product">
        <thead>
        <tr>
            <th style="width: 20px;">No</th>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th style="width: 50px;">Harga</th>
            <th style="width: 70px;">Aksi</th>
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
            <div data-trigger="spinner" class="row">
                <a class="btn btn-link btn-xs" href="javascript:;" data-spin="down" style="cursor: pointer;"><i class="fa fa-minus"></i></a>
                <input type="text" style="width: 45px; border: none; border: 1px solid #999; text-align: center; border-radius: 4px;" class="input-number quantity form-control" id="quantity'.$no.'" name="quantity" value="1" data-rule="quantity">
                
                <a class="btn btn-link btn-xs" href="javascript:;" data-spin="up" style="cursor: pointer;"><i class="fa fa-plus"></i></a>
            </div>
            </td>
            <td style="width: 50px;">Rp.'.number_format($product['harga'],0,',','.').'</td>
            <td style="width: 70px;"><button class="btn btn-success btn-xs" onclick="masukcart('.$no.')"> Pilih </button></td>
        </tr>';
        ++$no;
        } 
    echo' </tbody>
      </table>';
      
    }

    function tampilformvoid($uniqid)
    {
        echo '<form method="post" enctype="multipart/form-data" action="'.base_url().'kasir/void_item/'.$uniqid.'">
                <div class="form-group">
                Email / Username <input type="text" name="uservoid" value="">
                Password <input type="password"  name="passvoid" value="">
                <br>
                <input type="submit"  name="password" value="">
                </div>
                </form>';
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
        'price'   => $this->data_product[$index]['harga_jual'],
        'name'    => $this->data_product[$index]['nama_product'],
        'options'  =>array(
                        'id_jenis'=>$this->data_product[$index]['id_jenis'],
                        'discount'=>$this->data_product[$index]['discount'],
                        
                        )
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
    
    function void_item($uniqid)
    {
        $username=$this->input->post('uservoid');
        $password=$this->input->post('passvoid');
        $checker=wp_authenticate_username_password( NULL,$username,$password);
        $capability="void_item";

        if (!is_wp_error($checker)) {
            if (user_can( $checker, $capability )) {
                if($this->Model_Kasir->void_item($uniqid))
                {
                    echo "Berhasil Void";
                }
            }
        }
        
        redirect('kasir','refresh');

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

    function masukpesanan()
    {
        $pemesanan= array(
            'id_customer'=>0,
            'id_kasir'=>$this->id_kasir,
            'id_waiters'=>0);
        $id_meja=$this->input->post('id_meja',TRUE);
        $id_metode=$this->input->post('id_metode',TRUE);
        $uniqid=$this->input->post('uniqid',TRUE);
        
        if ($this->cart->contents()) {
            
            if ($id_metode==1) {
            //Meja
            $this->Model_Kasir->bookingmeja($id_meja,1);
            }

            if (is_null($uniqid)) {
            $uniqid=uniqid($pemesanan['id_metode'],TRUE);
            //Header
            $pemesanan['id_meja']=$id_meja;
            $pemesanan['id_metode']=$id_metode;
            $this->Model_Kasir->pemesanan('h_transaksi',$pemesanan,$uniqid);
            }

            //Detail Pemesanan
            foreach ($this->cart->contents() as $items) {
                $insert = array('id_product' =>$items['id'],
                                    'quantity'=>$items['qty'],
                                    //'potongan'=>$items['price']*$items['options']['discount']/100,
                                    'harga_jual'=>$items['price'],
                                    );

                $this->Model_Kasir->detailpemesanan('detail_transaksi',$insert,$uniqid);
            }
            
            $this->cart->destroy();
        }

    }

    function bayar()
    {
        $uniqid=$this->input->post('uniqid',TRUE);
        $id_meja=$_POST['id_meja'];
        $id_customer=$_POST['pelanggan'];
        $id_metode=$_POST['metode'];
        $id_tipe=$_POST['tipe'];
        
        $total_kotor=$this->input->post('subtotal');
        $nilai_pajak=$this->input->post('nilai_pajak');
        $potongan=$this->input->post('potongan');
        $grand_total=$this->input->post('total');
        $potongan_persen=$_POST['tambahan_discount'];
        
        $data=array('id_customer'=>$id_customer,
                    'id_metode'=>$id_metode,
                    'id_tipe'=>$id_tipe,
                    'status'=>1 );
        

        if ($potongan_persen<>0) {
            //Detail
            $this->Model_Kasir->tambahan_discount($potongan_persen,$uniqid);
        }
        
        if ($this->persen_pajak<>0) {
            //Detail
            $this->Model_Kasir->tambah_pajak($this->persen_pajak,$uniqid);
        }


        $this->Model_Kasir->checkout($uniqid,$data);
        $this->Model_Kasir->bookingmeja($id_meja,0);
        
        if($this->kelipatan_point){
            $point=$grand_total/$this->kelipatan_point;
            $point=round($point,0);
         /*    $data_point=array('debit' =>round($point,0),
                            'keterangan'=>"transaksi ".$uniqid,
                            'id_customer'=>$id_customer, );
            $this->Model_Kasir->tambahpoint('detail_point_user',$data_point,$uniqid); */
            $this->tambah_point($id_customer,$point,$uniqid);

        }
        
        $this->jurnal_transaksi($uniqid);
        
        //redirect('kasir/print_struk/'.$uniqid.'');
        
        //$this->print_struk($uniqid);
    
    }
    
    function tambah_point($id_customer,$jumlah_point,$uniqid_order)
    {
                $uniqid=uniqid('pt',TRUE);  
                $pemesanan = array( 'id_kasir' =>$this->id_kasir ,
                                    'id_customer'=>$id_customer,
                                    'uniqid_order'=>$uniqid_order,
                                    'status'=>1 );
            //Header
            $this->Model_Kasir->pemesanan('h_transaksi_point',$pemesanan,$uniqid);
            
            //Detail Pemesanan
                $insert = array(    'debit'=>$jumlah_point,
                                    'keterangan'=>"Tambah point".$uniqid_order.""
                                    );
                $this->Model_Kasir->detailpemesanan('detail_transaksi_point',$insert,$uniqid);
            
    }

    function jurnal_transaksi($uniqid)
    {
        $uniqid_header=uniqid('JK',TRUE);
        $id_session_kas=uniqid('',TRUE);
        $id_session_potongan=uniqid('',TRUE);
        $data_header = array(	'uniqid'=>$uniqid_header,
                                'id_tipe_voucher' =>'JK' ,
								'status'=>1,
								'eod'=>get_option('buka_kasir') );
        $this->Model_Kasir->jurnal_penjualan_header('h_akuntansi_voucher',$data_header);

        $data_transaksi=$this->Model_Kasir->kelompok_jenis($uniqid);
        
            foreach ($data_transaksi as $data) {
            
                if ($data['id_coa'] && $data['total_harga']) {
                    
                    $kas=array(     'id_coa' =>$this->coa_kas , 
                                    'debit'=>$data['total_harga'],
                                    'id_session'=>$id_session_kas,
                                    'keterangan'=>'transaksi '.$data['nama_product'].'');

                    $transaksi=array('id_coa' =>$data['id_coa'] , 
                                    'kredit'=>$data['total_harga'],
                                    'id_session'=>$id_session_kas,
                                    'keterangan'=>'transaksi '.$data['nama_product'].'');
                    $this->Model_Kasir->jurnal_penjualan('detail_akuntansi_voucher',$kas,$uniqid_header);
                    $this->Model_Kasir->jurnal_penjualan('detail_akuntansi_voucher',$transaksi,$uniqid_header);
                    
                    $kas=array('id_coa' =>$this->coa_kas, 
                                    'kredit'=>$data['total_potongan'],
                                    'id_session'=>$id_session_potongan,
                                    'keterangan'=>'transaksi potongan '.$data['nama_product'].'');
                }

                if ($data['id_coa_potongan'] && $data['total_potongan']) {
                
                    $potongan=array('id_coa' =>$data['id_coa_potongan'] , 
                                    'debit'=>$data['total_potongan'],
                                    'id_session'=>$id_session_potongan,
                                    'keterangan'=>'transaksi potongan'.$data['nama_product'].'');
                    $this->Model_Kasir->jurnal_penjualan('detail_akuntansi_voucher',$kas,$uniqid_header);
                    $this->Model_Kasir->jurnal_penjualan('detail_akuntansi_voucher',$potongan,$uniqid_header);
                }
            }
            
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

    public function buka_kasir()
    {
      update_option('buka_kasir',current_time( 'mysql' ));
      redirect(base_url('kasir'));
    }

    public function eod()
    {
      $priode=get_option('buka_kasir');
      $this->Model_Kasir->eod('h_transaksi',$priode);

            $x=strtotime($priode);
            $priode=date("d-m-Y", $x);
      
      $this->session->set_flashdata('message_success', 'Berhasil EOD priode '.$priode.'');
      update_option('buka_kasir','');
      redirect(base_url('kasir/status_kasir'));
    }
    

    function tes()
    {
        $r_data=$this->Model_Kasir->tampilbill(28,1);
        $data['aktiva']=array(0 =>'' , );
    print_r($data);
    print_r($r_data);
    
    /* foreach ($data as $header) {
        echo array_values($header);
        foreach ($header as $sub) {
            echo $sub;
        }
    } */

    /* $data['aktiva'];
        $data['aktiva']['nama']; $data['aktiva']['saldo'];
 */
    }
    

}

/* End of file Controllername.php */

