<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_outbound_aging extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("outbound/M_outbound_aging");
    }

	public function index()
	{
        if(!($this->session->has_userdata('users_id'))){
            redirect(base_url());
        }

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
        
        $queryoutboundaging = array();
        $queryoutboundaging[] = array(
            "program_name" => "Please Reload!",
            "order_code"   => "None",
            "last_status"  => "-",
            "color"        => "",
            "rtp_date"     => "-",
            "rtp_time"     => "",
            "age"          => "0"
        );

        $data['queryoutboundaging']    = json_decode(json_encode($queryoutboundaging));
    
        $data['title'] = 'Performance';

        // echo json_encode($data);exit();
        $this->load->view('admin/layout/v_head',$data);
        $this->load->view('admin/layout/v_header');
        $this->load->view('admin/layout/v_nav',$data);
        $this->load->view('admin/dashboard/outbound/v_outbound_aging',$data);
        $this->load->view('admin/layout/v_footer');
    }

    public function getOutboundAging()
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
        
        $data['queryoutboundaging']    = $this->M_outbound_aging->OutboundAging(date('M Y'));
    
        $data['title'] = 'Outbound Aging';
        echo json_encode($data);
    }

    // Export ke excel
    public function download_outbound_aging()
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

        $file_name = "outbound_aging_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");

        $outboundaging       = "     SELECT 
									id, 
		                            program_name, 
		                            order_code, 
		                            last_status, 
		                            rtp_date, 
		                            rtp_time, 
		                            age 
								FROM outboundaging 
								WHERE location_id = $location_id
								ORDER BY rtp_date";
        // echo $sql_prof;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $outboundagingdownload     =  $this->db->query($outboundaging)->result_array();
        // echo $result_array;die;

        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("CLIENT",
                        "ORDER",
                        "Purchase Status",
                        "STATUS",
                        "DATE",
                        "TIME",
                        "AGE"
                    ); 
        fputcsv($file, $header);
        foreach ($outboundagingdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }
}

/* End of file C_performance.php */
/* Location: ./application/controllers/admin/C_performance.php */