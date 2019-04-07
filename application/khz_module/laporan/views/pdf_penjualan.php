
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
	table.table-style-two {
		font-family: verdana, arial, sans-serif;
		font-size: 11px;
		color: #333333;
		border-width: 1px;
		border-color: #3A3A3A;
		border-collapse: collapse;
	}
 
	table.table-style-two th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #517994;
		background-color: #B2CFD8;
	}
 
	/* table.table-style-two tr:hover td {
		background-color: #FFF;
	}
  */
	table.table-style-two td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #517994;
		background-color: #ffffff;
	}
</style>
    <body>
    
  <div class="panel-body">
  <h3>Laporan Penjualan</h3>
  <h3>Periode <?php echo $w_awal ?> s/d <?php echo $w_akhir ?></h3>
                <table class="table-style-two">
                    <tr>
                        <th>No</th>
                        <th>Id Penjualan</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Jenis</th>
                        <th>Nama Prohuk</th>
                        <th>Harga Jual</th>
                        <th>Quantity</th>
                        <th>Total Bersih</th>

                    </tr>
                    <?php
                            $no=0;
                            $grandtotal=0;
                            foreach ($record as $recorddata) {
                                $grandtotal=$grandtotal+$recorddata['total_bersih'];
                             ?>

                        <!-- Kategori -->
                        <tr>
                            <td><?php echo ++$no ?></td>
                            <td><?php echo $recorddata['id_bill'] ?></td>
                            <td><?php echo $recorddata['tanggal'] ?></td>
                            <td><?php echo $recorddata['nama_kasir'] ?></td>
                            <td><?php echo $recorddata['nama_jenis'] ?></td>
                            <td><?php echo $recorddata['nama_product'] ?></td>
                            <td><?php echo $recorddata['harga_jual'] ?></td>
                            <td><?php echo $recorddata['quantity'] ?></td>
                            <td><?php echo $recorddata['total_bersih'] ?></td>
                        </tr>
                        <?php }?>
                    <tr>
                        <td>Grand Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $grandtotal ?></td>
                            
                    </tr>
                </table>


    </body>
</html>

