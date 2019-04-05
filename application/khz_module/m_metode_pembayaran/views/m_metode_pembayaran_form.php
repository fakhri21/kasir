<div class="container">
   <div class="row">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <a href="javascript:history.back()" class="btn btn-link btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>  
                    <h2><?php echo $button . (isset($nama_metode) ? ' '.$nama_metode : '') ?></h2>  
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="post">
                     <div class="form-group row">
                        <label for="nama_metode" class="col-sm-2 col-form-label">Nama Metode <?php echo form_error('nama_metode') ?></label>
                        <div class="col-sm-10 my-auto">
                            <input type="text" class="form-control" name="nama_metode" id="nama_metode" placeholder="Nama Metode" value="<?php echo $nama_metode; ?>" />
                        </div>
                    </div>
                    <input type="hidden" name="id_metode" value="<?php echo $id_metode; ?>" /> 
                    <div class="form-group row px-4">
                        <button type="submit" class="btn btn-primary col"><?php echo $button ?></button> 
                        <a href="<?php echo base_url('m_metode_pembayaran') ?>" class="col btn btn-link">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

