<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_stockcard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman Purchase
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Stock Card';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav');
		$this->load->view('admin/reportinglist/v_stockcard');
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
                $file_name = "stock_card_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "stock_card_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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
        $start_date_field       = $this->input->post('start_date');
        $end_date_field         = $this->input->post('end_date');
        if (!empty($start_date_field) || !empty($end_date_field) )
        {
            if ($start_date_field == $end_date_field)
            {
                $start_date = "AND DATE(transaction_date) = '$start_date_field' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field)){
                    $start_date = "AND transaction_date >= '$start_date_field'";
                }
                else{
                    $start_date = "";
                }
                if (!empty($end_date_field)){
                    $end_date = "AND transaction_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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

        $is_client = $this->session->userdata('is_client');
        if($is_client == 0){
                            $is_clientquery = " UNION ALL 
                                                SELECT 'ADJUSTMENT' AS tp, c.location_id, CONCAT('ADJ',inventory_adjustment_id) AS cd, a.created_date AS dt, 
                                                'Adjustment' AS stat, c.program_item_id, (to_quantity-from_quantity) AS qty 
                                                FROM inventoryadjustment a JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id 
                                                JOIN inventory c ON b.inventory_id = c.inventory_id ";
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
        $stockcard       = " SELECT 
                                program_name,
                                location_name,
                                type,
                                transaction_code,
                                TO_CHAR(transaction_date, 'mm/dd/YYYY HH24:MI') as transaction_date,
                                status,
                                item_sku,
                                item_name,
                                quantity
							FROM stockcard
							WHERE 1=1
							$location
                            $client
                            $i_code
                            $i_name
                            $start_date
                            $end_date
                            ORDER BY transaction_date DESC";
        // echo $stockcard;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $stockcarddownload     =  $this->db->query($stockcard)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Type",
                        "Transaction Code",
                        "Transaction Date",
                        "Status",
                        "Item Code",
                        "Item Name",
                        "Quantity"
                    ); 
        fputcsv($file, $header);
        foreach ($stockcarddownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}