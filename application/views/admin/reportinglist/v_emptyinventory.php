<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-body">
                      <section class="content-header">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
                              </li>
                              <li class="breadcrumb-item active"><a href="<?= base_url('admin/C_reporting'); ?>">reporting</a>
                              </li>
                              <li class="breadcrumb-item active">empty inventory</li>
                          </ol>
                          <h1>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-info">MORE ACTIONS</button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                      <span class="sr-only">Toggle Dropdown</span>
                                      <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="#"><i class="fa fa-ban"></i>NO ACTION</a>
                                      </div>
                                    </button>
                                    </div>
                              </h1>
                        </section>
                      </div> -->
                      <div class="card-body">
                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_emptyinventory/export"); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-info collapsed-card">
                                          <div class="card-header">
                                            <h3 class="card-title">INVENTORY EMPTY LIST</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <div class="table-responsive" id="putaway-grid">
                                                    <table id="emptyinventory" class="table table-bordered table-hover" style="font-size:13px">
                                                        <thead>
                                                            <tr>
                                                                <th id="putaway-grid_c0">NAME</th>
                                                                <th id="putaway-grid_c1">ACTIVE</th>
                                                                <th id="putaway-grid_c2">DAMAGED</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            foreach ($emptyinventory as $row) 
                                                            {
                                                        ?>
                                                        <tr class="odd">
                                                            <td><?php echo $row->grid_name; ?></td>
                                                            <td><?php echo $row->is_active; ?></td>
                                                            <td><?php echo $row->is_damaged; ?></td>
                                                        </tr>
                                                        <?php
                                                            }

                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-6">
                                        <div class="card card-info collapsed-card">
                                          <div class="card-header">
                                            <h3 class="card-title">INVENTORY OCUPATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div id="container"></div>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Empty 56.61 % (856/1512)</button>
                                                    <button type="button" class="btn btn-success">Filled 43.39 % (656/1512)</button>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="box box-solid box-info">
                                    <!-- <div class="box-header with-border">
                                        <i class="fa fa-file-o"></i>
                                        <h3 class="box-title">EMPTY INVENTORY</h3>
                                    </div> -->
                                    <div class="card card-info">
                                        <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> EMPTY INVENTORY</h3>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_location">Location</label>
                                                <input class="form-control" id="location" size="60" maxlength="200" placeholder="LOCATION" name="location_name" type="text" /> </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="form-group col-md-6">
                                                <input id="ytReporting_all_location" type="hidden" value="0" name="all_location" />
                                                <input name="all_location" id="Reporting_all_location" value="1" type="checkbox" /> ALL LOCATION
                                            </div> -->
                                            <div class="icheck-info d-inline form-group col-md-6">
                                                <input type="checkbox" id="Reporting_all_location" value="1" name="all_location">
                                                <label for="Reporting_all_location">
                                                ALL LOCATION
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <script type="text/javascript">
                                jQuery_1_12_4("#location").autocomplete({
                                    source: 'https://dashboard.wms.haistar.co.id/index.php?r=Custom/LocationName',
                                    select: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                        else {
                                            $("#location").val(ui.item.value);
                                        }
                                    },
                                    focus: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                    }
                                });
                            </script>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
  $(function () {
    $("#emptyinventory").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
  });
</script>

<script type="text/javascript">
    Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'INVENTORY OCUPATION'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Filled',
      y: 656/1512
    },{
      name: 'Empty',
      y: 856/1512
    }]
  }]
});
</script>