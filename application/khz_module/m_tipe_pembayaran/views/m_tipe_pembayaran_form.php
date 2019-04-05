<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">M_tipe_pembayaran <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Tipe <?php echo form_error('nama_tipe') ?></label>
            <input type="text" class="form-control" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" value="<?php echo $nama_tipe; ?>" />
        </div>
	    <input type="hidden" name="id_tipe" value="<?php echo $id_tipe; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo base_url('m_tipe_pembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>