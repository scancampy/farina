<div id="cover-spin"></div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 Farina
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('adminlte/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?php echo base_url('adminlte/plugins/moment/moment.min.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('adminlte/plugins/summernote/summernote-bs4.min.js'); ?>"></script>

<!-- Select2 -->
<script src="<?php echo base_url('adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url('adminlte/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('adminlte/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('adminlte/js/demo.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $('.linkload').on("click", function() { $('#cover-spin').show(0); });
<?php if(isset($js)) { echo $js; } ?>
	});	
</script>
</body>
</html>
