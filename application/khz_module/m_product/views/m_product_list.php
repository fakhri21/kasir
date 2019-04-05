<div class="container">
    <div class="box box-primary" style="overflow: auto">
        <div class="box-header with-border">
            <h1 class="display-4">List Produk</h1>
            <?php echo anchor(base_url('m_product/create'), '<div class="btn-custom-label"><i class=" fa fa-plus" aria-hidde="true"></i></div><span> Tambah produk</span>', 'class="btn btn-primary btn-labeled-custom"'); ?>
        </div>

        <div class="box-body">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>

            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th class="text-nowrap">No</th>
                        <th class="text-nowrap">Id Product</th>
                        <th class="text-nowrap">Id Kategori</th>
                        <th class="text-nowrap">Id Jenis</th>
                        <th class="text-nowrap">Nama Product</th>
                        <th class="text-nowrap">Harga</th>
                        <th class="text-nowrap">Deskripsi</th>
                        <th class="text-nowrap">Gambar</th>
                        <th class="text-nowrap">Discount</th>
                        <th class="text-nowrap">Tgl Dibuat</th>
                        <th class="text-nowrap">User Pembuat</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1'; // Change Pagination Button Class
        $.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap"
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
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

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },

            processing: true,
            serverSide: true,
            ajax: {"url": "m_product/json", "type": "POST"},
            columns: [
            {
                "data": "uniqid",
                "orderable": false
            },{"data": "id_product"},{"data": "id_kategori"},{"data": "id_jenis"},{"data": "nama_product"},{"data": "harga"},{"data": "deskripsi"},{"data": "gambar"},{"data": "discount"},{"data": "tgl_dibuat"},{"data": "user_pembuat"},{"data": "status"},
            {
                "data" : "action",
                "orderable": false,
                "className" : "text-center"
            }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                var gambar='<img id="gambar_product" style="height: 80px; width: 100%;" src="<?php echo base_url();?>img_product/'+data.gambar+'" class="img-responsive">'
                var status='<label class="label label-success">Tersedia</label>'

                if (data.status!=0) {
                    status='<label class="label label-danger">Out of Order</label>'
                }

                $('td:eq(0)', row).html(index);
                $('td:eq(7)', row).html(gambar);
                $('td:eq(11)', row).html(status);
            }
        });
    });
</script>