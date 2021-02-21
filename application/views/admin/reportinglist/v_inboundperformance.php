<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_inboundperformance/export"); ?>" method="post">
                                <div class="box box-solid box-info">
                                    <div class="card card-info">
                                        <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> INBOUND PERFORMANCE</h3>
                                        </div>
                                    </div>
                                        <?php if($this->session->flashdata('notice')): ?>
                                        <?php echo $this->session->flashdata('notice'); ?>
                                        <?php endif; ?>
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
                                        <div class="row" id="date">
                                            <div class="form-group col-md-6">
                                                <label>START PUTAWAY DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="putaway_date1" placeholder="START PUTAWAY DATE" readonly="readonly" name="putaway_date1" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END PUTAWAY DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="putaway_date2" placeholder="END PUTAWAY DATE" readonly="readonly" name="putaway_date2" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="date">
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
                                            <div class="icheck-info d-inline form-group col-md-6">
                                                <input type="checkbox" id="Reporting_all_client" value="1" name="all_client">
                                                <label for="Reporting_all_client">
                                                ALL CLIENT
                                                </label>
                                            </div>
                                            <div class="icheck-info d-inline form-group col-md-6">
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
    $("#putaway_date1").datepicker({'dateFormat':'yy-mm-dd'});
    $("#putaway_date2").datepicker({'dateFormat':'yy-mm-dd'});
    $("#start_date").datepicker({'dateFormat':'yy-mm-dd'});
    $("#end_date").datepicker({'dateFormat':'yy-mm-dd'});
</script>