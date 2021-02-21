<?php 
    echo $this->session->flashdata('message'); 
    date_default_timezone_set('Asia/Jakarta');
    $now   = date('F Y');
    $bulan = date('M');
    $bln   = date('m');
    $tahun = date('Y');
    // echo json_encode($bulan);die;
?>
<!-- <div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> -->
                        <div class="row">
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
                            <!-- <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="table-responsive" id="dead-stock-grid">
                                            <table class="table table-bordered table-striped table-sm" style="font-size:11px">
                                                <thead>
                                                    <tr>
                                                        <th bgcolor="red" id="dead-stock-grid_c0" color="red">ADMIN</th>
                                                        <th bgcolor="orange" id="dead-stock-grid_c1">PICKER</th>
                                                        <th bgcolor="yellow" id="dead-stock-grid_c2">CHECKER</th>
                                                        <th bgcolor="lightblue" id="dead-stock-grid_c3">PACKER</th>
                                                        <th bgcolor="green" id="dead-stock-grid_c4">ROUTER</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd">
                                                        <td>
                                                            1</td>
                                                        <td>
                                                            4</td>
                                                        <td>
                                                            1</td>
                                                        <td>
                                                            4</td>
                                                        <td>
                                                            1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    <!-- </div>
                </div>
            </div>
        </div>
    </section>
</div> -->

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
        <script type="text/javascript">
            var orderMonitoringPerDay_chart, trendOrderPerHour_chart, operationLeadTime_chart, orderCompletionPerDay_chart;

            $(document).ready(function() 
            {

                chartDailyOrderMonitoring();
                // homeMonitoring();
                setInterval(function() {
                    init();
                }, 600000);
            });

            function init(){
                orderMonitoringPerDay_chart.destroy();
                trendOrderPerHour_chart.destroy();
                orderCompletionPerDay_chart.destroy();
                operationLeadTime_chart.destroy();
                chartDailyOrderMonitoring();
            }


            function initDashboardChart(result){
                orderMonitoringPerDay(result);
                trendOrderPerHour(result);
                orderCompletionPerDay(result);
                operationLeadTime(result);
            }


            function orderMonitoringPerDay(result){
                orderMonitoringPerDay_chart = new Highcharts.chart('ordermonitoring_perday', {
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
                trendOrderPerHour_chart = new Highcharts.chart('trendorder_perhour',{
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
                orderCompletionPerDay_chart = new Highcharts.chart('ordercompletion_perday', {
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
                operationLeadTime_chart = new Highcharts.chart('operationleadtime', {
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
                var view_cl_in = $('#view_cl_in').val();
                var view_wh_in = $('#view_wh_in').val();
                // var date = $('#date').val();
                // console.log(date);
                var uri = '<?php echo base_url(); ?>admin/C_dashboardwhmonitoring/getAllClient';
                $.ajax(
                {
                    type: 'POST',
                    async: false,
                    dataType: "json",
                    cache: false,
                    url: uri,
                    data: {
                        // date:date,
                        view_wh_in:view_wh_in,
                        view_cl_in:view_cl_in
                    },
                    success: function(result)
                    {
                        initDashboardChart(result);
                    }
                });
                
            }
        </script>