<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_charttable extends CI_Model {
    public function getpendingbefore4pm($allclient)
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

        // $choose_client = "";
		// if($_POST["view_client_all"] == 'all_client'){
        //     $choose_client = " AND location_id = $location_id";
        // }
		// else{
        //     $choose_client = "  AND location_id = $location_id
        //                         AND program_id = $program_id";
        // }
		$pendingbefore4pm = "  SELECT        
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
                                        ORDER BY jam ASC
                                        ";
        $nilaipendingbefore4pm = $this->db->query($pendingbefore4pm)->result();
        return $nilaipendingbefore4pm;
    }

    public function getpendingafter4pm($allclient)
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

        // $choose_client = "";
		// if($_POST["view_client_all"] == 'all_client'){
        //     $choose_client = " AND location_id = $location_id";
        // }
		// else{
        //     $choose_client = "  AND location_id = $location_id
        //                         AND program_id = $program_id";
        // }
		$pendingafter4pm = "  SELECT        
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
                                        ORDER BY jam ASC
                                        ";
        $nilaipendingafter4pm = $this->db->query($pendingafter4pm)->result();
        return $nilaipendingafter4pm;
    }

    public function getpendingdplusn($allclient)
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

        // $choose_client = "";
		// if($_POST["view_client_all"] == 'all_client'){
        //     $choose_client = " AND location_id = $location_id";
        // }
		// else{
        //     $choose_client = "  AND location_id = $location_id
        //                         AND program_id = $program_id";
        // }
		$pendingdplusn = "  SELECT        
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
                                        ORDER BY jam ASC
                                        ";
        $nilaipendingdplusn = $this->db->query($pendingdplusn)->result();
        return $nilaipendingdplusn;
    }
}