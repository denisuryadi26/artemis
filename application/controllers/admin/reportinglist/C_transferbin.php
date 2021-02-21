<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_transferbin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_transferbin
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Transfer Bin';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_transferbin');
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
                $file_name = "transferbin_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "transferbin_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $grid_from        = $this->input->post('grid_from');
        if(!empty($grid_from))
        {
            $g_from = "AND grid_from = '$grid_from'";
        }
        else
        {
            $g_from = "";
        }

        $grid_to        = $this->input->post('grid_to');
        if(!empty($grid_to))
        {
            $g_to = "AND grid_to = '$grid_to'";
        }
        else
        {
            $g_to = "";
        }
        $start_date_field       = $this->input->post('start_date');
        $end_date_field         = $this->input->post('end_date');
        if (!empty($start_date_field) || !empty($end_date_field) )
        {
            if ($start_date_field == $end_date_field)
            {
                $start_date = "AND DATE(process_date) = '$start_date_field' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field)){
                    $start_date = "AND process_date >= '$start_date_field'";
                }
                else{
                    $start_date = "";
                }
                if (!empty($end_date_field)){
                    $end_date = "AND process_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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
        $transferbin       = " SELECT
								location_name,
                                bin_from,
                                grid_to,
                                item_code,
                                item_name,
                                barcode,
                                exist_quantity,
                                onhand_quantity,
                                process_by,
                                TO_CHAR(process_date, 'mm/dd/YYYY HH24:MI') as process_date
							FROM transferbin
							WHERE 1=1
                            $location
                            $g_from
                            $g_to
                            $start_date
                            $end_date
							";
        // echo $transferbin;die;
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $transferbindownload     =  $this->db->query($transferbin)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Location Name",
                        "Bin From",
                        "Grid To",
                        "Item Code",
                        "Item Name",
                        "Barcode",
                        "Exist Quantity",
                        "Onhand Quantity",
                        "Process By",
                        "Process Date"
                    ); 
        fputcsv($file, $header);
        foreach ($transferbindownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}