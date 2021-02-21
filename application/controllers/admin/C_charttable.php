<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_charttable extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("charts/M_charttable");
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
        $allclient       = $this->input->post('view_client_all');
        $data['nilaipendingbefore4pm'] 		                    = $this->M_charttable->getpendingbefore4pm($allclient);
        $data['nilaipendingafter4pm'] 		                    = $this->M_charttable->getpendingafter4pm($allclient);
        $data['nilaipendingdplusn'] 		                    = $this->M_charttable->getpendingdplusn($allclient);
        
		$data['title'] = 'Chart Value Download';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_charttable',$data);
        $this->load->view('admin/layout/v_footer');
        
    }

    public function getAllPendingClient()
    {
        $allclient       = $this->input->post('view_client_all');
        $nilaipendingbefore4pm = $this->M_charttable->getpendingbefore4pm($allclient);

        echo json_encode(['nilaipendingbefore4pm' => $nilaipendingbefore4pm]);
        
    }

        // Export ke excel
        public function exportpendingbefore4pm()
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
    
            $file_name = "pending_before4pm_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");
    
            $purchase_code    = $this->input->post('purchase_code');
            if(!empty($purchase_code))
            {
                $p_code = "AND purchase_code = '$purchase_code'";
            }
            else
            {
                $p_code = "";
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
            
            $pendingbefore4pm       = "  SELECT        
                                    location_name,
                                    program_name,
                                    order_code,
                                    status,
                                    courier_name,
                                    date(order_created_date) as order_created_date,
                                    jam,
                                    remaining_hour_before4pm
                                FROM pendingorder
                                WHERE 1=1
                                AND location_id = $location_id
                                AND TO_CHAR( order_created_date, 'YYYY-mm-dd HH24:MI:SS' ) BETWEEN to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 00:00:00' ) 
                                AND to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 15:59:59' )
                                ";
            // echo $pendingbefore4pm;die;
    
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // get data 
            $downloadpendingbefore4pm     =  $this->db->query($pendingbefore4pm)->result_array();
            // $usersData = $this->Main_model->getUserDetails();
    
            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array(
                            "Location Name",
                            "Client Name",
                            "Order Code",
                            "Status",
                            "Courier",
                            "Created Date",
                            "Hour",
                            "Remeining Hour"
                        ); 
            fputcsv($file, $header);
            foreach ($downloadpendingbefore4pm as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }

        public function exportpendingafter4pm()
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
    
            $file_name = "pending_before4pm_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");
    
            $purchase_code    = $this->input->post('purchase_code');
            if(!empty($purchase_code))
            {
                $p_code = "AND purchase_code = '$purchase_code'";
            }
            else
            {
                $p_code = "";
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
            
            $pendingbefore4pm       = "  SELECT        
                                    location_name,
                                    program_name,
                                    order_code,
                                    status,
                                    courier_name,
                                    date(order_created_date) as order_created_date,
                                    jam,
                                    remaining_hour_after4pm
                                FROM pendingorder
                                WHERE 1=1
                                AND location_id = $location_id
                                AND TO_CHAR( order_created_date, 'YYYY-mm-dd HH24:MI:SS' ) BETWEEN to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 16:00:00' ) 
                                AND to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 23:59:59' )
                                ";
            // echo $pendingbefore4pm;die;
    
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // get data 
            $downloadpendingbefore4pm     =  $this->db->query($pendingbefore4pm)->result_array();
            // $usersData = $this->Main_model->getUserDetails();
    
            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array(
                            "Location Name",
                            "Client Name",
                            "Order Code",
                            "Status",
                            "Courier",
                            "Created Date",
                            "Hour",
                            "Remeining Hour"
                        ); 
            fputcsv($file, $header);
            foreach ($downloadpendingbefore4pm as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }

        public function exportpendingorderdplusn()
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
    
            $file_name = "pending_order_d+n_".strtolower(str_replace(' ', '_', $location_name))."_".date("Ymd")."_".date("His");
    
            $purchase_code    = $this->input->post('purchase_code');
            if(!empty($purchase_code))
            {
                $p_code = "AND purchase_code = '$purchase_code'";
            }
            else
            {
                $p_code = "";
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
            
            $pendingdplusn       = "  SELECT        
                                    location_name,
                                    program_name,
                                    order_code,
                                    status,
                                    courier_name,
                                    date(order_created_date) as order_created_date,
                                    jam
                                FROM pendingorder
                                WHERE 1=1
                                AND location_id = $location_id
                                AND TO_CHAR(order_created_date :: DATE, 'YYYY-MM-DD HH24:MI:SS') <= to_char( NOW() - INTERVAL '1' Day, 'YYYY-MM-DD 15:59:59' )
                                ";
            // echo $pendingdplusn;die;
    
            header("Content-Description: File Transfer"); 
            header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
            header("Content-Type: application/csv; ");
            
            // get data 
            $downloadpendingdplusn     =  $this->db->query($pendingdplusn)->result_array();
            // $usersData = $this->Main_model->getUserDetails();
    
            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array(
                            "Location Name",
                            "Client Name",
                            "Order Code",
                            "Status",
                            "Courier",
                            "Created Date",
                            "Hour"
                        ); 
            fputcsv($file, $header);
            foreach ($downloadpendingdplusn as $row){ 
                fputcsv($file,$row);
            }
            fclose($file); 
            exit;
        }

}

/* End of file C_performance.php */
/* Location: ./application/controllers/admin/C_performance.php */