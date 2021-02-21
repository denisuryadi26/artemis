<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_shipment extends CI_Model {


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

}