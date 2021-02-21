<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
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
                        <div class="chart">

                            <figure class="highcharts-figure">
                                <div id="inbound_average"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">SHIPMENT AVERAGE TIME</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <figure class="highcharts-figure">
                            <div id="shipment_average"></div>
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
                        <h3 class="card-title">OUTBOUND AVERAGE TIME</h3>

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
                                <div id="outbound_average"></div>
                            </figure>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- BAR CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">GRID ALLOCATION</h3>

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
                                <div id="grid_allocation"></div>
                            </figure>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->

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
            $queryinbound_average = "SELECT 
                        months, 
                        IFNULL(average, 0) AS average 
                        FROM ( 
                            SELECT MONTH(CONCAT(YEAR(CURRENT_DATE),'-',m,'-01')) AS months 
                            FROM 
                            (SELECT 1 m  
                            UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                            UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                            UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12) months 
                            WHERE m <= MONTH(CURRENT_DATE) 
                            
                            ) a 
                        LEFT JOIN ( 
                            SELECT mnt, SUM(selisih), ct, SUM(selisih) / ct AS average 
                            FROM ( 
                                SELECT MONTH(status_created_date) AS mnt, 
                                SUM(CASE WHEN status_code = 'PL_FINISH' THEN TIMESTAMPDIFF(MINUTE, created_date, finishing_date) 
                                ELSE TIMESTAMPDIFF(MINUTE, created_date, NOW()) END) AS selisih, COUNT(*) AS ct 
                        FROM purchasedetail
                        WHERE location_id = '$location_id' 
                        GROUP BY mnt 
                        ) a 
                        GROUP BY mnt 

                        ) b ON a.months = b.mnt 
                        ORDER BY a.months ";
            
            // echo $query;die;
            $datainbound_average = $this->db->query($queryinbound_average)->result();
            foreach ($datainbound_average as $isi ) {
            $inbound_average[] = intval($isi->average);
            // $harga_barang[] = intval($isi->price);
            }
            // print_r(json_encode($chart, JSON_NUMERIC_CHECK));die();
        ?>

    <script type="text/javascript">
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var date = new Date();
        var chart;
        chart = new Highcharts.chart({
          chart: {
            renderTo: 'inbound_average',
            type: 'line'
          },
          title: {
            text: 'Inbound Average Time Graph ' + date.getFullYear(), 
            x: -20
          },
          subtitle: {                
            text: "",
            x: -20
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tickmarkPlacement: 'on',
            title: {
              enabled: false
            }
          },
          yAxis: {
            title: {
              text: ''
            },
            labels: {
              formatter: function () {
                return this.value;
                // return '<b>'+ this.x +'</b><br/> Inbound average time : '+ this.y +' minute ';

              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
          },
          tooltip: {
            split: false,
            valueSuffix: ' minute'
          },
          plotOptions: {
            area: {
              stacking: 'normal',
              lineColor: '#666666',
              lineWidth: 1,
              marker: {
                lineWidth: 1,
                lineColor: '#666666'
              }
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            x: -10,
            y: 100,
            borderWidth: 0
        },
          series: [{
            showInLegend: false,
            name: 'Inbound Avg Time',
            data: <?php echo json_encode($inbound_average) ?>
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
            $queryshipment_average = "  SELECT 
                                            months, 
                                            IFNULL(average, 0) AS average 
                                        FROM shipmentaverage 
                                        ORDER BY months ";
            
            // echo $query;die;
            $datashipment_average = $this->db->query($queryshipment_average)->result();
            foreach ($datashipment_average as $isi ) {
            $shipment_average[] = intval($isi->average);
            // $harga_barang[] = intval($isi->price);
            }
            // print_r(json_encode($chart, JSON_NUMERIC_CHECK));die();
        ?>

    <script type="text/javascript">
        var date = new Date();
        var chart;
        chart = new Highcharts.chart({
          chart: {
            renderTo: 'shipment_average',
            type: 'line'
          },
          title: {
            text: 'Shipment Average Time Graph ' + date.getFullYear(), 
            x: -20
          },
          subtitle: {
            text: "",
            x: -20
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tickmarkPlacement: 'on',
            title: {
              enabled: false
            }
          },
          yAxis: {
            title: {
              text: ''
            },
            labels: {
              formatter: function () {
                return this.value;
                // return '<b>'+ this.x +'</b><br/> Shipment average time : '+ this.y +' minute ';

              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
          },
          tooltip: {
            split: false,
            valueSuffix: ' minute'
          },
          plotOptions: {
            area: {
              stacking: 'normal',
              lineColor: '#666666',
              lineWidth: 1,
              marker: {
                lineWidth: 1,
                lineColor: '#666666'
              }
            }
          },
          series: [{
            showInLegend: false,
            name: 'Shipment Avg Time',
            data: <?php echo json_encode($shipment_average) ?>
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
            $queryoutbound_average = "  SELECT 
                                            a.months, 
                                            IFNULL(b.average, 0) AS average 
                                        FROM ( 
                                            SELECT MONTH(CONCAT(YEAR(CURRENT_DATE),'-',m,'-01')) AS months 
                                            FROM 
                                            (SELECT 1 m  
                                            UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                                            UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                                            UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12) months 
                                            WHERE m <= MONTH(CURRENT_DATE) 
                                            
                                            ) a 
                                        LEFT JOIN ( 
                                            SELECT mnt, SUM(selisih), ct, SUM(selisih) / ct AS average 
                                            FROM ( 
                                            SELECT MONTH(a.created_date) AS mnt, 
                                            SUM(CASE WHEN b.order_header_id IS NOT NULL THEN TIMESTAMPDIFF(MINUTE, a.created_date, b.created_date) 
                                            ELSE TIMESTAMPDIFF(MINUTE, NOW(), b.created_date) END) AS selisih, COUNT(*) AS ct 
                                            FROM orderdetail a 
                                            LEFT JOIN ( 
                                            SELECT a.order_header_id, a.created_date FROM orderhistory a JOIN `status` b ON a.status_id = b.status_id 
                                            WHERE b.code = 'ORD_STANDBY' 
                                            ) b ON a.order_header_id = b.order_header_id 
                                        WHERE a.location_id = '$location_id' 
                                        GROUP BY mnt 
                                        ) a 
                                        GROUP BY mnt 

                                        ) b ON a.months = b.mnt 
                                        ORDER BY a.months ";
            
            // echo $query;die;
            $data = $this->db->query($queryoutbound_average)->result();
            foreach ($data as $isi ) {
            $outbound_average[] = intval($isi->average);
            // $harga_barang[] = intval($isi->price);
            }
            // print_r(json_encode($chart, JSON_NUMERIC_CHECK));die();
        ?>

    <script type="text/javascript">
        var date = new Date();
        var chart;
        chart = new Highcharts.chart({
          chart: {
            renderTo: 'outbound_average',
            type: 'line'
          },
          title: {
            text: 'Outbound Average Time Graph ' + date.getFullYear(), 
            x: -20
          },
          subtitle: {
            
            text: "",
            x: -20
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tickmarkPlacement: 'on',
            title: {
              enabled: false
            }
          },
          yAxis: {
            title: {
              text: ''
            },
            labels: {
              formatter: function () {
                return this.value;
                // return '<b>'+ this.x +'</b><br/> Outbound average time : '+ this.y +' minute ';

              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
          },
          tooltip: {
            split: false,
            valueSuffix: ' minute'
          },
          plotOptions: {
            area: {
              stacking: 'normal',
              lineColor: '#666666',
              lineWidth: 1,
              marker: {
                lineWidth: 1,
                lineColor: '#666666'
              }
            }
          },
          series: [{
            showInLegend: false,
            name: 'Outbound Avg Time',
            data: <?php echo json_encode($outbound_average) ?>
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
            $querygrid_allocation = "  SELECT 
                                            name, 
                                            hasil 
                                        FROM gridallocation";
            
            // echo $query;die;
            $datagridallocation = $this->db->query($querygrid_allocation)->result();
            foreach ($datagridallocation as $isi ) 
            {
            if($isi->name == "Unallocated" && $isi->hasil == "0")
                $isi->hasil = 1;
            $grid_allocation[] = array($isi->name, round($isi->hasil, 2));
            }
        ?>

    <script type="text/javascript">
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var date = new Date();
        
        var chart;
        chart = new Highcharts.chart({
            chart: {
                renderTo: 'grid_allocation',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grid Allocation up to '+ months[date.getMonth()] + ' ' + date.getFullYear(),
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
                data: <?php echo json_encode($grid_allocation) ?>
            }]
        });
    </script>
-->