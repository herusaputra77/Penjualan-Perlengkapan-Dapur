<body>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('dashboard') ?>"><i class="fa fa-moon-o fa-rotate-90 "></i><strong> GO</strong> DAPUR</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('username')) { ?>
                        <li><a href="<?= base_url('auth/logout/') ?>">Logout</a></li>
                        <?php
                        $jml_brg = 0;
                        $Keranjang = $this->cart->contents();
                        foreach ($Keranjang as  $items) {
                            $jml_brg = $jml_brg + $items['qty'];
                        }
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shopping-cart"></i>
                                <span class="float-right text-sm" style="font-size: 12px; font-family: Times new Roman;"><?= $jml_brg ?></span></a>

                            <ul class="dropdown-menu" style="width: 350px;">
                                <?php if (empty($items)) { ?>
                                    <p align="center">Keranjang Belanja Kosong</p>
                                    <?php } else {
                                    foreach ($Keranjang as $key => $items) {
                                        $barang = $this->M_barang->cari_id($items['id']) ?>
                                        <div class=" ml-3" align="center">
                                            <h3>Keranjang</h3>
                                        </div>
                                        <hr>
                                        <li>
                                            <div class="row">
                                                <!-- <div class="col-md-3"></div> -->
                                                <div class=" col-md-3 ml-3">
                                                    <img src="<?= base_url('assets/barang/') . $barang->gambar ?>" style="border-radius: 180px; width: 50px    ; margin-right: 0px">
                                                </div>
                                                <div class="col-md-9">
                                                    <p style="color: navy;"><?= $items['name'] ?></p>
                                                    <p style="color: navy;"><?= $items['qty'] ?></p>
                                                    <p style="color: navy;">Rp. <?= number_format($items['subtotal'], 0, ',', '.') ?></p>

                                                </div>

                                            </div>
                                        </li>
                                    <?php } ?>
                                    <button class="btn btn-primary btn-sm" style="width: 100%;">Total Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></button>
                                    <a href="<?= base_url('katalog/keranjang/') ?>" class="btn btn-sm btn-success" style="width: 100%;">Detail Keranjang</a>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- <?php echo $this->session->userdata('username') ?> --><i class="fa fa-user"></i> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">

                                <li>

                                    <a href="<?= base_url('katalog/profile') ?>"><i class="fa fa-user"></i> Profile</a>

                                </li>

                                <hr>
                                <li>
                                    <a href="<?= base_url('katalog/pembayaran/pesanan') ?>"><i class="fa fa-shopping-cart"></i> Pesanan</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="<?= base_url('katalog/pembayaran/riwayat') ?>"><i class="fa fa-book"></i> Riwayat</a>
                                </li>

                            </ul>
                        </li>
                    <?php } else { ?>
                        <li><a href="<?= base_url('auth/login/') ?>">Login</a></li>
                        <li><a href="<?= base_url('auth/register/') ?>">Signup</a></li>
                        <li><a href="<?= base_url('auth/reg_penjual/') ?>">Daftar Penjual</a></li>
                    <?php } ?>
                </ul>
                <form class="navbar-form navbar-right" action="<?= base_url('dashboard/search') ?>" method="post" role="search">
                    <div class="form-group">
                        <input type="text" name="keyword" placeholder="Enter Keyword Here ..." class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>