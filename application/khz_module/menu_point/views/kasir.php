<link href="<?php echo base_url();?>assets/bootstrap/css/kasir.css" rel="stylesheet">
<?php
if (!empty($this->session->flashdata('message_success'))) {
		echo '
			<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-check"></i> Selamat.!</h4>
	            '.$this->session->flashdata('message_success').'
	        </div>
		';
	}

	if (!empty($this->session->flashdata('message_failed'))) {
		echo '
			<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Perhatian.!</h4>
	            '.$this->session->flashdata('message_failed').'
	        </div>
		';
	}
	
?>


<div class="col-md-12" style="margin-bottom: 10px;">
  <button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="tampilproduct()"><i class="fa fa-plus"></i> Tambah Pesanan</button>
</div>


<div class="col-md-12" style="margin-top: 30px;">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="pull-left">Pesanan</h3>
      <button style="margin-top: 5px;" class="btn pull-right btn-success" onclick="refresh_table('mytable')"><i class="fa fa-refresh"></i></button>
    </div>

    <?php 
    $args = array(
                  'name'                    => 'pelanggan', // string
                  'id'                      => 'pelanggan', // integer
                  'role'                    => 'user', // string|array,
    ); ?>
    <div id="nama_meja">   <span id="id_meja"></span></div> <!-- Id Meja -->
    <p>Pelanggan : <?php wp_dropdown_users($args); ?></p>
    <div > Point :   <span id="jumlah_poin"></span></div> <!-- Poin -->

    <div class="box-body">
      <div style="overflow: auto">
      <table class="table table-bordered table-striped" id="mytable">
        <thead>
          <tr>
            <td style="width: 20px;">No</th>
            <td>Nama Produk</td>
            <td style="width: 100px;">Qty</td>
            <td>Harga Poin</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
              
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <h3><p>Total :<span id="total_tebus">0</span> </p> </h3>
  <button class="btn btn-primary" onclick="masuk_pesanan()"><i class="fa fa-point"></i> Tebus</button>
</div>

<!-- content -->
<div id="content">
  
  
  <!-- Modal Product -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product</h4>
        </div>
        <div id="body-product" class="modal-body">
        
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Detail Pemesanan -->
    <div id="modal-detail-pemesanan" class="modal fade" role="dialog">

    </div>
    
  </div>
</body>
</html>

<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

    
    <script>
    var id_meja="0"
    var id_metode="1"
    var id_pelanggan="0"
    var id_transaksi=null
    var tes=""
    var base_url="<?php echo base_url() ?>"
    </script>

    <script>
    $(document).ready(function() {
            $("#pelanggan").selectize({
                });
          
          
          $("#pelanggan").change(function(){
            refresh_table('mytable')
          })


      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };
                
    //datatables
    table = $('#mytable').DataTable({
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
    "url": '<?php echo base_url('menu_point/cart'); ?>',
    "type": "POST"
    },
    //Set column definition initialisation properties.
    "columns": [
    {"data": "rowid",width:170},
    {"data": "name",width:100},
    {"data": "qty",width:100},
    {"data": "price",width:100},
    {"data": "rowid",width:100}
    
    ],
    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        var tambahan="<input type='number' id='tambah"+index+"' value='0'>";
                        var quantity="<input type='number' id='qty"+index+"' value='"+data.qty+"'>";
                        var aksi="<button class='btn btn-danger btn-xs' onclick=hapusitemcart('"+data.rowid+"')><i class='fa fa-remove'></i></button> <button class='btn btn-success btn-xs' onclick=updateitemcart('"+data.rowid+"','"+index+"')><i class='fa fa-refresh'></i></button>"
                        $('td:eq(0)', row).html(index); //Index
                        $('td:eq(2)', row).html(quantity); //quantity
                        $('td:eq(4)', row).html(aksi); //Aksi

                    }
    
    });

    //refresh_table("mytable")  
    });

/* kontent */

      
      function tampilproduct() {
        $("#body-product").load('<?php echo base_url('menu_point/tampilproduct'); ?>',function () {
          $("#table-product").dataTable()
        })
      }

      
      
      function tampildetailpemesanan(id,nama,cback) { //Meja berisi
        pilihmeja(id,nama)
        $("#modal-detail-pemesanan").load('<?php echo base_url('menu_point/tampildetailpemesanan/'); ?>'+id+'',function () {
          
          
        })
        
      }

/* Aksi */
      
      function refresh_table(id) {
        $('#'+id+'').DataTable().ajax.reload()

        $.post("menu_point/tampiltebuspoint",function(jumlah) {
          $("#total_tebus").text(jumlah)
        })
        
        var id_customer=$("#pelanggan").val();
        if(id_customer){
          $.post("menu_point/saldo_point/"+id_customer+"",function(jumlah) {
            $("#jumlah_poin").text(jumlah)
          })
        }
      }

      function masuk_pesanan(cback) { //Save
        var data ={
          "pelanggan":$("#pelanggan").val(),
        }
        $.post('menu_point/masukpesanan',data,function() {
          alert("pesanan telah dimasukkan")
          refresh_table("mytable")
          if (typeof(cback)=="function") {
            cback
          }
        })
      }

      function hapusitemcart(rowid) {
        var data={tes:'0'};
        $.post("menu_point/hapusitemcart/"+rowid+"",data,function (pesan) {
          alert(pesan)
          refresh_table("mytable")
        })
      }
      
      function updateitemcart(rowid,index) {
        var data={
          "tambahan_harga":$("#tambah"+index+"").val(),
          "quantity":$("#qty"+index+"").val(),
          "rowid":rowid
          };
        $.post("menu_point/updateitemcart/",data,function (pesan) {
          alert(pesan)
          refresh_table("mytable")
        })
      }
      
      function masukcart(index) {
        var data={
          "index":index,
          "quantity":$("#quantity"+index+"").val()
        }
        $.post("menu_point/masukcart",data,function() {
          alert("Item berhasil ditambahkan")
          refresh_table("mytable")
        })
        
      }

      
      
    </script>