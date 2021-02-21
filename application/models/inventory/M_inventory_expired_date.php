<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory_expired_date extends CI_Model {
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
}