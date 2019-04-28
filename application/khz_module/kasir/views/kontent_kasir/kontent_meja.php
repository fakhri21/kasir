
<div class="row">
<?php  foreach ($data_meja as $meja) { 
      $warna="is-green";
      $aksi="pilihmeja('".$meja['id_meja']."','".$meja['nama_meja']."')";
      if ($meja['status']== 1) {
        $warna="is-red";
        $aksi="tampildetailpemesanan('".$meja['id_meja']."','".$meja['nama_meja']."')";
      } ?>
   <div class="col-md-4 col-lg-2 col-xs-4">
   <button data-dismiss="modal" 
        class="m-2 btn w-100 button-meja <?php echo $warna ?>" 
        onclick="<?php echo $aksi ?>"> <?php echo $meja['nama_meja'] ?>
      </button>
   </div>
   <?php } ?>
</div>