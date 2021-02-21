<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_outboundperformance extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_outboundperformance
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Outbound Performance';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_outboundperformance');
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
                        $file_name = "outbound_performance_all_client_".date("Ymd")."_".date("His");
                    else
                        $file_name = "outbound_performance_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

                $last_status        = $this->input->post('last_status');
                if(!empty($last_status))
                {
                    $l_status = "AND last_status = '$last_status'";
                }
                else
                {
                    $l_status = "";
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
                        if (!empty($end_date_field)){
                            $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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
                $outboundperformance       = " SELECT
                                        program_name, 
                                        location_name,
                                        order_code,
                                        TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                        TO_CHAR(order_created_date, 'mm/dd/YYYY HH24:MI') AS order_created_date,
                                        channel_type,
                                        last_status,
                                        courier_name,
                                        delivery_type,
                                        courier_booking_number,
                                        awb_number,
                                        total_weight,
                                        total_qty,
                                        ready_to_picked_by,
                                        ready_to_pick_date,
                                        printed_by,
                                        TO_CHAR(printed_date, 'mm/dd/YYYY HH24:MI') AS printed_date,
                                        assign_to_picker_by,
                                        TO_CHAR(assign_to_picker_date, 'mm/dd/YYYY HH24:MI') AS assign_to_picker_date,
                                        assign_to,
                                        picked_by,
                                        TO_CHAR(picked_date, 'mm/dd/YYYY HH24:MI') AS picked_date,
                                        ready_to_packed_by,
                                        TO_CHAR(ready_to_packed_date, 'mm/dd/YYYY HH24:MI') AS ready_to_packed_date,
                                        packer_name,
                                        packed_by,
                                        TO_CHAR(packed_date, 'mm/dd/YYYY HH24:MI') AS packed_date,
                                        marketplace,
                                        parent_type_client
                                    FROM outboundperformance 
                                    WHERE 1=1
                                    $location
                                    $client
                                    $l_status
                                    $start_date
                                    $end_date";
                // echo $outboundperformance;die;

                // file name 
                $filename = 'users_'.date('Ymd').'.csv'; 
                header("Content-Description: File Transfer"); 
                header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
                header("Content-Type: application/csv; ");
                
                // get data 
                $outboundperformancedownload     =  $this->db->query($outboundperformance)->result_array();
                // $usersData = $this->Main_model->getUserDetails();

                // file creation 
                $file = fopen('php://output', 'w');
                
                $header = array("Client Name",
                                "Location Name",
                                "Order Code",
                                "Order Date",
                                "Created Date",
                                "Channel Type",
                                "Last Status",
                                "Courier Name",
                                "Delivery Type",
                                "Courier Booking Number",
                                "AWB Number",
                                "Total Weight (gr)",
                                "Total Qty (pcs)",
                                "Ready To Picked By",
                                "Ready To Pick Date",
                                "Printed By",
                                "Printed Date",
                                "Assign To Picker By",
                                "Assign To Picker Date",
                                "Assign To",
                                "Picked By",
                                "Picked Date",
                                "Ready to Packed By",
                                "Ready To Packed Date",
                                "Packer Name",
                                "Packed By",
                                "Packed Date",
                                "Marketplace",
                                "Parent Type Client"
                            ); 
                fputcsv($file, $header);
                foreach ($outboundperformancedownload as $row){ 
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
                redirect(array('admin/reportinglist/C_outboundperformance'));
            }
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date Start and Date End '."can't".' be empty!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_outboundperformance'));
        }
    }
}