<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <form method="get" action="<?= base_url('penjual/transaksi/filter_tgl/') ?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
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
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" class="input-tanggal form-control" />
                    </div>
                    <div id="form-bulan" class="form-group">
                        <label>Bulan</label>
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
                        </select>
                    </div>
                </div>

            </div>




            <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
            <a href="<?php echo base_url('penjual/transaksi'); ?>" class="btn btn-sm btn-secondary">Reset Filter</a>
        </form>
        <br>
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Tanggal Pesanan</th>
                    <th>Nama Customer</th>
                    <th>Alamat</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <!-- <th>Bukti Pembayaran</th> -->
                    <th>Aksi</th>

            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($transaksi as $tr) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tr['tgl_order'] ?></td>
                        <td><?= $tr['nama'] ?></td>
                        <td><?= $tr['alamat'] ?></td>
                        <td><?= $tr['metode'] ?></td>
                        <td><?php if ($tr['status_bayar'] == 0) {
                                echo "Belum Bayar";
                            } else {
                                echo "Lunas";
                            } ?></td>
                        <!-- <td><?php if ($tr['bukti_pembayaran'] == 0) {
                                        echo "Belum ada";
                                    } else { ?>
                                <a href="" class="btn btn-sm btn-success">Lihat</a>
                            <?php } ?>
                        </td> -->
                        <td>
                            <a href="<?= base_url('penjual/transaksi/detail_transaksi/') . $tr['id_faktur'] ?>" class="btn btn-sm btn-warning">Detail Pemesanan</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>