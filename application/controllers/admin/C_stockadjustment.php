<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_stockadjustment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_stockadjustment
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Stock Adjustment';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_stockadjustment');
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

        if(!empty($all_client))
            $file_name = "stock_adjustment_all_client_".date("Ymd")."_".date("His");
        else
            $file_name = "stock_adjustment_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if (!empty($start_date) || !empty($end_date) )
        {
        if ($start_date == $end_date)
            $start_date = "AND DATE(adjustment_date) = '$start_date' ";
        else
        {
            if (!empty($start_date))
                $start_date = "AND DATE(adjustment_date) >= '$start_date'";
            if (!empty($end_date))
                $end_date = "AND DATE(adjustment_date) <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
        }
        }
        else {
        $start_date="";
        $end_date="";
        }

        $is_client = $this->session->userdata('is_client');
        if($is_client == 0){
                            $is_clientquery = "SELECT 'ADJUSTMENT' AS tp, c.location_id, CONCAT('ADJ',inventory_adjustment_id) AS cd, a.created_date AS dt,
                            'Adjustment' AS stat, c.program_item_id, (to_quantity-from_quantity) AS qty, IFNULL((SELECT g.name FROM grid g WHERE g.grid_id = b.grid_id),'') AS location, a.remark AS remark, b.item_information AS item_information, a.created_by
                            FROM inventoryadjustment a JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
                            JOIN inventory c ON b.inventory_id = c.inventory_id";
                            }

        if (!empty($all_client))
        {
        $client = "";
        }
        else
        {
        $client = " AND program_id = ".$program_id;
        }

        if (!empty($all_location))
        {
        $location = "";
        }
        else
        {
        $location = " AND location_id = ".$location_id;
        }
        $stockadjustment       = " SELECT	
                            location_name,
                            program_name,
                            TO_CHAR(adjustment_date, 'mm/dd/YYYY') as adjustment_date,
                            item_code,
                            item_name,
                            barcode,
                            grid_name,
                            managed_by,
                            item_information,
                            quantity_adjustment,
                            reason,
                            user,
                            type, 
                            transaction_code
                        FROM stockadjustment
                        WHERE 1=1
                        $location
                        $client
                        $start_date
                        $end_date
                        ORDER BY adjustment_date DESC";
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
         $stockadjustmentdownload     =  $this->db->query($stockadjustment)->result_array();
         // $usersData = $this->Main_model->getUserDetails();
 
         // file creation 
         $file = fopen('php://output', 'w');
         
         $header = array("WH Site",
                         "Client Name",
                         "Adjustment Date",
                         "Item Code",
                         "Item Name",
                         "Barcode",
                         "Grid Name",
                         "Managed By",
                         "Item Information",
                         "Quantity Adjustment",
                         "Reason",
                         "User",
                         "Type",
                         "Transaction Code"
                     ); 
         fputcsv($file, $header);
         foreach ($stockadjustmentdownload as $row){ 
             fputcsv($file,$row);
         }
         fclose($file); 
         exit;
 
         
     }
}