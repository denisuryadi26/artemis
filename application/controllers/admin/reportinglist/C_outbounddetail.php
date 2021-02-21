<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_outbounddetail extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_outbounddetail
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Outbound Detail';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_outbounddetail');
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
                        $file_name = "outbound_detail_all_client_".date("Ymd")."_".date("His");
                    else
                        $file_name = "outbound_detail_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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

                $item_code        = $this->input->post('item_code');
                if(!empty($item_code))
                {
                    $i_code = "AND item_sku = '$item_code'";
                }
                else
                {
                    $i_code = "";
                }

                $item_name        = $this->input->post('item_name');
                if(!empty($item_name))
                {
                    $i_name = "AND item_name = '$item_name'";
                }
                else
                {
                    $i_name = "";
                }

                $start_date       = $this->input->post('start_date');
                $end_date         = $this->input->post('end_date');
                if (!empty($start_date) || !empty($end_date) )
                {
                    if ($start_date == $end_date)
                        $start_date = "AND DATE(order_created_date) = '$start_date' ";
                    else
                    {
                        if (!empty($start_date))
                            $start_date = "AND outbound_date >= '$start_date'";
                        if (!empty($end_date))
                            $end_date = "AND outbound_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
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
                $outbounddetail       = " SELECT
                                        program_name,
                                        location_name,
                                        order_code,
                                        TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                        item_sku,
                                        item_name,
                                        publish_price,
                                        basic_price,
                                        barcode,
                                        category,
                                        brand,
                                        color,
                                        size,
                                        outbound_qty,
                                        item_information,
                                        TO_CHAR(outbound_date, 'mm/dd/YYYY HH24:MI') AS outbound_date,
                                        created_by
                                    FROM outbounddetail
                                    WHERE 1=1 
                                    $location
                                    $client
                                    $o_code
                                    $w_number
                                    $i_code
                                    $i_name
                                    $start_date
                                    $end_date";
                // echo $outbounddetail;die;

                // file name 
                $filename = 'users_'.date('Ymd').'.csv'; 
                header("Content-Description: File Transfer"); 
                header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
                header("Content-Type: application/csv; ");
                
                // get data 
                $outbounddetaildownload     =  $this->db->query($outbounddetail)->result_array();
                // $usersData = $this->Main_model->getUserDetails();

                // file creation 
                $file = fopen('php://output', 'w');
                
                $header = array("Client Name",
                                "Location Name",
                                "Order Code",
                                "Order Date",
                                "Item SKU",
                                "Item Name",
                                "Publish Price",
                                "Basic Price",
                                "Barcode",
                                "Category",
                                "Brand",
                                "Color",
                                "Size",
                                "Outbound Qty",
                                "Item Information",
                                "Outbound Date",
                                "Created By"
                            ); 
                fputcsv($file, $header);
                foreach ($outbounddetaildownload as $row){ 
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
                redirect(array('admin/reportinglist/C_outbounddetail'));
            }
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date Start and Date End '."can't".' be empty!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_outbounddetail'));
        }
    }
}