<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
        $this->load->library('form_validation');
    }

	//Halaman C_order
	public function index()
	{
        $data['notice']="Date interval can't more than 31 days.";
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Order';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_order');
		$this->load->view('admin/layout/v_footer');
	}

    // Export ke excel
    public function export()
    {
        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if(($start_date != "" || $start_date != NULL) && ($end_date != "" || $end_date != NULL))
		{
            $start_date       = $this->input->post('start_date');
            $end_date         = $this->input->post('end_date');
            // echo $start_date;die;
                
            $start = new DateTime($start_date);
            // $start->setTimestamp();
            
            $end_date = date('Y-m-d', strtotime($end_date. ' + 1 days'));
            $end = new DateTime($end_date);
            // $end->add(new DateInterval('P1D'));
            // $end->setTimestamp();
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
                $all_client         = $this->input->post('all_client');
                $all_location       = $this->input->post('all_location');
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
                        $file_name = "order_all_client_".date("Ymd")."_".date("His");
                    else
                        $file_name = "order_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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
                    $del_type = "AND delivery_type = '$delivery_type'";
                }
                else
                {
                    $del_type = "";
                }
                $payment_type        = $this->input->post('payment_type');
                if(!empty($payment_type))
                {
                    $pay_type = "AND payment_type = '$payment_type'";
                }
                else
                {
                    $pay_type = "";
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
                $item_code        = $this->input->post('item_code');
                if(!empty($item_code))
                {
                    $l_code = "AND item_code = '$item_code'";
                }
                else
                {
                    $l_code = "";
                }
                $item_name        = $this->input->post('item_name');
                if(!empty($item_name))
                {
                    $l_name = "AND item_name = '$item_name'";
                }
                else
                {
                    $l_name = "";
                }

                $start_shippeddate_field       = $this->input->post('shipped_date1');
                $end_shippeddate_field         = $this->input->post('shipped_date2');
                if (!empty($start_shippeddate_field) || !empty($end_shippeddate_field) )
                {
                    if ($start_shippeddate_field == $end_shippeddate_field)
                    {
                        $start_shippeddate = "AND DATE(shipped_date) = '$start_shippeddate_field' ";
                        $end_shippeddate   = "";
                    }
                    else
                    {
                        if (!empty($start_shippeddate_field)){
                            $start_shippeddate = "AND shipped_date >= '$start_shippeddate_field'";
                        }
                        else{
                            $start_shippeddate = "";
                        }
                        if (!empty($end_shippeddate_field)){
                            $end_shippeddate = "AND shipped_date <= DATE(TO_DATE('$end_shippeddate_field', 'YYYY-MM-DD') + interval '1 day')";
                        }
                        else{
                            $end_shippeddate = "";
                        }
                    }
                }
                else {
                    $start_shippeddate="";
                    $end_shippeddate="";
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

                $orderinformation       = " SELECT
                                        location_name,
                                        program_name,
                                        order_code,
                                        TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                        TO_CHAR(order_created_date, 'mm/dd/YYYY HH24:MI') AS order_created_date,
                                        last_status,
                                        market_place,
                                        channel_name,
                                        payment_type,
                                        courier_name,
                                        delivery_type,
                                        courier_booking_number,
                                        waybill_number,
                                        dropshipper_name,
                                        dropshipper_phone,
                                        dropshipper_address,
                                        recipient_name,
                                        recipient_phone,
                                        recipient_email,
                                        recipient_address,
                                        country,
                                        province,
                                        city,
                                        district,
                                        destination_code,
                                        postal_code,
                                        cod_price,
                                        payment_notes,
                                        item_code,
                                        item_name,
                                        category,
                                        color,
                                        size,
                                        order_qty,
                                        picked_qty,
                                        unit_price,
                                        total_price,
                                        unit_weight,
                                        item_status,
                                        remark_cancel,
                                        order_created_by,
                                        remark,
                                        shipped_date
                                    FROM orderinformation
                                    WHERE 1=1 
                                    $location
                                    $client
                                    $o_code
                                    $w_number
                                    $c_name
                                    $del_type
                                    $pay_type
                                    $l_status
                                    $l_code
                                    $l_name
                                    $start_date
                                    $end_date
                                    $start_shippeddate
                                    $end_shippeddate";
                // echo $orderinformation;die;
                // $data['orderinformationinfo']  =  $this->db->query($orderinformation)->result();
                // $data['all_client']         = $this->input->post('all_client');
                // $data['all_location']        = $this->input->post('all_location');
                    
                // $this->load->view('admin/reportinglist/export/exportorderinformation', $data);

                // file name 
                $filename = 'users_'.date('Ymd').'.csv'; 
                header("Content-Description: File Transfer"); 
                header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
                header("Content-Type: application/csv; ");
                
                // get data 
                $orderinfodownload     =  $this->db->query($orderinformation)->result_array();
                // $usersData = $this->Main_model->getUserDetails();

                // file creation 
                $file = fopen('php://output', 'w');
                
                $header = array("Client Name",
                                "Location Name",
                                "Order Code",
                                "Order Date",
                                "Created Date",
                                "Last Status",
                                "Market Place",
                                "Channel Name",
                                "Payment Type",
                                "Courier Name",
                                "Delivery Type",
                                "Courier Booking Number",
                                "AWB Number",
                                "Dropshipper Name",
                                "Dropshipper Phone",
                                "Dropshipper Address",
                                "Recipient Name",
                                "Recipient Phone",
                                "Recipient Email",
                                "Recipient Address",
                                "Country",
                                "Province",
                                "City",
                                "District",
                                "Destination Code",
                                "Postal Code",
                                "COD Price (IDR)",
                                "Payment Notes",
                                "Item SKU",
                                "Item Name",
                                "Category",
                                "Color",
                                "Size",
                                "Order Qty",
                                "Picked Qty",
                                "Unit Price (IDR)",
                                "Total Price (IDR)",
                                "Unit Weight (KG)",
                                "Item Status",
                                "Remark Cancel",
                                "Created By",
                                "Remark",
                                "Shipped Date"
                            ); 
                fputcsv($file, $header);
                foreach ($orderinfodownload as $row){ 
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
                redirect(array('admin/reportinglist/C_order'));
            }
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date Start and Date End '."can't".' be empty!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_order'));
        }
    }
}