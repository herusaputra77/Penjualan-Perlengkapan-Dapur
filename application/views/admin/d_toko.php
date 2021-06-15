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
              <th>Pemilik</th>
              <th>Data Transaksi</th>
              <th>Alamat Pemilik</th>
              <th>Alamat Toko</th>
              <th>Keterangan</th>
              <th>Aksi</th>

          </thead>
          <tbody>
            <tr>
              <?php $no = 1;
              foreach ($toko as $u) : ?>
                <td><?= $no++ ?></td>
                <td><?= $u->nama_toko ?></td>
                <td><?= $u->nama ?></td>
                <td><a href="<?= base_url('admin/penjual/transaksi_toko/') . $u->id_toko ?>">Transaksi</a></td>
                <td><?= $u->alamat ?></td>
                <td><?= $u->alamat_toko ?></td>
                <td><?= $u->keterangan ?></td>
                <td><a href="<?= base_url('admin/penjual/hapus_toko/') . $u->id_toko ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  <a href="<?= base_url('admin/penjual/detail/') . $u->id_toko ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                </td>

            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  <!-- Button trigger modal -->