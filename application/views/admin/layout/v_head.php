
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="<?php echo base_url() ?>assets/admin/dist/img/logo-system2.png" type="image/gif">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!---->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/jquery-ui.min.css'?>">
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

    

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/adminlte.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- Include file bootstrap.min.css -->
    <link href="<?php echo base_url() ?>assets/datepicker/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include library Font Awesome -->
    <link href="<?php echo base_url() ?>assets/datepicker/libraries/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Include library Datepicker Gijgo -->
    <link href="<?php echo base_url() ?>assets/datepicker/libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/preloader.css" rel="stylesheet">
<script>
// Add the following into your HEAD section
var timer = 0;
function set_interval() {
  // the interval 'timer' is set as soon as the page loads
  timer = setInterval("auto_logout()", 10000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
  // So set it to 300000
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer

  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    // second step: implement the timer again
    timer = setInterval("auto_logout()", 10000);
    // completed the reset of the timer
  }
}

function auto_logout() {
  // this function will redirect the user to the logout script
  window.location = "C_login.php";
}

// Add the following attributes into your BODY tag
onload="set_interval()"
onmousemove="reset_interval()"
onclick="reset_interval()"
onkeypress="reset_interval()"
onscroll="reset_interval()"
</script>

</head>
