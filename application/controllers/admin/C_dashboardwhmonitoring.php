<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboardwhmonitoring extends CI_Controller {

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
    }

	public function index()
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

		$data['title'] = 'Dashboard Management System';
		$this->load->view('admin/layout/v_head',$data);
		// $this->load->view('admin/layout/v_header');
		// $this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_dashboardwhmonitoring',$data);
        // $this->load->view('admin/layout/v_footer');

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

    
    public function getOperationLeadLabel(){
        $operationlabellist = ['AVG LT RTS','AVG LT Packed', 'AVG LT Picker & Checker', 'AVG LT ATP', 'AVG LT Printed'];
        return $operationlabellist;
    }

    public function getAllClient()
    {
        
        $date         = $this->input->post('all_date', null);
        $allclient       = $this->input->post('allclient', null);
        $hourList = $this->getHourList();
        $completionList = $this->getCompletionList();
        $monitoringDayList = $this->getOrderMonitoringDayLabel();
        $operationlabellist = $this->getOperationLeadLabel();
        $ordermonitoringday = $this->M_performanceperday->getordermonitoringperday($date,$allclient);
        $orderperhour = $this->M_performanceperday->getorderperhour($date,$allclient);
        $itemqtyperhour = $this->M_performanceperday->getitemqtyperhour($date,$allclient);
        $completionperdayblue = $this->M_performanceperday->getordercompletionperhourblue($date,$allclient);
        $completionperdayellow = $this->M_performanceperday->getordercompletionperhouryellow($date,$allclient);
        $nilaioperationleadtime = $this->M_performanceperday->getOperationLeadTime($date,$allclient);

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
            // 'date' => (isset($_POST['date']) ? $this->getDayList($_POST['date']): $this->getDayList()),
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

}

/* End of file C_performance.php */
/* Location: ./application/controllers/admin/C_performance.php */