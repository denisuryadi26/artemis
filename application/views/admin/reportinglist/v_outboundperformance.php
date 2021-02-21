<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content">
                            <form id="outbound-form" action="<?php echo base_url("admin/reportinglist/C_outboundperformance/export"); ?>" method="post">
                                <div class="box box-solid box-info">
                                    <div class="card card-info">
                                        <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> OUTBOUND PERFORMANCE INFORMATION</h3>
                                        </div>
                                    </div>
                                    <?php if($this->session->flashdata('notice')): ?>
                                    <?php echo $this->session->flashdata('notice'); ?>
                                    <?php endif; ?>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_last_status">LAST STATUS</label>
                                                <input class="form-control" id="last_status" size="60" maxlength="200" placeholder="LAST STATUS" name="last_status" type="text" />
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
                            <script type="text/javascript">
                                jQuery_1_12_4("#last_status").autocomplete({
                                    source: 'https://dashboard.wms.haistar.co.id/index.php?r=Custom/StatusName',
                                    select: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                        else {
                                            $("#status_id").val(ui.item.status_id);
                                        }
                                    },
                                    focus: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                    }
                                });
                            </script>
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