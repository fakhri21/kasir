<div class="row">
   <?php foreach ($data_metode as $metode) { ?> 
   <div class="col-md-2 col-sm-4 col-xs-12" style="margin-bottom: 10px;">
      <button class="btn btn-success btn-lg btn-block" onclick="pilihmetode(<?php echo $metode['id_metode'];?>)"> <?php echo $metode['nama_metode'];?></button>
   </div>
   <?php  } ?> 
</div>