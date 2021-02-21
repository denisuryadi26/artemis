  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2 <strong><a href = "https://adminlte.io/docs/3.0/" target="_blank">Documentation</a></strong><br>
    </div>
    <strong>Copyright &copy; 2020 <a href="https://haistar.id">haistar.id</a></strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/demo.js"></script>


<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/admin/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/demo.js"></script>
<!-- Page script -->
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>

<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
</body>
</html>

<script>
$(document).ready(function(){
  $('#location_id').change(function(){
  var loc_id = $(this).val();
  var loc_name = $("#location_id option:selected").text();
  //var program_id = $('#program_id').val();
  //var program_name = $("#program_id option:selected").text();;
  if(loc_id != '')
    {
    $.ajax({
      url:"<?php echo base_url(); ?>admin/C_home/set_loc",
      method:"POST", 
      data: 
      {
        loc_id: loc_id,
        loc_name : loc_name
      // program_id: program_id,
      // program_name : program_name
      },
      dataType: "JSON",  
      cache:false,
      success:function(data)
      {
        var data = JSON.parse(data);
        // alert(data)
        window.location.reload(true)
      }
    });
  }
});

$('#program_id').change(function(){
    var program_id = $(this).val();
    var program_name = $("#program_id option:selected").text();
    if(program_id != '')
      {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/C_home/set_prog",
        method:"POST", 
        data: 
        {
          program_id: program_id,
          program_name : program_name
        },
        dataType: "JSON",  
        cache:false,
        success:function(data)
        {
          var data = JSON.parse(data);
          // alert(data)
          window.location.reload(true)
        }
      });
      }
  });
});
</script>


<script>
  $(function () {
    $(".dataTableNormal").DataTable();
    $(".dataTableWithSearch").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
  </script>