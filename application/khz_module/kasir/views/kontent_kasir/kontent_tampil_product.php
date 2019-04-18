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
            <td>
                <input type="text"  class="input-number quantity form-control" id="quantity<?php echo $no;?>" name="quantity" value="1" data-rule="quantity">                
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
     <script>
         $(".quantity").InputSpinner()
     </script>