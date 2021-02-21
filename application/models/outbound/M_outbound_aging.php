<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_outbound_aging extends CI_Model {

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