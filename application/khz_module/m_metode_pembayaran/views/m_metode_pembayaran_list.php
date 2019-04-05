    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary mb-2">
            <div class="box-header">
                <h1 style="margin-top:0px" class="display-4">Metode Pembayaran</h1>
               <?php echo anchor(base_url('m_metode_pembayaran/create'), '<div class="btn-custom-label"><i class=" fa fa-plus" aria-hidde="true"></i></div><span> Tambah Metode Pembayaran</span>', 'class="btn btn-primary btn-labeled-custom"'); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                 <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th width="80px">No</th>
                            <th>Nama Metode</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap"
            $.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1';
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
                ajax: {"url": "m_metode_pembayaran/json", "type": "POST"},
                columns: [
                {
                    "data": "id_metode",
                    "orderable": false
                },{"data": "nama_metode"},
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