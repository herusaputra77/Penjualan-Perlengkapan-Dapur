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
                        <th>Nama Toko</th>
                        <th>Alamat Toko</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($detail_pesanan as $dp) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $dp['nama_toko'] ?></td>
                            <td><?= $dp['alamat_toko'] ?></td>
                            <td><?= $dp['keterangan'] ?></td>
                            <td>
                                <form action="<?= base_url('admin/penjual/detail_barang') ?>" method="post">
                                    <input type="hidden" name="id_toko" value="<?= $dp['id_toko'] ?>">
                                    <input type="hidden" name="id_faktur" value="<?= $dp['id_faktur'] ?>">
                                    <button type="submit" class="btn btn-sm btn-secondary"> <i class="fas fa-eye"></i></button>
                                </form>
                                <form action="<?= base_url('admin/penjual/cetak_faktur') ?>" method="post">
                                    <input type="hidden" name="id_toko" value="<?= $dp['id_toko'] ?>">
                                    <input type="hidden" name="id_faktur" value="<?= $dp['id_faktur'] ?>">
                                    <button type="submit" class="btn btn-sm btn-success"> <i class="fas fa-print"></i></button>
                                </form>
                                <!-- <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#toko<?= $dp['id_toko'] ?>">
                                    Detail Barang
                                </button> -->
                                <a href="" class="btn btn-sm btn-primary">Validasi</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <!-- Button trigger modal -->

        </div>
    </div>
</div>


<!-- Modal -->
<!-- <?php $no = 0;
        $total_bayar = 0;
        foreach ($detail_pesanan as $key => $value) {
            $no++ ?>
    <div class="modal fade" id="toko<?= $value['id_toko'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah Pesanan</th>
                                <th>Total</th>
                                <th>Ongkir Persatuan</th>
                                <th>Total Ongkir</th>
                                <th>Total Per Pesanan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $ni = 1;
                            foreach ($barang as $key => $br) { ?>
                                <tr>
                                    <td>
                                        <?= $ni++ ?>
                                    </td>
                                    <td><?= $br['nama_brg'] ?></td>
                                    <td>Rp. <?= number_format($br['harga'], 0, ',', '.') ?></td>
                                    <td><?= $br['jumlah'] ?></td>
                                    <td>Rp. <?= number_format($br['total'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($br['ongkir'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($br['total_ongkir'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($br['total_pesanan'], 0, ',', '.') ?></td>
                                    <td></td>

                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="7">Total Pembayaran</td>
                                <td>Rp. <?= number_format($total_bayar += $value['total_pesanan'], 0, ',', '.')  ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?> -->