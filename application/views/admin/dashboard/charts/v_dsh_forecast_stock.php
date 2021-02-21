<script src="<?php echo base_url() ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/series-label.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/exporting.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/export-data.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="trend_stock"></div>
</figure>
<?php die;?>
  <!-- <?php
    // include "models/highcharts/M_charts.php";
    // $this->db->select('name,price');
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
    $prog = "SELECT name From program where program_id = '$program_id' ";

    $queryforcaststock = "SELECT 
                program_item_id, 
                SUM(order_quantity) AS forecast_qty  
              FROM orderdetail 
              WHERE DATE(created_date) >= DATE_SUB(DATE(NOW()),INTERVAL 30 DAY) 
              AND location_id = '$location_id' 
              AND program_id = '$program_id' 
              GROUP BY program_item_id 
              ORDER BY forecast_qty DESC ";
    // echo $query2;die;
    $nilaiforcaststock = $this->db->query($queryforcaststock)->result();
    foreach ($nilaiforcaststock as $isi ) {
      $querytotal = " SELECT 
                        SUM(exist_quantity) as qty
                      FROM inventorydetail a JOIN inventory b ON a.inventory_id = b.inventory_id
                      WHERE program_item_id = '$prog' 
                      AND program_id = '$program_id' 
                      AND location_id = '$location_id'";
      $total = $this->db->query( $querytotal)->result();

      $nilai[0] = (int)$total;
      
      $forecase1 = $ii['forecast_qty']/31;
      $sisa1 = $total-$forecase1;
      $nilai[1] = round($sisa1);
      
      $forecase2 = ($ii['forecast_qty']+$forecase1)/32;
      $sisa2 = $sisa1-$forecase2;
      $nilai[2] = round($sisa2);
      
      $forecase3 = ($ii['forecast_qty']+$forecase1+$forecase2)/33;
      $sisa3 = $sisa2-$forecase3;
      $nilai[3] = round($sisa3);
      
      $forecase4 = ($ii['forecast_qty']+$forecase1+$forecase2+$forecase3)/34;
      $sisa4 = $sisa3-$forecase4;
      $nilai[4] = round($sisa4);
      
      $forecase5 = ($ii['forecast_qty']+$forecase1+$forecase2+$forecase3+$forecase4)/35;
      $sisa5 = $sisa4-$forecase5;
      $nilai[5] = round($sisa5);
      
      $forecase6 = ($ii['forecast_qty']+$forecase1+$forecase2+$forecase3+$forecase4+$forecase5)/36;
      $sisa6 = $sisa5-$forecase6;
      $nilai[6] = round($sisa6);
      
      $forecase7 = ($ii['forecast_qty']+$forecase1+$forecase2+$forecase3+$forecase4+$forecase5+$forecase6)/37;
      $sisa7 = $sisa6-$forecase7;
      $nilai[7] = round($sisa7);
      
      $program_item = ProgramItem::model()->findByPk($ii['program_item_id']);
      
      $chart[] = array(
        'name'=>$program_item->item->name, 
        'data'=>$nilai
      );

    $chart[] = $isi->program_item_id;
    }

    //==============

    foreach($dataProvider->getData() as $i=>$ii)
    {
      
      
      
    }
    // print_r(json_encode($chart, JSON_NUMERIC_CHECK));die();
  ?>

  <script type="text/javascript">
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var date = new Date();
      var chart;
      chart = new Highcharts.chart({
        chart: {
          renderTo: 'trend_stock',
          type: 'line'
        },
        title: {
          text: 'Inventory Trend '+ months[date.getMonth()]+' '+date.getFullYear(), 
          x: -20
        },
        subtitle: {
          // <?php
          //     $location = $this->session->userdata('location_id');
          //     $program = $this->session->userdata('program_id');
          //     $subtitle = 'Data base on '.$program->name.' '.$location->name;
          // ?>
          
          text: "Database on '$program' '$location'",
          // <?php //echo json_encode($subtitle) ?>,
          x: -20
        },
        xAxis: {

          <?php
            $queryinbound_average = " SELECT 
                                      DATE_FORMAT(NOW(), '%d %b') AS dte 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +1 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +2 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +3 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +4 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +5 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +6 DAY), '%d %b') 
                                      UNION ALL 
                                      SELECT DATE_FORMAT(DATE_ADD(DATE(NOW()),INTERVAL +7 DAY), '%d %b') ";
            
            // echo $query;die;
            $datalabel = $this->db->query($queryinbound_average)->result();
            foreach ($data as $isi ) {
            $label[] = $isi->dte;
          ?>

          categories: <?php echo json_encode($label) ?>,
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
          name: 'Forcast Stock',
          data: <?php echo json_encode($chart3) ?>
        }]
      });
  </script> -->


<!---->

