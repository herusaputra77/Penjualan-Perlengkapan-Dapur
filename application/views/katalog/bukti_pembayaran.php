<div class="container-fluid">
    <h3>Upload Bukti Pembayaran</h3><br>
    <div class="row">
        <div class="col-md-2">
            <h3>Nomor Rekening :</h3>
        </div>
        <div class="col-md-2">
            <h3>4865-4335-4545-45</h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2">
            <label for="">File Bukti Pembayaran</label>
        </div>
        <div class="col-md-6">
            <form action="<?= base_url('katalog/pembayaran/simpan_bukti') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_faktur" value="<?= $bukti['id_faktur'] ?>">
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control" id="bukti_pembayaran" name="bukti_pembayaran">
                    <label class="custom-file-label" for="image">Pilih file</label>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>

        <div class="col-md-4">
            <img src="<?= base_url('assets/bukti_pembayaran/') . $bukti['bukti_pembayaran'] ?>" style="width: 100px;" alt="">

        </div>
        <!-- col -->
    </div>
    <!-- row -->


</div>