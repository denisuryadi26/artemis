<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

    //--------------------ITEM CONTROL---------------------
    //MINIMUM STOCK
    public function minimumstock()
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
        $minimumstock = "SELECT 
                            id, 
                            item_code, 
                            item_name, 
                            item_price, 
                            stat, 
                            exist_quantity, 
                            minimum_stock, 
                            average
                        FROM minimumstock
                        WHERE location_id = $location_id ";
            if($program_id != "" || $program_id != NULL)
            { 
            $minimumstock .=          " AND program_id = $program_id ";
            }
            $minimumstock .=           " ORDER BY exist_quantity ASC, item_name ASC";
        $minimumstockquery = $this->db->query($minimumstock)->result_array();
        return $minimumstockquery;
    }

    //DEAD STOCK
    public function deadstock()
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

        $deadstock       = "    SELECT
                                    market_place, 
                                    item_sku,  
                                    item_name, 
                                    quantity, 
                                    DATE(inbound_date) AS inbound_date
                                FROM deadstock
                                WHERE location_id = $location_id "; 
        if($program_id != "" || $program_id != NULL)
        { 
            $deadstock       .=    " and program_id = $program_id ";
                               // -- and inventory_id IS NULL 
        }
        $deadstock       .=   " ORDER BY quantity DESC";
        // echo $deadstock;die;
        $deadstockquery  =  $this->db->query($deadstock)->result();
        return $deadstockquery;
    }
    //EXPIRED STOCK
    public function expiredstock()
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

        $expiredstock = " SELECT
                                    market_place, 
                                    item_sku, 
                                    item_name, 
                                    item_information, 
                                    grid, 
                                    ready_order, 
                                    onhand
                                FROM expiredstock
                                WHERE location_id = $location_id ";
        if($program_id != "" || $program_id != NULL)
        {                        
            $expiredstock .=  " AND program_id = $program_id ";
        }

        $expiredstock .=  " ORDER BY program_name DESC";
        // echo $expiredstock;die;
        $expiredstockquery  =  $this->db->query($expiredstock)->result();
        return $expiredstockquery;
    }


    //--------------------SHIPMENT CONTROL---------------------
    // NOT DELIVERED
    public function NotDelivered()
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
        // $this->db->select('program_name');
                            // DATE(dte) AS dte, 
                            // COUNT(*) AS total 
        // $this->db->from('shipmentcontrol');
        // $this->db->where('location_id', '1');
        // $this->db->where('status_id', '11');
        // $this->db->group_by('id, program_name, DATE(dte)');
        // $this->db->order_by('DATE(dte)', 'ASC');
        // $this->db->limit(10);
        // $querynotdelivered = $this->db->get()->result();
        // return $querynotdelivered;

        $notdelivered       = " SELECT
                                program_name, 
                                DATE(dte) AS dte, 
                                total
                            FROM notdelivered
                            WHERE location_id = $location_id 
                            -- and status_id = '11'
                            -- group by program_name, date(dte) 
                            -- order by date(dte) ASC";
        // echo $query;die;
        $notdeliveredquery  =  $this->db->query($notdelivered)->result();
        return $notdeliveredquery;
    }

    // WAYBILL NULL
    public function WaybillNull()
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
        // $this->db->select('  
        //                     program_name, 
        //                     DATE(dte) AS dte, 
        //                     total  ');
        // $this->db->from('shipmentcontrol');
        // $this->db->where('location_id', $location_id);
        // $this->db->where_in('status_code', ["ORD_STANDBY", "ORD_DELIVERY"]);
        // $this->db->where('awb_number','');
        // // $this->db->group_by('id,program_name, DATE(dte), total','ASC');
        // $this->db->order_by('DATE(dte)', 'ASC');;
        // $querywaybillnull = $this->db->get()->result();
        // return $querywaybillnull;

        $waybillnull       = " SELECT
                                program_name, 
                                DATE(dte) AS dte, 
                                total
                            FROM waybillnull
                            WHERE location_id = $location_id 
                            -- and status_code in ('ORD_STANDBY', 'ORD_DELIVERY')
                            -- and awb_number is NULL
                            -- order by DATE(dte) ASC
                            -- group by program_name, date(dte) 
                            -- order by date(dte) ASC";
        // echo $query;die;
        $waybillnullquery  =  $this->db->query($waybillnull)->result();
        return $waybillnullquery;
    }

    //--------------------OUTBOUND AGING---------------------
    public function OutboundAging()
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
        $this->db->select(" program_name, 
                            order_code, 
                            last_status, 
                            color, 
                            DATE(rtp_date) as rtp_date, 
                            TO_CHAR(rtp_time, 'HH24:MI:SS') as rtp_time,  
                            age");
        $this->db->from('outboundaging');
        $this->db->where('location_id', $location_id);
        // $this->db->where('status_code IN ("ORD_COMPLETE", "ORD_PRINTED", "ORD_ASSIGN", "ORD_OUTBOUND", "ORD_CHECKED", "ORD_PACKED", "ORD_STANDBY")');
        // $this->db->where('TIMESTAMPDIFF(HOUR, rtp_date, NOW()) >= 12');
        $this->db->order_by('rtp_date');
        // $this->db->limit($offset,$limit);
        $queryoutboundaging = $this->db->get()->result();
        return $queryoutboundaging;
    }

}