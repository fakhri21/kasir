<div class="row">
<?php 
foreach ($detail_meja as $items) {                
?>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <div class="card w-100-p m-2">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="modal-title"><?php echo $items['nama_meja'];?></h4>
                </div>
                <div class="card-text">
                    <input type="hidden" id="uniqid_detail_meja" name="uniqid" value="<?php echo $items['uniqid']; ?>" />
                    <div>
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php echo $items['waktu_order'];?>
                    </div>
                    <p>No bill : <?php echo $items['id_bill'];?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <button onclick='tampildetailpemesanan(`<?php echo $items["id_meja"] ;?>`,` <?php echo $items["nama_meja"];?>`)' class="btn button-meja is-red">Pilih Meja</button>
                        <div><?php echo number_format($items['total_sementara']);?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
            
            
