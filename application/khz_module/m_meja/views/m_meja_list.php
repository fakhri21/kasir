<div class="container">
    <div class="box box-primary pt-2 pb-2 mt-3" style="overflow: auto">
        <div class="box-header">
        <h1 class="display-4">Daftar Meja</h1>
            <?php echo anchor(base_url('m_meja/create'), '<div class="btn-custom-label"><i class=" fa fa-plus" aria-hidde="true"></i></div><span> Tambah Meja</span>', 'class="btn btn-primary btn-labeled-custom"'); ?>
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped display w-100-p" id="dataTables">
                <thead>
                    <tr>
                        <th width="80px" class="text-nowrap">No</th>
                        <th class="text-nowrap">Id Meja</th>
                        <th class="text-nowrap">Urutan</th>
                        <th class="text-nowrap">Nama Meja</th>
                        <th class="text-nowrap">Harga Tambahan Meja</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Kondisi</th>
                        <th class="text-nowrap" width="200px">Aksi</th>
                    </tr>
                </thead>
            </table>
        
        </div>
        
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

                $.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1'; // Change Pagination Button Class
                $.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap"
                console.log()
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



                var t = $("#dataTables").dataTable({
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
                    ajax: {"url": "m_meja/json", "type": "POST"},
                    columns: [
                    {
                        "data": "uniqid",
                        "orderable": false
                    },{"data": "id_meja"},{"data": "urutan"},{"data": "nama_meja"},{"data": "harga_tambahan_meja"},{"data": "status"},{"data": "kondisi"},
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
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>

    </div>