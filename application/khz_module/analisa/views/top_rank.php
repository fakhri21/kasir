<div class="col-md-4">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title text-danger">Top 10 (Quantity)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
        <table class="table table-bordered">					
					<tr class="info">
						<th>Rank</th>
            <th>Nama Product</th>
						<th>Total Quantity</th>
					</tr>
					<?php
          $index=1; 
          foreach ($toprank as $topRankProductdata) { ?>
					
					<tr>
						<td><?php echo $index ?></td>
            <td><?php echo $topRankProductdata['nama_product'];?></td>
						<td><?php echo $topRankProductdata['top_rank'];?></td>
					</tr>
					<?php 
          $index++;
          } ?>
        </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

<div class="col-md-4">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title text-danger">Top Chart Quantity</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
      <div class="sparkline" id="topquantity" data-type="pie" data-offset="90" data-width="100px" data-height="100px">

      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

<script>
        var data = JSON.parse('<?php echo json_encode($toprank); ?> ');
        var data_nama = JSON.parse('<?php echo json_encode($toprank_name); ?> ');
        var data_value = JSON.parse('<?php echo json_encode($toprank_value); ?> ');

        $('#topquantity').sparkline(data_value, {
            type: 'pie',
            width: '300',
            height: '300',
            tooltipFormat: '{{offset:kampret}} {{offset:slice}}',
            tooltipValueLookups: {
                'slice': data_nama,
                'kampret': data_value,
            }
        });

        $("#id_jenis").selectize({
            create: false
        });

        $(".tanggal").datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
</script>