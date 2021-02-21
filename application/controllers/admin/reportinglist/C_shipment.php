<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_shipment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_shipment
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Shipment';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_shipment');
		$this->load->view('admin/layout/v_footer');
	}

    // Export ke excel
    public function export()
    {
        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
            
        $start = new DateTime($start_date);
        
        $end_date = date('Y-m-d', strtotime($end_date. ' + 1 days'));
        $end = new DateTime($end_date);
        $interval = $start->diff($end);
        // echo $interval->days;die;
        if($interval->days <= 31)
        {
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
            $all_client             = $this->input->post('all_client');
            $all_location           = $this->input->post('all_location');
            $filterclient      = $this->session->userdata('client');
            $filterlocation     = $this->session->userdata('list_location_id');

            // Untuk client privilage peruser
            $stringclient = "";
            foreach($filterclient as $client)
            {
                $stringclient = $stringclient.",".$client[0];
            }
            $stringclient = ltrim($stringclient, ',');

            // Untuk location privilage peruser
            $stringlocation = "";
            foreach($filterlocation as $location)
            {
                $stringlocation = $stringlocation.",".$location[0];
            }
            $stringlocation = ltrim($stringlocation, ',');

            if(!empty($all_client))
                    $file_name = "shipment_all_client_".date("Ymd")."_".date("His");
                else
                    $file_name = "shipment_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

            $order_code        = $this->input->post('order_code');
            if(!empty($order_code))
            {
                $o_code = "AND order_code = '$order_code'";
            }
            else
            {
                $o_code = "";
            }

            $waybill_number        = $this->input->post('waybill_number');
            if(!empty($waybill_number))
            {
                $w_number = "AND waybill_number = '$waybill_number'";
            }
            else
            {
                $w_number = "";
            }

            $courier_name        = $this->input->post('courier_name');
            if(!empty($courier_name))
            {
                $c_name = "AND courier_name = '$courier_name'";
            }
            else
            {
                $c_name = "";
            }

            $delivery_type        = $this->input->post('delivery_type');
            if(!empty($delivery_type))
            {
                $d_type = "AND delivery_type = '$delivery_type'";
            }
            else
            {
                $d_type = "";
            }

            $payment_type        = $this->input->post('payment_type');
            if(!empty($payment_type))
            {
                $p_type = "AND payment_type = '$payment_type'";
            }
            else
            {
                $p_type = "";
            }

            $last_status        = $this->input->post('last_status');
            if(!empty($last_status))
            {
                $l_status = "AND last_status = '$last_status'";
            }
            else
            {
                $l_status = "";
            }

            $client        = $this->input->post('client');
            if(!empty($client))
            {
                $c_id = "AND program_id = '$client'";
            }
            else
            {
                $c_id = "";
            }

            $shipment_code1        = $this->input->post('shipment_code1');
            if(!empty($shipment_code1))
            {
                $s_code = "AND shipment_code = '$shipment_code1'";
            }
            else
            {
                $s_code = "";
            }

            $start_shipped_date      = $this->input->post('shipped_date1');
            $end_shipped_date        = $this->input->post('shipped_date2');
            
            if (!empty($start_shipped_date) || !empty($end_shipped_date) )
            {
                if ($start_shipped_date == $end_shipped_date)
                {
                    $start_shipped = "AND DATE(shipped_date) = '$start_shipped_date' ";
                    $end_shipped   = "";
                }
                else
                {
                    if (!empty($start_shipped_date)){
                        $start_shipped = "AND shipped_date >= '$start_shipped_date'";
                    }
                    else{
                        $start_shipped = "";
                    }
                    if (!empty($end_shipped_date)){
                        $end_shipped = "AND shipped_date <= DATE(TO_DATE('$end_shipped_date', 'YYYY-MM-DD') + interval '1 day')";
                    }
                    else{
                        $end_shipped = "";
                    }
                }
            }
            else {
                $start_shipped="";
                $end_shipped="";
            }

            $start_packed_date      = $this->input->post('packed_date1');
            $end_packed_date        = $this->input->post('packed_date2');
            
            if (!empty($start_packed_date) || !empty($end_packed_date) )
            {
                if ($start_packed_date == $end_packed_date)
                {
                    $start_packed = "AND DATE(packed_date) = '$start_packed_date' ";
                    $end_packed   = "";
                }
                else
                {
                    if (!empty($start_packed_date)){
                        $start_packed = "AND packed_date >= '$start_packed_date'";
                    }
                    else{
                        $start_packed = "";
                    }
                    if (!empty($end_packed_date)){
                        $end_packed = "AND packed_date <= DATE(TO_DATE('$end_packed_date', 'YYYY-MM-DD') + interval '1 day')";
                    }
                    else{
                        $end_packed = "";
                    }
                }
            }
            else {
                $start_packed="";
                $end_packed="";
            }

            $start_delivered_date      = $this->input->post('delivered_date1');
            $end_delivered_date        = $this->input->post('delivered_date2');
            
            if (!empty($start_delivered_date) || !empty($end_delivered_date) )
            {
                if ($start_delivered_date == $end_delivered_date)
                {
                    $start_delivered = "AND DATE(delivered_date) = '$start_delivered_date' ";
                    $end_delivered   = "";
                }
                else
                {
                    if (!empty($start_delivered_date)){
                        $start_delivered = "AND delivered_date >= '$start_delivered_date'";
                    }
                    else{
                        $start_delivered = "";
                    }
                    if (!empty($end_delivered_date)){
                        $end_delivered = "AND delivered_date <= DATE(TO_DATE('$end_delivered_date', 'YYYY-MM-DD') + interval '1 day')";
                    }
                    else{
                        $end_delivered = "";
                    }
                }
            }
            else {
                $start_delivered="";
                $end_delivered="";
            }

            $start_date_field       = $this->input->post('start_date');
            $end_date_field         = $this->input->post('end_date');
            if (!empty($start_date_field) || !empty($end_date_field) )
            {
                if ($start_date_field == $end_date_field)
                {
                    $start_date = "AND DATE(order_created_date) = '$start_date_field' ";
                    $end_date   = "";
                }
                else
                {
                    if (!empty($start_date_field)){
                        $start_date = "AND order_created_date >= '$start_date_field'";
                    }
                    else{
                        $start_date = "";
                    }
                    if (!empty($end_date_field)){
                        $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
                    }
                    else{
                        $end_date = "";
                    }
                }
            }
            else {
                $start_date="";
                $end_date="";
            }
            if (empty($start_shipped_date) && empty($end_shipped_date) && empty($start_packed_date) && empty($end_packed_date) && empty($start_delivered_date) && empty($end_delivered_date) && empty($start_date_field) && empty($end_date_field)) {
                $date = "AND DATE(order_created_date) = date(CURRENT_DATE)";
            }else{
                $date = "";
            }

            $order_date             = $this->input->post('order_date');
            $order_created_date             = $this->input->post('order_created_date');
            $recipient_name         = $this->input->post('recipient_name');
            $recipient_phone         = $this->input->post('recipient_phone');
            $recipient_address         = $this->input->post('recipient_address');
            $country         = $this->input->post('country');
            $province         = $this->input->post('province');
            $city         = $this->input->post('city');
            $district         = $this->input->post('district');
            $destination_code         = $this->input->post('destination_code');
            $postal_code         = $this->input->post('postal_code');
            $cob_number         = $this->input->post('cob_number');
            $insurance         = $this->input->post('insurance');
            $cod_price         = $this->input->post('cod_price');
            $discount         = $this->input->post('discount');
            $total_price         = $this->input->post('total_price');
            $total_weight         = $this->input->post('total_weight');
            $volumetric         = $this->input->post('volumetric');
            $total_koli         = $this->input->post('total_koli');
            $shipping_price         = $this->input->post('shipping_price');
            $qty         = $this->input->post('qty');
            $packing_type         = $this->input->post('packing_type');
            $shipment_code         = $this->input->post('shipment_code');
            $driver_name         = $this->input->post('driver_name');
            $driver_phone         = $this->input->post('driver_phone');
            $vehicle         = $this->input->post('vehicle');
            $police_number         = $this->input->post('police_number');
            $entry_date         = $this->input->post('entry_date');
            $backorder_date         = $this->input->post('backorder_date');
            $pending_date         = $this->input->post('pending_date');
            $ready_topick_date         = $this->input->post('ready_topick_date');
            $printed_date         = $this->input->post('printed_date');
            $assign_topicker_date         = $this->input->post('assign_topicker_date');
            $picked_date         = $this->input->post('picked_date');
            $ready_topacked_date         = $this->input->post('ready_topacked_date');
            $packed_date         = $this->input->post('packed_date');
            $ready_toshipped_date         = $this->input->post('ready_toshipped_date');
            $shipped_date         = $this->input->post('shipped_date');
            $delivered_date         = $this->input->post('delivered_date');

            if (!empty($all_client))
            {
                $client = "AND program_id in (".$stringclient.")";
                // $client = "";

            }
            else
            {
                $client = " AND program_id = ".$program_id;
            }

            if (!empty($all_location))
            {
                $location = "AND location_id in (".$stringlocation.")";
                // $location = "";
            }
            else
            {
                $location = " AND location_id = ".$location_id;
            }

            $select = "";
            $hd     = array();

            if(!empty($order_date)){
                $select .= "order_date,";
                array_push($hd, "Order Date");
            }

            if(!empty($order_created_date)){
                $select .= "order_created_date,";
                array_push($hd, "Order Created Date");
            }
                
            if(!empty($recipient_name)){            
                $select .= "recipient_name,";
                array_push($hd, "Recipient Name");
            }

            if (!empty($recipient_phone))
            {
                $select .= " recipient_phone, ";
                array_push($hd, "Recipient Phone");
            }

            if (!empty($recipient_address))
            {
                $select .= " recipient_address, ";
                array_push($hd, "Recipient Address");
            }

            if (!empty($country))
            {
                $select .= " country, ";
                array_push($hd, "Country");
            }

            if (!empty($province))
            {
                $select .= " province, ";
                array_push($hd, "Province");
            }

            if (!empty($city))
            {
                $select .= " city, ";
                array_push($hd, "City");
            }

            if (!empty($district))
            {
                $select .= " district, ";
                array_push($hd, "District");
            }

            if (!empty($destination_code))
            {
                $select .= " destination_code, ";
                array_push($hd, "Destination Code");
            }

            if (!empty($postal_code))
            {
                $select .= " postal_code, ";
                array_push($hd, "Postal Code");
            }

            if (!empty($cob_number))
            {
                $select .= " courier_booking_number, ";
                array_push($hd, "Courier Booking Number");
            }

            if (!empty($insurance))
            {
                $select .= " insurance, ";
                array_push($hd, "Insurance (IDR)");
            }

            if (!empty($cod_price))
            {
                $select .= " cod_price,  ";
                array_push($hd, "COD Price (IDR)");
            }

            if (!empty($discount))
            {
                $select .= " discount,  ";
                array_push($hd, "Discount (IDR)");
            }

            if (!empty($total_price))
            {
                $select .= " total_price,  ";
                array_push($hd, "Total Price (IDR)");
            }

            if (!empty($total_weight))
            {
                $select .= " total_weight,  ";
                array_push($hd, "Total Weight (KG)");
            }

            if (!empty($volumetric))
            {
                $select .= " volume,  ";
                array_push($hd, "Volume (CM)");
            }

            if (!empty($total_koli))
            {
                $select .= " total_koli,  ";
                array_push($hd, "Total Koli");
            }

            if (!empty($shipping_price))
            {
                $select .= " shipping_price,  ";
                array_push($hd, "Shipping Price (IDR)");
            }

            if (!empty($qty))
            {
                $select .= " total_qty,  ";
                array_push($hd, "Total Qty (pcs)");
            }

            if (!empty($packing_type))
            {
                $select .= " packing_type,  ";
                array_push($hd, "Packing Type");
            }

            if (!empty($shipment_code))
            {
                $select .= " shipment_code, ";
                array_push($hd, "Shipment Code");
            }

            if (!empty($driver_name))
            {
                $select .= " driver_name, ";
                array_push($hd, "Driver Name");
            }

            if (!empty($driver_phone))
            {
                $select .= " driver_phone, ";
                array_push($hd, "Driver Phone");
            }

            if (!empty($vehicle))
            {
                $select .= " vehicle, ";
                array_push($hd, "Vehicle");
            }

            if (!empty($police_number))
            {
                $select .= " police_number, ";
                array_push($hd, "Police Number");
            }

            if (!empty($entry_date))
            {
                $select .= " TO_CHAR(entry_date, 'mm/dd/YYYY HH24:MI') AS entry_date, ";
                array_push($hd, "Entry Date");
            }

            if (!empty($backorder_date))
            {
                $select .= " TO_CHAR(backorder_date, 'mm/dd/YYYY HH24:MI') AS backorder_date,";
                array_push($hd, "Backorder Date");
            }

            if (!empty($pending_date))
            {
                $select .= " TO_CHAR(pending_date, 'mm/dd/YYYY HH24:MI') AS pending_date,";
                array_push($hd, "Pending Date");
            }

            if (!empty($ready_topick_date))
            {
                $select .= " TO_CHAR(ready_to_pick_date, 'mm/dd/YYYY HH24:MI') AS ready_to_pick_date,";
                array_push($hd, "Ready To Pick Date");
            }

            if (!empty($printed_date))
            {
                $select .= " TO_CHAR(printed_date, 'mm/dd/YYYY HH24:MI') AS printed_date,";
                array_push($hd, "Printed Date");
            }

            if (!empty($assign_topicker_date))
            {
                $select .= " TO_CHAR(assign_to_picker_date, 'mm/dd/YYYY HH24:MI') AS assign_to_picker_date,";
                array_push($hd, "Assign To Picker Date");
            }

            if (!empty($picked_date))
            {
                $select .= " TO_CHAR(picked_date, 'mm/dd/YYYY HH24:MI') AS picked_date,";
                array_push($hd, "Picked Date");
            }

            if (!empty($ready_topacked_date))
            {
                $select .= " TO_CHAR(ready_to_packed_date, 'mm/dd/YYYY HH24:MI') AS ready_to_packed_date,";
                array_push($hd, "Ready To Packed Date");
            }

            if (!empty($packed_date))
            {
                $select .= " TO_CHAR(packed_date, 'mm/dd/YYYY HH24:MI') AS packed_date,";
                array_push($hd, "Packed Date");
            }

            if (!empty($ready_toshipped_date))
            {
                $select .= " TO_CHAR(ready_to_shipped_date, 'mm/dd/YYYY HH24:MI') AS ready_to_shipped_date,";
                array_push($hd, "Ready To Shipped Date");
            }

            if (!empty($shipped_date))
            {
                $select .= " TO_CHAR(shipped_date, 'mm/dd/YYYY HH24:MI') AS shipped_date,";
                array_push($hd, "Shipped Date");
            }

            if (!empty($delivered_date))
            {
                $select .= " TO_CHAR(delivered_date, 'mm/dd/YYYY HH24:MI') AS delivered_date,";
                array_push($hd, "Delivered Date");
            }        

            $shipmentorder  = " SELECT
                                    program_name, 
                                    location_name,
                                    $select
                                    order_code,
                                    last_status,
                                    courier_name,
                                    delivery_type,                                
                                    waybill_number,                                
                                    payment_type,                                 
                                    remark_return,
                                    created_by
                                FROM shipmentorder	
                                WHERE 1=1  
                                $location
                                $client
                                $o_code
                                $w_number
                                $c_name
                                $d_type
                                $p_type
                                $l_status
                                $c_id
                                $s_code
                                $start_shipped
                                $end_shipped
                                $start_packed
                                $end_packed
                                $start_delivered
                                $end_delivered
                                $start_date
                                $end_date
                                $date";
            // var_dump($shipmentorder);exit(1);
            // echo $shipmentorder;die;
            // $data['redzoneinfo']  =  $this->db->query($redzone)->result();
            // $data['all_client']         = $this->input->post('all_client');
            // $data['all_location']        = $this->input->post('all_location');
            
            
            // $this->load->view('admin/reportinglist/export/exportredzone', $data);
            // // file name 
            $filename = 'users_'.date('Ymd').'.csv'; 
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // // get data 
            $shipmentorderdownload     =  $this->db->query($shipmentorder)->result_array();
            // // $usersData = $this->Main_model->getUserDetails();

            // // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array("Client Name",
                            "Location Name"
                        ); 
            
            if(empty($hd))
            {
                array_push($header,"Order Code");
                array_push($header,"Last Status");
                array_push($header,"Courier Name");
                array_push($header,"Delivery Type");
                array_push($header,"WayBill Number");
                array_push($header,"Payment Type");
                array_push($header,"Remark Return");
                array_push($header,"Created By");
            }
            else
            {
                foreach($hd as $h)
                {
                    array_push($header, $h);
                }
                array_push($header,"Order Code");
                array_push($header,"Last Status");
                array_push($header,"Courier Name");
                array_push($header,"Delivery Type");
                array_push($header,"WayBill Number");
                array_push($header,"Payment Type");
                array_push($header,"Remark Return");
                array_push($header,"Created By");
            }
            // echo json_encode($header);exit(1);
            fputcsv($file, $header);
            foreach ($shipmentorderdownload as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date interval '."can't".' more than 31 days!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_shipment'));
        }
    }
}