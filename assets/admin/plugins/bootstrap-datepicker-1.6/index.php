<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bootstrap Datepicker</title>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <link href="datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="datepicker/dist/js/jquery.js"></script>
    <script src="datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    $(function()
    {
      $('#tgl_awal').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'}),
      $('#tgl_akhir').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'})
    });
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h3>Bootstrap Datepicker</h3>
          <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Datepicker</h3></div>
            <div class="panel-body">
              <label>Tanggal Awal</label>
              <input type="text" class="form-control" name="tgl_awal" id="tgl_awal"><br>
              <label>Tanggal Akhir</label>
              <input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir">
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
