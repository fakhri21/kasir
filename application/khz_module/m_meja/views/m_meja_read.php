
<div class="container">
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-1">
                <div class="box-header">
                    <a href="<?php echo base_url('m_meja') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title"> <?php echo $nama_meja; ?> <small class="text-muted font-weight-light" style="line-height: 42px;">(id : <?php echo $id_meja; ?>)</small></h3>
                            
                        </div>
                        

                    </div>

                    <h6 class="card-subtitle mb-2 text-muted">Urutan <?php echo $urutan; ?></h6>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    Harga Tambahan Meja
                                </div>
                                <div class="col-2">
                                    : Rp. <?php echo  number_format($harga_tambahan_meja,0,",","."); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    Status
                                </div>
                                <div class="col-2">
                                    : <?php echo $status; ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    Kondisi
                                </div>
                                <div class="col-2">
                                    : <?php echo $kondisi; ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
