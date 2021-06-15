 <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>assets/admin_lte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/admin_lte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/admin_lte/dist/js/demo.js"></script>
<script type="text/javascript">
  $(function(){
    const Toast = Swal.mixin({
      toast : true,
      position : 'top-end',
      showConfirmButton: false,
      timer :10000
    });
    $('.swalDefaultSuccess').click(function(){
      Toast.fire({
        icon : 'success',
        title : ' Barang berhasil ditambahkan ke keranjang!!'
      })    
    });
  });
  
</script>
</body>
</html>
  