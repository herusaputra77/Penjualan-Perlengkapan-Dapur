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
              <th>Nama</th>
              <th>Username</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>Aksi</th>

          </thead>
          <tbody>
            <tr>
              <?php $no = 1;
              foreach ($penjual as $u) : ?>
                <td><?= $no++ ?></td>
                <td><?= $u->nama ?></td>
                <td><?= $u->username ?></td>
                <td><?= $u->jenis_kelamin ?></td>
                <td><?= $u->alamat ?></td>
                <?php foreach ($validasi as $v) { ?>
                  <?php if ($v->id_user == '') { ?>
                    <td>
                      <a href="<?= base_url('admin/penjual/validasi/') . $u->id_user ?>" class="btn btn-sm btn-primary">Validasi
                    </td>
                  <?php } else { ?>
                    <td>
                      Saudah di Validasi
                    </td>
                  <?php } ?>
                  </a>
                <?php } ?>
                <td><a href="<?= base_url('admin/penjual/hapus/') . $u->id_user ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  <a href="<?= base_url('admin/user/edit/') . $u->id_user ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                  <a href="<?= base_url('admin/penjual/detail_penjual/') . $u->id_user ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                </td>

            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>