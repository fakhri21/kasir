<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">
          Detail Pemesanan
      </h4>
      <button type="button" class="close" data-dismiss="modal">&times;
      </button>
    </div>
    <?php
$uniqid=$detailpemesanan[0]['uniqid'];
?>
    <div class="modal-body">
        <div class="row mb-2">
            <input type="hidden" id="uniqid" name="uniqid" value="<?php echo $uniqid; ?>" />
            <div class="col text-center">
                <h2><?php echo $detailpemesanan[0]['nama_meja'];?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php echo $detailpemesanan[0]['waktu_order'];?>
                        </div>
                        <div class="mb-2">
                            No bill : <?php echo $detailpemesanan[0]['id_bill'];?>
                        </div class="mb-2">
                        <div  class="d-flex align-items-center">
                                <div class="text-nowrap mr-1">Pelanggan : </div>
                                <div class="w-100">
                                    <?php echo wp_dropdown_users($args);?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="text-nowrap mr-1">Metode :</div>
                            <select class="custom-select"  id="metode" name="" value=""> 
                            </select>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="text-nowrap mr-1">Tipe Bayar : </div>
                            <select class="custom-select"  id="tipe" name="" value=""> 
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      <div class="row">
        <div class="col-md-12">
          
          <table class="table">
            <thead>
              <tr>
                <th style="width: 15px;">No.
                </th>
                <th>Nama Produk
                </th>
                <th>qty
                </th>
                <th>Harga
                </th>
                <th>Void
                </th>
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
                <td>
                  <?php echo ++$no ?>
                </td>
                <td>
                  <?php echo $items['nama_product']; ?>
                </td>
                <td>
                  <?php echo $items['quantity']; ?>
                </td>
                <td>
                  <?php echo $items['harga_jual']; ?>
                </td>
                <td>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-void" onclick="tampilformvoid(<?php echo stripcslashes("\'".$items['uniqid_item']."\'"); ?>)">Void
                  </button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div>
        </div>
      </div>    
      <div class="row d-flex justify-content-end">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
          <table class="table">
            <tr>
              <th>Sub-Total
              </th>
              <td>
                <input class="form-control" type="text" id="sub_total" disabled name="" value="<?php echo $subtotal; ?>">
              </td>
            </tr>
            <tr>
              <th>Pajak
              </th>
              <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control" disabled type="text" id="nilai_pajak" name="" value="<?php echo $nilai_pajak; ?>">
                         <div class="text-nowrap">
                               &nbsp; (<?php echo $persen_pajak; ?>%)
                         </div>   
                        </div>
              </td>
            </tr>
            <tr>
              <th>Tambahan Discount 
              </th>
              <td>
                <div class="d-flex align-items-center">
                    <input class="form-control" type="text" id="tambahan_discount" name="" value="">
                    &nbsp;%
                </div>
              </td>
              <td>
                <button class="btn btn-primary" onclick="tambahan_potongan()">Potongan
                </button>
              </td>
              <td>
                <input type="hidden" id="potongan" name="" value=""> 
              </td>
            </tr>
            <tr>
              <th>Total
              </th>
              <td>
                <input class="form-control" disabled id="total" name="" value="<?php echo $total; ?>">
              </td>
            </tr>
            <tr>
                    <th>Point
                    </th>
                    <td>
                            <input class="form-control" disabled id="point" name="" value="<?php echo $point; ?>">
                    </td>
                  </tr>
          </table>
        </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success" onclick="bayar()">Bayar
      </button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close
      </button>
    </div>
  </div>
</div>
