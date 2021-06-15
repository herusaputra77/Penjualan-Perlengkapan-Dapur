<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>E-commerce</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">E-commerce</li>
            </ol>
          </div>
        </div>
      </div> -->
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <form action="<?= base_url('katalog/keranjang/tambah_keranjang/') ?>" method="post">
        <?php foreach ($barang as $br) : ?>
          <input type="hidden" name="id" value="<?= $br->id_barang ?>">
          <input type="hidden" name="price" value="<?= $br->harga ?>">
          <input type="hidden" name="name" value="<?= $br->nama_barang ?>">
          <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?= $br->nama_barang ?></h3>
                <div class="col-12">
                  <img src="<?php echo base_url() . 'assets/barang/' . $br->gambar ?>" style="width: 300px;">
                </div>
                <!-- <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
              </div> -->
              </div>
              <div class="col-sm-6">
                <h3 class="my-3"><?= $br->nama_barang ?></h3>

                <hr>

                <div class="bg-gray py-2 px-3 mt-4">
                  <h2 class="mb-0">
                    Rp. <?= number_format($br->harga, 0, ',', '.') ?>
                  </h2>
                  <!-- <h4 class="mt-0">
                  <small>Ex Tax: $80.00 </small>
                </h4> -->
                </div>

                <div class="mt-2">
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <input type="number" class="form-control" name="qty" value="1" min="0">
                    </div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary btn-sm swalDefaultSuccess mb-3"><i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Tambah ke keranjang
                      </button>
                    </div>
                    <div class="">
                      <a href="<?= base_url('katalog/toko/index/') . $br->id_toko ?>" class="btn btn-sm btn-secondary"><i class="fas fa-home"></i> Lihat Toko</a>
                    </div>
                  </div>

                  <!-- <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i>
                  Add to Wishlist
                </div> -->
                </div>

                <div class="mt-4 product-share">
                  <a href="#" class="text-gray">
                    <i class="fab fa-facebook-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fab fa-twitter-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-envelope-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-rss-square fa-2x"></i>
                  </a>
                </div>



              </div>
            </div>
          </div>
          <!-- /.card-body -->
    </div>
  <?php endforeach; ?>
  </form>
  <!-- /.card -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-bullhorn"></i>
        Komentar
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="<?= base_url('dashboard/tambah_komen') ?>" method="post">
        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
        <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
        <input type="hidden" class="form-control" name="id_barang" value="<?= $br->id_barang ?>">
        <div class="row">
          <?php foreach ($komentar as $key => $value) { ?>
            <div class="col-md-6">
              <div class="callout callout-info">
                <h5><?= $value['nama'] ?></h5>

                <p><?= $value['komentar'] ?></p>
              </div>

            </div>
            <div class="col-md-6">

            </div>
          <?php } ?>

          <div class="col-md-5">
            <div class="form-group">
              <input type="text" class="form-control" name="komentar" placeholder="Masukan Komentar...">
              <?= form_error('komentar', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

          </div>
          <div class="col-md-1">
            <button type="" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->