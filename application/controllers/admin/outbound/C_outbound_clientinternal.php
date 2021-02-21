<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_outbound_clientinternal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("outbound/M_outbound_clientinternal");
    }

	public function index()
	{
        if(!($this->session->has_userdata('users_id'))){
            redirect(base_url());
        }
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

        $nilaiqueryslatopclient = array();
        $nilaiqueryslatopclient[] = array(
            "program_name"  => "Please Reload!",
            "location_name" => "None",
            "ach_packed"    => "-",
            "color_packed"  => "",
            "ach_rts"       => "-",
            "color_rts"     => ""
        );

        $nilaiquerysladaytopclient = array();
        $nilaiquerysladaytopclient[] = array(
            "program_name"         => "Please Reload!",
            "location_id"          => "",
            "location_name"        => "NONE",
            "order_created_date_1" => "2040-01-14",
            "packed_1"             => "-",
            "color_packed_1"       => "",
            "rts_1"                => "-",
            "color_rts_1"          => "",
            "order_created_date_2" => "2040-01-15",
            "packed_2"             => "-",
            "color_packed_2"       => "",
            "rts_2"                => "-",
            "color_rts_2"          => "",
            "order_created_date_3" => "2040-01-16",
            "packed_3"             => "-",
            "color_packed_3"       => "",
            "rts_3"                => "-",
            "color_rts_3"          => "",
            "order_created_date_4" => "2040-01-17",
            "packed_4"             => "-",
            "color_packed_4"       => "",
            "rts_4"                => "-",
            "color_rts_4"          => "",
            "order_created_date_5" => "2040-01-18",
            "packed_5"             => "-",
            "color_packed_5"       => "",
            "rts_5"                => "-",
            "color_rts_5"          => "",
            "order_created_date_6" => "2040-01-19",
            "packed_6"             => "-",
            "color_packed_6"       => "",
            "rts_6"                => "-",
            "color_rts_6"          => "",
            "order_created_date_7" => "2040-01-20",
            "packed_7"             => "-",
            "color_packed_7"       => "",
            "rts_7"                => "-",
            "color_rts_7"          => ""
        );

        $data['nilaiqueryslatopclient']    = json_decode(json_encode($nilaiqueryslatopclient));
        $data['nilaiquerysladaytopclient'] = json_decode(json_encode($nilaiquerysladaytopclient));
        
        // $data['nilaiqueryslatopclient']    = $this->M_outbound_clientinternal->getslaweekclient(date('M Y'));
        // $data['nilaiquerysladaytopclient'] = $this->M_outbound_clientinternal->getsladayclient(date('M Y'));

		$data['title'] = 'Performance';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/outbound/v_outbound_clientinternal',$data);
        $this->load->view('admin/layout/v_footer');

    }

    public function getAllslaTopClient()
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
        
        $data['nilaiqueryslatopclient']    = $this->M_outbound_clientinternal->getslaweekclient(date('M Y'));
    
        $data['title'] = 'Performance';
        echo json_encode($data);
    }

    public function getAllslaDayTopClient()
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
        
        $data['nilaiquerysladaytopclient'] = $this->M_outbound_clientinternal->getsladayclient(date('M Y'));
    
        $data['title'] = 'Performance';
        echo json_encode($data);
    }
    
    public function getSlaTopClient()
    {
        $date              = $this->input->post('date');
        $allclient         = $this->input->post('view_client_all');
        $nilaislatopclient = $this->M_outbound_clientinternal->getslatopclient($date, $allclient);

        echo json_encode(['nilaislatopclient' => $nilaislatopclient]);
        
    }

    public function downloadordertokcab($location_id,$periode)
    {
        $file_name = "order_tokocabang_".date("Ymd")."_".date("His");

        $dataslaorder = "SELECT * FROM (SELECT a.location_name, 
                                a.program_name, 
                                a.order_code,
                                a.total_qty, 
                                a.courier_name, 
                                a.last_status,
                                a.order_created_date, 
                                a.ready_to_pick_date, 
                                a.packed_date,
                                b.ready_to_shipped_date,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and a.packed_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and a.packed_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_packed,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and b.ready_to_shipped_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and b.ready_to_shipped_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_rts
                                from outboundperformance a 
                                    left join shipmentperformance b on a.order_code = b.order_code and b.last_status in ('Ready To Shipped','Shipped','Delivered')
                                WHERE a.last_status in  ('Packed','Ready To Shipped','Shipped','Delivered')
                                AND date(a.order_created_date) = '".$periode."' and a.location_id = '".$location_id."'
                                order by order_created_date) as datasla where datasla.sla_packed = 'not' or datasla.sla_rts = 'not' ";

        //$filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");

        $ordersladownload     =  $this->db->query($dataslaorder)->result_array();

        $file = fopen('php://output', 'w');

        $header = array("Location Name",
                                "Client Name",
                                "Order Code",
                                "Item Qty",
                                "Courier Name",
                                "Last Status",
                                "Created Date",
                                "Ready To Picked Date",
                                "Packed Date",
                                "RTS Date",
                                "Sla Packed",
                                "Sla RTS",
                            ); 
        fputcsv($file, $header);

        foreach ($ordersladownload as $row){ 
                    fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }

    public function downloadorderheraclient($program_id,$location_id,$periode)
    {
        $file_name = "order_heraclient_".date("Ymd")."_".date("His");

        $dataslaorder = "SELECT * FROM (SELECT a.location_name, 
                                a.program_name, 
                                a.order_code,
                                a.total_qty, 
                                a.courier_name, 
                                a.last_status,
                                a.order_created_date, 
                                a.ready_to_pick_date, 
                                a.packed_date,
                                b.ready_to_shipped_date,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and a.packed_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and a.packed_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_packed,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and b.ready_to_shipped_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and b.ready_to_shipped_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_rts
                                from outboundperformance a 
                                    left join shipmentperformance b on a.order_code = b.order_code and b.last_status in ('Ready To Shipped','Shipped','Delivered')
                                WHERE a.last_status in  ('Packed','Ready To Shipped','Shipped','Delivered')
                                AND date(a.order_created_date) = '".$periode."' and a.location_id = '".$location_id."' AND a.program_id = '".$program_id."'
                                order by order_created_date) as datasla where datasla.sla_packed = 'not' or datasla.sla_rts = 'not' ";

        //$filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");

        $ordersladownload     =  $this->db->query($dataslaorder)->result_array();

        $file = fopen('php://output', 'w');

        $header = array("Location Name",
                                "Client Name",
                                "Order Code",
                                "Item Qty",
                                "Courier Name",
                                "Last Status",
                                "Created Date",
                                "Ready To Picked Date",
                                "Packed Date",
                                "RTS Date",
                                "SLA Packed",
                                "SLA RTS"
                            ); 
        fputcsv($file, $header);

        foreach ($ordersladownload as $row){ 
                    fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }

    public function downloadordertopclient($program_id,$location_id,$periode)
    {
        $file_name = "order_topclient_".date("Ymd")."_".date("His");

        $dataslaorder = "SELECT * FROM (SELECT a.location_name, 
                                a.program_name, 
                                a.order_code,
                                a.total_qty, 
                                a.courier_name, 
                                a.last_status,
                                a.order_created_date, 
                                a.ready_to_pick_date, 
                                a.packed_date,
                                b.ready_to_shipped_date,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and a.packed_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and a.packed_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_packed,
                                case when cast(a.ready_to_pick_date::timestamp as time) <= '16:00:00' and b.ready_to_shipped_date <= cast(concat(date(a.ready_to_pick_date),' 23:59:59')::timestamp as timestamp) then 'Achieve' 
                                when cast(a.ready_to_pick_date::timestamp as time) > '16:00:00' and b.ready_to_shipped_date <= a.ready_to_pick_date + interval '20 Hour' then 'Achieve' 
                                else 'not' end sla_rts
                                from outboundperformance a 
                                    left join shipmentperformance b on a.order_code = b.order_code and b.last_status in ('Ready To Shipped','Shipped','Delivered')
                                WHERE a.last_status in  ('Packed','Ready To Shipped','Shipped','Delivered')
                                AND date(a.order_created_date) = '".$periode."' and a.location_id = '".$location_id."' AND a.program_id = '".$program_id."'
                                order by order_created_date) as datasla where datasla.sla_packed = 'not' or datasla.sla_rts = 'not' ";

        //$filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");

        $ordersladownload     =  $this->db->query($dataslaorder)->result_array();

        $file = fopen('php://output', 'w');

        $header = array("Location Name",
                                "Client Name",
                                "Order Code",
                                "Item Qty",
                                "Courier Name",
                                "Last Status",
                                "Created Date",
                                "Ready To Picked Date",
                                "Packed Date",
                                "RTS Date",
                                "SLA Packed",
                                "SLA RTS",
                            ); 
        fputcsv($file, $header);

        foreach ($ordersladownload as $row){ 
                    fputcsv($file,$row);
        }
        fclose($file); 
        exit;
    }

}

/* End of file C_performance.php */
/* Location: ./application/controllers/admin/C_performance.php */