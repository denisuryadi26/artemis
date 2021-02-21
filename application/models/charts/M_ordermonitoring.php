<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_ordermonitoring extends CI_Model 
{
    public function getordermonitoring($date, $allclient)
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

        if($program_id == '' || $program_id == NULL)
        {
            $program_id = 29;
        }
        
        $choose_client = "";
		if($allclient == 'all_clientmonitoring'){
            $choose_client = " AND location_id = $location_id";
        }
		else{
            $choose_client = "  AND location_id = $location_id
                                AND program_id = $program_id";
        }
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $dailymonitoring = "SELECT
                                pending_days,
                                date,
                                order_created_date,
                                sum(order_created) as order_created,
                                sum(order_printed) as order_printed,
                                sum(order_packed) as order_packed,
                                sum(packed_item_qty) as packed_item_qty,
                                sum(order_rts) as order_rts,
                                sum(order_shipped) as order_shipped,
                                sum(pending_system) as pending_system,
                                sum(pending_outbound) as pending_outbound,
                                sum(pending_item_qty) as pending_item_qty,
                                sum(cancel) as cancel,
                                sum(pending_dispatch) as pending_dispatch,
                                sum(pending_shipped) as pending_shipped,
                                sum(dispatch_complete) as dispatch_complete
                            FROM
                                dailymonitoring 
                            WHERE
                                1 = 1 
                                -- AND date_trunc( 'month', order_created_date ) = date_trunc( 'month', CURRENT_DATE ) 
                                AND to_char(order_created_date, 'Mon YYYY') = '$tanggal'
                                $choose_client
                                GROUP BY pending_days, date, order_created_date
                                ORDER BY order_created_date ASC";
        // echo $ordernumber;die;
                                // date_trunc('month', CURRENT_DATE)
        $nilaidailymonitoring = $this->db->query($dailymonitoring)->result();
        return $nilaidailymonitoring;
    }
}