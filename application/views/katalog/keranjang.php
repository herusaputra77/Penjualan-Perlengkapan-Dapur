<div class="container-fluid">
	<h4>Keranjang Belanja</h4>
	<?php if (empty($this->cart->contents())) { ?>
		<h1 align="center">Kerajang Belanja Kosong!!!</h1>
		<center>
			<a href="<?= base_url('dashboard/') ?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Belanja</a>
		</center>
	<?php } else { ?>
		<div class="table-container">

			<table id="" class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Nama Toko</th>
						<th>Gambar</th>
						<th width="85px">Jumlah</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th>Sub Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<form action="<?= base_url('katalog/keranjang/update') ?>" method="post">
						<?php $i = 1; ?>
						<?php $no = 1;
						foreach ($this->cart->contents() as $items) :
							$barang = $this->M_barang->cari_id($items['id']); ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $items['name'] ?></td>
								<td><?= $barang->nama_toko ?> </td>
								<td align="center"><img src="<?= base_url('assets/barang/') . $barang->gambar ?>" style="width: 50px;"></td>
								<td><?php echo form_input(array(
										'name' => $i . '[qty]',
										'value' => $items['qty'],
										'maxlength' => '3',
										'size' => '5',
										'min' => '1',
										'type' => 'number',
										'class' => 'form-control'
									)); ?></td>
								<td><?= $barang->satuan ?></td>
								<td align="right">Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
								<td align="right">Rp. <?= number_format($items['subtotal'], 0, ',', '.') ?></td>
								<td><a href="<?= base_url('katalog/keranjang/delete/') . $items['rowid'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a></td>
							</tr>
							<?php $i++ ?>
						<?php endforeach; ?>
						<tr>
							<td colspan="7">
								<h3><strong>Total</strong></h3>
							</td>
							<td align="right">
								<h3><strong>Rp. <?php echo number_format($this->cart->total(), 0, ',', '.') ?></strong></h3>
							</td>
						</tr>
				</tbody>

			</table>
		</div>
		<button type="submit" class="btn btn-sm btn-success btn-flat" style="background-color: navy;"><i class="fa fa-edit"></i> Update Keranjang</button>
		</form>
		<div align="center">
			<a href="<?= base_url('katalog/keranjang/hapus_keranjang/') ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Keranjang</a>
			<a href="<?= base_url('katalog/pembayaran/') ?>" class="btn btn-sm btn-success"><i class="fa fa-dollar"></i> Bayar</a>
			<a href="<?= base_url('dashboard/') ?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Belanja</a>
		</div>
	<?php } ?>

	<!-- <div class="perhitungan">
		<p><?= $items['name']; ?></p>
		</div> -->
</div>