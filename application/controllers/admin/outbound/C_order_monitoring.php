<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_order_monitoring extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("charts/M_performanceperday");
        $this->load->model("charts/M_performanceperday_opr");
        $this->load->model("charts/M_slamitratokped");
        $this->load->model("charts/M_ordermonitoring");
        $this->load->model("charts/M_inventoryefficiency");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	//Halaman Dashboard
	public function index()
	{
		$data['title'] = "Dashboard Management System";

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
        
		$data['navlocation']          = $this->M_nav->getNav();
		$data['nilaidailymonitoring'] = $this->M_ordermonitoring->getordermonitoring(date('M Y'), 'dawdaw');
		$data['dayList']              = $this->getDayList();
        

		$this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view("admin/layout/v_nav",$data);
		$this->load->view("admin/dashboard/outbound/v_order_monitoring",$data);
		$this->load->view("admin/layout/v_footer");
				
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

    public function getOrderMonitoringDayLabel(){
        $monitoringdaylabel = ['Pending Order D+N','Pending Order D-1 After 4 PM', 'Pending Order Before 4 PM', 'Pending Order After 4 PM', 'Order Packed', 'RTS Complete','Shipping Complete','Cancel'];
        return $monitoringdaylabel;
    }

    public function getOrderMonitoringDayLabelOpr(){
        $monitoringdaylabel = ['Pending Order Before 4 PM', 'Order Packed', 'RTS Complete','Shipping Complete','Cancel'];
        return $monitoringdaylabel;
    }

    public function getOperationLeadLabel(){
        $operationlabellist = ['AVG LT RTS','AVG LT Packed', 'AVG LT Picker & Checker', 'AVG LT ATP', 'AVG LT Printed'];
        return $operationlabellist;
    }

    public function getAllClient()
    {
        
        $date         = $this->input->post('all_date', null);
        $allclient       = $this->input->post('allclient', null);
        $dayList = (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList());
        $hourList = $this->getHourList();
        $completionList = $this->getCompletionList();
        $monitoringDayList = $this->getOrderMonitoringDayLabel();
        $operationlabellist = $this->getOperationLeadLabel();
        $orderdata = $this->M_performanceperday->getordernumber($date,$allclient);
        $qtydata = $this->M_performanceperday->getitemqty($date,$allclient);
        $sladata = $this->M_performanceperday->getsla($date,$allclient);
        $ordermonitoringday = $this->M_performanceperday->getordermonitoringperday($date,$allclient);
        $orderperhour = $this->M_performanceperday->getorderperhour($date,$allclient);
        $itemqtyperhour = $this->M_performanceperday->getitemqtyperhour($date,$allclient);
        $completionperdayblue = $this->M_performanceperday->getordercompletionperhourblue($date,$allclient);
        $completionperdayellow = $this->M_performanceperday->getordercompletionperhouryellow($date,$allclient);
        $nilaioperationleadtime = $this->M_performanceperday->getOperationLeadTime($date,$allclient);

        $dailyorder_chart = [];
        $itemqty_chart = [];
        $sla_chart = [];
        foreach ($dayList as $key => $day) {
            $dailyorder_chart[$key] = 0;
            $itemqty_chart[$key] = 0;
            $sla_chart[$key] = 0;
        
            foreach ($orderdata as $isiorder ) {
                if ($isiorder->order_created_date == $day) {
                    $dailyorder_chart[$key] = intval($isiorder->nilai);
                }
            }
            foreach ($sladata as $isisla ) {
                if ($isisla->order_created_date == $day) {
                    $sla_chart[$key] = floatval($isisla->percentace_achievement);
                }
            }
            foreach ($qtydata as $isiitemqty ) {
                if ($isiitemqty->order_created_date == $day) {
                    $itemqty_chart[$key] = intval($isiitemqty->itemqty);
                }
            }
        }
        $ordermonitoringperday_chart = [];
        // $ordermonitoringperday_label = [];
        foreach ($monitoringDayList as $mdkey => $label) {
            $ordermonitoringperday_chart[$mdkey] = 0;
            foreach ($ordermonitoringday as $isiom ) {
                if ($isiom->status == $label) {
                    $ordermonitoringperday_chart[$mdkey] = intval($isiom->nilai);
                }
            }
        }
        $dailyorderhour_chart = [];
        $itemqtyhour_chart = [];
        foreach ($hourList as $hrkey => $hour) {
            $dailyorderhour_chart[$hrkey] = 0;
            $itemqtyhour_chart[$hrkey] = 0;
            foreach ($orderperhour as $isiorderhour ) {
                if ($isiorderhour->jam == $hour) {
                    $dailyorderhour_chart[$hrkey] = intval($isiorderhour->nilai);
                }
            }
        }
        foreach ($hourList as $hrkey => $hour) {
            foreach ($itemqtyperhour as $isiitemqtyhour ) {
                if ($isiitemqtyhour->jam == $hour) {
                    $itemqtyhour_chart[$hrkey] = intval($isiitemqtyhour->itemqty);
                }
            }
        }
        
        $completionperdayblue_chart = 0;
        $completionperdayyellow_chart = 0;
        foreach ($completionperdayblue as $isiblue ) {
                $completionperdayblue_chart = intval($isiblue->nilai);
        }
        foreach ($completionperdayellow as $isiyellow ) {
                $completionperdayyellow_chart = intval($isiyellow->nilai);
        }

        $nilaioperationleadtime_chart = [];
        // $nilaioperationleadtime_label = [];
        foreach ($operationlabellist as $oplkey => $labelopl) {
            $nilaioperationleadtime_chart[$oplkey] = 0;
            // $nilaioperationleadtime_label[$oplkey] = 0;
            foreach ($nilaioperationleadtime as $isiopl ) {
                if ($isiopl->status == $labelopl) {
                    // $nilaioperationleadtime_chart[$oplkey] = date('H:i', strtotime($isiopl->avg)); 
                    $nilaioperationleadtime_chart[$oplkey] = $isiopl->avg; 
                }
            }
        }
        // echo json_encode($nilaioperationleadtime_chart); die;
        echo json_encode([
            'date' => (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList()),
            'nilaiorder' => $dailyorder_chart,
            'nilaisla' => $sla_chart,
            'nilaiqty' => $itemqty_chart,
            'nilaiordermonitoringperday' => $ordermonitoringperday_chart,
            'labelordermonitoringperday' => $this->getOrderMonitoringDayLabel(),
            'hour' => $this->getHourList(),
            'orderperhour' => $dailyorderhour_chart,
            'itemqtyperhour' => $itemqtyhour_chart,
            'completionlist' => $this->getCompletionList(),
            'completionblue' => $completionperdayblue_chart,
            'completionyellow' => $completionperdayyellow_chart,
            'nilaioperationleadtime' => $nilaioperationleadtime_chart,
            'operationlabel' => $this->getOperationLeadLabel()
        ]);
        
    }

    public function getAllClientOpr()
    {
        
        $date         = $this->input->post('all_date', null);
        $allclient       = $this->input->post('allclient', null);
        $dayList = (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList());
        $hourList = $this->getHourList();
        $completionList = $this->getCompletionList();
        $monitoringDayList = $this->getOrderMonitoringDayLabelOpr();
        $operationlabellist = $this->getOperationLeadLabel();
        $ordermonitoringday = $this->M_performanceperday_opr->getordermonitoringperday($date,$allclient);
        $completionperdayblue = $this->M_performanceperday_opr->getordercompletionperhourblue($date,$allclient);
        $completionperdayellow = $this->M_performanceperday_opr->getordercompletionperhouryellow($date,$allclient);
        $nilaioperationleadtime = $this->M_performanceperday_opr->getOperationLeadTime($date,$allclient);

        $ordermonitoringperday_chart = [];
        // $ordermonitoringperday_label = [];
        foreach ($monitoringDayList as $mdkey => $label) {
            $ordermonitoringperday_chart[$mdkey] = 0;
            foreach ($ordermonitoringday as $isiom ) {
                if ($isiom->status == $label) {
                    $ordermonitoringperday_chart[$mdkey] = intval($isiom->nilai);
                }
            }
        }
        
        $completionperdayblue_chart = 0;
        $completionperdayyellow_chart = 0;
        foreach ($completionperdayblue as $isiblue ) {
                $completionperdayblue_chart = intval($isiblue->nilai);
        }
        foreach ($completionperdayellow as $isiyellow ) {
                $completionperdayyellow_chart = intval($isiyellow->nilai);
        }

        $nilaioperationleadtime_chart = [];
        // $nilaioperationleadtime_label = [];
        foreach ($operationlabellist as $oplkey => $labelopl) {
            $nilaioperationleadtime_chart[$oplkey] = 0;
            // $nilaioperationleadtime_label[$oplkey] = 0;
            foreach ($nilaioperationleadtime as $isiopl ) {
                if ($isiopl->status == $labelopl) {
                    // $nilaioperationleadtime_chart[$oplkey] = date('H:i', strtotime($isiopl->avg)); 
                    $nilaioperationleadtime_chart[$oplkey] = $isiopl->avg; 
                }
            }
        }
        // echo json_encode($nilaioperationleadtime_chart); die;
        echo json_encode([
            'date' => (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList()),
            'nilaiordermonitoringperday' => $ordermonitoringperday_chart,
            'labelordermonitoringperday' => $this->getOrderMonitoringDayLabel(),
            'hour' => $this->getHourList(),
            'completionlist' => $this->getCompletionList(),
            'completionblue' => $completionperdayblue_chart,
            'completionyellow' => $completionperdayyellow_chart,
            'nilaioperationleadtime' => $nilaioperationleadtime_chart,
            'operationlabel' => $this->getOperationLeadLabel()
        ]);
        
    }

    public function getAllClientSlaMitraTokped()
    {
        
        $date         = $this->input->post('all_date', null);
        $allclient       = $this->input->post('allclient', null);
        $dayList = (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList());
        $hourList = $this->getHourList();
        $completionList = $this->getCompletionList();
        $monitoringDayList = $this->getOrderMonitoringDayLabel();
        $operationlabellist = $this->getOperationLeadLabel();
        $orderdata = $this->M_slamitratokped->getorder($date,$allclient);
        $qtydata = $this->M_slamitratokped->getitemqty($date,$allclient);
        $sladata = $this->M_slamitratokped->getsla($date,$allclient);

        $dailyorder_chart = [];
        $itemqty_chart = [];
        $sla_chart = [];
        foreach ($dayList as $key => $day) {
            $dailyorder_chart[$key] = 0;
            $itemqty_chart[$key] = 0;
            $sla_chart[$key] = 0;
        
            foreach ($orderdata as $isiorder ) {
                if ($isiorder->order_created_date == $day) {
                    $dailyorder_chart[$key] = intval($isiorder->nilai);
                }
            }
            foreach ($sladata as $isisla ) {
                if ($isisla->order_created_date == $day) {
                    $sla_chart[$key] = floatval($isisla->percentace_achievement);
                }
            }
            foreach ($qtydata as $isiitemqty ) {
                if ($isiitemqty->order_created_date == $day) {
                    $itemqty_chart[$key] = intval($isiitemqty->itemqty);
                }
            }
        }
        
        // echo json_encode($nilaioperationleadtime_chart); die;
        echo json_encode([
            'date' => (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList()),
            'nilaiorder' => $dailyorder_chart,
            'nilaisla' => $sla_chart,
            'nilaiqty' => $itemqty_chart
        ]);
        
    }

    public function getAllMonitoringClient()
    {
        $date         = $this->input->post('date');
        $allclient       = $this->input->post('view_client_all');
        $nilaidailymonitoring = $this->M_ordermonitoring->getordermonitoring($date, $allclient);

        echo json_encode(['nilaidailymonitoring' => $nilaidailymonitoring]);
        
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
}