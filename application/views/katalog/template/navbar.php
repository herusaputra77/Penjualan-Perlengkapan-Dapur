<body class="hold-transition sidebar-collapse layout-top-nav">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <!--           <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li> -->
            <li class="nav-item">
              <a href="<?= base_url('dashboard') ?>" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('katalog/keranjang') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i> Keranjang</a>
            </li>

          </ul>

          <!-- SEARCH FORM -->
          <!-- <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form> -->
        </div>


      </div>
    </nav>
    <!-- /.navbar -->