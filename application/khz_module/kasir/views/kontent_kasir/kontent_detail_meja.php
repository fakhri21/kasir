<?php 
foreach ($detail_meja as $items) {                
?>
    <div class="row">
                            <button onclick='tampildetailpemesanan("<?php echo $items['id_meja'] ;?>","<?php echo $items['nama_meja'];?>")' class="button-meja is-red">
                                <input type="hidden" id="uniqid" name="uniqid" value="<?php echo $items['uniqid']; ?>" />
                                <h4 class="modal-title"><?php echo $items['nama_meja'];?></h4>
                                <p>Waktu Order : <?php echo $items['waktu_order'];?></p>
                                <p>No bill : <?php echo $items['id_bill'];?></p>
                                <p><?php echo number_format($items['total_sementara']);?></p>
                            </button>
    </div>
<?php } ?>
                
            
            
            
