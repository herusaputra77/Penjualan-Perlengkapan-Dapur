

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#tambahtoko"><i class="fas fa-plus"></i>
 		 Tambah
		</button>
		<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
       <thead>
           <tr>
            <th>NO</th>
               <th>Nama Toko</th>
               <th>Barang</th>
               <th>Alamat Toko</th>
               <th>Keterangan</th>
               <th>Aksi</th>

       </thead>
       <tbody>
           <tr>
           	<?php $no=1; foreach($toko as $u):?>
            <td><?= $no++?></td>
            <td><?= $u->nama_toko?></td>
            <td> 
              <a href="<?= base_url('penjual/toko/tampil_barang/'). $u->id_toko?>" class="btn btn-sm btn-primary btn-sm" ><span class="">Cek Barang</span></a></td>
            <td><?= $u->alamat_toko?></td>
            <td><?= $u->keterangan?></td>
            <td><a href="<?= base_url('penjual/toko/hapus/'). $u->id_toko?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edittoko<?php echo $u->id_toko?>"><i class="fas fa-edit"></i>
                </button>
                <a href="<?= base_url('penjual/toko/detail/'). $u->id_toko?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
            </td>

           </tr>
       <?php endforeach;?>
       </tbody>
    </table>
      </div>
  </div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahtoko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-store-alt"></i> Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?php echo base_url('penjual/toko/tambah_toko')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        	<div class="form-group">
        		<input type="text" name="nama_toko" class="form-control" placeholder="Nama toko...">
            <?php foreach($penjual as $u):?>
        		<input type="hidden" name="id_penjual" value="<?= $u->id_penjual?>">
          <?php endforeach;?>
        	</div>
        	<div class="form-group">
        		<input type="text" name="alamat_toko" class="form-control" placeholder="Alamat toko...">
        	</div>	
        	<div class="form-group">
        		<input type="text" name="keterangan" class="form-control" placeholder="Keterangan...">
        	</div>	
        	<div class="form-group">
        		<input type="file" name="logo" class="form-control" >
        	</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
     </form>
    </div>
  </div>
</div>

<?php $no=0; foreach($toko as $u): $no++?>
<!-- Modal -->
<div class="modal fade" id="edittoko<?= $u->id_toko?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-store-alt"></i> Edit Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?php echo base_url('penjual/toko/edit_toko')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <input type="text" name="nama_toko" class="form-control" value="<?= $u->nama_toko?>">
            <input type="hidden" name="id_toko" value="<?=$u->id_toko?>">
          </div>
          <div class="form-group">
            <input type="text" name="alamat_toko" class="form-control" value="<?php echo $u->alamat_toko?>">
          </div>  
          <div class="form-group">
            <input type="text" name="keterangan" class="form-control" value="<?php echo $u->keterangan?>">
          </div>  
          <div class="form-group">
            <input type="file" name="logo" class="form-control" >
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
     </form>
    </div>
  </div>
</div>
<?php endforeach;?>