<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_purchaselist extends CI_Model {


    public function purchase()
    {
        $where = array();
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
        // echo var_dump($this->session->userdata('program_id'));
        if(!empty($this->input->get('search_by1') && $this->input->get('search_value1')))
        {
            $where[] = " AND CAST(".$this->input->get('search_by1')." AS TEXT) LIKE '%".$this->input->get('search_value1')."%'";
        }
        elseif(!empty($this->input->get('search_by1') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('search_by1') == 'Received'))
        {
            $where[] = " AND status = 'Received'";
        }
        elseif(!empty($this->input->get('search_by1') == 'Putaway'))
        {
            $where[] = " AND status = 'Putaway'";
        }
        elseif(!empty($this->input->get('search_by1') == 'Finish'))
        {
            $where[] = " AND status = 'Finish'";
        }
        if(!empty($this->input->get('search_by2') && $this->input->get('search_value2')))
        {
            $where[] = " AND CAST(".$this->input->get('search_by2')." AS TEXT) LIKE '%".$this->input->get('search_value2')."%'";
        }
        elseif(!empty($this->input->get('search_by2') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('search_by2') == 'Received'))
        {
            $where[] = " AND status = 'Received'";
        }
        elseif(!empty($this->input->get('search_by2') == 'Putaway'))
        {
            $where[] = " AND status = 'Putaway'";
        }
        elseif(!empty($this->input->get('search_by2') == 'Finish'))
        {
            $where[] = " AND status = 'Finish'";
        }
        $stringwhere = implode(" ", $where);
        
        // $query = "SELECT * FROM purchaselist WHERE program_id = ".$program_id." ".$stringwhere." LIMIT ".$limit." OFFSET ".$offset;
        // // echo var_dump($query);exit;
        // $querypurchase = $this->db->query($query)->result();

        // return $querypurchase;

        $query       = " SELECT
                                purchase_code,
                                item_code,
                                item_name,
                                quantity,
                                received,
                                putaway,
                                damaged,
                                status,
                                color
                            FROM purchaselist
                            WHERE 1=1 
                            and location_id = $location_id
                            and program_id = $program_id
                            $stringwhere";
        // echo $query;die;
        $querypurchase  =  $this->db->query($query)->result();
        return $querypurchase;

        // $this->db->select('        
        //                     purchase_code,
        //                     item_code,
        //                     item_name,
        //                     quantity,
        //                     received,
        //                     putaway,
        //                     damaged,
        //                     status,
        //                     color');
        // $this->db->from('purchaselist');
        // $this->db->where('location_id', $location_id);
        // $this->db->where('program_id', $program_id);
        // $this->db->where($stringwhere);
        // $this->db->limit($offset,$limit);
        // $querypurchase = $this->db->get()->result();
        // return $querypurchase;
    }


}