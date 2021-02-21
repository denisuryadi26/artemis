<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_emptyinventory/export"); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-info shadow-sm">
                                            <div class="card-header">
                                            <h3 class="card-title">INVENTORY EMPTY LIST</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                                        <div class="card card-info shadow-sm">
                                            <div class="card-header">
                                            <h3 class="card-title">INVENTORY OCUPATION</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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