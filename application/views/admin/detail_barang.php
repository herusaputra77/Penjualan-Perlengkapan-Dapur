<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $judul ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

            <!-- Button trigger modal -->

        </div>
    </div>
</div>