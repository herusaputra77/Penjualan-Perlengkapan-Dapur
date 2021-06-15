<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">

		</div>
		<div class="col-md-8">
			<h4>Pembayaran</h4>
			<?php $i = 1; ?>
			<?php
			$grand_total = 0;
			$jml_item = 0;
			$ongkir = 0;
			if ($keranjang = $this->cart->contents()) {
				foreach ($keranjang as $items) {
					$barang = $this->M_barang->cari_id($items['id']);
					$jml_item += $items['qty'];
					$ongkir = $jml_item * 2000;
					$total = $this->cart->total();
					$grand_total =  $total + $ongkir;
					$i++;
				}
				// echo "<h4 class='mb-3'>Total : Rp. " . number_format($items['subtotal'], 0, ',', '.');
				echo "<h4 class='mb-3'>Biaya Ongkir : Rp. " . number_format($ongkir, 0, ',', '.');
				echo "<h4 class='mb-3'>Total belanja anda : Rp. " . number_format($grand_total, 0, ',', '.');

			?>
				<hr>

				<form action="<?= base_url('katalog/pembayaran/simpan_bayar') ?>" method="post">
					<input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
					<input type="hidden" name="nama" value="<?= $user['nama'] ?>">
					<input type="hidden" name="total_bayar" value="<?= $grand_total ?>">
					<input type="hidden" name="ongkir" value="<?= $ongkir ?>">
					<input type="hidden" name="jml_item" value="<?= $jml_item ?>">


					<div class="form-group mt-2">
						<label for="">Alamat Penerima</label>
						<input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat penerima yang valid...">
						<?php echo form_error('alamat', '<div class="text-danger small">', '</div>') ?>
					</div>
					<div class="form-group mt-2">
						<label for="">No Hp</label>
						<input type="text" name="no_hp" value="<?= $user['no_hp'] ?>" class="form-control">
					</div>
					<div class="form-group mt-2">
						<label for="">Alamat Email</label>
						<input type="text" name="email" value="<?= $user['email'] ?>" class="form-control" readonly>
					</div>
					<div class="form-group mt-2">
						<label for="">Metode Pembayaran</label>
						<select name="bayar" id="" class="form-control">
							<option value="">
								<--Metode Pembayaran-->
							</option>
							<?php foreach ($metode as $by) : ?>
								<option value="<?= $by['id_metode'] ?>"><?= $by['metode'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-6">

							<button type="submit" class="btn btn-sm btn-primary" style="width: 100%;"><i class="fa fa-check"></i> Bayar</button>
						</div>
						<div class="col-md-6">

							<a href="<?= base_url('katalog/keranjang') ?>" class="btn btn-sm btn-warning" style="width: 100%;"><i class="fa fa-times-circle"></i> Kembali</a>
						</div>

					</div>


				</form>
			<?php } ?>
		</div>
	</div>
</div>