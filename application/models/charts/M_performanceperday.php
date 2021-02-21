<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_performanceperday extends CI_Model {

	public function getordernumber($date,$allclient)
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
            $from               = "FROM slaoperationalallclient";
            $nilai              = " case when round(avg(percentace_achievement),2) > 100 then '100.00' else round(avg(percentace_achievement),2) end as percentace_achievement,";
            $groupby            = " GROUP BY location_id, order_created_date, status_id";
        }
        else 
        {
            $choose_client = "  AND program_id = $program_id";
            $from               = "FROM slaoperational";
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
                                AND status_id = 27
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
    
    public function getorderperhour()
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

        $choose_location = "";
		if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        $choose_client = "";
		if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $trendorderhours = "    SELECT
                                    sum(nilai) as nilai,
                                    jam
                                FROM trendorderhours
                                -- WHERE DATE_TRUNC('month',order_created_date) = date_trunc('month', CURRENT_DATE)
                                WHERE DATE(order_created_date) = CURRENT_DATE
                                $choose_location
                                $choose_client
                                GROUP BY jam
                                ORDER BY jam ASC";
        $nilaitrendorderhours = $this->db->query($trendorderhours)->result();
        return $nilaitrendorderhours;
    }

    public function getitemqtyperhour()
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

        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
		$itemqtyperhours = "  SELECT        
                                    sum(itemqty) as itemqty,
                                    jam
                                FROM itemqtyperhour
                                -- WHERE DATE_TRUNC('month',order_created_date) = date_trunc('month', CURRENT_DATE)
                                WHERE 1=1 
                                $choose_location
                                $choose_client
                                AND DATE(order_created_date) = CURRENT_DATE
                                GROUP BY jam
                                ORDER BY jam ASC";
        $nilaiitemqtyperhours = $this->db->query($itemqtyperhours)->result();
        return $nilaiitemqtyperhours;
    }
    
    public function getordercompletionperhourblue()
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

        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
		$ordercompletionperdayblue = "  SELECT        
                                            'Complete' as status,
                                            sum(nilai) as nilai
                                        FROM ordercompletionperday
                                        WHERE 1=1
                                        -- AND status_id in ( '11', '10','12' ) -- shipped & RTS
                                        AND DATE(order_created_date) = CURRENT_DATE
                                        $choose_location
                                        $choose_client";
        $nilaiordercompletionperdayblue = $this->db->query($ordercompletionperdayblue)->result();
        return $nilaiordercompletionperdayblue;
    }
    
    public function getordercompletionperhouryellow()
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
        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $ordercompletionperdayyellow = "    SELECT   
                                                'Not Complete' as status,
                                                sum(nilai) as nilai
                                            FROM ordernotcompletionperday
                                            WHERE 1=1
                                            -- AND status_id IN ( 8, 24, 26, 9, 25, 27 )-- Ready To Picked s/d Packed
                                            AND DATE(order_created_date) = CURRENT_DATE
                                            $choose_location
                                            $choose_client";
        $nilaiordercompletionperdayyellow = $this->db->query($ordercompletionperdayyellow)->result();
        return $nilaiordercompletionperdayyellow;
    }

    public function getOperationLeadTime()
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

        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $operationleadtime = "  SELECT
                                    'AVG LT RTS' AS status,
                                    AVG ( avg_lt_rts :: TIME )  as avg
                                FROM
                                    operationleadtime
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                
                                UNION ALL
                                SELECT
                                    'AVG LT Packed' AS status,
                                    AVG ( avg_lt_packed :: TIME )  as avg
                                FROM
                                    operationleadtime
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT Picker & Checker' AS status,
                                    AVG ( avg_lt_picker_checker :: TIME )  as avg
                                FROM
                                    operationleadtime
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT ATP' AS status,
                                    AVG ( avg_lt_atp :: TIME )  as avg
                                FROM
                                    operationleadtime
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT Printed' AS status,
                                    AVG ( avg_printed :: TIME )  as avg
                                FROM
                                    operationleadtime
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client";
        $nilaioperationleadtime = $this->db->query($operationleadtime)->result();
        return $nilaioperationleadtime;
    }

    public function getordermonitoringperday()
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

        $choose_location = "";
		if($_POST["view_wh_in"] == 'alllocation')
            $choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        $choose_client = "";
		if($_POST["view_cl_in"] == 'allclient')
            $choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $ordermonitoringperday = "  SELECT
                                        'Cancel' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 14 -- Cancel
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                    
                                    
                                    UNION ALL
                                    SELECT
                                        'Shipping Complete' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 11 -- Shipped
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                        
                                    UNION ALL
                                    SELECT
                                        'RTS Complete' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 10 -- RTS
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                    
                                    UNION ALL
                                    SELECT
                                        'Order Packed' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 27 -- Packed
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client

                                    UNION ALL
                                        
                                    SELECT
                                        'Pending Order After 4 PM' AS status,
                                        COALESCE (SUM(nilai),0) as nilai
                                    FROM
                                        ordermonitoringperhour 
                                    WHERE
                                        1 = 1 
                                        AND TO_CHAR( order_created_date, 'YYYY-mm-dd HH24:MI:SS' ) BETWEEN to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 16:00:00' ) 
                                        AND to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 23:59:59' )
                                    $choose_location
                                    $choose_client

                                    UNION ALL
                                    SELECT
                                        'Pending Order Before 4 PM' AS status,
                                        COALESCE (SUM(nilai),0) as nilai
                                    FROM
                                        ordermonitoringperhour 
                                    WHERE
                                        1 = 1 
                                        AND TO_CHAR( order_created_date, 'YYYY-mm-dd HH24:MI:SS' ) BETWEEN to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 00:00:00' ) 
                                        AND to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 15:59:59' )
                                    $choose_location
                                    $choose_client
                                    
                                    UNION ALL
                                    
                                    SELECT
                                        'Pending Order D+N After 4 PM' AS status,
                                        COALESCE ( SUM ( nilai ), 0 ) AS nilai 
                                    FROM
                                        ordermonitoringperhour 
                                    WHERE
                                        1 = 1
                                        
                                        AND TO_CHAR( order_created_date :: DATE, 'YYYY-MM-DD HH24:MI:SS' ) between to_char( NOW( ) - INTERVAL '1' DAY, 'YYYY-MM-DD 16:00:00' ) and to_char( NOW( ) - INTERVAL '1' DAY, 'YYYY-MM-DD 23:59:59' )
                                    $choose_location
                                    $choose_client
                                        
                                    UNION ALL
                                    
                                    SELECT
                                        'Pending Order D+N' AS status,
                                        COALESCE (SUM(nilai),0) as nilai
                                    FROM
                                        ordermonitoringperhour 
                                    WHERE
                                        1 = 1 
                                        -- AND status_id = 16 -- Pending
                                        
                                        AND TO_CHAR(order_created_date :: DATE, 'YYYY-MM-DD HH24:MI:SS') <= to_char( NOW() - INTERVAL '1' Day, 'YYYY-MM-DD 15:59:59' ) 
                                    $choose_location
                                    $choose_client";
        $nilaiordermonitoringperday = $this->db->query($ordermonitoringperday)->result();
        return $nilaiordermonitoringperday;
    }
    

}

/* End of file M_performanceperday.php */
/* Location: ./application/models/M_performanceperday.php */