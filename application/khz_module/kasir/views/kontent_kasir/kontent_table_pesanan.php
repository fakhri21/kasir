<div style="overflow: auto">
            <table class="table table-bordered table-striped" id="mytable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Qty</th>
                  <th>Tambahan</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
</div>

<script>

  
$.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1'; // Change Pagination Button Class
$.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap";
$.fn.dataTableExt.pager.numbers_length = 5;
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
  "url": '<?php echo base_url('kasir/cart'); ?>',
  "type": "POST"
},
//Set column definition initialisation properties.
"columns": [
{"data": "rowid",width:170},
{"data": "name",width:100},
{"data": "qty"},
{"data": "price",width:100},
{"data": "price",width:100},
{"data": "rowid",width:100}

],
rowCallback: function(row, data, iDisplayIndex) {
  var info = this.fnPagingInfo();
  var page = info.iPage;
  var length = info.iLength;
  var index = page * length + (iDisplayIndex + 1);
  var tambahan="<input type='number' id='tambah"+index+"' value='0'>";
  var quantity="<input type='number'class='quantity' id='qty"+index+"' value='"+data.qty+"'>";
  var aksi="<button class='btn btn-danger btn-xs' onclick=hapusitemcart('"+data.rowid+"')><i class='fa fa-remove'></i></button> <button class='btn btn-success btn-xs' onclick=updateitemcart('"+data.rowid+"','"+index+"')><i class='fa fa-refresh'></i></button>"
$('td:eq(0)', row).html(index); //Index
$('td:eq(2)', row).html(quantity); //quantity
$('td:eq(3)', row).html(tambahan); //tambahan
$('td:eq(5)', row).html(aksi); //Aksi

}
});
$("input[type='number']").InputSpinner()
</script>