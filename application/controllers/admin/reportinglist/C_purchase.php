<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_purchase extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
	//Halaman Purchase
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Purchase';

		$config['base_url'] = base_url('').'/admin/reportinglist/C_purchase';

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_purchase',$data);
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
        // $filterclient     = $this->session->userdata('client');

        $purchase_code    = $this->input->post('purchase_code');
        $item_code        = $this->input->post('item_code');
        $item_name        = $this->input->post('item_name');
        $item_barcode     = $this->input->post('item_barcode');
        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');

        if(!empty($purchase_code))
        {
            $p_code = "AND purchase_code = '$purchase_code'";
        }
        else
        {
            $p_code = "";
        }

        if (!empty($item_code)) {
            $i_code = "AND item_sku = '$item_code'";
        }
        else{
            $i_code = "";
        }

        if (!empty($item_name)) {
            $i_name = "AND item_name = '$item_name'";
        }
        else{
            $i_name = "";
        }
        if (!empty($item_barcode)) {
            $i_barcode = "AND item_barcode = '$item_barcode'";
        }
        else{
            $i_barcode = "";
        }

        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date){
                $start_date = "AND DATE(packinglist_created_date) = '$start_date' ";
            }
            else
            {
                if (!empty($start_date)){
                    $start_date = "AND packinglist_created_date >= '$start_date'";
                }
                if (!empty($end_date)){
                    $end_date = "AND packinglist_created_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
                }
            }
        }
        else {
            $start_date="";
            $end_date="";
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
        
        // var_dump($filterclient);die;

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

        if(!empty($all_client))
                $file_name = "purchase_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "purchase_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $sql_prof       = " SELECT
                                program_name,
                                location_name,
                                purchase_status, 
                                packinglist_number, 
                                TO_CHAR(purchase_date, 'mm/dd/YYYY HH24:MI') as purchase_date, 
                                market_place, 
                                item_status, 
                                item_sku,
                                item_barcode, 
                                item_name, 
                                category, 
                                brand, 
                                color, 
                                size, 
                                buying_price, 
                                allocation_quantity, 
                                received_quantity, 
                                putaway_quantity, 
                                damaged_quantity,
                                remark,
                                is_return
                            FROM purchaseinfo
                            WHERE 1=1 
                            $location
                            $client
                            $p_code
                            $i_code
                            $i_name
                            $i_barcode
                            $start_date
                            $end_date";
                            
        // echo $sql_prof;die;
        // $data['purchaseinfo']  =  $this->db->query($sql_prof)->result();
        // $data['all_client']         = $this->input->post('all_client');
        // $data['all_location']        = $this->input->post('all_location');
        
        
        // $this->load->view('admin/reportinglist/export/exportpurchase', $data);
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $orderinformationdownload     =  $this->db->query($sql_prof)->result_array();
        // echo $result_array;die;

        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Program Name",
                        "Location Name",
                        "Purchase Status",
                        "Pakinglist Number",
                        "Purchase Date",
                        "Market Place",
                        "Item Status",
                        "Item SKU",
                        "Item Barcode",
                        "Item Name",
                        "Category",
                        "Brand",
                        "Color",
                        "Size",
                        "Buying Price",
                        "Purchase Quantity",
                        "Received Quantity",
                        "Putaway Quantity",
                        "Damaged Quantity",
                        "Remark",
                        "Is Return"
                    ); 
        fputcsv($file, $header);
        foreach ($orderinformationdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;

        
    }


}