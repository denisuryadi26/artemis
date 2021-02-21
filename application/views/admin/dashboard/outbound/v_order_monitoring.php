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
                <div class="card-body">
                        <div class="tab-pane fade show active" id="custom-content-below-dashboard" role="tabpane2" aria-labelledby="custom-content-below-dashboard-tab">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#dashboard_tab_1b" data-toggle="tab">DAILY ORDER MONITORING</a>
                                        <div class="form-group col-md-4">
                                        </div>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="#dashboard_tab_1" data-toggle="tab">OPERATIONAL REGULER</a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="dashboard_tab_1b">
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
                                                        <select name="date" id="date" class="form-control" onchange="chartDailyOrderMonitoring()">
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
                                                        <select class="form-control" id="view_wh_in" onchange="chartDailyOrderMonitoring()">
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
                                                        <select class="form-control" id="view_cl_in" onchange="chartDailyOrderMonitoring()">
                                                            <option value="allclient">View base on all Client</option>
                                                            <option value="justclient">View base on Client</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <td>
                                                        <form action="<?php echo base_url('admin/outbound/C_order_monitoring') ?>">
                                                            <input type="submit" value="Show For Wherehouse" class="btn btn-block btn-outline-primary"/>
                                                        </form>
                                                    </td>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="chart">
                                                                <figure class="highcharts-figure">
                                                                    <div id="trendorder_perhour"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="chart">
                                                                <figure class="highcharts-figure">
                                                                    <div id="ordercompletion_perday"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <figure class="highcharts-figure">
                                                                <div id="ordermonitoring_perday"></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <figure class="highcharts-figure">
                                                                <div id="operationleadtime"></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="chart">
                                                                <figure class="highcharts-figure">
                                                                    <div id="performance_per_day"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="dashboard_tab_1">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                        </div>
                                                        <select class="form-control" id="view_wh_in" onchange="chartDailyOrderMonitoringOpr()">
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
                                                        <select class="form-control" id="view_cl_in" onchange="chartDailyOrderMonitoringOpr()">
                                                            <option value="allclient">View base on all Client</option>
                                                            <option value="justclient">View base on Client</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="chart">
                                                                <figure class="highcharts-figure">
                                                                    <div id="ordercompletion_perday_opr"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <figure class="highcharts-figure">
                                                                <div id="ordermonitoring_perday_opr"></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <figure class="highcharts-figure">
                                                                <div id="operationleadtime_opr"></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="dashboard_tab_2">
                                            <div class="row">
                                                <!-- <div class="form-group col-md-3">
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
                                                        </select>
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
                                                </div> -->
                                                
                                            </div>
                                        </div>
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
                chartDailyOrderMonitoring();
                chartDailyOrderMonitoringOpr();
            });
            function initDashboardChart(result){
                performancePerDay(result);
                orderMonitoringPerDay(result);
                trendOrderPerHour(result);
                orderCompletionPerDay(result);
                operationLeadTime(result);
            }
            function initDashboardChartOpr(result){
                orderMonitoringPerDayOpr(result);
                orderCompletionPerDayOpr(result);
                operationLeadTimeOpr(result);
            }
            function performancePerDay(result){
                var date = new Date();
                var maxRate = 98;
                chart = new Highcharts.chart({
                    chart: {
                        renderTo: 'performance_per_day',
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
            function orderMonitoringPerDay(result){
                Highcharts.chart('ordermonitoring_perday', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Order Monitoring Today'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: ['Pending Order D+N','Pending Order D-1 After 4 PM', 'Pending Order Before 4 PM', 'Pending Order After 4 PM', 'Order Packed', 'RTS Complete','Shipping Complete','Cancel'],
                        title: {
                        text: null
                        }
                    },
                    yAxis: [{
                        min: 0,
                        title: {
                        text: '',
                        align: 'high'
                        },
                        labels: {
                        overflow: 'justify'
                        },
                        title: {
                            text: 'Values',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            },
                            enabled: false
                        },
                        labels: {
                            enabled: false
                        }
                    }],
                    tooltip: {
                        valueSuffix: ' Order'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        },
                        series: {
                            cursor: 'pointer',
                            point: {
                                events: {
                                    click: function () {
                                        // location.href = '<?php echo base_url(); ?>admin/C_charttable';
                                        window.open(
                                        '<?php echo base_url(); ?>admin/C_charttable',
                                        '_blank' // <- This is what makes it open in a new window.
                                        );
                                    }
                                }
                            }
                        }
                    },legend: {
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    credits: {
                        enabled: false
                    },
                    // colors: ['#800000', '#228B22', '#2E8B57', '#20B2AA', '#FF1493', '#E9967A', '#FF0000'],
                    series: [{
                        name: 'Total',
                        data: result.nilaiordermonitoringperday
                    }]
                });
            }
            function trendOrderPerHour(result){
                var date = new Date();
                Highcharts.chart('trendorder_perhour',{
                    title: {
                        text: 'Trend Order Per Hour On ' +date.toLocaleString(undefined, {
                        weekday: 'long'
                        }) +' '+date.toLocaleString(undefined, {
                        day: 'numeric'
                        }) +' '+date.toLocaleString(undefined, {
                        month: 'long'
                        }) +' '+date.toLocaleString(undefined, {
                        year: 'numeric'
                        }) +' In '+date.toLocaleString(undefined, {
                        hour: 'numeric'
                        })
                    },
                    xAxis: {
                        categories: result.hour,
                        crosshair: true
                    },
                    yAxis: {
                        labels: {
                            format: '{value}',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                            
                        },
                        title: {
                            text: '',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },tooltip: {
                        shared: true
                    },
                    colors: ['#0092ff', '#ff8100'],
                    series: [{
                        type: 'column',
                        name: 'Order',
                        tooltip: {
                            valueSuffix: ' Order'
                        },
                        data: result.orderperhour,
                        dataLabels: {
                            enabled: true
                        }
                    }, {
                        type: 'column',
                        name: 'Item Qty (Pcs)',
                        // yAxis: 1,
                        tooltip: {
                            valueSuffix: ' Pcs'
                        },
                        data: result.itemqtyperhour,
                        dataLabels: {
                            enabled: true
                        }
                    }]
                    });
            }
            function orderCompletionPerDay(result){
                Highcharts.chart('ordercompletion_perday', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Order Completion Today'
                    },
                    subtitle: {
                        text: 'Complete Status in Ready To Shipped & Shipped <br> Not Complete Status in Ready To Picked up to Packed'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <br><b>{point.percentage:.1f} %</b><br>'
                    },
                    accessibility: {
                        point: {
                        valueSuffix: '%'
                        }
                    },
                    // plotOptions: {
                    //     pie: {
                    //     allowPointSelect: true,
                    //     cursor: 'pointer',
                    //     dataLabels: {
                    //         enabled: true
                    //     },
                    //     showInLegend: true
                    //     }
                    // }
                    plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>',
                        },
                        showInLegend: true
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    colors: ['#008000', '#ffff00'],
                    series: [{
                        name: 'Order Completion Today',
                        colorByPoint: true,
                        data: [{
                        name: 'Complete',
                        y: result.completionblue
                        }, {
                        name: 'Not Complete',
                        y: result.completionyellow
                        }]
                    }]
                });
            }
            function operationLeadTime(result){
                var total = [];
                function toMs(timeUnformatted) 
                {
                    return Date.parse("1/1/1 " + timeUnformatted.toString()) - Date.parse("1/1/1 00:00:00");
                }
                // console.log(result.nilaioperationleadtime);
                $.each(result.nilaioperationleadtime, function(key, item) {
                    if(item == null)
                    {
                        total.push(toMs('00:00:00'));
                    }
                    else
                    {
                        var r = item.split(':');
                        
                        if(r[0] == '-00')
                        {
                            total.push(toMs('00:00:00'));
                        }
                        else
                        {
                            total.push(
                                toMs(r[0] + ':' + r[1] + ':' + r[2])
                            );
                        }
                    }
                });
                Highcharts.chart('operationleadtime', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Operation Average Lead Time Process Today'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: result.operationlabel,
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        // min: 0,
                        // type: 'datetime',
                        // title: {
                        // text: '',
                        // align: 'high'
                        // },
                        // labels: {
                        // overflow: 'justify'
                        // ,
                        // format: '{value:%H:%M}',
                        // }
                        // ---
                        // type: 'time',
                        // labels: {
                        //     formatter: function () {
                        //         var time = this.value;
                        //         var hours1=parseInt(time/3600000);
                        //         var mins1=parseInt((parseInt(time%3600000))/60000);
                        //         var secs1=parseInt((parseInt(time%3600000))%60000);
                        //         return (hours1 < 10 ? '0' + hours1 : hours1) + ':' + (mins1 < 10 ? '0' + mins1 : mins1) + ':' + (secs1 < 10 ? '0' + secs1 : secs1/1000);
                        //     }   
                        // },
                        title: {
                            text: 'Time',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            },
                            enabled: false
                        },
                        labels: {
                            enabled: false
                        }
                    },
                    tooltip: {
                        // valueSuffix: ''
                        // ,
                        pointFormat: "<span style='color:{point.color}'>\u25CF</span> {series.name}<br/>"
                    },
                    plotOptions: {
                        bar: {
                        dataLabels: {
                            enabled: true
                        }
                        }
                    },legend: {
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Operation Lead Time',
                        data: total,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                var time = this.y / 1000;
                                var hours1=parseInt(time/3600);
                                var mins1=parseInt((parseInt(time%3600))/60);
                                var secs1=parseInt((parseInt(time%3600))%60);
                                return (hours1 < 10 ? '0' + hours1 : hours1) + ':' + (mins1 < 10 ? '0' + mins1 : mins1) + ':' + (secs1 < 10 ? '0' + secs1 : secs1);
                            }
                        },
                    }]
                });                
            }
            function chartDailyOrderMonitoring(){
                // var date = new Date();
                var chart;
                var view_cl_in = $('#view_cl_in').val();
                var view_wh_in = $('#view_wh_in').val();
                var date = $('#date').val();
                // console.log(date);
                var uri = '<?php echo base_url(); ?>admin/outbound/C_order_monitoring/getAllClient';
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
                        initDashboardChart(result);
                    }
                });
                
            }
            // Opr
            function orderMonitoringPerDayOpr(result){
                Highcharts.chart('ordermonitoring_perday_opr', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Order Monitoring Today'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: ['Pending Order Before 4 PM', 'Order Packed', 'RTS Complete','Shipping Complete','Cancel'],
                        title: {
                        text: null
                        }
                    },
                    yAxis: [{
                        min: 0,
                        title: {
                        text: '',
                        align: 'high'
                        },
                        labels: {
                        overflow: 'justify'
                        },
                        title: {
                            text: 'Values',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            },
                            enabled: false
                        },
                        labels: {
                            enabled: false
                        }
                    }],
                    tooltip: {
                        valueSuffix: ' Order'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },legend: {
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    credits: {
                        enabled: false
                    },
                    // colors: ['#800000', '#228B22', '#2E8B57', '#20B2AA', '#FF1493', '#E9967A', '#FF0000'],
                    series: [{
                        name: 'Total',
                        data: result.nilaiordermonitoringperday
                    }]
                });
            }
            function orderCompletionPerDayOpr(result){
                Highcharts.chart('ordercompletion_perday_opr', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Order Completion Today'
                    },
                    subtitle: {
                        text: 'Complete Status in Ready To Shipped & Shipped <br> Not Complete Status in Ready To Picked up to Packed'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <br><b>{point.percentage:.1f} %</b><br>'
                    },
                    accessibility: {
                        point: {
                        valueSuffix: '%'
                        }
                    },
                    // plotOptions: {
                    //     pie: {
                    //     allowPointSelect: true,
                    //     cursor: 'pointer',
                    //     dataLabels: {
                    //         enabled: true
                    //     },
                    //     showInLegend: true
                    //     }
                    // }
                    plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>',
                        },
                        showInLegend: true
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    colors: ['#008000', '#ffff00'],
                    series: [{
                        name: 'Order Completion Today',
                        colorByPoint: true,
                        data: [{
                        name: 'Complete',
                        y: result.completionblue
                        }, {
                        name: 'Not Complete',
                        y: result.completionyellow
                        }]
                    }]
                });
            }
            function operationLeadTimeOpr(result){
                var total = [];
                function toMs(timeUnformatted) 
                {
                    return Date.parse("1/1/1 " + timeUnformatted.toString()) - Date.parse("1/1/1 00:00:00");
                }
                $.each(result.nilaioperationleadtime, function(key, item) {
                    if(item == null)
                    {
                        total.push(toMs('00:00:00'));
                    }
                    else
                    {
                        var r = item.split(':');
                        
                        if(r[0] == '-00')
                        {
                            total.push(toMs('00:00:00'));
                        }
                        else
                        {
                            total.push(
                                toMs(r[0] + ':' + r[1] + ':' + r[2])
                            );
                        }
                    }
                });
                Highcharts.chart('operationleadtime_opr', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Operation Average Lead Time Process Today'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: result.operationlabel,
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        // min: 0,
                        // type: 'datetime',
                        // title: {
                        // text: '',
                        // align: 'high'
                        // },
                        // labels: {
                        // overflow: 'justify'
                        // ,
                        // format: '{value:%H:%M}',
                        // }
                        // ---
                        // type: 'time',
                        // labels: {
                        //     formatter: function () {
                        //         var time = this.value;
                        //         var hours1=parseInt(time/3600000);
                        //         var mins1=parseInt((parseInt(time%3600000))/60000);
                        //         var secs1=parseInt((parseInt(time%3600000))%60000);
                        //         return (hours1 < 10 ? '0' + hours1 : hours1) + ':' + (mins1 < 10 ? '0' + mins1 : mins1) + ':' + (secs1 < 10 ? '0' + secs1 : secs1/1000);
                        //     }   
                        // },
                        title: {
                            text: 'Time',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            },
                            enabled: false
                        },
                        labels: {
                            enabled: false
                        }
                    },
                    tooltip: {
                        // valueSuffix: ''
                        // ,
                        pointFormat: "<span style='color:{point.color}'>\u25CF</span> {series.name}<br/>"
                    },
                    plotOptions: {
                        bar: {
                        dataLabels: {
                            enabled: true
                        }
                        }
                    },legend: {
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Operation Lead Time',
                        data: total,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                var time = this.y / 1000;
                                var hours1=parseInt(time/3600);
                                var mins1=parseInt((parseInt(time%3600))/60);
                                var secs1=parseInt((parseInt(time%3600))%60);
                                return (hours1 < 10 ? '0' + hours1 : hours1) + ':' + (mins1 < 10 ? '0' + mins1 : mins1) + ':' + (secs1 < 10 ? '0' + secs1 : secs1);
                            }
                        },
                    }]
                });                
            }
            function chartDailyOrderMonitoringOpr(){
                // var date = new Date();
                var chart;
                var view_cl_in = $('#view_cl_in').val();
                var view_wh_in = $('#view_wh_in').val();
                var date = $('#date').val();
                // console.log(date);
                var uri = '<?php echo base_url(); ?>admin/outbound/C_order_monitoring/getAllClientOpr';
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
                        initDashboardChartOpr(result);
                    }
                });
                
            }
        </script>
<script>
    $(function () {
        $("#minimumstock").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $("#deadstock").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $("#expiredstock").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $('#notdelivered').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $('#waybillnull').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
    });
</script>
