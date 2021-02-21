<script src="<?php echo base_url() ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/series-label.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/exporting.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/export-data.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="trend_order"></div>
</figure>
<?php die;?>
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
    $querynilai = " SELECT 
                        dte,
                        ctn 
                    FROM trendorderctn ";
    // echo $querynilai;die;
    $datanilai = $this->db->query($querynilai)->result();
    foreach ($datanilai as $isi ) {
    $chart[] = intval($isi->ctn);
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
          renderTo: 'trend_order',
          type: 'line'
        },
        title: {
          text: 'Demand Dashboard '+ months[date.getMonth()]+' '+date.getFullYear(), 
          x: -20
        },
        subtitle: {
          // <?php
          //     $location = $this->session->userdata('location_id');
          //     $program = $this->session->userdata('program_id');

          //     $loc = "SELECT name From location where location_id = '$location' ";
          //     $prog = "SELECT name From program where program_id = '$program' ";
          //     $locations = $this->db->query($loc)->result();
          //     $programs = $this->db->query($prog)->result();

          //     $sub = 'Data base on '.$programs->name.' '.$locations->name;
          // ?>
          
          text: "Database on '$program' '$location'",
          // text: <?php //echo json_encode($sub) ?>,
          x: -20
        },
        xAxis: {
            <?php
              $querylabel = " SELECT 
                                DATE_FORMAT(dte, '%d %b') AS DAY 
                              FROM ( 
                                SELECT DATE_SUB(DATE(NOW()),INTERVAL 30 DAY) + INTERVAL a + b DAY AS dte   
                                FROM (SELECT 0 a UNION SELECT 1 a UNION SELECT 2  UNION SELECT 3  
                                UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7   
                                UNION SELECT 8 UNION SELECT 9 ) d, (  
                                SELECT 0 b UNION SELECT 10 UNION SELECT 20 UNION SELECT 30) m  
                              WHERE DATE_SUB(DATE(NOW()),INTERVAL 38 DAY) + INTERVAL a + b DAY  <  DATE(NOW())  
                              ORDER BY dte) alias";
              // echo $querylabel;die;
              $datalabel = $this->db->query($querylabel)->result();
              foreach ($datalabel as $isi ) {
              $label[] = $isi->DAY;
              }
            ?>
          categories: <?php echo json_encode($label) ?>,
          // <?php //echo json_encode($nama_barang) ?>,
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
          valueSuffix: ''
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
          name: 'Trend Order',
          data: <?php echo json_encode($chart) ?>
        }]
      });
  </script>


<!---->

