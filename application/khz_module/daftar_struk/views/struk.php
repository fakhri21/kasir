<!DOCTYPE html>
<html>
<head>
	<title>Struk</title>
	<style>

	*{margin: 0; padding: 0;}

	body{
		background: #fafafa;
		font-family: 'courier new';
		color: #444;
	}

	p,td{ font-size: 18px; }

	hr{ margin-bottom: 5px; }

		.struk-box{
			background: #fff;
			width: 2.7in;
			padding: 10px 15px;
		}

		.struk-box h2, h4, p{ text-align: center;  }

	</style>
</head>
<body>

	<div class="struk-box">
		<h2><?php echo  get_option( 'nama_perusahaan' ) ?></h2>
		
		<h4><?php echo  get_option( 'slogan_perusahaan' ) ?></h4>
		<p><?php echo  get_option( 'alamat_perusahaan' ) ?></p>
		
		<br>
		<?php if ($print[0]['detail'][0]['id_metode']==1) { ?>
			<p style="font-size: 20px; font-weight: bold;">Meja :<?php echo $print[0]['detail'][0]['nama_meja']; ?> </p>
		<?php } else { ?>
			<p style="font-size: 20px; font-weight: bold;"><?php echo $print[0]['detail'][0]['nama_metode']; ?> </p>
		<?php }?>
		<br>

		<table border="0" width="80%">
			<tr>
				<td colspan="3"><?php echo $print[0]['detail'][0]['nama_customer']; ?></td>
			</tr>

			<tr>
				<td width="45%"><?php echo $print[0]['detail'][0]['id_bill']; ?></td>
				<td width="35%"><?php echo date_format(date_create($print[0]['detail'][0]['waktu_order']),"d/m/Y"); ?></td>
				<td width="15%"><?php echo date_format(date_create($print[0]['detail'][0]['waktu_order']),"H:i"); ?></td>
			</tr>

			<tr>
				<td colspan="3" style="text-align: left;">-------------------------------</td>
			</tr>

			<!-- Product -->
			<?php 
				$total=0;
				$total_nilai_pajak=0;
				$total_nilai_potongan=0;
				foreach ($print as $product) { 
				$subtotal=0; ?>
				
			<tr>
				<td colspan="3"><?php echo $product['nama_jenis']; ?></td>
			</tr>
					<?php foreach ($product['detail'] as $subproduct) { ?>
					<tr>
						<td colspan="3"><?php echo $subproduct['nama_product']; ?></td>
					</tr>

					<tr>
							<td>@ <?php echo number_format($subproduct['harga_jual']); ?></td>
							<td><?php echo $subproduct['quantity']; ?></td>
							<td><?php echo number_format($subproduct['harga_jual']*$subproduct['quantity']) ; ?></td>
					</tr>
					<?php 
					$subtotal=$subtotal+$subproduct['harga_jual']*$subproduct['quantity']; 
					$total_nilai_potongan=$total_nilai_potongan+$subproduct['nilai_potongan'];
					$total_nilai_pajak=$total_nilai_pajak+$subproduct['nilai_pajak'];
					$total=$total+$subproduct['total_bersih']; 
					
					} ?>
							<tr>
								<td>Subtotal </td>
								<td>:</td>
								<td><?php echo number_format($subtotal) ; ?></td>
							</tr>
			<?php } ?>

			<tr>
				<td colspan="3" style="text-align: left;">-------------------------------</td>
			</tr>

			<!-- total -->

			 <tr>
				<td>PPN <?php echo $print[0]['detail'][0]['pajak_persen']; ?>%</td>
				<td>:</td>
				<td><?php echo number_format($total_nilai_pajak); ?></td>
			</tr>

			<tr>
				<td>Diskon</td>
				<td>:</td>
				<td><?php echo number_format($total_nilai_potongan) ?></td>
			</tr>

			<tr>
				<td>Total</td>
				<td>:</td>
				<td><?php echo number_format($total); ?></td>
			</tr>
 
		</table>

		<br>
		<h4>Waiters: <?php echo $print[0]['detail'][0]['nama_waiters']; ?></h4>
		<h4>Kasir: <?php echo $print[0]['detail'][0]['nama_kasir']; ?></h4>

		<br>
		
		Cetakan ke: <?php echo $print[0]['detail'][0]['status_print']; ?>

	</div>


</body>
</html>