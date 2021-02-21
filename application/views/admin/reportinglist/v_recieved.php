<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-body">
                        <section class="content-header">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="<?= base_url('admin/C_reporting'); ?>">reporting</a>
                                </li>
                                <li class="breadcrumb-item active">recieved</li>
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
                        </section>
                    </div> -->
                    <div class="card-body">
                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_received/export"); ?>" method="post">
                                <div class="box box-solid box-primary">

                                    <div class="card card-lightblue">
                                        <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> RECEIVED INFORMATION</h3>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_purchase_code">PURCHASE CODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="PURCHASE CODE" name="purchase_code" id="Reporting_purchase_code" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_code">ITEM CODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM CODE" name="item_code" id="Reporting_item_code" type="text" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_name">ITEM NAME</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM NAME" name="item_name" id="Reporting_item_name" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_barcode">ITEM BARCODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM BARCODE" name="item_barcode" id="Reporting_item_barcode" type="text" />
                                            </div>
                                        </div>
                                        <!--RECEIVED DATE-->
                                        <div class="row" id="date">
                                            <!-- <div class="form-group col-md-6">
                                                <label for="Reporting_received_date1">START RECEIVED DATE</label>
                                                
                                                <input class="form-control" size="30" id="received_date1" placeholder="START RECEIVED DATE" readonly="readonly" name="received_date1" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_received_date2">END RECEIVED DATE</label>
                                                
                                                <input class="form-control" size="30" id="received_date2" placeholder="END RECEIVED DATE" readonly="readonly" name="received_date2" type="text" />
                                            </div> -->
                                            <div class="form-group col-md-6">
                                                <label>START RECEIVED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="received_date1" placeholder="START RECEIVED DATE" readonly="readonly" name="received_date1" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END RECEIVED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="received_date2" placeholder="END RECEIVED DATE" readonly="readonly" name="received_date2" type="text" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="date">
                                            <!-- <div class="form-group col-md-6">
                                                <label for="Reporting_start_date">START DATE</label>
                                                
                                                <input class="form-control" size="30" id="start_date" placeholder="START DATE" readonly="readonly" name="start_date" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_end_date">END DATE</label>
                                                
                                                <input class="form-control" size="30" id="end_date" placeholder="END DATE" readonly="readonly" name="end_date" type="text" />
                                            </div> -->
                                            <div class="form-group col-md-6">
                                                <label>START DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="start_date" placeholder="START DATE" readonly="readonly" name="start_date" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="end_date" placeholder="END DATE" readonly="readonly" name="end_date" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="form-group col-md-6">
                                                <input id="ytReporting_all_client" type="hidden" value="0" name="all_client" />
                                                <input name="all_client" id="Reporting_all_client" value="1" type="checkbox" /> ALL CLIENT
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="ytReporting_all_location" type="hidden" value="0" name="all_location" />
                                                <input name="all_location" id="Reporting_all_location" value="1" type="checkbox" /> ALL LOCATION
                                            </div> -->
                                            <div class="icheck-primary d-inline form-group col-md-6">
                                                <input type="checkbox" id="Reporting_all_client" value="1" name="all_client">
                                                <label for="Reporting_all_client">
                                                ALL CLIENT
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline form-group col-md-6">
                                                <input type="checkbox" id="Reporting_all_location" value="1" name="all_location">
                                                <label for="Reporting_all_location">
                                                ALL LOCATION
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </section>
                    </div>
                 </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?= base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'assets/js/jquery-ui.min.js'?>"></script>
<script>
    $("#received_date1").datepicker({'dateFormat':'yy-mm-dd'});
    $("#received_date2").datepicker({'dateFormat':'yy-mm-dd'});
    $("#start_date").datepicker({'dateFormat':'yy-mm-dd'});
    $("#end_date").datepicker({'dateFormat':'yy-mm-dd'});
</script>