<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?= $this->session->flashdata('pesan'); ?>
        <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah_barang"><i class="fas fa-plus" ></i>
        Tambah
      </button>        -->
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Toko</th>
                    <th>Aksi</th>
                    <!-- <th>Aksi</th> -->

            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($detail_transaksi as $dt) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $dt['nama_toko'] ?></td>
                        <td>
                            <form action="<?= base_url('penjual/transaksi/print_faktur') ?>" method="post">
                                <input type="hidden" name="id_toko" value="<?= $dt['id_toko'] ?>">
                                <input type="hidden" name="id_faktur" value="<?= $dt['id_faktur'] ?>">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-print"></i></button>
                            </form>
                            <form action="<?= base_url('penjual/transaksi/detail_brg') ?>" method="post">
                                <input type="hidden" name="id_toko" value="<?= $dt['id_toko'] ?>">
                                <input type="hidden" name="id_faktur" value="<?= $dt['id_faktur'] ?>">
                                <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></button>
                            </form>
                            <?php if ($dt['status_pengiriman'] == 2) { ?>
                                <button type="submit" class="btn btn-sm btn-success" data-toggle="modal" data-target="#terkirim<?php echo $dt['id_toko'] ?>"><i class="fas fa-truck"></i></button>
                            <?php } else if ($dt['status_pengiriman'] == 1) { ?>
                                <button type="submit" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#prosespengiriman<?php echo $dt['id_toko'] ?>"><i class="fas fa-truck"></i></button>

                            <?php } else { ?>

                                <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#pengiriman<?php echo $dt['id_toko'] ?>"><i class="fas fa-truck"></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!-- Button trigger modal -->


<?php $no = 0;
foreach ($detail_transaksi as $u) : $no++ ?>
    <!-- Modal -->
    <div class="modal fade" id="pengiriman<?= $u['id_toko'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i> Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('penjual/transaksi/pengiriman') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Toko</label>
                            <input type="text" name="nama_toko" class="form-control" value="<?= $u['nama_toko'] ?>" readonly>
                            <input type="hidden" name="id_toko" value="<?= $u['id_toko'] ?>">
                            <input type="hidden" name="id_faktur" value="<?= $u['id_faktur'] ?>">
                            <input type="hidden" name="id_user" value="<?= $u['id_user'] ?>">
                            <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pengirim</label>
                            <input type="text" name="nama_pengirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">No Hp Pengirim</label>
                            <input type="text" name="no_hp_pengirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="kendaraan" class="form-control" id="">
                                <option value="">
                                    <-Pilih Jenis Kendaraan->
                                </option>
                                <option value="Motor">Motor</option>
                                <option value="Mobil">Mobil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Tujuan</label>
                            <input type="text" name="alamat_tujuan" value="<?= $u['alamat'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php $no = 0;
foreach ($detail_transaksi as $dl) {
    $proses_pengiriman = $this->M_invoice->proses_pengiriman($dl['id_toko']);
    foreach ($proses_pengiriman as $pp) : $no++ ?>
        <!-- Modal -->
        <div class="modal fade" id="prosespengiriman<?= $pp['id_toko'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i>Proses Pengiriman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('penjual/transaksi/order_terkirim') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input type="hidden" name="id_toko" value="<?= $pp['id_toko'] ?>">
                                <input type="hidden" name="id_faktur" value="<?= $pp['id_faktur'] ?>">
                                <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                                <p><?= $pp['nama_pengirim'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">No Hp Pengirim</label>
                                <p><?= $pp['no_hp_pengirim'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kendaraan</label>
                                <p><?= $pp['kendaraan'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pengirim</label>
                                <p><?= $pp['alamat_pengiriman'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Status Pengirim</label>
                                <p>Dalam Proses Pengiriman</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Validasi Pengiriman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?php $no = 0;
foreach ($detail_transaksi as $dl) {
    $proses_pengiriman = $this->M_invoice->proses_pengiriman($dl['id_toko']);
    foreach ($proses_pengiriman as $pp) : $no++ ?>
        <!-- Modal -->
        <div class="modal fade" id="terkirim<?= $pp['id_toko'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i>Proses Pengiriman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('penjual/transaksi/order_terkirim') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input type="hidden" name="id_toko" value="<?= $pp['id_toko'] ?>">
                                <input type="hidden" name="id_faktur" value="<?= $pp['id_faktur'] ?>">
                                <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                                <p><?= $pp['nama_pengirim'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">No Hp Pengirim</label>
                                <p><?= $pp['no_hp_pengirim'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kendaraan</label>
                                <p><?= $pp['kendaraan'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pengirim</label>
                                <p><?= $pp['alamat_pengiriman'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Status Pengirim</label>
                                <p>Pesanan Telah Dikirim</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>