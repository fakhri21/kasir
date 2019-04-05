<div class="container">
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <a href="javascript:history.back()" class="btn btn-link btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>    
                    <h2><?php echo $button . (isset($nama_product) ? ' '.$nama_product : '')?></h2>
                </div>
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_product">Id Product <?php echo form_error('id_product') ?></label>
                                    <input type="text" class="form-control" name="id_product" id="id_product" placeholder="Id Product" value="<?php echo $id_product; ?>" />
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_kategori">Id Kategori <?php echo form_error('id_kategori') ?></label>
                                    <?php echo cmb_dinamis('id_kategori','m_kategori','nama_kategori','id_kategori','id_kategori') ?>
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_jenis">Id Jenis <?php echo form_error('id_jenis') ?></label>
                                    <?php echo cmb_dinamis('id_jenis','m_jenis','nama_jenis','id_jenis','id_jenis') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_product">Nama Product <?php echo form_error('nama_product') ?></label>
                                    <input type="text" class="form-control" name="nama_product" id="nama_product" placeholder="Nama Product" value="<?php echo $nama_product; ?>" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="harga">Harga <?php echo form_error('harga') ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>   
                                        </div>
                                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
                                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="discount">Discount <?php echo form_error('discount') ?></label>
                                    <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?php echo $discount; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Status <?php echo form_error('status') ?></label>
                                    <select name="status" id="status">
                                        <option value="0">Tersedia</option>
                                        <option value="1">Out of Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col mt-auto">
                                <div class="form-group">
                                    <label>Gambar <?php echo form_error('gambar') ?> <?php echo $this->session->flashdata('upload_failed') ?></label>
                                    <label class="btn btn-default">
                                        Pilih <input hidden type="file" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                            <div class="col-6 mx-auto">
                                <div class="row">
                                    <button type="submit" class="col btn btn-primary"><?php echo $button ?></button> 
                                    <a href="<?php echo base_url('m_product') ?>" class="col btn btn-link">Cancel</a>     
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#id_kategori").selectize({
            create: false
        });
        $("#id_jenis").selectize({
            create: false
        });
        $("#status").selectize({
            create: false
        });
    })

</script>