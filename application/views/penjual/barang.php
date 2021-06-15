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
          <th>Nama Barang</th>
          <th>Gambar Barang</th>
          <th>Alamat Toko</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <!-- <th>Aksi</th> -->

      </thead>
      <tbody>
        <?php $no = 1;
        foreach ($barang as $br) : ?>
          <form>
            <input type="hidden" name="redirect" value="<?= str_replace('index.php/', '', current_url()); ?>">
          </form>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $br->nama_toko ?></td>
            <td><?= $br->nama_barang ?></td>
            <td><img src="<?php echo base_url() . 'assets/barang/' . $br->gambar ?>" style="width: 50px;"></td>
            <td><?= $br->alamat_toko ?></td>
            <td>Rp. <?= number_format($br->harga, 0, ',', '.') ?></td>
            <td><?= $br->jumlah ?></td>
            <td><?= $br->satuan ?></td>
            <!-- <td><a href="<?= base_url('penjual/barang/hapus/') . $br->id_barang ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editbarang<?php echo $br->id_barang ?>"><i class="fas fa-edit"></i>
              </button>
              <a href="<?= base_url('penjual/barang/detail/') . $br->id_barang ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
            </td> -->

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cubes"></i>Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('penjual/barang/tambah_barang') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang...">
            <input type="hidden" name="id_penjual" value="<?= $penjual->id_penjual ?>">
          </div>
          <div class="form-group">
            <select class="form-control" name="toko">
              <option>
                <--Pilih Toko Anda-->
              </option>
              <?php foreach ($toko as $tk) : ?>
                <option value="<?= $tk->id_toko ?>"><?= $tk->nama_toko ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="jumlah" placeholder="Jumlah...">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="harga" placeholder="Harga...">
          </div>
          <div class="form-group">
            <select name="satuan" class="form-control">
              <option value="">
                <--Pilih Satuan-->
              </option>
              <?php foreach ($satuan as $st) : ?>
                <option value="<?= $st['satuan'] ?>"><?= $st['satuan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="gambar" value="">
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

<!-- Modal -->
<?php $no = 0;
foreach ($barang as $br) : $no++ ?>
  <div class="modal fade" id="editbarang<?php echo $br->id_barang ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url('penjual/barang/edit_barang') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" class="form-control" name="nama_barang" value="<?= $br->nama_barang ?>">
              <input type="hidden" name="id_barang" value="<?= $br->id_barang ?>">
            </div>
            <div class="form-group">
              <select name="toko" class="form-control">
                <option value="<?= $br->id_toko ?>"><?php echo $br->nama_toko ?></option>
                <?php foreach ($toko as $tk) : ?>
                  <option value="<?= $tk->id_toko ?>"><?= $tk->nama_toko ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <input type="number" class="form-control" name="jumlah" value="<?php echo $br->jumlah ?>">
              <input type="hidden" name="redirect" value="<?= str_replace('index.php/', '', current_url()); ?>">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" name="harga" value="<?php echo $br->harga ?>">
            </div>
            <div class="form-group">
              <select name="satuan" class="form-control">
                <option value=""><?= $br->satuan ?></option>
                <?php foreach ($satuan as $st) : ?>
                  <option value="<?= $st['satuan'] ?>"><?= $st['satuan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-3">
                    <img src="<?= base_url('assets/barang/') . $br->gambar ?>" class="img-thumbnail">
                  </div>
                  <div class="col-sm-9">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="gambar" name="gambar">
                      <label class="custom-file-label" for="gambar">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Ubah Data</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>