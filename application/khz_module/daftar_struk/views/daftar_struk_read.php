
<h3 style="margin-top:0px">Id Bill : <?php $pesanan['nama_product']?> </h3>
<h3 style="margin-top:0px">Metode : <?php $pesanan['nama_product']?> </h3>
<h3 style="margin-top:0px">Waktu : <?php $pesanan['nama_product']?> </h3>
<h3 style="margin-top:0px">Kasir : <?php $pesanan['nama_product']?> </h3>
<h3 style="margin-top:0px">Waiters : <?php $pesanan['nama_product']?> </h3>

<table class="table">
   <tr>
    <td>Nama Product</td>
    <td>Quantity</td>
    <td>Harga Bayar</td>
</tr>

<tr>
    <td><?php $pesanan['nama_product']?></td>
    <td><?php $pesanan['quantity']?></td>
    <td><?php $pesanan['harga_bayar']?></td>
</tr>

<tr><td>Total</td><td>$total_bayar</td></tr>
<tr><td></td><td><a href="<?php echo base_url('m_kategori') ?>" class="btn btn-default">Cancel</a></td></tr>
</table>