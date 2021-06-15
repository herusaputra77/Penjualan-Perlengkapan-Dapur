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
              <?= $this->session->flashdata('pesan'); ?>
              <br>
              <form method="post" action="<?= base_url('admin/penjual/filter_tgl/') ?>">
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
                  <a href="<?php echo base_url('admin/penjual/pemesanan'); ?>" class="btn btn-sm btn-secondary">Reset Filter</a>
              </form><br>
              <b><?= $ket ?></b>

              <br>
              <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>NO</th>
                          <th>Tanggal Pesanan</th>
                          <th>Alamat</th>
                          <th>Nama Konsumen</th>
                          <th>Ongkir</th>
                          <th>Total Bayar</th>
                          <th>Metode Pembayaran</th>
                          <th>Status Bayar</th>
                          <th>Bukti Pembayaran</th>
                          <th>Aksi</th>

                  </thead>
                  <tbody>
                      <?php $no = 1;
                        foreach ($pesanan as $key => $value) { ?>
                          <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $value['tgl_order'] ?></td>
                              <td width="20px"><?= $value['alamat'] ?></td>
                              <td><?= $value['nama'] ?></td>
                              <td><?= $value['ongkir'] ?></td>
                              <td><?= $value['total_bayar'] ?></td>
                              <td><?= $value['metode'] ?></td>
                              <td><?php if ($value['status_bayar'] == 0) { ?>
                                      <p>Belum Bayar</p>
                                  <?php } else if ($value['status_bayar'] == 1) { ?>
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $value['id_faktur'] ?>">
                                          Konfirmasi
                                      </button>
                                  <?php } else { ?>
                                      <p>Lunas</p>
                                  <?php } ?>
                              </td>
                              <td> <a href="<?= base_url('assets/bukti_pembayaran/' . $value['bukti_pembayaran']) ?>"><?= $value['bukti_pembayaran'] ?></a> </td>
                              <td><a href="<?= base_url('admin/penjual/detail_pesanan/') . $value['id_faktur'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                 
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <?php $no = 1;
    foreach ($pesanan as $ps) { ?>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal<?= $ps['id_faktur'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin <strong><?= $ps['nama'] ?></strong> sudah membayar?</p>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <a href="<?= base_url('admin/penjual/validasi_pembayaran/') . $ps['id_faktur'] ?>" class="btn btn-sm btn-success">Yakin</a>
                  </div>
              </div>
          </div>
      </div>
  <?php } ?>