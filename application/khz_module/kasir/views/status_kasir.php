<?php
if (!empty($this->session->flashdata('message_success'))) {
	echo '
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Selamat.!</h4>
		'.$this->session->flashdata('message_success').'
	</div>
	';
}

if (!empty($this->session->flashdata('message_failed'))) {
	echo '
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-ban"></i> Perhatian.!</h4>
		'.$this->session->flashdata('message_failed').'
	</div>
	';
}

?>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="box box-primary">
				<div class="box-header">
					<h5 class="box-title">Status Kasir</h5>
				</div>
				Tanggal buka : <?php echo $tanggal_buka; ?>
				<div class="box-body">
					<form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kasir/buka_kasir">
						<div class="form-group">
							<input type="submit" value="Buka Kasir" id="buka" class="btn btn-success">
						</div>
					</form>
					<form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kasir/eod">
						<div class="form-group">
							<input type="submit" value="End Of Day" id="tutup" class="btn btn-warning">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>




