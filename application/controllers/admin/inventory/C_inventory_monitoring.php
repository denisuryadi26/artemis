<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inventory_monitoring extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("inventory/M_inventory_monitoring");
    }

	public function index()
	{
        if(!($this->session->has_userdata('users_id'))){
            redirect(base_url());
        }

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
        
        $deadstock = array();
        $deadstock[] = array(
            "market_place" => "Please Reload!",
            "item_sku"     => "-",
            "item_name"    => "-",
            "quantity"     => "-",
            "inbound_date" => "-"
        );

        $minimumstock = array();
        $minimumstock[] = array(
            "item_code"      => "Please Reload!",
            "item_name"      => "",
            "item_price"     => "NONE",
            "stat"           => "2040-01-14",
            "exist_quantity" => "-",
            "minimum_stock"  => "",
            "average"        => "-"
        );

        $data['deadstock']    = json_decode(json_encode($deadstock));
        $data['minimumstock'] = json_decode(json_encode($minimumstock));
    
        $data['title'] = 'Performance';

        // echo json_encode($data);exit();
        $this->load->view('admin/layout/v_head',$data);
        $this->load->view('admin/layout/v_header');
        $this->load->view('admin/layout/v_nav',$data);
        $this->load->view('admin/dashboard/inventory/v_inventory_monitoring',$data);
        $this->load->view('admin/layout/v_footer');
    }

	public function getDeadStock()
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
        
        $data['deadstock'] = $this->M_inventory_monitoring->deadstock();
    
        $data['title'] = 'Dead Stock';
        echo json_encode($data);
    }

    public function getMinimumStock()
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
        
        $data['minimumstock'] = $this->M_inventory_monitoring->minimumstock();
    
        $data['title'] = 'Minimum Stock';
        echo json_encode($data);
    }

	function set_loc()
    {
        // echo json_encode($_POST['loc']);
        $loc_id 		= str_replace('"', '', json_encode($_POST['loc_id']));
        $loc_name 		= str_replace('"', '', json_encode($_POST['loc_name']));
        $this->session->set_userdata('location_id', $loc_id);
        $this->session->set_userdata('location_name', $loc_name);
    }

    function set_prog()
    {
        // echo json_encode($_POST['loc']);
        $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
        $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
        $this->session->set_userdata('program_id', $program_id);
        $this->session->set_userdata('name', $program_name);
	}
	
	    // Export ke excel
		public function download_dead_stock()
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
	
			$file_name = "dead_stock_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");
	
			$deadstock       = " SELECT
										market_place, 
										item_sku,  
										item_name, 
										quantity, 
										DATE(inbound_date) AS inbound_date
									FROM deadstock
									WHERE location_id = $location_id 
									and program_id = $program_id
									-- and inventory_id IS NULL 
									ORDER BY quantity DESC";
			// echo $deadstock;die;
	
			// file name 
			$filename = 'users_'.date('Ymd').'.csv'; 
			header("Content-Description: File Transfer"); 
			header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
			header("Content-Type: application/csv; ");
			
			// get data 
			$deadstockdownload     =  $this->db->query($deadstock)->result_array();
			// $usersData = $this->Main_model->getUserDetails();
	
			// file creation 
			$file = fopen('php://output', 'w');
			
			$header = array("MARKET PLACE",
							"ITEM CODE",
							"ITEM NAME",
							"READY TO ORDER",
							"INBOUND DATE"
						); 
			fputcsv($file, $header);
			foreach ($deadstockdownload as $row){ 
				fputcsv($file,$row);
			}
			fclose($file); 
			exit;
		}
	
		// Export ke excel
		public function download_minimum_stock()
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
	
			$file_name = "minimum_stock_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");
	
			$deadstock       = "    SELECT 
										item_code, 
										item_name, 
										item_price, 
										stat, 
										exist_quantity, 
										minimum_stock, 
										average
									FROM minimumstock
									WHERE location_id = $location_id 
									AND program_id = $program_id
									ORDER BY exist_quantity ASC, item_name ASC";
			// echo $deadstock;die;
	
			// file name 
			$filename = 'users_'.date('Ymd').'.csv'; 
			header("Content-Description: File Transfer"); 
			header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
			header("Content-Type: application/csv; ");
			
			// get data 
			$deadstockdownload     =  $this->db->query($deadstock)->result_array();
			// $usersData = $this->Main_model->getUserDetails();
	
			// file creation 
			$file = fopen('php://output', 'w');
			
			$header = array("ITEM CODE",
							"ITEM NAME",
							"ITEM PRICE",
							"LEVEL",
							"QTY",
							"MIN",
							"AVERAGE"
						); 
			fputcsv($file, $header);
			foreach ($deadstockdownload as $row){ 
				fputcsv($file,$row);
			}
			fclose($file); 
			exit;
		}
}