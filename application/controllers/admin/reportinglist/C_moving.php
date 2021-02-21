<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_moving extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_moving
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Moving';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav');
		$this->load->view('admin/reportinglist/v_moving');
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
                $file_name = "moving_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "moving_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $moving_code        = $this->input->post('moving_code');
        if(!empty($moving_code))
        {
            $m_code = "AND moving_code = '$moving_code'";
        }
        else
        {
            $m_code = "";
        }
        $last_status        = $this->input->post('last_status');
        if (!empty($last_status)) 
        {
            $l_status = "AND last_status = '$last_status'";
        }
        else
        {
            $l_status = "";
        }
        $item_code        = $this->input->post('item_code');
        if (!empty($item_code)) 
        {
            $i_code = "AND item_sku = '$item_code'";
        }
        else
        {
            $i_code = "";
        }
        $item_name        = $this->input->post('item_name');
        if (!empty($item_name)) 
        {
            $i_name = "AND item_name = '$item_name'";
        }
        else
        {
            $i_name = "";
        }
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
        $moving       = " SELECT
								program_name,
                                location_name,
                                moving_code,
                                TO_CHAR(moving_date, 'mm/dd/YYYY HH24:MI') AS moving_date,
                                TO_CHAR(moving_created_date, 'mm/dd/YYYY HH24:MI') AS moving_created_date,
                                last_status,
                                item_sku,
                                item_name,
                                category,
                                color,
                                size,
                                request_qty,
                                checked_qty,
                                location_to,
                                item_status,
                                remark_cancel,
                                moving_created_by
							FROM moving
							WHERE 1=1 
                            $location
                            $client
							$m_code
                            $l_status
                            $i_code
                            $i_name
                            $start_date
                            $end_date";
        // echo $moving;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $movingdownload     =  $this->db->query($moving)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Moving Code",
                        "Moving Date",
                        "Created Date",
                        "Last Status",
                        "Item SKU",
                        "Item Name",
                        "Category",
                        "Color",
                        "Size",
                        "Request Qty",
                        "Checked Qty",
                        "Location To",
                        "Item Status",
                        "Remark Cancel",
                        "Created By"
                    ); 
        fputcsv($file, $header);
        foreach ($movingdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}