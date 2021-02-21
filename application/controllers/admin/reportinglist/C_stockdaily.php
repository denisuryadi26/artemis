<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_stockdaily extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_stockdaily
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Stock Daily';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_stockdaily');
		$this->load->view('admin/layout/v_footer');
	}

    // Export ke excel
    public function export()
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
        if($interval->days <= 1)
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
                    $file_name = "stock_daily_all_client_".date("Ymd")."_".date("His");
                else
                    $file_name = "stock_daily_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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
            $start_date       = $this->input->post('start_date');
            $end_date         = $this->input->post('end_date');
            if (!empty($start_date) || !empty($end_date) )
            {
                if ($start_date == $end_date)
                    $start_date = "AND DATE(date) = '$start_date' ";
                else
                {
                    if (!empty($start_date))
                        $start_date = "AND DATE(date) >= '$start_date'";
                    if (!empty($end_date))
                        $end_date = "AND DATE(date) <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
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
            $stockdaily       = " SELECT
                                    location_name,
                                    program_name,
                                    item_code,
                                    item_name,
                                    basic_price,
                                    ready_order,
                                    onhand,
                                    TO_CHAR(date, 'mm/dd/YYYY HH24:MI') AS date
                                FROM stockdaily
                                WHERE 1=1
                                $location
                                $client
                                $i_code
                                $i_name
                                $start_date
                                $end_date";
            // echo $stockdaily;die;

            // file name 
            $filename = 'users_'.date('Ymd').'.csv'; 
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // get data 
            $stockdailydownload     =  $this->db->query($stockdaily)->result_array();
            // $usersData = $this->Main_model->getUserDetails();

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array("Location Name",
                            "Client Name",
                            "Item Code",
                            "Item Name",
                            "Basic Price",
                            "Ready Order",
                            "Onhand",
                            "Date"
                        ); 
            fputcsv($file, $header);
            foreach ($stockdailydownload as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }
        else
        {
            $alert = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Date interval '."can't".' more than 1 days!</div></div>';
            $this->session->set_flashdata("notice", $alert);
            redirect(array('admin/reportinglist/C_stockdaily'));
        }
    }
}