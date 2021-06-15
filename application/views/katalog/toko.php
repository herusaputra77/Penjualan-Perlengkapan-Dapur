<div class="content-wrapper">
	<section class="content-header">


	</section>
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h4>Toko <?= $toko['nama_toko'] ?></h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<img src="<?= base_url('assets/logo/') . $toko['logo'] ?>" style="width: 300px;">
					</div>
					<div class="col-md-6">
						<table class="table table-hover">
							<tr>
								<td>Nama Penjual</td>
								<td>:</td>
								<td><?= $penjual['nama'] ?></td>
							</tr>
							<tr>
								<td>No Handphone</td>
								<td>:</td>
								<td><?= $penjual['no_hp'] ?></td>
							</tr>
							<tr>
								<td>Alamat Toko</td>
								<td>:</td>
								<td><?= $penjual['alamat_toko'] ?></td>
							</tr>
						</table>
					</div>

				</div>



			</div>

		</div>
		<div class="card">
			<div class="card-header">
				<h4>Barang</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<?php foreach ($barang as $key => $value) { ?>
						<div class="col-md-4 mb-4">
							<form action="<?= base_url('katalog/keranjang/tambah_keranjang/') ?>" method="post">
								<input type="hidden" name="id" value="<?= $value['id_barang'] ?>">
								<input type="hidden" name="qty" value="1">
								<input type="hidden" name="price" value="<?= $value['harga'] ?>">
								<input type="hidden" name="name" value="<?= $value['nama_barang'] ?>">
								<input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
								<div class="col-md-4 text-center col-sm-6 col-xs-6">
									<div class="thumbnail product-box" style=" width: 23rem;">
										<img src="<?= base_url() . 'assets/barang/' . $value['gambar'] ?>" style="width: 100px; height: 100px" alt="" />
										<input type="hidden" name="gambar" value="<?= $value['gambar'] ?>">
										<div class="caption">
											<h3><a href="#"></a><?= $value['nama_barang'] ?></h3>
											<p>Harga : <strong> Rp. <?php echo number_format($value['harga'], 0, ',', '.') ?></strong> </p>

											<p><button type="submit" class="btn btn-success" role="button" id="tambah_keranjang"><i class="fa fa-plus"></i> <i class="fa fa-shopping-cart"></i></button>
												<a href="<?= base_url('dashboard/detail/') . $value['id_barang'] ?>" class="btn btn-primary"> Detail</a>
											</p>
										</div>
									</div>
								</div>
								<!-- /.col -->
							</form>
						</div>
					<?php } ?>
				</div>

			</div>

		</div>
	</section>

</div>