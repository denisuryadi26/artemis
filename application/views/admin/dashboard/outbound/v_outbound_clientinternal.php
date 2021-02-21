<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Top Client SLA Summary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Top Client SLA In 7 Days</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="col-md-14">
                                <div class="card card-info shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Top Client SLA Summary</h3>
                                        <div class="card-tools">
                                        <button type="button" onclick="topClientSummary()" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/outbound/C_outbound_clientinternal" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                                                    $date = date("Y-m-d");
                                                    $date = strtotime($date);
                                                    $firtsdate = strtotime("-14 day", $date);
                                                    $lastdate = strtotime("-7 day", $date);
                                                    $hariawal = date("Y-m-01");
                                                    // $hariawal = date('m-d-Y', $firtsdate);
                                                    $hariakhir = date('m-d-Y', $lastdate);
                                                    $day = $hariawal.' - '. $hariakhir;
                                                    ?>
                                                    <th rowspan="2" colspan="2" id="packinglist-grid_c2" style="text-align:center">Total AVG Per Day in <?php echo $day?></th>
                                                    
                                                </tr>
                                                <tr></tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align:center">Packed</th>
                                                    <th style="text-align:center">RTS</th>
                                                </tr>
                                            </thead>
                                            <tbody class="nilaiqueryslatopclient">
                                                <tr>
                                                <?php foreach ($nilaiqueryslatopclient as $row) { ?>
                                                    <td>
                                                        <?php echo $row->program_name; ?></td>
                                                    <td>
                                                        <?php echo $row->location_name; ?></td>
                                                    <td bgcolor="<?php echo $row->color_packed; ?>" style="text-align:center">
                                                        <?php echo $row->ach_packed; ?> %</td>
                                                    <td bgcolor="<?php echo $row->color_rts; ?>" style="text-align:center">
                                                        <?php echo $row->ach_rts; ?> %</td>
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
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="col-md-14">
                                <div class="card card-info shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Top Client SLA In 7 Days</h3>
                                        <div class="card-tools">
                                        <button type="button" id="reload2" onclick="topClientPerDay()" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/outbound/C_outbound_clientinternal" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                                            <tbody class="nilaiquerysladaytopclient">
                                            <tr>
                                                <?php foreach ($nilaiquerysladaytopclient as $dayrow) { ?>
                                                    <td>
                                                        <?php echo $dayrow->program_name; ?></td>
                                                    <td>
                                                        <?php echo $dayrow->location_name; ?></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_1; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_1 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_1."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_1; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_1; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_1 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_1."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_1; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_2; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_2 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_2."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_2; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_2; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_2 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_2."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_2; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_3; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_3 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_3."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_3; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_3; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_3 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_3."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_3; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_4; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_4 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_4."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_4; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_4; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_4 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_4."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_4; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_5; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_5 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_5."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_5; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_5; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_5 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_5."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_5; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_6; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_6 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_6."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_6; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_6; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_6 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_6."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_6; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_packed_7; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_packed_7 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_7."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->packed_7; ?> %</a></td>
                                                    <td bgcolor="<?php echo $dayrow->color_rts_7; ?>" style="text-align:center">
                                                        <a <?php if($dayrow->color_rts_7 == 'tomato')
                                                                { echo "href='https://artemis.haistar.co.id/admin/C_performance/downloadordertopclient/".$dayrow->program_id."/".$dayrow->location_id."/".$dayrow->order_created_date_7."' target='_blank'";}?> > 
                                                        <?php echo $dayrow->rts_7; ?> %</a></td>
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
        </div>
    </section>
</div>

<script type="text/javascript">
    // setTimeout(tokocabangPerDay, 10000);

    function topClientSummary() 
    {
        var date = new Date();
        var chart;
        // var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/outbound/C_outbound_clientinternal/getAllslaTopClient';
    
        axios.post(uri)
        .then(response => {
            var result = response.data;
            $(".nilaiqueryslatopclient").find('tr').remove();
            var nilaiqueryslatopclient = $(".nilaiqueryslatopclient");
            $.each(result.nilaiqueryslatopclient, function(key, item) 
            {
                var inti;
                inti = '<tr class="odd">';
                inti += '<td style="text-align:center">' + item.program_name + '</td>';
                inti += '<td style="text-align:center">' + item.location_name + '</td>';
                inti += '<td style="text-align:center">' + item.ach_packed + ' %</td>';
                inti += '<td style="text-align:center">' + item.ach_rts + ' %</td>';
                inti += '</tr>';
                nilaiqueryslatopclient.append(inti);
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }
    
    function topClientPerDay() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload2').val();
        var uri = '<?php echo base_url(); ?>admin/outbound/C_outbound_clientinternal/getAllslaDayTopClient';
    
        axios.post(uri)
        .then(response => {
            var result = response.data;
            $(".nilaiquerysladaytopclient").find('tr').remove();
            var nilaiquerysladaytopclient = $(".nilaiquerysladaytopclient");
            $.each(result.nilaiquerysladaytopclient, function(key, item) 
            {
                var inti;
                inti = '<tr class="odd">';
                inti += '<td style="text-align:center">' + item.program_name + '</td>';
                inti += '<td style="text-align:center">' + item.location_name + '</td>';
                inti += '<td style="text-align:center">' + (item.packed_1 = item.packed_1 || "-")  + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_1 = item.rts_1 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_2 = item.packed_2 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_2 = item.rts_2 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_3 = item.packed_3 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_3 = item.rts_3 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_4 = item.packed_4 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_4 = item.rts_4 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_5 = item.packed_5 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_5 = item.rts_5 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_6 = item.packed_6 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_6 = item.rts_6 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.packed_7 = item.packed_7 || "-") + ' %</td>';
                inti += '<td style="text-align:center">' + (item.rts_7 = item.rts_7 || "-") + ' %</td>';
                inti += '</tr>';
                nilaiquerysladaytopclient.append(inti);
            });
            // console.log(result);
        })
        .catch(errors => {
            console.log(errors);
        });
    }
    
</script>