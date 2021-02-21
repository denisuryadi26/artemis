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
                <div class="card">
                    <div class="card-body">
                            <div class="tab-pane fade show active" id="custom-content-below-shipmentcontrol" role="tabpane6" aria-labelledby="custom-content-below-shipmentcontrol-tab">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3">SHIPMENT INFORMATION</h3>
                                        <ul class="nav nav-pills ml-auto p-2">
                                            <li class="nav-item"><a class="nav-link active" href="#tab_10" data-toggle="tab">NOT DELIVERED</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_11" data-toggle="tab">WAYBILL INACTIVE</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_12" data-toggle="tab">WAYBILL NULL</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_10">
                                                <!-- HALAMAN NOT DELIVERED -->
                                                <form id="notdelivered-form" action="<?= base_url('admin/C_SHIPMENT/download_not_delivered');?>" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-info">
                                                        <div class="form-group col-md-3">
                                                            <td>
                                                                <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                                <button type="button"  id="reload" onclick="notDelivered()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/C_shipment" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                                    <i class="fas fa-sync-alt"></i> Reload
                                                                </button>
                                                            </td>
                                                        </div>    
                                                            <div class="box-body">
                                                                <div class="table-responsive" id="minimum_stock-grid">
                                                                    <table id="notdeliveredtable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                                        <thead>
                                                                            <tr>
                                                                                <th id="minimum_stock-grid_c0">CLIENT</th>
                                                                                <th id="minimum_stock-grid_c1">DATE</th>
                                                                                <th id="minimum_stock-grid_c2">TOTAL</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="notdelivered">
                                                                            <?php
                                                                                foreach ($notdelivered as $row) 
                                                                                {
                                                                            ?>
                                                                            <tr class="odd">
                                                                                <td><?php echo $row->program_name; ?></td>
                                                                                <td><?php echo $row->dte; ?></td>
                                                                                <td><?php echo $row->total; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-primary">DOWNLOAD</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                <!-- END HALAMAN NOT DELIVERED -->
                                            </div>
                                        
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_11">
                                                <!-- HALAMAN WAYBILL INACTIVE -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-info">
                                                            <div class="box-header with-border">
                                                                <i class="fa fa-warning"></i>
                                                                <h3 class="box-title">Waybill Inactive Information</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="error-page">
                                                                    <h2 class="headline text-yellow">501</h2>
                                                                    <div class="error-content">
                                                                        <h3><i class="fa fa-info-circle text-yellow"></i><b> Oops! Feature coming soon</b></h3>
                                                                        <p>
                                                                            This page is currently under construction. Please come back later.
                                                                        </p>
                                                                        <form class="search-form">
                                                                            <div class="input-group">
                                                                                <input type="text" name="search" class="form-control" placeholder="Search">
                                                                                <div class="input-group-btn">
                                                                                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END HALAMAN WAYBILL INACTIVE -->
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_12">
                                                <!-- HALAMAN WAYBILL NULL -->
                                                <form id="maybillnull-form" action="<?= base_url('admin/C_shipment/download_waybill_information');?>" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-info">
                                                            <div class="form-group col-md-3">
                                                                <td>
                                                                    <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                                    <button type="button"  id="reload2" onclick="waybillNull()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/C_shipment" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                                        <i class="fas fa-sync-alt"></i> Reload
                                                                    </button>
                                                                </td>
                                                            </div>   
                                                            <div class="box-body">
                                                                <div class="table-responsive" id="waybill_null-grid">
                                                                    <table id="waybillnulltable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                                        <thead>
                                                                            <tr>
                                                                                <th id="waybill_null-grid_c0">CLIENT</th>
                                                                                <th id="waybill_null-grid_c1">DATE</th>
                                                                                <th id="waybill_null-grid_c2">TOTAL</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="waybillnull">
                                                                            <?php
                                                                                foreach ($waybillnull as $row) 
                                                                                {
                                                                            ?>
                                                                            <tr class="odd">
                                                                                <td><?php echo $row->program_name; ?></td>
                                                                                <td><?php echo $row->dte; ?></td>
                                                                                <td><?php echo $row->total; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                    
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-primary">DOWNLOAD</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END HALAMAN WAYBILL NULL -->
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
        </div>
    </section>
</div>
<script type="text/javascript">
    
    function notDelivered() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/C_shipment/getNotDelivered';
        
        axios.post(uri)
        .then(response => {
            var notdelivereddata = [];
            var result = response.data;
            $(".notdelivered").find('tr').remove();
            var notdelivered = $(".notdelivered");
            $.each(result.notdelivered, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.program_name);
                out.push(item.dte);
                out.push(item.total);
                notdelivereddata.push(out);
            });

            $("#notdeliveredtable").dataTable().fnDestroy();
            $("#notdeliveredtable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: notdelivereddata
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }

    function waybillNull() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload2').val();
        var uri = '<?php echo base_url(); ?>admin/C_shipment/getWayBillNull';
        
        axios.post(uri)
        .then(response => {
            var waybillnulldata = [];
            var result = response.data;
            $(".waybillnull").find('tr').remove();
            var waybillnull = $(".waybillnull");
            $.each(result.waybillnull, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.program_name);
                out.push(item.dte);
                out.push(item.total);
                waybillnulldata.push(out);
            });

            $("#waybillnulltable").dataTable().fnDestroy();
            $("#waybillnulltable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: waybillnulldata
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
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
        $('#notdeliveredtable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $('#waybillnulltable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
    });
</script>
