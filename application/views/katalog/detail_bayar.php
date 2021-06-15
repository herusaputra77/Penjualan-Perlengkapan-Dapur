<div class="container">
  <h3>Detail Pemesanan</h3>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <?php foreach ($nama_toko as $toko) {
        $barang = $this->M_barang->cari_toko($toko['id_toko']); ?>
        <button class="btn btn-white" style="width: 100%;"> <b>Nama Toko : <?= $toko['nama_toko'] ?></b></button>
        <?php foreach ($barang as $br) { ?>
          <div class="col-sm-4 text-center align-center col-sm-12 col-xs-6">

            <p><?= $br['nama_brg'] ?></p>
            <img src="<?= base_url() . 'assets/barang/' . $br['gambar'] ?>" style="width: 100px; height:100px;" />
            <p>Harga : Rp <?= number_format($br['harga'], 0, ',', '.')  ?> </p>
            <p class="btn btn-primary" style="width: 100%;">Jumlah order : <?= $br['jumlah'] ?> </p>
          </div>

        <?php } ?>
        <div class="col-md-12">
          <?php if ($toko['status_pengiriman'] == 2) { ?>
            <button class="btn btn-success" style="width: 100%; ">Status Pengiriman : Terkirim</button>
          <?php } else if ($toko['status_pengiriman'] == 1) { ?>
            <button class="btn btn-warning" style="width: 100%; font-size:1vw;">
              <h3>Status Pengiriman : Sedang Dalam Proses Pengiriman</h3>
            </button>
          <?php } else { ?>
            <button class="btn btn-danger" style="width: 100%; font-size:1vw;">
              <h6>Status Pengiriman : Menunggu Konfirmasi Pembeli</h6>
            </button>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>

  <!-- col -->

  <!-- row -->
  <h3>Ongkir : Rp. <?= number_format($pesanan['total_ongkir'], 0, ',', '.') ?> </h3>
  <h2>Total : Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.')  ?></h2>
</div>