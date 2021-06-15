<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $judul ?> <?= $toko['nama_toko'] ?></h1>
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
            <form method="post" action="<?= base_url('admin/penjual/filter_tgl_toko/') ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="hidden" name="id_toko" value="<?= $toko['id_toko'] ?>">
                            <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                            <label>Filter Berdasarkan</label><br>
                            <select name="filter" id="filter" class="form-control">
                                <option value="">Pilih</option>
                                <option value="1">Per Tanggal</option>
                                <option value="2">Per Bulan</option>
                                <option value="3">Per Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="form-tanggal" class="form-group">
                            <label>Tanggal</label><br>
                            <input type="text" name="tanggal" class="input-tanggal form-control" />
                        </div>
                        <div id="form-bulan" class="form-group">
                            <label>Bulan</label><br>
                            <select name="bulan" class="form-control">
                                <option value="">Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="form-tahun" class="form-group">
                            <label>Tahun</label><br>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Pilih</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                <a href="<?php echo base_url('admin/penjual/transaksi_toko/') . $toko['id_toko']; ?>" class="btn btn-sm btn-secondary">Reset Filter</a>
            </form><br>
            <!-- <b><?= $ket ?></b> -->

            <br>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tanggal Transaksi</th>
                        <th>Alamat Pengiriman</th>
                        <th>Nama Konsumen</th>
                        <th>Ongkir</th>
                        <th>Total Bayar</th>

                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($filter as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['tgl_order'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['ongkir'] ?></td>
                            <td><?= $value['total_bayar'] ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- Button trigger modal -->