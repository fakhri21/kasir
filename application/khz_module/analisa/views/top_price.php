<div class="col-md-4">
<div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title text-danger">Top Chart Price</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
      <div class="sparkline" id="topprice" data-type="pie" data-offset="90" data-width="100px" data-height="100px"> </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->    
</div>

  <div class="col-md-4">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title text-danger">Top 10 (Rp)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
        <table class="table table-bordered">
					
					<tr class="info">
						<th>No</th>
            <th>Nama Product</th>
						<th>Total Quantity</th>
					</tr>
					<?php
          $index=1; 
          foreach ($topRankProductprice as $topRankProductdata) { ?>
					
					<tr>
						<td><?php echo $index;?></td>
            <td><?php echo $topRankProductdata->nama_product;?></td>
						<td>Rp. <?php echo $topRankProductdata->top_rank;?></td>
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


