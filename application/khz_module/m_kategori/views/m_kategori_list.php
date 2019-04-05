
<div class="container">
    <div class="row mb-2">
        <div class="col">
            <div id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <div class="box box-primary">
                <div class="box-header">
                     <h1 class="display-4">Daftar Kategori</h1>
                     <?php echo anchor(base_url('m_kategori/create'), '<div class="btn-custom-label"><i class=" fa fa-plus" aria-hidde="true"></i></div><span> Tambah Kategori</span>', 'class="btn btn-primary btn-labeled-custom"'); ?>
                </div>
                <div class="box-body px-3 py-4">
                <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Id Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Urutan</th>
                                <th>Isi</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1'; // Change Pagination Button Class
        $.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap"
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
            ajax: {"url": "m_kategori/json", "type": "POST"},
            columns: [
            {
                "data": "uniqid",
                "orderable": false
            },{"data": "id_kategori"},{"data": "nama_kategori"},{"data": "urutan"},{"data": "isi"},
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