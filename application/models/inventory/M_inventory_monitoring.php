<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory_monitoring extends CI_Model {

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

}