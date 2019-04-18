<div class="row">
   <?php  foreach ($data_meja as $meja) { 
      $warna="is-green";
      $aksi="pilihmeja('".$meja['id_meja']."','".$meja['nama_meja']."')";
      if ($meja['status']== 1) {
        $warna="is-red";
        $aksi="tampildetailpemesanan('".$meja['id_meja']."','".$meja['nama_meja']."')";
      } ?>
   <div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 10px;">
      <button data-dismiss="modal" 
        class="button-meja <?php echo $warna ?>" 
        onclick="<?php echo $aksi ?>"> <?php echo $meja['nama_meja'] ?>
      </button>
   </div>
   <?php } ?>
</div>
