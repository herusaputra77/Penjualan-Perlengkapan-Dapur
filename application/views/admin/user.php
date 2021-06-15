<!-- Content Wrapper. Contains page content -->
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
  <div class="content">
    <div class="container-fluid">
      <?= $this->session->flashdata('pesan'); ?>

      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Aksi</th>

        </thead>
        <tbody>
          <tr>
            <?php $no = 1;
            foreach ($user1 as $s) : ?>
              <td><?= $no++ ?></td>
              <td><?= $s->nama ?></td>
              <td><?= $s->username ?></td>
              <td><?= $s->role ?></td>
              <td><?= $s->jenis_kelamin ?></td>
              <td><?= $s->alamat ?></td>
              <?php if ($s->id_role == '1') : ?>
                <td><button class="btn btn-secondary"><i class="fas fa-lock"></i> No Action</button></td>
              <?php else : ?>
                <td>

                  <a href="<?= base_url('admin/user/hapus/') . $s->id_user ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $s->id_user ?>"><i class="fas fa-edit"></i>
                  </button>
                  <a href="<?= base_url('admin/user/detail/') . $s->id_user ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                </td>
              <?php endif; ?>

          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- Button trigger modal -->


<!-- Modal -->
<?php $no = 0;
foreach ($user1 as $u) : $no++ ?>
  <div class="modal fade" id="exampleModal<?= $u->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= base_url('admin/user/edit_user/') ?>">
            <div class="form-group">
              <select name="role" class="form-control">
                <option value="<?= $u->id_role ?>"><?php echo $u->role ?></option>
                <?php foreach ($role as $rl) : ?>
                  <option value="<?= $rl->id_role ?>"><?= $rl->role ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="nama" value="<?= $u->nama ?>">
              <input type="hidden" class="form-control" name="id_user" value="<?= $u->id_user ?>">

            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="username" value="<?= $u->username ?>">

            </div>
            <div class="form-group">
              <select name="gender" class="form-control">
                <option value="<?= $u->jenis_kelamin ?>"><?= $u->jenis_kelamin ?></option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>

              </select>
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