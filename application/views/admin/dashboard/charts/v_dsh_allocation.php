<script src="https:/code.highcharts.com/highcharts.js"></script>
<script src="https:/code.highcharts.com/modules/exporting.js"></script>
<script src="https:/code.highcharts.com/modules/export-data.js"></script>
<script src="https:/code.highcharts.com/modules/accessibility.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">MARKETPLACE ALLOCATION STOCK</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">

                            <figure class="highcharts-figure">
                                <div id="marketplace_allocation"></div>
                            </figure>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">INBOUND AVERAGE TIME</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <figure class="highcharts-figure">
                            <div id="inbound_allocation"></div>
                        </figure>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">OUTBOUND ALLOCATION</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">

                            <figure class="highcharts-figure">
                                <div id="outbound_allocation"></div>
                            </figure>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<?php die;?>
        <!--
        <?php
            if($this->session->userdata('location_id'))
                  {
                      $location_id = $this->session->userdata('location_id');
                      $program_id = $this->session->userdata('program_id');
                  }
                  else
                  {
                      $location_id = $this->session->userdata('loc_id');
                      $program_id = $this->session->userdata('prog_id');
                  }
            $querymarketplace_allocation = "    SELECT 
                                                        name, 
                                                        label, 
                                                        hasil 
                                                FROM marketplaceallocation  ";
            
            // echo $query;die;
            $datamarketplace = $this->db->query($querymarketplace_allocation)->result();
            if (count($datamarketplace) > 0) {
                foreach ($datamarketplace as $isi ) 
                {
                if($isi->name == "None" && $isi->hasil == "0")
                    $isi->hasil = 1;
                $marketplace_allocation[] = array($isi->label, round($isi->hasil, 2));
                }
            } 
            else 
            {
                $marketplace_allocation['0'] = array("None",1);
            }
        ?>

        <script type="text/javascript">
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var date = new Date();
            
            var chart;
            chart = new Highcharts.chart({
                chart: {
                    renderTo: 'marketplace_allocation',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Market Place Allocation Stock up to '+ months[date.getMonth()] + ' ' + date.getFullYear(),
                    x: -20

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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: 
                            {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: <?php echo json_encode($marketplace_allocation) ?>
                }]
            });
        </script>

        <?php
            if($this->session->userdata('location_id'))
            {
              $location_id = $this->session->userdata('location_id');
              $program_id = $this->session->userdata('program_id');
            }
            else
            {
              $location_id = $this->session->userdata('loc_id');
              $program_id = $this->session->userdata('prog_id');
            }
            $queryinbound_allocation = "    SELECT 
                                                    name, 
                                                    label, 
                                                    hasil 
                                                FROM inboundallocation";
            
            // echo $query;die;
            $datainbound = $this->db->query($queryinbound_allocation)->result();
            if (count($datainbound) > 0) {
                foreach ($datainbound as $isi ) 
                {
                if($isi->name == "None" && $isi->hasil == "0")
                    $isi->hasil = 1;
                $inbound_allocation[] = array($isi->label, round($isi->hasil, 2));
                }
            } 
            else 
            {
                $inbound_allocation['0'] = array("None",1);
            }
        ?>

        <script type="text/javascript">
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var date = new Date();
            
            var chart;
            chart = new Highcharts.chart({
                chart: {
                    renderTo: 'inbound_allocation',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Inbound Allocation up to '+ months[date.getMonth()] + ' ' + date.getFullYear(),
                    x: -20

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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: 
                            {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: <?php echo json_encode($inbound_allocation) ?>
                }]
            });
        </script>

        <?php
            if($this->session->userdata('location_id'))
            {
              $location_id = $this->session->userdata('location_id');
              $program_id = $this->session->userdata('program_id');
            }
            else
            {
              $location_id = $this->session->userdata('loc_id');
              $program_id = $this->session->userdata('prog_id');
            }
            $queryoutbound_allocation = "   SELECT 
                                                name, 
                                                label, 
                                                hasil 
                                            FROM outboundallocation";
            
            // echo $queryoutbound_allocation;die;
            $dataoutbound = $this->db->query($queryoutbound_allocation)->result();
            if (count($dataoutbound) > 0) {
                foreach ($dataoutbound as $isi ) 
                {
                if($isi->name == "None" && $isi->hasil == "0")
                    $isi->hasil = 1;
                $outbound_allocation[] = array($isi->label, round($isi->hasil, 2));
                }
            } 
            else 
            {
                $outbound_allocation['0'] = array("None",1);
            }
        ?>

        <script type="text/javascript">
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var date = new Date();
            
            var chart;
            chart = new Highcharts.chart({
                chart: {
                    renderTo: 'outbound_allocation',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Outbound Allocation up to '+ months[date.getMonth()] + ' ' + date.getFullYear(),
                    x: -20

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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: 
                            {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: <?php echo json_encode($outbound_allocation) ?>
                }]
            });
        </script>
        -->