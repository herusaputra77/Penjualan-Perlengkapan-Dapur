<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin_lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin_lte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background-image: url('<?php echo base_url() ?>assets/admin_lte/dist/img/photo1.png'); background-size:cover;">
  <div class="login-box">
    <div class="login-logo">
      <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <?php echo $this->session->flashdata('login'); ?>
        <?php echo $this->session->flashdata('pesan'); ?>
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?= base_url('auth/login') ?>" method="post">
          <div class="input-group ">
            <input type="email" class="form-control" name="email" placeholder="Email">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div>

            <?= form_error('email', '<span class="text-small text-danger">', '</span>') ?>
          </div>
          <div class="input-group mt-2 ">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?= form_error('password', '<span class="text-small text-danger">', '</span>') ?>
          <div class="row">
            <div class="">
              <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
            </div>
            <!-- /.col -->
            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"> Sign In</i></button>
            </div>
            <div class="col-md-12">
              <p align="center"><a href="<?php echo base_url('auth/register') ?>" class="mt-3 ">Silahkan registrasi akun!</a></p>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-0">
          <a href="<?= base_url('auth/register/') ?>" class="text-center"></a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/admin_lte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/admin_lte/dist/js/adminlte.min.js"></script>
</body>

</html>