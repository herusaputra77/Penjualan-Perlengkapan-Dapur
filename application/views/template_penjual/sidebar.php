<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('penjual/dashboard') ?>" class="brand-link">
    <img src="<?php echo base_url() ?>assets/admin_lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b>Dashboard</b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/user/') . $user['image'] ?>" class="img-circle elevation-2">
      </div>

      <div class="info">
        <a href="<?= base_url('penjual/profile/') ?>" class="d-block"><?php echo $this->session->userdata('nama') ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">

        <li class="nav-item">
          <a href="<?php echo base_url('penjual/toko/') ?>" class="nav-link">
            <i class="nav-icon fas fa-store-alt"></i>
            <p>
              Toko

            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('penjual/barang/') ?>" class="nav-link">
            <i class="nav-icon fas fa-store-alt"></i>
            <p>
              Barang

            </p>
          </a>
        </li>
        <?php $id = $this->session->userdata('id_user');
        $transaksi = $this->M_invoice->notifikasi($id); ?>
        <li class="nav-item">
          <a href="<?php echo base_url('penjual/transaksi') ?>" class="nav-link">
            <i class="nav-icon fas fa-handshake"></i>
            <p>
              Transaksi
              <span class="badge badge-info right"><?= $transaksi['hasil']  ?></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('auth/logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>