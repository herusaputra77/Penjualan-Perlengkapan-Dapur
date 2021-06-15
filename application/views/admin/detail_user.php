

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
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
         <!-- /.col-md-6 -->
          <div class="col-lg-12"> 
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="<?= base_url('assets/user/').$detail['image']?>" style="width: 400px;">
                  </div>
                  <div class="col-md-6"> 
                    
                <table class="table table-striped table-hover">
                  <tr>
                    <td>Nama </td>
                    <td>:</td>
                    <td><?= $detail['nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><?= $detail['username'] ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $detail['email'] ?></td>
                  </tr>
                  <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td><?= $detail['no_hp']?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Buat</td>
                    <td>:</td>
                    <td><?= date('d F Y',$detail['tgl_buat']) ?></td>
                  </tr>
                  <tr>
                    <td>Role</td>
                    <td>:</td>
                    <?php if($detail['id_role'] == 2){?>
                    <td>Penjual</td>
                  <?php }else{?>
                    <td>Customer</td>
                  <?php } ?>
                  </tr>
                </table>
                <a href="<?= base_url('admin/user')?>" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
      </div>
    </div>
  </div>