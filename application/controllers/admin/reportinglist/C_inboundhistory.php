<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_inboundhistory extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_inboundperformance
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Inbound History';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_inboundhistory');
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
            if($interval->days <= 365)
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
                    $file_name = "inboundperformance_all_client_".date("Ymd")."_".date("His");
                else
                    $file_name = "inboundperformance_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

            $purchase_code    = $this->input->post('purchase_code');
            if(!empty($purchase_code))
            {
                $p_code = "AND purchase_code = '$purchase_code'";
            }
            else
            {
                $p_code = "";
            }

            $item_code        = $this->input->post('item_code');
            if(!empty($item_code))
            {
                $i_code = "AND item_code = '$item_code'";
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

            $item_barcode     = $this->input->post('item_barcode');
            if(!empty($item_barcode))
            {
                $i_barcode = "AND barcode = '$item_barcode'";
            }
            else
            {
                $i_barcode = "";
            }

            $start_date_field       = $this->input->post('start_date');
            $end_date_field         = $this->input->post('end_date');
            if (!empty($start_date_field) || !empty($end_date_field) )
            {
                if ($start_date_field == $end_date_field)
                {
                    $start_date = "AND DATE(packinglist_created_date) = '$start_date_field' ";
                    $end_date   = "";
                }
                else
                {
                    if (!empty($start_date_field)){
                        $start_date = "AND packinglist_created_date >= '$start_date_field'";
                    }
                    else{
                        $start_date = "";
                    }
                    if (!empty($end_date_field)){
                        $end_date = "AND packinglist_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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
            $inboundhistory     = " SELECT
                                    program_name,
                                    location_name,
                                    status, 
                                    purchase_code,
                                    marketplace,
                                    item_code,
                                    item_name,
                                    barcode,
                                    purchase_quantity,
                                    received_quantity,
                                    putaway_quantity,
                                    TO_CHAR(packinglist_created_date, 'mm/dd/YYYY HH24:MI')  AS packinglist_created_date,
                                    inbound_created_by,
                                    TO_CHAR(arrival_date, 'mm/dd/YYYY HH24:MI')  AS arrival_date,
                                    parent_type_client
                                FROM inboundhistory
                                WHERE 1=1 
                                $location
                                $client
                                $p_code
                                $i_code
                                $i_name
                                $i_barcode
                                $start_date
                                $end_date";
            // echo $inboundhistory;die;
            // $data['inboundhistoryinfo']  =  $this->db->query($inboundhistory)->result();
            // $data['all_client']         = $this->input->post('all_client');
            // $data['all_location']        = $this->input->post('all_location');
            
            
            // $this->load->view('admin/reportinglist/export/exportinboundhistory', $data);

            // file name 
            $filename = 'users_'.date('Ymd').'.csv'; 
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // get data 
            $inboundhistorydownload     =  $this->db->query($inboundhistory)->result_array();
            // $usersData = $this->Main_model->getUserDetails();

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array("Client Name",
                            "Location Name",
                            "Status",
                            "PO Number",
                            "Marketplace",
                            "Item Code",
                            "Item Name",
                            "Barcode",
                            "PO Qty",
                            "Receiving Qty",
                            "Putaway Qty",
                            "PO Created",
                            "Created By",
                            "Arrival Date",
                            "Parent Type Client"
                        ); 
            fputcsv($file, $header);
            foreach ($inboundhistorydownload as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date interval '."can't".' more than 6 months!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_inboundhistory'));
        }
    }
    else
    {
        $alert = '<div class="alert alert-danger" style="margin-top: 3px">
        <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date Start and Date End '."can't".' be empty!</div></div>';
        $this->session->set_flashdata("notice", $alert);
        redirect(array('admin/reportinglist/C_inboundhistory'));
    }
    }
}