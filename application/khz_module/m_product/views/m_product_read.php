<style type="text/css">
	.card-img-top{
		min-height: 150px;
		background-color: #d6dde7;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="box box-primary mb-2">
				<div class="box-header">
					<a href="<?php echo base_url('m_product') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" ></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-4">
			
			<div class="card">
				<img class="card-img-top d-flex align-items-center justify-content-center" src="<?php echo $gambar ?>" alt="Gambar Tidak Tersedia">
				<div class="card-body">
					<h5 class="card-title"><?php echo $nama_product; ?></h5>
					<div class="row">
						<div class="col">
							<h6 class="text-muted">Di Buat Oleh</h6>
						</div>
						<div class="col">
							<h6 class="text-muted"><?php echo $user_pembuat; ?></h6>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="text-muted">Id Produk</h6>
						</div>
						<div class="col">
							<h6 class="text-muted"><?php echo $id_product; ?></h6>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="text-muted">Id Kategori</h6>
						</div>
						<div class="col">
							<h6 class="text-muted"><?php echo $id_kategori; ?></h6>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="text-muted">Id Jenis</h6>
						</div>
						<div class="col">
							<h6 class="text-muted"><?php echo $id_jenis; ?></h6>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-header"> <h2>Keterangan</h2></div>
				<div class="card-body">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="row">
								<div class="col-3">
									<span>Deskripsi</span>
								</div>
								<div class="col">
									: <span><?php echo $deskripsi; ?></span>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-3">
									<span>Harga</span>
								</div>
								<div class="col">
									: Rp. <span><?php echo number_format($harga, 0, ',', '.'); ?>,-</span>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-3">
									<span>Discount</span>
								</div>
								<div class="col">
									: Rp. <span><?php echo $discount; ?>,-</span>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-3">
									<span>Tanggal Dibuat</span>
								</div>
								<div class="col">
									: 	<span><?php echo $tgl_dibuat; ?></span>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-3">
									<span>Status</span>
								</div>
								<div class="col">
									: 	<span><?php echo $status; ?></span>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>