<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class C_home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_purchaselist");
        $this->load->model("M_home");
        $this->load->model("M_nav");
        $this->load->model("charts/M_ordermonitoring");
        $this->load->model("charts/M_inventoryefficiency");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	//Halaman Dashboard
	public function index()
	{
		$data['title'] 				= "Dashboard Management System";

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
        
		$data['minimumstock'] 		                            = $this->M_home->minimumstock();
		$data['navlocation'] 		                            = $this->M_nav->getNav();
        $data['nilaidailymonitoring'] 		                    = $this->M_ordermonitoring->getordermonitoring(date('M Y'), 'dawdaw');
        $data['dayList'] 		                                = $this->getDayList();
        
        $nilaiinventorygridefficiency = array();
        $nilaiinventorygridefficiency[] = array(
            "grid_name"  => "Please Reload!",
            "total_grid" => "-",
            "avg_perday" => "-"
        );
        
        $nilaiinventoryskuefficiency = array();
        $nilaiinventoryskuefficiency[] = array(
            "sku_name"   => "Please Reload!",
            "total_sku"  => "-",
            "avg_perday" => "-"
        );
        
        $data['nilaiinventorygridefficiency'] = json_decode(json_encode($nilaiinventorygridefficiency));
        $data['nilaiinventoryskuefficiency']  = json_decode(json_encode($nilaiinventoryskuefficiency));

        // $data['nilaiinventorygridefficiency'] 		            = $this->M_inventoryefficiency->getinventorygrid(date('M Y'), 'dawdaw');
        // $data['nilaiinventoryskuefficiency'] 		            = $this->M_inventoryefficiency->getinventorysku(date('M Y'), 'dawdaw');
        
		$this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view("admin/layout/v_nav",$data);
		$this->load->view("admin/dashboard/v_home",$data);
		$this->load->view("admin/layout/v_footer");
				
    }
    
    public function getGridEfficiency()
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

        $data['nilaiinventorygridefficiency'] = $this->M_inventoryefficiency->getinventorygrid(date('M Y'), 'dawdaw');

    
        $data['title'] = 'Grid Efficiency';
        echo json_encode($data);
    }

    public function getItemEfficiency()
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

        $data['nilaiinventoryskuefficiency'] = $this->M_inventoryefficiency->getinventorysku(date('M Y'), 'dawdaw');

    
        $data['title'] = 'Item Efficiancy';
        echo json_encode($data);
    }
    
    public function getDayList($parameter = null)
    {
        if(!isset($parameter))
        {
            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');
            $date = $first_day_this_month;
            $end = $last_day_this_month;
        }
        else
        {
            $first_day_this_month = date('Y-m-01', strtotime($parameter)); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t', strtotime($parameter));
            $date = $first_day_this_month;
            $end = $last_day_this_month;
        }
        
        $days = [];
        while(strtotime($date) <= strtotime($end)) {
            $day_num = date('Y-m-d', strtotime($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $days[] = $day_num;
        }
        // echo $_POST["date"];die;

        return $days;
    }

    public function getLastWeek()
    {
        $date         = $this->input->post('date');
        $now = new DateTime( "7 days ago", new DateTimeZone('America/New_York'));
        $interval = new DateInterval( 'P1D'); // 1 Day interval
        $period = new DatePeriod( $now, $interval, 7); // 7 Days
        
        $days = array();
        foreach( $period as $day) {
            $key = $day->format( 'm-d-Y');
            $days[] = $key;
        }
        // echo $_POST["date"];die;

        return $days;
    }

    public function getHourList(){
        $hours = [];
        for($i = 0; $i <= 23; $i++):
            $hours[] = "Hour".' '.date("H", strtotime("$i:00"));
        endfor;
        return $hours;
    }

    public function getCompletionList(){
        $completionlist = ['Complete','Not Complete'];
        return $completionlist;
    }

	public function set_loc()
    {
        // echo json_encode($_POST['loc']);
        $loc_id 		= str_replace('"', '', json_encode($_POST['loc_id']));
        $loc_name 		= str_replace('"', '', json_encode($_POST['loc_name']));
      //  $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
       // $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
       // $this->session->set_userdata('program_id', $program_id);
       // $this->session->set_userdata('program_name', $program_name);
        $this->session->set_userdata('location_id', $loc_id);
        $this->session->set_userdata('location_name', $loc_name);
        foreach($this->session->userdata('list_location') as $list_location)
        {
            if($list_location->loc_id == $_POST['loc_id'])
            {
                $this->session->set_userdata('program_id', $list_location->client[0]->c_id);
                break;
            }
        }
        //add the header here
        header('Content-Type: application/json');
        echo json_encode(  $loc_id  );
    }

    public function set_prog()
    {
        // echo json_encode($_POST['loc']);
        $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
        $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
        $this->session->set_userdata('program_id', $program_id);
        $this->session->set_userdata('program_name', $program_name);

        //add the header here
        header('Content-Type: application/json');
        echo json_encode(  $program_id  );
    }

    public function homeSummary()
	{
		//$date_from = $_POST["date_from"];
		//$date_to = $_POST["date_to"];
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

        $all_client         = $this->input->post('all_client');
        $client             = $this->input->post('client');
        $all_location       = $this->input->post('all_location');
        $location           = $this->input->post('location');
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

        $choose_program = "";
		if($_POST["view_based_at"] == 'client'){
            $choose_program = " AND program_id = '$program_id'";
            $ctn            = " sum(ctn) as ctn";
            $groupby            = " GROUP BY stat";
        }
		else{
            $choose_program = "";
            $ctn            = " ctn";
            $groupby            = " ";
        }
		
		
		$choose_location = "";
		if($_POST["view_based_in"] == 'location'){
            $choose_location = " AND location_id = '$location_id'";
            $ctn            = " sum(ctn) as ctn";
            $groupby            = " GROUP BY stat";
        }
		else{
            $choose_location = "";
            $ctn            = " ctn";
            $groupby            = " ";
        }
		
		$date_from       = $this->input->post('date_from');
        $date_to         = $this->input->post('date_to');
        // echo $date_from; die;
		if($date_from != "" && $date_to != "")
		{
			$str_po = " AND DATE(summary_created_date) >= '$date_from' AND DATE(summary_created_date) <= '$date_to' ";
			$str_so = " AND DATE(order_created_date) >= '$date_from'AND DATE(order_created_date) <= '$date_to' ";
		}
		
		if($date_from != "" && $date_to == "")
		{
			$str_po = " AND DATE(summary_created_date) >= '$date_from' AND DATE(summary_created_date) <= DATE(NOW()) ";
			$str_so = " AND DATE(order_created_date) >= '$date_from' AND DATE(order_created_date) <= DATE(NOW()) ";
		}
		
		if($date_from == "" && $date_to != "")
		{
			$str_po = " AND DATE(summary_created_date) <= DATE(NOW()) ";
			$str_so = " AND DATE(order_created_date) <= DATE(NOW()) ";
		}
		
		if($date_from == "" && $date_to == "")
		{
			$str_po = " AND DATE(summary_created_date) >= DATE(NOW()) AND DATE(summary_created_date) <= DATE(NOW()) ";
			$str_so = " AND DATE(order_created_date) >= DATE(NOW()) AND DATE(order_created_date) <= DATE(NOW()) ";
		}
		
		$total_PLTtotal = 0; 
		$total_PLInbound = 0; 
        $total_PLInventory = 0; 
        $total_PLFinish = 0;

		$sql_stat1       = "SELECT 
                                COALESCE (NULL, sum(total) , 0) as total,
								COALESCE (NULL, sum(received) , 0) as received,
								COALESCE (NULL, sum(putaway) , 0) as putaway
							FROM purchasesummary
							WHERE 1=1 
                            $choose_location
							$choose_program
							$str_po
							";
        // echo $sql_stat1;die;
        $dataProvider  =  $this->db->query($sql_stat1)->result();

		foreach($dataProvider as $ii)
		{
			$total_PLTtotal = $ii->total;
			$total_PLInbound = $ii->received;
			$total_PLInventory = $ii->putaway;
		}

		$sql_stat2       = " 	SELECT 
                                        COALESCE (NULL, sum(finish) , 0) as finish
									FROM purchasesummary
									WHERE 1=1 
									AND status_code = 'PL_FINISH'
									$choose_location
							        $choose_program
									$str_po
								";
        // echo $total_PLFinish;die;
        $dataProvider  =  $this->db->query($sql_stat2)->result();
        foreach($dataProvider as $ii)
		{
			$total_PLFinish = $ii->finish;
		}
		
		$total_OrderPending = 0;
		$total_OrderComplete = 0;
		$total_OrderPrinted = 0;
		$total_OrderAssign = 0;
		$total_OrderPicked = 0;
		$total_OrderChecked = 0;
		$total_OrderPacked = 0;
		$total_OrderStandby = 0;
		$total_OrderShipped = 0;
		$total_OrderDelivered = 0;
		$total_OrderReturned = 0;
		$total_OrderTotal = 0;

		$stats       = " 	SELECT
									stat,
									$ctn
							FROM ordersummary 
							WHERE 1=1  
							$choose_location
							$choose_program
							$str_so
							AND stat IN ('ORD_PENDING', 'ORD_COMPLETE', 'ORD_PRINTED', 'ORD_ASSIGN', 'ORD_OUTBOUND', 'ORD_CHECKED', 
							'ORD_PACKED', 'ORD_STANDBY', 'ORD_DELIVERY', 'ORD_RECEIVED', 'ORD_RETURNED' 
							) 
                            $groupby
								";
        // echo $stats;die;
        $dataProvider  =  $this->db->query($stats)->result();
		
		foreach($dataProvider as $ii)
		{
			if($ii->stat == "ORD_PENDING")
				$total_OrderPending = $ii->ctn;
			if($ii->stat == "ORD_COMPLETE")
				$total_OrderComplete = $ii->ctn;
			if($ii->stat == "ORD_PRINTED")
				$total_OrderPrinted = $ii->ctn;
			if($ii->stat == "ORD_ASSIGN")
				$total_OrderAssign = $ii->ctn;
			if($ii->stat == "ORD_OUTBOUND")
				$total_OrderPicked = $ii->ctn;
			if($ii->stat == "ORD_CHECKED")
				$total_OrderChecked = $ii->ctn;
			if($ii->stat == "ORD_PACKED")
				$total_OrderPacked = $ii->ctn;
			if($ii->stat == "ORD_STANDBY")
				$total_OrderStandby = $ii->ctn;
			if($ii->stat == "ORD_DELIVERY")
				$total_OrderShipped = $ii->ctn;
			if($ii->stat == "ORD_RECEIVED")
				$total_OrderDelivered = $ii->ctn;
			if($ii->stat == "ORD_RETURNED")
				$total_OrderReturned = $ii->ctn;
			
			$total_OrderTotal += $ii->ctn;
		}
		
		$summs = array(
			'pl_total' => $total_PLTtotal, 
			'pl_inbound' => $total_PLInbound, 
			'pl_inventory' => $total_PLInventory, 
			'pl_finish' => $total_PLFinish,
			'ord_total' => $total_OrderTotal,
			'ord_pending' => $total_OrderPending,
			'ord_complete' => $total_OrderComplete,
			'ord_printed' => $total_OrderPrinted,
			'ord_assign' => $total_OrderAssign,
			'ord_picked' => $total_OrderPicked,
			'ord_checked' => $total_OrderChecked,
			'ord_packed' => $total_OrderPacked,
			'ord_standby' => $total_OrderStandby,
			'ord_shipped' => $total_OrderShipped,
			'ord_delivered' => $total_OrderDelivered,
			'ord_returned' => $total_OrderReturned
		);
		
		echo json_encode($summs);
		return;
    }
    
}