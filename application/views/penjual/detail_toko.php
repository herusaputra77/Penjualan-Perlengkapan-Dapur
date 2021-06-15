
        <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
           <!-- /.col-md-6 -->
          <div class="col-lg-12"> 
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
        <?php foreach($detail as $tk):?>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="<?= base_url('assets/logo/').$tk->logo?>" style="width: 500px;">
                  </div>
                  <div class="col-md-6"> 
                    
                <table class="table table-striped table-hover">
                  <tr>
                    <td>Nama Toko</td>
                    <td>:</td>
                    <td><?= $tk->nama_toko ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $tk->alamat_toko ?></td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?= $tk->keterangan ?></td>
                  </tr>
                  <tr>
                    <td>Nama Pemilik</td>
                    <td>:</td>
                    <td><?= $tk->nama ?></td>
                  </tr>
                  <tr>
                    <td>Alamat Pemilik</td>
                    <td>:</td>
                    <td><?= $tk->alamat ?></td>
                  </tr>
                </table>
                <a href="<?= base_url('penjual/toko')?>" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                  
                </div>
              </div>
        <?php endforeach;?>
            </div>
          </div>
          <!-- /.col-md-6 -->
      </div>
    </div>
  </div>