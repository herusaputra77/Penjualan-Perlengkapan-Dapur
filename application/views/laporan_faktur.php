<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        h1 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body">
    <h1>Faktur Penjualan</h1>
    <h3>Nama Toko : <?= $toko['nama_toko'] ?></h3>
    <h3>Alamat Toko : <?= $toko['alamat_toko'] ?></h3>
    <!--     -->
    <hr>
    <h3>Faktur</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <p>Nama : <?= $toko['nama'] ?></p>
                <p>No HP : <?= $toko['no_hp'] ?></p>
                <p>Alamat : <?= $toko['alamat'] ?></p>
                <p>Tanggal Transaksi : <?= date('d-m-Y', strtotime($toko["tgl_order"])) ?></p>
            </div>
            <div class="col-md-6">
                <p>No Faktur : <?= $toko['id_faktur'] ?></p>
                <p>Metode Pembayaran : <?= $toko['metode'] ?></p>
            </div>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Ongkir</th>
                        <th>Jumlah Pesanan</th>
                        <th>Total Per Pesanan</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    $total_bayar = 0;
                    foreach ($barang as $key => $br) { ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td><?= $br['nama_brg'] ?></td>
                            <td>Rp. <?= number_format($br['harga'], 0, ',', '.') ?></td>
                            <td><?= $br['ongkir'] ?></td>
                            <td><?= $br['jumlah'] ?></td>
                            <td>Rp. <?= number_format($br['total'], 0, ',', '.') ?></td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="5">Total</td>
                        <td>Rp. <?= number_format($total_pesanan['total'], 0, ',', '.')  ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Total Ongkir</td>
                        <td>Rp. <?= number_format($total_pesanan['ongkir'], 0, ',', '.')  ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Total Pembayaran</td>

                        <td>Rp. <?= number_format($total_pesanan['total_pesanan'], 0, ',', '.')  ?></td>

                    </tr>
                </tbody>
            </table>
            <div class="right">
                <label for="">Hormat Kami</label><br>
                <br>
                <p>(<?= $penjual['penjual'] ?>)</p>
            </div>
        </div>
    </div>
    </body>

</html>