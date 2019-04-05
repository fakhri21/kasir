<div class="container">
    <div class="row mb-2">
        <div class="col">
            
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo base_url('m_kategori') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                            <h2><?php echo $button . (isset($nama_kategori) ? ' '. $nama_kategori : '') ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="varchar">Id Kategori <?php echo form_error('id_kategori') ?></label>
                                    <input type="text" class="form-control" name="id_kategori" id="id_kategori" placeholder="Id Kategori" value="<?php echo $id_kategori; ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="varchar">Nama Kategori <?php echo form_error('nama_kategori') ?></label>
                                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" value="<?php echo $nama_kategori; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tinyint">Urutan <?php echo form_error('urutan') ?></label>
                                    <input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?php echo $urutan; ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="varchar">Isi <?php echo form_error('isi') ?></label>
                                    <input type="text" class="form-control" name="isi" id="isi" placeholder="Isi" value="<?php echo $isi; ?>" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                        <div class="row my-2 ">
                            <div class="col-4 ml-auto">

                                <button type="submit" class="col btn btn-primary"><?php echo $button ?></button> 

                            </div>
                            <div class="col-4 mr-auto">
                                <a href="<?php echo base_url('m_kategori') ?>" class="col btn btn-link">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

