

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
          <div class="col-md-6">
            <form action="<?= base_url('penjual/profile/ganti_password_aksi')?>" method="post">
              
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password">
               <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="password_baru">Password Baru</label>
              <input type="password" class="form-control" id="password_baru" name="password_baru">
               <?= form_error('password_baru', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="ulangi_password">Ulangi Password</label>
              <input type="password" class="form-control" id="ulangi_password" name="ulangi_password">
               <?= form_error('ulangi_password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>