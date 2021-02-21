<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-info card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">DEAD STOCK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">FAST MOVING & SLOW MOVING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">MINIMUM STOCK</a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <form id="inbound-form" action="<?= base_url('admin/inventory/C_inventory_monitoring/download_dead_stock');?>" method="post">
                                <div class="tab-pane" id="item_tab_6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="form-group col-md-3">
                                                    <td>
                                                        <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                        <button type="button"  id="reload" onclick="deadStock()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/inventory/C_inventory_monitoring" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                            <i class="fas fa-sync-alt"></i> Reload
                                                        </button>
                                                    </td>
                                                </div>  
                                                <div class="box-body">
                                                    <div class="table-responsive" id="dead-stock-grid">
                                                        <table id="deadstocktable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                            <thead>
                                                                <tr>
                                                                    <th id="dead-stock-grid_c0">MARKET PLACE</th>
                                                                    <th id="dead-stock-grid_c1">ITEM CODE</th>
                                                                    <th id="dead-stock-grid_c2">ITEM NAME</th>
                                                                    <th id="dead-stock-grid_c3">READY TO ORDER</th>
                                                                    <th id="dead-stock-grid_c4">INBOUND DATE</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="deadstock">
                                                                <?php foreach ($deadstock as $row) { ?>
                                                                <tr class="odd">
                                                                    <td>
                                                                        <?php echo $row->market_place; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_sku; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_name; ?></td>
                                                                    <td>
                                                                        <?php echo $row->quantity; ?> pcs</td>
                                                                    <td>
                                                                        <?php echo $row->inbound_date; ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="tab-pane" id="item_tab_7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <i class="fa fa-thumbs-o-up"></i>
                                                <h3 class="box-title">Fast Moving Item</h3>

                                            </div>
                                            <div class="box-body">
                                                <ul class="products-list product-list-in-box">
                                                    <div class="table-responsive" id="fast-moving-grid">
                                                        <table class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="display:none" id="fast-moving-grid_c0"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="1" class="empty"><span class="empty">No results found.</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <tr>
                                                            <td style="border-top:none;"></td>
                                                        </tr>
                                                        <div class="keys" style="display:none" title="/index.php?r=site/index"></div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <i class="fa fa-thumbs-o-down"></i>
                                                <h3 class="box-title">Slow Moving Item</h3>

                                            </div>
                                            <div class="box-body">
                                                <ul class="products-list product-list-in-box">
                                                    <div class="table-responsive" id="slow-moving-grid">
                                                        <table class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="display:none" id="slow-moving-grid_c0"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="odd">
                                                                    <td>
                                                                        <li class="item">
                                                                            <div class="product-img">
                                                                                <img src="<?= base_url(); ?>assets/admin/dist/img/default-50x50.gif" alt="Product Image">
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <a href="javascript::;" class="product-title">
                                    017817809818
                                    <span class = "label label-warning">
                                        1 pcs
                                    </span>
                                    </a>
                                                                                <span class = "product-description">
                                    BOSE NOISE CANCELLING HEADPHONE 700 WHITE SOAPSTONE
                                    </span>
                                                                            </div>
                                                                        </li>
                                                                        &nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <tr>
                                                            <td style="border-top:none;"></td>
                                                        </tr>
                                                        <div class="keys" style="display:none" title="/index.php?r=site/index"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control" id="years" name="listyear">
                                            <option value="2019">2019</option>
                                            <option value="2020" selected="selected">2020</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select class="form-control" id="months" name="listmonth">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        All Data
                                        <input type="checkbox" id="allData" class="messageCheckbox">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a class="btn btn-block bg-gradient-primary" href="<?php echo base_url("admin/inventory/C_inventory_monitoring/download_all_status "); ?>">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <form id="inbound-form" action="<?= base_url('admin/inventory/C_inventory_monitoring/download_minimum_stock');?>" method="post">
                                <div class="tab-pane active" id="item_tab_8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="form-group col-md-3">
                                                    <td>
                                                        <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                        <button type="button"  id="reload2" onclick="minimumStock()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/inventory/C_inventory_monitoring" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                            <i class="fas fa-sync-alt"></i> Reload
                                                        </button>
                                                    </td>
                                                </div>  
                                                <div class="box-body">
                                                    <div class="table-responsive" id="minimum_stock-grid">
                                                        <table id="minimumstocktable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                            <thead>
                                                                <tr>
                                                                    <th id="minimum_stock-grid_c0">ITEM CODE</th>
                                                                    <th id="minimum_stock-grid_c1">ITEM NAME</th>
                                                                    <th id="minimum_stock-grid_c2">ITEM PRICE</th>
                                                                    <th id="minimum_stock-grid_c3">LEVEL</th>
                                                                    <th id="minimum_stock-grid_c4">QTY</th>
                                                                    <th id="minimum_stock-grid_c5">MIN</th>
                                                                    <th id="minimum_stock-grid_c6">AVERAGE</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="minimumstock">
                                                                    <?php
                                                                    foreach ($minimumstock as $row) 
                                                                    {
                                                                ?>
                                                                <tr class="odd">
                                                                    <td>
                                                                        <?php echo $row->item_code; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_name; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_price; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            if($row->stat == 'alert')
                                                                            {
                                                                                echo '<span class="badge bg-danger">';
                                                                            }
                                                                            else if($row->stat == 'safe')
                                                                            {
                                                                                echo '<span class="badge bg-success">';
                                                                            }
                                                                            else if($row->stat == 'warning')
                                                                            {
                                                                                echo '<span class="badge bg-warning">';
                                                                            }
                                                                        ?>
                                                                        <?php echo $row->stat; ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row->exist_quantity; ?></td>
                                                                    <td><?php echo $row->minimum_stock; ?></td>
                                                                    <td><?php echo $row->average; ?></td>
                                                                </tr>
                                                                <?php 
                                                                    } 
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    
    function deadStock() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/inventory/C_inventory_monitoring/getDeadStock';
        
        axios.post(uri)
        .then(response => {
            var deadstockdata = [];
            var result = response.data;
            $(".deadstock").find('tr').remove();
            var deadstock = $(".deadstock");
            $.each(result.deadstock, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.market_place);
                out.push(item.item_sku);
                out.push(item.item_name);
                out.push(item.quantity);
                out.push(item.inbound_date);
                deadstockdata.push(out);
            });

            $("#deadstocktable").dataTable().fnDestroy();
            $("#deadstocktable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: deadstockdata
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }

    function minimumStock() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload2').val();
        var uri = '<?php echo base_url(); ?>admin/inventory/C_inventory_monitoring/getMinimumStock';
        
        axios.post(uri)
        .then(response => {
            var minimumstockdata = [];
            var result = response.data;
            $(".minimumstock").find('tr').remove();
            var minimumstock = $(".minimumstock");
            $.each(result.minimumstock, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.item_code);
                out.push(item.item_name);
                out.push(item.item_price);
                out.push(item.stat);
                out.push(item.exist_quantity);
                out.push(item.minimum_stock);
                out.push(item.average);
                minimumstockdata.push(out);
            });

            $("#minimumstocktable").dataTable().fnDestroy();
            $("#minimumstocktable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: minimumstockdata
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
        $("#minimumstocktable").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $("#deadstocktable").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
    });
</script>
