<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo base_url('m_jenis') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                            <h2><?php echo $button . (isset($nama_jenis) ? ' '. $nama_jenis : '') ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label for="varchar">Id Jenis <?php echo form_error('id_jenis') ?></label>
                            <input type="text" class="form-control" name="id_jenis" id="id_jenis" placeholder="Id Jenis" value="<?php echo $id_jenis; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Nama Jenis <?php echo form_error('nama_jenis') ?></label>
                            <input type="text" class="form-control" name="nama_jenis" id="nama_jenis" placeholder="Nama Jenis" value="<?php echo $nama_jenis; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Urutan <?php echo form_error('urutan') ?></label>
                            <input type="text" class="form-control" name="urutan" id="urutan" placeholder="Nama Jenis" value="<?php echo $urutan; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">COA <?php echo form_error('coa') ?></label>
                            <?php echo cmb_dinamis('coa','m_coa_pendapatan','nama_coa','id_coa',$coa) ?>
                        </div>
                        <div class="form-group">
                            <label for="varchar">COA Potongan <?php echo form_error('coa_potongan') ?></label>
                            <?php echo cmb_dinamis('coa_potongan','m_coa_pendapatan','nama_coa','id_coa',$coa_potongan) ?>
                        </div>
                        <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                        <div class="form-group">
                            <div class="row px-4">
                                <button type="submit" class="col btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo base_url('m_jenis') ?>" class="col btn btn-link">Batal</a>
                            </div>
                        </div>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
</div>

