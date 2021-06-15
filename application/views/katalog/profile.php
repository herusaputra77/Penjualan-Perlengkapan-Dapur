<div class="container">
	<h2 class="">My Profile</h2><br>
	<div class="row">
		<div class="col-md-2">
			<img src="<?= base_url('assets/user/') . $user['image'] ?>" style="width: 150px;">
		</div>
		<div class="col-md-3 mt-3" style="font-size: 20px; font-family: Times new roman;">
			<div>
				<label>Nama </label>
				<p><?= $user['nama'] ?></p>
			</div>
			<hr>
			<div>
				<label>Username </label>
				<p><?= $user['username'] ?></p>
			</div>
			<hr>
			<div>
				<label>Email </label>
				<p><?= $user['email'] ?></p>
			</div>
			<hr>

			<!-- <table border="0">	
				<tr class="btn btn-primary">
					<td><p>Nama :</p> </td>
					<td><p> <?= $user['nama'] ?></p></td>
				</tr>
				<tr class="btn btn-primary">
					<td><p>Nama :</p> </td>
					<td><p> <?= $user['nama'] ?></p></td>
				</tr>
			</table> -->
		</div>
		<div class="col-md-4" style="font-size: 20px; font-family: Times new roman;">
			<div>
				<label>Alamat </label>
				<p><?= $user['alamat'] ?></p>
			</div>
			<hr>
			<div>
				<label>Member Sejak </label>
				<p><?= date('d F Y', $user['tgl_buat']) ?></p>
			</div>
			<hr>
			<a href="<?= base_url('katalog/profile/edit_profile/') . $user['id_user'] ?>" class="btn btn-primary" style="width: 100%;"><i class="fa fa-edit"></i> Edit Profile</a>

		</div>

	</div>
	<!-- row -->
	<!-- <div class="row">
		<div class="col-md-3">
			<a href="<?= base_url('katalog/pembayaran') ?>" class="btn btn-success">PILIH PEMBAYARAN</a>
		</div>
		<div class="col-md-3">
			<a href="<?= base_url('katalog/pembayaran/detail_bayar') ?>" class="btn btn-success">DALAM PROSES</a>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-success">DALAM PENGIRIMAN</a>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-success">ULASAN</a>
		</div>

	</div> -->
</div>