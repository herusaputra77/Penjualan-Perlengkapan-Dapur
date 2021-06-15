
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Register Penjual</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lteplugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lteplugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_ltedist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lteplugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lteplugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lteplugins/summernote/summernote-bs4.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/admin_lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition" style="background: url('<?php echo base_url()?>assets/admin_lte/dist/img/photo1.png'); background-size:cover;">
 <!-- Main content -->
    <section class="content" style="width: 800px; margin: 100px auto;">
      <div class="container">

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('auth/reg_penjual/')?>" method="post">
         <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <div class="card-body">
                  <h4 align="center">Form Register Penjual</h4>
                  <?php echo $this->session->flashdata('pesan');?>
                  <div class="input-group mb-2">
                  <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                  </div>
                </div>
                <?= form_error('nama','<span class="text-small text-danger">','</span>')?>
                  <div class="input-group mb-2">
                  <input type="text" class="form-control" name="username" placeholder="Username...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                  </div>
                </div>
                  <?= form_error('username','<span class="text-small text-danger">','</span>')?>
                <div class="input-group mb-2">
                  <input type="email" class="form-control" name="email" placeholder="Alamat email...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                </div>
                <?= form_error('email','<span class="text-small text-danger">','</span>')?>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="alamat" placeholder="Alamat tinggal...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                  </div>
                </div>
                <?= form_error('alamat','<span class="text-small text-danger">','</span>')?>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="no_hp" placeholder="No HP...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                  </div>
                </div>
                <?= form_error('no_hp','<span class="text-small text-danger">','</span>')?>
                <div class="form-group">
                        <select class="form-control" name="gender">
                          <option value=""><--Pilih Gender--></option>
                          <option value="pria">Pria</option>
                          <option value="wanita">Wanita</option>
                        </select>
                      </div>
                      <?= form_error('gender','<span class="text-small text-danger">','</span>')?>
                <div class="input-group mb-2">
                  <input type="password" class="form-control" name="password1" placeholder="Password...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                </div>
                <?= form_error('password1','<span class="text-small text-danger">','</span>')?>
                <div class="input-group mb-2">
                  <input type="password" class="form-control" name="password2" placeholder="Ulangi password...">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                </div>
                <?= form_error('password2','<span class="text-small text-danger">','</span>')?>
                <div class="col-md-6"> 

                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <p align="right"><a href="<?= base_url('auth/login')?>" class="align-right">Sudah memiliki akun|Login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
            <!-- /.card -->
  <!-- Main Footer -->
  <!-- <footer class="main-footer"> -->
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> -->
    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin_lteplugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>assets/admin_lte<?php echo base_url()?>assets/admin_lteplugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()?>assets/admin_lteplugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/admin_ltedist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- jQuery -->
<script src="<?php echo base_url()?>assets/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/admin_lte/dist/js/adminlte.min.js"></script>
</body>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/admin_lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>assets/admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>assets/admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#datatable').DataTable();
        });
      </script>
</html>

</body>
</html>
