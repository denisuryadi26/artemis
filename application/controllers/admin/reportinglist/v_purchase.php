<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content-header">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="<?= base_url('admin/C_reporting'); ?>">reporting</a>
                                </li>
                                <li class="breadcrumb-item active">purchase</li>
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
                    </div>
                    <div class="card-body">
                        <section class="content">


                            <form id="inbound-form" action="<?= base_url('admin/reportinglist/C_purchase/export');?>" method="post">
                                <div class="box box-solid box-primary">
                                    <div class="box-header with-border">
                                        <i class="fa fa-file-o"></i>
                                        <h3 class="box-title">PURCHASE INFORMATION</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_purchase_code">PURCHASE CODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="PURCHASE CODE" name="purchase_code" id="Reporting_purchase_code" type="text" /> </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_code">ITEM CODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM CODE" name="item_code" id="Reporting_item_code" type="text" /> </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_name">ITEM NAME</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM NAME" name="item_name" id="Reporting_item_name" type="text" /> </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_item_barcode">ITEM BARCODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ITEM BARCODE" name="item_barcode" id="Reporting_item_barcode" type="text" /> </div>
                                        </div>
                                        <div class="row" id="date">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_start_date">START DATE</label>
                                                
                                                <input class="form-control" size="30" id="start_date" placeholder="PURCHASE START DATE" readonly="readonly" name="start_date" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_end_date">END DATE</label>
                                                
                                                <input class="form-control" size="30" id="end_date" placeholder="PURCHASE END DATE" readonly="readonly" name="end_date" type="text" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input id="ytReporting_all_client" type="hidden" value="0" name="all_client" />
                                                <input name="all_client" id="Reporting_all_client" value="1" type="checkbox" /> ALL CLIENT
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="ytReporting_all_location" type="hidden" value="0" name="all_location" />
                                                <input name="all_location" id="Reporting_all_location" value="1" type="checkbox" /> ALL LOCATION
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-primary">DOWNLOAD</button>
                                                <!-- <a class="btn btn-block bg-gradient-primary" style="width: 40%;" href="<?php //echo base_url("admin/reportinglist/C_purchase/download_purchase_report "); ?>">DOWNLOAD</a> -->
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
    $("#start_date").datepicker({'dateFormat':'yy-mm-dd'});
    $("#end_date").datepicker({'dateFormat':'yy-mm-dd'});
</script>
