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

	p,td{ font-size: 14px; }

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
		<h2>Coffee Blues</h2>
		<h2 style="margin-bottom: 5px;">'INDONESIA'</h2>

		<h4>Coffee, Art &amp; Side Effect</h4>
		<p>Jl. STM ujung</p>
		<p>Komplek Chrysant Park No. 8</p>
		<p>Medan Johor 20146</p>

		<br>

		<p style="font-size: 20px; font-weight: bold;">Meja : T-<?php echo $no_meja; ?> </p>
		<br>

		<table border="0" width="80%">
			<tr>
				<td colspan="3"><?php echo $id_customer; ?></td>
			</tr>

			<tr>
				<td width="35%"><?php echo $no_bill; ?></td>
				<td width="35%"><?php echo date_format(date_create($waktu),"d/m/Y"); ?></td>
				<td width="15%"><?php echo date_format(date_create($waktu),"H:i"); ?></td>
			</tr>

			<tr>
				<td colspan="3" style="text-align: left;">-------------------------------</td>
			</tr>

			<!-- Product -->
			<?php foreach ($items as $product) { ?>
				
			<tr>
				<td colspan="3"><?php echo $product['name']; ?></td>
			</tr>

			<tr>
				<td>@ <?php echo $product['price']; ?></td>
				<td><?php echo $product['qty']; ?></td>
				<td><?php echo $product['price']*$product['qty'] ; ?></td>
			</tr>
			<?php } ?>

			<tr>
				<td colspan="3" style="text-align: left;">-------------------------------</td>
			</tr>

			<!-- total -->

			<tr>
				<td>PPN <?php echo $pajak; ?>%</td>
				<td>:</td>
				<td><?php echo $t_pajak; ?></td>
			</tr>

			<tr>
				<td>Diskon</td>
				<td>:</td>
				<td><?php echo $t_diskon; ?></td>
			</tr>

			<tr>
				<td>Total</td>
				<td>:</td>
				<td><?php echo $total + $t_pajak; ?></td>
			</tr>

		</table>

		<br>
		<h4>Waiters: <?php echo $id_waiters; ?></h4>

	</div>


</body>
</html>