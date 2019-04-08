<script src="<?php echo base_url('assets/js/jquery.spinner.js'); ?>" ></script>
   
        <table class="table table-bordered table-striped" id="table-product">
        <thead>
        <tr>
            <th style="width: 20px;">No</th>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th style="width: 50px;">Harga</th>
            <th style="width: 70px;">Aksi</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $no=0;
        $nomor=0;
        foreach ($data_product as $product) {
     ?>
       <tr>
            <th><?php echo ++$nomor;?></th>
            <td><?php echo $product['nama_product'];?></td>
            <td style="width: 100px;">
            <div data-trigger="spinner" class="row">
                <a class="btn btn-link btn-xs" href="javascript:;" data-spin="down" style="cursor: pointer;"><i class="fa fa-minus"></i></a>
                <input type="text" style="width: 45px; border: none; border: 1px solid #999; text-align: center; border-radius: 4px;" class="input-number quantity form-control" id="quantity'.$no.'" name="quantity" value="1" data-rule="quantity">                
                <a class="btn btn-link btn-xs" href="javascript:;" data-spin="up" style="cursor: pointer;"><i class="fa fa-plus"></i></a>
            </div>
            </td>
            <td style="width: 50px;">Rp.<?php echo number_format($product['harga'],0,',','.');?></td>
            <td style="width: 70px;"><button class="btn btn-success btn-xs" onclick="masukcart(<?php echo $no ;?>)"> Pilih </button></td>
        </tr>
      <?php
        ++$no;
        } 
        ?>
     </tbody>
      </table>
     