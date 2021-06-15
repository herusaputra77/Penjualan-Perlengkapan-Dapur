<div class="container-fluid">
    <h3>Pesanan</h3>
    <div class="table-container">
        <table class="table table-hover">
            <tr>
                <th>No Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Tanggal Pesanan</th>
                <th>Alamat Pengiriman</th>
                <th>Metode Pembayaran</th>
                <th>Total Bayar</th>
                <th>Status Bayar</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($pesanan as $key => $value) { ?>
                <tr>
                    <td><?= $value['id_faktur'] ?></td>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['tgl_order'] ?></td>
                    <td><?= $value['alamat'] ?></td>
                    <td><?= $value['metode'] ?></td>
                    <td>Rp. <?= number_format($value['total_bayar'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($value['status_bayar'] == 2) {
                            echo "Lunas";
                        } ?></td>
                    <!-- <td>
                    <?php if ($value['metode_bayar'] == 0) {
                        echo "Belum Dikirim";
                    } else if ($value['metode_bayar'] == 1) {
                        echo "Sedang Dikirim";
                    } else {
                        echo "Terkirim";
                    } ?>
                </td> -->
                    <td>
                        <a href="<?= base_url('katalog/pembayaran/detail_bayar/') . $value['id_faktur'] ?>" class="btn btn-sm btn-primary">Detail Pesanan</a><br>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div>