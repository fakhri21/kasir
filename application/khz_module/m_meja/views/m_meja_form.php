
<div class="container">
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-1">
                <div class="box-header">
                    <a href="javascript:history.back()" class="btn btn-link btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <h2><?php echo $button . " " . (isset($nama_meja) ? $nama_meja : '') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form class="card" action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="id_meja" class="col-sm-2 col-form-label">Id Meja <?php echo form_error('id_meja') ?></label>
                        <div class="col-sm-10  my-auto">
                            <input type="text" placeholder="Id Meja" class="form-control" name="id_meja" id="id_meja" value="<?php echo $id_meja; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="urutan" class="col-sm-2 col-form-label">Urutan <?php echo form_error('urutan') ?></label>
                        <div class="col-sm-10  my-auto">
                            <input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?php echo $urutan; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_meja" class="col-sm-2 col-form-label">Nama Meja <?php echo form_error('nama_meja') ?></label>
                        <div class="col-sm-10  my-auto">
                            <input type="text" class="form-control" name="nama_meja" id="nama_meja" placeholder="Nama Meja" value="<?php echo $nama_meja; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_tambahan_meja" class="col-sm-2 col-form-label">Harga Tambahan Meja <?php echo form_error('harga_tambahan_meja') ?></label>
                        <div class="col-sm-10 my-auto">
                            <input type="text" class="form-control" name="harga_tambahan_meja" id="harga_tambahan_meja" placeholder="Harga Tambahan Meja" value="<?php echo $harga_tambahan_meja; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status <?php echo form_error('status') ?></label>
                        <div class="col-sm-10  my-auto">
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kondisi" class="col-sm-2 col-form-label">Kondisi <?php echo form_error('kondisi') ?></label>
                        <div class="col-sm-10  my-auto">
                            <input type="text" class="form-control" name="kondisi" id="kondisi" placeholder="Kondisi" value="<?php echo $kondisi; ?>" />
                        </div>
                    </div>
                    <input class="" type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                    <div class="row">
                        <button type="submit" class="col btn btn-primary mx-3"><?php echo $button ?></button> 
                        <a class="col text-center my-auto mx-3" href="<?php echo base_url('m_meja') ?>" class="btn btn-default">Cancel</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

