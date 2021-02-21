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
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-summary-tab" data-toggle="pill" href="#custom-content-below-summary" role="tab" aria-controls="custom-content-below-summary" aria-selected="false">SUMMARY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-inventoryefficiency-tab" data-toggle="pill" href="#custom-content-below-inventoryefficiency" role="tab" aria-controls="custom-content-below-inventoryefficiency" aria-selected="false">INVENTORY EFFICIENCY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-dailyreport-tab" data-toggle="pill" href="#custom-content-below-dailyreport" role="tab" aria-controls="custom-content-below-dailyreport" aria-selected="false">DAILY MONITORING</a>
                            </li>
                        </ul>
                            <!-- ===========================Isi SUmmary Tab======================== -->
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-summary" role="tabpanel" aria-labelledby="custom-content-below-summary-tab">
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control" size="30" id="date_from" placeholder="Date From" readonly="readonly" name="date_from" type="text" onchange="homeSummary()"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control" size="30" id="date_to" placeholder="Date To" readonly="readonly" name="date_to" type="text" onchange="homeSummary()"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" id="view_based_in" onchange="homeSummary()">
                                                    <option value="location">View base on location</option>
                                                    <option value="all_location">View all location</option>
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
                                                <select class="form-control" id="view_based_at" onchange="homeSummary()">
                                                    <option value="client">View base on client</option>
                                                    <option value="all_client">View all client</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ===========================Info Box======================== -->
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-red">
                                                <span class="info-box-icon"><i class="far fa-file"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">ENTRY</span>
                                                    <span class="info-box-number" id="pl_entry"></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" id="pl_entry_bar"></div>
                                                    </div>
                                                    <span class="progress-description" id="pl_entry_progress">&nbsp;</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-yellow">
                                                <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">RECIEVED</span>
                                                    <span class="info-box-number" id="pl_inbound"></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" id="pl_inbound_bar"></div>
                                                    </div>
                                                    <span class="progress-description" id="pl_inbound_progress">&nbsp;</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-lightblue">
                                                <span class="info-box-icon"><i class="fa fa-database"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">PUTAWAY</span>
                                                    <span class="info-box-number" id="pl_inventory"></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" id="pl_inventory_bar"></div>
                                                    </div>
                                                    <span class="progress-description" id="pl_inventory_progress">&nbsp;</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-green">
                                                <span class="info-box-icon"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">FINISH</span>
                                                    <span class="info-box-number" id="pl_finish"></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" id="pl_finish_bar"></div>
                                                    </div>
                                                    <span class="progress-description" id="pl_finish_progress">&nbsp;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- =======================Info Box=========================== -->
                                    <!-- =======================Small Box=========================== -->
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                    <h3 id="ord_pending">0</h3>
                                                    <p>Pending</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                    <h3 id="ord_backorder">0</h3>
                                                    <p>Backorder</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-unlock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                    <h3 id="ord_complete">0</h3>
                                                    <p>Ready To Picked</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-yellow">
                                                <div class="inner">
                                                    <h3 id="ord_printed">0</h3>
                                                    <p>Print Picklist</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-print"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-yellow">
                                                <div class="inner">
                                                    <h3 id="ord_assign">0</h3>
                                                    <p>Assign to Picker</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-retweet"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-yellow">
                                                <div class="inner">
                                                    <h3 id="ord_picked">0</h3>
                                                    <p>Picked</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3 id="ord_checked">0</h3>
                                                    <p>Ready To Packed</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-tags"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3 id="ord_packed">0</h3>
                                                    <p>Packed</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fab fa-dropbox"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3 id="ord_standby">0</h3>
                                                    <p>Ready To Shipped</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-gift"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-green">
                                                <div class="inner">
                                                    <h3 id="ord_shipped">0</h3>
                                                    <p>Shipped</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-truck"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-green">
                                                <div class="inner">
                                                    <h3 id="ord_delivered">0</h3>
                                                    <p>Delivered</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-home"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-brown ">
                                                <div class="inner">
                                                    <h3 id="ord_returned">0</h3>
                                                    <p>Returned</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-undo"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-blue ">
                                                <div class="inner">
                                                    <h3 id="ord_total">0</h3>
                                                    <p>TOTAL</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-chart-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- /.row -->
                                <!-- =======================Small Box=========================== -->
                                <!-- =======================Table Summary ====================== -->
                                <!-- <div class="form-group col-md-3">
                                    <input type="text" name="date_from" class="form-control" readonly="readonly" size="30" id="date_from" value="Date From" />
                                </div> -->
                            </div>
                            <!-- =======================Table Summary ====================== -->
                            <div class="tab-pane fade" id="custom-content-below-dailyreport" role="tabpane1b" aria-labelledby="custom-content-below-dailyreport-tab">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <br>
                                        <label>Month :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <?php 
                                                echo $this->session->flashdata('message'); 
                                                date_default_timezone_set('Asia/Jakarta');
                                                $now   = date('F Y');
                                                $bulan = date('M');
                                                $bln   = date('m');
                                                $tahun = date('Y');
                                                // echo json_encode($bulan);die;
                                            ?>
                                            <select name="monitoringdate" id="monitoringdate" class="form-control" onchange="homeMonitoring()">
                                                <?php
                                                    if($bulan == "Jan"){
                                                        echo "<option value='Jan $tahun'>Jan $tahun</option>";
                                                    }else if($bulan == "Feb"){
                                                        echo "<option value='Feb $tahun'>Feb $tahun</option>";
                                                    }else if($bulan == "Mar"){
                                                        echo "<option value='Mar $tahun'>Mar $tahun</option>";
                                                    }else if($bulan == "April"){
                                                        echo "<option value='Apr $tahun'>Apr $tahun</option>";
                                                    }else if($bulan == "May"){
                                                        echo "<option value='May $tahun'>May $tahun</option>";
                                                    }else if($bulan == "Jun"){
                                                        echo "<option value='Jun $tahun'>Jun $tahun</option>";
                                                    }else if($bulan == "Jul"){
                                                        echo "<option value='Jul $tahun'>Jul $tahun</option>";
                                                    }else if($bulan == "Aug"){
                                                        echo "<option value='Aug $tahun'>Aug $tahun</option>";
                                                    }else if($bulan == "Sept"){
                                                        echo "<option value='Sept $tahun'>Sept$tahun</option>";
                                                    }else if($bulan == "Oct"){
                                                        echo "<option value='Oct $tahun'>Oct $tahun</option>";
                                                    }else if($bulan == "Nov"){
                                                        echo "<option value='Nov $tahun'>Nov $tahun</option>";
                                                    }else if($bulan == "Dec"){
                                                        echo "<option value='Dec $tahun'>Dec $tahun</option>";
                                                    }
                                                $bulan=array(
                                                                "Jan",
                                                                "Feb",
                                                                "Mar",
                                                                "Apr",
                                                                "May",
                                                                "Jun",
                                                                "Jul",
                                                                "Aug",
                                                                "Sept",
                                                                "Oct",
                                                                "Nov",
                                                                "Dec");
                                                    $jlh_bln=count($bulan);
                                                    for($c=0; $c<$jlh_bln; $c+=1)
                                                        {
                                                        echo "<option value='$bulan[$c] $tahun'>$bulan[$c] $tahun</option>";
                                                    }
                                                ?>
                                                <!-- <option name="comp_id" value='Dec <?php echo $tahun; ?>'>Dec <?php echo $tahun; ?></option>  -->
                                            </select>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <br>
                                        <label>WH :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user-tag"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" id="view_client_all" onchange="homeMonitoring()">
                                                <option value="clientmonitoring">View base on Client</option>
                                                <option value="all_clientmonitoring">View all Client</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                <h3 class="card-title"></i> WH DAILY CONTROL</h3>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                <tr>
                                                    <th>Pending Days</th>
                                                    <th>Date</th>
                                                    <th>Order Created</th>
                                                    <th>Order Printed</th>
                                                    <th>Order Packed</th>
                                                    <th>Packed Item Qty</th>
                                                    <th>Order RTS</th>
                                                    <th>Order Shipped</th>
                                                    <th>Pending System</th>
                                                    <th>Pending Outbound</th>
                                                    <th>Pending Item Qty</th>
                                                    <th>Cancel</th>
                                                    <th>Pending Dispatch</th>
                                                    <th>Pending Shipped</th>
                                                    <th>Dispatch Completed</th>
                                                    <th>Completed Percentage</th>
                                                </tr>
                                                </thead>
                                                <tbody class="nilaidailymonitoring">
                                                <?php foreach ($nilaidailymonitoring as $row) { ?>
                                                    <tr class="odd">
                                                        <td>
                                                            <?php echo $row->pending_days; ?></td>
                                                        <td>
                                                            <?php echo $row->date; ?></td>
                                                        <td>
                                                            <?php echo $row->order_created; ?></td>
                                                        <td><?php echo $row->order_printed; ?></td>
                                                        <td>
                                                            <?php echo $row->order_packed; ?></td>
                                                        <td>
                                                            <?php echo $row->packed_item_qty; ?></td>
                                                        <td>
                                                            <?php echo $row->order_rts; ?></td>
                                                        <td>
                                                            <?php echo $row->order_shipped; ?></td>
                                                        <td>
                                                            <?php echo $row->pending_system; ?></td>
                                                        <td>
                                                            <?php echo $row->pending_outbound; ?></td>
                                                        <td>
                                                            <?php echo $row->pending_item_qty; ?></td>
                                                        <td>
                                                            <?php echo $row->cancel; ?></td>
                                                        <td>
                                                            <?php echo $row->pending_dispatch; ?></td>
                                                        <td>
                                                            <?php echo $row->pending_shipped; ?></td>
                                                        <td>
                                                            <?php echo $row->dispatch_complete; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-inventoryefficiency" role="tabpane3" aria-labelledby="custom-content-below-inventoryefficiency-tab">
                                <div class="content pt-2">
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="form-group col-md-6">
                                            <td>
                                                <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                <button type="button"  id="reload1" onclick="gridEfficiency()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/C_home" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i> Reload
                                                </button>
                                            </td>
                                        </div>
                                            <table id="nilaiinventorygridefficiencytable" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                <thead>
                                                    <?php
                                                        if($this->session->userdata('location_name'))
                                                        {
                                                            $location_name = $this->session->userdata('location_name');
                                                            $program_name = $this->session->userdata('program_name');
                                                        }
                                                        else
                                                        {
                                                            $location_name = $this->session->userdata('loc_name');
                                                            $program_name = $this->session->userdata('prog_name');
                                                        }
                                                    ?>
                                                    <tr>
                                                        <th colspan = "3" rowspan = "3" id="packinglist-grid_c3" style="text-align:center"><?php echo $location_name; ?></th>
                                                    </tr>
                                                    
                                                </thead>
                                                    <?php
                                                        $date = date("Y-m-d");
                                                        $date = strtotime($date);
                                                        $firtsdate = strtotime("-14 day", $date);
                                                        $lastdate = strtotime("today", $date);
                                                        $hariawal = date("Y-m-01");
                                                        // $hariawal = date('m-d-Y', $firtsdate);
                                                        $hariakhir = date('Y-m-d', $lastdate);
                                                        $day = $hariawal.' - '. $hariakhir;
                                                    ?>
                                                    <tr>
                                                        <th colspan="3"id="packinglist-grid_c4" style="text-align:center">Day in <?php echo $day?></th>
                                                    </tr>
                                                    <tr>
                                                        <th id="packinglist-grid_c0" style="text-align:center">GRID NAME</th>
                                                        <th id="packinglist-grid_c1" style="text-align:center">GRAND TOTAL</th>
                                                        <th id="packinglist-grid_c2" style="text-align:center">AVG PER DAY</th>
                                                    </tr>
                                                <tbody class="nilaiinventorygridefficiency">
                                                    <?php foreach ($nilaiinventorygridefficiency as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row->grid_name; ?></td>
                                                        <td>
                                                            <?php echo $row->total_grid; ?></td>
                                                        <td>
                                                            <?php echo $row->avg_perday; ?></td>
                                                    </tr>
                                                    <?php 
                                                    } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group col-md-6">
                                                <td>
                                                    <!-- <button class="btn btn-block btn-outline-primary"><span class="glyphicon glyphicon-refresh"></span>Reload</button> -->
                                                    <button type="button"  id="reload2" onclick="itemEfficiency()" class="btn btn-block btn-outline-primary" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/C_home" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                        <i class="fas fa-sync-alt"></i> Reload
                                                    </button>
                                                </td>
                                            </div>
                                            <table id="nilaiinventoryskuefficiencytable" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                <thead>
                                                    <?php
                                                        if($this->session->userdata('location_name'))
                                                        {
                                                            $location_name = $this->session->userdata('location_name');
                                                            $program_name = $this->session->userdata('program_name');
                                                        }
                                                        else
                                                        {
                                                            $location_name = $this->session->userdata('loc_name');
                                                            $program_name = $this->session->userdata('prog_name');
                                                        }
                                                    ?>
                                                    <tr>
                                                        <th colspan = "3" rowspan = "3" id="packinglist-grid_c3" style="text-align:center"><?php echo $location_name; ?></th>
                                                    </tr>
                                                    
                                                </thead>
                                                    <?php
                                                        $date = date("Y-m-d");
                                                        $date = strtotime($date);
                                                        $firtsdate = strtotime("-14 day", $date);
                                                        $lastdate = strtotime("today", $date);
                                                        $hariawal = date("Y-m-01");
                                                        // $hariawal = date('m-d-Y', $firtsdate);
                                                        $hariakhir = date('Y-m-d', $lastdate);
                                                        $day = $hariawal.' - '. $hariakhir;
                                                    ?>
                                                    <tr>
                                                        <th colspan="3"id="packinglist-grid_c4" style="text-align:center">Day in <?php echo $day?></th>
                                                    </tr>
                                                    <tr>
                                                        <th id="packinglist-grid_c0" style="text-align:center">ITEM SKU</th>
                                                        <th id="packinglist-grid_c1" style="text-align:center">GRAND TOTAL</th>
                                                        <th id="packinglist-grid_c2" style="text-align:center">AVG PER DAY</th>
                                                    </tr>
                                                <tbody class="nilaiinventoryskuefficiency">
                                                    <tr>
                                                    <?php foreach ($nilaiinventoryskuefficiency as $row) { ?>
                                                        <td>
                                                            <?php echo $row->sku_name; ?></td>
                                                        <td>
                                                            <?php echo $row->total_sku; ?></td>
                                                        <td>
                                                            <?php echo $row->avg_perday; ?></td>
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
        <!-- =========================================================== -->

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

    if($this->session->userdata('location_name'))
    {
        $location_name = $this->session->userdata('location_name');
        $program_name = $this->session->userdata('program_name');
    }
    else
    {
        $location_name = $this->session->userdata('loc_name');
        $program_name = $this->session->userdata('prog_name');
    }

    
?>
<script>
    $("#date_from").datepicker({'dateFormat':'yy-mm-dd'});
    $("#date_to").datepicker({'dateFormat':'yy-mm-dd'});
</script>
<script type="text/javascript">
    $(document).ready(function() 
    {
        homeSummary();
    });
    function homeSummary() 
    {
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        var view_based_at = $('#view_based_at').val();
        var view_based_in = $('#view_based_in').val();
        var flag = true;
        
        if(date_from != "" && date_to != "")
        {
            if(Date.parse(date_to) < Date.parse(date_from))
                flag = false;
        }
        
        if(flag == true)
        {
            var uri = '<?php echo base_url(); ?>admin/C_home/homeSummary';
            jQuery.ajax(
            {
                type: 'POST',
                async: false,
                dataType: "json",
                cache: false,
                url: uri,
                data: {
                    date_from:date_from,
                    date_to:date_to,
                    view_based_at:view_based_at,
                    view_based_in:view_based_in
                },
                success: function(result) 
                {
                    if(result.pl_total != 0)
                    {
                        pl_inbound_bar = Math.round((result.pl_inbound * 100) / result.pl_total) +"%";
                        pl_inbound_progress = Math.round((result.pl_inbound * 100) / result.pl_total) +" % received";
                        
                        pl_inventory_bar = Math.round((result.pl_inventory * 100) / result.pl_inbound) +"%";
                        pl_inventory_progress = Math.round((result.pl_inventory * 100) / result.pl_total) +" % putaway";
                        
                        pl_finish_bar = Math.round((result.pl_finish * 100) / result.pl_inventory) +"%";
                        pl_finish_progress = Math.round((result.pl_finish * 100) / result.pl_total) +" % finish";
                    }
                    else
                    {
                        pl_inbound_progress = "0 % received";
                        pl_inbound_bar = "0%";
                        
                        pl_inventory_progress = "0 % putaway";
                        pl_inventory_bar = "0%";
                        
                        pl_finish_progress = "0 % finish";
                        pl_finish_bar = "0%";
                    }
                    
                    document.getElementById('pl_entry').innerHTML = result.pl_total;
                    
                    document.getElementById('pl_inbound').innerHTML = result.pl_inbound;
                    document.getElementById('pl_inbound_progress').innerHTML = pl_inbound_progress;
                    document.getElementById('pl_inbound_bar').style.width = pl_inbound_bar;
                    
                    document.getElementById('pl_inventory').innerHTML = result.pl_inventory;
                    document.getElementById('pl_inventory_progress').innerHTML = pl_inventory_progress;
                    document.getElementById("pl_inventory_bar").style.width = pl_inventory_bar;
                    
                    document.getElementById('pl_finish').innerHTML = result.pl_finish;
                    document.getElementById('pl_finish_progress').innerHTML = pl_finish_progress;
                    document.getElementById("pl_finish_bar").style.width = pl_finish_bar;
                    
                    document.getElementById("ord_pending").innerHTML = result.ord_pending;
                    document.getElementById("ord_complete").innerHTML = result.ord_complete;
                    document.getElementById("ord_printed").innerHTML = result.ord_printed;
                    document.getElementById("ord_assign").innerHTML = result.ord_assign;
                    
                    document.getElementById("ord_picked").innerHTML = result.ord_picked;
                    document.getElementById("ord_checked").innerHTML = result.ord_checked;
                    document.getElementById("ord_packed").innerHTML = result.ord_packed;
                    document.getElementById("ord_standby").innerHTML = result.ord_standby;
                    
                    document.getElementById("ord_shipped").innerHTML = result.ord_shipped;
                    document.getElementById("ord_delivered").innerHTML = result.ord_delivered;
                    document.getElementById("ord_returned").innerHTML = result.ord_returned;
                    document.getElementById("ord_total").innerHTML = result.ord_total;
                },
            });
        }
        else
            alert("Date From Greater Than Date To");
    }
</script>
<script type="text/javascript">

    function gridEfficiency() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/C_home/getGridEfficiency';
    
        axios.post(uri)
        .then(response => {
            var result = response.data;
            $(".nilaiinventorygridefficiency").find('tr').remove();
            var nilaiinventorygridefficiency = $(".nilaiinventorygridefficiency");
            $.each(result.nilaiinventorygridefficiency, function(key, item) 
            {
                var inti;
                inti = '<tr>';
                inti += '<td>' + item.grid_name + '</td>';
                inti += '<td>' + item.total_grid + '</td>';
                inti += '<td>' + item.avg_perday + '</td>';
                inti += '</tr>';
                nilaiinventorygridefficiency.append(inti);
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }

    function itemEfficiency() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload2').val();
        var uri = '<?php echo base_url(); ?>admin/C_home/getItemEfficiency';
    
        axios.post(uri)
        .then(response => {
            var result = response.data;
            $(".nilaiinventoryskuefficiency").find('tr').remove();
            var nilaiinventoryskuefficiency = $(".nilaiinventoryskuefficiency");
            $.each(result.nilaiinventoryskuefficiency, function(key, item) 
            {
                var inti;
                inti = '<tr class="odd">';
                inti += '<td>' + item.sku_name + '</td>';
                inti += '<td>' + item.total_sku + '</td>';
                inti += '<td>' + item.avg_perday + '</td>';
                inti += '</tr>';
                nilaiinventoryskuefficiency.append(inti);
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }
</script>
