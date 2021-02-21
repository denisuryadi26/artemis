<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_emptyinventory extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
        $this->load->model("reportinglist/M_emptyinventory");
    }

	//Halaman C_emptyinventory
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['emptyinventory'] = $this->M_emptyinventory->emptyinventory();
        $data['title'] = 'Empty Inventory';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_emptyinventory',$data);
		$this->load->view('admin/layout/v_footer');
	}

    // Export ke excel
    public function export()
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
                $file_name = "empty_inventory_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "empty_inventory_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $location_name        = $this->input->post('location_name');
        if(!empty($location_name))
        {
            $loc_name = "AND location_name = '$location_name'";
        }
        else
        {
            $loc_name = "";
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
        $emptyinventory       = " SELECT
								location_name,
                                grid_id,
                                grid_name,
                                is_active,
                                is_damaged,
                                total_qty,
                                onhand_qty
							FROM emptyinventory
							WHERE 1=1
                            $location
                            $loc_name
                            ORDER BY location_id";
        // echo $emptyinventory;die;
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $emptyinventorydownload     =  $this->db->query($emptyinventory)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("WH Site",
                        "Grid ID",
                        "Grid Name",
                        "Is Active",
                        "Is Damage",
                        "Total Qyt",
                        "On Hand Qty"
                    ); 
        fputcsv($file, $header);
        foreach ($emptyinventorydownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}