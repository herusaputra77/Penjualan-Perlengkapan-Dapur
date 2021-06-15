<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <?php $id = $this->session->userdata('id_user');
        $transaksi = $this->M_invoice->notifikasi($id); ?>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"><?= $transaksi['hasil']  ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?= $transaksi['hasil']  ?> Notifikasi Transaksi</span>
            <?php $id = $this->session->userdata('id_user');
            $notifikasi = $this->M_invoice->detail_notifikasi($id);
            foreach ($notifikasi as $key => $value) { ?>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('penjual/transaksi/detail_transaksi/') . $value['id_faktur'] ?>" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> <?= $value['nama'] ?>
                <span class="float-right text-muted text-sm"><?= $value['tgl_order'] ?></span>
              </a>
              <div class="dropdown-divider"></div>
            <?php } ?>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="<?php echo base_url('assets/user/') . $user['image'] ?>" class="img-circle elevation-2" alt="User Image" style="width: 30px;">
            <p></p>
            <span class="badge badge-warning navbar-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header"><?= $this->session->userdata('username') ?></span>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('penjual/profile') ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>My Profile
              <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('penjual/profile/edit_profile/') ?>" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> Edit Profile
              <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('penjual/profile/ganti_password/') ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Ganti Password
              <span class="float-right text-muted text-sm"></span>
            </a>
            <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> -->

        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->
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
                <li class="breadcrumb-item"><a href=""><?= $this->uri->segment(1) ?></a></li>
                <li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->