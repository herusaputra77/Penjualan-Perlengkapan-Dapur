  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- ChartJS -->
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/admin_lte<?php echo base_url() ?>assets/admin_lteplugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url() ?>assets/admin_lteplugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/admin_ltedist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/admin_lte/dist/js/adminlte.min.js"></script>
  </body>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#datatable').DataTable();
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#jumlah, #harga").keyup(function() {
        var harga = $("#harga").val();
        var jumlah = $("jumlah").val();
        var total = parseInt(harga) * parseInt(jumlah);
        $('#total').val(total);
      });
    });
  </script>

  <!-- js filter tanggal -->
  <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
  <script>
    $(document).ready(function() { // Ketika halaman selesai di load
      $('.input-tanggal').datepicker({
        dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
      });

      $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

      $('#filter').change(function() { // Ketika user memilih filter
        if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
          $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
          $('#form-tanggal').show(); // Tampilkan form tanggal
        } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
          $('#form-tanggal').hide(); // Sembunyikan form tanggal
          $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
        } else { // Jika filternya 3 (per tahun)
          $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
          $('#form-tahun').show(); // Tampilkan form tahun
        }

        $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
      })
    })
  </script>

  </html>