<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_movingperformance extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_movingperformance
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Moving Performance';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav');
		$this->load->view('admin/reportinglist/v_movingperformance');
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
                $file_name = "moving_performance_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "moving_performance_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $start_date_field       = $this->input->post('start_date');
        $end_date_field         = $this->input->post('end_date');
        if (!empty($start_date_field) || !empty($end_date_field) )
        {
            if ($start_date_field == $end_date_field)
            {
                $start_date = "AND DATE(moving_created_date) = '$start_date_field' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field)){
                    $start_date = "AND moving_created_date >= '$start_date_field'";
                }
                else{
                    $start_date = "";
                }
                if (!empty($end_date_field)){
                    $end_date = "AND moving_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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
        $movingperformance       = " SELECT
                                program_name, 
                                location_name, 
                                moving_code,
                                TO_CHAR(moving_date, 'mm/dd/YYYY HH24:MI') AS moving_date,
                                TO_CHAR(moving_created_date, 'mm/dd/YYYY HH24:MI') AS moving_created_date,
                                last_status,
                                total_qty,
                                ready_to_picked_by,
                                TO_CHAR(ready_to_pick_date, 'mm/dd/YYYY HH24:MI') AS ready_to_pick_date,
                                printed_by,
                                TO_CHAR(printed_date, 'mm/dd/YYYY HH24:MI') AS printed_date,
                                ready_to_packed_by,
                                TO_CHAR(ready_to_packed_date, 'mm/dd/YYYY HH24:MI') AS ready_to_packed_date,
                                packed_by,
                                TO_CHAR(packed_date, 'mm/dd/YYYY HH24:MI') AS packed_date,
                                marketplace,
                                parent_type_client
                            FROM movingperformance
                            WHERE 1=1
                            $location
                            $client
                            $start_date
                            $end_date";
        // echo $movingperformance;die;
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $movingperformancedownload     =  $this->db->query($movingperformance)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Moving Code",
                        "Moving Date",
                        "Created Date",
                        "Last Status",
                        "Total Qty (pcs)",
                        "Ready To Picked By",
                        "Ready To Pick Date",
                        "Printed By",
                        "Printed Date",
                        "Ready to Packed By",
                        "Ready To Packed Date",
                        "Packed By",
                        "Packed Date",
                        "Marketplace",
                        "Parent Type Client"
                    ); 
        fputcsv($file, $header);
        foreach ($movingperformancedownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}