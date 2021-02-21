<?php 
    echo $this->session->flashdata('message'); 
    date_default_timezone_set('Asia/Jakarta');
    $now   = date('F Y');
    $bulan = date('M');
    $bln   = date('m');
    $tahun = date('Y');
    // echo json_encode($bulan);die;
?>

<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Mitra Tokopedia SLA</a>
                        </li>
                        
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <?php 
                                            echo $this->session->flashdata('message'); 
                                            date_default_timezone_set('Asia/Jakarta');
                                            $now   = date('F Y');
                                            $bulan = date('M');
                                            $bln   = date('m');
                                            $tahun = date('Y');
                                            // echo json_encode($bulan);die;
                                        ?>
                                        <select name="sladate" id="sladate" class="form-control" onchange="chartDailyOrderMonitoringMitraTokped()">
                                            <?php
                                                if($bulan == "Jan"){
                                                    echo "<option value='Jan $tahun'>Jan $tahun</option>";
                                                }else if($bulan == "Feb"){
                                                    echo "<option value='Feb $tahun'>Feb $tahun</option>";
                                                }else if($bulan == "Mar"){
                                                    echo "<option value='Mar $tahun'>Mar $tahun</option>";
                                                }else if($bulan == "April"){
                                                    echo "<option value='Apr $tahun'>Apr $tahun</option>";
                                                }else if($bulan == "May"){
                                                    echo "<option value='May $tahun'>May $tahun</option>";
                                                }else if($bulan == "Jun"){
                                                    echo "<option value='Jun $tahun'>Jun $tahun</option>";
                                                }else if($bulan == "Jul"){
                                                    echo "<option value='Jul $tahun'>Jul $tahun</option>";
                                                }else if($bulan == "Aug"){
                                                    echo "<option value='Aug $tahun'>Aug $tahun</option>";
                                                }else if($bulan == "Sep"){
                                                    echo "<option value='Sep $tahun'>Sep $tahun</option>";
                                                }else if($bulan == "Oct"){
                                                    echo "<option value='Oct $tahun'>Oct $tahun</option>";
                                                }else if($bulan == "Nov"){
                                                    echo "<option value='Nov $tahun'>Nov $tahun</option>";
                                                }else if($bulan == "Dec"){
                                                    echo "<option value='Dec $tahun'>Dec $tahun</option>";
                                                }
                                            $bulan=array(
                                                            "Jan",
                                                            "Feb",
                                                            "Mar",
                                                            "Apr",
                                                            "May",
                                                            "Jun",
                                                            "Jul",
                                                            "Aug",
                                                            "Sep",
                                                            "Oct",
                                                            "Nov",
                                                            "Dec");
                                                $jlh_bln=count($bulan);
                                                for($c=0; $c<$jlh_bln; $c+=1)
                                                {
                                                    echo "<option value='$bulan[$c] $tahun'>$bulan[$c] $tahun</option>";
                                                }
                                            ?>
                                            <!-- <option name="comp_id" value='Dec <?php //echo $tahun; ?>'>Dec <?php //echo $tahun; ?></option>  -->
                                        </select>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        </div>
                                        <select class="form-control" id="view_wh_tokped" onchange="chartDailyOrderMonitoringMitraTokped()">
                                            <option value="justlocation">View base on Location</option>
                                            <option value="alllocation">View base on all Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        </div>
                                        <select class="form-control" id="view_cl_tokped" onchange="chartDailyOrderMonitoringMitraTokped()">
                                            <option value="justclient">View base on Client</option>
                                            <option value="allclient">View base on all Client</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <td>
                                        <form action="<?php echo base_url('admin/outbound/C_outbound_mitra') ?>">
                                            <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                            <button type="button" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/outbound/C_outbound_mitra" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                <i class="fas fa-sync-alt"></i> Reload
                                            </button>
                                        </form>
                                    </td>
                                </div>                                
                                <div class="col-md-12">
                                    <div class="card card-info">
                                        <div class="card-body">
                                            <div class="chart">
                                                <figure class="highcharts-figure">
                                                    <div id="sla_mitra_tokped"></div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="col-md-14">
                                <div class="card card-info shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Tokocabang SLA In 7 Days</h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="purchase" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" id="packinglist-grid_c0" style="text-align:center">CLIENT NAME</th>
                                                    <th rowspan="2" id="packinglist-grid_c1" style="text-align:center">SITE LOCATION</th>
                                                    <?php 
                                                    $now = new DateTime( "6 days ago", new DateTimeZone('Asia/Bangkok'));
                                                    $interval = new DateInterval( 'P1D'); // 1 Day interval
                                                    $period = new DatePeriod( $now, $interval, 6); // 7 Days
                                                    
                                                    $days = array();
                                                    foreach( $period as $day) {
                                                        $key = $day->format( 'm-d-Y');
                                                        $days[] = $key;
                                                    }
                                                    foreach ($days as $dayrow) { ?>
                                                        <th colspan="2" style="text-align:center">
                                                            <?php echo $dayrow; ?></th>
                                                    
                                                    <?php 
                                                    } 
                                                    ?>
                                                </tr>
                                                <tr></tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($nilaisladaytokocabang as $dayrow) { ?>
                                                    <td>
                                                        <?php echo $dayrow->parent; ?></td>
                                                    <td>
                                                        <?php echo $dayrow->location_name; ?></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_1; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_1 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_1."' target='_blank'";}?> > <?php echo $dayrow->packed_1; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_1; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_1 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_1."' target='_blank'";}?> > <?php echo $dayrow->rts_1; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_2; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_2 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_2."' target='_blank'";}?> > <?php echo $dayrow->packed_2; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_2; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_2 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_2."' target='_blank'";}?> > <?php echo $dayrow->rts_2; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_3; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_3 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_3."' target='_blank'";}?> > <?php echo $dayrow->packed_3; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_3; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_3 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_3."' target='_blank'";}?> > <?php echo $dayrow->rts_3; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_4; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_4 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_4."' target='_blank'";}?> > <?php echo $dayrow->packed_4; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_4; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_4 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_4."' target='_blank'";}?> > <?php echo $dayrow->rts_4; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_5; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_5 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_5."' target='_blank'";}?> > <?php echo $dayrow->packed_5; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_5; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_5 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_5."' target='_blank'";}?> > <?php echo $dayrow->rts_5; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_6; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_6 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_6."' target='_blank'";}?> > <?php echo $dayrow->packed_6; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_6; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_6 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_6."' target='_blank'";}?> > <?php echo $dayrow->rts_6; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_7; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_packed_7 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_7."' target='_blank'";}?> > <?php echo $dayrow->packed_7; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_7; ?>" style="text-align:center">
                                                        <a <?php  if($dayrow->color_rts_7 == 'tomato'){ echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertokcab/".$dayrow->location_id."/".$dayrow->order_created_date_7."' target='_blank'";}?> > <?php echo $dayrow->rts_7; ?> %</a></td>
                                                </tr>
                                                <?php 
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
        <!-- =========================================================== -->
        <script src="<?php echo base_url() ?>assets/highcharts/highcharts.js"></script>
        <script src="<?php echo base_url() ?>assets/highcharts/series-label.js"></script>
        <script src="<?php echo base_url() ?>assets/highcharts/exporting.js"></script>
        <script src="<?php echo base_url() ?>assets/highcharts/export-data.js"></script>
        <script src="<?php echo base_url() ?>assets/highcharts/accessibility.js"></script>

        <!-- Include file jquery.min.js -->
        <script src="<?php echo base_url() ?>assets/datepicker/js/jquery.min.js"></script>

        <!-- Include file boootstrap.min.js -->
        <script src="<?php echo base_url() ?>assets/datepicker/js/bootstrap.min.js"></script>

        <!-- Include library Moment JS -->
        <script src="<?php echo base_url() ?>assets/datepicker/libraries/moment/moment.min.js"></script>

        <!-- Include library Datepicker Gijgo -->
        <script src="<?php echo base_url() ?>assets/datepicker/libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Include file custom.js -->
        <script src="<?php echo base_url() ?>assets/datepicker/js/custom.js"></script>

        <script type="text/javascript" src="<?= base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>
        <script type="text/javascript" src="<?= base_url().'assets/js/jquery-ui.min.js'?>"></script>
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

            if($this->session->userdata('location_name'))
            {
                $location_name = $this->session->userdata('location_name');
                $program_name = $this->session->userdata('program_name');
            }
            else
            {
                $location_name = $this->session->userdata('loc_name');
                $program_name = $this->session->userdata('prog_name');
            }

            
        ?>
        <script>
            $("#date_from").datepicker({'dateFormat':'yy-mm-dd'});
            $("#date_to").datepicker({'dateFormat':'yy-mm-dd'});
        </script>
        <script type="text/javascript">
            $(document).ready(function() 
            {
                chartDailyOrderMonitoringMitraTokped();
                // homeMonitoring();
            });
            // Mitra Tokped
            function performancePerDayMitraTokped(result){
                var date = new Date();
                var maxRate = 98;
                chart = new Highcharts.chart({
                    chart: {
                        renderTo: 'sla_mitra_tokped',
                        zoomType: 'xy'
                    },
                    title: {
                        text: 'Performance Per Day '
                    },
                    subtitle: {
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
                        
                            if($this->session->userdata('location_name'))
                            {
                                $location_name = $this->session->userdata('location_name');
                                $program_name = $this->session->userdata('program_name');
                            }
                            else
                            {
                                $location_name = $this->session->userdata('loc_name');
                                $program_name = $this->session->userdata('prog_name');
                            }
                            $subtitle = 'Data base on '.$location_name.' '.$program_name;
                        ?>
                        text: <?php echo json_encode($subtitle); ?>,
                        x: -20
                        // text :'Tes'
                    },
                    xAxis: {
                        categories: result.date,
                        crosshair: true
                    },
                    colors: ['#0092ff', '#ff8100' ,'#008000', '#ffff00'],
                    yAxis: [{ // Primary yAxis
                        labels: {
                            format: '{value}',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        title: {
                            text: 'Order Quantity',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    }, { // Secondary yAxis
                        title: {
                            text: 'Performance',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        labels: {
                            format: '{value}%',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        plotLines: [{
                        value: maxRate,
                        color: 'yellow',
                        // dashStyle: 'shortdash',
                        width: 2,
                        label: {
                            text: maxRate + ' %',
                            align: 'right'
                        }
                        }],
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    // legend: {
                    //     layout: 'vertical',
                    //     align: 'left',
                    //     x: 120,
                    //     verticalAlign: 'top',
                    //     y: 100,
                    //     floating: true,
                    //     backgroundColor:
                    //         Highcharts.defaultOptions.legend.backgroundColor || // theme
                    //         'rgba(255,255,255,0.25)'
                    // },
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Total Order',
                        type: 'column',
                        // yAxis: 1,
                        data: result.nilaiorder,
                        dataLabels: {
                            enabled: false
                        },
                        tooltip: {
                            valueSuffix: ' Order'
                        }
                    },{
                        name: 'ItemQty (Pcs)',
                        type: 'column',
                        // yAxis: 1,
                        data: result.nilaiqty,
                        dataLabels: {
                            enabled: false
                        },
                        tooltip: {
                            valueSuffix: ' Pcs'
                        }
                    }, {
                        name: 'Performance',
                        type: 'spline',
                        yAxis: 1,
                        data: result.nilaisla,
                        dataLabels: {
                            enabled: true
                        },
                        tooltip: {
                            valueSuffix: ' %'
                        }
                    },{
                        name: 'Target',
                        type: 'line',
                        yAxis: 1,
                        data: [],
                        dataLabels: {
                            enabled: true
                        },
                        tooltip: {
                            valueSuffix: ' %'
                        }
                    }]
                });
            }
            function chartDailyOrderMonitoringMitraTokped(){
                // var date = new Date();
                var chart;
                var view_cl_in = $('#view_cl_tokped').val();
                var view_wh_in = $('#view_wh_tokped').val();
                var date = $('#sladate').val();
                // console.log(date);
                var uri = '<?php echo base_url(); ?>admin/C_home/getAllClientSlaMitraTokped';
                $.ajax(
                {
                    type: 'POST',
                    async: false,
                    dataType: "json",
                    cache: false,
                    url: uri,
                    data: {
                        date:date,
                        view_wh_in:view_wh_in,
                        view_cl_in:view_cl_in
                    },
                    success: function(result)
                    {
                        performancePerDayMitraTokped(result);
                    }
                });
                
            }
        </script>
