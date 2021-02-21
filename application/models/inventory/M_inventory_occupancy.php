<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory_occupancy extends CI_Model {

	public function emptyinventory()
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
        $emptyinventory       = " SELECT
								location_name,
                                grid_id,
                                grid_name,
                                is_active,
                                is_damaged,
                                total_qty
							FROM emptyinventory
                            where location_id = $location_id
                            ORDER BY location_id";
        // echo $emptyinventory;die;
        $emptyinventoryquery               = $this->db->query($emptyinventory)->result();
        return $emptyinventoryquery;

        // $config['emptyinventoryquery'] = $emptyinventoryquery->result();
        // $data['emptyinventoryquery'] = $config['emptyinventoryquery'];
        // $data['emptyinventory']  =  $this->db->query($emptyinventory)->result();
    }

}

/* End of file m_purchase.php */
/* Location: ./application/models/m_purchase.php */