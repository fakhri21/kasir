<div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php
            $uniqid=$detailpemesanan[0]['uniqid'];
            ?>
         <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="hidden" id="uniqid" name="uniqid" value="<?php echo $uniqid; ?>" />
                <h4 class="modal-title"><?php echo $detailpemesanan[0]['nama_meja'];?></h4>
                <p>Waktu Order : <?php echo $detailpemesanan[0]['waktu_order'];?></p>
                <p>No bill : <?php echo $detailpemesanan[0]['id_bill'];?></p>
                <p>Pelanggan : <?php echo wp_dropdown_users($args);?></p>
                <p>Metode : <select  id=metode name="" value=""> </select></p>
                <p>Tipe Bayar : <select  id=tipe name="" value=""> </select></p>
                </div>

                <table class="table">
                <thead>
                    <tr>
                    <td style="width: 15px;">No.</td>
                    <td>Nama Produk</td>
                    <td>qty</td>
                    <td>Harga</td>
                    <td>Void</td>
                    </tr>
                </thead>
                <tbody>
                
                <?php

                $subtotal=0;
                $total=0;
                $no=0;
                $nilai_pajak=0;
                $potongan=0;
                $point=0;
                foreach ($detailpemesanan as $items) {
                        $subtotal=$subtotal+($items['total_kotor']);
                        $nilai_pajak=$nilai_pajak+$items['nilai_pajak'];
                        $total=$subtotal+$nilai_pajak-$items['nilai_potongan'];
                
                ?>
                        <tr>
                        <td><?php echo ++$no ?></td>
                        <td><?php echo $items['nama_product']; ?></td>
                        <td><?php echo $items['quantity']; ?></td>
                        <td><?php echo $items['harga_jual']; ?></td>
                        <td><button data-toggle="modal" data-target="#modal-void" onclick="tampilformvoid(<?php echo stripcslashes("\'".$items['uniqid_item']."\'"); ?>)">Void</button></td>
                        </tr>
               <?php } ?>

                
                
                </tbody>
                </table>
            </div>

            <div>
            
            </div>

                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
                <table class="table">
                <tr>
                    <th>Sub-Total</th>
                    <td><input type="text" id="sub_total" disabled name="" value="<?php echo $subtotal; ?>"></td>
                </tr>
                <tr>
                    <th>Pajak</th>
                    <td><input disabled type="text" id="nilai_pajak" name="" value="<?php echo $nilai_pajak; ?>"> (<?php echo $persen_pajak; ?> %)</td>
                </tr>
                <tr>
                    <th>Tambahan Discount </th>
                    <td><input type="text" id="tambahan_discount" name="" value=""> %</td>
                    <td><button onclick="tambahan_potongan()">Potongan</button></td>
                    <td><input type="hidden" id="potongan" name="" value=""> </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><input disabled id="total" name="" value="<?php echo $total; ?>"></td>
                </tr>
                
                </table>
            </div>
            </div>
            
            Point <input disabled id="point" name="" value="<?php echo $point; ?>">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="bayar()">Bayar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
                    </div>