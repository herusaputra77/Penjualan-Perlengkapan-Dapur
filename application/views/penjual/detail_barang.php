<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah Pesanan</th>
                    <th>Ongkir Persatuan</th>
                    <th>Total</th>
                    <th>Total Ongkir</th>
                    <th>Total Per Pesanan</th>
                </tr>
            </thead>

            <tbody>
                <?php $ni = 1;
                $total_bayar = 0;
                foreach ($barang as $key => $br) { ?>
                    <tr>
                        <td>
                            <?= $ni++ ?>
                        </td>
                        <td><?= $br['nama_brg'] ?></td>
                        <td>Rp. <?= number_format($br['harga'], 0, ',', '.') ?></td>
                        <td><?= $br['jumlah'] ?></td>
                        <td>Rp. <?= number_format($br['ongkir'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($br['total'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($br['total_ongkir'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($br['total_pesanan'], 0, ',', '.') ?></td>

                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="7">Total Pembayaran</td>
                    <td>Rp. <?= number_format($total_pesanan['total_pesanan'], 0, ',', '.')  ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>