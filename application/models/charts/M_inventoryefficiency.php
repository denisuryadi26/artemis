<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_inventoryefficiency extends CI_Model 
{
    public function getinventorygrid($date)
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
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $inventorygridefficiency = "   SELECT
                                grid_name,
                                total_grid,
                                avg_perday,
                                total_day
                            FROM inventorygridefficiency
                            where 1=1
                            and location_id = $location_id
                            order by avg_perday DESC
                            limit 20";
        $nilaiinventorygridefficiency = $this->db->query($inventorygridefficiency)->result();
        return $nilaiinventorygridefficiency;
    }
    public function getinventorysku($date)
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
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $inventoryskuefficiency = "   SELECT
                                sku_name,
                                total_sku,
                                avg_perday,
                                total_day
                            FROM inventoryskuefficiency
                            where 1=1
                            and location_id = $location_id
                            order by avg_perday DESC
                            limit 20";
        $nilaiinventoryskuefficiency = $this->db->query($inventoryskuefficiency)->result();
        return $nilaiinventoryskuefficiency;
    }
}