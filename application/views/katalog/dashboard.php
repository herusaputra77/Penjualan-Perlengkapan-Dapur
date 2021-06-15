<div class="row">
    <div class="col-md-12">
        <?= $this->session->flashdata('pesan'); ?>
        <div>
            <ol class="breadcrumb">
                <li><a href="#"><?php echo $this->uri->segment(1); ?></a></li>
                <!-- <li class="active">Electronics</li> -->
            </ol>
        </div>
        <!-- /.div -->
        <!-- <div class="row">
        <div class="btn-group alg-right-pad">
            <button type="button" class="btn btn-default"><strong>1235 </strong>items</button>
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    Sort Products &nbsp;
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">By Price Low</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Price High</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Popularity</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Reviews</a></li>
                </ul>
            </div>
        </div>
    </div> -->
        <!-- /.row -->
        <div class="row">
            <?php foreach ($barang as $br) : ?>
                <form action="<?= base_url('katalog/keranjang/tambah_keranjang/') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $br->id_barang ?>">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" value="<?= $br->harga ?>">
                    <input type="hidden" name="name" value="<?= $br->nama_barang ?>">
                    <input type="hidden" name="id_toko" value="<?= $br->id_toko ?>">
                    <input type="hidden" name="redirect_page" value="<?= str_replace('index.php/', '', current_url()); ?>">
                    <!-- <div class="col-md-3 text-center col-sm-6 col-xs-12"> -->
                    <div class="col-sm-3 text-center align-center col-sm-12 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="<?= base_url() . 'assets/barang/' . $br->gambar ?>" style="width: 100px; height:100px;" alt="" />
                            <input type="hidden" name="gambar" value="<?= $br->gambar ?>">
                            <div class="caption">
                                <h5><b><a href="#" style="font-size: 1ch;"></a><?= $br->nama_barang ?></b></h5>
                                <p>Stok Barang : <?= $br->jumlah ?></p>
                                <p>Harga : <strong> Rp. <?php echo number_format($br->harga, 0, ',', '.') ?></strong> </p>
                                <p><button type="submit" class="btn btn-success" role="button" id="tambah_keranjang"><i class="fa fa-plus"></i> <i class="fa fa-shopping-cart"></i></button>
                                    <a href="<?= base_url('dashboard/detail/') . $br->id_barang ?>" class="btn btn-primary"> Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </form>
            <?php endforeach; ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
<!-- <div class="col-md-12 download-app-box text-center">

    <span class="glyphicon glyphicon-download-alt"></span>Download Our Android App and Get 10% additional Off on all Products . <a href="#" class="btn btn-danger btn-lg">DOWNLOAD NOW</a>

</div> -->