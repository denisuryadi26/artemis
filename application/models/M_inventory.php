<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory extends CI_Model {

	public function inventoryitem()
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
    if(!empty($this->input->get('item_search_by1') && $this->input->get('search_value1')))
    {
        $where[] = " AND CAST(".$this->input->get('item_search_by1')." AS TEXT) LIKE upper('%".$this->input->get('search_value1')."%')";
    }
    
    if(!empty($this->input->get('item_search_by2') && $this->input->get('search_value2')))
    {
        $where[] = " AND CAST(".$this->input->get('item_search_by2')." AS TEXT) LIKE upper('%".$this->input->get('search_value2')."%')";
    }
    
    $stringwhere = implode(" ", $where);

        $queryinventoryitem       = " SELECT
                                market_place,
                                item_code,
                                item_name,
                                item_barcode,
                                ready_order,
                                onhand,
                                damage
                            FROM inventoryitem
                            WHERE 1=1 
                            and location_id = $location_id
                            and program_id = $program_id
                            $stringwhere
                            ORDER BY inventory_id DESC";
        // echo $queryinventoryitem;die;
        $inventoryitem  =  $this->db->query($queryinventoryitem)->result();
        return $inventoryitem;
	}

	public function inventorygrid()
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
        if(!empty($this->input->get('grid_search_by1') && $this->input->get('grid_search_value1')))
        {
            $where[] = " AND CAST(".$this->input->get('grid_search_by1')." AS TEXT) LIKE '%".$this->input->get('grid_search_value1')."%'";
        }
        
        if(!empty($this->input->get('grid_search_by2') && $this->input->get('grid_search_value2')))
        {
            $where[] = " AND CAST(".$this->input->get('grid_search_by2')." AS TEXT) LIKE '%".$this->input->get('grid_search_value2')."%'";
        }
        
        $stringwhere = implode(" ", $where);

        $queryinventorygrid = " SELECT
                                market_place,
                                grid_name,
                                item_information,
                                item_code,
                                item_name,
                                ready_order,
                                onhand,
                                damage
                            FROM inventorygrid
                            WHERE 1=1 
                            and location_id = $location_id
                            and program_id = $program_id
                            $stringwhere
                            ORDER BY inventory_created_date DESC";
        // echo $queryinventorygrid;die;
        $inventorygrid  =  $this->db->query($queryinventorygrid)->result();
        return $inventorygrid;
	}

}

/* End of file M_inventory.php */
/* Location: ./application/models/M_inventory.php */