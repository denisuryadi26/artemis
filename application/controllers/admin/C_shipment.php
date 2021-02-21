<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class C_shipment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_purchaselist");
        $this->load->model("M_home");
        $this->load->model("M_nav");
        $this->load->model("M_shipment");
    }

	public function index()
	{
        if(!($this->session->has_userdata('users_id'))){
            redirect(base_url());
        }
		$data['title'] 				= "Shipment";

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

        $notdelivered = array();
        $notdelivered[] = array(
            "program_name" => "Please Reload!",
            "dte"          => "None",
            "total"        => "-"
        );

        $waybillnull = array();
        $waybillnull[] = array(
            "program_name" => "Please Reload!",
            "dte"          => "None",
            "total"        => "-"
        );

        $data['notdelivered'] = json_decode(json_encode($notdelivered));
        $data['waybillnull']  = json_decode(json_encode($waybillnull));
        
		// $data['navlocation'] 		                            = $this->M_nav->getNav();
		// $data['notdelivered'] 		                            = $this->M_shipment->NotDelivered();
        // $data['waybillnull'] 		                            = $this->M_shipment->WaybillNull();
        

		$this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view("admin/layout/v_nav",$data);
		$this->load->view("admin/dashboard/v_shipment",$data);
		$this->load->view("admin/layout/v_footer");
				
    }

    public function getNotDelivered()
    {
        $params = json_decode(file_get_contents('php://input'),true); 

        if($this->session->userdata('location_id'))
        {
            $location_id = $this->session->userdata('location_id');
            $program_id  = $this->session->userdata('program_id');
        }
        else
        {
            $location_id = $this->session->userdata('loc_id');
            $program_id  = $this->session->userdata('prog_id');
        }
        
        $data['notdelivered'] = $this->M_shipment->NotDelivered();
    
        $data['title'] = 'Not Delivered';
        echo json_encode($data);
    }

    public function getWayBillNull()
    {
        $params = json_decode(file_get_contents('php://input'),true); 

        if($this->session->userdata('location_id'))
        {
            $location_id = $this->session->userdata('location_id');
            $program_id  = $this->session->userdata('program_id');
        }
        else
        {
            $location_id = $this->session->userdata('loc_id');
            $program_id  = $this->session->userdata('prog_id');
        }
        
        $data['waybillnull'] = $this->M_shipment->WaybillNull();
    
        $data['title'] = 'Waybill Null';
        echo json_encode($data);
    }

	public function set_loc()
    {
        // echo json_encode($_POST['loc']);
        $loc_id 		= str_replace('"', '', json_encode($_POST['loc_id']));
        $loc_name 		= str_replace('"', '', json_encode($_POST['loc_name']));
      //  $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
       // $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
       // $this->session->set_userdata('program_id', $program_id);
       // $this->session->set_userdata('program_name', $program_name);
        $this->session->set_userdata('location_id', $loc_id);
        $this->session->set_userdata('location_name', $loc_name);
        foreach($this->session->userdata('list_location') as $list_location)
        {
            if($list_location->loc_id == $_POST['loc_id'])
            {
                $this->session->set_userdata('program_id', $list_location->client[0]->c_id);
                break;
            }
        }
        //add the header here
        header('Content-Type: application/json');
        echo json_encode(  $loc_id  );
    }

    public function set_prog()
    {
        // echo json_encode($_POST['loc']);
        $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
        $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
        $this->session->set_userdata('program_id', $program_id);
        $this->session->set_userdata('program_name', $program_name);

        //add the header here
        header('Content-Type: application/json');
        echo json_encode(  $program_id  );
    }

    // Export ke excel
    public function download_waybill_information()
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

        $file_name = "wayybill_null_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");

        $waybillnull       = "     SELECT
                                        program_name, 
                                        DATE(dte) AS dte, 
                                        total
                                    FROM waybillnull
                                    WHERE location_id = $location_id 
                                    -- and status_code in ('ORD_STANDBY', 'ORD_DELIVERY')
                                    -- and awb_number is NULL
                                    -- order by DATE(dte) ASC
                                    -- group by program_name, date(dte) 
                                    -- order by date(dte) ASC";
        // echo $waybillnull;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $waybillnulldownload     =  $this->db->query($waybillnull)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("CLIENTe",
                        "DATE",
                        "TOTAL"
                    ); 
        fputcsv($file, $header);
        foreach ($waybillnulldownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }

    // Export ke excel
    public function download_not_delivered()
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

        $file_name = "not_delivered_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");

        $notdelivered       = " SELECT
                                    program_name, 
                                    DATE(dte) AS dte, 
                                    total
                                FROM notdelivered
                                WHERE location_id = $location_id 
                                -- and status_id = '11'
                                -- group by program_name, date(dte) 
                                -- order by date(dte) ASC";
        // echo $notdelivered;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $notdelivereddownload     =  $this->db->query($notdelivered)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("CLIENT",
                        "DATE",
                        "TOTAL"
                    ); 
        fputcsv($file, $header);
        foreach ($notdelivereddownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}