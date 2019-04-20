<div class="container-fluid">

	<!-- tampil produk &amp; meja -->
	<div class="row">
		<div class="col">
			<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="tampilproduct()"><i class="fa fa-plus"></i> Tambah Pesanan</button>
		</div>
		<div class="col">
			<h3 class="pull-left">Pesanan : <span id="nama_meja" id="id_meja"> Pilih meja<span></h3>
			<div id="nama_kasir"><span id="id_kasir"></span></div> <!-- Id kasir -->
        	<div id="nama_metode"><span id="id_metode"></span></div> <!-- Id Metode -->
		</div>
		<div class="col">
			<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-meja" onclick="tampilmeja()">Pilih Meja</button>
		</div>
	</div>

	<!-- meja yg berisi &amp; pesanan yg terpilih -->
	<div class="row">
		<div class="col" id="detailmeja"></div>
		<div class="col" id="pesanan"></div>
	</div>

	<!-- tombol action -->
	<div class="row">
		<div class="col">
			<button id="btn-detail-pemesanan" class="btn btn-primary" data-toggle="modal" data-target="#modal-detail-pemesanan"><i class="fa fa-file"></i> Detail Pemesanan</button>
      		<button class="btn btn-primary" onclick="masuk_pesanan()"><i class="fa fa-save"></i> Simpan Order</button>
		</div>
	</div>
	
</div>

  <!-- Modal Product -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
    <div class="modal-dialog" role="document">
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
    </div>
  </div>
  <!-- Modal meja -->
  <div id="modal-meja" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Meja</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div id='body-meja' class="modal-body">
          <div class="row">
            <div class="col">
              <div class="fa-3x text-center">
                <i class="fa fa-spinner fa-pulse"></i>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- Modal metode -->
  <div id="modal-metode" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih metode</h4>
        </div>
        <div id='body-metode' class="modal-body">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Void -->
  <div id="modal-void" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Void Pesanan</h4>
        </div>
        <div id='body-void' class="modal-body">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
    </div>
</div>


<script>
  var id_meja="0"
  var id_metode="1"
  var id_pelanggan="0"
  var id_transaksi=null
  var tes=""
  var base_url="<?php echo base_url() ?>"

  
  $(document).ready(function() {
    $('#modal-meja').modal('show');
    $('#modal-meja').on('shown.bs.modal', function () {
      $("#body-meja").load('<?php echo base_url('kasir/kontent_meja'); ?>');
    })
    $("#pesanan").load('<?php echo base_url('kasir/kontent_table_pesanan'); ?>');
    tampildetailmeja()
    setInterval(function(){ 
              tampildetailmeja() 
          }, 30000);
    



});

  /* kontent */

  function tampilformvoid(uniqid_product) {
    $("#body-void").load('<?php echo base_url('kasir/tampilformvoid/'); ?>'+uniqid_product+'',function () {
    })
  }

  function tampilproduct() {
    $("#body-product").load('<?php echo base_url('kasir/tampilproduct'); ?>',function () {
      $("#table-product").dataTable()
    })
  }

  function tampilmeja() {
    $("#body-meja").load('<?php echo base_url('kasir/kontent_meja'); ?>')
  }

  function tampildetailmeja() {
    $("#detailmeja").load('<?php echo base_url('kasir/kontent_detail_meja'); ?>')
  }

  function tampilmetode() {
    $("#body-metode").load('<?php echo base_url('kasir/kontent_metode'); ?>')
  }

function tampildetailpemesanan(id,nama,cback) { //Meja berisi
  pilihmeja(id,nama)
  $("#modal-detail-pemesanan").load('<?php echo base_url('kasir/tampildetailpemesanan/'); ?>'+id+'',function () {

      $("#pelanggan").selectize({
        create: false
      });
    
    $.getJSON(""+base_url+"m_metode_pembayaran/json",function (data) {
      $.each(data.data, function(key) {   
        $('#metode')
        .append($("<option></option>")
          .attr("value",data.data[key].id_metode)
          .text(data.data[key].nama_metode)); 
      });
    })
    $.getJSON(""+base_url+"m_tipe_pembayaran/json",function (data) {
      $.each(data.data, function(key) {   
        $('#tipe')
        .append($("<option></option>")
          .attr("value",data.data[key].id_tipe)
          .text(data.data[key].nama_tipe)); 
      });
    })

  })

}

/* Aksi */
function pilihmeja(id,nama) {
  id_meja=id
  $("#nama_meja").text(nama)
  $("#modal-detail-pemesanan .modal-title").html('Tidak ada pemesanan')
  $("#modal-detail-pemesanan .modal-body").html('Pemesanan Kosong')
  $("#modal-detail-pemesanan .modal-footer").html('')
}

function pilihmetode(id) {
  id_meja=0
  id_metode=id
  $("#modal-detail-pemesanan .modal-title").html('Tidak ada pemesanan')
  $("#modal-detail-pemesanan .modal-body").html('Pemesanan Kosong')
  $("#modal-detail-pemesanan .modal-footer").html('')
  masuk_pesanan()
  tampildetailpemesanan(0,'')
}

function refresh_table(id) {
  $('#'+id+'').DataTable().ajax.reload()
}

function masuk_pesanan(cback) { //Save
  var data ={
    "id_meja":id_meja,
    "id_metode":id_metode,
    "uniqid":$("#uniqid").val(),
  }
  $.post('kasir/masukpesanan',data,function() {
    alertify.success("pesanan telah dimasukkan")
    refresh_table("mytable")
    if (typeof(cback)=="function") {
      cback
    }
  })
}

function hapusitemcart(rowid) {
  var data={tes:'0'};
  $.post("kasir/hapusitemcart/"+rowid+"",data,function (pesan) {
    alertify.success(pesan)
    refresh_table("mytable")
  })
}

function updateitemcart(rowid,index) {
  var data={
    "tambahan_harga":$("#tambah"+index+"").val(),
    "quantity":$("#qty"+index+"").val(),
    "rowid":rowid
  };
  $.post("kasir/updateitemcart/",data,function (pesan) {
    alertify.success(pesan)
    refresh_table("mytable")
  })
}

function masukcart(index) {
  var data={
    "index":index,
    "quantity":$("#quantity"+index+"").val()
  }
  $.post("kasir/masukcart",data,function() {
    alertify.success("Item berhasil ditambahkan")
    refresh_table("mytable")
  })
}

function tambahan_potongan() {
  var total=$("#total").val()
  var persen=$("#tambahan_discount").val()
  var hasil=total*persen/100;

  $("#potongan").val(hasil)
  $("#total").val(total-hasil)

//alertify.success(""+hasil+" "+total+"")


}

function bayar() {
  var uniqid=$("#uniqid").val()
  var data={
    "uniqid":""+uniqid+"",
    "id_meja":id_meja,
    "pelanggan":$("#pelanggan").val(),
    "metode":$("#metode").val(),
    "tipe":$("#tipe").val(),
    "subtotal":$("#subtotal").val(),
    "tambahan_discount":$("#tambahan_discount").val(),
    "potongan":$("#potongan").val(),
    "nilai_pajak":$("#nilai_pajak").val(),
    "total":$("#total").val(),

  }
  $.post('kasir/bayar',data,function(params) {
    alert("Berhasil melakukan pembayaran")
    window.location='<?php echo base_url('daftar_struk/read/');?>'+uniqid+'';
  })
}
</script>