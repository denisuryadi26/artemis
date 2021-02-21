<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_stagingcancel extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_stagingcalcel
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Staging Cancel';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_stagingcancel');
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
                $file_name = "staging_cancel_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "staging_cancel_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $order_code        = $this->input->post('order_code');
        if(!empty($order_code))
        {
            $o_code = "AND order_code = '$order_code'";
        }
        else
        {
            $o_code = "";
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
        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date)
                $start_date = "AND DATE(canceled_date) = '$start_date' ";
            else
            {
                if (!empty($start_date))
                    $start_date = "AND DATE(canceled_date) >= '$start_date'";
                if (!empty($end_date))
                    $end_date = "AND DATE(canceled_date) <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
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
        $stagingcancel       = " SELECT
								program_name,
                                location_name,
                                order_code,
                                TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                TO_CHAR(canceled_date, 'mm/dd/YYYY HH24:MI') AS canceled_date,
                                last_status,
                                canceled_by,
                                item_sku,
                                item_name,
                                barcode,
                                grid_order,
                                qty_order,
                                grid_move,
                                qty_move,
                                TO_CHAR(date_process, 'mm/dd/YYYY HH24:MI') date_process,
                                process_by, 
                                status  
							FROM stagingcancel
							WHERE 1=1 
							$location
                            $client
                            $o_code
                            $i_code
                            $start_date
                            $end_date";
        // echo $stagingcancel;die;
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $stagingcanceldownload     =  $this->db->query($stagingcancel)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Order Code",
                        "Order Date",
                        "Canceled Date",
                        "Last Status",
                        "Canceled By",
                        "Item Code",
                        "Item Name",
                        "Barcode",
                        "Grid Order",
                        "Qty Order",
                        "Grid Move",
                        "Qty Move",
                        "Date Process",
                        "Process By",
                        "Status",
                        "Dropshipper Phone",
                        "Dropshipper Address",
                        "Recipient Name"
                    ); 
        fputcsv($file, $header);
        foreach ($stagingcanceldownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}