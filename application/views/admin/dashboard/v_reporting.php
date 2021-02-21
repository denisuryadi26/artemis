<div class="content-wrapper pt-2">
    <section class="content">
        <div class="card">
            <!-- <section class="content-header">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active">reporting</li>
                </ol>
                <h1>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">MORE ACTIONS</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="#"><i class="fa fa-ban"></i>NO ACTION</a>
                            </div>
                        </button>
                    </div>
                </h1>
            </section> -->
            <section class="content-header">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">INBOUND</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-footer p-0">
                                <ul class="nav flex-column" style="font-size:13px">
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_purchase" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            PURCHASE
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_arrival" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            ARRIVAL
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_received" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            RECEIVED
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_putaway" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            PUTAWAY
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_serialnumber" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            SERIAL NUMBER
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_inboundperformance" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            INBOUND PERFORMANCE
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_inboundhistory" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            INBOUND HISTORY
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_redzone" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            REDZONE
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-3">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">INVENTORY</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-footer p-0">
                                <ul class="nav flex-column" style="font-size:13px">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockitem" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK BASED ON ITEM
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockgrid" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK BASED ON GRID
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockaging" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK AGING
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockcard" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK CARD
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockdaily" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK DAILY
                                        </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockmovement" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK MOVEMENT
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stockadjustment" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STOCK ADJUSTMENT
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_emptyinventory" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            EMPTY INVENTORY
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_transferbin" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            TRANSFER BIN
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_stagingcancel" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                            STAGING CANCEL
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">OUTBOUND</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-footer p-0">
                                <ul class="nav flex-column" style="font-size:13px">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_order" class="nav-link text-info">
                                        <i class="fas fa-tag"></i>
                                    ORDER
                                </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_moving" class="nav-link text-info">
                                        <i class="fas fa-tag"></i>
                                    MOVING
                                </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_picklist" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    PICKLIST
                                </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_outbound" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    OUTBOUND
                                </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_outbounddetail" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    OUTBOUND DETAIL
                                </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_outbounddetailbundling" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    OUTBOUND DETAIL BUNDLING
                                </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_outboundperformance" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    OUTBOUND PERFORMANCE
                                </a>
                                    </li>
                                    <li class="nav-item text-info">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_movingperformance" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    MOVING PERFORMANCE
                                </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-3">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">SHIPMENT</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-footer p-0">
                                <ul class="nav flex-column" style="font-size:13px">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_shipment" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    SHIPMENT
                                </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>admin/reportinglist/C_shipmentperformance" class="nav-link text-info">
                                            <i class="fas fa-tag"></i>
                                    SHIPMENT PERFORMANCE
                                </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </section>
        </div>
    </section>
</div>