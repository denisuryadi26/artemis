<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">EXPIRED STOCK INFORMATION</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <form id="inbound-form" action="<?= base_url('admin/C_home/download_expired_stock');?>" method="post">
                                <!-- HALAMAN EXPIRED STOCK -->
                                <div class="tab-pane" id="item_tab_5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                            <div class="form-group col-md-3">
                                                    <td>
                                                        <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                        <button type="button"  id="reload" onclick="expiredStock()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/inventory/C_inventory_expireddate" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                            <i class="fas fa-sync-alt"></i> Reload
                                                        </button>
                                                    </td>
                                                </div>  
                                                <div class="box-body">
                                                    <div class="table-responsive" id="dead-stock-grid">
                                                        <table id="expiredstocktable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                            <thead>
                                                                <tr>
                                                                    <th id="dead-stock-grid_c0">MARKET PLACE</th>
                                                                    <th id="dead-stock-grid_c1">ITEM CODE</th>
                                                                    <th id="dead-stock-grid_c2">ITEM NAME</th>
                                                                    <th id="dead-stock-grid_c3">GRID</th>
                                                                    <th id="dead-stock-grid_c4">EXPIRED DATE</th>
                                                                    <th id="dead-stock-grid_c5">READY ORDER</th>
                                                                    <th id="dead-stock-grid_c6">ONHAND</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="expiredstock">
                                                                <?php foreach ($expiredstock as $row) { ?>
                                                                <tr class="odd">
                                                                    <td>
                                                                        <?php echo $row->market_place; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_sku; ?></td>
                                                                    <td>
                                                                        <?php echo $row->item_name; ?></td>
                                                                    <td>
                                                                        <?php echo $row->grid; ?></td>
                                                                    <td><?php echo $row->item_information; ?></td>
                                                                    <td>
                                                                        <?php echo $row->ready_order; ?>pcs</td>
                                                                    <td>
                                                                        <?php echo $row->onhand; ?>pcs</td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        <tr>
                                                            <td style="border-top:none;"></td>
                                                        </tr>
                                                        <div class="keys" style="display:none" title="/index.php?r=site/index"></div>
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
            </div>
        </div>
    </section>
</div>
<script>
function expiredStock() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/inventory/C_inventory_expireddate/getExpiredStock';
        
        axios.post(uri)
        .then(response => {
            var expiredstockdata = [];
            var result = response.data;
            $(".expiredstock").find('tr').remove();
            var expiredstock = $(".expiredstock");
            $.each(result.expiredstock, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.market_place);
                out.push(item.item_sku);
                out.push(item.item_name);
                out.push(item.item_information);
                out.push(item.grid);
                out.push(item.ready_order);
                out.push(item.onhand);
                expiredstockdata.push(out);
            });

            $("#expiredstocktable").dataTable().fnDestroy();
            $("#expiredstocktable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: expiredstockdata
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
        $("#expiredstocktable").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
        $("#outboundaging").DataTable({
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
