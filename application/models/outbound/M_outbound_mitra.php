<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_outbound_mitra extends CI_Model {

	public function getorder($date,$allclient)
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

        $filterclient      = $this->session->userdata('client');
        $filterlocation     = $this->session->userdata('list_location_id');

        // Untuk client privilage peruser
        $stringclient = "";
		foreach($filterclient as $client)
		{
			$stringclient = $stringclient.",".$client[0];
		}
        $stringclient = ltrim($stringclient, ',');

        // Untuk location privilage peruser
        $stringlocation = "";
		foreach($filterlocation as $location)
		{
			$stringlocation = $stringlocation.",".$location[0];
		}
        $stringlocation = ltrim($stringlocation, ',');

        $choose_location = "";
        if($_POST["view_wh_in"] == 'alllocation')
        {
            $choose_location = "AND location_id in (".$stringlocation.")
                                AND location_name NOT LIKE '%dummy%'";
            $nilai              = " sum(nilai) as nilai,";
            $groupby            = " GROUP BY order_created_date";
        }
        else 
        {
            $choose_location = "    AND location_id = $location_id";
            $nilai              = " nilai,";
            $groupby            = " ";
        }
        
        $choose_client = "";
        if($_POST["view_cl_in"] == 'allclient')
        {
            $choose_client = "";
            $nilai              = " sum(nilai) as nilai,";
            $groupby            = " GROUP BY order_created_date";
        }
        else 
        {
            $choose_client = "  AND program_id = $program_id";
            $nilai              = " nilai,";
            $groupby            = " ";
        }

        // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $_POST["date"]);
        $choose_month = "";
		$ordernumber = "  SELECT    
                                    $nilai
                                    order_created_date
                                FROM performanceperday
                                WHERE 1=1
                                -- AND date_trunc('month', order_created_date) = date_trunc('month', CURRENT_DATE)
                                AND to_char(order_created_date, 'Mon YYYY') = '$tanggal'
                                $choose_location
                                $choose_client
                                $groupby";
        // echo $ordernumber;die;
                                // date_trunc('month', CURRENT_DATE)
        $nilaiordernumber = $this->db->query($ordernumber)->result();
        return $nilaiordernumber;
    }

    public function getsla($date,$allclient)
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

        $filterclient      = $this->session->userdata('client');
        $filterlocation     = $this->session->userdata('list_location_id');

        // Untuk client privilage peruser
        $stringclient = "";
		foreach($filterclient as $client)
		{
			$stringclient = $stringclient.",".$client[0];
		}
        $stringclient = ltrim($stringclient, ',');

        // Untuk location privilage peruser
        $stringlocation = "";
		foreach($filterlocation as $location)
		{
			$stringlocation = $stringlocation.",".$location[0];
		}
        $stringlocation = ltrim($stringlocation, ',');

        $choose_location = "";
        if($_POST["view_wh_in"] == 'alllocation')
        {
            $choose_location = "AND location_id in (".$stringlocation.")
                                AND location_name NOT LIKE '%dummy%'";
            $nilai              = " case when round(avg(percentace_achievement),2) > 100 then '100.00' else round(avg(percentace_achievement),2) end as percentace_achievement,";
            $groupby            = " GROUP BY order_created_date";
        }
        else 
        {
            $choose_location = "    AND location_id = $location_id";
            $nilai              = " percentace_achievement,";
            $groupby            = " ";
        }
        
        $choose_client = "";
        if($_POST["view_cl_in"] == 'allclient')
        {
            $choose_client = "";
            $from               = "FROM slaoperationalallclientmitratokped";
            $nilai              = " case when round(avg(percentace_achievement),2) > 100 then '100.00' else round(avg(percentace_achievement),2) end as percentace_achievement,";
            $groupby            = " GROUP BY location_id, order_created_date, status_id";
        }
        else 
        {
            $choose_client = "  AND program_id = $program_id";
            $from               = "FROM slaoperationalmitratokped";
            $nilai              = " percentace_achievement,";
            $groupby            = " ";
        }

        // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $_POST["date"]);
        $choose_month = "";
		$sla = "  SELECT    
                                    $nilai
                                    order_created_date::date
                                $from
                                WHERE 1=1
                                AND to_char(order_created_date, 'Mon YYYY') = '$tanggal'
                                AND status_id = 11
                                $choose_location
                                $choose_client
                                $groupby";
        $nilaisla = $this->db->query($sla)->result();
        return $nilaisla;
    }
    
    public function getitemqty()
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

        $filterclient      = $this->session->userdata('client');
        $filterlocation     = $this->session->userdata('list_location_id');

        // Untuk client privilage peruser
        $stringclient = "";
		foreach($filterclient as $client)
		{
			$stringclient = $stringclient.",".$client[0];
		}
        $stringclient = ltrim($stringclient, ',');

        // Untuk location privilage peruser
        $stringlocation = "";
		foreach($filterlocation as $location)
		{
			$stringlocation = $stringlocation.",".$location[0];
		}
        $stringlocation = ltrim($stringlocation, ',');

        $choose_location = "";
        if($_POST["view_wh_in"] == 'alllocation')
        {
            $choose_location = "AND location_id in (".$stringlocation.")
                                AND location_name NOT LIKE '%dummy%'";
            $itemqty              = " sum(itemqty) as itemqty,";
            $groupby            = " GROUP BY order_created_date";
        }
        else
        {
            $choose_location = "    AND location_id = $location_id";
            $itemqty              = " itemqty,";
            $groupby            = " ";
        }

        $choose_client = "";
        if($_POST["view_cl_in"] == 'allclient')
        {
            $choose_client = "";
            $itemqty              = " sum(itemqty) as itemqty,";
            $groupby            = " GROUP BY order_created_date";
        }
        else
        {
            $choose_client = "    AND program_id = $program_id";
            $itemqty              = " itemqty,";
            $groupby            = " ";
        }
        $tanggal = str_replace("+", " ", $_POST["date"]);
        $choose_month = "";
		$itemqty = "            SELECT
                                    $itemqty
                                    order_created_date
                                FROM itemqtyperformanceday
                                WHERE 1=1
                                AND to_char(order_created_date, 'Mon YYYY') = '$tanggal'
                                $choose_location
                                $choose_client
                                $groupby ";
        $nilaiitemqty = $this->db->query($itemqty)->result();
        return $nilaiitemqty;
    }    

}

/* End of file M_performanceperday.php */
/* Location: ./application/models/M_performanceperday.php */