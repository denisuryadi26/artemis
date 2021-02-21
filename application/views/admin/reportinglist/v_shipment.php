<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_shipment/export"); ?>" method="post">
                                <div class="box box-solid box-info">
                                    <div class="card card-info">
                                        <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> SHIPMENT INFORMATION</h3>
                                        </div>
                                    </div>
                                    <?php if($this->session->flashdata('notice')): ?>
                                    <?php echo $this->session->flashdata('notice'); ?>
                                    <?php endif; ?>
                                    <div class="box-body">
                                        <div class="row" id="row-wb">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_order_code">ORDER CODE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="ORDER CODE" name="order_code" id="Reporting_order_code" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_waybill_number">WAYBILL NUMBER</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="WAYBILL NUMBER" name="waybill_number" id="Reporting_waybill_number" type="text" />
                                            </div>
                                        </div>
                                        <div class="row" id="row-deliver">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_courier_name">COURIER NAME</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="COURIER NAME" name="courier_name" id="Reporting_courier_name" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_delivery_type">DELIVERY TYPE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="DELIVERY TYPE" name="delivery_type" id="Reporting_delivery_type" type="text" />
                                            </div>
                                        </div>
                                        <div class="row" id="row-stat">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_payment_type">PAYMENT TYPE</label>
                                                <input class="form-control" size="60" maxlength="200" placeholder="PAYMENT TYPE" name="payment_type" id="Reporting_payment_type" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_last_status">LAST STATUS</label>
                                                <input class="form-control" id="last_status" size="60" maxlength="200" placeholder="LAST STATUS" name="last_status" type="text" />
                                                <input class="form-control" id="status_id" size="60" maxlength="200" name="status_id" type="hidden" />
                                            </div>
                                        </div>

                                        <div class="row" id="row-client">
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_client">Client</label>
                                                <input class="form-control" id="client" size="60" maxlength="200" placeholder="CLIENT" name="client" type="text" />
                                                <input class="form-control" id="client_id" size="60" maxlength="200" name="Reporting[client_id]" type="hidden" /> </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_shipment_code1">SHIPMENT CODE</label>
                                                <input class="form-control" id="shipment_code1" size="60" maxlength="200" placeholder="SHIPMENT CODE" name="shipment_code1" type="text" />
                                            </div>
                                        </div>
                                        <!-- SHIPED DATE -->
                                        <div class="row" id="date">
                                            <!-- <div class="form-group col-md-6">
                                                <label for="Reporting_shipped_date1">START SHIPPED DATE</label>
                                                
                                                <input class="form-control" size="30" id="shipped_date1" placeholder="START DATE" readonly="readonly" name="shipped_date1" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_shipped_date2">END SHIPPED DATE</label>
                                                
                                                <input class="form-control" size="30" id="shipped_date2" placeholder="END DATE" readonly="readonly" name="shipped_date2" type="text" />
                                            </div> -->
                                            <div class="form-group col-md-6">
                                                <label>START SHIPPED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="shipped_date1" placeholder="START DATE" readonly="readonly" name="shipped_date1" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END SHIPPED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="shipped_date2" placeholder="END DATE" readonly="readonly" name="shipped_date2" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PACKED DATE -->
                                        <div class="row" id="date">
                                            <!-- <div class="form-group col-md-6">
                                                <label for="Reporting_packed_date1">START PACKED DATE</label>
                                                
                                                <input class="form-control" size="30" id="packed_date1" placeholder="START DATE" readonly="readonly" name="packed_date1" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_packed_date2">END PACKED DATE</label>
                                                
                                                <input class="form-control" size="30" id="packed_date2" placeholder="END DATE" readonly="readonly" name="packed_date2" type="text" />
                                            </div> -->
                                            <div class="form-group col-md-6">
                                                <label>START PACKED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="packed_date1" placeholder="START DATE" readonly="readonly" name="packed_date1" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END PACKED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="packed_date2" placeholder="END DATE" readonly="readonly" name="packed_date2" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- DELIVERED DATE -->
                                        <div class="row" id="date">
                                            <!-- <div class="form-group col-md-6">
                                                <label for="Reporting_delivered_date1">START DELIVERED DATE</label>
                                                
                                                <input class="form-control" size="30" id="delivered_date1" placeholder="START DATE" readonly="readonly" name="delivered_date1" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Reporting_delivered_date2">END DELIVERED DATE</label>
                                                
                                                <input class="form-control" size="30" id="delivered_date2" placeholder="END DATE" readonly="readonly" name="delivered_date2" type="text" />
                                            </div> -->
                                            <div class="form-group col-md-6">
                                                <label>START DELIVERED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="delivered_date1" placeholder="START DATE" readonly="readonly" name="delivered_date1" type="text" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>END DELIVERED DATE</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input class="form-control" size="30" id="delivered_date2" placeholder="END DATE" readonly="readonly" name="delivered_date2" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ORDER DATE -->
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
                                                <input name="all_client" id="all_client" value="1" type="checkbox" /> ALL CLIENT
                                            </div>

                                            <div class="form-group col-md-6">
                                                <input id="ytReporting_all_location" type="hidden" value="0" name="all_location" />
                                                <input name="all_location" id="all_location" value="1" type="checkbox" /> ALL LOCATION
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

                                        <div class="col-md-14">
                                            <div class="card card-info collapsed-card">
                                                <div class="card-header">
                                                <h3 class="card-title">CUSTOM FIELD</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <input id="ytselect_all" type="hidden" value="0" name="select_all" />
                                                                <input name="select_all" id="select_all" value="1" type="checkbox" /> <b>SELECT ALL</b>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_order_date" type="hidden" value="0" name="order_date" />
                                                                <input class="checkitem" name="order_date" id="order_date" value="1" type="checkbox" /> ORDER DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_order_created_date" type="hidden" value="0" name="order_created_date" />
                                                                <input class="checkitem" name="order_created_date" id="order_created_date" value="1" type="checkbox" /> ORDER CREATED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_recipient_name" type="hidden" value="0" name="recipient_name" />
                                                                <input class="checkitem" name="recipient_name" id="recipient_name" value="1" type="checkbox" /> RECIPIENT NAME
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_recipient_phone" type="hidden" value="0" name="recipient_phone" />
                                                                <input class="checkitem" name="recipient_phone" id="recipient_phone" value="1" type="checkbox" /> RECIPIENT PHONE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_recipient_address" type="hidden" value="0" name="recipient_address" />
                                                                <input class="checkitem" name="recipient_address" id="recipient_address" value="1" type="checkbox" /> RECIPIENT ADDRESS
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_country" type="hidden" value="0" name="country" />
                                                                <input class="checkitem" name="country" id="country" value="1" type="checkbox" /> COUNTRY
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_province" type="hidden" value="0" name="province" />
                                                                <input class="checkitem" name="province" id="province" value="1" type="checkbox" /> PROVINCE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_city" type="hidden" value="0" name="city" />
                                                                <input class="checkitem" name="city" id="city" value="1" type="checkbox" /> CITY
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_district" type="hidden" value="0" name="district" />
                                                                <input class="checkitem" name="district" id="district" value="1" type="checkbox" /> DISTRICT
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_destination_code" type="hidden" value="0" name="destination_code" />
                                                                <input class="checkitem" name="destination_code" id="destination_code" value="1" type="checkbox" /> DESTINATION CODE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_postal_code" type="hidden" value="0" name="postal_code" />
                                                                <input class="checkitem" name="postal_code" id="postal_code" value="1" type="checkbox" /> POSTAL CODE
                                                            </div>

                                                            <!-- <div class="form-group col-md-3">
                                                                    LAST STATUS
                                                            </div> -->

                                                            <!-- <div class="form-group col-md-3">
                                                                    COURIER NAME
                                                            </div> -->

                                                            <!-- <div class="form-group col-md-3">
                                                                    DELIVERY TYPE
                                                            </div> -->

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_cob_number" type="hidden" value="0" name="cob_number" />
                                                                <input class="checkitem" name="cob_number" id="cob_number" value="1" type="checkbox" /> COURIER BOOKING NUMBER
                                                            </div>

                                                            <!--  <div class="form-group col-md-3">
                                                                    WAYBILL NUMBER
                                                            </div> -->


                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_insurance" type="hidden" value="0" name="insurance" />
                                                                <input class="checkitem" name="insurance" id="insurance" value="1" type="checkbox" /> INSURANCE (IDR)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_cod_price" type="hidden" value="0" name="cod_price" />
                                                                <input class="checkitem" name="cod_price" id="cod_price" value="1" type="checkbox" /> COD PRICE (IDR)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_discount" type="hidden" value="0" name="discount" />
                                                                <input class="checkitem" name="discount" id="discount" value="1" type="checkbox" /> DISCOUNT (IDR)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_total_price" type="hidden" value="0" name="total_price" />
                                                                <input class="checkitem" name="total_price" id="total_price" value="1" type="checkbox" /> TOTAL PRICE (IDR)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_total_weight" type="hidden" value="0" name="total_weight" />
                                                                <input class="checkitem" name="total_weight" id="total_weight" value="1" type="checkbox" /> TOTAL WEIGHT (KG)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_volumetric" type="hidden" value="0" name="volumetric" />
                                                                <input class="checkitem" name="volumetric" id="volumetric" value="1" type="checkbox" /> VOLUME (CM)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_total_koli" type="hidden" value="0" name="total_koli" />
                                                                <input class="checkitem" name="total_koli" id="total_koli" value="1" type="checkbox" /> TOTAL KOLI
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_shipping_price" type="hidden" value="0" name="shipping_price" />
                                                                <input class="checkitem" name="shipping_price" id="shipping_price" value="1" type="checkbox" /> SHIPPING PRICE (IDR)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_qty" type="hidden" value="0" name="qty" />
                                                                <input class="checkitem" name="qty" id="qty" value="1" type="checkbox" /> TOTAL QTY (PCS)
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_packing_type" type="hidden" value="0" name="packing_type" />
                                                                <input class="checkitem" name="packing_type" id="packing_type" value="1" type="checkbox" /> PACKING TYPE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_shipment_code" type="hidden" value="0" name="shipment_code" />
                                                                <input class="checkitem" name="shipment_code" id="shipment_code" value="1" type="checkbox" /> SHIPMENT CODE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_driver_name" type="hidden" value="0" name="driver_name" />
                                                                <input class="checkitem" name="driver_name" id="driver_name" value="1" type="checkbox" /> DRIVER NAME
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_driver_phone" type="hidden" value="0" name="driver_phone" />
                                                                <input class="checkitem" name="driver_phone" id="driver_phone" value="1" type="checkbox" /> DRIVER PHONE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_vehicle" type="hidden" value="0" name="vehicle" />
                                                                <input class="checkitem" name="vehicle" id="vehicle" value="1" type="checkbox" /> VEHICLE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_police_number" type="hidden" value="0" name="police_number" />
                                                                <input class="checkitem" name="police_number" id="police_number" value="1" type="checkbox" /> POLICE NUMBER
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_entry_date" type="hidden" value="0" name="entry_date" />
                                                                <input class="checkitem" name="entry_date" id="entry_date" value="1" type="checkbox" /> ENTRY DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_backorder_date" type="hidden" value="0" name="backorder_date" />
                                                                <input class="checkitem" name="backorder_date" id="backorder_date" value="1" type="checkbox" /> BACKORDER DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_pending_date" type="hidden" value="0" name="pending_date" />
                                                                <input class="checkitem" name="pending_date" id="pending_date" value="1" type="checkbox" /> PENDING DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_ready_topick_date" type="hidden" value="0" name="ready_topick_date" />
                                                                <input class="checkitem" name="ready_topick_date" id="ready_topick_date" value="1" type="checkbox" /> READY TO PICK DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_printed_date" type="hidden" value="0" name="printed_date" />
                                                                <input class="checkitem" name="printed_date" id="printed_date" value="1" type="checkbox" /> PRINTED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_assign_topicker_date" type="hidden" value="0" name="assign_topicker_date" />
                                                                <input class="checkitem" name="assign_topicker_date" id="assign_topicker_date" value="1" type="checkbox" /> ASSIGN TO PICKER DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_picked_date" type="hidden" value="0" name="picked_date" />
                                                                <input class="checkitem" name="picked_date" id="picked_date" value="1" type="checkbox" /> PICKED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_ready_topacked_date" type="hidden" value="0" name="ready_topacked_date" />
                                                                <input class="checkitem" name="ready_topacked_date" id="ready_topacked_date" value="1" type="checkbox" /> READY TO PACKED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_packed_date" type="hidden" value="0" name="packed_date" />
                                                                <input class="checkitem" name="packed_date" id="packed_date" value="1" type="checkbox" /> PACKED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_ready_toshipped_date" type="hidden" value="0" name="ready_toshipped_date" />
                                                                <input class="checkitem" name="ready_toshipped_date" id="ready_toshipped_date" value="1" type="checkbox" /> READY TO SHIPPED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_shipped_date" type="hidden" value="0" name="shipped_date" />
                                                                <input class="checkitem" name="shipped_date" id="shipped_date" value="1" type="checkbox" /> SHIPPED DATE
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <input id="ytReporting_delivered_date" type="hidden" value="0" name="delivered_date" />
                                                                <input class="checkitem" name="delivered_date" id="delivered_date" value="1" type="checkbox" /> DELIVERED DATE
                                                            </div>

                                                        </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        <!-- /.card -->
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
                                var j = jQuery.noConflict();
                                jQuery(document).ready(function() {

                                    jQuery('#select_all').click(function() {
                                        $(':checkbox.checkitem').prop('checked', this.checked);
                                    });

                                    jQuery('#generate').click(function() {
                                        Generate();
                                    });

                                    jQuery('#reload').click(function() {
                                        Reload();
                                    });

                                });

                                function Reload() {
                                    location.reload();
                                }

                                function Generate() {

                                    var start_date = $('#start_date').val();
                                    var end_date = $('#end_date').val();
                                    var miliday = 24 * 60 * 60 * 1000;
                                    var datefirst = new Date(start_date);
                                    var datelast = new Date(end_date);
                                    var start = Date.parse(datefirst);
                                    var end = Date.parse(datelast);
                                    var interval = (end - start) / miliday;

                                    if (interval <= 31) {

                                        var order_code = $('#order_code').val();
                                        var waybill_number = $('#waybill_number').val();
                                        var courier_name = $('#courier_name').val();
                                        var delivery_type = $('#delivery_type').val();
                                        var payment_type = $('#payment_type').val();
                                        var last_status = $('#last_status').val();

                                        if ($('#all_client').prop("checked") == true) {
                                            var all_client = 1;
                                        } else {
                                            var all_client = 0;
                                        }

                                        if ($('#all_location').prop("checked") == true) {
                                            var all_location = 1;
                                        } else {
                                            var all_location = 0;
                                        }

                                        if ($('#all_member').prop("checked") == true) {
                                            var all_member = 1;
                                        } else {
                                            var all_member = 0;
                                        }

                                        var uri = 'https://dashboard.wms.haistar.co.id/index.php?r=Reporting/GenerateTemp';
                                        jQuery.ajax({
                                            type: 'POST',
                                            async: false,
                                            dataType: "json",
                                            url: uri,
                                            timeout: 600000,
                                            data: {
                                                start_date: start_date,
                                                end_date: end_date,
                                                all_location: all_location,
                                                all_member: all_member,
                                                all_client: all_client,
                                                order_code: order_code,
                                                waybill_number: waybill_number,
                                                courier_name: courier_name,
                                                delivery_type: delivery_type,
                                                payment_type: payment_type,
                                                last_status: last_status
                                            },
                                            beforeSend: function(jqXHR, settings) {
                                                j.blockUI();

                                                $("#loading-image").show();


                                            },
                                            success: function(result) {
                                                j.unblockUI();
                                                $("#loading-image").hide();
                                                //alert(result);
                                                //die();
                                                var msgs = result;
                                                if (msgs == "OK") {
                                                    $("#loading-image").hide();
                                                    alert('Success Generate Temporary Shipment Report');
                                                    //location.reload(); 

                                                    $("#generate").hide();
                                                    $("#download").show();
                                                    $("#reload").show();
                                                    $("#date").hide();
                                                    $("#row-wb").hide();
                                                    $("#row-deliver").hide();
                                                    $("#row-stat").hide();
                                                    $("#row-loc").hide();
                                                    $("#row-custom").show();

                                                } else {
                                                    $("#loading-image").hide();
                                                    alert(msgs);
                                                }

                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                $("#loading-image").hide();
                                                j.unblockUI();
                                                alert(errorThrown);
                                            }
                                        });
                                    } else {
                                        alert("Notice: Date interval can't more than 31 days");
                                    }

                                }


                                jQuery_1_12_4("#client").autocomplete({
                                    source: 'https://dashboard.wms.haistar.co.id/index.php?r=Custom/ClientName',
                                    select: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                        else {
                                            $("#client_id").val(ui.item.program_id);
                                        }
                                    },
                                    focus: function(event, ui) {
                                        if (ui.item.label == "No result found")
                                            event.preventDefault();
                                    }
                                });


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
    $("#shipped_date1").datepicker({'dateFormat':'yy-mm-dd'});
    $("#shipped_date2").datepicker({'dateFormat':'yy-mm-dd'});
    $("#packed_date1").datepicker({'dateFormat':'yy-mm-dd'});
    $("#packed_date2").datepicker({'dateFormat':'yy-mm-dd'});
    $("#delivered_date1").datepicker({'dateFormat':'yy-mm-dd'});
    $("#delivered_date2").datepicker({'dateFormat':'yy-mm-dd'});
    $("#start_date").datepicker({'dateFormat':'yy-mm-dd'});
    $("#end_date").datepicker({'dateFormat':'yy-mm-dd'});
</script>