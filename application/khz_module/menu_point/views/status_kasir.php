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

<form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kasir/buka_kasir">
                <div class="form-group">
                    <label>Buka Kasir </label>
                </div>
                <div class="form-group">
                <input type="submit" value="">
                </div>

</form>

<form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kasir/eod">
                <div class="form-group">
                    <label>End Of Day </label>
                </div>
                <div class="form-group">
                <input type="submit" value="">
                </div>

</form>


