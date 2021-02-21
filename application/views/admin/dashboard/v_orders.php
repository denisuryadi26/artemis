<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <!-- <h3 class="card-title p-3">ORDERS</h3> -->
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_15" data-toggle="tab">ORDER INFORMATION</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_16" data-toggle="tab">ORDER WITH ITEM INFORMATION</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_15">
                                <form id="yw0" action="<?php echo site_url('admin/C_orders/index'); ?>" method="get">
                                    <div style="display:none">
                                        <input type="hidden" value="order/index" name="r" />
                                    </div>
                                    <div class="box box-solid box-info">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="order_search_by1" class="form-control" name="order_search_by1">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="order_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <!-- <option value="courier">Courier Name</option> -->
                                                        <!-- <option value="delivery_type">Delivery Type</option> -->
                                                        <!-- <option value="cob_number">Courier Booking Number</option> -->
                                                        <option value="waybill_number">WayBill Number</option>
                                                        <option value="recipient_name">Recepient Name</option>
                                                        <option value="Entry">Status : Entry</option>
                                                        <option value="Backorder">Status : Backorder</option>
                                                        <option value="Pending">Status : Pending</option>
                                                        <option value="Ready To Picked">Status : Ready To Picked</option>
                                                        <option value="Print Picklist">Status : Print Picklist</option>
                                                        <option value="Assign To Picker">Status : Assign To Picker</option>
                                                        <option value="Picked">Status : Picked</option>
                                                        <option value="Ready To Packed">Status : Ready To Packed</option>
                                                        <option value="Packed">Status : Packed</option>
                                                        <option value="Ready To Shipped">Status : Ready To Shipped</option>
                                                        <option value="Shipped">Status : Shipped</option>
                                                        <option value="Delivered">Status : Delivered</option>
                                                        <option value="Returned">Status : Returned</option>
                                                        <option value="Canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="order_search_value1" id="order_search_value1" type="text" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="order_search_by2" class="form-control" name="order_search_by2">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="order_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <!-- <option value="courier">Courier Name</option> -->
                                                        <!-- <option value="delivery_type">Delivery Type</option> -->
                                                        <!-- <option value="cob_number">Courier Booking Number</option> -->
                                                        <option value="waybill_number">WayBill Number</option>
                                                        <option value="recipient_name">Recepient Name</option>
                                                        <option value="Entry">Status : Entry</option>
                                                        <option value="Backorder">Status : Backorder</option>
                                                        <option value="Pending">Status : Pending</option>
                                                        <option value="Ready To Picked">Status : Ready To Picked</option>
                                                        <option value="Print Picklist">Status : Print Picklist</option>
                                                        <option value="Assign To Picker">Status : Assign To Picker</option>
                                                        <option value="Picked">Status : Picked</option>
                                                        <option value="Ready To Packed">Status : Ready To Packed</option>
                                                        <option value="Packed">Status : Packed</option>
                                                        <option value="Ready To Shipped">Status : Ready To Shipped</option>
                                                        <option value="Shipped">Status : Shipped</option>
                                                        <option value="Delivered">Status : Delivered</option>
                                                        <option value="Returned">Status : Returned</option>
                                                        <option value="Canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="order_search_value2" id="order_search_value2" type="text" />
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                                    <button type="submit" class="btn btn-block bg-gradient-info">SEARCH</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="card card-info">
                                    <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-list"></i> ORDER INFORMATION</h3>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive" id="order-header-grid">
                                        <table id="order" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th id="order-header-grid_c1"><a class="sort-link" href="/index.php?r=order/index&amp;OrderHeader_sort=code">ORDER CODE</a>
                                                    </th>
                                                    <th id="order-header-grid_c2">DATE</th>
                                                    <th id="order-header-grid_c3">TIME</th>
                                                    <th id="order-header-grid_c4">WAYBILL NUMBER</th>
                                                    <th id="order-header-grid_c5">RECIPIENT NAME</th>
                                                    <th id="order-header-grid_c6">CHANNEL TYPE</th>
                                                    <th id="order-header-grid_c7">CREATED BY</th>
                                                    <th id="order-header-grid_c8">STATUS</th>
                                                    <th style="text-align: center;" id="order-header-grid_c9">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($orders as $row)
                                                    {
                                                ?>
                                                <tr class="odd">
                                                    <td><?php echo $row->order_code; ?></td>
                                                    <td><?php echo $row->date; ?></td>
                                                    <td><?php echo $row->time; ?></td>
                                                    <td><?php echo $row->waybill_number; ?></td>
                                                    <td><?php echo $row->recipient_name; ?></td>
                                                    <td><?php echo $row->channel_type; ?></td>
                                                    <td><?php echo $row->order_created_by; ?></td>
                                                    <td>
                                                        <?php
                                                            if($row->color == 'label-red')
                                                            {
                                                                echo '<span class="badge bg-danger">';
                                                            }
                                                            else if($row->color == 'label-lightgreen' || $row->color == 'label-green')
                                                            {
                                                                echo '<span class="badge bg-success">';
                                                            }
                                                            else if($row->color == 'label-blue')
                                                            {
                                                                echo '<span class="badge bg-primary">';
                                                            }
                                                            else if($row->color == 'label-orange')
                                                            {
                                                                echo '<span class="badge bg-warning">';
                                                            }
                                                            else if($row->color == 'label-purple')
                                                            {
                                                                echo '<span class="badge bg-secondery">';
                                                            }
                                                            else if($row->color == 'label-turquoise')
                                                            {
                                                                echo '<span class="badge bg-info">';
                                                            }
                                                        ?>
                                                            <?php echo $row->status; ?>
                                                        </span>
                                                    </td>
                                                    <td width="75px" align="center"><a class="view" title="View" href="/index.php?r=order/view&amp;id=12404853">
                                                    <img src="<?= base_url(); ?>assets/admin/dist/img/CButtonColumn/search.png" alt="View" /></a>
                                                        <a target="_new" title="invoice" href="/index.php?r=order/invoice&amp;id=12404853">
                                                    <img src="<?= base_url(); ?>assets/admin/dist/img/CButtonColumn/invoice.png" alt="invoice" /></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_16">
                                <form id="yw2" action="<?php echo site_url('admin/C_orders/index'); ?>" method="get">
                                    <div style="display:none">
                                        <input type="hidden" value="order/index" name="r" />
                                    </div>
                                    <div class="box box-solid box-info">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="orderitem_search_by1">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="order_created_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <!-- <option value="courier">Courier Name</option> -->
                                                        <!-- <option value="awb_number">WayBill Number</option> -->
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <!-- <option value="Barcode">Item Barcode</option> -->
                                                        <option value="Entry">Status : Entry</option>
                                                        <option value="Backorder">Status : Backorder</option>
                                                        <option value="Pending">Status : Pending</option>
                                                        <option value="Ready To Picked">Status : Ready To Picked</option>
                                                        <option value="Print Picklist">Status : Print Picklist</option>
                                                        <option value="Assign To Picker">Status : Assign To Picker</option>
                                                        <option value="Picked">Status : Picked</option>
                                                        <option value="Ready To Packed">Status : Ready To Packed</option>
                                                        <option value="Packed">Status : Packed</option>
                                                        <option value="Ready To Shipped">Status : Ready To Shipped</option>
                                                        <option value="Shipped">Status : Shipped</option>
                                                        <option value="Delivered">Status : Delivered</option>
                                                        <option value="Returned">Status : Returned</option>
                                                        <option value="Canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="orderitem_search_value1" id="orderitem_search_value1" type="text" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="orderitem_search_by2">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="order_created_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <!-- <option value="courier">Courier Name</option> -->
                                                        <!-- <option value="awb_number">WayBill Number</option> -->
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <!-- <option value="barcode">Item Barcode</option> -->
                                                        <option value="Entry">Status : Entry</option>
                                                        <option value="Backorder">Status : Backorder</option>
                                                        <option value="Pending">Status : Pending</option>
                                                        <option value="Ready To Picked">Status : Ready To Picked</option>
                                                        <option value="Print Picklist">Status : Print Picklist</option>
                                                        <option value="Assign To Picker">Status : Assign To Picker</option>
                                                        <option value="Picked">Status : Picked</option>
                                                        <option value="Ready To Packed">Status : Ready To Packed</option>
                                                        <option value="Packed">Status : Packed</option>
                                                        <option value="Ready To Shipped">Status : Ready To Shipped</option>
                                                        <option value="Shipped">Status : Shipped</option>
                                                        <option value="Delivered">Status : Delivered</option>
                                                        <option value="Returned">Status : Returned</option>
                                                        <option value="Canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="orderitem_search_value2" id="orderitem_search_value2" type="text" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                                    <button type="submit" class="btn btn-block bg-gradient-info">SEARCH</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="card card-info">
                                    <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-list"></i> ORDER WITH ITEM INFORMATION</h3>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive" id="order-detail-grid">
                                        <table id="orderitem" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th id="order-detail-grid_c0">ORDER CODE</th>
                                                    <th id="order-detail-grid_c1">ITEM CODE</th>
                                                    <th id="order-detail-grid_c2">ITEM NAME</th>
                                                    <th id="order-detail-grid_c3">QTY</th>
                                                    <th id="order-detail-grid_c4">PICKED</th>
                                                    <th id="order-detail-grid_c5">STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($orderswithitem as $row) {
                                                ?>
                                                <tr class="odd">
                                                    <td width="350px"><?php echo $row->order_code; ?></td>
                                                    <td><?php echo $row->item_code; ?></td>
                                                    <td width="350px"><?php echo $row->item_name; ?></td>
                                                    <td><?php echo $row->qty; ?></td>
                                                    <td><?php echo $row->picked; ?></td>
                                                    <td>
                                                        <?php
                                                            if($row->color == 'label-red')
                                                            {
                                                                echo '<span class="badge bg-danger">';
                                                            }
                                                            else if($row->color == 'label-lightgreen' || $row->color == 'label-green')
                                                            {
                                                                echo '<span class="badge bg-success">';
                                                            }
                                                            else if($row->color == 'label-blue')
                                                            {
                                                                echo '<span class="badge bg-primary">';
                                                            }
                                                            else if($row->color == 'label-orange')
                                                            {
                                                                echo '<span class="badge bg-warning">';
                                                            }
                                                            else if($row->color == 'label-purple')
                                                            {
                                                                echo '<span class="badge bg-secondery">';
                                                            }
                                                            else if($row->color == 'label-turquoise')
                                                            {
                                                                echo '<span class="badge bg-info">';
                                                            }
                                                        ?>
                                                            <?php echo $row->status; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <d/iv>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $("#order").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        });
        $('#orderitem').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        });
    });
</script>