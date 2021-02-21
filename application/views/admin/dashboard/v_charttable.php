<?php date_default_timezone_set('Asia/Jakarta'); $totime = strtotime(date("Y-m-d H:i:s")); ?>
<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> Pending Before 4 PM All Client</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="inbound-form" action="<?= base_url('admin/C_charttable/exportpendingbefore4pm');?>" method="post">
                        <table id="pendingbefore4pm" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                            <thead>
                                <tr>
                                    <!-- <th id="packinglist-grid_c0">Location Name</th> -->
                                    <th id="packinglist-grid_c1">Client Name</th>
                                    <th id="packinglist-grid_c2">Order Code</th>
                                    <th id="packinglist-grid_c3">Status</th>
                                    <th id="packinglist-grid_c3">Courier</th>
                                    <th id="packinglist-grid_c4">Created Date</th>
                                   <!--  <th id="packinglist-grid_c4">Hour</th> -->
                                    <th id="packinglist-grid_c4">Target</th>
                                    <th id="packinglist-grid_c4">Remaining Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($nilaipendingbefore4pm as $row) 
                                    {
                                ?>
                                    <tr class="odd">
                                       <!--  <td><?php //echo $row->location_name; ?></td> -->
                                        <td><?php echo $row->program_name; ?></td>
                                        <td><?php echo $row->order_code; ?></td>
                                        <td><?php echo $row->status; ?></td>
                                        <td><?php echo $row->courier_name; ?></td>
                                        <td><?php echo $row->order_created_date." ".$row->jam; ?></td>
                                       <!--  <td><?php //echo $row->jam; ?></td> -->
                                        <td><?php echo $row->order_created_date." 23:59:59"; ?></td>
                                        <td><?php  $startime = strtotime($row->order_created_date." 23:59:59");  
                                        			$diff = $startime-$totime;  $jam = floor($diff / (60 * 60));  
                                        			$menit = $diff - $jam * (60 * 60); 
                                        			echo $jam.":".floor( $menit / 60 ); //echo $row->remaining_hour_before4pm; ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> Pending After 4 PM All Client</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="inbound-form" action="<?= base_url('admin/C_charttable/exportpendingafter4pm');?>" method="post">
                        <table id="pendingafter4pm" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                            <thead>
                                <tr>
                                    <!-- <th id="packinglist-grid_c0">Location Name</th> -->
                                    <th id="packinglist-grid_c1">Client Name</th>
                                    <th id="packinglist-grid_c2">Order Code</th>
                                    <th id="packinglist-grid_c3">Status</th>
                                    <th id="packinglist-grid_c3">Courier</th>
                                    <th id="packinglist-grid_c4">Created Date</th>
                                    <th id="packinglist-grid_c4">Target</th>
                                    <th id="packinglist-grid_c4">Remaining Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($nilaipendingafter4pm as $row) 
                                    {
                                ?>
                                    <tr class="odd">
                                       <!--  <td><?php //echo $row->location_name; ?></td> -->
                                        <td><?php echo $row->program_name; ?></td>
                                        <td><?php echo $row->order_code; ?></td>
                                        <td><?php echo $row->status; ?></td>
                                        <td><?php echo $row->courier_name; ?></td>
                                        <td><?php echo $row->order_created_date.":".$row->jam; ?></td>
                                        <td><?php   $newtime = $row->order_created_date." ".$row->jam;
                                        			$cenvertedTime = date('Y-m-d H:i:s',strtotime('+20 hour',strtotime($newtime)));
                                        			echo $cenvertedTime; ?></td>
                                        <td><?php 	$newtime = $row->order_created_date." ".$row->jam;
                                        			$cenvertedTime = date('Y-m-d H:i:s',strtotime('+20 hour',strtotime($newtime)));
                                        			$startime = strtotime($cenvertedTime);  
                                        			$diff = $startime-$totime;  $jam = floor($diff / (60 * 60));  
                                        			$menit = $diff - $jam * (60 * 60); 
                                        			echo $jam.":".floor( $menit / 60 );
                                        			//echo $cenvertedTime;
                                        			//echo $row->remaining_hour_after4pm; ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> Pending Order D+N All Client</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="inbound-form" action="<?= base_url('admin/C_charttable/exportpendingorderdplusn');?>" method="post">
                        <table id="pendingdplusn" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                            <thead>
                                <tr>
                                  <!--   <th id="packinglist-grid_c0">Location Name</th> -->
                                    <th id="packinglist-grid_c1">Client Name</th>
                                    <th id="packinglist-grid_c2">Order Code</th>
                                    <th id="packinglist-grid_c3">Status</th>
                                    <th id="packinglist-grid_c3">Courier</th>
                                    <th id="packinglist-grid_c4">Created Date</th>
                                    <th id="packinglist-grid_c4">Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($nilaipendingdplusn as $row) 
                                    {
                                ?>
                                    <tr class="odd">
                                        <!-- <td><?php //echo $row->location_name; ?></td> -->
                                        <td><?php echo $row->program_name; ?></td>
                                        <td><?php echo $row->order_code; ?></td>
                                        <td><?php echo $row->status; ?></td>
                                        <td><?php echo $row->courier_name; ?></td>
                                        <td><?php echo $row->order_created_date; ?></td>
                                        <td><?php echo $row->jam; ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $("#pendingbefore4pm").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        });
    });
    $(function () {
        $("#pendingafter4pm").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        });
    });
    $(function () {
        $("#pendingdplusn").DataTable({
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
    $(document).ready(function() 
            {
                // chartDownload();
            });
    function chartDownload() 
    {
        var date = new Date();
        var chart;
        var view_client_all = $('#view_client_all').val();
        var uri = '<?php echo base_url(); ?>admin/C_charttable/getAllPendingClient';
    
        jQuery.ajax(
        {
            type: 'POST',
            async: false,
            dataType: "json",
            cache: false,
            url: uri,
            data: {
                date:date,
                view_client_all:view_client_all
            },
            success: function(result)
            {
                console.log(result.nilaipendingbefore4pm);
                $(".nilaipendingbefore4pm").find('tr').remove();
                var nilaipendingbefore4pm = $(".nilaipendingbefore4pm");
                $.each(result.nilaipendingbefore4pm, function(key, item) 
                {
                    var inti;
                    inti = '<tr class="odd">';
                    inti += '<td>' + item.location_name + '</td>';
                    inti += '<td>' + item.program_name + '</td>';
                    inti += '<td>' + item.order_code + '</td>';
                    inti += '<td>' + item.status + '</td>';
                    inti += '<td>' + item.order_created_date + '</td>';
                    inti += '</tr>';
                    nilaipendingbefore4pm.append(inti);
                });
                // ---
            }
        });
    }
</script>