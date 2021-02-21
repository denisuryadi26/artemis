<div class="tab-pane active" id="tab_15">
                                <form id="yw0" action="<?php echo base_url("admin/C_orders/skeyword"); ?>" method="post">
                                    <div style="display:none">
                                        <input type="hidden" value="order/index" name="r" />
                                    </div>
                                    <div class="box box-solid box-primary">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="OrderHeader[search_by1]">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="created_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <option value="courier">Courier Name</option>
                                                        <option value="delivery_type">Delivery Type</option>
                                                        <option value="cob_number">Courier Booking Number</option>
                                                        <option value="awb_number">WayBill Number</option>
                                                        <option value="recepient_name">Recepient Name</option>
                                                        <option value="entry">Status : Entry</option>
                                                        <option value="backorder">Status : Backorder</option>
                                                        <option value="pending">Status : Pending</option>
                                                        <option value="complete">Status : Ready To Picked</option>
                                                        <option value="printed">Status : Print Picklist</option>
                                                        <option value="assign">Status : Assign To Picker</option>
                                                        <option value="picked">Status : Picked</option>
                                                        <option value="checked">Status : Ready To Packed</option>
                                                        <option value="packed">Status : Packed</option>
                                                        <option value="standby">Status : Ready To Shipped</option>
                                                        <option value="delivery">Status : Shipped</option>
                                                        <option value="received">Status : Delivered</option>
                                                        <option value="returned">Status : Returned</option>
                                                        <option value="canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="OrderHeader[search_value1]" id="OrderHeader_search_value1" type="text" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="OrderHeader[search_by2]">
                                                        <option value="">Search By</option>
                                                        <option value="order_code">Order Code</option>
                                                        <option value="created_date">Created Date [format : yyyy-mm-dd]</option>
                                                        <option value="courier">Courier Name</option>
                                                        <option value="delivery_type">Delivery Type</option>
                                                        <option value="cob_number">Courier Booking Number</option>
                                                        <option value="awb_number">WayBill Number</option>
                                                        <option value="recepient_name">Recepient Name</option>
                                                        <option value="entry">Status : Entry</option>
                                                        <option value="backorder">Status : Backorder</option>
                                                        <option value="pending">Status : Pending</option>
                                                        <option value="complete">Status : Ready To Picked</option>
                                                        <option value="printed">Status : Print Picklist</option>
                                                        <option value="assign">Status : Assign To Picker</option>
                                                        <option value="picked">Status : Picked</option>
                                                        <option value="checked">Status : Ready To Packed</option>
                                                        <option value="packed">Status : Packed</option>
                                                        <option value="standby">Status : Ready To Shipped</option>
                                                        <option value="delivery">Status : Shipped</option>
                                                        <option value="received">Status : Delivered</option>
                                                        <option value="returned">Status : Returned</option>
                                                        <option value="canceled">Status : Canceled</option>
                                                    </select>
                                                </div>
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="OrderHeader[search_value2]" id="OrderHeader_search_value2" type="text" />
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="card-header"> -->
                                    <h3 class="card-title p-3">ORDER INFORMATION</h3>
                                <!-- </div> -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
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
                                                <td width="100px"><?php echo $row->order_code; ?></td>
                                                <td width="200px"><?php echo $row->date; ?></td>
                                                <td width="75px"><?php echo $row->time; ?></td>
                                                <td width="200px"><?php echo $row->waybill_number; ?></td>
                                                <td width="250px"><?php echo $row->recipient_name; ?></td>
                                                <td width="200px"><?php echo $row->channel_type; ?></td>
                                                <td width="150px"><?php echo $row->order_created_by; ?></td>
                                                <td width="75px">
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
                                    <div class="row pt-3">
                                        <div class="col-sm-6">
                                            Result : <?= $total_rows; ?> Item
                                        </div>
                                        <div class="col-sm-6" align="right">
                                            <?= $pagination; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>