<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inbound extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("charts/M_slatopclient");
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
        
        $data['nilaislatokocabang'] 		                            = $this->M_slatopclient->getslaweektokocabang(date('M Y'), 'dawdaw');
        $data['nilaislaweekhera'] 		                            = $this->M_slatopclient->getslaweekhera(date('M Y'), 'dawdaw');
        $data['nilaislaweekindomall'] 		                            = $this->M_slatopclient->getslaweekindomall(date('M Y'), 'dawdaw');
        $data['nilaiqueryslatopclient'] 		                            = $this->M_slatopclient->getslaweekclient(date('M Y'), 'dawdaw');
        $data['nilaisladaytokocabang'] 		                            = $this->M_slatopclient->getsladaytokocabang(date('M Y'), 'dawdaw');
        $data['nilaisladayhera'] 		                            = $this->M_slatopclient->getsladayhera(date('M Y'), 'dawdaw');
        $data['nilaisladayindomall'] 		                            = $this->M_slatopclient->getsladayindomall(date('M Y'), 'dawdaw');
        $data['nilaiquerysladaytopclient'] 		                            = $this->M_slatopclient->getsladayclient(date('M Y'), 'dawdaw');

		$data['title'] = 'Performance';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_inbound_tokocabang',$data);
        $this->load->view('admin/layout/v_footer');

    }
    
    public function getSlaTopClient()
    {
        $date         = $this->input->post('date');
        $allclient       = $this->input->post('view_client_all');
        $nilaislatopclient = $this->M_slatopclient->getslatopclient($date, $allclient);

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